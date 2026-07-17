const DESKTOP_MEDIA = "(min-width: 768px)";
const MIN_COLUMN_WIDTH = 260;
const MAX_COLUMNS = 3;
const GAP = 24;
const RESIZE_REINIT_DELAY = 100;

const clamp = (value, min, max) => Math.max(min, Math.min(value, max));

const getImageSize = (image) => {
	const width =
		image?.naturalWidth || Number(image?.getAttribute("width")) || 0;
	const height =
		image?.naturalHeight || Number(image?.getAttribute("height")) || 0;

	return { width, height };
};

const getColumnCount = (galleryWidth) => {
	return clamp(
		Math.floor((galleryWidth + GAP) / (MIN_COLUMN_WIDTH + GAP)),
		2,
		MAX_COLUMNS,
	);
};

const resetGallery = (gallery, items) => {
	gallery.style.height = "";

	items.forEach((item) => {
		item.style.position = "";
		item.style.left = "";
		item.style.top = "";
		item.style.width = "";
		item.style.height = "";
	});
};

const setItemWidth = (gallery, items) => {
	const galleryWidth = gallery.clientWidth;
	const columnCount = getColumnCount(galleryWidth);
	const columnWidth = (galleryWidth - GAP * (columnCount - 1)) / columnCount;

	items.forEach((item) => {
		item.style.width = `${columnWidth}px`;
	});

	return columnWidth;
};

const layoutGallery = (gallery) => {
	const items = Array.from(gallery.querySelectorAll(".gallery__item"));

	if (!items.length) {
		return;
	}

	if (!window.matchMedia(DESKTOP_MEDIA).matches) {
		resetGallery(gallery, items);
		return;
	}

	const columnCount = getColumnCount(gallery.clientWidth);
	const columnWidth = setItemWidth(gallery, items);
	const columnHeights = Array(columnCount).fill(0);

	items.forEach((item, index) => {
		const image = item.querySelector("img");
		const { width, height } = getImageSize(image);
		const imageRatio = width && height ? width / height : 4 / 3;
		const itemHeight = columnWidth / imageRatio;
		const columnIndex = index % columnCount;
		const left = columnIndex * (columnWidth + GAP);
		const top = columnHeights[columnIndex];

		item.style.position = "absolute";
		item.style.left = `${left}px`;
		item.style.top = `${top}px`;
		item.style.width = `${columnWidth}px`;
		item.style.height = `${itemHeight}px`;

		columnHeights[columnIndex] = top + itemHeight + GAP;
	});

	gallery.style.height = `${Math.max(...columnHeights) - GAP}px`;
};

const layoutGalleries = (galleries) => {
	galleries.forEach(layoutGallery);
};

export const initPortfolioListBatch = () => {
	const galleries = Array.from(document.querySelectorAll(".gallery")).filter(
		(gallery) => !gallery.dataset.portfolioListBatchInited,
	);

	if (!galleries.length) {
		return;
	}

	galleries.forEach((gallery) => {
		gallery.dataset.portfolioListBatchInited = "true";
	});

	layoutGalleries(galleries);

	let layoutTimer;
	const pendingGalleries = new Set();

	const scheduleLayout = (gallery) => {
		pendingGalleries.add(gallery);
		window.clearTimeout(layoutTimer);
		layoutTimer = window.setTimeout(() => {
			pendingGalleries.forEach(layoutGallery);
			pendingGalleries.clear();
		}, 80);
	};

	galleries.forEach((gallery) => {
		gallery.querySelectorAll("img").forEach((image) => {
			if (!image.complete) {
				image.addEventListener(
					"load",
					() => {
						scheduleLayout(gallery);
					},
					{ once: true },
				);
				image.addEventListener(
					"error",
					() => {
						scheduleLayout(gallery);
					},
					{ once: true },
				);
			}
		});
	});

	let resizeTimeout;

	window.addEventListener("resize", () => {
		window.clearTimeout(resizeTimeout);
		resizeTimeout = window.setTimeout(() => {
			layoutGalleries(galleries);
		}, RESIZE_REINIT_DELAY);
	});
};

if (document.readyState === "loading") {
	document.addEventListener("DOMContentLoaded", initPortfolioListBatch, {
		once: true,
	});
} else {
	initPortfolioListBatch();
}

if (window.BX?.ready) {
	window.BX.ready(initPortfolioListBatch);
}

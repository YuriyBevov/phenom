const sliders = document.querySelectorAll(".base-card-slider");

if (sliders) {
	sliders.forEach((slider) => {
		const slidesDesktopViewCount = slider.dataset.slidesDesktopViewCount;
		const slidesTabletViewCount = slider.dataset.slidesTabletViewCount;
		const slidesMobileViewCount = slider.dataset.slidesMobileViewCount;

		// const btnNext = slider.closest('swiper-navigation-container');

		const btnPrev = slider.parentNode.querySelector(".swiper-btn-prev");
		const btnNext = slider.parentNode.querySelector(".swiper-btn-next");

		new Swiper(slider, {
			slidesPerView: slidesMobileViewCount ?? 1,
			spaceBetween: 24,
			breakpoints: {
				620: {
					slidesPerView: slidesTabletViewCount ?? 2,
				},
				1024: {
					slidesPerView: slidesDesktopViewCount ?? 3,
				},
			},
			navigation: {
				nextEl: btnNext ? btnNext : null,
				prevEl: btnPrev ? btnPrev : null,
			},
		});
	});
}

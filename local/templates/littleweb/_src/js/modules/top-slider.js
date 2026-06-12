import Swiper from "swiper";
import { Navigation, Pagination } from "swiper/modules";

// Регистрируем нужные модули глобально
Swiper.use([Navigation, Pagination]);

const topBannerSlider = document.querySelector(".top-banner .swiper");

if (topBannerSlider) {
	const btnPrev = topBannerSlider.parentNode.querySelector(".swiper-btn--prev");
	const btnNext = topBannerSlider.parentNode.querySelector(".swiper-btn--next");
	const pagination =
		topBannerSlider.parentNode.querySelector(".swiper-pagination");

	new Swiper(topBannerSlider, {
		slidesPerView: 1,
		spaceBetween: 24,

		navigation: {
			nextEl: btnNext ? btnNext : null,
			prevEl: btnPrev ? btnPrev : null,
		},

		pagination: {
			el: pagination ? pagination : null,
			clickable: true, // makes the bullets clickable
		},
	});
}

import Swiper from "swiper";
import { Navigation, Pagination } from "swiper/modules";

// Регистрируем нужные модули глобально
Swiper.use([Navigation, Pagination]);

const brandsSlider = document.querySelector(".brands .swiper");

if (brandsSlider) {
	const btnPrev = brandsSlider.parentNode.querySelector(".swiper-btn--prev");
	const btnNext = brandsSlider.parentNode.querySelector(".swiper-btn--next");
	const pagination =
		brandsSlider.parentNode.querySelector(".swiper-pagination");

	new Swiper(brandsSlider, {
		slidesPerView: "auto",
		spaceBetween: 20,

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

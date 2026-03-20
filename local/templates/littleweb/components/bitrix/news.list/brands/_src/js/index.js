import Swiper from "swiper";
import { Navigation, Pagination } from "swiper/modules";

// Регистрируем нужные модули глобально
Swiper.use([Navigation, Pagination]);
// Экспортируем для внешнего использования

const slider = document.querySelector(".top-banner .swiper");

if (slider) {
	const btnPrev = slider.parentNode.querySelector(".swiper-btn--prev");
	const btnNext = slider.parentNode.querySelector(".swiper-btn--next");
	const pagination = slider.parentNode.querySelector(".swiper-pagination");
	console.log(pagination);

	new Swiper(slider, {
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

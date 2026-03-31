import Swiper from "swiper";
import { Navigation, Pagination } from "swiper/modules";

// Регистрируем нужные модули глобально
Swiper.use([Navigation, Pagination]);

const sliders = document.querySelectorAll(".swiper.--autofill");

if (sliders) {
	sliders.forEach((slider) => {
		const btnPrev = slider.parentNode.querySelector(".swiper-btn--prev");
		const btnNext = slider.parentNode.querySelector(".swiper-btn--next");
		const pagination = slider.parentNode.querySelector(".swiper-pagination");

		new Swiper(slider, {
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
	});
}

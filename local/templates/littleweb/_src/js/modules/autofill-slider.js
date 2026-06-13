import Swiper from "swiper";
import { Navigation, Pagination } from "swiper/modules";
const autofillSliders = document.querySelectorAll(".autofill-slider");

if (autofillSliders) {
	autofillSliders.forEach((slider) => {
		const btnPrev = slider.parentNode.querySelector(".swiper-btn--prev");
		const btnNext = slider.parentNode.querySelector(".swiper-btn--next");
		const pagination = slider.parentNode.querySelector(".swiper-pagination");

		new Swiper(slider, {
			slidesPerView: "auto",
			spaceBetween: 24,

			navigation: {
				nextEl: btnNext ? btnNext : null,
				prevEl: btnPrev ? btnPrev : null,
			},

			pagination: {
				el: pagination ? pagination : null,
				dynamicBullets: true,
				clickable: true,
			},
		});
	});
}

import Swiper from "swiper";
import { Navigation, Pagination } from "swiper/modules";

// Регистрируем нужные модули глобально
Swiper.use([Navigation, Pagination]);
window.Swiper = Swiper;

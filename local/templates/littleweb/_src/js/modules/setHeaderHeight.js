import { setHeaderHeight } from "../functions/setHeaderHeight";

export const initSetHeaderHeight = () => {
	return setHeaderHeight();
};

if (document.readyState === "loading") {
	document.addEventListener("DOMContentLoaded", initSetHeaderHeight, { once: true });
} else {
	initSetHeaderHeight();
}

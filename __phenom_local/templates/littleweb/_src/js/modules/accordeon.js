const accordeons = document.querySelectorAll(".accordeon");

if (accordeons) {
	accordeons.forEach((accordeon) => {
		const expanders = accordeon.querySelectorAll(".accordeon-expander");

		expanders.forEach((expander) => {
			expander.addEventListener("click", () => {
				expander.closest(".accordeon-item").classList.toggle("expanded");
			});
		});
	});
}

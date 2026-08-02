import IMask from "imask";

const phoneMaskOptions = {
	mask: "+{7} (000) 000-00-00",
};

const phoneInputSelector = [
	'input[data-type="tel"]',
	'input[data-type="phone"]',
	'input[type="tel"]',
].join(",");

function isPhoneInput(input) {
	if (!(input instanceof HTMLInputElement)) {
		return false;
	}

	const fieldName = `${input.name || ""} ${input.id || ""}`.toLowerCase();
	return (
		input.matches(phoneInputSelector) ||
		fieldName.includes("phone") ||
		fieldName.includes("tel")
	);
}

function getPhoneInputs(root = document) {
	const scope = root instanceof Element ? root : document;
	const inputs = new Set();

	if (isPhoneInput(scope)) {
		inputs.add(scope);
	}

	scope.querySelectorAll("input").forEach((input) => {
		if (isPhoneInput(input)) {
			inputs.add(input);
		}
	});

	return Array.from(inputs);
}

export function initPhoneMasks(root = document) {
	getPhoneInputs(root).forEach((input) => {
		if (!input.phoneMaskInstance) {
			input.phoneMaskInstance = IMask(input, phoneMaskOptions);
		}
	});
}

function observeAjaxContent() {
	const observer = new MutationObserver((mutations) => {
		mutations.forEach((mutation) => {
			mutation.addedNodes.forEach((node) => {
				if (node instanceof Element) {
					initPhoneMasks(node);
				}
			});
		});
	});

	observer.observe(document.body, {
		childList: true,
		subtree: true,
	});
}

function initPhoneMaskModule() {
	initPhoneMasks();
	observeAjaxContent();
}

if (document.readyState === "loading") {
	document.addEventListener("DOMContentLoaded", initPhoneMaskModule);
} else {
	initPhoneMaskModule();
}

if (window.BX?.addCustomEvent) {
	BX.addCustomEvent("onAjaxSuccess", () => initPhoneMasks());
	BX.addCustomEvent("onFrameDataReceived", () => initPhoneMasks());
}

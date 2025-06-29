document.addEventListener("DOMContentLoaded", function () {
	document.querySelectorAll("[data-copy]").forEach((el) => {
		el.style.cursor = "pointer"; // визуально даёт понять, что элемент кликабельный

		el.addEventListener("click", () => {
			const textToCopy = el.getAttribute("data-copy");

			if (!textToCopy) return;

			navigator.clipboard
				.writeText(textToCopy)
				.then(() => {
					el.classList.add("copied");
					setTimeout(() => el.classList.remove("copied"), 1000);
				})
				.catch((err) => {
					console.error("Ошибка копирования: ", err);
				});
		});
	});
});

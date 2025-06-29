document.addEventListener("DOMContentLoaded", function () {
	// Хранилище текущей открытой формы
	let activeFormWrapper = null;
	const body = document.body;

	// Открытие формы
	document.querySelectorAll("#hp-add-comment").forEach((button) => {
		button.addEventListener("click", function () {
			const modalSelector = `.hp-review-form__wrapper`;
			const modalWrapper = document.querySelector(modalSelector);

			if (modalWrapper) {
				body.classList.add("no-scroll");
				modalWrapper.dataset.show = "true";
				modalWrapper.classList.add("is-visible");
				activeFormWrapper = modalWrapper;
			}
		});
	});

	// Закрытие по кнопке "Сброс"
	document.querySelectorAll(".hp-review-form__wrapper form").forEach((form) => {
		const resetButton = form.querySelector('button[type="reset"]');
		if (resetButton) {
			resetButton.addEventListener("click", function (e) {
				e.preventDefault();
				const wrapper = form.closest(".hp-review-form__wrapper");
				if (wrapper) {
					body.classList.remove("no-scroll");
					wrapper.dataset.show = "false";
					wrapper.classList.remove("is-visible");
					activeFormWrapper = null;
				}
			});
		}
	});

	// Закрытие по клавише ESC
	document.addEventListener("keydown", function (e) {
		if (e.key === "Escape" && activeFormWrapper) {
			body.classList.remove("no-scroll");
			activeFormWrapper.dataset.show = "false";
			activeFormWrapper.classList.remove("is-visible");
			activeFormWrapper = null;
		}
	});
});

document.addEventListener("DOMContentLoaded", function () {
	const form = document.querySelector(".hp-review-form");

	if (!form) return;

	const wrapper = form.closest(".hp-review-form__wrapper");
	const body = document.body;
	let isLoading = false;

	function disableForm(form) {
		const elements = form.querySelectorAll("input, textarea, button, select");
		elements.forEach((el) => (el.disabled = true));
	}

	function enableForm(form) {
		const elements = form.querySelectorAll("input, textarea, button, select");
		elements.forEach((el) => (el.disabled = false));
	}

	form.addEventListener("submit", function (e) {
		e.preventDefault();

		if (isLoading) return;
		isLoading = true;

		const formData = new FormData(form);

		if (formData.get("website")) {
			console.warn("SPAM detected");
			return;
		}

		// Подготовка данных
		const data = {
			action: "submit_hp_comment",
			fullname: formData.get("fullname"),
			email: formData.get("email"),
			review: formData.get("review"),
			rating: formData.get("rating"),
			post_id: wp_data.post_id,
		};

		const email = data.email?.trim();
		const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		if (email.length < 3 || !emailRegex.test(email)) {
			alert("Почта должна быть заполнена!");
			return;
		}

		const rating = parseInt(data.rating, 10);
		if (rating < 1 || rating > 5) {
			alert("Оценка должна быть от 1 до 5.");
			return;
		}

		const review = data.review?.trim();
		if (review.length < 10 || review.length >= 360) {
			alert("Комментарий должн быть от 10 до 360 символов.");
			return;
		}

		disableForm(form);

		fetch(wp_data.ajax_url, {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
			},
			body: new URLSearchParams({
				action: "submit_hp_comment",
				fullname: formData.get("fullname"),
				email: formData.get("email"),
				review: formData.get("review"),
				rating: formData.get("rating"),
				post_id: formData.get("post_id"),
				nonce: wp_data.nonce,
			}).toString(),
		})
			.then((res) => res.json())
			.then((response) => {
				if (response.success) {
					alert("Спасибо за отзыв!");
				} else {
					alert("Ошибка: " + (response.data || "не удалось отправить"));
				}
			})
			.catch((err) => {
				console.error("AJAX error", err);
				alert("Ошибка при отправке формы.");
			})
			.finally(() => {
				body.classList.remove("no-scroll");
				wrapper.dataset.show = "false";
				wrapper.classList.remove("is-visible");
				form.reset();
				enableForm(form);
				isLoading = false;
			});
	});
});

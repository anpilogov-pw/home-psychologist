jQuery(document).ready(function ($) {
	$("body").on("change", ".hp-switch .hp-toggle", function () {
		const checkbox = $(this);
		const postId = checkbox.data("post");
		const value = checkbox.is(":checked") ? 1 : 0;

		const allToggles = $(".hp-switch .hp-toggle");
		const container = checkbox.closest(".hp-switch");
		const spinner = container.find(".spinner");

		// Блокируем все
		allToggles.prop("disabled", true).addClass("hp-toggle-disabled");
		showHPBooksNotice("Сохраняем...", "#777", 1000);
		spinner.show();

		$.ajax({
			url: HPBooksAjax.ajax_url,
			method: "POST",
			data: {
				action: "hp_books_toggle_on_main",
				nonce: HPBooksAjax.nonce,
				post_id: postId,
				value: value,
			},
			complete: function () {
				spinner.hide();
				allToggles.prop("disabled", false).removeClass("hp-toggle-disabled");
			},
			success: function (response) {
				if (response.success) {
					showHPBooksNotice("Успешно сохранено");
				} else {
					showHPBooksNotice("Ошибка: " + response.data, "#dc3232");
					checkbox.prop("checked", !value).trigger("change");
				}
			},
			error: function () {
				showHPBooksNotice("Ошибка сети. Повторите попытку.", "#dc3232");
				checkbox.prop("checked", !value).trigger("change");
			},
		});
	});
});

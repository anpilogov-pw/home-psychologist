function showHPBooksNotice(message, color = "#007cba", timeout = 2000) {
	const notice = jQuery("#hp-books-notice");
	notice
		.css({
			background: color,
			display: "block",
		})
		.text(message);

	setTimeout(() => {
		notice.fadeOut();
	}, timeout);
}

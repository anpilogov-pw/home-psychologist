document.addEventListener("DOMContentLoaded", () => {
	const shareButton = document.getElementById("hp-share");

	if (!shareButton) {
		return;
	}

	if (!navigator.share) {
		shareButton.style.display = "none";
		return;
	}

	shareButton.addEventListener("click", async () => {
		try {
			await navigator.share({
				title: document.title,
				text: "Рекомендую прочитать эту статью на Home Психолог:",
				url: window.location.href,
			});
		} catch (err) {
			console.error("Ошибка при попытке поделиться:", err);
		}
	});
});

document.addEventListener("DOMContentLoaded", () => {
	(function () {
		const menuButton = document.getElementById("hp-menu-button");
		const menuElement = document.querySelector(".hp-nav-menu");
		const body = document.body;

		if (!menuButton || !menuElement) return;

		menuButton.addEventListener("click", (event) => {
			event.preventDefault();
			const isHidden = menuElement.classList.toggle("hp-nav-menu__hidden");
			menuButton.dataset.checked = !isHidden;
			body.classList.toggle("no-scroll", !isHidden);
		});
	})();
});

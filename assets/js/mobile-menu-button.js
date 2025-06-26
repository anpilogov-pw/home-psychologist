document.addEventListener("DOMContentLoaded", function () {
	const button = document.getElementById("hp-category-mobile-menu-button");
	const buttonClose = document.getElementById("hp-categories-nav-close");
	const nav = document.getElementById("hp-categories-nav");
	const body = document.body;

	if (button && nav && buttonClose && body) {
		const toggleMenu = () => {
			const isHidden = nav.classList.contains("hp-categories-nav_hidden");

			if (isHidden) {
				nav.classList.remove("hp-categories-nav_hidden");
				body.classList.add("no-scroll");
			} else {
				nav.classList.add("hp-categories-nav_hidden");
				body.classList.remove("no-scroll");
			}
		};

		button.addEventListener("click", toggleMenu);
		buttonClose.addEventListener("click", toggleMenu);
	}
});

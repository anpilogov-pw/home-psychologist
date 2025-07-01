document.addEventListener("DOMContentLoaded", function () {
	const wrapper = document.querySelector(".hp-book-gallery__wrapper");

	if (!wrapper) return;

	const gallery = wrapper.querySelector(".hp-book-gallery-list");
	const startBtn = wrapper.querySelector(".hp-book-gallery-list__start");
	const endBtn = wrapper.querySelector(".hp-book-gallery-list__end");

	if (!gallery || !startBtn || !endBtn) return;

	const isMobile = () => window.innerWidth < 768;

	function getScrollOffset() {
		const firstItem = gallery.querySelector("a");
		if (!firstItem) return 100;
		return isMobile()
			? firstItem.offsetWidth + parseInt(getComputedStyle(gallery).gap || 8)
			: firstItem.offsetHeight + parseInt(getComputedStyle(gallery).gap || 8);
	}

	function scrollByOneItem(direction = "forward") {
		const offset = getScrollOffset();
		const behavior = "smooth";

		if (isMobile()) {
			gallery.scrollBy({
				left: direction === "forward" ? offset : -offset,
				behavior,
			});
		} else {
			gallery.scrollBy({
				top: direction === "forward" ? offset : -offset,
				behavior,
			});
		}
	}

	function checkVisibility() {
		const items = gallery.querySelectorAll("a");
		if (!items.length) return;

		const containerRect = gallery.getBoundingClientRect();
		const firstRect = items[0].getBoundingClientRect();
		const lastRect = items[items.length - 1].getBoundingClientRect();

		let firstVisible, lastVisible;

		if (isMobile()) {
			firstVisible = firstRect.left >= containerRect.left;
			lastVisible = lastRect.right <= containerRect.right;
		} else {
			firstVisible = firstRect.top >= containerRect.top;
			lastVisible = lastRect.bottom <= containerRect.bottom;
		}

		startBtn.style.display = firstVisible ? "none" : "";
		endBtn.style.display = lastVisible ? "none" : "";
	}

	// Прокрутка по клику
	startBtn.addEventListener("click", () => scrollByOneItem("backward"));
	endBtn.addEventListener("click", () => scrollByOneItem("forward"));

	// Проверка видимости кнопок
	gallery.addEventListener("scroll", checkVisibility);
	window.addEventListener("resize", checkVisibility);
	window.addEventListener("load", checkVisibility);
	checkVisibility();
});

document.addEventListener("DOMContentLoaded", function () {
	const galleryContainer = document.getElementById("hp-book-gallery");

	if (!galleryContainer) return;

	const galleryList = galleryContainer.querySelector(".hp-book-gallery-list");
	const previewLinks = Array.from(galleryList.querySelectorAll("a"));

	const mainImageLink = galleryContainer.querySelector(
		".hp-book-gallery__thumbnail a"
	);
	const mainImage = galleryContainer.querySelector("#active-main-image");

	const prevBtn = galleryContainer.querySelector(".hp-book-gallery__prev");
	const nextBtn = galleryContainer.querySelector(".hp-book-gallery__next");

	if (!previewLinks.length || !mainImage || !mainImageLink) return;

	let currentIndex = 0;

	function updateMainImage(index) {
		if (index < 0 || index >= previewLinks.length) return;

		const link = previewLinks[index];
		const img = link.querySelector("img");
		const fullSrc = link.getAttribute("href");
		const alt = img?.getAttribute("alt") || "";
		const previewSrc = fullSrc.replace(/-\d+x\d+(?=\.\w+$)/, ""); // нормализуем путь к картинке

		// Обновляем главное изображение
		mainImage.src = previewSrc;
		mainImage.alt = alt;

		// Обновляем ссылку Fancybox
		mainImageLink.href = fullSrc;
		mainImageLink.dataset.caption = alt;

		currentIndex = index;
	}

	// Навешиваем клики на превью
	previewLinks.forEach((link, index) => {
		link.addEventListener("click", function (e) {
			e.preventDefault();
			updateMainImage(index);
		});
	});

	// Навешиваем кнопки навигации
	prevBtn.addEventListener("click", () => {
		const newIndex =
			(currentIndex - 1 + previewLinks.length) % previewLinks.length;
		updateMainImage(newIndex);
	});

	nextBtn.addEventListener("click", () => {
		const newIndex = (currentIndex + 1) % previewLinks.length;
		updateMainImage(newIndex);
	});

	// Инициализация
	updateMainImage(0);
});

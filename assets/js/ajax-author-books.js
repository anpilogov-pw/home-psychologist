document.addEventListener("DOMContentLoaded", () => {
	const button = document.getElementById("hp-books-author-upload");
	if (!button) return;

	let currentPage = 2;
	const authorId = button.dataset.authorId;

	button.addEventListener("click", () => {
		button.disabled = true;
		button.innerText = "Загрузка...";

		fetch(`${hp_ajax.url}?action=load_author_books`, {
			method: "POST",
			headers: { "Content-Type": "application/x-www-form-urlencoded" },
			body: new URLSearchParams({
				author_id: authorId,
				paged: currentPage,
				nonce: hp_ajax.nonce,
			}),
		})
			.then((res) => res.json())
			.then((data) => {
				if (data?.success && data?.data?.html) {
					const container = document.querySelector(".hp-books-list");
					container.insertAdjacentHTML("beforeend", data?.data?.html);
					currentPage++;

					if (currentPage > data?.data?.max_num_pages) {
						button.style.display = "none";
					}
				} else {
					button.style.display = "none";
				}
				button.disabled = false;
				button.innerText = "Загрузить ещё";
			})
			.catch((err) => {
				console.error("Ошибка загрузки книг:", err);
				button.innerText = "Ошибка";
			});
	});
});

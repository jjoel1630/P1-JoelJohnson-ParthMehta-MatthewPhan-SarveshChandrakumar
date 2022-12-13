const cards = document.querySelectorAll(".movie-card");

let maxHeight = 0;

cards.forEach((elem) => {
	maxHeight = Math.max(elem.offsetHeight, maxHeight);
});

cards.forEach((elem) => {
	elem.style.height = `${maxHeight}px`;
	const id = elem.querySelector("h3").textContent;
	elem.addEventListener("click", (e) => {
		window.location = "/singlemovie.php?movie_id=" + id;
	});
});

// document.querySelector("nav").style.marginBottom = "0.3em";
document.querySelector(".movie-list-container").style.margin = "0.3em";

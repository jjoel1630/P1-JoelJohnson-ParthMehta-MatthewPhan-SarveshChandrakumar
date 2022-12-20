// Created by Parth Mehta
const cards = document.querySelectorAll(".movie-card");

function truncate(str, n) {
	return str.length > n ? str.slice(0, n - 1) + "..." : str;
}

let maxHeight = 0;

cards.forEach((elem) => {
	const desc = elem.querySelectorAll("p")[1];
	const genre = elem.querySelectorAll("p")[0];
	const relDate = elem.querySelectorAll("p")[2];
	const budget = elem.querySelectorAll("p")[3];
	desc.innerHTML = "<strong>Description: </strong>" + truncate(desc.textContent, 150);

	const title = elem.querySelector("h2");
	title.textContent = truncate(title.textContent, 15);

	desc.innerHTML = desc.textContent.includes("null")
		? "<strong>Description:</strong> No info available."
		: desc.innerHTML;
	genre.innerHTML = genre.textContent.includes("null")
		? "<strong>Genre:</strong> No info available."
		: genre.innerHTML;
	relDate.innerHTML = relDate.textContent.includes("null")
		? "<strong>Release date:</strong> No info available."
		: relDate.innerHTML;
	budget.innerHTML = budget.textContent.includes("null")
		? "<strong>Budget:</strong> No info available."
		: budget.innerHTML;

	// console.log(elem);
	// console.log(elem.offsetHeight);
});

cards.forEach((elem) => {
	maxHeight = Math.max(elem.offsetHeight, maxHeight);
});

cards.forEach((elem) => {
	elem.style.height = `${maxHeight}px`;
	const id = elem.querySelector("h3").textContent;
	elem.addEventListener("click", (e) => {
		window.location = "/singlemovie.php?movie_id=" + id;
	});

	// console.log(desc.textContent + "\n" + truncate(desc.textContent, desc.textContent.length));
});

// document.querySelector("nav").style.marginBottom = "0.3em";
document.querySelector(".movie-list-container").style.margin = "0.3em";

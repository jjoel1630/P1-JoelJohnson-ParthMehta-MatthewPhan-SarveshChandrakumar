// console.log(parseInt(window.location.search.split("=")[1]));
const moviesList = document.querySelectorAll("nav > ul > li")[0];
const reviewsList = document.querySelectorAll("nav > ul > li")[1];
const search = document.querySelectorAll("nav > ul > li")[2];

moviesList.addEventListener("click", (e) => {
	window.location = "/movies-list.php";
});

reviewsList.addEventListener("click", (e) => {
	window.location = "/";
});

search.addEventListener("click", (e) => {
	window.location = "/search.php";
});

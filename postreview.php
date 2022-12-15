<head>
	<link rel="stylesheet" href="css/reviews.css" type="text/css">
</head>

<?php
	// if(count($_POST) == 0 && count(explode("?", $_SERVER['REQUEST_URI'])) == 1) {
	// 	header("Location: http://localhost:8080/movies-list.php");
	// 	exit();
	// } else if(count($_POST) == 0) {
	// 	header("Location: http://localhost:8080/singlemovie.php?" . explode("?", $_SERVER['REQUEST_URI'])[1]);
	// 	exit();
	// }

	echo "<h1>Successfully created review. Below are the details of your review: </h1>";
	echo "<div class='single-review-card'>";
	echo "<h2>Rating: " . intval($_POST["rating"]) . "</h2>";
	echo "<h4>Comments: " . $_POST["comments"] . "</h4>";
	echo "<h5>Made by: " . $_POST["name"] . "</h5>";
	echo "</div>";
	
	$movie_id = explode(" ", $_POST["movie_id"])[2];
	// echo "id " . intval($movie_id);

	require 'vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();
	include 'dbutil.php';

	// insertRating(intval($movie_id), intval($_POST["rating"]), $_POST["comments"], $_POST["name"]);
?>

<!-- <button>redirect</button> -->
<div id="timer"></div>

<script>
	// document.querySelector("button").addEventListener("click", (e) => {
	// 	window.location=`/singlemovie.php?movie_id=${parseInt(window.location.search.split("=")[1])}`;
	// });

	var countDownDate = new Date().getTime() + 12000;

	var timer = setInterval(function() {
		var now = new Date().getTime();
		var distance = countDownDate - now;
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		document.querySelector("#timer").innerHTML = `Redirecting to the previous page in ${seconds} seconds`;

		if (distance < 0) {
			clearInterval(timer);
			document.querySelector("#timer").innerHTML = "Redirecting...";
			window.location=`/singlemovie.php?movie_id=${parseInt(window.location.search.split("=")[1])}`;
		}
	}, 1000);

</script>
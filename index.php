<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="stylesheet" href="css/navbar.css" type="text/css">
	<link rel="stylesheet" href="css/homebanner.css" type="text/css">
	<link rel="stylesheet" href="css/aboutus.css" type="text/css">
	<link rel="stylesheet" href="css/howto.css" type="text/css">
	<link rel="stylesheet" href="css/footer.css" type="text/css">

	<script src="js/navbar.js" defer></script>
	<!-- <script defer>
		const navLi = document.querySelectorAll("nav>ul>li");

		navLi.foreach((val, idx) => {
			if(idx == 0) {
				val.addEventListener("onclick", (e) => {
					window.location = "/movies-list.php";
				})
			} else if (idx == 1) {
				val.addEventListener("onclick", (e) => {
					window.location = "/reviews.php";
				})
			}
		})
	</script> -->
</head>
<body>
	<!-- NAVBAR -->
		<!-- LIST OF MOVIES, HOME, SEARCH (later) -->
	<nav>
		<div>
			<h3>[TITLE OF WEBSITE]</h3>
		</div>
		<ul>
			<li>Movies</li>
			<li>Reviews</li>
			<li>Search</li>
		</ul>
	</nav>
	<!-- HOME BANNER (TITLE, ETC) -->
	<div id="home-banner">
		<div class="banner-content">
			<h1>WELCOME TO [TITLE OF WEBSITE]</h1>
			<h4>Here you can find information about your favorite movies, and provide ratings for each one!</h4>
		</div>
	</div>
	<!-- INFO ABOUT US -->
	<div id="about-us">
		<div class="about-content-1">
			<h4>Content 1</h4>
			<p>content goes here........</p>
		</div>
		<div class="about-content-2">
			<h4>Content 2</h4>
			<p>content goes here........</p>
		</div>
	</div>
	<!-- WHAT THE WEBSITE IS FOR -->
	<div id="how-to">
		<div class="how-content-1">
			<h4>Content 1</h4>
			<p>content goes here........</p>
		</div>
		<div class="how-content-2">
			<h4>Content 2</h4>
			<p>content goes here........</p>
		</div>
	</div>
	<!-- FOOTER -->
	<footer>
		<h4>This project was made by ... for Mr. Millard's AP CSP class</h4>
	</footer>
</body>
</html>
<?php
	require 'vendor/autoload.php';

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	include 'apiutil.php';
	include 'dbutil.php';

	// getData();
?>
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
</head>
<body>
	<!-- NAVBAR -->
		<!-- LIST OF MOVIES, HOME, SEARCH (later) -->
		<nav>
			<div>
				<h3>[TITLE OF WEBSITE]</h3>
			</div>
			<ul>
				<li>List</li>
				<li>Movies</li>
				<li>Reviews</li>
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
		<div class="content-1">
			<h4>Content 1</h4>
			<p>content goes here........</p>
		</div>
		<div class="content-2">
			<h4>Content 2</h4>
			<p>content goes here........</p>
		</div>
	</div>
	<!-- WHAT THE WEBSITE IS FOR -->
	<!-- HOW TO USE -->
	<!-- FOOTER -->
</body>
</html>
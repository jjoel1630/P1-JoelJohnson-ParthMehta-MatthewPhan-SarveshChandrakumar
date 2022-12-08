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
</head>
<body>
	<!-- NAVBAR -->
		<!-- LIST OF MOVIES, HOME, SEARCH (later) -->
		<nav>
			<div>
				<h3>TITLE OF WEBSITE</h3>
			</div>
			<ul>
				<li>List</li>
				<li>Movies</li>
				<li>Reviews</li>
			</ul>
		</nav>
	<!-- HOME BANNER (TITLE, ETC) -->
	<!-- INFO ABOUT US -->
	<!-- WHAT THE WEBSITE IS FOR -->
	<!-- HOW TO USE -->
	<!-- FOOTER -->
</body>
</html>
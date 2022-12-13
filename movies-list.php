<?php
	require 'vendor/autoload.php';

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	include 'apiutil.php';
	include 'dbutil.php';

	$m_array = getData();
	// transferToDB();

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
	<link rel="stylesheet" href="css/movieslist.css" type="text/css">

	<script src="js/navbar.js" defer></script>
	<script src="js/movies-list.js" defer></script>
</head>
<body>
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
	<div class="movie-list-container">
		<?php 
			$i = 0;
			while($i < count($m_array)) {
				echo "<div class='movie-card'>";
				echo "<h2>{$m_array[$i]->title}</h2>";
				echo "<h3 style=\"display: none\">{$m_array[$i]->id}</h3>";
				echo "<div><p><strong>Genre:</strong> {$m_array[$i]->genre}</p>";
				echo "<p>{$m_array[$i]->description}</p>";
				echo "<p><strong>Release date:</strong> {$m_array[$i]->rel_date}</p>";
				echo "<p><strong>Budget:</strong> {$m_array[$i]->budget}</p></div></div>";
				// echo "<br/>";

				$i++;
			}
		?>
	</div>
</body>
</html>
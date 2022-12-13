<?php
	require 'vendor/autoload.php';

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	include 'apiutil.php';
	include 'dbutil.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<style>
		.card-container {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
		}

		.card {
			width: 300px;
			margin: 10px;
			padding: 10px;
			box-sizing: border-box;
			background-color: #F7F7F7;
			border: 1px solid #DDD;
			border-radius: 5px;
		}
	</style>

</head>
<body>
	<h1>Search for movie</h1>
	<form action="search.php" method="GET">
		<select name="columns">
			<option value="title">Title</option>
			<option value="movie_id">Movie Id</option>
			<option value="description">Description</option>
			<option value="genre">Genre</option>
			<option value="rel_date">Release Date</option>
			<option value="budget">Budget</option>
		</select>
		<input type="text" name="query" placeholder="Query">
		<input type="submit" value="Search" disabled>
	</form>

	<script>
		const search = document.querySelector("input[value='Search']");
		const query = document.querySelector("input[name='query']");
		const select = document.querySelector("select");
		const firstInput = document.querySelectorAll("option")[0];

		const listenForChange = (e) => {
			if(isNaN(query.value) || query.value == "") search.disabled = true;
			else search.disabled = false;
		}

		const queryEverything = (e) => {
			if(query.value == "") search.disabled = true;
			else search.disabled = false;
		}

		query.addEventListener("input", queryEverything);

		select.addEventListener("change", (e) => {
			if(select.value == "movie_id") {
				search.disabled = true;
				query.addEventListener("input", listenForChange);
				query.removeEventListener("input", queryEverything)
			} else {
				search.disabled = true;
				query.removeEventListener("input", listenForChange);
				query.addEventListener("input", queryEverything)
			}
		})
	</script>


	<?php 
		if(count($_GET) > 0) {			
			// if(intval($_GET["movie_id"]) == 0) {
				// 	echo "<div>";
				// 	echo ""
				// 	echo "</div>";
				// }
				
			$movie_data_array = searchData($_GET["columns"], $_GET["query"]);
			$i = 0;

			if($movie_data_array != 0) {
				echo "<h1>Results for movies with the " . $_GET["columns"] . " of \"" . $_GET["query"] . "\"</h1>";
				echo "<div class='card-container'>";
				while($i < count($movie_data_array)) {
					echo "<div class='card'>";
					echo "<img src='movie-poster.jpg' alt='Movie poster'>";
					echo "<h2>Title: " . $movie_data_array[$i]->title . "</h2>";
					echo "<h3>Genre: " . $movie_data_array[$i]->genre . "</h3>";
					echo "<h3>Release Date: " . $movie_data_array[$i]->rel_date . "</h3>";
					echo "<h3>Budget: " . $movie_data_array[$i]->budget . "</h3>";
					echo "<p>Description: " . $movie_data_array[$i]->description . "</p>";
					echo "</div>";
					
					$i++;
				}
				echo "</div>";
			} else {
				echo "<h2>No movies with the ". $_GET["columns"] . " of " . $_GET["query"] . "</h2>";
			}
		}
	?>
</body>
</html>
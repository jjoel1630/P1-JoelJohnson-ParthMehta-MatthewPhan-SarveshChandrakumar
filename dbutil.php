<?php
	include 'dbconnection.php';

	function transferToDB() {
		$connec = connectMoviesDB();

		$sql_query = "SELECT * FROM movies";
		$res = $connec->query($sql_query);

		if ($res->num_rows != 0) return;

		$z = 1;
		$PAGE_COUNT = 7;
		while($z < $PAGE_COUNT) {
			$f = getReq("https://api.themoviedb.org/3/discover/movie?api_key=" . $_ENV["THE_MOVIEDB_KEY"] . "&sort_by=popularity.desc&page=" . $z);
			$f = json_decode($f);
	
			$i = 0;
			while($i < count($f->results)) {
				$api_request = getReq("https://api.themoviedb.org/3/movie/" . $f->results[$i]->id . "?api_key=" . $_ENV["THE_MOVIEDB_KEY"]);
				$api_request = json_decode($api_request);
	
				$budget = $api_request->budget;
				$budget = mysqli_real_escape_string($connec, $budget);
				$budget = str_replace('“', '\“', $budget);
				$budget = str_replace('”', '\”', $budget);
				$budget = $budget ? $budget : 'null';
	
				$genre = @$api_request?->genres[0]?->name;
				$genre = mysqli_real_escape_string($connec, $genre);
				$genre = str_replace('“', '\“', $genre);
				$genre = str_replace('”', '\”', $genre);
				$genre = $genre ? $genre : 'null';
	
				$desc = $api_request->overview;
				$desc = mysqli_real_escape_string($connec, $desc);
				$desc = str_replace('“', '\“', $desc);
				$desc = str_replace('”', '\”', $desc);
				$desc = $desc ? $desc : 'null';
	
				$release_date = $api_request->release_date;
				$release_date = mysqli_real_escape_string($connec, $release_date);
				$release_date = str_replace('“', '\“', $release_date);
				$release_date = str_replace('”', '\”', $release_date);
				$release_date = $release_date ? $release_date : 'null';
	
				$title = $api_request->title;
				$title = mysqli_real_escape_string($connec, $title);
				$title = str_replace('“', '\“', $title);
				$title = str_replace('”', '\”', $title);
				$title = $title ? $title : 'null';				
	
				$single_query = "INSERT INTO movies (title, genre, description, release_date, budget) VALUES ('{$title}', '{$genre}', '{$desc}', '{$release_date}', '{$budget}')";
				// $re = $connec->query($single_query);
	
				if ($connec->query($single_query) === TRUE) {
					echo "New record created successfully<br>";
				} else {
					echo "Error: " . $single_query . "<br>" . $connec->error;
				}
	
				$i++;
			}

			$z++;
		}
		$connec->close();
	}

	function getData() {
		$connec = connectMoviesDB();

		$sql_query = "SELECT * FROM movies";
		$res = $connec->query($sql_query);

		$movies_array[] = (object) array();

		if ($res->num_rows > 0) {
			$i = 0;
			while($row = $res->fetch_assoc()) {
				// echo "id: " . $row["movie_id"]. " - title: " . $row["title"] . " - genre: " . $row["genre"]. "<br />";
				$movie_object = new stdClass();
			
				$movie_object->id = $row["movie_id"];
				$movie_object->title = $row["title"];
				$movie_object->genre = $row["genre"];
				$movie_object->description = $row["description"];
				$movie_object->rel_date = $row["release_date"];
				$movie_object->budget = $row["budget"];

				$movies_array[$i] = $movie_object;

				$i++;
			}
			return $movies_array;
		} else return 0;

		$connec->close();
	}

	function formatMoviesTable() {
		$movies_array[] = (object) array();		
		// $res = getData();
		
		$i = 0;
		while($i < count($res)) {
			// $movie_object = new stdClass();
			
			// $movie_object->id = $row["movie_id"];
			// $movie_object->title = $row["title"];
			// $movie_object->genre = $row["genre"];
			// $movie_object->description = $row["description"];
			// $movie_object->rel_date = $row["release_date"];
			// $movie_object->budget = $row["budget"];

			echo $row["movie_id"];

			// $movies_array[$i] = $movie_object;

			$i++;
		}

		return $movies_array;
	}
	?>
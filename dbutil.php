<?php
	require 'vendor/autoload.php';

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	include 'dbconnection.php';

	function createDB() {
		$connec = connectCreateMoviesDB();

		$query = "CREATE DATABASE csp_project_database";

		if ($connec->query($query) === TRUE) {
			echo "1/4 Database created successfully<br>";
		} else {
			echo "1/4 Error creating database: " . $connec->error;
		}

		// $query_user = "CREATE USER \"{$_ENV['SQL_USER_NAME']}\"@'localhost' IDENTIFIED BY \"{$_ENV['SQL_USER_PASSWORD']}\"";
		// if ($connec->query($query_user) === TRUE) {
		// 	echo "2/7 Database user created successfully";
		// } else {
		// 	echo "2/7 Error creating user: " . $connec->error;
		// }

		// $query_user_perms = "GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, RELOAD, SHUTDOWN, PROCESS, FILE, REFERENCES, INDEX, ALTER, SHOW DATABASES, SUPER, CREATE TEMPORARY TABLES, LOCK TABLES, EXECUTE, REPLICATION SLAVE, REPLICATION CLIENT, CREATE VIEW, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, CREATE USER, EVENT, TRIGGER, CREATE TABLESPACE, CREATE ROLE, DROP ROLE ON *.* TO \"{$_ENV['SQL_USER_NAME']}\"@'localhost'";
		// if ($connec->query($query_user_perms) === TRUE) {
		// 	echo "3/7 Database user created successfully";
		// } else {
		// 	echo "3/7 Error granting user perms: " . $connec->error;
		// }

		// $query_flush_perms = "FLUSH PRIVILEGES";
		// if ($connec->query($query_flush_perms) === TRUE) {
		// 	echo "4/7 Database user created successfully";
		// } else {
		// 	echo "4/7 Error flushing perms: " . $connec->error;
		// }

		$connec->close();
	}

	function createTables() {
		$connec = connectMoviesDB();

		$query_movies = "CREATE TABLE movies (movie_id INT NOT NULL AUTO_INCREMENT, title VARCHAR(100), genre VARCHAR(20), description VARCHAR(1000),release_date VARCHAR(20),budget VARCHAR(500),image VARCHAR(200),PRIMARY KEY (movie_id))";
			
		if ($connec->query($query_movies) === TRUE) {
			echo "2/4 Table movies created successfully<br>";
		} else {
			echo "2/4 Error creating table: " . $connec->error;
		}

		$query_ratings = "CREATE TABLE ratings (rating_id INT NOT NULL AUTO_INCREMENT,movie_id INT NOT NULL,rating INT,genre VARCHAR(30),description VARCHAR(200),rater_name VARCHAR(20),PRIMARY KEY (rating_id),FOREIGN KEY (rating_id) REFERENCES movies(movie_id))";
			
		if ($connec->query($query_ratings) === TRUE) {
			echo "3/4 Table movies created successfully<br>";
		} else {
			echo "3/4 Error creating table: " . $connec->error;
		}
		
		$connec->close();
	}

	function transferToDB() {
		$connec = connectMoviesDB();

		$sql_query = "SELECT * FROM movies";
		$res = $connec->query($sql_query);

		$success = true;

		if ($res->num_rows != 0) return;

		$z = 1;
		$PAGE_COUNT = 7;
		while($z < $PAGE_COUNT) {
			$f = getReq("https://api.themoviedb.org/3/discover/movie?api_key=" . $_ENV["THE_MOVIEDB_KEY"] . "&sort_by=popularity.desc&page=" . $z);
			$f = json_decode($f);
			https://image.tmdb.org/t/p/w500/bQXAqRx2Fgc46uCVWgoPz5L5Dtr.jpg
	
			$i = 0;
			while($i < count($f->results)) {
				$api_request = getReq("https://api.themoviedb.org/3/movie/" . $f->results[$i]->id . "?api_key=" . $_ENV["THE_MOVIEDB_KEY"]);
				$api_request = json_decode($api_request);

				$image = $api_request->poster_path;
				// https://image.tmdb.org/t/p/w500/pFlaoHTZeyNkG83vxsAJiGzfSsa.jpg
				$image = $image ? $image : ($api_request->backdrop_path ? $api_request->backdrop_path : 'null');
				if($image != 'null') {
					$image = 'https://image.tmdb.org/t/p/w500' . $image;
				}
	
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
				
				// echo $image;
	
				$single_query = "INSERT INTO movies (title, genre, description, release_date, budget, image) VALUES ('{$title}', '{$genre}', '{$desc}', '{$release_date}', '{$budget}', '{$image}')";
				// $re = $connec->query($single_query);
	
				if ($connec->query($single_query) === TRUE) {
					// echo "New record created successfully<br>";
				} else {
					// echo "Error: " . $single_query . "<br>" . $connec->error;
					$success = false;
				}
	
				$i++;
			}

			$z++;
		}

		if($success) {
			echo "4/4 Movie data entered successfully<br>";
		} else {
			echo "4/4 Error entering movie data";
		}

		$connec->close();
	}

	function selectDataWhere($column, $value) {
		$connec = connectMoviesDB();

		$sql_query = "SELECT * FROM movies WHERE " . $column . "=" . $value;
		$res = $connec->query($sql_query);

		$movies_array[] = (object) array();

		if ($res->num_rows > 0) {
			$i = 0;
			while($row = $res->fetch_assoc()) {
				// echo "id: " . $row["movie_id"]. " - title: " . $row["title"] . " - genre: " . $row["genre"]. "<br />";
				$movie_object = new stdClass();
			
				$movie_object->id = $row["movie_id"];
				$movie_object->title = $row["title"];
				$movie_object->genre = $row["genre"] == 'null' ? "This data is not available for this movie." : $row["genre"];
				$movie_object->description = $row["description"] == 'null' ? "This data is not available for this movie." : $row["description"];
				$movie_object->rel_date = $row["release_date"] == 'null' ? "This data is not available for this movie." : $row["release_date"];
				$movie_object->budget =$row["budget"] == 'null' ? "This data is not available for this movie." : $row["budget"];

				$movies_array[$i] = $movie_object;

				$i++;
			}
			return $movies_array;
		} else return 0;

		$connec->close();
	}

	function searchData($column, $value) {
		$connec = connectMoviesDB();
		
		$sql_query = "SELECT * FROM movies WHERE " . $column . "=" . $value;

		if($column == "description" || $column == "title" || $column == "genre") {
			$v = mysqli_real_escape_string($connec, $value);
			$sql_query = "SELECT * FROM movies WHERE " . $column . " like '%" . $v . "%'";
			// echo $sql_query;
		}
		$res = $connec->query($sql_query);

		$movies_array[] = (object) array();

		if ($res->num_rows > 0) {
			$i = 0;
			while($row = $res->fetch_assoc()) {
				// echo "id: " . $row["movie_id"]. " - title: " . $row["title"] . " - genre: " . $row["genre"]. "<br />";
				$movie_object = new stdClass();
			
				$movie_object->id = $row["movie_id"];
				$movie_object->title = $row["title"];
				$movie_object->genre = $row["genre"] == 'null' ? "This data is not available for this movie." : $row["genre"];
				$movie_object->description = $row["description"] == 'null' ? "This data is not available for this movie." : $row["description"];
				$movie_object->rel_date = $row["release_date"] == 'null' ? "This data is not available for this movie." : $row["release_date"];
				$movie_object->budget =$row["budget"] == 'null' ? "This data is not available for this movie." : $row["budget"];

				$movies_array[$i] = $movie_object;

				$i++;
			}
			return $movies_array;
		} else return 0;

		$connec->close();
	}

	function selectDataWhereRatings($column, $value) {
		$connec = connectMoviesDB();

		$sql_query = "SELECT * FROM ratings WHERE " . $column . "=" . $value;
		$res = $connec->query($sql_query);

		$ratings_array[] = (object) array();

		if ($res->num_rows > 0) {
			$i = 0;
			while($row = $res->fetch_assoc()) {
				// echo "id: " . $row["movie_id"]. " - title: " . $row["title"] . " - genre: " . $row["genre"]. "<br />";
				$ratings_object = new stdClass();
			
				$ratings_object->id = $row["rating_id"];
				$ratings_object->movie_id = $row["movie_id"];
				$ratings_object->rating = $row["rating"];
				$ratings_object->description = $row["description"] == 'null' ? "This data is not available for this movie." : $row["description"];
				$ratings_object->rater_name = $row["rater_name"] == 'null' ? "This data is not available for this movie." : $row["rater_name"];

				$ratings_array[$i] = $ratings_object;

				$i++;
			}
			return $ratings_array;
		} else return 0;

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

	function insertRating($movie_id, $rating, $description, $rater_name) {
		$connec = connectMoviesDB();

		$description = mysqli_real_escape_string($connec, $description);
		$description = str_replace('"', '\"', $description);
		// $description = str_replace('”', '\”', $description);
		
		$rater_name = mysqli_real_escape_string($connec, $rater_name);
		$rater_name = str_replace('"', '\"', $rater_name);
		// $rater_name = str_replace('”', '\”', $rater_name);
		// echo $description;
		// echo $rater_name;

		$sq = "INSERT INTO ratings (movie_id, rating, description, rater_name) VALUES ({$movie_id},{$rating},'{$description}','{$rater_name}')";
		// $res = $connec->query($sq);

		if ($connec->query($sq) === TRUE) {
			// echo "New record created successfully";
		} else {
			echo "Error: " . $sq . "<br>" . $connec->error;
		}

		$connec->close();
	}
?>
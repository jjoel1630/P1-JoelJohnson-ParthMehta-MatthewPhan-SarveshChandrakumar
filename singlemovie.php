<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<script src="js/displaymovie.js" defer></script>
	<script src="js/navbar.js" defer></script>
	<!-- <script defer>
		if(parseInt(window.location.search.split("=")[1]) == NaN) {
			var countDownDate = new Date().getTime() + 5000;

			var timer = setInterval(function() {
				var now = new Date().getTime();
				var distance = countDownDate - now;
				var seconds = Math.floor((distance % (1000 * 60)) / 1000);

				document.querySelector("#timer").innerHTML = `Redirecting in ${seconds} seconds`;

				if (distance < 0) {
					clearInterval(timer);
					document.querySelector("#timer").innerHTML = "Redirecting...";
					window.location="/movies-list.php";
				}
			}, 1000);
		}
	</script> -->
	
	<link rel="stylesheet" href="css/navbar.css" type="text/css">
</head>
<body>
	<div id="timer"></div>

	<nav>
		<div>
			<h3>[TITLE OF WEBSITE]</h3>
		</div>
		<ul>
			<li>List</li>
			<li>Movies</li>
			<li>Search</li>
		</ul>
	</nav>
	<?php 
		require 'vendor/autoload.php';
		include 'dbutil.php';

		$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
		$dotenv->load();
		// if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') $url = "https://";   
		// else $url = "http://";   
		// // Append the host(domain name, ip) to the URL.   
		// $url.= $_SERVER['HTTP_HOST'];   
		
		$url = $_SERVER['REQUEST_URI'];
		$data_array;
		$url_movie_id;
		$url_array;

		if(count(explode("?", $url)) == 1) {
			// echo "No movie id specified";
			header("Location: http://localhost:8080/movies-list.php");
			exit();
		} else {
			$url_array = explode("?", $url)[1];
			$url_movie_id = explode("=", $url_array)[1];
	
			$data_array = selectDataWhere("movie_id", $url_movie_id); 
		}

		$review_data_array = selectDataWhereRatings("movie_id", $url_movie_id);
  	?>

	<div id="single-movie-main-content">
		<div>
			<h1>Title: <?php echo $data_array[0]->title; ?></h1>
			<h2>Genre: <?php echo $data_array[0]->genre; ?></h2>
			<h2>Release Date: <?php echo $data_array[0]->rel_date; ?></h2>
			<h3>Budget: <?php echo $data_array[0]->budget; ?></h3>
			<p>Description: <?php echo $data_array[0]->description; ?></p>
			<!-- <p><?php echo count($_POST); ?></p> -->
		</div>

		<?php echo "<form action='postreview.php?movie_id=" . $url_movie_id . "' method='POST'>"; ?>
			<?php echo "<input type='text' name='movie_id' value='Movie id: {$url_movie_id}' readonly>"; ?>
			<input type="text" placeholder="Your name" name="name">
			<input type="text" placeholder="Comments" name="comments">
			<input type="text" placeholder="Rating" name="rating">
			<input type="submit" value="Submit">
		</form>

		<div class="reviews-list">
			<?php 
				if($review_data_array != 0) {
					$f = 0;
					while($f < count($review_data_array)) {
						echo "<div class='singe-review-card'>";
						echo "<h2>" . $review_data_array[$f]->rating . "</h2>";
						echo "<h3>" . $review_data_array[$f]->description . "</h3>";
						echo "<h4>" . $review_data_array[$f]->rater_name . "</h4>";
						echo "</div>";
	
						$f++;
					}
				}
			?>
		</div>
	</div>
</body>
</html>
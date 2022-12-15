<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<script src="js/displaymovie.js" defer></script>
	<script src="js/navbar.js" defer></script>

	<link rel="stylesheet" href="css/navbar.css" type="text/css">
	<link rel="stylesheet" href="css/movieslist.css" type="text/css">
	<link rel="stylesheet" href="css/reviews.css" type="text/css">
	
	<style>
		.form-container {
			width: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.form-container > div {
			width: 60%;
		}

		.form-container > div > h2 {
			text-align: center;
			margin-bottom: 1em;
		}

		.form-container > div > div {
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.form-container > div > div > form {
			width: 40%;
		}

		.form-container > div > div > form > * {
			display: block;
			padding: 0.5em;
			margin: 0.9em;
			width: 100%;
		}

		.form-container > div > div > form > textarea {
			resize: none;
		}
	</style>
</head>
<body>
	<div id="timer"></div>

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

	<div class="movie-list-container" style="margin: 2em;">
		<div class="movie-card">
			<h2>Title: <?php echo $data_array[0]->title; ?></h2>
			<h3>Genre: <?php echo $data_array[0]->genre; ?></h3>
			<div>
				<h2>Release Date: <?php echo $data_array[0]->rel_date; ?></h2>
				<h3>Budget: <?php echo $data_array[0]->budget; ?></h3>
				<p>Description: <?php echo $data_array[0]->description; ?></p>
				<!-- <p><?php echo count($_POST); ?></p> -->

			</div>
		</div>
	</div>

	<div class="form-container">
		<div>
			<h2>Submit a review here:</h2>
			<div>
				<?php echo "<form action='postreview.php?movie_id=" . $url_movie_id . "' method='POST'>"; ?>
					<?php echo "<input type='text' name='movie_id' value='Movie id: {$url_movie_id}' readonly>"; ?>
					<input type="text" placeholder="Your name" name="name">
					<input type="text" placeholder="Rating" name="rating">
					<!-- <input type="text" placeholder="Comments" name="comments"> -->
					<textarea id="comments" placeholder="Comments" name="comments" rows="4" cols="50"></textarea>
					<p style="display: none"></p>
					<input type="submit" value="Submit" disabled>
				</form>
			</div>
		</div>
	</div>

	<div style="margin-top: 4em">
		<h2 style="text-align: center">Reviews for "<?php echo $data_array[0]->title; ?>"</h2>
		<div class="reviews-list">
			<div>
				<?php 
					if($review_data_array != 0) {
						$f = 0;
						while($f < count($review_data_array)) {
							echo "<div class='single-review-card'>";
							echo "<h2>Rating: " . $review_data_array[$f]->rating . "</h2>";
							echo "<h4>Comments: " . $review_data_array[$f]->description . "</h4>";
							echo "<h5>Made by: " . $review_data_array[$f]->rater_name . "</h5>";
							echo "</div>";
	
							$f++;
						}
					}
				?>
			</div>
		</div>
	</div>

	<script>
		const submitForm = document.querySelector("input[value='Submit']");
		const raterName = document.querySelector("input[name='name']");
		const rating = document.querySelector("input[name='rating']");
		const commentsTextArea = document.querySelectorAll("textArea")[0];

		let commentTrue = false;
		let raterTrue = false;
		let ratingTrue = false;

		commentsTextArea.addEventListener("change", (e) => {
			commentTrue = commentsTextArea.value.length <= 200;
			submitForm.disabled = !(ratingTrue && raterTrue && commentTrue);

			console.log(raterTrue, commentTrue, ratingTrue);
		});

		raterName.addEventListener("input", (e) => {
			raterTrue = raterName.value.length <= 30;
			submitForm.disabled = !(ratingTrue && raterTrue && commentTrue);

			console.log(raterTrue, commentTrue, ratingTrue);
		});

		rating.addEventListener("input", (e) => {
			ratingTrue = !isNaN(rating.value) && (parseInt(rating.value) >= 1 && parseInt(rating.value) <= 5);
			submitForm.disabled = !(ratingTrue && raterTrue && commentTrue);

			if(!ratingTrue)

			console.log(raterTrue, commentTrue, ratingTrue);
		});

	</script>
</body>
</html>
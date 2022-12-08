<?php 
	// $request = getReq("https://www.omdbapi.com/?apikey=" . $_ENV["OMBD_API_KEY"] . "&t=Fury");
	// $request = getReq("https://api.themoviedb.org/3/movie/436270?api_key=" . $_ENV["THE_MOVIEDB_KEY"]);
	// $request = json_decode($request);

	// echo getReq("https://www.omdbapi.com/?apikey=db60c827&t=Fury");
	// echo $request->Title;
	// https://image.tmdb.org/t/p/w300/g4yJTzMtOBUTAR2Qnmj8TYIcFVq.jpg

	// GET REQUEST API
	function getReq($url)
	{
		$curl = curl_init($url);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json'
		]);

		$result = curl_exec($curl);

		curl_close($curl);

		return $result;
	}
?>
<?php
	function connectMoviesDB() {
		// var_dump($_ENV);

		// DB CONFIG
		$servername = "localhost";
		$username = "javellecousins";
		$password = $_ENV["JAVELLECOUSINS"];
	
		// Create connection
		$conn = new mysqli($servername, $username, $password, "csp_project_database");
	
		// Check connection
		if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
		// else echo "Success";

		return $conn;
	}
?>
<!-- Created by Joel Johnson -->
<?php
	function connectMoviesDB() {
		// var_dump($_ENV);

		// DB CONFIG
		$servername = "localhost";
		$username = $_ENV["SQL_USER_NAME"];
		$password = $_ENV["SQL_USER_PASSWORD"];
	
		// Create connection
		$conn = new mysqli($servername, $username, $password, "csp_project_database");
	
		// Check connection
		if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
		// else echo "Success";

		return $conn;
	}

	function connectCreateMoviesDB() {
		// var_dump($_ENV);

		// DB CONFIG
		$servername = "localhost";
		$username = $_ENV["SQL_USER_NAME"];
		$password = $_ENV["SQL_USER_PASSWORD"];
	
		// Create connection
		$conn = new mysqli($servername, $username, $password);
	
		// Check connection
		if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
		// else echo "Success";

		return $conn;
	}
?>
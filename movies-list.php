<?php
	require 'vendor/autoload.php';

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	include 'apiutil.php';
	include 'dbutil.php';

	$m_array = getData();

	// getData();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<?php 
		$i = 0;
		while($i < count($m_array)) {
			echo "<div><h2>{$m_array[$i]->title}</h2><h3>{$m_array[$i]->id}</h3><p>{$m_array[$i]->genre}</p><p>{$m_array[$i]->description}</p><p>{$m_array[$i]->rel_date}</p><p>{$m_array[$i]->budget}</p></div>";
			$i++;
			echo "<br/>";
		}
	?>
</head>
<body>
</body>
</html>
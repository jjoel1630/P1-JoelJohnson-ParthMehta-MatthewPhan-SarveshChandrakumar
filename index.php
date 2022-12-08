<?php
	require 'vendor/autoload.php';

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	include 'apiutil.php';
	include 'dbutil.php';

	getData();
?>
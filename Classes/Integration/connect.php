<?php
	$hostname="localhost";
	$database="tasty";
	$username="root";
	$password="";

	$link = mysqli_connect($hostname, $username, $password, $database);
	if (!$link) {
		die('Connection failed: ' . mysqli_error());
	}
?>
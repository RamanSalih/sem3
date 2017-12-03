<?php
	session_start(); //Starts User Session
	include("connect.php");

	$username = $_POST["username"];
	$password = $_POST["password"];

	//Sanitize DATA, SQL injection protection
	
	
	//Assuming you have the corresponding column names...
	$q = mysqli_query($link, "SELECT * FROM users WHERE username='$username' AND password='$password'");
	//if(mysqli_num_rows($q) == 1) { //If the number of rows is equal to 1, let them login
		$_SESSION["username"] = $username;
		$_SESSION["password"] = $password;
		$_SESSION["message"] = "Welcome " . $username . '!';
		$_SESSION["success"] = true;
	} else {
		$_SESSION["message"] = "Wrong credentials";
		$_SESSION["success"] = false;
	}
	header('Location: index.php');
?>
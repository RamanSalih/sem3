<?php
	include("connect.php");

	if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password2"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];
		$password2 = $_POST["password2"];
		
		if ($password != $password2) {
			$_SESSION["message"] = "Passwords doesn't match";
			$_SESSION["success"] = false;
		} else {
			$q = mysqli_query($link, "SELECT * FROM users WHERE username='$username'");
			if(mysqli_num_rows($q) == 0) { // Check if username is free, if 0 continue with registration
				session_start(); // Starts User Session
				$q = mysqli_query($link, "INSERT INTO users (id, username, password) VALUES (NULL, '$username', '$password')");
				$_SESSION["message"] = "Registration successful";
				$_SESSION["success"] = true;
			} else {
				$_SESSION["message"] = "Username already taken";
				$_SESSION["success"] = false;
			}
		}
	} else {
		$_SESSION["message"] = "Please fill all forms";
		$_SESSION["success"] = false;
	}
	header('Location: index.php');
?>
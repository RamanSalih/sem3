<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>Tasty Recipes</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="popup.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	</head>
	<body>
		<?php
			session_start();
			if(!isset($_SESSION["username"])){
				echo '<div class="main">
					<div class="panel">	
						<a href="#login_form" id="login_pop">Log In</a>
						<a href="#join_form" id="join_pop">Sign Up</a>
					</div>
				</div>
				
				<!-- popup login -->
				<a href="#x" class="overlay" id="login_form"></a>
				<div class="popup">
					<h2>Welcome!</h2>
					<p>Please enter your login and password here</p>
					<div>
						<form method="POST" action="login.php">
							<div>
								<input type="text" id="username" name="username" placeholder="Username">
							</div>
							<div>
								<input type="password" id="password" name="password" placeholder="Password">
							</div>
							<div>
								<input type="submit" value="Submit">
							</div>
						</form>
					</div>
					<a class="close" href="#close"></a>
				</div>

				<!-- popup form #2 -->
				<a href="#x" class="overlay" id="join_form"></a>
				<div class="popup">
					<h2>Sign Up</h2>
					<p>Please enter your details here</p>
					<div>
						<form method="POST" action="register.php">
							<div>
								<input type="text" id="username" name="username" placeholder="Username">
							</div>
							<div>
								<input type="password" id="password" name="password" placeholder="Password">
							</div>
							<div>
								<input type="password" id="password2" name="password2" placeholder="Password again">
							</div>
							<div>
								<input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;<a href="#login_form" id="login_pop">Log In</a>
							</div>
						</form>
					</div>
					<a class="close" href="#close"></a>
				</div>';
			} else {
				echo '<div class="main">
					<div class="panel">
						<a href="logout.php" id="login_pop">Log out ' . $_SESSION["username"] . '</a>
					</div>
				</div>';
			}
			if (isset($_SESSION["success"]) && isset($_SESSION["message"])) {
				echo '<div id="toast">';
				if ($_SESSION["success"] == false) {
						echo '<p id="fail">' . $_SESSION["message"] . '</p>';
				}
				if ($_SESSION["success"] == true) {
						echo '<p id="success">' . $_SESSION["message"] . '</p>';
				}
				echo '</div>';
				$_SESSION["message"] = null;
				$_SESSION["success"] = null;
			}
		?>
	</body>
</html>
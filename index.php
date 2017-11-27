<?php

	//if submit button has been pressed, set session username and password variables
	//and redirect to homepage.php
	if (isset($_POST['submit'])){
	 	session_start();
	 	$username = $_POST['username'];
	 	$_SESSION['username'
		] = $username;
	 	$_SESSION['password'] = $_POST['password'];
		header("Location: homepage.php");
	 	die();
	 }
	 
	 //if signup button is pressed, redirect to signup.php
	 if (isset($_POST['signup'])) {
		header("Location: signup.html");
	}
	 
?>

<html>
<head>
	<!--styling-->
	<meta charset="UTF-8">

	<!-- page info -->
	<title>Network Health Monitor</title>
	<meta name="Description" content="Team DROP TABLES Network Health Monitor" />
    <meta name="Keywords" content="MTU, Michigan Tech, TSP, Team Software Project" />
    <link rel="icon" type="image/png" href="favicon.png" />

	<!-- stylesheets -->
	<link type="text/css" rel="stylesheet" href="css/stylesheet.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i" rel="stylesheet">
</head>

<body>
	<h4>Please enter your username and password</h4>
	<form action="index.php" method = "post">
	<div id="login">
		<div class="entry">
			Username: <input type = "text" name = "username" autofocus>
		</div>
		<div class="entry">
			Password:  <input type = "password" name = "password">
		</div>
		<div id="login_buttons">
			<div class="submit_button">
				<input class = "submit" name = "submit" type = "submit" value = "Login">
			</div>
			<div class="submit_button">
				<input class="submit" name="signup" type="submit" value="Sign Up">
			</div>
		</div>
	</div>
	<!-- 
		<table>
			<tr>
				<td>Username:</td><td><input type = "text" name = "username" autofocus></td>
			</tr>
			<tr>
				<td>Password:</td><td><input type = "password" name = "password"></td>
			</tr>
			<tr>
				<td></td><td><input class = "submit" name = "submit" type = "submit" value = "Login"></td>
			</tr>
			<tr>
				<td></td><td><input class="submit" name="signup" type="submit" value="Sign Up"></td>
			</tr>
		</table>
		-->
	</form>
</body>
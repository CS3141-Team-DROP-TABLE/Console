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
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- page info -->
	<title>Network Health Monitor</title>
	<meta name="Description" content="Team DROP TABLES Network Health Monitor" />
    <meta name="Keywords" content="MTU, Michigan Tech, TSP, Team Software Project" />

	<link type="text/css" rel="stylesheet" href="css/stylesheet.css">
	<style>
	
		body {
			
			margin: 5vw 0 0 0;
			
		}
		
		@media screen and (min-width: 810px){
			
			form {
				margin: 0 auto 0 auto;
				width: 25vw;
			}
			
		}
		@media screen and (min-width: 540px) and (max-width: 810px){
			
			form {
				margin: 0 auto 0 auto;
				width: 38vw;
			}
			
		}
		
		@media screen and (max-width: 540px){
			
			form{
				
				margin: 0;
				width: 100%
				
			}
			
		}
	</style>

</head>
<body>
	<div style = "text-align: center;">
		<img src="visuals/logo.png" alt="UpBot" style="width:300px;height:300px">
	</div>
	<form action="index.php" method = "post" style="text-align: center">
		<label for = "usrname">Username</label>
		<input type = "text" id="usrname" name = "username" autofocus>
		<label for = "psword">Password</label>
		<input type = "password" id="psword" name = "password">
		<input class = "submit" name = "submit" type = "submit" value = "Login">
		<input class="submit" name="signup" type="submit" value="Sign Up">
	</form>
</body>
</html>
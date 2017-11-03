<?php
	if (isset($_POST['submit'])){
	 	session_start();
	 	$username = $_POST['username'];
	 	$_SESSION['username'] = $username;
	 	$_SESSION['password'] = $_POST['password'];
		header("Location: homepage.php");
	 	die();
	 }
	 if (isset($_POST['signup'])) {
		header("Location: signup.html");
	}
	 
?>

<html>
<head>Welcome to the Network Health Monitor</head>
<title>Network Health Monitor</title>

<body>
	<h4>Please enter your username and password</h4>
	<form action="index.php" method = "post">
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
	</form>
</body>
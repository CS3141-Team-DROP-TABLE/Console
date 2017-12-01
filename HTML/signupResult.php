<html>
<header>
	<link type="text/css" rel="stylesheet" href="css/stylesheet.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</header>
<body>
	<div style="height: 300px; width: 100%;">
		<img src="visuals/logo.png" alt="UpBot" style="width:300px;height:300px">
	</div>
<?php
	//username and password provided on signup.html
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	
	//check if passwords match
	if ($password != $confirm_password) {
		echo 'passwords do not match';
		
		echo '<form action = "index.php" method = "post">';
		echo 	'<input class="submit" name="back" type="submit" value="Back to Login">';
		echo '</form>';
		
		die();
	}
	
	
	try { 
	
		//connect to database
		$dsn = 'mysql:dbname=NetworkHealthMonitor;host=cs3141.chqohuzhefwm.us-east-1.rds.amazonaws.com';
		$dbuser = 'web';
		$dbpassword = 'Netw0rkH3alth';
		
		$dbh = new PDO($dsn,$dbuser,$dbpassword);

		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
		$userExists = $dbh->prepare("select username from user where username = ?");
		$userExists->execute(array($username));
		$userExists = $userExists->fetch(PDO::FETCH_ASSOC);
		
		//check if that username already exists
		if ($result != NULL) {
			echo "that username is already taken!";
			
			echo '<form action = "index.php" method = "post">';
			echo	'<input class="submit" name="back" type="submit" value="Back to Login">';
			echo '</form>';
			
		//else add user to the database	
		}   else {
			$insertUser = ("insert into user values('$username','$password')");
			$dbh->exec($insertUser);
			 echo "account successfully created!";
		 }
		
			//return to login link
			echo '<form action = "index.php" method = "post">';
			echo 	'<input class="submit" name="backToLogin" type="submit" value="Back to Login">';
			echo '</form>';
			
			

	}
	
	//error handling
	catch (PDOException $e) {
			print "error! $e->getMessage()<br/>";
			echo '<form action = "index.php" method = "post">';
			echo 	'<input class="submit" name="backToLogin" type="submit" value="Back to Login">';
			echo '</form>';
			die();

		}
?>
</body>
</html>
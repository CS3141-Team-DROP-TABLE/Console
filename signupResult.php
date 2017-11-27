
<?php
	//username and password provided on signup.html
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	
	//check if passwords match
	if ($password != $confirm_password) {
		echo 'passwords do not match';
		
		echo '<form action = "signup.html" method = "post">';
		echo 	'<input class="submit" name="back" type="submit" value="Back">';
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
		$result = $dbh->execute(array($username));
		$result = $result->fetch(PDO::FETCH_ASSOC);
		
		//check if that username already exists
		if ($result != NULL) {
			echo "that username is already taken!";
			
			echo '<form action = "signup.html" method = "post">';
			echo	'<input class="submit" name="back" type="submit" value="Back">';
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
			die();

		}
?>

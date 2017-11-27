<?php
session_start();
?>




	<?php

		//database and user credentials
		$dsn = 'mysql:dbname=NetworkHealthMonitor;host=cs3141.chqohuzhefwm.us-east-1.rds.amazonaws.com';
		$dbuser = 'web';
		$dbpassword = 'Netw0rkH3alth';
		
		//username and password from index.php
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
		
		
		try { 
			//connecting to database
			$dbh = new PDO($dsn,$dbuser,$dbpassword);

			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			
			
			//checking to see if the user exists within the database
			$login = $dbh->query("select username,password from user where username = '$username' and password = '$password'");
			$login = $login->fetch(PDO::FETCH_ASSOC);
			$login_result = $login['username'];
			
			if ($login_result != $username || $username == NULL) {
				echo "Login Failed: Invalid Username/Password";
				session_destroy();
				?>
				<form action="index.php" method="post">
					<input class = "submit" name = "back" type = "submit" value = "Back to Login">
				</form>
				<?php
				die();
			}
	?>
	
	<html>
	<head>
		<title>Network Health Monitor</title>
	</head>
	<body>
	
		<!--table set up-->
		<table border = "1">
        <thead>
            <tr>
				<th>Name</th>
				<th>Address</th>
                <th>Ping</th>
                <th>Uptime</th>
            </tr>
        </thead>
        <tbody>
	<?php
		//table of the name, ip, ping, and uptime for each target
		foreach ($dbh->query("SELECT name, watches.ip, ping, uptime FROM watches, stats where username = '$username' and watches.ip = stats.ip") as $row) {
			echo "<TR>";
			echo "<TD>$row[0]</TD>";
			echo "<TD>$row[1]</TD>";
			echo "<TD>$row[2]</TD>";
			echo "<TD>$row[3]</TD>";  
			echo '<form action = "homepage.php" method = "post">';
			echo 	'<TD><input type = "submit" name = "delete" value = "delete"></TD>';
			
			//delete button for each target specific to this user
			if (isset($_POST['delete'])) {
				$delete = "DELETE FROM watches WHERE ip = '$row[1]' and username = '$username'";
				$dbh->exec($delete);
				unset($_POST['delete']);
				header("Refresh:0");
			}
			echo '</form>'; 
			
		}
		//link to add a target
		echo '<a href="addTarget.html">Add a new Target</a>';
	}
    

		//error handling
		catch (PDOException $e) {
			print "error! $e->getMessage()<br/>";
			die();

		}

		
		error_reporting(E_ALL);
		ini_set('display_errors','on');
	?>
		</tbody>
		</table>
	</body>
	<footer>
		<!--link to logout of webapp-->
		<a href="logout.php">logout</a>
	</footer>
</html>

<?php
session_start();
$username = $_SESSION['username'];

//database and user credentials
$dsn = 'mysql:dbname=NetworkHealthMonitor;host=cs3141.chqohuzhefwm.us-east-1.rds.amazonaws.com';
$dbuser = 'web';
$dbpassword = 'Netw0rkH3alth';

//network name and address from addTarget.html
$name = $_POST['networkName'];
$address = $_POST['address'];





try { 
	//connecting to database
	$dbh = new PDO($dsn,$dbuser,$dbpassword);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbh->query("use NetworkHealthMonitor");
	
	//prepared php statements
	$targetInsert = $dbh->prepare("INSERT INTO target VALUES(?,?)");
	$watchInsert = $dbh->prepare("INSERT INTO watches VALUES(?,?,?, 'ACTIVE')");
	$statInsert = $dbh->prepare("INSERT INTO stats VALUES(?,NOW(),'00:00:00',24)");
	$watchesSelect = $dbh->prepare("SELECT ip from watches where ip = ? and username = ?");
	$targetSelect = $dbh->prepare("SELECT ip FROM target where ip = ?");
	
	//check if the target is already in the database
	$targetSelect->execute(array($address));
	$targetSelect = $targetSelect->fetch(PDO::FETCH_ASSOC);
	
	//if target is not in database, add it to the database
	if ($targetSelect['ip'] == NULL) {
		$targetInsert->execute(array($address,$name));
		$statInsert->execute(array($address));
	} 
	
	//check if the user is already watching the target
	$watchesSelect->execute(array($address,$username));
	$watchesSelect = $watchesSelect->fetch(PDO::FETCH_ASSOC);

	//if user is already watching the target, inform user and direct back to homepage.php
	if ($watchesSelect['ip'] == $address) {
		echo 'Target already added!';
		echo '<form action = "homepage.php" method = "post">';
		echo	'<input class="submit" name="myMonitors" type="submit" value="My Monitors">';
		echo '</form>';
	}
	//otherwise, add the target to the user and direct back to homepage.php
	else {
		$watchInsert->execute(array($username,$address,$name));
		echo 'Target Successfully Added';
		echo '<form action = "homepage.php" method = "post">';
		echo	'<input class="submit" name="myMonitors" type="submit" value="My Monitors">';
		echo '</form>';
	} 
	
	
}

//error handling
catch (PDOException $e) {
	print "error! $e->getMessage()<br/>";
	die();

}

?>

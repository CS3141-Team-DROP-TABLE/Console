<?php
session_start();
$username = $_SESSION['username'];


$dsn = 'mysql:dbname=NetworkHealthMonitor;host=cs3141.chqohuzhefwm.us-east-1.rds.amazonaws.com';
$dbuser = 'web';
$dbpassword = 'Netw0rkH3alth';


$name = $_POST['networkName'];
$address = $_POST['address'];

$targetInsert = "INSERT INTO target VALUES('$address','$name')";
$watchInsert = "INSERT INTO watches VALUES('$username','$address','$name')";
$statInsert = "INSERT INTO stats VALUES('$address',NOW(),'00:00:00',24)";
//$targetSelect = "SELECT ip FROM target where ip = '$address'";
//$watchesSelect = "SELECT ip from watches where ip = '$address' and username = '$username'";



try { 
	
	$dbh = new PDO($dsn,$dbuser,$dbpassword);

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	/* $targetSelect = $dbh->query("SELECT ip FROM target where ip = '$address'");
	$targetSelect = $targetSelect->fetch(PDO::FETCH_ASSOC);
	$selectResult = targetSelect['ip'];
	if ($selectResult == NULL) {
	} */
	//else {
		$dbh->exec($targetInsert);
	//}  
	
	$watchesSelect = $dbh->query("SELECT ip from watches where ip = '$address' and username = '$username'");
	$watchesSelect = $watchesSelect->fetch(PDO::FETCH_ASSOC);
	$watchesResult = watchesSelect['ip']; 
	if ($watchesResult == $address) {
		echo 'Target already added!';
		echo '<form action = "homepage.php" method = "post">';
		echo	'<input class="submit" name="myMonitors" type="submit" value="My Monitors">';
		echo '</form>';
	}
	else {
		$dbh->exec($watchInsert);
		$dbh->exec($statInsert);
		echo 'Target Successfully Added';
		echo '<form action = "homepage.php" method = "post">';
		echo	'<input class="submit" name="myMonitors" type="submit" value="My Monitors">';
		echo '</form>';
	} 
	
	
}
catch (PDOException $e) {
	print "error! $e->getMessage()<br/>";
	die();

}

?>
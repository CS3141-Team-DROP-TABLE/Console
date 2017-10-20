<html>
<title>Network Health Monitor</title>
</html>


<?php
try { 
	$dbh = new PDO('cs3141.chqohuzhefwm.us-east-1.rds.amazonaws.com;dbname=NetworkHealthMonitor',"web","Netw0rkH3alth");

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    echo "table border='1'";
    echo "<TR>";
    echo "<TH> Target </TH>";
    echo "<TH> Ping </TH>";
    echo "</TR>";

    foreach ($dbh->query("SELECT ip, ping FROM watches") as $row) {
    	echo "<TR>";
	echo "<TD>".$row[0]."</TD>";
	echo "<TD>".$row[1]."</TD>";   
    }
}
    


catch (PDOException $e) {
      print "error!".$e->getMessage()."<br/>";
      die();

}
?>

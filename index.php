<html>
	<head>
		<title>Network Health Monitor</title>
	</head>
	<body>
	
		<!--table set up-->
		<table border = "1">
        <thead>
            <tr>
                <th>Target</th>
                <th>Ping</th>
            </tr>
        </thead>
        <tbody>


	<?php

		//connecting to the database
		$dsn = 'mysql:dbname=NetworkHealthMonitor;host=cs3141.chqohuzhefwm.us-east-1.rds.amazonaws.com';
		$user = 'web';
		$password = 'Netw0rkH3alth';
		try { 
			$dbh = new PDO($dsn,$user,$password);

			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


			
			//db query for the ping and ip of a target
			foreach ($dbh->query("SELECT ip, ping FROM watches") as $row) {
			
				echo "<TD>$row[0]</TD>";
				echo "<TD>$row[1]</TD>";   
			}
		}
    


		//error handling
		catch (PDOException $e) {
			print "error!$e->getMessage()<br/>";
			die();

		}

		error_reporting(E_ALL);
		ini_set('display_errors','on');
		?>
		</tbody>
		</table>
	</body>
</html>
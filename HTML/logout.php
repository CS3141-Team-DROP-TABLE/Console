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
//end the session
session_start();
session_destroy();
//echo "Logout Successful!";
?>
<!--direct back to login page-->
	<form action = "index.php" method = "post">
		<input class="submit" name="login" type="submit" value="Back to login">
	</form>
</body>
</html>
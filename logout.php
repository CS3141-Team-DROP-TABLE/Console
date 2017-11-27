<?php
//end the session
session_start();
session_destroy();
echo "Logout Successful!";
?>
<!--direct back to login page-->
<form action = "index.php" method = "post">
<input class="submit" name="login" type="submit" value="Login">
</form>
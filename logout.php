<?php
session_start();
session_destroy();
echo "Logout Successful!";
?>
<form action = "index.php" method = "post">
<input class="submit" name="login" type="submit" value="Login">
</form>
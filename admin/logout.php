<?php
unset($_SESSION['ADMIN_LOGIN']);
unset($_SESSION['ADMIN_USERNAME']);
header('location:login.php');
//The die() is an inbuilt function in PHP. It is used to print message 
//and exit from the current php script. It is equivalent to exit() function in PHP.
die();
?>
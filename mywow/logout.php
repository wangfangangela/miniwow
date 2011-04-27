<?php

if (isset($_SESSION['user'])){
    unset($_SESSION['user']);
    session_destroy();
}
else
	echo "您已经登出！！";
header("location:login.php");

?>


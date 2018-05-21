<?php
	session_start();
	session_unset();
	session_destroy();
	//unset($_COOKIE['cookie_name']);
	setcookie('PHPSESSID', '', time() - 3600, '/');
    //setcookie('cookie_name', '', time() - 3600, '/');
	header("Location:index.php");
   	exit;
?>
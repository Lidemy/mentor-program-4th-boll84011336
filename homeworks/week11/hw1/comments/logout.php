<?php
	require_once('conn.php');
	session_start();
	session_destroy();
 	setcookie("token", "", time() - 3600);
 	header("Location: index.php");   
?>





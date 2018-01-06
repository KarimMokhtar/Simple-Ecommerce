<?php 
	session_start();

	session_destroy();
	header("location:Log.php");
	exit();
?>
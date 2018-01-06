<?php
	$dataSourceName = "mysql:host=localhost;dbname=it_project";
	$user = "root";
	$pass = "";
	$op = array(PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES utf8",);

	try {
		$con = new PDO($dataSourceName,$user,$pass,$op);
		//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		//echo "connected";
	} catch (PDOException $e) {
		//echo "Failed".$e->getMessage();
	}
?>
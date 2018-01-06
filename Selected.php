<?php 
	include "function.php";
	include "Header.php";
	include 'navbar.php';
	include "DPConnection.php";
	
	if(isset($_GET['ITEMS'])){
		$str =  $_GET['ITEMS'][0];
		$items = explode(',', $str);
		//print_r($items);
		//for($i = 0 ; $i < count($items[0]) ; ++$i)print_r($items[0][$i]);
		$query = $con->prepare("SELECT * from Product where ID = ?");
		foreach($items as $item){
			
			$query->execute(array($item));
			echo '<div class="container-fluid">
				<div class="row">';
			while( $row = $query->fetch() ){
				echo '<div class="col-sm-4" style="background-color:lavender;">' .'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image'] ).'"/>'.
				
				'<a class = "EDD" href = "Product.php?do=Details&PID='.$row["ID"].'">'.'<button class = "btn btn-primary">Details</button>' .'</a> '.
				'<a class = "EDD" href = "Product.php?do=Edit&PID='.$row["ID"].'">'.'<button class = "btn btn-primary">Edit</button>' .'</a> '.
				'<a class = "EDD" href = "Product.php?do=Delete&PID='.$row["ID"].'">' .'<button class = "btn btn-primary">Delete</button>' .'</a>'.
				'</div>';
			}
		}
		

	}
	include "Footer.php";
?>

<?php 
	session_start();
	$Title = "Home";
	include "function.php";
	include "Header.php";
	include 'navbar.php';
	include "DPConnection.php";
	if(!isset($_SESSION['UserName'])){
		header('Location: Log.php');
	}
	$query = $con->prepare("SELECT * from product");
	$query->execute();
	$count = $query->rowCount();
	if($count == 0){
		echo "0 data ";
	}
	echo '<div class="container-fluid">
			<div class="row">';
	while( $row = $query->fetch() ){
		echo '<div class="col-sm-4" class="pretty p-switch p-fill" style="background-color:lavender;">' .'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image'] ).'"/>'.
		
		'<a class = "EDD" href = "Product.php?do=Details&PID='.$row["ID"].'">'.'<button class = "btn btn-primary">Details</button>' .'</a> '.
		'<a class = "EDD" href = "Product.php?do=Edit&PID='.$row["ID"].'">'.'<button class = "btn btn-primary">Edit</button>' .'</a> '.
		'<a class = "EDD" href = "Product.php?do=Delete&PID='.$row["ID"].'">' .'<button class = "btn btn-primary">Delete</button>' .'</a>'.
		'<input type="checkbox" class="Item" value = '.$row["ID"].'>'.
		'</div>';
	}
?>
	<button class = "btn btn-primary btn-block" onclick= "selectFun()"> Select? </button>
	
<?php 
	include "Footer.php";

?>

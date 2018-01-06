<?php 
	session_start();

	if(isset($_SESSION['UserName'])){
		include "function.php";
		include "Header.php";
		include 'navbar.php';
		include "DPConnection.php";

		$do = isset($_GET['do']) ?$_GET['do'] : "Add";
		$id = isset($_GET['PID']) ?$_GET['PID'] : 1;
		if($do == 'Add'){
			if($_SERVER['REQUEST_METHOD'] == "POST"){
				$PName = $_POST['ProductName'];
				$PCat = $_POST['ProductCategory'];
				$PDis = $_POST['ProductDiscrtiption'];
				$check = $_FILES["ProductImage"]["tmp_name"];
				if($check){
					$imagetmp=file_get_contents($_FILES['ProductImage']['tmp_name']);
	    			$query = $con->prepare("INSERT INTO Product(Name,Category, Description, Image) VALUES (?,?,?,?)");
					$query->execute(array($PName,$PCat,$PDis,$imagetmp));

					echo "<script>
						alert('Done');
						window.location.href='UserHome.php';
						</script>";
				}
				else echo '<div class = "alert alert-danger">Sorry Image is not Good</div>';

			}

?>

	<form class="login" method = "POST" enctype="multipart/form-data">
		<h4 class="text-center">Add Product</h4>
		<div  >Product Name:</div>
		<input class = "form-control" type="text" name="ProductName" required="required"/>
		<div  >Product Category:</div>
		<input class = "form-control" type="text" name="ProductCategory"/> 
		<div  >Product Discrtiption:</div>
		<input class = "form-control" type="text" name="ProductDiscrtiption"/> 
		<div  >Product Image:</div>
		<input class = "form-control" type="file" name="ProductImage" required="required"/> 	
		<input class = "btn btn-primary btn-block"  type="submit" value="Save" />	
	</form>
<?php
		}
		if($do == 'Delete'){
			$query = $con->prepare("DELETE from Product where ID = ?");
			$query->execute(array($id));
			echo "<script>
					alert('Done');
					window.location.href='UserHome.php';
					</script>";
		}
		if($do == 'Edit'){
			$query = $con->prepare("SELECT * from Product where ID = ?");
			$query->execute(array($id));
			$row = $query->fetch();
			

			if($_SERVER['REQUEST_METHOD'] == "POST"){
				$PName = $_POST['ProductName'];
				$PCat = $_POST['ProductCategory'];
				$PDis = $_POST['ProductDiscrtiption'];
				$check = $_FILES["ProductImage"]["tmp_name"];
    			$query = $con->prepare("UPDATE  Product SET ID = ? ,Name = ?,Category = ?, Description = ?, Image = ? where ID = ?");
    			if($check){
    				//$imagename=$_FILES["ProductImage"]["name"];
					$imagetmp=file_get_contents($_FILES['ProductImage']['tmp_name']);
					$query->execute(array($id,$PName,$PCat,$PDis,$imagetmp,$id));
					
				}
				else $query->execute(array($id,$PName,$PCat,$PDis,$row['Image'],$id));
				echo "<script>
					alert('Done');
					window.location.href='UserHome.php';
					</script>";

			}
?>
			<form class="login" method = "POST" enctype="multipart/form-data">
				<h4 class="text-center">Edit Product</h4>
				<div  >Product Name:</div>
				<input class = "form-control" type="text" name="ProductName" value="<?php echo $row['Name']?>" required="required"/>
				<div  >Product Category:</div>
				<input class = "form-control" type="text" name="ProductCategory" value="<?php echo $row['Category']?>"/> 
				<div  >Product Discrtiption:</div>
				<input class = "form-control" type="text" name="ProductDiscrtiption" value="<?php echo $row['Description']?>"/> 
				<div  >Product Image:</div>
				<input class = "form-control" type="file" name="ProductImage" /> 	
				<input class = "btn btn-primary btn-block"  type="submit" value="Save" />	
			</form>
<?php

		}
		if($do == 'Details'){
			
			$query = $con->prepare("SELECT * from Product where ID = ?");
			$query->execute(array($id));
			$row = $query->fetch();
			echo '<div class = "Big">' . '<img src="data:image/jpeg;base64,'.base64_encode( $row['Image'] ).'"/>'.
			'<br>'.'Name        :'.$row['Name'].
			'<br>'.'Category    :'.$row['Category'].
			'<br>'.'Description :'.$row['Description'].
			'</div>';
		}
	}

?>
<?php 
	include "Footer.php";

?>
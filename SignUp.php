
<?php
	$Title = "Sign Up";
	include "function.php";
	include "Header.php";
	include "DPConnection.php";
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$usern = $_POST['userName'];
		$pass = $_POST['pass'];
		$Email = $_POST['Email'];
		$FuName = $_POST['FullName'];
		// check if the user name is exist

		$query = $con->prepare("SELECT UserName from users where UserName = ?");
		$query->execute(array($usern));
		$check = $query->rowCount();
		if($check){
			echo '<div class = "alert alert-danger">Sorry Username is not available</div>';
		}
		else{

			$query = $con->prepare("INSERT INTO users(UserName,Password, Email, FullName) VALUES (?,?,?,?)");
			

			$query->execute(array($usern,$pass,$Email,$FuName));

			$_SESSION['UserName'] = $usern;

			header('Location: UserHome.php');
			exit();
		}

	}
?>

	<form id = "frm1" onsubmit = "return check_Sign_Up();" class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
		<h4 class="text-center">Sign Up</h4>
		<div id = "one">User Name:</div>
		<input class = "form-control" type="text" name="userName" placeholder="User Name" autocomplete="off" required="required"/>
		<div id = "two">Password:</div>
		<input class = "form-control" type="password" name="pass" placeholder="Password" autocomplete="new-password" required = "required"/> 
		<div id = "three">Full Name:</div>
		<input class = "form-control" type="text" name="FullName" placeholder="Full Name" autocomplete="off" required ="required"/> 
		<div id = "four">Email:</div>
		<input class = "form-control" type="text" name="Email" placeholder="Email" autocomplete="off" required = "required"/> 	
		<input class = "btn btn-primary btn-block"  type="submit" value="Submit" />	
	</form>

	
<?php 
	include "Footer.php";

?>

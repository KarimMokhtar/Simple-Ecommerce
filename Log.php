
<?php 
	session_start();
	
	
	$Title = "Log in";
	include "function.php";
	include "Header.php";
	include "DPConnection.php";
	if(isset($_SESSION['UserName'])){
		header('Location: UserHome.php');
	}
	

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//echo $_POST['user'] . " " . $_POST['pass'];
		$usern = $_POST['user'];
		$pass = $_POST['pass'];
		$query = $con->prepare("SELECT UserName,Password from users where UserName = ? and Password = ?");
		$query->execute(array($usern ,$pass));

		$check = $query->rowCount();
		//echo $check . " " . $usern . " " . $pass;
		if ($check){
			$_SESSION['UserName'] = $usern;
			header('Location: UserHome.php');
			exit();
		}
		else{
			echo "<script>
					alert('Wrong User Name or Password');
					</script>";
		}
	}


	?>
	<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
		<h4 class="text-center">Login</h4>
		
		<input class = "form-control" type="text" name="user" placeholder="User Name" autocomplete="off" required="required"/>
		<input class = "form-control" type="password" name="pass" placeholder="Password" autocomplete="new-password" required="required"/>
		<input class = "btn btn-primary btn-block" type="submit" value="Login" /> Or <button class="btn btn-primary" onclick="window.location.href='SignUp.php'">sign up</button>
	</form>
<?php 
	include "Footer.php";

?>
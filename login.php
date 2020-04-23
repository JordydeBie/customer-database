<?php 
session_start(); 
if (isset($_POST['username']) && isset($_POST['password']) ) {
	if (strlen($_POST['username']) < 1) {
		$_SESSION['error'] = "Please insert your username";
		header('location: login.php');
		return;
	}
	if (strlen($_POST['password']) < 1) {
		$_SESSION['error'] = "Please insert your password";
		header('location: login.php');
		return;
	}
}
if (isset($_POST['username']) && isset($_POST['password']) ) {
	if (strlen($_POST['username']) > 0 && strlen($_POST['password']) > 0) {
		
		$_SESSION['logged_in'] = "You are logged in!";
		$_SESSION['success'] = true;
		header('location: index.php');
		return;
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Log in</title>
</head>
<body>
	<h3>Log in</h3>
<?php  
	if (isset($_SESSION['error']) ) {
	echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
	//unset($_SESSION['error']);
	
	}
	?>
	<form method="POST">
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<input type="submit" name="submit" value="Log in">
	</form>
	<a href="register.php">Not registered?</a>
	<a href="forgot_password.php">Forgot your password?</a>

</body>
</html>
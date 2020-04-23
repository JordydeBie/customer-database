<?php 
// Use PDO to connect to MySQL db  
require_once 'pdo.php';
session_start();

// Server-side input validation
if (isset($_POST['create']) ){
	
	if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1) {
		$_SESSION['error'] = "Please fill in your full name";
		header('location: index.php');
		return;
	}

	if (strlen($_POST['email']) < 1 || strlen($_POST['telephone']) < 1 ) {
		$_SESSION['error'] = "Please add an email address and a telephone number";
		header('location: index.php');
		return;
	}
	if (! strpos($_POST['email'], '@') ) {
		$_SESSION['error'] = "Please add a valid email address (@)";
		header('location: index.php');
		return;
	}

	// Create a new record using prepared statements for security
	$sql = "INSERT INTO customer (first_name, last_name_prefix, last_name, email, telephone, remarks)
    		VALUES (:first_name, :last_name_prefix, :last_name, :email, :telephone, :remarks)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
    	':first_name' => htmlentities($_POST['first_name']),
    	':last_name_prefix' => htmlentities($_POST['last_name_prefix']),
    	':last_name' => htmlentities($_POST['last_name']),
    	':email' => htmlentities($_POST['email']),
    	':telephone' => htmlentities($_POST['telephone']),
    	':remarks' => htmlentities($_POST['remarks']) ));
    // Redirect user to table 
    $_SESSION['success'] = "Record added";
    header('location: index.php');
    return;
}
?>


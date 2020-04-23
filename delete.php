<?php
// Use PDO to connect to MySQL db
require_once 'pdo.php';
session_start();

// Redirect the user to the index
if (isset($_POST['return']) ) {
	header('location: index.php');
	return;
}

// Select customer ID and use PDO prepared statements
if (isset($_GET['customer_id']) ) {
	$sql = "SELECT customer_id FROM customer WHERE customer_id = :customer_id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array( ':customer_id' => $_GET['customer_id'] ));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$ci = $row['customer_id'];
	if ($row === false) {
		$_SESSION['error'] = 'Bad value for customer_id';
		header('location: index.php');
		unset($_SESSION['error']);
		return;
	}
}

// The above code is needed to execute the statement below, because it tells the code below WHAT to delete
if (isset($_POST['delete']) ) {
	$sql = "DELETE FROM customer WHERE customer_id = :xyz";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array( ':xyz' => $_POST['customer_id'] ));
	$_SESSION['success'] = "Customer record is deleted";
	header('location: index.php');
	return;
}

/*
if (isset($_POST['delete']) ) {
	$_SESSION['delete'] = "Record(s) have been deleted";
	$stmt = $pdo->query("DELETE FROM customer");
	echo "string";
	header('location: index.php');
	return;
}
*/
?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<!-- Stylesheet -->
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header><h1 class="py-4 bg-dark text-light rounded text-center"><i class="fas fa-address-book"></i> Delete customers</h1>
	</header>
	<main>
		<div class="d-flex justify-content-center">
		<h5>Are you sure you want to delete the customer record with customer ID <?= $ci ?>? This action is irreversible.</h5>
		</div>
		<form action="" method="POST" class="w-100">
			<div class="d-flex justify-content-center">
			<button name="delete_all" class="btn btn-success" id="btn_delete">Yes</button>
			<button name="return" class="btn btn-danger" id="btn_update">No</button>
			<input type="hidden" name="customer_id" value= <?= $ci ?> >
			</div>		
		</form>
	</main>

<!-- Fonts & icons -->
 <script src="https://kit.fontawesome.com/e011ef49ec.js" crossorigin="anonymous"></script>
 <!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
<?php 
// Use PDO tot connect to MySQL db 
require_once 'pdo.php';
session_start();

// Redirect user to index
if (isset($_POST['return']) ) {
	header('location: index.php');
	return;
}

// Delete ALL records using PDO prepared statements
if (isset($_POST['delete_all']) ) {
	$sql = "DELETE FROM customer";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$_SESSION['success'] = "All customer records are deleted";
	header('location: index.php');
	return;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete all</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<!-- Stylesheet -->
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<main>
	<h1 class="py-4 bg-dark text-light rounded text-center"><i class="fas fa-address-book"></i> Delete customers</h1>
	<div class="d-flex justify-content-center">
		<h5 style="color: red;">Are you sure you want to delete all the customer records? This action is irreversible.</h5>
	</div>
	<form action="" method="POST" class="w-100">
		<div class="d-flex justify-content-center">

			<button name="delete_all" class="btn btn-success" id="btn_delete">Yes</button>
			<button name="return" class="btn btn-danger" id="btn_update">No</button>
			
			
		</div>		
	</form>
</main>
<!-- Fonts & icons -->
<script src="https://kit.fontawesome.com/e011ef49ec.js" crossorigin="anonymous"></script>
 <!-- Bootstrap -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
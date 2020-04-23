<?php  
require_once 'pdo.php';
session_start();

/*if (! isset($_SESSION['success']) ) {
	die("ACCESS DENIED");
}

if (isset($_POST['return']) ) {
	header('location: index.php');
	return;
}*/

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['customer_id'])) {
	if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['telephone']) < 1)  {
		$_SESSION['error'] = "Required fields: first name, last name, email and telephone";
		header('location: edit.php?customer_id='.$_POST['customer_id']);
		return;
	}
	// Edit the customer information
	$sql = "UPDATE customer SET first_name = :first_name, last_name_prefix = :last_name_prefix, last_name = :last_name, email = :email, telephone = :telephone, remarks = :remarks WHERE customer_id = :customer_id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(	
		':first_name' => htmlentities($_POST['first_name']),
		':last_name_prefix' => htmlentities($_POST['last_name_prefix']),
		':last_name' => htmlentities($_POST['last_name']),
		':email' => htmlentities($_POST['email']),
		':telephone' => htmlentities($_POST['telephone']),
		':remarks' => htmlentities($_POST['remarks']),
		':customer_id' => htmlentities($_POST['customer_id']) ));
	$_SESSION['success'] = "Customer edited"; 
	header('location: index.php');
	return;
}

// Guardian: make sure that customer_id is present
if (! isset($_GET['customer_id']) 	) {
	$_SESSION['error'] = "Missing customer_id";
	header('location: index.php');
	return;
}
	// Select customer information for HTML form
$sql = "SELECT * FROM customer WHERE customer_id = :xyz";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(":xyz" => $_GET['customer_id']) );
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false) {
	$_SESSION['error'] = 'Bad value for customer_id';
	header('location: index.php');
	unset($_SESSION['error']);
	return;
}



$fn = htmlentities($row['first_name']);
$lnp = htmlentities($row['last_name_prefix']);
$ln = htmlentities($row['last_name']);
$em = htmlentities($row['email']);
$te = htmlentities($row['telephone']);
$re = htmlentities($row['remarks']);
$customer_id = htmlentities($row['customer_id']);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<!-- Fonts & icons -->
  	<script src="https://kit.fontawesome.com/e011ef49ec.js" crossorigin="anonymous"></script>
  	<!-- Bootstrap -->
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<!-- Stylesheet -->
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
	if (isset($_SESSION['error'])) {
		echo '<p style="color:red;">'.$_SESSION['error'].'</p\n>';
		unset($_SESSION['error']);
	}
	?>
	<h1 class="py-4 bg-dark text-light rounded text-center"><i class="fas fa-address-book"></i> Customer database</h1>
			<div class="d-flex justify concent-center">
				<form action="" method="POST" class="w-100">
					<!--<div class="py-2">
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text bg-warning"><i class="fas fa-portrait"></i></div>
								<input type="text" autocomplete="off" class="form-control" id="inlineFormInputGroup" placeholder="First name">
							</div> 
						</div>
					<div class="pt-2">
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text bg-warning"><i class="fas fa-portrait"></i></div>
								<input type="text" autocomplete="off" class="form-control" id="inlineFormInputGroup" placeholder="First name">
							</div> 
					</div>-->

					<div class="form-row">
						<div class="col">
							<div class="input-group-prepend">
								<div class="input-group-text bg-warning"><i class="fas fa-portrait"></i></div>
								<input type="text" autocomplete="off" class="form-control" id="inlineFormInputGroup" name="first_name" value= "<?= $fn ?>">
							</div> 
						</div>
						<div class="col">
							<div class="input-group-prepend">
								<div class="input-group-text bg-warning"><i class="fas fa-portrait"></i></div>
								<input type="text" autocomplete="off" class="form-control" id="inlineFormInputGroup" name="last_name_prefix" value="<?= $lnp ?>">
							</div> 
						</div>
						<div class="col">
							<div class="input-group-prepend">
								<div class="input-group-text bg-warning"><i class="fas fa-portrait"></i></div>
								<input type="text" autocomplete="off" class="form-control" id="inlineFormInputGroup" name="last_name" value="<?= $ln ?>">
							</div> 
						</div>
					</div>
					<div class="form-row pt-2"> <!-- pt = padding top -->
						<div class="col">
							<div class="input-group-prepend">
								<div class="input-group-text bg-success"><i class="far fa-envelope"></i></div>
								<input type="text" autocomplete="off" class="form-control" id="inlineFormInputGroup" name="email" value="<?= $em ?>">
							</div> 
						</div>
						<div class="col">
							<div class="input-group-prepend">
								<div class="input-group-text bg-primary"><i class="fas fa-phone-alt"></i></div>
								<input type="text" autocomplete="off" class="form-control" id="inlineFormInputGroup" name="telephone" value="<?= $te ?>">
								<input type="hidden" name="customer_id" id="customer_id" value="<?= $customer_id ?>">
							</div> 
						</div>
						<div class="col">
							<div class="input-group-prepend">
								<div class="input-group-text bg-danger"><i class="fas fa-exclamation-triangle"></i></div>
								<input type="text" autocomplete="off" class="form-control" id="inlineFormInputGroup" name="remarks" value="<?= $re ?>">
							</div> 
						</div>
					</div>
					<div class="d-flex justify-content-center">
						
						<button name="update" class="btn btn-warning" id="btn_update"><i class="fas fa-pencil-alt"></i></button>
						<button name="return" class="btn btn-secondary" id="btn_return"><i class="fas fa-arrow-left"></i></button>
					</div>		
					</form>
			</div>
</body>
</html>
<?php
// PDO is used to connect to MySQL database
require_once 'pdo.php';
require 'add.php';

// Adds a customer record to the database
if (isset($_POST['create']) ) {
	header('location: index.php');
	return;
}
// This redirects to the page where ALL customer records are deleted
if (isset($_POST['delete']) ) {
	//$_SESSION['delete'] = true;
	header('location: delete_all.php');
	return;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Customer Database</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Stylesheet -->
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header><h1 class="py-4 bg-dark text-light rounded text-center"><i class="fas fa-address-book"></i> Customer database</h1>
	</header>
	<main>
		<div class="d-flex justify concent-center">
			<form action="" method="POST" class="w-100">

				<?php 
					// Display error messages
					if (isset($_SESSION['error']) ) {
						echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
						unset($_SESSION['error']);
					}
					//Display confirmation that db operation was succesful
					if (isset($_SESSION['success']) ) {
						echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
						unset($_SESSION['success']);
						//return;
					}
				?>
				<div class="form-row">
						<div class="col">
							<div class="input-group-prepend">
								<div class="input-group-text bg-warning"><i class="fas fa-portrait"></i></div>
								<input type="text" autocomplete="off" class="form-control" name="first_name" placeholder="First name">
							</div> 
						</div>
						<div class="col">
							<div class="input-group-prepend">
								<div class="input-group-text bg-warning"><i class="fas fa-portrait"></i></div>
								<input type="text" autocomplete="off" class="form-control" name="last_name_prefix" placeholder="Last name prefix">
							</div> 
						</div>
						<div class="col">
							<div class="input-group-prepend">
								<div class="input-group-text bg-warning"><i class="fas fa-portrait"></i></div>
								<input type="text" autocomplete="off" class="form-control" name="last_name" placeholder="Last name">
							</div> 
						</div>
					</div>
					<div class="form-row pt-2"> 
						<div class="col">
							<div class="input-group-prepend">
								<div class="input-group-text bg-success"><i class="far fa-envelope"></i></div>
								<input type="text" autocomplete="off" class="form-control" name="email" placeholder="Email">
							</div> 
						</div>
						<div class="col">
							<div class="input-group-prepend">
								<div class="input-group-text bg-primary"><i class="fas fa-phone-alt"></i></div>
								<input type="text" autocomplete="off" class="form-control" name="telephone" placeholder="Telephone">
							</div> 
						</div>
						<div class="col">
							<div class="input-group-prepend">
								<div class="input-group-text bg-danger"><i class="fas fa-exclamation-triangle"></i></div>
								<input type="text" autocomplete="off" class="form-control" name="remarks" placeholder="Remarks">
							</div> 
						</div>
					</div>
					<div class="d-flex justify-content-center">
						<button name="create" class="btn btn-success" id="btn_create"><i class="fas fa-plus"></i></button>
						<button name="delete" class="btn btn-danger" id="btn_delete"><i class="fas fa-trash-alt"></i></button>
					</div>			
			</form>
	</main>
<?php
// Prints the table
echo "<div class='d-flex table-data'>";
// Table head
echo "<table class='table table-striped table-dark'>";
echo "<thead class='thead-dark'>";			
echo "<tr>";				 
echo "<th>Customer ID</th>";					 
echo "<th>First name</th>";					
echo "<th>First name prefix</th>";					
echo "<th>Last name</th>";					
echo "<th>Email</th>";					
echo "<th>Telephone</th>";					
echo "<th>Remarks</th>";					
echo "<th>Edit</th>";					
echo "<th>Delete</th>";
echo "</tr>";				
echo "</thead>";

// Select all records from the db		
$stmt = $pdo->query("SELECT first_name, last_name_prefix, last_name, email, telephone, remarks, customer_id FROM customer");
echo "<tbody>";
// Print all table rows
while ($row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
	echo "<tr><td>";					
	echo htmlentities($row['customer_id']);
	echo "</td><td>";
	echo htmlentities($row['first_name']);
	echo "</td><td>";
	echo htmlentities($row['last_name_prefix']);
	echo "</td><td>";
	echo htmlentities($row['last_name']);
	echo "</td><td>";
	echo htmlentities($row['email']);
	echo "</td><td>";
	echo htmlentities($row['telephone']);
	echo "</td><td>";
	echo htmlentities($row['remarks']);
	echo "</td><td>";
	echo ('<a href="edit.php?customer_id='.$row['customer_id'].'"><i class="fas fa-pencil-alt"></i></a>'); 
	echo "</td><td>";
	echo ('<a href="delete.php?customer_id='.$row['customer_id'].'"><i class="fas fa-trash-alt"></i></a>');
	echo ("</td></tr>\n");
}

echo "</tbody>";
echo "</table>";
echo "</div>";
?>

<!-- Fonts & icons -->
<script src="https://kit.fontawesome.com/e011ef49ec.js" crossorigin="anonymous"></script>
<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>


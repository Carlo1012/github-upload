<?php
ob_start();
session_start();
include '../include/connect.php'; 
include '../include/core.inc.php'; 

$_SESSION['username'];
$username = $_SESSION['username']; 
$query ="SELECT * FROM admin WHERE username = '$username'";
$result = mysqli_query($conn, $query);  

while($row = mysqli_fetch_array($result)) {
    $firstname_s = $row['firstname'];
    $middlename = $row['middlename'];
    $lastname_s = $row['lastname'];
}

?>   

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Admin - Home</title>
 	<link rel="icon" type="image/ico" href="../images/logo.png" />
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<script src="../vendor/jquery/jquery.min.js"></script>


	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

	
	<!-- custom css -->
	<link rel="stylesheet" type="text/css" href="../css/custom2.css" >  
</head>

<body class="container-fluid background">
	<?php include('navigation.html'); ?>
		
	<!-- <div class="container-fluid"> -->
		<?php include '../announcement/home.php'; ?>
	<!-- </div> container -->
	<?php include'../include/footer.html'; ?>

<script src="../include/notification_admin.js"></script>
</body>
</html>
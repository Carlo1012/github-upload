<?php
ob_start();
session_start();
include '../include/connect.php'; 
include '../include/core.inc.php';
$_SESSION['username'];
$username = $_SESSION['username']; //username ng nag login/sender ng files

$query ="SELECT * FROM mlgoo_clgoo WHERE username = '$username'";
$result = mysqli_query($conn, $query);  

while($row = mysqli_fetch_array($result)) {
  $firstname = $row['firstname'];
  $middlename = $row['middlename'];
  $lastname = $row['lastname'];
  $municipality = $row['city_municipality'];

}

$result_announcement = mysqli_query($conn, "SELECT * FROM announcement_admin ORDER BY created DESC");
?>
<!DOCTYPE html>
<html lang="en">

  <head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Staffs - Dashboard</title>
	<link rel="icon" type="image/ico" href="../images/logo.png" />

	<script src="../vendor/jquery/jquery.min.js"></script>
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- version 3.7.7 -->
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script> <!-- for design -->
	<link href="../vendor/fontawesome-free/css/all.css" rel="stylesheet"> <!-- for icons -->

	<!-- custom css -->
	<link href="../css/custom2.css" rel="stylesheet">

  </head>


<body class="container-fluid background">
<?php include 'navigation.html'; ?>
  <div class="container-fluid">
  	<?php include '../announcement/home.php'; ?>
  </div> <!-- container-fluid -->
  <?php include'../include/footer.html'; ?>
<script src="notification_mlgoo.js"></script>   
</body>
</html> 
<?php
ob_start();
session_start();
include '../include/connect.php'; 
include '../include/core.inc.php';
$_SESSION['username'];
$username_session = $_SESSION['username'];

$query_session ="SELECT * FROM staff_info WHERE username = '$username_session'";
$result_session = mysqli_query($conn, $query_session);  

while($row = mysqli_fetch_array($result_session)){
	$firstname = $row['firstname'];
	$middlename = $row['middlename'];
	$lastname = $row['lastname'];
	$district_assigned = $row['district_assigned'];
}

 if (preg_match('/(1|2)/',$district_assigned)) { //matching from $string
	 $reg = '(1|2)';
	} elseif(preg_match('/(3|4)/',$district_assigned)) {
		$reg = '(3|4)';
	}

	$query ="SELECT * FROM mlgoo_clgoo WHERE district REGEXP '($reg)' ";
	$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Accounts - Staff</title>
		<link rel="icon" type="image/ico" href="../images/logo.png" />


		<!-- Bootstrap core CSS-->
		 <script src="../vendor/jquery/jquery.min.js"></script>
		 <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- version 3.7.7 -->
		 <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> <!-- for design -->
		 
		<!-- for icons -->
		 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<!-- <link href="../vendor/fontawesome-free/css/all.css" rel="stylesheet">  -->
		 
		 <!-- custom css -->
		 <link href="../css/custom2.css" rel="stylesheet">

	<script src="../vendor/datatables/js/UIKit.jquery.dataTables.min.js"></script>  
    <script src="../vendor/datatables/js/dataTables.uikit.min.js"></script> 
    <link href="../vendor/datatables/css/uikit.min.css" rel="stylesheet">
    <link href="../vendor/datatables/css/dataTables.uikit.min.css" rel="stylesheet">

	</head>

<body class="container-fluid background">
<?php include 'navigation.html'; ?>
	<div class="container-fluid">
		<div class="container box">
			<div class="card-header">
				<i class="fas fa-users fa-3x"></i><br><br>
				<b>Mlgoo/Clgoo Accounts</b><br>
			</div>
			<div class="card-body">
				<div class="table-responsive" border="5px">  
				 <table id="staff_info" class="table table-striped uk-table-hover">  
					<thead>  
					 <tr> 
							<th>#</th>
							<th>username</th>
							<th>Name</th>
							<th>City/Municipality</th>
							<th>Email</th>
					 </tr>  
					</thead>  

					<?php  
					 $count = 1;
					while($row = mysqli_fetch_array($result)) {  
						$username  = $row['username'];
						$firstname  = $row['firstname'];
						$middlename = $row['middlename'];
						$lastname   = $row['lastname'];
						$city_municipality = $row['city_municipality'];
						$email = $row['email'];
							 echo '  
							 <tr>  
										<td>'.$count.'</td>
										<td>'. $username.'</td>  
										<td>'.$firstname.' '.$middlename.' '.$lastname.'</td>  
										<td>'.$city_municipality.'</td>  
										<td>'.$email.'</td>  
							 </tr>  
							 '; 
								$count++; 
					}  
					?>  
				 </table> <!-- id="staff_info -->
				</div>  <!-- table-responsive -->
			</div> <!-- card-body -->
		</div> <!-- card mb-3 -->
	</div> <!-- /.container-fluid -->
	<?php include '../include/footer.html' ?>


<script>
	$(document).ready(function(){  
		$('#staff_info').DataTable();  
	}); 

</script>
<script src="notification_staff.js"></script>

</body>
</html>

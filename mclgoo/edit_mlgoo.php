<?php
ob_start();
session_start();
include '../include/connect.php'; 
include '../include/core.inc.php';

$_SESSION['username'];
$username = $_SESSION['username']; 
$query ="SELECT * FROM mlgoo_clgoo WHERE username = '$username'";
$result = mysqli_query($conn, $query);  

while($row = mysqli_fetch_array($result)) {
    $firstname = $row['firstname'];
    $middlename = $row['middlename'];
    $lastname = $row['lastname'];
    $address = $row['address'];
    $email = $row['email'];
    $id = $row['id'];
  	$municipality = $row['city_municipality'];

}
if(isset($_POST['submit_btn'])){
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email']; 
	$address = $_POST['address'];
	// $gender = $_POST['gender'];

	$query = "UPDATE mlgoo_clgoo SET 
				firstname = '$firstname',
				middlename = '$middlename',
				lastname = '$lastname',
				email= '$email'
				WHERE id = '$id'
				";

	$query_run = mysqli_query($conn,$query);

	if($query_run){
			echo '<script type="text/javascript"> alert("Successfully Changed.")</script>';  
		}else{
			echo '<script type="text/javascript"> alert("Not Changed.")</script>';  

		}
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

		<title>My Information</title>
		<link rel="icon" type="image/ico" href="../images/logo.png" />


		 <script src="../vendor/jquery/jquery.min.js"></script>
		 <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- version 3.7.7 -->
		 <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> <!-- for design -->
		 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


		 <!-- custom css -->
		 <link href="../css/custom2.css" rel="stylesheet">

</head>
	</head>
<body class="container-fluid background">
<?php include "navigation.html" ?>
	<div class="container-fluid">
		<div class="container box">
			<div class="card-header">
				<i class="fas fa-info-circle fa-3x"></i>
				<b>My Information</b></div>
			<div class="card-body">
				<form class="myform" action="edit_mlgoo.php" method="post">	

					<div class="form-group">
						<div class="form-row">
							<div class="col-md-4">
								<div class="form-label-group">
									<input type="text" name="firstname" id="firstname" class="form-control" placeholder="First name" required="required" maxlength="15" value="<?php echo $firstname ?>">
									<label for="firstname">First name</label>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-label-group">
									<input type="text" name="middlename" class="form-control" placeholder="Middle name" maxlength="15" value="<?php echo $middlename ?>">
									<label for="middlename" value="<?php echo $firstname ?>">Middle name</label>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-label-group">
									<input type="text" name="lastname" class="form-control" placeholder="Last name" required="required" maxlength="15" value="<?php echo $lastname ?>">
									<label for="lastname">Last name</label>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="form-row">
							<div class="col-md-4">
								<div class="form-label-group">
									<input type="email" name="email" class="form-control" placeholder="Email address" required="required" maxlength="30" onkeypress="CheckSpace(event)" value="<?php echo $email ?>">
									<label for="email">Email address</label>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="form-row">
							<div class="col-md-4">
								<div class="form-label-group">
									<input type="text" name="address" class="form-control" placeholder="Address" required="required" maxlength="50" value="<?php echo $address ?>">
									<label for="address">Address</label>
								</div>
							</div>
						</div>
					</div>

				<!-- 	<div class="form-group">
						<div class="form-label-group">
							<div class="col-md-4">
								<label for="gender">Gender</label><br>
								<input type="radio" name="gender" value="m"  required="required">Male
								<input type="radio" name="gender" value="f"  required="required">Female 
							</div>         
						</div>
					</div> -->

					<input name="submit_btn" class="btn btn-primary btn-block" type="submit" id="signup_btn" value="Save Changes"/>
				</form>
			</div> 
		</div>
	</div>
	<?php include '../include/footer.html'; ?>  
<script src="notification_mlgoo.js"></script>   

<script type="text/javascript">
	// for not allowing blank space
	function CheckSpace(event) {
	   if(event.which ==32) {
		  event.preventDefault();
		  return false;
	   }
	}

	// $('#firstname').on('change keyup', function() {
	//   var sanitized = $(this).val().replace(/[^A-Z]/g, '');
	//   $(this).val(sanitized);
	// });
</script>
</body>
</html>
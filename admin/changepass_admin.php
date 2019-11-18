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
    $password = $row['password'];
}

	if (isset($_POST['update']) && 
	  isset($_POST['c_password'])&&
	  isset($_POST['new_password'])){




	  

		$old_pass = $_POST['old_password'];
		$old_password = md5($old_pass);

	if ($password == $old_password) {
		
		$new_password = $_POST['new_password'];
	 	$c_password = $_POST['c_password'];
		$md5_password = md5($new_password);

	
		if($new_password == $c_password){
		  $select_query = "SELECT * FROM admin";    

          if ($password != $md5_password) {
              // go
         


			if(mysqli_query($conn, $select_query)){
					
			  $update_query = "UPDATE admin SET password = '$md5_password' WHERE username = '$username' ";
			  $query = mysqli_query($conn, $update_query);
			
			  if($query){
				// echo "<script>alert('Data Updated.');</script>";
				echo '<script type="text/javascript">';
				echo 'setTimeout(function () { swal("Updated","Password Updated!","success");';
				echo '}, 1000);</script>'; 
			  }else{
			   echo mysqli_error();
			  }
				   
			}else{
			  // echo "<script>alert('Data not Updated.');</script>";
				echo '<script type="text/javascript">';
				echo 'setTimeout(function () { swal("Try Again","Password not Updated!","error");';
				echo '}, 1000);</script>'; 
			}
		  
 } else {
            echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Failed","That is your current password!","error");';
                echo '}, 1000);</script>'; 
          }


		}else{
		  // echo "<script>alert('Password does not match.');</script>";
			echo '<script type="text/javascript">';
			echo 'setTimeout(function () { swal("Not Match","Password does not match!","error");';
			echo '}, 1000);</script>'; 
		}
} else {
	// echo "<script>alert('Password not macth.');</script>";
	echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("Not Match","Old Password does not match!","error");';
    echo '}, 1000);</script>'; 
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

	<title>Admin - Settings</title>
	<link rel="icon" type="image/ico" href="../images/logo.png" />

	<!-- Bootstrap core CSS-->

	<script src="../vendor/jquery/jquery.min.js"></script>
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- version 3.7.7 -->
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script> <!-- for design -->
	
	<!-- for icons -->
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <script src="../vendor/sweetalert/js/sweetalert.min.js"></script>


   <!-- custom css -->
   <link href="../css/custom2.css" rel="stylesheet">

  </head>

<body class="container-fluid background">
<?php include('navigation.html'); ?>
  <div class="container-fluid">
	<div class="container box">
		 <div class="card-header">
		 	<i class="fas fa-unlock-alt fa-3x"></i>
                <b>Change Password</b>
            </div>
		<!-- <span class="send_report_title"><h3>Change Password</h3></span><hr> -->
		<form class="my-form" method="POST" action="#">
			<div class="form-group">
				<div class="col-lg-3 col-xs-8">
				
					<label for="old_password">Old Password</label>
					<input type="password" class="form-control" name="old_password" id="NewPassword" placeholder="Old password" equired minlength="8" maxlength="15" autofocus="autofocus">

					<label for="NewPassword">New Password</label>
					<input type="password" class="form-control" name="new_password" id="NewPassword" placeholder="New password" equired minlength="8" maxlength="15" autofocus="autofocus">

					<label for="N_Password">Confirm Password</label>
					<input type="password" class="form-control" name="c_password" id="N_Password" placeholder="Retype new Password" required minlength="8" maxlength="15">
				</div>          
			</div>
		<br>
		<br>
			<button class="button upload" style="vertical-align:middle" name="update"><span>Change Password </span></button>
		</form>
	</div>
</div>  <!-- /.container-fluid -->
<?php include '../include/footer.html' ?>

<script src="../include/notification_admin.js"></script>
</body>
</html>
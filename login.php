<?php 
ob_start();
session_start();
include 'include/connect.php';

if(isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $md5_password = md5($password);
    
    if (!empty($username) && !empty($password)) {
    
        $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$md5_password'"; 
        $query_run = mysqli_query($conn, $query);
        $row = mysqli_num_rows($query_run);

        if($query_run = mysqli_query($conn, $query)){
            $query_num_rows = mysqli_num_rows($query_run);

            if($query_num_rows==1){                     
                $_SESSION['username']=$username;
                header('Location: admin/dashboard.php'); 
                } else if($query_num_rows==0) {
                
                    $query_staff_info = "SELECT * FROM staff_info WHERE username = '$username' AND password = '$md5_password'"; 
                    $query_run_staff_info = mysqli_query($conn, $query_staff_info);
                    $row_staff_info= mysqli_num_rows($query_run_staff_info);
                    
                    if($query_run_staff_info = mysqli_query($conn, $query_staff_info)){
                        $query_num_rows_staff_info = mysqli_num_rows($query_run_staff_info);

                        if($query_num_rows_staff_info==0) {
                        
                            $query_mclgoo = "SELECT * FROM mlgoo_clgoo WHERE username = '$username' AND password = '$md5_password'";
                            $query_run_mclgoo = mysqli_query($conn, $query_mclgoo);
                            $row_mclgoo= mysqli_num_rows($query_run_mclgoo);
                            
                            if($query_run_mclgoo = mysqli_query($conn, $query_mclgoo)){
                                $query_num_row_mclgoo = mysqli_num_rows($query_run_mclgoo); 

                                if($query_num_row_mclgoo==0) {
                                    echo "<script>alert('Invalid username/passsword combination.');</script>" ;     
                                    } else if($query_num_row_mclgoo==1){
                                      while($row = mysqli_fetch_array($query_run_mclgoo)){
                                        $active = $row['active'];
                                      }

                                      if ($active==1) {
                                        echo '<script type="text/javascript">';
                                        echo 'setTimeout(function () { swal("BLOCKED","Your account is Disabled!","error");';
                                        echo '}, 1000);</script>';      
                                      }else{
                                        $_SESSION['username']=$username;
                                          header('Location: mclgoo/dashboard_mclgoo.php');  
                                      }
                                }
                            }

                            } else if($query_num_rows_staff_info==1){
                                while($row = mysqli_fetch_array($query_run_staff_info)){
                                  $active = $row['active'];
                                }

                                if ($active==1) {
                                    echo '<script type="text/javascript">';
                                    echo 'setTimeout(function () { swal("BLOCKED","Your account is Disabled!","error");';
                                    echo '}, 1000);</script>';   
                                }else{
                                  $_SESSION['username']=$username;
                                  header('Location: staff/dashboard_staff.php');  
                                }
                            }
                    }   
                } else {
                    echo '<script type="text/javascript">';
                    echo 'setTimeout(function () { swal("Invalid","Invalid username/passsword combination!","error");';
                    echo '}, 1000);</script>';       
                }
        } else {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Enter Credentials","You must supply a username and password!","error");';
            echo '}, 1000);</script>'; 
        }
                
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
    <link rel="icon" href="images/logo.png" type="image/x-icon">

    <title>Login</title>

    <!-- Bootstrap core CSS-->
    <script src="vendor/jquery/jquery.min.js"></script>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- version 3.7.7 -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script> <!-- for design -->
    
    <script src="vendor/sweetalert/js/sweetalert.min.js"></script>

    <!-- Custom styles for this template-->
    <link href="css/custom2.css" rel="stylesheet">
    
  </head>
<body class="container-fluid bglogin">
    <div class="container-fluid">
        <div class="container-fluid login col-sm-4">
            <!--login.php?newpwd=passwordupdated-->
            <div class="row">
			<div class="col-lg-12">
				<?php 
					if(isset($_GET['newpwd'])) {
						$reset = $_GET['newpwd'];
						
						if($reset=='success'){
								$class='success';  
								$msg = 'Check your email spam/inbox';
						}else if($reset=='cantfindemail'){
								$class='danger';   
								$msg = 'Invalid Email';
						}else if($reset=='error'){
								$class='danger';   
								$msg = 'Theres a problem in your connection';
						}else if($reset=='passwordupdated'){
								$class='success';   
								$msg = 'Your password is updated';
						}else{
								$class='hide';
						}
					}
				?>
				<div class="alert alert-<?php if(isset($class)){ echo $class; }  ?> ">
					<strong><?php if (isset($msg)) { echo $msg. '!'; }  ?></strong>    
				</div>
			</div>
		</div>
            <form method="POST" action="#">
                <!-- <div class="imgcontainer">
                    <img src="images/logo.png" alt="Avatar" class="avatar">
                </div> -->
                <label for="username"><b class="login">Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" id="username" required>

                <label for="password"><b class="login">Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button type="submit" name="submit">Login</button>
                <label class="login">
                  <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>

                <div class="container-fluid">
                    <span class="psw"><a href="forgettenpwd/reset-password.php">Forget your password ?</a></span>
                </div>
            </form>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function(){  
        $("#username").on('change keyup paste',function() {
        $(this).val($(this).val().toLowerCase());
        })
    });
</script>
</body>
</html>
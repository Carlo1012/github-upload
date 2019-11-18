<?php 
include '../include/connect.php';

?>

<!DOCTYPE html>
<html lang="en">

  <head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Reset Password</title>

	<!-- Bootstrap core CSS-->
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- version 3.7.7 -->

	<script src="../vendor/jquery/jquery.min.js"></script>

	 <!-- for design -->
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

	<link href="../vendor/fontawesome-free/css/all.css" rel="stylesheet"> <!-- for icons -->

	<!-- Custom styles for this template-->
	<link href="../css/custom2.css" rel="stylesheet">

  </head>
<body class="container-fluid background">
	<div class="container report_admin">
		<h1 style="text-align: center;">Reset your password</h1><br>
		<p>An e-mail will be send to you with instructions on how to reset your password.</p>
		<form  method="POST" action="includes/reset-request.inc.php">
			<input type="text" name="email" autocomplete="on" placeholder="Enter your e-mail address....">
			<button type="submit" name="reset-request-submit">Proceed </button>
		</form>
		
		<div class="row">
			<div class="col-lg-12">
				<?php 
					if(isset($_GET['reset'])) {
						$reset = $_GET['reset'];
						
						if($reset=='success'){
								$class='success';  
								$msg = 'Check your email spam/inbox';
						}else if($reset=='cantfindemail'){
								$class='danger';   
								$msg = 'Invalid Email';
						}else if($reset=='error'){
								$class='danger';   
								$msg = 'Theres a problem in your connection';
						}else if($reset=='block'){
								$class='danger';   
								$msg = 'The account has been blocked';
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
	</div>
			<?php include '../include/footer.html' ?>


</body>
</html>
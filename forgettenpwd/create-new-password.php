<?php 

include '../include/connect.php';

if(!isset( $_GET["selector"])){
//   header('Location: ../login.php'); 
echo "<script>window.location.href='../login.php'</script>";
     die();
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

    <title>Create new password</title>

    <!-- Bootstrap core CSS-->
    <script src="../vendor/jquery/jquery.min.js"></script>

	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- version 3.7.7 -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> <!-- for design -->
    <link href="../vendor/fontawesome-free/css/all.css" rel="stylesheet"> <!-- for icons -->

    <!-- Custom styles for this template-->
	<link href="../css/custom2.css" rel="stylesheet">

<style type="text/css">

	input[type=text], input[type=password] {
  			width: unset;		
	}

	button {
		width: unset;
	}

</style>
  </head>
<body class="container-fluid background">
	<div class="container report_admin">
		<h1 style="text-align: center;">Create new password</h1>
		<p>Enter your new password.</p>
		<?php
			$selector = $_GET["selector"];
			$validator = $_GET["validator"];

			if (empty($selector) || empty($validator)) {
				echo "Could not validate your request!";
			} else {

				if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
					
                    echo '
					<form action="includes/reset-password.inc.php" method="POST"> 
						<input type="hidden" name="selector" value="'.$selector.'">
						<input type="hidden" name="validator" value="'.$validator.'">
						<input type="password" name="pwd" placeholder="New Password">
						<input type="password" name="pwd-repeat" placeholder="Retype Password">
						<button type="submit" name="reset-password-submit">Reset password</button>
					</form>';
					
				}
			}
		?>
	</div><br>
	<?php include '../include/footer.html' ?>
</body>
</html>

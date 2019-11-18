<?php

if (isset($_POST["reset-password-submit"])) {
	$selector = $_POST["selector"];
	$validator = $_POST["validator"];
	$password = $_POST["pwd"];
	$passwordRepeat = $_POST["pwd-repeat"];

	if (empty($selector) || empty($validator)) {
		header("Location: ../create-new-password.php?newpwd=empty");
		exit();
	} elseif ($password !=$passwordRepeat) {
		header("Location: ../create-new-password.php?newpwd=pwdnotsame");
		exit();
	}

	$currentDate = date("U");
	require '../../include/connect.php';

	$sql = "SELECT * FROM pwdreset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "There was an error1!";
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
		mysqli_stmt_execute($stmt);
		

		$result = mysqli_stmt_get_result($stmt);
		if (!$row = mysqli_fetch_assoc($result)) {
// 			echo "You need to re-submit your reset request1.";
            echo "<script>window.location.href='../reset-password.php?reset=error'</script>";
			exit();
		} else {

			$tokenBin = hex2bin($validator);
			$tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

			if ($tokenCheck === false) {
				echo "You need to re-submit your reset request2.<br>";
				echo 'TokenBin<br>'.  $tokenBin;
				echo 'TokenCheck<br>'. $tokenCheck;
				exit();
			} elseif ($tokenCheck === true) {
			    
				$tokenEmail = $row['pwdResetEmail'];  

				$sql = "SELECT * FROM staff_info WHERE email=?;";
				$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
				// 		echo "There was an error2!";
				echo "<script>window.location.href='../reset-password.php?reset=error'</script>";
						exit();
					} else {
						mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt); 
						
						if (!$row = mysqli_fetch_assoc($result)) {
				// 			echo "There was an error3!.";
				echo "<script>window.location.href='../reset-password.php?reset=error'</script>";
							exit();
						} else {
							
							$sql ="UPDATE staff_info SET password=? WHERE email=?";
							$stmt = mysqli_stmt_init($conn);
							if (!mysqli_stmt_prepare($stmt, $sql)) {
				// 			echo "There was an error4!";
				echo "<script>window.location.href='../reset-password.php?reset=error'</script>";
							exit();
							} else {
							    $password = $_POST["pwd"];
							//	$newpassword = password_hash($password, PASSWORD_DEFAULT);
								$pass = md5($password);
								mysqli_stmt_prepare($stmt, $sql);
								mysqli_stmt_bind_param($stmt, "ss", $pass, $tokenEmail);
								mysqli_stmt_execute($stmt);
							
                                $sql ="DELETE FROM pwdreset WHERE pwdResetEmail=?";
								$stmt =mysqli_stmt_init($conn);
								if (!mysqli_stmt_prepare($stmt, $sql)) {
								// 	echo "There was an error5!";
								echo "<script>window.location.href='../reset-password.php?reset=error'</script>";
									exit();
								} else {
									mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
									mysqli_stmt_execute($stmt);
								// 	header("Location: ../../login.php?newpwd=passwordupdated");
									echo "<script>window.location.href='../../login.php?newpwd=passwordupdated'</script>";
								}
							} 
						}
					}
			} 
		}
	// }else{ 
	// 	header("Location: ../../index.html");
		} 
}
?>
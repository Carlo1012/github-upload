<?php
ob_start();
session_start();
include '../include/connect.php'; 
include '../include/core.inc.php';
$_SESSION['username'];
$username = $_SESSION['username'];
$dead = $_REQUEST['deadline'];
$query ="SELECT * FROM staff_info WHERE username = '$username'";
$result = mysqli_query($conn, $query);  

while($row = mysqli_fetch_array($result)) {
	$firstname = $row['firstname'];
	$middlename = $row['middlename'];
	$lastname = $row['lastname'];
	$district_assigned = $row['district_assigned'];
}
if (isset($_POST['upload'])) {
		// Get image name
	$username = $_SESSION['username'];
	$recipient = $_POST['recipient'];
	$files = $_FILES['file']['name'];
	$deadline=$_POST['deadline'];

	$timestamp = strtotime($deadline);
	$start_date = date("Y-m-d", $timestamp);
	
	if(empty($files)){
		echo "<script>alert('Please choose the file.');</script>";    
	}elseif(empty($deadline)){
		echo "<script>alert('Please choose deadline.');</script>";   
	}elseif(empty($recipient)){
		echo "<script>alert('Please choose recipient.');</script>";     
	}else{    

        $target = "../files_upload/".basename($files);
        $query_run = "INSERT INTO uploaded_files (sender, recipient, file_name, deadline) VALUES (?, ?, ?, ?)";
        $stmt =mysqli_stmt_init($conn);
    
            if (!mysqli_stmt_prepare($stmt, $query_run)) {
                echo "<script>alert('There was an error2');</script>"; 

                echo $query;
                exit();
            } else {

                $errors     = array();
                $maxsize    = 10097152;
                $extensions = array("docx","doc","pdf","xlxs","xls");
                $ext = pathinfo($files, PATHINFO_EXTENSION);;

                if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
                    echo "<script>alert('File too large. File must be less than 10 megabytes.');</script>"; 
                    header("refresh:1 url=report_staff.php");

                }elseif (!in_array($ext,$extensions)) {
                    echo "<script>alert('This file extenstion is not accepted.');</script>"; 
                    header("refresh:1 url=report_staff.php");

                }elseif (count($errors) === 0) {
                 
                     if(isset($_POST['recipient'])){
                        $recipient = $_POST['recipient'];
                        foreach ($recipient  as $recipients) { 
                            move_uploaded_file($_FILES['file']['tmp_name'], $target);

                            mysqli_stmt_bind_param($stmt, "ssss", $username, $recipients, $files, $start_date);
                            mysqli_stmt_execute($stmt);
                        }
                        	header("refresh:1 url=reportlist_staff.php?r=Sent");
                        	die();
                            // echo "<script>alert('Uploaded successfully.');</script>"; 

                    }
      
                }else {
                    foreach($errors as $error) {
                        echo '<script>alert("'.$error.'");</script>';
                        header("refresh:1 url=report_staff.php?r=send");
                    }
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            }
    }
}
			// mysqli_stmt_execute($stmt);
 ?>    

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Staff - Report</title>
 	<link rel="icon" type="image/ico" href="../images/logo.png" />


		<script src="../vendor/jquery/jquery.min.js"></script>
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- version 3.7.7 -->
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script> <!-- for design -->

		<!-- for icons -->
		<link href="../vendor/fontawesome-free/css/all.css" rel="stylesheet"> 

		<!-- custom css -->
		<link href="../css/custom2.css" rel="stylesheet">

		<link href="../vendor/jquery-ui/css/jquery-ui.css" rel="stylesheet">
    	<script src="../vendor/jquery-ui/js/jquery-ui.js"></script>
	
<?php include('navigation.html'); ?>
</head>

<body class="container-fluid background">
	<div class="container-fluid">
		<div class="container box">
			<span class="send_report_title">
				<h3>Send Report</h3></span><hr>
			<form class="myform" autocomplete="off" action="report_staff.php?r=Sent" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<div class="form-row-fluid">
						<div class="col-md-9 col-sm-9 col-lg-10">
							<div class="form-label-group">
								<label for="opt"><span class="opts_title">Mlgoo/Clgoo Name</span></label>
											<?php
								  if (preg_match('/(1|2)/',$district_assigned)) {
                                     $reg = '1';
                                     $reg2 = '2';

                                    } elseif(preg_match('/(3|4)/',$district_assigned)) {
                                      $reg = '3';
                                      $reg2 = '4';
                                    }
                                   
                                    if ($_REQUEST['reply'] == 'admin') {
											echo '
											<input type="text" name="recipient[]" id="autodeadline" required="required" readonly="readonly" value="'.$_REQUEST['sender'].'"> ';

                                    } else {
                                    	 echo'
											<select  class="row opts" id="opt" name="recipient[]" multiple="multiple" required="required" value="">
											
											';	
                                    	echo'
											<optgroup label="District '.$reg.'"> ';
											$query ="SELECT * FROM mlgoo_clgoo WHERE district = '$reg' ORDER BY firstname ASC";
											$result = mysqli_query($conn, $query);  
											
											while($row = mysqli_fetch_array($result)) {
												$recipient_username = $row['username'];
												$firstname = $row['firstname'];
												$middlename = $row['middlename'];
												$lastname = $row['lastname']; 
												$cm = $row['city_municipality'];

												echo' <option value="'.$recipient_username.'">
														'.$firstname.' '.$lastname.' ('.$cm.')
											</optgroup>
											';
											}

										echo'
											<optgroup label="District '.$reg2.'">
											';
											$query ="SELECT * FROM mlgoo_clgoo WHERE district = '$reg2' ORDER BY firstname ASC";
											$result = mysqli_query($conn, $query);  
											
											while($row = mysqli_fetch_array($result)) {
												$recipient_username = $row['username'];
												$firstname = $row['firstname'];
												$middlename = $row['middlename'];
												$lastname = $row['lastname']; 
												$cm = $row['city_municipality'];
												
												echo' <option value="'.$recipient_username.'">
														'.$firstname.' '.$lastname.' ('.$cm.')
											</optgroup>
											';
										}
									}
								?>
						</select>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-9 col-sm-9 col-lg-10" >
							<div class="form-label-group">
								<label for="datepicker"><span class="opts_title"><b>Deadline</b></span></label>
								<?php
								
								if ($_REQUEST['status'] == 'Expired' OR $_REQUEST['reply'] == 'admin') {
										echo '
											<input style="float: right;" type="text" name="deadline" id="autodeadline" required="required" readonly="readonly" value="'.$_REQUEST['deadline'].'"> ';

									} elseif ($_REQUEST['status'] != 'Expired'){
										echo '
											<input style="float: right;" type="text" name="deadline" id="datepicker" required="required" readonly="readonly"> ';
									}
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-9 col-sm-9 col-lg-10">
							<div class="form-label-group">
								<input type="file" name="file" id="file" required="required">
								<label for="file"><span class="opts_title"><b>Choose File</b></span></label>
							</div>
						</div>
					</div>
				</div>         
				<button class="button upload" style="vertical-align:middle" name="upload"><span>Send Report</span></button>
			</form>

		</div> <!-- container -->	
		<br>
		<br>
		<br>
		<br>
	</div> <!-- container-fluid -->
	<?php include '../include/footer.html' ?>

<script>
$(function() {
	$("#datepicker").datepicker({
		minDate: '0',
		format: 'yyyy-mm-dd',
		maxDate: new Date('<?php echo $dead; ?>'),
	});

	$( "#datepicker" ).datepicker();
	$( "#datepicker" ).datepicker('show');
});
</script>
<script src="notification_staff.js"></script>
</body>
</html>
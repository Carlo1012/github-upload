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


if (isset($_POST['upload'])) {
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
					header("refresh:1 url=report_admin.php");

				}elseif (!in_array($ext,$extensions)) {
					echo "<script>alert('This file extenstion is not accepted.');</script>"; 
					header("refresh:1 url=report_admin.php");

				}elseif (count($errors) === 0) {

					 if(isset($_POST['recipient'])){
						$recipient = $_POST['recipient'];
						foreach ($recipient  as $recipients) { 
							move_uploaded_file($_FILES['file']['tmp_name'], $target);

							mysqli_stmt_bind_param($stmt, "ssss", $username, $recipients, $files, $start_date);
							mysqli_stmt_execute($stmt);
						}
							// echo "<script>alert('Uploaded successfully.');</script>"; 
							// echo '<script type="text/javascript">';
	                        // echo 'setTimeout(function () { swal("SENT","Check your Sentbox!","success");';
	                        // echo '}, 1000);</script>'; 
							header("Location: report_admin.php?r=sent");


					}
	  
				}else {
					foreach($errors as $error) {
						echo '<script>alert("'.$error.'");</script>';
						header("refresh:1 url=report_admin.php");
					}
				}
				mysqli_stmt_close($stmt);
				mysqli_close($conn);
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

	<title>Admin - Report</title>
 	<link rel="icon" type="image/ico" href="../images/logo.png" />
	
		<script src="../vendor/jquery/jquery.min.js"></script>
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- version 3.7.7 -->
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script> <!-- for design -->
		
    	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<!-- for icons -->
    	
    	<script src="../vendor/sweetalert/js/sweetalert.min.js"></script>

		<!-- custom css -->
		<link href="../css/custom2.css" rel="stylesheet">

		<!-- For datepicker -->
		<link href="../vendor/jquery-ui/css/jquery-ui.css" rel="stylesheet">
		<script src="../vendor/jquery-ui/js/jquery-ui.js"></script>

</head>

<body class="container-fluid background">
<?php include('navigation.html'); ?>

	<div class="container-fluid">
		<div class="container box">
			<div class="card-header">
                <i class="fas fa-share-square fa-3x"></i>
                <b>Send Report</b>
            </div>
            <div class="card mb-3">
            
            <div class="row">
                <div class="col-lg-12">
                    <?php if(isset($_GET['r'])): ?>
                            <?php
                                $r = $_GET['r'];
                                if($r=='sent'){
                                        $class='success';   
                                }else if($r=='updated'){
                                        $class='info';  
                                }else if($r=='send'){
                                        $class='success'; 
                                }else if($r=='deleted'){
                                        $class='danger';   
                                }else if($r=='added an account'){
                                        $class='success';   
                                }else{
                                        $class='hide';
                                }
                            ?>
                            <div class="alert alert-<?php echo $class ?> ">
                                    <strong>File successfully <?php echo $r; ?>!</strong>    
                            </div>
                    <?php endif; ?>
                </div>
            </div>
        </div> <!-- card mb-3 -->
            <hr>
			<form class="my-form" autocomplete="off" action="report_admin.php" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<div class="form-row-fluid">
						<div class="col-md-9 col-sm-9 col-lg-10">
							<div class="form-label-group">
								<label for="opt"><span class="opts_title">Staff Name</span></label>
								<!-- <select  class="row opts"  name="opt[]" id="opt" multiple="multiple"> -->
								<?php
									echo'
										<select  class="row opts" id="opt" name="recipient[]" multiple="multiple" required="required">
										<optgroup label="District 1|2">
										';
										$query ="SELECT * FROM staff_info WHERE district_assigned = '1|2' AND active =0 ORDER BY firstname ASC";
										$result = mysqli_query($conn, $query);  
										
										while($row = mysqli_fetch_array($result)) {
											$recipient_username = $row['username'];
											$firstname = $row['firstname'];
											$middlename = $row['middlename'];
											$lastname = $row['lastname']; 
											$district = $row['district_assigned'];
											
											echo' <option value="'.$recipient_username.'">
													'.$firstname.' '.$lastname.' 
										</optgroup>
										';
										}

									echo'
										<optgroup label="District 3|4">
										';
										$query ="SELECT * FROM staff_info WHERE district_assigned = '3|4' AND active =0 ORDER BY firstname ASC";
										$result = mysqli_query($conn, $query);  
										
										while($row = mysqli_fetch_array($result)) {
											$recipient_username = $row['username'];
											$firstname = $row['firstname'];
											$middlename = $row['middlename'];
											$lastname = $row['lastname']; 
											$district = $row['district_assigned'];

											echo' <option value="'.$recipient_username.'">
													'.$firstname.' '.$lastname.' 
										</optgroup>
										
										

										';
										}
								?>+
								<!-- <input type="button" id="select_all" name="select_all" value="Select All">
								<input type="button" id="deselect_all" name="deselect_all" value="Deselect All"> -->
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-9 col-sm-9 col-lg-10" >
							<div class="form-label-group">
								<label for="deadline"><span class="opts_title"><b>Deadline</b></span></label>
								<input style="float: right;" type="text" name="deadline" id="datepicker" required="required" readonly="readonly">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-9 col-sm-9 col-lg-10">
							<div class="form-label-group">
								<input type="file" name="file" id="file" required="required" >
								
								<label for="file"><span class="opts_title"><b>Choose File</b></span></label>
							</div>
						</div>
					</div>
				</div>         
				<button class="button upload" style="vertical-align:middle" name="upload"><span>Send Report </span></button>
			</form>

		</div> <!-- container -->
	</div> <!-- container-fluid -->
	<?php include '../include/footer.html' ?>

<script src="../include/notification_admin.js"></script>
<script >
	$(function() {
		$("#datepicker").datepicker({
			minDate: '0',
			format: 'yyyy/mm/dd',
		});
		$( "#datepicker" ).datepicker();
		$( "#datepicker" ).datepicker('show');
	});
</script>

<script type="text/javascript">

	$('#select_all').click( function() {
    $('#opt option').prop('selected', true);
	});

	$('#deselect_all').click( function() {
    $('#opt option').prop('selected', false);
	});

</script>
</body>
</html>
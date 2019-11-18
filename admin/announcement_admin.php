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

$result_announcement = mysqli_query($conn, "SELECT * FROM announcement_admin");

if(isset($_POST['post'])) {

	$type = mysqli_real_escape_string($conn, $_POST['type']);
	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$content = mysqli_real_escape_string($conn, $_POST['content']);
	$remove = array('\n', '\r');
	$content_save = str_replace($remove, ' ', $content);
	$image = $_FILES['choose_image']['name'];
	$target = "../announcement/announcement_image/".basename($image);
	
	$query_run = "INSERT INTO announcement_admin (title, type, content, image) VALUES (?, ?, ?, ?)";
	$stmt =mysqli_stmt_init($conn);

	if(empty($type)){
		echo "<script>alert('Please choose the Type.');</script>";    
	}elseif(empty($title)){
		echo "<script>alert('Please insert title.');</script>";   
	}elseif(empty($content_save)){
		echo "<script>alert('Please insert content.');</script>";     
	}elseif(empty($image)){
		echo "<script>alert('Please insert image.');</script>";  
	}else{    
		if (!mysqli_stmt_prepare($stmt, $query_run)) {
				echo "<script>alert('Try Again');</script>"; 
				echo $query_run;
				exit();
			} else {
			$errors     = array();
			move_uploaded_file($_FILES['choose_image']['tmp_name'], $target);

			mysqli_stmt_bind_param($stmt, "ssss", $title, $type, $content_save	, $image);
			mysqli_stmt_execute($stmt);

			echo '<script type="text/javascript">';
			echo 'setTimeout(function () { swal("POSTED","Successfully Posted!","success");';
			echo '}, 1000);</script>';
			// echo "<script>alert('Uploaded successfully.');</script>";
			// header("refresh:1 url=announcement_admin.php");
		}
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
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
  <link href="../vendor/fontawesome-free/css/all.css" rel="stylesheet"> <!-- for icons -->

  <script src="../vendor/sweetalert/js/sweetalert.min.js"></script>
  

  <!-- custom css -->
  <link href="../css/custom2.css" rel="stylesheet">
  <style type="text/css">
  .box
  {
   width:1270px;
   padding:20px;
   background-color:#fff;
   border:1px solid #ccc;
   border-radius:5px;
   margin-top:25px;
   box-sizing:border-box;
  }
  </style>
</head>

<body class="container-fluid background">
<?php include('navigation.html'); ?>


  <div class="container-fluid">
	<?php
		if(mysqli_num_rows($result_announcement) > 0) {
			while ($row = mysqli_fetch_array($result_announcement)) {
			$id = $row['id'];
			$title = $row['title'];
			$content = $row['content'];
			$image =$row['image'];
			}
		}
	?>
	<div class="container box">
			<span class="send_report_title col-xs-12 col-sm-12 col-md-12 col-lg-12"><h3>Created Announcement/News/Events</h3></span><hr>
			<form class="my-form" autocomplete="off" action="announcement_admin.php" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="form-label-group">
								<label for="type"><span class="opts_title">Type:</span></label>
								<select  class="dropdown_announcement" name="type">
									<option value="Announcement">Announcement</option>
									<option value="News">News</option>
									<option value="Events">Events</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-lg-12" >
							<div class="form-label-group">
								<label for="title"><span class="opts_title"><b>Title:</b></span></label>
								<input style="float: right;" type="text" name="title" id="title" placeholder="Enter title here" required="required">

							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
							<label for="description"><span class="opts_title"><b>Description:</b></span></label>
							<div class="form-label-group">
									<textarea style="float: left; width: 100%" 
									id="text" 
									rows="19" 
									name="content"
									id="content"
									required="required"></textarea>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
							<label for="addimage"><span class="opts_title"><b>Add Image:</b></span></label>
							<div class="form-label-group">
								<input type="file" required="required" name="choose_image" onchange="showImage.call(this)" >
								<img src="" style="display: none;" height="250" width="300" name="image" id="image">
							</div>
						</div>
					</div>
				</div>
				<button class="button upload" style="vertical-align:middle" name="post"><span>Post</span></button>
			</form>
		</div> <!-- container -->
  </div> <!-- container-fluid -->
	<?php include'../include/footer.html'; ?>

<script src="../include/notification_admin.js"></script>
  <script type="text/javascript">
	function showImage() {
		if(this.files && this.files[0]) {
			var obj = new FileReader();
				obj.onload = function(data){
				  var image = document.getElementById("image");
				  image.src = data.target.result;
				  image.style.display = "block";
				}
		obj.readAsDataURL(this.files[0]);
		}
	}
  </script>
</body>
</html>
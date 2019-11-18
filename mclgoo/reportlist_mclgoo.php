
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
  $municipality = $row['city_municipality'];
	
}

// $query_upload ="SELECT * FROM uploaded_files WHERE sender = '$username' OR recipient = '$username'";
$result_upload_sentbox = mysqli_query($conn, "SELECT * FROM uploaded_files WHERE sender = '$username'");
$result_upload_inbox = mysqli_query($conn, "SELECT * FROM uploaded_files WHERE recipient = '$username'");

?>   

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Mlgoo/Clgoo Reports</title>
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
				<i class="fas fa-file-alt fa-3x"></i>
				<b>Inbox</b>
				</div><br>
				<div class="card-body">
						<div class="table-responsive" border="5px">  
								<table id="inbox" class="table table-striped uk-table-hover">  
										<thead>  
												<tr> 
														<td>#</td>
														<td>Sender</td>  
														<td>Recipient</td>  
														<td>File_Name</td>  
														<td>Date Submitted</td>  
														<td>Status</td>
														<td>Action</td>

												</tr>  
										</thead>  
										<?php  
										$count = 1;
												
										while($row = mysqli_fetch_array($result_upload_inbox)) {
												$id = $row['id'];  
												$sender = $row['sender'];
												$recipient  = $row['recipient'];
												$filename = $row['file_name'];
												$date   = $row['dates'];
												$deadline  = $row['deadline'];
												$status = $row['status'];
												 
												// $ans='';

												// if($status=='1'){
												// 		$ans ='Done';
												// }elseif ($status=='2') {
												// 		$ans ='Revise';
												// }else {
												// 		$ans ='Ongoing';
												// }
												
												
 $current = strtotime(date("Y-m-d"));
 $dates    = strtotime($deadline);

 $datediff = $dates - $current;
 $difference = floor($datediff/(60*60*24));
 if($difference==0)
 {
    // echo 'today';
    // $ans = 'Ongoing';
 }
 else if($difference > 1)
 {  
    // $ans = 'Ongoing';

    // echo 'Future Date';
 }
 else if($difference > 0)
 {
  // $ans = 'Advance';
    // $ans = 'Ongoing';

    // echo 'tomarrow';
 }
 else if($difference < -1)
 {
    // echo 'Long Back';
  // $ans = 'Expired';
//  }
//   else if($status=='2')
//  {
//   $ans ='Revise';
//  }
//   else if($status=='1')
//  {
//   $ans ='Done';
 }
 else
 {  
  // $ans = 'Expired';
    // echo 'yesterday';
 }  

               $ans=''; 
                      if($status=='0'){
                        if ($difference < 0) {
                        $ans ='Expired';
                        } else {
                        $ans ='Ongoing';
                        }
                      }elseif ($status=='1') {
                        $ans ='Done';
                      }elseif ($status=='2') {
                        $ans ='Revised';
                      }elseif ($difference < 0) {
                        $ans ='Expired';
                      }else{
                        $ans ='Expired';
                      }
												
												
												
												
												

											echo '  
														<tr>  
															<td>'.$count.'</td>
															<td>'.$sender.'</td>  
															<td>'.$recipient.'</td>  
															<td><a download href="../files_upload/'.$filename.'">'.$filename.'</a></td>  
															<td>'.$date.'</td>  
															<td><b>'.$ans.'</b></td>
															<td>
																<a href="report_mclgoo.php?&id='.$row['id'].' &deadline='.$row['deadline'].' &filename='.$row['file_name'].' &sender='.$row['sender'].' " title="Reply"><i class="far fa-share-square fa-2x"></i></a>
															</td>

														</tr>  
														'; 
											$count++; 
										}  
										?>  
								</table> <!-- uploaded_files -->
						</div>  <!-- table-responsive -->
				</div>
			</div><br><br>  <!-- container box  -->   

				<div class="container box">
						<div class="card-header">
						<i class="fas fa-file-alt fa-3x"></i>
						<b>SentBox</b>
						</div>
						<div class="card-body">
								<div class="table-responsive" border="5px">  
									<table id="sentbox" class="table table-striped uk-table-hover">  
										<thead>  
										 <tr> 
											<td>#</td>
											<td>Sender</td>  
											<td>Recipient</td>  
											<td>File_Name</td>  
											<td>Date Submitted</td>  
											<td>Status</td>
										 </tr>  
										</thead>  
										<?php  
										$count = 1;
												
										while($row = mysqli_fetch_array($result_upload_sentbox)) {
												$id = $row['id'];  
												$sender = $row['sender'];
												$recipient  = $row['recipient'];
												$filename = $row['file_name'];
												$date   = $row['dates'];
												$deadline  = $row['deadline'];
												$status = $row['status'];
												 
												$ans='';

												// if($status=='1'){
												// 		$ans ='Done';
												// }elseif ($status=='2') {
												// 		$ans ='Revise';
												// }else {
												// 		$ans ='Ongoing';
												// }
												
												
												
 $current = strtotime(date("Y-m-d"));
 $dates    = strtotime($deadline);

 $datediff = $dates - $current;
 $difference = floor($datediff/(60*60*24));
 if($difference==0)
 {
    // echo 'today';
    // $ans = 'Ongoing';
 }
 else if($difference > 1)
 {  
    // $ans = 'Ongoing';

    // echo 'Future Date';
 }
 else if($difference > 0)
 {
  // $ans = 'Advance';
    // $ans = 'Ongoing';

    // echo 'tomarrow';
 }
 else if($difference < -1)
 {
    // echo 'Long Back';
  // $ans = 'Expired';
//  }
//   else if($status=='2')
//  {
//   $ans ='Revise';
//  }
//   else if($status=='1')
//  {
//   $ans ='Done';
 }
 else
 {  
  // $ans = 'Expired';
    // echo 'yesterday';
 }  

               $ans=''; 
                      if($status=='0'){
                        if ($difference < 0) {
                        $ans ='Expired';
                        } else {
                        $ans ='Ongoing';
                        }
                      }elseif ($status=='1') {
                        $ans ='Done';
                      }elseif ($status=='2') {
                        $ans ='Revised';
                      }elseif ($difference < 0) {
                        $ans ='Expired';
                      }else{
                        $ans ='Expired';
                      }
												
												

											echo '  
														<tr>  
															<td>'.$count.'</td>
															<td>'.$sender.'</td>  
															<td>'.$recipient.'</td>  
															<td><a download href="../files_upload/'.$filename.'">'.$filename.'</a></td>  
															<td>'.$date.'</td>  
															<td><b>'.$ans.'</b></td>
														</tr>  
													'; 
											$count++; 
										}  
										?>  
									</table> <!-- uploaded_files -->
								</div>  <!-- table-responsive -->
						</div> <!-- card-body -->
				</div> <!-- container box  -->     
			</div>
		</div> <!-- /.container-fluid -->
		<br>
		<br>  
		<?php include '../include/footer.html' ?> 
<script>
$(document).ready(function(){  
		$('#inbox').DataTable();  
		$('#sentbox').DataTable();  

}); 
</script>
<script src="notification_mlgoo.js"></script>   
 
</body>
</html>
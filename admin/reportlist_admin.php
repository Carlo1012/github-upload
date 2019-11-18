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

$result_inbox = mysqli_query($conn, "SELECT * FROM uploaded_files WHERE del = '0' AND recipient ='$username'");
$result_sentbox = mysqli_query($conn, "SELECT * FROM uploaded_files WHERE del = '0' AND sender ='$username'");
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
   
    <!-- custom css -->
    <link href="../css/custom2.css" rel="stylesheet">

    <!-- <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>  
    <link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="../vendor/datatables/js/dataTables.bootstrap.min.js"></script>  -->

		<script src="../vendor/datatables/js/UIKit.jquery.dataTables.min.js"></script>  
    <script src="../vendor/datatables/js/dataTables.uikit.min.js"></script> 
    <link href="../vendor/datatables/css/uikit.min.css" rel="stylesheet">
    <link href="../vendor/datatables/css/dataTables.uikit.min.css" rel="stylesheet">
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
 
  </style>
</head>

<body class="container-fluid background">
<?php include('navigation.html'); ?>
    <div class="container-fluid">
        <div class="card mb-3">
            
            <div class="row">
                <div class="col-lg-12">
                    <?php if(isset($_GET['r'])): ?>
                            <?php
                                $r = $_GET['r'];
                                if($r=='added'){
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

        <div class="container box">
            <div class="card-header">
                <i class="fas fa-inbox fa-3x"></i>
                <b>INBOX</b>
            </div>
            <!-- <div class="table-responsive" border="5px">   -->
                <table id="uploaded_files_inbox" class="table table-striped uk-table-hover" >  
                    <thead>  
                        <tr> 
                            <td><b>#</b></td>
                            <td><b>Sender</b></td>  
                            <td><b>Recipient</b></td>  
                            <td><b>File_Name</b></td>  
                            <td><b>Date Submitted</b></td>  
                            <td><b>Deadline</b></td>
                            <td><b>Status</b></td>
                            <td><b>Action</b></td>  
                        </tr>  
                    </thead>  
                    <?php  
                     $count = 1;

                    while($row = mysqli_fetch_array($result_inbox)) {
                        $id = $row['id'];  
                        $sender = $row['sender'];
                        $recipient  = $row['recipient'];
                        $filename = $row['file_name'];
                        $date   = $row['dates'];
                        $deadline  = $row['deadline'];
                        $status = $row['status'];
                         

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




                        // $ans=''; 
                        //     if($status=='1'){
                        //         $ans ='Done';
                        //     }elseif ($status=='2') {
                        //         $ans ='Revised';
                        //     }else {
                        //         $ans ='Ongoing';
                        //     }
                              
                        if ($status =='1') {
                            echo    '<tr>  
                                    <td>'.$count.'</td>
                                    <td>'.$sender.'</td>  
                                    <td>'.$recipient.'</td>  
                                    <td><a download href="../files_upload/'.$filename.'">'.$filename.'</a></td>  
                                    <td>'.$date.'</td>  
                                    <td>'.$deadline.'</td> 
                                    <td><b>'.$ans.'</b></td>
                                    <td>

                                        <a href="status_update.php?&id='.$row['id'].'&page='.'delete'.' " title="Remove"><i class="far fa-trash-alt fa-2x"></i></a>

                                    </td>  
                                </tr>'; 

                        }elseif ($ans =='Expired') {
                            echo    '<tr>  
                                    <td>'.$count.'</td>
                                    <td>'.$sender.'</td>  
                                    <td>'.$recipient.'</td>  
                                    <td><a download href="../files_upload/'.$filename.'">'.$filename.'</a></td>  
                                    <td>'.$date.'</td>  
                                    <td>'.$deadline.'</td> 
                                    <td><b>'.$ans.'</b></td>
                                    <td>
                                    <a href="status_update.php?&id='.$row['id'].'&page='.'delete'.' " title="Remove"><i class="far fa-trash-alt fa-2x"></i></a>

                                    </td>  
                                </tr>';
                        } else {
                            echo    '<tr>  
                                    <td>'.$count.'</td>
                                    <td>'.$sender.'</td>  
                                    <td>'.$recipient.'</td>  
                                    <td><a download href="../files_upload/'.$filename.'">'.$filename.'</a></td>  
                                    <td>'.$date.'</td>  
                                    <td>'.$deadline.'</td> 
                                    <td><b>'.$ans.'</b></td>
                                    <td>
                                        <a href="status_update.php?&id='.$row['id'].' &deadline='.$row['deadline'].' &file_name='.$row['file_name'].' &sender='.$row['sender'].' &page='.'done'.' " title="Done"><i class="fas fa-check fa-2x"></i></a>&nbsp;

                                        <a href="status_update.php?&id='.$row['id'].' &page='.'revise'.'  " title="Revise"><i class="fas fa-exclamation-triangle fa-2x text-danger confirmation"></i></a>&nbsp;

                                        <a href="status_update.php?&id='.$row['id'].'&page='.'delete'.' " title="Remove"><i class="far fa-trash-alt fa-2x "></i></a>
                                    </td>  
                                </tr>'; 
                        }     

                        $count++; 
                    }  
                    ?>  
                </table>  
            <!-- </div>  table-responsive -->
        </div> <!-- card-body -->

        <br><br>
        
        <div class="container box">
            <div class="card-header">
                <i class="fas fa-share-square fa-3x"></i>
                <b>SENTBOX</b>
            </div>
            <div class="table-responsive">  
                <table id="uploaded_files_sentbox"  class="table table-striped uk-table-hover" >  
                    <thead>  
                        <tr> 
                            <td><b>#</b></td>
                            <td><b>Sender</b></td>  
                            <td><b>Recipient</b></td>  
                            <td><b>File Name</b></td>  
                            <td><b>Date Submitted</b></td>  
                            <td><b>Deadline</b></td>
                            <td><b>Status</b></td>
                            <td><b>Action</b></td>  
                        </tr>  
                    </thead>  
                    <?php  
                        $count = 1;
                        while($row = mysqli_fetch_array($result_sentbox)) {
                            $id = $row['id'];  
                            $sender = $row['sender'];
                            $recipient  = $row['recipient'];
                            $filename = $row['file_name'];
                            $date   = $row['dates'];
                            $deadline  = $row['deadline'];
                            $status = $row['status'];
                             
                            // $ans=''; 
                            //     if($status=='1'){
                            //         $ans ='Done';
                            //     }elseif ($status=='2') {
                            //         $ans ='Revise';
                            //     }else {
                            //         $ans ='Ongoing';
                            //     }
                            
                            
                            
                            
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

                            
                            

                                echo    '<tr> 
                                            <td>'.$count.'</td>
                                            <td>'.$sender.'</td>  
                                            <td>'.$recipient.'</td>  
                                            <td><a download href="../files_upload/'.$filename.'">'.$filename.'</a></td>  
                                            <td>'.$date.'</td>  
                                            <td>'.$deadline.'</td> 
                                            
                                            <td>'.$ans.'</td>
                                            <td>
                                            <!-- <a href="status_update.php?&id='.$row['id'].'&page='.'done'.' " title="Done"><i class="fas fa-check fa-2x"></i></a>&nbsp;

                                                <a href="status_update.php?&id='.$row['id'].'&page='.'revise'.' " title="Revise"><i class="fas fa-exclamation-triangle fa-2x text-danger confirmation"></i></a>&nbsp;  -->

                                                <a href="status_update.php?&id='.$row['id'].'&page='.'delete'.' " title="Remove"><i class="far fa-trash-alt fa-2x"></i></a>
                                            </td> 
                                        </tr>';
                            $count++; 
                        }  
                    ?>  
                </table>  
            </div>  <!-- table-responsive -->
        </div> <!-- card-body -->
    </div> <!-- /.container-fluid -->
    <?php include '../include/footer.html' ?>
    
<script src="../include/notification_admin.js"></script>
<script type="text/javascript">
$(document).ready(function(){  
    $('#uploaded_files_inbox').DataTable();  
    $('#uploaded_files_sentbox').DataTable();  
}); 
</script>
</body>
</html>
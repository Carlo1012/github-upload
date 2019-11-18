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

$result_sentbox = mysqli_query($conn, "SELECT * FROM uploaded_files");
$result_inbox = mysqli_query($conn, "SELECT * FROM uploaded_files");

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

    <!-- <link href="../vendor/fontawesome-free/css/all.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
     <!-- for icons -->
   
    <!-- custom css -->
    <link href="../css/custom2.css" rel="stylesheet">

    <script src="../vendor/datatables/js/UIKit.jquery.dataTables.min.js"></script>  
    <script src="../vendor/datatables/js/dataTables.uikit.min.js"></script> 
    <link href="../vendor/datatables/css/uikit.min.css" rel="stylesheet">
    <link href="../vendor/datatables/css/dataTables.uikit.min.css" rel="stylesheet">
<style type="text/css">
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  
    img {
    padding: 15px;
    float: right;
    padding-right: unset;
    max-width: 100%;
}

.container.announcements {
    margin-top: 250px;
}

p.card-text:hover {
  background-color: #f1f1f1;
}


</style>
</head>

<body class="container-fluid background">
<?php include('navigation.html'); ?>
    <div class="container-fluid header">
            <h1 style="font-family: Signika">All Reports</h1>
        </div>
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
            <div class="table-responsive" border="5px">  
                <table id="uploaded_files_inbox" class="table table-striped uk-table-hover" >  
                    <thead>  
                        <tr> 
                            <td>#</td>
                            <td>Sender</td>  
                            <td>Recipient</td>  
                            <td>File_Name</td>  
                            <td>Date Submitted</td>  
                            <td>Deadline</td>
                            <!--<td>Status</td>-->
                            <td>Action</td>
                            
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
                         
                        // $ans=''; 
                        //     if($status == '1'){
                        //         $ans ='Done';
                        //     }elseif ($status=='2') {
                        //         $ans ='Revise';
                        //     }else {
                        //         $ans ='Ongoing';
                        //     }
                              
                        // if ($status =='1') {
                            echo    '<tr>  
                                    <td>'.$count.'</td>
                                    <td>'.$sender.'</td>  
                                    <td>'.$recipient.'</td>  
                                    <td><a download href="../files_upload/'.$filename.'">'.$filename.'</a></td>  
                                    <td>'.$date.'</td>  
                                    <td>'.$deadline.'</td> 
                                    <td><a href="status_update.php?&id='.$row['id'].'&page='.'deleted'.' " title="Remove"><i class="far fa-trash-alt fa-2x"></i></a></td>
                                    
                                     

                                   
                                </tr>'; 
                        // } else {
                        //     echo    '<tr>  
                        //             <td>'.$count.'</td>
                        //             <td>'.$sender.'</td>  
                        //             <td>'.$recipient.'</td>  
                        //             <td><a download href="../files_upload/'.$filename.'">'.$filename.'</a></td>  
                        //             <td>'.$date.'</td>  
                        //             <td>'.$deadline.'</td> 
                        //             <td><b>'.$ans.'</b></td>
                        //             <td><b>Delete</b></td>
                                    
                        //         </tr>'; 
                        // }     
                        $count++; 
                    }  
                    ?>  
                </table>  
            </div>  <!-- table-responsive -->
        </div> <!-- card-body -->

        <br><br>
       
        <div class="container box">
             <div class="card-header">
                <i class="fas fa-share-square fa-3x"></i>
                <b>SENTBOX</b>
            </div>
            <div class="table-responsive" border="5px">  
                <table id="uploaded_files_sentbox" class="table table-striped uk-table-hover" >  
                    <thead>  
                        <tr> 
                            <td>#</td>
                            <td>Sender</td>  
                            <td>Recipient</td>  
                            <td>File Name</td>  
                            <td>Date Submitted</td>  
                            <td>Deadline</td>
                            <td>Action</td>
                           
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
                            //     $ans ='Done';
                            //     }elseif ($status=='2') {
                            //          $ans ='Revise';
                            //     }else {
                            //          $ans ='Ongoing';
                            //     }

                                echo    '<tr> 
                                     
                                            <td>'.$count.'</td>
                                            <td>'.$sender.'</td>  
                                            <td>'.$recipient.'</td>  
                                            <td><a download href="../files_upload/'.$filename.'">'.$filename.'</a></td>  
                                            <td>'.$date.'</td>  
                                            <td>'.$deadline.'</td> 
                                           <td><a href="status_update.php?&id='.$row['id'].'&page='.'deleted'.' " title="Remove"><i class="far fa-trash-alt fa-2x"></i></a></td>
                                    
                                           
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
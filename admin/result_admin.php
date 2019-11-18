<?php
include '../include/connect.php'; 

$query = "SELECT * FROM tblapplicants WHERE status = 'approved'";
$query_run =  mysqli_query($conn, $query);
  
 if (isset($_REQUEST['page'])) {
    
  if($_REQUEST['page']=='delete') {
    $query1 = "UPDATE tblapplicants SET status = 'deleted' WHERE id = '".$_REQUEST['id']."' "; //change to udate query
    mysqli_query($conn, $query1);
    header("refresh:1 url=result_admin.php?r=deleted");

    }elseif($_REQUEST['page']=='approved') {
    $query = "UPDATE tblapplicants SET status = 'approved' WHERE id = '".$_REQUEST['id']."' ";
    header("refresh:1 url=company_view.php?r=approved");

    $query_run = mysqli_query($conn, $query);

  
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

  <script src="../vendor/jquery/jquery.min.js"></script>
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> <!-- for design -->

  <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>  
  <link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="../vendor/datatables/js/dataTables.bootstrap.min.js"></script> 

  <style>

  .navbar-inverse {
    background-color: #1eaf29bf;
    border-color: #080808;
  }

  .navbar-inverse .navbar-nav>li>a {
    color: #060606;
  }

  </style>
</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">

      <ul class="nav navbar-nav">
        <li><a href="reports.php" >Manage Reports </a></li>
         <li><a href="company/company.php" >Company</a></li>
         <li><a href="result_admin.php" >Results</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../production/log_out.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </nav>

<img src="../img/image.png" width="250px" height="90px" style="margin-left:2%" >
<img src="../img/header.png" width="700px" height="100px" style="margin-left:2%">

  <h1 align="center">Results</h1>
  <div class="container" style="height:30px">
    <div class="row">
      <div class="col-lg-12">
        <?php 
          if(isset($_GET['r'])): ?>
            <?php
                $r = $_GET['r'];
                if($r=='added'){
                        $class='success';   
                }else if($r=='updated'){
                        $class='info';   
                }else if($r=='deleted'){
                        $class='danger';   
                }else if($r=='approved'){
                        $class='success';   
                }else{
                        $class='hide';
                }
            ?>
            <div class="alert alert-<?php echo $class ?> ">
                    <strong>Successfully <?php echo $r; ?>!</strong>    
            </div>
        <?php endif; ?>
        </div>
      </div>
  </div>
    
    <div class="container-fluid">
      <br>
      <br>
      <br>
        <div class="card-body">
            <div class="table-responsive" border="5px">  
                <table id="result" class="table table-striped table-bordered" >  
                    <thead>  
                      <tr> 
                        <td><b>#</b></td>
                        <td><b>First Name</b></td>  
                        <td><b>Last Name</b></td>  
                        <td><b>Address</b></td>  
                        <td><b>Company</b></td>  
                        <td><b>Action</b></td>  
                      </tr>  
                    </thead>  
                    <?php  
                      $count = 1;

                      while($row = mysqli_fetch_array($query_run)) {
                        $id = $row['id'];  
                        $firstname = $row['fname'];
                        $lastname  = $row['lname'];
                        $company = $row['company'];
                                
                        echo'
                            <tr>  
                              <td>'.$count.'</td>
                              <td>'.$firstname.'</td>
                              <td>'.$lastname.'</td>';  

                              $query1 ="SELECT * FROM user WHERE company_name = '$company' ";
                              $result = mysqli_query($conn, $query1);  
                                    
                              while($row = mysqli_fetch_array($result)) {
                                $address = $row['address'];

                                echo '
                                    <td>'.$address.'</td>';
                              }

                              echo '
                                  <td>'.$company.'</td>  
                                  <td> <a class="btn btn-danger btn-xs delete" href="result_admin.php?&id='.$id.'&page='.'delete'.' " title="Delete">Delete</a></td>  
                            </tr>'; 
                        $count++; 
                      }  
                    ?>  
                </table>  
            </div>  <!-- table-responsive -->
        </div> <!-- card-body -->
    </div> <!-- /.container-fluid -->
    
<script type="text/javascript">
$(document).ready(function(){  
    $('#result').DataTable();  
}); 
</script>
</body>
</html>
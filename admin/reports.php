<?php
  include '../include/connect.php';
  $cmd = mysqli_query($conn, "SELECT * FROM tblapplicants WHERE status = 'endorse' ");
  $select = mysqli_query($conn, "SELECT * FROM user");

if (isset($_POST['uploads'])) {
  $id = $_POST['id'];
  $company_name = $_POST['company'];

  mysqli_query($conn, "UPDATE tblapplicants SET company ='$company_name'   WHERE id = '$id' ") or die("Can't connect to database");
  $e = "endorsed";

  mysqli_query($conn, "UPDATE tblapplicants SET status ='$e' WHERE `id` = $id") or die("Can't connect to database");
    echo "<script>alert('Endorsed successfully.');</script>"; 
    // header("refresh:1 url=reports.php?r=endorsed");
    echo "<script>window.location.href='reports.php?r=endorsed'</script>";
}

 if (isset($_REQUEST['page'])) {
    
  if($_REQUEST['page']=='delete') {
    $query1 = "UPDATE tblapplicants SET status = 'deleted' WHERE id = '".$_REQUEST['id']."' "; //change to udate query
    mysqli_query($conn, $query1);
    header("refresh:1 url=reports.php?r=deleted");

    }elseif($_REQUEST['page']=='approved') {
    $query = "UPDATE tblapplicants SET status = 'approved' WHERE id = '".$_REQUEST['id']."' ";
    header("refresh:1 url=company_view.php?r=approved");

    $query_run = mysqli_query($conn, $query);

  
    }
  }
?>
<html>
<head>
	<title> Reports </title>
	<!-- <link rel="stylesheet" href="../css/w3.css"> -->

    <script src="../vendor/jquery/jquery.min.js"></script>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- version 3.7.7 -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> <!-- for design -->

    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>  
    <link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="../vendor/datatables/js/dataTables.bootstrap.min.js"></script> 

<style>
  .navbar-inverse {
  background-color: #1eaf29bf;
  border-color: unset;
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

<a href="admin.php"><img class="w3-image" src="../img/image.png" width="250px" height="90px" style="margin-left:2%" ></a>
<img class="w3-image" src="../img/header.png" width="700px" height="100px" style="margin-left:2%">
<div class="container" style="height:30px">
  <div class="row">
    <div class="col-lg-12">
      <?php 
        if(isset($_GET['r'])): ?>
          <?php
              $r = $_GET['r'];
              if($r=='endorsed'){
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
      <table id="applied" class="table table-striped table-bordered" >  
        <thead>  
            <tr> 
                <td><b>#</b></td>
                <td><b>First Name</b></td>  
                <td><b>Last Name</b></td>  
                <td><b>Address</b></td>  
                <td><b>Contact</b></td>  
                <td><b>Desired Position</b></td>  
                <td><b>Company</b></td>  
                <td><b>Action</b></td>  
            </tr>  
        </thead>  
          
        <?php  
          $count = 1;

          while($row = mysqli_fetch_array($cmd)) {
              $id = $row['id'];  
              $firstname = $row['fname'];
              $lastname  = $row['lname'];
              $address = $row['adress'];
              $contact = $row['phone_no'];
              // $position = $row['position'];
              $company = $row['company'];
                    
              echo  
                  '<tr>  
                      <td>'.$count.'</td>
                      <td>'.$firstname.'</td>
                      <td>'.$lastname.'</td>
                      <td>'.$address.'</td>
                      <td>'.$contact.'</td>
                      <td>
                      ';

              ?>
                  <form action="reports.php" method="POST">
                  <select  name="company">
                  <?php   
                    $query ="SELECT * FROM user";
                    $result = mysqli_query($conn, $query);  
                    
                      while($row = mysqli_fetch_array($result)) {
                        $company_name = $row['company_name'];
                  ?>                        

                   <option style="text-align: center;" value="<?php echo $company_name; ?>"><?php echo $company_name; ?></option>
                  <?php
                    }
                  ?>
                  </select>
                    <input type="hidden" value="<?php echo $id; ?>" name="id">
                    </td>
                    <td> <button class="button upload" style="vertical-align:middle" name="uploads"><span>Endorse </span></button></td>
                  </form>
              <?php
              echo'  <td> 
                        <a class="btn btn-danger btn-xs delete" href="reports.php?&id='.$id.'&page='.'delete'.' " title="Delete">Delete</a></td>    
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
    $('#applied').DataTable();  
}); 
</script>
</body>
</html>
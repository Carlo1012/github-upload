<?php
session_start();

    include '../include/connect.php';
    $username= $_SESSION['user_name'];

    $cmd = mysqli_query($conn, "SELECT * FROM tblapplicants WHERE status = 'endorsed' AND company = '$username'");

 if (isset($_REQUEST['page'])) {
    
  if($_REQUEST['page']=='delete') {
    $query = "UPDATE tblapplicants SET status = 'deleted' WHERE id = '".$_REQUEST['id']."' "; //change to udate query
    mysqli_query($conn, $query);
    header("refresh:1 url=company_view.php?r=deleted");
    
    
    }elseif($_REQUEST['page']=='revise') {
    $query = "UPDATE tblapplicants SET status = '0' WHERE id = '".$_REQUEST['id']."' ";
    mysqli_query($conn, $query);
    header("refresh:1 url=company_view.php?r=updated");

    }elseif($_REQUEST['page']=='approved') {
    $query = "UPDATE tblapplicants SET status = 'approved' WHERE id = '".$_REQUEST['id']."' ";
    header("refresh:1 url=company_view.php?r=approved");

    $query_run = mysqli_query($conn, $query);

  
    }
  }
    ?>

<html>
<head>
  <title> iSource </title>
  <!-- <link rel="stylesheet" href="css/w3.css"> -->

    <script src="../vendor/jquery/jquery.min.js"></script>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>  
    <script src="../vendor/datatables/js/dataTables.bootstrap.min.js"></script> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


  <style>

  body {
    margin:0;
    padding:0;
    background-color:#f1f1f1;
  }

  .box {
     width:1270px;
     padding:20px;
     background-color:#fff;
     border:1px solid #ccc;
     border-radius:5px;
     margin-top:25px;
     box-sizing:border-box;
  }

    .navbar-inverse {
    background-color: #1eaf29bf;
    border-color: unset;
    }

    .navbar-inverse .navbar-nav>li>a {
    color: #060606;
    }
  </style>

</head>
<body style="background: #fff; background-size:100% 100%">
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">

      <ul class="nav navbar-nav">
        <li><a href="company_view.php" class=" w3-bar-item">Endorsed</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../production/log_out.php"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
      </ul>
    </div>
  </nav>

  <img src="../img/image.png" width="250px" height="90px" style="margin-left:2%" >
  <img src="../img/header.png" width="700px" height="100px" style="margin-left:2%">
  <br>

  <div class="container" style="height:30px">
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

<div class="container-fluid" style="background-color: #e0f9e28f;">
  <div class="container box">
    <div class="table-responsive" border="5px">  
      <h1 style="text-align: center;"><?php echo strtoupper($username);?>  </h1>
        <table id="endorsed" class="table table-striped table-bordered" >  
                    <thead>  
                        <tr> 
                            <td><b>#</b></td>
                            <td><b>First Name</b></td>  
                            <td><b>Middle Name</b></td>  
                            <td><b>Last Name</b></td> 
                            <td><b>Address</b></td>  
                            <td><b>Age</b></td>
                            <td><b>Date Applied</b></td>  
                            <td><b>Contact</b></td>  
                            <td><b>Education</b></td>  
                            <td><b>Course</b></td>  
                            <td><b>Last School</b></td>  
                            <td><b>Action</b></td>  
                        </tr>  
                    </thead>  
                    <?php  
                     $count = 1;

                    while($row = mysqli_fetch_array($cmd)) {
                        $id = $row['id'];  
                        $fname = $row['fname'];
                        $mname  = $row['mname'];
                        $lname = $row['lname'];
                        $address  = $row['adress'];
                        // $email   = $row['email'];
                        $age  = $row['age'];
                        $date_applied = $row['date_applied'];
                        $contact = $row['phone_no'];  
                        $education = $row['education'];  
                        $course = $row['course'];  
                        $last_school = $row['last_school'];   
                        
                             echo    '<tr>  
                                    <td>'.$count.'</td>
                                    <td>'.$fname.'</td>  
                                    <td>'.$mname.'</td>  
                                    <td>'.$lname.'</td>  
                                    <td>'.$address.'</td> 
                                    <td>'.$age.'</td> 
                                    <td>'.$date_applied.'</td> 
                                    <td>'.$contact.'</td> 
                                    <td>'.$education.'</td> 
                                    <td>'.$course.'</td> 
                                    <td>'.$last_school.'</td> 
                             
                                    <td>
                                        <a href="company_view.php?&id='.$row['id'].' &page='.'approved'.' " title="Approved"><i class="fas fa-check fa-2x"></i></a>&nbsp;

                                        <a href="company_view.php?&id='.$row['id'].'&page='.'delete'.' " title="Delete"><i class="far fa-trash-alt fa-2x "></i></a>
                                    </td>  
                                </tr>'; 
                            
                        $count++; 
                    }  
                    ?>  
                </table>  
            </div>  <!-- table-responsive -->
        </div> <!-- card-body -->
        </div>
</body>
<script type="text/javascript">
$(document).ready(function(){  
    $('#endorsed').DataTable();  
}); 
</script>
</body>
</html>

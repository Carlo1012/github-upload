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

$query ="SELECT * FROM mlgoo_clgoo";
$result = mysqli_query($conn, $query);

$query_staff ="SELECT * FROM staff_info";
$result_staff = mysqli_query($conn, $query_staff);
?>

<!DOCTYPE html>
<html>
 <head>
  <title>Accounts - Admin</title>
  <link rel="icon" type="image/ico" href="../images/logo.png" />

  <script src="../vendor/jquery/jquery.min.js"></script>

  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> <!-- for design -->

  <script src="../vendor/datatables/js/UIKit.jquery.dataTables.min.js"></script>  
  <script src="../vendor/datatables/js/dataTables.uikit.min.js"></script> 
  <link href="../vendor/datatables/css/uikit.min.css" rel="stylesheet">
  <link href="../vendor/datatables/css/dataTables.uikit.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link href="../css/custom2.css" rel="stylesheet">

  <script src="../vendor/sweetalert/js/sweetalert.min.js"></script>
    

  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" /> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script> -->
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
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

   
  <div class="container box">
   <h1 align="center">MLGOO/CLGOO Information</h1>
    <div class="card-header">
      <i class="fas fa-users fa-3x"></i>
      <b>MLGOO/CLGOO Accounts</b>
    </div>
   <div class="table-responsive">
    <br />
    <div id="alert_message"></div>
    <table id="user_data" class="table table-striped uk-table-hover">
     <thead>
      <tr>
       <th>User Name</th>
       <th>First Name</th>
       <th>Middle Name</th>
       <th>Last Name</th>
       <th>Municipality</th>
       <th>Address</th>
       <th>Email</th>
        <th>Status</th>
       <th>Password</th>
      
       <th>Action</th>
      </tr>
     </thead>
    </table>
   </div>
  </div>
    <?php include '../include/footer.html' ?>
    <script src="include/notification_admin.js"></script>
 </body>
</html>

<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
  
  fetch_data();

  function fetch_data()
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"mlgoo_admin/fetch.php",
     type:"POST"
    }
   });
  }
  
  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"mlgoo_admin/update.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {
     $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     $('#user_data').DataTable().destroy();
     fetch_data();
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 5000);
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  
  $(document).on('click', '.block', function(){
   var id = $(this).attr("id");
   if(confirm("Continue?"))
   {
    $.ajax({
     url:"mlgoo_admin/delete.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });

  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   if(confirm("Delete permanently?"))
   {
    $.ajax({
     url:"mlgoo_admin/deleted.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });

  $(document).on('click', '.changepw', function(){
   var id = $(this).attr("id");
   var username = $(this).attr("username");
   if(confirm("Reset to default?"))
   {
    $.ajax({
     url:"mlgoo_admin/changepw.php",
     method:"POST",
     data:{id:id, username:username},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });
 });
</script>
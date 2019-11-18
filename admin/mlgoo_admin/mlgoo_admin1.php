<?php
ob_start();
session_start();
include '../../include/connect.php'; 
include '../../include/core.inc.php'; 
$_SESSION['username'];
$username_session = $_SESSION['username'];
$query_session ="SELECT * FROM admin WHERE username = '$username_session'";
$result_session = mysqli_query($conn, $query_session);  

while($row = mysqli_fetch_array($result_session)){
  $firstname_session = $row['firstname'];
  $middlename_session = $row['middlename'];
  $lastname_session = $row['lastname'];
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
  <link rel="icon" type="image/ico" href="../../images/logo.png" />

  <script src="../../vendor/jquery/jquery.min.js"></script>

  <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script> <!-- for design -->

  <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script> 
  <script src="../../vendor/datatables/js/dataTables.bootstrap.min.js"></script> 

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- <link href="../../css/custom.css" rel="stylesheet"> -->

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
<?php include('../navigation.html'); ?>
 <p>Welcome, <b><?php echo $firstname_session." ".$middlename_session." ".$lastname_session." (".$username_session.") "; ?></b></p>
    <div class="card-header">
      <i class="fas fa-users fa-3x"></i>
      <b>MLGOO/CLGOO Accounts</b>
    </div><br>
  <div class="container box">
   <h1 align="center">MLGOO/CLGOO Information</h1>
   <br />
   <div class="table-responsive">
   <br />
    <br />
    <div id="alert_message"></div>
    <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>User Name</th>
       <th>First Name</th>
       <th>Middle Name</th>
       <th>Last Name</th>
       <th>Municipality</th>
       <th>Address</th>
       <th>Email</th>
       <th></th>
      </tr>
     </thead>
    </table>
   </div>
  </div>
    <?php include '../../include/footer.html' ?>
    <script src="../include/notification_admin.js"></script>
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
     url:"fetch.php",
     type:"POST"
    }
   });
  }
  
  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"update.php",
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
  
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this?"))
   {
    $.ajax({
     url:"delete.php",
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
 });
</script>
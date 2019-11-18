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

if(isset($_POST['submit_btn'])){
  $username = $_POST['usernamer'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $password_md5 = md5($password);
  $firstnamer = $_POST['firstnamer'];
  $middlename = $_POST['middlename'];
  $lastnamer = $_POST['lastnamer'];
  $gender = $_POST['gender'];
  $district = $_POST['district'];
  $cm = $_POST['cm'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  
  if($cm ==''){
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { swal("Exist","Please select Municipality!","error");';
      echo '}, 1000);</script>'; 
  } else {
  
  
  
  
  

      $query = "SELECT * FROM mlgoo_clgoo WHERE username = '".$username."' ";
      $exist_username = mysqli_query($conn, $query);
    
      if(mysqli_num_rows($exist_username) > 0){
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Exist","Username already taken!","error");';
        echo '}, 1000);</script>'; 
    
      } else { 
    
        $query = "SELECT * FROM mlgoo_clgoo WHERE email = '".$email."' ";
        $exist_email = mysqli_query($conn, $query);
    
        if(mysqli_num_rows($exist_email) > 0){
          echo '<script type="text/javascript">';
          echo 'setTimeout(function () { swal("Exist","Email already taken!","error");';
          echo '}, 1000);</script>'; 
    
        } else { 
    
          $check=mysqli_query($conn,"SELECT * FROM mlgoo_clgoo WHERE city_municipality = '$cm' ");
          $checkrows=mysqli_num_rows($check);
    
          if($checkrows == 1) {
          echo '<script type="text/javascript">';
          echo 'setTimeout(function () { swal("Exist","Municipality already taken!","error");';
          echo '}, 1000);</script>'; 
    
          } else {  
    
            if($password==$cpassword){
              $query= "INSERT IGNORE INTO mlgoo_clgoo (`username`, `password`, `district`, `city_municipality`, `firstname`, `middlename`, `lastname`, `gender`, `address`, `email`) VALUES ('$username','$password_md5','$district','$cm','$firstnamer','$middlename','$lastnamer','$gender', '$address', '$email')";
              $query_run = mysqli_query($conn,$query);  
    
                if($query_run){
                  echo '<script type="text/javascript">';
                  echo 'setTimeout(function () { swal("Created","User Registered!","success");';
                  echo '}, 1000);</script>';
                }else{
                  echo '<script type="text/javascript">';
                  echo 'setTimeout(function () { swal("Not Created","User NOT Registered!","error");';
                  echo '}, 1000);</script>';
                }
            }else{
              echo '<script type="text/javascript">';
              echo 'setTimeout(function () { swal("Not Match","Password and confirm password does not match!","error");';
              echo '}, 1000);</script>'; 
            }  
          }
        }
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

    <title>Admin - Register</title>
    <link rel="icon" type="image/ico" href="../images/logo.png" />

     <script src="../vendor/jquery/jquery.min.js"></script>
     <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- version 3.7.7 -->
     <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> <!-- for design -->

     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        <script src="../vendor/sweetalert/js/sweetalert.min.js"></script>



     <!-- custom css -->
     <link href="../css/custom2.css" rel="stylesheet">

  <style type="text/css">
    .field-icon {
    margin-left: -25px;
    margin-top: -25px;
    position: relative;
    z-index: 2;
  }
  </style>
  </head>
<script>
function getstate(val) {
  $.ajax({
  type: "POST",
  url: "get_state.php",
  data:'districtid='+val,
    success: function(data){
      $("#cm-list").html(data);
    }
  });
}
</script>
  </head>

<body class="container-fluid background">
  <?php include "navigation.html"; ?>

  <div class="container-fluid">
    <div class="container box">
            <div class="card-header">
              <i class="fas fa-user-alt fa-3x"></i>
              <b>Register a Mlgoo/Clgoo</b></div>
      <div class="card-body">
        <form class="myform" action="register_mcgloo.php" method="POST">
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" name="usernamer" id="usernamer" class="form-control" placeholder="Username" required="required" autofocus="autofocus" maxlength="10" autocapitalize="none" onkeypress="CheckSpace(event)">
                  <label for="usernamer">Username</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="password" name="password" id="password" value="12345" class="form-control" placeholder="Pasword" required="required" autofocus="autofocus" maxlength="15" onkeypress="CheckSpace(event)"><span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                  <label for="password">Password</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="password" name="cpassword" id="password" value="12345" class="form-control" placeholder="Confirm Password" required="required" maxlength="15" onkeypress="CheckSpace(event)">
                  <label for="cpassword">Confirm Password</label>
                </div>
              </div>
            </div>
          </div>         
            
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" name="firstnamer" id="firstname" class="form-control" placeholder="First name" required="required" maxlength="15">
                  <label for="firstname">First name</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" name="middlename" class="form-control" placeholder="Middle name" maxlength="15" >
                  <label for="middlename">Middle name</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" name="lastnamer" class="form-control" placeholder="Last name" required="required" maxlength="15">
                  <label for="lastname">Last name</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-label-group">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required="required" maxlength="30" onkeypress="CheckSpace(event)">
                <label for="email">Email address</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" name="address" class="form-control" placeholder="Address" required="required" maxlength="50">
                  <label for="address">Address</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <div class="col-md-4">
                <label for="gender">Gender</label><br>
                <input type="radio" name="gender" value="m"  required="required">Male
                <input type="radio" name="gender" value="f"  required="required">Female 
              </div>         
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <div class="col-md-4">
                <label>District:</label>
                <select name="district" id="district-list" class="demoInputBox"  onChange="getstate(this.value);">
                  <option value="">Select district</option>
                  <?php
                    $sql1="SELECT * FROM district";
                    $results=$conn->query($sql1); 
                    while($rs=$results->fetch_assoc()) { 
                  ?>
                  <option name="district" required="required" value="<?php echo $rs["districtid"]; ?>"><?php echo $rs["districtname"]; ?></option>
                  <?php
                    }
                  ?>
                </select><br>

                <label  >City/Municipality:</label>
                <select id="cm-list" name="cm"  >
                  <option name="cm" required="required" value="">Select City/Municipality</option>
                </select><br>
              </div> <!-- col-md-4 -->         
            </div> <!-- form-label-group -->
          </div> <!-- form-group -->
          <input name="submit_btn" class="btn btn-primary btn-block" type="submit" id="signup_btn" value="Sign Up"/>
        </form>    
      </div> 
    </div> <!-- container-->
  </div> <!-- container-fluid-->
  <?php include '../include/footer.html' ?>
<script src="../include/notification_admin.js"></script>  
<script type="text/javascript">
  // for cloning username to password & confirm password + 12345
  $(function() {
    $('input[id$=usernamer]').keyup(function() {
      var txtClone = $(this).val()+'12345';
      $('input[id$=password]').val(txtClone);
      $('input[id$=cpassword]').val(txtClone);

    });
  });

  // for not allowing black space
  function CheckSpace(event) {
     if(event.which ==32) {
      event.preventDefault();
      return false;
     }
  }

  $(document).ready(function(){  
    $("#usernamer").on('change keyup paste',function() {
      $(this).val($(this).val().toLowerCase());
    })
  });

  $(document).ready(function(){  
    $("#email").on('change keyup paste',function() {
    $(this).val($(this).val().toLowerCase());
    })
  });

</script>

<!-- Toggle Password -->
<script type="text/javascript">
    $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
</body> 
</html>
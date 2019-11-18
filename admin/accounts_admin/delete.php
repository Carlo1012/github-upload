<?php
  include("../../include/connect.php");

$query_select ="SELECT * FROM staff_info WHERE id = '".$_POST["id"]."'";
$query_run = mysqli_query($conn, $query_select);

while($row = mysqli_fetch_array($query_run)){
    $active = $row['active'];
}

if ($active==0) {
  if(isset($_POST["id"])) {
    $query = "UPDATE staff_info SET active=1 WHERE id = '".$_POST["id"]."'";

    if(mysqli_query($conn, $query)) {
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { swal("BLOCKED","Account is now Disabled!","success");';
      echo '}, 1000);</script>'; 
      echo 'Account is now Disabled';

    }
  }

}else{

  if(isset($_POST["id"])) {
    $query = "UPDATE staff_info SET active=0 WHERE id = '".$_POST["id"]."'";

    if(mysqli_query($conn, $query)) {
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { swal("UNBLOCKED","Account is ready to use!","success");';
      echo '}, 1000);</script>';   
      echo 'Account is ready to use';
      
    }
  }
}
?>
<?php
  include("../../include/connect.php");

  if(isset($_POST["id"])) {
    $query = "DELETE FROM staff_info WHERE id = '".$_POST["id"]."'";

    if(mysqli_query($conn, $query)) {
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { swal("DELETED","Account is deleted!","success");';
      echo '}, 1000);</script>'; 
      echo 'Account is deleted';

    }
  }

?>
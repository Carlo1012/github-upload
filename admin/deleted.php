<?php
  include("../include/connect.php");

  if(isset($_POST["id"])) {
    $query = "DELETE FROM announcement_admin WHERE id = '".$_POST["id"]."'";

    if(mysqli_query($conn, $query)) {
      // echo '<script type="text/javascript">';
      // echo 'setTimeout(function () { swal("DELETED","Post is successfully deleted!","success");';
      // echo '}, 1000);</script>'; 
      // echo 'Success';
      echo "<script>window.location.href='postlist.php?r=success'</script>";


    }
  }

?>
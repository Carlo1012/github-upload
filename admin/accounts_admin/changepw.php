<?php  
  include("../../include/connect.php");

 if(isset($_POST["id"])) {  
$query ="SELECT * FROM staff_info WHERE id = '".$_POST["id"]."' ";
$result = mysqli_query($conn, $query);  

while($row = mysqli_fetch_array($result)) {
	$username = $row['username'];
}
$default ='12345';
$password_md5 =md5($username.$default);

  $query = "UPDATE staff_info SET password ='$password_md5' WHERE id = '".$_POST["id"]."' ";  
   	if(mysqli_query($conn, $query)) {
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { swal("Reset","Password is now set to default!","success");';
      echo '}, 1000);</script>'; 
      echo 'Processing';
    }
 }  
?>

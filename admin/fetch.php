<?php
  include("../include/connect.php");

if(isset($_POST["view"])) {
  ob_start();
  session_start();
  $_SESSION['username'];
  $username = $_SESSION['username'];
   
  if($_POST["view"] != '') {
    $update_query = "UPDATE uploaded_files SET notif_admin=1 WHERE notif_admin=0  AND recipient = '$username' ";
    mysqli_query($conn, $update_query);
  }

  $query = "SELECT * FROM uploaded_files ORDER BY id DESC LIMIT 5";
  $result = mysqli_query($conn, $query);
  $output = '';
   
    if(mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_array($result)) {
       $output .= '
       <li>
        <a href="#">
         <strong>'.$row["sender"].'</strong><br />
         <small><em>'.$row["file_name"].'</em></small>
        </a>
       </li>
       <li class="divider"></li>
       ';
      }
    
    }else{
      $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
    }
   
  $query_1 = "SELECT * FROM uploaded_files WHERE notif_admin=0  AND recipient = '$username' ";
  $result_1 = mysqli_query($conn, $query_1);
  $count = mysqli_num_rows($result_1);
  $data = array(
    'notification'   => $output,
    'unseen_notification' => $count
  );
   echo json_encode($data);
}

 //fetch.php  
 if(isset($_POST["id"]))  
 {  
      $query = "SELECT * FROM announcement_admin WHERE id = '".$_POST["id"]."'";  
      $result = mysqli_query($conn, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
?>
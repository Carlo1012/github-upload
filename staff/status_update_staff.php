<?php
ob_start();
session_start();

include '../include/connect.php'; 
include '../include/core.inc.php'; 
 if (isset($_REQUEST['page'])) {
    
  if($_REQUEST['page']=='delete') {
    $query = "UPDATE uploaded_files SET del = '1' WHERE id = '".$_REQUEST['id']."' "; //change to udate query
    mysqli_query($conn, $query);
    header("refresh:1 url=reportlist_staff.php?r=deleted");
    
    }elseif($_REQUEST['page']=='revise') {
    $query = "UPDATE uploaded_files SET status = '2' WHERE id = '".$_REQUEST['id']."' ";
    mysqli_query($conn, $query);
    header("refresh:1 url=reportlist_staff.php?r=updated");

    }elseif($_REQUEST['page']=='done') {
    $query = "UPDATE uploaded_files SET status = '1' WHERE id = '".$_REQUEST['id']."' ";
    $query_run = mysqli_query($conn, $query);

        if ($query_run) {
                $query_sent = "UPDATE uploaded_files SET status = '1' WHERE deadline ='".$_REQUEST['deadline']."' AND file_name ='".$_REQUEST['file_name']."' AND recipient ='".$_REQUEST['sender']."'";
                // $query_sent = "UPDATE uploaded_files SET status = '1' WHERE deadline ='1' AND filename ='asd'";

                mysqli_query($conn, $query_sent);

                header("refresh:1 url=reportlist_staff.php?r=updated");
        }
    }
  }

// if(isset($_GET['id'])) {
//   $id = mysqli_real_escape_string($conn, $_GET['id']);
//   $title = mysqli_real_escape_string($conn, $_GET['title']);
//   $content = mysqli_real_escape_string($conn, $_GET['content']);
//   $query1 = "UPDATE announcement_admin SET title ='$title', content ='$content' WHERE id = '$id' ";

//   mysqli_query($conn, $query1);
//   header('Location: announcement_admin.php'); 
// //   header("refresh:1 url=announcement_admin.php");
// exit();
// } 

?>
<?php

if(!isset($_SESSION['username'])){
  header('Location: ../login.php'); 
     die();
 }
?>

 <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Signika">
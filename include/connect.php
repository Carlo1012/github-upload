<?php 
$host = "localhost";
$username= "root";
$password = "";
$db = "dilgbula_dilg_database";

// $host = "dilgbulacanars.com";
// $username= "dilgbula_dilg";
// $password = "pasdilgbulacanars";
// $db = "dilgbula_dilg_database";

$current_file = $_SERVER['SCRIPT_NAME'];
// Create connection
$conn = new mysqli($host, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully"; uncomment for testing
?>


<?php  
//action.php
include '../include/connect.php';
include '../include/core.inc.php'; 
$input = filter_input_array(INPUT_POST);

$middlename = mysqli_real_escape_string($conn, $input["middlename"]);
$firstname = mysqli_real_escape_string($conn, $input["firstname"]);
$lastname = mysqli_real_escape_string($conn, $input["lastname"]);
$username = mysqli_real_escape_string($conn, $input["username"]);
$email = mysqli_real_escape_string($conn, $input["email"]);

if($input["action"] === 'edit') {
 $query = "
 UPDATE staff_info SET 
 username = '".$username."', 
 firstname = '".$firstname."',
 middlename = '".$middlename."',
 lastname = '".$lastname."',
 email = '".$email."' 
 WHERE id = '".$input["id"]."'
 ";
	if($username == '' OR $firstname == '' OR $lastname == '' OR $email == '')  {
		mysqli_query(exit());
	}else{
		mysqli_query($conn, $query);
	}
}
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM staff_info 
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($conn, $query);
}

echo json_encode($input);

?>
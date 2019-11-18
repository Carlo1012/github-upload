<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Admin - Home</title>
</head>
<script type="text/javascript"></script>
<body>
<?php
require_once("../include/connect.php");
//$db_handle = new DBController();


	$query ="SELECT * FROM cm	WHERE districtid = '" . $_POST["districtid"] . "'";
	$results = $conn->query($query);
?>
	<option value="">Select City/Municipality</option>
<?php
	while($rs=$results->fetch_assoc()) {
?>
	<option value="<?php echo $rs["cmname"]; ?>"><?php echo $rs["cmname"]; ?></option>
<?php

}
?>


</body>
</html>
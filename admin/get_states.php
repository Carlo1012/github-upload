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
<script type="text/javascript">//alert("sdfsd");</script>
<body>
<?php
require_once("../include/connect.php");
//$db_handle = new DBController();


	$query ="SELECT * FROM uploaded_files WHERE id = '" . $_POST["id"] . "'";
	$results = $conn->query($query);
?>
	<option name="cm1" value="">test</option>
<?php
	while($rs=$results->fetch_assoc()) {
?>
	<option name="cm1" value="<?php echo $rs["deadline"]; ?>"><?php echo $rs["deadline"]; ?></option>
<?php

}
?>
</body>
</html>
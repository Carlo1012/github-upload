<?php
	$type = $_POST['id'];
	$content = $_POST['username'];
	$mysqli=connect_database(); //connection to database
	$stmt = $mysqli->prepare('UPDATE staff_info SET username = ? WHERE id = ?');
	$stmt->bind_param('ss', $content, $type);
	$ress = $stmt->execute();
	$stmt->close();
	$mysqli->close();
	echo "OK";
?>
<?php
require_once("../include/connect.php");
	if(isset($_POST["id"]))  {  
		$query ="SELECT * FROM uploaded_files WHERE id = '" . $_POST["id"] . "'";
		$results = $conn->query($query);
		$resu ='';
	
		while($rs=mysqli_fetch_array($results)) {	
			$resu .='	<input type="text" name="recipient" readonly="readonly" value="'.$rs["sender"].'"><br><br>	
						<input type="text" name="deadline" readonly="readonly" value="'.$rs["deadline"].'">';
		}
	echo $resu;
	}
?>
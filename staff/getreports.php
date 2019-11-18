<?php  
 $connect = mysqli_connect("localhost", "root", "", "dilgbula_dilg_database");  
 $output = '';  
 if(isset($_POST["id"]))  
 {  
			if($_POST["id"] != '')  
			{  
					 $sql = "SELECT * FROM uploaded_files WHERE id = '".$_POST["id"]."'";  
			}  
			else  
			{  
					 $sql = "SELECT * FROM uploaded_files";  
			}  
			$result = mysqli_query($connect, $sql);  
			while($row = mysqli_fetch_array($result))  
			{     
						$deadline = $row['deadline'];


			// The next output for choosing file_name, This is name of sendeer
					$output .= '<form method="POST" action="report_staff.php" enctype="multipart/form-data">';

					$output .= '<div class="col-md-3"><div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;"><p>Recipient</p>'.$row["sender"].'</div></div>';

          $output .= '<div class="col-md-3"><div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;"><p>Deadline</p>'.$row["deadline"].'</div></div>';
          
          $output .= '
					<div class="form-label-group col-md-3"><div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;">
						<input type="file" name="file">
						<button type="submit" name="upload">Send</button>
					</div></div>

					<div>
						<input type="hidden" name="deadline" value="'.$row["deadline"].'">
					</div>

					<div>
						<input type="hidden" name="opt" value="'.$row["sender"].'">
					</div>

			 		<div class="input-group date" id=datepicker>

					</div>
			
					</form> ';

					
			}  
			echo $output;  
 }  
 ?>  

 <script>
	$(function() {
		$("#datepicker").datepicker({
			// defaultDate: "+1w",
			// changeMonth: true,
			minDate: new Date("<?php echo $deadline; ?>"),
			maxDate: new Date("<?php echo $deadline; ?>"),

			format: "yyyy/mm/dd",
			inline: true,  
			// todayHighlight: true
		});
	});
 </script>
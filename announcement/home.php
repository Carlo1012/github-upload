<?php
	$result_announcement = mysqli_query($conn, "SELECT * FROM announcement_admin ORDER BY id desc LIMIT 3");
?>   

<style type="text/css">
	img {
	padding: 15px;
	float: right;
	padding-right: unset;
	max-width: 100%;
}

p.card-text:hover {
  background-color: #f1f1f1;
}
</style>
	<div class="container-fluid header">
			<h1 style="font-family: Signika">Announcements, News and Events</h1>
		</div>

		<div class="container announcements" id="load_data_table">
			<?php
				if(mysqli_num_rows($result_announcement) > 0) {
					while ($row = mysqli_fetch_array($result_announcement)) {
						$id = $row['id'];
						$title = $row['title'];
						$content = $row['content'];
						$image = $row['image'];
						$created = $row['time_created'];
						$created_substr = substr("$created",0, 10) . ""; 

						$content_substr = substr("$content",0, 200) . "..."; 

						echo'                       
							<div class="container report_admin" >
								<div class="card">
									<div class="row">
										<div class="col-md-4">
											<img src="../announcement/announcement_image/'.$row['image'].'" alt="Post Image" width="300" height="200">
										</div>
										<div class="col-md-6">
											<div class="card-block">
											<h4 class="card-title">'.$title.'</h4>
											<p class="sub-title">'.$created_substr.'</p>
											<p class="card-text">'.$content_substr.'</p>
											<input type="button" style="float: right; name="view" value="Read More" id="'.$row["id"].'" class="btn btn-info btn-xs read_more" />
											</div>
										</div>
									</div>
								</div>
							</div><br>
							';
					}
				}
			?>
			<div class="container" id="remove_row">  
				<button type="button" name="btn_more" data-vid="<?php echo $id; ?>" id="btn_more" class="btn btn-success form-control">See More</button>
			</div>
		</div>

<div class="modal fade" id="dataModal" tabindex="-1">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    	 <div class="modal-body" id="post_detail">
          Modal body..
        </div>
        
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
    
  </div>
</div>

<script>  
$(document).ready(function(){
	$(document).on('click', '.read_more', function(){
	//$('#dataModal').modal();
	var post_id = $(this).attr("id");
	$.ajax({
	url:"../announcement/select.php",
	method:"POST",
	data:{post_id:post_id},
	success:function(data){
	$('#post_detail').html(data);
	$('#dataModal').modal('show');
	}
	});
	});
});  
 </script>

  <script>  
 $(document).ready(function(){  
      $(document).on('click', '#btn_more', function(){  
           var post_id = $(this).data("vid");  
           $('#btn_more').html("Loading...");  
           $.ajax({  
                url:"../announcement/load_data.php",  
                method:"POST",  
                data:{post_id:post_id},  
                dataType:"text",  
                success:function(data)  
                {  
                     if(data != '')  
                     {  
                          $('#remove_row').remove();  
                          $('#load_data_table').append(data);  
                     }  
                     else  
                     {  
                          $('#btn_more').html("No Data");  
                     }  
                }  
           });  
      });  
 });  
 </script>
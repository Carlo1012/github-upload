
<?php  
$output = '';  
$post_id = '';  
sleep(1);  
include '../include/connect.php';
$sql = "SELECT * FROM announcement_admin WHERE id > ".$_POST['post_id']." LIMIT 2";  
$result = mysqli_query($conn, $sql);  
if(mysqli_num_rows($result) > 0)  
{  
     while($row = mysqli_fetch_array($result))  
     {  
          $id = $row['id'];
          $title = $row['title'];
          $content = $row['content'];
          $image = $row['image'];
          $created = $row['created'];
          $content_substr = substr("$content",0, 200) . "..."; 
          $post_id = $row["id"];  
          $output .= '<div class="container report_admin" >
                                        <div class="card" style="border: 1px solid rgba(0,0,0,.125)">
                                             <div class="row">
                                                  <div class="col-md-4">
                                                       <img src="announcement_upload/'.$row['image'].'" alt="Post Image" width="300" height="200">
                                                  </div>
                                                  <div class="col-md-6">
                                                       <div class="card-block">
                                                       <h4 class="card-title">'.$title.'</h4>
                                                       <p class="sub-title">'.$created.'</p>
                                                       <p class="card-text">'.$content_substr.'</p>
                                                       <input type="button" style="float: right; name="view" value="Read More" id="'.$row["id"].'" class="btn btn-info btn-xs read_more" />
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>';
     }  
     $output .= '  
               <div id="remove_row">  
                    <td><button type="button" name="btn_more" data-vid="'. $post_id .'" id="btn_more" class="btn btn-success form-control">more</button>
               </div>
     ';  
     echo $output;  
}  
?>

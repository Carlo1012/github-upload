<?php  
include '../include/connect.php';
if(isset($_POST["post_id"]))
{
 $output = '';
 $query = "SELECT * FROM announcement_admin WHERE id = '".$_POST["post_id"]."'";
 $result = mysqli_query($conn, $query);
 $output .= '  
      <div class="container report_admin" >
           <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
        $id = $row['id'];
        $title = $row['title'];
        $content = $row['content'];
        $image = $row['image'];
        $created = $row['created'];
        $content_substr = substr("$content",0, 200) . "..."; 
     $output .= '
        <div class="card" style="border: 1px solid rgba(0,0,0,.125)">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="announcement_upload/'.$row['image'].'" alt="Post Image" width="300" height="200">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-block">
                                            <h4 class="card-title">'.$title.'</h4>
                                            <p class="sub-title">'.$created.'</p>
                                            <p class="card-text">'.$content.'</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
     ';
    }
    $output .= '</div>';
    echo $output;
}
?>

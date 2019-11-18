<?php  
include '../include/connect.php';

 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $name = mysqli_real_escape_string($conn, $_POST["title"]);  
      $address = mysqli_real_escape_string($conn, $_POST["type"]);  
      $gender = mysqli_real_escape_string($conn, $_POST["content"]);  
      // $choose_image = mysqli_real_escape_string($conn, $_POST["file"]);
      // $choose_image = $_FILES['file']['name'];


      // if($_POST["id"] != '')  
      // {  
      //      $query = "  
      //      UPDATE announcement_admin   
      //      SET title='$name',   
      //      type='$address',   
      //      content='$gender',
      //      image='$choose_image'
           
      //      WHERE id='".$_POST["id"]."'";  
      //      $message = 'Data Updated';  
      // }  
      // else  
      // {  
      //      $query = "  
      //      INSERT INTO announcement_admin(tite, type, content, image)  
      //      VALUES('$name', '$address', '$gender', '$choose_image');  
      //      ";  
      //      $message = 'Data Inserted';  
      // }  

      if($_POST["id"] != '')  
      {  
           $query = "  
           UPDATE announcement_admin   
           SET title='$name',   
           type='$address',   
           content='$gender'
           
           WHERE id='".$_POST["id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  
           $query = "  
           INSERT INTO announcement_admin(tite, type, content, image)  
           VALUES('$name', '$address', '$gender');  
           ";  
           $message = 'Data Inserted';  
      }  




      if(mysqli_query($conn, $query))  
      {  
           $output .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM announcement_admin ORDER BY time_created DESC";  
           $result = mysqli_query($conn, $select_query);  
           $output .= '  
                <table class="table table-bordered">  
                     <tr>  
                          <th width="5%">#</th>  
                          <th width="10%">Title</th>  
                          <th width="10%">Categories</th>  
                          <th width="60%">Content</th>  
                          <th width="10%">Date</th>  
                          <th width="5%">Action</th>  


                     </tr>  
           ';
                     $count = 1;

           while($row = mysqli_fetch_array($result))  
           {     $id = $row['id'];  
                $title = $row['title'];
                $type  = $row['type'];
                $content = $row['content'];
                $image   = $row['image'];
                $created   = $row['time_created'];
                $output .= '  
                     <tr>  
                                <td>'.$count.'</td>
                                <td>'.$title.'</td>  
                                <td>'.$type.'</td>  
                                <td>'.$content.'</td>
                                <td><em>'.$created.'</em></td>  
                                <td><input type="button" name="edit" value="Edit" id="'.$row["id"].'" class="btn btn-info btn-xs edit_data" /><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button></td>  
                            </tr>'; 
           }  
           $output .= '</table>';  
      }  
      echo $output;  
 }  
 ?>
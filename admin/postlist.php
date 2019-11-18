<?php
ob_start();
session_start();
include '../include/connect.php'; 
include '../include/core.inc.php'; 
$_SESSION['username'];
$username = $_SESSION['username']; 
$query ="SELECT * FROM admin WHERE username = '$username'";
$result = mysqli_query($conn, $query);  

while($row = mysqli_fetch_array($result)) {
    $firstname_s = $row['firstname'];
    $middlename = $row['middlename'];
    $lastname_s = $row['lastname'];
}
$result = mysqli_query($conn, "SELECT * FROM announcement_admin ORDER BY time_created DESC");

?>  

<?php 
	if(isset($_GET['r'])) {
		$reset = $_GET['r'];
		
		if($reset=='success'){
			echo '<script type="text/javascript">';
			echo 'setTimeout(function () { swal("DELETED","Post is successfully deleted!","success");';
			echo '}, 1000);</script>'; 
		}else{
			$class='hide';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Home</title>
    <link rel="icon" type="image/ico" href="../images/logo.png" />
    <script src="../vendor/jquery/jquery.min.js"></script>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- version 3.7.7 -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> <!-- for design -->

    <!-- for icons -->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- <link href="../vendor/fontawesome-free/css/all.css" rel="stylesheet">  -->
    
    <script src="../vendor/sweetalert/js/sweetalert.min.js"></script>

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="../css/custom2.css" >  

    <!-- <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>  
    <link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="../vendor/datatables/js/dataTables.bootstrap.min.js"></script>  -->

		<script src="../vendor/datatables/js/UIKit.jquery.dataTables.min.js"></script>  
    <script src="../vendor/datatables/js/dataTables.uikit.min.js"></script> 
    <link href="../vendor/datatables/css/uikit.min.css" rel="stylesheet">
    <link href="../vendor/datatables/css/dataTables.uikit.min.css" rel="stylesheet">
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  </style>
</head>

<body class="container-fluid background">

<?php include('navigation.html'); ?>
    <div class="container-fluid">
        <div class="container box">
            <div class="table-responsive" border="5px">  
              <h1 align="center">All Post</h1><hr>

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-inbox fa-3x"></i>
                <b>List</b>
            </div>
        </div> <!-- card mb-3 -->
                <table id="postlist" class="table table-striped uk-table-hover"  >  
                    <thead>  
                        <tr> 
                          <th width="5%">#</th>  
                          <th width="10%">Title</th>  
                          <th width="10%">Categories</th>  
                          <th width="60%">Content</th>  
                          <th width="10%">Date</th>  
                          <th width="5%">Action</th>   
                        </tr>  
                    </thead>  
                    <?php  
                     $count = 1;

                    while($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];  
                        $title = $row['title'];
                        $type  = $row['type'];
                        $content = $row['content'];
                        $image   = $row['image'];
                        $created   = $row['time_created'];
                        $created_substr = substr("$created",0, 10) . ""; 
                      
                        echo'<tr>  
                                <td>'.$count.'</td>
                                <td>'.$title.'</td>  
                                <td>'.$type.'</td>  
                                <td>'.$content.'</td>
                                <td><em>'.$created_substr.'</em></td>  
                                <td><input type="button" style="padding-left: 25px; padding-right: 25px; name="edit" value="Edit" id="'.$row["id"].'" class="btn btn-info btn-xs edit_data" /><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button></td>  
                            </tr>'; 
                         $count++; 
                        }     
                    ?>  
                </table>  
            </div>  <!-- table-responsive -->
        </div> <!-- card-body -->
        <br><br>
        
    </div> <!-- container -->
    <?php include'../include/footer.html'; ?>

<script src="../include/notification_admin.js"></script>
<script type="text/javascript">
    $(document).ready(function(){  
        $('#postlist').DataTable();  
    }); 
</script>
<script>  
 $(document).ready(function(){ 

      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var id = $(this).attr("id");  
           $.ajax({  
                url:"fetch.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"json",  
                success:function(data){  
                     $('#title').val(data.title);  
                     $('#type').val(data.type);  
                     $('#content').val(data.content);  
                     $('#choose_image').val(data.image);  
                     $('#id').val(data.id);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#title').val() == "")  
           {  
                alert("Title is required");  
           }  
           else if($('#type').val() == '')  
           {  
                alert("Type is required");  
           }  
           else if($('#content').val() == '')  
           {  
                alert("Content is required");  
           }  
           // else if($('#choose_image').val() == '')  
           // {  
           //      alert("image is required");  
           // }  
           else  
           {  
                $.ajax({  
                     url:"insert.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Updating");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#postlist').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', '.view_data', function(){  
           var id = $(this).attr("id");  
           if(id != '')  
           {  
                $.ajax({  
                     url:"select.php",  
                     method:"POST",  
                     data:{id:id},  
                     success:function(data){  
                          $('#employee_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
      });  

      $(document).on('click', '.delete', function(){
       var id = $(this).attr("id");
       if(confirm("Delete permanently?"))
       {
        $.ajax({
         url:"deleted.php",
         method:"POST",
         data:{id:id},
         success:function(data){
          $('#postlist').html('<div class="alert alert-success">'+data+'</div>');
          $('#user_data').DataTable().destroy();
          fetch_data();
         }
        });
        setInterval(function(){
         $('#alert_message').html('');
        }, 5000);
       }
      });
 });  
 </script>
</body>
</html>
<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Employee Details</h4>  
                </div>  
                <div class="modal-body" id="employee_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
     <div id="add_data_Modal" class="modal fade">  
          <div class="modal-dialog">  
               <div class="modal-content">  
                    <div class="modal-header">  
                         <button type="button" class="close" data-dismiss="modal">&times;</button>  
                         <h4 class="modal-title">Edit choosen post</h4>  
                    </div>  
                    <div class="modal-body">  
                         <form method="POST" id="insert_form" enctype="multipart/form-data">  
                              <label>Title</label>  
                              <input type="text" name="title" id="title" class="form-control" />  
                              <br />  
                              
                              <label>Select Categories</label>  
                              <select name="type" id="type" class="form-control">  
                                   <option value="Announcement">Announcement</option>  
                                   <option value="News">News</option>  
                                   <option value="Events">Events</option>  
                              </select>  
                              <br />  
                              <label>Content</label>  
                              <textarea 
                              name="content" 
                              id="content" 
                              class="form-control"
                              cols="10"
                              rows="10" 
                              ></textarea>  
                              <br />  
                              
                              <!-- <input type="file" required="required" name="file" id="file"> -->
                              <input type="hidden" name="id" id="id" />  
                              <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                         </form>  
                    </div>  
                    <div class="modal-footer">  
                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                    </div>  
               </div>  
          </div>  
     </div>  
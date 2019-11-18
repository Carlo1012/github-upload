<?php
ob_start();
session_start();
include '../include/connect.php'; 
include '../include/core.inc.php';
$_SESSION['username'];
$username = $_SESSION['username'];

$query ="SELECT * FROM mlgoo_clgoo WHERE username = '$username'";
$result = mysqli_query($conn, $query);  

while($row = mysqli_fetch_array($result)) {
    $firstname = $row['firstname'];
    $middlename = $row['middlename'];
    $lastname = $row['lastname'];
    $username = $row['username'];
    $municipality = $row['city_municipality'];

}

if (isset($_POST['upload'])) {
    $username = $_SESSION['username'];
    $recipient = $_POST['recipient'];
    $files = $_FILES['file']['name'];
    $deadline=$_POST['deadline'];
    
    if(empty($files)){
		echo "<script>alert('Please choose the file.');</script>";    
	}elseif(empty($deadline)){
		echo "<script>alert('Please choose deadline.');</script>";   
	}elseif(empty($recipient)){
		echo "<script>alert('Please choose recipient.');</script>";     
	}else{    
  $target = "../files_upload/".basename($files);
        $query_run = "INSERT INTO uploaded_files (sender, recipient, file_name, deadline) VALUES (?, ?, ?, ?)";
        $stmt =mysqli_stmt_init($conn);
    
            if (!mysqli_stmt_prepare($stmt, $query_run)) {
                echo "<script>alert('There was an error2');</script>"; 

                echo $query;
                exit();
            } else {

                $errors     = array();
                $maxsize    = 10097152;
                $extensions = array("docx","doc","pdf","xlxs","xls");
                $ext = pathinfo($files, PATHINFO_EXTENSION);;

                if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
                    echo "<script>alert('File too large. File must be less than 10 megabytes.');</script>"; 
                    header("refresh:1 url=reportlist_mclgoo.php");

                }elseif (!in_array($ext,$extensions)) {
                    echo "<script>alert('This file extenstion is not accepted.');</script>"; 
                    header("refresh:1 url=reportlist_mclgoo.php");

                }elseif (count($errors) === 0) {
                    mysqli_stmt_bind_param($stmt, "ssss", $username, $recipient, $files, $deadline);
                    mysqli_stmt_execute($stmt);

                    move_uploaded_file($_FILES['file']['tmp_name'], $target);
                    echo "<script>alert('Uploaded successfully.');</script>"; 
                    header("refresh:1 url=reportlist_mclgoo.php");
                    die();


                }else {
                    foreach($errors as $error) {
                        echo '<script>alert("'.$error.'");</script>';
                        header("refresh:1 url=reportlist_mclgoo.php");
                    }
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            }
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

    <title>MLGOO/CLGOO - Report</title>
    <link rel="icon" type="image/ico" href="../images/logo.png" />

                
    <script src="../vendor/jquery/jquery.min.js"></script>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- version 3.7.7 -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> <!-- for design -->
   
    <!-- for icons -->
    <link href="../vendor/fontawesome-free/css/all.css" rel="stylesheet"> 

    <!-- custom css -->
    <link href="../css/custom2.css" rel="stylesheet">

    <script>
</script>
    
</head>
<body class="container-fluid background">
<?php include 'navigation.html'; ?>
    <div class="container-fluid">
        <div class="container box">
            <span class="send_report_title"><h3>Send Report</h3></span><hr>
            <form class="my-form" autocomplete="off" action="report_mclgoo.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="form-row-fluid">
                        <div class="col-md-9 col-sm-9 col-lg-10">
                            <div class="form-label-group">
                                <label for="opt"><span class="opts_title">Filename</span></label>
                                <input type="text" readonly="readonly" name="opt" id="recipient" required="required" value="<?php echo $_REQUEST['filename'] ?>">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-9 col-sm-9 col-lg-10" >
                            <div class="form-label-group">
                                <label for="deadline"><span class="opts_title"><b>Deadline</b></span></label>
                                <label for="recipient"><span class="opts_title"><b>Recipient</b></span></label>
                                <div style="float: right; font-size: 20px;" >
                                    <input type="text" name="recipient" id="recipient" readonly="readonly" required="required" value="<?php echo $_REQUEST['sender'] ?>"><br><br>

                                    <input type="text" readonly="readonly" name="deadline" id="autodeadline" required="required" value="<?php echo $_REQUEST['deadline'] ?>">
                                    <!-- Deadline and name result here -->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-9 col-sm-9 col-lg-10">
                            <div class="form-label-group">
                                <br>
                                <input type="file" name="file" id="file" required="required">
                                <label for="file"><span class="opts_title"><b>Choose File</b></span></label>
                            </div>
                        </div>
                    </div>
                </div>         
                <button class="button upload" style="vertical-align:middle" name="upload"><span>Send Report </span></button>
            </form>

        </div> <!-- container -->
    </div> <!-- container-fluid -->
    <?php include '../include/footer.html' ?>                
    <script src="notification_mlgoo.js"></script>   

</body>
</html>
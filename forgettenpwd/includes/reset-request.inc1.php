<script src="../../vendor/sweetalert/js/sweetalert.min.js"></script>

<?php
if(isset($_POST["reset-request-submit"])) {
        function proceed() {
            $userEmail = $_POST["email"];
            require '../../include/connect.php';
            $query2 ="SELECT * FROM mlgoo_clgoo WHERE email = '$userEmail'";
            $result = mysqli_query($conn, $query2);  

            while($row = mysqli_fetch_array($result)) {
                $active = $row['active'];
            }

            if($active == 1){
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Error","Account is Disabled!","error");';
                echo '}, 1000);</script>';
                echo "<script>window.location.href='../reset-password.php?reset=block'</script>";
                die();
            }


            $query3 ="SELECT * FROM staff_info WHERE email = '$userEmail'";
            $result = mysqli_query($conn, $query3);  

            while($row = mysqli_fetch_array($result)) {
                $active = $row['active'];
            }

            if($active == 1){
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Error","Account is Disabled!","error");';
                echo '}, 1000);</script>';
                echo "<script>window.location.href='../reset-password.php?reset=block'</script>";
                die();
            }

            $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
            $stmt =mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {

                echo "There was an error1!";

                echo $sql;

                exit();

            

            } else {
                mysqli_stmt_bind_param($stmt, "s", $userEmail);
                mysqli_stmt_execute($stmt);
            }

            $sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";

            $stmt =mysqli_stmt_init($conn);

            

            if (!mysqli_stmt_prepare($stmt, $sql)) {

                echo "There was an error2!";

                echo $sql;

                exit();

            } else {

                $hashedToken = password_hash($token, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);

                mysqli_stmt_execute($stmt);

            



            // mysqli_stmt_close($stmt);

            // mysqli_close($conn);



            $to = $userEmail;



            $subject = 'Reset your password';



            $message = '<p>We, received a password reset request. The link to reset your password make this request, you can ignore this email.Here is your password reset link: 

            <a href ="'.$url.'">' .$url.'</a>
            </p>';



            $headers = "From: dilgbulacanars.com\r\n";

            $headers = "Reply-To: carlodelossantos1012@gmail.com";

            $headers = "Content-type: text/html\r\n";



            mail($to, $subject, $message, $headers);

            //      $to = $userEmail;



            // $subject = 'Reset your password';



            // $message = '<p>We, received a password reset request. The link to reset your password make this request, you can ignore this email. </p>';



            // $message = '<p>Here is your password reset link: </br>';

            // $message = '<a href ="' .$url. '">' .$url.'</a></p>';



            // $headers = "From: dilgbulacanars <carlodelossantos1012@gmail.com>\r\n";

            // $headers = "Reply-To: carlodelossantos1012@gmail.com";

            // $headers = "Content-type: text/html\r\n";



            // mail($to, $subject, $message, $headers);



            // header("Location: ../reset-password.php?reset=success");

            echo "<script>window.location.href='../reset-password.php?reset=success'</script>";

            }

        }



        $selector = bin2hex(openssl_random_pseudo_bytes(10));

        $token = openssl_random_pseudo_bytes(32);

          

        $url = "www.dilgbulacanars.com/forgettenpwd/create-new-password.php?selector=" .$selector. "&validator=" . bin2hex($token);

        $expires = date("U") + 1800;

        

        require '../../include/connect.php';



        $userEmail = $_POST["email"];



        // ADMIN

        $query_admin = "SELECT * FROM admin WHERE email = '$userEmail' ";

        $query_run_admin = mysqli_query($conn, $query_admin);

        $row_admin= mysqli_num_rows($query_run_admin);



        if ($query_run_admin = mysqli_query($conn, $query_admin)) {

            $query_num_row_admin = mysqli_num_rows($query_run_admin); 



            if($query_num_row_admin == 1) {

                proceed();

            } else {

                // MLGOO

                $query_mclgoo = "SELECT * FROM mlgoo_clgoo WHERE email = '$userEmail' ";

                $query_run_mclgoo = mysqli_query($conn, $query_mclgoo);

                $row_mclgoo= mysqli_num_rows($query_run_mclgoo);

                

                if ($query_run_mclgoo = mysqli_query($conn, $query_mclgoo)) {

                    $query_num_row_mclgoo = mysqli_num_rows($query_run_mclgoo); 



                    if($query_num_row_mclgoo == 1 ) {

                        

                        

    

                        

                        

                        proceed();



                    } else {

                        // STAFF

                        $query_staff_info = "SELECT * FROM staff_info WHERE email = '$userEmail' "; 

                        $query_run_staff_info = mysqli_query($conn, $query_staff_info);

                        $row_staff_info= mysqli_num_rows($query_run_staff_info);

                        

                        if($query_run_staff_info = mysqli_query($conn, $query_staff_info)){

                            $query_num_rows_staff_info = mysqli_num_rows($query_run_staff_info);



                            if($query_num_rows_staff_info == 1 ) {

                                proceed();

                            } else {

                                header("Location: ../reset-password.php?reset=cantfindemail");

                            }

                        }

                    }

                }

            }

        }   

    } else {

        header("Location: ../../index.html");

    }

?>
<?php
    // if(isset($_POST["reset-request-submit"])) {

    //     function proceed() {

    //         require '../../include/connect.php';



    //         $userEmail = $_POST["email"];

    //         $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?";

    //         $stmt =mysqli_stmt_init($conn);

            

    //         if (!mysqli_stmt_prepare($stmt, $sql)) {

    //             echo "There was an error1!";

    //             echo $sql;

    //             exit();

            

    //         } else {

    //             mysqli_stmt_bind_param($stmt, "s", $userEmail);

    //             mysqli_stmt_execute($stmt);

    //         }



    //         $sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";

    //         $stmt =mysqli_stmt_init($conn);

            

    //         if (!mysqli_stmt_prepare($stmt, $sql)) {

    //             echo "There was an error2!";

    //             echo $sql;

    //             exit();

    //         } else {

    //             $hashedToken = password_hash($token, PASSWORD_DEFAULT);

    //             mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);

    //             mysqli_stmt_execute($stmt);

            




    //         $to = $userEmail;



    //         $subject = 'Reset your password';



    //         $message = '<p>We, received a password reset request. The link to reset your password make this request, you can ignore this email. </p>';



    //         $message = '<p>Here is your password reset link: </br>';

    //         $message = '<a href ="' .$url. '">' .$url.'</a></p>';



    //         $headers = "From: dilgbulacanars <carlodelossantos1012@gmail.com>\r\n";

    //         $headers = "Reply-To: carlodelossantos1012@gmail.com";

    //         $headers = "Content-type: text/html\r\n";



    //         mail($to, $subject, $message, $headers);




    //         echo "<script>window.location.href='../reset-password.php?reset=success'</script>";

    //         }

    //     }



    //     $selector = bin2hex(openssl_random_pseudo_bytes(10));

    //     $token = openssl_random_pseudo_bytes(32);

          

    //     $url = "www.dilgbulacanars.com/forgettenpwd/create-new-password.php?selector=" .$selector. "&validator=" . bin2hex($token);

    //     $expires = date("U") + 1800;

        

    //     require '../../include/connect.php';



    //     $userEmail = $_POST["email"];





    //     $query_admin = "SELECT * FROM admin WHERE email = '$userEmail' ";

    //     $query_run_admin = mysqli_query($conn, $query_admin);

    //     $row_admin= mysqli_num_rows($query_run_admin);



    //     if ($query_run_admin = mysqli_query($conn, $query_admin)) {

    //         $query_num_row_admin = mysqli_num_rows($query_run_admin); 



    //         if($query_num_row_admin == 1) {

    //             proceed();

    //         } else {



    //             $query_mclgoo = "SELECT * FROM mlgoo_clgoo WHERE email = '$userEmail' ";

    //             $query_run_mclgoo = mysqli_query($conn, $query_mclgoo);

    //             $row_mclgoo= mysqli_num_rows($query_run_mclgoo);

                

    //             if ($query_run_mclgoo = mysqli_query($conn, $query_mclgoo)) {

    //                 $query_num_row_mclgoo = mysqli_num_rows($query_run_mclgoo); 



    //                 if($query_num_row_mclgoo == 1 ) {

    //                     proceed();



    //                 } else {

                    

    //                     $query_staff_info = "SELECT * FROM staff_info WHERE email = '$userEmail' "; 

    //                     $query_run_staff_info = mysqli_query($conn, $query_staff_info);

    //                     $row_staff_info= mysqli_num_rows($query_run_staff_info);

                        

    //                     if($query_run_staff_info = mysqli_query($conn, $query_staff_info)){

    //                         $query_num_rows_staff_info = mysqli_num_rows($query_run_staff_info);



    //                         if($query_num_rows_staff_info == 1 ) {

    //                             proceed();

    //                         } else {

    //                             header("Location: ../reset-password.php?reset=cantfindemail");

    //                         }

    //                     }

    //                 }

    //             }

    //         }

    //     }   

    // } else {

    //     header("Location: ../../index.html");

    // }

?>
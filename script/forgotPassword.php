<!-- 
  Module Name: Forgot Password
  Date of Code: 4/22/2020
  Programmer's Name: Fernando Andrade
  Description: This module allows the user to retrieve their password.
  Data Structures(if any): None
  Algorithms(if any): None
 -->

<?php
    session_start(['cookie_lifetime' => 86400,]);
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="../css/error.css">
    <link rel="stylesheet" type="text/css" href="../css/forgotPassword.css">
    <!-- page header -->
    <header>
        <?php
            include('header.php');
            ob_start();
        ?>
    </header>

    <!-- page contents -->
    <body>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <form class="box" action="" method="POST">
                                <h2 id="override">Forgot Password?</h2>
                                <p class="text-muted"> Please enter your email address</p> 
                                    <input type="email" name="email" pattern="[^ @]*@[^ @]*" placeholder="Email" autofocus="autofocus"> 
                                    <input type="submit" name="submit_btn" value="Submit" >
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <?php
                include('../connect.php');

                if(isset($_REQUEST['submit_btn'])){
                    $email = $_POST["email"];

                    $select = mysqli_query($connection, "SELECT `EmailAddress` FROM `users` WHERE `EmailAddress` = '".$_POST['email']."'") or exit(mysqli_error($connection));
                        if(mysqli_num_rows($select)) {?>
                                <div class="alert alert-success" id="alert">
                                  <span class="closebtn">&times;</span>  
                                  <strong>Success!</strong> You were emailed a link to reset your password!
                                </div>

                                <script>
                                    var close = document.getElementsByClassName("closebtn");
                                    var i;

                                    for (i = 0; i < close.length; i++) {
                                      close[i].onclick = function(){
                                        var div = this.parentElement;
                                        div.style.opacity = "0";
                                        setTimeout(function(){ div.style.display = "none"; }, 600);
                                      }
                                    }
                                </script>
                            <?php
                            exit;
                        } else {
                            ?>
                                <div class="alert" id="alert">
                                  <span class="closebtn">&times;</span>  
                                  <strong>Error!</strong> That email is not in our database.
                                </div>

                                <script>
                                    var close = document.getElementsByClassName("closebtn");
                                    var i;

                                    for (i = 0; i < close.length; i++) {
                                      close[i].onclick = function(){
                                        var div = this.parentElement;
                                        div.style.opacity = "0";
                                        setTimeout(function(){ div.style.display = "none"; }, 600);
                                      }
                                    }
                                </script>

                            <?php
                        }
                }
            ?>
            


        </section>
    </body>
</html>
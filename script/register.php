<!-- 
  Module Name: Register
  Date of Code: 4/5/2020
  Programmer's Name: Christopher Price
  Description: This module allows the user to create
  an account.
  Data Structures(if any): None
  Algorithms(if any): None
 -->

<?php
    session_start(['cookie_lifetime' => 86400,]);
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="../css/error.css">
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
                                <h1>Register</h1>
                                <p class="text-muted"> Sign-up for a free account!</p> 
                                    <input type="email" pattern="[^ @]*@[^ @]*" name="email" placeholder="Email" autofocus="autofocus" required> 
                                    <input type="password" name="password" placeholder="Password" minlength="8" required> 
                                    <input type="password" placeholder="Confirm Password" id="confirm" name="confirm" required>
                                    <p class="text-muted">Already have an account? <a class="log-link" href="login.php">Login Here!</a></p>
                                    
                                    <input type="submit" name="reg_btn" value="Register" href="#">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                include('../connect.php');
                if(isset($_REQUEST['reg_btn'])){
                    $email = $_POST["email"];
                    $password = md5($_POST["password"]);

                    $select = mysqli_query($connection, "SELECT `EmailAddress` FROM `users` WHERE `EmailAddress` = '".$_POST['email']."'") or exit(mysqli_error($connection));
                    //Checks the database to make sure that the email they are trying to use isn't already linked to an account
                        if(mysqli_num_rows($select)) {?>
                                <div class="alert" id="alert">
                                  <span class="closebtn">&times;</span>  
                                  <strong>Error!</strong> Email is already in use.
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
                        }

                //Checks to see if the password and confirm password match
                    if($_POST['password'] != $_POST['confirm']) { ?>
                            <div class="alert" id="alert">
                              <span class="closebtn">&times;</span>  
                              <strong>Error!</strong> Passwords do not match.
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
                        $result=$connection->query("INSERT INTO users (EmailAddress, Password) VALUES('$email', '$password')");
                        if($result){ 
                            $_SESSION['user_id'] = $connection->query("SELECT UserID FROM users WHERE $email = EmailAddress");
                            header("Location: login.php");
                        } else {
                            echo "ERROR";
                        }
                    }

                }
            ?>
        </section>
    </body>

</html>

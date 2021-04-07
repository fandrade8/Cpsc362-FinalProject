<!-- 
  Module Name: Login
  Date of Code: 4/5/2020
  Programmer's Name: Christopher Price
  Description: This module allows the user to login.
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
                                <h1>Login</h1>
                                <p class="text-muted"> Please enter your email and password!</p> 
                                    <input type="email" name="email" pattern="[^ @]*@[^ @]*" placeholder="Email" autofocus="autofocus"> 
                                    <input type="password" name="pass" placeholder="Password"> 
                                        <a class="forgot text-muted" href="forgotPassword.php">Forgot password?</a>
                                        <br>
                                        <br>
                                        <p class="text-muted">Need an account? <a class="reg-link" href="register.php">Register Here</a></p>  
                                    <input type="submit" name="submit_btn" value="Login" >
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <?php
                include('../connect.php');

                if(isset($_REQUEST['submit_btn'])){
                    $email = $_POST["email"];
                    $password = md5($_POST["pass"]);

                    $result=$connection->query("SELECT * FROM users WHERE EmailAddress='$email' AND Password='$password'");

                    if($result->num_rows!=0){
                        $row = mysqli_fetch_array($result);
                        $_SESSION['user_id']=$connection->query("SELECT UserID FROM users WHERE EmailAddress='$email' AND Password='$password'");
                        $_SESSION['emailAddress'] = $row["EmailAddress"];
                        $_SESSION['id'] = $row["UserID"];
                        header("Location: browse_items.php");
                    }

                    //User does not exist
                    if($result->num_rows==0){?>
                        <div class="alert" id="alert">
                              <span class="closebtn">&times;</span>  
                              <strong>Error!</strong> You have entered an invalid email and/or password. Please try again, or register down below.
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

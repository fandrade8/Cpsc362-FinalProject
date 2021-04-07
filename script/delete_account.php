<!-- 
  Module Name: Delete Account
  Date of Code: 4/2/2020
  Programmer's Name: Christopher Price
  Description: This module allows the user to permanently delete their
  account. Deletion of account will remove user information,
  credit card information, and shipping address information
  from the database.
  Data Structures(if any): None
  Algorithms(if any): None
 -->

 <?php
    session_start();
    include('../connect.php');
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="../css/logout.css">
    <link rel="stylesheet" type="text/css" href="../css/error.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
                                <h1 class="text-danger">Delete Account</h1>
                                <p class="text-muted"> Enter your email and password to PERMANENTLY delete account</p> 
                                    <input type="email" name="email" pattern="[^ @]*@[^ @]*" placeholder="Email" autofocus="autofocus"> 
                                    <input type="password" name="pass" placeholder="Password"> 
                                         
                                    <input type="submit" name="submit_btn" value="Delete" id="delete" >
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_SESSION['id'])) {
            	$id = $_SESSION['id'];
            }            

            if (isset($_REQUEST['submit_btn'])) {
            	$email = $_POST['email'];
            	$password = md5($_POST['pass']);

            	$result=$connection->query("SELECT * FROM users WHERE EmailAddress='$email' AND Password='$password' AND UserID = '$id'");

                if($result->num_rows!=0){
                   ?>
                    <script> location.replace("delete_success.php"); </script>
                   <?php
          			    header("Location: delete_success.php");
               	}

                    //User does not exist
                    if($result->num_rows==0){?>
                        <div class="alert" id="alert">
                              <span class="closebtn">&times;</span>  
                              <strong>Error!</strong> You have entered an invalid email and/or password.
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

            
    </body>
</html>

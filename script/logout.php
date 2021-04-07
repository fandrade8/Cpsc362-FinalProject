<!-- 
  Module Name: Logout
  Date of Code: 4/5/2020
  Programmer's Name: Christopher Price
  Description: This module logs out the user and
  they are redirected to the homepage.
  Data Structures(if any): None
  Algorithms(if any): None
 -->

<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: home.php");
    }
    else{
        session_destroy();
    }
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="../css/logout.css">

    <!-- page header -->
    <header>
        <?php include('header.php'); ?>
    </header>

    <!-- page contents -->
    <body>
        <section>
            <div class="alert alert-success mx-auto text-center" id="pad" style="width: 600px;" role="alert">
              <h4 class="alert-heading">You've been logged out!</h4>
              <br>
              <p>Hope to see you back soon!.</p>
            </div>
        </section>

        <script type="text/javascript">
            window.setTimeout(function() {
                window.location.href='home.php';
            }, 1000);
        </script>
    </body>
</html>

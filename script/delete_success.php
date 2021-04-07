<!-- 
  Module Name: Delete Success
  Date of Code: 4/28/2020
  Programmer's Name: Fernando Andrade
  Description: This module outputs a message to the user that thier account
  has been successfully deleted.
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

      <?php
        include('../connect.php');
          if (isset($_SESSION['id'])) {
              $id = $_SESSION['id'];
            }

        $sql = "DELETE FROM `users` WHERE UserID = $id";
        $connection->query($sql);
      ?>
        <section>
            <div class="alert alert-danger mx-auto text-center" id="pad" style="width: 600px;" role="alert">
              <h4 class="alert-heading">Account has been permanently deleted.</h4>
              <br>
              <p>All Information saved on this account has been deleted</p>
            </div>
        </section>

        <script type="text/javascript">
            window.setTimeout(function() {
                window.location.href='home.php';
            }, 2000);
        </script>
    </body>
</html>
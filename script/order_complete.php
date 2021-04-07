<!-- 
  Module Name: Order Complete
  Date of Code: 4/28/2020
  Programmer's Name: Fernando Andrade
  Description: This module outputs a message that lets user
  know that their order has been completed. It also clears
  the shopping cart.
  Data Structures(if any): None
  Algorithms(if any): None
 -->

<?php
    session_start();
    unset($_SESSION["shopping_cart"]);
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
              <h4 class="alert-heading">Order Complete!</h4>
              <br>
              <p>Invoice will be emailed to you shortly and you will be redirected to our home page.</p>
            </div>
        </section>

        <script type="text/javascript">
            window.setTimeout(function() {
                window.location.href='home.php';
            }, 3000);
        </script>
    </body>
</html>
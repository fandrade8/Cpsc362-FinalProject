<!-- 
  Module Name: Home
  Date of Code: 4/2/2020
  Programmer's Name: Fernando Andrade
  Description: This module outputs the landing page
  of the site.
  Data Structures(if any): None
  Algorithms(if any): None
 -->

<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    

    <!-- page header -->
    <header>
        <?php
            include('header.php');
        ?>
    </header>

    <body id="page-top">
    <!-- Header -->
    <header class="masthead">
        <div class="container d-flex h-100 align-items-center">
            <div class="mx-auto text-center">
                <h1 class="mx-auto my-0 text-uppercase">Congo</h1>
                <h2 class="text-dark mx-auto mt-2 mb-5">Your go-to site for great products. Once you start you won't want to stop.</h2>
                <a href="browse_items.php" class="btn home-btn btn-primary js-scroll-trigger">Start Browsing</a>
            </div>
        </div>
    </header>
    </body>
</html>

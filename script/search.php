<!-- 
  Module Name: Search
  Date of Code: 4/15/2020
  Programmer's Name: Steven Salazar
  Description: This module allows the user
  to search the site's inventory.
  Data Structures(if any): If there is a match in the
  search then an array of items will be used to output
  the results to the user.
  Algorithms(if any): None
 -->

<!DOCTYPE html>
<!-- update to new tables -->
<html>
    <!-- page header -->
    <header>
        <?php 
          include('header.php'); 
          include('cart_management.php');
        ?>
    </header>

    <!-- page contents -->
    <body>
      <?php
        $query = $_GET['query'];
        $key = 0;
        $min_length = 1;
      ?>

      <div class="message_box">
        <?php echo $status; ?>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-lg-9 mt-5">
            <div class="row">
              <h1 class="mb-5 font-weight-bold">Search Results for <?php echo $query; ?>:</h1>
            </div>

          </div>

        <?php

            if(strlen($query) >= $min_length) {
              $query = htmlspecialchars($query); 

               
              $query = mysqli_real_escape_string($connection, $query);

              $sql = "SELECT * FROM `products` WHERE (`description` LIKE '%".$query."%') OR (`name` LIKE '%".$query."%')";
              
              $result = $connection->query($sql);
               
              if(mysqli_num_rows($result) > 0){ 
                   
                  while($row = mysqli_fetch_array($result)){
                   
                      echo "
                        <form class='col-lg-4 col-md-6 mb-4' method='post' action='' class=''>
                          <div class='card h-100'>
                            <input type='hidden' name='code' value=".$row['code']." />

                            <img class='card-img-top' src='".$row['image2']."'/>
                            <div class='card-body'>
                              <h5 class='card-title'>".$row['name']."</h5>

                              <h6>$".$row['price']."</h6>

                              <p class='card-text'>
                                <ul>
                                  ".$row['description']."
                                </ul>
                              </p>
                            </div>

                            <div class='card-footer'>
                              <input type='submit' class='btn btn-info' id='hov' value='Add to Cart'></input>
                            </div>
                          </div>
                        </form>
                      ";
                  }
                   
              }
              else{ // if there is no matching rows do following
                ?>
                 <div class="alert alert-danger mx-auto text-center" id="pad" style="width: 600px;" role="alert">
                    <h4 class="alert-heading">No results found</h4>
                    <br>
                    <p>Try another search</p>
                  </div>
                <?php
              }
               
          }
          else{ // if query length is less than minimum
                ?>
                 <div class="alert alert-danger mx-auto text-center" id="pad" style="width: 600px;" role="alert">
                    <h4 class="alert-heading">Search cannot be empty</h4>
                    <br>
                    <p>Try another search</p>
                  </div>
                <?php
          }

        ?>

        </section>
    </body>
</html>

<!-- 
  Module Name: Phones
  Date of Code: 4/26/2020
  Programmer's Name: Fernando Andrade
  Description: This module outputs all\
  phones from the database
  Data Structures(if any): An array of headphones from the database
  Algorithms(if any): None
 -->

<?php
  session_start(['cookie_lifetime' => 86400,]);
?>

<!DOCTYPE html>
<html>
  <link rel="stylesheet" type="text/css" href="../css/browse.css">

  <header>
        <?php
            include('header.php');
            include('cart_management.php');
        ?>
  </header>

  <body>
    <div class="message_box">
      <?php echo $status; ?>
    </div>

    <div class="container">

      <div class="row">

        <div class="col-lg-3">

          <h2 class="my-4 text-white">Phones</h2>
          <div class="list-group">
            <a href="browse_items.php" class="list-group-item" id="h">Browse All Items</a>
            <a href="tablets.php" class="list-group-item" id="h">Tablets</a>
            <a href="headphones.php" class="list-group-item" id="h">Headphones</a>
          </div>

        </div>

        <div class="col-lg-9 mt-5">
          <div class="row">

             <?php
              


                  $sql = "SELECT * FROM `products` WHERE `category` = 'phones'";
                  $result = $connection->query($sql);
                  $counter = 0;

                  if ($result) {
                    while($row = $result->fetch_assoc()) { 
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
            ?>

          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

  </body>
</html>
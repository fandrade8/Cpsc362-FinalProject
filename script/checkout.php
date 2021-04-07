<!-- 
  Module Name: Checkout
  Date of Code: 4/25/2020
  Programmer's Name: Fernando Andrade
  Description: This module's function is to read in the total and subtotal
  amount from the cart module and to ask customer for shipping and credit
  card information. It will then store the customer's shipping address and credit card info
  in the database if they choose to save their informaton. If the customer already has thier
  information saved to the database will have the forms autocompleted.
  Data Structures(if any): If the user has thier information saved already, then an array
  of thier information is used to output it to the forms.
  Algorithms(if any): None
 -->

<?php
    session_start(['cookie_lifetime' => 86400,]);
    include('../connect.php');
    ob_start();
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="../css/cart.css">
    <link rel="stylesheet" type="text/css" href="../css/color.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <header>
        <?php
            include('header.php');
        ?>
    </header>

    <body>
        <div class="container py-5"></div>
        <div class="px-4 px-lg-0">


          <form action="" method="post" class="pb-5">
            <div class="container">

              <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                  <h1 class="pb-5 display-5 font-weight-bold text-center text-black">Checkout</h1>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col" class="border-0 title">
                            <div class="p-2 px-3 text-uppercase">Shipping Address</div>
                          </th>
                          <th scope="col" class="border-0 title">
                            <div class="py-2 text-uppercase"></div>
                          </th>
                          <th scope="col" class="border-0 title">
                            <div class="py-2 text-uppercase"></div>
                          </th>
                          <th scope="col" class="border-0 title">
                            <div class="py-2 text-uppercase"></div>
                          </th>
                        </tr>
                      </thead>
                    </table>

                    
                      <!-- <form method="post" action=""> -->
                  <?php
                  if (isset($_SESSION['id'])) {
                      $id = $_SESSION['id'];
                    }

                    $result = $connection->query("SELECT * FROM `checkout_info` WHERE user_id = '$id'");
                    $row_count = $result->num_rows;

                    $row = mysqli_fetch_assoc($result);

                    if ($row_count == 0){
                      ?>
                      <tbody>
                        <div class="row">
                          <div class="col">
                            <p class="font-italic mb-4">First Name</p>
                            <div class="input-group mb-4 border rounded-pill p-2">
                              <input type="text" placeholder="John" class="form-control border-0 text-capitalize" name="first" pattern="[A-Za-z]{1,32}" required>
                            </div>
                          </div>
                          <div class="col">
                            <p class="font-italic mb-4">Last Name</p>
                            <div class="input-group mb-4 border rounded-pill p-2">
                              <input type="text" placeholder="Smith" class="form-control border-0 text-capitalize" name="last" pattern="[A-Za-z]{1,32}" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col">
                            <p class="font-italic mb-4">Address</p>
                            <div class="input-group mb-4 border rounded-pill p-2">
                              <input type="text" placeholder="743 Chapman Ave" class="form-control border-0 text-capitalize" name="address" required>
                            </div>
                          </div>
                          <div class="col">
                            <p class="font-italic mb-4">City</p>
                            <div class="input-group mb-4 border rounded-pill p-2">
                              <input type="text" placeholder="Fullerton" class="form-control border-0 text-capitalize" name="city" pattern="[A-Za-z]{1,32}" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col">
                            <p class="font-italic mb-4">State</p>
                            <div class="input-group mb-4 border rounded-pill p-2">
                              <input type="text" placeholder="CA" class="form-control border-0 text-uppercase" name="state" pattern="[A-Za-z]{1,32}" maxlength="2" required>
                            </div>
                          </div>
                          <div class="col">
                            <p class="font-italic mb-4">Zip Code</p>
                            <div class="input-group mb-4 border rounded-pill p-2">
                              <input type="text" placeholder="90020" class="form-control border-0" name="zip" pattern="(\d{5}([\-]\d{4})?)" required>
                            </div>
                          </div>
                        </div>
                        <div class="form-check mb-3">
                          <input class="form-check-input" type="checkbox" value="true" name="save" id="defaultCheck1">
                          <label class="form-check-label" for="defaultCheck1">
                            Save Shipping Address
                          </label>
                        </div>
                    </tbody>
                  <?php 

                  }

                  else {
                    ?>
                  <tbody>
                    <div class="row">
                          <div class="col">
                            <p class="font-italic mb-4">First Name</p>
                            <div class="input-group mb-4 border rounded-pill p-2">
                              <input type="text" placeholder="John" class="form-control border-0 text-capitalize" name="first" pattern="[A-Za-z]{1,32}" required value="<?php echo $row['first_name']; ?>">
                            </div>
                          </div>
                          <div class="col">
                            <p class="font-italic mb-4">Last Name</p>
                            <div class="input-group mb-4 border rounded-pill p-2">
                              <input type="text" placeholder="Smith" class="form-control border-0 text-capitalize" name="last" pattern="[A-Za-z]{1,32}" required value="<?php echo $row['last_name']; ?>">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col">
                            <p class="font-italic mb-4">Address</p>
                            <div class="input-group mb-4 border rounded-pill p-2">
                              <input type="text" placeholder="743 Chapman Ave" class="form-control border-0 text-capitalize" name="address" required value="<?php echo $row['address']; ?>">
                            </div>
                          </div>
                          <div class="col">
                            <p class="font-italic mb-4">City</p>
                            <div class="input-group mb-4 border rounded-pill p-2">
                              <input type="text" placeholder="Fullerton" class="form-control border-0 text-capitalize" name="city"  required value="<?php echo $row['city']; ?>">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col">
                            <p class="font-italic mb-4">State</p>
                            <div class="input-group mb-4 border rounded-pill p-2">
                              <input type="text" placeholder="CA" class="form-control border-0 text-uppercase" name="state" pattern="[A-Za-z]{2}" maxlength="2" minlength="2" required value="<?php echo $row['state']; ?>">
                            </div>
                          </div>
                          <div class="col">
                            <p class="font-italic mb-4">Zip Code</p>
                            <div class="input-group mb-4 border rounded-pill p-2">
                              <input type="text" placeholder="90020" class="form-control border-0" name="zip" pattern="(\d{5}([\-]\d{4})?)" required value="<?php echo $row['zipcode']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="form-check mb-3">
                          <input class="form-check-input" type="checkbox" value="true" name="save" id="defaultCheck1">
                          <label class="form-check-label" for="defaultCheck1">
                            Save Shipping Address
                          </label>
                        </div>
                    </tbody>
                    <?php
                  }
                ?>

                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                  <div class="table-responsive">

                <?php
                    $result = $connection->query("SELECT * FROM `creditcard` WHERE `card_id` = '$id'");
                    $row_count = $result->num_rows;

                    $row = mysqli_fetch_assoc($result);

                    if ($row_count == 0){
                    ?>
                    

                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col" class="border-0 title">
                            <div class="p-2 px-3 text-uppercase">Credit Card</div>
                          </th>
                          <th scope="col" class="border-0 title">
                            <div class="py-2 text-uppercase"></div>
                          </th>
                          <th scope="col" class="border-0 title">
                            <div class="py-2 text-uppercase"></div>
                          </th>
                          <th scope="col" class="border-0 title">
                            <div class="py-2 text-uppercase"></div>
                          </th>
                        </tr>
                      </thead>
                    </table>

                    <tbody>
                      <form method="post" action="">
                        <div class="row">
                          <div class="col">
                            <p class="font-italic mb-4">Name On Card</p>
                            <div class="input-group mb-4 border rounded-pill p-2">
                              <input type="text" placeholder="John H Smith" class="form-control border-0 text-capitalize"  name="card_name">
                            </div>
                          </div>
                          <div class="col">
                            <p class="font-italic mb-4">CVV</p>
                            <div class="input-group mb-4 border rounded-pill p-2">
                              <input type="text" placeholder="111" class="form-control border-0" name="cvv">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-6">
                            <p class="font-italic mb-4 creditCardText">Card Number</p>
                            <div class="input-group mb-4 border rounded-pill p-2">
                              <input type="text" placeholder="1111-2222-3333-4444" class="form-control border-0 creditCardText" name="card_num">
                              <script>
                                $('.creditCardText').keyup(function() {
                                  var dashes = $(this).val().split("-").join(""); // remove hyphens
                                  if (dashes.length > 0) {
                                  dashes = dashes.match(new RegExp('.{1,4}', 'g')).join("-");
                                  }
                                  $(this).val(dashes);
                                });                                  
                              </script>                                
                            </div>
                          </div>
                          <div class="col">
                            <p class="font-italic mb-4">Expiration Date</p>
                            <select class="custom-select mr-sm-1 rounded-pill" id="date">
                              <option value="01">January</option>
                              <option value="02">February </option>
                              <option value="03">March</option>
                              <option value="04">April</option>
                              <option value="05">May</option>
                              <option value="06">June</option>
                              <option value="07">July</option>
                              <option value="08">August</option>
                              <option value="09">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                            </select>

                            <select class="custom-select mr-sm-1 rounded-pill" id="date">
                              <option value="16"> 2020</option>
                              <option value="17"> 2021</option>
                              <option value="18"> 2022</option>
                              <option value="19"> 2023</option>
                              <option value="20"> 2024</option>
                              <option value="21"> 2025</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-check mb-3">
                          <input class="form-check-input" type="checkbox" value="true" name="save_card" id="defaultCheck1">
                          <label class="form-check-label" for="defaultCheck1">
                            Save Credit Card
                          </label>
                        </div>
                      </form>
                    </tbody>
                    <?php
                  } else {

                    ?>

                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col" class="border-0 title">
                            <div class="p-2 px-3 text-uppercase">Credit Card</div>
                          </th>
                          <th scope="col" class="border-0 title">
                            <div class="py-2 text-uppercase"></div>
                          </th>
                          <th scope="col" class="border-0 title">
                            <div class="py-2 text-uppercase"></div>
                          </th>
                          <th scope="col" class="border-0 title">
                            <div class="py-2 text-uppercase"></div>
                          </th>
                        </tr>
                      </thead>
                    </table>

                    <tbody>
                      <form method="post" action="">
                        <div class="row">
                          <div class="col">
                            <p class="font-italic mb-4">Name On Card</p>
                            <div class="input-group mb-4 border rounded-pill p-2 text-capitalize">
                              <input type="text" placeholder="John H Smith" class="form-control border-0 text-capitalize"  name="card_name" value="<?php echo $row['name']; ?>">
                            </div>
                          </div>
                          <div class="col">
                            <p class="font-italic mb-4">CVV</p>
                            <div class="input-group mb-4 border rounded-pill p-2 ">
                              <input type="text" placeholder="111" class="form-control border-0" name="cvv" value="<?php echo $row['cvv']; ?>">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-6">
                            <p class="font-italic mb-4 creditCardText">Card Number</p>
                            <div class="input-group mb-4 border rounded-pill p-2">
                              <input type="text" placeholder="1111-2222-3333-4444" class="form-control border-0 creditCardText" name="card_num" value="<?php echo $row['card_number']; ?>">
                              <script>
                                $('.creditCardText').keyup(function() {
                                  var dashes = $(this).val().split("-").join(""); // remove hyphens
                                  if (dashes.length > 0) {
                                  dashes = dashes.match(new RegExp('.{1,4}', 'g')).join("-");
                                  }
                                  $(this).val(dashes);
                                });                                 
                              </script>                                
                            </div>
                          </div>
                          <div class="col">
                            <p class="font-italic mb-4">Expiration Date</p>
                            <select class="custom-select mr-sm-1 rounded-pill" id="date">
                              <option value="01">January</option>
                              <option value="02">February </option>
                              <option value="03">March</option>
                              <option value="04">April</option>
                              <option value="05">May</option>
                              <option value="06">June</option>
                              <option value="07">July</option>
                              <option value="08">August</option>
                              <option value="09">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                            </select>

                            <select class="custom-select mr-sm-1 rounded-pill" id="date">
                              <option value="16"> 2020</option>
                              <option value="17"> 2021</option>
                              <option value="18"> 2022</option>
                              <option value="19"> 2023</option>
                              <option value="20"> 2024</option>
                              <option value="21"> 2025</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-check mb-3">
                          <input class="form-check-input" type="checkbox" value="true" name="save_card" id="defaultCheck1">
                          <label class="form-check-label" for="defaultCheck1">
                            Save Credit Card Info
                          </label>
                        </div>
                      </form>
                    </tbody>
                    <?php
                  }

              ?>
                  </div>
                </div>
              </div>

              <?php
                if (isset($_SESSION["subtotal"])) {
                  $subtotal = $_SESSION["subtotal"];
                  $total = $_SESSION["total"];
                }
              
                ?>
              <div class="row py-5 p-4 bg-white rounded shadow-sm">
                <div class="col-lg">
                  <div class="title rounded-pill px-4 py-3 text-uppercase font-weight-bold">Confirm Order </div>
                  <div class="p-4">
                    <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</p>
                    <ul class="list-unstyled mb-4">
                      <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Order Subtotal </strong><strong>$<?php echo htmlspecialchars($subtotal)?>.00</strong></li>
                      <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>$10.00</strong></li>
                      <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tax</strong><strong>10%</strong></li>
                      <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                        <h5 class="font-weight-bold">$<?php echo htmlspecialchars($total)?>.00</h5>
                      </li>
                    </ul><input href="order_complete.php" class="btn btn-success rounded-pill py-2 btn-block" value="Submit Order" name="order" type="submit"></input>
                  </div>
                </div>
              </div>
             
            </div>
          </form>

          <?php
                

                if (isset($_REQUEST['order'])) {
                  if (isset($_POST['save'])) {
                    $fname = $_POST['first'];
                    $lname = $_POST['last'];
                    $address = $_POST['address'];
                    $city = $_POST['city'];
                    $state = $_POST['state'];
                    $zip = $_POST['zip'];
                    

                    if (isset($_SESSION['id'])) {
                      $id = $_SESSION['id'];
                    }

                    $result = $connection->query("SELECT * FROM `checkout_info` WHERE user_id = '$id'");
                    $row_count = $result->num_rows;                    

                    if ($row_count == 0) {
                      $sql = "INSERT INTO `checkout_info` (user_id, first_name, last_name, address, city, state, zipcode) VALUES ('$id', '$fname', '$lname', '$address', '$city', '$state', '$zip')";
                      $connection->query($sql);                      
                    } else {
                      $sql = "UPDATE checkout_info SET first_name = '$fname', last_name = '$lname', address = '$address', city = '$city', state = '$state', zipcode = '$zip' WHERE user_id = '$id'";
                      $connection->query($sql);                      
                    }   
                  }

                  if (isset($_POST['save_card'])) {
                    $card_name = $_POST['card_name'];
                    $cvv = $_POST['cvv'];
                    $card_num = $_POST['card_num'];

                    if (isset($_SESSION['id'])) {
                      $id = $_SESSION['id'];
                    }

                    $result = $connection->query("SELECT * FROM `creditcard` WHERE card_id = '$id'");
                    
                    $row_count = $result->num_rows;                    

                    if ($row_count == 0) {
                      $sql = "INSERT INTO `creditcard` (card_id, name, cvv, card_number) VALUES ('$id',  '$card_name', '$cvv', '$card_num')";
                      $connection->query($sql); 
                                         
                    } else {
                      $sql = "UPDATE `creditcard` SET name = '$card_name', cvv = '$cvv', card_number = '$card_num' WHERE card_id = '$id'";
                      $connection->query($sql);
                                   
                    }   
                  }

                  header("Location: order_complete.php");
                }
                
              ?>

        </div>
    </body>
</html>
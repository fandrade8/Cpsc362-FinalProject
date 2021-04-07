<!-- 
  Module Name: Cart
  Date of Code:	4/24/2020
  Programmer's Name: Fernando Andrade
  Description: This module's function is to create the shopping cart page.
  Using the data passed through it from the other pages it recieves an array of items
  and it then loops through them to output them to the user. It also shows the user
  the subtotal of the all the items they chose as well as give them the option to change
  the quantity or remove items. Also checks if the user is logged in. If they are they can continue to
  checkout and if not they must log in.
  Data Structures(if any): An array of items passed to it from the cart managment module.
  Algorithms(if any): None

 -->

<?php
	session_start(['cookie_lifetime' => 86400,]);

	$status="";
	//Checks to see if the user clicked the remove button
	if (isset($_POST['action']) && $_POST['action']=="remove"){
		//Checks is cart array is not empty and if it has items
		//it notifies the user that the item was removed from the cart.
		if(!empty($_SESSION["shopping_cart"])) {
			foreach($_SESSION["shopping_cart"] as $key => $value) {
				if($_POST["code"] == $key){
					unset($_SESSION["shopping_cart"][$key]);

					$status = "
					<div class='alert' id='alert'>
			        	<span class='closebtn'>&times;</span>  
			     		Product is removed from your cart!
			     	</div>

			     	<script>
			   			var close = document.getElementsByClassName('closebtn');
			   			var i;

			   			for (i = 0; i < close.length; i++) {
			  				close[i].onclick = function(){
			   					var div = this.parentElement;
			  					div.style.opacity = '0';
			 					setTimeout(function(){ div.style.display = 'none'; }, 600);
			 				}
			  			}
			 		</script>";
				}
				if(empty($_SESSION["shopping_cart"]))
					unset($_SESSION["shopping_cart"]);
				}		
			}
		}
	//Checks to see if user changed the quantity and updates the quantity variable.
	if (isset($_POST['action']) && $_POST['action']=="change"){
	  foreach($_SESSION["shopping_cart"] as &$value){
	    if($value['code'] === $_POST["code"]){
	        $value['quantity'] = $_POST["quantity"];
	        break; // Stop the loop after we've found the product
	    }
	}
  	
}
?>





<html>
	<link rel="stylesheet" type="text/css" href="../css/cart.css">
    <link rel="stylesheet" type="text/css" href="../css/color.css">
    <link rel="stylesheet" type="text/css" href="../css/error.css">
    <link rel="stylesheet" type="text/css" href="../css/logout.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <header>
        <?php
            include('header.php');
        ?>
    </header>
	<body>
		<div class="message_box">
   			<?php echo $status; ?>
    	</div>


		<div class="cart">
			<?php
			//If the shopping cart is not empty create the subtotal and total variables and initialize.
				if(isset($_SESSION["shopping_cart"])){
		   		 $subtotal = 0;

		   		 $total = 0;
			?>	

			<div class="px-4 px-lg-0">
         	 <div class="container py-5"></div>
         	 <div class="pb-5">
           	 <div class="container">
           	 <?php

           	 	?>
              <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                  <h1 class="pb-5 display-5 font-weight-bold text-center text-black">Shopping Cart</h1>
					<div class="table-responsive">
                    	<table class="table">
                     		<thead>
                        		<tr>
		                          <th scope="col" class="border-0 title">
		                            <div class="p-2 px-3 text-uppercase">Product</div>
		                          </th>
		                          <th scope="col" class="border-0 title">
		                            <div class="py-2 text-uppercase">Price</div>
		                          </th>
		                          <th scope="col" class="border-0 title">
		                            <div class="py-2 text-uppercase">Quantity</div>
		                          </th>
		                          <th scope="col" class="border-0 title">
		                            <div class="py-2 text-uppercase">Remove</div>
		                          </th>
		                        </tr>
                      		</thead>
                   <?php
		                        	//Loop through cart array and output items
									foreach ($_SESSION["shopping_cart"] as $product){
										?>
										<tbody>
											<tr class="bg-light">
												<th scope="row" class="border-0 bg-white">
													<div class="p-2">
														<img width="70" class="img-fluid rounded shadow-sm" src=<?php echo htmlspecialchars($product['image'])?> >
														<div class="ml-3 d-inline-block align-middle">
															<h5 class="mb-0"><a href="#" class="text-dark d-inline-block align-middle"><?php echo $product["name"]; ?> </a></h5>
														</div>
													</div>
												</th>


												<td class="border-0 align-middle bg-white">
													<strong>
														<?php echo "$".$product["price"]*$product["quantity"]; ?>
													</strong>
												</td>

												<td class="border-0 align-middle bg-white">
													<form method='post' action='' class="pt-2">
														<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
														<input type='hidden' name='action' value="change" />
														<select name='quantity' class='border btn p-2 bg-white' onchange="this.form.submit()">
															<option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
															<option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
															<option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
															<option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
															<option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
														</select>
													</form>
												</td>

												<td class="border-0 align-middle bg-white">
													<form method='post' action='' class="pt-2">
														<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
														<input type='hidden' name='action' value="remove" />
														<button type='submit' class='btn btn-danger rounded-pill'>Remove Item</button>
													</form>
												</td>
											</tr>
										</tbody>
										<?php
										//Calculate subtotal and total prices after every loop of the array.
										$subtotal += ($product["price"]*$product["quantity"]);
										$total = ($subtotal + 10) * 1.1;

										?>
										
										<?php
									}
									?>
									<tr>
											<!-- Output the subtotal -->
											<td colspan="5" align="right" class="pr-5">
												<strong class="pr-5 text-uppercase">subtotal: <?php echo "$".$subtotal; ?></strong>
												<!-- Check if user is logged in. If they are not they are given a message to log in if they want to checkout. -->
												<?php if( isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) )
								                  {
								                    ?>
								                      <a href="checkout.php" class="btn btn-secondary rounded-pill py-2 btn-block mt-4">Checkout</a>
								                    <?php 
								                  }else{ 
								                    ?>
								                     <a href="login.php" class="btn btn-warning rounded-pill py-2 btn-block mt-4">Must be logged in to continue. Click here to login.</a>
								                    <?php 
								                  } 
								                ?>
											</td>
										</tr>
									<?php
								//Create session variables for the totals so we can use these variables in the checkout module.
		                        $_SESSION["total"] = $total;
	             				$_SESSION["subtotal"] = $subtotal;
		                        ?>						
                      		
                      	
                    	</table>
                    	<?php

                    	//If the cart is empty the user is given a message
						}else{
							?>
							<section>
					            <div class="alert alert-success mx-auto text-center" id="pad" style="width: 600px;" role="alert">
					              <h4 class="alert-heading">Your cart is empty</h4>
					              <br>
					              <p>Go fill it up! We'll wait!</p>
					            </div>
					        </section>
						<?php
						}
					?>
                  	</div>
                  </div>
                 </div>
               </div>
              </div>
       		</div>			
		</div>






	</body>
</html>
<!-- 
  Module Name: Cart Managment
  Date of Code: 4/24/2020
  Programmer's Name: Matthew Stutzman
  Description: This module manages the items that go in the shopping cart.
  This module is used in any module that shows items such as the browse items
  and search modules.
  Data Structures(if any): Stores all item information in an array.
  Algorithms(if any): None
 -->

<?php
	include('../connect.php');
	$status="";

	if (isset($_POST['code']) && $_POST['code']!=""){
		$code = $_POST['code'];
		$sql = "SELECT * FROM `products` WHERE `code`='$code'";
  		$result =  $connection->query($sql);
		$row = mysqli_fetch_assoc($result);
		$name = $row['name'];
		$code = $row['code'];
		$price = $row['price'];
		$image = $row['image'];

		//creates an array of items. This array is only for the items
		//on the current page.
		$cartArray = array(
			$code=>array(
			'name'=>$name,
			'code'=>$code,
			'price'=>$price,
			'quantity'=>1,
			'image'=>$image)
		);

		//If shopping cart is empty and user adds item to the cart from their current page
		//they are given a message that item was added.
		if(empty($_SESSION["shopping_cart"])) {
			$_SESSION["shopping_cart"] = $cartArray;
			$status = "<div class='alert alert-success' id='alert'>
		        	<span class='closebtn'>&times;</span>  
		     		Product is added to your cart!
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
		}else{
		//If the cart already has the item stored in the array
		//the user is told that the item is already in their cart
		//and the quantity can be changed at checkout
			$array_keys = array_keys($_SESSION["shopping_cart"]);
			if(in_array($code,$array_keys)) {
				$status = "
				<div class='alert' id='alert'>
		        	<span class='closebtn'>&times;</span>  
		     		Product is already in your cart! You can change quantity at checkout.
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
			} else {
			//If the cart already has items but this is a new item being added then 
			//it will merge the array of the cart from this page with the array that contains
			//the items from every page.
				$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
				$status = "<div class='alert alert-success' id='alert'>
		        	<span class='closebtn'>&times;</span>  
		     		Product is added to your cart!
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

		}
	}
?>
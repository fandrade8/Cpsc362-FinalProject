<!-- 
  Module Name: Browse Items
  Date of Code: 4/20/2020
  Programmer's Name: Matthew Stutzman
  Description: This module function is to create the browse items page
  as well as to populate the page with the items from the database.
  Any time a new item is added/removed from the database this module will 
  reflect that change in its output.
  Data Structures(if any): An array is used to store the items from the database
  and the module loops through the array and outputs the items.
  Algorithms(if any): None
 -->

<?php
session_start(['cookie_lifetime' => 86400,]);
?>
<html>
	<link rel="stylesheet" type="text/css" href="../css/browse.css">
	<link rel="stylesheet" type="text/css" href="../css/error.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
					<h2 class="my-4 text-white">Browse Items</h2>

					<div class="list-group">
						<a href="phones.php" class="list-group-item">
							Phones
						</a>

						<a href="tablets.php" class="list-group-item">
							Tablets
						</a>
						<a href="headphones.php" class="list-group-item">
							Headphones
						</a>
					</div>					
				</div>

				<div class="col-lg-9">
					<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner" role="listbox">
							<div class="carousel-item active">
							 	<img class="d-block img-fluid banner" src="../img/iphone.png" alt="First slide">
							</div>
							<div class="carousel-item">
							 	<img class="d-block img-fluid" src="../img/surface-pro.png" alt="Second slide">
							</div>
							<div class="carousel-item">
							 	<img class="d-block img-fluid" src="../img/ipad.jpeg" alt="Third slide">
							</div>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>	
					</div>


					<div class="row">
						<?php
							

							$sql = "SELECT * FROM `products`";
			            	$result = $connection->query($sql);

							while($row = mysqli_fetch_assoc($result)){
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
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>
<!DOCTYPE>
<?php 
session_start();
include("functions/functions.php");

?>
<html>
	<head>
		<title>My Online Shop</title>
		
		
	<link rel="stylesheet" href="styles/style.css" media="all" /> 
	</head>
	
<body>
	
	<!--Main Container starts here-->
	<div class="main_wrapper">
	
		<!--Header starts here-->
		<div class="header_wrapper">
		
			<a href="index.php"><img id="logo" src="images/logo.gif" /> </a>
			<img id="banner" src="images/ad_banner.gif" />
		</div>
		<!--Header ends here-->
		
		<!--Navigation Bar starts-->
		<div class="menubar">
			
			<ul id="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="all_products.php">All Products</a></li>
				<li><a href="customer/my_account.php">My Account</a></li>
				<li><a href="checkout.php">Sign Up</a></li>
				<li><a href="cart.php">Shopping Cart</a></li>
				<li><a href="#">Contact Us</a></li>
			
			</ul>
			
			<div id="form">
				<form method="get" action="results.php" enctype="multipart/form-data">
					<input type="text" name="user_query" placeholder="Search a Product"/ > 
					<input type="submit" name="search" value="Search" />
				</form>
			
			</div>
			
		</div>
		<!--Navigation Bar ends-->
	
		<!--Content wrapper starts-->
		<div class="content_wrapper">
		
			<div id="sidebar">
			
				<div id="sidebar_title">Categories</div>
				
				<ul id="cats">
				
				<?php getCats(); ?>
				
				<ul>
					
				<div id="sidebar_title">Brands</div>
				
				<ul id="cats">
					
					<?php getBrands(); ?>
				
				<ul>
				<div id="sidebar_title">Filter</div>
				
				<ul id="cats">
					
					<form action='index.php' method='post'>
					<table align='center'>
						<tr>
							<td><span style='color:white;'>Select Category</span></td>
							<td align="right">
								<select name='filter_cat'>
									<option value='0'>All</option>
									
									<?php
										include('includes/db.php');
										$get_cat = 'select * from categories';
										$run_cat = mysqli_query($con, $get_cat); 
										
										while($row_cat=mysqli_fetch_array($run_cat)){
											$cat_id = $row_cat['cat_id'];
											$cat_title = $row_cat['cat_title'];
											echo "
												<option value='$cat_id'>$cat_title</option>
											";
											
										}
									?>
								</select>
						</tr><br>

						<tr>
							<td><span style='color:white;'>Select Brand</span></td>
							<td align="right">
								<select name='filter_brand' >
									<option value='0'>All</option>
									
									<?php
										include('includes/db.php');
										$get_brand = 'select * from brands';
										$run_brand = mysqli_query($con, $get_brand); 
										
										while($row_brand=mysqli_fetch_array($run_brand)){
											$brand_id = $row_brand['brand_id'];
											$brand_title = $row_brand['brand_title'];
											echo "
												<option value='$brand_id'>$brand_title</option>
											";
											
										}
									?>
								</select>
						</tr>
						<tr>
							<td><span style='color:white;'>Order</span></td>
							<td align="right"><select name='order'>
								<option value='1'>Price Low to High</option>
								<option value='2'>Price High to Low</option>
							</select></td>
						</tr>
						</table><br>
						<input type='submit' name='filter' value='Filter'>
					</form>
				
				<ul>
			
			
			</div>
		
			<div id="content_area">
			
			
			
			<div id="shopping_cart"> 
					
					<span style="float:right; font-size:17px; padding:5px; line-height:40px;">
					
					<?php 
					if(isset($_SESSION['customer_email'])){
					echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style='color:yellow;'>Your</b>" ;
					}
					else {
					echo "<b>Welcome Guest:</b>";
					}
					?>
					
					<b style="color:yellow">Shopping Cart -</b> Total Items: <?php total_items();?> Total Price: <?php total_price(); ?> <a href="cart.php" style="color:yellow">Go to Cart</a>
					
					
					<?php 
					if(!isset($_SESSION['customer_email'])){
					
					echo "<a href='checkout.php' style='color:orange;'>Login</a>";
					
					}
					else {
					echo "<a href='logout.php' style='color:orange;'>Logout</a>";
					}
					
					
					
					?>
					
					
					
					</span>
			</div>
			
				<div id="products_box">
				
				<?php getPro(); ?>
				<?php getCatPro(); ?>
				<?php getBrandPro(); ?>
				<?php filter(); ?>
				</div>
			
			</div>
		</div>
		<!--Content wrapper ends-->
		
		
		
		<div id="footer">
		
		<h2 style="text-align:center; padding-top:30px;">E-Commerce DBMS Project<br>Made By Mohit Gupta, Rahul Singh Rawat and Saif Haque<br>&copy; All Rights Reserved.</h2>
		
		</div>
	
	
	
	
	
	
	</div> 
<!--Main Container ends here-->


</body>
</html>

<?php cart(); ?>



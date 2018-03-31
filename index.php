<!DOCTYPE>
<?php 
session_start();
include("functions/functions.php");

?>
<html>
	<head>
		<title>My Online Shop</title>
		
		
		<meta charset="utf-8"> 
    <meta name="viewport" content="width=1000px, initial-scale=1">	 
	<link rel="stylesheet" href="styles/style.css" media="all" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
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
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <ul class="nav navbar-nav">
			  <li><a href="index.php">Home</a></li>
			  <li><a href="all_products.php">All Products</a></li>
			  <li><a href="customer/my_account.php">My Account</a></li>
	          <li><a href="checkout.php">Sign Up</a></li>
			  <li><a href="cart.php">Shopping Cart</a></li>
			  <li><a href="#">Contact Us</a></li>
			</ul>
			<form class="navbar-form navbar-left" action="results.php" enctype="multipart/form-data" method="get">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="user_query">
                  <div class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="search">
                      <i class="glyphicon glyphicon-search"></i>
                    </button>
                  </div>
              </div>
            </form>

		  
		  </div>
		</nav>
		<!--Navigation Bar ends-->
	
		<!--Content wrapper starts-->
		<div class="content_wrapper">
		
			<nav id="sidebar">
			
				<div class="sidebar-header"><h3>Categories</h3></div>
				
				<ul class="list-unstyled components">
				
				<?php getCats(); ?>
				
				<ul>
					
				<div class="sidebar-header"><h3>Brands</h3></div>
				
				<ul class="list-unstyled components">
					
					<?php getBrands(); ?>
				
				<ul>
				<div class="sidebar-header"><h3>Filter</h3></div>
				
				<ul class="list-unstyled components">
					
					<form action='' method='post'>
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
			
			
			</nav>
		
			<div id="content_area">
			
			<?php cart(); ?>
			
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
					
					<b style="color:yellow">Shopping Cart -</b> Total Items: <?php total_items();?> Total Price: <?php total_price(); ?> <a href="cart.php" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-shopping-cart" ></span> Shopping Cart</a>
					
					
					<?php 
					if(!isset($_SESSION['customer_email'])){
					
					echo "<a href='checkout.php' ><button type='button' class='btn btn-info' >Login</button></a>";
					
					}
					else {
					echo "<a href='logout.php' ><button type='button' class='btn btn-info' >Logout</button></a>";
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
		<a href="#" class="fa fa-facebook"></a>
<a href="#" class="fa fa-twitter"></a>
<a href="#" class="fa fa-google"></a>
<a href="#" class="fa fa-linkedin"></a>
<a href="#" class="fa fa-youtube"></a>
<a href="#" class="fa fa-instagram"></a>
		
		
		<h2 style="text-align:center; padding-top:30px;">E-Commerce DBMS Project<br>Made By Mohit Gupta, Rahul Singh Rawat and Saif Haque<br>&copy; All Rights Reserved.</h2>
		
		</div>
	
	
	
	
	
	
	</div> 
<!--Main Container ends here-->


</body>
</html>



<!DOCTYPE>
<?php 

include("functions/functions.php");

?>
<html>
	<head>
		<title>My Online Shop</title>
		
		
		<meta charset="utf-8"> 
    <meta name="viewport" content="width=1000px, initial-scale=1">	 
	<link rel="stylesheet" href="styles/style.css" media="all" />
	<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
	</head>
	
<body  background="images/ecommerce2.jpg">
	
	<!--Main Container starts here-->
	<div class="main_wrapper">
	
		<!--Header starts here-->
		<div class="header_wrapper">
		
		<a href="index.php"><img id="logo" src="images/logo_new.jpg" /> </a>
			<img id="banner" src="images/jet-1.gif" />
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
			  <div class="sidebar-header">
			    <h3>Categories</h3>
			  </div>
			  <ul class="list-unstyled components">
			    <?php getCats(); ?>
			  </ul>
			  <div class="sidebar-header">
			    <h3>Brands</h3>
			  </div>
			  <ul class="list-unstyled components">
			    <?php getBrands(); ?>
			  </ul>
			  
		</nav>
		
			<div id="content_area">
			
			<div id="shopping_cart"> 
					
					<span style="float:right; font-size:18px; padding:5px; line-height:40px;">
					
					Welcome Guest! <b style="color:yellow">Shopping Cart -</b> Total Items: Total Price: <a href="cart.php" class="btn btn-info btn-lg" style="font-size:11px"><span class="glyphicon glyphicon-shopping-cart" style="font-size:10px"></span> Shopping Cart</a>
					
					
					
					</span>
			</div>
			
				<div id="products_box">
	<?php 
	$get_pro = "select * from products";

	$run_pro = mysqli_query($con, $get_pro); 
	
	while($row_pro=mysqli_fetch_array($run_pro)){
	
		$pro_id = $row_pro['product_id'];
		$pro_cat = $row_pro['product_cat'];
		$pro_brand = $row_pro['product_brand'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_image'];
	
		echo "
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					
					<img src='admin_area/product_images/$pro_image' width='180' height='180' />
					
					<p><b> $ $pro_price </b></p>
					
					<a href='details.php?pro_id=$pro_id' style='float:left; color:black'>Details</a>
					
					<a href='index.php?add_cart=$pro_id'><button style='float:right' type='button' class='btn btn-success'>Add to Cart</button></a>
				
				</div>
		
		
		";
	
	}
	?>
				
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

<?php 

echo "<script>
$(document).ready(function() {
	var height = Math.max($('#content_area').height(), $('#sidebar').height());
	$('#sidebar').height(height);
	$('#content_area').height(height);
})</script>";

?>
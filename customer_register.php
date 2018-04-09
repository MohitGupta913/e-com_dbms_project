<!DOCTYPE>
<?php 
session_start();
include("functions/functions.php");
include("includes/db.php"); 
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
	          <li><a href="#">Sign Up</a></li>
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
			
			<?php cart(); ?>
			
			<div id="shopping_cart"> 
					
					<span style="float:right; font-size:18px; padding:5px; line-height:40px;">
					
					Welcome Guest! <b style="color:yellow">Shopping Cart -</b> Total Items: <?php total_items();?> Total Price: <?php total_price(); ?> <a href="cart.php" class="btn btn-info btn-lg"style="font-size:11px"><span class="glyphicon glyphicon-shopping-cart" style="font-size:10px"></span> Shopping Cart</a>
					
					
					
					</span>
			</div>
			
				<form action="customer_register.php" method="post" enctype="multipart/form-data">
				
					<table align="center" width="750">
						
						<tr align="center">
							<td colspan="6"><h2>Create an Account</h2></td>
						</tr>
						
						<tr>
							<td align="right">Customer Name:</td>
							<td><input type="text" name="c_name" required class="form-control"/></td>
						</tr>
						
						<tr>
							<td align="right">Customer Email:</td>
							<td><input type="text" name="c_email" required class="form-control"/></td>
							<td align="left"></td>
						</tr>
						
						<tr>
							<td align="right">Customer Password:</td>
							<td><input type="password" name="c_pass" required class="form-control"/></td>
						</tr>
						
						<tr>
							<td align="right">Customer Image:</td>
							<td><input type="file" name="c_image" required/></td>
						</tr>
						
						
						
						<tr>
							<td align="right">Customer Country:</td>
							<td>
							<select name="c_country" class="form-control">
								<option>Select a Country</option>
								<option>Afghanistan</option>
								<option>India</option>
								<option>Japan</option>
								<option>Pakistan</option>
								<option>Israel</option>
								<option>Nepal</option>
								<option>United Arab Emirates</option>
								<option>United States</option>
								<option>United Kingdom</option>
							</select>
							
							</td>
						</tr>
						
						<tr>
							<td align="right">Customer City:</td>
							<td><input type="text" name="c_city" required class="form-control"/></td>
						</tr>
						
						<tr>
							<td align="right">Customer Contact:</td>
							<td><input type="text" name="c_contact" required class="form-control"/></td>
						</tr>
						
						<tr>
							<td align="right">Customer Address</td>
							<td><input type="text" name="c_address" required class="form-control"/></td>
						</tr>

						<tr>
							<td align="right">Customer Secret</td>
							<td><input type="text" name="c_secret" required class="form-control"/></td>
						</tr>
						
						
					<tr align="center">
						<td colspan="6"><input type="submit" name="register" value="Create Account" class="btn btn-success"/></td>
					</tr>
					
					
					
					</table>
			
				</form>
			
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
	$e_check= 0;

	if(isset($_POST['c_email'])){
		$email_id = $_POST['c_email'];
		$get_email = "select * from customers where customer_email='$email_id'";
		$run_email = mysqli_query($con, $get_email);
		$num_rows = mysqli_num_rows($run_email);
		if($num_rows>0){
			echo "<script>alert('Email Id alredy registered!')</script>";
			}
		
		if(filter_var($email_id, FILTER_VALIDATE_EMAIL)){
				$e_check =1;//Email is good
				}
		else {
			$e_check =0;
			echo "<script>alert('Email Id not valid!')</script>";
		}
	}
	



	if(isset($_POST['register']) && $num_rows==0  && $e_check){
	
		
		$ip = getIp();
		
		$c_name = $_POST['c_name'];
		$c_email = $_POST['c_email'];
		$c_pass = $_POST['c_pass'];
		$c_image = $_FILES['c_image']['name'];
		$c_image_tmp = $_FILES['c_image']['tmp_name'];
		$c_country = $_POST['c_country'];
		$c_city = $_POST['c_city'];
		$c_contact = $_POST['c_contact'];
		$c_address = $_POST['c_address'];
		$c_secret = $_POST['c_secret'];
	
		
		move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");
		
		 $insert_c = "insert into customers (customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image, customer_secret) values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image','$c_secret')";
	
		$run_c = mysqli_query($con, $insert_c);
		if(!$run_c){
			echo "<script>alert('There is some error in making new account!')</script>";
			echo "<script>window.open('checkout.php','_self')</script>";
			exit();
		} 
		
		$sel_cart = "select * from cart where ip_add='$ip'";
		
		$run_cart = mysqli_query($con, $sel_cart); 
		
		$check_cart = mysqli_num_rows($run_cart); 
		
		if($check_cart==0){
		
		$_SESSION['customer_email']=$c_email; 
		
		echo "<script>alert('Account has been created successfully, Thanks!')</script>";
		echo "<script>window.open('customer/my_account.php','_self')</script>";
		
		}
		else {
		
		$_SESSION['customer_email']=$c_email; 
		
		echo "<script>alert('Account has been created successfully, Thanks!')</script>";
		
		echo "<script>window.open('cart.php','_self')</script>";
		
		
		}
	}





?>


<?php 

echo "<script>
$(document).ready(function() {
	var height = Math.max($('#content_area').height(), $('#sidebar').height());
	$('#sidebar').height(height);
	$('#content_area').height(height);
})</script>";

?>
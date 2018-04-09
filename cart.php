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
	          <li><a href="customer_register.php">Sign Up</a></li>
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
					
					<b style="color:yellow">Shopping Cart -</b> Total Items: <?php total_items();?> Total Price: <?php total_price(); ?> <a href="index.php" style="color:yellow">Back to Shop</a>
					
					<?php 
					if(!isset($_SESSION['customer_email'])){
					
					echo "<a href='checkout.php'  ><button type='button' class='btn btn-info' >Login</button></a>";
					
					}
					else {
					echo "<a href='logout.php'><button type='button' class='btn btn-info' >Logout</button></a>";
					}
					
					
					
					?>
					
					</span>
			</div>
			
				<div id="products_box">
				
			<form action="" method="post" enctype="multipart/form-data">
			
				<table align="center" width="700" >
					
					<tr align="center">
						<th>Remove</th>
						<th>Product(S)</th>
						<th>Quantity</th>
						<th>Price per Unit</th>
					</tr>
					
		<?php 
		$total = 0;
		
		global $con; 
		
		$ip = getIp(); 
		
		$sel_price = "select * from cart where ip_add='$ip'";
		
		$run_price = mysqli_query($con, $sel_price); 
		
		while($p_price=mysqli_fetch_array($run_price)){
			
			$pro_id = $p_price['p_id']; 
			$pro_qty = $p_price['qty'];
			
			$pro_price = "select * from products where product_id='$pro_id'";
			
			$run_pro_price = mysqli_query($con,$pro_price); 
			
			while ($pp_price = mysqli_fetch_array($run_pro_price)){
			
			$product_price = array($pp_price['product_price']);
			
			$product_title = $pp_price['product_title'];
			
			$product_image = $pp_price['product_image']; 
			
			$single_price = $pp_price['product_price'];
			
			$values = array_sum($product_price); 
			$values*=$pro_qty;
			
			$total += $values; 
					
					?>
					
					<tr align="center">
						<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"/></td>
						<td><?php echo $product_title; ?><br>
						<img src="admin_area/product_images/<?php echo $product_image;?>" width="60" height="60"/>
						</td>
						<td>
						<button name="cha_qty[]" value="<?php echo $pro_id; ?>">-</button>
						<input type="text" size="4" name="qty" placeholder="<?php echo $pro_qty; ?>" disabled />
						<button name="ch_qty[]" value="<?php echo $pro_id; ?>">+</button>
						</td>		
						<td><?php echo "$" . $single_price; ?></td>
					</tr>
					
					
				<?php } } echo "<br>";?>
				<tr>
						<td colspan="4" align="right"><b>Sub Total:</b></td>
						<td><?php echo "$" . $total;?></td>
					</tr>
					
					<tr align="center">
						<td colspan="2"><input type="submit" name="update_cart" value="Update Cart" class="btn btn-warning"/></td>
						<td><input type="submit" name="continue" value="Continue Shopping" class="btn btn-warning" /></td>
						<td><a href="checkout.php"> <button type="button" class="btn btn-warning">Checkout</button></a></td>
					</tr>
					
				</table> 
			
			</form>
			
	<?php 

if(isset($_POST['ch_qty'])){
							
	foreach($_POST['ch_qty'] as $change_qty){
	
	$update_qty = "update cart set qty=qty+1 where p_id='$change_qty' AND ip_add='$ip'";
	
	$run_update = mysqli_query($con, $update_qty); 
	
	
	if($run_update){
	
	echo "<script>window.open('cart.php','_self')</script>";
	
	}
	else{
		echo "<script>alert('There is some error in increasing quantity!')</script>";
		echo "<script>window.open('cart.php','_self')</script>";
	}
	
	}

}

if(isset($_POST['cha_qty'])){
							
	foreach($_POST['cha_qty'] as $change_qty){
	
	$update_qty = "update cart set qty=qty-1 where p_id='$change_qty' AND ip_add='$ip' AND qty>1";
	
	
	$run_update = mysqli_query($con, $update_qty); 
	
	
	if($run_update){
	
	echo "<script>window.open('cart.php','_self')</script>";
	
	}
	else{
		echo "<script>alert('There is some error in descreaing quantity!')</script>";
		echo "<script>window.open('cart.php','_self')</script>";
	}
	}

}
		
	function updatecart(){
		
		global $con; 
		
		$ip = getIp();
		
		if(isset($_POST['update_cart'])){
		
			foreach($_POST['remove'] as $remove_id){
			
			$delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
			
			$run_delete = mysqli_query($con, $delete_product); 
			
			if($run_delete){
			
			echo "<script>window.open('cart.php','_self')</script>";
			
			}
			else{
				echo "<script>alert('There is some error in deleting !')</script>";
				echo "<script>window.open('cart.php','_self')</script>";
			}
			
			}
		
		}
		if(isset($_POST['continue'])){
		
		echo "<script>window.open('index.php','_self')</script>";
		
		}
	
	}
	echo @$up_cart = updatecart();
	
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
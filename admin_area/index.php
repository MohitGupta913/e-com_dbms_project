<?php 
session_start(); 

if(!isset($_SESSION['user_email'])){
	
	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {

?>

<!DOCTYPE> 

<html>
	<head>
		<title>This is Admin Panel</title> 

		<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
		<script>
				tinymce.init({selector:'textarea'});
		</script>
		<meta charset="utf-8"> 
    <meta name="viewport" content="width=1000px, initial-scale=1">	 
	<link rel="stylesheet" href="styles/style.css" media="all" />
	<link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
    
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	

	</head>


<body background="images/RootZ.jpg"> 

	<div class="main_wrapper">
	
	
		<div id="header"></div>
		
		<nav id="sidebar">
		<div class="sidebar-header">
		<h3 >Manage Content</h3>
		</div>	
			<a href="index.php?insert_product">Insert New Product</a>
			<a href="index.php?view_products">View All Products</a>
			
			<a href="index.php?insert_cat">Insert New Category</a>
			<a href="index.php?view_cats">View All Categories</a>
			
			<a href="index.php?insert_brand">Insert New Brand</a>
			<a href="index.php?view_brands">View All Brands</a>
			
			<a href="index.php?view_customers">View Customers</a>
		
			<a href="index.php?view_orders">View Orders</a>
			<!--<a href="index.php?view_payments">View Payments</a>-->
			<a href="logout.php">Admin Logout</a>
		
		</nav>
		
		<div id="left">
		<h2 style="color:red; text-align:center;"><?php echo @$_GET['logged_in']; ?></h2>
		<?php 
		if(isset($_GET['insert_product'])){
		
		include("insert_product.php"); 
		
		}
		if(isset($_GET['view_products'])){
		
		include("view_products.php"); 
		
		}
		if(isset($_GET['edit_pro'])){
		
		include("edit_pro.php"); 
		
		}
		if(isset($_GET['delete_pro'])){
		
			include("delete_pro.php"); 
			
			}
		if(isset($_GET['insert_cat'])){
		
		include("insert_cat.php"); 
		
		}
		
		if(isset($_GET['view_cats'])){
		
		include("view_cats.php"); 
		
		}
		
		if(isset($_GET['edit_cat'])){
		
		include("edit_cat.php"); 
		
		}
		if(isset($_GET['delete_cat'])){
		
			include("delete_cat.php"); 
			
			}
		
		if(isset($_GET['insert_brand'])){
		
		include("insert_brand.php"); 
		
		}
		
		if(isset($_GET['view_brands'])){
		
		include("view_brands.php"); 
		
		}
		if(isset($_GET['edit_brand'])){
		
		include("edit_brand.php"); 
		
		}
		if(isset($_GET['delete_brand'])){
		
			include("delete_brand.php"); 
			
			}
		if(isset($_GET['view_customers'])){
		
		include("view_customers.php"); 
		
		}
		if(isset($_GET['delete_c'])){
		
			include("delete_c.php"); 
			
			}
		if(isset($_GET['view_orders'])){
		
		include("view_orders.php"); 
		
		}
		if(isset($_GET['view_payments'])){
		
		include("view_payments.php"); 
		
		}
		if(isset($_GET['confirm_order'])){
			include("complete_order.php"); 
		}
		?>
		</div>






	</div>


</body>
</html>

<?php } ?>

<?php 

echo "<script>
$(document).ready(function() {
	var height = Math.max($('#left').height(), $('#sidebar').height());
	$('#left').height(height);
	$('#sidebar').height(height);
})</script>";

?>
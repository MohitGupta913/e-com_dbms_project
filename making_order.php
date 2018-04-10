<?php 
//session_start(); 
?>



<html>
	<head>
		<title>Order Successful!</title>
	</head>

<body>
<?php 
		include("includes/db.php");
		//include("functions/functions.php");

		// this is about the customer
		$user = $_SESSION['customer_email'];
				
		$get_c = "select * from customers where customer_email='$user'";
			
		$run_c = mysqli_query($con, $get_c); 
			
		$row_c = mysqli_fetch_array($run_c); 
			
		$c_id = $row_c['customer_id'];
		$c_email = $row_c['customer_email'];
		$c_name = $row_c['customer_name']; 
		
		//this is all for product details
		
		$total = 0;
		
		global $con; 
		
		$ip = getIp(); 
		
		$sel_price = "select * from cart where ip_add='$ip'";
		
		$run_price = mysqli_query($con, $sel_price); 
		
		while($p_price=mysqli_fetch_array($run_price)){
			
			$pro_id = $p_price['p_id'];
			$qty = $p_price['qty'];
			
			$pro_price = "select * from products where product_id='$pro_id'";
			
			$run_pro_price = mysqli_query($con,$pro_price); 
			
			while ($pp_price = mysqli_fetch_array($run_pro_price)){
			
			$product_price = array($pp_price['product_price']);
			
			$product_id = $pp_price['product_id'];
			
			$pro_name = $pp_price['product_title'];
			$pro_p = $pp_price['product_price'];
			$total = $pro_p*$qty;

			$invoice = mt_rand(); 
				
				// inserting the order into table
				$insert_order = "insert into orders (p_id, c_id, qty,amount, currency, invoice_no, order_date,status) values ('$pro_id','$c_id','$qty','$total','USD', '$invoice',NOW(),'in Progress')";
				$run_order = mysqli_query($con, $insert_order); 

				if(!$run_order){ 
					echo "<script>alert('There is some error in placing order!')</script>";
					echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";
					exit();
				}
				
				//removing the products from cart
				$empty_cart = "delete from cart where ip_add='$ip'";
				$run_cart = mysqli_query($con, $empty_cart);
				echo "<script>alert('Order placed successfully!')</script>";
				echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";
			
			//$values = array_sum($product_price);
			
			//$total +=$values;
			
			}
		
		
		}
			
				

?>
</body>
</html>








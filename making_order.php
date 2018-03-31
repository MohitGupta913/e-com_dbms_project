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
				
				//inserting the payment to table 
				//$insert_payment = "insert into payments (amount,customer_id,product_id,trx_id,currency,payment_date) values ('$total','$c_id','$pro_id','$trx_id','$currency',NOW())";
				
				//$run_payment = mysqli_query($con, $insert_payment); 
				
				// inserting the order into table
				$insert_order = "insert into orders (p_id, c_id, qty,amount, currency, invoice_no, order_date,status) values ('$pro_id','$c_id','$qty','$total','USD', '$invoice',NOW(),'in Progress')";
				$run_order = mysqli_query($con, $insert_order); 
				
				//removing the products from cart
				$empty_cart = "delete from cart where ip_add='$ip'";
				$run_cart = mysqli_query($con, $empty_cart);
				echo "<script>alert('Product placed order successfully!')</script>";
				echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";
			
			$values = array_sum($product_price);
			
			$total +=$values;
			
			}
		
		
		}
		
			// getting Quantity of the product 
			// $get_qty = "select * from cart where p_id='$pro_id'";
			
			// $run_qty = mysqli_query($con, $get_qty); 
			
			// $row_qty = mysqli_fetch_array($run_qty); 
			
			// $qty = $row_qty['qty'];
			
			// if($qty==0){
			
			// $qty=1;
			// }
			// else {
			
			// $qty=$qty;
			
			// $total = $total*$qty;
			
			// }
			
			
			

			
				
				
				
		/*if($amount==$total){
		
		echo "<h2>Welcome:" . $_SESSION['customer_email']. "<br>" . "Your Payment was successful!</h2>";
		echo "<a href='http://www.onlinetuting.com/myshop/customer/my_account.php'>Go to your Account</a>";
		
		}
		else {
		
		echo "<h2>Welcome Guest, Payment was failed</h2><br>";
		echo "<a href='http://www.onlinetuting.com/myshop'>Go to Back to shop</a>";
		
		}*/
			
				

?>
</body>
</html>








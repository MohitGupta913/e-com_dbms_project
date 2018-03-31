<?php 
	include("includes/db.php"); 
$com_id = $_GET['confirm_order'];
			$order_up = "update orders set status='Shipped' where order_id = '$com_id';";
			$run_up = mysqli_query($con, $order_up);
			if(!$run_up){
				echo "<script>alert('There is some error in updating status!')</script>";
				echo "<script>window.open('index.php?view_orders','_self')</script>";
				exit();
			}
			echo "<script>alert('Order Shipped!')</script>";
            echo "<script>window.open('index.php?view_orders','_self')</script>";
?>
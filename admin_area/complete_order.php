<?php 
	include("includes/db.php"); 
$com_id = $_GET['confirm_order'];
			
			$ret_d = "select d_id from delivery order by RAND();";
			$run_del_up = mysqli_query($con, $ret_d);
			$d_person=mysqli_fetch_array($run_del_up);
			$dp_id = $d_person['d_id'];
			$order_up = "update orders set status='Shipped', order_delivery='$dp_id' where order_id = '$com_id';";
		
			$run_up = mysqli_query($con, $order_up);
			if(!$run_up){
				echo "<script>alert('There is some error in updating status!')</script>";
				echo "<script>window.open('index.php?view_orders','_self')</script>";
				exit();
			}
			echo "<script>alert('Order Shipped!')</script>";
            echo "<script>window.open('index.php?view_orders','_self')</script>";
?>
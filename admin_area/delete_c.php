<?php 
	include("includes/db.php"); 
	
	if(isset($_GET['delete_c'])){
	
	$delete_id = $_GET['delete_c'];

	$cus_image = "select * from customers where customer_id='$delete_id'";
	$run_cus_image = mysqli_query($con, $cus_image);
	$cus_image_link = mysqli_fetch_array($run_cus_image);
	$file = $cus_image_link['customer_image'];
	$file_link = "../customer/customer_images/{$file}";


	
	
	$delete_c = "delete from customers where customer_id='$delete_id'"; 
	
	$run_delete = mysqli_query($con, $delete_c); 
	
	if($run_delete){
		if( file_exists($file_link)){
			unlink($file_link);
		}
	
	echo "<script>alert('A customer has been deleted!')</script>";
	echo "<script>window.open('index.php?view_customers','_self')</script>";
	}
	else{
	
		echo "<script>alert('There is some error in deleting this account!')</script>";
		echo "<script>window.open('index.php?view_customers','_self')</script>";
	}
	
	}





?>
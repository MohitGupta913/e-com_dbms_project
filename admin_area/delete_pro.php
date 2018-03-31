<?php 
	include("includes/db.php"); 
	
	if(isset($_GET['delete_pro'])){
	
	$delete_id = $_GET['delete_pro'];

	$cus_image = "select * from products where product_id='$delete_id'";
	$run_cus_image = mysqli_query($con, $cus_image);
	$cus_image_link = mysqli_fetch_array($run_cus_image);
	$file = $cus_image_link['product_image'];
	$file_link = "product_images/{$file}";


	
	
	$delete_pro = "delete from products where product_id='$delete_id'"; 
	
	$run_delete = mysqli_query($con, $delete_pro); 
	
	if($run_delete){
		if( file_exists($file_link)){
			unlink($file_link);
		}
	
	echo "<script>alert('A product has been deleted!')</script>";
	echo "<script>window.open('index.php?view_products','_self')</script>";
	}
	else{
	
		echo "<script>alert('There is some error in deleting this product!')</script>";
		echo "<script>window.open('index.php?view_products','_self')</script>";
		}
	
	}





?>
<?php 


if(!isset($_SESSION['user_email'])){
	
	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {

?>


<table width="795" align="center" class="bg-blueviolet"> 

	
	<tr align="center">
		<td colspan="6"><h2>View all orders here</h2></td>
	</tr>
	
	<tr align="center" bgcolor="skyblue">
		<th>S.N</th>
		<th>Customer<br>Name</th>
		<th>Product (S)</th>
		<th>Quantity</th>
		<th>Amount</th>
		<th>Invoice No</th>
		<th>Order Date</th>
		<th>Status</th>
	</tr>
	<?php 
	include("includes/db.php");
	
	$get_order = "select * from orders";
	
	$run_order = mysqli_query($con, $get_order); 
	
	$i = 0;
	
	while ($row_order=mysqli_fetch_array($run_order)){
		
		$order_id = $row_order['order_id'];
		$qty = $row_order['qty'];
		$amt = $row_order['amount'];
		$curr = $row_order['currency'];
		$status = $row_order['status'];
		$pro_id = $row_order['p_id'];
		$c_id = $row_order['c_id'];
		$invoice_no = $row_order['invoice_no'];
		$order_date = $row_order['order_date'];
		$i++;
		
		$get_pro = "select * from products where product_id='$pro_id'";
		$run_pro = mysqli_query($con, $get_pro); 
		
		$row_pro=mysqli_fetch_array($run_pro); 
		
		$pro_image = $row_pro['product_image']; 
		$pro_title = $row_pro['product_title'];
		
		$get_c = "select * from customers where customer_id='$c_id'";
		$run_c = mysqli_query($con, $get_c); 
		
		$row_c=mysqli_fetch_array($run_c); 
		
		$c_email = $row_c['customer_email'];
		$c_name = $row_c['customer_name'];
	
	?>
	<tr align="left">
		<td><?php echo $i;?></td>
		<td><?php echo $c_name;?></td>
		<td>
		<?php echo $pro_title;?><br>
		<img src="../admin_area/product_images/<?php echo $pro_image;?>" width="50" height="50" />
		</td>
		<td><?php echo $qty;?></td>
		<td><?php echo $amt.' ' .$curr;?></td>
		<td><?php echo $invoice_no;?></td>
		<td><?php echo $order_date;?></td>
		<?php
		if($status == 'Shipped')
			echo "<td>$status</td>";
		else
			echo "<td><a href='index.php?confirm_order= $order_id' style='color:red'> Complete Order</a></td>";
		?>
		
	
	</tr>
	<?php } ?>
</table>

<?php } ?>
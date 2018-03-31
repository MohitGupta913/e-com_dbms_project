<?php
	if(!isset($_SESSION['customer_email'])){
		echo "<script>window.open('../checkout.php','_self')</script>";
	}
	else{
?>

		
		<?php 	
				include("includes/db.php"); 
				
				$user = $_SESSION['customer_email'];
				
				$get_customer = "select * from customers where customer_email='$user'";
				
				$run_customer = mysqli_query($con, $get_customer); 
				
				$row_customer = mysqli_fetch_array($run_customer); 
				
				$c_id = $row_customer['customer_id'];
				$name = $row_customer['customer_name'];
				$email = $row_customer['customer_email'];
				$pass = $row_customer['customer_pass'];
				$country = $row_customer['customer_country'];
				$city = $row_customer['customer_city'];
				$contact = $row_customer['customer_contact'];
				$address= $row_customer['customer_address'];
				$image = $row_customer['customer_image'];
				$secret = $row_customer['customer_secret'];
				
		?>
			
		<form action="" method="post" enctype="multipart/form-data">
					
					<table align="center" width="750">
						
						<tr align="center">
							<td colspan="6"><h2>Update your Account</h2></td>
						</tr>
						
						<tr>
							<td align="right">Customer Name:</td>
							<td><input type="text" name="c_name" value="<?php echo $name;?>" required/></td>
						</tr>
						
						<tr>
							<td align="right">Customer Email:</td>
							<td><input type="text" name="c_email" value="<?php echo $email;?>" required/></td>
						</tr>
						
						<tr>
							<td align="right">Customer Password:</td>
							<td><input type="password" name="c_pass" value="<?php echo $pass;?>" required/></td>
						</tr>
						
						<tr>
							<td align="right">Customer Image:</td>
							<td><input type="file" name="c_image"/><img src="customer_images/<?php echo $image; ?>" width="50" height="50"/></td>
						</tr>
						
						
						
						<tr>
							<td align="right">Customer Country:</td>
							<td>
							<select name="c_country" disabled>
								<option><?php echo $country; ?></option>
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
							<td><input type="text" name="c_city" value="<?php echo $city;?>"/></td>
						</tr>
						
						<tr>
							<td align="right">Customer Contact:</td>
							<td><input type="text" name="c_contact" value="<?php echo $contact;?>"/></td>
						</tr>
						
						<tr>
							<td align="right">Customer Address</td>
							<td><input type="text" name="c_address" value="<?php echo $address;?>"/></td>
						</tr>

						<tr>
							<td align="right">Customer Secret</td>
							<td><input type="text" name="c_secret" value="<?php echo $secret;?>"/></td>
						</tr>
						
						
					<tr align="center">
						<td colspan="6"><input type="submit" name="update" value="Update Account" /></td>
					</tr>
					
					
					
					</table>
				
				</form>
		
		
		
	
<?php 

	$e_check= 1;

	if(isset($_POST['c_email'])){
		$email_id = $_POST['c_email'];
		$num_rows=0;
		if($email_id!=$_SESSION['customer_email']){
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
	}




	if(isset($_POST['update']) &&  $num_rows==0  && $e_check){
	
		
		$ip = getIp();
		
		$customer_id = $c_id;
		
		$c_name = $_POST['c_name'];
		$c_email = $_POST['c_email'];
		$c_pass = $_POST['c_pass'];
		$c_image = $_FILES['c_image']['name'];
		$c_image_tmp = $_FILES['c_image']['tmp_name'];
		$c_city = $_POST['c_city'];
		$c_contact = $_POST['c_contact'];
		$c_address = $_POST['c_address'];
		$c_secret = $_POST['c_secret'];
	
		
		move_uploaded_file($c_image_tmp,"customer_images/$c_image");
		
		 $update_c = "update customers set customer_name='$c_name', customer_email='$c_email', customer_pass='$c_pass',customer_city='$c_city', customer_contact='$c_contact',customer_address='$c_address',customer_image='$c_image', customer_secret='$c_secret' where customer_id='$customer_id'";
	
		$run_update = mysqli_query($con, $update_c); 
		
		if($run_update){
		
		echo "<script>alert('Your account successfully Updated')</script>";
		echo "<script>window.open('my_account.php','_self')</script>";
		
		}
		else{
		
			echo "<script>alert('There is some error in updating your account!')</script>";
			echo "<script>window.open('my_account.php','_self')</script>";
			
			}
	}





?>

	<?php } ?>










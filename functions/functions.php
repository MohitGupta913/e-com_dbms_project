<?php 
// After uploading to online server, change this connection accordingly
$con = mysqli_connect("localhost","root","","ecommerce");

if (mysqli_connect_errno())
  {
  echo "The Connection was not established: " . mysqli_connect_error();
  }
 // getting the user IP address
  function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}
  
  
  
//creating the shopping cart
function cart(){

if(isset($_GET['add_cart'])){

	global $con; 
	
	$ip = getIp();
	
	$pro_id = $_GET['add_cart'];

	$check_pro = "select * from cart where ip_add='$ip' AND p_id='$pro_id'";
	
	$run_check = mysqli_query($con, $check_pro); 
	
	if(mysqli_num_rows($run_check)>0){

	echo "";
	
	}
	else {
	
	$insert_pro = "insert into cart (p_id,ip_add,qty) values ('$pro_id','$ip', 1)";
	
	$run_pro = mysqli_query($con, $insert_pro); 
	
	echo "<script>window.open('index.php','_self')</script>";
	}
	
}

}
 // getting the total added items
 
 function total_items(){
 
	if(isset($_GET['add_cart'])){
	
		global $con; 
		
		$ip = getIp(); 
		
		$get_items = "select * from cart where ip_add='$ip'";
		
		$run_items = mysqli_query($con, $get_items); 
		
		$count_items = mysqli_num_rows($run_items);
		
		}
		
		else {
		
		global $con; 
		
		$ip = getIp(); 
		
		$get_items = "select * from cart where ip_add='$ip'";
		
		$run_items = mysqli_query($con, $get_items); 
		
		$count_items = mysqli_num_rows($run_items);
		
		}
	
	echo $count_items;
	}
  
// Getting the total price of the items in the cart 
	
	function total_price(){
	
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
			
			$values = array_sum($product_price);
			$values*=$pro_qty;
			
			$total +=$values;
			
			}
		
		
		}
		
		echo "$" . $total;
		
	
	}

//getting the categories

function getCats(){
	
	global $con; 

	
	$get_cats = "select * from categories";
	
	$run_cats = mysqli_query($con, $get_cats);
	
	while ($row_cats=mysqli_fetch_array($run_cats)){
	
		$cat_id = $row_cats['cat_id']; 
		$cat_title = $row_cats['cat_title'];
	
	echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
	
	
	}


}

//getting the brands

function getBrands(){
	
	global $con; 
	
	$get_brands = "select * from brands";
	
	$run_brands = mysqli_query($con, $get_brands);
	
	while ($row_brands=mysqli_fetch_array($run_brands)){
	
		$brand_id = $row_brands['brand_id']; 
		$brand_title = $row_brands['brand_title'];
	
	echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
	
	
	}
}

function getPro(){

	if(!isset($_GET['cat'])){
		if(!isset($_GET['brand'])){
			if(!isset($_POST['filter'])){

	global $con; 
	
	$get_pro = "select * from products order by RAND() LIMIT 0,6";

	$run_pro = mysqli_query($con, $get_pro); 
	
	while($row_pro=mysqli_fetch_array($run_pro)){
	
		$pro_id = $row_pro['product_id'];
		$pro_cat = $row_pro['product_cat'];
		$pro_brand = $row_pro['product_brand'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_image'];
	
		echo "
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					
					<img src='admin_area/product_images/$pro_image' width='180' height='180' />
					
					<p><b> Price: $ $pro_price </b></p>
					
					<a href='details.php?pro_id=$pro_id' style='float:left; color:black'>Details</a>
					
					<a href='index.php?add_cart=$pro_id'><button style='float:right' type='button' class='btn btn-success'>Add to Cart</button></a>
				
				</div>
		
		
		";
	
	}
	}
	}
}

}

function getRecomPro(){
	if(!isset($_GET['cat'])){
		if(!isset($_GET['brand'])){
			if(!isset($_POST['filter'])){
	global $con; 
	$t_p = 30;
	$email = $_SESSION['customer_email'];
	$find_c = "select * from customers where customer_email='$email'";
	$run_c = mysqli_query($con, $find_c);
	$c =mysqli_fetch_array($run_c);
	$cust_id = $c['customer_id'];

	$pro = "select product_cat from products p inner join orders o on p.product_id = o.p_id where o.c_id='$cust_id' group by product_cat having count(*)>1 order by count(*) desc";
	$run_pr = mysqli_query($con, $pro);
	$count_p = mysqli_num_rows($run_pr);
	if($count_p!=0) echo "<h1>Deals recommended for you</h1>";

	while($row_pr=mysqli_fetch_array($run_pr)){
		$pro_c = $row_pr['product_cat'];
		$x = "select * from products where product_cat='$pro_c' order by RAND() LIMIT 0,3";

		$run_pro = mysqli_query($con, $x); 
		$count_pro = mysqli_num_rows($run_pro);
		$t_p = $t_p-$count_pro;
		

		while($row_pro=mysqli_fetch_array($run_pro)){
		
			$pro_id = $row_pro['product_id'];
			$pro_cat = $row_pro['product_cat'];
			$pro_brand = $row_pro['product_brand'];
			$pro_title = $row_pro['product_title'];
			$pro_price = $row_pro['product_price'];
			$pro_image = $row_pro['product_image'];
		
			echo "
					<div id='single_product'>
					
						<h3>$pro_title</h3>
						
						<img src='admin_area/product_images/$pro_image' width='180' height='180' />
						
						<p><b> Price: $ $pro_price </b></p>
						
						<a href='details.php?pro_id=$pro_id' style='float:left;color:black;'>Details</a>
						
						<a href='index.php?add_cart=$pro_id'><button style='float:right;' type='button' class='btn btn-success'>Add to Cart</button></a>
					
					</div>
			
			
			";
		
		}
	}
	
	if($t_p>0&&$count_p!=0) echo "<br><div><h1>Other Products</h1></div>";

	$xy = "select * from products where product_cat not in (select product_cat from products p inner join orders o on p.product_id = o.p_id where o.c_id='$cust_id' group by product_cat having count(*)>1 order by count(*) desc) order by RAND() LIMIT 0,$t_p";

	$xyz = mysqli_query($con, $xy); 
	
	while($row_p=mysqli_fetch_array($xyz)){
	
		$pro_id = $row_p['product_id'];
		$pro_cat = $row_p['product_cat'];
		$pro_brand = $row_p['product_brand'];
		$pro_title = $row_p['product_title'];
		$pro_price = $row_p['product_price'];
		$pro_image = $row_p['product_image'];
	
		echo "
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					
					<img src='admin_area/product_images/$pro_image' width='180' height='180' />
					
					<p><b> Price: $ $pro_price </b></p>
					
					<a href='details.php?pro_id=$pro_id' style='float:left; color:black;'>Details</a>
					
					<a href='index.php?add_cart=$pro_id'><button style='float:right;' type='button' class='btn btn-success'>Add to Cart</button></a>
				
				</div>
		
		
		";
	
	}

			}}}
}

function getCatPro(){

	if(isset($_GET['cat'])){
		
		$cat_id = $_GET['cat'];

	global $con; 
	
	$get_cat_pro = "select * from products where product_cat='$cat_id'";

	$run_cat_pro = mysqli_query($con, $get_cat_pro); 
	
	$count_cats = mysqli_num_rows($run_cat_pro);
	
	if($count_cats==0){
	
	echo "<h2 style='padding:20px;'>No products where found in this category!</h2>";
	
	}
	
	while($row_cat_pro=mysqli_fetch_array($run_cat_pro)){
	
		$pro_id = $row_cat_pro['product_id'];
		$pro_cat = $row_cat_pro['product_cat'];
		$pro_brand = $row_cat_pro['product_brand'];
		$pro_title = $row_cat_pro['product_title'];
		$pro_price = $row_cat_pro['product_price'];
		$pro_image = $row_cat_pro['product_image'];
	
		echo "
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					
					<img src='admin_area/product_images/$pro_image' width='180' height='180' />
					
					<p><b> $ $pro_price </b></p>
					
					<a href='details.php?pro_id=$pro_id' style='float:left; color:black'>Details</a>
					

					<a href='index.php?add_cart=$pro_id'><button style='float:right' type='button' class='btn btn-success'>Add to Cart</button></a>		
				</div>
		
		";
		
	
	}
	
}

}

function filter(){
	if(isset($_POST['filter'])){
		global $con;
		$pro_cat = $_POST['filter_cat'] ;
		$pro_brand = $_POST['filter_brand'] ;
		if($pro_cat!=0 && $pro_brand!=0){
		if($_POST['order']==1){
			$fetch_pro = "select * from products where product_cat='$pro_cat' and product_brand='$pro_brand' order by product_price asc";
		}
		else if($_POST['order']==2 ){
			$fetch_pro = "select * from products where product_cat='$pro_cat' and product_brand='$pro_brand' order by product_price desc";
		}
	}

		else if($pro_cat!=0 && $pro_brand==0){
			if($_POST['order']==1){
				$fetch_pro = "select * from products where product_cat='$pro_cat'  order by product_price asc";
			}
			else if($_POST['order']==2 ){
				$fetch_pro = "select * from products where product_cat='$pro_cat'  order by product_price desc";
			}
		}
		else if($pro_cat==0 && $pro_brand!=0){
			if($_POST['order']==1){
				$fetch_pro = "select * from products where  product_brand='$pro_brand' order by product_price asc";
			}
			else if($_POST['order']==2 ){
				$fetch_pro = "select * from products where product_brand='$pro_brand' order by product_price desc";
			}
		}
		else{
			if($_POST['order']==1){
				$fetch_pro = "select * from products order by product_price asc";
			}
			else if($_POST['order']==2 ){
				$fetch_pro = "select * from products order by product_price desc";
			}
		}
	
		$run_pro = mysqli_query($con, $fetch_pro);

		while($row_pro=mysqli_fetch_array($run_pro)){
	
			$pro_id = $row_pro['product_id'];
			$pro_cat = $row_pro['product_cat'];
			$pro_brand = $row_pro['product_brand'];
			$pro_title = $row_pro['product_title'];
			$pro_price = $row_pro['product_price'];
			$pro_image = $row_pro['product_image'];
		
			echo "
					<div id='single_product'>
					
						<h3>$pro_title</h3>
						
						<img src='admin_area/product_images/$pro_image' width='180' height='180' />
						
						<p><b> $ $pro_price </b></p>
						
						<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
						
						<a href='index.php?add_cart=$pro_id'><button style='float:right' type='button' class='btn btn-success'>Add to Cart</button></a>
					
					</div>
			
			";
			
		
		}
	}
}


function getBrandPro(){

	if(isset($_GET['brand'])){
		
		$brand_id = $_GET['brand'];

	global $con; 
	
	$get_brand_pro = "select * from products where product_brand='$brand_id'";

	$run_brand_pro = mysqli_query($con, $get_brand_pro); 
	
	$count_brands = mysqli_num_rows($run_brand_pro);
	
	if($count_brands==0){
	
	echo "<h2 style='padding:20px;'>No products where found associated with this brand!!</h2>";
	
	}
	
	while($row_brand_pro=mysqli_fetch_array($run_brand_pro)){
	
		$pro_id = $row_brand_pro['product_id'];
		$pro_cat = $row_brand_pro['product_cat'];
		$pro_brand = $row_brand_pro['product_brand'];
		$pro_title = $row_brand_pro['product_title'];
		$pro_price = $row_brand_pro['product_price'];
		$pro_image = $row_brand_pro['product_image'];
	
		echo "
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					
					<img src='admin_area/product_images/$pro_image' width='180' height='180' />
					
					<p><b> $ $pro_price </b></p>
					
					<a href='details.php?pro_id=$pro_id' style='float:left; color:black'>Details</a>
					

					<a href='index.php?add_cart=$pro_id'><button style='float:right' type='button' class='btn btn-success'>Add to Cart</button></a>				
				</div>
		
		";
		
	
	}
	
}
}


?>
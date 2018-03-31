<!DOCTYPE>
<?php 
session_start();
include("functions/functions.php");

?>
<html>
	<head>
		<title>My Online Shop</title>
		
		
		<meta charset="utf-8"> 
    <meta name="viewport" content="width=1000px, initial-scale=1">	 
	<link rel="stylesheet" href="styles/style.css" media="all" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
	</head>
	
<body background="images/ecommerce2.jpg">
	
	<!--Main Container starts here-->
	<div class="main_wrapper">
	
		<!--Header starts here-->
		<div class="header_wrapper">
		
		<a href="index.php"><img id="logo" src="images/logo_new.jpg" /> </a>
			<img id="banner" src="images/jet-1.gif" />
		</div>
		<!--Header ends here-->
		
		<!--Navigation Bar starts-->
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <ul class="nav navbar-nav">
			  <li><a href="index.php">Home</a></li>
			  <li><a href="all_products.php">All Products</a></li>
			  <li><a href="customer/my_account.php">My Account</a></li>
	          <li><a href="customer_register.php">Sign Up</a></li>
			  <li><a href="cart.php">Shopping Cart</a></li>
			  <li><a href="#">Contact Us</a></li>

			</ul>
			<form class="navbar-form navbar-left" action="results.php" enctype="multipart/form-data" method="get">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="user_query">
                  <div class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="search">
                      <i class="glyphicon glyphicon-search"></i>
                    </button>
                  </div>
              </div>
            </form>

		  
		  </div>
		</nav>
		<!--Navigation Bar ends-->
	
		<!--Content wrapper starts-->
		<div class="content_wrapper">
		
		<nav id="sidebar">
			  <div class="sidebar-header">
			    <h3>Categories</h3>
			  </div>
			  <ul class="list-unstyled components">
			    <?php getCats(); ?>
			  </ul>
			  <div class="sidebar-header">
			    <h3>Brands</h3>
			  </div>
			  <ul class="list-unstyled components">
			    <?php getBrands(); ?>
			  </ul>
			  
		</nav>
		
			<div id="content_area">
			
			<?php cart(); ?>
			
			<div id="shopping_cart"> 
					
					<span style="float:right; font-size:18px; padding:5px; line-height:40px;">
					
					<?php 
					if(isset($_SESSION['customer_email'])){
					echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style='color:yellow;'>Your</b>" ;
					}
					else {
					echo "<b>Welcome Guest:</b>";
					}
					?>
					
					
					<b style="color:yellow">Shopping Cart -</b> Total Items: <?php total_items();?> Total Price: <?php total_price(); ?> <a href="cart.php" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-shopping-cart" ></span> Shopping Cart</a>
					
					
					
					</span>
			</div>
			
				<div id="products_box">
                <h2>Reset Password!</h2>
				<br>
                    <?php if(isset($_GET['enter_email'])){ ?>
                    <form method="post" action=""> 
                
                <table width="500" align="center" bgcolor="skyblue"> 
                    
                    <tr align="center">
                        <td colspan="3"><h2>Enter Email Id</h2></td>
                    </tr>
                    
                    <tr>
                        <td align="right"><b>Email:</b></td>
                        <td><input type="text" name="email" placeholder="enter email" required class="form-control"/></td>
                    </tr>

					<tr>
                        <td align="right"><b>Secret:</b></td>
                        <td><input type="text" name="secret" placeholder="enter your secret" required class="form-control"/></td>
                    </tr>
                    
                    <tr align="center">
                        <td colspan="3"><input type="submit" name="submit_email" value="Submit Email Id" class="btn btn-success"/></td>
                    </tr>
                    
                
                
                </table> 
	
			
    </form>
                    <?php }
                    
                    if(isset($_GET['reset_pass'])){?>
                        <form method="post" action=""> 
                
                <table width="500" align="center" bgcolor="skyblue"> 
                    
                    <tr align="center">
                        <td colspan="3"><h2>Enter new password!</h2></td>
                    </tr>
                    
                    <tr>
                        <td align="right"><b>Enter New Pasword:</b></td>
                        <td><input type="password" name="n_pass" placeholder="password" required class="form-control"/></td>
                    </tr>

                    <tr>
                        <td align="right"><b>Confirm New Pasword:</b></td>
                        <td><input type="password" name="c_pass" placeholder="password" required class="form-control"/></td>
                    </tr>
                    
                    <tr align="center">
                        <td colspan="3"><input type="submit" name="submit_pass" value="Submit Password" /></td>
                    </tr>
                    
                
                
                </table> 
	
			
    </form>
                    <?php } ?>
				
				</div>
			
			</div>
		</div>
		<!--Content wrapper ends-->
		
		
		
		<div id="footer">
		<a href="#" class="fa fa-facebook"></a>
<a href="#" class="fa fa-twitter"></a>
<a href="#" class="fa fa-google"></a>
<a href="#" class="fa fa-linkedin"></a>
<a href="#" class="fa fa-youtube"></a>
<a href="#" class="fa fa-instagram"></a>
		
		<h2 style="text-align:center; padding-top:30px;">E-Commerce DBMS Project<br>Made By Mohit Gupta, Rahul Singh Rawat and Saif Haque<br>&copy; All Rights Reserved.</h2>
		
		</div>
	
	
	
	
	
	
	</div> 
<!--Main Container ends here-->


</body>
</html>

<?php 
if(isset($_POST['submit_email'])){
	
	$c_email = $_POST['email'];
	$c_secret = $_POST['secret'];
    
    $sel_c = "select * from customers where customer_email='$c_email' and customer_secret='$c_secret'";
    
    $run_c = mysqli_query($con, $sel_c);
    
    $check_customer = mysqli_num_rows($run_c); 
    
    if($check_customer==0){
    
    echo "<script>alert('Email or secret is not correct, plz try again!')</script>";
    echo "<script>window.open('forgot_pass.php?enter_email','_self')</script>";
    exit();
    }
    
    else {
        $_SESSION['customer_email']=$c_email; 
    
    //echo "<script>alert('You logged in successfully, Thanks!')</script>";
    echo "<script>window.open('forgot_pass.php?reset_pass','_self')</script>";
    
    
    }
}

if(isset($_POST['submit_pass'])){
	
    $new_pass = $_POST['n_pass'];
    $con_pass = $_POST['c_pass'];

    if($new_pass!=$con_pass){
        echo "<script>alert('New and confirm password are not same, plz try again!')</script>";
        echo "<script>window.open('forgot_pass.php?reset_pass','_self')</script>";
        exit();
    }
    else{
        $email = $_SESSION['customer_email'];
        $find_c = "update customers set customer_pass='$new_pass' where customer_email='$email'";
    
		$f_c = mysqli_query($con, $find_c);
		
		//$up_customer = mysqli_num_rows($f_c); 
		if(f_c){
			session_destroy(); 
			echo "<script>alert('Password updated Successfully!')</script>";
			echo "<script>window.open('checkout.php','_self')</script>";
		}
		else{
			session_destroy(); 
			echo "<script>alert('There is some error in changing password!')</script>";
			echo "<script>window.open('checkout.php','_self')</script>";
		}
    
	}
    
    
}

?>
<?php 

session_start(); 

session_destroy(); 

echo "<script>alert('You logged out successfully!')</script>";
echo "<script>window.open('../index.php','_self')</script>";


?>
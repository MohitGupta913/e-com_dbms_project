<?php 
session_start(); 

session_destroy(); 

echo "<script>window.open('login.php?logged_out=You have logged out successfully!','_self')</script>";




?> 
-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2018 at 03:24 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `user_id` int(10) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`user_id`, `user_email`, `user_pass`) VALUES
(1, 'awpareshan@gmail.com', 'wali'),
(2, 'saima@yahoo.com', 'khan');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'HP'),
(2, 'DELL'),
(3, 'LG'),
(4, 'Samsung'),
(5, 'Sony'),
(6, 'Toshiba');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Laptops'),
(2, 'Cameras'),
(3, 'Mobiles'),
(4, 'Computers'),
(5, 'Banana'),
(6, 'iPhones'),
(7, 'Tablets');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_ip` varchar(255) NOT NULL,
  `customer_name` text NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_image` text NOT NULL,
  `customer_secret` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_ip`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`, `customer_secret`) VALUES
(8, '::1', 'Rahul Singh Rawat', 'rahulrawat1210@yahoo.co.in', 'rahul', 'India', 'Delhi', '565467', 'D-58 Galli No.-3 East Vinod Nagar', 'paypal.png', 'rahul'),
(11, '::1', 'saif haque', 'saif@gmail.com', 'saifhaque', 'India', 'Delhi', '86576499', 'D-58 Galli No.-3 East Vinod Nagar', '', 'saif');

--
-- Triggers `customers`
--
DELIMITER $$
CREATE TRIGGER `customer_backup` BEFORE DELETE ON `customers` FOR EACH ROW BEGIN
INSERT INTO cust_backup  VALUES (OLD.customer_id, OLD.customer_ip, OLD.customer_name, OLD.customer_email, OLD.customer_pass, OLD.customer_country, OLD.customer_city, OLD.customer_contact, OLD.customer_address, OLD.customer_image);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cust_backup`
--

CREATE TABLE `cust_backup` (
  `customer_id` int(10) NOT NULL,
  `customer_ip` varchar(255) NOT NULL,
  `customer_name` text NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cust_backup`
--

INSERT INTO `cust_backup` (`customer_id`, `customer_ip`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`) VALUES
(0, '::1', 'rsr', 'rahul@gmail.com', 'rahul', 'India', 'delhi', '987898789', 'dgh', 'paypal_button.png'),
(1, '::1', 'Rahul Singh Rawat', 'rahulrawat1210@yahoo.co.in', 'rahul', 'India', 'Delhi', '9939', 'D-58 Galli No.-3 East Vinod Nagar', 'paypal_button.png'),
(7, '::1', 'Rahul Singh Rawat', 'rahulrawat1210@yahoo.co.in', 'rahul', 'India', 'Delhi', '09821889422', 'east vinod nagar', 'favicon.ico'),
(8, '::1', 'rar', 'rahul@gmail.com', 'rahul', 'India', 'Delhi', '456123789', 'D-58 Galli No.-3 East Vinod Nagar', 'paypal.png');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `d_id` int(10) NOT NULL,
  `d_name` varchar(255) NOT NULL,
  `d_email` varchar(255) NOT NULL,
  `d_password` varchar(100) NOT NULL,
  `d_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`d_id`, `d_name`, `d_email`, `d_password`, `d_phone`) VALUES
(1, 'mohan', 'mohan@gmail.com', 'mohan', '9878789867'),
(2, 'ramesh kumar', 'ramesh@gmail.com', 'ramesh', '9878788987');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(100) NOT NULL,
  `p_id` int(100) NOT NULL,
  `c_id` int(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `invoice_no` int(100) NOT NULL,
  `status` text NOT NULL,
  `order_date` date NOT NULL,
  `order_delivery` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `p_id`, `c_id`, `qty`, `amount`, `currency`, `invoice_no`, `status`, `order_date`, `order_delivery`) VALUES
(5, 8, 5, 1, 0, '', 462643381, 'Shipped', '0000-00-00', 0),
(6, 6, 5, 3, 0, '', 481994459, 'Paid', '2014-07-21', 2),
(7, 9, 0, 1, 0, '', 1545302558, 'Paid', '2014-07-23', 2),
(8, 5, 0, 2, 0, '', 705705316, 'Shipped', '2014-08-08', 0),
(9, 7, 6, 1, 0, '', 1935681132, 'Paid', '2014-08-08', 2),
(10, 9, 6, 3, 0, '', 1817786416, 'in Progress', '2014-08-08', 0),
(11, 5, 6, 2, 0, '', 423122154, 'in Progress', '2014-08-08', 0),
(12, 8, 6, 4, 0, '', 496641685, 'in Progress', '2014-08-08', 0),
(13, 8, 6, 1, 450, 'USD', 370935809, 'in Progress', '2018-03-29', 0),
(14, 8, 6, 1, 1550, 'USD', 1888421494, 'in Progress', '2018-03-29', 0),
(15, 11, 6, 1, 1400, 'USD', 1239155451, 'in Progress', '2018-03-29', 0),
(16, 0, 6, 1, 0, 'USD', 1918677737, 'in Progress', '2018-03-29', 0),
(17, 0, 7, 1, 0, 'USD', 1208155700, 'in Progress', '2018-03-30', 0),
(18, 9, 8, 1, 750, 'USD', 1753555780, 'Shipped', '2018-03-31', 0),
(19, 7, 8, 2, 500, 'USD', 852968912, 'Shipped', '2018-03-31', 0),
(20, 10, 8, 1, 400, 'USD', 1905018615, 'Shipped', '2018-03-31', 0),
(21, 9, 11, 1, 500, 'USD', 1273673945, 'in Progress', '2018-03-31', 0),
(22, 10, 11, 1, 400, 'USD', 106197433, 'in Progress', '2018-03-31', 0),
(23, 9, 8, 2, 1000, 'USD', 993148793, 'Shipped', '2018-04-03', 0),
(24, 10, 8, 1, 400, 'USD', 342868480, 'Shipped', '2018-04-07', 0),
(25, 7, 8, 1, 250, 'USD', 1218230372, 'Paid', '2018-04-07', 2),
(26, 9, 8, 1, 500, 'USD', 1301479772, 'Paid', '2018-04-07', 1),
(27, 7, 8, 1, 250, 'USD', 1246389755, 'Paid', '2018-04-07', 2),
(28, 10, 8, 1, 400, 'USD', 1698935958, 'Paid', '2018-04-07', 2);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `customer_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `currency` text NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `amount`, `customer_id`, `product_id`, `trx_id`, `currency`, `payment_date`) VALUES
(1, 800, 5, 6, '31B07494JS505133P', 'USD', '0000-00-00'),
(2, 500, 5, 9, '18747053K31546734', 'USD', '0000-00-00'),
(3, 1000, 5, 9, '183154524M7953521', 'USD', '0000-00-00'),
(4, 900, 5, 5, '8L053110TE658224T', 'USD', '2014-07-21'),
(5, 450, 5, 8, '42M62596JN658381G', 'USD', '2014-07-21'),
(6, 600, 5, 6, '1FC71986FP579232R', 'USD', '2014-07-21'),
(7, 500, 0, 9, '0AH67056C64289013', 'USD', '2014-07-23'),
(8, 1800, 0, 5, '1F431738AY795223E', 'USD', '2014-08-08'),
(9, 250, 6, 7, '3G918931JL634141Y', 'USD', '2014-08-08'),
(10, 1500, 6, 9, '0BF7586175203573G', 'USD', '2014-08-08'),
(11, 1800, 6, 5, '7RS823437E828061K', 'USD', '2014-08-08'),
(12, 1800, 6, 8, '84J65197FN011600G', 'USD', '2014-08-08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES
(5, 0, 0, 'Samsung Camera', 1000, '<p>This is a great samsung mobile, you must buy it in order to have some really good fun.&nbsp;</p>', '', 'Samsung, Cameras, Special'),
(7, 2, 6, 'Toshiba Camera ', 250, '<p>This is a great camera...</p>', 'professional-video-camera.jpg', 'Toshiba, cameras, Special'),
(8, 3, 5, 'Nokia Tablet', 450, '<p>this is a great thing....</p>', 'nokia-windows-200-dollar-tablet2-640x353.jpg', 'Samsung, Cameras, Special'),
(9, 1, 2, 'Dell Pink Laptop', 500, '<p>this is a very nice <strong>laptop</strong> and I like it very much....</p>', '1.jpg', 'dell, laptops, new, special'),
(10, 1, 1, 'HP Envy Laptop', 400, '<p>this is so much nice laptop..</p>', 'original.jpg', 'dell, laptops, new, special'),
(11, 1, 2, 'Dell Laptop 123', 1000, '<p>this is a dell laptop!</p>', '', 'dell, laptop');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `cust_backup`
--
ALTER TABLE `cust_backup`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cust_backup`
--
ALTER TABLE `cust_backup`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `d_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

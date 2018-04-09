-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2018 at 02:41 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

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
(3, 'rahul@gmail.com', 'ýŸ¤qÃü4ÍS¬m8>òÖŸ'),
(4, 'mohit@gmail.com', 'U±œPù8½§ÚJã›òá'),
(5, 'saif@gmail.com', '=R–]\Z‰-NŠÞ¦¿<Ül');

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
(3, 'Apple'),
(4, 'Samsung'),
(5, 'Sony'),
(6, 'Toshiba'),
(7, 'Motorola'),
(8, 'Nikon'),
(9, 'Acer'),
(10, 'Asus'),
(11, 'Canon'),
(12, 'Lenovo'),
(13, 'HTC'),
(14, 'OnePlus'),
(15, 'Nokia'),
(16, 'Panasonic');

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
(5, 'Tablets');

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
(8, '::1', 'Rahul Singh Rawat', 'rahulrawat1210@yahoo.co.in', 'ýŸ¤qÃü4ÍS¬m8>òÖŸ', 'India', 'Delhi', '565467', 'D-58 Galli No.-3 East Vinod Nagar', 'breaking_bad_walter_white_bryan_cranston_skyler_white_anna_gunn_jesse_pinkman_98465_1920x1080.jpg', 'rahul'),
(12, '::1', 'Mohit Gupta', 'mohit@yahoo.com', 'U±œPù8½§ÚJã›òá', 'India', 'Delhi', '9897876789', 'shanti mohalla', 'WhatsApp Image 2018-01-05 at 10.11.32 AM.jpeg', 'mohit'),
(13, '::1', 'Saif Haque', 'saif@gmail.com', '=R–]\Z‰-NŠÞ¦¿<Ül', 'India', 'Delhi', '9767564534', 'VMH, DTU', 'PicsArt_12-17-12.03.08.jpg', 'saif');

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
(8, '::1', 'rar', 'rahul@gmail.com', 'rahul', 'India', 'Delhi', '456123789', 'D-58 Galli No.-3 East Vinod Nagar', 'paypal.png'),
(11, '::1', 'saif haque', 'saif@gmail.com', 'saifhaque', 'India', 'Delhi', '86576499', 'D-58 Galli No.-3 East Vinod Nagar', 'PicsArt_12-17-12.03.08.jpg');

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
(1, 'mohan', 'mohan@gmail.com', 'çé8O™r×æ¡Ò\"î#U', '9878789867'),
(2, 'ramesh kumar', 'ramesh@gmail.com', 'RS³{šR7~yëý\ZÎbS', '9878788987'),
(4, 'rajat', 'rajat@gmail.com', 'é~nì!†Fo)(xþ…õ', '9878564345');

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
(34, 13, 8, 1, 1500, 'USD', 1937311512, 'Paid', '2018-04-09', 2),
(33, 24, 8, 1, 8000, 'USD', 1425640089, 'Paid', '2018-04-09', 4),
(32, 24, 8, 2, 16000, 'USD', 1784473689, 'Paid', '2018-04-09', 2);

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
(12, 5, 3, 'IPad', 5000, '<p>This is a very good tablet</p>', '91QlrgIeLOL._SY355_.jpg', 'Apple Tablets IPad'),
(13, 3, 7, 'Moto G5', 1500, '<p>This is a great smartphone</p>', '260.jpg', 'Motorola Mobiles Moto G5'),
(14, 2, 5, 'Sony Cybershot', 1000, '<p>Great camera</p>', '810_0754-460.jpg', 'Sony Cameras Sony Cybershot'),
(15, 2, 8, 'Nikon D3400', 3800, '<p>Great camera</p>', '101428.jpg', 'Nikon Cameras Nikon D3400'),
(16, 1, 6, 'Toshiba Tecra', 4000, '<p>Great laptop</p>', '469221-toshiba-satellite-s55t.jpg', 'Toshiba Laptops Toshiba Tecra '),
(17, 4, 9, 'Acer Assembled', 5000, '<p>great computer</p>', 'acer-aspire-x3950-5804ec1d3df78cbc2882c2e8.jpg', 'Acer Computers Acer Assembled'),
(18, 5, 10, 'Asus ZenPad', 1600, '<p>great tablet</p>', 'asus_tablet_01.jpg', 'Asus Tablets Asus ZenPad'),
(19, 2, 11, 'Canon Ixus', 1000, '<p>great camera</p>', 'Canon-EOS-Rebel-T3i.jpg', 'Canon Cameras Canon Ixus'),
(20, 4, 3, 'Apple iMac', 10000, '<p>great computer</p>', 'Computers-To-Buy..png', 'Apple Computers Apple iMac'),
(21, 1, 9, 'Acer Switch', 1200, '<p>great laptop</p>', 'download (1).jpg', 'Acer Laptops Acer Switch'),
(22, 1, 10, 'Asus Vivobook', 2700, '<p>great laptop</p>', 'download (2).jpg', 'Asus Laptops Asus Vivobook'),
(23, 3, 4, 'Samsung Galaxy Note8', 7000, '<p>great mobile</p>', 'download (3).jpg', 'Samsung Mobiles Samsung Galaxy Note8'),
(24, 3, 3, 'Apple iPhone 8', 8000, '<p>great mobile</p>', 'download (4).jpg', 'Apple Mobiles Apple iPhone 8'),
(25, 1, 12, 'Lenovo Ideapad', 3000, '<p>great laptop</p>', 'download.jpg', 'Lenovo Laptops Lenovo Ideapad'),
(26, 5, 4, 'Samsung Galaxy', 4000, '<p>great tablet</p>', 'Galaxy-Tab-S3-press-release_main_1.jpg', 'Samsung Tablets Samsung Galaxy'),
(27, 0, 0, 'HTC Desire', 2000, '<p>great mobile</p>', 'htc-desire-510-white.jpg', 'HTC Mobiles HTC Desire'),
(28, 4, 1, 'HP AIO', 4000, 'great computer', 'k2-_15c0de7e-51a1-4046-ba0f-1e2e74b21a7e.v1.jpg', 'HP Computers HP AIO'),
(29, 1, 1, 'HP G5', 2000, '<p>great laptop</p>', 'Laptops-hp-Pro-Book-300x275.jpg', 'HP Laptops HP G5'),
(30, 5, 12, 'Lenovo Tab4', 5000, '<p>great tablet</p>', 'lenovo-tablets-500x500.jpg', 'Lenovo Tablets Lenovo Tab4'),
(31, 3, 14, 'OnePlus 5', 3500, '<p>great mobile</p>', 'Mobile-Phones-2017.jpg', 'OnePlus Mobiles OnePlus 5'),
(32, 1, 3, 'MacBook Air', 7000, '<p>great laptop</p>', 'mpxt2hna.jpg', 'Apple Laptops MacBook Air'),
(33, 4, 2, 'Dell Vostro', 5000, '<p>great computer</p>', 'nav_desktops_1115.jpg', 'Dell Laptops Dell Vostro'),
(34, 3, 15, 'Nokia 6', 2500, '<p>great mobile</p>', 'Nokia_2_front-600x800.jpg', 'Nokia Mobiles Nokia 6'),
(35, 3, 16, 'Panasonic Eluga', 2300, '<p>great mobile</p>', 'panasonic_eluga_turbo_2.jpg', 'Panasonic Mobiles Panasonic Eluga');

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
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cust_backup`
--
ALTER TABLE `cust_backup`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `d_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

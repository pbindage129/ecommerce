-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2019 at 06:57 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.37

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
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_num` varchar(10) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal_price` decimal(5,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_num`, `product_id`, `user_id`, `quantity`, `subtotal_price`, `total_price`, `payment`, `date`, `status`) VALUES

(1, '20_2_2', 1, 2, 1, '15.60', '15.60', 'Cradit card', '18-02-2019', 'placed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `product_cat` int(5) NOT NULL,
  `product_price` decimal(5,2) NOT NULL,
  `product_img` varchar(1000) NOT NULL,
  `product_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_cat`, `product_price`, `product_img`, `product_desc`) VALUES
(1, 'Mind is your Business', 1, '15.60', 'img/products_img/Mind_is_your_Business_1.jpg', 'This is about true friendship '),
(2, 'T-shirt', 2, '34.00', 'img/products_img/T-shirt_2.jpg', 'New Polo t-shirt'),
(3, 'Men Plain Shirt', 2, '24.20', 'img/products_img/Men_Plain_Shirt_1.jpg', 'LineKing\'s best product'),
(5, 'Rangriti Women\'s Straight Kurt', 3, '20.50', 'img/products_img/Rangriti_Womens_Straight_Kurt_3.jpg', 'Material: Cotton with three quarter sleeve Straight fit Mid thigh Wash separately in cold water, do ');

-- --------------------------------------------------------

--
-- Table structure for table `prod_cat`
--

CREATE TABLE `prod_cat` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prod_cat`
--

INSERT INTO `prod_cat` (`id`, `cat_name`) VALUES
(1, 'Books'),
(2, 'Men\'s Fashion'),
(3, 'Women\'s Fashion');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `user_name`, `email_id`, `password`, `mobile`, `active`) VALUES
(1, 'Admin ', 'admin@gmail.com', '0e7517141fb53f21ee439b355b5a1d0a', '9623145380', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `street1` varchar(30) NOT NULL,
  `street2` varchar(30) NOT NULL,
  `area` varchar(20) NOT NULL,
  `zipcode` int(6) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `profile_img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `street1`, `street2`, `area`, `zipcode`, `city`, `state`, `profile_img`) VALUES
(5, 2, 'street1', 'street2', 'kolhapur', 410209, 'kolhapur', 'Maharashtra', 'img/user_profiles/user_main.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `prod_cat`
--
ALTER TABLE `prod_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prod_cat`
--
ALTER TABLE `prod_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

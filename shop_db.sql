-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2022 at 02:14 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `p_id` int(100) NOT NULL,
  `category_id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `size` varchar(50) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `stocks` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(100) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Shirts'),
(2, 'Jackets'),
(3, 'Footwear'),
(8, 'Dresses'),
(16, 'Pants');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `p_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `size` varchar(100) NOT NULL,
  `product_photo` varchar(100) NOT NULL,
  `cart_products` varchar(1000) NOT NULL,
  `total_products` int(255) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `p_id`, `name`, `number`, `email`, `method`, `address`, `size`, `product_photo`, `cart_products`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(72, 20, 101, 'Customer01', '123456', 'one@mail.com', 'cash on delivery', 'house no. , National Road St. , Masbate City, Masbate - ', 'M', 'Light_pants.png', 'Light Pants for Men', 2, 1180, '11-Dec-2022', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `category_id` int(100) NOT NULL,
  `stocks` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `name`, `price`, `description`, `image`, `category_id`, `stocks`) VALUES
(87, 'Oversized T-Shirt Unisex Frog Design', '120.00', 'Its a cute, original unisex outfit. Only available in green color', 'palaka.png', 1, 3),
(88, 'Polo Shirt', '500.00', 'A close-fitting pullover often knit shirt with short or long sleeves and turnover collar or banded neck.', 'polo_shirt.jpg', 1, 3),
(89, 'Pink Dress', '400.00', 'An outer garment (as for a woman or girl) usually consisting of a one-piece bodice and skirt. Covering, adornment, or appearance appropriate or peculiar to a particular time.', 'pink_dress.jpg', 8, 1),
(90, 'Gray sweater', '500.00', 'Made of knitted or crocheted material. Good for winter season', 'sweater.jpg', 1, 3),
(91, 'Couple T-Shirt', '200.00', 'Our branded couples t shirt are based on quality and comfort that you can enjoy wearing them', 'cute_COUPLE_CAT.jpg', 1, 2),
(92, 'Red skirt for women', '450.00', 'Good quality skirt and is comfy to wear', 'red_skirt.jpg', 1, 2),
(93, 'Blue Dress', '500.00', 'Good for parties.', 'blue_dress.jpg', 8, 4),
(95, 'Jogger Pants', '500.00', '100% comfy', 'women_s_jogger_pants.jpg', 16, 3),
(96, 'Sandals Unisex', '400.00', 'Sandals that are built tough. Good for strong terrains', 'sandals_for_men.jpeg', 3, 3),
(97, 'Sandals for women', '300.00', 'Tough for rainy days. Made with leather', 'sandals_for_women.jpg', 3, 9),
(98, 'High Waist Skirt', '190.00', 'It is the silhouette of a garment sitting higher up between under the bust and the waist. Perfect for parties', 'high_waist_skirt.jpg', 8, 4),
(99, 'Trendy Sneakers Unisex', '500.00', 'Chunky lightweight Korean Sneakers', 'shoes_trendy.jpg', 3, -18),
(100, 'Khaki Hoodie Jacket', '600.00', 'High-quality, pre-shrunk heavy or lightweight fleece. Cool design', 'hoodie1.png', 2, 9),
(101, 'Light Pants for Men', '590.00', 'Incredibly lightweight and comfortable to wear', 'Light_pants.png', 16, 1),
(102, 'Women\'s Fine Merino Sweater', '790.00', '100% wool knit with an exquisite feel. In an elegant and relaxed cut. ', 'fine_merino_sweater.png', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `p_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `order_name` varchar(100) NOT NULL,
  `reviews` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `p_id`, `user_id`, `name`, `order_name`, `reviews`) VALUES
(28, 32, 16, 'hehe', 'Sweater Gray', 'Gandaaaa'),
(29, 30, 16, 'hhe', 'Polo Shirt', 'Good quality'),
(30, 30, 16, 'hhe', 'Polo Shirt', 'Good'),
(31, 101, 20, 'Customer01', 'Light Pants for Men', 'Good quality product!!! Highly recommended');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(16, 'buyer', 'buyer@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(17, 'seller', 'seller@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(18, 'seller1', 'seller1@mail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(19, 'buyer01', 'buyer@domain.com', '202cb962ac59075b964b07152d234b70', 'user'),
(20, 'buyer01', 'one@mail.com', '202cb962ac59075b964b07152d234b70', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
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
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

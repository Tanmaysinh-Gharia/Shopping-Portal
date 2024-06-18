-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 05:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `del_entry`
--

CREATE TABLE `del_entry` (
  `del_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `DandT` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `vend_id` int(11) NOT NULL,
  `stock` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `image`, `category_id`, `vend_id`, `stock`) VALUES
(1, 'Cannon EOS', 36000, 'img/cannon eos_7.jpg', 1, 7, 5),
(3, 'Sony DSLR', 50000, 'img/sony dslr_7.jpeg', 1, 7, 2),
(4, 'Olympus DSLR', 80000, 'img/olympus DSLR_7.jpg', 1, 9, 0),
(5, 'Titan Model 301', 13000, 'img/titan model 301_7.jpg', 2, 7, 4),
(6, 'Titan Model 201', 3000, 'img/titan model 201_7.jpg', 2, 7, 5),
(7, 'HMT Milan', 8000, 'img/hmt_7.JPG', 2, 7, 4),
(8, 'Favre Lueba 111', 18000, 'img/Favre Lueba 111_7.jpg', 2, 7, 3),
(9, 'Raymond', 1500, 'img/raymond_7.jpg', 3, 7, 5),
(10, 'Charles', 1000, 'img/charles_7.jpg', 3, 7, 5),
(11, 'HXR', 900, 'img/HXR_7.jpg', 3, 7, 5),
(12, 'PINK', 1200, 'img/PINK_7.jpg', 3, 7, 5),
(28, 'Ball Pen', 291, 'img/Ball Pen_9.jpg', NULL, 9, 28);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `sm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `user_id`, `sm_id`) VALUES
(31, '2024-06-16 18:30:00', 13, 11);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_id`, `item_id`, `qty`, `status`) VALUES
(31, 3, 1, 1),
(31, 28, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_ship`
--

CREATE TABLE `order_ship` (
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `DandT` timestamp NOT NULL DEFAULT current_timestamp(),
  `sm_id` int(11) NOT NULL,
  `cond` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sm_to_del_entry`
--

CREATE TABLE `sm_to_del_entry` (
  `sm_id` int(11) NOT NULL,
  `del_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `DandT` timestamp NOT NULL DEFAULT current_timestamp(),
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pincode` int(6) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `state` varchar(30) DEFAULT NULL
) ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`, `city`, `address`, `pincode`, `type`, `status`, `state`) VALUES
(6, 'Tanmaysinh', 'tanmay@gmail.com', '3eeaf7be03c71954ccf83df31c5cf23f', '7861088580', 'add', 'add', 393120, 5, 1, 'Gujarat'),
(7, 'Vendi', 'vendi@gmail.com', '106a003fe36a136e538a1df169a9a803', '1234567890', 'Surat', 'varacha', 395006, 2, 1, 'Gujarat'),
(9, 'Yolo', 'vendi2@gmail.com', 'e3f41186dc7a34414b9d481ebd59eeb8', '1234567890', 'Bharuch', 'asdsad', 393120, 2, 1, 'Gujarat'),
(10, 'Flip flop', 'vendi3@gmail.com', '7a239f7511de435f9e7fc10a308e66e3', '9898989898', 'SURAT', 'Varacha', 394110, 2, 1, 'Gujarat'),
(11, 'sm1', 'sm1@gmail.com', 'ea8d3457c9711532c9789274171bb009', '9898989898', 'BHARUCH', 'Umalla', 393120, 3, 1, 'Gujarat'),
(12, 'dhairya', 'dhairya@gmail.com', '92d41c9af01aaf1dc54466f3b11bede1', '9898989898', 'SURAT', 'Udhna', 394125, 1, 1, 'Gujarat'),
(13, 'Tan', 'tan@gmail.com', '61a194a6f7e7b9f474d07fe752519127', '9898989898', 'BHARUCH', 'BOOM', 393105, 1, 1, 'Gujarat'),
(14, 'sm2', 'sm2@gmail.com', 'fca61fdd59e198e6fb0aa6c57cd4ec8a', '9898989898', 'GANDHINAGAR', 'Gota', 382016, 3, 1, 'Gujarat'),
(15, 'sm3', 'sm3@gmail.com', '853f264fe0276fd4b4d4f5d623247792', '9898989898', 'AHMEDABAD', 'Gota', 382481, 3, 1, 'Gujarat'),
(16, 'del1', 'del1@gmail.com', 'c6efdaa812c42d1abe1966b0dd3fbb48', '9898989898', 'BHARUCH', 'boom bam', 393020, 4, 1, 'Gujarat'),
(17, 'c2', 'c2@gmail.com', '7cf6c2b08f4e689279df1f846ea4ee4d', '9898989898', 'BHARUCH', 'OITA', 393151, 1, 1, 'Gujarat'),
(18, 'del5', 'del5@gmail.com', 'f9813cf56ddf7ae43d24a62a89ddf82b', '9898989898', 'BHARUCH', 'TOO', 393151, 4, 1, 'Gujarat'),
(19, 'del4', 'del4@gmail.com', 'e9eb149496659ad5ea550af304e09d75', '9898989898', 'SURAT', 'asldasd', 394125, 3, 1, 'Gujarat');

-- --------------------------------------------------------

--
-- Table structure for table `users_items`
--

CREATE TABLE `users_items` (
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users_items`
--

INSERT INTO `users_items` (`user_id`, `item_id`, `quantity`) VALUES
(12, 1, 1),
(12, 3, 3),
(13, 28, 10),
(17, 7, 1),
(17, 28, 2),
(17, 5, 1),
(13, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `del_entry`
--
ALTER TABLE `del_entry`
  ADD PRIMARY KEY (`del_id`,`order_id`,`item_id`,`DandT`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_id`,`item_id`);

--
-- Indexes for table `order_ship`
--
ALTER TABLE `order_ship`
  ADD PRIMARY KEY (`order_id`,`item_id`,`DandT`);

--
-- Indexes for table `sm_to_del_entry`
--
ALTER TABLE `sm_to_del_entry`
  ADD PRIMARY KEY (`sm_id`,`del_id`,`order_id`,`item_id`,`DandT`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_items`
--
ALTER TABLE `users_items`
  ADD KEY `user_id` (`user_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_ord_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

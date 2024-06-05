
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `items` (`id`, `name`, `price`,`image`) VALUES
(1, 'Cannon EOS', 36000, 'img/cannon_eos.jpg'),
(2, 'Sony DSLR', 40000, 'img/sony_dslr.jpeg'),
(3, 'Sony DSLR', 50000, 'img/sony_dslr2.jpeg'),
(4, 'Olympus DSLR', 80000,'img/olympus.jpg'),
(5, 'Titan Model #301', 13000,'img/titan301.jpg'),
(6, 'Titan Model #201', 3000,'img/titan201.jpg'),
(7, 'HMT Milan', 8000,'img/hmt.JPG'),
(8, 'Favre Lueba #111', 18000,'img/favreleuba.jpg'),
(9, 'Raymond', 1500,'img/raymond.jpg'),
(10, 'Charles', 1000,'img/charles.jpg'),
(11, 'HXR', 900,'img/HXR.jpg'),
(12, 'PINK', 1200,'img/pink.jpg');


CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`, `city`, `address`) VALUES
(4, 'vaibhav B', 'vaibhavbavarava@gmail.com', '14e1b600b1fd579f47433b88e8d85291', '6263056779', 'GUJ', 'Morbi'),
(5, 'vaibhav', 'vaibhav@gmail.com', '14e1b600b1fd579f47433b88e8d85291', '9165063741', 'GUJ', 'Morbi');

CREATE TABLE `users_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `status` enum('Added to cart','Confirmed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users_items` (`id`, `user_id`, `item_id`, `status`) VALUES
(7, 3, 3, 'Added to cart'),
(8, 3, 4, 'Added to cart'),
(9, 3, 5, 'Added to cart'),
(10, 3, 11, 'Added to cart'),
(11, 1, 9, 'Added to cart'),
(12, 1, 2, 'Added to cart'),
(13, 1, 8, 'Added to cart'),
(14, 4, 2, 'Confirmed'),
(18, 5, 11, 'Added to cart'),
(20, 5, 5, 'Added to cart');

--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admins` (`email`, `password`) VALUES ('admin123@gmail.com', 'admin');

-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_items`
--
ALTER TABLE `users_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables

ALTER TABLE `users_items` 
ADD COLUMN `quantity` INT NOT NULL DEFAULT 1 AFTER `status`;

--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_items`
--
ALTER TABLE `users_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_items`
--
ALTER TABLE `users_items`
  ADD CONSTRAINT `users_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE orders (
    'order_id' INT(11) NOT NULL AUTO_INCREMENT,
    'order_date' DATE NOT NULL,
    'ord_status' TINYINT(1) NOT NULL CHECK ('ord_status' BETWEEN 1 AND 5),
    'user_id' INT(11) NOT NULL,
    'vend_id' INT(11) NOT NULL,
    'sm_id' INT(11) NOT NULL,
    'Amount' DECIMAL(10, 2) NOT NULL,
    'itm_ids' VARCHAR(200),
    PRIMARY KEY ('order_id')
);


CREATE TABLE sm_to_del_entry
(
  entry_id INT(11) NOT NULL AUTO_INCREMENT,
  sm_id INT(11) NOT NULL;
  del_id INT(11) NOT NULL;
  date_reg DATE NOT NULL,
  order_id INT(11) NOT NULL;
);

CREATE table ord_shipping
(
  ship_id INT(11) Not Null AUTO_INCREMENT,
  vend_id int(11) Not NULL,
  sm_id int(11) not NULL,
  ord_cond TINYINT(1) Not Null check(ord_cond BETWEEN 0 and 1)
);

-- CREATE TABLE delivery
-- (
--   del_id INT(11) NOT NULL AUTO_INCREMENT,
--   numb INT(10) NOT NULL,
--   name VARCHAR(25)
-- );

-- CREATE table Shipping_Manager
-- (
--   sm_id Int(11) Not NULL AUTO_INCREMENT,
--   numb INT(10) NOT NULL,
--   name VARCHAR(25),
--   pin_code Int(6)
-- );
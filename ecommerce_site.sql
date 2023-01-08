-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2023 at 08:28 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_site`
--
CREATE DATABASE IF NOT EXISTS `ecommerce_site` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ecommerce_site`;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--
-- Creation: Jan 08, 2023 at 05:34 PM
-- Last update: Jan 08, 2023 at 06:57 PM
--

DROP TABLE IF EXISTS `cart_item`;
CREATE TABLE `cart_item` (
  `cartitemid` int(21) NOT NULL,
  `user_id_fk` int(21) DEFAULT NULL,
  `product_id_fk` int(21) DEFAULT NULL,
  `quantity` int(2) NOT NULL,
  `item_created_at` timestamp NULL DEFAULT NULL,
  `item_modified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `cart_item`:
--   `product_id_fk`
--       `product` -> `productid`
--   `user_id_fk`
--       `users` -> `user_idpk`
--

-- --------------------------------------------------------

--
-- Table structure for table `orderaddress`
--
-- Creation: Jan 08, 2023 at 05:37 PM
-- Last update: Jan 08, 2023 at 06:57 PM
--

DROP TABLE IF EXISTS `orderaddress`;
CREATE TABLE `orderaddress` (
  `adressid` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address_line1` varchar(255) NOT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'Morocco',
  `order_id_fk` int(21) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `orderaddress`:
--   `order_id_fk`
--       `order_details` -> `orderid`
--

--
-- Dumping data for table `orderaddress`
--

INSERT INTO `orderaddress` (`adressid`, `city`, `address_line1`, `postal_code`, `country`, `order_id_fk`) VALUES
(6, 'Agoura', 'j ygyyjgyygjgjyg', '11111', 'Morocco', 6),
(7, 'sale', 'j ygyyjgyygjgjyg', '11111', 'Morocco', 7);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--
-- Creation: Jan 08, 2023 at 05:36 PM
-- Last update: Jan 08, 2023 at 06:57 PM
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `orderid` int(21) NOT NULL,
  `user_id` int(21) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_created_at` timestamp NULL DEFAULT NULL,
  `order_modified_at` timestamp NULL DEFAULT NULL,
  `order_customer_phone` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `order_customer_name` varchar(100) NOT NULL,
  `order_customer_email` varchar(319) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `order_details`:
--   `user_id`
--       `users` -> `user_idpk`
--

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`orderid`, `user_id`, `total`, `order_created_at`, `order_modified_at`, `order_customer_phone`, `order_customer_name`, `order_customer_email`) VALUES
(6, 22, '2550000.00', '2023-01-08 18:52:01', NULL, 0654548955, '', 'twitchprimetest2021@gmail.com'),
(7, 22, '870000.00', '2023-01-08 18:57:07', NULL, 0612345678, '', 'twitchprimetest2021@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--
-- Creation: Jan 08, 2023 at 05:35 PM
-- Last update: Jan 08, 2023 at 06:57 PM
--

DROP TABLE IF EXISTS `order_item`;
CREATE TABLE `order_item` (
  `orderitemid` int(21) NOT NULL,
  `order_id` int(21) NOT NULL,
  `product_id` int(21) NOT NULL,
  `quantity` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `order_item`:
--   `order_id`
--       `order_details` -> `orderid`
--   `product_id`
--       `product` -> `productid`
--

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`orderitemid`, `order_id`, `product_id`, `quantity`) VALUES
(18, 6, 20, 20),
(19, 6, 21, 10),
(20, 6, 30, 15),
(21, 7, 18, 5),
(22, 7, 16, 12),
(23, 7, 33, 5);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--
-- Creation: Jan 08, 2023 at 05:38 PM
-- Last update: Jan 08, 2023 at 06:57 PM
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `paymentid` int(21) NOT NULL,
  `order_id` int(21) DEFAULT NULL,
  `status` enum('Pending','Completed') NOT NULL DEFAULT 'Pending',
  `payment_method` enum('Paypal','Cash on delivery') NOT NULL,
  `payment_created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `payment`:
--   `order_id`
--       `order_details` -> `orderid`
--

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentid`, `order_id`, `status`, `payment_method`, `payment_created_at`) VALUES
(6, 6, 'Pending', 'Cash on delivery', '2023-01-08 18:52:02'),
(7, 7, 'Pending', 'Cash on delivery', '2023-01-08 18:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--
-- Creation: Dec 11, 2022 at 01:04 PM
-- Last update: Jan 08, 2023 at 06:35 PM
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `productid` int(21) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `category_id_fk` int(21) NOT NULL,
  `brand_id_fk` int(21) NOT NULL,
  `inventory` int(10) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `product_picture` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `product`:
--

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `name`, `description`, `category_id_fk`, `brand_id_fk`, `inventory`, `price`, `created_at`, `modified_at`, `deleted_at`, `product_picture`) VALUES
(16, '1', 'Les transparences, l’effet d’illusion et la cascade de fleurs donnent forme à ce modèle spectaculaire avec col montant et manches longues avec épaule bouffante.', 6, 0, 12, '10000', '2023-01-08 17:49:30', '2023-01-08 18:12:01', NULL, 'images/63bb022a6dcb18.84503010'),
(17, '2', 'Un design unique qui souligne la sensualité du décolleté avec une coupe sans manches en forme de cœur et qui encadre la silhouette avec une ceinture en satin blanc cassé', 6, 0, 8, '40000', '2023-01-08 18:14:35', NULL, NULL, 'images/63bb080bc684b7.21910187'),
(18, '3', 'Une robe de mariée fourreau sophistiquée style smoking', 6, 0, 5, '60000', '2023-01-08 18:15:51', NULL, NULL, 'images/63bb08577d0356.24233465'),
(19, '4', 'Une robe A-line classique avec une touche bohème grâce à ses manches longues romantiques, son corsage et ses poignets en dentelle.', 6, 0, 15, '70000', '2023-01-08 18:18:09', NULL, NULL, 'images/63bb08e120d8a6.68120188'),
(20, '5', 'Cette robe de soirée glamour présente un drapé classique au niveau du corsage et des hanches ainsi que de fines manches longues', 5, 0, 20, '60000', '2023-01-08 18:19:25', NULL, NULL, 'images/63bb092dd04b07.35402688'),
(21, '6', 'Robe de soirée En dentelle longue bordeaux', 5, 0, 10, '60000', '2023-01-08 18:20:42', NULL, NULL, 'images/63bb097acb0425.34575642'),
(22, '7', 'Robe de bal longue bleue grise avec broderie', 5, 0, 3, '150000', '2023-01-08 18:25:43', NULL, NULL, 'images/63bb0aa70ffd01.95465325'),
(23, '8', 'Une ligne Spaghetti Straps Purple Grey Long Prom Dress avec appliques', 5, 0, 10, '80000', '2023-01-08 18:29:31', NULL, NULL, 'images/63bb0b8b364c62.05752049'),
(25, '9', 'Une ligne Jewel Light Nude Tea Length Prom Robe de bal à manches longues', 5, 0, 6, '65000', '2023-01-08 18:30:44', NULL, NULL, 'images/63bb0bd42a0f07.65859299'),
(26, '10', 'Magnifique A Line Spaghetti Straps Yellow Long Prom Robe avec Appliques', 5, 0, 9, '49999', '2023-01-08 18:31:28', NULL, NULL, 'images/63bb0c00cc2696.55623779'),
(27, '11', 'Robe de bal longue Rud A-Line dorée', 5, 0, 8, '100000', '2023-01-08 18:32:24', NULL, NULL, 'images/63bb0c38d13c96.44430241'),
(28, '12', 'Robe de bal en satin sans dos bleu royal', 5, 0, 3, '200000', '2023-01-08 18:32:42', NULL, NULL, 'images/63bb0c4a69c6c9.04327581'),
(29, '13', 'Robe manteau légèrement évasée en tissu stretch néoprène.', 7, 0, 40, '40000', '2023-01-08 18:33:32', NULL, NULL, 'images/63bb0c7c3bc267.84838427'),
(30, '14', 'Robe en viscose de couleur rouge', 5, 0, 15, '50000', '2023-01-08 18:34:06', NULL, NULL, 'images/63bb0c9e1143f6.13317381'),
(31, '15', 'Robe finitions tressées avec boutons marinière', 7, 0, 6, '70000', '2023-01-08 18:34:33', NULL, NULL, 'images/63bb0cb9588207.97605063'),
(32, '16', 'Robe en satin duchesse imprimé fleuri', 7, 0, 20, '60000', '2023-01-08 18:35:03', NULL, NULL, 'images/63bb0cd7e81e81.41107428'),
(33, '17', 'Robe croisée en satin', 7, 0, 5, '90000', '2023-01-08 18:35:23', NULL, NULL, 'images/63bb0cebdd7926.04290957');

-- --------------------------------------------------------

--
-- Table structure for table `product_brand`
--
-- Creation: Dec 04, 2022 at 08:35 PM
--

DROP TABLE IF EXISTS `product_brand`;
CREATE TABLE `product_brand` (
  `brand_id` int(21) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `brand_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `product_brand`:
--

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--
-- Creation: Dec 04, 2022 at 08:36 PM
-- Last update: Jan 08, 2023 at 06:36 PM
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE `product_category` (
  `category_id` int(21) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `product_category`:
--

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_name`, `category_description`, `created_at`, `modified_at`, `deleted_at`) VALUES
(5, 'eventweardresses', '.', '2022-12-15 14:37:36', NULL, NULL),
(6, 'weddingdresses', '..', '2022-12-15 14:37:50', NULL, NULL),
(7, 'daydresses', '...', '2022-12-15 14:38:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Dec 13, 2022 at 09:27 AM
-- Last update: Jan 08, 2023 at 07:27 PM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_idpk` int(21) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(319) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` text NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `telephone` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `user_type` enum('customer','admin') DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `users`:
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_idpk`, `username`, `email`, `email_verified_at`, `password`, `fname`, `lname`, `telephone`, `created_at`, `modified_at`, `user_type`) VALUES
(9, 'dream', 'gamereagle2016@gmail.com', NULL, 'ad57484016654da87125db86f4227ea3', 'MOHAMED AMINE', 'FAKHRE-EDDINE', 0641695499, '2022-11-26 19:10:46', NULL, 'admin'),
(22, 'dreamww', 'twitchprimetest2021@gmail.com', NULL, 'ad57484016654da87125db86f4227ea3', 'fs', 'ds', 0641695499, '2022-12-10 12:05:47', NULL, 'customer'),
(23, 'admin', 'admintest@gmail.com', NULL, '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 0611111111, '2023-01-08 19:25:55', NULL, 'admin'),
(24, 'customer', 'customertest@gmail.com', NULL, '91ec1f9324753048c0096d036a694f86', 'customer', 'customer', 0611111111, '2023-01-08 19:26:50', NULL, 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cartitemid`),
  ADD KEY `cart_item_fk` (`product_id_fk`),
  ADD KEY `cart_user_fk` (`user_id_fk`);

--
-- Indexes for table `orderaddress`
--
ALTER TABLE `orderaddress`
  ADD PRIMARY KEY (`adressid`),
  ADD KEY `order_address_fk` (`order_id_fk`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `order_user_fk` (`user_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`orderitemid`),
  ADD KEY `order_fk` (`order_id`),
  ADD KEY `order_item_fk` (`product_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentid`),
  ADD KEY `payment_order_fk` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `product_category_fk` (`category_id_fk`),
  ADD KEY `product_brand_fk` (`brand_id_fk`);

--
-- Indexes for table `product_brand`
--
ALTER TABLE `product_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_idpk`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cartitemid` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orderaddress`
--
ALTER TABLE `orderaddress`
  MODIFY `adressid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `orderid` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `orderitemid` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentid` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_brand`
--
ALTER TABLE `product_brand`
  MODIFY `brand_id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_idpk` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_fk` FOREIGN KEY (`product_id_fk`) REFERENCES `product` (`productid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_user_fk` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_idpk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderaddress`
--
ALTER TABLE `orderaddress`
  ADD CONSTRAINT `order_address_fk` FOREIGN KEY (`order_id_fk`) REFERENCES `order_details` (`orderid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_idpk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_fk` FOREIGN KEY (`order_id`) REFERENCES `order_details` (`orderid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_fk` FOREIGN KEY (`product_id`) REFERENCES `product` (`productid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_order_fk` FOREIGN KEY (`order_id`) REFERENCES `order_details` (`orderid`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata for table cart_item
--

--
-- Metadata for table orderaddress
--

--
-- Metadata for table order_details
--

--
-- Metadata for table order_item
--

--
-- Metadata for table payment
--

--
-- Metadata for table product
--

--
-- Metadata for table product_brand
--

--
-- Metadata for table product_category
--

--
-- Metadata for table users
--

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'ecommerce_site', 'users', '{\"sorted_col\":\"`users`.`user_type` ASC\"}', '2023-01-08 15:21:26');

--
-- Metadata for database ecommerce_site
--
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

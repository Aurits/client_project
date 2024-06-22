-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 04:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `client_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `BLOGS` (
  `ID` INT(11) NOT NULL,
  `TITLE` VARCHAR(255) NOT NULL,
  `CONTENT` TEXT NOT NULL,
  `CATEGORY_ID` INT(11) DEFAULT NULL,
  `BLOG_IMAGE` VARCHAR(500) NOT NULL,
  `CREATED_AT` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP()
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `BLOG_CATEGORIES` (
  `ID` INT(11) NOT NULL,
  `CATEGORY_NAME` VARCHAR(255) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `BLOG_CATEGORIES` (
  `ID`,
  `CATEGORY_NAME`
) VALUES (
  1,
  'Decor Tips'
),
(
  2,
  'Product Highlights'
),
(
  3,
  'Customer Stories'
);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `CART` (
  `ID` INT(11) NOT NULL,
  `PRODUCT_NAME` VARCHAR(100) NOT NULL,
  `PRODUCT_PRICE` VARCHAR(50) NOT NULL,
  `PRODUCT_IMAGE` VARCHAR(255) NOT NULL,
  `QTY` INT(10) NOT NULL,
  `TOTAL_PRICE` VARCHAR(100) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=LATIN1 COLLATE=LATIN1_SWEDISH_CI;

--
-- Dumping data for table `cart`
--

INSERT INTO `CART` (
  `ID`,
  `PRODUCT_NAME`,
  `PRODUCT_PRICE`,
  `PRODUCT_IMAGE`,
  `QTY`,
  `TOTAL_PRICE`
) VALUES (
  12,
  'Agent',
  '2000',
  'site_images/Screenshot (6).png',
  2,
  '4000'
);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `CUSTOMERS` (
  `ID` INT(11) NOT NULL,
  `NAME` VARCHAR(255) NOT NULL,
  `EMAIL` VARCHAR(255) NOT NULL,
  `PHONE` VARCHAR(20) DEFAULT NULL,
  `LOCATION` VARCHAR(255) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `ORDERS` (
  `ID` INT(11) NOT NULL,
  `NAME` VARCHAR(100) NOT NULL,
  `EMAIL` VARCHAR(100) NOT NULL,
  `PHONE` VARCHAR(20) NOT NULL,
  `ADDRESS` VARCHAR(255) NOT NULL,
  `PMODE` VARCHAR(50) NOT NULL,
  `PRODUCTS` VARCHAR(255) NOT NULL,
  `AMOUNT_PAID` VARCHAR(100) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=LATIN1 COLLATE=LATIN1_SWEDISH_CI;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `PRODUCT` (
  `ID` INT(11) NOT NULL,
  `PRODUCT_NAME` VARCHAR(255) NOT NULL,
  `PRODUCT_PRICE` VARCHAR(100) NOT NULL,
  `PRODUCT_QTY` INT(11) NOT NULL DEFAULT 1,
  `PRODUCT_IMAGE` VARCHAR(255) NOT NULL,
  `PRODUCT_IMAGE_TWO` VARCHAR(255) DEFAULT NULL,
  `PRODUCT_IMAGE_THREE` VARCHAR(255) DEFAULT NULL,
  `PRODUCT_IMAGE_FOUR` VARCHAR(255) DEFAULT NULL,
  `PRODUCT_DESCRIPTION` VARCHAR(300) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=LATIN1 COLLATE=LATIN1_SWEDISH_CI;

--
-- Dumping data for table `product`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `USERS` (
  `ID` INT(11) NOT NULL,
  `USERNAME` VARCHAR(255) NOT NULL,
  `PASSWORD` VARCHAR(255) NOT NULL,
  `EMAIL` VARCHAR(255) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

--
-- Dumping data for table `users`
--

INSERT INTO `USERS` (
  `ID`,
  `USERNAME`,
  `PASSWORD`,
  `EMAIL`
) VALUES (
  2,
  'Admin',
  'Site@admin',
  'ateraxantonio@gmail.com'
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `BLOGS` ADD PRIMARY KEY (`ID`), ADD KEY `CATEGORY_ID` (`CATEGORY_ID`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `BLOG_CATEGORIES` ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `CART` ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `CUSTOMERS` ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `ORDERS` ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `PRODUCT` ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `USERS` ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `BLOGS` MODIFY `ID` INT(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `BLOG_CATEGORIES` MODIFY `ID` INT(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `CART` MODIFY `ID` INT(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `CUSTOMERS` MODIFY `ID` INT(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `ORDERS` MODIFY `ID` INT(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `PRODUCT` MODIFY `ID` INT(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `USERS` MODIFY `ID` INT(11) NOT NULL AUTO_INCREMENT;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
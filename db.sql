-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 21, 2024 at 10:18 AM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u105432154_db`
--

-- --------------------------------------------------------
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `product_name` VARCHAR(100) NOT NULL,
    `product_price` VARCHAR(50) NOT NULL,
    `product_image` VARCHAR(255) NOT NULL,
    `qty` INT(10) NOT NULL,
    `total_price` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=LATIN1 COLLATE=LATIN1_SWEDISH_CI;

-- --------------------------------------------------------
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(20) DEFAULT NULL,
    `location` VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

-- --------------------------------------------------------
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `phone` VARCHAR(20) NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `pmode` VARCHAR(50) NOT NULL,
    `products` VARCHAR(255) NOT NULL,
    `amount_paid` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=LATIN1 COLLATE=LATIN1_SWEDISH_CI;

-- --------------------------------------------------------
-- Table structure for table `product`
--

CREATE TABLE `product` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `product_name` VARCHAR(255) NOT NULL,
    `product_price` VARCHAR(100) NOT NULL,
    `product_qty` INT(11) NOT NULL DEFAULT 1,
    `product_image` VARCHAR(255) NOT NULL,
    `product_description` VARCHAR(300) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=LATIN1 COLLATE=LATIN1_SWEDISH_CI;

-- --------------------------------------------------------
-- Table structure for table `users`
--

CREATE TABLE `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(2, 'Admin', 'Flip@admin', 'ateraxantonio@gmail.com');

-- --------------------------------------------------------
-- Additional tables for Blogs and Categories
--

-- --------------------------------------------------------
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `category_name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

-- Dumping data for table `blog_categories`
INSERT INTO `blog_categories` (`id`, `category_name`) VALUES
(1, 'Decor Tips'),
(2, 'Product Highlights'),
(3, 'Customer Stories');

-- --------------------------------------------------------
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `content` TEXT NOT NULL,
    `category_id` INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `category_id` (`category_id`)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

-- Dumping data for table `blogs`
INSERT INTO `blogs` (`id`, `title`, `content`, `category_id`) VALUES
(1, 'Choosing the Right Decor for Your Space', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 1),
(2, 'Top 10 Products to Enhance Your Living Room', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 2),
(3, 'Customer Spotlight: Joan and Her Unique Decor Journey', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 3);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

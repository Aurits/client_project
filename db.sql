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

CREATE TABLE `CART` (
    `ID` INT(11) NOT NULL AUTO_INCREMENT,
    `PRODUCT_NAME` VARCHAR(100) NOT NULL,
    `PRODUCT_PRICE` VARCHAR(50) NOT NULL,
    `PRODUCT_IMAGE` VARCHAR(255) NOT NULL,
    `QTY` INT(10) NOT NULL,
    `TOTAL_PRICE` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=INNODB DEFAULT CHARSET=LATIN1 COLLATE=LATIN1_SWEDISH_CI;

-- --------------------------------------------------------
-- Table structure for table `customers`
--

CREATE TABLE `CUSTOMERS` (
    `ID` INT(11) NOT NULL AUTO_INCREMENT,
    `NAME` VARCHAR(255) NOT NULL,
    `EMAIL` VARCHAR(255) NOT NULL,
    `PHONE` VARCHAR(20) DEFAULT NULL,
    `LOCATION` VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

-- --------------------------------------------------------
-- Table structure for table `orders`
--

CREATE TABLE `ORDERS` (
    `ID` INT(11) NOT NULL AUTO_INCREMENT,
    `NAME` VARCHAR(100) NOT NULL,
    `EMAIL` VARCHAR(100) NOT NULL,
    `PHONE` VARCHAR(20) NOT NULL,
    `ADDRESS` VARCHAR(255) NOT NULL,
    `PMODE` VARCHAR(50) NOT NULL,
    `PRODUCTS` VARCHAR(255) NOT NULL,
    `AMOUNT_PAID` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=INNODB DEFAULT CHARSET=LATIN1 COLLATE=LATIN1_SWEDISH_CI;

-- --------------------------------------------------------
-- Table structure for table `product`
--

CREATE TABLE `PRODUCT` (
    `ID` INT(11) NOT NULL AUTO_INCREMENT,
    `PRODUCT_NAME` VARCHAR(255) NOT NULL,
    `PRODUCT_PRICE` VARCHAR(100) NOT NULL,
    `PRODUCT_QTY` INT(11) NOT NULL DEFAULT 1,
    `PRODUCT_IMAGE` VARCHAR(255) NOT NULL,
    `PRODUCT_DESCRIPTION` VARCHAR(300) NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=INNODB DEFAULT CHARSET=LATIN1 COLLATE=LATIN1_SWEDISH_CI;

-- --------------------------------------------------------
-- Table structure for table `users`
--

CREATE TABLE `USERS` (
    `ID` INT(11) NOT NULL AUTO_INCREMENT,
    `USERNAME` VARCHAR(255) NOT NULL,
    `PASSWORD` VARCHAR(255) NOT NULL,
    `EMAIL` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`ID`)
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
    'Flip@admin',
    'ateraxantonio@gmail.com'
);

-- --------------------------------------------------------
-- Additional tables for Blogs and Categories
--

-- --------------------------------------------------------
-- Table structure for table `blog_categories`
--

CREATE TABLE `BLOG_CATEGORIES` (
    `ID` INT(11) NOT NULL AUTO_INCREMENT,
    `CATEGORY_NAME` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

-- Dumping data for table `blog_categories`
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
-- Table structure for table `blogs`
--

CREATE TABLE `BLOGS` (
    `ID` INT(11) NOT NULL AUTO_INCREMENT,
    `TITLE` VARCHAR(255) NOT NULL,
    `CONTENT` TEXT NOT NULL,
    `CATEGORY_ID` INT(11) NOT NULL,
    PRIMARY KEY (`ID`),
    KEY `CATEGORY_ID` (`CATEGORY_ID`)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

-- Dumping data for table `blogs`
INSERT INTO `BLOGS` (
    `ID`,
    `TITLE`,
    `CONTENT`,
    `CATEGORY_ID`
) VALUES (
    1,
    'Choosing the Right Decor for Your Space',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    1
),
(
    2,
    'Top 10 Products to Enhance Your Living Room',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    2
),
(
    3,
    'Customer Spotlight: Joan and Her Unique Decor Journey',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    3
);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
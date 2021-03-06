-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 05, 2014 at 08:12 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `reserved`
--
CREATE DATABASE IF NOT EXISTS `reserved` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `reserved`;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `club_id` int(11) DEFAULT NULL,
  `club_table_id` int(11) DEFAULT NULL,
  `guys` smallint(6) DEFAULT NULL,
  `girls` smallint(6) DEFAULT NULL,
  `arrival_time` varchar(10) DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `booking_price` float(10,2) DEFAULT NULL,
  `booking_method` enum('Manually Added','Rerserved App') DEFAULT 'Rerserved App',
  `booking_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('cancelled','check_in','pending','available','reserved','taken') DEFAULT 'pending',
  `client_name` varchar(100) DEFAULT NULL,
  `client_phone` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking user id` (`user_id`),
  KEY `club table id` (`club_table_id`),
  KEY `booking club id` (`club_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `club_id`, `club_table_id`, `guys`, `girls`, `arrival_time`, `arrival_date`, `booking_price`, `booking_method`, `booking_time`, `status`, `client_name`, `client_phone`) VALUES
(6, 2, 5, NULL, 2, 4, '4.30', NULL, NULL, 'Rerserved App', '2014-02-18 07:33:32', 'pending', NULL, NULL),
(7, 2, 3, NULL, 2, 5, '3.0', NULL, NULL, 'Rerserved App', '2014-02-18 07:35:00', 'pending', NULL, NULL),
(8, 7, 3, NULL, 2, 3, '4.30', NULL, NULL, 'Rerserved App', '2014-02-19 01:59:56', 'pending', NULL, NULL),
(9, 7, 3, NULL, 2, 3, '4.30', NULL, NULL, 'Rerserved App', '2014-02-19 02:00:03', 'pending', NULL, NULL),
(10, 7, 3, NULL, 1, 2, '4.30', NULL, NULL, 'Rerserved App', '2014-02-19 02:05:00', 'pending', NULL, NULL),
(11, 7, 3, NULL, 1, 2, '4.30', NULL, NULL, 'Rerserved App', '2014-02-19 02:05:51', 'pending', NULL, NULL),
(12, 7, 3, NULL, 4, 2, '3.0', NULL, NULL, 'Rerserved App', '2014-02-19 02:06:18', 'pending', NULL, NULL),
(13, 7, 5, NULL, 3, 4, '4.30', NULL, NULL, 'Rerserved App', '2014-02-19 02:08:05', 'pending', NULL, NULL),
(14, 7, 5, NULL, 2, 3, '4.30', NULL, NULL, 'Rerserved App', '2014-02-19 02:15:37', 'pending', NULL, NULL),
(15, 7, 4, NULL, 2, 0, '4.30', NULL, NULL, 'Rerserved App', '2014-02-19 06:38:05', 'pending', NULL, NULL),
(16, 7, 4, NULL, 1, 0, '3.0', NULL, NULL, 'Rerserved App', '2014-02-19 06:41:17', 'pending', NULL, NULL),
(17, 7, 5, NULL, 2, 2, '4.30', NULL, NULL, 'Rerserved App', '2014-02-19 06:54:24', 'pending', NULL, NULL),
(18, 7, 2, NULL, 1, 1, '2.30', NULL, NULL, 'Rerserved App', '2014-02-19 07:47:53', 'pending', NULL, NULL),
(19, 7, 2, NULL, 2, 2, '4.30', NULL, NULL, 'Rerserved App', '2014-02-19 08:32:50', 'pending', NULL, NULL),
(20, 7, 4, NULL, 0, 2, '3.0', NULL, NULL, 'Rerserved App', '2014-02-24 06:46:16', 'pending', NULL, NULL),
(21, 7, 4, NULL, 1, 0, '2.30', NULL, NULL, 'Rerserved App', '2014-02-26 05:52:23', 'pending', NULL, NULL),
(22, 7, 3, NULL, 2, 2, '3.0', NULL, NULL, 'Rerserved App', '2014-02-26 06:01:54', 'pending', NULL, NULL),
(23, 7, 3, NULL, 0, 0, '2.30', NULL, NULL, 'Rerserved App', '2014-02-26 07:00:09', 'pending', NULL, NULL),
(24, 7, 1, NULL, 1, 2, '3.0', NULL, NULL, 'Rerserved App', '2014-02-26 07:02:32', 'pending', NULL, NULL),
(25, 7, 1, NULL, 1, 1, '4.30', NULL, NULL, 'Rerserved App', '2014-02-26 07:07:55', 'pending', NULL, NULL),
(26, 7, 2, NULL, 1, 1, '4.30', NULL, NULL, 'Rerserved App', '2014-02-26 07:10:36', 'pending', NULL, NULL),
(27, 7, 3, NULL, 1, 0, '3.0', NULL, NULL, 'Rerserved App', '2014-02-26 07:17:33', 'pending', NULL, NULL),
(28, 7, 1, NULL, 1, 1, '4.30', NULL, NULL, 'Rerserved App', '2014-02-26 07:34:05', 'pending', NULL, NULL),
(29, 7, 4, NULL, 1, 1, '3.0', NULL, NULL, 'Rerserved App', '2014-02-26 07:40:50', 'pending', NULL, NULL),
(30, 7, 1, NULL, 1, 1, '4.30', NULL, NULL, 'Rerserved App', '2014-02-26 08:06:41', 'pending', NULL, NULL),
(31, 7, 2, NULL, 1, 1, '3.0', NULL, NULL, 'Rerserved App', '2014-02-26 08:09:40', 'pending', NULL, NULL),
(32, 7, 3, NULL, 0, 0, '2.30', NULL, NULL, 'Rerserved App', '2014-02-26 08:13:23', 'pending', NULL, NULL),
(33, 7, 2, NULL, 1, 1, '3.0', NULL, NULL, 'Rerserved App', '2014-02-26 14:15:39', 'pending', NULL, NULL),
(34, 7, 3, NULL, 1, 2, '2.30', NULL, NULL, 'Rerserved App', '2014-02-26 23:02:18', 'pending', NULL, NULL),
(35, 7, 1, NULL, 1, 2, '2.30', NULL, NULL, 'Rerserved App', '2014-02-26 23:10:50', 'pending', NULL, NULL),
(36, 7, 2, NULL, 2, 2, '3.0', NULL, NULL, 'Rerserved App', '2014-02-26 23:29:28', 'pending', NULL, NULL),
(37, 7, 5, NULL, 1, 1, '3.0', NULL, NULL, 'Rerserved App', '2014-02-26 23:29:41', 'pending', NULL, NULL),
(38, 7, 3, NULL, 2, 5, '1', NULL, NULL, 'Rerserved App', '2014-02-26 23:50:57', 'pending', NULL, NULL),
(39, 7, 2, NULL, 1, 1, '4.30', NULL, NULL, 'Rerserved App', '2014-02-27 00:41:16', 'pending', NULL, NULL),
(40, 7, 1, NULL, 3, 4, '2.30', NULL, NULL, 'Rerserved App', '2014-02-28 09:04:28', 'pending', NULL, NULL),
(41, 7, 2, NULL, 1, 1, '4.30', NULL, NULL, 'Rerserved App', '2014-03-04 01:01:19', 'pending', NULL, NULL),
(42, 7, 1, NULL, 2, 2, '4.30', NULL, NULL, 'Rerserved App', '2014-03-04 01:11:51', 'pending', NULL, NULL),
(43, 7, 5, NULL, 1, 1, '3.0', NULL, NULL, 'Rerserved App', '2014-03-04 01:26:08', 'pending', NULL, NULL),
(44, 7, 1, NULL, 2, 1, '4.30', NULL, NULL, 'Rerserved App', '2014-03-04 01:31:52', 'pending', NULL, NULL),
(45, 7, 2, NULL, 1, 1, '3.0', NULL, NULL, 'Rerserved App', '2014-03-04 01:41:26', 'pending', NULL, NULL),
(46, 7, 1, NULL, 1, 1, '4.30', NULL, NULL, 'Rerserved App', '2014-03-04 04:28:25', 'pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE IF NOT EXISTS `cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `cards` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) DEFAULT NULL,
  `category_type` enum('table','bottle','events') DEFAULT 'table',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_type`, `status`) VALUES
(1, 'Lounge/Surrounding Area', 'table', 'active'),
(2, 'DJ/Dance Floor Area', 'table', 'active'),
(3, 'Most Expensive Tables', 'table', 'active'),
(4, 'Expensive Bottles', 'bottle', 'active'),
(5, 'Wine', 'bottle', 'active'),
(6, 'Vodka', 'bottle', 'active'),
(7, 'Red Label', 'bottle', 'inactive'),
(8, 'Marry Christmas1', 'events', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE IF NOT EXISTS `clubs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `club_name` varchar(50) DEFAULT NULL,
  `club_type_id` int(11) DEFAULT NULL,
  `short_description` text,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `address` tinytext,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `approve_auto_purchase` enum('yes','no') DEFAULT 'yes',
  `tip_service_fee` varchar(150) NOT NULL,
  `status` enum('pending','approved') DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `club type id` (`club_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `user_id`, `club_name`, `club_type_id`, `short_description`, `create_date`, `address`, `latitude`, `longitude`, `approve_auto_purchase`, `tip_service_fee`, `status`) VALUES
(1, 1, 'Greystone Mannor', 1, 'Good Club', '2014-02-06 06:49:42', 'Dhaka', '46.58', '88.08', 'yes', 'select 1', 'pending'),
(2, 2, 'Bootsy Bellows', 2, NULL, '2014-02-06 06:50:03', 'Dhaka', '31.34', '85.15', 'yes', '', 'pending'),
(3, 3, 'Evalate Lounge', 2, NULL, '2014-02-06 06:50:28', 'Dhaka', '31.34', '92.08', 'yes', '', 'pending'),
(4, 5, 'The Vault', 1, 'this is the football club', '2014-02-06 06:41:54', 'Dhaka', '23.709921', '90.407143', 'yes', 'select 1', 'pending'),
(5, 7, 'Cricket Club', 2, 'Cricket Club', '2014-02-06 06:50:41', NULL, '34.11', '82.23', 'yes', 'select 3', 'pending'),
(6, 1, 'GUlshan club', 1, 'Gulshan club', '2014-02-27 07:02:40', 'gulshan circle, Dhaka 1212, Bangladesh', '23.794511', '90.410898', 'yes', '', 'pending'),
(7, 1, 'Hotel Westin', 1, 'Hotel Westin dhaka', '2014-02-27 07:02:19', 'House # NWJ/-2/A, Bir Uttam Sultan Mahmud Road\r\nRoad No. 50, Dhaka 1212, Bangladesh', '23.792086', '90.409321', 'yes', '', 'pending'),
(8, 1, 'Hotel Radison', 2, 'Hotel Radison', '2014-02-27 07:12:32', NULL, '23.810619', '90.407433', 'yes', '', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `club_bottles`
--

CREATE TABLE IF NOT EXISTS `club_bottles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `club_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `bottle_name` varchar(100) DEFAULT NULL,
  `bottle_price` float(10,2) DEFAULT NULL,
  `upsell` varchar(100) DEFAULT 'none',
  `upsell_type` enum('add','replace') DEFAULT 'replace',
  `status` enum('approved','pending') DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `bottles user id` (`user_id`),
  KEY `bottles club id` (`club_id`),
  KEY `bottles category id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `club_bottles`
--

INSERT INTO `club_bottles` (`id`, `user_id`, `club_id`, `category_id`, `bottle_name`, `bottle_price`, `upsell`, `upsell_type`, `status`) VALUES
(1, 3, 3, 4, 'Bottle Test', 500.75, '2', 'add', 'approved'),
(2, 3, 3, 4, 'Bottle Expensive', 1000.50, '1', 'replace', 'approved'),
(3, 7, 5, 6, 'Bottle Vodka', 450.00, '2', 'add', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `club_exceptions`
--

CREATE TABLE IF NOT EXISTS `club_exceptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) DEFAULT NULL,
  `exception_date` date DEFAULT NULL,
  `exception_name` varchar(50) DEFAULT NULL,
  `open_time` varchar(5) DEFAULT NULL,
  `close_time` varchar(5) DEFAULT NULL,
  `status` enum('Open','Closed') DEFAULT 'Open',
  PRIMARY KEY (`id`),
  KEY `exception club id` (`club_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `club_exceptions`
--

INSERT INTO `club_exceptions` (`id`, `club_id`, `exception_date`, `exception_name`, `open_time`, `close_time`, `status`) VALUES
(7, 2, '2014-01-22', 'test 1', '1 am', '5 am', 'Open'),
(8, 2, '2014-01-04', 'test 1', '0', '0', 'Open'),
(12, 1, '2014-01-08', 'Exception 121', '0', '0', 'Open'),
(13, 3, '2014-01-09', 'nazmul', '1 am', '2 am', 'Open'),
(14, 1, '2014-01-29', 'Eid', '5 am', '1 pm', 'Open'),
(15, 5, '2014-01-29', 'Eid', '1 am', '1 am', 'Closed'),
(16, 5, '2014-02-03', 'Test Exception', '8 am', '11 am', 'Open'),
(17, NULL, '2014-02-06', 'Holly Day', '8 am', '11 pm', 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `club_open_days`
--

CREATE TABLE IF NOT EXISTS `club_open_days` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) DEFAULT NULL,
  `days` enum('Monday','Tuesday','Thursday','Wednesday','Friday','Saturday','Sunday') DEFAULT NULL,
  `open_time` varchar(5) DEFAULT NULL,
  `close_time` varchar(5) DEFAULT NULL,
  `status` enum('Open','Closed') DEFAULT 'Open',
  PRIMARY KEY (`id`),
  KEY `club opens day club id` (`club_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `club_open_days`
--

INSERT INTO `club_open_days` (`id`, `club_id`, `days`, `open_time`, `close_time`, `status`) VALUES
(1, 1, 'Saturday', '1 am', '1 am', 'Open'),
(2, 1, 'Sunday', '1 am', '1 am', 'Open'),
(3, 1, 'Monday', '1 am', '1 am', 'Open'),
(4, 1, 'Tuesday', '1 ', '1 am', 'Open'),
(5, 1, 'Tuesday', '1', '1 am', 'Open'),
(6, 1, 'Thursday', '1 ', '1 am', 'Open'),
(7, 1, 'Friday', '1 ', '1 am', 'Open'),
(8, 1, 'Saturday', '1.00 ', '1 am', 'Open'),
(9, 1, 'Sunday', '1.00 ', '1 am', 'Open'),
(10, 1, 'Monday', '1.00 ', '1 am', 'Open'),
(11, 1, 'Tuesday', '1.00 ', '1 am', 'Open'),
(12, 1, 'Wednesday', '1.00 ', '1 am', 'Open'),
(13, 1, 'Thursday', '1.00 ', '1 am', 'Open'),
(14, 1, 'Friday', '1.00 ', '1 am', 'Open'),
(15, 1, 'Saturday', '1.00 ', '1 am', 'Open'),
(16, 1, 'Sunday', '1.00 ', '1 am', 'Open'),
(17, 1, 'Monday', '1.00 ', '1 am', 'Open'),
(18, 1, 'Tuesday', '1.00 ', '1 am', 'Open'),
(19, 1, 'Wednesday', '1.00 ', '1 am', 'Open'),
(20, 1, 'Thursday', '1.00 ', '1 am', 'Open'),
(21, 1, 'Friday', '1.00 ', '1 am', 'Open'),
(22, 1, 'Saturday', '1 am', '1 am', 'Closed'),
(23, 1, 'Sunday', '1 am', '1 am', 'Open'),
(24, 1, 'Monday', '1 am', '1 am', 'Open'),
(25, 1, 'Tuesday', '1.00 ', '1 am', 'Closed'),
(26, 1, 'Wednesday', '1 am', '1 am', 'Open'),
(27, 1, 'Thursday', '1.00 ', '1 am', 'Closed'),
(28, 1, 'Friday', '1 am', '1 am', 'Open'),
(29, 4, 'Saturday', '1 am', '1 am', 'Open'),
(30, 4, 'Sunday', '1 am', '1 am', 'Open'),
(31, 4, 'Monday', '1 am', '1 am', 'Open'),
(32, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(33, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(34, 4, 'Thursday', '1', '1 am', 'Open'),
(35, 4, 'Friday', '1 am', '1 am', 'Open'),
(36, 5, 'Saturday', '1 am', '1 am', 'Open'),
(37, 5, 'Sunday', '1 am', '1 am', 'Open'),
(38, 5, 'Monday', '1 am', '1 am', 'Open'),
(39, 5, 'Tuesday', '1.00 ', '1 am', 'Open'),
(40, 5, 'Wednesday', '1 am', '1 am', 'Open'),
(41, 5, 'Thursday', '1.00 ', '1 am', 'Open'),
(42, 5, 'Friday', '1 am', '1 am', 'Open'),
(43, 5, 'Saturday', '1 am', '1 am', 'Open'),
(44, 5, 'Sunday', '1 am', '1 am', 'Open'),
(45, 5, 'Monday', '1 am', '1 am', 'Open'),
(46, 5, 'Tuesday', '1.00 ', '1 am', 'Open'),
(47, 5, 'Wednesday', '1 am', '1 am', 'Open'),
(48, 5, 'Thursday', '1 am', '1 am', 'Open'),
(49, 5, 'Friday', '1 am', '1 am', 'Open'),
(50, 2, 'Saturday', '1 am', '1 am', 'Open'),
(51, 2, 'Sunday', '1 am', '1 am', 'Open'),
(52, 2, 'Monday', '1 am', '1 am', 'Open'),
(53, 2, 'Tuesday', '1 am', '1 am', 'Open'),
(54, 2, 'Wednesday', '1 am', '1 am', 'Open'),
(55, 2, 'Thursday', '1 am', '1 am', 'Open'),
(56, 2, 'Friday', '1 am', '1 am', 'Open'),
(57, 1, 'Saturday', '1 am', '1 am', 'Open'),
(58, 1, 'Sunday', '1 am', '1 am', 'Open'),
(59, 1, 'Monday', '1 am', '1 am', 'Open'),
(60, 1, 'Tuesday', '1 am', '1 am', 'Open'),
(61, 1, 'Wednesday', '1 am', '1 am', 'Open'),
(62, 1, 'Thursday', '1 am', '1 am', 'Open'),
(63, 1, 'Friday', '1 am', '1 am', 'Open'),
(64, 4, 'Saturday', '1 am', '1 am', 'Open'),
(65, 4, 'Sunday', '1 am', '1 am', 'Open'),
(66, 4, 'Monday', '1 am', '1 am', 'Open'),
(67, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(68, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(69, 4, 'Thursday', '1 am', '1 am', 'Open'),
(70, 4, 'Friday', '1 am', '1 am', 'Open'),
(71, 3, 'Saturday', '1 am', '1 am', 'Open'),
(72, 3, 'Sunday', '1 am', '1 am', 'Open'),
(73, 3, 'Monday', '1 am', '1 am', 'Open'),
(74, 3, 'Tuesday', '1 am', '1 am', 'Open'),
(75, 3, 'Wednesday', '1 am', '1 am', 'Open'),
(76, 3, 'Thursday', '1 am', '1 am', 'Open'),
(77, 3, 'Friday', '1 am', '1 am', 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `club_tables`
--

CREATE TABLE IF NOT EXISTS `club_tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `club_id` int(11) DEFAULT NULL,
  `table_name` varchar(100) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `minimum_price` float(10,2) DEFAULT NULL,
  `table_min_guy` smallint(11) DEFAULT NULL,
  `table_min_girls` smallint(11) DEFAULT NULL,
  `max_guys1` smallint(11) DEFAULT NULL,
  `max_guys1_price` float(10,2) DEFAULT NULL,
  `max_guys2` smallint(11) DEFAULT NULL,
  `max_guys2_price` float(10,2) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('pending','approved') DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `table user id` (`user_id`),
  KEY `table club id` (`club_id`),
  KEY `table cat id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `club_tables`
--

INSERT INTO `club_tables` (`id`, `user_id`, `club_id`, `table_name`, `category_id`, `minimum_price`, `table_min_guy`, `table_min_girls`, `max_guys1`, `max_guys1_price`, `max_guys2`, `max_guys2_price`, `create_date`, `status`) VALUES
(1, 3, 3, 'Test', 1, 200.50, 3, 3, 4, 180.90, 5, 160.75, '2014-01-22 06:23:58', 'approved'),
(2, 7, 5, 'Test Table', 3, 230.00, 4, 7, 5, 230.00, 6, 56.00, '2014-02-03 06:31:01', 'pending'),
(3, 7, 5, 'Table 1', 1, 100.00, 4, 4, 4, 100.00, 4, 90.00, '2014-02-19 00:37:59', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `club_types`
--

CREATE TABLE IF NOT EXISTS `club_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `club_types`
--

INSERT INTO `club_types` (`id`, `type_name`) VALUES
(1, 'Club'),
(2, 'Lounge');

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE IF NOT EXISTS `deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) DEFAULT NULL,
  `club_table_id` int(11) DEFAULT NULL,
  `deal_price` int(11) DEFAULT NULL,
  `deal_now` enum('on','off') DEFAULT 'off',
  `deal_date` date DEFAULT NULL,
  `recur` enum('yes','no') DEFAULT 'no',
  `status` enum('on','off') DEFAULT 'on',
  PRIMARY KEY (`id`),
  KEY `deals club id` (`club_id`),
  KEY `deal table id` (`club_table_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ep_positions`
--

CREATE TABLE IF NOT EXISTS `ep_positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `position_date` datetime NOT NULL,
  `deviceid` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `ep_positions`
--

INSERT INTO `ep_positions` (`id`, `name`, `latitude`, `longitude`, `position_date`, `deviceid`) VALUES
(3, 'name', '0.0', '0.0', '2014-03-04 17:02:32', '80ae767b94b871fe'),
(4, 'name', '0.0', '0.0', '2014-03-04 17:02:36', '80ae767b94b871fe'),
(5, 'name', '0.0', '0.0', '2014-03-04 17:02:41', '80ae767b94b871fe'),
(6, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:12:59', '16243a76f534231d'),
(7, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:13:04', '16243a76f534231d'),
(8, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:13:09', '16243a76f534231d'),
(9, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:13:14', '16243a76f534231d'),
(10, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:13:19', '16243a76f534231d'),
(11, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:13:24', '16243a76f534231d'),
(12, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:13:29', '16243a76f534231d'),
(13, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:13:34', '16243a76f534231d'),
(14, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:13:39', '16243a76f534231d'),
(15, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:17:16', '16243a76f534231d'),
(16, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:17:21', '16243a76f534231d'),
(17, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:17:26', '16243a76f534231d'),
(18, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:17:31', '16243a76f534231d'),
(19, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:17:37', '16243a76f534231d'),
(20, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:17:42', '16243a76f534231d'),
(21, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:17:48', '16243a76f534231d'),
(22, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:17:53', '16243a76f534231d'),
(23, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:17:58', '16243a76f534231d'),
(24, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:18:03', '16243a76f534231d'),
(25, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:18:16', '16243a76f534231d'),
(26, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:18:48', '16243a76f534231d'),
(27, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:18:53', '16243a76f534231d'),
(28, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:18:58', '16243a76f534231d'),
(29, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:19:03', '16243a76f534231d'),
(30, 'test-name', '23.7932701', '90.4014381', '2014-03-04 17:19:08', '16243a76f534231d'),
(31, 'test-name', '23.7949254', '90.4014043', '2014-03-04 17:23:49', '16243a76f534231d'),
(32, 'test-name', '23.7949254', '90.4014043', '2014-03-04 17:23:54', '16243a76f534231d'),
(33, 'test-name', '23.7949254', '90.4014043', '2014-03-04 17:23:59', '16243a76f534231d'),
(34, 'test-name', '23.7949254', '90.4014043', '2014-03-04 17:24:04', '16243a76f534231d'),
(35, 'test-name', '23.7932666', '90.4013854', '2014-03-04 17:24:12', '16243a76f534231d'),
(36, 'test-name', '23.7932666', '90.4013854', '2014-03-04 17:24:19', '16243a76f534231d');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `performer` varchar(200) DEFAULT NULL,
  `price_multiplier` enum('.5','1.5','2','2.5','3','3.5','4','4.5','5') DEFAULT NULL,
  `recur_week` enum('no','yes') DEFAULT 'no',
  `event_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events club id` (`club_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `job_titles`
--

CREATE TABLE IF NOT EXISTS `job_titles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `job_titles`
--

INSERT INTO `job_titles` (`id`, `job_title`) VALUES
(1, 'Owner'),
(2, 'Door man');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `club_bottle_id` int(11) DEFAULT NULL,
  `quantity` smallint(6) DEFAULT NULL,
  `price` float(10,2) DEFAULT NULL,
  `transactionid` varchar(100) DEFAULT NULL,
  `status` enum('pending','completed') DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `order user id` (`user_id`),
  KEY `order booking id` (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(200) DEFAULT NULL,
  `page_content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `club_id` int(11) DEFAULT NULL,
  `photos` varchar(100) DEFAULT NULL,
  `photo_type` enum('club','user') DEFAULT 'club',
  `profile_picture` enum('yes','no') DEFAULT 'no',
  PRIMARY KEY (`id`),
  KEY `photos user id` (`user_id`),
  KEY `photos club id` (`club_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `user_id`, `club_id`, `photos`, `photo_type`, `profile_picture`) VALUES
(7, 7, 5, '1391430835Hydrangeas.jpg', 'club', 'yes'),
(9, 7, 5, '1391430874Penguins.jpg', 'club', 'no'),
(10, 2, 2, '1391689751club_image_1.jpg', 'club', 'no'),
(11, 2, 2, '1391689762club_image_2.jpg', 'club', 'no'),
(12, 1, 1, '1391690286club_image_3.jpg', 'club', 'no'),
(13, 1, 1, '1391690294club_image_4.jpg', 'club', 'no'),
(14, 5, 4, '1391690381club_image_5.jpg', 'club', 'no'),
(16, 5, 4, '1391690509club_image_6.jpg', 'club', 'no'),
(17, 3, 3, '1391690811club_image_7.jpg', 'club', 'no'),
(18, 3, 3, '1391690819club_image_8.jpg', 'club', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `question_answers`
--

CREATE TABLE IF NOT EXISTS `question_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question user id` (`user_id`),
  KEY `question id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `splits`
--

CREATE TABLE IF NOT EXISTS `splits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `splited_amount` varchar(5) DEFAULT NULL,
  `status` enum('pending','completed') DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `split user id` (`user_id`),
  KEY `split booking id` (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tips`
--

CREATE TABLE IF NOT EXISTS `tips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tips_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(12) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_token` varchar(255) DEFAULT NULL,
  `first_name` varchar(15) DEFAULT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `email_address` varchar(50) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `job_title_id` int(11) DEFAULT NULL,
  `fbid` varchar(15) DEFAULT NULL,
  `fb_thumb_img` varchar(255) DEFAULT NULL,
  `join_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_type` enum('admin','club_member','user','promoter') DEFAULT NULL,
  `created_by` int(11) DEFAULT '0',
  `zip_code` varchar(10) DEFAULT NULL,
  `cciv` varchar(20) DEFAULT NULL,
  `promoter_code` varchar(10) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT '0',
  `email_token` varchar(128) DEFAULT NULL,
  `email_token_expires` datetime DEFAULT NULL,
  `club_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user job title id` (`job_title_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `password_token`, `first_name`, `last_name`, `email_address`, `phone_number`, `job_title_id`, `fbid`, `fb_thumb_img`, `join_date`, `user_type`, `created_by`, `zip_code`, `cciv`, `promoter_code`, `email_verified`, `email_token`, `email_token_expires`, `club_id`) VALUES
(1, NULL, 'aa37acc3ccfc6019c345bf0487de4e7f8bd00840', NULL, NULL, NULL, 'games@gmail.com', '1234', NULL, NULL, NULL, '0000-00-00 00:00:00', 'club_member', 0, NULL, NULL, NULL, 0, NULL, NULL, 0),
(2, NULL, 'aa37acc3ccfc6019c345bf0487de4e7f8bd00840', 'ptr1zfelnw', NULL, NULL, 'isumon@gmail.com', '2345555', NULL, NULL, NULL, '0000-00-00 00:00:00', 'club_member', 0, NULL, NULL, NULL, 0, NULL, '2014-01-16 19:26:37', 0),
(3, NULL, 'aa37acc3ccfc6019c345bf0487de4e7f8bd00840', NULL, NULL, NULL, 'sumon_dk@yahoo.com', '333333', NULL, NULL, NULL, '0000-00-00 00:00:00', 'club_member', 0, NULL, NULL, NULL, 0, NULL, NULL, 0),
(4, NULL, '0c1f6207aa2412cd275f244f8e4a3ded60b326e8', NULL, 'System Admin', 'Husain', 'system@gmail.com', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 'club_member', 3, NULL, NULL, NULL, 0, NULL, NULL, 0),
(5, NULL, 'aa37acc3ccfc6019c345bf0487de4e7f8bd00840', NULL, 'Uzzal', 'Masud', 'uzzal.masud123@gmail.com', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 'club_member', 3, NULL, NULL, NULL, 0, NULL, NULL, 3),
(6, NULL, 'aa37acc3ccfc6019c345bf0487de4e7f8bd00840', NULL, NULL, NULL, 'football@gmail.com', '123', NULL, NULL, NULL, '0000-00-00 00:00:00', 'club_member', 0, NULL, NULL, NULL, 0, NULL, NULL, 0),
(7, NULL, 'aa37acc3ccfc6019c345bf0487de4e7f8bd00840', NULL, 'mahi', 'uddin', 'mahi@gmail.com', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 'club_member', 6, NULL, NULL, NULL, 0, NULL, NULL, 4),
(8, NULL, 'b82905e21f4cfa5926d4ee72c088c19d017b6c1a', NULL, 'nitu', 'husain', 'nitu@gmail.com', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 'club_member', 7, NULL, NULL, NULL, 0, NULL, NULL, 5),
(9, NULL, '04612d82d86000602b8753c4a34b2e8e849f716e', NULL, 'sumon', 'islam', 'sharif@yahoo.com', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 'club_member', 7, NULL, NULL, NULL, 0, NULL, NULL, 5),
(28, NULL, 'aa37acc3ccfc6019c345bf0487de4e7f8bd00840', NULL, 'yt', 'hf', 'bappyiub@gmail.com', NULL, NULL, NULL, NULL, '2014-01-30 05:44:24', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, 0),
(29, NULL, '4ec208cb4baa71698f6e5460823849e6808f95c1', NULL, 'justub', 'atlan', 'J.atlanbiz@gmail.com', NULL, NULL, NULL, NULL, '2014-02-08 00:39:15', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, 0),
(32, NULL, '007c4440878467c5ba673e4522a0f77e07949b5f', NULL, 'manzoor', 'husaain', 'bappyiub@hotmail.com', NULL, NULL, NULL, NULL, '2014-02-19 02:47:16', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, 0),
(33, NULL, '7726dd5fe2e998dcc2b56aa8b36f9717ddcb3573', NULL, 'Just', 'Agaus', 'Josi@gmail.com', NULL, NULL, NULL, NULL, '2014-02-19 23:53:37', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, 0),
(34, NULL, '7135c87e0ca4e632ffc3ab3e3c8af45da22ef30b', NULL, 'amit', 'chowdhury', 'amit3j2003@gmail.com', '01672901708', 1, NULL, NULL, '0000-00-00 00:00:00', 'club_member', 7, NULL, NULL, NULL, 0, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `id` varchar(36) NOT NULL,
  `user_id` varchar(36) NOT NULL,
  `position` float NOT NULL DEFAULT '1',
  `field` varchar(255) NOT NULL,
  `value` text,
  `input` varchar(16) NOT NULL,
  `data_type` varchar(16) NOT NULL,
  `label` varchar(128) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_PROFILE_PROPERTY` (`field`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `name` varchar(300) NOT NULL,
  `role_id` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `name`, `role_id`) VALUES
(1, 4, 'Clubs', 0),
(2, 4, 'UserRoles', 0),
(3, 5, 'Clubs', 0),
(4, 5, 'UserRoles', 0),
(5, 7, 'Clubs', 0),
(6, 7, 'UserRoles', 0),
(7, 8, 'Clubs', 0),
(8, 8, 'UserRoles', 0),
(9, 9, 'MenuePricing', 0),
(10, 9, 'Orders', 0),
(11, 2, 'Clubs', 0),
(12, 2, 'UserRoles', 0),
(13, 1, 'Clubs', 0),
(14, 28, 'Clubs', 0),
(15, 3, 'Clubs', 0),
(22, 34, 'Earnings', 0),
(23, 34, 'Reservations', 0),
(24, 34, 'MenuePricing', 0),
(25, 34, 'Orders', 0),
(26, 34, 'Clubs', 0),
(27, 34, 'UserRoles', 0),
(28, 34, 'Users', 0),
(29, 34, 'MenuandPricing', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `booking club id` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `booking user id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `club table id` FOREIGN KEY (`club_table_id`) REFERENCES `club_tables` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `user id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `clubs`
--
ALTER TABLE `clubs`
  ADD CONSTRAINT `club type id` FOREIGN KEY (`club_type_id`) REFERENCES `club_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `club_bottles`
--
ALTER TABLE `club_bottles`
  ADD CONSTRAINT `bottles category id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `bottles club id` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `bottles user id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `club_exceptions`
--
ALTER TABLE `club_exceptions`
  ADD CONSTRAINT `exception club id` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `club_open_days`
--
ALTER TABLE `club_open_days`
  ADD CONSTRAINT `club opens day club id` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `club_tables`
--
ALTER TABLE `club_tables`
  ADD CONSTRAINT `table cat id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `table club id` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `table user id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `deals`
--
ALTER TABLE `deals`
  ADD CONSTRAINT `deal table id` FOREIGN KEY (`club_table_id`) REFERENCES `club_tables` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `deals club id` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events club id` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order booking id` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order user id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos club id` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `photos user id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `question_answers`
--
ALTER TABLE `question_answers`
  ADD CONSTRAINT `question id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `question user id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `splits`
--
ALTER TABLE `splits`
  ADD CONSTRAINT `split booking id` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `split user id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user job title id` FOREIGN KEY (`job_title_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

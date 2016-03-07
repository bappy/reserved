-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 11, 2014 at 01:38 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `reserved`
--

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
  `arrival_time` time DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `booking_price` float(10,2) DEFAULT NULL,
  `booking_method` enum('Manually Added','Rerserved App') DEFAULT 'Rerserved App',
  `booking_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('cancelled','check_in','pending','available','reserved','taken') DEFAULT 'available',
  `client_name` varchar(100) DEFAULT NULL,
  `client_phone` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking user id` (`user_id`),
  KEY `club table id` (`club_table_id`),
  KEY `booking club id` (`club_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `club_id`, `club_table_id`, `guys`, `girls`, `arrival_time`, `arrival_date`, `booking_price`, `booking_method`, `booking_time`, `status`, `client_name`, `client_phone`) VALUES
(1, 4, 4, 7, 5, 4, '14:30:00', '2014-02-10', 459.00, 'Manually Added', '2014-01-24 10:54:34', 'reserved', 'Adam Horwitz', '02345566'),
(2, 3, 4, 5, 5, 7, '14:40:00', '2014-02-13', 300.00, 'Rerserved App', '2014-01-29 07:56:09', 'taken', 'Sakoat Hossen', '+8801733548180');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_type`, `status`) VALUES
(1, 'Lounge Surrounding Area', 'table', 'active'),
(2, 'DJ/Dance Floor Area', 'table', 'active'),
(3, 'Most Expensive Tables', 'table', 'active'),
(6, 'Motka', 'bottle', 'active'),
(7, 'Cotka', 'bottle', 'active'),
(8, 'super vodka', 'bottle', 'active'),
(9, 'Super Motka', 'bottle', 'inactive'),
(10, 'Vodka', 'bottle', 'active'),
(11, 'Disco/DJ Dance', 'events', 'active'),
(12, 'Music', 'events', 'active'),
(13, 'DJ Dance', 'events', 'active');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `user_id`, `club_name`, `club_type_id`, `short_description`, `create_date`, `address`, `latitude`, `longitude`, `approve_auto_purchase`, `tip_service_fee`, `status`) VALUES
(1, 1, 'Games', 1, 'Game is good for health', '2014-01-15 05:27:32', 'Dhaka', '23.709921', '90.407143', 'yes', '', 'pending'),
(2, 2, 'Sharif''s Lounge', NULL, NULL, '0000-00-00 00:00:00', 'Dhaka', '23.709921', '90.407143', 'yes', '', 'pending'),
(3, 3, 'sumon''s club', NULL, NULL, '0000-00-00 00:00:00', 'Dhaka', '23.709921', '90.407143', 'yes', '', 'pending'),
(4, 4, 'Cricket Club', 1, 'This is description for Cricket Club', '2014-01-31 12:40:20', 'Banani', '23.7939927', '90.4042719', 'no', 'select 3', 'pending'),
(5, 5, 'Super Football', 2, 'This description super football', '2014-01-31 09:16:31', NULL, NULL, NULL, 'yes', '', 'pending');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `club_bottles`
--

INSERT INTO `club_bottles` (`id`, `user_id`, `club_id`, `category_id`, `bottle_name`, `bottle_price`, `upsell`, `upsell_type`, `status`) VALUES
(1, 4, 4, 8, 'Bottle Test', 230.00, '2', 'add', 'pending'),
(2, 4, 4, 8, 'New Bottles test 2', 230.80, '2', 'replace', 'approved');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `club_exceptions`
--

INSERT INTO `club_exceptions` (`id`, `club_id`, `exception_date`, `exception_name`, `open_time`, `close_time`, `status`) VALUES
(7, 2, '2014-01-22', 'test 1', '1 am', '5 am', 'Open'),
(8, 2, '2014-01-04', 'test 1', '0', '0', 'Open'),
(11, 1, '2014-01-02', 'Test Ed By Manzoor', '0', '0', 'Open'),
(12, 1, '2014-01-08', 'Exception 121', '0', '0', 'Open'),
(13, 3, '2014-01-09', 'nazmul', '1 am', '2 am', 'Open'),
(14, 5, '2014-01-08', 'Test', '2 am', '5 pm', 'Open'),
(15, 4, '2014-01-02', 'test', '0', '0', 'Open'),
(17, 4, '2014-01-02', 'test', '2 am', '0', 'Closed'),
(18, 4, '2014-01-02', 'Test 8', '6 am', '10 am', 'Closed');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=239 ;

--
-- Dumping data for table `club_open_days`
--

INSERT INTO `club_open_days` (`id`, `club_id`, `days`, `open_time`, `close_time`, `status`) VALUES
(1, 1, 'Saturday', '1 am', '1 am', 'Open'),
(2, 1, 'Sunday', '1 am', '1 am', 'Open'),
(3, 1, 'Monday', '1 am', '1 am', 'Open'),
(4, 1, 'Tuesday', '1 am', '1 am', 'Open'),
(5, 1, 'Wednesday', '1 am', '1 am', 'Open'),
(6, 1, 'Thursday', '1 am', '1 am', 'Open'),
(7, 1, 'Friday', '1 am', '1 am', 'Open'),
(8, 1, 'Saturday', '1 am', '1 am', 'Open'),
(9, 1, 'Sunday', '1 am', '1 am', 'Open'),
(10, 1, 'Monday', '1 am', '1 am', 'Open'),
(11, 1, 'Tuesday', '1 am', '1 am', 'Open'),
(12, 1, 'Wednesday', '1 am', '1 am', 'Open'),
(13, 1, 'Thursday', '1 am', '1 am', 'Open'),
(14, 1, 'Friday', '1 am', '1 am', 'Open'),
(15, 1, 'Saturday', '1 am', '1 am', 'Open'),
(16, 1, 'Sunday', '1 am', '1 am', 'Open'),
(17, 1, 'Monday', '1 am', '1 am', 'Open'),
(18, 1, 'Tuesday', '1 am', '1 am', 'Open'),
(19, 1, 'Wednesday', '1 am', '1 am', 'Open'),
(20, 1, 'Thursday', '1 am', '1 am', 'Open'),
(21, 1, 'Friday', '1 am', '1 am', 'Open'),
(22, 5, 'Saturday', '1 am', '1 am', 'Open'),
(23, 5, 'Sunday', '1 am', '1 am', 'Open'),
(24, 5, 'Monday', '1 am', '1 am', 'Open'),
(25, 5, 'Tuesday', '1 am', '1 am', 'Open'),
(26, 5, 'Wednesday', '1 am', '1 am', 'Open'),
(27, 5, 'Thursday', '1 am', '1 am', 'Open'),
(28, 5, 'Friday', '1 am', '1 am', 'Open'),
(29, 5, 'Saturday', '1 am', '1 am', 'Open'),
(30, 5, 'Sunday', '1 am', '1 am', 'Open'),
(31, 5, 'Monday', '1 am', '1 am', 'Open'),
(32, 5, 'Tuesday', '1 am', '1 am', 'Open'),
(33, 5, 'Wednesday', '1 am', '1 am', 'Open'),
(34, 5, 'Thursday', '1 am', '1 am', 'Open'),
(35, 5, 'Friday', '1 am', '1 am', 'Open'),
(36, 5, 'Saturday', '1 am', '1 am', 'Open'),
(37, 5, 'Sunday', '1 am', '1 am', 'Open'),
(38, 5, 'Monday', '1 am', '1 am', 'Open'),
(39, 5, 'Tuesday', '1 am', '1 am', 'Open'),
(40, 5, 'Wednesday', '1 am', '1 am', 'Open'),
(41, 5, 'Thursday', '1 am', '1 am', 'Open'),
(42, 5, 'Friday', '1 am', '1 am', 'Open'),
(43, 5, 'Saturday', '1 am', '1 am', 'Open'),
(44, 5, 'Sunday', '1 am', '1 am', 'Open'),
(45, 5, 'Monday', '1 am', '1 am', 'Open'),
(46, 5, 'Tuesday', '1 am', '1 am', 'Open'),
(47, 5, 'Wednesday', '1 am', '1 am', 'Open'),
(48, 5, 'Thursday', '1 am', '1 am', 'Open'),
(49, 5, 'Friday', '1 am', '1 am', 'Open'),
(50, 4, 'Saturday', '1 am', '1 am', 'Open'),
(51, 4, 'Sunday', '1 am', '1 am', 'Open'),
(52, 4, 'Monday', '1 am', '1 am', 'Open'),
(53, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(54, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(55, 4, 'Thursday', '1 am', '1 am', 'Open'),
(56, 4, 'Friday', '1 am', '1 am', 'Open'),
(57, 4, 'Saturday', '1 am', '1 am', 'Open'),
(58, 4, 'Sunday', '1 am', '1 am', 'Open'),
(59, 4, 'Monday', '1 am', '1 am', 'Open'),
(60, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(61, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(62, 4, 'Thursday', '1 am', '1 am', 'Open'),
(63, 4, 'Friday', '1 am', '1 am', 'Open'),
(64, 4, 'Saturday', '1 am', '1 am', 'Open'),
(65, 4, 'Sunday', '1 am', '1 am', 'Open'),
(66, 4, 'Monday', '1 am', '1 am', 'Open'),
(67, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(68, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(69, 4, 'Thursday', '1 am', '1 am', 'Open'),
(70, 4, 'Friday', '1 am', '1 am', 'Open'),
(71, 4, 'Saturday', '1 am', '1 am', 'Open'),
(72, 4, 'Sunday', '1 am', '1 am', 'Open'),
(73, 4, 'Monday', '1 am', '1 am', 'Open'),
(74, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(75, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(76, 4, 'Thursday', '1 am', '1 am', 'Open'),
(77, 4, 'Friday', '1 am', '1 am', 'Open'),
(78, 4, 'Saturday', '1 am', '1 am', 'Open'),
(79, 4, 'Sunday', '1 am', '1 am', 'Open'),
(80, 4, 'Monday', '1 am', '1 am', 'Open'),
(81, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(82, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(83, 4, 'Thursday', '1 am', '1 am', 'Open'),
(84, 4, 'Friday', '1 am', '1 am', 'Open'),
(85, 4, 'Saturday', '1 am', '1 am', 'Open'),
(86, 4, 'Sunday', '1 am', '1 am', 'Open'),
(87, 4, 'Monday', '1 am', '1 am', 'Open'),
(88, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(89, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(90, 4, 'Thursday', '1 am', '1 am', 'Open'),
(91, 4, 'Friday', '1 am', '1 am', 'Open'),
(92, 4, 'Saturday', '1 am', '1 am', 'Open'),
(93, 4, 'Sunday', '1 am', '1 am', 'Open'),
(94, 4, 'Monday', '1 am', '1 am', 'Open'),
(95, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(96, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(97, 4, 'Thursday', '1 am', '1 am', 'Open'),
(98, 4, 'Friday', '1 am', '1 am', 'Open'),
(99, 4, 'Saturday', '1 am', '1 am', 'Open'),
(100, 4, 'Sunday', '1 am', '1 am', 'Open'),
(101, 4, 'Monday', '1 am', '1 am', 'Open'),
(102, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(103, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(104, 4, 'Thursday', '1 am', '1 am', 'Open'),
(105, 4, 'Friday', '1 am', '1 am', 'Open'),
(106, 4, 'Saturday', '1 am', '1 am', 'Open'),
(107, 4, 'Sunday', '1 am', '1 am', 'Open'),
(108, 4, 'Monday', '1 am', '1 am', 'Open'),
(109, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(110, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(111, 4, 'Thursday', '1 am', '1 am', 'Open'),
(112, 4, 'Friday', '1 am', '1 am', 'Open'),
(113, 4, 'Saturday', '1 am', '1 am', 'Open'),
(114, 4, 'Sunday', '1 am', '1 am', 'Open'),
(115, 4, 'Monday', '1 am', '1 am', 'Open'),
(116, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(117, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(118, 4, 'Thursday', '1 am', '1 am', 'Open'),
(119, 4, 'Friday', '1 am', '1 am', 'Open'),
(120, 4, 'Saturday', '1 am', '1 am', 'Open'),
(121, 4, 'Sunday', '1 am', '1 am', 'Open'),
(122, 4, 'Monday', '1 am', '1 am', 'Open'),
(123, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(124, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(125, 4, 'Thursday', '1 am', '1 am', 'Open'),
(126, 4, 'Friday', '1 am', '1 am', 'Open'),
(127, 4, 'Saturday', '1 am', '1 am', 'Open'),
(128, 4, 'Sunday', '1 am', '1 am', 'Open'),
(129, 4, 'Monday', '1 am', '1 am', 'Open'),
(130, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(131, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(132, 4, 'Thursday', '1 am', '1 am', 'Open'),
(133, 4, 'Friday', '1 am', '1 am', 'Open'),
(134, 4, 'Saturday', '1 am', '1 am', 'Open'),
(135, 4, 'Sunday', '1 am', '1 am', 'Open'),
(136, 4, 'Monday', '1 am', '1 am', 'Open'),
(137, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(138, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(139, 4, 'Thursday', '1 am', '1 am', 'Open'),
(140, 4, 'Friday', '1 am', '1 am', 'Open'),
(141, 4, 'Saturday', '1 am', '1 am', 'Open'),
(142, 4, 'Sunday', '1 am', '1 am', 'Open'),
(143, 4, 'Monday', '1 am', '1 am', 'Open'),
(144, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(145, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(146, 4, 'Thursday', '1 am', '1 am', 'Open'),
(147, 4, 'Friday', '1 am', '1 am', 'Open'),
(148, 4, 'Saturday', '1 am', '1 am', 'Open'),
(149, 4, 'Sunday', '1 am', '1 am', 'Open'),
(150, 4, 'Monday', '1 am', '1 am', 'Open'),
(151, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(152, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(153, 4, 'Thursday', '1 am', '1 am', 'Open'),
(154, 4, 'Friday', '1 am', '1 am', 'Open'),
(155, 4, 'Saturday', '1 am', '1 am', 'Open'),
(156, 4, 'Sunday', '1 am', '1 am', 'Open'),
(157, 4, 'Monday', '1 am', '1 am', 'Open'),
(158, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(159, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(160, 4, 'Thursday', '1 am', '1 am', 'Open'),
(161, 4, 'Friday', '1 am', '1 am', 'Open'),
(162, 4, 'Saturday', '1 am', '1 am', 'Open'),
(163, 4, 'Sunday', '1 am', '1 am', 'Open'),
(164, 4, 'Monday', '1 am', '1 am', 'Open'),
(165, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(166, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(167, 4, 'Thursday', '1 am', '1 am', 'Open'),
(168, 4, 'Friday', '1 am', '1 am', 'Open'),
(169, 4, 'Saturday', '1 am', '1 am', 'Open'),
(170, 4, 'Sunday', '1 am', '1 am', 'Open'),
(171, 4, 'Monday', '1 am', '1 am', 'Open'),
(172, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(173, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(174, 4, 'Thursday', '1 am', '1 am', 'Open'),
(175, 4, 'Friday', '1 am', '1 am', 'Open'),
(176, 4, 'Saturday', '1 am', '1 am', 'Open'),
(177, 4, 'Sunday', '1 am', '1 am', 'Open'),
(178, 4, 'Monday', '1 am', '1 am', 'Open'),
(179, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(180, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(181, 4, 'Thursday', '1 am', '1 am', 'Open'),
(182, 4, 'Friday', '1 am', '1 am', 'Open'),
(183, 4, 'Saturday', '1 am', '1 am', 'Open'),
(184, 4, 'Sunday', '1 am', '1 am', 'Open'),
(185, 4, 'Monday', '1 am', '1 am', 'Open'),
(186, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(187, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(188, 4, 'Thursday', '1 am', '1 am', 'Open'),
(189, 4, 'Friday', '1 am', '1 am', 'Open'),
(190, 4, 'Saturday', '1 am', '1 am', 'Open'),
(191, 4, 'Sunday', '1 am', '1 am', 'Open'),
(192, 4, 'Monday', '1 am', '1 am', 'Open'),
(193, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(194, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(195, 4, 'Thursday', '1 am', '1 am', 'Open'),
(196, 4, 'Friday', '1 am', '1 am', 'Open'),
(197, 4, 'Saturday', '1 am', '1 am', 'Open'),
(198, 4, 'Sunday', '1 am', '1 am', 'Open'),
(199, 4, 'Monday', '1 am', '1 am', 'Open'),
(200, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(201, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(202, 4, 'Thursday', '1 am', '1 am', 'Open'),
(203, 4, 'Friday', '1 am', '1 am', 'Open'),
(204, 4, 'Saturday', '1 am', '1 am', 'Open'),
(205, 4, 'Sunday', '1 am', '1 am', 'Open'),
(206, 4, 'Monday', '1 am', '1 am', 'Open'),
(207, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(208, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(209, 4, 'Thursday', '1 am', '1 am', 'Open'),
(210, 4, 'Friday', '1 am', '1 am', 'Open'),
(211, 4, 'Saturday', '1 am', '1 am', 'Open'),
(212, 4, 'Sunday', '1 am', '1 am', 'Open'),
(213, 4, 'Monday', '1 am', '1 am', 'Open'),
(214, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(215, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(216, 4, 'Thursday', '1 am', '1 am', 'Open'),
(217, 4, 'Friday', '1 am', '1 am', 'Open'),
(218, 4, 'Saturday', '1 am', '1 am', 'Open'),
(219, 4, 'Sunday', '1 am', '1 am', 'Open'),
(220, 4, 'Monday', '1 am', '1 am', 'Open'),
(221, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(222, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(223, 4, 'Thursday', '1 am', '1 am', 'Open'),
(224, 4, 'Friday', '1 am', '1 am', 'Open'),
(225, 4, 'Saturday', '1 am', '1 am', 'Open'),
(226, 4, 'Sunday', '1 am', '1 am', 'Open'),
(227, 4, 'Monday', '1 am', '1 am', 'Open'),
(228, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(229, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(230, 4, 'Thursday', '1 am', '1 am', 'Open'),
(231, 4, 'Friday', '1 am', '1 am', 'Open'),
(232, 4, 'Saturday', '1 am', '1 am', 'Open'),
(233, 4, 'Sunday', '1 am', '1 am', 'Open'),
(234, 4, 'Monday', '1 am', '1 am', 'Open'),
(235, 4, 'Tuesday', '1 am', '1 am', 'Open'),
(236, 4, 'Wednesday', '1 am', '1 am', 'Open'),
(237, 4, 'Thursday', '1 am', '1 am', 'Open'),
(238, 4, 'Friday', '1 am', '1 am', 'Open');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `club_tables`
--

INSERT INTO `club_tables` (`id`, `user_id`, `club_id`, `table_name`, `category_id`, `minimum_price`, `table_min_guy`, `table_min_girls`, `max_guys1`, `max_guys1_price`, `max_guys2`, `max_guys2_price`, `create_date`, `status`) VALUES
(4, 4, 4, 'Test', 3, 200.00, 3, 4, 7, 50.00, 8, 75.00, '2014-01-20 06:28:52', 'pending'),
(5, 4, 4, 'Test', 3, 500.00, 8, 9, 5, 490.00, 6, 340.00, '2014-01-20 05:27:15', 'pending'),
(7, 4, 4, 'Second 2 To Left Dance', 2, 678.94, 10, 5, 4, 230.00, 8, 450.98, '2014-02-06 13:38:32', 'approved'),
(8, 4, 4, 'Second Test Table', 3, 490.50, 1, 10, 2, 45.00, 1, 55.90, '2014-01-29 04:54:48', 'approved');

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
(1, 'Games'),
(2, 'Super Football');

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE IF NOT EXISTS `deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) DEFAULT NULL,
  `club_table_id` int(11) DEFAULT NULL,
  `deal_price` float(10,2) DEFAULT NULL,
  `deal_now` enum('on','off') DEFAULT 'off',
  `deal_date` date DEFAULT NULL,
  `recur` enum('yes','no') DEFAULT 'no',
  `status` enum('on','off') DEFAULT 'on',
  PRIMARY KEY (`id`),
  KEY `deals club id` (`club_id`),
  KEY `deal table id` (`club_table_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id`, `club_id`, `club_table_id`, `deal_price`, `deal_now`, `deal_date`, `recur`, `status`) VALUES
(1, 4, 4, 100.00, 'off', NULL, 'yes', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `performer` varchar(200) DEFAULT NULL,
  `price_multiplier` float(11,1) DEFAULT NULL,
  `recur_week` enum('no','yes') DEFAULT 'no',
  `event_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events club id` (`club_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `club_id`, `category_id`, `performer`, `price_multiplier`, `recur_week`, `event_date`) VALUES
(1, 4, 11, 'Disco Dancer', 3.5, 'no', '2014-02-20'),
(2, 4, 12, 'Test2', 2.5, 'no', '2014-02-21');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `user_id`, `club_id`, `photos`, `photo_type`, `profile_picture`) VALUES
(1, 5, 5, '1391149036Hydrangeas.jpg', 'club', 'no'),
(2, 5, 5, '1391156651Koala.jpg', 'club', 'no'),
(3, 4, 4, '1391162648Hydrangeas.jpg', 'club', 'no'),
(4, 4, 4, '1391172063Koala.jpg', 'club', 'no'),
(5, 4, 4, '1391408221Penguins.jpg', 'club', 'no'),
(6, 4, 4, '1391408228Tulips.jpg', 'club', 'no'),
(7, 4, 4, '1391408240Jellyfish.jpg', 'club', 'no'),
(8, 4, 4, '1391408249Desert.jpg', 'club', 'no'),
(9, 4, 4, '1391408255Chrysanthemum.jpg', 'club', 'yes'),
(10, 4, 4, '1391408266Lighthouse.jpg', 'club', 'no');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `password_token`, `first_name`, `last_name`, `email_address`, `phone_number`, `job_title_id`, `fbid`, `fb_thumb_img`, `join_date`, `user_type`, `created_by`, `zip_code`, `cciv`, `promoter_code`, `email_verified`, `email_token`, `email_token_expires`, `club_id`) VALUES
(1, NULL, 'b70b03ed05dbc9095cc8806fccc3f7ef4b794f8b', NULL, NULL, NULL, 'games@gmail.com', '1234', NULL, NULL, NULL, '0000-00-00 00:00:00', 'club_member', 0, NULL, NULL, NULL, 0, NULL, NULL, 0),
(2, NULL, '975236d7d5e6f613886b8ff6a9dad0df18c325d3', 'ptr1zfelnw', NULL, NULL, 'isumon@gmail.com', '2345555', NULL, NULL, NULL, '0000-00-00 00:00:00', 'club_member', 0, NULL, NULL, NULL, 0, NULL, '2014-01-16 19:26:37', 0),
(3, NULL, '6d92e2e84e5934e7cd7e28a7581431adbcfdda7a', NULL, NULL, NULL, 'sumon_dk@yahoo.com', '333333', NULL, NULL, NULL, '0000-00-00 00:00:00', 'club_member', 0, NULL, NULL, NULL, 0, NULL, NULL, 0),
(4, '', '15777dca223fcf7a07efccd6b03239a12793d648', NULL, 'Sakoat', 'Hossen', 'sakoat@bglobalsourcing.com', '0234455', 1, NULL, NULL, '0000-00-00 00:00:00', 'club_member', 0, NULL, NULL, NULL, 0, NULL, NULL, 0),
(5, NULL, '405950726f66ad307c2d6d8aec588214b07ed70d', NULL, 'Sakoat', 'Hossen', 'Sakoatcse@gmail.com', '0234455', 2, NULL, NULL, '0000-00-00 00:00:00', 'club_member', 4, NULL, NULL, NULL, 0, NULL, NULL, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `name`, `role_id`) VALUES
(3, 4, 'Clubs', 0),
(4, 4, 'Users', 0),
(5, 4, 'UserRoles', 0),
(6, 4, 'Orders', 0),
(7, 4, 'Reservations', 0),
(8, 4, 'MenuandPricing', 0),
(34, 5, 'Clubs', 0),
(35, 5, 'UserRoles', 0),
(36, 5, 'Users', 0),
(37, 5, 'Orders', 0),
(38, 5, 'Reservations', 0),
(39, 5, 'MenuandPricing', 0);

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

-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 12, 2014 at 03:24 PM
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
-- Table structure for table `user_infos`
--

CREATE TABLE IF NOT EXISTS `user_infos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `website` varchar(50) NOT NULL,
  `street_address` text NOT NULL,
  `add_address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `postal_code` varchar(100) NOT NULL,
  `phone_no` varchar(50) NOT NULL,
  `country_id` tinyint(4) NOT NULL,
  `check` varchar(100) NOT NULL,
  `paypal_email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user_infos`
--

INSERT INTO `user_infos` (`id`, `user_id`, `website`, `street_address`, `add_address`, `city`, `state`, `postal_code`, `phone_no`, `country_id`, `check`, `paypal_email`) VALUES
(9, 51, 'http://www.troyeit.com', 'Dhanmondi', 'Shaymoli', 'Dhaka', 'Bangladesh', '1217', '01672901708', 19, '$100', 'amit3j2003@gmail.com'),
(10, 53, 'http://www.google.com', 'Dhaka', 'Dhaka', 'Dhaka', 'Dhaka', '4219', '123456', 1, '$100', '1@1.COM');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

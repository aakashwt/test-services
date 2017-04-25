-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2017 at 07:02 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wedding`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `last_ip` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `created_date`, `last_login`, `last_ip`) VALUES
(1, '', 'admin@site.com', '21232f297a57a5a743894a0e4a801fc3', '2016-05-21 07:15:16', '2017-03-22 09:40:28', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `country_name` varchar(150) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `id`, `code`, `country_name`) VALUES
(1, 2, 'AL', 'Albania'),
(2, 5, 'AD', 'Andorra'),
(3, 14, 'AT', 'Austria'),
(4, 15, 'AZ', 'Azerbaijan'),
(5, 20, 'BY', 'Belarus'),
(6, 21, 'BE', 'Belgium'),
(7, 27, 'BA', 'Bosnia and Herzegovina'),
(8, 33, 'BG', 'Bulgaria'),
(9, 54, 'HR', 'Croatia (Hrvatska)'),
(10, 57, 'CZ', 'Czech Republic'),
(11, 58, 'DK', 'Denmark'),
(12, 68, 'EE', 'Estonia'),
(13, 74, 'FI', 'Finland'),
(14, 75, 'FR', 'France'),
(15, 81, 'GE', 'Georgia'),
(16, 82, 'DE', 'Germany'),
(17, 85, 'GR', 'Greece'),
(18, 99, 'HU', 'Hungary'),
(19, 100, 'IS', 'Iceland'),
(20, 105, 'IE', 'Ireland'),
(21, 107, 'IT', 'Italy'),
(22, 112, 'KZ', 'Kazakhstan'),
(23, 120, 'LV', 'Latvia'),
(24, 125, 'LI', 'Liechtenstein'),
(25, 126, 'LT', 'Lithuania'),
(26, 127, 'LU', 'Luxembourg'),
(27, 129, 'MK', 'Macedonia'),
(28, 135, 'MT', 'Malta'),
(29, 144, 'MD', 'Moldova'),
(30, 145, 'MC', 'Monaco'),
(31, 154, 'AN', 'Netherlands Antilles'),
(32, 155, 'NL', 'Netherlands The'),
(33, 164, 'NO', 'Norway'),
(34, 175, 'PL', 'Poland'),
(35, 176, 'PT', 'Portugal'),
(36, 180, 'RO', 'Romania'),
(37, 181, 'RU', 'Russia'),
(38, 189, 'SM', 'San Marino'),
(39, 193, 'RS', 'Serbia'),
(40, 197, 'SK', 'Slovakia'),
(41, 198, 'SI', 'Slovenia'),
(42, 205, 'ES', 'Spain'),
(43, 211, 'SE', 'Sweden'),
(44, 212, 'CH', 'Switzerland'),
(45, 223, 'TR', 'Turkey'),
(46, 228, 'UA', 'Ukraine'),
(47, 230, 'GB', 'United Kingdom'),
(48, 236, 'VA', 'Vatican City State (Holy See)');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` int(15) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `address` text NOT NULL,
  `company_name` varchar(128) NOT NULL,
  `category` int(11) NOT NULL,
  `logo` varchar(128) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 11, 2024 at 08:11 PM
-- Server version: 5.5.29
-- PHP Version: 5.3.10-1ubuntu3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `HNDWEBMR3`
--

-- --------------------------------------------------------

--
-- Table structure for table `AeroMembers`
--

CREATE TABLE IF NOT EXISTS `AeroMembers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `member_type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `AeroMembers`
--

INSERT INTO `AeroMembers` (`ID`, `username`, `password`, `DOB`, `member_type`) VALUES
(1, 'Carlo', 'Mexico', '2000-03-03', 'admin'),
(17, 'test1', 'test1', '1999-12-12', 'admin'),
(20, 'Johnwhite', 'P@ssw0rd!', '1990-11-11', 'admin'),
(21, '!@#$%~``^', 'P@ssw0rd!', '1990-11-11', 'admin'),
(22, '!@#$%~``^', 'P@ssw0rd!', '1990-11-11', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

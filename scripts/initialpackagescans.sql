-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 25, 2015 at 03:50 PM
-- Server version: 5.6.25
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `websource_package_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `initialpackagescans`
--

CREATE TABLE IF NOT EXISTS `initialpackagescans` (
  `ScanNumber` int(11) NOT NULL,
  `TrackingNumber` varchar(60) NOT NULL,
  `ShippingCarrier` varchar(60) DEFAULT NULL,
  `TimeScanned` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ScannedBy` varchar(30) NOT NULL COMMENT 'The username of the person who scanned the package'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `initialpackagescans`
--

INSERT INTO `initialpackagescans` (`ScanNumber`, `TrackingNumber`, `ShippingCarrier`, `TimeScanned`, `ScannedBy`) VALUES
(5, '7347783478347', 'FedEx', '2015-11-24 16:13:54', 'Kenice'),
(6, '8741255552', 'USPS', '2015-11-24 16:14:02', 'Kenice');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `initialpackagescans`
--
ALTER TABLE `initialpackagescans`
  ADD PRIMARY KEY (`ScanNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `initialpackagescans`
--
ALTER TABLE `initialpackagescans`
  MODIFY `ScanNumber` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

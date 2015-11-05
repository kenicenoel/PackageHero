-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2015 at 07:39 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

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
-- Table structure for table `newsfeed`
--

CREATE TABLE `newsfeed` (
  `NewsfeedNumber` int(11) NOT NULL,
  `PackageID` int(11) NOT NULL,
  `News` varchar(200) DEFAULT NULL,
  `TimeCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Username` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `PackageID` int(11) NOT NULL,
  `TrackingNumber` varchar(50) NOT NULL,
  `HAWB` varchar(50) DEFAULT NULL,
  `CustomerName` varchar(50) DEFAULT NULL,
  `MainIssue` varchar(50) NOT NULL DEFAULT 'Not entered',
  `Description` varchar(300) NOT NULL,
  `HideFromCountry` varchar(30) DEFAULT NULL,
  `Photo1` varchar(50) DEFAULT NULL,
  `Photo2` varchar(50) DEFAULT NULL,
  `Photo3` varchar(50) DEFAULT NULL,
  `Photo4` varchar(50) DEFAULT NULL,
  `Photo5` varchar(50) DEFAULT NULL,
  `Resolved` varchar(3) NOT NULL DEFAULT 'No',
  `ResolvedTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ResolvedBy` varchar(25) DEFAULT NULL,
  `IssueCreationTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`PackageID`, `TrackingNumber`, `HAWB`, `CustomerName`, `MainIssue`, `Description`, `HideFromCountry`, `Photo1`, `Photo2`, `Photo3`, `Photo4`, `Photo5`, `Resolved`, `ResolvedTimestamp`, `ResolvedBy`, `IssueCreationTime`) VALUES
(1, '890556517', NULL, 'Bell Hopkin', 'Broken', 'Lorem ipsum dolor sit amet, ultrices pharetra nonummy congue et, ac \r\npurus sodales, accumsan ligula.', NULL, 'uploads/fridge.jpg', NULL, NULL, NULL, NULL, 'Yes', '2015-11-05 16:01:55', 'ramcharitar', '2015-11-04 16:57:34'),
(2, '56808608608', NULL, 'Ann Sa', 'Cannot identify customer', 'Lorem ipsum dolor sit amet, ', NULL, 'uploads/broken pc.jpg', 'uploads/laptop2.jpg', NULL, NULL, NULL, 'Yes', '2015-11-05 15:54:02', 'ramcharitar', '2015-11-04 16:58:04'),
(3, '2323324355', NULL, '', 'Cannot identify customer', 'Lorem ipsum dolor sit amet, ', NULL, 'uploads/lumia950.jpg', NULL, NULL, NULL, NULL, 'Yes', '2015-11-05 15:52:55', 'kenice', '2015-11-04 16:58:23'),
(4, '98567565656565', NULL, 'Mark Dull', 'Invoice required', '', NULL, 'uploads/monitor.jpg', NULL, NULL, NULL, NULL, 'Yes', '2015-11-05 15:37:21', 'kenice', '2015-11-04 16:58:47'),
(6, '21212346486', NULL, 'Zachari Levi', 'Delivery address not known', 'Could not find a web number for customer.', 'Grenada', 'uploads/jacket.jpg', NULL, NULL, NULL, NULL, 'No', '2015-11-05 17:18:10', NULL, '2015-11-05 16:09:17'),
(7, '5785478483437', NULL, '', 'Cannot identify customer', 'Customer data has not been supplied. ', NULL, 'uploads/LBP2-Sackboy.JPG', NULL, NULL, NULL, NULL, 'No', '2015-11-05 18:28:14', NULL, '2015-11-05 18:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `UpdateNumber` int(11) NOT NULL,
  `PackageID` int(11) NOT NULL,
  `Note` varchar(200) DEFAULT NULL,
  `TimeCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Username` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `updates`
--

INSERT INTO `updates` (`UpdateNumber`, `PackageID`, `Note`, `TimeCreated`, `Username`) VALUES
(1, 4, 'Called mark to request invoice', '2015-11-05 15:36:11', 'kenice'),
(2, 4, 'Received invoice from customer', '2015-11-05 15:36:37', 'kenice'),
(3, 4, 'Issue resolved', '2015-11-05 15:36:52', 'kenice'),
(4, 1, 'Shipped to customer', '2015-11-05 15:49:49', 'kenice'),
(5, 3, 'yihilj', '2015-11-05 15:52:20', 'ramcharitar');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(5) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(36) NOT NULL,
  `FirstName` varchar(20) DEFAULT NULL,
  `LastName` varchar(20) DEFAULT NULL,
  `EmailAddress` varchar(50) DEFAULT NULL,
  `PhoneNumber` varchar(11) DEFAULT NULL,
  `Country` varchar(30) NOT NULL,
  `LastLoginTime` timestamp NULL DEFAULT NULL,
  `LastModifiedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `Username`, `Password`, `FirstName`, `LastName`, `EmailAddress`, `PhoneNumber`, `Country`, `LastLoginTime`, `LastModifiedOn`) VALUES
(1, 'kenice', 'knj271990', 'Kenice', 'Noel', 'kenicenoel@outlook.com', '18687866586', 'Grenada', NULL, '2015-11-04 20:46:36'),
(2, 'ramcharitar', 'test', NULL, NULL, NULL, NULL, 'Trinidad', NULL, '2015-11-05 15:51:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `newsfeed`
--
ALTER TABLE `newsfeed`
  ADD PRIMARY KEY (`NewsfeedNumber`),
  ADD KEY `newsfeed` (`PackageID`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`PackageID`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`UpdateNumber`),
  ADD KEY `updates` (`PackageID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `newsfeed`
--
ALTER TABLE `newsfeed`
  MODIFY `NewsfeedNumber` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `PackageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `UpdateNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `newsfeed`
--
ALTER TABLE `newsfeed`
  ADD CONSTRAINT `newsfeed` FOREIGN KEY (`PackageID`) REFERENCES `packages` (`PackageID`);

--
-- Constraints for table `updates`
--
ALTER TABLE `updates`
  ADD CONSTRAINT `updates` FOREIGN KEY (`PackageID`) REFERENCES `packages` (`PackageID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 29, 2023 at 03:19 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meetingroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `CompanyId` int NOT NULL AUTO_INCREMENT,
  `CompanyName` varchar(100) NOT NULL,
  `CompanyDescription` varchar(100) NOT NULL,
  `CompanyEmail` varchar(100) NOT NULL,
  `CompanyLogo` varchar(50) NOT NULL,
  `CompanyActive` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CompanyId`,`CompanyName`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`CompanyId`, `CompanyName`, `CompanyDescription`, `CompanyEmail`, `CompanyLogo`, `CompanyActive`) VALUES
(6, 'Test Company', 'A test company', 'test@example.com', 'logo.png', 1),
(8, 'wertyu', 'cvbn@sdfghj', 'email@email', 'tyhgtyhgyh', 1),
(9, 'wertyu', 'cvbn@sdfghj', 'email@email', 'tyhgtyhgyh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

DROP TABLE IF EXISTS `meeting`;
CREATE TABLE IF NOT EXISTS `meeting` (
  `ReservationId` int NOT NULL AUTO_INCREMENT,
  `StartTime` datetime NOT NULL,
  `EndTime` datetime NOT NULL,
  `RelatedRoom` int DEFAULT NULL,
  `NumberOfAttendees` int DEFAULT NULL,
  `MeetingStatus` tinyint(1) DEFAULT NULL,
  `MeetingManagerId` int NOT NULL,
  `Duration` int NOT NULL,
  PRIMARY KEY (`ReservationId`),
  UNIQUE KEY `StartTime` (`StartTime`,`EndTime`),
  UNIQUE KEY `StartTime_2` (`StartTime`,`EndTime`),
  KEY `FK_Meeting_SystemUser` (`MeetingManagerId`),
  KEY `FK_Meeting_Room` (`RelatedRoom`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`ReservationId`, `StartTime`, `EndTime`, `RelatedRoom`, `NumberOfAttendees`, `MeetingStatus`, `MeetingManagerId`, `Duration`) VALUES
(16, '2023-08-16 01:48:00', '2023-08-16 01:48:00', 1, 0, 1, 1, 0),
(15, '2023-08-09 01:38:00', '2023-08-17 01:38:00', 3, 10, 1, 1, 0),
(7, '2023-08-31 01:45:00', '2023-08-31 07:45:00', 1, 10, 1, 1, 0),
(11, '2023-08-19 01:45:00', '2023-08-19 02:45:00', 1, 10, 1, 0, 0),
(18, '2023-08-29 05:15:00', '2023-08-29 05:15:00', 1, 20, 1, 1, 0),
(19, '2023-09-01 03:19:00', '2023-09-01 03:19:00', 1, 20, 1, 1, 0),
(20, '2023-09-09 03:20:00', '2023-09-09 03:20:00', 1, 10, 1, 1, 0),
(21, '2023-08-29 03:32:00', '2023-08-29 05:32:00', 1, 50, 1, 1, 0),
(22, '2023-08-31 03:33:00', '2023-08-31 03:33:00', 1, 10, 1, 1, 0),
(26, '2023-08-29 06:15:00', '2023-08-29 05:15:00', 1, 12, 1, 1, 0),
(27, '2023-08-29 05:16:00', '2023-08-29 05:15:00', 1, 12, 1, 1, 0),
(28, '2023-09-07 16:43:00', '2023-09-07 16:43:00', 1, 15, 1, 6, 0),
(29, '2023-09-08 16:43:00', '2023-09-08 17:44:00', 1, 12, 1, 6, 0),
(30, '2023-09-09 16:45:00', '2023-09-09 16:45:00', 1, 12, 1, 6, 0),
(31, '2023-09-10 16:45:00', '2023-09-10 16:45:00', 1, 12, 1, 6, 0),
(32, '2023-09-11 16:45:00', '2023-09-11 16:45:00', 1, 12, 1, 6, 0),
(33, '2023-10-29 16:51:00', '2023-10-29 16:51:00', 1, 12, 1, 6, 0),
(34, '2023-11-30 16:53:00', '2023-11-30 16:53:00', 1, 20, 1, 6, 0),
(35, '2023-09-07 22:55:00', '2023-09-07 22:55:00', 1, 12, 1, 6, 0),
(36, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 1, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `RoomId` int NOT NULL AUTO_INCREMENT,
  `RoomLocation` varchar(255) DEFAULT NULL,
  `RoomCapacity` int DEFAULT NULL,
  `RoomDescription` varchar(255) DEFAULT NULL,
  `RelatedCompany` int DEFAULT NULL,
  PRIMARY KEY (`RoomId`),
  KEY `FK_Room_Company` (`RelatedCompany`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`RoomId`, `RoomLocation`, `RoomCapacity`, `RoomDescription`, `RelatedCompany`) VALUES
(1, 'Test Location', 10, 'Test Description', 4),
(3, 'cvbnjm', 0, 'fghjk', 8);

-- --------------------------------------------------------

--
-- Table structure for table `systemuser`
--

DROP TABLE IF EXISTS `systemuser`;
CREATE TABLE IF NOT EXISTS `systemuser` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Birth` date DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `UserPassword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `UserRole` varchar(50) NOT NULL,
  `CompanyId` int DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_SystemUser_Company` (`CompanyId`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `systemuser`
--

INSERT INTO `systemuser` (`Id`, `UserName`, `Birth`, `Gender`, `Email`, `UserPassword`, `UserRole`, `CompanyId`) VALUES
(1, 'Test User', '1995-01-01', 'Male', 'test@example.com', 'test123', 'User', 4),
(2, 'Test User', '1995-01-01', 'Male', 'test@example.com', 'test123', 'User', 4),
(3, 'abbb', '2023-08-07', 'Male', 'aaaaa', 'aaaaa', 'User', 6),
(6, 'ebbani', '1995-07-27', 'Male', 'ebbani@email', 'ebbb', 'Admin', 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

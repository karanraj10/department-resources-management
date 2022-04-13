-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2021 at 10:32 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `department`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(5) NOT NULL,
  `categoryName` varchar(50) NOT NULL,
  `categoryDesc` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`, `categoryDesc`) VALUES
(8, 'Desktop', 'desktop (Personal Computer).'),
(9, 'Printer', 'this is printer ');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `resourceID` int(5) NOT NULL,
  `resourceName` varchar(50) NOT NULL,
  `resourceDesc` varchar(300) NOT NULL,
  `resourceMAC` varchar(50) NOT NULL,
  `resourceCompany` varchar(50) NOT NULL,
  `resourceCategory` int(5) NOT NULL,
  `resourceSection` int(5) NOT NULL,
  `lastUpdated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`resourceID`, `resourceName`, `resourceDesc`, `resourceMAC`, `resourceCompany`, `resourceCategory`, `resourceSection`, `lastUpdated`) VALUES
(89, 'PC 1', 'pc 1 from dell for programming of c', '1111', 'DELL', 8, 13, '2021-06-22 13:42:58'),
(90, 'PC 2', 'Pc 2  for computer department.', '1112', 'DELL', 8, 13, '2021-06-22 13:44:24'),
(91, 'PC 3', 'pc 2 from dell for programming of c', '1113', 'DELL', 8, 13, '2021-06-22 13:42:58'),
(92, 'PC 4', 'Pc 4  for computer department.', '1114', 'DELL', 8, 14, '2021-06-22 13:44:05'),
(93, 'PC 5', 'pc 5 from dell for programming of c', '1115', 'DELL', 8, 14, '2021-06-22 13:43:40'),
(94, 'Printer 1', 'Printer 1', 'p01', 'CANON', 9, 15, '2021-06-23 13:25:18'),
(95, 'Printer 2', 'Printer 2 is for printing', 'p02', 'CANON', 9, 15, '2021-06-23 13:39:53'),
(96, 'Printer 3', 'Printer 3', 'p03', 'CANON', 9, 15, '2021-06-23 13:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `sectionID` int(5) NOT NULL,
  `sectionName` varchar(50) NOT NULL,
  `sectionDesc` varchar(300) NOT NULL,
  `sectionCapacity` int(5) NOT NULL,
  `sectionAllocated` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sectionID`, `sectionName`, `sectionDesc`, `sectionCapacity`, `sectionAllocated`) VALUES
(13, 'Store Room', 'Store Room of Computer Department BVM.', 600, 3),
(14, 'BATCH AB', 'batch AB for Roll NO between 1 and 40', 50, 2),
(15, 'BATCH CD', 'cd', 50, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`resourceID`),
  ADD UNIQUE KEY `resourceMAC` (`resourceMAC`),
  ADD KEY `resource_category` (`resourceCategory`),
  ADD KEY `resource_section` (`resourceSection`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`sectionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `resourceID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `sectionID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resource_category` FOREIGN KEY (`resourceCategory`) REFERENCES `categories` (`categoryID`),
  ADD CONSTRAINT `resource_section` FOREIGN KEY (`resourceSection`) REFERENCES `section` (`sectionID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

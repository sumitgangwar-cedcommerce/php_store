-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-server
-- Generation Time: Jun 24, 2022 at 09:06 AM
-- Server version: 8.0.19
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `Order_id` int NOT NULL,
  `User_email` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `Total_Amount` varchar(255) DEFAULT NULL,
  `Status` enum('Pending','Approved','Rejected') DEFAULT NULL,
  `Order_Date` datetime DEFAULT NULL,
  `Delivery_Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`Order_id`, `User_email`, `City`, `Total_Amount`, `Status`, `Order_Date`, `Delivery_Date`) VALUES
(19, 'sumit@abc', 'Meerut', '490281', 'Pending', '2022-06-22 10:39:00', '2022-06-24 00:00:00'),
(20, 'shiv@abc', 'Lucknow', '147192', 'Approved', '2022-06-22 12:25:19', '2022-06-30 00:00:00'),
(21, 'sachin@abc', 'Kanpur', '109152', 'Approved', '2022-06-23 04:47:19', '2022-06-19 00:00:00'),
(22, 'sachin@abc', 'Kanpur', '40000', 'Pending', '2022-06-23 04:48:52', '2022-06-10 00:00:00'),
(23, 'sachin@abc', 'Kanpur', '40000', 'Pending', '2022-06-23 04:49:43', '2022-06-03 00:00:00'),
(24, 'sachin@abc', 'Kanpur', '9799', 'Pending', '2022-06-23 04:49:58', '2022-06-24 00:00:00'),
(25, 'shiv@abc', 'Lucknow', '110766', 'Approved', '2022-06-23 06:36:02', '2022-06-26 00:00:00'),
(26, 'shiv@abc', 'Lucknow', '20000', 'Pending', '2022-06-23 06:43:11', '2022-06-24 00:00:00'),
(27, 'shiv@abc', 'Lucknow', '295315', 'Pending', '2022-06-23 07:38:45', '2022-06-14 00:00:00'),
(28, 'amit@abc.com', 'Meerur', '21588', 'Pending', '2022-06-23 10:12:30', '2022-06-03 00:00:00'),
(29, 'sumit@abc.com', 'Meerut', '89962', 'Pending', '2022-06-23 10:25:30', '2022-06-12 00:00:00'),
(30, 'sumit@abc.com', 'Meerut', '87564', 'Pending', '2022-06-23 12:40:55', NULL),
(31, 'sumit@abc.com', 'Meerut', '31387', 'Pending', '2022-06-23 13:08:41', NULL),
(32, 'sumit@abc.com', 'Meerut', '67564', 'Pending', '2022-06-24 03:33:56', NULL),
(33, 'amit@abc.com', 'Meerur', '31387', 'Pending', '2022-06-24 05:39:21', NULL),
(34, 'vaibhav@abc.com', 'Delhi', '41186', 'Pending', '2022-06-24 05:54:06', NULL),
(35, 'vaibhav@abc.com', 'Delhi', '1299332', 'Pending', '2022-06-24 06:42:52', NULL),
(36, 'amit@abc.com', 'Meerur', '40000', 'Pending', '2022-06-24 06:46:29', NULL),
(37, 'amit@abc.com', 'Meerur', '521653', 'Pending', '2022-06-24 07:47:13', NULL),
(38, 'amit@abc.com', 'Meerur', '663134', 'Pending', '2022-06-24 07:55:53', NULL),
(39, 'raghu@gmail.com', 'Meerut', '114995', 'Approved', '2022-06-24 08:00:30', '2022-06-24 00:00:00'),
(40, 'amit@abc.com', 'Meerur', '29397', 'Pending', '2022-06-24 08:56:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Order_details`
--

CREATE TABLE `Order_details` (
  `Order_id` int DEFAULT NULL,
  `Product_id` int DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Order_details`
--

INSERT INTO `Order_details` (`Order_id`, `Product_id`, `Quantity`) VALUES
(19, 43, '3'),
(19, 44, '1'),
(19, 45, '7'),
(19, 46, '2'),
(19, 51, '2'),
(19, 48, '2'),
(19, 47, '1'),
(20, 43, '4'),
(20, 44, '4'),
(20, 45, '4'),
(21, 43, '1'),
(21, 44, '1'),
(21, 45, '3'),
(21, 46, '4'),
(22, 43, '2'),
(23, 43, '2'),
(24, 44, '1'),
(25, 45, '1'),
(25, 46, '3'),
(25, 43, '3'),
(26, 43, '1'),
(27, 44, '4'),
(27, 45, '3'),
(27, 46, '3'),
(27, 47, '1'),
(27, 48, '1'),
(27, 51, '1'),
(28, 45, '1'),
(28, 46, '1'),
(29, 44, '4'),
(29, 45, '1'),
(29, 46, '3'),
(30, 45, '2'),
(30, 46, '3'),
(30, 44, '1'),
(30, 43, '1'),
(31, 44, '1'),
(31, 45, '1'),
(31, 46, '1'),
(32, 46, '3'),
(32, 45, '2'),
(32, 44, '1'),
(33, 45, '1'),
(33, 46, '1'),
(33, 44, '1'),
(34, 45, '1'),
(34, 46, '1'),
(34, 44, '2'),
(35, 45, '1'),
(35, 46, '1'),
(35, 44, '1'),
(35, 54, '1'),
(35, 55, '4'),
(35, 56, '4'),
(35, 43, '1'),
(35, 57, '4'),
(35, 59, '1'),
(35, 58, '1'),
(35, 51, '4'),
(35, 48, '1'),
(35, 47, '1'),
(36, 55, '1'),
(37, 44, '1'),
(37, 45, '1'),
(37, 46, '1'),
(37, 47, '1'),
(37, 43, '1'),
(37, 51, '1'),
(37, 48, '3'),
(37, 55, '3'),
(37, 56, '1'),
(38, 44, '4'),
(38, 45, '4'),
(38, 46, '5'),
(38, 54, '8'),
(38, 55, '2'),
(38, 56, '3'),
(39, 45, '5'),
(39, 55, '2'),
(40, 44, '3');

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `Id` int NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Category` varchar(255) DEFAULT NULL,
  `Price` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`Id`, `Name`, `Image`, `Category`, `Price`) VALUES
(43, 'Realme X', 'img/realme-x-1.png', 'Mobile', '20000'),
(44, ' Nokia 6.1 Plus', 'img/nokia-6.1.png', 'Mobile', '9799'),
(45, 'Mi-5', 'img/MI-removebg.png', 'Mobile', '6999'),
(46, 'Oppo F17 Pro', 'img/oppo-f17-pro.png', 'Mobile', '14589'),
(47, 'Samsung S7', 'img/samsung-s7.png', 'Mobile', '40399'),
(48, 'Samsung S7 edge', 'img/s7-edge.webp', 'Mobile', '38956'),
(51, 'I Phone XR', 'img/iphonex.webp', 'Mobile', '112000'),
(54, 'Toshiba TV', 'img/Toshiba_TV.png', 'TV', '25000'),
(55, 'Samsung TV', 'img/Samsung_TV.png', 'TV', '40000'),
(56, 'Samsung UHD', 'img/Samsung_UHD.png', 'TV', '80999'),
(57, 'Sony TV', 'img/sony.png', 'TV', '45999'),
(58, 'Onida TV', 'img/Onida.png', 'TV', '1599'),
(59, 'MI TV', 'img/MI.png', 'TV', '25999');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `Role` enum('admin','user') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`Name`, `Email`, `Password`, `Address`, `City`, `Role`) VALUES
('Akash', 'akash@abc.com', '1234', 'C-17 Nurserry', 'Bareilly', 'user'),
('Amit', 'amit@ab.com', '1234', 'X-7 Police Line', 'Meerut', 'user'),
('amit', 'amit@abc.com', '1234', 'X-4 New lane Jagriti vihar', 'Meerur', 'admin'),
('isha', 'isha@abc.com', '1234', 'kanpur goal chowk', 'kanpur', 'user'),
('Kamal', 'kamal@abc.com', '1234', 'C-15 Abu lane', 'Banaras', 'admin'),
('Sachin', 'sachin@abc.com', '1234', 'Rajeev Nagar 208040', 'Kanpur', 'user'),
('Shiv Shakti', 'shiv@abc.com', '1234', '112/138 rajeev nagar', 'Lucknow', 'user'),
('sumit', 'su@ab.com', '1234', 'New Sadak A-10', 'Meerut', 'admin'),
('Sumit Gangwar', 'sumit@abc.com', '1234', 'X-7 Police Line Meerut', 'Meerut', 'user'),
('Vaibhav', 'vaibhav@abc.com', '1234', 'anand vihar terminal', 'Delhi', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`Order_id`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `Order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

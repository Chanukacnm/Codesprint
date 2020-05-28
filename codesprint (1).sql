-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2020 at 08:44 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codesprint`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `carId` int(4) NOT NULL,
  `carName` varchar(30) NOT NULL,
  `carPicNameSmall` varchar(100) NOT NULL,
  `carPicNameLarge` varchar(100) NOT NULL,
  `carDescripShort` varchar(100) NOT NULL,
  `carDescripLong` varchar(1000) NOT NULL,
  `carQuantity` int(20) NOT NULL,
  `carPrice` double(6,2) NOT NULL,
  `carRate` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`carId`, `carName`, `carPicNameSmall`, `carPicNameLarge`, `carDescripShort`, `carDescripLong`, `carQuantity`, `carPrice`, `carRate`) VALUES
(1, 'CR-V', 'cr-v.png', 'cr-v.png', 'Honda CRV', 'Honda CRV Mastetpiece 2018 Model Red Color,Tan Premium Interior,Wood Trim Interior Dash Bord,Brown Leather Electric Seats,Honda Sensing Includes Lane Keeping Assist, Aadaptive Cruise Control, Dual Multyfunction,Paddle Shift,Dual Zone Climate Control,Dual A/C, Panaromic Sunroof, Roof Rails,18\" Original Alloys,LED Daytime Running Lights,LED Fog Lamps,LED Head Lights, 8 Air Bags,Power Tail Gate with kik Open Function.,', 18, 9999.99, 0),
(2, 'Civic', 'civic.png', 'civic.png', 'Honda Civic', 'Brand New Honda Civic EX Package with Full Options.,', 20, 9999.99, 0),
(3, 'vezel', 'vezel.png', 'vezel.png', 'Honda Vezel', 'Brand New, RS-Grade, Black Interior, Reverse Camera, Dual Air Bags, Cruise Control, Paddle Shift, Auto Braking, ABS, Winker Mirror, HID Head Light, Adjustable Auto Braking+Radar, LED Fog Lights, Lane Detector, Rear Wiper, Original Alloys.,', 22, 9999.99, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderNo` int(4) NOT NULL,
  `userId` int(4) NOT NULL,
  `orderDateTime` datetime NOT NULL,
  `orderTotal` decimal(50,0) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderNo`, `userId`, `orderDateTime`, `orderTotal`) VALUES
(4, 3, '2020-04-10 12:03:21', '10000'),
(5, 2, '2020-04-10 12:13:09', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `order_line`
--

CREATE TABLE `order_line` (
  `oderLineId` int(4) NOT NULL,
  `orderNo` int(4) NOT NULL,
  `prodId` int(4) NOT NULL,
  `quantityOrdered` int(4) NOT NULL,
  `subTotal` decimal(8,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_line`
--

INSERT INTO `order_line` (`oderLineId`, `orderNo`, `prodId`, `quantityOrdered`, `subTotal`) VALUES
(2, 4, 1, 1, '9999.99'),
(3, 5, 1, 1, '9999.99');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(4) NOT NULL,
  `userType` varchar(1) NOT NULL,
  `userFName` varchar(50) NOT NULL,
  `userSName` varchar(50) NOT NULL,
  `userAddress` varchar(50) NOT NULL,
  `userTelNo` varchar(50) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPassword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userType`, `userFName`, `userSName`, `userAddress`, `userTelNo`, `userEmail`, `userPassword`) VALUES
(1, 'a', 'Chanuka', 'Nimsara', 'Matara', '0717611781', 'chanukacnm98@gmail.com', '123456'),
(2, 'c', 'Minuri', 'Sanara', 'Ambalangoda', '0123456789', 'minusanara@gmail.com', '123123'),
(3, 'c', 'aaa', 'bbb', 'dd', '6', 'abcd@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`carId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderNo`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`oderLineId`),
  ADD KEY `orderNo` (`orderNo`,`prodId`),
  ADD KEY `prodId` (`prodId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `carId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderNo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `oderLineId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

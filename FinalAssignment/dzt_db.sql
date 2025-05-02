-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Generation Time: May 02, 2025 at 04:49 PM
=======
-- Generation Time: May 01, 2025 at 01:05 AM
>>>>>>> 5c1c4024f986f4e484d2afad73437f4534d91dfb
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dzt_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `landlords`
--

CREATE TABLE `landlords` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landlords`
--

INSERT INTO `landlords` (`ID`, `UserName`, `Password`) VALUES
<<<<<<< HEAD
(3, 'dylan', '123'),
(4, 'teo', '123');
=======
(1, 'dylan', '789'),
(2, 'jerry', '456');
>>>>>>> 5c1c4024f986f4e484d2afad73437f4534d91dfb

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `ID` int(11) NOT NULL,
  `LandlordID` int(11) DEFAULT NULL,
  `Beds` int(11) DEFAULT NULL,
  `RentalMonths` int(11) DEFAULT NULL,
  `RentalPrice` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `ID` int(11) NOT NULL,
<<<<<<< HEAD
  `UserName` varchar(20) NOT NULL,
=======
  `UserID` int(11) DEFAULT NULL,
>>>>>>> 5c1c4024f986f4e484d2afad73437f4534d91dfb
  `ServiceName` varchar(200) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

<<<<<<< HEAD
--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`ID`, `UserName`, `ServiceName`, `Date`, `Comment`) VALUES
(2, 'Derrick', 'dylan', '2025-05-01', 'fdfd');

=======
>>>>>>> 5c1c4024f986f4e484d2afad73437f4534d91dfb
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(200) NOT NULL,
  `Password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `UserName`, `Password`) VALUES
<<<<<<< HEAD
(13, 'Derrick', '456'),
(14, 'Tom', '123');
=======
(4, 'Derrick', '789'),
(5, 'user', '123'),
(6, 'Longkai', '123'),
(7, 'teo', '123'),
(8, 'dylan', '456'),
(9, 'Tom', '456');
>>>>>>> 5c1c4024f986f4e484d2afad73437f4534d91dfb

--
-- Indexes for dumped tables
--

--
-- Indexes for table `landlords`
--
ALTER TABLE `landlords`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `LandlordID` (`LandlordID`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
<<<<<<< HEAD
  ADD PRIMARY KEY (`ID`);
=======
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`);
>>>>>>> 5c1c4024f986f4e484d2afad73437f4534d91dfb

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`,`UserName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `landlords`
--
ALTER TABLE `landlords`
<<<<<<< HEAD
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
=======
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
>>>>>>> 5c1c4024f986f4e484d2afad73437f4534d91dfb

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
<<<<<<< HEAD
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
=======
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
>>>>>>> 5c1c4024f986f4e484d2afad73437f4534d91dfb

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
<<<<<<< HEAD
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
=======
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
>>>>>>> 5c1c4024f986f4e484d2afad73437f4534d91dfb

--
-- Constraints for dumped tables
--

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`LandlordID`) REFERENCES `landlords` (`ID`);
<<<<<<< HEAD
=======

--
-- Constraints for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD CONSTRAINT `testimonials_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);
>>>>>>> 5c1c4024f986f4e484d2afad73437f4534d91dfb
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

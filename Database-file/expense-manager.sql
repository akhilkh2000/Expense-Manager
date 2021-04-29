-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2021 at 06:19 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `transId` int(11) NOT NULL,
  `idUsers` tinytext NOT NULL,
  `transDate` date NOT NULL,
  `transType` char(1) NOT NULL,
  `transAmount` int(15) NOT NULL,
  `transCategory` tinytext NOT NULL,
  `transInfo` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`transId`, `idUsers`, `transDate`, `transType`, `transAmount`, `transCategory`, `transInfo`) VALUES
(1, '1', '2019-11-06', 'D', 900, 'health', 'shoes'),
(7, '10', '2019-11-15', 'C', 1200, 'income', 'scholarship'),
(9, '10', '2019-10-26', 'D', 1000, 'health', 'shoes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `uidUsers` tinytext NOT NULL,
  `emailUsers` tinytext NOT NULL,
  `pwdUsers` longtext NOT NULL,
  `budget` int(11) NOT NULL DEFAULT 0,
  `startBalance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsers`, `uidUsers`, `emailUsers`, `pwdUsers`, `budget`, `startBalance`) VALUES
(11, 'akhilkh2000', 'akhilkhubchandani@gmail.com', '$2y$10$Ya449r3OPzpiRpFRnP.uLOoq/1mHEa901.EcnUFTSJmeTgsXNbPKq', 200, 5000),
(12, 'shubham', 'shubham@gmail.com', '$2y$10$oIllPeHk46kycdHUbO8Z5OKu3DVHRG7pYHVJhZLtCrNLtuqQEyp2u', 0, 0),
(14, 'harsha', 'abc@gmail.com', '$2y$10$glNs8.H8MkqUEoq7863WBux87tHmV6lCfPTHgPED3eBdA27gsufJW', 200, 1000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`transId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `transId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2021 at 04:41 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `formialt`
--

-- --------------------------------------------------------

--
-- Table structure for table `wk`
--

CREATE TABLE `wk` (
  `kd_wk` int(11) NOT NULL,
  `kd_dpa` int(11) NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `s_uraian` varchar(255) DEFAULT NULL,
  `kd_komponen` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `kegiatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wk`
--

INSERT INTO `wk` (`kd_wk`, `kd_dpa`, `uraian`, `s_uraian`, `kd_komponen`, `qty`, `kegiatan`) VALUES
(3, 1, '', '', 1, 2, 7),
(5, 1, '', '', 24, 2, 5),
(6, 1, '', '', 22, 5, 6),
(7, 1, '', '', 6, 6, 8),
(8, 1, '', '', 10, 2, 3),
(9, 1, '', '', 36, 10, 20),
(10, 3, 'Hahaha', '', 1, 2, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wk`
--
ALTER TABLE `wk`
  ADD PRIMARY KEY (`kd_wk`),
  ADD KEY `kd_dpa` (`kd_dpa`),
  ADD KEY `kd_komponen` (`kd_komponen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wk`
--
ALTER TABLE `wk`
  MODIFY `kd_wk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wk`
--
ALTER TABLE `wk`
  ADD CONSTRAINT `wk_ibfk_2` FOREIGN KEY (`kd_komponen`) REFERENCES `komponen` (`kd_komponen`),
  ADD CONSTRAINT `wk_ibfk_3` FOREIGN KEY (`kd_dpa`) REFERENCES `dpa` (`kd_dpa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

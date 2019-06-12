-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2019 at 11:08 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dellaria`
--
CREATE DATABASE IF NOT EXISTS `dellaria` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dellaria`;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `IdBarang` int(11) NOT NULL AUTO_INCREMENT,
  `NamaBarang` varchar(255) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  PRIMARY KEY (`IdBarang`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`IdBarang`, `NamaBarang`, `Jumlah`) VALUES
(1, 'Speaker Aktif', 11),
(2, 'Kabel Listrik', 250),
(3, 'Kabel Speaker', 1000),
(4, 'Kabel Mic', 500),
(5, 'Mic Wireless', 6),
(6, 'Mic Kabel', 20),
(7, 'Speaker Pasif', 18),
(8, 'Power', 6),
(9, 'Mixer', 4),
(10, 'Stand Mic', 8),
(11, 'Tenda Standar', 1000),
(12, 'Tenda Palapon', 1000),
(13, 'Tenda Seni', 1000),
(14, 'Kursi', 1000),
(15, 'Meja', 150),
(16, 'Panggung', 8);

-- --------------------------------------------------------

--
-- Table structure for table `status_barang`
--

CREATE TABLE IF NOT EXISTS `status_barang` (
  `IdBarang` int(11) NOT NULL,
  `Baik` int(11) NOT NULL DEFAULT '0',
  `Maintenance` int(11) NOT NULL DEFAULT '0',
  `Rusak` int(11) NOT NULL DEFAULT '0',
  KEY `status_barang_ibfk_1` (`IdBarang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_barang`
--

INSERT INTO `status_barang` (`IdBarang`, `Baik`, `Maintenance`, `Rusak`) VALUES
(1, 8, 2, 1),
(2, 250, 0, 0),
(3, 1000, 0, 0),
(4, 500, 0, 0),
(5, 6, 0, 0),
(6, 20, 0, 0),
(7, 18, 0, 0),
(8, 6, 0, 0),
(9, 4, 0, 0),
(10, 8, 0, 0),
(11, 1000, 0, 0),
(12, 1000, 0, 0),
(13, 1000, 0, 0),
(14, 1000, 0, 0),
(15, 150, 0, 0),
(16, 8, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `IdUser` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Level` enum('1','2','3') NOT NULL,
  `Status` enum('0','1') NOT NULL,
  PRIMARY KEY (`IdUser`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`IdUser`, `Username`, `Password`, `Nama`, `Level`, `Status`) VALUES
(1, 'kiki', 'fd8a885d241bc651c2f6b3ff5dba310c47d24a65', 'Kiki', '3', '1'),
(2, 'aji', '7c33489720fccf682f22f2efb2cefc7aee7de177', 'Aji', '2', '1'),
(3, 'agus', '434e43a262c95c5a345542cdf327222adf18aa93', 'Agus', '1', '1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `status_barang`
--
ALTER TABLE `status_barang`
  ADD CONSTRAINT `status_barang_ibfk_1` FOREIGN KEY (`IdBarang`) REFERENCES `barang` (`IdBarang`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

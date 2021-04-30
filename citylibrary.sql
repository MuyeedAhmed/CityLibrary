-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2021 at 07:10 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `citylibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `PID` int(10) NOT NULL,
  `DOCID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`PID`, `DOCID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(2, 38),
(2, 39),
(3, 42),
(3, 43),
(6, 54),
(6, 55),
(6, 56),
(9, 49),
(9, 50),
(9, 51),
(9, 52),
(10, 30),
(10, 31),
(10, 32),
(11, 47),
(11, 48),
(13, 44),
(13, 45),
(14, 53),
(15, 53),
(16, 33),
(16, 34),
(16, 35),
(17, 36),
(17, 37),
(18, 40),
(19, 46),
(24, 41),
(25, 57),
(25, 58);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `DOCID` int(10) NOT NULL,
  `ISBN` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`DOCID`, `ISBN`) VALUES
(1, '978-3-16-1484100'),
(2, '978-3-16-1484110'),
(3, '978-3-16-1484120'),
(4, '978-3-16-1484130'),
(5, '978-3-16-1484140'),
(6, '978-3-16-1484150'),
(7, '978-3-16-1484160'),
(8, '978-3-16-1484170'),
(30, '978-3-16-1484180'),
(31, '978-3-16-1484190'),
(32, '978-3-16-1484200'),
(33, '978-3-16-1484210'),
(34, '978-3-16-1484220'),
(35, '978-3-16-1484230'),
(36, '978-3-16-1484240'),
(37, '978-3-16-1484250'),
(38, '978-3-16-1484260'),
(39, '978-3-16-1484270'),
(40, '978-3-16-1484280'),
(41, '978-3-16-1484290'),
(42, '978-3-16-1484300'),
(43, '978-3-16-1484310'),
(44, '978-3-16-1484320'),
(45, '978-3-16-1484330'),
(46, '978-3-16-1484340'),
(47, '978-3-16-1484350'),
(48, '978-3-16-1484360'),
(49, '978-3-16-1484370'),
(50, '978-3-16-1484380'),
(51, '978-3-16-1484390'),
(52, '978-3-16-1484400'),
(53, '978-3-16-1484410'),
(54, '978-3-16-1484420'),
(55, '978-3-16-1484430'),
(56, '978-3-16-1484440'),
(57, '978-3-16-1484450'),
(58, '978-3-16-1484460');

-- --------------------------------------------------------

--
-- Table structure for table `borrowing`
--

CREATE TABLE `borrowing` (
  `BOR_NO` int(10) NOT NULL,
  `BDTIME` datetime NOT NULL,
  `RDTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `borrowing`
--

INSERT INTO `borrowing` (`BOR_NO`, `BDTIME`, `RDTIME`) VALUES
(14, '2020-12-24 02:52:40', '2021-02-01 12:55:50'),
(25, '2020-12-02 02:52:40', '2021-03-29 22:43:42'),
(36, '2021-04-27 02:51:55', NULL),
(37, '2021-04-02 02:52:40', '2021-04-27 02:53:40'),
(38, '2021-04-01 02:54:04', '2021-04-24 02:54:43'),
(39, '2021-02-23 02:54:47', NULL),
(40, '2021-02-14 02:55:16', '2021-03-15 02:55:28'),
(41, '2021-02-11 03:08:44', '2021-02-27 03:29:50'),
(42, '2021-01-12 03:29:30', NULL),
(43, '2021-03-27 03:29:54', '2021-04-28 12:01:40'),
(44, '2021-02-21 03:35:32', NULL),
(45, '2021-01-27 03:35:35', NULL),
(46, '2021-02-24 03:35:41', NULL),
(47, '2021-04-27 03:35:57', NULL),
(48, '2021-04-27 02:32:30', NULL),
(49, '2021-04-27 02:35:35', NULL),
(50, '2021-03-27 03:35:28', NULL),
(51, '2021-04-27 03:35:42', NULL),
(52, '2021-04-27 03:36:04', NULL),
(53, '2021-04-04 03:58:59', '2021-04-27 03:58:12'),
(54, '2021-04-05 13:47:14', '2021-04-27 11:12:14'),
(55, '2021-04-04 14:45:12', '2021-04-29 19:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

CREATE TABLE `borrows` (
  `BOR_NO` int(10) NOT NULL,
  `DOCID` int(10) NOT NULL,
  `COPYNO` int(10) NOT NULL,
  `BID` int(10) NOT NULL,
  `RID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `borrows`
--

INSERT INTO `borrows` (`BOR_NO`, `DOCID`, `COPYNO`, `BID`, `RID`) VALUES
(25, 46, 3, 1, 2),
(25, 44, 1, 1, 2),
(25, 43, 1, 1, 2),
(25, 34, 3, 1, 2),
(14, 32, 1, 1, 8),
(14, 15, 1, 1, 8),
(14, 49, 2, 1, 8),
(54, 32, 1, 2, 8),
(54, 15, 1, 3, 8),
(54, 49, 2, 2, 8),
(54, 31, 1, 2, 8),
(54, 32, 1, 3, 8),
(54, 33, 1, 3, 8),
(55, 46, 3, 2, 2),
(55, 44, 1, 2, 2),
(55, 43, 1, 2, 2),
(55, 34, 3, 2, 2),
(50, 2, 1, 2, 1),
(50, 6, 1, 1, 1),
(50, 6, 3, 3, 1),
(50, 7, 3, 1, 1),
(50, 8, 1, 1, 1),
(50, 31, 1, 1, 1),
(50, 48, 1, 1, 1),
(53, 8, 2, 3, 1),
(53, 14, 2, 3, 1),
(53, 49, 1, 3, 1),
(36, 1, 1, 1, 3),
(36, 1, 2, 1, 3),
(36, 2, 1, 1, 3),
(36, 6, 1, 1, 3),
(36, 6, 2, 1, 3),
(36, 6, 3, 1, 3),
(36, 7, 1, 1, 3),
(36, 7, 2, 1, 3),
(36, 9, 1, 1, 3),
(37, 10, 1, 1, 3),
(37, 10, 3, 1, 3),
(38, 10, 1, 1, 3),
(38, 11, 1, 1, 3),
(40, 10, 1, 1, 3),
(41, 14, 1, 1, 3),
(43, 1, 1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `BID` int(10) NOT NULL,
  `LNAME` varchar(100) NOT NULL,
  `LOCATION` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`BID`, `LNAME`, `LOCATION`) VALUES
(1, 'Kearny Public Library', 'Kearny, New Jersey'),
(2, 'Harrison Public Library', 'Harrison, Jew Jersey'),
(3, 'New York Public Library', 'New York, New York');

-- --------------------------------------------------------

--
-- Table structure for table `chairs`
--

CREATE TABLE `chairs` (
  `PID` int(10) NOT NULL,
  `DOCID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chairs`
--

INSERT INTO `chairs` (`PID`, `DOCID`) VALUES
(4, 9),
(5, 12),
(5, 14),
(7, 16),
(8, 15),
(12, 17),
(14, 11),
(16, 19),
(17, 10),
(19, 13),
(24, 18);

-- --------------------------------------------------------

--
-- Table structure for table `copy`
--

CREATE TABLE `copy` (
  `DOCID` int(10) NOT NULL,
  `COPYNO` int(10) NOT NULL,
  `BID` int(10) NOT NULL,
  `POSITION` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `copy`
--

INSERT INTO `copy` (`DOCID`, `COPYNO`, `BID`, `POSITION`) VALUES
(1, 1, 1, '2F100'),
(1, 1, 2, '3F421'),
(1, 2, 1, '3F400'),
(2, 1, 1, '3F105'),
(2, 1, 2, '3F278'),
(3, 1, 2, '2F123'),
(4, 1, 2, '2F468'),
(5, 1, 2, '3F021'),
(6, 1, 1, '1F245'),
(6, 1, 2, '2F345'),
(6, 1, 3, '3F456'),
(6, 2, 1, '1F246'),
(6, 2, 2, '2F346'),
(6, 2, 3, '3F457'),
(6, 3, 1, '1F247'),
(6, 3, 2, '2F347'),
(6, 3, 3, '3F458'),
(7, 1, 1, '1F248'),
(7, 1, 2, '2F348'),
(7, 1, 3, '3F459'),
(7, 2, 1, '1F249'),
(7, 2, 2, '2F349'),
(7, 2, 3, '3F460'),
(7, 3, 1, '1F250'),
(7, 3, 2, '2F350'),
(7, 3, 3, '3F461'),
(8, 1, 1, '1F249'),
(8, 1, 2, '2F349'),
(8, 1, 3, '3F460'),
(8, 2, 1, '1F250'),
(8, 2, 2, '2F350'),
(8, 2, 3, '3F461'),
(8, 3, 1, '1F251'),
(8, 3, 2, '2F351'),
(8, 3, 3, '3F462'),
(9, 1, 1, '1F249'),
(9, 1, 2, '2F349'),
(9, 1, 3, '3F460'),
(9, 2, 1, '1F250'),
(9, 2, 2, '2F350'),
(9, 2, 3, '3F461'),
(9, 3, 1, '1F251'),
(9, 3, 2, '2F351'),
(9, 3, 3, '3F462'),
(10, 1, 1, '1F249'),
(10, 1, 2, '2F349'),
(10, 1, 3, '3F460'),
(10, 2, 1, '1F250'),
(10, 2, 2, '2F350'),
(10, 2, 3, '3F461'),
(10, 3, 1, '1F251'),
(10, 3, 2, '2F351'),
(10, 3, 3, '3F462'),
(11, 1, 1, '1F249'),
(11, 1, 2, '2F349'),
(11, 1, 3, '3F460'),
(11, 2, 1, '1F250'),
(11, 2, 2, '2F350'),
(11, 2, 3, '3F461'),
(11, 3, 1, '1F251'),
(11, 3, 2, '2F351'),
(11, 3, 3, '3F462'),
(12, 1, 1, '1F249'),
(12, 1, 2, '2F349'),
(12, 1, 3, '3F460'),
(12, 2, 1, '1F250'),
(12, 2, 2, '2F350'),
(12, 2, 3, '3F461'),
(12, 3, 1, '1F251'),
(12, 3, 2, '2F351'),
(12, 3, 3, '3F462'),
(13, 1, 1, '1F249'),
(13, 1, 2, '2F349'),
(13, 1, 3, '3F460'),
(13, 2, 1, '1F250'),
(13, 2, 2, '2F350'),
(13, 2, 3, '3F461'),
(13, 3, 1, '1F251'),
(13, 3, 2, '2F351'),
(13, 3, 3, '3F462'),
(14, 1, 1, '1F249'),
(14, 1, 2, '2F349'),
(14, 1, 3, '3F460'),
(14, 2, 1, '1F250'),
(14, 2, 2, '2F350'),
(14, 2, 3, '3F461'),
(14, 3, 1, '1F251'),
(14, 3, 2, '2F351'),
(14, 3, 3, '3F462'),
(15, 1, 1, '1F249'),
(15, 1, 2, '2F349'),
(15, 1, 3, '3F460'),
(15, 2, 1, '1F250'),
(15, 2, 2, '2F350'),
(15, 2, 3, '3F461'),
(15, 3, 1, '1F251'),
(15, 3, 2, '2F351'),
(15, 3, 3, '3F462'),
(16, 1, 1, '1F249'),
(16, 1, 2, '2F349'),
(16, 1, 3, '3F460'),
(16, 2, 1, '1F250'),
(16, 2, 2, '2F350'),
(16, 2, 3, '3F461'),
(16, 3, 1, '1F251'),
(16, 3, 2, '2F351'),
(16, 3, 3, '3F462'),
(17, 1, 1, '1F249'),
(17, 1, 2, '2F349'),
(17, 1, 3, '3F460'),
(17, 2, 1, '1F250'),
(17, 2, 2, '2F350'),
(17, 2, 3, '3F461'),
(17, 3, 1, '1F251'),
(17, 3, 2, '2F351'),
(17, 3, 3, '3F462'),
(18, 1, 1, '1F249'),
(18, 1, 2, '2F349'),
(18, 1, 3, '3F460'),
(18, 2, 1, '1F250'),
(18, 2, 2, '2F350'),
(18, 2, 3, '3F461'),
(18, 3, 1, '1F251'),
(18, 3, 2, '2F351'),
(18, 3, 3, '3F462'),
(19, 1, 1, '1F249'),
(19, 1, 2, '2F349'),
(19, 1, 3, '3F460'),
(19, 2, 1, '1F250'),
(19, 2, 2, '2F350'),
(19, 2, 3, '3F461'),
(19, 3, 1, '1F251'),
(19, 3, 2, '2F351'),
(19, 3, 3, '3F462'),
(20, 1, 1, '1F249'),
(20, 1, 2, '2F349'),
(20, 1, 3, '3F460'),
(20, 2, 1, '1F250'),
(20, 2, 2, '2F350'),
(20, 2, 3, '3F461'),
(20, 3, 1, '1F251'),
(20, 3, 2, '2F351'),
(20, 3, 3, '3F462'),
(21, 1, 1, '1F249'),
(21, 1, 2, '2F349'),
(21, 1, 3, '3F460'),
(21, 2, 1, '1F250'),
(21, 2, 2, '2F350'),
(21, 2, 3, '3F461'),
(21, 3, 1, '1F251'),
(21, 3, 2, '2F351'),
(21, 3, 3, '3F462'),
(22, 1, 1, '1F249'),
(22, 1, 2, '2F349'),
(22, 1, 3, '3F460'),
(22, 2, 1, '1F250'),
(22, 2, 2, '2F350'),
(22, 2, 3, '3F461'),
(22, 3, 1, '1F251'),
(22, 3, 2, '2F351'),
(22, 3, 3, '3F462'),
(23, 1, 1, '1F249'),
(23, 1, 2, '2F349'),
(23, 1, 3, '3F460'),
(23, 2, 1, '1F250'),
(23, 2, 2, '2F350'),
(23, 2, 3, '3F461'),
(23, 3, 1, '1F251'),
(23, 3, 2, '2F351'),
(23, 3, 3, '3F462'),
(24, 1, 1, '1F249'),
(24, 1, 2, '2F349'),
(24, 1, 3, '3F460'),
(24, 2, 1, '1F250'),
(24, 2, 2, '2F350'),
(24, 2, 3, '3F461'),
(24, 3, 1, '1F251'),
(24, 3, 2, '2F351'),
(24, 3, 3, '3F462'),
(25, 1, 1, '1F249'),
(25, 1, 2, '2F349'),
(25, 1, 3, '3F460'),
(25, 2, 1, '1F250'),
(25, 2, 2, '2F350'),
(25, 2, 3, '3F461'),
(25, 3, 1, '1F251'),
(25, 3, 2, '2F351'),
(25, 3, 3, '3F462'),
(26, 1, 1, '1F249'),
(26, 1, 2, '2F349'),
(26, 1, 3, '3F460'),
(26, 2, 1, '1F250'),
(26, 2, 2, '2F350'),
(26, 2, 3, '3F461'),
(26, 3, 1, '1F251'),
(26, 3, 2, '2F351'),
(26, 3, 3, '3F462'),
(27, 1, 1, '1F249'),
(27, 1, 2, '2F349'),
(27, 1, 3, '3F460'),
(27, 2, 1, '1F250'),
(27, 2, 2, '2F350'),
(27, 2, 3, '3F461'),
(27, 3, 1, '1F251'),
(27, 3, 2, '2F351'),
(27, 3, 3, '3F462'),
(28, 1, 1, '1F249'),
(28, 1, 2, '2F349'),
(28, 1, 3, '3F460'),
(28, 2, 1, '1F250'),
(28, 2, 2, '2F350'),
(28, 2, 3, '3F461'),
(28, 3, 1, '1F251'),
(28, 3, 2, '2F351'),
(28, 3, 3, '3F462'),
(29, 1, 1, '1F249'),
(29, 1, 2, '2F349'),
(29, 1, 3, '3F460'),
(29, 2, 1, '1F250'),
(29, 2, 2, '2F350'),
(29, 2, 3, '3F461'),
(29, 3, 1, '1F251'),
(29, 3, 2, '2F351'),
(29, 3, 3, '3F462'),
(30, 1, 1, '1F249'),
(30, 1, 2, '2F349'),
(30, 1, 3, '3F460'),
(30, 2, 1, '1F250'),
(30, 2, 2, '2F350'),
(30, 2, 3, '3F461'),
(30, 3, 1, '1F251'),
(30, 3, 2, '2F351'),
(30, 3, 3, '3F462'),
(31, 1, 1, '1F249'),
(31, 1, 2, '2F349'),
(31, 1, 3, '3F460'),
(31, 2, 1, '1F250'),
(31, 2, 2, '2F350'),
(31, 2, 3, '3F461'),
(31, 3, 1, '1F251'),
(31, 3, 2, '2F351'),
(31, 3, 3, '3F462'),
(32, 1, 1, '1F249'),
(32, 1, 2, '2F349'),
(32, 1, 3, '3F460'),
(32, 2, 1, '1F250'),
(32, 2, 2, '2F350'),
(32, 2, 3, '3F461'),
(32, 3, 1, '1F251'),
(32, 3, 2, '2F351'),
(32, 3, 3, '3F462'),
(33, 1, 1, '1F249'),
(33, 1, 2, '2F349'),
(33, 1, 3, '3F460'),
(33, 2, 1, '1F250'),
(33, 2, 2, '2F350'),
(33, 2, 3, '3F461'),
(33, 3, 1, '1F251'),
(33, 3, 2, '2F351'),
(33, 3, 3, '3F462'),
(34, 1, 1, '1F249'),
(34, 1, 2, '2F349'),
(34, 1, 3, '3F460'),
(34, 2, 1, '1F250'),
(34, 2, 2, '2F350'),
(34, 2, 3, '3F461'),
(34, 3, 1, '1F251'),
(34, 3, 2, '2F351'),
(34, 3, 3, '3F462'),
(35, 1, 1, '1F249'),
(35, 1, 2, '2F349'),
(35, 1, 3, '3F460'),
(35, 2, 1, '1F250'),
(35, 2, 2, '2F350'),
(35, 2, 3, '3F461'),
(35, 3, 1, '1F251'),
(35, 3, 2, '2F351'),
(35, 3, 3, '3F462'),
(36, 1, 1, '1F249'),
(36, 1, 2, '2F349'),
(36, 1, 3, '3F460'),
(36, 2, 1, '1F250'),
(36, 2, 2, '2F350'),
(36, 2, 3, '3F461'),
(36, 3, 1, '1F251'),
(36, 3, 2, '2F351'),
(36, 3, 3, '3F462'),
(37, 1, 1, '1F249'),
(37, 1, 2, '2F349'),
(37, 1, 3, '3F460'),
(37, 2, 1, '1F250'),
(37, 2, 2, '2F350'),
(37, 2, 3, '3F461'),
(37, 3, 1, '1F251'),
(37, 3, 2, '2F351'),
(37, 3, 3, '3F462'),
(38, 1, 1, '1F249'),
(38, 1, 2, '2F349'),
(38, 1, 3, '3F460'),
(38, 2, 1, '1F250'),
(38, 2, 2, '2F350'),
(38, 2, 3, '3F461'),
(38, 3, 1, '1F251'),
(38, 3, 2, '2F351'),
(38, 3, 3, '3F462'),
(39, 1, 1, '1F249'),
(39, 1, 2, '2F349'),
(39, 1, 3, '3F460'),
(39, 2, 1, '1F250'),
(39, 2, 2, '2F350'),
(39, 2, 3, '3F461'),
(39, 3, 1, '1F251'),
(39, 3, 2, '2F351'),
(39, 3, 3, '3F462'),
(40, 1, 1, '1F249'),
(40, 1, 2, '2F349'),
(40, 1, 3, '3F460'),
(40, 2, 1, '1F250'),
(40, 2, 2, '2F350'),
(40, 2, 3, '3F461'),
(40, 3, 1, '1F251'),
(40, 3, 2, '2F351'),
(40, 3, 3, '3F462'),
(41, 1, 1, '1F249'),
(41, 1, 2, '2F349'),
(41, 1, 3, '3F460'),
(41, 2, 1, '1F250'),
(41, 2, 2, '2F350'),
(41, 2, 3, '3F461'),
(41, 3, 1, '1F251'),
(41, 3, 2, '2F351'),
(41, 3, 3, '3F462'),
(42, 1, 1, '1F249'),
(42, 1, 2, '2F349'),
(42, 1, 3, '3F460'),
(42, 2, 1, '1F250'),
(42, 2, 2, '2F350'),
(42, 2, 3, '3F461'),
(42, 3, 1, '1F251'),
(42, 3, 2, '2F351'),
(42, 3, 3, '3F462'),
(43, 1, 1, '1F249'),
(43, 1, 2, '2F349'),
(43, 1, 3, '3F460'),
(43, 2, 1, '1F250'),
(43, 2, 2, '2F350'),
(43, 2, 3, '3F461'),
(43, 3, 1, '1F251'),
(43, 3, 2, '2F351'),
(43, 3, 3, '3F462'),
(44, 1, 1, '1F249'),
(44, 1, 2, '2F349'),
(44, 1, 3, '3F460'),
(44, 2, 1, '1F250'),
(44, 2, 2, '2F350'),
(44, 2, 3, '3F461'),
(44, 3, 1, '1F251'),
(44, 3, 2, '2F351'),
(44, 3, 3, '3F462'),
(45, 1, 1, '1F249'),
(45, 1, 2, '2F349'),
(45, 1, 3, '3F460'),
(45, 2, 1, '1F250'),
(45, 2, 2, '2F350'),
(45, 2, 3, '3F461'),
(45, 3, 1, '1F251'),
(45, 3, 2, '2F351'),
(45, 3, 3, '3F462'),
(46, 1, 1, '1F249'),
(46, 1, 2, '2F349'),
(46, 1, 3, '3F460'),
(46, 2, 1, '1F250'),
(46, 2, 2, '2F350'),
(46, 2, 3, '3F461'),
(46, 3, 1, '1F251'),
(46, 3, 2, '2F351'),
(46, 3, 3, '3F462'),
(47, 1, 1, '1F249'),
(47, 1, 2, '2F349'),
(47, 1, 3, '3F460'),
(47, 2, 1, '1F250'),
(47, 2, 2, '2F350'),
(47, 2, 3, '3F461'),
(47, 3, 1, '1F251'),
(47, 3, 2, '2F351'),
(47, 3, 3, '3F462'),
(48, 1, 1, '1F249'),
(48, 1, 2, '2F349'),
(48, 1, 3, '3F460'),
(48, 2, 1, '1F250'),
(48, 2, 2, '2F350'),
(48, 2, 3, '3F461'),
(48, 3, 1, '1F251'),
(48, 3, 2, '2F351'),
(48, 3, 3, '3F462'),
(49, 1, 1, '1F249'),
(49, 1, 2, '2F349'),
(49, 1, 3, '3F460'),
(49, 2, 1, '1F250'),
(49, 2, 2, '2F350'),
(49, 2, 3, '3F461'),
(49, 3, 1, '1F251'),
(49, 3, 2, '2F351'),
(49, 3, 3, '3F462'),
(50, 1, 1, '1F249'),
(50, 1, 2, '2F349'),
(50, 1, 3, '3F460'),
(50, 2, 1, '1F250'),
(50, 2, 2, '2F350'),
(50, 2, 3, '3F461'),
(50, 3, 1, '1F251'),
(50, 3, 2, '2F351'),
(50, 3, 3, '3F462'),
(51, 1, 1, '1F249'),
(51, 1, 2, '2F349'),
(51, 1, 3, '3F460'),
(51, 2, 1, '1F250'),
(51, 2, 2, '2F350'),
(51, 2, 3, '3F461'),
(51, 3, 1, '1F251'),
(51, 3, 2, '2F351'),
(51, 3, 3, '3F462'),
(52, 1, 1, '1F249'),
(52, 1, 2, '2F349'),
(52, 1, 3, '3F460'),
(52, 2, 1, '1F250'),
(52, 2, 2, '2F350'),
(52, 2, 3, '3F461'),
(52, 3, 1, '1F251'),
(52, 3, 2, '2F351'),
(52, 3, 3, '3F462'),
(53, 1, 1, '1F249'),
(53, 1, 2, '2F349'),
(53, 1, 3, '3F460'),
(53, 2, 1, '1F250'),
(53, 2, 2, '2F350'),
(53, 2, 3, '3F461'),
(53, 3, 1, '1F251'),
(53, 3, 2, '2F351'),
(53, 3, 3, '3F462'),
(54, 1, 1, '1F249'),
(54, 1, 2, '2F349'),
(54, 1, 3, '3F460'),
(54, 2, 1, '1F250'),
(54, 2, 2, '2F350'),
(54, 2, 3, '3F461'),
(54, 3, 1, '1F251'),
(54, 3, 2, '2F351'),
(54, 3, 3, '3F462'),
(55, 1, 1, '1F249'),
(55, 1, 2, '2F349'),
(55, 1, 3, '3F460'),
(55, 2, 1, '1F250'),
(55, 2, 2, '2F350'),
(55, 2, 3, '3F461'),
(55, 3, 1, '1F251'),
(55, 3, 2, '2F351'),
(55, 3, 3, '3F462'),
(56, 1, 1, '1F249'),
(56, 1, 2, '2F349'),
(56, 1, 3, '3F460'),
(56, 2, 1, '1F250'),
(56, 2, 2, '2F350'),
(56, 2, 3, '3F461'),
(56, 3, 1, '1F251'),
(56, 3, 2, '2F351'),
(56, 3, 3, '3F462'),
(57, 1, 1, '1F249'),
(57, 1, 2, '2F349'),
(57, 1, 3, '3F460'),
(57, 2, 1, '1F250'),
(57, 2, 2, '2F350'),
(57, 2, 3, '3F461'),
(57, 3, 1, '1F251'),
(57, 3, 2, '2F351'),
(57, 3, 3, '3F462'),
(58, 1, 1, '1F249'),
(58, 1, 2, '2F349'),
(58, 1, 3, '3F460'),
(58, 2, 1, '1F250'),
(58, 2, 2, '2F350'),
(58, 2, 3, '3F461'),
(58, 3, 1, '1F251'),
(58, 3, 2, '2F351'),
(58, 3, 3, '3F462');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `DOCID` int(10) NOT NULL,
  `TITLE` varchar(100) NOT NULL,
  `PDATE` varchar(9) NOT NULL,
  `PUBLISHERID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`DOCID`, `TITLE`, `PDATE`, `PUBLISHERID`) VALUES
(1, 'Harry Potter 1', '26-Jun-97', 1),
(2, 'Harry Potter 2', '2-Jul-98', 1),
(3, 'Harry Potter 3', '8-Jul-99', 1),
(4, 'Harry Potter 4', '8-Jul-00', 1),
(5, 'Harry Potter 5', '21-Jun-03', 1),
(6, 'Harry Potter 6', '16-Jul-05', 1),
(7, 'Harry Potter 7', '21-Jul-07', 1),
(8, 'Cursed Child', '31-Jul-16', 1),
(9, 'Proceedings of AI', '26-Jan-10', 6),
(10, 'Proceedings of Linguistics', '2-Feb-13', 6),
(11, 'Proceedings of NLP', '8-Mar-14', 7),
(12, 'Proceedings of ML', '8-Jul-08', 9),
(13, 'Proceedings of DL', '21-Jun-19', 8),
(14, 'Proceedings of Algorithm', '16-Aug-06', 6),
(15, 'Proceedings of Complexity', '21-Jul-09', 7),
(16, 'Proceedings of Cloud Computing', '30-Nov-18', 9),
(17, 'Proceedings of HCI', '26-Dec-18', 8),
(18, 'Proceedings of Database', '2-Jul-98', 6),
(19, 'Proceedings of Datamining', '8-Jul-99', 7),
(20, 'Deep Learning Journal', '8-Jul-20', 9),
(21, 'Security Journal', '26-Jan-10', 8),
(22, 'Database Journal', '2-Feb-13', 6),
(23, 'NLP Journal', '8-Mar-14', 7),
(24, 'Machine Learning Journal', '8-Jul-08', 9),
(25, 'Biomedical Journal', '21-Jun-19', 8),
(26, 'Mechanical Engineering Journal', '16-Aug-05', 6),
(27, 'Journal of HCI', '21-Jul-09', 7),
(28, 'Journal of Datamining', '30-Nov-17', 9),
(29, 'Deep into Cryptography-Journal', '26-Dec-18', 8),
(30, 'Inferno', '16-Jul-05', 2),
(31, 'The Da Vinci Code', '21-Jul-07', 3),
(32, 'Angels & Demons', '31-Jul-16', 5),
(33, 'Himu', '26-Jun-97', 10),
(34, 'Misir Ali', '2-Jul-98', 10),
(35, 'Kothao Keu Nei', '8-Jul-99', 10),
(36, 'Gitanjali', '8-Jul-00', 10),
(37, 'Kabuliwala', '21-Jun-03', 10),
(38, 'If tomorrow Comes', '16-Jul-05', 5),
(39, 'Bloodline', '21-Jul-07', 4),
(40, 'Sapiens', '31-Jul-16', 4),
(41, 'Tukunjil', '26-Jun-97', 10),
(42, 'Pride and Prejudice', '2-Jul-98', 2),
(43, 'Lady Susan', '8-Jul-99', 3),
(44, 'Recursion', '8-Jul-00', 5),
(45, 'Dark Matter', '21-Jun-03', 4),
(46, 'The Theory of Everything', '16-Jul-05', 4),
(47, 'Sherlock Holmes I', '21-Jul-07', 5),
(48, 'Sherlock Holmes II', '31-Jul-16', 2),
(49, 'Hamlet', '26-Jun-97', 3),
(50, 'Romeo & Juliet', '2-Jul-98', 5),
(51, 'Julius Caesar', '8-Jul-99', 4),
(52, 'Othelo', '8-Jul-00', 4),
(53, 'Statistical NLP', '21-Jun-03', 5),
(54, 'A Tale of Two Cities', '16-Jul-05', 5),
(55, 'Oliver Twist', '21-Jul-07', 2),
(56, 'David Copperfield', '31-Jul-16', 3),
(57, 'The Sun Also Rises', '26-Jun-97', 5),
(58, 'A Farewell to Arms', '2-Jul-98', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gedits`
--

CREATE TABLE `gedits` (
  `DOCID` int(10) NOT NULL,
  `ISSUE_NO` int(10) NOT NULL,
  `PID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gedits`
--

INSERT INTO `gedits` (`DOCID`, `ISSUE_NO`, `PID`) VALUES
(20, 1, 8),
(20, 2, 12),
(21, 1, 4),
(21, 2, 5),
(22, 1, 14),
(22, 2, 15),
(23, 1, 5),
(24, 1, 4),
(24, 2, 19),
(25, 1, 7),
(25, 2, 7),
(26, 1, 8),
(26, 2, 12),
(26, 3, 21),
(27, 1, 16),
(27, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `journal_issue`
--

CREATE TABLE `journal_issue` (
  `DOCID` int(10) NOT NULL,
  `ISSUE_NO` int(10) NOT NULL,
  `SCOPE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `journal_issue`
--

INSERT INTO `journal_issue` (`DOCID`, `ISSUE_NO`, `SCOPE`) VALUES
(20, 1, 'A'),
(20, 2, 'B'),
(21, 1, 'C'),
(21, 2, 'D'),
(22, 1, 'A'),
(22, 2, 'B'),
(23, 1, 'C'),
(24, 1, 'D'),
(24, 2, 'A'),
(25, 1, 'B'),
(25, 2, 'C'),
(26, 1, 'D'),
(26, 2, 'A'),
(26, 3, 'B'),
(27, 1, 'C'),
(27, 2, 'D');

-- --------------------------------------------------------

--
-- Table structure for table `journal_volume`
--

CREATE TABLE `journal_volume` (
  `DOCID` int(10) NOT NULL,
  `VOLUME_NO` int(10) NOT NULL,
  `EDITOR` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `journal_volume`
--

INSERT INTO `journal_volume` (`DOCID`, `VOLUME_NO`, `EDITOR`) VALUES
(20, 1, 4),
(21, 2, 7),
(22, 3, 5),
(23, 1, 14),
(24, 2, 12),
(25, 1, 8),
(26, 1, 4),
(27, 2, 5),
(28, 1, 24),
(29, 2, 19);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `PID` int(2) NOT NULL,
  `PNAME` varchar(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`PID`, `PNAME`) VALUES
(1, 'J K Rowling'),
(2, 'Sidney Sheldon'),
(3, 'Jane Austen'),
(4, 'William Blake'),
(5, 'Geoffrey Chaucer'),
(6, 'Charles Dickens'),
(7, 'John Donne'),
(8, 'George Elliot'),
(9, 'William Shakespeare'),
(10, 'Dan Brown'),
(11, 'Arthur Conan Doyle'),
(12, 'Nora Roberts'),
(13, 'Blake Crouch'),
(14, 'Christopher Manning'),
(15, 'Dan Jurafsky'),
(16, 'Humayun Ahmed'),
(17, 'Rabindranath Tagore'),
(18, 'Yuval Noah Harari'),
(19, 'Stephen Hawking'),
(20, 'Mark Manson'),
(21, 'Stan Lee'),
(22, 'Christopher Nolan'),
(23, 'Sharatchandra'),
(24, 'Jafar Iqbal'),
(25, 'Ernest Hemingway');

-- --------------------------------------------------------

--
-- Table structure for table `proceedings`
--

CREATE TABLE `proceedings` (
  `DOCID` int(10) NOT NULL,
  `CDATE` varchar(9) NOT NULL,
  `CLOCATION` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `proceedings`
--

INSERT INTO `proceedings` (`DOCID`, `CDATE`, `CLOCATION`) VALUES
(9, '26-Jan-10', 'Athens Greece'),
(10, '2-Feb-13', 'NY USA'),
(11, '8-Mar-14', 'CT USA'),
(12, '8-Jul-08', 'London UK'),
(13, '21-Jun-19', 'Berlin Germany'),
(14, '16-Aug-06', 'Torronto Canada'),
(15, '21-Jul-09', 'Amsterdam Netherlands'),
(16, '30-Oct-18', 'Geneva Switzerland'),
(17, '26-Dec-18', 'Kolkata India'),
(18, '2-Jul-98', 'Cape Towns SA'),
(19, '8-Jul-99', 'Dhaka Bangladesh');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `PUBLISHERID` int(10) NOT NULL,
  `PUBNAME` varchar(100) NOT NULL,
  `ADDRESS` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`PUBLISHERID`, `PUBNAME`, `ADDRESS`) VALUES
(1, 'Scholastic Corporation', 'NY USA'),
(2, 'Simon & Schuster', 'CT USA'),
(3, 'Penguin Random House', 'London UK'),
(4, 'Hachette Book Group', 'Berlin Germany'),
(5, 'HarperCollins', 'Torronto Canada'),
(6, 'IEEE', 'Amsterdam Netherlands'),
(7, 'SIAM', 'Geneva Switzerland'),
(8, 'Springer', 'Kolkata India'),
(9, 'ACM', 'Cape Towns SA'),
(10, 'Ononna', 'Dhaka Bangladesh');

-- --------------------------------------------------------

--
-- Table structure for table `reader`
--

CREATE TABLE `reader` (
  `RID` int(10) NOT NULL,
  `RTYPE` varchar(30) NOT NULL,
  `RNAME` varchar(50) NOT NULL,
  `RADDRESS` varchar(100) NOT NULL,
  `PHONE_NO` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reader`
--

INSERT INTO `reader` (`RID`, `RTYPE`, `RNAME`, `RADDRESS`, `PHONE_NO`) VALUES
(1, 'Student', 'Muyeed Ahmed', '328 Central Ave, Harrison', 9734894545),
(2, 'Student', 'Muntasir Rahman', '328 Central Ave, Harrison', 9874531234),
(3, 'Senior Citizen', 'Rifath Rafi', '328 Central Ave, Harrison', 9786313544),
(4, 'Senior Citizen', 'Niladri Talukdar', '263 Cstreet, Kearny', 1323543214),
(5, 'Senior Citizen', 'Bilas Talukdar', '263 Cstreet, Kearny', 4512344576),
(6, 'Student', 'Pritam Sen', '263 Cstreet, Kearny', 4154724579),
(7, 'Student', 'Jeremy Luo', '329 Hue Street, Newark', 4512548796),
(8, 'Staff', 'John Doe', '78 Random Street, Edison', 5432154879),
(9, 'Regular', 'Jeorem Sanchez', '254 Rutland Ave, Orange', 5248731597),
(10, 'Regular', 'Hugo Boss', '75 Orange Street, West Orange', 4213645876),
(11, 'Student', 'Tejasvi', '12 Harrison Ave, Harrison', 987998399);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `RES_NO` int(10) NOT NULL,
  `DTIME` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`RES_NO`, `DTIME`) VALUES
(44, '2021-04-30 03:57:54');

-- --------------------------------------------------------

--
-- Table structure for table `reserves`
--

CREATE TABLE `reserves` (
  `RID` int(10) NOT NULL,
  `RESERVATION_NO` int(10) NOT NULL,
  `DOCID` int(10) NOT NULL,
  `COPYNO` int(10) NOT NULL,
  `BID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reserves`
--

INSERT INTO `reserves` (`RID`, `RESERVATION_NO`, `DOCID`, `COPYNO`, `BID`) VALUES
(1, 44, 56, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`PID`,`DOCID`),
  ADD KEY `author_ibfk_2` (`DOCID`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`DOCID`);

--
-- Indexes for table `borrowing`
--
ALTER TABLE `borrowing`
  ADD PRIMARY KEY (`BOR_NO`);

--
-- Indexes for table `borrows`
--
ALTER TABLE `borrows`
  ADD PRIMARY KEY (`BOR_NO`,`DOCID`,`COPYNO`,`BID`),
  ADD KEY `DOCID` (`DOCID`,`COPYNO`,`BID`),
  ADD KEY `RID` (`RID`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`BID`);

--
-- Indexes for table `chairs`
--
ALTER TABLE `chairs`
  ADD PRIMARY KEY (`PID`,`DOCID`),
  ADD KEY `DOCID` (`DOCID`);

--
-- Indexes for table `copy`
--
ALTER TABLE `copy`
  ADD PRIMARY KEY (`DOCID`,`COPYNO`,`BID`),
  ADD KEY `BID` (`BID`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`DOCID`),
  ADD KEY `PUBLISHERID` (`PUBLISHERID`);

--
-- Indexes for table `gedits`
--
ALTER TABLE `gedits`
  ADD PRIMARY KEY (`DOCID`,`ISSUE_NO`,`PID`),
  ADD KEY `PID` (`PID`);

--
-- Indexes for table `journal_issue`
--
ALTER TABLE `journal_issue`
  ADD PRIMARY KEY (`DOCID`,`ISSUE_NO`);

--
-- Indexes for table `journal_volume`
--
ALTER TABLE `journal_volume`
  ADD PRIMARY KEY (`DOCID`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `proceedings`
--
ALTER TABLE `proceedings`
  ADD PRIMARY KEY (`DOCID`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`PUBLISHERID`);

--
-- Indexes for table `reader`
--
ALTER TABLE `reader`
  ADD PRIMARY KEY (`RID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`RES_NO`);

--
-- Indexes for table `reserves`
--
ALTER TABLE `reserves`
  ADD PRIMARY KEY (`RESERVATION_NO`,`DOCID`,`COPYNO`,`BID`),
  ADD KEY `DOCID` (`DOCID`,`COPYNO`,`BID`),
  ADD KEY `RID` (`RID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowing`
--
ALTER TABLE `borrowing`
  MODIFY `BOR_NO` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `BID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `DOCID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `PID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `PUBLISHERID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `reader`
--
ALTER TABLE `reader`
  MODIFY `RID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `RES_NO` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `author_ibfk_1` FOREIGN KEY (`PID`) REFERENCES `person` (`PID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `author_ibfk_2` FOREIGN KEY (`DOCID`) REFERENCES `book` (`DOCID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`DOCID`) REFERENCES `document` (`DOCID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `borrows`
--
ALTER TABLE `borrows`
  ADD CONSTRAINT `borrows_ibfk_1` FOREIGN KEY (`BOR_NO`) REFERENCES `borrowing` (`BOR_NO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `borrows_ibfk_2` FOREIGN KEY (`DOCID`,`COPYNO`,`BID`) REFERENCES `copy` (`DOCID`, `COPYNO`, `BID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `borrows_ibfk_3` FOREIGN KEY (`RID`) REFERENCES `reader` (`RID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chairs`
--
ALTER TABLE `chairs`
  ADD CONSTRAINT `chairs_ibfk_1` FOREIGN KEY (`DOCID`) REFERENCES `proceedings` (`DOCID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chairs_ibfk_2` FOREIGN KEY (`PID`) REFERENCES `person` (`PID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `copy`
--
ALTER TABLE `copy`
  ADD CONSTRAINT `copy_ibfk_1` FOREIGN KEY (`DOCID`) REFERENCES `document` (`DOCID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `copy_ibfk_2` FOREIGN KEY (`BID`) REFERENCES `branch` (`BID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_ibfk_1` FOREIGN KEY (`PUBLISHERID`) REFERENCES `publisher` (`PUBLISHERID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gedits`
--
ALTER TABLE `gedits`
  ADD CONSTRAINT `gedits_ibfk_1` FOREIGN KEY (`DOCID`,`ISSUE_NO`) REFERENCES `journal_issue` (`DOCID`, `ISSUE_NO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gedits_ibfk_2` FOREIGN KEY (`PID`) REFERENCES `person` (`PID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `journal_issue`
--
ALTER TABLE `journal_issue`
  ADD CONSTRAINT `journal_issue_ibfk_1` FOREIGN KEY (`DOCID`) REFERENCES `journal_volume` (`DOCID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `journal_volume`
--
ALTER TABLE `journal_volume`
  ADD CONSTRAINT `journal_volume_ibfk_1` FOREIGN KEY (`DOCID`) REFERENCES `document` (`DOCID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proceedings`
--
ALTER TABLE `proceedings`
  ADD CONSTRAINT `proceedings_ibfk_1` FOREIGN KEY (`DOCID`) REFERENCES `document` (`DOCID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reserves`
--
ALTER TABLE `reserves`
  ADD CONSTRAINT `reserves_ibfk_1` FOREIGN KEY (`DOCID`,`COPYNO`,`BID`) REFERENCES `copy` (`DOCID`, `COPYNO`, `BID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserves_ibfk_2` FOREIGN KEY (`RESERVATION_NO`) REFERENCES `reservation` (`RES_NO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserves_ibfk_3` FOREIGN KEY (`RID`) REFERENCES `reader` (`RID`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--

CREATE DEFINER=`root`@`localhost` EVENT `DELETERESERVATION` ON SCHEDULE EVERY 1 DAY STARTS '2021-04-28 18:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM reservation$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2018 at 03:27 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `secschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic`
--

CREATE TABLE `academic` (
  `id` int(11) NOT NULL,
  `acyear` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic`
--

INSERT INTO `academic` (`id`, `acyear`) VALUES
(1, '2018');

-- --------------------------------------------------------

--
-- Table structure for table `academicyear`
--

CREATE TABLE `academicyear` (
  `id` int(11) NOT NULL,
  `acyear` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `fee` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `allfeepayments`
--

CREATE TABLE `allfeepayments` (
  `id` int(11) NOT NULL,
  `admission` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `payment` double NOT NULL,
  `balance` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allfeepayments`
--

INSERT INTO `allfeepayments` (`id`, `admission`, `name`, `class`, `category`, `payment`, `balance`, `date`) VALUES
(6, '01', 'Student01', 'First Year', 'Regular', 10000, 64872, '2018-09-02'),
(7, '01', 'Student01', 'First Year', 'Regular', 5000, 59872, '2018-09-09'),
(8, '01', 'Student01', 'First Year', 'Regular', 10000, 49872, '2018-09-16'),
(9, '01', 'Student01', 'First Year', 'Regular', 5000, 44872, '2018-09-20'),
(10, '01', 'Student01', 'First Year', 'Regular', 10000, 34872, '2018-09-11'),
(11, '01', 'Student01', 'First Year', 'Regular', 5000, 29872, '2018-10-01'),
(12, '01', 'Student01', 'First Year', 'Regular', 7890, 21982, '2018-11-07'),
(13, '01', 'Student01', 'First Year', 'Regular', 10000, 11982, '2018-12-05'),
(14, '01', 'Student01', 'First Year', 'Regular', 10000, 1982, '2018-12-27'),
(15, '01', 'Student01', 'First Year', 'Regular', 1900, 82, '2018-12-24'),
(16, '01', 'Student01', 'First Year', 'Regular', 82, 0, '2018-09-02'),
(17, '01', 'Student01', 'First Year', 'Regular', 1000, -1000, '2018-09-02'),
(18, '02', 'Student02', 'First Year', 'Regular', 20000, 54872, '2018-09-02'),
(19, '02', 'Student02', 'First Year', 'Regular', 10000, 44872, '2018-09-12'),
(20, '02', 'Student02', 'First Year', 'Regular', 5000, 39872, '2018-09-14'),
(21, '02', 'Student02', 'First Year', 'Regular', 6709, 33163, '2018-10-04'),
(22, '02', 'Student02', 'First Year', 'Regular', 10000, 23163, '2018-10-24'),
(23, '02', 'Student02', 'First Year', 'Regular', 4000, 19163, '2018-09-30'),
(24, '02', 'Student02', 'First Year', 'Regular', 8000, 11163, '2018-09-10'),
(25, '03', 'Student03', 'First Year', 'Regular', 15000, 59872, '2018-09-03'),
(26, '03', 'Student03', 'First Year', 'Regular', 65000, -5128, '2018-09-03'),
(27, '02', 'Student02', 'First Year', 'Regular', 2000, 9163, '2018-09-07'),
(28, '2953', 'Antony Koech', 'First Year', 'Regular', 3000, 37000, '2018-09-07'),
(29, '04', 'Student04', 'First Year', 'Regular', 20000, 54872, '2018-09-10'),
(30, '04', 'Student04', 'First Year', 'Regular', 10000, 44872, '2018-09-10'),
(31, '10', 'Student 10', 'Form One', '', 20000, 100000, '2018-09-12'),
(32, '10', 'Student 10', 'Form One', '', 5000, 95000, '2018-09-12'),
(33, '4572', 'IAN KIPKURUI KIPLAGAT', 'Form One', '', 0, 0, '2018-10-22');

-- --------------------------------------------------------

--
-- Table structure for table `allpayments`
--

CREATE TABLE `allpayments` (
  `id` int(11) NOT NULL,
  `indexnumber` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL,
  `votehead` varchar(255) NOT NULL,
  `payment` double NOT NULL,
  `balance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allpayments`
--

INSERT INTO `allpayments` (`id`, `indexnumber`, `name`, `class`, `priority`, `votehead`, `payment`, `balance`) VALUES
(1, '10', 'Student 10', 'Form One', 1, 'Tuition Fee', 5000, 0),
(2, '10', 'Student 10', 'Form One', 2, 'Boarding', 6000, 0),
(3, '4572', 'IAN KIPKURUI KIPLAGAT', 'Form One', 1, 'Tuition Fee', 5000, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `allregister`
--

CREATE TABLE `allregister` (
  `id` int(11) NOT NULL,
  `indexnumber` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `name`) VALUES
(2, 'KCB');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(2, 'Regular'),
(3, 'School Based'),
(4, 'ECDE Diploma'),
(5, 'ECDE Certificate');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`) VALUES
(1, 'Form One'),
(2, 'Form Two'),
(3, 'Form Three'),
(4, 'Form Four');

-- --------------------------------------------------------

--
-- Table structure for table `classteacherremarks`
--

CREATE TABLE `classteacherremarks` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(100) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `acyear` varchar(100) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classteacherremarks`
--

INSERT INTO `classteacherremarks` (`id`, `username`, `name`, `class`, `stream`, `acyear`, `grade`, `remarks`) VALUES
(1, 'linus', 'Linus Ngososey', 'Form One', 'East', '2018', 'A', 'Excellent Work'),
(2, 'linus', 'Linus Ngososey', 'Form One', 'East', '2018', 'A-', 'Good Work'),
(4, 'linus', 'Linus Ngososey', 'Form One', 'East', '2018', 'B+', 'Good'),
(6, 'linus', 'Linus Ngososey', 'Form One', 'East', '2018', 'B', 'You can do better'),
(8, 'linus', 'Linus Ngososey', 'Form One', 'East', '2018', 'B-', 'Work extra hard'),
(9, 'linus', 'Linus Ngososey', 'Form One', 'East', '2018', 'C+', 'Can do better, aim higher'),
(10, 'linus', 'Linus Ngososey', 'Form One', 'East', '2018', 'C', 'Aim higher put more effort'),
(11, 'linus', 'Linus Ngososey', 'Form One', 'East', '2018', 'C-', 'Put more effort'),
(12, 'linus', 'Linus Ngososey', 'Form One', 'East', '2018', 'D+', 'Can do better'),
(13, 'linus', 'Linus Ngososey', 'Form One', 'East', '2018', 'D+', 'Can do better work hard'),
(14, 'james', 'James Kariuki', 'Form Two', 'East', '2018', 'A', 'Excellent work');

-- --------------------------------------------------------

--
-- Table structure for table `classteachers`
--

CREATE TABLE `classteachers` (
  `id` int(11) NOT NULL,
  `class` varchar(255) NOT NULL,
  `stream` varchar(255) NOT NULL,
  `acyear` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classteachers`
--

INSERT INTO `classteachers` (`id`, `class`, `stream`, `acyear`, `username`, `name`) VALUES
(3, 'Form One', 'East', '2018', 'linus', 'Linus Ngososey'),
(4, 'Form Two', 'East', '2018', 'james', 'James Kariuki'),
(5, 'Form Three', 'East', '2018', 'jacob', 'Jacob Kosgei'),
(6, 'Form Four', 'East', '2018', 'paul', 'Paul Macharia'),
(7, 'Form One', 'West', '2018', 'linus', 'Linus Ngososey');

-- --------------------------------------------------------

--
-- Table structure for table `developer`
--

CREATE TABLE `developer` (
  `id` int(11) NOT NULL,
  `Schoolname` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `developer`
--

INSERT INTO `developer` (`id`, `Schoolname`, `Address`) VALUES
(1, 'FOUNTAIN TRAINING COLLEGE', '( P.O BOX 137 - ELDORET )');

-- --------------------------------------------------------

--
-- Table structure for table `exammarks`
--

CREATE TABLE `exammarks` (
  `id` int(11) NOT NULL,
  `indexnumber` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `stream` varchar(255) NOT NULL,
  `term` varchar(255) NOT NULL,
  `acyear` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `exam` varchar(255) NOT NULL,
  `marks` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exammarks`
--

INSERT INTO `exammarks` (`id`, `indexnumber`, `name`, `class`, `stream`, `term`, `acyear`, `subject`, `exam`, `marks`, `grade`) VALUES
(1, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Mathematics', '1', '68', 'B'),
(2, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Mathematics', '1', '70', 'B+'),
(3, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Mathematics', '1', '72', 'B+'),
(4, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Mathematics', '1', '50', 'C'),
(5, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Mathematics', '1', '80', 'A'),
(6, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'English', '1', '70', 'B+'),
(7, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'English', '1', '66', 'B'),
(8, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'English', '1', '68', 'B'),
(9, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'English', '1', '70', 'B+'),
(10, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'English', '1', '54', 'C'),
(11, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Kiswahili', '1', '60', 'B-'),
(12, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Kiswahili', '1', '70', 'B+'),
(13, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Kiswahili', '1', '78', 'A-'),
(14, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Kiswahili', '1', '68', 'B'),
(15, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Kiswahili', '1', '72', 'B+'),
(16, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Physics', '1', '60', 'B-'),
(17, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Physics', '1', '50', 'C'),
(18, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Physics', '1', '70', 'B+'),
(19, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Physics', '1', '80', 'A'),
(20, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Physics', '1', '58', 'C+'),
(21, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Chemistry', '1', '70', 'B+'),
(22, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Chemistry', '1', '73', 'B+'),
(23, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Chemistry', '1', '80', 'A'),
(24, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Chemistry', '1', '68', 'B'),
(25, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Chemistry', '1', '82', 'A'),
(26, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Business Studies', '1', '70', 'B+'),
(27, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Business Studies', '1', '80', 'A'),
(28, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Business Studies', '1', '66', 'B'),
(29, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Business Studies', '1', '54', 'C'),
(30, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Business Studies', '1', '76', 'A-'),
(31, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Agriculture', '1', '67', 'B'),
(32, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Agriculture', '1', '80', 'A'),
(33, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Agriculture', '1', '70', 'B+'),
(34, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Agriculture', '1', '55', 'C+'),
(35, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Agriculture', '1', '80', 'A'),
(36, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'History', '1', '66', 'B'),
(37, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'History', '1', '60', 'B-'),
(38, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'History', '1', '70', 'B+'),
(39, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'History', '1', '68', 'B'),
(40, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'History', '1', '72', 'B+'),
(41, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Religion', '1', '70', 'B+'),
(42, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Religion', '1', '60', 'B-'),
(43, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Religion', '1', '60', 'B-'),
(44, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Religion', '1', '50', 'C'),
(45, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Religion', '1', '70', 'B+'),
(46, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Geography', '1', '68', 'B'),
(47, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Geography', '1', '70', 'B+'),
(48, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Geography', '1', '80', 'A'),
(49, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Geography', '1', '66', 'B'),
(50, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Geography', '1', '60', 'B-'),
(51, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Mathematics', '2', '70', 'B+'),
(52, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Mathematics', '2', '68', 'B'),
(53, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Mathematics', '2', '80', 'A'),
(54, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Mathematics', '2', '70', 'B+'),
(55, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Mathematics', '2', '58', 'C+'),
(56, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'English', '2', '66', 'B'),
(57, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'English', '2', '64', 'B-'),
(58, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'English', '2', '70', 'B+'),
(59, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'English', '2', '72', 'B+'),
(60, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'English', '2', '68', 'B'),
(61, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Kiswahili', '2', '68', 'B'),
(62, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Kiswahili', '2', '60', 'B-'),
(63, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Kiswahili', '2', '68', 'B'),
(64, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Kiswahili', '2', '50', 'C'),
(65, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Kiswahili', '2', '70', 'B+'),
(66, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Physics', '2', '70', 'B+'),
(67, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Physics', '2', '60', 'B-'),
(68, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Physics', '2', '72', 'B+'),
(69, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Physics', '2', '64', 'B-'),
(70, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Physics', '2', '66', 'B'),
(71, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Chemistry', '2', '60', 'B-'),
(72, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Chemistry', '2', '59', 'C+'),
(73, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Chemistry', '2', '60', 'B-'),
(74, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Chemistry', '2', '64', 'B-'),
(75, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Chemistry', '2', '70', 'B+'),
(76, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Business Studies', '2', '73', 'B+'),
(77, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Business Studies', '2', '64', 'B-'),
(78, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Business Studies', '2', '60', 'B-'),
(79, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Business Studies', '2', '58', 'C+'),
(80, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Business Studies', '2', '62', 'B-'),
(81, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Agriculture', '2', '68', 'B'),
(82, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Agriculture', '2', '70', 'B+'),
(83, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Agriculture', '2', '74', 'B+'),
(84, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Agriculture', '2', '68', 'B'),
(85, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Agriculture', '2', '62', 'B-'),
(86, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Religion', '2', '70', 'B+'),
(87, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Religion', '2', '72', 'B+'),
(88, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Religion', '2', '70', 'B+'),
(89, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Religion', '2', '60', 'B-'),
(90, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Religion', '2', '62', 'B-'),
(91, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Geography', '2', '60', 'B-'),
(92, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Geography', '2', '60', 'B-'),
(93, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Geography', '2', '64', 'B-'),
(94, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Geography', '2', '62', 'B-'),
(95, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Geography', '2', '58', 'C+'),
(96, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'History', '2', '50', 'C'),
(97, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'History', '2', '70', 'B+'),
(98, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'History', '2', '80', 'A'),
(99, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'History', '2', '68', 'B'),
(100, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'History', '2', '66', 'B'),
(101, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Mathematics', '3', '70', 'B+'),
(102, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Mathematics', '3', '60', 'B-'),
(103, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Mathematics', '3', '78', 'A-'),
(104, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Mathematics', '3', '68', 'B'),
(105, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Mathematics', '3', '70', 'B+'),
(106, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'English', '3', '66', 'B'),
(107, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'English', '3', '56', 'C+'),
(108, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'English', '3', '60', 'B-'),
(109, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'English', '3', '63', 'B-'),
(110, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'English', '3', '60', 'B-'),
(111, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Kiswahili', '3', '68', 'B'),
(112, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Kiswahili', '3', '58', 'C+'),
(113, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Kiswahili', '3', '70', 'B+'),
(114, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Kiswahili', '3', '72', 'B+'),
(115, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Kiswahili', '3', '60', 'B-'),
(116, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Physics', '3', '66', 'B'),
(117, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Physics', '3', '50', 'C'),
(118, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Physics', '3', '56', 'C+'),
(119, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Physics', '3', '60', 'B-'),
(120, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Physics', '3', '56', 'C+'),
(121, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Chemistry', '3', '66', 'B'),
(122, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Chemistry', '3', '60', 'B-'),
(123, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Chemistry', '3', '68', 'B'),
(124, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Chemistry', '3', '70', 'B+'),
(125, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Chemistry', '3', '50', 'C'),
(126, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Business Studies', '3', '60', 'B-'),
(127, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Business Studies', '3', '56', 'C+'),
(128, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Business Studies', '3', '55', 'C+'),
(129, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Business Studies', '3', '62', 'B-'),
(130, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Business Studies', '3', '64', 'B-'),
(131, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Agriculture', '3', '60', 'B-'),
(132, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Agriculture', '3', '64', 'B-'),
(133, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Agriculture', '3', '70', 'B+'),
(134, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Agriculture', '3', '66', 'B'),
(135, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Agriculture', '3', '70', 'B+'),
(136, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'History', '3', '60', 'B-'),
(137, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'History', '3', '66', 'B'),
(138, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'History', '3', '64', 'B-'),
(139, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'History', '3', '50', 'C'),
(140, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'History', '3', '70', 'B+'),
(141, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Religion', '3', '60', 'B-'),
(142, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Religion', '3', '83', 'A'),
(143, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Religion', '3', '64', 'B-'),
(144, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Religion', '3', '80', 'A'),
(145, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Religion', '3', '62', 'B-'),
(146, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', 'Geography', '3', '66', 'B'),
(147, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', 'Geography', '3', '76', 'A-'),
(148, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', 'Geography', '3', '55', 'C+'),
(149, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', 'Geography', '3', '66', 'B'),
(150, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', 'Geography', '3', '60', 'B-'),
(152, '10w', 'Student 10w', 'Form One', 'West', 'Term I', '2018', 'Mathematics', '1', '70', 'B+'),
(153, '10w', 'Student 10w', 'Form One', 'West', 'Term I', '2018', 'English', '1', '64', 'B-'),
(154, '11w', 'Student 11w', 'Form One', 'West', 'Term I', '2018', 'Mathematics', '1', '67', 'B'),
(155, '10w', 'Student 10w', 'Form One', 'West', 'Term I', '2018', 'Kiswahili', '1', '70', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `examptemarks`
--

CREATE TABLE `examptemarks` (
  `id` int(11) NOT NULL,
  `indexnumber` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `stream` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `acyear` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `exam` varchar(255) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examptemarks`
--

INSERT INTO `examptemarks` (`id`, `indexnumber`, `name`, `class`, `stream`, `category`, `acyear`, `subject`, `exam`, `points`) VALUES
(54, '01', 'Student01', 'First Year', 'A', 'Regular', '2018/1', 'English', 'CAT 1', 2),
(55, '02', 'Student02', 'First Year', 'A', 'Regular', '2018/1', 'English', 'CAT 1', 1),
(56, '03', 'Student03', 'First Year', 'A', 'Regular', '2018/1', 'English', 'CAT 1', 1),
(57, '04', 'Student04', 'First Year', 'A', 'Regular', '2018/1', 'English', 'CAT 1', 2),
(58, '01', 'Student01', 'First Year', 'A', 'Regular', '2018/1', 'Kiswahili', 'CAT 1', 1),
(59, '02', 'Student02', 'First Year', 'A', 'Regular', '2018/1', 'Kiswahili', 'CAT 1', 2),
(60, '03', 'Student03', 'First Year', 'A', 'Regular', '2018/1', 'Kiswahili', 'CAT 1', 3),
(61, '04', 'Student04', 'First Year', 'A', 'Regular', '2018/1', 'Kiswahili', 'CAT 1', 2),
(62, '01', 'Student01', 'First Year', 'A', 'Regular', '2018/1', 'ICT', 'CAT 1', 1),
(63, '02', 'Student02', 'First Year', 'A', 'Regular', '2018/1', 'ICT', 'CAT 1', 3),
(64, '03', 'Student03', 'First Year', 'A', 'Regular', '2018/1', 'ICT', 'CAT 1', 2),
(65, '04', 'Student04', 'First Year', 'A', 'Regular', '2018/1', 'ICT', 'CAT 1', 4),
(66, '01', 'Student01', 'First Year', 'A', 'Regular', '2018/1', 'Mathematics', 'CAT 1', 5),
(67, '02', 'Student02', 'First Year', 'A', 'Regular', '2018/1', 'Mathematics', 'CAT 1', 1),
(68, '03', 'Student03', 'First Year', 'A', 'Regular', '2018/1', 'Mathematics', 'CAT 1', 2),
(69, '04', 'Student04', 'First Year', 'A', 'Regular', '2018/1', 'Mathematics', 'CAT 1', 6),
(70, '01', 'Student01', 'First Year', 'A', 'Regular', '2018/1', 'Integrated Science', 'CAT 1', 3),
(71, '02', 'Student02', 'First Year', 'A', 'Regular', '2018/1', 'Integrated Science', 'CAT 1', 2),
(72, '03', 'Student03', 'First Year', 'A', 'Regular', '2018/1', 'Integrated Science', 'CAT 1', 1),
(73, '04', 'Student04', 'First Year', 'A', 'Regular', '2018/1', 'Integrated Science', 'CAT 1', 4),
(74, '01', 'Student01', 'First Year', 'A', 'Regular', '2018/1', 'Physical Education', 'CAT2', 2),
(75, '02', 'Student02', 'First Year', 'A', 'Regular', '2018/1', 'Physical Education', 'CAT2', 2),
(76, '01', 'Student01', 'First Year', 'A', 'Regular', '2018/1', 'Physical Education', 'CAT 1', 2),
(77, '02', 'Student02', 'First Year', 'A', 'Regular', '2018/1', 'Physical Education', 'CAT 1', 1),
(78, '03', 'Student03', 'First Year', 'A', 'Regular', '2018/1', 'Physical Education', 'CAT 1', 4),
(79, '04', 'Student04', 'First Year', 'A', 'Regular', '2018/1', 'Physical Education', 'CAT 1', 2),
(80, '01', 'Student01', 'First Year', 'A', 'Regular', '2018/1', 'CRE', 'CAT 1', 5),
(81, '02', 'Student02', 'First Year', 'A', 'Regular', '2018/1', 'CRE', 'CAT 1', 3),
(82, '03', 'Student03', 'First Year', 'A', 'Regular', '2018/1', 'CRE', 'CAT 1', 5),
(83, '04', 'Student04', 'First Year', 'A', 'Regular', '2018/1', 'CRE', 'CAT 1', 6),
(84, '01', 'Student01', 'First Year', 'A', 'Regular', '2018/1', 'Creative Art', 'CAT 1', 4),
(85, '02', 'Student02', 'First Year', 'A', 'Regular', '2018/1', 'Creative Art', 'CAT 1', 1),
(86, '03', 'Student03', 'First Year', 'A', 'Regular', '2018/1', 'Creative Art', 'CAT 1', 2),
(87, '04', 'Student04', 'First Year', 'A', 'Regular', '2018/1', 'Creative Art', 'CAT 1', 6),
(88, '01', 'Student01', 'First Year', 'A', 'Regular', '2018/1', 'Social Studies', 'CAT 1', 5),
(89, '02', 'Student02', 'First Year', 'A', 'Regular', '2018/1', 'Social Studies', 'CAT 1', 4),
(90, '03', 'Student03', 'First Year', 'A', 'Regular', '2018/1', 'Social Studies', 'CAT 1', 7),
(91, '04', 'Student04', 'First Year', 'A', 'Regular', '2018/1', 'Social Studies', 'CAT 1', 6),
(102, '01', 'Student01', 'First Year', 'A', 'Regular', '2018/1', 'Education', 'CAT 1', 3),
(104, '02', 'Student02', 'First Year', 'A', 'Regular', '2018/1', 'Education', 'CAT 1', 1),
(107, '04', 'Student04', 'First Year', 'A', 'Regular', '2018/1', 'Education', 'CAT 1', 6),
(108, '03', 'Student03', 'First Year', 'A', 'Regular', '2018/1', 'Education', 'CAT 1', 3);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `priority`, `name`) VALUES
(5, 1, 'CAT 1'),
(6, 2, 'CAT 2'),
(7, 3, 'End Term');

-- --------------------------------------------------------

--
-- Table structure for table `expenditure`
--

CREATE TABLE `expenditure` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `item` varchar(255) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenditure`
--

INSERT INTO `expenditure` (`id`, `date`, `item`, `amount`) VALUES
(1, '2018-08-30', 'item1', 20000),
(2, '2018-08-30', 'item2', 200),
(3, '2018-08-30', 'item3', 1200),
(4, '2018-08-30', 'item4', 3000),
(5, '2018-08-30', 'item5', 1000),
(6, '2018-09-07', 'Transport', 2000),
(7, '2018-09-07', 'BES', 130000),
(8, '2018-09-07', 'EWC', 10000),
(9, '2018-09-07', 'Stationary', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `headteacherremarks`
--

CREATE TABLE `headteacherremarks` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `acyear` varchar(100) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `headteacherremarks`
--

INSERT INTO `headteacherremarks` (`id`, `username`, `name`, `acyear`, `grade`, `remarks`) VALUES
(2, 'paul', 'Paul Macharia', '2018', 'A', 'Excellent work you can do better'),
(3, 'paul', 'Paul Macharia', '2018', 'A-', 'Good work put more effort'),
(4, 'paul', 'Paul Macharia', '2018', 'B', 'You can do better aim more higher'),
(5, 'paul', 'Paul Macharia', '2018', 'B-', 'Work extra hard you can do more than this');

-- --------------------------------------------------------

--
-- Table structure for table `headteachers`
--

CREATE TABLE `headteachers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `headteachers`
--

INSERT INTO `headteachers` (`id`, `name`, `username`, `category`) VALUES
(2, 'Paul Macharia', 'paul', 'headteacher');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `item` varchar(255) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `date`, `item`, `amount`) VALUES
(1, '2018-08-29', 'Lent Bus school', 30000),
(6, '2018-08-29', 'Lent Busmkll', 30000),
(10, '2018-08-30', 'Item1', 3000),
(11, '2018-08-29', 'Item2', 12000),
(12, '2018-08-01', 'Item3', 120),
(13, '2018-07-31', 'Item4', 2453),
(14, '2018-07-11', 'Item5', 24530),
(15, '2018-07-26', 'Item6', 1267),
(16, '2018-07-30', 'Item7', 1267),
(17, '2018-07-29', 'Item8', 126700),
(18, '2018-09-01', 'Item9', 9097),
(19, '2018-09-20', 'Item10', 9097);

-- --------------------------------------------------------

--
-- Table structure for table `loginadmin`
--

CREATE TABLE `loginadmin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `confirm` varchar(20) NOT NULL,
  `favorite` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginadmin`
--

INSERT INTO `loginadmin` (`username`, `password`, `confirm`, `favorite`) VALUES
('linus', 'linus1', 'linus1', '123');

-- --------------------------------------------------------

--
-- Table structure for table `logindeveloper`
--

CREATE TABLE `logindeveloper` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logindeveloper`
--

INSERT INTO `logindeveloper` (`username`, `password`) VALUES
('linus@27', '31452423');

-- --------------------------------------------------------

--
-- Table structure for table `loginfinance`
--

CREATE TABLE `loginfinance` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `confirmpassword` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginfinance`
--

INSERT INTO `loginfinance` (`username`, `password`, `confirmpassword`) VALUES
('linus', 'linus1', 'linus1');

-- --------------------------------------------------------

--
-- Table structure for table `overallpositioning`
--

CREATE TABLE `overallpositioning` (
  `id` int(11) NOT NULL,
  `indexnumber` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `stream` varchar(255) NOT NULL,
  `acyear` varchar(255) NOT NULL,
  `term` varchar(255) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overallpositioning`
--

INSERT INTO `overallpositioning` (`id`, `indexnumber`, `name`, `class`, `stream`, `acyear`, `term`, `total`) VALUES
(1, '10', 'Student 10', 'Form One', 'East', '2018', 'Term I', 1966),
(2, '11', 'Student 11', 'Form One', 'East', '2018', 'Term I', 1963),
(3, '12', 'Student 12', 'Form One', 'East', '2018', 'Term I', 2046),
(4, '13', 'Student 13', 'Form One', 'East', '2018', 'Term I', 1920),
(5, '14', 'Student 14', 'Form One', 'East', '2018', 'Term I', 1968),
(6, '10w', 'Student 10w', 'Form One', 'West', '2018', 'Term I', 204),
(7, '11w', 'Student 11w', 'Form One', 'West', '2018', 'Term I', 67);

-- --------------------------------------------------------

--
-- Table structure for table `paymentdetails`
--

CREATE TABLE `paymentdetails` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `idnumber` varchar(255) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentdetails`
--

INSERT INTO `paymentdetails` (`id`, `name`, `idnumber`, `amount`) VALUES
(1, 'Staff 1', '31245654', 30000),
(2, 'Staff 2', '40245654', 32000),
(3, 'Staff 3', '19245654', 41000),
(4, 'Staff 4', '29245654', 31000);

-- --------------------------------------------------------

--
-- Table structure for table `positioning`
--

CREATE TABLE `positioning` (
  `id` int(11) NOT NULL,
  `indexnumber` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `stream` varchar(255) NOT NULL,
  `term` varchar(255) NOT NULL,
  `acyear` varchar(255) NOT NULL,
  `exam` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positioning`
--

INSERT INTO `positioning` (`id`, `indexnumber`, `name`, `class`, `stream`, `term`, `acyear`, `exam`, `total`) VALUES
(1, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', '1', '669'),
(2, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', '1', '679'),
(3, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', '1', '714'),
(4, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', '1', '629'),
(5, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', '1', '704'),
(6, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', '2', '655'),
(7, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', '2', '647'),
(8, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', '2', '698'),
(9, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', '2', '636'),
(10, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', '2', '642'),
(11, '10', 'Student 10', 'Form One', 'East', 'Term I', '2018', '3', '642'),
(12, '11', 'Student 11', 'Form One', 'East', 'Term I', '2018', '3', '637'),
(13, '12', 'Student 12', 'Form One', 'East', 'Term I', '2018', '3', '634'),
(14, '13', 'Student 13', 'Form One', 'East', 'Term I', '2018', '3', '655'),
(15, '14', 'Student 14', 'Form One', 'East', 'Term I', '2018', '3', '622'),
(16, '10w', 'Student 10w', 'Form One', 'West', 'Term I', '2018', '1', '204'),
(17, '11w', 'Student 11w', 'Form One', 'West', 'Term I', '2018', '1', '67');

-- --------------------------------------------------------

--
-- Table structure for table `ptetotal`
--

CREATE TABLE `ptetotal` (
  `id` int(11) NOT NULL,
  `indexnumber` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `class` varchar(255) NOT NULL,
  `stream` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `acyear` varchar(255) NOT NULL,
  `exam` varchar(255) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ptetotal`
--

INSERT INTO `ptetotal` (`id`, `indexnumber`, `name`, `gender`, `class`, `stream`, `category`, `acyear`, `exam`, `total`) VALUES
(1, '01', 'Student01', 'Male', 'First Year', 'A', 'Regular', '2018/1', 'CAT 1', 31),
(2, '02', 'Student02', 'Male', 'First Year', 'A', 'Regular', '2018/1', 'CAT 1', 19),
(3, '03', 'Student03', 'Male', 'First Year', 'A', 'Regular', '2018/1', 'CAT 1', 30),
(4, '04', 'Student04', 'Male', 'First Year', 'A', 'Regular', '2018/1', 'CAT 1', 44);

-- --------------------------------------------------------

--
-- Table structure for table `recycle`
--

CREATE TABLE `recycle` (
  `id` int(11) NOT NULL,
  `indexnumber` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `acyear` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `fee` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staffpayment`
--

CREATE TABLE `staffpayment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `idnumber` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL,
  `month` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffpayment`
--

INSERT INTO `staffpayment` (`id`, `name`, `idnumber`, `amount`, `date`, `month`) VALUES
(2, 'Staff 1', '31245654', 30000, '2018-09-05', '03-2018'),
(3, 'Staff 2', '40245654', 32000, '2018-09-05', '03-2018'),
(5, 'Staff 4', '29245654', 31000, '2018-09-05', '09-2018'),
(6, 'Staff 3', '19245654', 41000, '2018-09-05', '09-2018'),
(7, 'Staff 2', '40245654', 32000, '2018-09-06', '09-2018');

-- --------------------------------------------------------

--
-- Table structure for table `streams`
--

CREATE TABLE `streams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `streams`
--

INSERT INTO `streams` (`id`, `name`) VALUES
(6, 'East'),
(7, 'West');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `indexnumber` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `stream` varchar(255) NOT NULL,
  `house` varchar(255) NOT NULL,
  `county` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `kcmarks` varchar(100) NOT NULL,
  `kcgrade` varchar(100) NOT NULL,
  `gname` varchar(255) NOT NULL,
  `gcontact` varchar(255) NOT NULL,
  `payment` double NOT NULL,
  `prev_balance` double NOT NULL,
  `balance` double NOT NULL,
  `fee` double NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `indexnumber`, `name`, `class`, `stream`, `house`, `county`, `gender`, `kcmarks`, `kcgrade`, `gname`, `gcontact`, `payment`, `prev_balance`, `balance`, `fee`, `password`) VALUES
(1, '4572', 'IAN KIPKURUI KIPLAGAT', 'Form One', 'North', '', '', 'Male', '361', ' B', 'FRIDAH KIPLAGAT', '2.54721E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a0'),
(2, '4579', 'KELVIN KIBET', 'Form One', 'North', '', '', 'Male', '341', '', 'PARENT', '2.54728E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a1'),
(3, '4583', 'MOSES KIPRONO BIWOTT', 'Form One', 'North', '', '', 'Male', '338', '', 'WINNIE TUIKENY', '2.54718E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a2'),
(4, '4585', 'BONIFACE KANGANGI KIGOTHO', 'Form One', 'North', '', '', 'Male', '376', ' B', 'CATHERINE KIGOTHO', '2.54729E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a3'),
(5, '4588', 'JOSEH MAINA KAMAE', 'Form One', 'North', '', '', 'Male', '373', 'B', 'EUNICE MAINA', '2.54726E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a4'),
(6, '4594', 'ALVIN ONGERA MOCHAMA', 'Form One', 'North', '', '', 'Male', '359', 'B', 'VIOLET NYABOKE', '2.54711E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a5'),
(7, '4599', 'LAWI KIPKOECH CHUMBA', 'Form One', 'North', '', '', 'Male', '336', '', 'EDNAH CHUMBA', '2.54718E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a6'),
(8, '4600', 'TEBENY PHILIP KIPKEMBOI', 'Form One', 'North', '', '', 'Male', '350', '', 'LEAH TEBENY', '2.54736E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a7'),
(9, '4609', 'EDWIN KIPCHIRCHIR', 'Form One', 'North', '', '', 'Male', '356', 'B', 'PURITY KEMBOI', '2.54793E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a8'),
(10, '4613', 'ABRAHAM KIPKIRUI SITIENEI', 'Form One', 'North', '', '', 'Male', '357', 'B', 'ESTHER SITIENEI', '2.54717E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a9'),
(11, '4618', 'AUGUSTINE WEKESA MASADA', 'Form One', 'North', '', '', 'Male', '358', 'B', 'PHANIES WAFULA', '2.54729E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a10'),
(12, '4621', 'KIPROP COLLINS', 'Form One', 'North', '', '', 'Male', '359', 'B', 'RODAH MASIT', '2.54704E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a11'),
(13, '4631', 'DANIEL KIPROTICH MELI', 'Form One', 'North', '', '', 'Male', '360', 'B', 'DOCAS TOO', '2.54727E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a12'),
(14, '4634', 'RODGERS KIPRUTO', 'Form One', 'North', '', '', 'Male', '361', 'B', 'PARENT', '2.54713E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a13'),
(15, '4636', 'HAZAEL CHERUIYOT', 'Form One', 'North', '', '', 'Male', '362', 'B', 'NIFFAH KIRUI', '2.54708E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a14'),
(16, '4637', 'NIMROD KIPRONO ROTICH', 'Form One', 'North', '', '', 'Male', '363', 'B', 'ANNEH SOME', '2.54729E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a15'),
(17, '4644', 'KIBET KELVIN', 'Form One', 'North', '', '', 'Male', '', '', 'PARENT', '2.54727E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a16'),
(18, '4650', 'ADRIAN KIPRUTO KIRUI', 'Form One', 'North', '', '', 'Male', '365', 'B', 'LYDIA KOECH', '2.54716E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a17'),
(19, '4652', 'BRIAN KIPTOO CHERUIYOT', 'Form One', 'North', '', '', 'Male', '366', 'B', 'JESCAH TENAI', '2.54723E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a18'),
(20, '4656', 'SILAS CHAHIVA', 'Form One', 'North', '', '', 'Male', '367', 'B', 'SHEILAH MINAYO', '2.54726E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a19'),
(21, '4662', 'PAUL MWOMBE SHIVONA', 'Form One', 'North', '', '', 'Male', '368', 'B', 'DORCAS SHIVONA', '2.54743E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a20'),
(22, '4664', 'WALTER KIPCHUMBA NGETICH', 'Form One', 'North', '', '', 'Male', '369', 'B', 'FELISTERH TOO', '2.54714E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a21'),
(23, '4667', 'ELVIS KIPRUTO MAIYO', 'Form One', 'North', '', '', 'Male', '370', 'B', 'MARY MAIYO', '2.547E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a22'),
(24, '4669', 'VICTOR KIPTOO', 'Form One', 'North', '', '', 'Male', '371', ' B', 'LYDIA KERING', '2.5472E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a23'),
(25, '4670', 'ABRAHAM KIMARU ROTICH', 'Form One', 'North', '', '', 'Male', '372', 'B', 'VIOLAH KEMEI', '2.54711E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a24'),
(26, '4672', 'SILAS KIPROP NGELECHEI', 'Form One', 'North', '', '', 'Male', '373', 'B', 'TERESA NGELECHEI', '2.54719E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a25'),
(27, '4676', 'AMON KIPROTICH KOECH', 'Form One', 'North', '', '', 'Male', '374', 'B', 'JANE RUGUT', '2.54722E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a26'),
(28, '4677', 'DANIEL KIPLAGAT NDIEMA', 'Form One', 'North', '', '', 'Male', '375', 'B', 'JOAN NDIEMA', '2.54729E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a27'),
(29, '4680', 'MARK OTIENO OUMA', 'Form One', 'North', '', '', 'Male', '376', 'B', 'PARENT', '2.54717E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a28'),
(30, '4687', 'KIPKOECH IAN', 'Form One', 'North', '', '', 'Male', '377', 'B', 'DINAH CHEROBON', '2.547E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a29'),
(31, '4696', 'KELVIN KIPCHUMBA', 'Form One', 'North', '', '', 'Male', '378', 'B', 'EUNICE MUREITHI', '2.54712E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a30'),
(32, '4700', 'ALFONCE KIPKEMEI', 'Form One', 'North', '', '', 'Male', '379', 'B', 'EUNICE KOECH', '2.54725E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a31'),
(33, '4703', 'DAN TIROP BIWOT', 'Form One', 'North', '', '', 'Male', '380', 'B', 'SALLY CHERONO', '2.54702E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a32'),
(34, '4707', 'KIPYEGO DENNIS', 'Form One', 'North', '', '', 'Male', '381', 'B', 'LYDIA SOME', '2.54722E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a33'),
(35, '4710', 'KELVIN KIMUTAI KOSGEI', 'Form One', 'North', '', '', 'Male', '382', '', 'CARNILLAH KOSGEI', '2.54717E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a34'),
(36, '4717', 'SOLOMON KIPCHUMBA', 'Form One', 'North', '', '', 'Male', '383', '', 'PARENT', '2.54723E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a35'),
(37, '4722', 'EDWIN BOSIRE OGINGA', 'Form One', 'North', '', '', 'Male', '384', '', 'GLADYS OGINGA', '2.54797E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a36'),
(38, '4727', 'LARRY KIPKORIR', 'Form One', 'North', '', '', 'Male', '385', '', 'RAEL LAMAI', '2.54713E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a37'),
(39, '4729', 'KEVIN KIPKEMBOI CHERUIYOT', 'Form One', 'North', '', '', 'Male', '386', '', 'LYDIA TANUI', '2.54716E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a38'),
(40, '4733', 'ALEX MAINA', 'Form One', 'North', '', '', 'Male', '387', '', 'PARENT', '2.54721E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a39'),
(41, '4746', 'KIPTOO KEITH', 'Form One', 'North', '', '', 'Male', '388', '', 'DEBORA BITOK', '2.54724E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a40'),
(42, '4747', 'BILL KIPRONO', 'Form One', 'North', '', '', 'Male', '389', '', 'ARLENE BOIT', '2.54716E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a41'),
(43, '4752', 'ENOCK KIPNGETICH', 'Form One', 'North', '', '', 'Male', '390', '', 'PARENT', '2.54721E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a42'),
(44, '4753', 'RONGOEI DENNIS', 'Form One', 'North', '', '', 'Male', '391', '', 'PARENT', '2.54701E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a43'),
(45, '4755', 'ALLAN KIPTOO', 'Form One', 'North', '', '', 'Male', '392', '', 'MIRIAM JEPKOECH', '2.54713E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a44'),
(46, '4762', 'KIPROTICH DENNIS', 'Form One', 'North', '', '', 'Male', '393', '', 'JANE SAMOEI', '2.54727E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a45'),
(47, '4764', 'JORAM KIPCHIRCHIR', 'Form One', 'North', '', '', 'Male', '394', 'B', 'RISBELLA MAIYO', '2.54726E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a46'),
(48, '4774', 'PIUS ASHIONO', 'Form One', 'North', '', '', 'Male', '395', 'B', 'PETRONILAH CHERONO', '2.54714E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a47'),
(49, '4782', 'BILBRIGHT KIPROTICH YEGO', 'Form One', 'North', '', '', 'Male', '396', 'B', '', '2.54723E+11', 0, 0, 0, 0, 'ad6a280417a0f533d8b670c61667e1a48'),
(50, '100', 'Student 100', 'Form One', 'East', 'Simba', 'Nakuru', 'Male', '300', 'B', 'James', '0776453762', 0, 0, 0, 0, '$2y$10$3.GwbQ63BPMmF6vixOWrE.8HhGWc/8qWWK1vmxgLdaIOZqIlJR6dq');

--
-- Triggers `students`
--
DELIMITER $$
CREATE TRIGGER `addFC` BEFORE UPDATE ON `students` FOR EACH ROW set new.balance=new.fee + new.balance
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(2, 'Mathematics'),
(3, 'English'),
(4, 'Kiswahili'),
(5, 'Physics'),
(6, 'Chemistry'),
(7, 'Business Studies'),
(8, 'Agriculture'),
(9, 'History'),
(10, 'C.R.E'),
(11, 'Geography'),
(12, 'Biology');

-- --------------------------------------------------------

--
-- Table structure for table `subjectsassigned`
--

CREATE TABLE `subjectsassigned` (
  `id` int(11) NOT NULL,
  `class` varchar(255) NOT NULL,
  `stream` varchar(255) NOT NULL,
  `acyear` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `initials` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjectsassigned`
--

INSERT INTO `subjectsassigned` (`id`, `class`, `stream`, `acyear`, `subject`, `username`, `name`, `initials`) VALUES
(1, 'Form One', 'East', '2018', 'Mathematics', 'linus', 'Linus Ngososey', 'LN'),
(2, 'Form One', 'East', '2018', 'English', 'james', 'James Kariuki', 'JK'),
(3, 'Form One', 'East', '2018', 'Kiswahili', 'jacob', 'Jacob Kosgei', 'JKG'),
(4, 'Form One', 'East', '2018', 'Physics', 'paul', 'Paul Macharia', 'PM'),
(5, 'Form One', 'West', '2018', 'Mathematics', 'linus', 'Linus Ngososey', 'LN'),
(6, 'Form One', 'West', '2018', 'English', 'linus', 'Linus Ngososey', 'LN'),
(7, 'Form One', 'West', '2018', 'Kiswahili', 'linus', 'Linus Ngososey', 'LN'),
(8, 'Form One', 'West', '2018', 'Physics', 'linus', 'Linus Ngososey', 'LN'),
(9, 'Form One', 'West', '2018', 'Chemistry', 'linus', 'Linus Ngososey', 'LN'),
(10, 'Form One', 'West', '2018', 'Business Studies', 'linus', 'Linus Ngososey', 'LN'),
(11, 'Form One', 'West', '2018', 'Agriculture', 'linus', 'Linus Ngososey', 'LN');

-- --------------------------------------------------------

--
-- Table structure for table `teacherremarks`
--

CREATE TABLE `teacherremarks` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `initials` varchar(100) NOT NULL,
  `class` varchar(100) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `acyear` varchar(100) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacherremarks`
--

INSERT INTO `teacherremarks` (`id`, `username`, `name`, `initials`, `class`, `stream`, `subject`, `acyear`, `grade`, `remarks`) VALUES
(8, 'linus', 'Linus Ngososey', 'LN', 'Form One', '', 'Mathematics', '2018', 'A', 'Excellent'),
(9, 'linus', 'Linus Ngososey', 'LN', 'Form One', '', 'Mathematics', '2018', 'A-', 'Good Work'),
(10, 'linus', 'Linus Ngososey', 'LN', 'Form One', '', 'Mathematics', '2018', 'B+', 'Good'),
(11, 'linus', 'Linus Ngososey', 'LN', 'Form One', '', 'Mathematics', '2018', 'B-', 'Work extra hard'),
(12, 'linus', 'Linus Ngososey', 'LN', 'Form One', '', 'Mathematics', '2018', 'B', 'You can do better'),
(13, 'linus', 'Linus Ngososey', 'LN', 'Form One', '', 'Mathematics', '2018', 'C+', 'Can do better aim higher'),
(14, 'james', 'James Kariuki', 'JK', 'Form One', '', 'English', '2018', 'A', 'Excellent keep it up'),
(15, 'james', 'James Kariuki', 'JK', 'Form One', '', 'English', '2018', 'A-', 'Good work keep it up'),
(16, 'james', 'James Kariuki', 'JK', 'Form One', '', 'English', '2018', 'B+', 'Good, work hard'),
(17, 'james', 'James Kariuki', 'JK', 'Form One', '', 'English', '2018', 'B', 'You can do better than this'),
(18, 'james', 'James Kariuki', 'JK', 'Form One', '', 'English', '2018', 'B-', 'Work hard'),
(19, 'james', 'James Kariuki', 'JK', 'Form One', '', 'English', '2018', 'C+', 'You can do better'),
(20, 'linus', 'Linus Ngososey', 'LN', 'Form One', 'East', 'Mathematics', '2018', 'A', 'Excellent'),
(21, 'linus', 'Linus Ngososey', 'LN', 'Form One', 'East', 'Mathematics', '2018', 'A-', 'Good Work'),
(22, 'linus', 'Linus Ngososey', 'LN', 'Form One', 'East', 'Mathematics', '2018', 'B+', 'Good'),
(23, 'linus', 'Linus Ngososey', 'LN', 'Form One', 'East', 'Mathematics', '2018', 'B', 'You can do better'),
(24, 'linus', 'Linus Ngososey', 'LN', 'Form One', 'East', 'Mathematics', '2018', 'B-', 'Work extra hard'),
(25, 'james', 'James Kariuki', 'JK', 'Form One', 'East', 'English', '2018', 'A', 'Excellent keep it up'),
(26, 'james', 'James Kariuki', 'JK', 'Form One', 'East', 'English', '2018', 'A-', 'Good work keep it up'),
(27, 'james', 'James Kariuki', 'JK', 'Form One', 'East', 'English', '2018', 'B+', 'Good work, put more effort'),
(28, 'james', 'James Kariuki', 'JK', 'Form One', 'East', 'English', '2018', 'B', 'You can do better'),
(29, 'james', 'James Kariuki', 'JK', 'Form One', 'East', 'English', '2018', 'C+', 'Work hard');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `initials` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `initials`, `username`, `password`) VALUES
(5, 'Linus Ngososey', 'LN', 'linus', 'teacher123'),
(6, 'James Kariuki', 'JK', 'james', 'teacher123'),
(7, 'Jacob Kosgei', 'JKG', 'jacob', 'a426dcf72ba25d046591f81a5495eab7'),
(8, 'Paul Macharia', 'PM', 'paul', 'a426dcf72ba25d046591f81a5495eab7');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `name`) VALUES
(1, 'Term I'),
(2, 'Term II'),
(3, 'Term III');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `class` varchar(100) NOT NULL,
  `stream` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `class`, `stream`, `name`) VALUES
(1, 'Form One', 'East', 'Linus Ngososey');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `category`, `name`, `username`, `password`) VALUES
(1, 'teacher', 'Linus Ngososey', 'linus', '$2y$10$7db903RqlVqhJaOLuafoV.F7YwxrKS4l.EInfixQtsP52aljFL4CW'),
(4, 'administrator', 'Jacob Jones', 'jones', '$2y$10$7db903RqlVqhJaOLuafoV.F7YwxrKS4l.EInfixQtsP52aljFL4CW'),
(26, 'admission', 'Admission', 'admission', '281edb7c3cf81e3b67aaa09df4e313f5'),
(38, 'teacher', '', 'james', 'a426dcf72ba25d046591f81a5495eab7'),
(54, 'student', '', '10', '$2y$10$7db903RqlVqhJaOLuafoV.F7YwxrKS4l.EInfixQtsP52aljFL4CW'),
(55, 'student', '', '11', 'ad6a280417a0f533d8b670c61667e1a0'),
(56, 'student', '', '12', 'ad6a280417a0f533d8b670c61667e1a0'),
(57, 'student', '', '13', 'ad6a280417a0f533d8b670c61667e1a0'),
(58, 'student', '', '14', 'ad6a280417a0f533d8b670c61667e1a0'),
(59, 'teacher', '', 'jacob', 'a426dcf72ba25d046591f81a5495eab7'),
(60, 'teacher', '', 'paul', 'a426dcf72ba25d046591f81a5495eab7'),
(61, 'student', '', '10w', 'ad6a280417a0f533d8b670c61667e1a0'),
(62, 'student', '', '11w', 'ad6a280417a0f533d8b670c61667e1a0'),
(63, 'student', '', '100', '$2y$10$3.GwbQ63BPMmF6vixOWrE.8HhGWc/8qWWK1vmxgLdaIOZqIlJR6dq');

-- --------------------------------------------------------

--
-- Table structure for table `votehead`
--

CREATE TABLE `votehead` (
  `id` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votehead`
--

INSERT INTO `votehead` (`id`, `priority`, `name`, `class`, `amount`) VALUES
(1, 1, 'Tuition Fee', 'Form One', 5000),
(2, 2, 'Boarding', 'Form One', 6000);

-- --------------------------------------------------------

--
-- Table structure for table `votehead1r`
--

CREATE TABLE `votehead1r` (
  `id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votehead1r`
--

INSERT INTO `votehead1r` (`id`, `num`, `name`, `amount`) VALUES
(1, 1, 'Examination', 0),
(2, 2, 'Tracksuit/Uniform', 0),
(3, 3, 'Hockey Stick', 0),
(4, 4, 'Computer Studies', 0),
(5, 5, 'Activity', 0),
(6, 6, 'Medical', 0),
(7, 7, 'Student Council', 0),
(8, 8, 'Rehabilitation', 0),
(9, 9, 'Caution', 0),
(10, 10, 'Personal Emolument Subsidity', 0),
(11, 11, 'Contingencies', 0),
(12, 12, 'Gratuity', 0),
(13, 13, 'Motors Vehicles Repairs', 0),
(14, 14, 'Repairs Improvement', 0),
(15, 15, 'Teaching Equipment', 0),
(16, 16, 'Local Transport & Travelling', 0),
(17, 17, 'Boarding', 0);

-- --------------------------------------------------------

--
-- Table structure for table `votehead2r`
--

CREATE TABLE `votehead2r` (
  `id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votehead2r`
--

INSERT INTO `votehead2r` (`id`, `num`, `name`, `amount`) VALUES
(1, 1, 'Examination', 0),
(2, 2, 'Tracksuit/Uniform', 0),
(3, 3, 'Hockey Stick', 0),
(4, 1, 'Computer Studies', 0),
(5, 2, 'Activity', 0),
(6, 3, 'Medical', 0),
(7, 4, 'Student Council', 0),
(8, 8, 'Rehabilitation', 0),
(9, 9, 'Caution', 0),
(10, 5, 'Personal Emolument Subsidity', 0),
(11, 6, 'Contingencies', 0),
(12, 7, 'Gratuity', 0),
(13, 8, 'Vehicle Replacement Fund', 0),
(14, 16, 'Repairs Improvement', 0),
(15, 10, 'Teaching Equipment', 0),
(16, 11, 'Local Transport & Travelling', 0),
(17, 14, 'Boarding', 0),
(18, 9, 'Teaching practice', 0),
(19, 12, 'Electricity Water and Conser', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic`
--
ALTER TABLE `academic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academicyear`
--
ALTER TABLE `academicyear`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allfeepayments`
--
ALTER TABLE `allfeepayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allpayments`
--
ALTER TABLE `allpayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allregister`
--
ALTER TABLE `allregister`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classteacherremarks`
--
ALTER TABLE `classteacherremarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classteachers`
--
ALTER TABLE `classteachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `developer`
--
ALTER TABLE `developer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exammarks`
--
ALTER TABLE `exammarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examptemarks`
--
ALTER TABLE `examptemarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenditure`
--
ALTER TABLE `expenditure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headteacherremarks`
--
ALTER TABLE `headteacherremarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headteachers`
--
ALTER TABLE `headteachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loginfinance`
--
ALTER TABLE `loginfinance`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `overallpositioning`
--
ALTER TABLE `overallpositioning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentdetails`
--
ALTER TABLE `paymentdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positioning`
--
ALTER TABLE `positioning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ptetotal`
--
ALTER TABLE `ptetotal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recycle`
--
ALTER TABLE `recycle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffpayment`
--
ALTER TABLE `staffpayment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `streams`
--
ALTER TABLE `streams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjectsassigned`
--
ALTER TABLE `subjectsassigned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacherremarks`
--
ALTER TABLE `teacherremarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votehead`
--
ALTER TABLE `votehead`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votehead1r`
--
ALTER TABLE `votehead1r`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votehead2r`
--
ALTER TABLE `votehead2r`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic`
--
ALTER TABLE `academic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `academicyear`
--
ALTER TABLE `academicyear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `allfeepayments`
--
ALTER TABLE `allfeepayments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `allpayments`
--
ALTER TABLE `allpayments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `allregister`
--
ALTER TABLE `allregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `classteacherremarks`
--
ALTER TABLE `classteacherremarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `classteachers`
--
ALTER TABLE `classteachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `developer`
--
ALTER TABLE `developer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exammarks`
--
ALTER TABLE `exammarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `examptemarks`
--
ALTER TABLE `examptemarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `expenditure`
--
ALTER TABLE `expenditure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `headteacherremarks`
--
ALTER TABLE `headteacherremarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `headteachers`
--
ALTER TABLE `headteachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `overallpositioning`
--
ALTER TABLE `overallpositioning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `paymentdetails`
--
ALTER TABLE `paymentdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `positioning`
--
ALTER TABLE `positioning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ptetotal`
--
ALTER TABLE `ptetotal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recycle`
--
ALTER TABLE `recycle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffpayment`
--
ALTER TABLE `staffpayment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `streams`
--
ALTER TABLE `streams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subjectsassigned`
--
ALTER TABLE `subjectsassigned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `teacherremarks`
--
ALTER TABLE `teacherremarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `votehead`
--
ALTER TABLE `votehead`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `votehead1r`
--
ALTER TABLE `votehead1r`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `votehead2r`
--
ALTER TABLE `votehead2r`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

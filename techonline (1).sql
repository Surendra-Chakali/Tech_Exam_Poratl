-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2021 at 01:38 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `fname` varchar(40) NOT NULL,
  `dept` char(10) NOT NULL,
  `passwrd` varchar(20) NOT NULL,
  `cpasswrd` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `name` varchar(30) NOT NULL,
  `feedback` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`name`, `feedback`) VALUES
('Anonymous', 'Greate work!'),
('Anonymous', 'V good'),
('Marshmallow', 'Good work'),
('Bhanu prasad', 'Excellent work'),
('praveen', 'good'),
('praveen', 'Good'),
('Lavanya', 'Awesome');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `quation` varchar(400) NOT NULL,
  `opt1` varchar(100) NOT NULL,
  `opt2` varchar(100) NOT NULL,
  `opt3` varchar(100) NOT NULL,
  `opt4` varchar(100) NOT NULL,
  `answer` varchar(1) NOT NULL,
  `subjectname` varchar(30) DEFAULT NULL,
  `sno` varchar(5) NOT NULL,
  `year` varchar(1) NOT NULL,
  `departname` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `questions1`
--

CREATE TABLE `questions1` (
  `quation` varchar(400) NOT NULL,
  `subjectname` varchar(40) NOT NULL,
  `sno` varchar(5) NOT NULL,
  `year` varchar(1) NOT NULL,
  `departname` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `rollnumber` varchar(10) NOT NULL,
  `stdname` varchar(30) NOT NULL,
  `score` varchar(30) DEFAULT NULL,
  `subject` varchar(50) NOT NULL,
  `year` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `result1`
--

CREATE TABLE `result1` (
  `rollnumber` varchar(10) NOT NULL,
  `sno` varchar(2) NOT NULL,
  `question` varchar(100) NOT NULL,
  `answer` varchar(170) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `year` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stdname` varchar(30) NOT NULL,
  `deptname` varchar(6) NOT NULL,
  `year` varchar(1) NOT NULL,
  `rollnum` varchar(10) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `cpwd` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

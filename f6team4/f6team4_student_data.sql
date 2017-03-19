-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 31, 2016 at 07:53 AM
-- Server version: 5.5.52-cll
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `f6team4_student_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `courselist`
--

CREATE TABLE IF NOT EXISTS `courselist` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `archive` tinyint(1) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `courselist`
--

INSERT INTO `courselist` (`id`, `name`, `course_id`, `archive`) VALUES
(100000016, 'asdf', 96, 0),
(100000016, 'History', 87, 1),
(100000015, 'COMP1007', 88, 0),
(100000015, 'asdf', 90, 1);

-- --------------------------------------------------------

--
-- Table structure for table `GradeFinal`
--

CREATE TABLE IF NOT EXISTS `GradeFinal` (
  `course_id` int(11) NOT NULL,
  `assignment1` int(3) DEFAULT NULL,
  `assignment2` int(3) DEFAULT NULL,
  `assignment3` int(3) DEFAULT NULL,
  `quiz` int(3) DEFAULT NULL,
  `midterm` int(3) DEFAULT NULL,
  `Exam` int(3) DEFAULT NULL,
  UNIQUE KEY `course_id` (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `GradeFinal`
--

INSERT INTO `GradeFinal` (`course_id`, `assignment1`, `assignment2`, `assignment3`, `quiz`, `midterm`, `Exam`) VALUES
(90, NULL, NULL, NULL, NULL, NULL, NULL),
(96, NULL, NULL, NULL, NULL, NULL, NULL),
(87, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 50, 30, NULL, NULL, NULL, 20);

-- --------------------------------------------------------

--
-- Table structure for table `GradeGoals`
--

CREATE TABLE IF NOT EXISTS `GradeGoals` (
  `course_id` int(11) NOT NULL,
  `assignment1` int(3) DEFAULT NULL,
  `assignment2` int(3) DEFAULT NULL,
  `assignment3` int(3) DEFAULT NULL,
  `quiz` int(3) DEFAULT NULL,
  `midterm` int(3) DEFAULT NULL,
  `Exam` int(3) DEFAULT NULL,
  UNIQUE KEY `course_id` (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `GradeGoals`
--

INSERT INTO `GradeGoals` (`course_id`, `assignment1`, `assignment2`, `assignment3`, `quiz`, `midterm`, `Exam`) VALUES
(90, 20, NULL, NULL, NULL, NULL, NULL),
(96, NULL, NULL, NULL, NULL, NULL, NULL),
(87, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 100, 100, NULL, NULL, NULL, 100);

-- --------------------------------------------------------

--
-- Table structure for table `GradeMaterials`
--

CREATE TABLE IF NOT EXISTS `GradeMaterials` (
  `course_id` int(11) NOT NULL,
  `assignment1` int(3) DEFAULT NULL,
  `assignment2` int(3) DEFAULT NULL,
  `assignment3` int(3) DEFAULT NULL,
  `quiz` int(3) DEFAULT NULL,
  `midterm` int(3) DEFAULT NULL,
  `exam` int(3) DEFAULT NULL,
  UNIQUE KEY `course_id` (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `GradeMaterials`
--

INSERT INTO `GradeMaterials` (`course_id`, `assignment1`, `assignment2`, `assignment3`, `quiz`, `midterm`, `exam`) VALUES
(88, 85, 85, NULL, NULL, NULL, NULL),
(96, NULL, NULL, NULL, NULL, NULL, NULL),
(90, NULL, NULL, NULL, NULL, NULL, NULL),
(87, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `GradeTrivials`
--

CREATE TABLE IF NOT EXISTS `GradeTrivials` (
  `course_id` int(11) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `KRating` int(1) DEFAULT NULL,
  `DRating` int(1) DEFAULT NULL,
  `CRating` int(1) DEFAULT NULL,
  `t_comment` varchar(500) DEFAULT NULL,
  `notes` varchar(2000) NOT NULL,
  UNIQUE KEY `course_id` (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `GradeTrivials`
--

INSERT INTO `GradeTrivials` (`course_id`, `name`, `KRating`, `DRating`, `CRating`, `t_comment`, `notes`) VALUES
(87, 'Jack Os', 5, 5, 5, 'Wears a funny hat					', ''),
(88, 'a', NULL, NULL, NULL, '					', ''),
(90, NULL, NULL, NULL, NULL, NULL, ''),
(96, NULL, NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `student_account`
--

CREATE TABLE IF NOT EXISTS `student_account` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `logged` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `first_name` (`first_name`),
  KEY `last_name` (`last_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100000082 ;

--
-- Dumping data for table `student_account`
--

INSERT INTO `student_account` (`id`, `username`, `password`, `first_name`, `last_name`, `logged`, `admin`) VALUES
(100000016, 'honda', 'honda', 'Michael', 'Power', '2016-12-21 20:40:05', 1),
(100000015, 'toann', 'toann', 'Toan', 'Nguyen', '2016-12-06 14:39:06', 1),
(100000080, 'jack', 'jack', 'jack', 'jack', '2016-12-06 14:44:47', 0),
(100000081, 'benblanc', 'password', 'Ben', 'Blanc', '2016-12-12 01:47:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_infomation`
--

CREATE TABLE IF NOT EXISTS `student_infomation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `stateorprovince` varchar(100) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `postal` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100000082 ;

--
-- Dumping data for table `student_infomation`
--

INSERT INTO `student_infomation` (`id`, `first_name`, `last_name`, `email`, `phone`, `country`, `city`, `stateorprovince`, `address`, `postal`) VALUES
(100000016, 'Michael', 'Power', 'asdf@hotmail.com', NULL, NULL, NULL, NULL, '90 green avenue', NULL),
(100000015, 'Toan', 'Nguyen', 'asdf@hotmail.com', NULL, NULL, NULL, NULL, '60 pape avenue', NULL),
(100000080, 'jack', 'jack', 'jack@hotmail.com', '4444444444', 'Bahrain', 'a', 'a', 'a', 'a'),
(100000081, 'Ben', 'Blanc', 'ben.blanc@georgebrown.ca', '1234567890', 'Canada', 'Toronto', 'Ontario', '123 Main St', 'M1P1A1');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `id` int(11) NOT NULL,
  `file_id` int(10) NOT NULL AUTO_INCREMENT,
  `file` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL,
  `size` int(11) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `file_id`, `file`, `type`, `size`) VALUES
(100000081, 36, '81941-1.jpg', 'image/jpeg', 309),
(100000016, 16, '68830-week-6-status-report.pdf', 'applicatio', 486),
(100000016, 35, '51393-comp1230-atklass-120616.rar', 'applicatio', 0),
(100000015, 33, '11643-test.rar', 'applicatio', 0),
(100000015, 31, '5801-test.txt', 'text/plain', 0),
(100000015, 32, '20254-test.txt', 'text/plain', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

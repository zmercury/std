-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2023 at 04:16 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `addedby` varchar(100) NOT NULL,
  `submissiondate` datetime NOT NULL,
  `curtime` datetime NOT NULL,
  `assignment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id`, `addedby`, `submissiondate`, `curtime`, `assignment`) VALUES
(10, 'bijumalla', '2023-08-11 00:00:00', '2023-08-09 20:09:01', 'Make a student management system using php, html and css and use mysql as database');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice-id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `notice-date` datetime NOT NULL,
  `notice-data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice-id`, `status`, `notice-date`, `notice-data`) VALUES
(5, '', '2023-08-08 09:33:16', 'this is an example notice'),
(6, '', '2023-08-08 09:48:25', 'this is an example notice'),
(7, '', '2023-08-08 09:48:33', 'this is an example notice'),
(8, '', '2023-08-08 10:26:07', 'this is an example notice'),
(9, 'important', '2023-08-08 10:31:29', 'This is an example of important notice which will appear on the dashboard! Only one of the recent important notice is displayed on the dashboard! '),
(10, 'basic', '2023-08-08 10:35:16', 'THis is an ordinary notice!'),
(11, 'important', '2023-08-08 10:36:48', 'This is an example of important notice which will appear on the dashboard! Only one of the recent important notice is displayed on the dashboard! <br> To add important notice you will need to select important status from the dropdown menu while submitting a notice! The basic notice will apprear on the notice page, not on the dashboard!');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `uid` int(100) NOT NULL,
  `symbolnum` int(55) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `phone` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`uid`, `symbolnum`, `fname`, `lname`, `email`, `dob`, `phone`) VALUES
(1, 233423, 'Nikhil', 'Bastola', 'nikhilbastola03@gmail.com', '2003-01-10', 9860009591),
(4, 214124, 'Badal Chamling', 'Rai', 'badalrai@gmail.com', '2004-01-23', 9802345333),
(5, 1241231, 'Sabin', 'Bom', 'sabinbom@gmail.com', '2002-02-12', 9804355489),
(6, 1231412, 'Suzan', 'Gurung', 'suzzangrg@gmail.com', '2001-03-04', 9854566745),
(7, 253423, 'Santosh', 'Bhandari', 'santubhan@gmail.com', '1999-03-05', 9854344277),
(8, 5837923, 'Yasod', 'Tamang', 'yasodtmng@yahoo.com', '2004-02-23', 9854588743),
(9, 235233, 'Aarpan', 'Ghimire', 'aarpanaarpan@hotmail.com', '2003-04-12', 9858432345),
(10, 523423, 'Abinash Chamling', 'Rai', 'abiabirai@outlook.com', '2004-05-23', 9858477563),
(11, 234252, 'Bibek', 'Ghimire', 'bbek1123@gmail.com', '2003-02-22', 9803844322),
(15, 234234, 'Sagar', 'Karki', 'sagarkarki@yahoo.com', '1996-03-23', 9805488344),
(16, 3463463, 'Prabesh', 'Shrestha', 'prabeshsta@gmail.com', '2002-01-24', 9805488233);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `uid` int(100) NOT NULL,
  `teachersid` int(55) NOT NULL,
  `subject` varchar(155) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `phone` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`uid`, `teachersid`, `subject`, `fname`, `lname`, `email`, `dob`, `phone`) VALUES
(1, 12312, 'Web Technology', 'bijaya', 'Malla', 'bijumalla@gmail.com', '1993-01-23', 9845443453),
(2, 12125123, 'Computer Architecture & Organization', 'Suresh ', 'Diyal', 'sureshdiyal@gmail.com', '1979-02-23', 9894922453),
(4, 1241412, '21st Century Skills', 'Govinda', 'Neupane', 'neupanegovinda12@gmail.com', '1987-12-23', 9806544344);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `role` varchar(55) NOT NULL,
  `fname` varchar(55) NOT NULL,
  `lname` varchar(55) NOT NULL,
  `uname` varchar(55) NOT NULL,
  `email` varchar(100) NOT NULL,
  `upass` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `role`, `fname`, `lname`, `uname`, `email`, `upass`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'admin@admin.com', 'admin'),
(3, 'student', 'Nikhil', 'Bastola', 'nikhilbastola', 'nikhilbastola@gmail.com', 'nikhil123'),
(6, 'teacher', 'Biju', 'Malla', 'bijumalla', 'biju@gmail.com', 'biju123'),
(8, 'student', 'badal', 'rai', 'badalrai', 'badal@gmail.com', 'badal123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice-id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice-id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `uid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `uid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

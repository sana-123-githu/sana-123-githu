-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2024 at 04:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `complainreg`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `name` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `phno` int(12) NOT NULL,
  `complaint_type` varchar(25) NOT NULL,
  `date` date NOT NULL,
  `complaint_detail` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `suspect_name` varchar(30) NOT NULL,
  `details` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `officerid` varchar(30) NOT NULL,
  `complaint_id` int(10) NOT NULL,
  `voice` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`name`, `dob`, `address`, `phno`, `complaint_type`, `date`, `complaint_detail`, `photo`, `suspect_name`, `details`, `email`, `status`, `officerid`, `complaint_id`, `voice`) VALUES
('shaharban', '2004-03-24', ' asdfsdfasdsd', 12345678, 'Blackmail', '2024-09-19', 'bdfvdjvlfvdv', 'Screenshot 2024-09-19 152910.png', 'THUFAIL PB', 'asdfghjkl;', 'nafeesathshaharban@gmail.com', 'pending', '3', 33, 'uploads/audio/66ebf76d58fb7.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `usertype` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`email`, `password`, `usertype`) VALUES
('fdghjk@gkn', 'asd', 1),
('admin@gmail.com', 'admincreg', 2),
('nafeesathshaharban@gmail.com', '9526917338', 0),
('qbc@gmail.com', '12345678', 0),
('sana@gmail.com', '12365449', 0),
('nafeesathshaharban@gmail.com', '12345678', 0),
('shahar@gmail.com', 'asdewq', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `complaint_id` int(11) DEFAULT NULL,
  `sender_type` enum('user','officer') DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `complaint_id`, `sender_type`, `sender_id`, `message`, `timestamp`) VALUES
(5, 0, 'user', 28, 'enthayiii', '2024-09-19 14:40:37'),
(7, 0, 'officer', 28, 'ekka set annu', '2024-09-19 14:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `officer`
--

CREATE TABLE `officer` (
  `officerid` int(20) NOT NULL,
  `position` varchar(30) NOT NULL,
  `phonenum` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `name` varchar(30) NOT NULL,
  `passwordoff` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `officer`
--

INSERT INTO `officer` (`officerid`, `position`, `phonenum`, `dob`, `name`, `passwordoff`, `email`) VALUES
(3, 'si', '23456789', '2006-05-20', 'shaharrr', 'asd', 'fdghjk@gkn');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(70) NOT NULL,
  `phno` int(12) NOT NULL,
  `password` varchar(30) NOT NULL,
  `usid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `dob`, `address`, `phno`, `password`, `usid`) VALUES
('shaharban', 'nafeesathshaharban@gmail.com', '2004-03-24', 'karimattom h kummanode pattimattom po', 2147483647, '9526917338', 28),
('mjjhg', 'qbc@gmail.com', '5262-05-25', 'asdfgf', 12345678, '12345678', 29),
('sana', 'sana@gmail.com', '2002-02-12', 'asdfghj', 12365449, '12365449', 30),
('shaharban', 'nafeesathshaharban@gmail.com', '2004-03-24', ' asdfsdfasdsd', 12345678, '12345678', 31);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officer`
--
ALTER TABLE `officer`
  ADD PRIMARY KEY (`officerid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `officer`
--
ALTER TABLE `officer`
  MODIFY `officerid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

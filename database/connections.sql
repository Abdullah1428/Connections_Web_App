-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2020 at 09:24 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connections`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `mID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  `recieverID` int(10) NOT NULL,
  `senderName` varchar(30) NOT NULL,
  `recieverName` varchar(30) NOT NULL,
  `senderEmail` varchar(30) NOT NULL,
  `recieverEmail` varchar(30) NOT NULL,
  `message` varchar(50) DEFAULT NULL,
  `senderImage` varchar(30) NOT NULL,
  `recieverImage` varchar(30) NOT NULL,
  `timeStamp` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`mID`, `senderID`, `recieverID`, `senderName`, `recieverName`, `senderEmail`, `recieverEmail`, `message`, `senderImage`, `recieverImage`, `timeStamp`) VALUES
(14, 1, 2, 'Abdullah', 'Najeeb', 'abdullahcse1428@gmail.com', 'najeeb@khan.com', 'sangae najeeb', 'myimg.jpg', 's3 bucket.png', '2020-06-30'),
(15, 1, 3, 'Abdullah', 'jamshid', 'abdullahcse1428@gmail.com', 'bacha@jam.com', 'bacha ta sangae', 'myimg.jpg', 'smartHomeIot.png', '2020-06-30'),
(16, 1, 2, 'Abdullah', 'Najeeb', 'abdullahcse1428@gmail.com', 'najeeb@khan.com', 'najeeb assignment done finally!', 'myimg.jpg', 's3 bucket.png', '2020-06-30'),
(17, 2, 1, 'Najeeb', 'Abdullah', 'najeeb@khan.com', 'abdullahcse1428@gmail.com', 'kher de yar ta waya', 's3 bucket.png', 'myimg.jpg', '2020-06-30'),
(18, 4, 1, 'Usman', 'Abdullah', 'Usman@syed.com', 'abdullahcse1428@gmail.com', 'Hello Abdullah ', 'icon.png', 'myimg.jpg', '2020-06-30'),
(19, 5, 1, 'Aashir', 'Abdullah', 'aashir@gmail.com', 'abdullahcse1428@gmail.com', 'hello abdullah how are you', 'smart_home.jpg', 'myimg.jpg', '2020-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(10) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(30) NOT NULL,
  `userPassword` varchar(30) NOT NULL,
  `userImage` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userName`, `userEmail`, `userPassword`, `userImage`) VALUES
(1, 'Abdullah', 'abdullahcse1428@gmail.com', '1234567', 'myimg.jpg'),
(2, 'Najeeb', 'najeeb@khan.com', '1231231', 's3 bucket.png'),
(3, 'jamshid', 'bacha@jam.com', '1234512', 'smartHomeIot.png'),
(4, 'Usman', 'Usman@syed.com', '1234567', 'icon.png'),
(5, 'Aashir', 'aashir@gmail.com', '1234567', 'smart_home.jpg'),
(6, 'Aiman', 'aiman@abid.com', '000999', 'aiman.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`mID`),
  ADD KEY `senderID` (`senderID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `mID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

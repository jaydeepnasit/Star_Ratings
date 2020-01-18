-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2020 at 10:14 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rating`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `b_id` int(11) NOT NULL,
  `b_title` varchar(200) NOT NULL,
  `b_text` text NOT NULL,
  `b_uni_no` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`b_id`, `b_title`, `b_text`, `b_uni_no`) VALUES
(1, 'Blog Title 1', 'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 617170153473524),
(2, 'Blog Title 2', 'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 217170153473524),
(3, 'Blog Title 3', 'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 107170153473524),
(4, 'Blog Title 4', 'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 207170153473524),
(5, 'Blog Title 5', 'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 777170153473524),
(6, 'Blog Title 6', 'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 557170153473524),
(7, 'Blog Title 7', 'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 447170153473524),
(8, 'Blog Title 8', 'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 367170153473524),
(9, 'Blog Title 9', 'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 227170153473524),
(10, 'Blog Title 10', 'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 117170153473524),
(11, 'Blog Title 11', 'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 337170153473524),
(12, 'Blog Title 12', 'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 147170153473524);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_image` varchar(200) NOT NULL,
  `u_name` varchar(200) NOT NULL,
  `u_pass` varchar(200) NOT NULL,
  `u_uni_no` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_image`, `u_name`, `u_pass`, `u_uni_no`) VALUES
(1, 'user1.png', 'user1', '12345678', 328759437979450),
(2, 'user2.png', 'user2', '12345678', 185472960356631),
(3, 'user3.png', 'user3', '12345678', 385019877605097),
(4, 'user4.png', 'user4', '12345678', 127718463219333),
(5, 'user5.png', 'user5', '12345678', 999761133054490),
(6, 'user6.png', 'user6', '12345678', 422328655574284),
(7, 'user7.png', 'user7', '12345678', 822577585054926),
(8, 'user8.png', 'user8', '12345678', 280479578480934),
(9, 'user9.png', 'user9', '12345678', 698460598171496),
(10, 'user10.png', 'user10', '12345678', 869287089555991);

-- --------------------------------------------------------

--
-- Table structure for table `user_rating`
--

CREATE TABLE `user_rating` (
  `ur_id` int(11) NOT NULL,
  `ur_u_uni_no` bigint(20) NOT NULL,
  `ur_b_uni_no` bigint(20) NOT NULL,
  `ur_score` int(11) NOT NULL DEFAULT 0,
  `ur_uni_no` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`b_id`),
  ADD UNIQUE KEY `b_uni_no` (`b_uni_no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_uni_no` (`u_uni_no`);

--
-- Indexes for table `user_rating`
--
ALTER TABLE `user_rating`
  ADD PRIMARY KEY (`ur_id`),
  ADD UNIQUE KEY `ur_uni_no` (`ur_uni_no`),
  ADD KEY `ur_u_uni_no` (`ur_u_uni_no`),
  ADD KEY `ur_b_uni_no` (`ur_b_uni_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_rating`
--
ALTER TABLE `user_rating`
  MODIFY `ur_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_rating`
--
ALTER TABLE `user_rating`
  ADD CONSTRAINT `user_rating_ibfk_1` FOREIGN KEY (`ur_u_uni_no`) REFERENCES `user` (`u_uni_no`),
  ADD CONSTRAINT `user_rating_ibfk_2` FOREIGN KEY (`ur_b_uni_no`) REFERENCES `blogs` (`b_uni_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

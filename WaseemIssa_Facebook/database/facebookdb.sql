-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2021 at 06:08 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facebookdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `text` text NOT NULL,
  `is_opened` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `created_by`, `text`, `is_opened`) VALUES
(76, 4, 3, 'Doumouh Dirani accepted your friend request', 0),
(80, 1, 3, 'Doumouh Dirani accepted your friend request', 0),
(81, 4, 1, 'Waseem Issa sent you a friend request', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `profile_picture_url` text NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `profile_picture_url`, `date_of_birth`, `email`, `password`) VALUES
(1, 'Waseem', 'Issa', 'profile_pic.png', '1998-09-08', 'waseem.issa88@gmail.com', 'e4bf34be6eb217c2dac47381f4379561ca5d8439982162b32dcb5b203e214022'),
(2, 'Issam', 'Khalil', 'profile_pic.png', '2000-08-09', 'issam@gmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225'),
(3, 'Doumouh', 'Dirani', 'profile_pic.png', '1994-09-29', 'doumouh@gmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225'),
(4, 'Jaafar', 'Shehadi', 'profile_pic.png', '1998-08-09', 'jaafar.shehadi22@gmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225'),
(5, 'Nathalie', 'Ammoun', 'profile_pic.png', '1998-08-10', 'nathalie@gmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225'),
(6, 'Zeinab', 'Fawez', 'profile_pic.png', '2000-12-12', 'zeinab@gmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225');

-- --------------------------------------------------------

--
-- Table structure for table `users_block_users`
--

CREATE TABLE `users_block_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blocked_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_follow_users`
--

CREATE TABLE `users_follow_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_follow_users`
--

INSERT INTO `users_follow_users` (`id`, `user_id`, `friend_id`) VALUES
(56, 3, 4),
(57, 4, 3),
(60, 3, 1),
(61, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users_send_requests_users`
--

CREATE TABLE `users_send_requests_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `another_user_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_send_requests_users`
--

INSERT INTO `users_send_requests_users` (`id`, `user_id`, `another_user_id`, `status`) VALUES
(47, 4, 3, 'accepted'),
(50, 1, 3, 'accepted'),
(51, 1, 4, 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_block_users`
--
ALTER TABLE `users_block_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_follow_users`
--
ALTER TABLE `users_follow_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_send_requests_users`
--
ALTER TABLE `users_send_requests_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_block_users`
--
ALTER TABLE `users_block_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_follow_users`
--
ALTER TABLE `users_follow_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users_send_requests_users`
--
ALTER TABLE `users_send_requests_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

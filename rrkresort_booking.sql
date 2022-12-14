-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2022 at 04:06 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rrkresort_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `mt_image_uploads`
--

CREATE TABLE `mt_image_uploads` (
  `img_upload_id` int(55) NOT NULL,
  `room_id` int(11) NOT NULL DEFAULT 0,
  `file_name` text DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `abs_file_path` text DEFAULT NULL,
  `file_org_name` varchar(255) DEFAULT NULL,
  `file_size` varchar(255) DEFAULT NULL,
  `file_ext` varchar(255) DEFAULT NULL,
  `dtime` datetime DEFAULT NULL,
  `added_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mt_image_uploads`
--

INSERT INTO `mt_image_uploads` (`img_upload_id`, `room_id`, `file_name`, `file_path`, `file_type`, `abs_file_path`, `file_org_name`, `file_size`, `file_ext`, `dtime`, `added_by`) VALUES
(2, 13, 'yhtyht', 'ytjdbv.jpg', NULL, NULL, NULL, NULL, NULL, '2022-01-27 06:11:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mt_room`
--

CREATE TABLE `mt_room` (
  `room_id` int(55) NOT NULL,
  `room_name` varchar(255) DEFAULT NULL,
  `room_desc` text DEFAULT NULL,
  `bed_type` varchar(255) DEFAULT NULL,
  `room_view_type` varchar(255) DEFAULT NULL,
  `amenities` text DEFAULT NULL,
  `max_room_capacity` int(11) NOT NULL DEFAULT 0,
  `with_breakfast` enum('yes','no') NOT NULL,
  `total_adults` int(11) NOT NULL DEFAULT 0,
  `total_kids` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `added_dtime` datetime DEFAULT NULL,
  `edited_by` int(11) NOT NULL DEFAULT 0,
  `edited_dtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mt_room`
--

INSERT INTO `mt_room` (`room_id`, `room_name`, `room_desc`, `bed_type`, `room_view_type`, `amenities`, `max_room_capacity`, `with_breakfast`, `total_adults`, `total_kids`, `status`, `added_by`, `added_dtime`, `edited_by`, `edited_dtime`) VALUES
(13, 'test room', 'test', 'king', 'river', 'test, test2', 3, 'yes', 2, 1, 1, 1, '2021-09-16 23:05:29', 1, '2022-01-27 14:56:38'),
(15, 'scsc', 'wewe', 'king', 'sdfs', 'wer test', 3, 'no', 3, 0, 1, 1, '2022-01-27 09:57:44', 1, '2022-01-27 15:08:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_availability`
--

CREATE TABLE `tbl_availability` (
  `avl_id` int(55) NOT NULL,
  `room_id` int(11) NOT NULL DEFAULT 0,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `discount_percentage` double(10,2) NOT NULL DEFAULT 0.00,
  `actual_rate` double(10,2) NOT NULL DEFAULT 0.00,
  `discounted_rate` double(10,2) NOT NULL DEFAULT 0.00,
  `dtime` datetime DEFAULT NULL,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=available, 2= not available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_availability`
--

INSERT INTO `tbl_availability` (`avl_id`, `room_id`, `from_date`, `to_date`, `discount_percentage`, `actual_rate`, `discounted_rate`, `dtime`, `added_by`, `status`) VALUES
(2, 13, '2022-01-27', '2022-01-31', 5.00, 390.00, 300.00, '2022-01-27 08:51:21', 1, 1),
(6, 15, '2022-01-26', '2022-01-26', 0.00, 44444.00, 1111.00, '2022-01-27 14:45:30', 1, 1),
(8, 15, '2022-01-27', '2022-01-31', 12.00, 3000.00, 2640.00, '2022-01-27 18:03:30', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_bookings`
--

CREATE TABLE `tbl_room_bookings` (
  `booking_id` int(55) NOT NULL,
  `room_id` int(11) NOT NULL DEFAULT 0,
  `amount` double(10,2) NOT NULL DEFAULT 0.00,
  `booking_date` date DEFAULT NULL,
  `booking_end_date` date DEFAULT NULL,
  `payment_id` text DEFAULT NULL,
  `payment_status` int(11) NOT NULL,
  `dtime` datetime DEFAULT NULL,
  `added_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(55) NOT NULL,
  `user_group` int(11) NOT NULL DEFAULT 0,
  `full_name` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `twofa_enabled` int(11) NOT NULL DEFAULT 0,
  `twofa_secret` varchar(255) DEFAULT NULL,
  `dtime` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `last_login` varchar(255) DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  `last_logout` varchar(255) DEFAULT NULL,
  `last_updated` varchar(255) DEFAULT NULL,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `user_blocked` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_group`, `full_name`, `user_name`, `pass`, `twofa_enabled`, `twofa_secret`, `dtime`, `created_by`, `last_login`, `last_login_ip`, `last_logout`, `last_updated`, `updated_by`, `user_blocked`) VALUES
(1, 1, 'Snigdho Upadhyay', 'admin@gmail.com', 'yHbKO56SIL5myftosVG/qw==', 0, NULL, '2020-04-30 11:44:10', 1, '2022-01-29 09:25:21', '::1', '2022-01-28 16:42:36', '2021-08-27 18:09:39', 1, 0),
(24, 1, 'Test User', 'testuser1@gmail.com', '05033N4tHKkuEwWKK0iLbQ==', 0, NULL, '2021-08-27 16:09:34', 1, NULL, NULL, NULL, '2021-09-16 23:23:25', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mt_image_uploads`
--
ALTER TABLE `mt_image_uploads`
  ADD PRIMARY KEY (`img_upload_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `mt_room`
--
ALTER TABLE `mt_room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `room_name` (`room_name`);

--
-- Indexes for table `tbl_availability`
--
ALTER TABLE `tbl_availability`
  ADD PRIMARY KEY (`avl_id`);

--
-- Indexes for table `tbl_room_bookings`
--
ALTER TABLE `tbl_room_bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `room_id` (`room_id`,`booking_date`,`booking_end_date`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mt_image_uploads`
--
ALTER TABLE `mt_image_uploads`
  MODIFY `img_upload_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mt_room`
--
ALTER TABLE `mt_room`
  MODIFY `room_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_availability`
--
ALTER TABLE `tbl_availability`
  MODIFY `avl_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_room_bookings`
--
ALTER TABLE `tbl_room_bookings`
  MODIFY `booking_id` int(55) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

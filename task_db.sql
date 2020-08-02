-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2020 at 09:13 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins_list_tbl`
--

CREATE TABLE `admins_list_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins_list_tbl`
--

INSERT INTO `admins_list_tbl` (`id`, `name`, `email`, `mobile_no`, `created_at`, `updated_at`) VALUES
(1, 'Admin1', 'admin1@gmail.com', '8888899999', '2020-08-02 17:03:24', '2020-08-02 17:03:24'),
(2, 'Admin2', 'admin2@gmail.com', '7777788888', '2020-08-02 17:03:24', '2020-08-02 17:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `country_list_tbl`
--

CREATE TABLE `country_list_tbl` (
  `id` int(11) NOT NULL,
  `country_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country_list_tbl`
--

INSERT INTO `country_list_tbl` (`id`, `country_name`, `created_at`, `updated_at`) VALUES
(1, 'India', '2020-08-02 09:16:04', '2020-08-02 09:16:04'),
(2, 'Japan', '2020-08-02 09:16:04', '2020-08-02 09:16:04'),
(3, 'Canada', '2020-08-02 09:16:04', '2020-08-02 09:16:04'),
(4, 'Italy', '2020-08-02 09:16:04', '2020-08-02 09:16:04');

-- --------------------------------------------------------

--
-- Table structure for table `customers_list_tbl`
--

CREATE TABLE `customers_list_tbl` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins_list_tbl`
--
ALTER TABLE `admins_list_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_list_tbl`
--
ALTER TABLE `country_list_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers_list_tbl`
--
ALTER TABLE `customers_list_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins_list_tbl`
--
ALTER TABLE `admins_list_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `country_list_tbl`
--
ALTER TABLE `country_list_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers_list_tbl`
--
ALTER TABLE `customers_list_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

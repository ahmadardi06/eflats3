-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2019 at 10:27 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eflats`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `extension` int(4) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=deactive,1=active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `username`, `first_name`, `last_name`, `extension`, `password`, `phonenumber`, `email`, `address`, `active`) VALUES
(1, 'john@yopmail.com', 'John ', 'Deo', 1234, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, 1),
(2, 'David@yopmail.com', 'Devid', 'Backhem', 8765, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, 1),
(3, 'msluccy', 'Ms', 'Luccy', 7654, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, 1),
(4, '6212', 'test', 'test', 4622, '05a671c66aefea124cc08b76ea6d30bb', NULL, NULL, NULL, 1),
(5, 'Prince', 'Prince', 'Virk', 7878, '408510cdb8555d877990f70f02286843', NULL, NULL, NULL, 1),
(6, 'ardiansyah3ber', 'Ahmad', 'Ardiansyah', 6, 'be20ec6ed8731979e1fb58ea325a05c5', '082334093822', 'ahmad.ardi06@gmail.com', 'Jl. Smapal No.46 Lengkong Gudang BSD Serpong Tangerang Selatan', 1),
(8, 'ardiansyah3ber@gmail.com', 'Ahmad', 'Ardiansyah', 676, '', '082334093822', 'ardiansyah3ber@gmail.com', 'Jl. Smapal No.46 Lengkong Gudang, Serpong, Tangerang Selatan.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `log_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `log_ip` varchar(255) DEFAULT NULL,
  `log_details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `log_time`, `log_ip`, `log_details`) VALUES
(1, '2017-11-05 08:09:46', '::1', 'customer Regist'),
(2, '2017-11-05 08:11:37', '::1', 'Admin Login'),
(3, '2017-11-05 08:12:52', '::1', 'customer Login'),
(4, '2017-11-05 08:15:33', '::1', 'Add New Booking'),
(5, '2017-11-05 08:17:18', '::1', 'Admin Login'),
(6, '2017-11-05 08:18:28', '::1', 'customer Login'),
(7, '2017-11-05 08:18:52', '::1', 'Admin Login'),
(8, '2017-11-05 08:21:13', '::1', 'Admin Login'),
(9, '2017-11-05 09:04:02', '::1', 'Delete rooms'),
(10, '2017-11-05 09:06:12', '::1', 'customer Login'),
(11, '2017-11-05 09:08:31', '::1', 'Add New Booking'),
(12, '2017-11-05 09:08:52', '::1', 'Add New Booking'),
(13, '2017-11-05 09:09:42', '::1', 'Add New Booking'),
(14, '2017-11-05 09:18:33', '::1', 'Add New Booking'),
(15, '2017-11-05 09:22:03', '::1', 'Admin Login'),
(16, '2017-11-05 09:22:58', '::1', 'Delete rooms'),
(17, '2019-09-15 11:22:16', '::1', 'Admin Login'),
(18, '2019-09-15 17:42:35', '::1', 'Admin Login'),
(19, '2019-09-16 10:19:49', '::1', 'Admin Login'),
(20, '2019-09-16 10:40:26', '::1', 'Admin Login'),
(21, '2019-09-16 13:56:13', '::1', 'Admin Login'),
(22, '2019-09-16 15:11:25', '::1', 'Admin Login'),
(23, '2019-09-16 15:13:00', '::1', 'Admin Login'),
(24, '2019-09-16 15:15:29', '::1', 'Admin Login'),
(25, '2019-09-16 17:00:09', '::1', 'Admin Login'),
(26, '2019-09-16 18:32:12', '::1', 'Admin Login'),
(27, '2019-09-16 18:42:55', '::1', 'Admin Login'),
(28, '2019-09-17 02:57:42', '::1', 'Admin Login'),
(29, '2019-09-17 03:37:04', '::1', 'Admin Login'),
(30, '2019-09-17 03:39:47', '::1', 'Admin Login'),
(31, '2019-09-17 13:17:09', '::1', 'Admin Login'),
(32, '2019-09-17 13:31:32', '::1', 'customer Regist'),
(33, '2019-09-17 13:31:39', '::1', 'customer Login'),
(34, '2019-09-17 15:52:12', '::1', 'Admin Login'),
(35, '2019-09-17 15:54:23', '::1', 'Admin Login'),
(36, '2019-09-17 16:02:50', '::1', 'Admin Login'),
(37, '2019-09-17 16:03:57', '::1', 'customer Login'),
(38, '2019-09-17 16:14:33', '::1', 'customer Login'),
(39, '2019-09-17 16:39:00', '::1', 'Admin Login'),
(40, '2019-09-20 14:53:07', '::1', 'Admin Login'),
(41, '2019-09-20 16:56:01', '::1', 'Admin Login'),
(42, '2019-09-20 17:08:41', '::1', 'customer Login'),
(43, '2019-09-21 15:07:13', '127.0.0.1', 'Admin Login'),
(44, '2019-09-21 16:26:28', '127.0.0.1', 'Admin Login'),
(45, '2019-09-21 16:39:26', '127.0.0.1', 'Admin Login'),
(46, '2019-09-21 16:42:45', '127.0.0.1', 'Customer ID 1 Login'),
(47, '2019-09-21 16:51:15', '::1', 'Admin Login'),
(48, '2019-09-21 17:02:37', '::1', 'New Customer Created'),
(49, '2019-09-21 17:02:47', '::1', 'Customer ID 6 Login'),
(50, '2019-09-22 02:29:54', '::1', 'User customer ID 6 Updated'),
(51, '2019-09-22 02:35:58', '::1', 'User customer ID 6 Update Password'),
(52, '2019-09-22 02:40:15', '::1', 'Customer ID 6 Login'),
(53, '2019-09-22 04:08:01', '::1', 'Admin Login'),
(54, '2019-09-22 04:19:12', '::1', 'User Customer 6 Add Favorite 16'),
(55, '2019-09-22 04:23:41', '::1', 'User Customer 6 Add Favorite 21'),
(56, '2019-09-22 04:23:43', '::1', 'User Customer 6 Add Favorite 16'),
(57, '2019-09-22 04:32:51', '::1', 'Customer ID 6 Login'),
(58, '2019-09-22 04:35:38', '::1', 'Admin Login'),
(59, '2019-09-22 05:25:29', '::1', 'User  ID 6 Create New Property'),
(60, '2019-09-22 05:32:47', '::1', 'User  ID 6 Create New Property'),
(61, '2019-09-22 05:47:53', '::1', 'User  ID 6 Update Property'),
(62, '2019-09-22 05:49:37', '::1', 'User  ID 6 Update Property'),
(63, '2019-09-22 05:52:47', '::1', 'User  ID 6 Create New Property'),
(64, '2019-09-22 06:31:22', '::1', 'User Customer 6 Add Favorite 23'),
(65, '2019-09-22 06:39:19', '::1', 'User Customer  Add Favorite 16'),
(66, '2019-09-22 06:41:57', '::1', 'Admin Login'),
(67, '2019-09-22 07:28:49', '::1', 'New Customer Created'),
(68, '2019-09-22 07:35:01', '::1', 'Customer ID 7 Login'),
(69, '2019-09-22 08:10:50', '::1', 'Customer ID 6 Login'),
(70, '2019-09-22 10:13:52', '::1', 'User customer ID 8 Updated'),
(71, '2019-09-22 10:14:31', '::1', 'User customer ID 8 Updated'),
(72, '2019-09-22 10:15:35', '::1', 'Admin Login'),
(73, '2019-09-22 10:24:25', '::1', 'Customer ID 6 Login'),
(74, '2019-09-22 10:26:20', '::1', 'User customer ID 6 Create New Property');

-- --------------------------------------------------------

--
-- Table structure for table `photogallery`
--

CREATE TABLE `photogallery` (
  `idGallery` int(11) NOT NULL,
  `titleGallery` longtext NOT NULL,
  `descGallery` longtext NOT NULL,
  `imgFullNameGallery` longtext NOT NULL,
  `orderGallery` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photogallery`
--

INSERT INTO `photogallery` (`idGallery`, `titleGallery`, `descGallery`, `imgFullNameGallery`, `orderGallery`) VALUES
(2, 'Very Nice House Located In South Perth.', 'here its description', 'new-iamge.5d789718adc976.03233005.jpg', '2'),
(3, 'three houses on beach ', 'These are three houses are right at a beach. ', 'three-images-.5d78e39e32a939.61896710.jpg', '3'),
(4, 'Affordable ', 'There are three house right near casino.', 'new-house.5d78f0ec46ed43.02041969.jpg', '4'),
(5, 'new house', 'This hosue is available for leasing', 'again-new-house-.5d78f507149734.53783286.jpg', '5');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `property_title` varchar(255) NOT NULL,
  `main_image` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `size` int(30) NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `owner_phone` varchar(15) NOT NULL,
  `owner_email` varchar(100) NOT NULL,
  `bedroom` varchar(50) NOT NULL,
  `bathroom` varchar(50) NOT NULL,
  `furnished` varchar(20) NOT NULL,
  `pet_friendly` varchar(20) NOT NULL,
  `author_id` int(11) NOT NULL,
  `level` enum('admin','customer') NOT NULL DEFAULT 'admin',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=created,1=confirm,2=publish'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `property_title`, `main_image`, `address`, `description`, `price`, `size`, `owner_name`, `owner_phone`, `owner_email`, `bedroom`, `bathroom`, `furnished`, `pet_friendly`, `author_id`, `level`, `status`) VALUES
(16, 'Best house', 'download.jpg', 'beach houes road, BHR', 'This Flat in good Condition .It Has Two bed Room and Gas Connection available in this room.', '10000', 1500, 'VJ', '042878782', 'vj@vj.com', '3', '1', 'Yes', 'Yes', 1, 'admin', 2),
(18, 'test1', 'download.jpg', '', 'Good Experience detail', '1088', 500, 'VJ', '2147483647', 'vj@gmail.com', '4 Bedrooms', '2 Bathrooms', 'No', 'Yes', 1, 'admin', 0),
(19, 'test', 'house1.jpg', 'Address1', 'best house that you can find. ', '10', 100, 'Amrit', '12404139994', 'amrit@gmail.com', '1', '1', 'Yes', 'Yes', 1, 'admin', 0),
(20, 'test', 'house2.jpg', '11', 'great house', '1250', 11, 'VJ', '1', '23@gmail.com', '1', '1', 'No', 'Yes', 1, 'admin', 0),
(21, 'Tree house', 'tree house.jpg', 'tree', 'its on a tree with a swimming pool connected', '540', 450, 'Amrit', '9939393944', 'amrit@amrit.com', '2', '0', 'Yes', 'Yes', 1, 'admin', 2),
(23, 'Ardiansyah Property', 'house2.jpg', 'Address Property', 'Description property', '3000', 150, 'Ahmad Ardiansyah', '082334093822', 'ardiansyah3ber@gmail.com', '3', '2', 'Yes', 'Yes', 6, 'customer', 2),
(25, 'Ahmad Property', '20190922102620-photo-galleryagain-new-house-.5d78f507149734.53783286.jpg', 'Jl. Smapal No.46 Lengkong Gudang, Serpong, Tangerang Selatan', 'Deskripsi Property Ahmad Ardiansyah, Great Property.', '4500', 120, 'Ahmad Ardiansyah', '082334093822', 'ardiansyah3ber@gmail.com', '4', '2', 'No', 'Yes', 6, 'customer', 2);

-- --------------------------------------------------------

--
-- Table structure for table `properties_images`
--

CREATE TABLE `properties_images` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties_images`
--

INSERT INTO `properties_images` (`id`, `property_id`, `image`) VALUES
(1, 10, 'Hydrangeas.jpg'),
(2, 10, 'Jellyfish.jpg'),
(3, 10, 'Koala.jpg'),
(4, 11, 'Koala.jpg'),
(5, 11, 'Lighthouse.jpg'),
(6, 12, 'slider1.jpg'),
(7, 12, 'slider2.jpg'),
(8, 16, 'download (1).jpg'),
(9, 16, 'download (2).jpg'),
(10, 16, 'download.jpg'),
(11, 17, 'photo-gallerynew-iamge.5d789718adc976.03233005.jpg'),
(12, 17, 'photo-gallerynew-image.5d7b4229235780.27822955.jpg'),
(13, 17, 'photo-gallerythree-images-.5d78e39e32a939.61896710.jpg'),
(14, 18, 'photo-gallerynew-iamge.5d789718adc976.03233005.jpg'),
(15, 18, 'photo-gallerynew-image.5d7b4229235780.27822955.jpg'),
(16, 18, 'photo-gallerythree-images-.5d78e39e32a939.61896710.jpg'),
(17, 16, 'house2.jpg'),
(18, 16, 'house3.jpg'),
(19, 21, 'inside tree house.jpg'),
(20, 20, 'tree house.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `photogallery`
--
ALTER TABLE `photogallery`
  ADD PRIMARY KEY (`idGallery`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties_images`
--
ALTER TABLE `properties_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `photogallery`
--
ALTER TABLE `photogallery`
  MODIFY `idGallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `properties_images`
--
ALTER TABLE `properties_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

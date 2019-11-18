-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2019 at 06:38 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dilgbula_dilg_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `password` varchar(32) NOT NULL,
  `firstname` varchar(11) NOT NULL,
  `middlename` varchar(11) NOT NULL,
  `lastname` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `email`) VALUES
(1, 'darwin', '25d55ad283aa400af464c76d713c07ad', 'Darwin', 'a', 'David', 'darwin@gmail.com'),
(2, 'dilg', '25d55ad283aa400af464c76d713c07ad', 'Intern', '', 'Ojt', 'cynicx12@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `announcement_admin`
--

CREATE TABLE `announcement_admin` (
  `id` int(50) NOT NULL,
  `type` varchar(1000) NOT NULL,
  `title` varchar(3000) NOT NULL,
  `content` varchar(3000) NOT NULL,
  `image` varchar(32) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement_admin`
--

INSERT INTO `announcement_admin` (`id`, `type`, `title`, `content`, `image`, `time_created`) VALUES
(4, 'Announcement', 'Manila Bay Cleanup', 'All LGUs are required to participate on this activity.', '20190309_170340.jpg', '2019-03-20 11:23:13'),
(7, 'Announcement', 'Election 2019', 'To ALL LGUs. Please be ready for the upcoming midterm national and local election.', '0120Sinulog01.jpg', '2019-03-22 12:25:08'),
(8, 'Events', 'Election 2019', 'Election 2019', 'My New App.accdb', '2019-03-22 12:25:44'),
(9, 'Announcement', 'hi', 'hello', '51355wide.jpg', '2019-03-22 12:26:43'),
(10, 'Announcement', 'test', 'test', 'chip_grid_background_black_green', '2019-04-11 10:24:31'),
(11, 'Announcement', 'test2', 'test2', 'images.jpg', '2019-04-11 10:29:55');

-- --------------------------------------------------------

--
-- Table structure for table `cm`
--

CREATE TABLE `cm` (
  `cmid` int(11) NOT NULL,
  `cmname` varchar(50) NOT NULL,
  `districtid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cm`
--

INSERT INTO `cm` (`cmid`, `cmname`, `districtid`) VALUES
(1, 'Malolos CIty', 1),
(2, 'Bulakan', 1),
(3, 'Calumpit', 1),
(4, 'Hagonoy', 1),
(5, 'Paombong', 1),
(6, 'Pulilan', 1),
(7, 'Balagtas', 2),
(8, 'Baliuag', 2),
(9, 'Bocaue', 2),
(10, 'Bustos', 2),
(11, 'Guiguinto', 2),
(12, 'Pandi', 2),
(13, 'Plaridel', 2),
(14, 'Angat', 3),
(15, 'DRT', 3),
(16, 'Norzagaray', 3),
(17, 'San Ildefonso', 3),
(18, 'San Miguel', 3),
(19, 'San Rafael', 3),
(20, 'San Jose Del Monte City', 3),
(21, 'Marilao', 4),
(22, 'Meycauayan', 4),
(23, 'Obando', 4),
(24, 'Sta. Maria', 4);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `districtid` int(11) NOT NULL,
  `districtname` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`districtid`, `districtname`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `mlgoo_clgoo`
--

CREATE TABLE `mlgoo_clgoo` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `district` int(10) NOT NULL,
  `city_municipality` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `mlgoo_clgoo`
--

INSERT INTO `mlgoo_clgoo` (`id`, `username`, `password`, `district`, `city_municipality`, `firstname`, `middlename`, `lastname`, `gender`, `address`, `email`, `active`) VALUES
(34, 'shem', '2182d67e1e029b905fe724a1c4bb8e6d', 3, 'Angat', 'Shem', '', 'Undazan', 'm', 'Calumpit', 'shem@gmail.com', 0),
(2, 'rose', 'e28af1404a7f5ed1456373b147dbad38', 2, 'Balagtas', 'rose', '', 'Geronimo', 'f', 'balagtas', 'roseg@gmail.com', 0),
(3, 'vincent', '25d55ad283aa400af464c76d713c07ad', 2, 'Baliuag', 'Vincent', '', 'Sunga', 'm', 'baliuag', 'Vincent@gmal.com', 0),
(5, 'julia', '61c1df24c77c4cad915a0a9b808f0eb9', 2, 'Bulakan', 'Julia', '', 'Bantug', 'f', 'Bulakan', 'julia@gmail.com', 0),
(7, 'julenie', '4368ef7ebf7b1cbb8e47b909933f7c98', 1, 'Calumpit', 'julenie', '', 'Bulaon', 'f', 'calumpit', 'julenie@gmail.com', 0),
(35, 'evin', 'bbb8c31650ef444a4ba5a89b0a1466f3', 3, 'DRT', 'Ervin', '', 'Alonzo', 'm', 'Pandi', 'ervin@gmail.com', 0),
(9, 'edwin', 'a539aa16e9c2575bbcaa9d8530123935', 1, 'Guiguinto', 'Edwin', '', 'Monte', 'm', 'Guiguinto', 'edwin@gmail.com', 0),
(10, 'christian', 'ea77769958b26b58ef6ac6d84abbad4d', 2, 'Hagonoy', 'Christian', '', 'Tayao', 'm', 'Hagonoy', 'chris@gmail.com', 0),
(32, 'aldrich', '3875da6527aae8b4113d3c42cdb68451', 4, 'Marilao', 'Aldrich', 'gatmaitan', 'tome', 'm', 'Apalit', 'aldrichtome@gmail.com', 0),
(17, 'miah', '6f13a1433ae81646e9ce605c3dfc60dc', 2, 'Pandi', 'Jeremiah', '', 'Fernandez', 'm', 'Pandi', 'miah@gmail.com', 0),
(18, 'jonell', '53e21ca570dfc671047c3f94aaa0f907', 2, 'Paombong', 'Jonell', '', 'Simbulan', 'm', 'Paombong', 'jonell@gmail.com', 0),
(19, 'joshua', '1ad6de13538a1bf27c3b4ab489c9dcb8', 2, 'Plaridel', 'Joshua', '', 'Logrosa', 'm', 'Plaridel', 'josh@gmail.com', 0),
(20, 'katrina', '081ef5c0523d73f1674557846316da2a', 2, 'Pulilan', 'Katrina', '', 'Pangilinan', 'f', 'Pulilan', 'katrina@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `municipality`
--

CREATE TABLE `municipality` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `municipality`
--

INSERT INTO `municipality` (`id`, `name`, `pos_id`) VALUES
(1, 'Angat', 2),
(2, 'Balagtas', 2),
(3, 'Baliuag', 2),
(4, 'Bocaue', 2),
(5, 'Bulakan', 2),
(6, 'Bustos', 2),
(7, 'Calumpit', 2),
(8, 'San Jose Del Monte ', 3),
(9, 'Dona Remedios Trinidad', 2),
(10, 'Guiguinto', 2),
(11, 'Hagonoy', 2),
(12, 'Malolos', 1),
(13, 'Marilao', 2),
(14, 'Meycauyan', 3),
(15, 'Norzaragay', 2),
(16, 'Obando', 2),
(17, 'Pandi', 2),
(18, 'Paombong', 2),
(19, 'Plaridel', 2),
(20, 'Pulilan', 2),
(21, 'San Ildelfonso', 2),
(22, 'San Miguel', 2),
(23, 'San Rafael', 2),
(24, 'Sta. Maria', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdReset` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `pwdreset`
--

INSERT INTO `pwdreset` (`pwdReset`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(1, 'kkgh@gmail.com', 'ergsdfg', '$2y$10$72qF0KRb8MFLz7pBK.Y1BuDI3wAS06pZqbM5qJSh6bD/XXAPWMM9.', '1547695636'),
(32, 'aivee@gmail.com', '62953e1372e1e74c6871', '$2y$10$zuSeoKq5eV4qRANO/33NVOV0WmbbhRFNEGHMwyxJzIrHMB0AcSNPG', '1549528734'),
(34, 'jaymartcastromaala23@gmail.com', '7a0f4653952527ab0e69', '$2y$10$Z1fVCoTxcWGWuHQmzxW08ORPN087Vp8yT6U7DSlrtnbgKIKtAt67m', '1553068523'),
(42, 'cynicx12@gmail.com', '576670c909d80235bba7', '$2y$10$j4YBKzJ61cKTccXuUg3KrOxc8RKW40ZVLhLrnc/07OvbFFuricGUq', '1553214551'),
(45, 'ervin@gmail.com', '39fa1b6427a8e5f1828e', '$2y$10$ymCVS0q99qFHpYiLd9XN2OyU..Wvny0E4VX6mJOncAMT5BOxfjszW', '1553247460'),
(50, 'aldrichtome@gmail.com', '621b344bd0a33d4aedb8', '$2y$10$bVc3Ok9jBzEHTZjqRrx7D.FZ9u8kY7hb7mlQ0KqIjOyP6QAyIQZm.', '1553395608');

-- --------------------------------------------------------

--
-- Table structure for table `staff_info`
--

CREATE TABLE `staff_info` (
  `id` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `password` varchar(32) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `district_assigned` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `staff_info`
--

INSERT INTO `staff_info` (`id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `district_assigned`, `address`, `gender`, `email`, `active`) VALUES
(20, 'ben', 'fd035f49548f054943c9f91138bf4c50', 'Benedict', '', 'Pangan', '1|2', 'tarlac', 'm', 'cynicx12@gmail.com', 0),
(24, 'carlo', '80ec08504af83331911f5882349af59d', 'Carlo', 'Alonzo', 'asdasdasd', '3|4', 'Malolos', 'm', 'pav1970s@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_files`
--

CREATE TABLE `uploaded_files` (
  `id` int(11) NOT NULL,
  `sender` varchar(11) NOT NULL,
  `recipient` varchar(11) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `dates` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deadline` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `del` int(11) NOT NULL DEFAULT '0',
  `notif` int(11) NOT NULL DEFAULT '0',
  `notif_mclgoo` int(11) NOT NULL DEFAULT '0',
  `notif_admin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploaded_files`
--

INSERT INTO `uploaded_files` (`id`, `sender`, `recipient`, `file_name`, `dates`, `deadline`, `status`, `del`, `notif`, `notif_mclgoo`, `notif_admin`) VALUES
(61, 'darwin', 'carlo', 'test.docx', '2019-03-22 05:11:37', '2019-03-20', 0, 0, 1, 0, 0),
(62, 'carlo', 'darwin', 'Philosophy-Final.docx', '2019-03-22 07:40:51', '2019-03-20', 0, 0, 0, 0, 1),
(63, 'carlo', 'darwin', 'Philosophy-Final.docx', '2019-03-22 07:45:54', '2019-03-20', 0, 0, 0, 0, 1),
(67, 'darwin', 'carlo', 'Philosophy-Final.docx', '2019-03-22 07:50:57', '2019-03-26', 0, 0, 1, 0, 0),
(70, 'darwin', 'carlo', 'jham.docx', '2019-03-22 08:11:27', '2019-03-26', 1, 0, 1, 0, 0),
(73, 'carlo', 'darwin', 'jham.docx', '2019-03-22 08:13:17', '2019-03-26', 1, 0, 0, 0, 1),
(74, 'darwin', 'carlo', 'LEA.docx', '2019-03-22 09:00:58', '2019-03-28', 1, 0, 1, 0, 0),
(75, 'carlo', 'shem', 'LEA.docx', '2019-03-22 09:01:32', '2019-03-27', 1, 0, 0, 1, 0),
(76, 'shem', 'carlo', 'LEA.docx', '2019-03-22 09:01:54', '2019-03-27', 1, 0, 1, 0, 0),
(77, 'carlo', 'darwin', 'LEA.docx', '2019-03-22 09:02:50', '2019-03-28', 1, 0, 0, 0, 1),
(78, 'carlo', 'aldrich', 'LEA.docx', '2019-03-22 12:20:47', '2019-03-31', 0, 0, 0, 1, 0),
(79, 'darwin', 'ben', 'Report.docx', '2019-03-22 12:31:50', '2019-03-22', 0, 0, 1, 0, 0),
(80, 'darwin', 'carlo', 'Report.docx', '2019-03-22 12:31:50', '2019-03-22', 1, 0, 1, 0, 0),
(81, 'carlo', 'darwin', 'Report.docx', '2019-03-22 13:00:44', '2019-03-22', 1, 0, 0, 0, 1),
(82, 'darwin', 'ben', 'report-philosophy.docx', '2019-03-29 07:32:56', '2019-03-30', 0, 0, 1, 0, 0),
(83, 'ben', 'darwin', 'Name_ Jaymart C-WPS Office.doc', '2019-03-29 07:33:51', '2019-03-30', 0, 0, 0, 0, 1),
(84, 'ben', 'jonell', 'report-philosophy.docx', '2019-03-29 08:42:34', '2019-03-30', 0, 0, 0, 1, 0),
(85, 'jonell', 'ben', 'report-philosophy.docx', '2019-03-29 08:43:11', '2019-03-30', 0, 0, 1, 0, 0),
(86, 'aldrich', 'carlo', 'report-philosophy.docx', '2019-03-29 08:59:13', '2019-03-31', 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `announcement_admin`
--
ALTER TABLE `announcement_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cm`
--
ALTER TABLE `cm`
  ADD PRIMARY KEY (`cmid`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`districtid`);

--
-- Indexes for table `mlgoo_clgoo`
--
ALTER TABLE `mlgoo_clgoo`
  ADD PRIMARY KEY (`city_municipality`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `municipality`
--
ALTER TABLE `municipality`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdReset`);

--
-- Indexes for table `staff_info`
--
ALTER TABLE `staff_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `announcement_admin`
--
ALTER TABLE `announcement_admin`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `districtid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mlgoo_clgoo`
--
ALTER TABLE `mlgoo_clgoo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `municipality`
--
ALTER TABLE `municipality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdReset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `staff_info`
--
ALTER TABLE `staff_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

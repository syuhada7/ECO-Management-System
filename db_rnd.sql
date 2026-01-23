-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2026 at 03:43 AM
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
-- Database: `db_rnd`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery_schedule`
--

CREATE TABLE `delivery_schedule` (
  `id` int(11) NOT NULL,
  `id_eco` int(11) NOT NULL,
  `material_no` varchar(50) DEFAULT NULL,
  `delivery_schedule` date DEFAULT NULL,
  `previous_inventory` int(11) DEFAULT NULL,
  `quantity_shipped` int(11) DEFAULT NULL,
  `current_stock` int(11) DEFAULT NULL,
  `shipped_wio` varchar(50) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `regis` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `regis_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_eco`
--

CREATE TABLE `detail_eco` (
  `id_detail` int(11) NOT NULL,
  `id_eco` int(11) NOT NULL,
  `model_pn` varchar(225) NOT NULL,
  `pn_number` varchar(225) NOT NULL,
  `rm` varchar(225) NOT NULL,
  `cr_stock` int(11) NOT NULL,
  `date_regis` datetime NOT NULL,
  `date_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `eco`
--

CREATE TABLE `eco` (
  `id_eco` int(11) NOT NULL,
  `register` varchar(50) NOT NULL,
  `dept` varchar(15) NOT NULL,
  `regis_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status1` varchar(15) NOT NULL,
  `pn_name` varchar(50) NOT NULL,
  `in_eco_num` varchar(50) NOT NULL,
  `in_eco_path` varchar(100) NOT NULL,
  `kr_eco_num` varchar(50) NOT NULL,
  `kr_eco_path` varchar(50) NOT NULL,
  `effec_date` date NOT NULL,
  `expec_date` date NOT NULL,
  `h_apply` varchar(50) NOT NULL,
  `status2` varchar(15) NOT NULL,
  `first_release_date` date NOT NULL,
  `img_qc` varchar(150) NOT NULL,
  `dwg_pn` varchar(100) NOT NULL,
  `last_stock_date` date NOT NULL,
  `ket` varchar(150) NOT NULL,
  `img_meeting` varchar(50) NOT NULL,
  `aproval1` varchar(10) NOT NULL,
  `aproval2` varchar(10) NOT NULL,
  `aproval3` varchar(10) NOT NULL,
  `aproval4` varchar(10) NOT NULL,
  `aproval5` varchar(10) NOT NULL,
  `aproval6` varchar(10) NOT NULL,
  `aproval7` varchar(10) NOT NULL,
  `u_update` varchar(150) NOT NULL,
  `date_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `f_date`
--

CREATE TABLE `f_date` (
  `id_fdate` int(11) NOT NULL,
  `id_eco` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `depart` varchar(100) NOT NULL,
  `file1` varchar(225) NOT NULL,
  `date_1` date NOT NULL DEFAULT current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komen` int(11) NOT NULL,
  `id_eco` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `date_komen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `komen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_material`
--

CREATE TABLE `tabel_material` (
  `id` int(11) NOT NULL,
  `id_eco` int(11) NOT NULL,
  `material_no` varchar(50) NOT NULL,
  `current_stock` int(11) DEFAULT NULL,
  `effective_date` date DEFAULT NULL,
  `exhaust_date` date DEFAULT NULL,
  `shipping_available` varchar(20) DEFAULT NULL,
  `issue` varchar(255) DEFAULT NULL,
  `u_update` varchar(150) NOT NULL,
  `date_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` int(11) NOT NULL,
  `image` varchar(15) NOT NULL,
  `dept` varchar(15) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nik`, `nama`, `password`, `level`, `image`, `dept`, `is_active`) VALUES
(1, '1234', 'Admin', '0192023a7bbd73250516f069df18b500', 1, 'default.png', 'IT', 1),
(2, '5678', 'User', '6ad14ba9986e3615423dfca256d04e3f', 2, 'default.png', '', 1),
(3, '123', 'Kim j', '98467a817e2ff8c8377c1bf085da7138', 1, 'default.png', 'RnD', 1),
(4, '7531', 'Agung', '6f5d0ad4bc971cddc51a0c5f74bdf3fd', 1, 'default.png', 'RnD', 1),
(5, '3659', 'Pendi', '69c3a9575f4120dc97068863bb8b60ef', 1, 'default.png', 'Assembly', 1),
(6, '7854', 'Rika', '2f6b87bf490402877f19ee52998f2fa6', 1, 'default.png', 'PPIC', 1),
(7, '2545', 'Aripin', '99b3069a894d080a128ea398766b2a8c', 1, 'default.png', 'QC', 1),
(8, '3254', 'Ermawan', '24ef73e81936e8a146597280af49ecf2', 1, 'default.png', 'Injection', 1),
(9, '6547', 'Joni', '1c0ac25b077a885dc53d91b05b14544e', 1, 'default.png', 'Molding', 1),
(10, '8524', 'Eka', 'e48ec16d066a59dffbe1e352ad0710d7', 1, 'default.png', 'Materials', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_schedule`
--
ALTER TABLE `delivery_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_eco`
--
ALTER TABLE `detail_eco`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `eco`
--
ALTER TABLE `eco`
  ADD PRIMARY KEY (`id_eco`);

--
-- Indexes for table `f_date`
--
ALTER TABLE `f_date`
  ADD PRIMARY KEY (`id_fdate`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komen`);

--
-- Indexes for table `tabel_material`
--
ALTER TABLE `tabel_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_schedule`
--
ALTER TABLE `delivery_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_eco`
--
ALTER TABLE `detail_eco`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eco`
--
ALTER TABLE `eco`
  MODIFY `id_eco` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `f_date`
--
ALTER TABLE `f_date`
  MODIFY `id_fdate` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_material`
--
ALTER TABLE `tabel_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

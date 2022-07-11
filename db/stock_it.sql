-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2022 at 09:32 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock_it`
--

-- --------------------------------------------------------

--
-- Table structure for table `koffice`
--

CREATE TABLE `koffice` (
  `k_id` int(11) NOT NULL,
  `k_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `koffice`
--

INSERT INTO `koffice` (`k_id`, `k_name`) VALUES
(1, 'IT'),
(2, 'ทันตกรรม'),
(3, 'ห้องบัตร'),
(4, 'NCD'),
(5, 'OPD');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(255) DEFAULT NULL,
  `m_price` float DEFAULT NULL,
  `m_number` int(3) NOT NULL,
  `m_date` date DEFAULT NULL,
  `m_time` time DEFAULT NULL,
  `m_detail` text DEFAULT NULL,
  `m_image` varchar(255) DEFAULT NULL,
  `m_s_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`m_id`, `m_name`, `m_price`, `m_number`, `m_date`, `m_time`, `m_detail`, `m_image`, `m_s_id`) VALUES
(13, 'หมึกดำepson', 260, 29, '2022-07-11', '10:15:00', 'epon หมึกดำ ใช้สำหรับ l360, l110', '20220711237265150.jpg', 2),
(14, 'หมึกสีแดง epson', 260, 0, '2022-07-11', '10:37:00', 'epson สีแดง ใช้สำหรับ l360, l110', '2022071172366070.jpg', 2),
(15, 'คีย์บอร์ด', 300, 0, '2022-07-11', '11:05:00', '', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `d_id` int(10) NOT NULL COMMENT 'รหัสของdetail',
  `o_id` int(11) NOT NULL COMMENT 'idของorderการเบิก',
  `m_id` int(11) NOT NULL COMMENT 'idของวัสดุที่เบิก',
  `d_qty` int(11) NOT NULL COMMENT 'idของจำนวนวัสดุที่เบิก',
  `d_subtotal` float NOT NULL COMMENT 'idของราคารวมการเบิกแต่ละรายการ'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`d_id`, `o_id`, `m_id`, `d_qty`, `d_subtotal`) VALUES
(113, 119, 13, 1, 260),
(112, 118, 14, 1, 260),
(111, 117, 14, 1, 260),
(110, 116, 14, 1, 260),
(109, 115, 14, 1, 260),
(108, 114, 14, 1, 260),
(107, 112, 15, 1, 300),
(106, 111, 13, 9, 2340),
(105, 111, 14, 5, 1300),
(104, 110, 13, 1, 260);

-- --------------------------------------------------------

--
-- Table structure for table `order_head`
--

CREATE TABLE `order_head` (
  `o_id` int(10) NOT NULL COMMENT 'รหัสของรายการเบิกต่อครั้ง',
  `o_dttm` datetime NOT NULL COMMENT 'วันเวลา',
  `o_name` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'ชื่อคนที่เบิก',
  `o_office` varchar(500) CHARACTER SET utf8 NOT NULL COMMENT 'หน่วยงานที่เบิก',
  `o_pname` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'คำนำหน้า',
  `o_position` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT 'ตำแหน่งของคนที่เบิก',
  `o_commitname` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'ชื่อของคนที่อนุมัติ',
  `o_total` float NOT NULL COMMENT 'ราคารวมของการเบิก'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_head`
--

INSERT INTO `order_head` (`o_id`, `o_dttm`, `o_name`, `o_office`, `o_pname`, `o_position`, `o_commitname`, `o_total`) VALUES
(110, '2022-07-11 10:18:07', 'ศรายุทธ นวะศรี', 'IT', 'นาย', 'นักวิชาการคอมพิวเตอร', '', 260),
(111, '2022-07-11 10:47:28', 'ศรายุทธ นวะศรี', 'IT', 'นาย', 'นักวิชาการคอมพิวเตอร', '', 3640),
(112, '2022-07-11 11:06:11', 'ศรายุทธ นวะศรี', 'IT', 'นาย', 'นักวิชาการคอมพิวเตอร', '', 300),
(113, '2022-07-11 11:37:58', 'ศรายุทธ นวะศรี', 'IT', 'นาย', 'นักวิชาการคอมพิวเตอร', 'นายศรายุทธ นวะศรี', 260),
(114, '2022-07-11 11:38:28', 'ศรายุทธ นวะศรี', 'IT', 'นาย', 'นักวิชาการคอมพิวเตอร', 'นายศรายุทธ นวะศรี', 260),
(115, '2022-07-11 11:39:18', 'ทดลอง', 'ทันตกรรม', 'นาง', 'จพ', 'นายศรายุทธ นวะศรี', 260),
(116, '2022-07-11 11:40:02', 'ทดสอบ', 'ห้องบัตร', 'นาย', 'จพ', 'นายศรายุทธ นวะศรี', 260),
(117, '2022-07-11 11:44:34', 'test', 'NCD', 'นาย', 'จพ', 'นายศรายุทธ นวะศรี', 260),
(118, '2022-07-11 11:52:31', 'tttt', 'IT', 'นาง', 'จพ', 'นายศรายุทธ นวะศรี', 260),
(119, '2022-07-11 13:30:53', 'ddddggg', 'IT', 'นาย', 'นักวิชาการคอมพิวเตอร', 'นายศรายุทธ นวะศรี', 260);

-- --------------------------------------------------------

--
-- Table structure for table `pname`
--

CREATE TABLE `pname` (
  `pname_id` int(11) NOT NULL,
  `pname_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pname`
--

INSERT INTO `pname` (`pname_id`, `pname_name`) VALUES
(1, 'นาย'),
(2, 'นาง'),
(3, 'น.ส.');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(1, 'อนุมัติ'),
(2, 'รออนุมัติ');

-- --------------------------------------------------------

--
-- Table structure for table `txtoffice`
--

CREATE TABLE `txtoffice` (
  `txtoffice_id` int(11) NOT NULL,
  `txtoffice_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `txtoffice`
--

INSERT INTO `txtoffice` (`txtoffice_id`, `txtoffice_name`) VALUES
(1, 'IT'),
(2, 'ER');

-- --------------------------------------------------------

--
-- Table structure for table `type_stock`
--

CREATE TABLE `type_stock` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `type_stock`
--

INSERT INTO `type_stock` (`s_id`, `s_name`) VALUES
(1, 'อุปกรณ์คอมพิวเตอร์'),
(2, 'อุปกรณ์ปริ้นเตอร์'),
(3, 'อุปกรณ์อินเตอร์เน็ต'),
(4, 'อุปกรณ์อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `cid` varchar(13) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `ulevel` varchar(255) NOT NULL,
  `txtoffice` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `pname`, `fullname`, `cid`, `tel`, `ulevel`, `txtoffice`, `position`, `status`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'นาย', 'ศรายุทธ นวะศรี', '1400900249352', '0980877876', 'admin', 'IT', 'นักวิชาการคอมพิวเตอร์ ', 'อนุมัติ'),
(2, 'user', 'e10adc3949ba59abbe56e057f20f883e', 'นาย', 'fnameuser', '1234567891234', '0912345678', 'member', 'it', 'computer', 'อนุมัติ'),
(3, 'user2', 'e10adc3949ba59abbe56e057f20f883e', 'นาย', 'fnameuser', '1234567891234', '0912345678', 'member', 'it', 'computer', 'อนุมัติ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `koffice`
--
ALTER TABLE `koffice`
  ADD PRIMARY KEY (`k_id`) USING BTREE;

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`m_id`) USING BTREE;

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `order_head`
--
ALTER TABLE `order_head`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `pname`
--
ALTER TABLE `pname`
  ADD PRIMARY KEY (`pname_id`) USING BTREE;

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `txtoffice`
--
ALTER TABLE `txtoffice`
  ADD PRIMARY KEY (`txtoffice_id`);

--
-- Indexes for table `type_stock`
--
ALTER TABLE `type_stock`
  ADD PRIMARY KEY (`s_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `koffice`
--
ALTER TABLE `koffice`
  MODIFY `k_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `d_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสของdetail', AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `order_head`
--
ALTER TABLE `order_head`
  MODIFY `o_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสของรายการเบิกต่อครั้ง', AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `type_stock`
--
ALTER TABLE `type_stock`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

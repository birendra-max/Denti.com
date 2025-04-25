-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 25, 2025 at 06:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skydent_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'Skydent@skydentdesigns.com', 'Skydent#991192');

-- --------------------------------------------------------

--
-- Table structure for table `autopooluser`
--

CREATE TABLE `autopooluser` (
  `id` int(11) NOT NULL,
  `mid` varchar(200) NOT NULL,
  `side` varchar(10) NOT NULL,
  `level` varchar(200) NOT NULL,
  `tot` varchar(200) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `sponserid` varchar(100) NOT NULL,
  `todaydate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `autopooluser`
--

INSERT INTO `autopooluser` (`id`, `mid`, `side`, `level`, `tot`, `amount`, `sponserid`, `todaydate`) VALUES
(1, '8899', '0', '0', '2', '20', '0', '02/28/2021'),
(2, 'SL2698', 'L', '0', '3', '30', '8899', '02/28/2021'),
(3, 'SL3727', 'M', '0', '1', '10', '8899', '02/28/2021'),
(4, 'SL5330', 'R', '0', '0', '0', '8899', '02/28/2021'),
(5, 'SL6180', 'L', '0', '0', '0', 'SL2698', '02/28/2021'),
(6, 'SL63535', 'R', '0', '0', '0', '8899', '03/03/2021'),
(7, 'SL68619', 'M', '0', '0', '0', 'SL2698', '03/03/2021'),
(8, 'SL75808', 'R', '0', '0', '0', 'SL2698', '03/03/2021'),
(9, 'SL82259', 'L', '0', '0', '0', 'SL3727', '03/03/2021');

-- --------------------------------------------------------

--
-- Table structure for table `chatbox`
--

CREATE TABLE `chatbox` (
  `id` int(11) NOT NULL,
  `orderid` varchar(50) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `msg` text DEFAULT NULL,
  `created_at` varchar(100) DEFAULT NULL,
  `attachment` text DEFAULT NULL,
  `read_status` varchar(50) DEFAULT NULL,
  `userid` varchar(255) DEFAULT NULL,
  `filename` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatbox`
--

INSERT INTO `chatbox` (`id`, `orderid`, `user_type`, `msg`, `created_at`, `attachment`, `read_status`, `userid`, `filename`) VALUES
(1, '100001', 'user', 'Hii i need design', '21-Apr-2025 11:01:20pm', '', NULL, 'D0001', ''),
(2, '100002', 'user', 'hello i am vicky', '21-Apr-2025 11:01:38pm', '', NULL, 'D0001', ''),
(3, '100002', 'SKYDENT TEAM', 'tha ks', '21-Apr-2025 11:01:53pm', '', NULL, 'D.Y@skydentdesigns.com', ''),
(4, '100001', 'SKYDENT TEAM', 'dsafkljlf', '21-Apr-2025 11:02:00pm', '', NULL, 'D.Y@skydentdesigns.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `closing`
--

CREATE TABLE `closing` (
  `id` int(11) NOT NULL,
  `pinid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `id` int(11) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `commision` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maillist`
--

CREATE TABLE `maillist` (
  `id` int(11) NOT NULL,
  `mid` varchar(200) NOT NULL,
  `direct` varchar(100) NOT NULL,
  `subject` text NOT NULL,
  `msg` text NOT NULL,
  `attach` varchar(255) NOT NULL,
  `todaydate` varchar(100) NOT NULL,
  `todaytime` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mpayment`
--

CREATE TABLE `mpayment` (
  `ID` int(11) NOT NULL,
  `mid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ramount` varchar(255) NOT NULL,
  `todaydate` varchar(255) NOT NULL,
  `tid` varchar(255) NOT NULL,
  `idate` varchar(255) NOT NULL,
  `status` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL,
  `apdate` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mpayment2`
--

CREATE TABLE `mpayment2` (
  `ID` int(11) NOT NULL,
  `mid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ramount` varchar(255) NOT NULL,
  `todaydate` varchar(255) NOT NULL,
  `tid` varchar(255) NOT NULL,
  `idate` varchar(255) NOT NULL,
  `status` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderid` text DEFAULT NULL,
  `user_id` varchar(255) NOT NULL,
  `fname` text DEFAULT NULL,
  `tduration` text DEFAULT NULL,
  `clientid` text DEFAULT NULL,
  `unit` text DEFAULT NULL,
  `product_type` text NOT NULL,
  `tooth` text DEFAULT NULL,
  `message` text DEFAULT NULL,
  `optional` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `labname` text DEFAULT NULL,
  `filename` text DEFAULT NULL,
  `stl_file` text DEFAULT NULL,
  `finished_file` text DEFAULT NULL,
  `finished_file_created_at` text DEFAULT NULL,
  `assign_date` text DEFAULT NULL,
  `did` text DEFAULT NULL,
  `crown` text DEFAULT NULL,
  `custom` text DEFAULT NULL,
  `framework` text DEFAULT NULL,
  `abu` text DEFAULT NULL,
  `model` text DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `backup_status` text DEFAULT NULL,
  `delete_status` text DEFAULT NULL,
  `b_date` text DEFAULT NULL,
  `d_date` text DEFAULT NULL,
  `flag` text DEFAULT NULL,
  `status_ch_date` varchar(255) DEFAULT NULL,
  `status_r` text DEFAULT NULL,
  `r_date` text DEFAULT NULL,
  `status_c` text DEFAULT NULL,
  `c_date` text DEFAULT NULL,
  `c_id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderid`, `user_id`, `fname`, `tduration`, `clientid`, `unit`, `product_type`, `tooth`, `message`, `optional`, `status`, `created_at`, `labname`, `filename`, `stl_file`, `finished_file`, `finished_file_created_at`, `assign_date`, `did`, `crown`, `custom`, `framework`, `abu`, `model`, `remark`, `backup_status`, `delete_status`, `b_date`, `d_date`, `flag`, `status_ch_date`, `status_r`, `r_date`, `status_c`, `c_date`, `c_id`) VALUES
(1, '100000', 'D0001', 'Alexandra E.zip', '', NULL, '1', 'Splint', '1', '', NULL, 'Completed', '2025-04-06 01:15:06am', 'Dentigo Test ', '', NULL, NULL, NULL, NULL, NULL, 'Crown', 'N', 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, '0', '06-Apr-2025 12:50:52pm', NULL, NULL, 'Completed', '06-Apr-2025 12:50:52pm', 'D.Y@skydentdesigns.com'),
(2, '100001', 'D0001', 'Samela M_0.zip', '', NULL, '0', '', '', '', NULL, 'New', '2025-04-06 12:38:34pm', 'Dentigo Test ', '', NULL, NULL, NULL, NULL, NULL, 'Crown', 'N', 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, '0', '2025-04-06 12:38:34pm', NULL, NULL, NULL, NULL, NULL),
(3, '100002', 'D0001', '2021-12-A2-HAMED-JONES-239267730-ITERO-SCR.zip', 'Same Day', NULL, '2', 'Unsectioned model, Antagonist model, Crown 12, Abutment 12', '12,12', 'narrow short scan body used', NULL, 'New', '2025-04-07 04:43:53am', 'Dentigo Test ', '', NULL, NULL, NULL, NULL, NULL, 'Crown', 'N', 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, '0', '2025-04-07 04:43:53am', NULL, NULL, NULL, NULL, NULL),
(4, '100003', 'D0001', '4012-19-A35-Bullard-MARX-TRIOS.zip', 'Same Day', NULL, '1', 'Crown 19', '19', '', NULL, 'New', '2025-04-07 04:44:52am', 'Dentigo Test ', '', NULL, NULL, NULL, NULL, NULL, 'Crown', 'N', 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, '0', '2025-04-07 04:44:52am', NULL, NULL, NULL, NULL, NULL),
(5, '100004', 'D0001', '4097-20-A2-Rabell-CSMILES-TRIOS.zip', 'Same Day', NULL, '1', 'Anatomical coping 20', '20', 'Please frabricate PFM crown for #20.  Please design a meisal rest seat on the coping,     Thank You. ', NULL, 'New', '2025-04-07 04:45:21am', 'Dentigo Test ', '', NULL, NULL, NULL, NULL, NULL, 'Crown', 'N', 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, '0', '2025-04-07 04:45:21am', NULL, NULL, NULL, NULL, NULL),
(6, '100005', 'D0001', '529-28-5M3-NDL-7865-MARQUIT-GUERRA-DEXIS.zip', 'Same Day', NULL, '1', 'Crown 28', '28', '', NULL, 'New', '2025-04-07 04:46:11am', 'Dentigo Test ', '', NULL, NULL, NULL, NULL, NULL, 'Crown', 'N', 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, '0', '2025-04-07 04:46:11am', NULL, NULL, NULL, NULL, NULL),
(7, '100006', 'D0001', '7121-13-C3-CABRERA-IDEAL-DENTAL.zip', 'Same Day', NULL, '1', 'Crown 13', '13', '', NULL, 'New', '2025-04-07 04:49:25am', 'Dentigo Test ', '', NULL, NULL, NULL, NULL, NULL, 'Crown', 'N', 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, '0', '2025-04-07 04:49:25am', NULL, NULL, NULL, NULL, NULL),
(8, '100007', 'D0001', '268-15-A3.5-SALGUEDO-IDEAL-DENTAL.zip', 'Same Day', NULL, '1', 'Crown 15', '15', '', NULL, 'New', '2025-04-07 04:50:38am', 'Dentigo Test ', '', NULL, NULL, NULL, NULL, NULL, 'Crown', 'N', 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, '0', '2025-04-07 04:50:38am', NULL, NULL, NULL, NULL, NULL),
(9, '100008', 'D0001', '1010-31-C3-OHALLORANS-IDEAL-DENTAL.zip', 'Same Day', NULL, '1', 'Crown 31', '31', '', NULL, 'New', '2025-04-07 04:51:27am', 'Dentigo Test ', '', NULL, NULL, NULL, NULL, NULL, 'Crown', 'N', 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, '0', '2025-04-07 04:51:27am', NULL, NULL, NULL, NULL, NULL),
(10, '100009', 'D0001', '4129-12-A3-GUTIERREZ-IDEAL-DENTAL.zip', 'Same Day', NULL, '1', 'Crown 12', '12', '', NULL, 'New', '2025-04-07 04:54:12am', 'Dentigo Test ', '', NULL, NULL, NULL, NULL, NULL, 'Crown', 'N', 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, '0', '2025-04-07 04:54:12am', NULL, NULL, NULL, NULL, NULL),
(11, '100010', 'D0001', '359-5-4M1-ROLDAN-PRIME-DENTAL.zip', 'Same Day', NULL, '1', 'Crown 5', '5', '', NULL, 'New', '2025-04-07 04:54:19am', 'Dentigo Test ', '', NULL, NULL, NULL, NULL, NULL, 'Crown', 'N', 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, '0', '2025-04-07 04:54:19am', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_finished`
--

CREATE TABLE `orders_finished` (
  `id` int(11) NOT NULL,
  `orderid` varchar(200) DEFAULT NULL,
  `user_id` varchar(255) NOT NULL,
  `finished_file` text DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `userid` varchar(255) DEFAULT NULL,
  `backup_status` varchar(10) DEFAULT NULL,
  `delete_status` varchar(10) DEFAULT NULL,
  `b_date` varchar(200) DEFAULT NULL,
  `d_date` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_finished`
--

INSERT INTO `orders_finished` (`id`, `orderid`, `user_id`, `finished_file`, `created_at`, `userid`, `backup_status`, `delete_status`, `b_date`, `d_date`) VALUES
(1, '100000', '', 'Alexandra E.zip', '06-Apr-2025 01:24:21am', 'D.Y@skydentdesigns.com', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_finished2`
--

CREATE TABLE `orders_finished2` (
  `id` int(11) NOT NULL,
  `orderid` varchar(200) DEFAULT NULL,
  `finished_file` text DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `userid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_stl_files`
--

CREATE TABLE `orders_stl_files` (
  `id` int(11) NOT NULL,
  `orderid` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) NOT NULL,
  `filename` text DEFAULT NULL,
  `created_at` varchar(100) DEFAULT NULL,
  `userid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_stl_files`
--

INSERT INTO `orders_stl_files` (`id`, `orderid`, `user_id`, `filename`, `created_at`, `userid`) VALUES
(1, '100000', '', 'Alexandra E_0.stl', '06-Apr-2025 02:37:30am', 'D.Y@skydentdesigns.com');

-- --------------------------------------------------------

--
-- Table structure for table `orders_stl_files2`
--

CREATE TABLE `orders_stl_files2` (
  `id` int(11) NOT NULL,
  `orderid` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) NOT NULL,
  `filename` text DEFAULT NULL,
  `created_at` varchar(100) DEFAULT NULL,
  `userid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `pin` varchar(6) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `todaydate` varchar(50) NOT NULL,
  `person` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `cname`, `email`, `mobile`, `address`, `state`, `city`, `pin`, `logo`, `todaydate`, `person`) VALUES
(1, 'SkyDent Designs', 'skydent@skydentdesigns.com', '', 'noida ', 'Delhi', 'new Delhi', '221105', 'images/1676559949-1769-logo.png', '01-03-2023', 'Sonu');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `des` text NOT NULL,
  `heading` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `todaydate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `des`, `heading`, `image`, `todaydate`) VALUES
(23, '	                		description\r\n	              		', '', ' images/1680142573-6215-upper 5 units P.PNG', '30-Mar-2023');

-- --------------------------------------------------------

--
-- Table structure for table `team_member`
--

CREATE TABLE `team_member` (
  `id` int(11) NOT NULL,
  `des` text NOT NULL,
  `heading` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `todaydate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_member`
--

INSERT INTO `team_member` (`id`, `des`, `heading`, `image`, `todaydate`) VALUES
(5, 'Junior Leader', 'Nandu Chay Wala', ' images/1613465018-3170-bb.jpg', '16-Feb-2021'),
(6, 'CMD', 'Papi', ' images/1613465046-8749-team4.jpg', '16-Feb-2021'),
(7, 'SEO', 'Mohan Lal', ' images/1613465345-7303-bg3.jpg', '16-Feb-2021');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `em` varchar(255) DEFAULT NULL,
  `occlusion` varchar(255) DEFAULT NULL,
  `labname` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `anatomy` varchar(255) DEFAULT '0',
  `remark` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `pontic` varchar(5) NOT NULL DEFAULT 'N',
  `todaydate` varchar(255) DEFAULT NULL,
  `acpinid` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `custom` varchar(255) NOT NULL DEFAULT '0',
  `lspacer` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `user_id`, `id`, `name`, `designation`, `em`, `occlusion`, `labname`, `amount`, `mobile`, `password`, `status`, `anatomy`, `remark`, `contact`, `pontic`, `todaydate`, `acpinid`, `pic`, `custom`, `lspacer`) VALUES
(1, 'D00001', 'BRC', 'Test', '', '', '0.30', 'Dentigo Test ', NULL, '979979979979', 'ebae4deaef1fa85483255e5749129a51', 'active', 'gl', ' ', '0.00', '0', '01-Apr-2025', '1', '', '0', '0'),
(2, 'D0001', 'BRC1', 'Test', NULL, NULL, '0.30', 'Dentigo Test ', NULL, '979979979979', '0cbc6611f5540bd0809a388dc95a615b', 'active', 'gl', '', '0.00', '0', '01-Apr-2025', '1', '', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user1`
--

CREATE TABLE `user1` (
  `userid` int(11) NOT NULL,
  `id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `em` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `todaydate` varchar(255) DEFAULT NULL,
  `acpinid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user1`
--

INSERT INTO `user1` (`userid`, `id`, `name`, `designation`, `em`, `mobile`, `password`, `status`, `todaydate`, `acpinid`) VALUES
(1, 'BRC', 'Dharmendra ', 'Manager ', 'D.Y@skydentdesigns.com', '09711521402', 'Welcome@DentiGo123', 'active', '16-Feb-2023', '1');

-- --------------------------------------------------------

--
-- Table structure for table `userkyc`
--

CREATE TABLE `userkyc` (
  `userid` int(11) NOT NULL,
  `id` varchar(255) NOT NULL,
  `pan` varchar(255) NOT NULL,
  `aadhar` varchar(255) NOT NULL,
  `doc1` varchar(255) NOT NULL,
  `doc2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autopooluser`
--
ALTER TABLE `autopooluser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatbox`
--
ALTER TABLE `chatbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `closing`
--
ALTER TABLE `closing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maillist`
--
ALTER TABLE `maillist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mpayment`
--
ALTER TABLE `mpayment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `mpayment2`
--
ALTER TABLE `mpayment2`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_finished`
--
ALTER TABLE `orders_finished`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_finished2`
--
ALTER TABLE `orders_finished2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_stl_files`
--
ALTER TABLE `orders_stl_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_stl_files2`
--
ALTER TABLE `orders_stl_files2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_member`
--
ALTER TABLE `team_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `user1`
--
ALTER TABLE `user1`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `userkyc`
--
ALTER TABLE `userkyc`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `autopooluser`
--
ALTER TABLE `autopooluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `chatbox`
--
ALTER TABLE `chatbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `closing`
--
ALTER TABLE `closing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maillist`
--
ALTER TABLE `maillist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mpayment`
--
ALTER TABLE `mpayment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mpayment2`
--
ALTER TABLE `mpayment2`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders_finished`
--
ALTER TABLE `orders_finished`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders_finished2`
--
ALTER TABLE `orders_finished2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_stl_files`
--
ALTER TABLE `orders_stl_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders_stl_files2`
--
ALTER TABLE `orders_stl_files2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `team_member`
--
ALTER TABLE `team_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user1`
--
ALTER TABLE `user1`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userkyc`
--
ALTER TABLE `userkyc`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

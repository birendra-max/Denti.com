-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 23, 2025 at 10:55 PM
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
(1, 'd1001', 'BRC', 'Test1', 'Lab Manager ', 'vicky@gmail.com', '0.45 mm Out of occlusion ', 'QSDL', NULL, '9711521402', '0cbc6611f5540bd0809a388dc95a615b', 'active', 'GL ', ' Natural design ', '-0.05 MM Broad and Deep ', '0 ', '16-Feb-2023', '1', '', 'Narrow Central, and natural design ', '0'),
(2, 'd1002', 'BRC1', 'Test', 'Manager ', 'testing@gmail.com', '0.35 mm Out of occlusion ', 'SDL', NULL, '9711521402', '0cbc6611f5540bd0809a388dc95a615b', 'active', 'GL ', '   Natural Designs', '-0.02 MM Broad and Deep ', '0 ', '16-Feb-2023', '1', '', '0', '0'),
(3, '', 'BRC2', 'Steven ', 'Lab Manager', 'cdmcusa@gmail.com', '0.35 out of occlusion ', 'CDMC', NULL, '9711521402', 'Skydent#2020', 'active', 'GL', ' Natural as much as possible ', '-0.02MM', '0', '28-Feb-2023', '0', '', '0', '0'),
(4, '', 'BRC3', ' Stephanie', 'Manager ', 'transfers...cadcam@dildentallab.com', 'light (0.15mm)', 'DIL', NULL, '9711521402', 'cadcam2023', 'active', 'Deep/GL', '   Regarding design parameters:\r\n\r\nOcclusion - light (0.15mm)\r\n\r\nDesign type - secondary anatomy unless adjacent anatomy is flat\r\n\r\nContact - Point\r\n\r\nPontic - Ridge lap\r\n\r\n \r\n\r\n3Shape settings:\r\n\r\nRemove undercuts, drill compensation, and new drill compensation is checked. Smooth surface noise is not checked.\r\n\r\nCement gap 0.050\r\n\r\nExtra cement gap 0.100\r\n\r\nDist to margin line 0.40\r\n\r\nSmooth dist 0.20\r\n\r\nDrill radius 0.650\r\n\r\nDrill cop offset 0.66', 'Point', '0', '05-Apr-2023', '1', '', '0', '0'),
(5, '', 'BRC4', 'Gavin', 'Lab Manager ', 'stainlab@gmail.com', 'Occlusion: 0.33mm clearance (Drs: Nonkovic and Bardia 0.23mm)', 'SL', NULL, '9711521402', 'Govin$3210', 'active', 'GL Keep Natural Anatomy ', ' Pontic : modified ridgelap imbedded into gum (-0.30mm) Anatomy: Ideal but not overly aggressive grooves.Contact: Broad and wide with marginal ridges on the same level. Open contact 0.02mm (gold crowns super tight -0.04mm) Occlusion: 0.33mm clearance (Drs: Nonkovic and Bardia 0.23mm)', '0.02mm broad and deep ', '-0.30', '27-Apr-2023', '0', '', '0', '0'),
(6, '', 'BRC5', 'Aaron', 'Lab Manager ', 'aaron@niklab.net', '0.20', 'NIK', NULL, '9711521402', 'NIK&skydent#321', 'active', 'Match adjacent or primary', '  Will specify per case if any additional design details will be necessary.', '-0.01', '0', '12-May-2023', '0', '', '0', '0'),
(7, '', 'BRC6', 'Chris', 'Lab Manager ', 'ExcelMaxLab@gmail.com', '.10 mm', 'C D Designs', NULL, '9711521402', 'Daller$3210', 'active', 'Match adjacent', ' ', '-0.02', '0', '20-May-2023', '0', '', '0', '0'),
(8, '', 'BRC7', 'kat', 'Lab Manager ', 'katherine.barkley@oralartsdental.com', '0.60', 'ODL', NULL, '9711521402', 'Kat@ORAL#321', 'active', 'GL Keep Natural Anatomy as always ', ' Modified Ridge', '-0.01', '0', '24-May-2023', '0', '', '0', '0'),
(9, '', 'BRC8', 'Nava', 'manager ', 'navadentallab1@gmail.com', '0.35', 'NDL', NULL, '9711521402', 'NAVA#DENTAL@123', 'active', 'GL Keep Natural Anatomy as always ', ' ', '-0.02', '0', '30-Jun-2023', '1', 'images/Nava Logo.jpg', '0', '0'),
(10, '', 'BRC9', 'Steven ', 'Lab Manager ', 'pkdsdigital@gmail.com', '0.35', 'PKD', NULL, '9711521402', 'Smile2023', 'active', 'GL Keep Natural Anatomy as always ', ' ', '0.02mm broad and deep ', '0', '23-Aug-2023', '1', '', '0', '0'),
(11, '', 'BRC10', 'Ben', 'Lab Manager ', 'coldicottb@gmail.com', '0.70', 'ADL - UK', NULL, '9711521402', 'Ben#123456', 'active', 'GL Keep Natural Anatomy as always ', ' ', '-0.02', '0', '31-Aug-2023', '0', '', '0', '0'),
(12, '', 'BRC11', 'Paul', 'Lab Manager ', 'Info@aldandental.com', '0.10', 'ADL USA - P', NULL, '9711521402', 'Aldan23', 'active', 'Match adjacent - culp yong ', ' Match shape with adjacent tooth ', '-0.03', '0', '08-Sep-2023', '1', '', '0', '0'),
(13, '', 'BRC12', ' Rubin Ochild', 'Lab Manager ', 'cbdlabdental@gmail.com', '0.35', 'CBD Lab', NULL, '9711521402', 'Rubin@CBD2023', 'active', 'Match adjacent - culp yong ', ' ', '-0.02', '', '27-Sep-2023', '0', '', '0', '0'),
(14, '', 'BRC13', 'LAKE DENTAL LABORATORY', 'Lab Manager ', 'LAKEDENTALLABORATORY@gmail.com', '.50mm', 'LDL- USA', NULL, '9711521402', 'LAKE#dental#lab321', 'active', 'Match adjacent - culp yong ', ' ', '-0.01', '0', '01-Nov-2023', '0', '', '0', '0'),
(15, '', 'BRC14', 'Nikki', 'manager ', 'nmccrumb@frontierdentallab.com', '0.35', 'FDL- USA', NULL, '9711521402', 'NIKKI@2024', 'active', 'GL Keep Natural Anatomy as always ', ' ', '-0.02', '0', '30-Jan-2024', '1', '', '0', '0'),
(16, '', 'BRC15', 'Alex ', 'Lab Manager ', 'alexmedina@neodentallab.com', '0.04 ', 'NEO ', NULL, '9711521402', 'WELCOME@321', 'active', 'GL Keep Natural Anatomy ', ' ', 'Anteriors: 0.05 to 0.10', '0', '29-Apr-2024', '1', '', '0', '0'),
(17, '', 'BRC16', 'Rahim ', 'Lab Manager ', 'artcosmeticlab@gmail.com', '0.35', 'A C D L', NULL, '9711521402', 'Welcome@4321', 'active', 'GL Keep Natural Anatomy as always ', ' ', '-0.02', '0', '03-May-2024', '1', '', '0', '0'),
(18, '', 'BRC17', 'Den', 'Lab Manager ', 'vitalitytechllc@gmail.com', '0.35', 'VTDL', NULL, '9711521402', 'Welcome@54321', 'active', 'GL Keep Natural Anatomy as always ', ' ', '-0.02', '0', '22-May-2024', '1', '', '0', '0'),
(19, '', 'BRC18', 'Alex ', 'Lab Manager ', '3doralengineering@gmail.com', '0.35', 'OE Lab', NULL, '9711521402', 'Welcome@123456', 'active', 'GL Keep Natural Anatomy as always ', ' ', '-0.02', '0', '23-May-2024', '1', '', '0', '0'),
(20, '', 'BRC19', 'Nathan', 'Lab Manager ', 'cs@pdils.com', '0.35', 'PDIL ', NULL, '9711521402', 'Precision2024#', 'active', 'GL Keep Natural Anatomy as always ', ' Trail ', '0.02mm broad and deep ', '0', '13-Jun-2024', '1', '', '0', '0'),
(21, 'D0005', 'BRC20', 'test', '', '', '0.40', 'NDLtest', NULL, '979879879798', '0cbc6611f5540bd0809a388dc95a615b', 'active', 'Gl', '    NG', '0.02', '0', '12-Mar-2025', '1', '', '0', '0');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_finished`
--
ALTER TABLE `orders_finished`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_finished2`
--
ALTER TABLE `orders_finished2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_stl_files`
--
ALTER TABLE `orders_stl_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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

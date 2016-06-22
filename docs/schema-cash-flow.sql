-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2016 at 10:34 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cash-flow`
--

-- --------------------------------------------------------

--
-- Table structure for table `loan_details`
--

CREATE TABLE IF NOT EXISTS `loan_details` (
`id` int(11) NOT NULL,
  `time_created` timestamp(6) NULL DEFAULT NULL,
  `time_modified` timestamp(6) NULL DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `loan_id` varchar(49) NOT NULL,
  `is_processed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `loan_details`
--

INSERT INTO `loan_details` (`id`, `time_created`, `time_modified`, `file_path`, `loan_id`, `is_processed`) VALUES
(18, '2016-06-21 14:21:10.000000', NULL, 'http://localhost/il-cashflow-model/docs/2016-06-21/Flow-demo-Output - 06-21-2016_052110.xlsx', '000158498', 0),
(19, '2016-06-21 17:36:28.000000', NULL, 'http://localhost/il-cashflow-model/docs/2016-06-21/Flow-demo-Output - 06-21-2016_083628.xlsx', '000158498', 0),
(20, '2016-06-21 17:36:44.000000', NULL, 'http://localhost/il-cashflow-model/docs/2016-06-21/Flow-demo-Output - 06-21-2016_083644.xlsx', '000158498', 0),
(21, '2016-06-21 17:36:57.000000', NULL, 'http://localhost/il-cashflow-model/docs/2016-06-21/Flow-demo-Output - 06-21-2016_083657.xlsx', '000158498', 0),
(22, '2016-06-21 17:37:09.000000', NULL, 'http://localhost/il-cashflow-model/docs/2016-06-21/Flow-demo-Output - 06-21-2016_083709.xlsx', '000158498', 0),
(23, '2016-06-21 17:37:14.000000', NULL, 'http://localhost/il-cashflow-model/docs/2016-06-21/Flow-demo-Output - 06-21-2016_083714.xlsx', '000158498', 0),
(24, '2016-06-21 17:37:18.000000', NULL, 'http://localhost/il-cashflow-model/docs/2016-06-21/Flow-demo-Output - 06-21-2016_083718.xlsx', '000158498', 0),
(25, '2016-06-21 17:37:22.000000', NULL, 'http://localhost/il-cashflow-model/docs/2016-06-21/Flow-demo-Output - 06-21-2016_083722.xlsx', '000158498', 0),
(26, '2016-06-21 18:00:50.000000', NULL, 'http://localhost/il-cashflow-model/docs/2016-06-21/Flow-demo-Output - 06-21-2016_090049.xlsx', '000158498', 0),
(27, '2016-06-22 00:42:57.000000', NULL, 'http://localhost/il-cashflow-model/docs/2016-06-22/Flow-demo-Output - 06-22-2016_034257.xlsx', '000158498', 0),
(28, '2016-06-22 04:26:02.000000', NULL, 'http://localhost/il-cashflow-model/docs/2016-06-22/Flow-demo-Output - 06-22-2016_072602.xlsx', '000158498', 0),
(29, '2016-06-22 05:33:53.000000', NULL, 'http://localhost/il-cashflow-model/docs/2016-06-22/Flow-demo-Output - 06-22-2016_083352.xlsx', '000158498', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loan_details`
--
ALTER TABLE `loan_details`
 ADD PRIMARY KEY (`id`), ADD KEY `loan_id` (`loan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loan_details`
--
ALTER TABLE `loan_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

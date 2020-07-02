
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 10, 2017 at 12:26 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 
--

-- --------------------------------------------------------

--
-- Table structure for table `tblCustomer`
--
-- use your_db;

CREATE TABLE `tblCustomer` (
  `cust_phone` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `last` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `first` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`cust_phone`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tblCustomer`
--

INSERT INTO `tblCustomer` VALUES('dfadfs', '', '');
INSERT INTO `tblCustomer` VALUES('fdfsas', '', '');
INSERT INTO `tblCustomer` VALUES('Uyh', '', '');
INSERT INTO `tblCustomer` VALUES('tttt', '', '');
INSERT INTO `tblCustomer` VALUES('trtt', '', '');
INSERT INTO `tblCustomer` VALUES('jfalkdfj', '', '');
INSERT INTO `tblCustomer` VALUES('222 333 7777', 'Ysa ', 'Jack');
INSERT INTO `tblCustomer` VALUES('555 444 2222', 'Ysa', 'Jack');
INSERT INTO `tblCustomer` VALUES('666 333 2222', 'Ysa', 'Jack');
INSERT INTO `tblCustomer` VALUES('555 444 3333', 'Ysa', 'Jack');
INSERT INTO `tblCustomer` VALUES('333 777 6666', 'Ysa', 'Jack');
INSERT INTO `tblCustomer` VALUES('777 565 4343', 'Ysa', 'Jack');
INSERT INTO `tblCustomer` VALUES('777 343 5656', 'Ysa', 'Jack');
INSERT INTO `tblCustomer` VALUES('777 888 9999', 'Ysa', 'Jack');
INSERT INTO `tblCustomer` VALUES('777 222 8888', 'Ysa', 'Jack');
INSERT INTO `tblCustomer` VALUES('dfads', '', '');
INSERT INTO `tblCustomer` VALUES('7172154234', '', 'jfaklsd');

-- --------------------------------------------------------

--
-- Table structure for table `tblOrder`
--

CREATE TABLE `tblOrder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_num` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `cust_phone` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `status` text COLLATE latin1_general_ci NOT NULL,
  `order_date` varchar(15) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tblOrder`
--

INSERT INTO `tblOrder` VALUES(1, '124a536', '777 222 8888', 'Ready', '10/25/2015');
INSERT INTO `tblOrder` VALUES(2, '124a539', '777 888 9999', 'Ready', '10/25/2015');
INSERT INTO `tblOrder` VALUES(3, '124a543', '777 343 5656', 'Ready', '10/25/2015');
INSERT INTO `tblOrder` VALUES(4, '124a546', '777 565 4343', 'Ready', '10/25/2015');
INSERT INTO `tblOrder` VALUES(5, '124a550', '333 777 6666', 'Ready', '10/25/2015');
INSERT INTO `tblOrder` VALUES(6, '124a555', '555 444 3333', 'In Progress', '10/25/2015');
INSERT INTO `tblOrder` VALUES(7, '124a566', '666 333 2222', 'In Progress', '10/25/2015');
INSERT INTO `tblOrder` VALUES(8, '124a577', '555 444 2222', 'In Progress', '10/25/2015');
INSERT INTO `tblOrder` VALUES(9, 'ea2dc4', '222 333 7777', 'Ready', '10/26/2015');
INSERT INTO `tblOrder` VALUES(10, 'bc8a86', 'jfalkdfj', 'In Progress', '03/11/2016');
INSERT INTO `tblOrder` VALUES(11, 'af6993', 'trtt', 'Ready', '07/06/2016');
INSERT INTO `tblOrder` VALUES(12, 'af6996', 'tttt', 'Ready', '07/06/2016');
INSERT INTO `tblOrder` VALUES(13, '35d3b6', 'Uyh', 'Ready', '07/06/2016');
INSERT INTO `tblOrder` VALUES(14, '89a567', 'fdfsas', 'Ready', '07/07/2016');
INSERT INTO `tblOrder` VALUES(15, '89a5622', 'dfadfs', 'In Progress', '07/07/2016');
INSERT INTO `tblOrder` VALUES(16, '89a5627', 'dfads', 'In Progress', '07/07/2016');
INSERT INTO `tblOrder` VALUES(17, '96c586', '7172154234', 'Ready', '12/31/2016');

-- --------------------------------------------------------

--
-- Table structure for table `tblPho`
--

CREATE TABLE `tblPho` (
  `item_id` int(8) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `type` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `image` text COLLATE latin1_general_ci NOT NULL,
  `price` double(10,2) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tblPho`
--

INSERT INTO `tblPho` VALUES(1, 'pho1', 'pho', 'Pho Tai', 'Pho with raw beef', 'pho-images/photai.jpg', 8.00);
INSERT INTO `tblPho` VALUES(2, 'pho2', 'pho', 'Pho Chin', 'Pho with cooked beef', 'pho-images/phochin.jpg', 6.00);
INSERT INTO `tblPho` VALUES(3, 'pho3', 'pho', 'Pho Bo Vien', 'Pho with meet ball', 'pho-images/phobovien.jpg', 7.00);
INSERT INTO `tblPho` VALUES(4, 'com1', 'com', 'Bo Luc Lac', 'Steak cut in cubes with salad', '', 9.85);
INSERT INTO `tblPho` VALUES(5, 'com2', 'com', 'Tom Rang Man', 'Simmered shrimps', '', 8.85);
INSERT INTO `tblPho` VALUES(6, 'com3', 'com', 'Com Chien Duong Chau', 'Yong Chow price rice', '', 7.85);
INSERT INTO `tblPho` VALUES(7, 'khaivi1', 'khaivi', 'Cha Gio', 'Egg rolls', '', 4.00);
INSERT INTO `tblPho` VALUES(11, 'khaivi3', 'khaivi', 'Hoanh Thanh', 'Won ton', '', 4.00);
INSERT INTO `tblPho` VALUES(10, 'khaivi2', 'khaivi', 'Goi Cuon', 'Shrimp rolls', '', 4.00);

-- --------------------------------------------------------

--
-- Table structure for table `tblTransaction`
--

CREATE TABLE `tblTransaction` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `qty` int(2) NOT NULL,
  `order_num` varchar(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`trans_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=85 ;

--
-- Dumping data for table `tblTransaction`
--

INSERT INTO `tblTransaction` VALUES(74, 'khaivi1', 1, '35d3b6');
INSERT INTO `tblTransaction` VALUES(73, 'pho1', 1, 'af6996');
INSERT INTO `tblTransaction` VALUES(75, 'pho2', 1, '35d3b6');
INSERT INTO `tblTransaction` VALUES(72, 'khaivi1', 1, 'af6993');
INSERT INTO `tblTransaction` VALUES(71, 'khaivi1', 1, 'bc8a86');
INSERT INTO `tblTransaction` VALUES(70, 'khaivi1', 1, 'ea2dc4');
INSERT INTO `tblTransaction` VALUES(69, 'pho1', 1, '124a577');
INSERT INTO `tblTransaction` VALUES(68, 'khaivi1', 1, '124a577');
INSERT INTO `tblTransaction` VALUES(67, 'pho1', 1, '124a566');
INSERT INTO `tblTransaction` VALUES(66, 'com1', 1, '124a566');
INSERT INTO `tblTransaction` VALUES(65, 'khaivi1', 1, '124a566');
INSERT INTO `tblTransaction` VALUES(64, 'com1', 1, '124a555');
INSERT INTO `tblTransaction` VALUES(63, 'com3', 1, '124a555');
INSERT INTO `tblTransaction` VALUES(62, 'pho1', 1, '124a555');
INSERT INTO `tblTransaction` VALUES(61, 'com1', 1, '124a550');
INSERT INTO `tblTransaction` VALUES(60, 'pho2', 1, '124a550');
INSERT INTO `tblTransaction` VALUES(59, 'khaivi1', 1, '124a550');
INSERT INTO `tblTransaction` VALUES(58, 'pho1', 1, '124a546');
INSERT INTO `tblTransaction` VALUES(57, 'khaivi3', 2, '124a546');
INSERT INTO `tblTransaction` VALUES(56, 'com3', 1, '124a543');
INSERT INTO `tblTransaction` VALUES(55, 'pho1', 2, '124a543');
INSERT INTO `tblTransaction` VALUES(54, 'khaivi2', 3, '124a543');
INSERT INTO `tblTransaction` VALUES(53, 'com2', 1, '124a539');
INSERT INTO `tblTransaction` VALUES(52, 'khaivi3', 2, '124a539');
INSERT INTO `tblTransaction` VALUES(51, 'com1', 1, '124a536');
INSERT INTO `tblTransaction` VALUES(50, 'pho1', 1, '124a536');
INSERT INTO `tblTransaction` VALUES(49, 'khaivi1', 2, '124a536');
INSERT INTO `tblTransaction` VALUES(76, 'khaivi1', 1, '89a567');
INSERT INTO `tblTransaction` VALUES(77, 'pho1', 1, '89a567');
INSERT INTO `tblTransaction` VALUES(78, 'khaivi1', 1, '89a5622');
INSERT INTO `tblTransaction` VALUES(79, 'pho1', 1, '89a5622');
INSERT INTO `tblTransaction` VALUES(80, 'pho2', 1, '89a5622');
INSERT INTO `tblTransaction` VALUES(81, 'pho3', 1, '89a5622');
INSERT INTO `tblTransaction` VALUES(82, 'khaivi1', 1, '89a5627');
INSERT INTO `tblTransaction` VALUES(83, 'pho1', 1, '89a5627');
INSERT INTO `tblTransaction` VALUES(84, 'khaivi1', 1, '96c586');

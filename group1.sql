-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 08, 2014 at 02:25 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `group1`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE IF NOT EXISTS `tbl_brand` (
  `brand_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(100) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`) VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'Sony'),
(4, 'Nokia'),
(5, 'HTC'),
(6, 'LG'),
(7, 'BlackBerry');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(100) NOT NULL,
  `cate_parent` int(10) NOT NULL,
  `cate_level` int(10) NOT NULL DEFAULT '1' COMMENT 'start from 1',
  `cate_orderby` int(10) NOT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cate_id`, `cate_name`, `cate_parent`, `cate_level`, `cate_orderby`) VALUES
(1, 'Smart Phone', 0, 1, 1),
(2, 'Android', 1, 2, 1),
(3, 'iPhones', 1, 2, 2),
(4, 'Windows Phones', 1, 2, 3),
(5, 'BlackBerry', 1, 2, 4),
(6, 'Feature Phones', 0, 1, 2),
(7, 'Smart Watches', 0, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config`
--

CREATE TABLE IF NOT EXISTS `tbl_config` (
  `config_page` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_config`
--

INSERT INTO `tbl_config` (`config_page`) VALUES
(12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE IF NOT EXISTS `tbl_feedback` (
  `feedback_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `feedback_name` varchar(100) NOT NULL,
  `feedback_email` varchar(100) NOT NULL,
  `feedback_content` text NOT NULL,
  `feedback_time` datetime NOT NULL,
  `feedback_rate` double NOT NULL COMMENT 'range from 0->5',
  `pro_id` int(10) NOT NULL,
  `feedback_status` int(11) NOT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedback_id`, `feedback_name`, `feedback_email`, `feedback_content`, `feedback_time`, `feedback_rate`, `pro_id`, `feedback_status`) VALUES
(1, 'Toan', 'toan@local.com', 'Perfect product with a reasonable price.', '2014-08-29 02:00:00', 5, 6, 1),
(2, 'Hung', 'hung@local.com', 'Not outstanding but quite good compare to other products with that price. The delevery is fast, right on time. I''m happy with your service.', '2014-08-29 05:09:00', 4, 6, 1),
(3, 'Linh', 'linh@local.com', 'not that good', '2014-08-29 07:50:13', 1, 6, 1),
(5, 'Alex', 'alex@local.com', 'Urgh!  The shipping is so freaking slow.', '2014-08-29 16:53:14', 2, 6, 1),
(8, 'toannt', 'toannt2@smartosc.com', 'very good', '2014-08-29 17:17:57', 3, 6, 1),
(9, 'peter', 'peter@local.com', 'overpriced product. I don''t understand all the hype.', '2014-09-03 10:55:09', 2, 1, 1),
(10, 'qwwee', 'tuan@local.com', 'fdgdfg', '2014-09-05 15:11:22', 2, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_image`
--

CREATE TABLE IF NOT EXISTS `tbl_image` (
  `img_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img_link` varchar(100) NOT NULL,
  `pro_id` int(10) NOT NULL,
  `img_status` int(2) NOT NULL DEFAULT '1' COMMENT '1:maiin 0:alternative',
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=172 ;

--
-- Dumping data for table `tbl_image`
--

INSERT INTO `tbl_image` (`img_id`, `img_link`, `pro_id`, `img_status`) VALUES
(1, 'public/images/products/1/1_1.jpg', 1, 1),
(2, 'public/images/products/2/2_2.jpg', 2, 0),
(3, 'public/images/products/2/2_1.jpg', 2, 1),
(4, 'public/images/products/3/3_5.jpg', 3, 0),
(5, 'public/images/products/3/3_1.jpg', 3, 1),
(6, 'public/images/products/3/3_2.jpg', 3, 0),
(7, 'public/images/products/3/3_3.jpg', 3, 0),
(8, 'public/images/products/3/3_4.jpg', 3, 0),
(9, 'public/images/products/4/4_2.jpg', 4, 0),
(10, 'public/images/products/4/4_1.jpg', 4, 1),
(11, 'public/images/products/4/4_4.jpg', 4, 0),
(12, 'public/images/products/4/4_3.jpg', 4, 0),
(13, 'public/images/products/4/4_5.jpg', 4, 0),
(14, 'public/images/products/5/5_1.jpg', 5, 1),
(15, 'public/images/products/5/5_2.jpg', 5, 0),
(16, 'public/images/products/5/5_5.jpg', 5, 0),
(17, 'public/images/products/5/5_3.jpg', 5, 0),
(18, 'public/images/products/5/5_4.jpg', 5, 0),
(19, 'public/images/products/6/6_4.jpg', 6, 0),
(20, 'public/images/products/6/6_8.jpg', 6, 0),
(21, 'public/images/products/6/6_5.jpg', 6, 0),
(22, 'public/images/products/6/6_6.jpg', 6, 0),
(23, 'public/images/products/6/6_3.jpg', 6, 0),
(24, 'public/images/products/6/6_1.jpg', 6, 1),
(25, 'public/images/products/6/6_9.jpg', 6, 0),
(26, 'public/images/products/6/6_7.jpg', 6, 0),
(27, 'public/images/products/6/6_2.jpg', 6, 0),
(28, 'public/images/products/7/7_2.jpg', 7, 0),
(29, 'public/images/products/7/7_3.jpg', 7, 0),
(30, 'public/images/products/7/7_1.jpg', 7, 1),
(31, 'public/images/products/8/8_2.jpg', 8, 0),
(32, 'public/images/products/8/8_3.jpg', 8, 0),
(33, 'public/images/products/8/8_1.jpg', 8, 1),
(34, 'public/images/products/9/9_3.jpg', 9, 0),
(35, 'public/images/products/9/9_2.jpg', 9, 0),
(36, 'public/images/products/9/9_1.jpg', 9, 1),
(37, 'public/images/products/10/10_1.jpg', 10, 1),
(38, 'public/images/products/10/10_2.jpg', 10, 0),
(39, 'public/images/products/11/11_4.jpg', 11, 0),
(40, 'public/images/products/11/11_3.jpg', 11, 0),
(41, 'public/images/products/11/11_2.jpg', 11, 0),
(42, 'public/images/products/11/11_1.jpg', 11, 1),
(43, 'public/images/products/12/12_2.jpg', 12, 0),
(44, 'public/images/products/12/12_1.jpg', 12, 1),
(45, 'public/images/products/12/12_3.jpg', 12, 0),
(46, 'public/images/products/13/13_2.jpg', 13, 0),
(47, 'public/images/products/13/13_3.jpg', 13, 0),
(48, 'public/images/products/13/13_1.jpg', 13, 1),
(49, 'public/images/products/14/14_1.jpg', 14, 1),
(50, 'public/images/products/14/14_2.jpg', 14, 0),
(51, 'public/images/products/15/15_4.jpg', 15, 0),
(52, 'public/images/products/15/15_5.jpg', 15, 0),
(53, 'public/images/products/15/15_2.jpg', 15, 0),
(54, 'public/images/products/15/15_1.jpg', 15, 1),
(55, 'public/images/products/15/15_3.jpg', 15, 0),
(56, 'public/images/products/15/15_6.jpg', 15, 0),
(57, 'public/images/products/16/16_2.jpg', 16, 0),
(58, 'public/images/products/16/16_1.jpg', 16, 1),
(59, 'public/images/products/17/17_6.jpg', 17, 0),
(60, 'public/images/products/17/17_1.jpg', 17, 1),
(61, 'public/images/products/17/17_5.jpg', 17, 0),
(62, 'public/images/products/17/17_3.jpg', 17, 0),
(63, 'public/images/products/17/17_2.jpg', 17, 0),
(64, 'public/images/products/17/17_4.jpg', 17, 0),
(65, 'public/images/products/18/18_3.jpg', 18, 0),
(66, 'public/images/products/18/18_2.jpg', 18, 0),
(67, 'public/images/products/18/18_4.jpg', 18, 0),
(68, 'public/images/products/18/18_1.jpg', 18, 1),
(69, 'public/images/products/18/18_6.jpg', 18, 0),
(70, 'public/images/products/18/18_7.jpg', 18, 0),
(71, 'public/images/products/18/18_5.jpg', 18, 0),
(72, 'public/images/products/19/19_1.jpg', 19, 1),
(73, 'public/images/products/19/19_2.jpg', 19, 0),
(74, 'public/images/products/19/19_3.jpg', 19, 0),
(75, 'public/images/products/19/19_4.jpg', 19, 0),
(76, 'public/images/products/19/19_5.jpg', 19, 0),
(77, 'public/images/products/20/20_2.jpg', 20, 0),
(78, 'public/images/products/20/20_1.jpg', 20, 1),
(79, 'public/images/products/21/21_2.jpg', 21, 0),
(80, 'public/images/products/21/21_1.jpg', 21, 1),
(81, 'public/images/products/21/21_7.jpg', 21, 0),
(82, 'public/images/products/21/21_4.jpg', 21, 0),
(83, 'public/images/products/21/21_8.jpg', 21, 0),
(84, 'public/images/products/21/21_5.jpg', 21, 0),
(85, 'public/images/products/21/21_6.jpg', 21, 0),
(86, 'public/images/products/21/21_3.jpg', 21, 0),
(87, 'public/images/products/22/22_1.jpg', 22, 1),
(88, 'public/images/products/22/22_4.jpg', 22, 0),
(89, 'public/images/products/22/22_3.jpg', 22, 0),
(90, 'public/images/products/22/22_2.jpg', 22, 0),
(91, 'public/images/products/23/23_2.jpg', 23, 0),
(92, 'public/images/products/23/23_1.jpg', 23, 1),
(93, 'public/images/products/24/24_1.jpg', 24, 1),
(94, 'public/images/products/25/25_1.jpg', 25, 1),
(95, 'public/images/products/25/25_3.jpg', 25, 0),
(96, 'public/images/products/25/25_2.jpg', 25, 0),
(97, 'public/images/products/26/26_1.jpg', 26, 1),
(98, 'public/images/products/26/26_5.jpg', 26, 0),
(99, 'public/images/products/26/26_2.jpg', 26, 0),
(100, 'public/images/products/26/26_3.jpg', 26, 0),
(101, 'public/images/products/26/26_4.jpg', 26, 0),
(102, 'public/images/products/27/27_1.jpg', 27, 1),
(103, 'public/images/products/28/28_1.jpg', 28, 1),
(104, 'public/images/products/29/29_2.jpg', 29, 0),
(105, 'public/images/products/29/29_1.jpg', 29, 1),
(106, 'public/images/products/30/30_8.jpg', 30, 0),
(107, 'public/images/products/30/30_4.jpg', 30, 0),
(108, 'public/images/products/30/30_5.jpg', 30, 0),
(109, 'public/images/products/30/30_6.jpg', 30, 0),
(110, 'public/images/products/30/30_2.jpg', 30, 0),
(111, 'public/images/products/30/30_7.jpg', 30, 0),
(112, 'public/images/products/30/30_3.jpg', 30, 0),
(113, 'public/images/products/30/30_1.jpg', 30, 1),
(114, 'public/images/products/31/31_3.jpg', 31, 0),
(115, 'public/images/products/31/31_1.jpg', 31, 1),
(116, 'public/images/products/31/31_2.jpg', 31, 0),
(117, 'public/images/products/32/32_1.jpg', 32, 1),
(118, 'public/images/products/33/33_2.jpg', 33, 0),
(119, 'public/images/products/33/33_1.jpg', 33, 1),
(120, 'public/images/products/34/34_4.jpg', 34, 0),
(121, 'public/images/products/34/34_1.jpg', 34, 1),
(122, 'public/images/products/34/34_2.jpg', 34, 0),
(123, 'public/images/products/34/34_3.jpg', 34, 0),
(124, 'public/images/products/35/35_1.jpg', 35, 1),
(125, 'public/images/products/35/35_3.jpg', 35, 0),
(126, 'public/images/products/35/35_2.jpg', 35, 0),
(127, 'public/images/products/35/35_4.jpg', 35, 0),
(128, 'public/images/products/36/36_2.jpg', 36, 0),
(129, 'public/images/products/36/36_1.jpg', 36, 1),
(130, 'public/images/products/36/36_3.jpg', 36, 0),
(131, 'public/images/products/37/37_3.jpg', 37, 0),
(132, 'public/images/products/37/37_2.jpg', 37, 0),
(133, 'public/images/products/37/37_1.jpg', 37, 1),
(134, 'public/images/products/38/38_1.jpg', 38, 1),
(135, 'public/images/products/38/38_3.jpg', 38, 0),
(136, 'public/images/products/38/38_2.jpg', 38, 0),
(137, 'public/images/products/39/39_1.jpg', 39, 1),
(138, 'public/images/products/39/39_2.jpg', 39, 0),
(139, 'public/images/products/39/39_3.jpg', 39, 0),
(140, 'public/images/products/40/40_1.jpg', 40, 1),
(141, 'public/images/products/40/40_3.jpg', 40, 0),
(142, 'public/images/products/40/40_2.jpg', 40, 0),
(143, 'public/images/products/41/41_1.jpg', 41, 1),
(144, 'public/images/products/41/41_2.jpg', 41, 0),
(145, 'public/images/products/42/42_1.jpg', 42, 1),
(146, 'public/images/products/43/43_1.jpg', 43, 1),
(147, 'public/images/products/44/44_3.jpg', 44, 0),
(148, 'public/images/products/44/44_2.jpg', 44, 0),
(149, 'public/images/products/44/44_1.jpg', 44, 1),
(150, 'public/images/products/45/45_4.jpg', 45, 0),
(151, 'public/images/products/45/45_1.jpg', 45, 1),
(152, 'public/images/products/45/45_5.jpg', 45, 0),
(153, 'public/images/products/45/45_2.jpg', 45, 0),
(154, 'public/images/products/45/45_3.jpg', 45, 0),
(155, 'public/images/products/46/46_1.jpg', 46, 1),
(156, 'public/images/products/47/47_2.jpg', 47, 0),
(157, 'public/images/products/47/47_3.jpg', 47, 0),
(158, 'public/images/products/47/47_1.jpg', 47, 1),
(159, 'public/images/products/47/47_4.jpg', 47, 0),
(160, 'public/images/products/48/48_4.jpg', 48, 0),
(161, 'public/images/products/48/48_1.jpg', 48, 1),
(162, 'public/images/products/48/48_3.jpg', 48, 0),
(163, 'public/images/products/48/48_2.jpg', 48, 0),
(164, 'public/images/products/49/49_3.jpg', 49, 0),
(165, 'public/images/products/49/49_1.jpg', 49, 1),
(166, 'public/images/products/49/49_5.jpg', 49, 0),
(167, 'public/images/products/49/49_2.jpg', 49, 0),
(168, 'public/images/products/49/49_4.jpg', 49, 0),
(169, 'public/images/products/50/50_3.jpg', 50, 0),
(170, 'public/images/products/50/50_2.jpg', 50, 0),
(171, 'public/images/products/50/50_1.jpg', 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_name` varchar(100) NOT NULL,
  `order_email` varchar(100) NOT NULL,
  `order_address` varchar(100) NOT NULL,
  `order_phone` varchar(11) NOT NULL,
  `order_time` datetime NOT NULL,
  `order_status` int(10) NOT NULL DEFAULT '0' COMMENT '-1:cancel 0:not paid 1:paid',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `order_name`, `order_email`, `order_address`, `order_phone`, `order_time`, `order_status`) VALUES
(1, 'Toan', 'toan@local.com', 'Namdinh', '0978372337', '2014-08-22 05:00:00', 1),
(2, 'Hung', 'hung@local.com', 'Hanoi', '0987234512', '2014-08-22 07:00:00', 1),
(3, 'Luan', 'luan@local.com', 'Hanoi', '0987123456', '2014-08-23 06:00:00', 1),
(4, 'toannt', 'toannt2@smartosc.com', 'Fargo', '0987123456', '2014-09-08 13:48:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_order_detail` (
  `order_id` int(10) NOT NULL,
  `pro_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `pro_name` varchar(100) NOT NULL,
  `pro_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`order_id`, `pro_id`, `quantity`, `pro_name`, `pro_price`) VALUES
(1, 1, 2, 'Apple iPhone 4 8GB (White)', 150),
(1, 8, 1, 'Samsung Galaxy S5 SM-G900H 16GB', 700),
(2, 1, 1, 'Apple iPhone 4 8GB (White)', 150),
(3, 1, 1, 'Apple iPhone 4 8GB (White)', 150),
(2, 8, 1, 'Samsung Galaxy S5 SM-G900H 16GB', 700),
(3, 13, 2, 'Sony Xperia M C1904', 200),
(4, 4, 1, 'Apple iPhone 5s 16GB-Gold', 679),
(4, 48, 1, 'Pebble Smartwatch for iPhone and Android-Black', 150),
(4, 33, 2, 'BlackBerry Z10', 237);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `pro_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(100) NOT NULL,
  `pro_list_price` double NOT NULL,
  `pro_sale_price` double NOT NULL,
  `pro_desc` text NOT NULL,
  `pro_country` varchar(100) NOT NULL,
  `pro_brand` int(10) NOT NULL,
  `pro_image` varchar(150) NOT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pro_id`, `pro_name`, `pro_list_price`, `pro_sale_price`, `pro_desc`, `pro_country`, `pro_brand`, `pro_image`) VALUES
(1, 'Apple iPhone 4 8GB-White', 150, 150, 'Size (LWH): 2.5 inches, 0.5 inches, 4.5 inches\r\nWeight: 8 ounces\r\nMinimum Rated Talk Time: 6 hours\r\nMinimum Rated Standby Time: 50 hours\r\nBattery Type: Lithium Ion', 'USA', 1, 'public/images/products/1/1_1.jpg'),
(2, 'Apple iPhone 4S 16GB-White', 500, 329.98, 'Siri intelligent assistant.\r\n3.5-inch Retina display.\r\n8MP iSight camera with HD video recording.\r\n802.11b/g/n Wi-Fi (802.11n 2.4GHz only).\r\nBluetooth 4.0 wireless technology.', 'USA', 1, 'public/images/products/2/2_1.jpg'),
(3, 'Apple iPhone 5', 699.99, 504, '4-inch Retina display\r\nA6 chip, iOS 6 and iCloud\r\n8.0MP iSight camera\r\nAll-new EarPods and improved audio\r\nUnlocked cell phones are compatible with GSM carriers like AT&T and T-Mobile as well as with GSM SIM cards (e.g. H20 and select prepaid carriers). Unlocked cell phones will not work with CDMA Carriers like Sprint, Verizon, Boost or Virgin', 'USA', 1, 'public/images/products/3/3_1.jpg'),
(4, 'Apple iPhone 5s 16GB-Gold', 679, 674, '4.0-inch Retina display\r\nA7 chip with M7 motion coprocessor\r\nTouch ID fingerprint sensor\r\n8MP iSight camera with True Tone flash and 1080p HD video recording\r\nUnlocked cell phones are compatible with GSM carriers like AT&T and T-Mobile as well as with GSM SIM cards (e.g. H20 and select prepaid carriers). Unlocked cell phones will not work with CDMA Carriers like Sprint, Verizon, Boost or Virgin.', 'USA', 1, 'public/images/products/4/4_1.jpg'),
(5, 'Apple iPhone 5s 16GB-Gray', 674.95, 674.95, '4.0-inch Retina display\r\nA7 chip with M7 motion coprocessor\r\nTouch ID fingerprint sensor\r\n8MP iSight camera with True Tone flash and 1080p HD video recording\r\nUnlocked cell phones are compatible with GSM carriers like AT&T and T-Mobile as well as with GSM SIM cards (e.g. H20 and select prepaid carriers). Unlocked cell phones will not work with CDMA Carriers like Sprint, Verizon, Boost or Virgin.', 'USA', 1, 'public/images/products/5/5_1.jpg'),
(6, 'Samsung Galaxy S3 Mini GT-i8190', 300, 173.49, '8GB Internal memory; 1 GB RAM; microSD Memory card slot; Standard battery, Li-Ion 1500 mAh\r\n5 MP Primary Camera, autofocus, LED flash, Video 720p@30fps, Secondary VGA camera\r\nGSM 850/900/1800/1900; HSDPA 900/1900/2100\r\nSuper AMOLED capacitive touchscreen 4.0-Inch\r\nOS Android OS, v4.1 (Jelly Bean), CPU Dual-core 1 GHz, Wi-Fi 802.11 a/b/g/n, DLNA, Wi-Fi Direct, Wi-Fi hotspot, Bluetooth v4.0 with A2DP, LE, EDR, NFC,', 'Vietnam', 2, 'public/images/products/6/6_1.jpg'),
(7, 'Samsung Galaxy S4 Mini GT-i9192 GSM Dual Sim', 699.99, 289.5, 'Cellular Band - Quad-Band 850 / 900 / 1800 / 1900 Mhz\r\nCellular Band 3G - 850 / 1900 / 2100 Mhz', 'Vietnam', 2, 'public/images/products/7/7_1.jpg'),
(8, 'Samsung Galaxy S5 SM-G900H 16GB', 799.99, 700, '5.1" Full HD Super AMOLED? (1080 x 1920)\r\nExyon Quad Core; 1.9GHz,1.3GHz\r\n16 MP Camera with LED Flash\r\nMust be activated with an Americas-region SIM\r\n16GB of Internal Memory', 'Korea', 2, 'public/images/products/8/8_1.jpg'),
(9, 'Samsung Galaxy Fame', 299.99, 200, '3G HSDPA 900/2100\r\nQuadBand GSM\r\nBluetooth\r\nWi-Fi\r\nAuto-focus, Geo-tagging, touch focus, face detection', 'Korea', 2, 'public/images/products/9/9_1.jpg'),
(10, 'Samsung Galaxy Ace 2 i8160-White', 599.99, 153.35, '3G bands are 850/1900/2100 MHz or 900/2100 MHz, depending on the cellphone version. Check the description in seller condition or ask seller.\r\nGSM 850 / 900 / 1800 / 1900\r\nWi-Fi 802.11 b/g/n, DLNA, Wi-Fi Direct, Wi-Fi hotspot\r\nA-GPS support and GLONASS\r\nAndroid OS, v2.3', 'Korea', 2, 'public/images/products/10/10_1.jpg'),
(11, 'Samsung Galaxy Young S5360', 279.89, 250, '830 MHz ARMv6 CPU\r\n3 Inches TFT Touchscreen,Android\r\n850 / 900 / 1800 / 1900MHz GSM&EDGE Band. 3G Network&Data: HSDPA7.2\r\n2MP camera, Wi-FI\r\nA-GPS', 'Vietnam', 2, 'public/images/products/11/11_1.jpg'),
(12, 'Sony Xperia E C1504', 189.99, 150, '3.5 inch display with 320 X 480 pixels, 262,000 color TFT\r\nStandby Time : Up to 530 hours: Talk Time: Up to 6 hours\r\n3.2 MP camera with 4X digital zoom and geotagging\r\nCPU/ Processor : 1 GHz Qualcomm Snapdragon processor\r\nGoogle Android 4.0 Operating System', 'Japan', 3, 'public/images/products/12/12_1.jpg'),
(13, 'Sony Xperia M C1904', 249.99, 200, 'One-touch connectivity with NFC for easy pairing and sharing of content with other NFC-capable devices, including one-touch mirroring with NFC-capable televisions.\r\n5MP fast capture camera with HDR for photos and 4? display for immersive entertainment\r\nQualcomm Snapdragon? S4 Plus dual-core 1.0 Ghz processor and Battery STAMINA Mode', 'Japan', 3, 'public/images/products/13/13_1.jpg'),
(14, 'Sony Xperia Z2 D6503 ', 899.99, 586.98, 'GSM 850 / 900 / 1800 / 1900\r\nHSDPA 850 / 900 / 1700 / 1900 / 2100\r\nLTE 700/800/850/900/1700/1800/1900/2100/2600\r\n1080 x 1920 pixels, 5.2 inches (~424 ppi pixel density)\r\n16 GB, 3 GB RAM', 'Japan', 3, 'public/images/products/14/14_1.jpg'),
(15, 'Sony Xperia Z1 C6903', 415, 409, 'Sony Xperia Honami Z1 16GB Black 20mp Camera 5" 4G LTE', 'Vietnam', 3, 'public/images/products/15/15_1.jpg'),
(16, 'Sony Xperia U ST25A-BP', 500, 500, 'Networks: UMTS HSPA 850 (Band V), 1900 (Band II), 2100 (Band I); GSM GPRS/EDGE 850, 900, 1800, 1900\r\nGoogle Android 2.3 (Gingerbread); 1 GHz STE U8500 Dual Core; Internal storage: 4 GB/RAM 512 MB\r\nDisplay: 3.5-Inch Capacitive touch screen, scratch-resistant, anti-reflection coating on mineral glass\r\nCamera: 5 megapixel with HD 720p video recording\r\nBlack end cap can be replaced with the extra pink end cap included in the box.', 'Vietnam', 3, 'public/images/products/16/16_1.jpg'),
(17, 'HTC One X', 300, 225.99, '16 GB storage, 1 GB RAM; Android OS, v4.0, v.4.0.4 (Ice Cream Sandwich)\r\nLTE 700 MHz Class 17 / 1700 / 2100\r\nGSM 850 / 900 / 1800 / 1900; HSDPA 850 / 1900 / 2100\r\nQualcomm MSM8960 Snapdragon Dual-core 1.5 GHz Krait\r\nSuper IPS LCD2 capacitive touchscreen, 16M colors\r\n720 x 1280 pixels, 4.7 inches (~312 ppi pixel density)\r\nPrimary: 8 MP, 3264x2448 pixels, autofocus, LED flash / Secondary: 1.3 MP, 720p', 'Taiwan', 5, 'public/images/products/17/17_1.jpg'),
(18, 'HTC One M7 32GB-Silver', 649.99, 599.99, 'Display: 4.7-inches\r\nCamera: HTC UltraPixel\r\nProcessor Speed: 1.7 GHz\r\nOS: Android 4.2 (Jelly Bean)\r\nUnlocked cell phones are compatible with GSM carriers like AT&T and T-Mobile as well as with GSM SIM cards (e.g. H20 and select prepaid carriers). Unlocked cell phones will not work with CDMA Carriers like Sprint, Verizon, Boost or Virgin.', 'Taiwan', 5, 'public/images/products/18/18_1.jpg'),
(19, 'HTC One M8-Gunmetal Grey', 800, 653.95, 'Display: 5.0-inches\r\nCamera: HTC UltraPixel\r\nProcessor Speed: 2.3 GHz\r\nOS: Android 4.4.2 (KitKat)', 'Taiwan', 5, 'public/images/products/19/19_1.jpg'),
(20, 'LG Optimus L7', 200, 146, '2G Network GSM 850 / 900 / 1800 / 1900 - SIM 1 & SIM 2\r\n3G Network HSDPA 900 / 1900 / 2100\r\nAndroid OS, v4.1.2 (Jelly Bean)\r\n4.3 inches Touch Screen. 8MP With VGA Front Camera\r\nDual Sim Card, Wi-Fi, microSD Card Slot up to 32 GB', 'Vietnam', 6, 'public/images/products/20/20_1.jpg'),
(21, 'LG Optimus L9', 200, 168, 'Display: 4.5-inches\r\nCamera: 5-MP\r\nInput: Touchscreen\r\nOS: Android', 'Japan', 6, 'public/images/products/21/21_1.jpg'),
(22, 'LG G Flex', 500, 500, 'World first Vertically Curved Display (Real RGB)\r\nCurved battery\r\nUltra slim and weight (7.9mm/177g)\r\nSelf healing back cover\r\n', 'Japan', 6, 'public/images/products/22/22_1.jpg'),
(23, 'LG Optimus Exceed 2', 129.99, 95.91, '4.5 inch WVGA Display with Gorilla Glass touch screen\r\n5 Megapixel autofocus camera\r\nAndriod 4.4.2 KitKat\r\nVideo player with touch lock, Play on Screen Function', 'Japan', 6, 'public/images/products/23/23_1.jpg'),
(24, 'Nokia Lumia 520 8GB', 120, 120, 'OS - Windows Phone 8\r\nDimensions - 119.9 x 64 x 9.9 mm, 75.7 cc (4.72 x 2.52 x 0.39 in) Weight 124 g (4.37 oz)\r\nIPS LCD capacitive touchscreen, 16M colors\r\n8 GB, 512 MB RAM\r\nCamera - 5 MP, 25921936 pixels, autofocus', 'Finland', 4, 'public/images/products/24/24_1.jpg'),
(25, 'Nokia Lumia 920', 500, 350, '2G: GSM 850 / 900 / 1800 / 1900, 3G: HSDPA 850 / 900 / 1900 / 2100, 4G: LTE LTE 700 MHz Class 17 / 1700 / 2100\r\n4.5" IPS LCD Capacitive Multi-Touchscreen w/ Protective Corning Gorilla Glass 2\r\nMicrosoft Windows Phone 8 (pgradeable to WP8 Black), Dual-Core 1.5 GHz Krait Processor, Chipset: Qualcomm MSM896 Snapdragon, Adreno 225 Graphics', 'Finland', 4, 'public/images/products/25/25_1.jpg'),
(26, 'HTC X310E Titan', 300, 284, 'Network: Quad-band GSM/GPRS/EDGE:850/900/1800/1900 MHz. HSPA/WCDMA: Europe/Asia: 850/900/2100 MHz\r\nPlatform: Windows® Phone OS 7.5. CPU Processing Speed: 1.5 GHz. Total storage 16 GB. Available storage: up to 12.63 GB. RAM: 512 MB.', 'Taiwan', 5, 'public/images/products/26/26_1.jpg'),
(27, 'HTC HD7 S T9295 ', 100, 89.95, 'This unlocked cell phone will work on GSM carriers like AT&T and T-Mobile. Not all carrier features may be supported.\r\n3G-enabled Windows Phone 7 smartphone with extra-large 4.3-inch touchscreen for fast typing on virtual keyboard and excellent multimedia.', 'Vietnam', 5, 'public/images/products/27/27_1.jpg'),
(28, 'Samsung Focus I917', 150, 100, 'Ultra-thin 3G-enabled Windows Phone 7 smartphone with 4-inch Super-Amoled touchscreen\r\nWindows Phone 7 OS provides easy access to social networking, personal/corporate e-mail, office apps, Xbox LIVE games, streaming media, and more\r\n5-megapixel camera with HD 720p video capture;8 GB internal memory; microSD memory expansion; Wireless-N Wi-Fi;', 'China', 2, 'public/images/products/28/28_1.jpg'),
(29, 'HTC 8XT 8GB 4G LTE', 197.59, 169.99, 'CDMA 800 / 1900, 3G Network: CDMA2000 1xEV-DO, 4G Network: LTE 1900\r\n4.3" Capacitive Multi-Touchscreen w/ Protective Corning Gorilla Glass\r\nMicrosoft Windows Phone 8 OS, Dual-Core 1.4 GHz Krait Processor, Chipset: Qualcomm MSM893 Snapdragon 4, Adreno 305 Graphics\r\n8 Megapixel Camera (3264 x 2448 pixels) ) w/ Autofocus, LED flash + Front-Facing 1.6 Megapixel Camera + Video 1080p@30fps', 'China', 5, 'public/images/products/29/29_1.jpg'),
(30, 'Nokia Lumia 900-Black', 500, 450, '4.3" AMOLED ClearBlack glass touchscreen, one-piece polycarbonate body, excellent antenna performance.\r\nCarl Zeiss optics, 8 MP main camera, dual LED flash, Auto Focus, 1 MP front camera, video calling.\r\nAll day battery life, up to 7 hours talk time.\r\n', 'China', 4, 'public/images/products/30/30_1.jpg'),
(31, 'BlackBerry Z30', 200, 163, '.3" AMOLED ClearBlack glass touchscreen, one-piece polycarbonate body, excellent antenna performance.\r\nCarl Zeiss optics, 8 MP main camera, dual LED flash, Auto Focus, 1 MP front camera, video calling.\r\nAll day battery life, up to 7 hours talk time.', 'USA', 7, 'public/images/products/31/31_1.jpg'),
(32, 'Blackberry Q5 Black', 195, 195, 'Cellular Band - Quad-Band 850 / 900 / 1800 / 1900 Mhz\r\nCellular Band 3G - 850 / 900 / 1900 / 2100 Mhz', 'China', 7, 'public/images/products/32/32_1.jpg'),
(33, 'BlackBerry Z10', 300, 237, 'BlackBerry Z10 Unlocked Cell Phone - International Version with No Warranty (Black', 'USA', 7, 'public/images/products/33/33_1.jpg'),
(34, 'Blackberry Q10 Black 16GB', 350, 250, 'Display: 720 x 720 pixels, 3.1 inches (~328 ppi pixel density)\r\nInternal Memory: 16 GB storage, 2 GB RAM\r\nCamera: 8 MP, 3264 x 2448 pixels, autofocus, LED flash\r\n3G: HSPA 1, 2, 5/6, 8 (850 / 900 / 1900 / 2100 MHz)\r\n4G:LTE 3, 7, 8, 20 (1800 / 2600 / 900 / 800 MHz)\r\n', 'China', 7, 'public/images/products/34/34_1.jpg'),
(35, 'BlackBerry Bold 9000', 120, 82.99, 'Newly designed QWERTY keyboard; Wi-Fi networking (802.11b/g); GPS navigation\r\n2-megapixel camera/camcorder; Bluetooth for handsfree devices and stereo music streaming; MicroSD expansion (to 32 GB)\r\nUp to 4.5 hours of talk time, up to 324 hours (13.5 days) of standby time', 'China', 7, 'public/images/products/35/35_1.jpg'),
(36, 'Samsung GT-E1205L Keystone', 30, 20, 'Long durability battery; Mobile Tracker; MP3 ringtones; Polyphonic ringtones; Organizer and Voice memo.\r\n3 Embedded games; Integrated speakerphone; 1.52 Inch TFT Display\r\nTalk time up to 8.3 hours - Standby up to 720 hours.', 'Vietnam', 2, 'public/images/products/36/36_1.jpg'),
(37, 'LG A275 Black', 35, 25, 'Cellular Band - Quad-Band 850 / 900 / 1800 / 1900 Mhz', 'China', 6, 'public/images/products/37/37_1.jpg'),
(38, 'BlackBerry Pearl 8100', 85, 50, 'Wireless email\r\nWeight Approximately 3.1 oz\r\nBluetooth v2.0; headset, hands-free and serial port profiles supported\r\nStandby time 360 hours or 15 days\r\nFlash memory 64 MB', 'China', 7, 'public/images/products/38/38_1.jpg'),
(39, 'Nokia 100 GSM Phone', 30, 30, 'Unlocked Dual-Band GSM cell phone compatible with 850/1900 MHz frequencies.\r\n1.8'' TFT Display, 128 x 160 pixels; FM Radio; Battery Standby time up to 840 hrs; Games; Loudspeaker; 3.5mm Audio Jack and Phonebook up to 500 entries.', 'Finland', 4, 'public/images/products/39/39_1.jpg'),
(40, 'Nokia 106.3 Negro-Black', 35, 35, 'Unlocked Dual-Band GSM cell phone compatible with 850/1900 MHz frequencies - Compatible with Mini SIM (Standard size).\r\n1.8'' QQVGA (160 x 128) ; FM Radio; Battery Standby time up to 840 hrs; Talk Time up to 110 hrs; Games; Loudspeaker; 3.5mm Audio Jack and Phonebook up to 500 entries.\r\nLED torch (flashlight); Speaking Clock; Dust and splash proof keymat; Calendar; Reminders.\r\nSales Package: Nokia 106, Nokia Charger, Nokia Battery, Product user guide.', 'Vietnam', 4, 'public/images/products/40/40_1.jpg'),
(41, 'Nokia 220 GSM Phone', 40, 40, 'Unlocked Dual-Band GSM cell phone compatible with 850/1900 MHz frequencies plus GPRS data capabilities.\r\n2.4'' TFT Display, 240 x 320 pixels; 2MP Camera, 2048x1536 pixels; Bluetooth; FM Radio; MP3 Player; Video Player and WAP Browser.\r\nMicroSD Card Slot up to 32GB; Battery Standby time up to 696hrs; Games; 3.5mm Audio Jack and Social Networking Integration.\r\n', 'China', 4, 'public/images/products/41/41_1.jpg'),
(42, 'Nokia Asha 311 Dark Grey', 80, 74, '3.2 MP Primary Camera\r\n3-inch LCD Capacitive Touchscreen\r\nExpandable Storage Capacity of 32 GB\r\n2G and 3G Network Support; FM Radio\r\nWi-Fi Enabled', 'Vietnam', 4, 'public/images/products/42/42_1.jpg'),
(43, 'Nokia Touch and Type X3-02', 120, 99.99, 'Cellular Band - Quad-Band 850 / 900 / 1800 / 1900 Mhz\r\nCellular Band 3G - 850 / 900 / 1900 / 2100 Mhz', 'China', 4, 'public/images/products/43/43_1.jpg'),
(44, 'Samsung Gear 2 Neo Smartwatch - Black', 199, 199, 'Smart Notification: Samsung Gear 2 Neo allows you to make and receive calls and read more on a large sAMOLED display making communication smooth and seamless.\r\nPersonalized Fitness Motivator: Samsung Gear 2, with its built-in Heart Rate Sensor, S Health features, and pedometer.\r\nCompatible with Samsung Galaxy S5 / Galaxy Grand 2 / Galaxy Note 3 / Galaxy Note 3 Neo / Galaxy Note 2 / Galaxy S4 / Galaxy S3 / Galaxy S4 Zoom / Galaxy S4 Active.', 'USA', 2, 'public/images/products/44/44_1.jpg'),
(45, 'Sony Smart Watch SW2 for Android Phones', 150, 150, 'Sunlight readable, touch/swipe/pinch, water resistant (IP57), innovative screen technology\r\nStandalone digital watch\r\nPhone to watch via Bluetooth - messages, calls, Facebook, Twitter, sports apps, music player, calendar\r\n', 'USA', 3, 'public/images/products/45/45_1.jpg'),
(46, 'LG G Watch Powered by Android Wear - Black Titan', 200, 190, 'G Watch powered by Android Wear. Always with you, always on.\r\nThe best fit for your style\r\nMost intelligent experience\r\nSlim and compact design\r\nCompatible phone is required (Android 4.3 +)', 'Japan', 6, 'public/images/products/46/46_1.jpg'),
(47, 'MOTA SmartWatch G2', 80, 80, 'Bluetooth Version 3.0\r\nHands free and Music player bluetooth profiles\r\nCharging Time: 2-3 hours\r\nWrist size: 7"', 'Vietnam', 2, 'public/images/products/47/47_1.jpg'),
(48, 'Pebble Smartwatch for iPhone and Android-Black', 150, 150, 'View notifications from email, SMS, Caller ID, calendar and your favorite apps on your wrist.\r\nDownload watch faces and apps to suit your style and interests.\r\nControl music playing on iTunes, Spotify, Pandora and more.\r\nRechargeable battery lasts 5-7 days on a single charge\r\nCompatible with both Apple and Android devices', 'Vietnam', 6, 'public/images/products/48/48_1.jpg'),
(49, 'Samsung Galaxy Gear Smartwatch - Jet Black', 150, 150, 'Compatible with Galaxy Note 3 and other Galaxy smartphones\r\n1.63 inch Super AMOLED screen and 1.9 Megapixel camera\r\nPlace calls and answer them directly from your Galaxy Gear\r\nEnjoy the S Voice personal assistant right on your wrist\r\nIncludes Samsung Galaxy Gear, wall charger, charging cradle, quick start guide', 'Korea', 2, 'public/images/products/49/49_1.jpg'),
(50, 'Samsung Gear Fit Fitness Tracker', 150, 150, '24/7 Wearable: Always-on activity tracking keeps track of your activities throughout the day and is prepared for any adventure with its dust and water resistant protection (IP67). Light and durable with a curved Super AMOLED display.\r\nPersonalized Fitness Motivator: With the Heart Rate Sensor, Samsung Gear Fit gives you real time coaching to actively support and motivate you to achieve your fitness goals.\r\nSimple Interaction: Samsung Gear Fit allows you to easily control basic functions, such as, reject calls with messages, quick reply to messages and control alarms.', 'USA', 2, 'public/images/products/50/50_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pro_cate`
--

CREATE TABLE IF NOT EXISTS `tbl_pro_cate` (
  `pro_id` int(10) NOT NULL,
  `cate_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_pro_cate`
--

INSERT INTO `tbl_pro_cate` (`pro_id`, `cate_id`) VALUES
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 4),
(25, 4),
(26, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 5),
(32, 5),
(33, 5),
(34, 5),
(35, 5),
(36, 6),
(37, 6),
(38, 6),
(39, 6),
(40, 6),
(41, 6),
(42, 6),
(43, 6),
(44, 7),
(45, 7),
(46, 7),
(47, 7),
(48, 7),
(49, 7),
(50, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slide`
--

CREATE TABLE IF NOT EXISTS `tbl_slide` (
  `slide_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slide_image` varchar(100) NOT NULL,
  `slide_order` int(10) NOT NULL,
  `pro_id` int(10) NOT NULL,
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_slide`
--

INSERT INTO `tbl_slide` (`slide_id`, `slide_image`, `slide_order`, `pro_id`) VALUES
(1, '', 2, 4),
(2, '', 1, 11),
(3, '', 3, 20),
(4, '', 4, 18);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `user_pass` char(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_phone` varchar(11) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_gender` int(2) NOT NULL,
  `user_level` int(2) NOT NULL DEFAULT '2' COMMENT '1:admin 2:member',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_phone`, `user_address`, `user_gender`, `user_level`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@local.com', '0986888888', 'Hanoi', 1, 1),
(2, 'huanvm', 'e10adc3949ba59abbe56e057f20f883e', 'huanvm@local.com', '0988666888', 'Hanoi', 1, 1),
(3, 'hungtp', 'e10adc3949ba59abbe56e057f20f883e', 'hungtp@local.com', '09888666888', 'Hanoi', 1, 1),
(4, 'kiennb', 'e10adc3949ba59abbe56e057f20f883e', 'kiennb@local.com', '09888666888', 'Hanoi', 2, 2),
(5, 'luanvd', 'e10adc3949ba59abbe56e057f20f883e', 'luanvd@local.com', '09888666888', 'Hanoi', 1, 2),
(6, 'toannt2', 'e10adc3949ba59abbe56e057f20f883e', 'toannt2@local.com', '09888666888', 'Namdinh', 1, 1),
(7, 'john', 'e10adc3949ba59abbe56e057f20f883e', 'john@local.com', '09888666888', 'Dankota', 1, 2),
(8, 'jane', 'e10adc3949ba59abbe56e057f20f883e', 'jane@local.com', '0988666888', 'Dankota', 2, 2),
(9, 'peter', 'e10adc3949ba59abbe56e057f20f883e', 'peter@local.com', '0988666888', 'London', 1, 2),
(10, 'jenifer', 'e10adc3949ba59abbe56e057f20f883e', 'jenifer@local.com', '0988666888', 'Liverpool', 2, 2),
(11, 'mary', 'e10adc3949ba59abbe56e057f20f883e', 'mary@local.com', '0988666888', 'Amsterdam', 2, 2),
(12, 'emma', 'e10adc3949ba59abbe56e057f20f883e', 'emma@local.com', '0988666888', 'California', 2, 2),
(13, 'david', 'e10adc3949ba59abbe56e057f20f883e', 'david@local.com', '0988666888', 'Leed', 1, 2),
(14, 'ted', 'e10adc3949ba59abbe56e057f20f883e', 'ted@local.com', '0988666888', 'New York', 1, 2),
(15, 'phil', 'e10adc3949ba59abbe56e057f20f883e', 'phil@local.com', '0988666888', 'Philadelphia', 1, 2),
(16, 'Malvo', 'e10adc3949ba59abbe56e057f20f883e', 'malvo@local.com', '0988666888', 'Fargo', 1, 2),
(17, 'sansa', 'e10adc3949ba59abbe56e057f20f883e', 'sansa@local.com', '09888666888', 'Winterfell', 2, 2),
(18, 'joffrey', 'e10adc3949ba59abbe56e057f20f883e', 'joffrey@local.com', '0988666888', 'King Landing', 1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2019 at 04:22 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laaztecs_laaztecs`
--

-- --------------------------------------------------------

--
-- Table structure for table `announces`
--

CREATE TABLE `announces` (
  `id` int(10) NOT NULL,
  `announce_logo` varchar(191) DEFAULT NULL,
  `announce_title` varchar(191) DEFAULT NULL,
  `announce_content` varchar(1255) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `announces`
--

INSERT INTO `announces` (`id`, `announce_logo`, `announce_title`, `announce_content`, `create_date`, `update_date`) VALUES
(1, 'assets/uploads/user/player04.jpg', 'New Player', 'Micheal J is 18 years old. And he is left kicker.', '2019-08-19 07:36:02', '2019-08-19 07:36:02'),
(3, NULL, 'New announce', 'hello,dolly', '2019-08-22 16:37:14', '2019-08-22 16:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `product_id` int(10) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(191) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `create_date`, `update_date`) VALUES
(1, 'clothing', '2019-08-31 04:46:51', '0000-00-00 00:00:00'),
(2, 'accesories', '2019-08-31 04:46:58', '0000-00-00 00:00:00'),
(3, 'bags', '2019-08-31 04:47:04', '0000-00-00 00:00:00'),
(4, 'shoes', '2019-08-31 04:47:13', '0000-00-00 00:00:00'),
(5, 'fashion', '2019-08-31 04:47:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `color_name` varchar(191) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color_name`, `create_date`, `update_date`) VALUES
(1, 'Purple', '2019-08-31 04:44:09', '0000-00-00 00:00:00'),
(2, 'Red', '2019-08-31 04:44:13', '0000-00-00 00:00:00'),
(3, 'Blue', '2019-08-31 04:44:19', '0000-00-00 00:00:00'),
(4, 'Black', '2019-08-31 04:44:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(10) UNSIGNED NOT NULL,
  `option` varchar(191) DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `cost` int(10) DEFAULT 0,
  `status` int(2) DEFAULT 0,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `option`, `description`, `cost`, `status`, `create_date`, `update_date`) VALUES
(2, 'Standard Delivery', 'Standard Delivery (7 days)', 100, 1, '2019-09-02 20:14:54', '2019-09-02 20:14:54'),
(3, 'Fast Delivery', 'Fast Delivery (3 days)', 200, 1, '2019-09-02 20:15:43', '2019-09-02 20:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(10) UNSIGNED NOT NULL,
  `fee_name` varchar(191) DEFAULT NULL,
  `cost` int(10) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `fee_name`, `cost`, `create_date`, `update_date`) VALUES
(1, 'tryout fee', 10, '2019-09-03 17:15:29', '2019-09-03 17:15:29'),
(2, 'training fee', 20, '2019-09-03 17:15:42', '2019-09-03 17:15:42'),
(3, 'game fee', 30, '2019-09-03 17:15:55', '2019-09-03 17:15:55'),
(4, 'insurance fee', 40, '2019-09-03 17:16:12', '2019-09-03 17:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) NOT NULL,
  `from_user` int(10) DEFAULT NULL,
  `to_user` int(10) DEFAULT NULL,
  `message_title` varchar(191) DEFAULT NULL,
  `message_content` text DEFAULT NULL,
  `read_status` int(2) DEFAULT 0,
  `from_del_status` int(2) DEFAULT 0,
  `to_del_status` int(2) DEFAULT 0,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_user`, `to_user`, `message_title`, `message_content`, `read_status`, `from_del_status`, `to_del_status`, `create_date`, `update_date`) VALUES
(1, 2, 6, 'titlet', NULL, 1, 0, 0, '2019-08-14 17:41:42', '2019-08-14 17:41:42'),
(2, 2, 6, 'titlt', NULL, 0, 0, 0, '2019-08-14 16:05:54', '2019-08-14 16:05:54'),
(9, 1, 7, 'Invoice', 'Please pay and activate your account.', 1, 0, 0, '2019-08-21 13:35:23', '2019-08-21 13:35:23'),
(10, 1, 8, 'Invoice', 'Please pay and activate your account.', 0, 0, 0, '2019-08-21 13:35:08', '2019-08-21 13:35:08'),
(11, 1, 6, 'Invoice', 'Please pay and activate your account.', 0, 0, 0, '2019-09-03 18:50:39', '2019-09-03 18:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) NOT NULL,
  `news_logo` varchar(191) DEFAULT NULL,
  `news_title` varchar(191) DEFAULT NULL,
  `news_content` varchar(500) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `news_logo`, `news_title`, `news_content`, `create_date`, `update_date`) VALUES
(2, 'assets/uploads/news/player032.jpg', 'La Aztecs New Signing', 'New player\' name is Dominick Dumbleton. He\'s 28 years old. And he is a striker.', '2019-08-26 06:30:12', '2019-08-26 06:30:12'),
(3, 'assets/uploads/news/player01.jpg', 'La Aztecs New Outing', 'New player\' name is Dominick Dumbleton. He\'s 28 years old. And he is a striker.', '2019-08-26 06:47:58', '2019-08-26 06:47:58');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `txn_id` varchar(191) DEFAULT NULL,
  `payment_gross` float(10,2) DEFAULT NULL,
  `currency_code` varchar(191) DEFAULT NULL,
  `payer_email` varchar(191) DEFAULT NULL,
  `payment_status` varchar(191) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `txn_id`, `payment_gross`, `currency_code`, `payer_email`, `payment_status`, `create_date`, `update_date`) VALUES
(1, 7, '5G638273W23', 50.00, 'USD', 'sanbox_buyer10@yahoo.com', 'completed', '2019-08-22 14:21:09', '2019-08-22 14:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `pendings`
--

CREATE TABLE `pendings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `fee_id` int(10) UNSIGNED NOT NULL,
  `status` int(2) DEFAULT 0,
  `del_status` int(2) DEFAULT 0,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pendings`
--

INSERT INTO `pendings` (`id`, `user_id`, `fee_id`, `status`, `del_status`, `create_date`, `update_date`) VALUES
(8, 14, 3, 1, 0, '2019-09-03 17:30:10', '0000-00-00 00:00:00'),
(9, 7, 1, 1, 0, '2019-09-03 17:32:20', '0000-00-00 00:00:00'),
(10, 8, 1, 1, 0, '2019-09-03 17:32:20', '0000-00-00 00:00:00'),
(11, 6, 2, 0, 0, '2019-09-03 18:32:35', '0000-00-00 00:00:00'),
(12, 14, 2, 1, 0, '2019-09-03 18:32:36', '0000-00-00 00:00:00'),
(13, 6, 1, 0, 0, '2019-09-03 18:47:49', '0000-00-00 00:00:00'),
(14, 12, 1, 0, 0, '2019-09-03 18:47:49', '0000-00-00 00:00:00'),
(15, 10, 1, 0, 0, '2019-09-03 18:47:49', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `player_option`
--

CREATE TABLE `player_option` (
  `id` int(10) UNSIGNED NOT NULL,
  `option` varchar(191) DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `cost` int(10) DEFAULT 0,
  `status` int(2) DEFAULT 0,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `player_option`
--

INSERT INTO `player_option` (`id`, `option`, `description`, `cost`, `status`, `create_date`, `update_date`) VALUES
(1, 'Deposit', 'Deposit', 0, 1, '2019-08-30 04:28:08', '2019-08-30 04:28:08'),
(2, 'Try-out', 'Try-out', 25, 1, '2019-08-30 04:27:30', '2019-08-30 04:27:30');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `product_image` varchar(191) DEFAULT NULL,
  `product_name` varchar(191) DEFAULT NULL,
  `product_detail` varchar(500) DEFAULT NULL,
  `product_price` int(10) DEFAULT NULL,
  `product_stock` int(10) DEFAULT NULL,
  `product_rating` int(1) DEFAULT 0,
  `category_id` int(10) DEFAULT 1,
  `size_id` int(10) DEFAULT 1,
  `color_id` int(10) DEFAULT 1,
  `product_status` int(1) DEFAULT 0,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_image`, `product_name`, `product_detail`, `product_price`, `product_stock`, `product_rating`, `category_id`, `size_id`, `color_id`, `product_status`, `create_date`, `update_date`) VALUES
(2, 'assets/uploads/products/product011.jpg', 'Product1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae impedit quod sit quam consequuntur aperiam voluptatem asperiores quae dicta recusandae omnis aut sed, blanditiis cumque quos unde sequi, molestias deleniti.', 200, 1000, 0, 1, 2, 2, 1, '2019-08-26 14:39:12', '2019-08-26 14:39:12'),
(3, 'assets/uploads/products/shoe01.jpg', 'shoe01', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae impedit quod sit quam consequuntur aperiam voluptatem asperiores quae dicta recusandae omnis aut sed, blanditiis cumque quos unde sequi, molestias deleniti.', 500, 1500, 0, 4, 1, 3, 1, '2019-09-02 00:27:05', '2019-09-02 00:27:05'),
(4, 'assets/uploads/products/product02.jpg', 'Product2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae impedit quod sit quam consequuntur aperiam voluptatem asperiores quae dicta recusandae omnis aut sed, blanditiis cumque quos unde sequi, molestias deleniti.', 150, 500, 0, 1, 4, 2, 1, '2019-09-02 00:27:17', '2019-09-02 00:27:17'),
(5, 'assets/uploads/products/product03.jpg', 'Product3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae impedit quod sit quam consequuntur aperiam voluptatem asperiores quae dicta recusandae omnis aut sed, blanditiis cumque quos unde sequi, molestias deleniti.', 125, 150, 0, 1, 2, 1, 1, '2019-09-02 00:27:34', '2019-09-02 00:27:34'),
(6, 'assets/uploads/products/shoe03.jpg', 'shoe03', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae impedit quod sit quam consequuntur aperiam voluptatem asperiores quae dicta recusandae omnis aut sed, blanditiis cumque quos unde sequi, molestias deleniti.', 100, 300, 0, 4, 1, 4, 1, '2019-09-02 00:32:15', '2019-09-02 00:32:15'),
(7, 'assets/uploads/products/product04.jpg', 'Product4', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae impedit quod sit quam consequuntur aperiam voluptatem asperiores quae dicta recusandae omnis aut sed, blanditiis cumque quos unde sequi, molestias deleniti.', 80, 200, 0, 4, 1, 1, 0, '2019-09-02 00:32:24', '2019-09-02 00:32:24'),
(8, 'assets/uploads/products/product031.jpg', 'Product5', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae impedit quod sit quam consequuntur aperiam voluptatem asperiores quae dicta recusandae omnis aut sed, blanditiis cumque quos unde sequi, molestias deleniti.', 100, 100, 0, 1, 3, 4, 1, '2019-09-02 00:27:45', '2019-09-02 00:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_payments`
--

CREATE TABLE `product_payments` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `product_id` int(10) DEFAULT NULL,
  `product_quantity` int(10) DEFAULT NULL,
  `order_id` int(10) DEFAULT NULL,
  `txn_id` varchar(191) DEFAULT NULL,
  `buyer_email` varchar(191) DEFAULT NULL,
  `payment_gross` int(10) DEFAULT NULL,
  `currency_code` varchar(191) DEFAULT NULL,
  `payment_status` varchar(191) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(10) NOT NULL,
  `match_result` varchar(191) DEFAULT NULL,
  `team_id` int(10) DEFAULT NULL,
  `match_type` varchar(191) DEFAULT NULL,
  `match_time` varchar(191) DEFAULT NULL,
  `match_location` varchar(191) DEFAULT NULL,
  `own_goals` int(10) DEFAULT NULL,
  `competitor_goals` int(10) DEFAULT NULL,
  `own_goaler` text DEFAULT NULL,
  `competitor_goaler` text DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `match_result`, `team_id`, `match_type`, `match_time`, `match_location`, `own_goals`, `competitor_goals`, `own_goaler`, `competitor_goaler`, `create_date`, `update_date`) VALUES
(7, 'WIN', 6, 'FRIENDLY MATCH', '2019-05-24 15:00', 'SALESIAN STADIUM', 4, 1, 'a:3:{i:0;a:1:{s:9:\"goal_info\";s:15:\"Ethan Diaz (27)\";}i:1;a:1:{s:9:\"goal_info\";s:15:\"Ethan Diaz (45)\";}i:2;a:1:{s:9:\"goal_info\";s:10:\"Panda (87)\";}}', 'a:1:{i:0;a:1:{s:9:\"goal_info\";s:17:\"Leland Lagos (29)\";}}', '2019-08-11 05:13:02', '2019-08-11 05:13:02'),
(8, 'DRAW', 7, 'FRIENDLY MATCH', '2019-05-31 16:00', 'SALESIAN STADIUM', 2, 2, 'a:2:{i:0;a:1:{s:9:\"goal_info\";s:15:\"Ethan Diaz (27)\";}i:1;a:1:{s:9:\"goal_info\";s:10:\"Panda (77)\";}}', 'a:2:{i:0;a:1:{s:9:\"goal_info\";s:17:\"Leland Lagos (29)\";}i:1;a:1:{s:9:\"goal_info\";s:17:\"Leland Lagos (49)\";}}', '2019-08-11 05:18:50', '2019-08-11 05:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(10) NOT NULL,
  `team_id` int(10) DEFAULT NULL,
  `match_type` varchar(191) DEFAULT NULL,
  `match_location` varchar(191) DEFAULT NULL,
  `match_time` datetime DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `team_id`, `match_type`, `match_location`, `match_time`, `create_date`, `update_date`) VALUES
(2, 5, 'Super cup', 'Home', '2019-09-05 16:00:00', '2019-08-05 14:39:58', '2019-08-05 14:39:58'),
(8, 7, 'Friendly Match', 'Away', '2019-09-15 15:30:00', '2019-08-11 06:21:07', '2019-08-11 06:21:07');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `size_name` varchar(191) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size_name`, `create_date`, `update_date`) VALUES
(1, 'XS', '2019-08-31 04:43:41', '0000-00-00 00:00:00'),
(2, 'S', '2019-08-31 04:43:44', '0000-00-00 00:00:00'),
(3, 'M', '2019-08-31 04:43:49', '0000-00-00 00:00:00'),
(4, 'L', '2019-08-31 04:43:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) NOT NULL,
  `slider_url` varchar(191) DEFAULT NULL,
  `slider_title` varchar(191) DEFAULT NULL,
  `slider_content` varchar(255) DEFAULT NULL,
  `slider_status` int(2) DEFAULT 0,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_url`, `slider_title`, `slider_content`, `slider_status`, `create_date`, `update_date`) VALUES
(1, 'assets/uploads/slider-image/league-15-cta-bg.jpg', '', '', 1, '2019-08-22 02:53:11', '2019-08-22 02:53:11'),
(2, 'assets/uploads/slider-image/307807.jpg', '', '', 1, '2019-08-19 05:02:52', '2019-08-19 05:02:52'),
(6, 'assets/uploads/slider-image/GENSLER_LAFC_BOWL_DUSK.jpg', '', '', 1, '2019-08-19 05:03:15', '2019-08-19 05:03:15'),
(7, 'assets/uploads/slider-image/SoccerStock.jpg', '', '', 1, '2019-08-19 05:03:29', '2019-08-19 05:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(10) NOT NULL,
  `team_logo` varchar(191) DEFAULT 'assets/img/team_logo.png',
  `team_name` varchar(191) DEFAULT NULL,
  `stadium_name` varchar(191) DEFAULT NULL,
  `team_point` int(10) DEFAULT 0,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `team_logo`, `team_name`, `stadium_name`, `team_point`, `create_date`, `update_date`) VALUES
(1, 'assets/uploads/team-logo/logo01.png', 'LA Aztecs', 'SALESIAN STADIUM', 20, '2019-08-22 04:21:13', '2019-08-22 04:21:13'),
(5, 'assets/uploads/team-logo/logo025.png', 'L.A. Wolves FC', 'L.A. Wolves FC Stadium', 5, '2019-08-22 04:21:25', '2019-08-22 04:21:25'),
(6, 'assets/uploads/team-logo/Ottawa_Fury_F_c_Academy.png', 'Ottawa Fury F c Academy', 'Ottawa Fury F c Academy Stadium', 10, '2019-08-22 04:21:36', '2019-08-22 04:21:36'),
(7, 'assets/uploads/team-logo/S__C__Internacional.png', 'S. C. Internacional', 'S. C. Internacional Stadium', 3, '2019-08-22 04:21:48', '2019-08-22 04:21:48'),
(8, 'assets/uploads/team-logo/Santa_An_a_Win_ds_FC.gif', 'Santa An a Win ds FC', 'Santa An a Win ds FC Stadium', 15, '2019-08-22 04:22:00', '2019-08-22 04:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `tncs`
--

CREATE TABLE `tncs` (
  `id` int(10) NOT NULL,
  `tnc_title` varchar(191) DEFAULT NULL,
  `tnc_content` varchar(500) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tncs`
--

INSERT INTO `tncs` (`id`, `tnc_title`, `tnc_content`, `create_date`, `update_date`) VALUES
(2, 'Terms and Conditions', 'This is terms and conditions. All player must follow this rules.', '2019-08-26 09:50:31', '2019-08-26 09:50:31');

-- --------------------------------------------------------

--
-- Table structure for table `tournaments`
--

CREATE TABLE `tournaments` (
  `id` int(10) NOT NULL,
  `tournament_name` varchar(191) DEFAULT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `tournament_location` varchar(191) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tournaments`
--

INSERT INTO `tournaments` (`id`, `tournament_name`, `start_datetime`, `tournament_location`, `create_date`, `update_date`) VALUES
(1, 'U.S Open Cup', '2019-08-24 15:00:00', 'Pasadena USA', '2019-08-22 07:13:47', '2019-08-22 07:13:47'),
(3, 'World Cup', '2022-11-21 15:00:00', 'Qatar', '2019-08-22 06:24:47', '2019-08-22 06:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` int(10) NOT NULL,
  `training_name` varchar(191) DEFAULT NULL,
  `training_location` varchar(191) DEFAULT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `training_duration` varchar(191) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`id`, `training_name`, `training_location`, `start_datetime`, `training_duration`, `create_date`, `update_date`) VALUES
(1, 'Body building', 'Los Angeles', '2019-08-24 07:00:00', '5 hours', '2019-08-22 07:02:40', '2019-08-22 07:02:40'),
(3, 'Shoot training', 'Los Angeles', '2019-08-24 17:00:00', '1 hour', '2019-08-22 07:04:26', '2019-08-22 07:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `user_group` int(10) NOT NULL DEFAULT 4,
  `fullname` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `age` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `photo` varchar(191) NOT NULL DEFAULT 'assets/img/user.png',
  `options` varchar(50) DEFAULT NULL,
  `player_position` varchar(191) DEFAULT NULL,
  `member_type` varchar(191) DEFAULT 'Other',
  `sum_goal` int(10) DEFAULT 0,
  `status` int(2) NOT NULL DEFAULT 0,
  `last_logedin` datetime DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_group`, `fullname`, `email`, `address`, `age`, `phone`, `photo`, `options`, `player_position`, `member_type`, `sum_goal`, `status`, `last_logedin`, `create_date`, `update_date`) VALUES
(1, 'admin', '7488e331b8b64e5794da3fa4eb10ad5d', 1, 'Administrator', 'admin@admin.io', 'Los Angeles', '35', '18002569876', 'assets/uploads/user/4.jpg', '', NULL, NULL, NULL, 0, '2019-09-04 02:31:21', '2019-08-05 09:18:31', '2019-08-05 22:22:22'),
(2, 'coach1', 'd572fbb9008c33d42db6d2ccede29763', 2, 'John Cruyff', 'john@cruyff.io', NULL, NULL, NULL, 'assets/img/user.png', NULL, NULL, NULL, NULL, 0, '2019-09-04 02:31:21', '2019-08-05 10:32:49', '2019-08-05 10:32:49'),
(3, 'staff1', 'f7a841964721c3bef72896d4591d405c', 3, 'Professional Staff', 'pro@staff.com', 'Los Angeles', '40', '342345235', 'assets/img/user.png', NULL, NULL, NULL, NULL, 0, '2019-09-04 02:31:21', '2019-08-05 12:54:10', '2019-08-05 13:11:34'),
(4, 'staff2', '80751bf75726c7fee969347a78347d13', 3, 'Beginner Staff', 'beginner@staff.com', 'Los Angeles', '30', '23445622', 'assets/img/user.png', NULL, NULL, NULL, NULL, 0, '2019-09-04 02:31:21', '2019-08-05 12:55:39', '2019-08-05 13:10:26'),
(6, 'player1', '9a6b20cd462caa65625c8353117d5662', 4, 'Jack Robert', 'player1@ply.io', NULL, NULL, NULL, 'assets/img/user.png', NULL, 'Defense', 'Main', 0, 1, '2019-09-04 02:31:21', '2019-08-09 04:42:58', '2019-08-10 22:26:35'),
(7, 'player2', 'e36d441dcf285d99dfa4d7adc39cdb5b', 4, 'Micheal J', 'player2@ply.com', NULL, NULL, NULL, 'assets/img/user.png', NULL, 'GK', 'Main', 0, 1, '2019-09-04 02:31:21', '2019-08-09 04:44:02', '2019-08-10 22:26:30'),
(8, 'player3', '94f8da443b1224d131d487dc2767818f', 4, 'Cristian J', 'player3@ply.co', NULL, NULL, NULL, 'assets/img/user.png', NULL, 'Striker', 'Main', 0, 0, '2019-09-04 02:31:21', '2019-08-10 22:09:48', '2019-08-10 22:26:57'),
(9, 'player4', '1fb30d3021f07482bc91d9fc1864776b', 4, 'Bean J', 'player4@ply.co', NULL, NULL, NULL, 'assets/img/user.png', NULL, 'Middle', 'Main', 0, 0, '2019-09-04 02:31:21', '2019-08-10 22:10:59', '2019-08-10 22:26:52'),
(10, 'player5', '46bd78c260744ad397c358437d4afcb1', 4, 'Charlie J', 'player5@ply.io', NULL, NULL, NULL, 'assets/img/user.png', NULL, 'GK', 'Substitus', 0, 0, '2019-09-04 02:31:21', '2019-08-10 22:12:25', '2019-08-10 23:54:15'),
(12, 'player6', '516957da890968bac0e9e069b84a20bd', 4, 'Dominick Dumbleton', 'user6@ply.au', 'Los Angeles', '25', '80283847', 'assets/img/user.png', 'Depoist', NULL, 'Other', 0, 0, '2019-09-04 02:31:21', '2019-08-26 00:47:27', '2019-08-26 00:47:27'),
(13, 'player7', 'abb2f264698a4cb23e540c3c33dbd908', 4, 'Kell Jackson', 'player7@lazte.io', 'Atlanta', '19', '98374730', 'assets/img/user.png', 'Try-outs', NULL, 'Other', 0, 0, '2019-09-04 02:31:21', '2019-08-26 00:49:56', '2019-08-26 00:49:56'),
(14, 'player8', 'f7d2a69b7dc6034d6916b3a321d1a839', 4, 'Michel Peter', 'user8@lazte.com', 'Washington', '20', '89028482', 'assets/img/user.png', 'Depoist', NULL, 'Other', 0, 0, '2019-09-04 02:31:21', '2019-08-26 00:51:49', '2019-08-26 00:51:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(10) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `role`, `description`, `create_date`, `update_date`) VALUES
(1, 'Super Admin', 'This is Super Admin', '2019-08-04 08:13:29', '0000-00-00 00:00:00'),
(2, 'Header Coach', 'This is Header Coach', '2019-08-04 08:13:48', '0000-00-00 00:00:00'),
(3, 'Staff', 'This is Staff', '2019-08-04 08:14:13', '0000-00-00 00:00:00'),
(4, 'Player', 'This is Player', '2019-08-04 08:14:29', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announces`
--
ALTER TABLE `announces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendings`
--
ALTER TABLE `pendings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `player_option`
--
ALTER TABLE `player_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_payments`
--
ALTER TABLE `product_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tncs`
--
ALTER TABLE `tncs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announces`
--
ALTER TABLE `announces`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pendings`
--
ALTER TABLE `pendings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `player_option`
--
ALTER TABLE `player_option`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_payments`
--
ALTER TABLE `product_payments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tncs`
--
ALTER TABLE `tncs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tournaments`
--
ALTER TABLE `tournaments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

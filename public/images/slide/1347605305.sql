-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2020 at 11:55 AM
-- Server version: 10.3.22-MariaDB-log
-- PHP Version: 7.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hos46738_hospitalbooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_admin`
--

CREATE TABLE `tbl_account_admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT 'afdd0b4ad2ec172c586e2150770fbf9e' COMMENT 'Aa123456',
  `id_type` int(11) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(12) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `force_sign_out` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0:no force , 1: force'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_account_admin`
--

INSERT INTO `tbl_account_admin` (`id`, `username`, `password`, `id_type`, `full_name`, `email`, `phone_number`, `status`, `force_sign_out`) VALUES
(1, '123654', 'afdd0b4ad2ec172c586e2150770fbf9e', 1, 'Administrator', 'admin@hos.com', '0945600055', 'Y', '0'),
(2, 'antoni', 'afdd0b4ad2ec172c586e2150770fbf9e', 2, 'Tăng vĩ quan', 'antoni.quang@hr.com', '09008888', 'Y', '0'),
(3, 'ngocdiem', 'e10adc3949ba59abbe56e057f20f883e', 1, 'Ngoc Diem', 'admin@qtc.conm', '090909090', 'Y', '0'),
(6, 'canhdinh', 'e10adc3949ba59abbe56e057f20f883e', 1, 'Trần Cảnh Dinh', 'canhdinh@gmail.com', '0908080808', 'Y', '0'),
(7, 'dananh', 'e10adc3949ba59abbe56e057f20f883e', 3, 'Nguyễn Ngọc Đan Anh', 'dananh@gmail.com', '08058888888', 'Y', '1'),
(8, 'phad', 'c33367701511b4f6020ec61ded352059', 1, 'Phương Huệ ad', 'admin@qtctek.com', '0909', 'Y', '0'),
(9, 'phht', 'e10adc3949ba59abbe56e057f20f883e', 2, 'Phương Huệ ht', 'admin@qtctek.com', '0909', 'Y', '1'),
(11, 'phdb', 'e10adc3949ba59abbe56e057f20f883e', 7, 'Phương Huệ đb', 'admin@gmail.com', '0909', 'Y', '1'),
(13, 'ok', 'e10adc3949ba59abbe56e057f20f883e', 7, 'Ok', 'admin@qtctek.com', '0999', 'Y', '1'),
(15, 'hp', 'e10adc3949ba59abbe56e057f20f883e', 17, 'Chin su', 'Chinsu@h.com', '09123456', 'Y', '1'),
(16, 'hpp', '202cb962ac59075b964b07152d234b70', 8, 'Nhàn nguyễn', 'hzzhud@gmail.com', '0909090909', 'N', '1'),
(17, 'h8c', 'f6922e5d3e724529ecdd4fcded7e81d8', 16, 'Phạm Lam', 'admin@qtctek.com', '11111', 'Y', '1'),
(24, '0945600055', '093a7d39c03aef5aff621b7c5cef6b9a', 2, 'tăng vĩ quan', 'hotro@gmail.com', '090808089', 'Y', '0'),
(25, 'pp', 'e10adc3949ba59abbe56e057f20f883e', 1, 'pp', 'ghh@jj.com', '0808080808', 'Y', '0'),
(26, 'hh', 'e10adc3949ba59abbe56e057f20f883e', 2, 'Nguyễn an', 'admin@ho.com', '123', 'Y', '1'),
(29, 'Abcde', 'afdd0b4ad2ec172c586e2150770fbf9e', 2, 'Abcdw', 'Abcde@gmail.com', '090808800', 'Y', '1'),
(30, 'Nghĩa trần ', 'bac70980dcf64485da7e2acaba2b1c2f', 2, 'Trần Trí Nghĩa', 'hotro@gmail.com', '090808089', 'Y', '1'),
(31, 'Trần Nghĩa ', 'bac70980dcf64485da7e2acaba2b1c2f', 2, 'Trần Trí Nghĩa', 'hotro@gmail.com', '0908080895', 'Y', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_authorize`
--

CREATE TABLE `tbl_account_authorize` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_admin` int(10) UNSIGNED NOT NULL,
  `grant_permission` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_account_authorize`
--

INSERT INTO `tbl_account_authorize` (`id`, `id_admin`, `grant_permission`, `created_at`, `updated_at`) VALUES
(382, 1, 7, '2020-10-22 03:42:45', '2020-10-22 03:42:45'),
(381, 1, 6, '2020-10-22 03:42:45', '2020-10-22 03:42:45'),
(380, 1, 5, '2020-10-22 03:42:45', '2020-10-22 03:42:45'),
(379, 1, 4, '2020-10-22 03:42:45', '2020-10-22 03:42:45'),
(378, 1, 3, '2020-10-22 03:42:45', '2020-10-22 03:42:45'),
(377, 1, 2, '2020-10-22 03:42:45', '2020-10-22 03:42:45'),
(376, 1, 1, '2020-10-22 03:42:45', '2020-10-22 03:42:45'),
(270, 2, 6, '2020-10-18 11:50:03', '2020-10-18 11:50:03'),
(269, 2, 4, '2020-10-18 11:50:03', '2020-10-18 11:50:03'),
(268, 2, 3, '2020-10-18 11:50:03', '2020-10-18 11:50:03'),
(433, 15, 8, '2020-11-10 19:34:26', '2020-11-10 19:34:26'),
(432, 15, 7, '2020-11-10 19:34:26', '2020-11-10 19:34:26'),
(45, 6, 4, '2020-09-24 08:38:16', '2020-09-24 08:38:16'),
(44, 6, 3, '2020-09-24 08:38:16', '2020-09-24 08:38:16'),
(460, 3, 6, '2020-11-23 07:30:14', '2020-11-23 07:30:14'),
(459, 3, 5, '2020-11-23 07:30:14', '2020-11-23 07:30:14'),
(252, 13, 7, '2020-10-18 11:48:25', '2020-10-18 11:48:25'),
(54, 7, 4, '2020-09-24 09:09:54', '2020-09-24 09:09:54'),
(53, 7, 5, '2020-09-24 09:09:54', '2020-09-24 09:09:54'),
(458, 3, 4, '2020-11-23 07:30:14', '2020-11-23 07:30:14'),
(457, 3, 3, '2020-11-23 07:30:14', '2020-11-23 07:30:14'),
(43, 6, 2, '2020-09-24 08:38:16', '2020-09-24 08:38:16'),
(42, 6, 1, '2020-09-24 08:38:16', '2020-09-24 08:38:16'),
(254, 11, 5, '2020-10-18 11:48:38', '2020-10-18 11:48:38'),
(253, 11, 4, '2020-10-18 11:48:38', '2020-10-18 11:48:38'),
(260, 9, 7, '2020-10-18 11:48:52', '2020-10-18 11:48:52'),
(259, 9, 6, '2020-10-18 11:48:52', '2020-10-18 11:48:52'),
(258, 9, 5, '2020-10-18 11:48:52', '2020-10-18 11:48:52'),
(257, 9, 4, '2020-10-18 11:48:52', '2020-10-18 11:48:52'),
(256, 9, 3, '2020-10-18 11:48:52', '2020-10-18 11:48:52'),
(255, 9, 2, '2020-10-18 11:48:52', '2020-10-18 11:48:52'),
(267, 8, 7, '2020-10-18 11:49:06', '2020-10-18 11:49:06'),
(266, 8, 6, '2020-10-18 11:49:06', '2020-10-18 11:49:06'),
(265, 8, 5, '2020-10-18 11:49:06', '2020-10-18 11:49:06'),
(264, 8, 4, '2020-10-18 11:49:06', '2020-10-18 11:49:06'),
(263, 8, 3, '2020-10-18 11:49:06', '2020-10-18 11:49:06'),
(262, 8, 2, '2020-10-18 11:49:06', '2020-10-18 11:49:06'),
(261, 8, 1, '2020-10-18 11:49:06', '2020-10-18 11:49:06'),
(251, 13, 6, '2020-10-18 11:48:25', '2020-10-18 11:48:25'),
(250, 13, 5, '2020-10-18 11:48:25', '2020-10-18 11:48:25'),
(249, 13, 4, '2020-10-18 11:48:25', '2020-10-18 11:48:25'),
(248, 13, 3, '2020-10-18 11:48:25', '2020-10-18 11:48:25'),
(247, 13, 2, '2020-10-18 11:48:25', '2020-10-18 11:48:25'),
(246, 13, 1, '2020-10-18 11:48:25', '2020-10-18 11:48:25'),
(431, 15, 6, '2020-11-10 19:34:26', '2020-11-10 19:34:26'),
(430, 15, 6, '2020-11-10 19:34:26', '2020-11-10 19:34:26'),
(429, 15, 5, '2020-11-10 19:34:26', '2020-11-10 19:34:26'),
(428, 15, 5, '2020-11-10 19:34:26', '2020-11-10 19:34:26'),
(427, 15, 4, '2020-11-10 19:34:26', '2020-11-10 19:34:26'),
(362, 16, 2, '2020-10-22 03:42:11', '2020-10-22 03:42:11'),
(361, 17, 4, '2020-10-22 03:41:36', '2020-10-22 03:41:36'),
(360, 17, 3, '2020-10-22 03:41:36', '2020-10-22 03:41:36'),
(439, 24, 6, '2020-11-19 01:43:38', '2020-11-19 01:43:38'),
(438, 24, 5, '2020-11-19 01:43:38', '2020-11-19 01:43:38'),
(426, 15, 4, '2020-11-10 19:34:26', '2020-11-10 19:34:26'),
(425, 15, 3, '2020-11-10 19:34:26', '2020-11-10 19:34:26'),
(424, 15, 3, '2020-11-10 19:34:26', '2020-11-10 19:34:26'),
(437, 24, 4, '2020-11-19 01:43:38', '2020-11-19 01:43:38'),
(436, 24, 3, '2020-11-19 01:43:38', '2020-11-19 01:43:38'),
(435, 24, 2, '2020-11-19 01:43:38', '2020-11-19 01:43:38'),
(456, 3, 2, '2020-11-23 07:30:14', '2020-11-23 07:30:14'),
(455, 3, 1, '2020-11-23 07:30:14', '2020-11-23 07:30:14'),
(434, 24, 1, '2020-11-19 01:43:38', '2020-11-19 01:43:38'),
(423, 15, 2, '2020-11-10 19:34:26', '2020-11-10 19:34:26'),
(422, 15, 2, '2020-11-10 19:34:26', '2020-11-10 19:34:26'),
(421, 15, 1, '2020-11-10 19:34:26', '2020-11-10 19:34:26'),
(468, 25, 8, '2020-11-23 07:59:20', '2020-11-23 07:59:20'),
(467, 25, 7, '2020-11-23 07:59:20', '2020-11-23 07:59:20'),
(466, 25, 6, '2020-11-23 07:59:20', '2020-11-23 07:59:20'),
(465, 25, 5, '2020-11-23 07:59:20', '2020-11-23 07:59:20'),
(464, 25, 4, '2020-11-23 07:59:20', '2020-11-23 07:59:20'),
(463, 25, 3, '2020-11-23 07:59:20', '2020-11-23 07:59:20'),
(462, 25, 2, '2020-11-23 07:59:20', '2020-11-23 07:59:20'),
(461, 25, 1, '2020-11-23 07:59:20', '2020-11-23 07:59:20'),
(359, 26, 7, '2020-10-22 03:41:08', '2020-10-22 03:41:08'),
(358, 26, 6, '2020-10-22 03:41:08', '2020-10-22 03:41:08'),
(357, 26, 5, '2020-10-22 03:41:08', '2020-10-22 03:41:08'),
(400, 29, 6, '2020-10-22 21:14:42', '2020-10-22 21:14:42'),
(399, 29, 5, '2020-10-22 21:14:42', '2020-10-22 21:14:42'),
(398, 29, 4, '2020-10-22 21:14:42', '2020-10-22 21:14:42'),
(397, 29, 3, '2020-10-22 21:14:42', '2020-10-22 21:14:42'),
(396, 29, 2, '2020-10-22 21:14:42', '2020-10-22 21:14:42'),
(395, 29, 1, '2020-10-22 21:14:42', '2020-10-22 21:14:42'),
(406, 30, 6, '2020-11-10 03:50:31', '2020-11-10 03:50:31'),
(405, 30, 5, '2020-11-10 03:50:31', '2020-11-10 03:50:31'),
(404, 30, 4, '2020-11-10 03:50:31', '2020-11-10 03:50:31'),
(403, 30, 3, '2020-11-10 03:50:31', '2020-11-10 03:50:31'),
(402, 30, 2, '2020-11-10 03:50:31', '2020-11-10 03:50:31'),
(401, 30, 1, '2020-11-10 03:50:31', '2020-11-10 03:50:31'),
(420, 31, 6, '2020-11-10 19:32:35', '2020-11-10 19:32:35'),
(419, 31, 5, '2020-11-10 19:32:35', '2020-11-10 19:32:35'),
(418, 31, 4, '2020-11-10 19:32:35', '2020-11-10 19:32:35'),
(417, 31, 3, '2020-11-10 19:32:35', '2020-11-10 19:32:35'),
(416, 31, 2, '2020-11-10 19:32:35', '2020-11-10 19:32:35'),
(415, 31, 1, '2020-11-10 19:32:35', '2020-11-10 19:32:35'),
(441, 24, 8, '2020-11-19 01:43:38', '2020-11-19 01:43:38'),
(440, 24, 7, '2020-11-19 01:43:38', '2020-11-19 01:43:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_customer`
--

CREATE TABLE `tbl_account_customer` (
  `id` int(11) UNSIGNED NOT NULL,
  `phone_active` varchar(20) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `sex` enum('male','female') NOT NULL DEFAULT 'male',
  `birthday` varchar(20) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `force_sign_out` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0:no force , 1: force'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_account_customer`
--

INSERT INTO `tbl_account_customer` (`id`, `phone_active`, `full_name`, `email`, `address`, `password`, `phone_number`, `sex`, `birthday`, `nationality`, `force_sign_out`) VALUES
(1, '0945600055', 'Tăng vĩ quan', 'antoni.quang@qtctek.com', '157/17/1 Nguyễn gia trí , bình thạnh', 'e10adc3949ba59abbe56e057f20f883e', '0945600055', 'male', '', '', '1'),
(2, '0372058871', 'lại xuân tâm', 'tam@gmail.com', '157/17/1 Nguyễn gia trí , bình thạnh', '6c44e5cd17f0019c64b042e4a745412a', '258963147000', 'male', '1993-09-18', '', '1'),
(5, '0975469232', 'Trần Cảnh Dinh', 'dinh@gmail.com', 'D2 - Bình Thạnh', 'e10adc3949ba59abbe56e057f20f883e', '0909999999', 'male', '2020-9-20', NULL, '0'),
(6, '0344992162', 'Nguyễn Ngọc Lam Anh', 'lamanh@gmail.com', 'Quận 2, Hồ Chí Minh', 'e10adc3949ba59abbe56e057f20f883e', '037373737', 'female', '2000-09-20', NULL, '0'),
(7, '0944810055', 'QTC TEK', 'hhhh@hui.com', '157 Bình Thạnh', 'e10adc3949ba59abbe56e057f20f883e', '0909090909', 'female', '2000-09-22', NULL, '0'),
(8, '966176286', 'Phương Huệ huệ', '@gmail.com', 'Q.9', 'e10adc3949ba59abbe56e057f20f883e', '0966176286', 'female', '1997-11-16', NULL, '1'),
(22, '0344992163', 'Nguyễn Ngọc Đan Anh', 'nguyetlam@gmail.com', 'Nguyễn Công Trứ, Hồ Chí Minh', 'e10adc3949ba59abbe56e057f20f883e', '09898989666', 'female', '1995-10-12', NULL, '0'),
(24, '08085858', 'Nguyệt nguyễn', '08085858@gmail.com', 'Quận Tân Bình, HCM', 'e10adc3949ba59abbe56e057f20f883e', '08085858', 'male', NULL, NULL, '1'),
(26, '0937614816', 'Tăng vĩ quan', 'antoni.quang@qtctek.com', '1113/42 Huỳnh Tấn Phát Quận 7', '093a7d39c03aef5aff621b7c5cef6b9a', NULL, 'male', NULL, NULL, '1'),
(27, '0344275590', 'Trần Nhất Minh', 'trannhatminh1992@gmail.com', 'Hà nội', 'e10adc3949ba59abbe56e057f20f883e', '0344275590', 'male', '1992-05-03', NULL, '0'),
(28, '0946574928', 'Lâm thị trang', 'Trannhatminh1992@gmail.com', 'Hà nội', 'ccfebeba64ba14f267a3a8fe80023434', '0946574928', 'male', NULL, NULL, '1'),
(29, '378591456', 'dương thanh hoàng', 'hoangem9001@gmail.com', '86 đường 19-5 nam định', '972111e81b4d620daf0f55a81f59cf86', NULL, 'male', NULL, NULL, '1'),
(30, '0389766796', 'lam thi trang', 'lamtrang201194@gmail.com', '158 van phuc', '63fd9a757d34009c7d63e50796cfc1a3', '0389766796', 'female', '1994-11-20', NULL, '1'),
(31, '0373412234', 'Vũ Đức Sơn', 'son@gmail.com', '14/14 Nguyen Van Luong', 'a127fd1f86e4ab650f2216f09992afa4', '0373412234', 'male', '1997-09-02', NULL, '0'),
(32, '0838241599', 'Tống Thị Thu Hà', NULL, 'Nam Định', 'e10adc3949ba59abbe56e057f20f883e', '0838241599', 'female', '1965-01-01', NULL, '0'),
(33, '0338042405', 'Nguyễn Gia Hân', 'hanhan160598@gmail.com', '15 Nguyễn Gia Trí', 'c4568f40c6277a48ffb9e48251888d3a', '0338042405', 'male', NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_permission`
--

CREATE TABLE `tbl_account_permission` (
  `id` int(11) UNSIGNED NOT NULL,
  `permission` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_account_permission`
--

INSERT INTO `tbl_account_permission` (`id`, `permission`, `description`) VALUES
(1, 'account_control', 'Quản lý nhân viên'),
(2, 'account_customer', 'Quản lý tài khoản khách hàng'),
(3, 'account_service', 'Quản lý gói khám - dịch vụ'),
(4, 'account_slide', 'Quản lý slide'),
(5, 'account_news', 'Quản lý bài viết'),
(6, 'account_orders', 'Quản lý đơn khám'),
(7, 'account_reports', 'Quản lý báo cáo - thống kê'),
(8, 'account_force_signout', 'Quản lý cưỡng chế đăng xuất');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_type`
--

CREATE TABLE `tbl_account_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `type_account` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_account_type`
--

INSERT INTO `tbl_account_type` (`id`, `type_account`, `description`) VALUES
(1, 'Admin', 'Quản lý hệ thống bán hàng'),
(2, 'Hỗ trợ', 'nhân viên hỗ trợ'),
(3, 'Đăng bài', 'Nhân viên đăng bài viết vui'),
(7, 'Tư vấn hotline', 'Tư vấn hotline'),
(8, 'Quản lý khách hàng', 'Quản lý khách hàng mô tả'),
(16, 'Tư vấn viên', 'Tư vấn dịch vụ khách hàng'),
(17, 'Đăng bài', 'đăng cái bài thông tin hỗ trợ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_app_deploy`
--

CREATE TABLE `tbl_app_deploy` (
  `id` int(11) UNSIGNED NOT NULL,
  `live_version` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_app_deploy`
--

INSERT INTO `tbl_app_deploy` (`id`, `live_version`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_billing_actually`
--

CREATE TABLE `tbl_billing_actually` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_billing` int(11) UNSIGNED NOT NULL,
  `id_service` int(11) UNSIGNED NOT NULL,
  `billing_quantity` int(11) UNSIGNED NOT NULL DEFAULT 1,
  `billing_price` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_billing_actually`
--

INSERT INTO `tbl_billing_actually` (`id`, `id_billing`, `id_service`, `billing_quantity`, `billing_price`) VALUES
(1, 13, 3, 1, '1500000'),
(2, 13, 4, 1, '60000'),
(3, 16, 4, 1, '60000'),
(6, 22, 71, 2, '120000'),
(8, 28, 86, 2, '150000'),
(10, 31, 86, 1, '150000'),
(11, 29, 83, 2, '120000'),
(12, 29, 87, 1, '300000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_billing_appointment`
--

CREATE TABLE `tbl_billing_appointment` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_billing` int(11) UNSIGNED NOT NULL,
  `id_service_service` int(11) UNSIGNED NOT NULL,
  `appointment_time` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_billing_appointment`
--

INSERT INTO `tbl_billing_appointment` (`id`, `id_billing`, `id_service_service`, `appointment_time`) VALUES
(1, 25, 86, '14:50 - 14:50'),
(2, 25, 87, '14:51 - 14:51'),
(3, 29, 80, '15:33 - 15:38'),
(4, 29, 86, '15:01 - 15:22'),
(5, 24, 87, '09:09 - 09:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_billing_billing`
--

CREATE TABLE `tbl_billing_billing` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_customer` int(11) UNSIGNED NOT NULL,
  `billing_code` varchar(200) NOT NULL,
  `billing_date` varchar(200) NOT NULL,
  `billing_time` varchar(200) NOT NULL,
  `billing_type` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1: Single ; 2 : multi',
  `payment_type` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1 : Cash ; 2 : T/T',
  `payment_image` varchar(500) DEFAULT NULL,
  `billing_status` enum('1','2','3','4','5') NOT NULL DEFAULT '1' COMMENT '1: waiting confirm ; 2 scheduled ; 3 transferred ; 4 : completed; 5:cancel',
  `billing_comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_billing_billing`
--

INSERT INTO `tbl_billing_billing` (`id`, `id_customer`, `billing_code`, `billing_date`, `billing_time`, `billing_type`, `payment_type`, `payment_image`, `billing_status`, `billing_comment`) VALUES
(1, 22, 'B_1603030577', '2020-10-24', '07:30', '1', '1', NULL, '5', 'A'),
(2, 22, 'B_1603030597', '2020-10-24', '09:18', '1', '1', NULL, '5', 'A'),
(3, 22, 'B_1603030620', '2020-10-22', '09:19', '1', '1', NULL, '5', 'A'),
(4, 22, 'B_1603030640', '2020-10-28', '10:19', '1', '1', NULL, '5', 'A'),
(5, 22, 'B_1603030666', '2020-10-29', '10:30', '1', '1', NULL, '5', 'A'),
(6, 22, 'B_1603091157', '20/10/2020', '14:08', '1', '1', NULL, '5', 'A'),
(7, 22, 'B_1603091396', '20/10/2020', '14:12', '1', '1', NULL, '2', NULL),
(8, 6, 'B_1603095622', '04/11/2020', '15:22', '1', '1', NULL, '5', 'A'),
(9, 6, 'B_1603095859', '2020-11-12', '09:26', '1', '1', NULL, '5', ' bệnh viện hết lịch trống'),
(10, 6, 'B_1603095881', '22/10/2020', '15:30', '1', '1', NULL, '2', NULL),
(11, 22, 'B_1603763490', '2020-10-27', '09:53', '1', '1', NULL, '5', 'A'),
(12, 26, 'B_1604949065', '2020-11-14', '14:10', '1', '2', NULL, '5', 'A'),
(13, 26, 'B_1604949355', '2020-11-16', '08:59', '2', '1', NULL, '4', NULL),
(14, 27, 'B_1605712053', '2020-11-19', '22:08', '1', '1', NULL, '5', 'A'),
(15, 26, 'B_1605712168', '2020-11-18', '23:08', '1', '2', '', '5', 'A'),
(16, 27, 'B_1605712188', '2020-11-20', '07:22', '1', '2', 'images/payment_image/FZbXGWiQK2l3qlpS8m8SxeQyxYpbr2hXtqg1YqAHB8SdlLhtfzNiGLqHhyY6.png', '4', NULL),
(17, 27, 'B_1605714307', '2020-11-19', '07:46', '2', '1', NULL, '5', 'A'),
(18, 7, 'B_1606116279', '2020-11-24', '14:30', '1', '1', NULL, '5', 'dhjdjd'),
(19, 7, 'B_1606116952', '2020-11-25', '14:40', '1', '1', NULL, '2', NULL),
(20, 7, 'B_1606117479', '2020-11-26', '14:45', '1', '1', NULL, '1', NULL),
(21, 7, 'B_1606117683', '2020-11-27', '14:50', '2', '1', NULL, '4', NULL),
(22, 31, 'B_1606117876', '2020-11-29', '15:20', '1', '1', NULL, '4', NULL),
(23, 5, 'B_1607057748', '2020-12-05', '12:00', '1', '2', NULL, '1', NULL),
(24, 22, 'B_1607063971', '2020-12-18', '13:43', '2', '1', NULL, '1', NULL),
(25, 5, 'B_1607064258', '2020-12-04', '13:48', '2', '1', NULL, '4', NULL),
(26, 22, 'B_1607065239', '2020-12-25', '14:04', '2', '2', NULL, '4', NULL),
(27, 22, 'B_1607065635', '2020-12-26', '14:10', '1', '1', NULL, '5', 'Huy'),
(28, 7, 'B_1607069923', '2020-12-05', '15:20', '1', '1', NULL, '2', NULL),
(29, 7, 'B_1607070608', '2020-12-10', '15:30', '2', '1', NULL, '4', NULL),
(30, 22, 'B_1607070811', '2020-12-18', '15:37', '1', '1', NULL, '1', NULL),
(31, 31, 'B_1607071199', '2020-12-06', '09:00', '1', '1', NULL, '4', NULL),
(32, 31, 'B_1607071853', '2020-12-06', '14:30', '2', '1', NULL, '4', NULL),
(33, 31, 'B_1607073688', '2020-12-06', '14:25', '1', '1', NULL, '2', NULL),
(34, 7, 'B_1607309716', '2020-12-07', '10:02', '1', '1', NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_billing_customer`
--

CREATE TABLE `tbl_billing_customer` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_billing` int(11) UNSIGNED NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `customer_phone` varchar(50) NOT NULL,
  `customer_address` varchar(500) NOT NULL,
  `customer_sex` enum('male','female') NOT NULL DEFAULT 'male',
  `customer_birthday` varchar(50) NOT NULL,
  `prehistoric` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_billing_customer`
--

INSERT INTO `tbl_billing_customer` (`id`, `id_billing`, `customer_name`, `customer_phone`, `customer_address`, `customer_sex`, `customer_birthday`, `prehistoric`) VALUES
(1, 1, 'Nguyễn Ngọc Đan Anh', '09898989666', 'Nguyễn Công Trứ, Hồ Chí Minh', 'female', '1995-10-12', NULL),
(2, 2, 'Nguyễn Ngọc Đan Anh', '09898989666', 'Nguyễn Công Trứ, Hồ Chí Minh', 'female', '1995-10-12', NULL),
(3, 3, 'Nguyễn Ngọc Đan Anh', '09898989666', 'Nguyễn Công Trứ, Hồ Chí Minh', 'female', '1995-10-12', NULL),
(4, 4, 'Nguyễn Ngọc Đan Anh', '09898989666', 'Nguyễn Công Trứ, Hồ Chí Minh', 'female', '1995-10-12', NULL),
(5, 5, 'Nguyễn Ngọc Đan Anh', '09898989666', 'Nguyễn Công Trứ, Hồ Chí Minh', 'female', '1995-10-12', NULL),
(6, 6, 'Nguyễn Ngọc Đan Anh', '09898989666', 'Nguyễn Công Trứ, Hồ Chí Minh', 'female', '1995-10-12', NULL),
(7, 7, 'Nguyễn Ngọc Đan Anh', '09898989666', 'Nguyễn Công Trứ, Hồ Chí Minh', 'female', '1995-10-12', NULL),
(8, 8, 'Nguyễn Ngọc Lam Anh', '037373737', 'Quận 2, Hồ Chí Minh', 'female', '2000-09-20', NULL),
(9, 9, 'Nguyễn Ngọc Lam Anh', '037373737', 'Quận 2, Hồ Chí Minh', 'female', '2000-09-20', NULL),
(10, 10, 'Nguyễn Ngọc Lam Anh', '037373737', 'Quận 2, Hồ Chí Minh', 'female', '2000-09-20', NULL),
(11, 11, 'Nguyễn Ngọc Đan Anh', '09898989666', 'Nguyễn Công Trứ, Hồ Chí Minh', 'female', '1995-10-12', NULL),
(12, 12, 'Tăng vĩ quan', '0937614816', '1113/42 Huỳnh Tấn Phát Quận 7', 'male', '1988-11-10', NULL),
(13, 13, 'ABC', '0896523', '1122345 htcvb', 'male', '1995-11-10', NULL),
(14, 14, 'Trần Nhất Minh', '0344275590', 'Hà nội', 'male', '1992-05-03', NULL),
(15, 15, 'Tăng vĩ quan', '0937614816', '1113/42 Huỳnh Tấn Phát Quận 7', 'male', '1988-11-17', NULL),
(16, 16, 'Trần Nhất Minh', '0344275590', 'Hà nội', 'male', '1992-05-03', NULL),
(17, 17, 'Đsajnsb djdjsj', '0344275590', 'Nam định', 'male', '2020-11-18', NULL),
(18, 17, 'Ycufuf jcuvuf', '0345275590', 'Hhdgb', 'male', '2020-11-18', NULL),
(19, 18, 'QTC TEK', '0944810055', '157 Bình Thạnh', 'female', '2000-09-22', NULL),
(20, 19, 'QTC TEK', '0944810055', '157 Bình Thạnh', 'female', '2000-09-22', NULL),
(21, 20, 'QTC TEK', '0944810055', '157 Bình Thạnh', 'female', '2000-09-22', NULL),
(22, 21, 'xghxjz', '707879707', 'zbzhjz', 'female', '2020-11-26', NULL),
(23, 22, 'Vũ Đức Sơn', '0373412234', '14/14 Nguyen Van Luong', 'male', '1997-09-02', NULL),
(24, 23, 'Trần Cảnh Dinh', '0975469232', 'D2 - Bình Thạnh', 'male', '2020-9-20', 'Đau dạ dày'),
(25, 24, 'Qtc tek', '08999966', 'Bsshsj dudjjss ndmdmd', 'male', '2020-12-04', 'Hdjdjdkdd\nKdkdkdkd\nKdkdkd\nKddkkdkd'),
(26, 25, 'Cảnh', '123321', 'D2', 'male', '2020-12-04', 'Đau bụng'),
(27, 25, 'Dinh', '123456', 'D2', 'male', '2020-12-04', 'Đau '),
(28, 26, ' Cảnh Dinh', '0909090099', 'Ushuss msksjsks', 'male', '2020-12-04', 'Hddjsi dmskks ndjdkdkd mdmdmd mdmdmd mdmdmdkd, jfkdkdd, snsjsjsjsk'),
(29, 26, 'Trần Dinh', '08080888889', 'Uhu wuiwiw dnskdk sjsjs', 'male', '2020-12-04', NULL),
(30, 27, 'Nguyễn Ngọc Đan Anh', '09898989666', 'Nguyễn Công Trứ, Hồ Chí Minh', 'female', '1995-10-12', 'Dị ứng với hải sản'),
(31, 28, 'QTC TEK', '0944810055', '157 Bình Thạnh', 'female', '2000-09-22', 'kiem tra tien su'),
(32, 29, 'nguyen a', '080808057676', 'zvhzjz', 'male', '2011-12-04', 'ghjjhuhojpg7f65df6yhh'),
(33, 29, 'ong b', '079797679767', 'gshsjs', 'male', '1992-12-04', 'zgzhzj bhjjibobl'),
(34, 30, 'Nguyễn Ngọc Đan Anh', '09898989666', 'Nguyễn Công Trứ, Hồ Chí Minh', 'female', '1995-10-12', 'Dị ứng chất cồn'),
(35, 31, 'Vũ Đức Sơn', '0373412234', '14/14 Nguyen Van Luong', 'male', '1997-09-02', 'Tiền sử sơ gan.... gan nhiễm mỡ'),
(36, 32, 'Đoàn Trọng Nhất', '0912548857', '50 Lê Thị Hồng', 'male', '2020-09-16', 'Đau nửa đầu vai gáy (nặng). '),
(37, 33, 'Vũ Đức Sơn', '0373412234', '14/14 Nguyen Van Luong', 'male', '1997-09-02', 'Viêm phổi. '),
(38, 34, 'QTC TEK', '0944810055', '157 Bình Thạnh', 'female', '2000-09-22', 'hdhdj');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_billing_detail`
--

CREATE TABLE `tbl_billing_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_billing` int(11) UNSIGNED NOT NULL,
  `id_service` int(11) UNSIGNED NOT NULL,
  `billing_price` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_billing_detail`
--

INSERT INTO `tbl_billing_detail` (`id`, `id_billing`, `id_service`, `billing_price`) VALUES
(1, 1, 10, '1000000'),
(2, 1, 1, '3000000'),
(3, 1, 3, '1500000'),
(4, 2, 10, '1000000'),
(5, 3, 9, '2000000'),
(6, 4, 8, '700000'),
(7, 5, 4, '60000'),
(8, 6, 10, '1000000'),
(9, 7, 10, '1000000'),
(10, 8, 4, '60000'),
(11, 9, 9, '2000000'),
(12, 10, 4, '60000'),
(13, 11, 10, '1000000'),
(14, 12, 1, '3000000'),
(15, 12, 2, '20000'),
(16, 12, 3, '1500000'),
(17, 12, 4, '60000'),
(18, 13, 10, '1000000'),
(19, 14, 10, '1000000'),
(20, 15, 4, '60000'),
(21, 15, 8, '700000'),
(22, 15, 10, '1000000'),
(23, 16, 1, '3000000'),
(24, 17, 10, '1000000'),
(25, 17, 8, '700000'),
(26, 17, 4, '60000'),
(27, 18, 89, '123456'),
(28, 19, 89, '123456'),
(29, 20, 89, '123456'),
(30, 20, 87, '300000'),
(31, 21, 89, '123456'),
(32, 22, 87, '300000'),
(33, 22, 14, '120000'),
(34, 22, 58, '103920'),
(35, 22, 15, '25800'),
(36, 22, 16, '25800'),
(37, 22, 17, '25800'),
(38, 22, 18, '32280'),
(39, 22, 19, '32280'),
(40, 22, 20, '36000'),
(41, 22, 21, '32280'),
(42, 22, 22, '25800'),
(43, 22, 23, '25800'),
(44, 22, 24, '24000'),
(45, 22, 27, '25800'),
(46, 22, 81, '120000'),
(47, 22, 36, '44520'),
(48, 22, 59, '82800'),
(49, 22, 68, '240000'),
(50, 22, 71, '120000'),
(51, 22, 82, '72000'),
(52, 22, 42, '150000'),
(53, 22, 43, '180000'),
(54, 23, 87, '300000'),
(55, 24, 87, '300000'),
(56, 25, 86, '150000'),
(57, 25, 87, '300000'),
(58, 26, 87, '300000'),
(59, 27, 87, '300000'),
(60, 28, 87, '300000'),
(61, 29, 80, '480000'),
(62, 29, 86, '150000'),
(63, 30, 87, '300000'),
(64, 31, 87, '300000'),
(65, 32, 87, '300000'),
(66, 33, 87, '300000'),
(67, 34, 87, '300000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_billing_document`
--

CREATE TABLE `tbl_billing_document` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_billing` int(11) UNSIGNED NOT NULL,
  `image_upload` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_billing_document`
--

INSERT INTO `tbl_billing_document` (`id`, `id_billing`, `image_upload`) VALUES
(1, 13, 'images/billing_document/irlBILdejkyU1c3TU84XpKCp006OS3bWpqzKHBq8CBBRBf5UvsPLlmNF3iwQ.png'),
(3, 16, 'images/billing_document/qqOAw9M2YBhBOj87j8biFzRxq2pKp4nH5tEaI3eiwtCdIbA1B7DGdwCLnzi1.png'),
(4, 16, 'images/billing_document/tTpkGQ6JbdyZkL8by8RBvRAKLsWxYbWxGeFTMM3TSZTezQe7hx1UTPXJYX4m.png'),
(5, 16, 'images/billing_document/lhu3AyHTXwqqjbOpBs4oJEn1e3HkUsDgu3l7t6xi8hkJPfT7SeD2azzhqMNR.png'),
(6, 22, 'images/billing_document/hHSpLpfVEDP3qKRbCPoPTCjYof2YNs672nN0NiPDgJNDI52BWURdIzJwo3VC.png'),
(9, 28, 'images/billing_document/zHbbiV4CSQ3QZc1LYzqgq2PsWUqn1SE2cAvrFxKzKeeEmB6ZjCpBnjPmqyoy.jpg'),
(10, 28, 'images/billing_document/AZGwGxarHDw0yN6w1GFFyQz3NRrjnTInKZNgSD1uxduXNZVgzUkdQ3NCBEOD.jpg'),
(11, 29, 'images/billing_document/kLY4skkivi63O6rP9uTcqQiKTkEMmkP1PW978FjJZDTXdCDwLXfoRaRoZhQE.jpg'),
(12, 29, 'images/billing_document/YHOEdy7JYNKeLuax6Zqq0JabH9pPUyL6cfWornBTkMQRbIMHQXjWo3Sdx9Z1.jpg'),
(14, 31, 'images/billing_document/qhnmwcfCbN5ENEfa1IDt5wDZSJAzirbUYE5lxgQ7R1eRshl3p7bHWs6TBGXw.png'),
(15, 26, 'images/billing_document/AwapVpsMf5U9NJSUMJBO5l0I6VV8tx5SjKs1D09obMkebv4pBT3nE7rukJzT.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `id` int(11) UNSIGNED NOT NULL,
  `image_upload` varchar(500) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `home_action` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_news`
--

INSERT INTO `tbl_news` (`id`, `image_upload`, `title`, `content`, `home_action`) VALUES
(3, 'images/news/W9iHojt9poNFcfxHtguUgGv28x6ILmGCeQ3DySOMIdoLVIztRsDAB2UslIbV.png', 'Cây diệp hạ châu', 'Cây chó đẻ (Diệp hạ châu) là vị thuốc nam quý. Dược liệu này có vị đắng, hơi ngọt, tính mát, tác dụng thẩm thấp, minh mục, lợi tiểu và thanh can. Hiện nay, diệp hạ châu không chỉ được sử dụng trong y học cổ truyền mà còn được ứng dụng trong nhiều chế phẩm chữa bệnh.', 'Y'),
(4, 'images/news/23UHiDjWss7iH6keuvjXj6WLTWYasK5H7HrZW9gVdpe105mIStMhabPbAeHS.png', 'Hướng dẫn cách làm trà chanh sả tăng sức đề kháng', 'Hướng dẫn thực hiện\n\nBước 1: Sơ chế nguyên liệu\n\n- Bóc lớp vỏ ngoài của sả và rửa kỹ để loại bỏ các chất dơ. Sau đó giả đập sả để chúng dễ tiết các chất dinh dưỡng cũng như mùi hương. Cắt sả thành những đoạn nhỏ với độ dài khoảng 5cm\n\n- Gọt vỏ củ gừng, rửa sạch với nước. Thái gừng thành những lát mỏng, tránh thái lát quá dày bạn nhé.\n\n- Chanh rửa sạch và vắt lấy nước cốt\n\nBước 2: Pha chế hỗn hợp\n\n- Bắt nồi lên bếp để đun sôi hỗn hợp nước lọc, sả và gừng. Khi hỗn hợp sôi già và sả đã chuyển sang màu vàng óng, bạn ngâm trà túi lọc vào nồi và đun sôi thêm lần nữa.\n\n- Đợi hỗn hợp nguội, thêm ít mật ong và chanh vào tùy theo khẩu vị.', 'Y'),
(5, 'images/news/bbEDwcLLTMcP1cZJ3Kqf8BXwXBOzptCbQQVoSY3SRsD23qRxYVJyAzvJ2NgJ.png', 'Sức khỏe là tài sản quý giá các bạn nhớ giữ gìn sức khoẻ', 'Sức khỏe là tài sản quý giá và quan trọng nhất của con người, đã uống rượu bia không nên lái xe', 'Y'),
(6, 'images/news/p6AqCCh2EGaPLjEyA1QqbvbnVxf7ABn07yN7fPBxek4hACt9aFX0eDlwafHF.png', 'CÁCH PHA TRÀ GỪNG VỚI MẬT ONG VÀ CÁCH SỬ DỤNG HIỆU QUẢ ĐỐI VỚI SỨC KHỎE', 'Nguyên liệu để pha trà gừng mật ong\n\nGừng tươi 1 củ\nNước lọc 1- 2 cốc\nNước chanh;\nMật ong 1-2 thìa.\nCách pha chế trà gừng mật ong\n\nGừng rửa sạch và gọt bỏ vỏ sau đó thái lát mỏng\nĐun sôi 1-2 cốc nước lọc sau đó cho vào 4-6 lát gừng ( Tùy vào số lượng sử dụng theo tỉ lệ 1-2 cốc nước 4-6 lát gừng ) rồi đun sôi âm ỉ khoảng 7 đến 10 phút.\nRót nước ra ấm trà và loại bỏ các lát gừng.\nCho một ít nước chanh vào ( tùy từng sở thích mỗi người ) và cho thêm 1 hoặc 2 thìa mật ong nguyên chất vào sau đó khuấy đều và để nguội rồi thưởng thức.\n\n', 'Y'),
(9, 'images/news/O4N7MjQHCaUNEmBIDLfRU6J3cu07hhmDQuh1c1FZPKJXNRtULKwdRWZziYug.png', 'Trà gừng cho sức khoẻ', 'Mỗi khi trời vào lạnh, mỗi buổi tối chúng ta nên uống 1 tách trà gừng để giữ ấm cơ thể. \nTrà gừng vốn được ông cha chúng ta sử dụng từ xa xưa như một liều thuốc tự nhiên để trị các triệu chứng về đường ruột cũng như tiêu hoá. Thế nhưng ít ai biết được rằng trà gừng còn có những công dụng khác như giảm buồn nôn, chống viêm, chống bệnh truyền nhiệm, tăng cường chức năng não, điều hoà đường huyết và thậm chí là cả giảm cân nữa.', 'N'),
(17, '', 'Lưu ý khi đăng kí khám sức khoẻ định kì', '- Khám nội chung tổng quát là bắt buộc. Bạn có thể chủ đăng kí khám nội chung tổng quát và đến nghe tư vấn của bác sĩ rồi mới quyết định làm các xét nghiệm nào.\n- Khám các chuyên khoa lẻ mắt, tai mũi họng, răng, da liễu, sản phụ khoa sẽ được bác sĩ hơcj điều dưỡng viên đăng kí khi bạn có nhu cầu ( hoàn toàn miễn phí )\n- Khi thanh toán tại bệnh viện, bạn vui lòng thanh toán các chi phí xét nghiệm bằng tiền mặt tại quầy tài chính ( mọi chi phí thanh toán đều có biên lai, hoá đơn nếu cần)\n- Đối với nội soi gây mê, bắt buộc phải có kết quả của xquang tim phổi và điện tim để cuộc soi gây mê được an toàn.\n- Để nội soi hoặc test HP hơi thở yêu cầu bạn nhịn ăn. Nếu bạn muốn uống thuốc làm sạch đại tràng tại nhà vui lòng liên hệ chăm sóc khách hàng để được hướng dẫn.\n- Chụp Cộng hưởng từ và CT 256 dãy trở lên là các xét nghiệm hẹn giờ. Nhân viên y tế sẽ hẹn giờ giúp bạn khi bạn thanh toán tiền xét nghiệm. Vui lòng chờ đến thời gian được hẹn để chụp.\n- Hồ sơ khám có thể được gửi về sau nếu bạn không có thời gian để đợi kết quả. Vui lòng liên hệ CSKH để biết thêm về dịch vụ này.\nCHÚNG TÔI KHÔNG THU THÊM BẤT KÌ CHI PHÍ NÀO CỦA KHÁCH HÀNG. \nXIN CẢM ƠN!!!', 'Y'),
(18, 'images/news/jg3CgfRGZVFs9Y4eWucK9PqcyOX3SCQDz013fUHfIHCX2NubBKtMwtKHOecQ.png', 'Xét nghiệm Test HP hơi thở', 'Test hơi thở tìm vi khuẩn Hp là gì?\nHầu hết rất khó để nhận biết các triệu chứng nhiễm vi khuẩn Hp trong dạ dày bằng mắt thường. Thay vào đó, các bác sĩ sẽ dựa vào các dụng cụ y tế để thực hiện đo lường và chẩn đoán. Test hơi thở tìm vi khuẩn Hp là một trong những biện pháp phổ biến và mang lại kết quả chính xác rất cao.\n\nMột tên gọi khác của phương pháp này là: xét nghiệm hơi thở urê.\n\nVì sao cần thực hiện test Hp?\nBất kỳ các xét nghiệm kiểm tra Helicobacter pylori (H.pylori) nào cũng đem lại mục đích tìm hiểu tình trạng nhiễm trùng của vi khuẩn. H.pylori có thể gây ra loét hoặc kích thích niêm mạc dạ dày, từ đó khiến xuất hiện viêm dạ dày cấp, viêm dạ dày mạn tính, …\n\ntest hơi thở tìm hp\nNgoài ra, việc test Hp sẽ tìm hiểu xem điều trị nhiễm H.pylori có thành công hay công. Dựa vào kết quả, kết hợp cùng thăm khám lâm sàng sẽ giúp bác sĩ đưa ra phương án điều trị phù hợp. Mỗi tình trạng nhiễm khuẩn và sức khỏe khác nhau sẽ cho ra các liệu trình chữa bệnh khác nhau.\n\nƯu nhược điểm của xét nghiệm vi khuẩn Hp qua hơi thở\nSo với phương pháp nội soi, xét nghiệm vi khuẩn Hp qua hơi thở có một số ưu nhược điểm nhất định như:\n\nĐộ nhạy cao (khoảng 95%).\nĐộ chuyên biệt đạt trên 90%.\nĐộ chính xác trên 80%.\nThời gian thực hiện khá nhanh chóng.\nDễ thực hiện, an toàn và không gây đau, khó chịu cho bệnh nhân.\nTuy nhiên nhược điểm của phương pháp này là không thể theo dõi được sát sao tình trạng sức khỏe của dạ dày so với phương pháp nội soi. Do đó nếu có những thương tổn trong dạ dày của bệnh nhân thì khó biết được.', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_packet`
--

CREATE TABLE `tbl_service_packet` (
  `id` int(11) UNSIGNED NOT NULL,
  `packet_service` varchar(200) NOT NULL,
  `packet_content` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_service_packet`
--

INSERT INTO `tbl_service_packet` (`id`, `packet_service`, `packet_content`) VALUES
(20, 'Gói cơ bản (Nam, Nữ)', 'Giá khám sức khoẻ đã bao gồm thuế, giá dịch vụ kĩ thuật, chăm sóc khách hàng, hồ sơ sức khoẻ'),
(21, 'Gói nâng cao dành cho nữ', 'Giá khám sức khoẻ đã bao gồm thuế, giá dịch vụ kĩ thuật, chăm sóc khách hàng, hồ sơ sức khoẻ'),
(22, 'Gói nâng cao dành cho nam', 'Giá khám sức khoẻ đã bao gồm thuế, giá dịch vụ kĩ thuật, chăm sóc khách hàng, hồ sơ sức khoẻ'),
(23, 'Gói toàn diện dành cho nữ', 'Giá khám sức khoẻ đã bao gồm thuế, giá dịch vụ kĩ thuật, chăm sóc khách hàng, hồ sơ sức khoẻ'),
(24, 'Gói toàn diện dành cho nam', 'Giá khám sức khoẻ đã bao gồm thuế, giá dịch vụ kĩ thuật, chăm sóc khách hàng, hồ sơ sức khoẻ'),
(25, 'Gói tầm soát ung thư dành cho nữ', 'Tầm soát ung thư dành cho nữ'),
(26, 'Gói tầm soát ung thư dành cho nam', 'Tầm soát ung thư ở nam giới');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_packet_detail`
--

CREATE TABLE `tbl_service_packet_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_service_packet` int(11) UNSIGNED NOT NULL,
  `id_service_service` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_service_packet_detail`
--

INSERT INTO `tbl_service_packet_detail` (`id`, `id_service_packet`, `id_service_service`) VALUES
(122, 20, 87),
(123, 20, 14),
(124, 20, 16),
(125, 20, 17),
(126, 20, 18),
(127, 20, 19),
(128, 20, 20),
(129, 20, 21),
(130, 20, 15),
(131, 20, 22),
(132, 20, 23),
(133, 20, 24),
(134, 20, 36),
(135, 20, 59),
(136, 20, 82),
(137, 20, 68),
(138, 20, 71),
(139, 20, 27),
(140, 21, 87),
(141, 21, 14),
(142, 21, 15),
(143, 21, 16),
(144, 21, 17),
(145, 21, 18),
(146, 21, 19),
(147, 21, 20),
(148, 21, 21),
(149, 21, 22),
(150, 21, 23),
(151, 21, 24),
(152, 21, 27),
(153, 21, 81),
(154, 21, 42),
(155, 21, 43),
(156, 21, 36),
(157, 21, 59),
(158, 21, 68),
(159, 21, 73),
(160, 21, 71),
(161, 21, 82),
(162, 21, 58),
(163, 22, 87),
(164, 22, 14),
(165, 22, 58),
(166, 22, 15),
(167, 22, 16),
(168, 22, 17),
(169, 22, 18),
(170, 22, 19),
(171, 22, 20),
(172, 22, 21),
(173, 22, 22),
(174, 22, 23),
(175, 22, 24),
(176, 22, 27),
(177, 22, 81),
(178, 22, 36),
(179, 22, 59),
(180, 22, 68),
(181, 22, 71),
(182, 22, 82),
(183, 22, 42),
(184, 22, 43),
(185, 23, 87),
(186, 23, 14),
(187, 23, 58),
(188, 23, 16),
(189, 23, 17),
(190, 23, 18),
(191, 23, 19),
(192, 23, 20),
(193, 23, 21),
(194, 23, 22),
(195, 23, 23),
(196, 23, 24),
(197, 23, 27),
(198, 23, 15),
(199, 23, 81),
(200, 23, 30),
(201, 23, 32),
(202, 23, 37),
(203, 23, 38),
(204, 23, 42),
(205, 23, 43),
(206, 23, 44),
(207, 23, 36),
(208, 23, 57),
(209, 23, 59),
(210, 23, 62),
(211, 23, 69),
(212, 23, 71),
(213, 23, 68),
(214, 23, 82),
(215, 23, 75),
(216, 23, 78),
(217, 23, 46),
(218, 23, 48),
(219, 23, 50),
(220, 23, 53),
(221, 23, 49),
(222, 24, 87),
(223, 24, 14),
(224, 24, 58),
(225, 24, 15),
(226, 24, 81),
(227, 24, 18),
(228, 24, 19),
(229, 24, 20),
(230, 24, 21),
(231, 24, 16),
(232, 24, 17),
(233, 24, 27),
(234, 24, 22),
(235, 24, 23),
(236, 24, 24),
(237, 24, 30),
(238, 24, 32),
(239, 24, 37),
(240, 24, 38),
(241, 24, 42),
(242, 24, 43),
(243, 24, 44),
(244, 24, 36),
(245, 24, 59),
(246, 24, 69),
(247, 24, 71),
(248, 24, 82),
(249, 24, 75),
(250, 24, 78),
(251, 24, 46),
(252, 24, 48),
(253, 24, 54),
(254, 24, 53),
(255, 24, 49),
(256, 25, 85),
(257, 25, 46),
(258, 25, 47),
(259, 25, 48),
(260, 25, 53),
(261, 25, 51),
(262, 25, 50),
(263, 25, 52),
(264, 25, 49),
(265, 26, 46),
(266, 26, 47),
(267, 26, 48),
(268, 26, 53),
(269, 26, 54),
(270, 26, 51),
(271, 26, 49);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_service`
--

CREATE TABLE `tbl_service_service` (
  `id` int(11) UNSIGNED NOT NULL,
  `service` varchar(200) NOT NULL,
  `content` varchar(500) NOT NULL,
  `price` varchar(200) NOT NULL,
  `status_service` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_service_service`
--

INSERT INTO `tbl_service_service` (`id`, `service`, `content`, `price`, `status_service`) VALUES
(1, 'Nặn tuyến bờ mi', 'Làm sạch biwf mi bằng tăm bông và thuốc chuyên dụng nhằm loại bỏ bụi bẩn, vi khuẩn tại bờ mi', '200000', 'Y'),
(2, 'Nội soi tai mũi họng ống mềm', 'Nội soi tai mũi họng bằng ống mềm', '600000', 'Y'),
(3, 'Ghi điện não đồ vi tính', 'Kiểm tra, phát hiện các sóng bất thường trên não', '180000', 'Y'),
(4, 'Chích chắp / lẹo', 'Rạch và loại bỏ ổ nhiễm trùng tại mi mắt trong trường hợp dùng thuốc kháng sinh không đỡ, có chỉ định của bác sĩ', '500000', 'Y'),
(8, 'Đo nhĩ lượng', 'Chẩn đoán, đánh giá sự toàn vẹn của hệ thống truyền âm tai giữa, áp lực tai giữa và chức năng vòi tai', '150000', 'Y'),
(9, 'Đo thính lực đơn âm khách quan', 'Đánh giá sức nghe cụ thể của 4 tần số cơ bản', '200000', 'Y'),
(10, 'Đo âm ốc tai', 'Sàng lọc nghe kém. Kiểm soát sơ bộ chức năng ốc tai trong ngộ độc thuốc, chấn thương, toeengs ồn, sau điều trị bệnh.', '300000', 'Y'),
(14, 'Tổng phân tích máu ( Công thức máu toàn phần)', 'Kiểm tra dố lượng bạch cầu, hồng cầu, tiểu cầu,...; đánh giá tình trạng thiếu máu, một số bệnh toàn thân', '120000', 'Y'),
(15, 'Định lượng glucose', 'Phát hiện bệnh tiểu đường và những rối loạn về đường máu', '25800', 'Y'),
(16, 'Định lượng Ure', 'Đánh giá chức năng thận', '25800', 'Y'),
(17, 'Định lượng Creatinene', 'Đánh giá chức năng thận', '25800', 'Y'),
(18, 'Định lượng Cholesterol toàn phần', 'Đánh giá những rối loạn do mỡ máu', '32280', 'Y'),
(19, 'Định lượng Triglycerid', 'Đánh giá những rối loạn do mỡ máu', '32280', 'Y'),
(20, 'Định lượng HDL-C', 'Đánh giá những rối loạn do mỡ máu', '36000', 'Y'),
(21, 'Định lượng LDL-C', 'Đánh giá những rối loạn do mỡ máu', '32280', 'Y'),
(22, 'Đo hoạt độ AST (GOT)', 'Kiểm tra men gan, đánh giá viêm gan và các bệnh về gan', '25800', 'Y'),
(23, 'Đo hoạt độ ALT (GPT)', 'Kiểm tra men gan, đánh giá viêm gan và các bệnh về gan', '25800', 'Y'),
(24, 'Đo hoạt độ GGT', 'Kiểm tra men gan, đánh giá viêm gan và các bệnh về gan', '24000', 'Y'),
(25, 'Định lượng Bilirubin toàn phần', 'Định lượng Bilirubin trong cơ thể, đánh giá các bệnh liên quan', '25800', 'Y'),
(26, 'Định lượng Bilirubin trực tiếp', 'Định lượng Bilirubin trong cơ thể, đánh giá các bệnh liên quan', '25800', 'Y'),
(27, 'Định lượng Acid uric', 'Định lượng Acid uric trong cơ thể, liên quan đến bệnh gút...', '25800', 'Y'),
(28, 'Định lượng Protein toàn phần', 'Đánh giá chức nặng tổng hợp của gan và các bệnh liên quan khác', '25800', 'Y'),
(29, 'Định lượng Albumin', 'Đánh giá chức năng tổng hợp của gan và các bệnh liên quan khác', '25800', 'Y'),
(30, 'Điện giải đồ (Na, K, Cl)', 'Kiểm tra điện giải trong máu, phát hiện biến đổi Na+, K+, Cl', '72000', 'Y'),
(31, 'Định lượng Calci toàn phần ', 'Đánh giá chức năng tuyến cận giáp, chuyênnr hoá calci trong cơ thể và các bệnh liên quan khác', '15480', 'Y'),
(32, 'Định lượng sắt huyết thanh', 'Kiểm tra độ thiếu máu ( yếu tố sắt trong máu)', '38760', 'Y'),
(33, 'Đo hoạt độ Amylase', 'Đánh giá chức năng tuỵ và các bệnh liên quan khác', '25800', 'Y'),
(34, 'Định lượng Cortisol', 'Chẩn đoán hội chứng Cúhing và suy thượng thận', '109920', 'Y'),
(35, 'Định lượng Troponin I', 'Chẩn đoán và theo dõi hội chứng động mạch vành cấp ( nhồi máu cơ tim)', '90480', 'Y'),
(36, 'Tổng phân tích nước tiểu', 'Phát hiện bệnh lý đường tiết niệu', '44520', 'Y'),
(37, 'Định lượng TSH', 'Chẩn đoán các bệnh lý về tuyến giáp', '84000', 'Y'),
(38, 'Định lượng FT4', 'Chẩn đoán các bệnh lý về tuyến giáp', '84000', 'Y'),
(39, 'Định lượng Tg (Thyroglobulin)', 'Chẩn đoán các bệnh về tuyến giáp', '211200', 'Y'),
(40, 'Định lượng Anti-Tg', 'Chẩn đoán các bệnh về tuyến giáp', '322800', 'Y'),
(41, 'Định lượng T3', 'Chẩn đoán các bệnh về tuyến giáp', '77520', 'Y'),
(42, 'HBsAg', 'Xét nghiệm viêm gan B', '150000', 'Y'),
(43, 'Anti-HCV', 'Xét nghiệm viêm gan C', '180000', 'Y'),
(44, 'Anti-HIV', 'Xét nghiệm HIV', '150000', 'Y'),
(45, 'Anti-Hbs', 'Định lượng kháng nguyên virus viêm gan B', '120000', 'Y'),
(46, 'Định lượng Cyfra 21-1', 'Tầm soát ung thư phổi', '337200', 'Y'),
(47, 'Định lượng SCC', 'Tầm soát ung thư vòm họng', '600000', 'Y'),
(48, 'Định lượng AFP', 'Tầm soát ung thư gan', '217200', 'Y'),
(49, 'Định lượng CEA ', 'Tầm soát ung thư đại tràng', '217200', 'Y'),
(50, 'Định lượng CA 125', 'Tầm soát ung thư buồng trứng', '301200', 'Y'),
(51, 'Định lượng CA 19-9', 'Tầm soát ung thư tuỵ', '301200', 'Y'),
(52, 'Định lượng CA 15-3', 'Tầm soát ung thư vú', '301200', 'Y'),
(53, 'Định lượng CA 72-4', 'Tầm soát ung thư dạ dày', '301200', 'Y'),
(54, 'Định lượng PSA toàn phần', 'Tầm soát ung thư tiền liệt tuyến', '253200', 'Y'),
(55, 'HBV đo tải lượng hệ thống tự động', 'Định lượng virus viêm gan B', '1445400', 'Y'),
(56, 'HCV đo tải lượng hệ thống tự động', 'Định lượng virus viêm gan C', '1456400', 'Y'),
(57, 'Lấy bệnh phẩm làm phiến đồ cổ tử cung - âm đạo', 'Tầm soát ung thư cổ tử cung', '386400', 'Y'),
(58, 'Định nhóm máu hệ ABO, Rd(D)', 'Xác định nhóm máu', '103920', 'Y'),
(59, 'Xquang tim phổi (ngực thẳng)', 'Kiểm tra sơ bộ các vấn đề bất thường về tim phổi', '82800', 'Y'),
(60, 'Xquang cột sống cổ thẳng nghiêng', 'Kiểm tra sơ bộ các vấn đề về cột sống cổ', '166800', 'Y'),
(61, 'Xquang cột sống thắt lưng', 'Kiểm tra sơ bộ các vấn đề về cột sống thắt lưng', '166800', 'Y'),
(62, 'Xquang tuyến vú', 'Kiểm tra sơ bộ về tuyến vú, phát hiện u vú', '600000', 'Y'),
(63, 'Xquang dựng mạch máu não', 'Dựng hình mạch máu não khi chụp CT não hoặc MRI não', '600000', 'Y'),
(64, 'Chụp CT 32 dãy', 'Chụp CT kiểm tra não hoặc phổi hoặc các tạng khác ( giá chưa bao gồm thuốc cản quang)', '880000', 'Y'),
(65, 'Chụp CT 256 dãy trở lên không thuôccs cản quang', 'Chụp CT kiểm tra Mạch vành timhoaecj Não hoặc Các tạng khác ( giá chưa bao gồm thuốc cản quang)', '3850000', 'Y'),
(66, 'Chụp cộng hưởng từ (MRI) ', 'Chụo cộng hưởng từ 3Tesla kiểm tra não hoặc đĩa đệm cột sống cổ, cột sống thắt lưng', '2200000', 'Y'),
(67, 'Đo mật độ xương bằng kĩ thuật DEXA (2 vị trí)', 'Kiểm tra tình trạng loãng xương', '380000', 'Y'),
(68, 'Siêu âm ổ bụng tổng quát', 'Phát hiện các bất thường về gan, mật , tuỵ...( Nữ: phần phụ, tử cung; Nam: tiền liệt tuyến)', '240000', 'Y'),
(69, 'Siêu âm Doppler tim, van tim', 'Phát hiện các bất thường về tim', '300000', 'Y'),
(70, 'Siêu âm đầu dò âm đạo, trực tràng', 'Phát hiện các bất thường về tử cung, phần phụ', '180000', 'Y'),
(71, 'Siêu âm tuyến giáp', 'Kiểm tra kích thước, hình ảnh tuyến giáp, phát hiện nang, nhân, u...', '120000', 'Y'),
(72, 'Siêu âm hạch vùng cổ', 'Phát hiện các hạch bất thường ở cổ', '120000', 'Y'),
(73, 'Siêu âm tuyến vú 2 bên', 'Kiểm tra mật độ vú, hình ảnh tuyến vú, phát hiện nang, nhân xơ, u, hạch bất thường...', '120000', 'Y'),
(74, 'Siêu âm Doppler động mạch, tĩnh mạch chi dưới', 'Phát hiện các bất thường ở động, tĩnh mạch chi dưới', '300000', 'Y'),
(75, 'Nội soi dạ dày', 'Nội soi dạ dày thường không sinh thiết', '429600', 'Y'),
(76, 'Nội soi dạ dày mê', 'Nội soi dạ dày mê không sinh thiết', '1200000', 'Y'),
(77, 'Nội soi đại trực tràng', 'Nội soi đại trực tràng thường không sinh thiết (chưa bao gồm chi phí nước và thuốc làm sạch đại tràng)', '678000', 'Y'),
(78, 'Nội soi đại tràng mê', 'Nội soi đại trực tràng mê không sinh thiết ( chưa bao gồm chi phí nước và thuốc làm sạch đại tràng)', '2200000', 'Y'),
(79, 'Nội soi trực tràng', 'Nội soi trực tràng không sinh thiết ( chưa bao gồm thuốc tháo thụt)', '463200', 'Y'),
(80, 'Test HP hơi thở', 'Tìm vi khuẩn HP ', '480000', 'Y'),
(81, 'Định lượng HbA1C', 'Kết hợp chẩn đoán bệnh đái tháo đường và theo hõi hiệu quả điều trị và mức độ kiểm soata Glucose của bệnh nhân Đái tháo đường', '120000', 'Y'),
(82, 'Điện tim thường', 'Phát hiện các bất thường để chẩn đoán và định hướng các bệnh về tim mạch', '72000', 'Y'),
(83, 'Lưu huyết não', 'Kiểm tra mức độ lưu thông máu lên não', '120000', 'Y'),
(84, 'Đo độ đàn hồi mô gan', 'Đánh giá độ gan nhiễm mỡ và độ xơ hoá gan', '400000', 'Y'),
(85, 'Định lượng HPV', 'Tầm soát ung thư cổ tử cung', '1170000', 'Y'),
(86, 'Làm thuốc tai', 'Làm sạch, thông thoáng ống tai ngoài', '150000', 'Y'),
(87, 'Khám nội tổng quát', 'Bác sĩ đa khoa khám, tư vấn, kết luận. Khám phụ khoa cho nữ, khám tai mũi họng, kiểm tra mắt, khám răng hàm mặt (nếu cần). Suất ăn miễn phí trong ngày.', '300000', 'Y'),
(88, 'Dịch vụ cảnh dinh bị vô hiệu hoá do xàm xí đú', 'bên admin đang test dịch vụ', '120000', 'N'),
(89, 'dich vu lam vo hieu hoa phuc hoi', 'dich vu lam vo hieu hoa phuc hoi', '123456', 'N'),
(90, 'Dịch vụ gọi xe cấp cứu', 'Gọi xe cấp cứu các bệnh viện trong tp, đi tỉnh. Giá cả phải chăng.', '1200000', 'N'),
(92, 'Dịch vụ đo huyết áp', 'Đo huyết áp', '50000', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slide`
--

CREATE TABLE `tbl_slide` (
  `id` int(11) UNSIGNED NOT NULL,
  `order_slide` int(11) UNSIGNED NOT NULL,
  `image_upload` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_slide`
--

INSERT INTO `tbl_slide` (`id`, `order_slide`, `image_upload`) VALUES
(3, 3, 'images/news/DNYt6mWOWrWZHlLdC0PHlXdVqnuio7IR6veJZj1xDeUpoqQPQko1CHWBLfrC.png'),
(12, 4, 'images/news/HN3o3XflkvM9SL0QogEtb5ktFfT2RKtPU3D0XURRYhsmuZi9uX1L2swCqob9.png'),
(15, 1, 'images/news/7LX78BJPch4ntg1bDbmphS3wAmJtFGesnY4yUSt2VvgWLAPf7GNwrDVg7Yqh.png'),
(16, 2, 'images/slide/ssssRahvGpgGXh2SJJHupqBdNJnkPewr72TMIVuOXptt6pHs0XxEjwBk3SQJ.png'),
(17, 5, 'images/slide/AO3U7ZeZNCYOZVK08SRHMGSA5l6cG5ZAI33Ahezp0h18xF8B9uMPari6yRZV.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_support_banking`
--

CREATE TABLE `tbl_support_banking` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_holder` varchar(100) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `account_bankname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_support_banking`
--

INSERT INTO `tbl_support_banking` (`id`, `account_holder`, `account_no`, `account_bankname`) VALUES
(1, 'LAM THI TRANG', '0800120041994', 'Ngân hàng quân đội MB BANK');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_support_hotline`
--

CREATE TABLE `tbl_support_hotline` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_support` varchar(100) NOT NULL,
  `account_support` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_support_hotline`
--

INSERT INTO `tbl_support_hotline` (`id`, `type_support`, `account_support`) VALUES
(1, 'Zalo', '0945600055'),
(2, 'Viber', '0945600055'),
(3, 'Facebook Messenger', '100016259075309');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account_admin`
--
ALTER TABLE `tbl_account_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_account_authorize`
--
ALTER TABLE `tbl_account_authorize`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_account_customer`
--
ALTER TABLE `tbl_account_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_account_permission`
--
ALTER TABLE `tbl_account_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_account_type`
--
ALTER TABLE `tbl_account_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_app_deploy`
--
ALTER TABLE `tbl_app_deploy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_billing_actually`
--
ALTER TABLE `tbl_billing_actually`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_billing_appointment`
--
ALTER TABLE `tbl_billing_appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_billing_billing`
--
ALTER TABLE `tbl_billing_billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_billing_customer`
--
ALTER TABLE `tbl_billing_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_billing_detail`
--
ALTER TABLE `tbl_billing_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_billing_document`
--
ALTER TABLE `tbl_billing_document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_service_packet`
--
ALTER TABLE `tbl_service_packet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_service_packet_detail`
--
ALTER TABLE `tbl_service_packet_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_service_service`
--
ALTER TABLE `tbl_service_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slide`
--
ALTER TABLE `tbl_slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_support_banking`
--
ALTER TABLE `tbl_support_banking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_support_hotline`
--
ALTER TABLE `tbl_support_hotline`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account_admin`
--
ALTER TABLE `tbl_account_admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_account_authorize`
--
ALTER TABLE `tbl_account_authorize`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=469;

--
-- AUTO_INCREMENT for table `tbl_account_customer`
--
ALTER TABLE `tbl_account_customer`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_account_permission`
--
ALTER TABLE `tbl_account_permission`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_account_type`
--
ALTER TABLE `tbl_account_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_app_deploy`
--
ALTER TABLE `tbl_app_deploy`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_billing_actually`
--
ALTER TABLE `tbl_billing_actually`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_billing_appointment`
--
ALTER TABLE `tbl_billing_appointment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_billing_billing`
--
ALTER TABLE `tbl_billing_billing`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_billing_customer`
--
ALTER TABLE `tbl_billing_customer`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_billing_detail`
--
ALTER TABLE `tbl_billing_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tbl_billing_document`
--
ALTER TABLE `tbl_billing_document`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_service_packet`
--
ALTER TABLE `tbl_service_packet`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_service_packet_detail`
--
ALTER TABLE `tbl_service_packet_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `tbl_service_service`
--
ALTER TABLE `tbl_service_service`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `tbl_slide`
--
ALTER TABLE `tbl_slide`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_support_banking`
--
ALTER TABLE `tbl_support_banking`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_support_hotline`
--
ALTER TABLE `tbl_support_hotline`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

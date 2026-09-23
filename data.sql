-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th3 04, 2026 lúc 08:57 AM
-- Phiên bản máy phục vụ: 10.11.11-MariaDB-cll-lve
-- Phiên bản PHP: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `trumrobl_haomundev`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `stk` text NOT NULL,
  `name` text NOT NULL,
  `bank_name` text NOT NULL,
  `logo` text NOT NULL,
  `ghichu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `bank`
--

INSERT INTO `bank` (`id`, `stk`, `name`, `bank_name`, `logo`, `ghichu`) VALUES
(8, '0777721598', 'MBBank', 'TRẦN PHƯƠNG HÀO', 'upload/bank/bankI34A.png', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank_auto`
--

CREATE TABLE `bank_auto` (
  `id` int(11) NOT NULL,
  `user_id` text NOT NULL,
  `tranId` text NOT NULL,
  `payment_method` text NOT NULL,
  `amount` int(11) NOT NULL,
  `comment` text NOT NULL,
  `create_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `bank_auto`
--

INSERT INTO `bank_auto` (`id`, `user_id`, `tranId`, `payment_method`, `amount`, `comment`, `create_date`) VALUES
(68, '1', '33772336240', 'MOMO', 5001, 'coin1', '2022/12/25 00:27:52'),
(69, '2', 'FT26062046619036', 'MBBANK', 10000, 'CUSTOMER COIN2   Ma giao dich  Trace544684 T race 544684', '2026/03/03 23:54:02'),
(70, '2', 'FT26062012040165', 'MBBANK', 10000, 'CUSTOMER COIN2   Ma giao dich  Trace497577 T race 497577', '2026/03/03 23:54:02'),
(71, '2', 'FT26063265532130', 'MBBANK', 39957, 'CUSTOMERHACK2   Ma giao dich  Trace353291 T race 353291', '2026/03/04 02:37:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `trans_id` varchar(255) DEFAULT NULL,
  `telco` varchar(255) DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `price` int(11) NOT NULL DEFAULT 0,
  `serial` text DEFAULT NULL,
  `pin` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `reason` text DEFAULT NULL,
  `credited` tinyint(1) NOT NULL DEFAULT 0,
  `request_id` varchar(64) DEFAULT NULL,
  `status_api` int(11) NOT NULL DEFAULT 0,
  `callback_raw` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dongtien`
--

CREATE TABLE `dongtien` (
  `id` int(11) NOT NULL,
  `sotientruoc` int(11) DEFAULT NULL,
  `sotienthaydoi` int(11) DEFAULT NULL,
  `sotiensau` int(11) DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `noidung` text DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `dongtien`
--

INSERT INTO `dongtien` (`id`, `sotientruoc`, `sotienthaydoi`, `sotiensau`, `thoigian`, `noidung`, `user_id`) VALUES
(429, 0, 270000, 270000, '2022-12-24 22:02:13', 'gjkhj', '2'),
(430, 270000, 130000, 400000, '2022-12-24 22:02:31', 'trừ', '2'),
(431, 9875535, 5001, 9880536, '2022-12-25 00:27:53', 'Nạp tiền tự động qua ví MOMO (33772336240)', '1'),
(432, 140000, 270000, 410000, '2022-12-25 00:55:36', 'fsdf', '2'),
(433, 9823870, 55555, 9768315, '2022-12-25 10:48:31', 'Mua mã nguồn mã số #6', '1'),
(434, 9822759, 889, 9821870, '2022-12-25 10:53:09', 'Mua mã nguồn mã số #4', '1'),
(435, 9821648, 1111, 9820537, '2022-12-25 12:04:27', 'Mua mã nguồn mã số #7', '1'),
(436, 9820537, 889, 9819648, '2022-12-25 15:32:43', 'Mua mã nguồn mã số #4', '1'),
(437, 9819426, 889, 9818537, '2022-12-25 15:32:53', 'Mua mã nguồn mã số #4', '1'),
(438, 9763871, 55555, 9708316, '2022-12-25 15:33:03', 'Mua mã nguồn mã số #6', '1'),
(439, 9751627, 12244, 9739383, '2022-12-25 15:33:12', 'Mua mã nguồn mã số #5', '1'),
(440, 9721627, 10000, 9711627, '2022-12-26 23:19:58', 'Mua gói hosting Gói AA1', '1'),
(441, 9314627, 2000, 9312627, '2022-12-27 23:14:21', 'Mua gói hosting ', '1'),
(442, 9312627, 2000, 9310627, '2022-12-27 23:14:29', 'Mua gói hosting ', '1'),
(443, 9299627, 13000, 9286627, '2022-12-27 23:22:40', 'Mua gói hosting ', '1'),
(444, 9286627, 13000, 9273627, '2022-12-27 23:22:48', 'Mua gói hosting ', '1'),
(445, 9273627, 13000, 9260627, '2022-12-27 23:30:22', 'Mua gói hosting ', '1'),
(446, 9260627, 13000, 9247627, '2022-12-27 23:30:28', 'Mua gói hosting ', '1'),
(447, 9247627, 13000, 9234627, '2022-12-27 23:31:31', 'Mua License hack Hack Map', '1'),
(448, 9234627, 13000, 9221627, '2022-12-27 23:34:11', 'Mua License hack Hack Map', '1'),
(449, 9221627, 13000, 9208627, '2022-12-27 23:34:19', 'Mua License hack Hack Map', '1'),
(450, 9037627, 5000, 9032627, '2022-12-28 17:17:56', 'Mua License hack Hack Map', '1'),
(451, 9032627, 5000, 9027627, '2022-12-28 17:18:29', 'Mua License hack Hack Map', '1'),
(452, 9027627, 5000, 9022627, '2022-12-28 17:18:42', 'Mua License hack Hack Map', '1'),
(453, 9022627, 5000, 9017627, '2022-12-28 17:18:49', 'Mua License hack Hack Map', '1'),
(454, 9017627, 5000, 9012627, '2022-12-28 17:18:58', 'Mua License hack Hack Map', '1'),
(455, 9012627, 5000, 9007627, '2022-12-28 17:19:49', 'Mua License hack Hack Map', '1'),
(456, 9004627, 8000, 8996627, '2022-12-29 13:07:26', 'Mua License hack Hack Map', '1'),
(457, 8999627, 5000, 8994627, '2022-12-29 13:10:10', 'Mua License hack Hack Map', '1'),
(458, 8994627, 5000, 8989627, '2022-12-29 13:10:25', 'Mua License hack Hack Map', '1'),
(459, 8993516, 1111, 8992405, '2023-01-04 11:22:22', 'Mua mã nguồn mã số #7', '1'),
(460, 8988516, 5000, 8983516, '2023-01-04 11:32:44', 'Mua License hack Hack Map', '1'),
(461, 8986516, 2000, 8984516, '2023-01-04 11:33:36', 'Mua License hack Hack Bất Tử', '1'),
(462, 8973516, 13000, 8960516, '2023-01-04 11:33:46', 'Mua License hack Hack Map', '1'),
(463, 8971516, 2000, 8969516, '2023-01-04 11:33:53', 'Mua License hack Hack Bất Tử', '1'),
(464, 8970405, 1111, 8969294, '2023-01-04 11:34:17', 'Mua mã nguồn mã số #7', '1'),
(465, 8888405, 2000, 8886405, '2023-01-27 18:09:47', 'Mua License hack Hack Bất Tử', '1'),
(466, 8802850, 55555, 8747295, '2023-01-27 20:57:58', 'Mua mã nguồn mã số #6', '1'),
(467, 8790606, 12244, 8778362, '2023-01-27 20:58:32', 'Mua mã nguồn mã số #5', '1'),
(468, 8777606, 13000, 8764606, '2023-01-27 21:32:26', 'Mua License hack Hack Map', '1'),
(469, 8775606, 2000, 8773606, '2023-02-07 15:02:00', 'Mua License hack Hack Bất Tử', '1'),
(470, 8775603, 3, 8775600, '2023-02-09 12:45:59', 'Mua License hack Hack Bất Tử', '1'),
(471, 8767603, 8000, 8759603, '2023-02-09 13:08:16', 'Mua License hack Hack Map', '1'),
(472, 8759603, 8000, 8751603, '2023-02-09 13:12:18', 'Mua License hack Hack Map', '1'),
(473, 8746603, 13000, 8733603, '2023-02-09 13:43:33', 'Mua License hack Hack Map', '1'),
(474, 8733603, 13000, 8720603, '2023-02-09 13:44:19', 'Mua License hack Hack Map', '1'),
(475, 8720603, 13000, 8707603, '2023-02-13 15:13:16', 'Mua License hack Hack Map', '1'),
(476, 8718603, 2000, 8716603, '2023-02-13 15:15:55', 'Mua License hack Hack Map', '1'),
(477, 0, 10000, 10000, '2026-03-03 23:54:02', 'Nạp tiền tự động ngân hàng (MBBANK | FT26062046619036)', '2'),
(478, 10000, 10000, 20000, '2026-03-03 23:54:02', 'Nạp tiền tự động ngân hàng (MBBANK | FT26062012040165)', '2'),
(479, 20000, 39957, 59957, '2026-03-04 02:37:40', 'Nạp tiền tự động ngân hàng (MBBANK | FT26063265532130)', '2'),
(480, 59957, 59597, 119554, '2026-03-04 06:18:21', '', '2'),
(481, 360, 360, 720, '2026-03-04 06:18:41', '', '2'),
(482, 0, 1000000, 1000000, '2026-03-04 06:43:02', '', '2'),
(483, 0, 200000, 200000, '2026-03-04 06:54:21', '', '3'),
(484, 200000, 1, 199999, '2026-03-04 07:02:10', 'Mua License hack BẢN BEAM-BYPASS_GAMELOOP - PUBG MOBILE GIẢ LẬP', '3');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` text DEFAULT NULL,
  `device` text DEFAULT NULL,
  `create_date` text DEFAULT NULL,
  `action` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `ip`, `device`, `create_date`, `action`) VALUES
(342, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2022/12/24 21:58:25', 'Cập nhật thông tin thành viên useradmin1[2].'),
(343, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2022/12/25 00:55:29', 'Cập nhật thông tin thành viên useradmin1[2].'),
(344, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2022/12/25 12:46:01', 'Cập nhật thông tin [2].'),
(345, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2022/12/25 12:47:03', 'useradmin Đã cập nhật thông tin tài khoản'),
(346, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2022/12/25 12:47:32', 'useradmin Đã cập nhật thông tin tài khoản'),
(347, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2022/12/25 12:48:19', 'useradmin Đã cập nhật thông tin tài khoản'),
(348, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2022/12/25 13:23:04', 'Đăng nhập vào hệ thống'),
(349, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2022/12/25 15:49:50', 'Đăng nhập vào hệ thống'),
(350, 1, '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', '2022/12/25 15:59:12', 'Đăng nhập vào hệ thống'),
(351, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2022/12/26 12:12:05', 'Đăng nhập vào hệ thống'),
(352, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2022/12/26 19:23:50', 'Đăng nhập vào hệ thống'),
(353, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2022/12/26 21:03:47', 'Đăng nhập vào hệ thống'),
(354, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2022/12/27 13:41:59', 'Đăng nhập vào hệ thống'),
(355, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2022/12/27 23:14:06', 'Đăng nhập vào hệ thống'),
(356, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2022/12/28 16:43:49', 'Đăng nhập vào hệ thống'),
(357, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2022/12/29 13:02:03', 'Đăng nhập vào hệ thống'),
(358, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2023/01/01 14:08:25', 'Đăng nhập vào hệ thống'),
(359, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2023/01/04 10:58:08', 'Đăng nhập vào hệ thống'),
(360, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2023/01/04 18:41:50', 'Đăng nhập vào hệ thống'),
(361, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/01/27 17:46:07', 'Đăng nhập vào hệ thống'),
(362, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/01/27 18:22:07', 'useradmin Đã cập nhật thông tin tài khoản'),
(363, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/01/27 18:22:13', 'useradmin Đã cập nhật thông tin tài khoản'),
(364, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/04 21:32:33', 'Đăng nhập vào hệ thống'),
(365, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/06 19:46:49', 'Đăng nhập vào hệ thống'),
(366, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/06 19:59:55', 'Đăng nhập vào hệ thống'),
(367, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/06 20:00:30', 'Đăng nhập vào hệ thống'),
(368, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/06 20:12:52', 'Đăng nhập vào hệ thống'),
(369, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/06 20:40:13', 'useradmin Đã cập nhật thông tin tài khoản'),
(370, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/06 22:18:34', 'Đăng nhập vào hệ thống'),
(371, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/07 15:01:45', 'Đăng nhập vào hệ thống'),
(372, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/07 17:51:38', 'Đăng nhập vào hệ thống'),
(373, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/07 21:53:25', 'Đăng nhập vào hệ thống'),
(374, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/09 12:44:15', 'Đăng nhập vào hệ thống'),
(375, 1, '125.235.233.147', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6 Mobile/15E148 Safari/604.1', '2023/02/09 14:00:31', 'Đăng nhập vào hệ thống'),
(376, 1, '2402:800:6310:ba76:4428:7667:83d7:d998', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/09 14:02:41', 'Đăng nhập vào hệ thống'),
(377, 1, '125.235.233.147', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6 Mobile/15E148 Safari/604.1', '2023/02/12 16:15:34', 'Đăng nhập vào hệ thống'),
(378, 1, '125.235.233.147', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6 Mobile/15E148 Safari/604.1', '2023/02/12 16:19:27', 'Đăng nhập vào hệ thống'),
(379, 1, '125.235.233.147', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/12 18:49:40', 'Đăng nhập vào hệ thống'),
(380, 1, '125.235.233.147', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/12 20:59:08', 'Đăng nhập vào hệ thống'),
(381, 1, '125.235.233.147', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/12 22:08:55', 'Đăng nhập vào hệ thống'),
(382, 1, '125.235.233.147', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6 Mobile/15E148 Safari/604.1', '2023/02/12 22:26:34', 'Đăng nhập vào hệ thống'),
(383, 1, '125.235.233.147', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/13 00:51:40', 'Đăng nhập vào hệ thống'),
(384, 1, '125.235.233.147', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6 Mobile/15E148 Safari/604.1', '2023/02/13 01:32:31', 'Đăng nhập vào hệ thống'),
(385, 1, '125.235.233.147', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6 Mobile/15E148 Safari/604.1', '2023/02/13 14:37:01', 'Đăng nhập vào hệ thống'),
(386, 1, '125.235.233.147', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/13 14:37:36', 'Đăng nhập vào hệ thống'),
(387, 1, '125.235.233.147', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/13 14:54:05', 'Thực hiện nạp thẻ Serial: 10008490838535 - Pin: 114574479556315'),
(388, 1, '125.235.233.147', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/13 15:10:14', 'Đăng nhập vào hệ thống'),
(389, 1, '125.235.233.147', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/13 15:47:56', 'Đăng nhập vào hệ thống'),
(390, 1, '171.244.218.44', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/13 20:57:36', 'Đăng nhập vào hệ thống'),
(391, 1, '116.97.104.81', 'Mozilla/5.0 (Linux; Android 8.1.0; SM-T580) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023/02/14 08:54:10', 'Đăng nhập vào hệ thống'),
(392, 1, '27.72.113.44', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/02/14 13:10:55', 'Đăng nhập vào hệ thống'),
(393, 1, '1.55.45.159', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023/02/14 16:46:40', 'Đăng nhập vào hệ thống'),
(394, 1, '14.175.237.5', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.3 Mobile/15E148 Safari/604.1', '2023/02/18 23:10:47', 'Đăng nhập vào hệ thống'),
(395, 1, '171.226.55.194', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023/02/20 22:41:36', 'Đăng nhập vào hệ thống'),
(396, 1, '116.104.60.88', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Mobile/15E148 Safari/604.1', '2023/02/23 11:56:28', 'Đăng nhập vào hệ thống'),
(397, 1, '27.65.250.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 Edg/110.0.1587.50', '2023/02/24 11:19:34', 'Đăng nhập vào hệ thống'),
(398, 1, '125.235.233.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023/02/27 02:06:48', 'Đăng nhập vào hệ thống'),
(399, 1, '125.235.233.15', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6 Mobile/15E148 Safari/604.1', '2023/02/27 02:12:09', 'Đăng nhập vào hệ thống'),
(400, 1, '125.235.233.15', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_5_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1', '2023/02/27 03:49:52', 'Đăng nhập vào hệ thống'),
(401, 1, '125.235.233.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023/02/27 11:44:29', 'Đăng nhập vào hệ thống'),
(402, 1, '125.235.233.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023/02/27 11:46:51', 'Đăng nhập vào hệ thống'),
(403, 1, '125.235.233.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023/02/27 12:35:44', 'Đăng nhập vào hệ thống'),
(404, 1, '125.235.233.99', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_5_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1', '2023/02/27 12:47:09', 'Đăng nhập vào hệ thống'),
(405, 1, '113.185.72.207', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.1 Mobile/15E148 Safari/604.1', '2023/02/28 15:11:47', 'Đăng nhập vào hệ thống'),
(406, 1, '125.235.233.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023/02/28 15:34:54', 'Đăng nhập vào hệ thống'),
(407, 1, '113.173.6.79', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.1 Mobile/15E148 Safari/604.1', '2023/03/01 19:17:42', 'Đăng nhập vào hệ thống'),
(408, 1, '113.173.6.79', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.1 Mobile/15E148 Safari/604.1', '2023/03/01 19:18:01', 'Đăng nhập vào hệ thống'),
(409, 1, '27.68.87.4', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Mobile/15E148 Safari/604.1', '2023/03/03 06:11:59', 'Đăng nhập vào hệ thống'),
(410, 1, '113.185.79.43', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023/03/05 21:10:58', 'Đăng nhập vào hệ thống'),
(411, 1, '171.236.196.238', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023/03/07 16:19:13', 'Đăng nhập vào hệ thống'),
(412, 1, '42.117.40.166', 'Mozilla/5.0 (Linux; Android 12; SM-M127F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Mobile Safari/537.36', '2023/03/08 00:10:38', 'Đăng nhập vào hệ thống'),
(413, 1, '42.117.40.166', 'Mozilla/5.0 (Linux; Android 12; SM-M127F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Mobile Safari/537.36', '2023/03/08 00:31:19', 'Đăng nhập vào hệ thống'),
(414, 1, '14.191.236.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023/03/08 15:53:09', 'Đăng nhập vào hệ thống'),
(415, 1, '14.238.237.19', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023/03/09 11:58:40', 'Đăng nhập vào hệ thống'),
(416, 1, '14.238.237.19', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023/03/09 12:38:13', 'Đăng nhập vào hệ thống'),
(417, 1, '14.191.236.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023/03/09 19:09:54', 'Đăng nhập vào hệ thống'),
(418, 1, '14.191.236.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023/03/09 20:31:12', 'Đăng nhập vào hệ thống'),
(419, 1, '113.185.73.106', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1', '2023/03/10 20:07:59', 'Đăng nhập vào hệ thống'),
(420, 1, '14.238.237.19', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023/03/11 18:06:14', 'Đăng nhập vào hệ thống'),
(421, 1, '27.79.72.3', 'Mozilla/5.0 (Linux; Android 11; RMX2042) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Mobile Safari/537.36', '2023/03/12 16:54:36', 'Đăng nhập vào hệ thống'),
(422, 1, '27.79.72.3', 'Mozilla/5.0 (Linux; Android 11; RMX2042) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Mobile Safari/537.36', '2023/03/12 16:54:36', 'Đăng nhập vào hệ thống'),
(423, 1, '125.235.232.83', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '2023/03/12 19:45:25', 'Đăng nhập vào hệ thống'),
(424, 1, '27.79.72.3', 'Mozilla/5.0 (Linux; Android 11; RMX2042) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Mobile Safari/537.36', '2023/03/12 21:13:22', 'Đăng nhập vào hệ thống'),
(425, 1, '14.238.237.19', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023/03/15 10:33:59', 'Đăng nhập vào hệ thống'),
(426, 1, '118.71.221.121', 'Mozilla/5.0 (Linux; Android 12; SM-M127F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023/03/15 12:05:46', 'Đăng nhập vào hệ thống'),
(427, 1, '118.71.221.121', 'Mozilla/5.0 (Linux; Android 12; SM-M127F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023/03/15 12:05:55', 'Đăng nhập vào hệ thống'),
(428, 1, '14.169.115.30', 'Mozilla/5.0 (Linux; Android 9; Redmi S2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Mobile Safari/537.36', '2023/03/17 17:34:19', 'Đăng nhập vào hệ thống'),
(429, 1, '14.238.237.50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023/03/18 01:53:28', 'Đăng nhập vào hệ thống'),
(430, 1, '14.178.78.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023/03/19 19:14:55', 'Đăng nhập vào hệ thống'),
(431, 1, '117.3.255.38', 'Mozilla/5.0 (Linux; Android 11; RMX2042) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Mobile Safari/537.36', '2023/03/20 11:57:23', 'Đăng nhập vào hệ thống'),
(432, 1, '117.3.255.38', 'Mozilla/5.0 (Linux; Android 11; RMX2042) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Mobile Safari/537.36', '2023/03/20 11:57:24', 'Đăng nhập vào hệ thống'),
(433, 1, '125.235.231.40', 'Mozilla/5.0 (Linux; Android 10; RMX1971) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Mobile Safari/537.36', '2023/03/20 23:53:20', 'Đăng nhập vào hệ thống'),
(434, 1, '14.178.78.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023/03/22 00:58:38', 'Đăng nhập vào hệ thống'),
(435, 1, '14.178.78.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023/03/22 00:58:39', 'Đăng nhập vào hệ thống'),
(436, 1, '171.251.239.65', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023/03/26 22:39:08', 'Đăng nhập vào hệ thống'),
(437, 5, '171.249.59.203', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6 Mobile/15E148 Safari/604.1', '2023/03/28 00:51:26', 'Đăng nhập vào hệ thống'),
(438, 1, '117.5.90.187', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/111.0.5563.101 Mobile/15E148 Safari/604.1', '2023/03/28 20:18:09', 'Đăng nhập vào hệ thống'),
(439, 6, '116.103.232.150', 'Mozilla/5.0 (Linux; Android 11; RMX2042) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Mobile Safari/537.36', '2023/03/29 19:53:20', 'Đăng nhập vào hệ thống'),
(440, 6, '116.103.232.150', 'Mozilla/5.0 (Linux; Android 11; RMX2042) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Mobile Safari/537.36', '2023/03/30 12:04:57', 'Đăng nhập vào hệ thống'),
(441, 6, '116.103.232.150', 'Mozilla/5.0 (Linux; Android 11; RMX2042) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Mobile Safari/537.36', '2023/03/30 12:49:15', 'Đăng nhập vào hệ thống'),
(442, 1, '125.235.233.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023/03/30 13:40:11', 'Đăng nhập vào hệ thống'),
(443, 6, '116.103.232.150', 'Mozilla/5.0 (Linux; Android 11; RMX2042) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Mobile Safari/537.36', '2023/03/30 17:50:26', 'Đăng nhập vào hệ thống'),
(444, 6, '116.103.232.150', 'Mozilla/5.0 (Linux; Android 11; RMX2042) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Mobile Safari/537.36', '2023/03/30 17:50:27', 'Đăng nhập vào hệ thống'),
(445, 1, '116.97.108.157', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023/03/30 22:05:06', 'Đăng nhập vào hệ thống'),
(446, 1, '103.82.23.145', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/111.0.5563.101 Mobile/15E148 Safari/604.1', '2023/04/05 07:56:25', 'Đăng nhập vào hệ thống'),
(447, 1, '103.82.23.145', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/111.0.5563.101 Mobile/15E148 Safari/604.1', '2023/04/05 08:04:16', 'Đăng nhập vào hệ thống'),
(448, 1, '116.111.217.52', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36', '2023/04/05 21:24:53', 'Đăng nhập vào hệ thống'),
(449, 1, '103.199.57.210', 'Mozilla/5.0 (Linux; Android 12; CPH2219) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Mobile Safari/537.36', '2023/04/06 07:10:47', 'Đăng nhập vào hệ thống'),
(450, 1, '103.199.57.210', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023/04/06 07:15:03', 'Đăng nhập vào hệ thống'),
(451, 1, '171.234.9.125', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36', '2023/04/06 11:55:16', 'Đăng nhập vào hệ thống'),
(452, 1, '171.234.9.125', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36', '2023/04/06 12:59:03', 'Đăng nhập vào hệ thống'),
(453, 1, '27.65.61.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.62', '2023/04/06 17:06:24', 'Đăng nhập vào hệ thống'),
(454, 1, '116.111.217.52', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36', '2023/04/06 23:04:12', 'Đăng nhập vào hệ thống'),
(455, 1, '116.111.217.52', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36', '2023/04/07 10:19:12', 'Đăng nhập vào hệ thống'),
(456, 1, '171.234.9.129', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36', '2023/04/08 14:02:35', 'Đăng nhập vào hệ thống'),
(457, 1, '1.53.198.121', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36', '2023/04/09 17:28:37', 'Đăng nhập vào hệ thống'),
(458, 1, '1.53.198.121', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36', '2023/04/09 17:32:43', 'Đăng nhập vào hệ thống'),
(459, 1, '1.53.198.121', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36', '2023/04/09 18:02:17', 'Đăng nhập vào hệ thống'),
(460, 1, '116.111.217.52', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023/04/10 00:15:19', 'Đăng nhập vào hệ thống'),
(461, 1, '125.235.233.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023/04/10 01:09:54', 'Đăng nhập vào hệ thống'),
(462, 1, '171.234.9.118', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Mobile Safari/537.36', '2023/04/11 11:49:22', 'Đăng nhập vào hệ thống'),
(463, 1, '42.113.156.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023/04/11 12:26:55', 'Đăng nhập vào hệ thống'),
(464, 1, '42.113.156.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', '2023/04/11 12:26:58', 'Đăng nhập vào hệ thống'),
(465, 1, '27.71.108.225', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6.1 Mobile/15E148 Safari/604.1', '2023/04/12 14:15:43', 'Đăng nhập vào hệ thống'),
(466, 1, '42.113.156.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023/04/14 15:25:01', 'Đăng nhập vào hệ thống'),
(467, 1, '171.253.21.94', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6 Mobile/15E148 Safari/604.1', '2023/04/14 15:31:42', 'Đăng nhập vào hệ thống'),
(468, 1, '171.253.21.94', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6 Mobile/15E148 Safari/604.1', '2023/04/14 15:58:37', 'Đăng nhập vào hệ thống'),
(469, 1, '125.235.232.144', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023/04/14 16:16:02', 'Đăng nhập vào hệ thống'),
(470, 1, '125.235.232.144', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023/04/14 16:16:35', 'Thay đổi mật khẩu'),
(471, 1, '125.235.232.144', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023/04/14 16:17:02', 'Đăng nhập vào hệ thống'),
(472, 1, '125.235.232.144', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023/04/14 20:30:32', 'Đăng nhập vào hệ thống'),
(473, 1, '171.253.21.94', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6 Mobile/15E148 Safari/604.1', '2023/04/14 20:33:58', 'Đăng nhập vào hệ thống'),
(474, 1, '125.235.232.129', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023/04/17 19:40:01', 'Đăng nhập vào hệ thống'),
(475, 1, '125.235.232.76', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023/04/21 13:12:01', 'Đăng nhập vào hệ thống'),
(476, 10, '42.118.49.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023/04/22 08:35:01', 'Đăng nhập vào hệ thống'),
(477, 11, '103.170.119.21', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_4_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.4 Mobile/15E148 Safari/604.1', '2023/04/24 22:06:48', 'Đăng nhập vào hệ thống'),
(478, 10, '42.118.51.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023/04/26 16:48:43', 'Đăng nhập vào hệ thống'),
(479, 1, '125.235.233.115', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6 Mobile/15E148 Safari/604.1', '2023/04/28 00:21:15', 'Đăng nhập vào hệ thống'),
(480, 15, '14.167.220.93', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.0.0', '2023/05/02 00:49:57', 'Đăng nhập vào hệ thống'),
(481, 17, '171.255.171.79', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Mobile Safari/537.36', '2023/05/20 06:43:47', 'Đăng nhập vào hệ thống'),
(482, 17, '171.234.9.170', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Mobile Safari/537.36', '2023/05/20 11:04:51', 'Đăng nhập vào hệ thống'),
(483, 18, '1.52.23.221', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Mobile Safari/537.36', '2023/05/30 09:30:15', 'Đăng nhập vào hệ thống'),
(484, 20, '42.114.16.189, 42.114.16.189', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', '2023/11/08 16:41:37', 'Đăng nhập vào hệ thống'),
(485, 20, '42.114.16.189, 42.114.16.189', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', '2023/11/08 18:06:17', 'Đăng nhập vào hệ thống'),
(486, 20, '42.114.16.189, 42.114.16.189', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', '2023/11/08 21:31:18', 'Đăng nhập vào hệ thống'),
(487, 20, '42.114.16.189, 42.114.16.189', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', '2023/11/08 21:31:48', 'Đăng nhập vào hệ thống'),
(488, 6, '2001:ee0:4f8a:37d0:296a:acb1:3e1e:54e4, 2001:ee0:4f8a:37d0:296a:acb1:3e1e:54e4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0', '2023/11/11 19:59:45', 'Đăng nhập vào hệ thống'),
(489, 6, '2001:ee0:500b:3570:a40a:d32b:e166:4905, 2001:ee0:500b:3570:a40a:d32b:e166:4905', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 Edg/120.0.0.0', '2023/12/10 13:38:59', 'Đăng nhập vào hệ thống'),
(490, 1, '125.235.232.203, 125.235.232.203', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2024/01/03 22:35:17', 'Đăng nhập vào hệ thống'),
(491, 25, '2402:800:6279:caf8:e7b7:6769:12ae:8141, 2402:800:6279:caf8:e7b7:6769:12ae:8141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', '2024/01/11 15:33:12', 'Đăng nhập vào hệ thống'),
(492, 1, '125.235.232.203, 125.235.232.203', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2024/01/18 12:52:40', 'Đăng nhập vào hệ thống'),
(493, 26, '203.145.47.22, 203.145.47.22', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.0 Mobile/15E148 Safari/604.1', '2024/01/18 13:33:48', 'Đăng nhập vào hệ thống'),
(494, 26, '14.243.100.17, 14.243.100.17', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.0 Mobile/15E148 Safari/604.1', '2024/01/18 19:59:45', 'Đăng nhập vào hệ thống'),
(495, 26, '2402:800:621e:4412:2df7:5514:460e:3fb6, 2402:800:621e:4412:2df7:5514:460e:3fb6', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.0 Mobile/15E148 Safari/604.1', '2024/01/20 17:05:03', 'Đăng nhập vào hệ thống'),
(496, 29, '171.251.236.30, 171.251.236.30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', '2024/02/01 22:55:19', 'Xác nhận khôi phục mật khẩu qua mail: legendma9ngon@gmail.com'),
(497, 29, '171.251.236.30, 171.251.236.30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', '2024/02/01 22:55:32', 'Xác nhận khôi phục mật khẩu qua mail: legendma9ngon@gmail.com'),
(498, 6, '2402:800:62f8:f389:1d90:ca1e:a13c:8707, 2402:800:62f8:f389:1d90:ca1e:a13c:8707', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/121.0.6167.138 Mobile/15E148 Safari/604.1', '2024/02/07 13:29:49', 'Đăng nhập vào hệ thống'),
(499, 24, '2402:800:62f8:f389:f4f5:6efd:d562:25ed, 2402:800:62f8:f389:f4f5:6efd:d562:25ed', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2024/02/07 19:42:22', 'Đăng nhập vào hệ thống'),
(500, 24, '2402:800:62f8:f389:f4f5:6efd:d562:25ed, 2402:800:62f8:f389:f4f5:6efd:d562:25ed', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2024/02/07 19:44:24', 'Đăng nhập vào hệ thống'),
(501, 31, '2001:ee0:4e66:38b0:8d19:e4d:ad59:eb2a, 2001:ee0:4e66:38b0:8d19:e4d:ad59:eb2a', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_3_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.3 Mobile/15E148 Safari/604.1', '2024/03/28 18:48:25', 'Đăng nhập vào hệ thống'),
(502, 31, '2001:ee0:4e66:38b0:8d19:e4d:ad59:eb2a, 2001:ee0:4e66:38b0:8d19:e4d:ad59:eb2a', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_3_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.3 Mobile/15E148 Safari/604.1', '2024/03/28 18:49:19', 'Đăng nhập vào hệ thống'),
(503, 1, '2402:800:6310:c7c2:4945:8ee6:22a:d22c, 2402:800:6310:c7c2:4945:8ee6:22a:d22c', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024/04/26 22:17:54', 'Đăng nhập vào hệ thống'),
(504, 2, '171.250.164.75, 162.158.162.48', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.3 Mobile/15E148 Safari/604.1', '2026/03/03 10:23:35', 'Đăng nhập vào hệ thống'),
(505, 2, '171.250.164.75, 172.71.124.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/03 11:21:05', 'Cập nhật thông tin thành viên gamemeee[3].'),
(506, 2, '171.250.164.75, 172.71.124.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/03 11:21:21', 'Cập nhật thông tin thành viên gamemeee[3].'),
(507, 2, '171.250.164.75, 172.71.124.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/03 11:21:36', 'Cập nhật thông tin thành viên gamemeee[3].'),
(508, 2, '171.250.164.75, 172.71.124.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/03 11:21:44', 'Cập nhật thông tin thành viên gamemeee[3].'),
(509, 3, '171.250.164.75, 162.158.106.172', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/03 12:14:36', 'Đăng nhập vào hệ thống'),
(510, 2, '171.250.164.75, 162.158.88.61', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/03 21:41:55', 'Đăng nhập vào hệ thống'),
(511, 2, '171.250.164.75, 104.23.175.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/03 23:19:14', 'Đăng nhập vào hệ thống'),
(512, 2, '171.250.164.75, 162.158.162.48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 00:00:39', 'Đăng nhập vào hệ thống'),
(513, 3, '171.250.164.75, 162.158.171.5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 04:22:20', 'Đăng nhập vào hệ thống'),
(514, 2, '171.250.164.75, 172.71.124.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 06:12:54', 'Thay đổi quyền Admin cho thành viên gamemeee1[4].'),
(515, 4, NULL, NULL, '2026/03/04 06:12:54', 'Bạn được Admin thuidit123456789 thay đổi quyền Admin.'),
(516, 2, '171.250.164.75, 172.71.124.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 06:12:54', 'Cập nhật thông tin thành viên gamemeee1[4].'),
(517, 2, '171.250.164.75, 172.71.124.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 06:13:08', 'Cập nhật thông tin thành viên gamemeee1[4].'),
(518, 2, '171.250.164.75, 172.71.124.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 06:13:22', 'Thay đổi quyền Admin cho thành viên gamemeee1[4].'),
(519, 4, NULL, NULL, '2026/03/04 06:13:22', 'Bạn được Admin thuidit123456789 thay đổi quyền Admin.'),
(520, 2, '171.250.164.75, 172.71.124.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 06:13:22', 'Cập nhật thông tin thành viên gamemeee1[4].'),
(521, 2, '171.250.164.75, 172.71.124.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 06:13:25', 'Cập nhật thông tin thành viên gamemeee1[4].'),
(522, 2, '171.250.164.75, 172.70.208.76', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 06:17:45', 'Cập nhật thông tin thành viên gamemeee1[4].'),
(523, 2, '171.250.164.75, 172.70.208.76', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 06:17:55', 'Thay đổi quyền Admin cho thành viên gamemeee1[4].'),
(524, 4, NULL, NULL, '2026/03/04 06:17:55', 'Bạn được Admin thuidit123456789 thay đổi quyền Admin.'),
(525, 2, '171.250.164.75, 172.70.208.76', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 06:17:55', 'Cập nhật thông tin thành viên gamemeee1[4].'),
(526, 2, '171.250.164.75, 172.70.208.76', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 06:18:05', 'Thay đổi quyền Admin cho thành viên gamemeee1[4].'),
(527, 4, NULL, NULL, '2026/03/04 06:18:05', 'Bạn được Admin thuidit123456789 thay đổi quyền Admin.'),
(528, 2, '171.250.164.75, 172.70.208.76', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 06:18:05', 'Cập nhật thông tin thành viên gamemeee1[4].'),
(529, 2, '171.250.164.75, 172.70.208.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 06:26:46', 'Đăng nhập vào hệ thống'),
(530, 2, '171.250.164.75, 172.70.147.178', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.3 Mobile/15E148 Safari/604.1', '2026/03/04 06:34:33', 'Đăng nhập vào hệ thống'),
(531, 3, '171.250.164.75, 162.158.108.125', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 06:53:45', 'Đăng nhập vào hệ thống'),
(532, 2, '171.250.164.75, 172.71.152.36', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.3 Mobile/15E148 Safari/604.1', '2026/03/04 07:03:01', 'Đăng nhập vào hệ thống'),
(533, 3, '171.250.164.75, 172.71.152.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 07:40:09', 'Đăng nhập vào hệ thống'),
(534, 4, '171.250.164.75, 172.71.152.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 07:40:38', 'Xác nhận khôi phục mật khẩu qua mail: huhi61300@gmail.com'),
(535, 4, '171.250.164.75, 172.71.152.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 07:41:21', 'Xác nhận khôi phục mật khẩu qua mail: huhi61300@gmail.com'),
(536, 2, '171.250.164.75, 172.71.124.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 07:46:19', 'Đăng nhập vào hệ thống'),
(537, 3, '171.250.164.75, 172.71.152.35', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 07:47:53', 'Đăng nhập vào hệ thống'),
(538, 3, '171.250.164.75, 162.158.88.60', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026/03/04 07:50:33', 'Đăng nhập vào hệ thống'),
(539, 2, '171.250.164.75, 172.71.152.35', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.3 Mobile/15E148 Safari/604.1', '2026/03/04 08:06:21', 'Đăng nhập vào hệ thống');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `options`
--

INSERT INTO `options` (`id`, `key`, `value`) VALUES
(1, 'title', 'Shop bán mã nguồn tự động - an toàn- uy tín'),
(2, 'mota', ''),
(3, 'tukhoa', ''),
(4, 'logo', 'upload/theme/logo_light_PEM.png'),
(12, 'thongbao', '<p style=\"text-align:center\"><img alt=\"hot-icon - AQUA CITY\" class=\"sweezy-custom-cursor-default-hover\" src=\"https://aquacityvn.vn/wp-content/uploads/2021/04/hot-icon.gif\" style=\"height:30px; width:30px\" />&nbsp;<span style=\"font-size:26px\"><strong><em>Trần H&agrave;o Dev</em></strong></span><span style=\"font-size:20px\"><strong><em>&nbsp;</em></strong></span><img alt=\"hot-icon - AQUA CITY\" class=\"sweezy-custom-cursor-default-hover\" src=\"https://aquacityvn.vn/wp-content/uploads/2021/04/hot-icon.gif\" style=\"height:30px; width:30px\" /></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n'),
(13, 'anhbia', 'data:image/webp;base64,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'),
(14, 'favicon', 'upload/theme/favicon_237.png'),
(57, 'domain', 'sieuthicode.net'),
(59, 'logo_light', 'assets/storage/images/logo_light_27S.png'),
(60, 'description', 'TRANHAODEV.TOP - Bán mã nguồn, source code'),
(61, 'keywords', 'TRANHAODEV.TOP,TRANHAODEV.CLICK'),
(62, 'author', 'Trần Hào Dev'),
(63, 'status', '1'),
(64, 'status_update', '1'),
(65, 'status_captcha', '1'),
(66, 'hotline', '0559705922'),
(67, 'email', 'haohaone1029@gmail.com'),
(68, 'email_smtp', 'cskh.sieuthicode@gmail.com'),
(69, 'pass_email_smtp', ''),
(70, 'session_login', '2592000'),
(71, 'min_recharge', '1000'),
(72, 'status_card', '1'),
(73, 'notice_napthe', '<p style=\"text-align:center\"><span style=\"font-size:16px\"><strong>Vui l&ograve;ng nhập đầy đủ th&ocirc;ng tin&nbsp;Serial&nbsp;-&nbsp;Pin&nbsp;-&nbsp;Mệnh Gi&aacute;&nbsp;của thẻ.</strong></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:16px\"><strong>Thẻ được xử l&yacute; tự động trong v&agrave;i gi&acirc;y.</strong></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:16px\"><strong>Nạp sai mệnh gi&aacute; mất&nbsp;50%&nbsp;gi&aacute; trị thực của thẻ.</strong></span></p>\r\n'),
(74, 'partner_key_card', '1840cc86caa649c7cbc0162619e8ff5e'),
(75, 'partner_id_card', '2055167596'),
(76, 'noidung_naptien', 'Hack'),
(77, 'status_momo', '0'),
(78, 'token_momo', ''),
(79, 'ck_bank', '0'),
(80, 'status_mbbank', '1'),
(81, 'token_mbbank', 'ffdfcd73c3a7588248790340455349da'),
(82, 'token_tsr', ''),
(83, 'notification', '1'),
(84, 'status_tsr', '1'),
(85, 'color', '#ffffff'),
(86, 'notice_napbank', '<p style=\"text-align:center\"><strong><em>Thu&ecirc; API Bank tại : sieuthicode</em></strong></p>\r\n\r\n<p style=\"text-align:center\"><strong><em>Link Cron ACB: https://tenweb/</em></strong><strong><em>cronjob/acb.php</em></strong></p>\r\n\r\n<p style=\"text-align:center\"><strong><em>Link Cron VCB:&nbsp;https://tenweb/</em></strong><strong><em>cronjob/vcb.php</em></strong></p>\r\n\r\n<p style=\"text-align:center\"><strong><em>Llink Cron MBbank:&nbsp;https://tenweb/</em></strong><strong><em>cronjob/bank.php</em></strong></p>\r\n'),
(87, 'notice_transfer', '<p><span style=\"color:#2c3e50\"><strong>- Ph&iacute; cố định 0đ</strong></span></p>\r\n\r\n<p><span style=\"color:#2c3e50\"><strong>- Chuyển tiền kh&ocirc;ng giới hạn</strong></span></p>\r\n\r\n<p><span style=\"color:#2c3e50\"><strong>- Số tiền chuyển tối thiểu l&agrave; 10.000đ</strong></span></p>\r\n'),
(88, 'status_demo', '0'),
(89, 'notice_withdraw', '<p><span style=\"color:#2c3e50\"><strong>Kh&ocirc;ng thể r&uacute;t tiền đối với t&agrave;i khoản&nbsp;Th&agrave;nh Vi&ecirc;n</strong></span></p>\r\n'),
(90, 'notice_check_nro', '<p><span style=\"color:#e74c3c\"><strong>C&ocirc;ng cụ check số lượng lớn t&agrave;i khoản nro ho&agrave;n to&agrave;n miễn ph&iacute;</strong></span></p>\r\n\r\n<p><span style=\"color:#e74c3c\"><strong>Ch&uacute;c c&aacute;c bạn một ng&agrave;y vui vẻ</strong></span></p>\r\n'),
(91, 'notice_account', '<p><strong>Hệ thống b&aacute;n t&agrave;i khoản game đa dạng, t&igrave;m kiếm acc t&ugrave;y th&iacute;ch, dễ d&agrave;ng sử dụng</strong></p>\r\n'),
(92, 'banner_active', 'https://i.imgur.com/JUxlDUE.png'),
(93, 'banner_1', 'upload/theme/banner/banner_UJI.png'),
(94, 'banner_2', 'upload/theme/banner/banner_V5C.png'),
(95, 'site_key', '6LeP4n0sAAAAAPNz9A4XdzrOlgg7O7whXK59Otd7'),
(96, 'secret_key', '6LeP4n0sAAAAAE8iZVGcxHzjMa8dq3JJVVtkfozZ'),
(97, 'notice_plowing', '<p><span style=\"color:#2c3e50\"><strong>C&aacute;c bạn ch&uacute; &yacute; trạng th&aacute;i ho&agrave;n th&agrave;nh khi thu&ecirc; g&oacute;i</strong></span></p>\r\n\r\n<p><span style=\"color:#2c3e50\"><strong>Kh&ocirc;ng được ph&eacute;p v&agrave;o t&agrave;i khoản khi đang trong qu&aacute; tr&igrave;nh c&agrave;y</strong></span></p>\r\n'),
(98, 'token_zalopay', ''),
(99, 'status_zalopay', '0'),
(100, 'link_facebook', 'https://www.facebook.com/profile.php?id=61578683206427'),
(101, 'link_youtube', 'https://www.youtube.com/@TRANHAODEV'),
(102, 'status_vcb', '1'),
(103, 'token_vcb', ''),
(104, 'status_sellacc', '1'),
(105, 'status_service', '1'),
(106, 'token_acb', ''),
(107, 'status_acb', '1'),
(108, 'logo_center', 'upload/theme/images/logo_mobile_GSQ.png'),
(109, 'embed_youtube', 'https://www.youtube.com/embed/gqSeaGBTJIU'),
(110, 'embed_intro', 'https://www.youtube.com/embed/gqSeaGBTJIU'),
(111, 'server_card', 'gachthe1s'),
(112, 'check_time_cron_momo', '1681363389'),
(113, 'money_reg', '0'),
(114, 'client_id_imgur', '9a032c6333834c2'),
(115, 'status_imgur', '1'),
(116, 'button_vongquay', 'https://i.imgur.com/76ueWU0.png'),
(117, 'button_play', 'https://i.imgur.com/XdaeYwn.png'),
(118, 'banner_one', 'https://i.imgur.com/uNmov6G.jpg'),
(119, 'status_banner', '1'),
(120, 'status_cursor', '1'),
(121, 'cursor_default', 'https://i.imgur.com/5yjr7GW.png'),
(122, 'cursor_hover', 'https://i.imgur.com/HvAPaFB.png'),
(123, 'status_minify', '0'),
(124, 'status_anti_f12', '0'),
(125, 'status_snowflake', '1'),
(126, 'api_key_host', 'ab13f05f2b15a8cb4bd083646f5af1f40ce0c40315c981a582eb02f3c'),
(127, 'banner', 'upload/theme/banner_23K.png'),
(128, 'footer', 'upload/theme/footer_ZW6.png'),
(129, 'noti_home', 'Trần Hào Dev - CODE WEBSITE BÁN HACK SỐ 1 VIỆT NAM'),
(130, 'noti_popup', '<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(131, 'card_partner_link', 'https://gachthefast.com/chargingws/v2'),
(132, 'ck_card', '20'),
(133, 'card_callback_url', 'https://trumroblox.store/api/card_callback.php'),
(134, 'status_card', '1'),
(135, 'card_partner_link', 'https://gachthefast.com/chargingws/v2'),
(136, 'partner_id_card', '2055167596'),
(137, 'partner_key_card', '1840cc86caa649c7cbc0162619e8ff5e'),
(138, 'ck_card', '20'),
(139, 'card_api_type', 'chargingws'),
(140, 'card_callback_url', 'https://trumroblox.store/api/card_callback.php'),
(141, 'card_verify_sign', '0'),
(142, 'card_api_type', 'chargingws'),
(143, 'card_partner_link', ''),
(144, 'partner_id_card', ''),
(145, 'partner_key_card', ''),
(146, 'card_callback_url', ''),
(147, 'card_json_map', '{\"request_id\":\"request_id\",\"status\":\"status\",\"amount\":\"amount\",\"received\":\"received\",\"message\":\"message\"}');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_blogs`
--

CREATE TABLE `tbl_blogs` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(11) NOT NULL,
  `stt` int(11) DEFAULT 1,
  `name` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `stt`, `name`, `slug`, `status`, `create_date`, `update_date`) VALUES
(1, 1, 'Danh mục shop acc', 'danh-muc-shop-acc', 1, '2022-12-24 20:52:31', '2022-12-25 11:39:51'),
(2, 2, 'Danh mục shop clone', 'danh-muc-shop-clone', 1, '2022-12-24 20:52:31', '2022-12-25 11:39:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category_hack`
--

CREATE TABLE `tbl_category_hack` (
  `id` int(11) NOT NULL,
  `stt` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category_hack`
--

INSERT INTO `tbl_category_hack` (`id`, `stt`, `name`, `slug`, `images`, `content`, `status`, `create_date`, `update_date`) VALUES
(2, 2, 'PANEL PC-PYBASS', 'panel-pc-pybass', 'upload/product/productDRJXHB.png', 'Là Phần Mền , Hỗ Trợ Kéo Tâm Cho , Và Giúp Aim Đầu Chặt Hơn', 1, '2022-12-27 15:46:39', '2022-12-27 15:46:39'),
(3, 1, 'PUBG MOBILE GIẢ LẬP', 'pubg-mobile-gia-lap', 'upload/product/product5C6P3N.png', 'Hack sử dụng trên giả lập', 1, '2023-02-06 22:40:17', '2026-03-04 05:39:33'),
(4, 2, 'PUBG MOBILE ANDROID', 'pubg-mobile-android', 'upload/product/productQLXN23.png', 'Hack PUBG Mobile trên điện thoại Android siêu an toàn', 1, '2023-02-06 22:40:46', '2023-02-06 22:40:46'),
(5, 3, 'PUBG STEAM', 'pubg-steam', 'upload/product/product4YVO5Z.png', 'HACK PUBG PC STEAM BẢO TRÌ ĐỊNH KỲ THỨ 4 HÀNG TUẦN DO GAME UPDATE LƯU Ý', 1, '2023-02-06 22:41:15', '2023-02-06 22:41:15'),
(6, 4, 'HACK LIÊN QUÂN LQ', 'hack-lien-quan-lq', 'upload/product/productZPICNF.png', 'HACK LIÊN QUÂN HỖ TRỢ CÁC HỆ ĐIỀU HÀNH IOS - ANDROID GIÚP CÁC BẠN DÀNH LỢI THẾ TRONG TRẬN ĐẤU', 1, '2023-02-06 22:41:45', '2023-02-06 22:41:45'),
(7, 5, 'LIÊN MINH HUYỀN THOẠI', 'lien-minh-huyen-thoai', 'upload/product/productHRKJBM.png', 'TOOL LIÊN MINH HUYỀN THOẠI HỖ TRỢ BẠN COMBO NHAN, NÉ SKILL, AUTO TRÙNG PHẠT VÀ BƠM MÁU. AN TOÀN CAO', 1, '2023-02-06 22:42:56', '2023-02-06 22:42:56'),
(8, 6, 'HACK FREE FIRE', 'hack-free-fire', 'upload/product/productRYDO6P.png', 'Hack Liên Quân Free Fire NHIỀU CHỨC NĂNG BÁ ĐẠO ỔN ÁP', 1, '2023-02-06 22:48:08', '2023-02-06 22:48:08'),
(9, 7, 'PUBG MOBILE IOS', 'pubg-mobile-ios', 'upload/product/productKTDENZ.png', 'Hack PUBG Mobile trên điện thoại IOS siêu an toàn', 1, '2023-02-06 22:49:07', '2023-02-06 22:49:07'),
(11, 8, 'Play Together', 'play-together', 'upload/product/product6W58K7.png', 'Cách Auto câu cá Play Together trên Android, iOS, PC an toàn ...', 1, '2026-03-03 12:11:12', '2026-03-03 12:12:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_groups_hack`
--

CREATE TABLE `tbl_groups_hack` (
  `id` int(11) NOT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `stt` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `tutorial` longtext DEFAULT NULL,
  `link_down` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_groups_hack`
--

INSERT INTO `tbl_groups_hack` (`id`, `cate_id`, `stt`, `name`, `slug`, `images`, `content`, `tutorial`, `link_down`, `status`, `create_date`, `update_date`) VALUES
(1, 1, 1, 'Hack Map', 'hack-map', 'upload/product/productYDMEZ0.png', '<h5><strong>ANTIBAN:&nbsp;80%</strong></h5>\r\n\r\n<h5><strong>Y&ecirc;u Cầu Ẩn Jailbreak:&nbsp;C&oacute;</strong></h5>\r\n\r\n<p><br />\r\n- Esp<br />\r\n- Aimbot<br />\r\n- Aim Lock<br />\r\n- Chams<br />\r\n- Auto Headshot<br />\r\n- Headshot Đầu Cu<br />\r\n-Cổ D&agrave;i<br />\r\n- Ghost Hack<br />\r\n- Leo Tường<br />\r\n- Antenna<br />\r\n- Trời Tối<br />\r\n- Hồi M&aacute;u Nhanh Như Maxim<br />\r\n- Kh&ocirc;ng Rung Scope<br />\r\n- No Recoil<br />\r\n- Người M&agrave;u<br />\r\n- Buff Damage Ảo<br />\r\n- Xo&aacute; T&agrave;i Khoản Kh&aacute;ch<br />\r\n- Speed Run No Die (Tuỳ Phi&ecirc;n Bản Sẽ Sử Dụng Được Hoặc Kh&ocirc;ng, N&ecirc;n Xem Kĩ Video Tr&ecirc;n Youtube Mới Nhất Về Hack)<br />\r\n- Nhảy Cao (Tuỳ Phi&ecirc;n Bản Sẽ Sử Dụng Được Hoặc Kh&ocirc;ng, N&ecirc;n Xem Kĩ Video Tr&ecirc;n Youtube Mới Nhất Về Hack)</p>', '<h5><strong>Lưu &yacute;:</strong></h5>\r\n\r\n<p>- Nếu bị tr&igrave;nh duyệt Chrome chặn tải file, vui l&ograve;ng xem:&nbsp;<a href=\"https://fptshop.com.vn/tin-tuc/thu-thuat/cach-khac-phuc-loi-google-chrome-chan-tep-tai-xuong-130498\">CLICK XEM</a><br />\r\n- C&aacute;ch tắt Diệt Virus Win10, Windows Defender (cho c&aacute;c bạn ko tải file được):&nbsp;<a href=\"https://www.youtube.com/watch?v=cC5SF7RaK8U\">CLICK XEM</a><br />\r\n&nbsp;</p>\r\n\r\n<h5><strong>Đối Với Key:</strong></h5>\r\n\r\n<p>- 1 Key Chỉ C&oacute; Thể Sử Dụng Được Tr&ecirc;n 1 Thiết Bị.<br />\r\n- Chuyển Đổi Game, X&oacute;a Dữ Liệu Game, Reset Thiết Bị, Chuyển Đổi Menu Từ Jailbreak Sang Non Jailbreak Hoặc Ngược Lại Sẽ Mất Key, Kh&ocirc;ng Thể Nhập Lại Trừ Khi Bạn Phải Reset Key Mới C&oacute; Thể Nhập Lại Được Key Cũ Nếu C&ograve;n Hạn Sử Dụng!<br />\r\n- Ph&iacute; Reset Lại Key Để Tiếp Tục Sử Dụng L&agrave; 10.000vnđ. Nếu Bạn Muốn Reset Key Vui L&ograve;ng Li&ecirc;n Hệ Zalo:&nbsp;<a href=\"https://www.zalo.me/84325508901\"><strong><u><strong>Tại Đ&acirc;y</strong></u></strong></a>&nbsp;Để Reset Key.</p>', 'https://www.facebook.com/profile.php?id=61578683206427', 1, '2022-12-27 16:12:18', '2026-03-03 10:55:24'),
(2, 1, 2, 'Hack Bất Tử', 'hack-bat-tu', 'upload/product/productULF8ME.png', '', NULL, NULL, 1, '2022-12-27 18:52:54', '2022-12-27 18:52:54'),
(3, 3, 1, 'BẢN BEAM-BYPASS_GAMELOOP - PUBG MOBILE GIẢ LẬP', 'ban-beam-bypass_gameloop-pubg-mobile-gia-lap', 'upload/product/product73WGZJ.png', '', '', 'https://www.facebook.com/profile.php?id=61578683206427', 1, '2023-02-06 23:37:00', '2026-03-04 07:54:14'),
(4, 3, 2, 'BẢN BYPASS-VNMOD - PUBG MOBILE GIẢ LẬP', 'ban-bypass-vnmod-pubg-mobile-gia-lap', 'upload/product/productKJA67U.png', '', NULL, NULL, 1, '2023-02-06 23:39:33', '2023-02-06 23:39:33'),
(5, 3, 3, 'BẢN WINDY-BYPASS - PUBG MOBILE GIẢ LẬP', 'ban-windy-bypass-pubg-mobile-gia-lap', 'upload/product/productGR8QUO.png', '', NULL, NULL, 1, '2023-02-06 23:40:11', '2023-02-06 23:40:11'),
(6, 11, 1, 'Play Together', 'play-together', 'upload/product/productEDO59S.png', '', '', '', 0, '2026-03-03 21:53:51', '2026-03-03 22:24:39'),
(7, 11, 2, 'Play Together2', 'play-together2', 'upload/product/product02FK95.png', '', '', '', 0, '2026-03-03 21:57:16', '2026-03-04 05:40:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_history`
--

CREATE TABLE `tbl_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_history`
--

INSERT INTO `tbl_history` (`id`, `user_id`, `product_id`, `price`, `create_date`) VALUES
(1, 1, 6, 55555, '2022-12-24 19:00:47'),
(2, 1, 5, 11020, '2022-12-24 19:01:17'),
(3, 1, 7, 1111, '2022-12-24 19:18:07'),
(4, 1, 7, 1111, '2022-12-25 01:33:42'),
(5, 1, 6, 55555, '2022-12-25 10:48:31'),
(6, 1, 4, 889, '2022-12-25 10:53:09'),
(7, 1, 7, 1111, '2022-12-25 12:04:27'),
(8, 1, 4, 889, '2022-12-25 15:32:43'),
(9, 1, 4, 889, '2022-12-25 15:32:53'),
(10, 1, 6, 55555, '2022-12-25 15:33:03'),
(11, 1, 5, 12244, '2022-12-25 15:33:12'),
(12, 1, 7, 1111, '2023-01-04 11:22:22'),
(13, 1, 7, 1111, '2023-01-04 11:34:17'),
(14, 1, 6, 55555, '2023-01-27 20:57:58'),
(15, 1, 5, 12244, '2023-01-27 20:58:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_history_hack`
--

CREATE TABLE `tbl_history_hack` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `groups_name` text DEFAULT NULL,
  `thoigian` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `license` text DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_history_hack`
--

INSERT INTO `tbl_history_hack` (`id`, `user_id`, `groups_name`, `thoigian`, `price`, `license`, `create_date`, `update_date`) VALUES
(26, 1, 'Hack Map', 6, 13000, 'adghsadshja9823', '2023-02-09 13:43:33', '2023-02-09 13:43:33'),
(27, 1, 'Hack Map', 6, 13000, 'dsajdjsajsan39282', '2023-02-09 13:44:19', '2023-02-09 13:44:19'),
(28, 1, 'Hack Map', 6, 13000, 'dsadjsaidsa039432', '2023-02-13 15:13:16', '2023-02-13 15:13:16'),
(29, 1, 'Hack Map', 24, 2000, 'dhsahd8374372dkjsad', '2023-02-13 15:15:55', '2023-02-13 15:15:55'),
(30, 3, 'BẢN BEAM-BYPASS_GAMELOOP - PUBG MOBILE GIẢ LẬP', 24, 1, '1144', '2026-03-04 07:02:10', '2026-03-04 07:02:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_history_hosting`
--

CREATE TABLE `tbl_history_hosting` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hosting_id` int(11) NOT NULL,
  `domain` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `price` int(11) NOT NULL,
  `user` text DEFAULT NULL,
  `pass` text DEFAULT NULL,
  `create_date` text DEFAULT NULL,
  `exp_date` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_history_hosting`
--

INSERT INTO `tbl_history_hosting` (`id`, `user_id`, `hosting_id`, `domain`, `email`, `price`, `user`, `pass`, `create_date`, `exp_date`, `status`) VALUES
(1, 1, 7, 'hiepsicode.site', 'nhatloc200@gmail.com', 10000, 'aepsicodesite', 'Az9Daily609507249', '1672071598', '1674663598', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_hosting`
--

CREATE TABLE `tbl_hosting` (
  `id` int(11) NOT NULL,
  `stt` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `code` text DEFAULT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `introtext` longtext DEFAULT NULL,
  `link` text DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_hosting`
--

INSERT INTO `tbl_hosting` (`id`, `stt`, `name`, `code`, `price`, `quantity`, `content`, `introtext`, `link`, `create_date`, `update_date`, `status`) VALUES
(1, 2, 'Gói RE2', 're2', 20000, 4, 'Dung lượng: 1000 MB\r\nBăng thông: không giới hạn\r\nMiễn phí chứng chỉ SSL\r\nMiền khác: không giới hạn\r\nMiền bí danh: không giới hạn\r\nCác thông số khác: không giới hạn\r\nVị trí máy chủ: Singapore\r\nBackup: Hằng ngày', NULL, NULL, '2022-12-26 14:39:58', '2022-12-26 14:39:58', 1),
(2, 1, 'Gói RE1', 're1', 10000, 4, 'Dung lượng: 500 MB\r\nBăng thông: không giới hạn\r\nMiễn phí chứng chỉ SSL\r\nMiền khác: 5 tên miền\r\nMiền bí danh: không giới hạn\r\nCác thông số khác: không giới hạn\r\nVị trí máy chủ: Singapore\r\nBackup: Hằng ngày', NULL, NULL, '2022-12-26 14:40:33', '2022-12-26 14:40:33', 1),
(3, 3, 'Gói RE3', 're3', 30000, 10, 'Dung lượng: 1500 MB\r\nBăng thông: không giới hạn\r\nMiễn phí chứng chỉ SSL\r\nMiền khác: không giới hạn\r\nMiền bí danh: không giới hạn\r\nCác thông số khác: không giới hạn\r\nVị trí máy chủ: Singapore\r\nBackup: Hằng ngày', NULL, NULL, '2022-12-26 14:53:28', '2022-12-26 14:53:28', 1),
(4, 4, 'Gói RE4', 're4', 33000, 4, 'Dung lượng: 2500 MB\r\nBăng thông: không giới hạn\r\nMiễn phí chứng chỉ SSL\r\nMiền khác: không giới hạn\r\nMiền bí danh: không giới hạn\r\nCác thông số khác: không giới hạn\r\nVị trí máy chủ: Singapore\r\nBackup: Hằng ngày', NULL, NULL, '2022-12-26 19:52:34', '2022-12-26 19:52:34', 1),
(5, 5, 'Gói RE5', 're5', 35000, 4, 'Dung lượng: 3600 MB\r\nBăng thông: không giới hạn\r\nMiễn phí chứng chỉ SSL\r\nMiền khác: không giới hạn\r\nMiền bí danh: không giới hạn\r\nCác thông số khác: không giới hạn\r\nVị trí máy chủ: Singapore\r\nBackup: Hằng ngày', NULL, NULL, '2022-12-26 19:53:03', '2022-12-26 19:53:03', 1),
(6, 6, 'Gói RE6', 're6', 40000, 4, 'Dung lượng: 5000 MB\r\nBăng thông: không giới hạn\r\nMiễn phí chứng chỉ SSL\r\nMiền khác: không giới hạn\r\nMiền bí danh: không giới hạn\r\nCác thông số khác: không giới hạn\r\nVị trí máy chủ: Singapore\r\nBackup: Hằng ngày', '', 'dsadsa', '2022-12-26 19:53:44', '2023-01-27 18:17:31', 1),
(7, 7, 'Gói AA1', 'aa1', 10000, 5, 'Dung lượng: 1000 MB SSD\r\nBăng thông: không giới hạn\r\nMiễn phí chứng chỉ SSL\r\nMiền khác: 0\r\nMiền bí danh: 0\r\nCác thông số khác: không giới hạn\r\nVị trí máy chủ: singapore\r\nBackup: Không tự động', '<h3 style=\"text-align:center\">Hosting sau khi hết hạn nếu kh&ocirc;ng gia hạn th&igrave; sẽ bị tạm kho&aacute;, sau 3 ng&agrave;y hết hạn nếu bạn kh&ocirc;ng gia hạn th&igrave; sẽ bị xo&aacute; host!<br />\r\nĐể sử dụng host, xin vui l&ograve;ng trỏ t&ecirc;n miền về IP&nbsp;<strong>b&ecirc;n dưới</strong>&nbsp;hoặc nameserver:</h3>\r\n\r\n<h3 style=\"text-align:center\">ns25.dailysieure.com<br />\r\nns26.dailysieure.com<br />\r\n(n&ecirc;n sử dụng nameserver v&igrave; ip c&oacute; thể bị thay đổi n&ecirc;n c&oacute; thể sẽ ảnh hưởng tới web bạn)</h3>\r\n', 'https://vmi1108039.contaboserver.net:2083', '2022-12-26 20:01:20', '2022-12-27 14:22:46', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_license`
--

CREATE TABLE `tbl_license` (
  `id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `license` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_license`
--

INSERT INTO `tbl_license` (`id`, `package_id`, `license`, `status`, `create_date`, `update_date`) VALUES
(50, 7, 'adghsadshja9823', 0, '2023-02-09 13:42:39', '2023-02-09 13:42:48'),
(51, 7, 'dsajdjsajsan39282', 0, '2023-02-09 13:42:39', '2023-02-09 13:42:48'),
(52, 7, 'dsadjsaidsa039432', 0, '2023-02-09 13:42:39', '2023-02-09 13:42:48'),
(53, 7, 'dsadnsjak0232', 1, '2023-02-09 13:42:39', '2023-02-09 13:42:48'),
(54, 7, 'dsajdhsahdsja3284329', 1, '2023-02-09 13:42:39', '2023-02-09 13:42:48'),
(55, 7, 'dsakjds82947328djkan', 1, '2023-02-09 13:42:39', '2023-02-09 13:42:48'),
(56, 7, '329u82njdsandksa832', 1, '2023-02-09 13:42:39', '2023-02-09 13:42:48'),
(57, 7, 'dsakjdsa832923djsankjdas', 1, '2023-02-09 13:42:39', '2023-02-09 13:42:48'),
(58, 7, '32984u328nkdasnjkdsda', 1, '2023-02-09 13:42:39', '2023-02-09 13:42:48'),
(59, 7, '329483299dsajaja32', 1, '2023-02-09 13:42:39', '2023-02-09 13:42:48'),
(60, 7, 'dsaihdusa29329', 1, '2023-02-09 13:42:39', '2023-02-09 13:42:48'),
(61, 8, 'dhsahd8374372dkjsad', 0, '2023-02-13 15:15:32', NULL),
(65, 8, '1', 1, '2026-03-04 06:44:22', '2026-03-04 07:01:13'),
(66, 11, '1144', 0, '2026-03-04 07:02:00', '2026-03-04 07:02:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_logs_orders`
--

CREATE TABLE `tbl_logs_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` text DEFAULT NULL,
  `amount` text DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `device` text DEFAULT NULL,
  `create_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_logs_orders`
--

INSERT INTO `tbl_logs_orders` (`id`, `user_id`, `action`, `amount`, `ip`, `device`, `create_date`) VALUES
(1, 1, 'mua mã nguồn mã số #7', '10000', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2023-01-04 11:22:22'),
(2, 1, 'Mua License hack Hack Map', '5000', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2023-01-04 11:32:44'),
(3, 1, 'Mua License hack Hack Bất Tử', '2000', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2023-01-04 11:33:36'),
(4, 1, 'Mua License hack Hack Map', '13000', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2023-01-04 11:33:46'),
(5, 1, 'Mua License hack Hack Bất Tử', '2000', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2023-01-04 11:33:53'),
(6, 1, 'Mua mã nguồn mã số #7', '1111', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '2023-01-04 11:34:17'),
(7, 1, 'Mua License hack Hack Bất Tử', '2000', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-01-27 18:09:47'),
(8, 1, 'Mua License hack Hack Map', '13000', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-01-27 21:32:26'),
(9, 1, 'Mua License hack Hack Bất Tử', '2000', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-07 15:02:00'),
(10, 1, 'Mua License hack Hack Bất Tử', '3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-09 12:45:59'),
(11, 1, 'Mua License hack Hack Map', '8000', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-09 13:08:16'),
(12, 1, 'Mua License hack Hack Map', '8000', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-09 13:12:18'),
(13, 1, 'Mua License hack Hack Map', '13000', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-09 13:43:33'),
(14, 1, 'Mua License hack Hack Map', '13000', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-09 13:44:19'),
(15, 1, 'Mua License hack Hack Map', '13000', '125.235.233.147', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-13 15:13:16'),
(16, 1, 'Mua License hack Hack Map', '2000', '125.235.233.147', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2023-02-13 15:15:55'),
(17, 3, 'Mua License hack BẢN BEAM-BYPASS_GAMELOOP - PUBG MOBILE GIẢ LẬP', '1', '171.250.164.75, 172.71.152.35', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-03-04 07:02:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id` int(11) NOT NULL,
  `stt` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `noidung` longtext DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `stt`, `name`, `slug`, `noidung`, `status`) VALUES
(1, 1, 'Hướng Dẫn Thuê Key Hack', 'huong-dan-thue-key-hack', 'PGgxPkjGr+G7mk5HIEThuqpOIFRIVSZFY2lyYzsgS0VZPC9oMT4NCg0KPHA+Tmjhu69uZyB0JmFncmF2ZTtpIGtob+G6o24gbOG6p24gxJHhuqd1IHRodSZlY2lyYzsgY+G6p24gxJDEgk5HIEsmWWFjdXRlOyB0JmFncmF2ZTtpIGtob+G6o24gdGh1JmVjaXJjOyBrZXk8L3A+DQoNCjxwPjxzdHJvbmc+LSBIxrDhu5tuZyBE4bqrbiBUaHUmZWNpcmM7IE5oYW5oPC9zdHJvbmc+PC9wPg0KDQo8cD48c3Ryb25nPi0gSMaw4bubbmcgROG6q24gVGh1JmVjaXJjOyBDaGkgVGnhur90PC9zdHJvbmc+PC9wPg0K', 1),
(2, 2, 'Lưu Ý Khi Thuê', 'luu-y-khi-thue', '', 1),
(3, 3, 'Liên Hệ', 'lien-he', 'PHA+PHNwYW4gc3R5bGU9ImZvbnQtc2l6ZToyMHB4Ij48ZW0+PHN0cm9uZz5GYWNlYm9vayA6IFRy4bqnbiBIJmFncmF2ZTtvIERldjwvc3Ryb25nPjwvZW0+PGJyIC8+DQo8c3Ryb25nPjxlbT5aYWxvIDogMDU1OTcwNTkyMjwvZW0+PC9zdHJvbmc+PC9zcGFuPjwvcD4NCg==', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_package_hack`
--

CREATE TABLE `tbl_package_hack` (
  `id` int(11) NOT NULL,
  `groups_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `thoigian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_package_hack`
--

INSERT INTO `tbl_package_hack` (`id`, `groups_id`, `price`, `thoigian`) VALUES
(1, 1, 5000, 1),
(2, 1, 8000, 2),
(3, 1, 13000, 3),
(4, 2, 2000, 1),
(5, 2, 3, 2),
(6, 1, 15000, 4),
(7, 1, 13000, 6),
(8, 1, 5000, 24),
(10, 4, 10000, 24),
(11, 3, 1, 24);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT 0,
  `sale` int(11) DEFAULT 0,
  `images` text DEFAULT NULL,
  `list_images` text DEFAULT NULL,
  `intro` longtext DEFAULT NULL,
  `view` bigint(20) DEFAULT 0,
  `sold` bigint(20) DEFAULT 0,
  `link_down` text DEFAULT NULL,
  `link_demo` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `name`, `slug`, `category`, `price`, `sale`, `images`, `list_images`, `intro`, `view`, `sold`, `link_down`, `link_demo`, `status`, `create_date`, `update_date`) VALUES
(4, 'share code shop bán acc', 'share-code-shop-ban-acc', 1, 1111, 20, 'upload/product/productFNKOZ4MW7T2P.png', 'upload/product/productCAVMUB.png', '', 15, 2, '', '', 1, '2022-12-24 14:42:42', '2022-12-25 10:28:01'),
(5, 'Share code bán hosting', 'share-code-ban-hosting', 2, 12244, 0, 'upload/product/productT5W4ER.png', 'upload/product/productT5W4ER.png', '&lt;p&gt;dsadsa&lt;/p&gt;', 20, 2, '', '', 1, '2022-12-24 14:52:01', '2022-12-25 01:22:35'),
(6, 'share code shop bán acc ff', 'share-code-shop-ban-acc-ff', 1, 55555, 0, 'upload/product/product8V930G.png', 'upload/product/product8V930G.png\r\nupload/product/product8V930G.png\r\nupload/product/product8V930G.png\r\nupload/product/product8V930G.png', '', 25, 2, '', '', 1, '2022-12-24 15:01:32', '2022-12-25 10:28:22'),
(7, 'Shop bán acc game free fire, random, vòng quay, bingo, lật thẻ', 'shop-ban-acc-game-free-fire-random-vong-quay-bingo-lat-the', 1, 1111, 0, 'upload/product/productC9TP325IZ4NQ.png', 'upload/product/product81YS5C.png\r\nupload/product/product81YS5C.png\r\nupload/product/product81YS5C.png\r\nupload/product/product81YS5C.png\r\nupload/product/product81YS5C.png\r\nupload/product/product81YS5C.png\r\nupload/product/product81YS5C.png\r\nupload/product/product81YS5C.png', '<p>Demo chi tiết tại:&nbsp;<a href=\"\\\" target=\"\\&quot;\\\\\\&quot;\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&quot;_blank\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\&quot;\\\\\\&quot;\\&quot;\">https://tool.sieuthicode.net/</a></p>\r\n\r\n<p>t&agrave;i khoản: useradmin</p>\r\n\r\n<p>mật khẩu: 123456</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><em>C&ocirc;ng nghệ:</em></p>\r\n\r\n<p>- HTML5/CSS3&nbsp;<br />\r\n- Boostrap 3<br />\r\n- Datatables<br />\r\n- Lazyload<br />\r\n- PHP/ Mysql</p>\r\n\r\n<p><em>Chức năng:</em></p>\r\n\r\n<p>- Tạo danh mục, nh&atilde;n d&aacute;n, minigame tự động<br />\r\n- B&aacute;n t&agrave;i khoản tự động<br />\r\n- V&ograve;ng quay may mắn</p>\r\n\r\n<p>-Danh mục c&agrave;y thu&ecirc;<br />\r\n- Nạp tiền qua thẻ c&agrave;o, momo<br />\r\n- Cộng t&aacute;c vi&ecirc;n<br />\r\n- Setting website, th&agrave;nh vi&ecirc;n, nh&acirc;n vi&ecirc;n pr, quản l&yacute; tất cả tại admin<br />\r\n- Tối ưu mọi dịch vụ chỉ quảng c&aacute;o shop<br />\r\n- Bọc chống spam đăng k&yacute;, nạp thẻ,...<br />\r\n- Hỗ trợ 24/24.</p>\r\n\r\n<p><em>Điều khoản:</em></p>\r\n\r\n<p>Vui l&ograve;ng KH&Ocirc;NG chia sẻ m&atilde; nguồn, vps, hosting để được bảo h&agrave;nh hỗ trợ trọn đời.</p>\r\n', 63, 3, '', '', 1, '2022-12-24 15:02:22', '2022-12-25 01:32:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `coin` int(11) NOT NULL DEFAULT 0,
  `total_coin` int(11) NOT NULL DEFAULT 0,
  `role` int(11) NOT NULL DEFAULT 0,
  `banned` int(11) NOT NULL DEFAULT 0,
  `ip` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `otp` text DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `email`, `coin`, `total_coin`, `role`, `banned`, `ip`, `token`, `otp`, `create_date`, `update_date`, `last_activity`) VALUES
(2, 'thuidit123456789', '9b7a9d3d2073fc1e960f2da851d2ea3396378138', 'haohaone1029@gmail.com', 1000000, 1000000, 1, 0, '171.250.164.75, 172.68.164.17', 'eb84284311428161a5e5e3ed53a619aa', NULL, '2026-03-03 09:54:48', '2026-03-03 09:54:48', '2026-03-04 08:57:26'),
(3, 'gamemeee', '20541b91a4dcd6bc39299b0858e1f20021e54743', 'legbij@t7xn.capcut11.name.ng', 199999, 200000, 0, 0, '171.250.164.75, 172.71.81.62', '05d197d89355e2450eaa3a7e0719aa4b', NULL, '2026-03-03 11:18:33', '2026-03-03 11:18:33', NULL),
(4, 'gamemeee1', '20541b91a4dcd6bc39299b0858e1f20021e54743', 'huhi61300@gmail.com', 0, 0, 0, 0, '171.250.164.75, 172.71.152.35', '6ce98c78bb9e779b50ab6223af725d21', '145608', '2026-03-03 21:41:02', '2026-03-03 21:41:02', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bank_auto`
--
ALTER TABLE `bank_auto`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `uq_tranId` (`tranId`) USING HASH;

--
-- Chỉ mục cho bảng `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trans_id` (`trans_id`),
  ADD KEY `idx_request_id` (`request_id`),
  ADD KEY `idx_cards_request_id` (`request_id`),
  ADD KEY `idx_cards_user_status` (`user_id`,`status`);

--
-- Chỉ mục cho bảng `dongtien`
--
ALTER TABLE `dongtien`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `tbl_blogs`
--
ALTER TABLE `tbl_blogs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_category_hack`
--
ALTER TABLE `tbl_category_hack`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_groups_hack`
--
ALTER TABLE `tbl_groups_hack`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_history`
--
ALTER TABLE `tbl_history`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_history_hack`
--
ALTER TABLE `tbl_history_hack`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_history_hosting`
--
ALTER TABLE `tbl_history_hosting`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_hosting`
--
ALTER TABLE `tbl_hosting`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_license`
--
ALTER TABLE `tbl_license`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_logs_orders`
--
ALTER TABLE `tbl_logs_orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_package_hack`
--
ALTER TABLE `tbl_package_hack`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_last_activity` (`last_activity`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `bank_auto`
--
ALTER TABLE `bank_auto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT cho bảng `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `dongtien`
--
ALTER TABLE `dongtien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=485;

--
-- AUTO_INCREMENT cho bảng `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=540;

--
-- AUTO_INCREMENT cho bảng `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT cho bảng `tbl_blogs`
--
ALTER TABLE `tbl_blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_category_hack`
--
ALTER TABLE `tbl_category_hack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tbl_groups_hack`
--
ALTER TABLE `tbl_groups_hack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tbl_history_hack`
--
ALTER TABLE `tbl_history_hack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `tbl_history_hosting`
--
ALTER TABLE `tbl_history_hosting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_hosting`
--
ALTER TABLE `tbl_hosting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_license`
--
ALTER TABLE `tbl_license`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT cho bảng `tbl_logs_orders`
--
ALTER TABLE `tbl_logs_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_package_hack`
--
ALTER TABLE `tbl_package_hack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 26, 2020 lúc 07:44 PM
-- Phiên bản máy phục vụ: 10.4.13-MariaDB
-- Phiên bản PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `studentdb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `challengequizz`
--

CREATE TABLE `challengequizz` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `hint` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `challengequizz`
--

INSERT INTO `challengequizz` (`id`, `name`, `created_at`, `hint`) VALUES
(5, 'Chall4', '2020-09-24 20:03:15', 'abc'),
(6, 'Chall1', '2020-09-24 20:08:40', 'Jack');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chat_message`
--

CREATE TABLE `chat_message` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `msg` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status_mes` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `chat_message`
--

INSERT INTO `chat_message` (`id`, `title`, `to_user_id`, `from_user_id`, `msg`, `status_mes`, `created_at`) VALUES
(11, 'Tieu De 2', 19, 1, '                                                                    Noi Dung  \r\n                                                                ', 0, '2020-09-25 22:50:29'),
(15, 'tesst', 1, 21, 'asdasdad                                                                ', 0, '2020-09-26 03:51:29'),
(16, 'test13', 21, 1, '                   ádddd                                             ', 1, '2020-09-26 06:34:09'),
(17, 'tesst', 15, 21, '                                                                    asdasdad      2222                                                                                                                          ', 0, '2020-09-26 10:50:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `download` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `namefile` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `homework`
--

INSERT INTO `homework` (`id`, `subject_name`, `size`, `download`, `created_at`, `namefile`) VALUES
(6, 'Bài 1', 23, 2, '2020-09-25 16:22:29', 'test2.txt'),
(7, 'Bài 12', 23, 0, '2020-09-25 18:40:15', 'test2.txt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `student_id` int(100) NOT NULL,
  `teacher_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `result_data`
--

CREATE TABLE `result_data` (
  `id` int(11) NOT NULL,
  `result_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `marks` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sub_result`
--

CREATE TABLE `sub_result` (
  `id` int(11) NOT NULL,
  `subject_id` int(100) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sub_result`
--

INSERT INTO `sub_result` (`id`, `subject_id`, `name`, `id_user`, `created_at`) VALUES
(8, 6, 'Hoa Hai Duong.txt', 12, '2020-09-25 16:23:17'),
(9, 0, 'test2.txt', 12, '2020-09-25 16:25:07'),
(10, 6, 'test2.txt', 12, '2020-09-25 16:25:15'),
(11, 6, 'test.txt', 12, '2020-09-25 16:25:52'),
(12, 6, 'Hoa Hai Duong.txt', 12, '2020-09-25 16:27:20'),
(13, 6, 'test.txt', 12, '2020-09-25 16:27:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usertype` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `email`, `telephone`, `usertype`, `created_at`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin đẹp trai', 'admin@gmail.com', '0333712623', '1', '2020-09-24 14:10:10'),
(7, 'haoanh', 'ff9ed3a80c65f7fd298142d247ce2124', 'Hào Anh đẹp trai', 'haoanhbadboiz@gmail.com', '1111111111', '2', '2020-09-24 04:30:26'),
(19, 'phigv', '86871b9b1ab33b0834d455c540d82e89', 'Bùi Đức Phi', 'supovipxtb@gmail.com', '0163 371 2623', '2', '2020-09-25 19:34:20'),
(21, 'testsv', 'b56feff478271e82b89bf62314836c40', 'Tesst', 'testsv@gmail.com', '312134131313', '2', '2020-09-26 03:51:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `usertypes`
--

CREATE TABLE `usertypes` (
  `id` int(11) NOT NULL,
  `usertypes` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `usertypes`
--

INSERT INTO `usertypes` (`id`, `usertypes`) VALUES
(1, 'Teacher'),
(2, 'Student');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `challengequizz`
--
ALTER TABLE `challengequizz`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `result_data`
--
ALTER TABLE `result_data`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sub_result`
--
ALTER TABLE `sub_result`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `challengequizz`
--
ALTER TABLE `challengequizz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `result_data`
--
ALTER TABLE `result_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sub_result`
--
ALTER TABLE `sub_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

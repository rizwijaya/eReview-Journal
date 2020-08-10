-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 31, 2020 at 09:31 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ereview`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id_assign` int(11) NOT NULL,
  `id_task` int(11) NOT NULL,
  `id_reviewer` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `file_complete` varchar(500) DEFAULT NULL,
  `tgl_assign` date DEFAULT NULL,
  `tgl_deadline` date DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_assign` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id_assign`, `id_task`, `id_reviewer`, `status`, `file_complete`, `tgl_assign`, `tgl_deadline`, `date_created`, `date_updated`, `sts_assign`) VALUES
(1, 1, 1, 6, 'Data_Science_Revisi.pdf', '2020-05-15', '1970-01-01', '2020-05-14 20:12:25', '2020-05-14 20:12:25', 1),
(2, 2, 1, 6, 'Data_Science_Revisi.pdf', '2020-05-15', '1970-01-01', '2020-05-14 20:17:39', '2020-05-14 20:17:39', 1),
(3, 3, 1, 2, NULL, '2020-05-15', '1970-01-01', '2020-05-14 20:18:35', '2020-05-14 20:18:35', 1),
(8, 7, 1, 3, NULL, '2020-05-16', '2020-05-16', '2020-05-16 00:17:06', '2020-05-16 00:17:06', 1),
(9, 8, 2, 6, 'fisika_dasar_revisi.pdf', '2020-05-16', '1970-01-01', '2020-05-16 06:58:07', '2020-05-16 06:58:07', 1),
(14, 13, 2, 3, NULL, '2020-05-18', '2020-05-18', '2020-05-18 08:05:33', '2020-05-18 08:05:33', 1),
(18, 17, 2, 6, 'Belajar_Codeigniter_Revisi.pdf', '2020-05-19', '1970-01-01', '2020-05-18 20:41:31', '2020-05-18 20:41:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `editor`
--

CREATE TABLE `editor` (
  `id_editor` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_editor` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `editor`
--

INSERT INTO `editor` (`id_editor`, `id_user`, `date_created`, `date_updated`, `sts_editor`) VALUES
(1, 1, '2020-05-12 23:45:17', '2020-05-12 23:45:17', 1),
(2, 2, '2020-05-12 23:45:55', '2020-05-12 23:45:55', 1),
(3, 3, '2020-05-12 23:46:13', '2020-05-12 23:46:13', 1),
(4, 10, '2020-05-13 07:34:44', '2020-05-13 07:34:44', 1),
(6, 12, '2020-05-15 23:05:16', '2020-05-15 23:05:16', 1),
(7, 13, '2020-05-16 07:10:54', '2020-05-16 07:10:54', 1),
(13, 20, '2020-05-18 09:14:45', '2020-05-18 09:14:45', 1),
(14, 21, '2020-05-18 18:36:54', '2020-05-18 18:36:54', 1),
(15, 22, '2020-05-18 19:39:28', '2020-05-18 19:39:28', 1),
(16, 23, '2020-05-18 20:37:54', '2020-05-18 20:37:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE `grup` (
  `id_grup` int(11) NOT NULL,
  `nama_grup` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_grup` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grup`
--

INSERT INTO `grup` (`id_grup`, `nama_grup`, `date_created`, `date_updated`, `sts_grup`) VALUES
(1, 'editor', '2020-03-12 05:56:08', '2020-03-12 05:57:48', 1),
(2, 'reviewer', '2020-03-12 05:56:08', '2020-03-12 05:57:48', 1),
(3, 'makelar', '2020-03-12 05:56:19', '2020-03-12 05:57:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `makelar`
--

CREATE TABLE `makelar` (
  `id_makelar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_makelar` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `makelar`
--

INSERT INTO `makelar` (`id_makelar`, `id_user`, `date_created`, `date_updated`, `sts_makelar`) VALUES
(1, 7, '2020-05-12 23:50:32', NULL, 1),
(2, 8, '2020-05-12 23:52:26', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `id_grup` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `sts_member` tinyint(4) DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `id_grup`, `id_user`, `sts_member`, `date_created`, `date_updated`) VALUES
(1, 1, 1, 1, '2020-05-12 23:45:17', '2020-05-12 23:45:17'),
(2, 1, 2, 1, '2020-05-12 23:45:55', '2020-05-12 23:45:55'),
(3, 1, 3, 1, '2020-05-12 23:46:13', '2020-05-12 23:46:13'),
(4, 2, 4, 1, '2020-05-12 23:47:20', '2020-05-12 23:47:20'),
(5, 2, 5, 1, '2020-05-12 23:48:26', '2020-05-12 23:48:26'),
(6, 2, 6, 1, '2020-05-12 23:49:18', '2020-05-12 23:49:18'),
(7, 3, 7, 1, '2020-05-12 23:50:49', NULL),
(8, 3, 8, 1, '2020-05-12 23:51:58', NULL),
(9, 2, 9, 1, '2020-05-13 07:20:08', '2020-05-13 07:20:08'),
(10, 1, 10, 1, '2020-05-13 07:34:44', '2020-05-13 07:34:44'),
(12, 1, 12, 1, '2020-05-15 23:05:16', '2020-05-15 23:05:16'),
(13, 1, 13, 1, '2020-05-16 07:10:54', '2020-05-16 07:10:54'),
(14, 2, 14, 1, '2020-05-16 07:11:42', '2020-05-16 07:11:42'),
(25, 1, 20, 1, '2020-05-18 09:14:45', '2020-05-18 09:14:45'),
(26, 2, 20, 1, '2020-05-18 09:14:45', '2020-05-18 09:14:45'),
(27, 1, 21, 1, '2020-05-18 18:36:54', '2020-05-18 18:36:54'),
(28, 2, 21, 1, '2020-05-18 18:36:54', '2020-05-18 18:36:54'),
(29, 1, 22, 1, '2020-05-18 19:39:28', '2020-05-18 19:39:28'),
(30, 2, 22, 1, '2020-05-18 19:39:28', '2020-05-18 19:39:28'),
(31, 1, 23, 1, '2020-05-18 20:37:54', '2020-05-18 20:37:54'),
(32, 2, 23, 1, '2020-05-18 20:37:54', '2020-05-18 20:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `amount` float NOT NULL,
  `bukti` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `id_assign` int(4) NOT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_payment` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `amount`, `bukti`, `status`, `id_assign`, `date_created`, `date_updated`, `sts_payment`) VALUES
(1, 170000, '1589487284struk_bni.jpg', 0, 1, '2020-05-14 20:14:44', NULL, 1),
(2, 150000, '1589602734struk_bri.jpg', 0, 2, '2020-05-16 04:18:54', NULL, 1),
(3, 150000, '1589602815struk_bri.jpg', 0, 2, '2020-05-16 04:20:15', NULL, 1),
(4, 140000, '1589603653struk_bni.jpg', 0, 4, '2020-05-16 04:34:13', NULL, 1),
(5, 210000, '1589612523struk_bri.jpg', 0, 9, '2020-05-16 07:02:03', NULL, 1),
(6, 180000, '1589747413struk_bni.jpg', 0, 10, '2020-05-17 20:30:13', NULL, 1),
(7, 300000, '1589787439struk_bni.jpg', 0, 13, '2020-05-18 07:37:19', NULL, 1),
(8, 300000, '1589790059struk_bni.jpg', 0, 15, '2020-05-18 08:20:59', NULL, 1),
(9, 300000, '1589827532struk_bni.jpg', 0, 17, '2020-05-18 18:45:32', NULL, 1),
(10, 300000, '1589834852struk_bni.jpg', 0, 18, '2020-05-18 20:47:32', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `status` int(11) NOT NULL,
  `nama_status` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `sts_progress` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`status`, `nama_status`, `date_created`, `date_updated`, `sts_progress`) VALUES
(1, 'On Requested', '2020-05-09 14:26:02', '2020-05-09 14:26:02', 1),
(2, 'On Progress', '2020-05-10 12:34:08', '2020-05-09 14:35:20', 1),
(3, 'Rejected', '2020-05-10 12:34:16', '2020-05-09 14:35:51', 1),
(4, 'Waiting Payment', '2020-05-09 14:36:15', '2020-05-09 14:36:15', 1),
(5, 'Checking Payment', '2020-05-12 14:59:02', '2020-05-09 14:36:29', 1),
(6, 'Completed', '2020-05-12 15:00:00', '2020-05-12 14:59:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviewer`
--

CREATE TABLE `reviewer` (
  `id_reviewer` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `no_rek` int(11) NOT NULL,
  `kompetensi` text NOT NULL,
  `saldo` int(11) NOT NULL DEFAULT 0,
  `Sts_reviewer` tinyint(4) NOT NULL DEFAULT 1,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviewer`
--

INSERT INTO `reviewer` (`id_reviewer`, `id_user`, `no_rek`, `kompetensi`, `saldo`, `Sts_reviewer`, `date_created`, `date_updated`) VALUES
(1, 4, 392029822, 'Digital Marketing', 2166000, 1, '2020-05-12 23:47:20', '2020-05-12 23:47:20'),
(2, 5, 982239202, 'Technology Information', 100000, 1, '2020-05-12 23:48:26', '2020-05-12 23:48:26'),
(3, 6, 742232463, 'Data Science', 0, 1, '2020-05-12 23:49:18', '2020-05-12 23:49:18'),
(4, 9, 243029822, 'Sains', 0, 1, '2020-05-13 07:20:07', '2020-05-13 07:20:07'),
(5, 14, 2147483647, 'Digital Marketing', 0, 1, '2020-05-16 07:11:41', '2020-05-16 07:11:41'),
(11, 20, 942049432, 'tech, data science, security', 0, 1, '2020-05-18 09:14:45', '2020-05-18 09:14:45'),
(12, 21, 942049432, 'Tech, Data Science, Security', 0, 1, '2020-05-18 18:36:54', '2020-05-18 18:36:54'),
(13, 22, 942049432, 'Data science, security, tech', 0, 1, '2020-05-18 19:39:28', '2020-05-18 19:39:28'),
(14, 23, 2147483647, 'Data science, security, tech', 0, 1, '2020-05-18 20:37:54', '2020-05-18 20:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id_task` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `authors` varchar(300) DEFAULT NULL,
  `keywords` varchar(300) DEFAULT NULL,
  `file_location` varchar(500) DEFAULT NULL,
  `id_editor` int(11) NOT NULL,
  `file_complete` varchar(500) DEFAULT NULL,
  `page` int(11) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_uploaded` timestamp NULL DEFAULT NULL,
  `sts_task` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id_task`, `judul`, `authors`, `keywords`, `file_location`, `id_editor`, `file_complete`, `page`, `price`, `date_created`, `date_uploaded`, `sts_task`) VALUES
(1, 'Data Science', 'Rizqi Wijaya', 'sience, data, task', '1589487139_Data_Science.pdf', 1, NULL, 17, 170000, '2020-05-14 20:12:19', NULL, 0),
(2, 'fisika dasar', 'Andri Martin', 'fisika, task, dasar', '1589487452_Fisika_Dasar.pdf', 1, NULL, 15, 150000, '2020-05-14 20:17:32', NULL, 0),
(3, 'Matematika Dasar', 'Sucipto Airlangga', 'matematika, book', '1589487511_Matematika_2.docx', 1, NULL, 19, 190000, '2020-05-14 20:18:31', NULL, 0),
(4, 'Fisika 2', 'Martina, Rosi', 'fisika, buku, task', '1589586992_Fisika_Dasar.pdf', 1, NULL, 14, 140000, '2020-05-15 23:56:32', NULL, 0),
(7, 'Data', 'darta', 'sience, data, task', '1589588219_Data_Science.pdf', 1, NULL, 16, 160000, '2020-05-16 00:16:59', NULL, 0),
(8, 'Astronomi', 'andri martin', 'astro, fisika', '1589612277_Fisika_Dasar.pdf', 1, NULL, 21, 210000, '2020-05-16 06:57:57', NULL, 0),
(13, 'Data Science', 'Rahmad', 'sience, data, task', '1589789129_Data_Science.pdf', 1, NULL, 12, 120000, '2020-05-18 08:05:29', NULL, 0),
(17, 'Teknologi Website', 'Rizqi Wijaya', 'security, website, tech', '1589834452_Belajar_Codeigniter.pdf', 23, NULL, 30, 300000, '2020-05-18 20:40:52', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(256) NOT NULL,
  `photo` varchar(200) DEFAULT 'default.jpg',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_user` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama`, `email`, `photo`, `date_created`, `date_updated`, `sts_user`) VALUES
(1, 'rizwijaya', '827ccb0eea8a706c4c34a16891f84e7b', 'Rizqi Wijaya', 'editor@editor.com', 'avatar.png', '2020-05-12 23:45:17', NULL, 1),
(2, 'rian', '827ccb0eea8a706c4c34a16891f84e7b', 'rian', 'editor1@editor.com', 'default.jpg', '2020-05-12 23:45:55', NULL, 1),
(3, 'raffi', '827ccb0eea8a706c4c34a16891f84e7b', 'raffi', 'editor@gmail.com', 'default.jpg', '2020-05-12 23:46:13', NULL, 1),
(4, 'andika', '827ccb0eea8a706c4c34a16891f84e7b', 'Andika', 'andika@reviewer.com', 'default.jpg', '2020-05-12 23:47:20', NULL, 1),
(5, 'rosi', '78b22ef213ff9127ff8a8eef0f68f413', 'Rosita', 'rosireviewer@gmail.com', 'google.jpg', '2020-05-12 23:48:26', NULL, 1),
(6, 'reviewer', '827ccb0eea8a706c4c34a16891f84e7b', 'reviewer', 'reviewer@gmail.com', 'default.jpg', '2020-05-12 23:49:18', NULL, 1),
(7, 'makelar', '827ccb0eea8a706c4c34a16891f84e7b', 'Saya Makelar', 'makelar@gmail.com', 'default.jpg', '2020-05-12 23:50:07', NULL, 1),
(8, 'rahma', '827ccb0eea8a706c4c34a16891f84e7b', 'Rahma', 'rahma@makelar.com', 'default.jpg', '2020-05-12 23:51:46', NULL, 1),
(9, 'reviewer04', '827ccb0eea8a706c4c34a16891f84e7b', 'Aku juga Reviewer', 'reviewer@ymail.com', 'default.jpg', '2020-05-13 07:20:06', NULL, 1),
(10, 'editor04', '827ccb0eea8a706c4c34a16891f84e7b', 'saya editor', 'editor042gmail.com', 'default.jpg', '2020-05-13 07:34:44', NULL, 1),
(12, 'raffa', '827ccb0eea8a706c4c34a16891f84e7b', 'raffa', 'raffa@editor.com', 'default.jpg', '2020-05-15 23:05:16', NULL, 1),
(13, 'rian', '827ccb0eea8a706c4c34a16891f84e7b', 'Rian', 'rian@editor.com', 'default.jpg', '2020-05-16 07:10:54', NULL, 1),
(14, 'reviewer3', '827ccb0eea8a706c4c34a16891f84e7b', 'reviewer 3', 'reviewer4@gmail.com', 'default.jpg', '2020-05-16 07:11:41', NULL, 1),
(20, 'rizwijaya03', '827ccb0eea8a706c4c34a16891f84e7b', 'Rizqi Wijaya', 'reviewer2@gmail.com', 'default.jpg', '2020-05-18 09:14:45', NULL, 1),
(21, 'rizwijaya12', '827ccb0eea8a706c4c34a16891f84e7b', 'Rizqi Wijaya', 'rizwijaya04@gmail.com', 'default.jpg', '2020-05-18 18:36:54', NULL, 1),
(22, 'rizwijaya13', '827ccb0eea8a706c4c34a16891f84e7b', 'Rizqi Wijaya', 'rizwijaya13@gmail.com', 'default.jpg', '2020-05-18 19:39:28', NULL, 1),
(23, 'rizwijaya05', '827ccb0eea8a706c4c34a16891f84e7b', 'Rizqi Wijaya', 'rizwijaya05@gmail.com', 'default.jpg', '2020-05-18 20:37:54', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id_assign`);

--
-- Indexes for table `editor`
--
ALTER TABLE `editor`
  ADD PRIMARY KEY (`id_editor`);

--
-- Indexes for table `grup`
--
ALTER TABLE `grup`
  ADD PRIMARY KEY (`id_grup`);

--
-- Indexes for table `makelar`
--
ALTER TABLE `makelar`
  ADD PRIMARY KEY (`id_makelar`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`status`);

--
-- Indexes for table `reviewer`
--
ALTER TABLE `reviewer`
  ADD PRIMARY KEY (`id_reviewer`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id_task`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id_assign` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `editor`
--
ALTER TABLE `editor`
  MODIFY `id_editor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `grup`
--
ALTER TABLE `grup`
  MODIFY `id_grup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `makelar`
--
ALTER TABLE `makelar`
  MODIFY `id_makelar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviewer`
--
ALTER TABLE `reviewer`
  MODIFY `id_reviewer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

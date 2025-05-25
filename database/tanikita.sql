-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2025 at 12:47 PM
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
-- Database: `tanikita`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `HistoryID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `aksi` text DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`HistoryID`, `UserID`, `aksi`, `tanggal`) VALUES
(118, 56, 'menambahkan postingan baru dengan caption \"mantap guys\"', '2025-05-25 11:27:43'),
(119, 56, 'menyukai postingan dari Aliezzar Wijaya pada \"mantap guys\"', '2025-05-25 11:28:28'),
(120, 56, 'menambahkan komentar baru dengan isi \"Mantap bang\"', '2025-05-25 11:32:13'),
(121, 56, 'melaporkan postingan dengan alasan \"konten_tidak_pantas\"', '2025-05-25 12:12:39'),
(122, 56, 'melaporkan postingan dengan alasan \"konten tidak pantas\"', '2025-05-25 12:12:45'),
(123, 56, 'melaporkan postingan dengan alasan \"\"', '2025-05-25 12:19:50'),
(124, 56, 'melaporkan postingan dengan alasan \"asdasdasdasdasdasd\"', '2025-05-25 12:26:49'),
(125, 56, 'melaporkan postingan dengan alasan \"AOWDAKWDPAKWDPOAKDOPKAWOPKDPO\"', '2025-05-25 12:27:17'),
(126, 56, 'Postingan anda dengan caption \"mantap guys\" telah dihapus oleh admin', '2025-05-25 12:27:28'),
(127, 56, 'menambahkan postingan baru dengan caption \"mantap guys\"', '2025-05-25 12:28:02'),
(128, 56, 'melaporkan postingan dengan alasan \"\"', '2025-05-25 12:28:07'),
(129, 56, 'melaporkan postingan dengan alasan \"\"', '2025-05-25 12:30:59'),
(130, 56, 'melaporkan postingan dengan alasan \"\"', '2025-05-25 12:40:14'),
(131, 56, 'melaporkan postingan dengan alasan \"\"', '2025-05-25 12:40:31'),
(132, 56, 'melaporkan postingan dengan alasan \"Konten tidak pantas\"', '2025-05-25 12:42:29'),
(133, 56, 'Menghapus postingan \"mantap guys\"', '2025-05-25 13:10:04'),
(134, 56, 'menambahkan postingan baru dengan caption \"aku suka kamuasd\"', '2025-05-25 13:10:39'),
(135, 56, 'melaporkan postingan dengan alasan \"Pelanggaran hak cipta\"', '2025-05-25 13:11:04'),
(136, 56, 'Postingan anda dengan caption \"aku suka kamuasd\" telah dihapus oleh admin', '2025-05-25 13:11:09'),
(137, 56, 'menambahkan postingan baru dengan caption \"Horeee lihat nih gw anjing\"', '2025-05-25 15:46:00'),
(138, 56, 'melaporkan postingan dengan alasan \"Pelanggaran hak cipta\"', '2025-05-25 15:46:13'),
(139, 56, 'menambahkan postingan baru dengan caption \"Selamat hari sandi dunia\"', '2025-05-25 16:10:09'),
(140, 56, 'melaporkan postingan dengan alasan \"Lainnya\"', '2025-05-25 16:10:18'),
(141, 56, 'Postingan anda dengan caption \"Selamat hari sandi dunia\" telah dihapus oleh admin', '2025-05-25 16:10:38'),
(142, 56, 'menambahkan postingan baru dengan caption \"aku suka kamu\"', '2025-05-25 16:11:26'),
(143, 56, 'melaporkan postingan dengan alasan \"Pelanggaran hak cipta\"', '2025-05-25 16:11:32'),
(144, 56, 'Postingan anda dengan caption \"aku suka kamu\" telah dihapus oleh admin', '2025-05-25 16:14:36'),
(145, 56, 'menambahkan postingan baru dengan caption \"asd\"', '2025-05-25 16:14:56'),
(146, 56, 'melaporkan postingan dengan alasan \"Konten tidak pantas\"', '2025-05-25 16:15:00'),
(147, 56, 'Postingan anda dengan caption \"asd\" telah dihapus oleh admin', '2025-05-25 16:15:11'),
(148, 56, 'menambahkan postingan baru dengan caption \"Selamat hari sandi dunia\"', '2025-05-25 16:16:44'),
(149, 56, 'melaporkan postingan dengan alasan \"Pelanggaran hak cipta\"', '2025-05-25 16:16:55'),
(150, 56, 'Postingan anda dengan caption \"Selamat hari sandi dunia\" telah dihapus oleh admin', '2025-05-25 16:17:03'),
(151, 56, 'menambahkan postingan baru dengan caption \"aku suka kamu\"', '2025-05-25 16:17:59'),
(152, 56, 'melaporkan postingan dengan alasan \"Penipuan\"', '2025-05-25 16:18:04'),
(153, 56, 'Postingan anda dengan caption \"aku suka kamu\" telah dihapus oleh admin', '2025-05-25 16:43:21'),
(154, 56, 'menambahkan postingan baru dengan caption \"Selamat hari sandi dunia\"', '2025-05-25 16:44:18'),
(155, 56, 'Menghapus postingan \"Selamat hari sandi dunia\"', '2025-05-25 16:44:30'),
(156, 56, 'menambahkan postingan baru dengan caption \"asdasasdasdas\"', '2025-05-25 16:46:03'),
(157, 56, 'melaporkan postingan dengan alasan \"Pelanggaran hak cipta\"', '2025-05-25 16:46:27'),
(158, 56, 'Postingan anda dengan caption \"asdasasdasdas\" telah dihapus oleh admin', '2025-05-25 16:46:56'),
(159, 56, 'menambahkan postingan baru dengan caption \"mantap\"', '2025-05-25 16:55:12'),
(160, 56, 'Menghapus postingan \"mantap\"', '2025-05-25 16:55:15'),
(161, 56, 'menambahkan postingan baru dengan caption \"asdpaskoapdks\"', '2025-05-25 16:56:30'),
(162, 56, 'menambahkan postingan baru dengan caption \"asd\"', '2025-05-25 16:57:20'),
(163, 56, 'melaporkan postingan dengan alasan \"Pelanggaran hak cipta\"', '2025-05-25 16:57:26'),
(164, 56, 'Postingan anda dengan caption \"asd\" telah dihapus oleh admin', '2025-05-25 16:57:36'),
(165, 56, 'menambahkan postingan baru dengan caption \"asdasd\"', '2025-05-25 16:58:04'),
(166, 56, 'melaporkan postingan dengan alasan \"Kekerasan\"', '2025-05-25 16:58:15'),
(167, 56, 'menambahkan postingan baru dengan caption \"asdasdasd\"', '2025-05-25 17:02:04'),
(168, 56, 'melaporkan postingan dengan alasan \"Penipuan\"', '2025-05-25 17:02:34'),
(169, 56, 'menambahkan postingan baru dengan caption \"q09wekqpwe\"', '2025-05-25 17:05:37'),
(170, 56, 'melaporkan postingan dengan alasan \"Spam\"', '2025-05-25 17:05:49'),
(171, 56, 'Postingan anda dengan caption \"q09wekqpwe\" telah dihapus oleh admin', '2025-05-25 17:06:12'),
(172, 56, 'Menghapus postingan \"q09wekqpwe\"', '2025-05-25 17:06:29'),
(173, 56, 'menambahkan postingan baru dengan caption \"Selamat hari sandi dunia\"', '2025-05-25 17:13:24'),
(174, 56, 'melaporkan postingan dengan alasan \"Konten tidak pantas\"', '2025-05-25 17:13:39'),
(175, 56, 'melaporkan postingan dengan alasan \"Kekerasan\"', '2025-05-25 17:17:21'),
(176, 56, 'Menghapus postingan \"Selamat hari sandi dunia\"', '2025-05-25 17:22:35'),
(177, 56, 'menambahkan postingan baru dengan caption \"asdasdasdasd\"', '2025-05-25 17:28:35'),
(178, 56, 'menambahkan postingan baru dengan caption \"asda\"', '2025-05-25 17:29:05'),
(179, 56, 'melaporkan postingan dengan alasan \"Pelanggaran hak cipta\"', '2025-05-25 17:29:15'),
(180, 56, 'Postingan anda dengan caption \"asda\" telah dihapus oleh admin', '2025-05-25 17:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `KomentarID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `isi_komentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pelanggaran_postingan`
--

CREATE TABLE `laporan_pelanggaran_postingan` (
  `LaporanID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `UserID_pelapor` int(11) NOT NULL,
  `UserID_uploader` int(11) NOT NULL,
  `isi_laporan` text NOT NULL,
  `tanggal_waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `PostID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `post_name` varchar(100) DEFAULT NULL,
  `image` tinytext DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suka`
--

CREATE TABLE `suka` (
  `id` int(11) NOT NULL,
  `PostID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `profile_picture` varchar(1024) DEFAULT 'default.png',
  `jenis_kelamin` varchar(16) DEFAULT NULL,
  `role` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `username`, `password`, `email`, `profile_picture`, `jenis_kelamin`, `role`, `created_at`) VALUES
(1, 'admin', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'admin@123', '6832d9c49a503.png', 'Laki-laki', 1, '2025-02-21 13:48:22'),
(55, 'orang', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '123@123', 'default.png', NULL, 0, '2025-05-19 21:43:37'),
(56, 'Aliezzar Wijaya', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'aliezzar42@gmail.com', 'default.png', 'Laki-laki', 0, '2025-05-19 21:46:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`HistoryID`),
  ADD KEY `UserID` (`UserID`) USING BTREE;

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`KomentarID`),
  ADD KEY `FK_PostID_komentar` (`PostID`) USING BTREE,
  ADD KEY `FK_UserID-komentar` (`UserID`);

--
-- Indexes for table `laporan_pelanggaran_postingan`
--
ALTER TABLE `laporan_pelanggaran_postingan`
  ADD PRIMARY KEY (`LaporanID`),
  ADD KEY `FK_PostID_laporan` (`PostID`),
  ADD KEY `FK_UserID_pelapor_laporan` (`UserID_pelapor`),
  ADD KEY `FK_UserID_uploader_laporan` (`UserID_uploader`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`PostID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `suka`
--
ALTER TABLE `suka`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_UserID` (`UserID`),
  ADD KEY `FK_PostID` (`PostID`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `HistoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `KomentarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `laporan_pelanggaran_postingan`
--
ALTER TABLE `laporan_pelanggaran_postingan`
  MODIFY `LaporanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `suka`
--
ALTER TABLE `suka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `FK_PostID_komentar` FOREIGN KEY (`PostID`) REFERENCES `post` (`PostID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserID-komentar` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `laporan_pelanggaran_postingan`
--
ALTER TABLE `laporan_pelanggaran_postingan`
  ADD CONSTRAINT `FK_PostID_laporan` FOREIGN KEY (`PostID`) REFERENCES `post` (`PostID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserID_pelapor_laporan` FOREIGN KEY (`UserID_pelapor`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserID_uploader_laporan` FOREIGN KEY (`UserID_uploader`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_user_product` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suka`
--
ALTER TABLE `suka`
  ADD CONSTRAINT `FK_PostID` FOREIGN KEY (`PostID`) REFERENCES `post` (`PostID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

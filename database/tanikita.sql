-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 18 Bulan Mei 2025 pada 06.29
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `history`
--

CREATE TABLE `history` (
  `HistoryID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `aksi` text DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `history`
--

INSERT INTO `history` (`HistoryID`, `UserID`, `aksi`, `tanggal`) VALUES
(1, 28, 'menambahkan postingan baru dengan caption \"aku suka kamu\"', '2025-05-01 16:12:43'),
(2, 28, 'menambahkan postingan baru dengan caption \"asdasdasdasd\"', '2025-05-01 16:14:14'),
(3, 28, 'Menghapus postingan \"aku suka kamu\"', '2025-05-01 18:09:23'),
(4, 28, 'menambahkan postingan baru dengan caption \"Selamat hari sandi dunia\"', '2025-05-01 23:34:53'),
(5, 28, 'Menghapus postingan \"asdasdasdasd\"', '2025-05-02 12:49:23'),
(6, 28, 'menambahkan postingan baru dengan caption \"Ini python\"', '2025-05-02 14:13:11'),
(7, 28, 'Menghapus postingan \"Ini python\"', '2025-05-03 23:07:25'),
(8, 28, 'Anda mengedit komentar woeeaanjayyyasasd menjadi woeeaanjayyyasasd ', '2025-05-18 07:46:30'),
(9, 28, 'Anda menghapus komentar ', '2025-05-18 07:48:04'),
(10, 28, 'Anda mengedit komentar hallooo menjadi halloooanjayyyy\n ', '2025-05-18 07:53:15'),
(11, 28, 'Anda menghapus komentar halloooanjayyyy\n', '2025-05-18 07:58:12'),
(12, 28, 'menambahkan komentar baru dengan isi \"anjayyyy\"', '2025-05-18 08:00:23'),
(13, 28, 'menyukai postingan dari Aliezzar._pada Selamat hari sandi dunia', '2025-05-18 08:11:12'),
(14, 28, 'Menghapus postingan \"Selamat hari sandi dunia\"', '2025-05-18 08:35:40'),
(15, 28, 'menambahkan komentar baru dengan isi \"halo bang\"', '2025-05-18 08:42:58'),
(16, 28, 'Anda mengedit komentar halo bang menjadi bagus banget gambar pythonnya\n ', '2025-05-18 08:43:13'),
(17, 28, 'menambahkan postingan baru dengan caption \"asd\"', '2025-05-18 08:44:50'),
(18, 28, 'Menghapus postingan \"asd\"', '2025-05-18 08:49:28'),
(19, 28, 'menambahkan postingan baru dengan caption \"mantep aku suka iniiii\"', '2025-05-18 09:44:15'),
(20, 28, 'menyukai postingan dari Aliezzar._ pada \"mantep aku suka iniiii\"', '2025-05-18 09:44:25'),
(21, 28, 'menyukai postingan dari admin pada \"Sayuran apalah ini\"', '2025-05-18 10:21:45'),
(22, 28, 'menyukai postingan dari admin pada \"Sayuran apalah ini\"', '2025-05-18 10:21:46'),
(23, 28, 'menyukai postingan dari admin pada \"Sayuran apalah ini\"', '2025-05-18 10:21:47'),
(24, 28, 'menyukai postingan dari admin pada \"Sayuran apalah ini\"', '2025-05-18 10:21:48'),
(25, 28, 'menyukai postingan dari admin pada \"Sayuran apalah ini\"', '2025-05-18 10:21:48'),
(26, 28, 'menyukai postingan dari admin pada \"Sayuran apalah ini\"', '2025-05-18 10:21:49'),
(27, 28, 'menyukai postingan dari admin pada \"Sayuran apalah ini\"', '2025-05-18 10:21:57'),
(28, 28, 'menyukai postingan dari admin pada \"Sayuran apalah ini\"', '2025-05-18 10:21:57'),
(29, 28, 'menyukai postingan dari admin pada \"Sayuran apalah ini\"', '2025-05-18 10:21:58'),
(30, 28, 'menyukai postingan dari admin pada \"Sayuran apalah ini\"', '2025-05-18 10:21:59'),
(31, 28, 'menyukai postingan dari admin pada \"Sayuran apalah ini\"', '2025-05-18 10:25:13'),
(32, 28, 'menyukai postingan dari admin pada \"Sayuran apalah ini\"', '2025-05-18 10:25:14'),
(33, 28, 'menyukai postingan dari admin pada \"Sayuran apalah ini\"', '2025-05-18 10:25:16'),
(34, 28, 'menyukai postingan dari admin pada \"Sayuran apalah ini\"', '2025-05-18 10:25:17'),
(35, 28, 'menambahkan postingan baru dengan caption \"Selamat hari sandi dunia\"', '2025-05-18 11:11:39'),
(36, 28, 'Menghapus postingan \"Selamat hari sandi dunia\"', '2025-05-18 11:11:58'),
(37, 28, 'Menghapus postingan \"mantep aku suka iniiii\"', '2025-05-18 11:12:07'),
(38, 1, 'Menghapus postingan \"Sayuran apalah ini\"', '2025-05-18 11:12:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
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
-- Struktur dari tabel `post`
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
-- Struktur dari tabel `suka`
--

CREATE TABLE `suka` (
  `id` int(11) NOT NULL,
  `PostID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`UserID`, `username`, `password`, `email`, `profile_picture`, `jenis_kelamin`, `role`, `created_at`) VALUES
(1, 'admin', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'admin@123', '682961f0a6921.png', 'Laki-laki', 1, '2025-02-21 13:48:22'),
(28, 'Aliezzar._', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'aliezzar42@gmail.com', '68163d09a0556.png', 'Laki-laki', 0, '2025-03-31 09:55:22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`HistoryID`),
  ADD KEY `UserID` (`UserID`) USING BTREE;

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`KomentarID`),
  ADD KEY `FK_UserID-komentar` (`UserID`),
  ADD KEY `FK_PostID_komentar` (`PostID`) USING BTREE;

--
-- Indeks untuk tabel `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`PostID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indeks untuk tabel `suka`
--
ALTER TABLE `suka`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_UserID` (`UserID`),
  ADD KEY `FK_PostID` (`PostID`) USING BTREE;

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `history`
--
ALTER TABLE `history`
  MODIFY `HistoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `KomentarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT untuk tabel `post`
--
ALTER TABLE `post`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `suka`
--
ALTER TABLE `suka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Ketidakleluasaan untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `FK_PostID_komentar` FOREIGN KEY (`PostID`) REFERENCES `post` (`PostID`),
  ADD CONSTRAINT `FK_UserID-komentar` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Ketidakleluasaan untuk tabel `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_user_product` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `suka`
--
ALTER TABLE `suka`
  ADD CONSTRAINT `FK_PostID` FOREIGN KEY (`PostID`) REFERENCES `post` (`PostID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

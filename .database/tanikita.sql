-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jun 2025 pada 01.03
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
(207, 3, 'menambahkan postingan baru dengan caption \"I love petani digital\"', '2025-06-03 11:13:38'),
(208, 4, 'melaporkan postingan dengan alasan \"Pelanggaran hak cipta\"', '2025-06-03 12:08:58'),
(209, 3, 'Menghapus postingan \"I love petani digital\"', '2025-06-09 04:48:40');

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
-- Struktur dari tabel `laporan_pelanggaran_postingan`
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
(1, 'admin', '$2y$10$Lkl7y7TDSQ9t0HpTXXpPnOxqMpgL2NZj5EeXU0joElmHB1nnp/nG2', NULL, 'default.png', 'Laki-laki', 1, '2025-06-01 02:02:33'),
(3, 'Aliezzar Wijaya', '$2y$10$F7rjp8ZWQdaDe9Xf6uZdv.Lfd4VtYA/pjDWa1AU9ZzgDenoJcSntS', 'aliezzar42@gmail.com', 'default.png', 'Laki-laki', 0, '2025-06-02 17:01:19'),
(4, 'anjay', '$2y$10$mULMJUd85t8G1FBXbb1lyuEsU0SI5Ek9EyRGmZp0mxG7MelYaRjRm', 'aliezzar_wijaya_ts7_24@gmail.com', 'default.png', 'Laki-laki', 0, '2025-06-03 11:18:52');

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
  ADD KEY `FK_PostID_komentar` (`PostID`) USING BTREE,
  ADD KEY `FK_UserID-komentar` (`UserID`);

--
-- Indeks untuk tabel `laporan_pelanggaran_postingan`
--
ALTER TABLE `laporan_pelanggaran_postingan`
  ADD PRIMARY KEY (`LaporanID`),
  ADD KEY `FK_PostID_laporan` (`PostID`),
  ADD KEY `FK_UserID_pelapor_laporan` (`UserID_pelapor`),
  ADD KEY `FK_UserID_uploader_laporan` (`UserID_uploader`);

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
  MODIFY `HistoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `KomentarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT untuk tabel `laporan_pelanggaran_postingan`
--
ALTER TABLE `laporan_pelanggaran_postingan`
  MODIFY `LaporanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `post`
--
ALTER TABLE `post`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT untuk tabel `suka`
--
ALTER TABLE `suka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `FK_PostID_komentar` FOREIGN KEY (`PostID`) REFERENCES `post` (`PostID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserID-komentar` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laporan_pelanggaran_postingan`
--
ALTER TABLE `laporan_pelanggaran_postingan`
  ADD CONSTRAINT `FK_PostID_laporan` FOREIGN KEY (`PostID`) REFERENCES `post` (`PostID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserID_pelapor_laporan` FOREIGN KEY (`UserID_pelapor`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserID_uploader_laporan` FOREIGN KEY (`UserID_uploader`) REFERENCES `users` (`UserID`);

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

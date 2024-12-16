-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2024 pada 12.19
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
-- Database: `db_mailing`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `page` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `access` varchar(100) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `is_active` enum('YES','NO') NOT NULL,
  `input_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `input_by` varchar(50) NOT NULL DEFAULT 'System'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `name`, `page`, `icon`, `access`, `sort`, `is_active`, `input_at`, `input_by`) VALUES
(1, 'Dashboard', 'dashboard.php', 'ri-home-5-line', '[\"owner\",\"admin\"]', 1, 'YES', '2024-12-05 03:31:37', 'System'),
(2, 'Surat Masuk', 'mail_in.php', 'ri-mail-download-line', '[\"owner\",\"admin\",\"warga\"]', 2, 'YES', '2024-12-05 03:32:58', 'System'),
(3, 'Surat Keluar', 'mail_out.php', 'ri-mail-send-line', '[\"owner\",\"admin\",\"warga\"]', 3, 'YES', '2024-12-05 03:34:09', 'System'),
(4, 'Profil', 'profile.php', 'ri-user-3-line', '[\"owner\",\"admin\",\"warga\"]', 5, 'YES', '2024-12-05 03:37:13', 'System'),
(5, 'Users', 'users.php', 'ri-group-line', '[\"owner\"]', 4, 'YES', '2024-12-05 03:37:04', 'System');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `role` enum('owner','admin','warga') NOT NULL DEFAULT 'warga',
  `is_verified` enum('NO','YES') NOT NULL DEFAULT 'NO',
  `otp` varchar(4) DEFAULT NULL,
  `otp_time` timestamp NULL DEFAULT NULL,
  `input_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `input_by` varchar(50) NOT NULL DEFAULT 'System'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `code`, `password`, `photo`, `full_name`, `contact`, `role`, `is_verified`, `otp`, `otp_time`, `input_at`, `input_by`) VALUES
(2, '123456789', '$2y$10$0eNmAP8mKegyaB31gq.eoe8/AjGwMMiUEbOn9ZfAhJ75wFn7jaAn.', NULL, 'Aldito Fayyadh', '6287789393875', 'owner', 'YES', NULL, NULL, '2024-12-16 11:14:03', 'System');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `contact` (`contact`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

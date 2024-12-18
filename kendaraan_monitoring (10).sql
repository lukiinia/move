-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Des 2024 pada 06.47
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
-- Database: `kendaraan_monitoring`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `approvals`
--

CREATE TABLE `approvals` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `approver_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `driver_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approver1_status` enum('pending','approved','rejected') DEFAULT 'pending',
  `approver2_status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bookings`
--

INSERT INTO `bookings` (`id`, `vehicle_id`, `customer_name`, `booking_date`, `driver_id`, `start_date`, `end_date`, `status`, `created_at`, `approver1_status`, `approver2_status`) VALUES
(2, 1, 'tania', '2000-04-22 17:00:00', 1, '2024-12-18 19:09:14', '2024-12-19 19:09:14', 'pending', '2024-12-17 18:09:14', 'approved', 'rejected'),
(3, 1, 'tania', '2000-02-09 17:00:00', 1, '2024-12-18 23:45:54', '2024-12-19 23:45:54', 'rejected', '2024-12-17 22:45:54', '', ''),
(5, 2, 'Hendri kusuma', '2000-02-19 17:00:00', 1, '2024-12-18 23:59:15', '2024-12-19 23:59:15', 'pending', '2024-12-17 22:59:15', '', ''),
(6, 1, 'Yura', '2000-02-09 17:00:00', 2, '2024-12-19 02:24:37', '2024-12-20 02:24:37', 'approved', '2024-12-18 01:24:37', 'approved', 'approved'),
(7, 1, 'Jingger', '2000-10-19 17:00:00', 2, '2024-12-19 02:41:22', '2024-12-20 02:41:22', 'approved', '2024-12-18 01:41:22', 'approved', 'approved'),
(8, 1, 'yulianto', '2000-02-09 17:00:00', 1, '2024-12-19 03:09:38', '2024-12-20 03:09:38', 'approved', '2024-12-18 02:09:38', 'approved', 'approved'),
(9, 3, 'Yuliani', '2000-02-09 17:00:00', 1, '2024-12-19 03:28:11', '2024-12-20 03:28:11', 'approved', '2024-12-18 02:28:11', 'approved', 'approved'),
(10, 1, 'Nia kurnia ', '2000-02-09 17:00:00', 1, '2024-12-19 03:56:53', '2024-12-20 03:56:53', 'approved', '2024-12-18 02:56:53', 'approved', 'approved');

-- --------------------------------------------------------

--
-- Struktur dari tabel `driver`
--

CREATE TABLE `driver` (
  `id_driver` int(11) NOT NULL,
  `nama_driver` varchar(100) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `status` enum('Aktif','Nonaktif') DEFAULT 'Aktif',
  `tanggal_bergabung` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `driver`
--

INSERT INTO `driver` (`id_driver`, `nama_driver`, `no_telepon`, `status`, `tanggal_bergabung`) VALUES
(1, 'sucipto', '00008932', 'Aktif', '2024-12-17'),
(2, 'Purwano', '00092919919921', 'Aktif', '2024-12-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_activity`
--

CREATE TABLE `log_activity` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','approver') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approver_level` enum('approver1','approver2') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `approver_level`) VALUES
(1, 'admin', '$2y$10$ZWeeV7C47Ct/qjbTUjJJoe9ynUkVsI9eeQ4itGyiLtR524MnSG59y', 'admin', '2024-12-16 10:48:38', NULL),
(2, 'approver1', '$2y$10$zaEPvcjcFVvDFHebX4hvWeBUb5MNQQji/R4WoMxS7AmGnS6EdHrsC', 'approver', '2024-12-16 10:48:38', 'approver1'),
(3, 'approver2', '$2y$10$AUpUGN4MpDBzGx3iqcO7h.oDqErSdZFA9pX7z.RKaCNNqWqSqCRTi', 'approver', '2024-12-16 10:48:38', 'approver2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `license_plate` varchar(20) DEFAULT NULL,
  `type` enum('angkut_barang','angkut_orang') NOT NULL,
  `status` enum('tersedia','digunakan','maintenance') DEFAULT 'tersedia',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `foto` varchar(255) DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `vehicles`
--

INSERT INTO `vehicles` (`id`, `name`, `license_plate`, `type`, `status`, `created_at`, `foto`, `last_used_at`) VALUES
(1, 'Truk box', 'N 122557', 'angkut_orang', 'digunakan', '2024-12-17 12:18:18', 'trek.jpg', NULL),
(2, 'Truk hino', 'S 2000 NN', 'angkut_orang', 'tersedia', '2024-12-17 22:46:56', 'trukkk.jpeg', NULL),
(3, 'Truk tambang', 'N 2246 EJ', 'angkut_barang', 'tersedia', '2024-12-18 02:27:24', 'trukk.jpg', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `approver_id` (`approver_id`);

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `idx_booking_status` (`status`),
  ADD KEY `fk_driver` (`driver_id`),
  ADD KEY `idx_start_date` (`start_date`);

--
-- Indeks untuk tabel `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id_driver`);

--
-- Indeks untuk tabel `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `license_plate` (`license_plate`),
  ADD KEY `idx_vehicle_status` (`status`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `approvals`
--
ALTER TABLE `approvals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `driver`
--
ALTER TABLE `driver`
  MODIFY `id_driver` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `approvals`
--
ALTER TABLE `approvals`
  ADD CONSTRAINT `approvals_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `approvals_ibfk_2` FOREIGN KEY (`approver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`id_driver`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_driver` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`id_driver`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_activity`
--
ALTER TABLE `log_activity`
  ADD CONSTRAINT `log_activity_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

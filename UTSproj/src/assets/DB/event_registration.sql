-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 21 Okt 2024 pada 06.31
-- Versi server: 8.0.39
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_registration`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `events`
--

CREATE TABLE `events` (
  `id_events` int NOT NULL,
  `event_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_time` datetime NOT NULL,
  `max_capacity` int NOT NULL,
  `location` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `id_events` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `email`, `username`, `password`, `role`, `id_events`) VALUES
(1, 'morenopradita013@gmail.com', 'Moreno Pradita', '$2y$10$4ShOepyy8VfDtKvlCA59vecTRN.ZQNL0ScIBjo7.zNYji79obiXNS', 'user', NULL),
(2, 'admin@example.com', 'admin', '$2y$10$oV1xY7SBOUUgYxFIus6yL.EAl41qp2hiIMiYkJyam9pB6KaygsAMG', 'admin', NULL),
(4, 'masteedarkflame@gmail.com', 'Ponyo', '$2y$10$eJGwRXV6v0H/clPLslUV/uEbL4k7V9zGDMkC9xV9kg3vuxjfzU1FG', 'user', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_events`),
  ADD UNIQUE KEY `created_at` (`created_at`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_events` (`id_events`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `events`
--
ALTER TABLE `events`
  MODIFY `id_events` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_events`) REFERENCES `events` (`id_events`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
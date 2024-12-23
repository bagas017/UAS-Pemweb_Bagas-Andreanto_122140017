-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Waktu pembuatan: 23 Des 2024 pada 12.19
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
-- Database: `f1_academy`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `race_registration`
--

CREATE TABLE `race_registration` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `class` enum('F1','F2','F3','F4') NOT NULL,
  `car_type` varchar(50) NOT NULL,
  `circuit` varchar(100) NOT NULL,
  `race_date` date NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `race_registration`
--

INSERT INTO `race_registration` (`id`, `user_id`, `name`, `country`, `class`, `car_type`, `circuit`, `race_date`, `age`) VALUES
(34, 14, 'admin', 'Indonesia', 'F1', 'Ferrari F2002 2002', 'Sirkuit Mont-Tremblant', '2024-02-15', 25),
(35, 15, 'bagas', 'Indonesia', 'F4', 'Mercedes F1 W05 Hybrid 2014', 'Mosport International Raceway', '2024-05-05', 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `ip_address`, `browser`, `password`) VALUES
(14, 'admin', 'admin@f1.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '$2y$10$eWQWbYxTzVxxTYvgOv/TUuHSnGqx0dG0UD1/QdQ5hwUIwBfpChXae'),
(15, 'bagas', 'antokanakpintar@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '$2y$10$pVezlsjyL0ZIeb1uxi.sauTSo2jfiYyFD2RI0H1hU1.gyIdSD7iMK'),
(16, 'jaki', 'jaki@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '$2y$10$BRBEJvlJDsGp4VsOdsdS7.exNlTErx8f80XeqPo794nNv4AvPW6Wa'),
(17, 'alim', 'alim@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '$2y$10$gI8l9ZhAccUB098wkz0tIuwkVLSDjmb2461CykCadzxDh6nRH4yIO'),
(18, 'andre', 'andreantobagas43@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '$2y$10$WheLzjxJAS9vqcfV8wRgNekSLL6eydsk4ttGUGMMN40hwjI4YuCXS'),
(19, 'bagasandre', 'bagasandreanto73@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '$2y$10$bXeX6xx5XuKNqj6/siY3dec4QmXW8nQ.QYhGmTT//WZodTUQOajd6');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `race_registration`
--
ALTER TABLE `race_registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `race_registration`
--
ALTER TABLE `race_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `race_registration`
--
ALTER TABLE `race_registration`
  ADD CONSTRAINT `race_registration_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

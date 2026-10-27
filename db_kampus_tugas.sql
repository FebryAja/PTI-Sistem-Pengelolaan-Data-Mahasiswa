-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 27, 2026 at 03:22 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kampus_tugas`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int NOT NULL,
  `nim` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `angkatan` year NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `email`, `jurusan`, `angkatan`) VALUES
(2, '10123002', 'Sari Roti', 'sari@email.com', 'Sistem Informasi', '2024'),
(3, '111222333', 'Ujang Spakbor', 'ujang@email.com', 'Teknik Mesin', '2020'),
(4, '11125262', 'Mamat Kesandung', 'mamat@email.com', 'Akutansi', '2021'),
(5, '10123003', 'Rizky Pratama', 'rizky.pratama@gmail.com', 'Teknik Informatika', '2022'),
(6, '10123004', 'Anisa Rahmawati', 'anisa.rahma@yahoo.com', 'Sistem Informasi', '2023'),
(7, '10123005', 'Fajar Ramadhan', 'fajar.ramadhan@gmail.com', 'Teknik Komputer', '2021'),
(8, '10123006', 'Siti Nurhaliza', 'siti.nur@gmail.com', 'Teknik Informatika', '2023'),
(9, '10123007', 'Dwi Cahyono', 'dwi.cahyono@outlook.com', 'Sistem Informasi', '2022'),
(10, '10123008', 'Maya Indah', 'maya.indah@gmail.com', 'Teknik Elektro', '2024'),
(11, '10123009', 'Ahmad Fauzi', 'ahmad.fauzi@gmail.com', 'Teknik Informatika', '2021'),
(12, '10123010', 'Dewi Lestari', 'dewi.lestari@gmail.com', 'Sistem Informasi', '2024'),
(13, '10123011', 'Bagas Adi', 'bagas.adi@yahoo.com', 'Teknik Mesin', '2020'),
(14, '10123012', 'Nabila Putri', 'nabila.putri@gmail.com', 'Teknik Komputer', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$wO8Q1R7v2KxN.8D2Qz1Kze.uI2qG6h2F6jW.Y2s1x3x4x5x6x7x8x');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

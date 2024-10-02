-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2024 at 06:52 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_wilayah`
--

-- --------------------------------------------------------

--
-- Table structure for table `lowokwaru`
--

CREATE TABLE `lowokwaru` (
  `koordinat_x` int(11) NOT NULL,
  `koordinat_y` int(11) NOT NULL,
  `akses_jalan` int(11) NOT NULL,
  `harga_tanah` int(11) NOT NULL,
  `kepadatan_penduduk` int(11) NOT NULL,
  `tingkat_kejahatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lowokwaru`
--

INSERT INTO `lowokwaru` (`koordinat_x`, `koordinat_y`, `akses_jalan`, `harga_tanah`, `kepadatan_penduduk`, `tingkat_kejahatan`) VALUES
(40, 57, 1, 582, 372, 11),
(29, 13, 1, 554, 96, 45),
(65, 89, 0, 834, 300, 56),
(96, 11, 1, 183, 208, 80),
(75, 34, 0, 245, 256, 8),
(17, 14, 0, 498, 355, 22),
(97, 16, 1, 105, 174, 72),
(53, 50, 1, 916, 454, 82),
(37, 39, 1, 948, 128, 45),
(48, 2, 1, 414, 351, 46),
(96, 94, 1, 270, 279, 22),
(41, 36, 1, 901, 338, 71),
(49, 31, 0, 611, 272, 2),
(44, 14, 0, 549, 176, 26),
(24, 42, 0, 541, 209, 62),
(65, 32, 1, 277, 54, 95),
(39, 9, 0, 240, 467, 20),
(20, 37, 0, 165, 336, 14),
(68, 95, 1, 711, 148, 44),
(28, 8, 1, 576, 498, 39),
(29, 75, 1, 182, 433, 5),
(65, 11, 1, 515, 326, 87),
(39, 32, 0, 210, 189, 52),
(47, 78, 0, 184, 7, 79),
(89, 5, 1, 895, 301, 35);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

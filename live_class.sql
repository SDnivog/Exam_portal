-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 23, 2021 at 06:25 AM
-- Server version: 10.4.15-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u354788831_trando_class`
--

-- --------------------------------------------------------

--
-- Table structure for table `live_class`
--

CREATE TABLE `live_class` (
  `id` int(11) NOT NULL,
  `live_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `join_link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_time` datetime NOT NULL,
  `post_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `edit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `live_class`
--

INSERT INTO `live_class` (`id`, `live_id`, `teacher_id`, `class_id`, `department`, `title`, `description`, `platform`, `link`, `join_link`, `class_time`, `post_date`, `status`, `edit_date`) VALUES
(5, 'LC-31-334', 'T440-571-715', 'CT-052776', 'Ipe', 'lkdnflkfn', 'lknflnflkdsf  ', 'other', '2021-05-09T18:40', '', '2021-05-24 19:16:00', '2021-05-09', 1, '2021-05-09'),
(7, 'LC-31-365', 'T440-571-715', 'CT-052776', 'Ipe', 'suraj ram', '  asldkjasdkjsadlkjd', 'zoom', 'aslkdnakdlnaldkanda', '', '2021-05-09 18:44:00', '2021-05-09', 1, '2021-05-09'),
(12, 'LC-29-522', 'T808-757-228', 'CT-433391', 'Chemical Engineering', 'Zoom meet1', '12345', 'zoom', '20', 'https://us05web.zoom.us/j/83146214172?pwd=NUduQ2JVdWc4NmJVRTVjYkNrSEY0Zz09', '2021-05-21 02:02:00', '2021-05-18', 1, '0000-00-00'),
(13, 'LC-39-662', 'T808-757-228', 'CT-433391', 'Chemical Engineering', 'Mass Transfer End Semester examination', 'endsem123', 'zoom', '135', 'https://us05web.zoom.us/j/83200965606?pwd=WU1RYVAzNUt6Q1pmV0p5SGgxUjF5Zz09', '2021-05-20 13:45:00', '2021-05-18', 1, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `live_class`
--
ALTER TABLE `live_class`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `live_class`
--
ALTER TABLE `live_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

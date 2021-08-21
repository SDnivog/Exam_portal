-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2021 at 07:17 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital_class`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_assignment`
--

CREATE TABLE `add_assignment` (
  `id` int(10) NOT NULL,
  `assign_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_id` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_url_file` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assignto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_yes_or_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_datetime` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `post_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_assignment`
--

INSERT INTO `add_assignment` (`id`, `assign_id`, `t_id`, `class_id`, `stream`, `title`, `desc`, `type_url_file`, `file`, `link`, `assignto`, `marks`, `due_yes_or_no`, `due_datetime`, `status`, `post_date`) VALUES
(9, 'A-059-059', 'T808-757-228', 'CT-433391', 'Chemical Engineering', 'End sem', '  Optional', 'file', 'govindimg.jpg', '', 'all', '100', 'due', '2021-05-22 11:04:00', 1, '0000-00-00'),
(14, 'A-17-459', 'T440-571-715', 'CT-052776', 'A-50-303', 'lkwdnasdknasdn', 'ndlksandlasnd  ', 'link', '', 'sdlknsadlkasndalksd', 'all', '23', 'due', '2021-05-13 12:57:00', 1, '2021-05-09'),
(18, 'A-69-126', 'T440-571-715', 'CT-052776', 'Ipe', 'What is Graphic Designing ?', '  Your have to write about the features of graphic designing and the importance of it in the field of life', 'file', '18113027_FPD_Dhanwantpalsingh_endsem.pdf', '', 'all', '10', 'due', '2021-05-09 17:53:00', 1, '2021-05-09');

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

-- --------------------------------------------------------

--
-- Table structure for table `study_material`
--

CREATE TABLE `study_material` (
  `id` int(11) NOT NULL,
  `material_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(10) NOT NULL,
  `date` date NOT NULL,
  `edit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `study_material`
--

INSERT INTO `study_material` (`id`, `material_id`, `teacher_id`, `class_id`, `department`, `topic`, `description`, `file_type`, `source`, `link`, `status`, `date`, `edit_date`) VALUES
(5, 'M-82-301', 'T440-571-715', 'CT-052776', 'Ipe', 'saldkndalk', 'nlkdnasdkas ', 'link', 'study_material.sql', 'lksadaslkdnasda', 1, '2021-05-09', '2021-05-09'),
(6, 'M-36-424', 'T440-571-715', 'CT-478316', 'MyDep', 'Our Mission', ' wdugwdwidgqwudq', 'link', '', 'https://grado.in', 1, '2021-05-09', '0000-00-00'),
(7, 'M-93-969', 'T440-571-715', 'CT-052776', 'Ipe', 'sjdasldjldasl', 'lsalkndlasndad ', 'file', 'add_assignment.sql', '', 1, '2021-05-09', '0000-00-00'),
(8, 'M-50-825', 'T440-571-715', 'CT-052776', 'Ipe', 'sura', 'jsldald ', 'file', 'study_material.sql', '', 1, '2021-05-09', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_assignment`
--
ALTER TABLE `add_assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_class`
--
ALTER TABLE `live_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `study_material`
--
ALTER TABLE `study_material`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_assignment`
--
ALTER TABLE `add_assignment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `live_class`
--
ALTER TABLE `live_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `study_material`
--
ALTER TABLE `study_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

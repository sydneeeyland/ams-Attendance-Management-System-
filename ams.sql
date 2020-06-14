-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2020 at 12:37 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `emp_id` int(11) NOT NULL,
  `u_password` varchar(45) NOT NULL,
  `u_name` varchar(45) NOT NULL,
  `u_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`emp_id`, `u_password`, `u_name`, `u_type`) VALUES
(123, 'admin', 'admin', 'admin'),
(41628, '2020-01-19', 'Sydney D. Enciso', 'faculty');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `sec_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `attendance` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `sub_id`, `sec_id`, `stud_id`, `attendance`) VALUES
(1, 1, 1, 123, '2020-01-23 05:27:57'),
(2, 1, 1, 123, '2020-01-23 05:37:04'),
(3, 1, 1, 123, '2020-01-23 05:41:50'),
(4, 1, 1, 123, '2020-01-23 05:43:20'),
(5, 1, 1, 123, '2020-01-23 05:43:52'),
(6, 1, 1, 123, '2020-01-23 05:50:24'),
(7, 1, 1, 123, '2020-01-23 06:00:50'),
(8, 1, 1, 123, '2020-01-23 06:04:36'),
(9, 1, 1, 123, '2020-01-23 06:06:41'),
(10, 1, 1, 123, '2020-01-23 06:20:22'),
(11, 1, 1, 123, '2020-01-23 06:22:01'),
(12, 1, 1, 123, '2020-01-23 06:22:25'),
(13, 1, 1, 123, '2020-01-23 06:26:05'),
(14, 1, 1, 123, '2020-01-23 06:31:52'),
(15, 1, 1, 123, '2020-01-23 06:44:31'),
(16, 1, 1, 123, '2020-01-23 06:44:56'),
(17, 1, 1, 123, '2020-01-23 06:45:19'),
(18, 1, 1, 123, '2020-01-23 06:45:56'),
(19, 1, 1, 123, '2020-01-23 06:47:26'),
(20, 1, 1, 441628, '2020-01-23 06:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_schedule`
--

CREATE TABLE `attendance_schedule` (
  `sched_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `attendance_start` time NOT NULL,
  `attendance_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enrolled`
--

CREATE TABLE `enrolled` (
  `sec_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrolled`
--

INSERT INTO `enrolled` (`sec_id`, `student_id`) VALUES
(1, 1002),
(2, 1005),
(2, 1006),
(2, 1007),
(2, 1010),
(2, 1013),
(2, 1020),
(2, 1022),
(2, 1027),
(2, 1038),
(2, 1040);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(45) NOT NULL,
  `emp_bday` varchar(45) NOT NULL,
  `emp_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`emp_id`, `emp_name`, `emp_bday`, `emp_type`) VALUES
(41628, 'Sydney D. Enciso', '2020-01-19', 'faculty');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `message_title` text NOT NULL,
  `message` longtext NOT NULL,
  `flag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `sec_id` int(11) NOT NULL,
  `sec_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sec_id`, `sec_name`) VALUES
(1, 'Section 1'),
(2, '2');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_card` varchar(45) NOT NULL,
  `student_name` varchar(45) NOT NULL,
  `parents_contact` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_card`, `student_name`, `parents_contact`) VALUES
(1001, '441628', 'Esha Holland', '+639065186524'),
(1002, '41628', 'Leopold Holloway', '+639270348798'),
(1003, '123', 'Lacy Donald', '+639994958914'),
(1004, '', 'Myra Kearney', ''),
(1005, '', 'Ayaz Sears', ''),
(1006, '', 'Beauden Clemons', ''),
(1007, '', 'Dora Dickson', ''),
(1008, '', 'Millie-Mae Crawford', ''),
(1009, '', 'Jon-Paul Rhodes', ''),
(1010, '', 'Antonina Benson', ''),
(1011, '', 'Iga Lam', ''),
(1012, '', 'Fenton Harvey', ''),
(1013, '', 'Abdur Coleman', ''),
(1014, '', 'Salahuddin Holman', ''),
(1015, '', 'Vladimir Howe', ''),
(1016, '', 'Nimra Akhtar', ''),
(1017, '', 'Duane Hester', ''),
(1018, '', 'Ruairidh Mccall', ''),
(1019, '', 'Ophelia Edge', ''),
(1020, '', 'Abbi Mclaughlin', ''),
(1021, '', 'Loui Hodson', ''),
(1022, '', 'Damon Roman', ''),
(1023, '', 'Sean Hardy', ''),
(1024, '', 'Kaycee Sutton', ''),
(1025, '', 'Nela Beck', ''),
(1026, '', 'Kerry Luna', ''),
(1027, '', 'Cameron Watson', ''),
(1028, '', 'Raul Ortega', ''),
(1029, '', 'Lara Ryan', ''),
(1030, '', 'Jody Carlson', ''),
(1031, '', 'Nishat Robertson', ''),
(1032, '', 'Ffion Bush', ''),
(1033, '', 'Niamh Pennington', ''),
(1034, '', 'Toni Nguyen', ''),
(1035, '', 'Gwion Knight', ''),
(1036, '', 'Marjorie Christie', ''),
(1037, '', 'Rian Lamb', ''),
(1038, '', 'Ashraf Booker', ''),
(1039, '', 'Gerald Huffman', ''),
(1040, '', 'Bethaney Travis', '');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` int(11) NOT NULL,
  `sec_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `sub_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `sec_id`, `emp_id`, `sub_name`) VALUES
(1, 1, 41628, '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `attendance_schedule`
--
ALTER TABLE `attendance_schedule`
  ADD PRIMARY KEY (`sched_id`);

--
-- Indexes for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`sec_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41630;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `enrolled`
--
ALTER TABLE `enrolled`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1041;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41629;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `sec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1041;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

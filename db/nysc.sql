-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2018 at 09:45 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nysc`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_user`
--

CREATE TABLE `app_user` (
  `user_id` int(11) NOT NULL,
  `regno` varchar(20) NOT NULL,
  `corp_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_user`
--

INSERT INTO `app_user` (`user_id`, `regno`, `corp_id`, `email`, `password`, `role`) VALUES
(1, '0', 0, 'ADMIN', '123456', 'ROLE_ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `batch_list`
--

CREATE TABLE `batch_list` (
  `batch_id` int(11) NOT NULL,
  `batch_title` varchar(100) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch_list`
--

INSERT INTO `batch_list` (`batch_id`, `batch_title`, `is_active`) VALUES
(6, 'A, 2018', 1);

-- --------------------------------------------------------

--
-- Table structure for table `deployment_list`
--

CREATE TABLE `deployment_list` (
  `id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `corp_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `ppa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `institution_list`
--

CREATE TABLE `institution_list` (
  `id` int(11) NOT NULL,
  `institution_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institution_list`
--

INSERT INTO `institution_list` (`id`, `institution_title`) VALUES
(5, 'Kaduna State University');

-- --------------------------------------------------------

--
-- Table structure for table `mobilization_list`
--

CREATE TABLE `mobilization_list` (
  `id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `institution_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `matric_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobilization_list`
--

INSERT INTO `mobilization_list` (`id`, `batch_id`, `institution_id`, `firstname`, `middlename`, `lastname`, `dob`, `matric_number`) VALUES
(28, 6, 5, 'Nuhu', '', 'Ibrahim', '1996-01-01', 'U15CS2921'),
(29, 6, 5, 'Abdullahi', '', 'Lawal', '1996-07-02', 'U15CS2081');

-- --------------------------------------------------------

--
-- Table structure for table `ppa_list`
--

CREATE TABLE `ppa_list` (
  `ppa_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `ppa_name` varchar(100) NOT NULL,
  `ppa_address` varchar(300) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ppa_list`
--

INSERT INTO `ppa_list` (`ppa_id`, `state_id`, `ppa_name`, `ppa_address`, `capacity`) VALUES
(1, 22, 'Nuwesa House', 'Unguan Muazu Kaduna', 12);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `state_title` varchar(100) NOT NULL,
  `camp_name` varchar(100) NOT NULL,
  `camp_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `state_title`, `camp_name`, `camp_address`) VALUES
(3, 'Abia ', 'Permanent Orientation Camp', 'Permanent Orientation Camp, Umuna, Bende Local Government Area, Abia State'),
(4, 'Adamawa ', 'Government College, Jalingo', 'Government College, Jalingo, Jalinga Local Government Area Taraba state'),
(5, 'Akwa Ibom ', 'NYSC Permanent Orientation Camps Ikot', 'NYSC Permanent Orientation Camps Ikot Itie Udung, Nsit Atal Local Government Area'),
(6, 'Anambra ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Progressive Senior Secondary School, Umunya, Oyi Local Government Area, Anambra State'),
(7, 'Bauchi ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Waila in Ganjuwa Local Government council, Bauchi'),
(8, 'Bayelsa ', 'Kalama Grammar School, Kalama', 'Kalama Grammar School, Kalama, Kolokoma-Opokuma Local Government Area, Bayelsa State'),
(9, 'Benue ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Wanune, Tarka Local Government Area, Kilometer35 Makurdi Gboko Road, Benue State'),
(10, 'Borno ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Kilometer 27 Maflam Sidi, Kwam Local Government Area, Gombe state'),
(12, 'Cross River ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Obubra, Obubra Local Government Area River State'),
(13, 'Delta ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Former Martins TTC, Issle –Uku Aniocha North LGA Delta State'),
(14, 'Ebonyi ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Macgregor College, Afikpo Local Government Area, Ebonyi State'),
(15, 'Edo ', 'Okada Grammar School', 'Okada Grammar School, Okada, Ovia North-East Local Government Area, Edo State'),
(16, 'Ekiti ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Ise-orun/Emure Local Government Area, Ekit State'),
(17, 'Enugu ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Awgu Local Government Area, Enugu State'),
(18, 'FCT ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Kubwa, Bwari Are a Council FCT'),
(19, 'Gombe ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Kilometer 27, Mallam Sidi, Kwam Local Government Area, Gombe State.'),
(20, 'Imo ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Umudi, Nkwerre Local Government Area.'),
(21, 'Jigawa ', 'NYSC Permanent Orientation camp', 'NYSC Permanent Orientation camp, opposite Army Barrack, Fanisau, Dutse Local Government Area, Jigawa state'),
(22, 'Kaduna ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Kaduna-Abuja Road, Kaduna'),
(23, 'Kano ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Kusala Dam, Karaye, Karaye Local Government Kano State'),
(24, 'Katsina ', 'Youth Multi-purpose/ Centre/NYSC Permanent Orientation Camp', 'Youth Multi-purpose/ Centre/NYSC Permanent Orientation Camp, Mani Road Katsina.'),
(25, 'Kebbi ', 'NYSC Temporary orientation Camp', 'NYSC Temporary orientation Camp, Government Science College, Dakingari Local Government Area, Kebbi State'),
(26, 'Kogi ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Asaya, Kabba Local Government Area, Kogi State'),
(27, 'Kwara ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Yikpata, Edu LGA, Kwara State'),
(28, 'Lagos ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Iyana Ipaja, Agege, Lagos'),
(29, 'Nasarawa ', 'Magaji Dan-Yamusa Permanent Orientation ', 'Magaji Dan-Yamusa Permanent Orientation Camp Keffi Nasarawa State.'),
(30, 'Niger ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, former Abubakar, Dada Secondary School, Paiko, Niger State'),
(31, 'Ogun ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Ikenne Road, Sagamu Local Government Area, Ogun State'),
(32, 'Ondo ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Ikare-Akoko Local Government Area, Ondo State'),
(33, 'Osun ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Aisu College Hospital Rd. Ede North Local Government Area, Ede Osun State'),
(34, 'Oyo ', 'Government Technical College', 'Government Technical College, Iseyin Local Government Area, Iseyin, Oyo State.'),
(35, 'Plateau ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Mangu Local Government Area Mangu, Plateau State'),
(36, 'River ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Nonwa-Gbam Tai LGA, Rivers State'),
(37, 'Sokoto ', 'Government Technical College Farfaru', 'Government Technical College Farfaru, Farfaru Local Government Area, Sokoto State'),
(38, 'Taraba ', 'Government College, Jalingo', 'Government College, Jalingo, Jalingo Local Government Area Taraba State'),
(39, 'Yobe ', 'NYSC Permanent Orientation Camp', 'NYSC Permanent Orientation Camp, Wailo, Ganjuwa Local Government Council, Bauchi State'),
(40, 'Zamfara', 'NYSC Permanent Orientation camp', 'NYSC Permanent Orientation camp, Beside FRSC office, Tsafe Local Government Area, Zamfara state.');

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `GSM` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `marital_status` varchar(50) NOT NULL,
  `state_of_origin` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `passport` varchar(200) NOT NULL,
  `kin_name` varchar(100) NOT NULL,
  `kin_GSM` varchar(100) NOT NULL,
  `kin_address` varchar(200) NOT NULL,
  `kin_relationship` varchar(100) NOT NULL,
  `institution_id` int(11) NOT NULL,
  `matric_number` varchar(20) NOT NULL,
  `date_of_grad` date NOT NULL,
  `class_of_degree` varchar(100) NOT NULL,
  `trouser_size` varchar(100) NOT NULL,
  `trouser_length` varchar(100) NOT NULL,
  `trouser_waist` varchar(100) NOT NULL,
  `trouser_bottom` varchar(100) NOT NULL,
  `shirt_size` varchar(100) NOT NULL,
  `shirt_length` varchar(100) NOT NULL,
  `canvas_size` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_user`
--
ALTER TABLE `app_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `batch_list`
--
ALTER TABLE `batch_list`
  ADD PRIMARY KEY (`batch_id`);

--
-- Indexes for table `deployment_list`
--
ALTER TABLE `deployment_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batch_id` (`batch_id`);

--
-- Indexes for table `institution_list`
--
ALTER TABLE `institution_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobilization_list`
--
ALTER TABLE `mobilization_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ppa_list`
--
ALTER TABLE `ppa_list`
  ADD PRIMARY KEY (`ppa_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_user`
--
ALTER TABLE `app_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batch_list`
--
ALTER TABLE `batch_list`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `deployment_list`
--
ALTER TABLE `deployment_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institution_list`
--
ALTER TABLE `institution_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mobilization_list`
--
ALTER TABLE `mobilization_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `ppa_list`
--
ALTER TABLE `ppa_list`
  MODIFY `ppa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

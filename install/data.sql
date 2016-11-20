-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2016 at 06:19 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `addressbook`
--
CREATE DATABASE IF NOT EXISTS `addressbook` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `addressbook`;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(10) UNSIGNED NOT NULL,
  `city_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city_name`) VALUES
(1, 'Abu Dhabi'),
(2, 'Abuja'),
(3, 'Accra'),
(4, 'Addis Ababa'),
(5, 'Algiers'),
(6, 'Amman'),
(7, 'Andorra la Vella'),
(8, 'Ankara'),
(9, 'Antananarivo'),
(10, 'Apia'),
(11, 'Ashgabat'),
(12, 'Asmara'),
(13, 'Astana'),
(14, 'Asuncion'),
(15, 'Athens'),
(16, 'Baku'),
(17, 'Bandar Seri Begawan'),
(18, 'Baghdad'),
(19, 'Bamako'),
(20, 'Bangkok'),
(21, 'Bangui'),
(22, 'Banjul'),
(23, 'Basseterre'),
(24, 'Beijing'),
(25, 'Beirut'),
(26, 'Belgrade'),
(27, 'Belmopan'),
(28, 'Belfast'),
(29, 'Berlin'),
(30, 'Bern'),
(31, 'Bishkek'),
(32, 'Bissau'),
(33, 'Bogota'),
(34, 'Brasilia'),
(35, 'Bratislava'),
(36, 'Brazzaville'),
(37, 'Bridgetown'),
(38, 'Brussels'),
(39, 'Budapest'),
(40, 'Bucharest'),
(41, 'Buenos Aires'),
(42, 'Bujumbura'),
(43, 'Cairo'),
(44, 'Canberra'),
(45, 'Caracas'),
(46, 'Cardiff'),
(47, 'Castries'),
(48, 'Cayenne'),
(49, 'Chisinau'),
(50, 'Colombo'),
(51, 'Conakry'),
(52, 'Copenhagen'),
(53, 'Dakar'),
(54, 'Damascus'),
(55, 'Dhaka'),
(56, 'Dar es Salaam'),
(57, 'Dili'),
(58, 'Djibouti'),
(59, 'Doha'),
(60, 'Dublin'),
(61, 'Dushanbe'),
(62, 'Edinburgh'),
(63, 'Freetown'),
(64, 'Gaborone'),
(65, 'Georgetown'),
(66, 'Guatemala City'),
(67, 'Hanoi'),
(68, 'Harare'),
(69, 'Havana'),
(70, 'Helsinki'),
(71, 'Honiara'),
(72, 'Islamabad'),
(73, 'Jakarta'),
(74, 'Juba'),
(75, 'Kabul'),
(76, 'Kathmandu'),
(77, 'Kampala'),
(78, 'Khartoum'),
(79, 'Kiev'),
(80, 'Kigali'),
(81, 'Kingston'),
(82, 'Kingstown'),
(83, 'Kinshasa'),
(84, 'Kuala Lumpur'),
(85, 'Kuwait City'),
(86, 'La Paz'),
(87, 'Libreville'),
(88, 'Lilongwe'),
(89, 'Lima'),
(90, 'Lisbon'),
(91, 'Ljubljana'),
(92, 'Lome'),
(93, 'London'),
(94, 'London'),
(95, 'Luanda'),
(96, 'Lusaka'),
(97, 'Luxembourg'),
(98, 'Madrid'),
(99, 'Majuro'),
(100, 'Malabo'),
(101, 'Male'),
(102, 'Managua'),
(103, 'Manama'),
(104, 'Manila'),
(105, 'Maputo'),
(106, 'Maseru'),
(107, 'Mbabana'),
(108, 'Melekeok'),
(109, 'Mexico City'),
(110, 'Minsk'),
(111, 'Mogadishu'),
(112, 'Monaco'),
(113, 'Monrovia'),
(114, 'Montevideo'),
(115, 'Moroni'),
(116, 'Moscow'),
(117, 'Muscat'),
(118, 'Nairobi'),
(119, 'Nassau'),
(120, 'N\'Djamena'),
(121, 'New Delhi'),
(122, 'Niamey'),
(123, 'Nicosia'),
(124, 'Nouakchott'),
(125, 'Nuku\'alofa'),
(126, 'Ouagadougou'),
(127, 'Oslo'),
(128, 'Ottawa'),
(129, 'Palikir'),
(130, 'Panama City'),
(131, 'Paramaribo'),
(132, 'Paris'),
(133, 'Phnom Penh'),
(134, 'Podgorica'),
(135, 'Port au Prince'),
(136, 'Port Louis'),
(137, 'Port Moresby'),
(138, 'Port of Spain'),
(139, 'Port Vila'),
(140, 'Porto Novo'),
(141, 'Prague'),
(142, 'Praia'),
(143, 'Pretoria'),
(144, 'Pristina'),
(145, 'Pyongyang'),
(146, 'Quito'),
(147, 'Rabat'),
(148, 'Rangoon (Yangon)'),
(149, 'Reykjavik'),
(150, 'Riga'),
(151, 'Riyadh'),
(152, 'Rome'),
(153, 'Roseau'),
(154, 'Saint George\'s'),
(155, 'Saint John\'s'),
(156, 'San Jose'),
(157, 'San Marino'),
(158, 'San Salvador'),
(159, 'Sanaa'),
(160, 'Santiago'),
(161, 'Santo Domingo'),
(162, 'Sao Tome'),
(163, 'Sarajevo'),
(164, 'Seoul'),
(165, 'Singapore'),
(166, 'Skopje'),
(167, 'Sofia'),
(168, 'Stockholm'),
(169, 'Suva'),
(170, 'Taipei'),
(171, 'Tallinn'),
(172, 'Tarawa Atoll'),
(173, 'Tashkent'),
(174, 'Tbilisi'),
(175, 'Tegucigalpa'),
(176, 'Tehran'),
(177, 'Tel Aviv*'),
(178, 'Amsterdam'),
(179, 'Thimphu'),
(180, 'Tirana (Tirane)'),
(181, 'Tokyo'),
(182, 'Tripoli'),
(183, 'Tunis'),
(184, 'Ulaanbaatar'),
(185, 'Vaduz'),
(186, 'Vaiaku village'),
(187, 'Valletta'),
(188, 'Vatican City'),
(189, 'Victoria'),
(190, 'Vienna'),
(191, 'Vientiane'),
(192, 'Vilnius'),
(193, 'Warsaw'),
(194, 'Washington D.C.'),
(195, 'Wellington'),
(196, 'Windhoek'),
(197, 'Yamoussoukro'),
(198, 'Yaounde'),
(199, 'Yerevan'),
(200, 'Zagreb'),
(202, 'Other City');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `street` varchar(250) NOT NULL,
  `city_id` int(11) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `first_name`, `last_name`, `street`, `city_id`, `zip`, `updated_on`) VALUES
(1, 'CA1', 'CA1', 'CA1 Street', 1, '12345', '2016-11-20 04:08:42'),
(2, 'CA2', 'CA2', 'CA2 Street', 49, '222222', '2016-11-20 04:09:09'),
(3, 'CC1', 'CC1', 'CC1 Street', 56, '1111111', '2016-11-20 04:09:36'),
(4, 'CC2', 'CC2', 'CC2 Street', 59, '2222222', '2016-11-20 04:10:01'),
(5, 'CD1', 'CD1', 'CD1 Street', 1, '1234', '2016-11-20 04:11:09'),
(6, 'CD2', 'CD2', 'CD2 Street', 51, '222', '2016-11-20 05:25:19'),
(7, 'CB1', 'CB1', 'CB1 Street', 16, '111', '2016-11-20 05:26:09'),
(8, 'CB2', 'CB2', 'CB2 Steet', 18, '2222', '2016-11-20 05:26:29');

-- --------------------------------------------------------

--
-- Table structure for table `contact_group`
--

CREATE TABLE `contact_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `contact_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_group`
--

INSERT INTO `contact_group` (`id`, `contact_id`, `group_id`) VALUES
(10, 4, 4),
(14, 5, 5),
(18, 1, 2),
(17, 1, 6),
(16, 2, 2),
(15, 2, 6),
(9, 3, 4),
(11, 6, 5),
(12, 7, 3),
(13, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(6, 'Group A'),
(2, 'Group AA'),
(3, 'Group B'),
(4, 'Group C'),
(5, 'Group D');

-- --------------------------------------------------------

--
-- Table structure for table `group_inherit`
--

CREATE TABLE `group_inherit` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_inherit`
--

INSERT INTO `group_inherit` (`id`, `group_id`, `parent_id`) VALUES
(58, 5, 3),
(57, 5, 2),
(59, 5, 4),
(60, 4, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_group`
--
ALTER TABLE `contact_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_inherit`
--
ALTER TABLE `group_inherit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `contact_group`
--
ALTER TABLE `contact_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `group_inherit`
--
ALTER TABLE `group_inherit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

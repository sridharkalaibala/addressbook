-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2016 at 06:26 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.38-4+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `addressbook`
--
CREATE DATABASE IF NOT EXISTS `addressbook` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `addressbook`;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `street` varchar(250) NOT NULL,
  `city_id` int(11) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `first_name`, `last_name`, `street`, `city_id`, `zip`, `updated_on`) VALUES
(1, 'John', 'Thomas', '1st Street', 1, '12345', '2016-11-06 12:38:49'),
(2, 'Arul', 'Das', 'Neermulai', 121, '89567', '2016-11-06 12:39:18'),
(3, 'Erik', 'John', '2nd Cross Street', 1, '89567', '2016-11-06 12:39:43'),
(4, 'Anton', 'Daniel', 'MJ Street', 93, '56789', '2016-11-06 12:40:16'),
(5, 'Smith', 'Ann', 'str ion', 76, '4857', '2016-11-06 12:42:26'),
(6, 'Jones', 'Dunn', 'LMK Street', 147, '7845', '2016-11-06 12:42:46'),
(7, 'Johnson', 'Page', 'Erju Street', 54, '6985', '2016-11-06 12:43:08'),
(8, 'Williams', 'Page', 'YUK Street', 78, '8522', '2016-11-06 12:43:34'),
(9, 'Miller', 'Fellows', 'tyeh Street', 10, '6235', '2016-11-06 12:43:52'),
(10, 'White', 'Rose', 'JKW Street', 96, '5624', '2016-11-06 12:44:16'),
(11, 'Cook', 'Bishop', '345 street', 181, '2222', '2016-11-06 12:44:45'),
(12, 'Bell', 'Dean', '839 Street', 43, '8933', '2016-11-06 12:45:07'),
(13, 'Butler', 'Hale', '0934 Street', 29, '7548', '2016-11-06 12:45:37'),
(14, 'West', 'Boyd', 'jhsr street', 30, '5268', '2016-11-06 12:46:27'),
(15, 'Hart', 'Cross', 'JK Street', 57, '568', '2016-11-06 12:47:01'),
(16, 'Adrews', 'Abbot', '$FS Street', 67, '6254', '2016-11-06 12:48:36'),
(17, 'Hodley', 'woodburn', 'GRT Street', 116, '5687', '2016-11-06 12:49:27'),
(18, 'Timms', 'Sher', 'SS Street', 178, '7856', '2016-11-06 12:49:48'),
(19, 'Lob', 'Abram', '888 Street', 82, '4257', '2016-11-06 12:50:12'),
(20, 'Gandy', 'Binder', '999 Street', 104, '66698', '2016-11-06 12:50:35'),
(21, 'Makin', 'Allred', '#$ER Street', 128, '62543', '2016-11-06 12:51:06'),
(22, 'Brun', 'Clow', 'MMM Street', 66, '5687458', '2016-11-06 12:51:29');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=203 ;

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
(120, 'N''Djamena'),
(121, 'New Delhi'),
(122, 'Niamey'),
(123, 'Nicosia'),
(124, 'Nouakchott'),
(125, 'Nuku''alofa'),
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
(154, 'Saint George''s'),
(155, 'Saint John''s'),
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22 May 2015 la 11:05
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `photo_gallery`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photograph_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `author` varchar(255) CHARACTER SET utf8 NOT NULL,
  `body` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `photograph_id` (`photograph_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Salvarea datelor din tabel `comments`
--

INSERT INTO `comments` (`id`, `photograph_id`, `created`, `author`, `body`) VALUES
(4, 11, '2014-07-06 00:00:00', 'lexu', 'nice lemne'),
(37, 21, '2015-05-18 22:03:15', 'faswefdaw', 'dwadwa'),
(6, 17, '2014-07-09 00:00:00', 'Lexu', 'No, this is Tappppiiiiaaaa'),
(7, 21, '2014-07-09 00:00:00', 'Lexu', 'am dat aproape din gresela peste poza asta.\r\n\r\nchiar scrie TENCHE la astia in curte'),
(9, 22, '2014-07-11 00:00:00', 'lexu', 'ye, really :)'),
(10, 24, '2014-07-21 00:00:00', 'lexu', 'lol asta da poza de cv'),
(11, 27, '2014-07-21 00:00:00', 'lexu', 'e poza pe o parte nu va speriati'),
(12, 24, '2014-07-21 00:00:00', 'lexu', 'stau in zdrenianin si imi inec amaru :)'),
(18, 20, '2014-11-12 14:15:05', 'lexu', 'asa da'),
(40, 12, '2015-05-18 23:05:42', 'dddd', 'dddd'),
(25, 13, '2015-02-01 18:40:14', '', 'testing'),
(39, 21, '2015-05-18 22:06:46', 'alex', 'intresting'),
(38, 21, '2015-05-18 22:06:36', 'fwadwa', 'dawdwa'),
(30, 28, '2015-02-01 20:38:16', 'anonymous', 'he he'),
(36, 21, '2015-05-14 01:10:46', 'aaa', 'aaaa'),
(35, 21, '2015-05-14 01:10:31', 'alex', 'testing'),
(34, 20, '0000-00-00 00:00:00', 'lexu', 'testing');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `photographs`
--

CREATE TABLE IF NOT EXISTS `photographs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `filename` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type` varchar(100) CHARACTER SET utf8 NOT NULL,
  `size` int(11) NOT NULL,
  `caption` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Salvarea datelor din tabel `photographs`
--

INSERT INTO `photographs` (`id`, `user_id`, `filename`, `type`, `size`, `caption`) VALUES
(21, 10, 'tenche1.jpg', 'image/jpeg', 163405, 'La astia in curte scrie TENCHE'),
(20, 10, 'split.jpg', 'image/jpeg', 237499, 'Na, pe unde ?'),
(19, 10, 'Monumentul Eroilor de la Paulis.jpg', 'image/jpeg', 276885, 'Greu si cu obiectivele astea'),
(12, 10, 'DSC00545.jpg', 'image/jpeg', 157089, 'Drum Resita - Carasova'),
(13, 10, 'DSC00554.jpg', 'image/jpeg', 199586, 'Mai 3km pana la pestera Comarnic'),
(14, 10, 'DSC00574.jpg', 'image/jpeg', 511499, 'mai putin :)'),
(15, 10, 'DSC00464.jpg', 'image/jpeg', 86149, 'Ancient Aliens'),
(16, 10, 'DSC00475.jpg', 'image/jpeg', 169534, 'Vonavianul Semenicus'),
(17, 10, 'DSC00520.jpg', 'image/jpeg', 194855, 'This is Sparta !?'),
(18, 10, 'Vona exploring.jpg', 'image/jpeg', 227305, 'Vona catre Pestera lui Dutu - varianta prin parau'),
(22, 10, 'timis.jpg', 'image/jpeg', 119410, 'pe Timis'),
(25, 10, 'DSC00684.JPG', 'image/jpeg', 143888, 'streets of novisad - fara michael douglas'),
(26, 10, 'DSC00723.JPG', 'image/jpeg', 122091, 'cetatea exit'),
(27, 10, 'DSC00735.JPG', 'image/jpeg', 107031, 'sarbii sunt si ei romantici'),
(29, 10, 'DSC00746.JPG', 'image/jpeg', 188570, 'monanul castelan (o bagat rock toata noaptea)'),
(31, 10, 'DSC00752.JPG', 'image/jpeg', 138901, 'the bridge pe care am venit'),
(32, 10, 'DSC00780.jpg', 'image/jpeg', 124533, 'Sorela o intrat in afaceri'),
(39, 26, 'fard-manhattan-pinacolada-1.jpg', 'image/jpeg', 79117, 'wadwadwa'),
(40, 26, 'fard-manhattan-pinkalicious-2.jpg', 'image/jpeg', 124908, 'dfsdf'),
(41, 26, 'img1.jpg', 'image/jpeg', 24250, 'asdawd'),
(44, 10, 'img2.jpg', 'image/jpeg', 28779, 'aaww');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 NOT NULL,
  `password` varchar(40) CHARACTER SET utf8 NOT NULL,
  `join_date` timestamp NOT NULL,
  `last_activity` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `join_date`, `last_activity`) VALUES
(10, 'Alex Tenche', 'alex@gmail.com', 'termopane', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'erwerew', 'werwer', 'termopane', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Alexone', 'alexone@gmail.com', 'artas', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

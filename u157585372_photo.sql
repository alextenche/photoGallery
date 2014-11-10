
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Gazda: localhost
-- Timp de generare: 09 Noi 2014 la 17:30
-- Versiune server: 5.1.61
-- Versiune PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza de date: `u157585372_photo`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photograph_id` int(11) NOT NULL,
  `created` date NOT NULL,
  `author` varchar(255) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Salvarea datelor din tabel `comments`
--

INSERT INTO `comments` (`id`, `photograph_id`, `created`, `author`, `body`) VALUES
(4, 11, '2014-07-06', 'lexu', 'nice lemne'),
(5, 12, '2014-07-07', 'Lexu', 'cool :)'),
(6, 17, '2014-07-09', 'Lexu', 'No, this is Tappppiiiiaaaa'),
(7, 21, '2014-07-09', 'Lexu', 'am dat aproape din gresela peste poza asta.\r\n\r\nchiar scrie TENCHE la astia in curte'),
(8, 21, '2014-07-10', 'aaa', 'sasdasdsad'),
(9, 22, '2014-07-11', 'lexu', 'ye, really :)'),
(10, 24, '2014-07-21', 'lexu', 'lol asta da poza de cv'),
(11, 27, '2014-07-21', 'lexu', 'e poza pe o parte nu va speriati'),
(12, 24, '2014-07-21', 'lexu', 'stau in zdrenianin si imi inec amaru :)');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `photographs`
--

CREATE TABLE IF NOT EXISTS `photographs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `size` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Salvarea datelor din tabel `photographs`
--

INSERT INTO `photographs` (`id`, `filename`, `type`, `size`, `caption`) VALUES
(21, 'tenche1.jpg', 'image/jpeg', 163405, 'La astia in curte scrie TENCHE'),
(20, 'split.jpg', 'image/jpeg', 237499, 'Na, pe unde ?'),
(19, 'Monumentul Eroilor de la Paulis.jpg', 'image/jpeg', 276885, 'Greu si cu obiectivele astea'),
(12, 'DSC00545.jpg', 'image/jpeg', 157089, 'Drum Resita - Carasova'),
(13, 'DSC00554.jpg', 'image/jpeg', 199586, 'Mai 3km pana la pestera Comarnic'),
(14, 'DSC00574.jpg', 'image/jpeg', 511499, 'mai putin :)'),
(15, 'DSC00464.jpg', 'image/jpeg', 86149, 'Ancient Aliens'),
(16, 'DSC00475.jpg', 'image/jpeg', 169534, 'Vonavianul Semenicus'),
(17, 'DSC00520.jpg', 'image/jpeg', 194855, 'This is Sparta !?'),
(18, 'Vona exploring.jpg', 'image/jpeg', 227305, 'Vona catre Pestera lui Dutu - varianta prin parau'),
(22, 'timis.jpg', 'image/jpeg', 119410, 'pe Timis'),
(23, 'DSC00581.JPG', 'image/jpeg', 108381, 'Ancient Aliens clar'),
(24, 'DSC00610.JPG', 'image/jpeg', 146083, 'suparattt sunt doamne iara'),
(25, 'DSC00684.JPG', 'image/jpeg', 143888, 'streets of novisad - fara michael douglas'),
(26, 'DSC00723.JPG', 'image/jpeg', 122091, 'cetatea exit'),
(27, 'DSC00735.JPG', 'image/jpeg', 107031, 'sarbii sunt si ei romantici'),
(28, 'DSC00742.JPG', 'image/jpeg', 180468, 'echipa cam tabarata'),
(29, 'DSC00746.JPG', 'image/jpeg', 188570, 'monanul castelan (o bagat rock toata noaptea)'),
(30, 'DSC00763.JPG', 'image/jpeg', 173603, 'prietenii animalelor'),
(31, 'DSC00752.JPG', 'image/jpeg', 138901, 'the bridge pe care am venit'),
(32, 'DSC00780.jpg', 'image/jpeg', 124533, 'Sorela o intrat in afaceri');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`) VALUES
(1, 'alex', 'pass', 'alex', 'tenche');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

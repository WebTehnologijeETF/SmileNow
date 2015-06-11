-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2015 at 11:30 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bazasmile`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE IF NOT EXISTS `komentari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idnovosti` int(11) NOT NULL,
  `autor` varchar(50) COLLATE utf16_slovenian_ci NOT NULL,
  `emailautora` varchar(30) COLLATE utf16_slovenian_ci NOT NULL,
  `tekst` text COLLATE utf16_slovenian_ci NOT NULL,
  `vrijeme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idnovosti` (`idnovosti`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `idnovosti`, `autor`, `emailautora`, `tekst`, `vrijeme`) VALUES
(1, 1, 'benjamin', 'neki_mail@hotmail.com', 'Ovo je komentar za prvu novost u tabeli.', '2015-05-28 14:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `novosti`
--

CREATE TABLE IF NOT EXISTS `novosti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(100) COLLATE utf16_slovenian_ci NOT NULL,
  `autor` varchar(30) COLLATE utf16_slovenian_ci NOT NULL,
  `tekst` text COLLATE utf16_slovenian_ci NOT NULL,
  `brojkomentara` int(11) NOT NULL DEFAULT '0',
  `vrijeme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `novosti`
--

INSERT INTO `novosti` (`id`, `naslov`, `autor`, `tekst`, `brojkomentara`, `vrijeme`) VALUES
(1, 'Prva novost', 'Benjamin', 'Ovo je prva novost u tabeli novosti.', 1, '2015-05-28 14:20:04'),
(2, 'Ovo je neka novost', 'Autor Autorovic', 'Eh sada ovdje ide tekst novostiEh sada ovdje ide tekst novostiEh sada ovdje ide tekst novostiEh sada ovdje ide tekst novostiEh sada ovdje ide tekst novostiEh sada ovdje ide tekst novostiEh sada ovdje ide tekst novostiEh sada ovdje ide tekst novosti', 0, '2015-05-28 23:35:04'),
(3, 'Novost sedmice', 'Neki Autor', 'tekst novostitekst novostitekst novostitekst novostitekst novostitekst novostitekst novostitekst novostitekst novostitekst novostitekst novostitekst novostitekst novostitekst novostitekst novostitekst novosti', 0, '2015-05-28 23:35:49');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `komentari_ibfk_1` FOREIGN KEY (`idnovosti`) REFERENCES `novosti` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

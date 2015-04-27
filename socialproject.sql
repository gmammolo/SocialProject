-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Apr 27, 2015 alle 20:18
-- Versione del server: 5.5.38-0ubuntu0.14.04.1
-- Versione PHP: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `socialproject`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Post`
--

CREATE TABLE IF NOT EXISTS `Post` (
  `id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `text` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `hashtag` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `locate` varchar(30) NOT NULL,
  `privacy` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `Profile`
--

CREATE TABLE IF NOT EXISTS `Profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `generalita` enum('uomo','donna','altro','nessuno') NOT NULL DEFAULT 'nessuno',
  `avatar` varchar(250) NOT NULL,
  `residenza` varchar(250) NOT NULL,
  `data` date NOT NULL,
  `email` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dump dei dati per la tabella `Profile`
--

INSERT INTO `Profile` (`id`, `nome`, `generalita`, `avatar`, `residenza`, `data`, `email`) VALUES
(2, 'amministratore', 'uomo', 'http://www.gopsp.it/uploads/profile/photo-206.png', '', '0000-00-00', 'root@gmail.com'),
(4, 'Pippo', 'nessuno', 'https://scontent-mxp.xx.fbcdn.net/hphotos-xap1/v/t1.0-9/11074295_10205690252111622_7873289294299222000_n.jpg?oh=c0af5564920ff115eed27388ce9c57c7&oe=559F6F9B', '', '0000-00-00', 'pippo@super.it'),
(6, 'Topolino', 'nessuno', 'http://img4.wikia.nocookie.net/__cb20141220175033/disney/it/images/4/4e/Topolinodisney.jpg', '', '0000-00-00', 'Miki@altro.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `Relationship`
--

CREATE TABLE IF NOT EXISTS `Relationship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant` int(11) NOT NULL,
  `requested` int(11) NOT NULL,
  `ablocked` tinyint(1) NOT NULL DEFAULT '0',
  `rblocked` tinyint(1) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `acceptedDate` date DEFAULT NULL,
  `requestDate` date DEFAULT NULL,
  `ablockedDate` date DEFAULT NULL,
  `rblockedDate` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `applicant` (`applicant`),
  KEY `requested` (`requested`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(74) NOT NULL,
  `accessLevel` int(11) NOT NULL,
  `roles` varchar(250) NOT NULL,
  `email` varchar(32) NOT NULL,
  `profile` int(11) NOT NULL,
  `cookie` varchar(33) DEFAULT NULL,
  `cookie_expire` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dump dei dati per la tabella `User`
--

INSERT INTO `User` (`id`, `username`, `password`, `accessLevel`, `roles`, `email`, `profile`, `cookie`, `cookie_expire`) VALUES
(9, 'admin', '$1$3rl9ZBDI$rOfwt7yKy6LXv7PAI3uKJ1', 5, 'a:1:{i:0;i:1;}', 'root@gmail.com', 2, '', '0000-00-00'),
(11, 'Pippo', '$1$1255aAfg$kCSIvXo11RRGOioC.wAx00', 1, 'a:0:{}', 'pippo@super.it', 4, NULL, '0000-00-00'),
(13, 'Topolino', '$1$2TDKxkgZ$PE7a0Xt0closwEpOVxrA8/', 4, 'a:0:{}', 'Miki@altro.com', 6, NULL, '0000-00-00');

-- --------------------------------------------------------

--
-- Struttura della tabella `V_UserRegistred`
--
-- in uso(#1356 - View 'socialproject.V_UserRegistred' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them)
-- Si è verificato un errore durante la lettura dei dati: (#1356 - View 'socialproject.V_UserRegistred' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them)

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Relationship`
--
ALTER TABLE `Relationship`
  ADD CONSTRAINT `Relationship_ibfk_1` FOREIGN KEY (`applicant`) REFERENCES `Profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relationship_ibfk_2` FOREIGN KEY (`requested`) REFERENCES `Profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

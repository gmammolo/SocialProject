-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Apr 21, 2015 alle 20:01
-- Versione del server: 5.5.41-0ubuntu0.14.04.1
-- Versione PHP: 5.5.9-1ubuntu4.6

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `Profile`
--

INSERT INTO `Profile` (`id`, `nome`, `generalita`, `avatar`, `residenza`, `data`, `email`) VALUES
(2, 'Amministratore', 'nessuno', 'Template/images/avatar.jpg', '', '0000-00-00', 'root@gmail.com'),
(3, 'Pippo', 'uomo', 'Template/images/avatar.jpg', '', '0000-00-00', 'pippo@email.com');

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
  `cache` varchar(33) DEFAULT NULL,
  `cache_expire` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dump dei dati per la tabella `User`
--

INSERT INTO `User` (`id`, `username`, `password`, `accessLevel`, `roles`, `email`, `profile`, `cache`, `cache_expire`) VALUES
(9, 'admin', '$1$0HpBTyzg$mM0v2TBKJFdRNbjEDoK67/', 5, 'a:1:{i:0;i:1;}', 'root@gmail.com', 2, '', '0000-00-00'),
(10, 'Pippo', '$1$I3dde./R$u03B8gTOk0OqjUPBlFNby0', 2, 'a:0:{}', 'pippo@email.com', 3, NULL, '0000-00-00');

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `V_UserRegistred`
--
CREATE TABLE IF NOT EXISTS `V_UserRegistred` (
`id` int(11)
,`username` varchar(32)
,`accessLevel` int(11)
,`roles` varchar(250)
,`email` varchar(32)
,`profile` int(11)
,`cache` varchar(33)
,`cache_expire` date
);
-- --------------------------------------------------------

--
-- Struttura per la vista `V_UserRegistred`
--
DROP TABLE IF EXISTS `V_UserRegistred`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `V_UserRegistred` AS select `User`.`id` AS `id`,`User`.`username` AS `username`,`User`.`accessLevel` AS `accessLevel`,`User`.`roles` AS `roles`,`User`.`email` AS `email`,`User`.`profile` AS `profile`,`User`.`cache` AS `cache`,`User`.`cache_expire` AS `cache_expire` from `User` where (`User`.`accessLevel` > 1);

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

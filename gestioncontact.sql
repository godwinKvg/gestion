-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 24 mai 2021 à 18:55
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestioncontact`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(52) DEFAULT NULL,
  `prenom` varchar(52) DEFAULT NULL,
  `email_pro` varchar(52) DEFAULT NULL,
  `email_perso` varchar(52) DEFAULT NULL,
  `telephone1` varchar(52) DEFAULT NULL,
  `telephone2` varchar(52) DEFAULT NULL,
  `adresse` varchar(52) DEFAULT NULL,
  `genre` varchar(20) DEFAULT NULL,
  `photo` varchar(52) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `prenom`, `email_pro`, `email_perso`, `telephone1`, `telephone2`, `adresse`, `genre`, `photo`) VALUES
(1, 'kavege', 'kodjo godwin', 'goddwinkavege@gmail.com', 'godwinkvg@gmail.com', '+212638796620', '+212762408108', 'Rue Souani', 'homme', '2.jfif'),
(2, 'Nadah', 'El Meliani', 'ElMeliani@gmail.com', 'ElMeliani@gmail.com', '+232 93 939 73', '+383 3838339', 'Mon Domicile', 'femme', '3.png'),
(3, 'Dahbia', 'Mrabet', 'Mrabet@gmail.com', 'Mrabet@gmail.com', '+232 93 939 73', '+383 3838339', 'Mon Domicile', 'femme', '11.jfif'),
(4, 'Bahéchar', 'Salamah', 'Salamah@gmail.com', 'Salamah@gmail.com', '+232 93 939 73', '+383 3838339', 'Mon Domicile', 'homme', '12.jfif'),
(5, 'Saadet', 'Oufkir', 'Oufkir@gmail.com', 'Oufkir@gmail.com', '+232 93 939 73', '+383 3838339', 'Mon Domicile', 'femme', '4.jpg'),
(6, 'Hudun', 'Assaraf', 'Assaraf@gmail.com', 'Assaraf@gmail.com', '+232 93 939 73', '+383 3838339', 'Mon Domicile', 'femme', '6.jpg'),
(7, 'Zafzaf', 'Reshma', 'Reshma@gmail.com', 'Reshma@gmail.com', '+232 93 939 73', '+383 3838339', 'Mon Domicile', 'femme', '8.jfif'),
(8, 'Seddiki', 'Hanane', 'Hanane@gmail.com', 'Hanane@gmail.com', '+232 93 939 73', '+383 3838339', 'Mon Domicile', 'femme', '11.jfif'),
(9, 'Abécassis', 'Baysan', 'Baysan@gmail.com', 'Baysan@gmail.com', '+232 93 939 73', '+383 3838339', 'Mon Domicile', 'femme', '4.jfif'),
(10, 'Qamari', 'Jabalah', 'Jabalah@gmail.com', 'Jabalah@gmail.com', '+232 93 939 73', '+383 3838339', 'Mon Domicile', 'homme', '7.jpg');



-- -------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
COMMIT;

--
-- Déchargement des données de la table `groupe`
--


INSERT INTO `groupe` (`id`, `nom`, `image`) VALUES 
(1, 'Famille', 'famille.jfif'),
(2, 'Amis', 'amis.jfif'),
(3, 'Informatique', 'info.jfif'),
(4, 'Industriel', 'industriel.jfif'),
(5, 'hacker', 'hacker.png');


-- --------------------------------------------------------

--
-- Structure de la table `contact_groupe`
--

DROP TABLE IF EXISTS `contact_groupe`;
CREATE TABLE IF NOT EXISTS `contact_groupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_gpe` int(11) NOT NULL,
  `id_contact` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Déchargement des données de la table `contact_groupe`
--
INSERT INTO `contact_groupe`(`id`, `id_gpe`, `id_contact`) VALUES 
(1 ,1,1),
(2 ,1,2),
(3 ,2,2),
(4 ,2,1),
(5 ,3,1),
(6 ,3,2),
(7 ,4,3),
(8 ,3,4),
(9 ,4,5),
(10 ,4,6),
(11 ,4,7),
(12 ,3,8),
(13 ,3,9),
(14 ,4,10),
(15 ,1,11),
(16 ,2,12),
(17 ,2,13),
(18 ,2,14),
(19 ,3,15),
(20 ,4,16),
(21 ,4,17),
(22 ,1,18);


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
(1, 'kavege', 'kodjo godwin', 'goddwinkavege@gmail.com', 'godwinkvg@gmail.com', '+212638796620', '+212762408108', 'Rue Souani', 'homme', '1621851554.png'),
(2, 'Moina', 'El Hadj', 'moinahadji@get.com', 'test@testing.get', '+232 93 939 73', '+383 3838339', 'Mon Domicile', 'femme', NULL);

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

/*!40101 SET CHARgit ACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

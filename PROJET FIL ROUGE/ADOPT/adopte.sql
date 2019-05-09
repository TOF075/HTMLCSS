-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 09 avr. 2019 à 06:37
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `adopte`
--

-- --------------------------------------------------------

--
-- Structure de la table `business`
--

DROP TABLE IF EXISTS `business`;
CREATE TABLE IF NOT EXISTS `business` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `business_name` varchar(100) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `pass` text NOT NULL,
  `reg_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `business`
--

INSERT INTO `business` (`id`, `business_name`, `last_name`, `first_name`, `mail`, `pass`, `reg_date`) VALUES
(1, 'rgzrv', 'efvefv', 'efvfe', 'tof@h.fr', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL),
(2, 'LULU', 'PERES', 'CHRISTOPHE', 'xtophe.PERES@gmail.com', 'd659d96d15c7a1206f44eb36ed72495563140859', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `pass` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `reg_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `pseudo`, `pass`, `email`, `reg_date`) VALUES
(1, 'toto', '1daf4eb81fe0f76949323544174e6e4900a39d39', 'tof@h.fr', NULL),
(2, 'sarah57', 'c8e6fdc377127342de9afc9c6fc376f3f4fd00ee', 'sarahbordelais@gmail.com', NULL),
(3, 'tttttt', '4ae9fa0a8299a828a886c0eb30c930c7cf302a72', 'g@f.fr', NULL),
(4, '&quot;&quot;&quot;', '43814346e21444aaf4f70841bf7ed5ae93f55a9d', '3@3.fr', NULL),
(5, 'toto', 'cd3f0c85b158c08a2b113464991810cf2cdfc387', 'toto@jjj.fr', NULL),
(6, '1', '7c4d33785daa5c2370201ffa236b427aa37c9996', '1@1.fr', NULL),
(7, 'tutu', '32a89bdcec2d50f9dc9747cd47ecfc14cf9c3dbe', 'tutu@tutu.fr', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 04 juin 2019 à 11:46
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
-- Structure de la table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `company_logo` varchar(200) NOT NULL,
  `siret` int(20) NOT NULL,
  `date_creation` date NOT NULL,
  `resume` text NOT NULL,
  `address` varchar(100) NOT NULL,
  `cp` int(5) NOT NULL,
  `city` varchar(25) NOT NULL,
  `country` varchar(25) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `phone` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `job`
--

DROP TABLE IF EXISTS `job`;
CREATE TABLE IF NOT EXISTS `job` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `job_name` varchar(100) NOT NULL,
  `illustration_job` text NOT NULL,
  `job_sector` varchar(100) NOT NULL,
  `job_infos` text NOT NULL,
  `job_address` varchar(100) NOT NULL,
  `debut_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jobcompany`
--

DROP TABLE IF EXISTS `jobcompany`;
CREATE TABLE IF NOT EXISTS `jobcompany` (
  `id_job` int(10) UNSIGNED NOT NULL,
  `id_company` int(200) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_job`,`id_company`),
  KEY `id_company` (`id_company`),
  KEY `id_job` (`id_job`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jobskills`
--

DROP TABLE IF EXISTS `jobskills`;
CREATE TABLE IF NOT EXISTS `jobskills` (
  `id_skill` int(10) NOT NULL,
  `id_job` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_skill`),
  KEY `id_job` (`id_job`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `jobskills`
--

INSERT INTO `jobskills` (`id_skill`, `id_job`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `pass` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `color` varchar(4) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `pseudo`, `pass`, `email`, `color`, `avatar`) VALUES
(1, 'toto', '1daf4eb81fe0f76949323544174e6e4900a39d39', 'tof@h.fr', NULL, ''),
(2, 'sarah57', 'c8e6fdc377127342de9afc9c6fc376f3f4fd00ee', 'sarahbordelais@gmail.com', NULL, ''),
(3, 'tttttt', '4ae9fa0a8299a828a886c0eb30c930c7cf302a72', 'g@f.fr', NULL, ''),
(4, '&quot;&quot;&quot;', '43814346e21444aaf4f70841bf7ed5ae93f55a9d', '3@3.fr', NULL, ''),
(5, 'toto', 'cd3f0c85b158c08a2b113464991810cf2cdfc387', 'toto@jjj.fr', NULL, ''),
(6, '1', '7c4d33785daa5c2370201ffa236b427aa37c9996', '1@1.fr', NULL, ''),
(7, 'tutu', '32a89bdcec2d50f9dc9747cd47ecfc14cf9c3dbe', 'tutu@tutu.fr', NULL, ''),
(8, 'toto', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', 'tof@oh.fr', NULL, ''),
(9, 'prout', '5683b32d9da3fe83cef1e284dc210e768d02b7cf', 'prout@prout.fr', NULL, ''),
(10, 'Tof', '9123924f2e90b354cf15af0a91ab5ff880708e46', 'peres@prout.fr', NULL, ''),
(11, 'xx', 'dd7b7b74ea160e049dd128478e074ce47254bde8', 'xx@xx.fr', NULL, '11.png'),
(12, 'retest', 'e74788d6f0b1e7f06935cc3e5052a0b65df54232', 'retest@gmail.com', NULL, ''),
(13, 'lulu', '4ec844dae165816ebad5cb5ed77840e2484047d6', 'lulu@lulu.fr', NULL, ''),
(14, 'z', '395df8f7c51f007019cb30201c49e884b46b92fa', 'z@z.fr', NULL, ''),
(15, 'fares', '1a42fab9b35ea59ea3a645a5355c2eb8345e19b0', 'fares@i.fr', NULL, ''),
(16, 'zz', 'd7dacae2c968388960bf8970080a980ed5c5dcb7', 'zz@zz.fr', NULL, ''),
(17, 'loulou', '109b5c7246f087aa4b5c89902eb386bc6b0d0258', 'loulou@loulou.fr', NULL, ''),
(18, 'poue', '7084661ee9ee6f667362e4257a087e6c14580d98', 'pou@poupou.fr', NULL, ''),
(19, 'voui', '4ec844dae165816ebad5cb5ed77840e2484047d6', 'v@v.fr', NULL, ''),
(20, 'lucastbm', '2871591e64f027a23fadafaa00305a8bd3484292', 'lucas@tbm.de', NULL, ''),
(21, 'lucasttbm', '69c8161c849f5a735aaac28093eab0ca608a63fc', 'liug@hhh.fr', NULL, ''),
(22, 'maman', '50d7436039744c253f9b2a4e90cbedb02ebfb82d', 'maman@a.fr', NULL, ''),
(23, 'onyva', 'd05219f8cc314443f25f9bc044f488a05f353c7a', 'onyva@va.fr', NULL, '23.jpg'),
(24, 'ifa', '5fccabba18db38e2cb69801faf9e1452addb617f', 'ifa@ifa.fr', NULL, 'default.jpg'),
(25, 'lo', '638e8f0171575864326f06d2a5f8e72287427b15', 'lo@lo.fr', NULL, '25.jpg'),
(26, 'max', '0706025b2bbcec1ed8d64822f4eccd96314938d0', 'max@max.fr', NULL, '26.png'),
(27, 'fou', 'cc98dfae011827b0dc2049bd6974dbcbf1c03015', 'fou@fou.fr', NULL, 'default.jpg'),
(28, 'indo', '2589cae7d56058f8d4b22f1d02403fc1bf435fca', 'indo@indo.fr', NULL, 'default.jpg'),
(29, 'can', '7e9219a0599eae1d9601883f894b4fbe60870586', 'can@can.fr', NULL, '29.png');

-- --------------------------------------------------------

--
-- Structure de la table `membersskills`
--

DROP TABLE IF EXISTS `membersskills`;
CREATE TABLE IF NOT EXISTS `membersskills` (
  `id_members` int(11) NOT NULL,
  `id_skills` int(11) NOT NULL,
  UNIQUE KEY `id_members` (`id_members`),
  KEY `membersskills_ibfk_1` (`id_skills`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rh`
--

DROP TABLE IF EXISTS `rh`;
CREATE TABLE IF NOT EXISTS `rh` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `business_name` varchar(100) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `pass` text NOT NULL,
  `id_company` int(100) DEFAULT NULL,
  `picture_rh` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rh`
--

INSERT INTO `rh` (`id`, `business_name`, `last_name`, `first_name`, `mail`, `pass`, `id_company`, `picture_rh`) VALUES
(1, 'rgzrv', 'efvefv', 'efvfe', 'tof@h.fr', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 0, ''),
(2, 'LULU', 'PERES', 'CHRISTOPHE', 'xtophe.PERES@gmail.com', 'd659d96d15c7a1206f44eb36ed72495563140859', 0, ''),
(3, 'lo', 'lo', 'lo', 'lo@lo.fr', '638e8f0171575864326f06d2a5f8e72287427b15', 0, ''),
(4, 'cool', 'cool', 'cool', 'cool@cool.fr', '85d8d76ba15bde3ef1602f477f32fd64e32fea5a', 0, ''),
(6, 'x', 'x', 'x', 'x@x.fr', '11f6ad8ec52a2984abaafd7c3b516503785c2072', NULL, NULL),
(7, 'yes', 'yes', 'yes', 'yes@yes.fr', 'fb360f9c09ac8c5edb2f18be5de4e80ea4c430d0', NULL, 'default.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `skill_name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `skills`
--

INSERT INTO `skills` (`id`, `skill_name`) VALUES
(1, 'HTML5'),
(2, 'Bootstrap'),
(3, 'Photoshop'),
(4, 'Illustrator'),
(5, 'Magento'),
(6, 'C++'),
(7, 'SQL'),
(8, 'JQUERY'),
(9, 'XML'),
(10, 'SEO'),
(11, 'CSS3'),
(12, 'Materialize'),
(13, 'CMS'),
(14, 'Graphisme'),
(15, 'After Effects'),
(16, 'UI/UX Design'),
(17, 'Etude de projet'),
(18, 'Ergonomie'),
(19, 'Dessin'),
(20, 'Indesign'),
(21, 'Angular'),
(22, 'Font Awesome'),
(23, 'Angular js'),
(24, 'Symfony'),
(25, 'Django'),
(26, 'Java'),
(27, 'Wordpress'),
(28, 'Prestashop'),
(29, 'PHP'),
(30, 'BDD'),
(31, 'Drupal'),
(32, 'Joomla'),
(33, 'Wordpress'),
(34, 'Mediawiki'),
(35, 'Magnolia'),
(36, 'Concrete5 '),
(37, 'BDD'),
(38, 'Marketing'),
(39, 'PHPMyadmin'),
(40, 'mySQL'),
(41, 'PDO'),
(42, 'MVC'),
(43, 'Python'),
(44, 'Ruby'),
(45, 'Git'),
(46, 'Funnel'),
(47, 'Maquette'),
(48, 'Algorithmique'),
(49, 'Perl'),
(50, 'Réseaux Sociaux'),
(51, 'React');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`id`) REFERENCES `rh` (`id`);

--
-- Contraintes pour la table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`id`) REFERENCES `jobskills` (`id_job`);

--
-- Contraintes pour la table `jobcompany`
--
ALTER TABLE `jobcompany`
  ADD CONSTRAINT `blabla` FOREIGN KEY (`id_job`) REFERENCES `job` (`id`),
  ADD CONSTRAINT `jobcompany_ibfk_1` FOREIGN KEY (`id_company`) REFERENCES `company` (`id`);

--
-- Contraintes pour la table `jobskills`
--
ALTER TABLE `jobskills`
  ADD CONSTRAINT `jobskills_ibfk_1` FOREIGN KEY (`id_skill`) REFERENCES `skills` (`id`);

--
-- Contraintes pour la table `membersskills`
--
ALTER TABLE `membersskills`
  ADD CONSTRAINT `membersskills_ibfk_1` FOREIGN KEY (`id_skills`) REFERENCES `skills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `membersskills_ibfk_2` FOREIGN KEY (`id_members`) REFERENCES `members` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

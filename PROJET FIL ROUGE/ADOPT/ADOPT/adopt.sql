-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  jeu. 27 juin 2019 à 00:13
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `adopte`
--

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE `company` (
  `id` int(10) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_logo` varchar(200) DEFAULT '',
  `siret` bigint(20) NOT NULL,
  `date_creation` date DEFAULT NULL,
  `resume` text,
  `address` varchar(100) DEFAULT '',
  `cp` int(5) DEFAULT NULL,
  `city` varchar(25) DEFAULT '',
  `country` varchar(25) DEFAULT '',
  `mail` varchar(50) DEFAULT '',
  `phone` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `company`
--

INSERT INTO `company` (`id`, `company_name`, `company_logo`, `siret`, `date_creation`, `resume`, `address`, `cp`, `city`, `country`, `mail`, `phone`) VALUES
(1, 'Orange', 'https://c.woopic.com/Icons/logo_orange_200x200.png', 38012986646850, '1988-01-01', 'Société de Réseaux Telecom, Fibre, ADSL, N°1 en France.', '78 RUE OLIVIER DE SERRES', 75015, 'Paris', 'France', 'orange@orange.fr', 387719956),
(2, 'IFA', 'https://www.moovijob.com/events/mjtfrance2013/assets/img/clients/ifa.jpg', 38480937200046, '1992-03-17', 'Découvrez dès à présent une sélection d\'offres de stages et d\'alternance parmi plus de 180 postes à pourvoir ! De la TPE au Grand Groupe, en France et au Luxembourg, pour quelques mois jusqu\'à 2 années, chaque candidat se voit proposer des offres adaptées à sa formation et à son projet professionnel. Candidatez pour en bénéficier !', '4 RUE SAINT CHARLES', 57000, 'Metz', 'France', 'ifa@ifa.fr', 387719988),
(3, 'italia', '', 12345678910121, NULL, NULL, '', NULL, '', '', '', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `job`
--

CREATE TABLE `job` (
  `id` int(10) NOT NULL,
  `job_name` varchar(100) NOT NULL,
  `illustration_job` text,
  `job_sector` varchar(100) NOT NULL,
  `job_infos` text NOT NULL,
  `job_address` varchar(100) NOT NULL,
  `debut_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jobcompany`
--

CREATE TABLE `jobcompany` (
  `id_job` int(10) UNSIGNED NOT NULL,
  `id_company` int(200) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jobskills`
--

CREATE TABLE `jobskills` (
  `id_skill` int(10) NOT NULL,
  `id_job` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int(10) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `pass` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `color` varchar(4) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL,
  `descript` varchar(255) DEFAULT NULL,
  `diploma` varchar(150) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `first_name`, `last_name`, `pass`, `email`, `color`, `avatar`, `descript`, `diploma`, `city`) VALUES
(1, 'Christophe', 'PERES', 'f245e8fdd3a891a5f8e2aaa18e3438d43f2c6e7c', 'fluideglacial@fluideglacial.fr', 'vert', '47.jpg', 'Hello je suis étudiant et je suis un gros connard qui fait chier tout le monde, c\'est pour cela que j\'ai décidé de chercher un stage. Avec moi vous êtes assurer d\'en baver.\r\n', 'Developpeur web et web mobile', 'Uckange'),
(2, 'Fares', 'Qedira', '5f50fab4de1a5cdfbe1ab73a45642884a98b563f', 'fqedira2@gmail.com', NULL, 'default.jpg', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `membersskills`
--

CREATE TABLE `membersskills` (
  `id_members` int(11) NOT NULL,
  `id_skills` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rh`
--

CREATE TABLE `rh` (
  `id` int(10) NOT NULL,
  `id_company` int(100) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `pass` text NOT NULL,
  `avatar` text,
  `descript` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `fonction` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rh`
--

INSERT INTO `rh` (`id`, `id_company`, `last_name`, `first_name`, `mail`, `pass`, `avatar`, `descript`, `city`, `fonction`) VALUES
(1, 2, 'PADILLA', 'Hervé', 'h@h.fr', '7c4a8d09ca3762af61e59520943dc26494f8941b', '33.jpg', 'hhhh hhhhh hhhh hhhhhhh', 'Metz', 'Directeur'),
(2, 1, 'RICHARD', 'Stéphane', 'steph@orange.fr', '7c4a8d09ca3762af61e59520943dc26494f8941b', '31.jpg', 'Stéphane Richard, né le 24 août 1961 à Caudéran, est un haut fonctionnaire et dirigeant d\'entreprise publique français. Il est actuellement président-directeur général d\'Orange.', 'steph@orange.fr', 'PDG'),
(3, 3, 'MANTOANI', 'Lucas', 'lucas@mnt.it', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'default.jpg', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `skills`
--

CREATE TABLE `skills` (
  `id` int(10) NOT NULL,
  `skill_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Index pour les tables déchargées
--

--
-- Index pour la table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jobcompany`
--
ALTER TABLE `jobcompany`
  ADD PRIMARY KEY (`id_job`,`id_company`),
  ADD KEY `id_company` (`id_company`),
  ADD KEY `id_job` (`id_job`);

--
-- Index pour la table `jobskills`
--
ALTER TABLE `jobskills`
  ADD PRIMARY KEY (`id_skill`),
  ADD KEY `id_job` (`id_job`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `membersskills`
--
ALTER TABLE `membersskills`
  ADD UNIQUE KEY `id_members` (`id_members`),
  ADD KEY `membersskills_ibfk_1` (`id_skills`);

--
-- Index pour la table `rh`
--
ALTER TABLE `rh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_company` (`id_company`);

--
-- Index pour la table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `rh`
--
ALTER TABLE `rh`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `jobskills`
--
ALTER TABLE `jobskills`
  ADD CONSTRAINT `jobskills_ibfk_2` FOREIGN KEY (`id_skill`) REFERENCES `skills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `membersskills`
--
ALTER TABLE `membersskills`
  ADD CONSTRAINT `membersskills_ibfk_1` FOREIGN KEY (`id_members`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `membersskills_ibfk_2` FOREIGN KEY (`id_skills`) REFERENCES `skills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `rh`
--
ALTER TABLE `rh`
  ADD CONSTRAINT `rh_ibfk_1` FOREIGN KEY (`id_company`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

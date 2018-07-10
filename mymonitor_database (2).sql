-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 10 juil. 2018 à 22:30
-- Version du serveur :  10.0.32-MariaDB-0+deb8u1
-- Version de PHP :  5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mymonitor_database`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `mail` text NOT NULL,
  `login` text NOT NULL,
  `pass_md5` text NOT NULL,
  `apikey` text NOT NULL,
  `phone` int(11) NOT NULL,
  `token_site` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenom`, `mail`, `login`, `pass_md5`, `apikey`, `phone`, `token_site`) VALUES
(1, 'HAUGUEL', 'Axel', 'axel@dyjix.eu', 'Dyjix', '$2y$10$F5e3dfN97h3PdbbbihOqneFYrcnZaWgs3lMxlPwDm3ZJ8LLLNPbNS', 'null', 0, '25k2g8r3yiq7t3h33ies6ve2');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name_category` text,
  `type` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `id_user`, `name_category`, `type`) VALUES
(3, 1, 'Personnel', 'site'),
(4, 1, 'Professionnel', 'site'),
(6, 1, 'Dyjix', 'server'),
(7, 1, 'Personnel', 'server');

-- --------------------------------------------------------

--
-- Structure de la table `servers`
--

CREATE TABLE `servers` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `IP` text NOT NULL,
  `description` text NOT NULL,
  `user` text NOT NULL,
  `port` int(11) NOT NULL,
  `mail_send` tinyint(1) NOT NULL,
  `apikey` text NOT NULL,
  `phone` int(11) NOT NULL,
  `reponse_time` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `servers`
--

INSERT INTO `servers` (`id`, `nom`, `IP`, `description`, `user`, `port`, `mail_send`, `apikey`, `phone`, `reponse_time`, `category`) VALUES
(5, 'Dyjix site', 'dyjix.eu', 'Site de Dyjix', '1', 443, 0, 'null', 0, 0, 6),
(6, 'Teamspeak', 'ts3.dyjix.eu', 'TS Dyjix', '1', 9987, 1, 'null', 0, 2, 7),
(7, 'Oreox SSH', 'oreox.fr', 'SSH Oreox', '1', 22, 0, 'null', 0, 0, 6);

-- --------------------------------------------------------

--
-- Structure de la table `sites`
--

CREATE TABLE `sites` (
  `id` int(11) NOT NULL,
  `user` varchar(5) DEFAULT NULL,
  `site` text,
  `mail_send` int(11) DEFAULT NULL,
  `code_http` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sites`
--

INSERT INTO `sites` (`id`, `user`, `site`, `mail_send`, `code_http`, `category`) VALUES
(2, '1\r\n', 'axel-hauguel.fr', 0, 200, 3),
(3, '1', 'https://oreox.fr', 0, 200, 3),
(4, '1', 'https://dyjix.eu', 0, 200, 4),
(10, '1', 'http://git.dyjix.eu', 0, 200, 4),
(11, '1', 'http://cloud.hexicans.eu', 1, 0, 3),
(12, '1', 'http://hexicans.eu', 0, 200, 3),
(13, '1', 'https://plesk1.dyjix.eu:8443/', 0, 200, 4),
(14, '1', 'https://vps.dyjix.eu/login.php', 0, 200, 4),
(18, '1', 'http://s.en-prod.org/', 0, 200, 3),
(19, '1', 'http://twitter.oreox.fr', 0, 200, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `servers`
--
ALTER TABLE `servers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

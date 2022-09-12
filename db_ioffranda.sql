-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 18 sep. 2021 à 19:33
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_ioffranda`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `username`, `password`) VALUES
(1, 'Admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `culte`
--

DROP TABLE IF EXISTS `culte`;
CREATE TABLE IF NOT EXISTS `culte` (
  `idCulte` int(11) NOT NULL AUTO_INCREMENT,
  `Culte` varchar(50) NOT NULL,
  `dateCulte` datetime NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idCulte`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `culte`
--

INSERT INTO `culte` (`idCulte`, `Culte`, `dateCulte`, `etat`) VALUES
(1, 'Samedi', '2021-09-18 19:13:48', 1),
(2, 'Mercredi', '2021-09-18 20:58:58', 1);

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `idDemande` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(255) NOT NULL,
  `motifDemande` varchar(150) NOT NULL,
  `dateDemande` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ServiceId` int(11) NOT NULL,
  `demandeExec` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idDemande`),
  KEY `ServiceId` (`ServiceId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`idDemande`, `Description`, `motifDemande`, `dateDemande`, `ServiceId`, `demandeExec`) VALUES
(1, 'Pour aider les gens en situation precaire avec un montant de 3000.', 'Aide', '2021-09-18 19:16:31', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

DROP TABLE IF EXISTS `depense`;
CREATE TABLE IF NOT EXISTS `depense` (
  `idDepense` int(11) NOT NULL AUTO_INCREMENT,
  `destineDepense` varchar(70) NOT NULL,
  `motifDepense` varchar(150) NOT NULL,
  `montantDepense` int(11) NOT NULL,
  `dateDepense` date NOT NULL,
  `DemandeId` int(11) NOT NULL,
  PRIMARY KEY (`idDepense`),
  KEY `DemandeId` (`DemandeId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `depense`
--

INSERT INTO `depense` (`idDepense`, `destineDepense`, `motifDepense`, `montantDepense`, `dateDepense`, `DemandeId`) VALUES
(1, 'Depense courant', 'Aide', 30000, '2021-09-18', 1);

-- --------------------------------------------------------

--
-- Structure de la table `eglise`
--

DROP TABLE IF EXISTS `eglise`;
CREATE TABLE IF NOT EXISTS `eglise` (
  `idEglise` int(11) NOT NULL AUTO_INCREMENT,
  `Eglise` varchar(70) NOT NULL,
  PRIMARY KEY (`idEglise`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `eglise`
--

INSERT INTO `eglise` (`idEglise`, `Eglise`) VALUES
(1, 'REJETON DE DAVID');

-- --------------------------------------------------------

--
-- Structure de la table `offrande`
--

DROP TABLE IF EXISTS `offrande`;
CREATE TABLE IF NOT EXISTS `offrande` (
  `idOffrande` int(11) NOT NULL AUTO_INCREMENT,
  `typeOffrande` varchar(100) NOT NULL,
  `montantOffrande` int(11) NOT NULL,
  `dateOffrande` datetime NOT NULL,
  `CulteId` int(11) NOT NULL,
  `depot` tinyint(1) NOT NULL DEFAULT '0',
  `garder` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idOffrande`),
  KEY `CulteId` (`CulteId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `offrande`
--

INSERT INTO `offrande` (`idOffrande`, `typeOffrande`, `montantOffrande`, `dateOffrande`, `CulteId`, `depot`, `garder`) VALUES
(1, 'Offrande', 30000, '2021-09-18 19:16:31', 1, 1, 1),
(2, 'Offrande', 50000, '2021-09-18 20:58:58', 2, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `rapport`
--

DROP TABLE IF EXISTS `rapport`;
CREATE TABLE IF NOT EXISTS `rapport` (
  `idRapport` int(11) NOT NULL AUTO_INCREMENT,
  `Entree` int(100) NOT NULL DEFAULT '0',
  `Sortie` int(100) NOT NULL DEFAULT '0',
  `Offrande_type` varchar(20) NOT NULL,
  `dateRapport` varchar(20) NOT NULL,
  PRIMARY KEY (`idRapport`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rapport`
--

INSERT INTO `rapport` (`idRapport`, `Entree`, `Sortie`, `Offrande_type`, `dateRapport`) VALUES
(1, 60000, 30000, 'Offrande', '09-2021'),
(2, 50000, 0, 'Offrande', '09-2021');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `idService` int(11) NOT NULL AUTO_INCREMENT,
  `Service` varchar(50) NOT NULL,
  `EgliseId` int(11) NOT NULL,
  PRIMARY KEY (`idService`),
  KEY `EgliseId` (`EgliseId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`idService`, `Service`, `EgliseId`) VALUES
(1, 'FINANCE', 1),
(2, 'TRESORERIE', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `postnom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `sexe` varchar(25) NOT NULL,
  `telephone` varchar(25) NOT NULL,
  `loginUser` varchar(255) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `typeService` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `typeService` (`typeService`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `postnom`, `prenom`, `sexe`, `telephone`, `loginUser`, `motdepasse`, `typeService`) VALUES
(1, 'MASENGO', 'MASENGO', 'RUTH', 'Feminin', '6667', 'RUTH', '7777', 1),
(2, 'MITONGA', 'MITONGA', 'JUDITH', 'Feminin', '66677', 'JUDITH', '4444', 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`ServiceId`) REFERENCES `service` (`idService`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `depense`
--
ALTER TABLE `depense`
  ADD CONSTRAINT `depense_ibfk_1` FOREIGN KEY (`DemandeId`) REFERENCES `demande` (`idDemande`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `offrande`
--
ALTER TABLE `offrande`
  ADD CONSTRAINT `offrande_ibfk_1` FOREIGN KEY (`CulteId`) REFERENCES `culte` (`idCulte`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`EgliseId`) REFERENCES `eglise` (`idEglise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`typeService`) REFERENCES `service` (`idService`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

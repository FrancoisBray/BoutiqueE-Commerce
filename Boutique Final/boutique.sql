-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Dim 23 Mars 2014 à 15:40
-- Version du serveur: 5.6.11-log
-- Version de PHP: 5.4.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `idAdministrateur` char(3) NOT NULL,
  `nom` char(32) NOT NULL,
  `mdp` char(32) NOT NULL,
  PRIMARY KEY (`idAdministrateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`idAdministrateur`, `nom`, `mdp`) VALUES
('1', 'FrancoisBray', '118218');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` char(32) NOT NULL,
  `libelle` char(32) DEFAULT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `libelle`) VALUES
('Modules', 'Modules'),
('Maintenance', 'Maintenance'),
('Pack', 'Pack');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `idCommande` char(32) NOT NULL,
  `dateCommande` date DEFAULT NULL,
  `nomPrenomClient` char(32) DEFAULT NULL,
  `adresseRueClient` char(32) DEFAULT NULL,
  `cpClient` char(5) DEFAULT NULL,
  `villeClient` char(32) DEFAULT NULL,
  `mailClient` char(50) DEFAULT NULL,
  PRIMARY KEY (`idCommande`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`idCommande`, `dateCommande`, `nomPrenomClient`, `adresseRueClient`, `cpClient`, `villeClient`, `mailClient`) VALUES
('1', '2014-03-20', 'gdfgdf', 'dgfgdfg', '75704', 'sdfsdf', 'fsdfs@gege.fr');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE IF NOT EXISTS `contenir` (
  `idCommande` char(32) NOT NULL,
  `idProduit` char(32) NOT NULL,
  `idQuantite` int(11) NOT NULL,
  PRIMARY KEY (`idCommande`,`idProduit`),
  KEY `I_FK_CONTENIR_COMMANDE` (`idCommande`),
  KEY `I_FK_CONTENIR_Produit` (`idProduit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `idProduit` char(32) NOT NULL,
  `description` char(50) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `image` varchar(8000) DEFAULT NULL,
  `idCategorie` char(32) NOT NULL,
  PRIMARY KEY (`idProduit`),
  KEY `I_FK_Produit_CATEGORIE` (`idCategorie`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`idProduit`, `description`, `prix`, `image`, `idCategorie`) VALUES
('19', 'Employé dédié à la création de code Processing', '2341.00', 'images/Modules/processing.jpg', 'Modules'),
('3', 'Employé dédié à la création de code JavaScript', '340.00', 'images/Modules/Java.jpg', 'Modules'),
('2', 'Employé dédié à la création de code jquery', '500.00', 'images/Modules/jQuery.jpg', 'Modules'),
('16', 'Employé dédié à la création de code  bootstrap', '870.00', 'images/Modules/bootstrap.jpg', 'Modules'),
('18', 'Employé dédié à la création de code  Php', '1320.00', 'images/Modules/php.jpg', 'Modules'),
('101', 'Résolution d''un incident', '90.00', 'images/Maintenance/Incident.jpg', 'Maintenance'),
('102', 'Résolution de 2 incidents', '175.00', 'images/Maintenance/Incident.jpg', 'Maintenance'),
('103', 'Résolution de 5 incidents', '430.00', 'images/Maintenance/Incident.jpg', 'Maintenance'),
('104', 'Résolution de 10 incidents', '800.00', 'images/Maintenance/Incident.jpg', 'Maintenance'),
('105', 'Résolution de 25 incidents', '1700.00', 'images/Maintenance/Incident.jpg', 'Maintenance'),
('106', 'Dépannage Hebdomadaire', '700.00', 'images/Pack/depanage.jpg', 'Pack'),
('108', 'Dépannage Annuel', '24000.00', 'images/Pack/depanage.jpg', 'Pack'),
('107', 'Dépannage Mensuel', '2100.00', 'images/Pack/depanage.jpg', 'Pack');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

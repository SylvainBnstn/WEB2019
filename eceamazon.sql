-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 01 mai 2019 à 12:54
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
-- Base de données :  `eceamazon`
--
CREATE DATABASE IF NOT EXISTS `eceamazon` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `eceamazon`;

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

DROP TABLE IF EXISTS `acheteur`;
CREATE TABLE IF NOT EXISTS `acheteur` (
  `Id_acheteur` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  `Pseudo` varchar(255) NOT NULL,
  `Adresse1` varchar(255) NOT NULL,
  `Adresse2` varchar(255) NOT NULL,
  `Ville` varchar(255) NOT NULL,
  `CodePostal` int(11) NOT NULL,
  `Pays` varchar(255) NOT NULL,
  `Num_tel` int(11) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Numero_carte` int(11) NOT NULL,
  `Type_carte` varchar(255) NOT NULL,
  `Nom_carte` varchar(255) NOT NULL,
  `Date_expi` date DEFAULT NULL,
  `Code_secu` int(11) NOT NULL,
  PRIMARY KEY (`Id_acheteur`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acheteur`
--

INSERT INTO `acheteur` (`Id_acheteur`, `Nom`, `Prenom`, `Mdp`, `Pseudo`, `Adresse1`, `Adresse2`, `Ville`, `CodePostal`, `Pays`, `Num_tel`, `Mail`, `Numero_carte`, `Type_carte`, `Nom_carte`, `Date_expi`, `Code_secu`) VALUES
(1, 'Dupont', 'Alfred', 'dupontalf', 'alf', '12 Rue Linois', ' ', 'Paris', 75015, 'France', 678324560, 'dupont.alf@gmail.com', 2147483647, 'Visa', 'Dupont', '0000-00-00', 764),
(2, 'Bilou', 'Claire', 'mdp', 'claire12', '37 Quai de Grenelle', ' ', 'Paris', 75015, 'France', 645321876, 'bilou.claire@orange.fr', 2147483647, 'Visa', 'Bilou', '0000-00-00', 332),
(3, 'Benistand', 'Sylvain', 'benistands', 'SylvainB', '75 Rue Saint Ferrerol', ' ', 'Marseille', 13001, 'France', 765432217, 'benistand.sylavain@gmail.com', 2147483647, 'Master Card', 'Benistand', '0000-00-00', 765),
(4, 'Rathery', 'Amandine', 'mdp', 'Amandine_Rathery', '20 Rue Volta', ' ', 'Puteaux', 92800, 'France', 645632112, 'rathery.amandine@free.fr', 2147483647, 'Maestro', 'Rathery', '0000-00-00', 123),
(5, 'Meunier', 'Helene', 'mdp', 'HeleneM', '11 Rue Sainte Anne', ' ', 'Paris', 75001, 'France', 654321785, 'meunier.helene@gmail.com', 2147483647, 'American Express', 'Meunier', '0000-00-00', 981);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `Id_achat` int(11) NOT NULL AUTO_INCREMENT,
  `Id_produit` int(11) NOT NULL,
  `Id_acheteur` int(11) NOT NULL,
  PRIMARY KEY (`Id_achat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `Id_prouit` int(11) NOT NULL AUTO_INCREMENT,
  `Type` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Prix` int(11) NOT NULL,
  `Video` varchar(255) NOT NULL,
  `Id_vendeur` int(11) NOT NULL,
  `Couleur` varchar(255) NOT NULL,
  `Taille` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_prouit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `Id_vendeur` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Pseudo` varchar(255) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Type` int(11) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_vendeur`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`Id_vendeur`, `Nom`, `Prenom`, `Pseudo`, `Photo`, `Type`, `Mail`, `Mdp`) VALUES
(1, 'Pollux', 'Richard', 'Richard_Pollux', 'richard.jpeg', 1, 'richard.pollux@gmail.com', 'test'),
(2, 'Zola', 'Maria', 'MariaZ', 'maria.jpeg', 2, 'maria.zola@gmail.com', 'mdptest'),
(3, 'Simon', 'Simon', 'Simsim', 'simon.jpeg', 1, 'simon@gmail.com', 'motdepasse');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

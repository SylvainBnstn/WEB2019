-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 04, 2019 at 10:50 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eceamazon`
--
CREATE DATABASE IF NOT EXISTS `eceamazon` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `eceamazon`;

-- --------------------------------------------------------

--
-- Table structure for table `acheteur`
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
  `Numero_carte` int(18) NOT NULL,
  `Type_carte` varchar(255) NOT NULL,
  `Nom_carte` varchar(255) NOT NULL,
  `Date_expi` date DEFAULT NULL,
  `Code_secu` int(11) NOT NULL,
  PRIMARY KEY (`Id_acheteur`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acheteur`
--

INSERT INTO `acheteur` (`Id_acheteur`, `Nom`, `Prenom`, `Mdp`, `Pseudo`, `Adresse1`, `Adresse2`, `Ville`, `CodePostal`, `Pays`, `Num_tel`, `Mail`, `Numero_carte`, `Type_carte`, `Nom_carte`, `Date_expi`, `Code_secu`) VALUES
(1, 'Dupont', 'Alfred', 'dupontalf', 'alf', '12 Rue Linois', ' ', 'Paris', 75015, 'France', 678324560, 'dupont.alf@gmail.com', 2147483647, 'Visa', 'Dupont', '0000-00-00', 764),
(2, 'Bilou', 'Claire', 'mdp', 'claire12', '37 Quai de Grenelle', ' ', 'Paris', 75015, 'France', 645321876, 'bilou.claire@orange.fr', 2147483647, 'Visa', 'Bilou', '0000-00-00', 332),
(3, 'Benistand', 'Sylvain', 'benistands', 'SylvainB', '75 Rue Saint Ferrerol', ' ', 'Marseille', 13001, 'France', 765432217, 'benistand.sylavain@gmail.com', 2147483647, 'Master Card', 'Benistand', '0000-00-00', 765),
(4, 'Rathery', 'Amandine', 'mdp', 'Amandine_Rathery', '20 Rue Volta', ' ', 'Puteaux', 92800, 'France', 645632112, 'rathery.amandine@free.fr', 2147483647, 'Maestro', 'Rathery', '0000-00-00', 123),
(5, 'Meunier', 'Helene', 'mdp', 'HeleneM', '11 Rue Sainte Anne', ' ', 'Paris', 75001, 'France', 654321785, 'meunier.helene@gmail.com', 2147483647, 'American Express', 'Meunier', '0000-00-00', 981);

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `Id_achat` int(11) NOT NULL AUTO_INCREMENT,
  `Id_produit` int(11) NOT NULL,
  `Id_acheteur` int(11) NOT NULL,
  `Etat_transac` int(11) NOT NULL,
  PRIMARY KEY (`Id_achat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `Id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `Type` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Prix` int(11) NOT NULL,
  `Video` varchar(400) NOT NULL,
  `Id_vendeur` int(11) NOT NULL,
  `Couleur` varchar(255) NOT NULL,
  `Taille` varchar(255) NOT NULL,
  `Stock` int(11) NOT NULL,
  PRIMARY KEY (`Id_produit`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`Id_produit`, `Type`, `Nom`, `Photo`, `Description`, `Prix`, `Video`, `Id_vendeur`, `Couleur`, `Taille`, `Stock`) VALUES
(1, 4, 'Sac rouge', 'sacrouge.jpg', 'Ce sac en cuir rouge vous accompagnera partout. ', 120, ' ', 1, 'rouge', 'Taille unique', 10),
(2, 4, 'Robe', 'robe.jpg', 'Robe rouge en coton', 70, '', 2, 'Vert', 'M', 3),
(3, 4, ' Robe en soie', 'robeverte.jpg', 'Robe longue en soie verte ', 200, ' ', 1, 'rouge', 'Taille unique', 5),
(4, 1, 'La Metamorphose de Franz Kafka', 'La-Metamorphose.jpg', 'Un matin, Gregor Samsa se reveille. Il est transforme en un monstrueux insecte.', 5, ' ', 2, '', '', 10),
(5, 1, 'Le Rouge et le Noir de Stendhal ', 'lerougeetlenoir.jpg', 'Un roman en deux parties relatant la vie et le parcours de Julien Sorel jusqu a son arrivee a Paris', 6, ' ', 1, '', '', 15),
(6, 1, 'La Promesse de l Aube de Romain Gary', 'lapromessedelaube.jpg', 'Roman autobiographique de Romain Gary traitant en particulier de sa relation avec sa mere durant sa jeunessse, son adolescence et la guerre.', 9, ' ', 1, '', '', 20),
(7, 1, 'L ecume des jours de Boris Vian', 'lecumedesjours.jpg', 'Chloe, la femme de Colin, tombe malade : un nenuphar pousse dans son poumon droit.', 7, ' ', 2, '', '', 20),
(8, 2, 'Lot de raquette de ping pong', 'pingpong.jpg', 'Utile pour jouer au ping pong', 8, '', 1, '', '', 5),
(9, 2, 'Pinata Peppa pig', 'peppa.jpg', 'Grande pinata sur le theme de Peppa pig : 70x70 cm', 30, '', 3, '', '', 15),
(10, 2, 'Pinata ', 'pinata.jpg', 'Pinata basique pour l anniversaire d un enfant. 70x30 cm', 20, '', 3, '', '', 25),
(11, 3, 'Album AM  - Arctic Monkeys ', 'articmonkeys.jpg', 'Le cinquieme album du groupe', 10, 'https://www.youtube.com/embed/ngzC_8zqInk', 1, '', '', 7),
(12, 3, 'Album The Dark Side of the Moon - Pink Floyd', 'pinkfloyd.jpg', 'Le huitieme et aussi le plus connu album de pink floyd', 12, 'https://www.youtube.com/embed/BbeavlJEYrk', 1, '', '', 10),
(13, 3, 'Album When we all fall asleep, where do we go ? -  Billie Eilish ', 'billie.jpg', 'Le dernier album de Billie Eilsh ', 13, 'https://www.youtube.com/embed/Ah0Ys50CqO8', 1, '', '', 20),
(14, 3, 'Album Doo-Woops et Hooligans - Bruno Mars', 'bruno.jpg', 'Premier album de Bruno Mars sorti en 2010', 9, 'https://www.youtube.com/embed/fLexgOxsZu0', 1, '', '', 8);

-- --------------------------------------------------------

--
-- Table structure for table `vendeur`
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
  `Photo_fond` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_vendeur`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendeur`
--

INSERT INTO `vendeur` (`Id_vendeur`, `Nom`, `Prenom`, `Pseudo`, `Photo`, `Type`, `Mail`, `Mdp`, `Photo_fond`) VALUES
(1, 'Pollux', 'Richard', 'Richard_Pollux', 'richard.jpeg', 1, 'richard.pollux@gmail.com', 'test', 'bleu.png'),
(2, 'Zola', 'Maria', 'MariaZ', 'maria.jpeg', 2, 'maria.zola@gmail.com', 'mdptest', 'marbre.jpeg'),
(3, 'Simon', 'Simon', 'Simsim', 'simon.jpeg', 1, 'simon@gmail.com', 'motdepasse', 'violet.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

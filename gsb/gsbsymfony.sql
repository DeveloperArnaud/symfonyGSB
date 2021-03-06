-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 01 avr. 2019 à 06:25
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gsbsymfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `comptable`
--

DROP TABLE IF EXISTS `comptable`;
CREATE TABLE IF NOT EXISTS `comptable` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMCOMPTABLE` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PRENOMCOMPTABLE` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LOGINCOMPTABLE` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MDPCOMPTABLE` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `ID` varchar(4) NOT NULL,
  `LIBELLE` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`ID`, `LIBELLE`) VALUES
('1', 'Saisie clôturée'),
('2', 'Fiche créée, saisie en cours'),
('3', 'Remboursée'),
('4', 'Validée et mise en paiement');

-- --------------------------------------------------------

--
-- Structure de la table `fichefrais`
--

DROP TABLE IF EXISTS `fichefrais`;
CREATE TABLE IF NOT EXISTS `fichefrais` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ETRE2` smallint(6) NOT NULL,
  `ID_DECLARER` varchar(128) NOT NULL,
  `MOIS` varchar(6) DEFAULT NULL,
  `NBJUSTIFICATIFS` int(11) DEFAULT NULL,
  `MONTANTVALIDE` decimal(10,2) DEFAULT NULL,
  `DATEMODIF` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `I_FK_FICHEFRAIS_ETAT` (`ID_ETRE2`),
  KEY `I_FK_FICHEFRAIS_VISITEUR` (`ID_DECLARER`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fichefrais`
--

INSERT INTO `fichefrais` (`ID`, `ID_ETRE2`, `ID_DECLARER`, `MOIS`, `NBJUSTIFICATIFS`, `MONTANTVALIDE`, `DATEMODIF`) VALUES
(1, 0, 'a17', '201903', 1, '0.00', '2019-03-20'),
(2, 0, 'b16', '201903', 1, '0.00', '2019-03-20'),
(3, 0, 'a93', '201903', 1, '0.00', '2019-03-28');

-- --------------------------------------------------------

--
-- Structure de la table `fraisforfait`
--

DROP TABLE IF EXISTS `fraisforfait`;
CREATE TABLE IF NOT EXISTS `fraisforfait` (
  `ID` varchar(128) NOT NULL,
  `LIBELLE` varchar(255) DEFAULT NULL,
  `MONTANT` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fraisforfait`
--

INSERT INTO `fraisforfait` (`ID`, `LIBELLE`, `MONTANT`) VALUES
('ETP', 'Forfait Etape', '110.00'),
('KM', 'Frais Kilométrique', '0.62'),
('NUI', 'Nuitée Hôtel', '80.00'),
('REP', 'Repas Restaurant', '25.00');

-- --------------------------------------------------------

--
-- Structure de la table `lignefraisforfait`
--

DROP TABLE IF EXISTS `lignefraisforfait`;
CREATE TABLE IF NOT EXISTS `lignefraisforfait` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `ID_CONCERNER` varchar(128) NOT NULL,
  `ID_ETRE` smallint(6) NOT NULL,
  `QUANTITE` bigint(4) DEFAULT NULL,
  `DATEMODIFICATION` date DEFAULT NULL,
  `idVisiteur` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `I_FK_LIGNEFRAISFORFAIT_FRAISFORFAIT` (`ID_CONCERNER`),
  KEY `I_FK_LIGNEFRAISFORFAIT_ETAT` (`ID_ETRE`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lignefraisforfait`
--

INSERT INTO `lignefraisforfait` (`ID`, `ID_CONCERNER`, `ID_ETRE`, `QUANTITE`, `DATEMODIFICATION`, `idVisiteur`) VALUES
(1, 'ETP', 0, 13, '2019-03-20', 'a17'),
(2, 'KM', 0, 14, '2019-03-20', 'a17'),
(3, 'NUI', 0, 12, '2019-03-20', 'a17'),
(4, 'REP', 0, 12, '2019-03-20', 'a17'),
(5, 'ETP', 0, 15, '2019-03-20', 'b16'),
(6, 'KM', 0, 16, '2019-03-20', 'b16'),
(7, 'NUI', 0, 19, '2019-03-20', 'b16'),
(8, 'REP', 0, 30, '2019-03-20', 'b16'),
(32, 'REP', 0, 4, '2019-03-29', 'a93'),
(31, 'NUI', 0, 3, '2019-03-29', 'a93'),
(30, 'KM', 0, 2, '2019-03-29', 'a93'),
(29, 'ETP', 0, 12, '2019-03-29', 'a93');

-- --------------------------------------------------------

--
-- Structure de la table `lignefraishorsforfait`
--

DROP TABLE IF EXISTS `lignefraishorsforfait`;
CREATE TABLE IF NOT EXISTS `lignefraishorsforfait` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(128) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `MONTANT` decimal(10,2) DEFAULT NULL,
  `DATEMODIF` date DEFAULT NULL,
  `idVisiteur` varchar(128) NOT NULL,
  `idFichefrais` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lignefraishorsforfait`
--

INSERT INTO `lignefraishorsforfait` (`ID`, `LIBELLE`, `DATE`, `MONTANT`, `DATEMODIF`, `idVisiteur`, `idFichefrais`) VALUES
(5, 'Test', '2018-12-12', '123.00', '2019-03-28', 'a17', '1'),
(3, 'JK', '2019-02-13', '132.00', '2019-03-20', 'b16', '2'),
(6, 'Test1', '2018-12-12', '134.00', '2019-03-28', 'a17', '1'),
(7, 'Test2', '2018-02-13', '153.00', '2019-03-28', 'a17', '1'),
(8, 'Test', '2019-03-12', '125.00', '2019-03-29', 'a93', '3');

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

DROP TABLE IF EXISTS `visiteur`;
CREATE TABLE IF NOT EXISTS `visiteur` (
  `ID` varchar(128) NOT NULL,
  `NOMVISITEUR` varchar(128) DEFAULT NULL,
  `PRENOMVISITEUR` varchar(128) DEFAULT NULL,
  `LOGINVISITEUR` varchar(128) DEFAULT NULL,
  `MDPVISITEUR` varchar(128) DEFAULT NULL,
  `ADRVISITEUR` varchar(128) DEFAULT NULL,
  `CPVISITEUR` varchar(5) DEFAULT NULL,
  `VILLEVISITEUR` varchar(128) DEFAULT NULL,
  `DATEEMBAUCHE` date DEFAULT NULL,
  `comptable` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `visiteur`
--

INSERT INTO `visiteur` (`ID`, `NOMVISITEUR`, `PRENOMVISITEUR`, `LOGINVISITEUR`, `MDPVISITEUR`, `ADRVISITEUR`, `CPVISITEUR`, `VILLEVISITEUR`, `DATEEMBAUCHE`, `comptable`) VALUES
('a131', 'Coquerelle', 'Arnaud', 'nono', '9cf95dacd226dcf43da376cdb6cbba7035218921', '8 rue des Charmes', '46000', 'Cahors', '2002-12-21', 1),
('a17', 'Andre', 'David', 'dandre', '37f2381c9a729782c38410b1ea5b8191', '1 rue Petit', '46200', 'Lalbenque', '1998-11-23', 0),
('a55', 'Jobard', 'Maxime', 'lelilel', '7f12f36ced4c7ae47d4320a0c8ed36dde3b0dea0', '1 rue Peranud', '46250', 'Montcuq', '1995-01-12', 1),
('a93', 'Tusseau', 'Louis', 'ltusseau', 'ab4f63f9ac65152575886860dde480a1', '22 rue des Ternes', '46123', 'Gramat', '2000-05-01', 0),
('b13', 'Bentot', 'Pascal', 'pbentot', '178e1efaf000fdf2267edc43fad2a65197a0ab10', '11 allée des Cerises', '46512', 'Bessines', '1992-07-09', 0),
('b16', 'Bioret', 'Luc', 'lbioret', 'ab4f63f9ac65152575886860dde480a1', '1 Avenue gambetta', '46000', 'Cahors', '1998-05-11', 0),
('b19', 'Bunisset', 'Francis', 'fbunisset', 'aa710ca3a1f12234bc2872aa0a6f88d6cf896ae4', '10 rue des Perles', '93100', 'Montreuil', '1987-10-21', 0),
('b25', 'Bunisset', 'Denise', 'dbunisset', '40ff56dc0525aa08de29eba96271997a91e7d405', '23 rue Manin', '75019', 'paris', '2010-12-05', 0),
('b28', 'Cacheux', 'Bernard', 'bcacheux', '51a4fac4890def1ef8605f0b2e6554c86b2eb919', '114 rue Blanche', '75017', 'Paris', '2009-11-12', 0),
('b34', 'Cadic', 'Eric', 'ecadic', '2ed5ee95d2588be3650a935ff7687dee46d70fc8', '123 avenue de la République', '75011', 'Paris', '2008-09-23', 0),
('b4', 'Charoze', 'Catherine', 'ccharoze', '8b16cf71ab0842bd871bce99a1ba61dd7e9d4423', '100 rue Petit', '75019', 'Paris', '2005-11-12', 0),
('b50', 'Clepkens', 'Christophe', 'cclepkens', '7ddda57eca7a823c85ac0441adf56928b47ece76', '12 allée des Anges', '93230', 'Romainville', '2003-08-11', 0),
('b59', 'Cottin', 'Vincenne', 'vcottin', '2f95d1cac7b8e7459376bf36b93ae7333026282d', '36 rue Des Roches', '93100', 'Monteuil', '2001-11-18', 0),
('c14', 'Daburon', 'François', 'fdaburon', '5c7cc4a7f0123460c29c84d8f8a73bc86184adbb', '13 rue de Chanzy', '94000', 'Créteil', '2002-02-11', 0),
('c3', 'De', 'Philippe', 'pde', '03b03872dd570959311f4fb9be01788e4d1a2abf', '13 rue Barthes', '94000', 'Créteil', '2010-12-14', 0),
('c54', 'Debelle', 'Michel', 'mdebelle', '1fa95c2fac5b14c6386b73cbe958b663fc66fdfa', '181 avenue Barbusse', '93210', 'Rosny', '2006-11-23', 0),
('d13', 'Debelle', 'Jeanne', 'jdebelle', '18c2cad6adb7cee7884f70108cfd0a9b448be9be', '134 allée des Joncs', '44000', 'Nantes', '2000-05-11', 0),
('d51', 'Debroise', 'Michel', 'mdebroise', '46b609fe3aaa708f5606469b5bc1c0fa85010d76', '2 Bld Jourdain', '44000', 'Nantes', '2001-04-17', 0),
('e22', 'Desmarquest', 'Nathalie', 'ndesmarquest', 'abc20ea01dabd079ddd63fd9006e7232e442973c', '14 Place d Arc', '45000', 'Orléans', '2005-11-12', 0),
('e24', 'Desnost', 'Pierre', 'pdesnost', '8eaa8011ec8aa8baa63231a21d12f4138ccc1a3d', '16 avenue des Cèdres', '23200', 'Guéret', '2001-02-05', 0),
('e39', 'Dudouit', 'Frédéric', 'fdudouit', '55072fa16c988da8f1fb31e40e4ac5f325ac145d', '18 rue de l église', '23120', 'GrandBourg', '2000-08-01', 0),
('e49', 'Duncombe', 'Claude', 'cduncombe', '577576f0b2c56c43b596f701b782870c8742c592', '19 rue de la tour', '23100', 'La souteraine', '1987-10-10', 0),
('e5', 'Enault-Pascreau', 'Céline', 'cenault', 'cc0fb4115bb04c613fd1b95f4792fc44f07e9f4f', '25 place de la gare', '23200', 'Gueret', '1995-09-01', 0),
('e52', 'Eynde', 'Valérie', 'veynde', 'd06ace8d729693904c304625e6a6fab6ab9e9746', '3 Grand Place', '13015', 'Marseille', '1999-11-01', 0),
('f21', 'Finck', 'Jacques', 'jfinck', '6d8b2060b60132d9bdb09d37913fbef637b295f2', '10 avenue du Prado', '13002', 'Marseille', '2001-11-10', 0),
('f39', 'Frémont', 'Fernande', 'ffremont', 'aa45efe9ecbf37db0089beeedea62ceb57db7f17', '4 route de la mer', '13012', 'Allauh', '1998-10-01', 0),
('f4', 'Gest', 'Alain', 'agest', '1af7dedacbbe8ce324e316429a816daeff4c542f', '30 avenue de la mer', '13025', 'Berre', '1985-11-01', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

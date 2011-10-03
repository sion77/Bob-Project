-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 03 Octobre 2011 à 06:32
-- Version du serveur: 5.5.8
-- Version de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `projet_bob`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `idAdmin` int(11) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `idCat` int(11) NOT NULL,
  `descriptionCat` text NOT NULL,
  `nomCat` varchar(255) NOT NULL,
  `idParent` int(11) DEFAULT NULL COMMENT 'sous categorie',
  PRIMARY KEY (`idCat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ciblepub`
--

CREATE TABLE IF NOT EXISTS `ciblepub` (
  `idCible` int(11) NOT NULL COMMENT 'prod/cat',
  PRIMARY KEY (`idCible`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `comporep`
--

CREATE TABLE IF NOT EXISTS `comporep` (
  `idEval` int(11) NOT NULL,
  `idReponse` int(11) NOT NULL,
  PRIMARY KEY (`idEval`,`idReponse`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `evalproduit`
--

CREATE TABLE IF NOT EXISTS `evalproduit` (
  `idUtilisateur` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `idEval` int(11) NOT NULL,
  PRIMARY KEY (`idUtilisateur`,`idProduit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

CREATE TABLE IF NOT EXISTS `evaluation` (
  `idEval` int(11) NOT NULL AUTO_INCREMENT,
  `dateEval` date NOT NULL,
  `noteEval` int(11) NOT NULL,
  `commentaireEval` text NOT NULL,
  PRIMARY KEY (`idEval`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `individu`
--

CREATE TABLE IF NOT EXISTS `individu` (
  `numIndividu` int(11) NOT NULL,
  `nomIndividu` varchar(20) NOT NULL,
  `prenomIndividu` varchar(20) NOT NULL,
  `adresseIndividu` text NOT NULL,
  `telephoneIndividu` int(11) NOT NULL,
  PRIMARY KEY (`numIndividu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `idProd` int(11) NOT NULL,
  `nomProd` varchar(255) NOT NULL,
  `libelle` text NOT NULL,
  `imageProd` blob NOT NULL,
  `stockProd` int(11) NOT NULL,
  `nbVentesProd` int(11) NOT NULL,
  `nbLocProd` int(11) NOT NULL,
  `prixProdVente` int(11) NOT NULL,
  `prixProdLoc` int(11) NOT NULL,
  `idCatProd` int(11) NOT NULL,
  PRIMARY KEY (`idProd`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `publicite`
--

CREATE TABLE IF NOT EXISTS `publicite` (
  `idPub` int(11) NOT NULL AUTO_INCREMENT,
  `idCible` int(11) NOT NULL,
  `offrePub` text NOT NULL,
  `imgPub` blob NOT NULL,
  PRIMARY KEY (`idPub`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `idRep` int(11) NOT NULL AUTO_INCREMENT,
  `idAdmin` int(11) NOT NULL,
  `reponse` text NOT NULL,
  `dateRep` date NOT NULL,
  PRIMARY KEY (`idRep`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `passUtilisateur` varchar(255) NOT NULL,
  `mailUtilisateur` varchar(255) NOT NULL,
  `pseudoUtilisateur` varchar(255) NOT NULL,
  `adresseUtilisateur` varchar(255) NOT NULL,
  `cpUtilisateur` int(11) NOT NULL,
  `villeUtilisateur` varchar(255) NOT NULL,
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

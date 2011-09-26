-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 26, 2011 at 07:10 AM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bobbdd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `idAdmin` int(11) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--


-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `idCat` int(11) NOT NULL,
  `descriptionCat` text NOT NULL,
  `nomCat` varchar(255) NOT NULL,
  `idParent` int(11) DEFAULT NULL COMMENT 'sous categorie',
  PRIMARY KEY (`idCat`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`idCat`, `descriptionCat`, `nomCat`, `idParent`) VALUES
(1, 'Retrouvez ici tous nos outils utiles pour le jardinage', 'Jardin', NULL),
(2, 'Les meilleurs rateaux de tous les temps', 'Rateaux', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ciblepub`
--

CREATE TABLE IF NOT EXISTS `ciblepub` (
  `idCible` int(11) NOT NULL COMMENT 'prod/cat',
  PRIMARY KEY (`idCible`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ciblepub`
--


-- --------------------------------------------------------

--
-- Table structure for table `comporep`
--

CREATE TABLE IF NOT EXISTS `comporep` (
  `idEval` int(11) NOT NULL,
  `idReponse` int(11) NOT NULL,
  PRIMARY KEY (`idEval`,`idReponse`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comporep`
--


-- --------------------------------------------------------

--
-- Table structure for table `evalproduit`
--

CREATE TABLE IF NOT EXISTS `evalproduit` (
  `idUtilisateur` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `idEval` int(11) NOT NULL,
  PRIMARY KEY (`idUtilisateur`,`idProduit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evalproduit`
--


-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE IF NOT EXISTS `evaluation` (
  `idEval` int(11) NOT NULL AUTO_INCREMENT,
  `dateEval` date NOT NULL,
  `noteEval` int(11) NOT NULL,
  `commentaireEval` text NOT NULL,
  PRIMARY KEY (`idEval`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `evaluation`
--


-- --------------------------------------------------------

--
-- Table structure for table `produit`
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

--
-- Dumping data for table `produit`
--


-- --------------------------------------------------------

--
-- Table structure for table `publicite`
--

CREATE TABLE IF NOT EXISTS `publicite` (
  `idPub` int(11) NOT NULL AUTO_INCREMENT,
  `idCible` int(11) NOT NULL,
  `offrePub` text NOT NULL,
  `imgPub` blob NOT NULL,
  PRIMARY KEY (`idPub`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `publicite`
--


-- --------------------------------------------------------

--
-- Table structure for table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `idRep` int(11) NOT NULL AUTO_INCREMENT,
  `idAdmin` int(11) NOT NULL,
  `reponse` text NOT NULL,
  `dateRep` date NOT NULL,
  PRIMARY KEY (`idRep`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `reponse`
--


-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `utilisateur`
--


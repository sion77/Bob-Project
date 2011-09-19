-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 19 Septembre 2011 à 09:23
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

--
-- Contenu de la table `individu`
--


-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `numMembre` int(11) NOT NULL AUTO_INCREMENT,
  `pseudoMembre` varchar(50) NOT NULL,
  `passMembre` varchar(50) NOT NULL,
  PRIMARY KEY (`numMembre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `membres`
--


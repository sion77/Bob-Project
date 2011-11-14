SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `projet_bob` DEFAULT CHARACTER SET utf8 ;
USE `projet_bob` ;

-- -----------------------------------------------------
-- Table `projet_bob`.`individu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_bob`.`individu` ;

CREATE  TABLE IF NOT EXISTS `projet_bob`.`individu` (
  `numIndividu` INT(11) NOT NULL ,
  `nomIndividu` VARCHAR(20) NOT NULL ,
  `prenomIndividu` VARCHAR(20) NOT NULL ,
  `adresseIndividu` TEXT NOT NULL ,
  `telephoneIndividu` INT(11) NOT NULL ,
  PRIMARY KEY (`numIndividu`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `projet_bob`.`utilisateur`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_bob`.`utilisateur` ;

CREATE  TABLE IF NOT EXISTS `projet_bob`.`utilisateur` (
  `idUtilisateur` INT(11) NOT NULL AUTO_INCREMENT ,
  `pseudoUtilisateur` VARCHAR(255) NOT NULL ,
  `passUtilisateur` VARCHAR(255) NOT NULL ,
  `mailUtilisateur` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`idUtilisateur`) ,
  UNIQUE INDEX `pseudoUtilisateur_UNIQUE` (`pseudoUtilisateur` ASC) ,
  CONSTRAINT `fk_utilisateur_individu`
    FOREIGN KEY (`idUtilisateur` )
    REFERENCES `projet_bob`.`individu` (`numIndividu` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `projet_bob`.`admin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_bob`.`admin` ;

CREATE  TABLE IF NOT EXISTS `projet_bob`.`admin` (
  `idAdmin` INT(11) NOT NULL ,
  INDEX `fk_admin_utilisateur` (`idAdmin` ASC),
  PRIMARY KEY (`idAdmin`),
  CONSTRAINT `fk_admin_utilisateur`
    FOREIGN KEY (`idAdmin` )
    REFERENCES `projet_bob`.`utilisateur` (`idUtilisateur` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `projet_bob`.`categorie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_bob`.`categorie` ;

CREATE  TABLE IF NOT EXISTS `projet_bob`.`categorie` (
  `idCat` INT(11) NOT NULL AUTO_INCREMENT ,
  `descriptionCat` TEXT NOT NULL ,
  `nomCat` VARCHAR(255) NOT NULL ,
  `idParent` INT(11) NULL DEFAULT NULL COMMENT 'sous categorie' ,
  PRIMARY KEY (`idCat`) ,
  INDEX `fk_categorie_categorie1` (`idParent` ASC) ,
  CONSTRAINT `fk_categorie_categorie1`
    FOREIGN KEY (`idParent` )
    REFERENCES `projet_bob`.`categorie` (`idCat` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `projet_bob`.`image`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_bob`.`image` ;

CREATE  TABLE IF NOT EXISTS `projet_bob`.`image` (
  `idImage` INT NOT NULL ,
  `image` BLOB NULL ,
  `titre` VARCHAR(45) NOT NULL ,
  `legende` TEXT NULL ,
  `taille` INT NOT NULL,
  `type` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`idImage`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projet_bob`.`produit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_bob`.`produit` ;

CREATE  TABLE IF NOT EXISTS `projet_bob`.`produit` (
  `idProd` INT(11) NOT NULL ,
  `nomProd` VARCHAR(255) NOT NULL ,
  `libelle` TEXT NOT NULL ,
  `imageProd` INT NOT NULL ,
  `stockProd` INT(11) NOT NULL ,
  `nbVentesProd` INT(11) NOT NULL ,
  `nbLocProd` INT(11) NOT NULL ,
  `prixProdVente` INT(11) NOT NULL ,
  `prixProdLoc` INT(11) NOT NULL ,
  `idCatProd` INT(11) NOT NULL ,
  PRIMARY KEY (`idProd`) ,
  INDEX `fk_produit_categorie1` (`idCatProd` ASC) ,
  INDEX `fk_produit_image` (`imageProd` ASC) ,
  CONSTRAINT `fk_produit_categorie1`
    FOREIGN KEY (`idCatProd` )
    REFERENCES `projet_bob`.`categorie` (`idCat` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produit_image`
    FOREIGN KEY (`imageProd` )
    REFERENCES `projet_bob`.`image` (`idImage` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `projet_bob`.`ciblepub`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_bob`.`ciblepub` ;

CREATE  TABLE IF NOT EXISTS `projet_bob`.`ciblepub` (
  `idCible` INT(11) NOT NULL COMMENT 'prod/cat' ,
  PRIMARY KEY (`idCible`) ,
  INDEX `fk_cible_prod` (`idCible` ASC) ,
  INDEX `fk_cible_cat` (`idCible` ASC) ,
  CONSTRAINT `fk_cible_prod`
    FOREIGN KEY (`idCible` )
    REFERENCES `projet_bob`.`produit` (`idProd` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cible_cat`
    FOREIGN KEY (`idCible` )
    REFERENCES `projet_bob`.`categorie` (`idCat` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `projet_bob`.`evaluation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_bob`.`evaluation` ;

CREATE  TABLE IF NOT EXISTS `projet_bob`.`evaluation` (
  `idEval` INT(11) NOT NULL AUTO_INCREMENT ,
  `dateEval` DATE NOT NULL ,
  `noteEval` INT(11) NOT NULL ,
  `commentaireEval` TEXT NOT NULL ,
  PRIMARY KEY (`idEval`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `projet_bob`.`reponse`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_bob`.`reponse` ;

CREATE  TABLE IF NOT EXISTS `projet_bob`.`reponse` (
  `idRep` INT(11) NOT NULL AUTO_INCREMENT ,
  `idAdmin` INT(11) NOT NULL ,
  `reponse` TEXT NOT NULL ,
  `dateRep` DATE NOT NULL ,
  PRIMARY KEY (`idRep`) ,
  INDEX `fk_reponse_admin1` (`idAdmin` ASC) ,
  CONSTRAINT `fk_reponse_admin1`
    FOREIGN KEY (`idAdmin` )
    REFERENCES `projet_bob`.`admin` (`idAdmin` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `projet_bob`.`comporep`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_bob`.`comporep` ;

CREATE  TABLE IF NOT EXISTS `projet_bob`.`comporep` (
  `idEval` INT(11) NOT NULL ,
  `idReponse` INT(11) NOT NULL ,
  PRIMARY KEY (`idEval`, `idReponse`) ,
  INDEX `fk_comporep_evaluation1` (`idEval` ASC) ,
  INDEX `fk_comporep_reponse1` (`idReponse` ASC) ,
  CONSTRAINT `fk_comporep_evaluation1`
    FOREIGN KEY (`idEval` )
    REFERENCES `projet_bob`.`evaluation` (`idEval` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comporep_reponse1`
    FOREIGN KEY (`idReponse` )
    REFERENCES `projet_bob`.`reponse` (`idRep` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `projet_bob`.`evalproduit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_bob`.`evalproduit` ;

CREATE  TABLE IF NOT EXISTS `projet_bob`.`evalproduit` (
  `idUtilisateur` INT(11) NOT NULL ,
  `idProduit` INT(11) NOT NULL ,
  `idEval` INT(11) NOT NULL ,
  PRIMARY KEY (`idUtilisateur`, `idProduit`) ,
  INDEX `fk_evalproduit_utilisateur1` (`idUtilisateur` ASC) ,
  INDEX `fk_evalproduit_produit1` (`idProduit` ASC) ,
  INDEX `fk_evalproduit_evaluation1` (`idEval` ASC) ,
  CONSTRAINT `fk_evalproduit_utilisateur1`
    FOREIGN KEY (`idUtilisateur` )
    REFERENCES `projet_bob`.`utilisateur` (`idUtilisateur` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_evalproduit_produit1`
    FOREIGN KEY (`idProduit` )
    REFERENCES `projet_bob`.`produit` (`idProd` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_evalproduit_evaluation1`
    FOREIGN KEY (`idEval` )
    REFERENCES `projet_bob`.`evaluation` (`idEval` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `projet_bob`.`publicite`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_bob`.`publicite` ;

CREATE  TABLE IF NOT EXISTS `projet_bob`.`publicite` (
  `idPub` INT(11) NOT NULL AUTO_INCREMENT ,
  `idCible` INT(11) NOT NULL ,
  `offrePub` TEXT NOT NULL ,
  `imgPub` INT NOT NULL ,
  PRIMARY KEY (`idPub`) ,
  INDEX `fk_pub_cible` (`idCible` ASC) ,
  INDEX `fk_pub_image` (`imgPub` ASC) ,
  CONSTRAINT `fk_pub_cible`
    FOREIGN KEY (`idCible` )
    REFERENCES `projet_bob`.`ciblepub` (`idCible` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pub_image`
    FOREIGN KEY (`imgPub` )
    REFERENCES `projet_bob`.`image` (`idImage` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

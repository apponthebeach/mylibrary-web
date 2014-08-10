SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `book` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `book` ;

-- -----------------------------------------------------
-- Table `book`.`GENRE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `book`.`GENRE` (
  `GEN_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `GEN_LIBELLE` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`GEN_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `book`.`AUTEUR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `book`.`AUTEUR` (
  `AUT_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `AUT_NOM` VARCHAR(255) NOT NULL,
  `AUT_PRENOM` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`AUT_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `book`.`LIVRE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `book`.`LIVRE` (
  `LIV_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `LIV_NOM` VARCHAR(255) NOT NULL,
  `LIV_ANNEE` YEAR NOT NULL,
  `LIV_LIEU` VARCHAR(255) NOT NULL,
  `LIV_POCHE` TINYINT(1) NOT NULL,
  `GEN_ID` INT(11) NOT NULL,
  `AUT_ID` INT(11) NOT NULL,
  PRIMARY KEY (`LIV_ID`),
  INDEX `fk_LIVRE_GENRE_idx` (`GEN_ID` ASC),
  INDEX `fk_LIVRE_AUTEUR1_idx` (`AUT_ID` ASC),
  CONSTRAINT `fk_LIVRE_GENRE`
    FOREIGN KEY (`GEN_ID`)
    REFERENCES `book`.`GENRE` (`GEN_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LIVRE_AUTEUR1`
    FOREIGN KEY (`AUT_ID`)
    REFERENCES `book`.`AUTEUR` (`AUT_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `book`.`UTILISATEUR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `book`.`UTILISATEUR` (
  `UTI_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `UTI_LOGIN` VARCHAR(255) NOT NULL,
  `UTI_PASSWORD` VARCHAR(255) NOT NULL,
  `UTI_MAIL` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`UTI_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `book`.`HAS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `book`.`HAS` (
  `LIV_ID` INT(11) NOT NULL,
  `UTI_ID` INT(11) NOT NULL,
  PRIMARY KEY (`LIV_ID`, `UTI_ID`),
  INDEX `fk_LIVRE_has_UTILISATEUR_UTILISATEUR1_idx` (`UTI_ID` ASC),
  INDEX `fk_LIVRE_has_UTILISATEUR_LIVRE1_idx` (`LIV_ID` ASC),
  CONSTRAINT `fk_LIVRE_has_UTILISATEUR_LIVRE1`
    FOREIGN KEY (`LIV_ID`)
    REFERENCES `book`.`LIVRE` (`LIV_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LIVRE_has_UTILISATEUR_UTILISATEUR1`
    FOREIGN KEY (`UTI_ID`)
    REFERENCES `book`.`UTILISATEUR` (`UTI_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `book`.`WANT`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `book`.`WANT` (
  `LIV_ID` INT(11) NOT NULL,
  `UTI_ID` INT(11) NOT NULL,
  PRIMARY KEY (`LIV_ID`, `UTI_ID`),
  INDEX `fk_LIVRE_has_UTILISATEUR1_UTILISATEUR1_idx` (`UTI_ID` ASC),
  INDEX `fk_LIVRE_has_UTILISATEUR1_LIVRE1_idx` (`LIV_ID` ASC),
  CONSTRAINT `fk_LIVRE_has_UTILISATEUR1_LIVRE1`
    FOREIGN KEY (`LIV_ID`)
    REFERENCES `book`.`LIVRE` (`LIV_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LIVRE_has_UTILISATEUR1_UTILISATEUR1`
    FOREIGN KEY (`UTI_ID`)
    REFERENCES `book`.`UTILISATEUR` (`UTI_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `book`.`BLACKLIST`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `book`.`BLACKLIST` (
  `LIV_ID` INT(11) NOT NULL,
  `UTI_ID` INT(11) NOT NULL,
  PRIMARY KEY (`LIV_ID`, `UTI_ID`),
  INDEX `fk_LIVRE_has_UTILISATEUR_UTILISATEUR2_idx` (`UTI_ID` ASC),
  INDEX `fk_LIVRE_has_UTILISATEUR_LIVRE2_idx` (`LIV_ID` ASC),
  CONSTRAINT `fk_LIVRE_has_UTILISATEUR_LIVRE2`
    FOREIGN KEY (`LIV_ID`)
    REFERENCES `book`.`LIVRE` (`LIV_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LIVRE_has_UTILISATEUR_UTILISATEUR2`
    FOREIGN KEY (`UTI_ID`)
    REFERENCES `book`.`UTILISATEUR` (`UTI_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

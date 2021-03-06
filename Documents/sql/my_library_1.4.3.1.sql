SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `library` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `library` ;

-- -----------------------------------------------------
-- Table `GENRE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GENRE` (
  `GEN_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `GEN_LIBELLE` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`GEN_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AUTEUR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AUTEUR` (
  `AUT_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `AUT_NOM` VARCHAR(255) NOT NULL,
  `AUT_PRENOM` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`AUT_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `LIVRE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LIVRE` (
  `LIV_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `LIV_NOM` VARCHAR(255) NOT NULL,
  `LIV_ANNEE` INT(4) NOT NULL,
  `LIV_COUVERTURE` VARCHAR(255) NOT NULL,
  `LIV_POCHE` TINYINT(1) NOT NULL,
  `GEN_ID` INT(11) NOT NULL,
  `AUT_ID` INT(11) NOT NULL,
  PRIMARY KEY (`LIV_ID`),
  INDEX `fk_LIVRE_GENRE_idx` (`GEN_ID` ASC),
  INDEX `fk_LIVRE_AUTEUR_idx` (`AUT_ID` ASC),
  CONSTRAINT `fk_LIVRE_GENRE`
    FOREIGN KEY (`GEN_ID`)
    REFERENCES `GENRE` (`GEN_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LIVRE_AUTEUR`
    FOREIGN KEY (`AUT_ID`)
    REFERENCES `AUTEUR` (`AUT_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

ALTER TABLE `LIVRE` ADD `LIV_NUM` TINYINT(1) NOT NULL COMMENT '';

-- -----------------------------------------------------
-- Table `UTILISATEUR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `UTILISATEUR` (
  `UTI_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `UTI_LOGIN` VARCHAR(255) NOT NULL,
  `UTI_PASSWORD` VARCHAR(255) NOT NULL,
  `UTI_MAIL` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`UTI_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HAS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HAS` (
  `LIV_ID` INT(11) NOT NULL,
  `UTI_ID` INT(11) NOT NULL,
  PRIMARY KEY (`LIV_ID`, `UTI_ID`),
  INDEX `fk_LIVRE_HAS_UTILISATEUR_UTILISATEUR_idx` (`UTI_ID` ASC),
  INDEX `fk_LIVRE_HAS_UTILISATEUR_LIVRE_idx` (`LIV_ID` ASC),
  CONSTRAINT `fk_LIVRE_HAS_UTILISATEUR_LIVRE`
    FOREIGN KEY (`LIV_ID`)
    REFERENCES `LIVRE` (`LIV_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LIVRE_HAS_UTILISATEUR_UTILISATEUR`
    FOREIGN KEY (`UTI_ID`)
    REFERENCES `UTILISATEUR` (`UTI_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WANT`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WANT` (
  `LIV_ID` INT(11) NOT NULL,
  `UTI_ID` INT(11) NOT NULL,
  PRIMARY KEY (`LIV_ID`, `UTI_ID`),
  INDEX `fk_LIVRE_WANT_UTILISATEUR_UTILISATEUR_idx` (`UTI_ID` ASC),
  INDEX `fk_LIVRE_WANT_UTILISATEUR_LIVRE_idx` (`LIV_ID` ASC),
  CONSTRAINT `fk_LIVRE_WANT_UTILISATEUR_LIVRE`
    FOREIGN KEY (`LIV_ID`)
    REFERENCES `LIVRE` (`LIV_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LIVRE_WANT_UTILISATEUR_UTILISATEUR`
    FOREIGN KEY (`UTI_ID`)
    REFERENCES `UTILISATEUR` (`UTI_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BLACKLIST`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BLACKLIST` (
  `LIV_ID` INT(11) NOT NULL,
  `UTI_ID` INT(11) NOT NULL,
  PRIMARY KEY (`LIV_ID`, `UTI_ID`),
  INDEX `fk_LIVRE_BLACKLIST_UTILISATEUR_UTILISATEUR_idx` (`UTI_ID` ASC),
  INDEX `fk_LIVRE_BLACKLIST_UTILISATEUR_LIVRE_idx` (`LIV_ID` ASC),
  CONSTRAINT `fk_LIVRE_BLACKLIST_UTILISATEUR_LIVRE`
    FOREIGN KEY (`LIV_ID`)
    REFERENCES `LIVRE` (`LIV_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LIVRE_BLACKLIST_UTILISATEUR_UTILISATEUR`
    FOREIGN KEY (`UTI_ID`)
    REFERENCES `UTILISATEUR` (`UTI_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `READ`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `READ` (
  `LIV_ID` INT(11) NOT NULL,
  `UTI_ID` INT(11) NOT NULL,
  PRIMARY KEY (`LIV_ID`, `UTI_ID`),
  INDEX `fk_LIVRE_READ_UTILISATEUR_UTILISATEUR_idx` (`UTI_ID` ASC),
  INDEX `fk_LIVRE_READ_UTILISATEUR_LIVRE_idx` (`LIV_ID` ASC),
  CONSTRAINT `fk_LIVRE_READ_UTILISATEUR_LIVRE`
    FOREIGN KEY (`LIV_ID`)
    REFERENCES `LIVRE` (`LIV_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LIVRE_READ_UTILISATEUR_UTILISATEUR`
    FOREIGN KEY (`UTI_ID`)
    REFERENCES `UTILISATEUR` (`UTI_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
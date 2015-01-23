-- MySQL Script generated by MySQL Workbench
-- Fri 16 Jan 2015 11:49:04 CET
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0;
SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0;
SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema afs
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema afs
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `afs`
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci;
USE `afs`;

-- -----------------------------------------------------
-- Table `afs`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `afs`.`user` (
  `id`                 INT          NOT NULL AUTO_INCREMENT,
  `username`           VARCHAR(100) NOT NULL,
  `password`           VARCHAR(45)  NULL,
  `firstname`          VARCHAR(100) NOT NULL,
  `lastname`           VARCHAR(100) NOT NULL,
  `birthday`           DATETIME     NOT NULL,
  `registerdate`       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastconnectiontime` DATETIME     NULL,
  `mail`               VARCHAR(100) NOT NULL,
  `phonenumber`        VARCHAR(13)  NULL,
  `twitter`            VARCHAR(30)  NULL,
  `skype`              VARCHAR(45)  NULL,
  `facebookuri`        VARCHAR(500) NULL,
  `website`            VARCHAR(500) NULL,
  `job`                VARCHAR(75)  NULL,
  `description`        TEXT         NULL,
  `privacy`            BIT(15)      NOT NULL,
  `mailnotifications`  TINYINT(1)   NOT NULL,
  `accesslevel`        INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`, `lastname`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC)
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `afs`.`conversation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `afs`.`conversation` (
  `id`         INT      NOT NULL AUTO_INCREMENT,
  `createtime` DATETIME NULL     DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `afs`.`conversation_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `afs`.`conversation_user` (
  `id`       INT      NOT NULL,
  `user`     INT      NOT NULL,
  `joindate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `messagecount` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `user`),
  INDEX `fk_conversation_1_idx` (`user` ASC),
  CONSTRAINT `fk_conversation_1`
  FOREIGN KEY (`user`)
  REFERENCES `afs`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conversation_2`
  FOREIGN KEY (`id`)
  REFERENCES `afs`.`conversation` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `afs`.`event`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `afs`.`event` (
  `id`          INT          NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(45)  NOT NULL,
  `user`        INT          NOT NULL,
  `description` TEXT         NOT NULL,
  `address`     TEXT         NOT NULL,
  `createtime`  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `eventtime`   DATETIME     NOT NULL,
  `money`       INT          NOT NULL,
  `personsmax`  INT UNSIGNED NOT NULL,
  `personsnow`  VARCHAR(45)  NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_event_1_idx` (`user` ASC),
  CONSTRAINT `fk_event_1`
  FOREIGN KEY (`user`)
  REFERENCES `afs`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `afs`.`event_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `afs`.`event_user` (
  `id`   INT NOT NULL,
  `user` INT NOT NULL,
  `joindate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`, `user`),
  INDEX `fk_event_user_2_idx` (`user` ASC),
  CONSTRAINT `fk_event_user_1`
  FOREIGN KEY (`id`)
  REFERENCES `afs`.`event` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_user_2`
  FOREIGN KEY (`user`)
  REFERENCES `afs`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `afs`.`comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `afs`.`comment` (
  `id`      INT  NOT NULL AUTO_INCREMENT,
  `user`    INT  NULL,
  `message` TEXT NULL,
  `postdate` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `editdate` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_comment_1_idx` (`user` ASC),
  CONSTRAINT `fk_comment_1`
  FOREIGN KEY (`user`)
  REFERENCES `afs`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `afs`.`comment_event`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `afs`.`comment_event` (
  `id` INT NOT NULL,
  `event` INT NOT NULL,
  PRIMARY KEY (`id`, `event`),
  INDEX `fk_comment_event_2_idx` (`event` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_comment_event_1`
  FOREIGN KEY (`id`)
  REFERENCES `afs`.`comment` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_event_2`
  FOREIGN KEY (`event`)
  REFERENCES `afs`.`event` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `afs`.`article_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `afs`.`article_category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC)
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `afs`.`article`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `afs`.`article` (
  `id`       INT  NOT NULL AUTO_INCREMENT,
  `user`     INT  NULL,
  `text`     TEXT NULL,
  `postdate` DATETIME NULL,
  `category` INT  NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_article_1_idx` (`user` ASC),
  INDEX `fk_article_2_idx` (`category` ASC),
  CONSTRAINT `fk_article_1`
  FOREIGN KEY (`user`)
  REFERENCES `afs`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_article_2`
  FOREIGN KEY (`category`)
  REFERENCES `afs`.`article_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `afs`.`comment_article`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `afs`.`comment_article` (
  `id` INT NOT NULL,
  `article` INT NOT NULL,
  PRIMARY KEY (`id`, `article`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_comment_article_1_idx` (`article` ASC),
  CONSTRAINT `fk_comment_article_1`
  FOREIGN KEY (`article`)
  REFERENCES `afs`.`article` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_article_2`
  FOREIGN KEY (`id`)
  REFERENCES `afs`.`comment` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;


SET SQL_MODE = @OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS;

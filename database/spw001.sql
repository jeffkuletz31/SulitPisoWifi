-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema spw_db
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `spw_db` ;

-- -----------------------------------------------------
-- Schema spw_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `spw_db` DEFAULT CHARACTER SET utf8 ;
USE `spw_db` ;

-- -----------------------------------------------------
-- Table `spw_db`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `spw_db`.`users` (
  `id` INT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(20) NULL,
  `user_password` VARCHAR(20) NULL,
  `user_level` INT NULL,
  `user_dt_created` DATETIME NULL,
  `user_dt_modified` DATETIME NULL,
  `user_dt_active` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `spw_db`.`transactions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `spw_db`.`transactions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `transaction_dt_started` DATETIME NULL,
  `transaction_dt_ended` DATETIME NULL,
  `access_id` INT NULL,
  `status_id` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `spw_db`.`access`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `spw_db`.`access` (
  `id` INT NOT NULL,
  `access_code` VARCHAR(16) NULL,
  `access_amount` INT NULL,
  `access_time` INT NOT NULL,
  `access_dt_created` DATETIME NULL,
  `access_dt_expired` DATETIME NULL,
  `access_type_id` INT NULL,
  `status_id` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `spw_db`.`configs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `spw_db`.`configs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `config_name` VARCHAR(20) NULL,
  `config_value` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `spw_db`.`access_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `spw_db`.`access_type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `access_name` VARCHAR(20) NULL,
  `access_value` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `spw_db`.`sites`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `spw_db`.`sites` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `site_name` VARCHAR(20) NULL,
  `site_link` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `spw_db`.`clients`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `spw_db`.`clients` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `client_name` VARCHAR(20) NULL,
  `client_ip` VARCHAR(20) NOT NULL,
  `client_mac` VARCHAR(20) NULL,
  `status_id` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `spw_db`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `spw_db`.`status` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `status_name` VARCHAR(20) NULL,
  `status_value` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `spw_db`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `spw_db`;
INSERT INTO `spw_db`.`users` (`id`, `user_name`, `user_password`, `user_level`, `user_dt_created`, `user_dt_modified`, `user_dt_active`) VALUES (1, 'rhalf', '654321', 1, '2019-08-05 00:00:00', '2019-08-05 00:00:00', '2019-08-05 00:00:00');

COMMIT;


-- -----------------------------------------------------
-- Data for table `spw_db`.`configs`
-- -----------------------------------------------------
START TRANSACTION;
USE `spw_db`;
INSERT INTO `spw_db`.`configs` (`id`, `config_name`, `config_value`) VALUES (1, 'amount_rate', '180');
INSERT INTO `spw_db`.`configs` (`id`, `config_name`, `config_value`) VALUES (2, 'amount_minimum', '1');
INSERT INTO `spw_db`.`configs` (`id`, `config_name`, `config_value`) VALUES (3, 'amount_limit', '10000');
INSERT INTO `spw_db`.`configs` (`id`, `config_name`, `config_value`) VALUES (4, '', '');
INSERT INTO `spw_db`.`configs` (`id`, `config_name`, `config_value`) VALUES (5, '', '');
INSERT INTO `spw_db`.`configs` (`id`, `config_name`, `config_value`) VALUES (6, 'time_running', '0');
INSERT INTO `spw_db`.`configs` (`id`, `config_name`, `config_value`) VALUES (7, 'time_serve', '0');
INSERT INTO `spw_db`.`configs` (`id`, `config_name`, `config_value`) VALUES (8, 'time_up', '0');
INSERT INTO `spw_db`.`configs` (`id`, `config_name`, `config_value`) VALUES (9, NULL, DEFAULT);
INSERT INTO `spw_db`.`configs` (`id`, `config_name`, `config_value`) VALUES (10, NULL, DEFAULT);
INSERT INTO `spw_db`.`configs` (`id`, `config_name`, `config_value`) VALUES (11, 'network_bandwidth', '2048');
INSERT INTO `spw_db`.`configs` (`id`, `config_name`, `config_value`) VALUES (12, NULL, DEFAULT);
INSERT INTO `spw_db`.`configs` (`id`, `config_name`, `config_value`) VALUES (13, NULL, DEFAULT);
INSERT INTO `spw_db`.`configs` (`id`, `config_name`, `config_value`) VALUES (14, NULL, DEFAULT);
INSERT INTO `spw_db`.`configs` (`id`, `config_name`, `config_value`) VALUES (15, NULL, DEFAULT);

COMMIT;


-- -----------------------------------------------------
-- Data for table `spw_db`.`access_type`
-- -----------------------------------------------------
START TRANSACTION;
USE `spw_db`;
INSERT INTO `spw_db`.`access_type` (`id`, `access_name`, `access_value`) VALUES (1, 'MACHINE', 0);
INSERT INTO `spw_db`.`access_type` (`id`, `access_name`, `access_value`) VALUES (2, 'VOUCHER', 1);
INSERT INTO `spw_db`.`access_type` (`id`, `access_name`, `access_value`) VALUES (3, 'PROMO', 2);
INSERT INTO `spw_db`.`access_type` (`id`, `access_name`, `access_value`) VALUES (4, 'FREE', 3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `spw_db`.`status`
-- -----------------------------------------------------
START TRANSACTION;
USE `spw_db`;
INSERT INTO `spw_db`.`status` (`id`, `status_name`, `status_value`) VALUES (1, 'GRANTED', 0);
INSERT INTO `spw_db`.`status` (`id`, `status_name`, `status_value`) VALUES (2, 'BLOCKED', 1);
INSERT INTO `spw_db`.`status` (`id`, `status_name`, `status_value`) VALUES (3, 'SUSPENDED', 2);
INSERT INTO `spw_db`.`status` (`id`, `status_name`, `status_value`) VALUES (4, 'PENDING', 3);

COMMIT;


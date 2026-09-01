SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `smartbase` DEFAULT CHARACTER SET utf8mb4 ;
USE `smartbase` ;

-- -----------------------------------------------------
-- Table `smartbase`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smartbase`.`roles` (
  `ID_roles` INT NOT NULL AUTO_INCREMENT,
  `Tipo_rol` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`ID_roles`)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `smartbase`.`puesto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smartbase`.`puesto` (
  `ID_puesto` INT NOT NULL AUTO_INCREMENT,
  `Nombre_puesto` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`ID_puesto`)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `smartbase`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smartbase`.`usuarios` (
  `ID_usuario` INT NOT NULL AUTO_INCREMENT,
  `curp` VARCHAR(18) NOT NULL,
  `Nombre` VARCHAR(100) NULL,
  `Apellido_Paterno` VARCHAR(100) NULL,
  `Apellido_Materno` VARCHAR(100) NULL,
  `Correo` VARCHAR(100) NOT NULL,
  `Contraseña` VARCHAR(255) NOT NULL,
  `ROLES_ID_roles` INT NOT NULL,
  `PUESTO_ID_puesto` INT NULL,
  PRIMARY KEY (`ID_usuario`),
  UNIQUE INDEX `curp_UNIQUE` (`curp` ASC),
  INDEX `fk_usuarios_roles_idx` (`ROLES_ID_roles` ASC),
  INDEX `fk_usuarios_puesto_idx` (`PUESTO_ID_puesto` ASC),
  CONSTRAINT `fk_usuarios_roles`
    FOREIGN KEY (`ROLES_ID_roles`)
    REFERENCES `smartbase`.`roles` (`ID_roles`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_usuarios_puesto`
    FOREIGN KEY (`PUESTO_ID_puesto`)
    REFERENCES `smartbase`.`puesto` (`ID_puesto`)
    ON DELETE SET NULL
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `smartbase`.`permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smartbase`.`permisos` (
  `ID_permisos` INT NOT NULL AUTO_INCREMENT,
  `Nombre_permisos` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`ID_permisos`)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `smartbase`.`permisos_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smartbase`.`permisos_roles` (
  `ROLES_ID_roles` INT NOT NULL,
  `PERMISOS_ID_permisos` INT NOT NULL,
  PRIMARY KEY (`ROLES_ID_roles`, `PERMISOS_ID_permisos`),
  INDEX `fk_permisos_roles_permisos_idx` (`PERMISOS_ID_permisos` ASC),
  CONSTRAINT `fk_permisos_roles_roles`
    FOREIGN KEY (`ROLES_ID_roles`)
    REFERENCES `smartbase`.`roles` (`ID_roles`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_permisos_roles_permisos`
    FOREIGN KEY (`PERMISOS_ID_permisos`)
    REFERENCES `smartbase`.`permisos` (`ID_permisos`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Catálogos Iniciales
-- -----------------------------------------------------
INSERT INTO `smartbase`.`roles` (`ID_roles`, `Tipo_rol`) VALUES 
(1, 'Administrador'),
(2, 'Supervisor'),
(3, 'Usuario General')
ON DUPLICATE KEY UPDATE `Tipo_rol` = VALUES(`Tipo_rol`);

INSERT INTO `smartbase`.`puesto` (`ID_puesto`, `Nombre_puesto`) VALUES 
(1, 'Dirección General'),
(2, 'Jefatura de Área'),
(3, 'Inspector / Técnico'),
(4, 'Auxiliar Administrativo')
ON DUPLICATE KEY UPDATE `Nombre_puesto` = VALUES(`Nombre_puesto`);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
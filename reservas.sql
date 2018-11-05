-- MySQL Script generated by MySQL Workbench
-- Wed Sep 26 17:50:27 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema think
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema think
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `think` DEFAULT CHARACTER SET utf8 ;
USE `think` ;

-- -----------------------------------------------------
-- Table `think`.`estados_proyecto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `think`.`estados_proyecto` ;

CREATE TABLE IF NOT EXISTS `think`.`estados_proyecto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `estado` VARCHAR(200) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `think`.`proyectos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `think`.`proyectos` ;

CREATE TABLE IF NOT EXISTS `think`.`proyectos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `estados_proyecto_id` INT NOT NULL,
  `nombre` VARCHAR(250) NOT NULL,
  `direccion` VARCHAR(200) NULL,
  `telefonos` VARCHAR(45) NULL,
  `latitud` VARCHAR(45) NULL,
  `longitud` VARCHAR(45) NULL,
  `nroplantas` INT NULL,
  `fechareg` DATETIME NULL,
  `descripcion` TEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_proyectos_estados_proyecto1_idx` (`estados_proyecto_id` ASC),
  CONSTRAINT `fk_proyectos_estados_proyecto1`
    FOREIGN KEY (`estados_proyecto_id`)
    REFERENCES `think`.`estados_proyecto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf32;


-- -----------------------------------------------------
-- Table `think`.`tipos_inmueble`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `think`.`tipos_inmueble` ;

CREATE TABLE IF NOT EXISTS `think`.`tipos_inmueble` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `think`.`areascomunes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `think`.`areascomunes` ;

CREATE TABLE IF NOT EXISTS `think`.`areascomunes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `area` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `think`.`clientes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `think`.`clientes` ;

CREATE TABLE IF NOT EXISTS `think`.`clientes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) NULL,
  `sexo` VARCHAR(45) NULL,
  `direccion` TEXT NULL,
  `telefono_fijo` VARCHAR(45) NULL,
  `celular` VARCHAR(45) NULL,
  `correo` VARCHAR(200) NULL,
  `facebook` VARCHAR(250) NULL,
  `whatsapp` VARCHAR(45) NULL,
  `twitter` VARCHAR(200) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `think`.`tipos_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `think`.`tipos_usuario` ;

CREATE TABLE IF NOT EXISTS `think`.`tipos_usuario` (
  `id` INT NOT NULL,
  `tipo` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `think`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `think`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `think`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `ci` VARCHAR(45) NULL,
  `fecha_nac` DATE NULL,
  `sexo` VARCHAR(45) NULL,
  `celular` VARCHAR(45) NULL,
  `fijo` VARCHAR(45) NULL,
  `direccion` TEXT NULL,
  `facebook` VARCHAR(200) NULL,
  `correo` VARCHAR(200) NULL,
  `login` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `tipos_usuario_id` INT NOT NULL,
  PRIMARY KEY (`id`, `tipos_usuario_id`),
  INDEX `fk_usuarios_tipos_usuario1_idx` (`tipos_usuario_id` ASC),
  CONSTRAINT `fk_usuarios_tipos_usuario1`
    FOREIGN KEY (`tipos_usuario_id`)
    REFERENCES `think`.`tipos_usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `think`.`estados_inmueble`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `think`.`estados_inmueble` ;

CREATE TABLE IF NOT EXISTS `think`.`estados_inmueble` (
  `id` INT NOT NULL,
  `estado` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `think`.`inmuebles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `think`.`inmuebles` ;

CREATE TABLE IF NOT EXISTS `think`.`inmuebles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `proyectos_id` INT NOT NULL,
  `tipos_inmueble_id` INT NOT NULL,
  `estado` INT NOT NULL,
  `precio_base` FLOAT NULL,
  `fecha_creacion` DATETIME NULL,
  `clientes_id` INT NOT NULL,
  `usuarios_id` INT NOT NULL,
  `fecha_inicio` DATETIME NULL,
  `fecha_fin` DATETIME NULL,
  `acuenta` FLOAT NULL,
  `moneda_acuenta` VARCHAR(45) NULL,
  PRIMARY KEY (`id`, `proyectos_id`, `tipos_inmueble_id`, `estado`),
  INDEX `fk_inmuebles_tipos_inmueble1_idx` (`tipos_inmueble_id` ASC),
  INDEX `fk_inmuebles_proyectos1_idx` (`proyectos_id` ASC),
  INDEX `fk_inmuebles_clientes1_idx` (`clientes_id` ASC),
  INDEX `fk_inmuebles_usuarios1_idx` (`usuarios_id` ASC),
  INDEX `fk_inmuebles_estados_inmueble1_idx` (`estado` ASC),
  CONSTRAINT `fk_inmuebles_tipos_inmueble1`
    FOREIGN KEY (`tipos_inmueble_id`)
    REFERENCES `think`.`tipos_inmueble` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inmuebles_proyectos1`
    FOREIGN KEY (`proyectos_id`)
    REFERENCES `think`.`proyectos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inmuebles_clientes1`
    FOREIGN KEY (`clientes_id`)
    REFERENCES `think`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inmuebles_usuarios1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `think`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inmuebles_estados_inmueble1`
    FOREIGN KEY (`estado`)
    REFERENCES `think`.`estados_inmueble` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `think`.`ambientes_propios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `think`.`ambientes_propios` ;

CREATE TABLE IF NOT EXISTS `think`.`ambientes_propios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `think`.`eventos_inmueble`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `think`.`eventos_inmueble` ;

CREATE TABLE IF NOT EXISTS `think`.`eventos_inmueble` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuarios_id` INT NOT NULL,
  `inmuebles_id` INT NOT NULL,
  `tipos_evento_id` VARCHAR(250) NOT NULL,
  `fechahora_registro` DATETIME NULL,
  `descripcion` TEXT NULL,
  PRIMARY KEY (`id`, `usuarios_id`, `inmuebles_id`),
  INDEX `fk_eventos_inmueble_usuarios1_idx` (`usuarios_id` ASC),
  INDEX `fk_eventos_inmueble_inmuebles1_idx` (`inmuebles_id` ASC),
  CONSTRAINT `fk_eventos_inmueble_usuarios1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `think`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_inmueble_inmuebles1`
    FOREIGN KEY (`inmuebles_id`)
    REFERENCES `think`.`inmuebles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `think`.`ambientes_propios_inmueble`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `think`.`ambientes_propios_inmueble` ;

CREATE TABLE IF NOT EXISTS `think`.`ambientes_propios_inmueble` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ambientes_propios_id` INT NOT NULL,
  `inmuebles_id` INT NOT NULL,
  `cantidad` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_ambientes_propios_propiedad_ambientes_propios1_idx` (`ambientes_propios_id` ASC),
  INDEX `fk_ambientes_propios_inmueble_inmuebles1_idx` (`inmuebles_id` ASC),
  CONSTRAINT `fk_ambientes_propios_propiedad_ambientes_propios1`
    FOREIGN KEY (`ambientes_propios_id`)
    REFERENCES `think`.`ambientes_propios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ambientes_propios_inmueble_inmuebles1`
    FOREIGN KEY (`inmuebles_id`)
    REFERENCES `think`.`inmuebles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `think`.`areascomunes_proyecto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `think`.`areascomunes_proyecto` ;

CREATE TABLE IF NOT EXISTS `think`.`areascomunes_proyecto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `proyectos_id` INT NOT NULL,
  `areascomunes_id` INT NOT NULL,
  `dimension` VARCHAR(45) NULL,
  `descripcion` TEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_areascomunes_proyecto_proyectos1_idx` (`proyectos_id` ASC),
  INDEX `fk_areascomunes_proyecto_areascomunes1_idx` (`areascomunes_id` ASC),
  CONSTRAINT `fk_areascomunes_proyecto_proyectos1`
    FOREIGN KEY (`proyectos_id`)
    REFERENCES `think`.`proyectos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_areascomunes_proyecto_areascomunes1`
    FOREIGN KEY (`areascomunes_id`)
    REFERENCES `think`.`areascomunes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `think`.`eventos_proyecto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `think`.`eventos_proyecto` ;

CREATE TABLE IF NOT EXISTS `think`.`eventos_proyecto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuarios_id` INT NOT NULL,
  `proyectos_id` INT NOT NULL,
  `tipo_evento` VARCHAR(200) NULL,
  `fechahora_registro` DATETIME NULL,
  `descripcion` TEXT NULL,
  PRIMARY KEY (`id`, `usuarios_id`, `proyectos_id`),
  INDEX `fk_eventos_proyecto_usuarios1_idx` (`usuarios_id` ASC),
  INDEX `fk_eventos_proyecto_proyectos1_idx` (`proyectos_id` ASC),
  CONSTRAINT `fk_eventos_proyecto_usuarios1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `think`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_proyecto_proyectos1`
    FOREIGN KEY (`proyectos_id`)
    REFERENCES `think`.`proyectos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

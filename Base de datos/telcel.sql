-- MySQL Script generated by MySQL Workbench
-- 04/18/18 21:03:28
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES,STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema telcel
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema telcel
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `telcel` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `telcel` ;

-- -----------------------------------------------------
-- Table `telcel`.`cat_planes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telcel`.`cat_planes` ;

CREATE TABLE IF NOT EXISTS `telcel`.`cat_planes` (
  `plan_id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `pl_clave` VARCHAR(18) NOT NULL COMMENT 'Clave del plan',
  `pl_nombre` VARCHAR(120) NOT NULL COMMENT 'Nombre del servicio',
  `pl_descripcion` VARCHAR(500) NULL COMMENT 'Descripcion del servicio',
  PRIMARY KEY (`plan_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `telcel`.`cat_persona`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telcel`.`cat_persona` ;

CREATE TABLE IF NOT EXISTS `telcel`.`cat_persona` (
  `per_id` INT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT '',
  `per_nombre` VARCHAR(150) NOT NULL COMMENT '',
  `per_apellidoPaterno` VARCHAR(45) NOT NULL COMMENT '',
  `per_apellidoMaterno` VARCHAR(45) NULL COMMENT '',
  `per_fechaNacimiento` DATE NOT NULL COMMENT '',
  `per_sexo` CHAR(1) NOT NULL COMMENT 'H: Hombre\nM: Mujer',
  `per_curp` VARCHAR(18) NOT NULL COMMENT '',
  `per_rfc` VARCHAR(13) NOT NULL COMMENT '',
  `per_tipo` CHAR(1) NOT NULL COMMENT 'Tipo de Persona\nF: Persona Fisica\nM: Persona Moral',
  `per_numeroTelefono` INT(13) NOT NULL COMMENT '',
  PRIMARY KEY (`per_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `telcel`.`cat_region`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telcel`.`cat_region` ;

CREATE TABLE IF NOT EXISTS `telcel`.`cat_region` (
  `reg_id` INT ZEROFILL UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `reg_nombre` VARCHAR(120) NOT NULL COMMENT '',
  `reg_descripcion` VARCHAR(300) NULL COMMENT '',
  PRIMARY KEY (`reg_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `telcel`.`cat_estado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telcel`.`cat_estado` ;

CREATE TABLE IF NOT EXISTS `telcel`.`cat_estado` (
  `estado_id` INT UNSIGNED ZEROFILL NOT NULL COMMENT '',
  `reg_id` INT ZEROFILL UNSIGNED NOT NULL COMMENT '',
  `Nombre` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`estado_id`, `reg_id`)  COMMENT '',
  INDEX `fk_Estado_Region1_idx` (`reg_id` ASC)  COMMENT '',
  CONSTRAINT `fk_Estado_Region1`
    FOREIGN KEY (`reg_id`)
    REFERENCES `telcel`.`cat_region` (`reg_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `telcel`.`cat_municipio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telcel`.`cat_municipio` ;

CREATE TABLE IF NOT EXISTS `telcel`.`cat_municipio` (
  `mun_id` INT UNSIGNED ZEROFILL NOT NULL COMMENT '',
  `estado_id` INT UNSIGNED ZEROFILL NOT NULL COMMENT '',
  `Nombre` VARCHAR(150) NULL COMMENT '',
  PRIMARY KEY (`mun_id`, `estado_id`)  COMMENT '',
  INDEX `fk_Municipio_Estado1_idx` (`estado_id` ASC)  COMMENT '',
  CONSTRAINT `fk_Municipio_Estado1`
    FOREIGN KEY (`estado_id`)
    REFERENCES `telcel`.`cat_estado` (`estado_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `telcel`.`cat_localidad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telcel`.`cat_localidad` ;

CREATE TABLE IF NOT EXISTS `telcel`.`cat_localidad` (
  `loc_id` INT UNSIGNED ZEROFILL NOT NULL COMMENT '',
  `mun_id` INT UNSIGNED ZEROFILL NOT NULL COMMENT '',
  `estado_id` INT UNSIGNED ZEROFILL NOT NULL COMMENT '',
  `loc_nombre` VARCHAR(400) NOT NULL COMMENT '',
  `loc_tipo` VARCHAR(45) NULL COMMENT 'Tipo de la localidad\n',
  `loc_cp` INT NULL COMMENT 'Codigo postal',
  PRIMARY KEY (`loc_id`, `mun_id`, `estado_id`)  COMMENT '',
  INDEX `fk_Localidad_Municipio1_idx` (`mun_id` ASC, `estado_id` ASC)  COMMENT '',
  CONSTRAINT `fk_Localidad_Municipio1`
    FOREIGN KEY (`mun_id` , `estado_id`)
    REFERENCES `telcel`.`cat_municipio` (`mun_id` , `estado_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `telcel`.`cat_direccionCliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telcel`.`cat_direccionCliente` ;

CREATE TABLE IF NOT EXISTS `telcel`.`cat_direccionCliente` (
  `direccionClienteID` INT ZEROFILL UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `loc_id` INT UNSIGNED ZEROFILL NOT NULL COMMENT '',
  `mun_id` INT UNSIGNED ZEROFILL NOT NULL COMMENT '',
  `estado_id` INT UNSIGNED ZEROFILL NOT NULL COMMENT '',
  `cli_id` INT UNSIGNED ZEROFILL NOT NULL COMMENT 'Numero de cliente\n',
  `dir_calle` VARCHAR(300) NOT NULL COMMENT 'Domicio del cliente',
  `dir_num` VARCHAR(45) NULL COMMENT '',
  `dir_tipo` CHAR(1) NOT NULL DEFAULT 'P' COMMENT 'Tipo de domicilio\nP: Principal\nT: Trabajo\nO: Otro no especificado',
  PRIMARY KEY (`direccionClienteID`)  COMMENT '',
  INDEX `fk_direccionCliente_Cliente_idx` (`cli_id` ASC)  COMMENT '',
  INDEX `fk_direccionCliente_Localidad1_idx` (`loc_id` ASC, `mun_id` ASC, `estado_id` ASC)  COMMENT '',
  CONSTRAINT `fk_direccionCliente_Cliente`
    FOREIGN KEY (`cli_id`)
    REFERENCES `telcel`.`cat_persona` (`per_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_direccionCliente_Localidad1`
    FOREIGN KEY (`loc_id` , `mun_id` , `estado_id`)
    REFERENCES `telcel`.`cat_localidad` (`loc_id` , `mun_id` , `estado_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `telcel`.`cat_TipoFuerzaVenta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telcel`.`cat_TipoFuerzaVenta` ;

CREATE TABLE IF NOT EXISTS `telcel`.`cat_TipoFuerzaVenta` (
  `tfv_id` INT NOT NULL COMMENT '',
  `tfv_nombre` VARCHAR(45) NULL COMMENT '',
  `tfv_observacion` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`tfv_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `telcel`.`cat_Sim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telcel`.`cat_Sim` ;

CREATE TABLE IF NOT EXISTS `telcel`.`cat_Sim` (
  `sim_id` INT ZEROFILL NOT NULL AUTO_INCREMENT COMMENT '',
  `sim_version` VARCHAR(45) NOT NULL COMMENT '',
  `sim_descripcion` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`sim_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `telcel`.`cat_equipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telcel`.`cat_equipo` ;

CREATE TABLE IF NOT EXISTS `telcel`.`cat_equipo` (
  `equ_id` INT ZEROFILL NOT NULL AUTO_INCREMENT COMMENT '',
  `equ_imei` VARCHAR(45) NOT NULL COMMENT '',
  `equ_tac` VARCHAR(45) NOT NULL COMMENT '',
  `equ_sistemaOperativo` VARCHAR(45) NOT NULL COMMENT '',
  `equ_modelo` VARCHAR(45) NOT NULL COMMENT '',
  `equ_marca` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`equ_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `telcel`.`vin_planSim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telcel`.`vin_planSim` ;

CREATE TABLE IF NOT EXISTS `telcel`.`vin_planSim` (
  `plan_id` INT UNSIGNED NOT NULL COMMENT '',
  `sim_id` INT ZEROFILL NOT NULL COMMENT '',
  `pl_estatus` CHAR(1) NOT NULL COMMENT 'A: Activa\nI: Inactiva',
  `pl_fechaAlta` DATE NULL COMMENT 'Fecha en la que se dio de alta el plan',
  `pl_fechaBaja` DATE NULL COMMENT 'Fecha en la que se dio de baja el plan',
  PRIMARY KEY (`plan_id`, `sim_id`)  COMMENT '',
  INDEX `fk_cat_equipo_has_cat_planes_cat_planes1_idx` (`plan_id` ASC)  COMMENT '',
  INDEX `fk_vin_planEquipo_cat_Sim1_idx` (`sim_id` ASC)  COMMENT '',
  CONSTRAINT `fk_cat_equipo_has_cat_planes_cat_planes1`
    FOREIGN KEY (`plan_id`)
    REFERENCES `telcel`.`cat_planes` (`plan_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vin_planEquipo_cat_Sim1`
    FOREIGN KEY (`sim_id`)
    REFERENCES `telcel`.`cat_Sim` (`sim_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `telcel`.`vin_equipoSim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telcel`.`vin_equipoSim` ;

CREATE TABLE IF NOT EXISTS `telcel`.`vin_equipoSim` (
  `sim_id` INT ZEROFILL NOT NULL COMMENT '',
  `equ_id` INT ZEROFILL NULL COMMENT '',
  INDEX `fk_cat_equipo_has_cat_Sim_cat_Sim1_idx` (`sim_id` ASC)  COMMENT '',
  PRIMARY KEY (`sim_id`)  COMMENT '',
  INDEX `fk_vin_equipoSim_cat_equipo1_idx` (`equ_id` ASC)  COMMENT '',
  CONSTRAINT `fk_cat_equipo_has_cat_Sim_cat_Sim1`
    FOREIGN KEY (`sim_id`)
    REFERENCES `telcel`.`cat_Sim` (`sim_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vin_equipoSim_cat_equipo1`
    FOREIGN KEY (`equ_id`)
    REFERENCES `telcel`.`cat_equipo` (`equ_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `telcel`.`vin_personaEquipoSim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telcel`.`vin_personaEquipoSim` ;

CREATE TABLE IF NOT EXISTS `telcel`.`vin_personaEquipoSim` (
  `per_id` INT UNSIGNED ZEROFILL NOT NULL COMMENT '',
  `sim_id` INT ZEROFILL NOT NULL COMMENT '',
  `equ_id` INT NULL COMMENT '',
  PRIMARY KEY (`per_id`, `sim_id`)  COMMENT '',
  INDEX `fk_Persona_has_vin_equipoSim_vin_equipoSim1_idx` (`sim_id` ASC, `equ_id` ASC)  COMMENT '',
  INDEX `fk_Persona_has_vin_equipoSim_Persona1_idx` (`per_id` ASC)  COMMENT '',
  CONSTRAINT `fk_Persona_has_vin_equipoSim_Persona1`
    FOREIGN KEY (`per_id`)
    REFERENCES `telcel`.`cat_persona` (`per_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Persona_has_vin_equipoSim_vin_equipoSim1`
    FOREIGN KEY (`sim_id`)
    REFERENCES `telcel`.`vin_equipoSim` (`sim_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `telcel`.`ventas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telcel`.`ventas` ;

CREATE TABLE IF NOT EXISTS `telcel`.`ventas` (
  `tfv_id` INT NOT NULL COMMENT '',
  `per_id` INT ZEROFILL NOT NULL COMMENT '',
  `sim_id` INT ZEROFILL NOT NULL COMMENT '',
  `equ_id` INT NULL COMMENT '',
  `ven_monto` DECIMAL(18,2) ZEROFILL NULL COMMENT 'Monto de la venta',
  `ven_fecha` DATE NULL COMMENT 'Fecha en la que se hizo la venta',
  INDEX `fk_cat_TipoFuerzaVenta_has_vin_personaEquipoSim_vin_persona_idx` (`per_id` ASC, `sim_id` ASC)  COMMENT '',
  INDEX `fk_cat_TipoFuerzaVenta_has_vin_personaEquipoSim_cat_TipoFue_idx` (`tfv_id` ASC)  COMMENT '',
  PRIMARY KEY (`tfv_id`, `per_id`, `sim_id`)  COMMENT '',
  CONSTRAINT `fk_cat_TipoFuerzaVenta_has_vin_personaEquipoSim_cat_TipoFuerz1`
    FOREIGN KEY (`tfv_id`)
    REFERENCES `telcel`.`cat_TipoFuerzaVenta` (`tfv_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cat_TipoFuerzaVenta_has_vin_personaEquipoSim_vin_personaEq1`
    FOREIGN KEY (`per_id` , `sim_id`)
    REFERENCES `telcel`.`vin_personaEquipoSim` (`per_id` , `sim_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `telcel`.`factura`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telcel`.`factura` ;

CREATE TABLE IF NOT EXISTS `telcel`.`factura` (
  `fac_id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `loc_id` INT ZEROFILL NOT NULL COMMENT '',
  `mun_id` INT UNSIGNED ZEROFILL NOT NULL COMMENT '',
  `estado_id` INT UNSIGNED ZEROFILL NOT NULL COMMENT '',
  `tfv_id` INT NOT NULL COMMENT '',
  `per_id` INT ZEROFILL NOT NULL COMMENT '',
  `sim_id` INT ZEROFILL NOT NULL COMMENT '',
  `equ_id` INT NULL COMMENT '',
  `fecha` DATE NULL COMMENT 'Fecha en la que se hizo la venta',
  PRIMARY KEY (`fac_id`, `loc_id`, `mun_id`, `estado_id`, `tfv_id`, `per_id`, `sim_id`)  COMMENT '',
  INDEX `fk_Localidad_has_ventas1_ventas1_idx` (`tfv_id` ASC, `per_id` ASC, `sim_id` ASC)  COMMENT '',
  INDEX `fk_Localidad_has_ventas1_Localidad1_idx` (`loc_id` ASC, `mun_id` ASC, `estado_id` ASC)  COMMENT '',
  UNIQUE INDEX `fac_id_UNIQUE` (`fac_id` ASC)  COMMENT '',
  CONSTRAINT `fk_Localidad_has_ventas1_Localidad1`
    FOREIGN KEY (`loc_id` , `mun_id` , `estado_id`)
    REFERENCES `telcel`.`cat_localidad` (`loc_id` , `mun_id` , `estado_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Localidad_has_ventas1_ventas1`
    FOREIGN KEY (`tfv_id` , `per_id` , `sim_id`)
    REFERENCES `telcel`.`ventas` (`tfv_id` , `per_id` , `sim_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `telcel`.`cat_movimiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telcel`.`cat_movimiento` ;

CREATE TABLE IF NOT EXISTS `telcel`.`cat_movimiento` (
  `mov_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `mov_nombre` VARCHAR(90) NULL COMMENT '',
  `mov_descripcion` VARCHAR(200) NULL COMMENT '',
  PRIMARY KEY (`mov_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `telcel`.`vin_personaEquipoSimMov`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telcel`.`vin_personaEquipoSimMov` ;

CREATE TABLE IF NOT EXISTS `telcel`.`vin_personaEquipoSimMov` (
  `per_id` INT UNSIGNED ZEROFILL NOT NULL COMMENT '',
  `sim_id` INT ZEROFILL NOT NULL COMMENT '',
  `mov_id` INT NOT NULL COMMENT '',
  `equ_id` INT NULL COMMENT '',
  `fecha` DATETIME NOT NULL COMMENT 'Fecha en que se realiza el movimiento',
  `duracion` DECIMAL NULL COMMENT '',
  PRIMARY KEY (`per_id`, `sim_id`, `mov_id`)  COMMENT '',
  INDEX `fk_vin_personaEquipoSim_has_cat_movimiento_cat_movimiento1_idx` (`mov_id` ASC)  COMMENT '',
  CONSTRAINT `fk_vin_personaEquipoSim_has_cat_movimiento_vin_personaEquipoS1`
    FOREIGN KEY (`per_id` , `sim_id`)
    REFERENCES `telcel`.`vin_personaEquipoSim` (`per_id` , `sim_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vin_personaEquipoSim_has_cat_movimiento_cat_movimiento1`
    FOREIGN KEY (`mov_id`)
    REFERENCES `telcel`.`cat_movimiento` (`mov_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

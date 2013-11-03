DROP TABLE IF EXISTS `detalle_lista`;
-- -----------------------------------------------------
-- Table `mudledb`.`detalle_lista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `detalle_lista` (
  `id_grupo` SMALLINT NOT NULL DEFAULT '0',
  `dia_asistencia` DATE NULL DEFAULT NULL,
  `asistencia` TINYINT(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id_grupo`)
);

DROP TABLE IF EXISTS `ciclo_escolar`;
-- -----------------------------------------------------
-- Table `mudledb`.`ciclo_escolar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ciclo_escolar` (
  `ciclo` VARCHAR(5) NOT NULL DEFAULT '0',
  `fecha_inicio` DATE NULL DEFAULT NULL,
  `fecha_fin` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`ciclo`)
);

DROP TABLE IF EXISTS `curso`;
-- -----------------------------------------------------
-- Table `mudledb`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `curso` (
  `nrc` VARCHAR(5) NOT NULL DEFAULT '0',
  `ciclo` VARCHAR(5) NOT NULL DEFAULT '0',
  `nombre_materia` VARCHAR(30) NULL DEFAULT NULL,
  `seccion` VARCHAR(5) NULL DEFAULT NULL,
  `academia` VARCHAR(30) NULL DEFAULT NULL,
  `carga_horaria` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`nrc`),
  INDEX `fk_ciclo_curso` (`ciclo` ASC),
  CONSTRAINT `fk_ciclo_ciclo_escolar_curso`
    FOREIGN KEY (`ciclo`)
    REFERENCES `ciclo_escolar` (`ciclo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

DROP TABLE IF EXISTS `usuario`;
-- -----------------------------------------------------
-- Table `mudledb`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `codigo` VARCHAR(15) NOT NULL DEFAULT '0',
  `nombres` VARCHAR(50) NULL DEFAULT NULL,
  `apellidos` VARCHAR(50) NULL DEFAULT NULL,
  `password` VARCHAR(64) NULL DEFAULT NULL,
  `tipo_usuario` TINYINT(4) NULL DEFAULT NULL,
  `carrera` VARCHAR(20) NULL DEFAULT NULL,
  `email` VARCHAR(40) NULL DEFAULT NULL,
  `activo` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`codigo`)
);

DROP TABLE IF EXISTS `calificaciones`;
-- -----------------------------------------------------
-- Table `mudledb`.`calificaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `calificaciones` (
  `id_grupo` SMALLINT(6) NOT NULL DEFAULT '0',
  `codigo` VARCHAR(15) NULL DEFAULT NULL,
  `nrc` VARCHAR(5) NULL DEFAULT NULL,
  PRIMARY KEY (`id_grupo`),
  INDEX `fk_codigo_calificaciones` (`codigo` ASC),
  INDEX `fk_nrc_calificaciones` (`nrc` ASC),
  CONSTRAINT `fk_nrc_curso_calificaciones`
    FOREIGN KEY (`nrc`)
    REFERENCES `curso` (`nrc`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_codigo_usuario_calificaciones`
    FOREIGN KEY (`codigo`)
    REFERENCES `usuario` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

DROP TABLE IF EXISTS `asistencias`;
-- -----------------------------------------------------
-- Table `mudledb`.`asistencias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `asistencias` (
  `id_grupo` SMALLINT NOT NULL DEFAULT '0',
  `codigo` VARCHAR(15) NULL DEFAULT NULL,
  `nrc` VARCHAR(5) NULL DEFAULT NULL,
  PRIMARY KEY (`id_grupo`),
  INDEX `fk_id_grupo_asistencias` (`id_grupo` ASC),
  INDEX `fk_codigo_asistencias` (`codigo` ASC),
  INDEX `fk_nrc_asistencias` (`nrc` ASC),
  CONSTRAINT `fk_id_grupo`
    FOREIGN KEY (`id_grupo`)
    REFERENCES `detalle_lista` (`id_grupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_grupo_calificaciones_asistencias`
    FOREIGN KEY (`id_grupo`)
    REFERENCES `calificaciones` (`id_grupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_codigo_usuarios_asistencias`
    FOREIGN KEY (`codigo`)
    REFERENCES `usuario` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_nrc_curso_asistencias`
    FOREIGN KEY (`nrc`)
    REFERENCES `curso` (`nrc`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

DROP TABLE IF EXISTS `detalle_calificaciones`;
-- -----------------------------------------------------
-- Table `mudledb`.`detalle_calificaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `detalle_calificaciones` (
  `id_grupo` SMALLINT NOT NULL DEFAULT '0',
  `numero_tarea` TINYINT NULL DEFAULT NULL,
  `calificacion` TINYINT NULL DEFAULT NULL,
  PRIMARY KEY (`id_grupo`),
  CONSTRAINT `fk_id_grupo_calificaciones_detalle_calificaciones`
    FOREIGN KEY (`id_grupo`)
    REFERENCES `calificaciones` (`id_grupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

DROP TABLE IF EXISTS `detalle_ciclo_escolar`;
-- -----------------------------------------------------
-- Table `mudledb`.`detalle_ciclo_escolar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `detalle_ciclo_escolar` (
  `ciclo` VARCHAR(5) NOT NULL DEFAULT '0',
  `dia_no_efectivo` DATE NULL DEFAULT NULL,
  `descripcion` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`ciclo`),
  CONSTRAINT `fk_ciclo_cursos_detalle_ciclo_escolar`
    FOREIGN KEY (`ciclo`)
    REFERENCES `curso` (`ciclo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

DROP TABLE IF EXISTS `detalle_curso`;
-- -----------------------------------------------------
-- Table `mudledb`.`detalle_curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `detalle_curso` (
  `nrc` VARCHAR(5) NULL DEFAULT NULL,
  `dia` VARCHAR(10) NULL DEFAULT NULL,
  `horas_por_dia` TINYINT NULL DEFAULT NULL,
  `horario` VARCHAR(15) NULL DEFAULT NULL,
  PRIMARY KEY (`nrc`),
  CONSTRAINT `fk_nrc_curso_detalle_curso`
    FOREIGN KEY (`nrc`)
    REFERENCES `curso` (`nrc`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);
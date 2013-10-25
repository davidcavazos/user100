



-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'usuario'
-- 
-- ---

DROP TABLE IF EXISTS `usuario`;
		
CREATE TABLE `usuario` (
  `codigo` VARCHAR(15) NULL DEFAULT NULL,
  `nombres` VARCHAR(50) NULL DEFAULT NULL,
  `apellidos` VARCHAR(50) NULL DEFAULT NULL,
  `password` VARCHAR(64) NULL DEFAULT NULL,
  `tipo_usuario` TINYINT NULL DEFAULT NULL,
  `carrera` VARCHAR(20) NULL DEFAULT NULL,
  `email` VARCHAR(40) NULL DEFAULT NULL,
  `activo` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`codigo`)
);

-- ---
-- Table 'calificaciones'
-- 
-- ---

DROP TABLE IF EXISTS `calificaciones`;
		
CREATE TABLE `calificaciones` (
  `id_grupo` SMALLINT NULL DEFAULT NULL,
  `codigo` VARCHAR(15) NULL DEFAULT NULL,
  `nrc` VARCHAR(5) NULL DEFAULT NULL,
  PRIMARY KEY (`codigo`, `nrc`, `id_grupo`)
);

-- ---
-- Table 'curso'
-- 
-- ---

DROP TABLE IF EXISTS `curso`;
		
CREATE TABLE `curso` (
  `nrc` VARCHAR(5) NOT NULL DEFAULT 'NULL',
  `ciclo` VARCHAR(5) NOT NULL DEFAULT 'NULL',
  `nombre_materia` VARCHAR(30) NULL DEFAULT NULL,
  `seccion` VARCHAR(5) NULL DEFAULT NULL,
  `academia` VARCHAR(30) NULL DEFAULT NULL,
  `carga_horaria` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`nrc`, `ciclo`)
);

-- ---
-- Table 'ciclo_escolar'
-- 
-- ---

DROP TABLE IF EXISTS `ciclo_escolar`;
		
CREATE TABLE `ciclo_escolar` (
  `ciclo` VARCHAR(5) NOT NULL DEFAULT 'NULL',
  `fecha_inicio` DATE NULL DEFAULT NULL,
  `fecha_fin` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`ciclo`)
);

-- ---
-- Table 'asistencias'
-- 
-- ---

DROP TABLE IF EXISTS `asistencias`;
		
CREATE TABLE `asistencias` (
  `id_grupo` SMALLINT NULL DEFAULT NULL,
  `codigo` VARCHAR(15) NULL DEFAULT NULL,
  `nrc` VARCHAR(5) NULL DEFAULT NULL,
  PRIMARY KEY (`codigo`, `nrc`, `id_grupo`)
);

-- ---
-- Table 'detalle_ciclo_escolar'
-- 
-- ---

DROP TABLE IF EXISTS `detalle_ciclo_escolar`;
		
CREATE TABLE `detalle_ciclo_escolar` (
  `ciclo` VARCHAR(5) NOT NULL DEFAULT 'NULL',
  `dia_no_efectivo` DATE NULL DEFAULT NULL,
  `descripcion` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`ciclo`)
);

-- ---
-- Table 'detalle_curso'
-- 
-- ---

DROP TABLE IF EXISTS `detalle_curso`;
		
CREATE TABLE `detalle_curso` (
  `nrc` VARCHAR(5) NULL DEFAULT NULL,
  `dia` VARCHAR(10) NULL DEFAULT NULL,
  `horas_por_dia` TINYINT NULL DEFAULT NULL,
  `horario` VARCHAR(15) NULL DEFAULT NULL,
  PRIMARY KEY (`nrc`)
);

-- ---
-- Table 'detalle_lista'
-- 
-- ---

DROP TABLE IF EXISTS `detalle_lista`;
		
CREATE TABLE `detalle_lista` (
  `id_grupo` SMALLINT NULL DEFAULT NULL,
  `dia_asistencia` DATE NULL DEFAULT NULL,
  `asistencia` TINYINT NULL DEFAULT NULL,
  PRIMARY KEY (`id_grupo`)
);

-- ---
-- Table 'detalle_calificaciones'
-- 
-- ---

DROP TABLE IF EXISTS `detalle_calificaciones`;
		
CREATE TABLE `detalle_calificaciones` (
  `id_grupo` SMALLINT NULL DEFAULT NULL,
  `numero_tarea` TINYINT NULL DEFAULT NULL,
  `calificacion` TINYINT NULL DEFAULT NULL,
  PRIMARY KEY (`id_grupo`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `usuario` ADD FOREIGN KEY (codigo) REFERENCES `calificaciones` (`codigo`);
ALTER TABLE `calificaciones` ADD FOREIGN KEY (nrc) REFERENCES `curso` (`nrc`);
ALTER TABLE `ciclo_escolar` ADD FOREIGN KEY (ciclo) REFERENCES `curso` (`ciclo`);
ALTER TABLE `asistencias` ADD FOREIGN KEY (id_grupo) REFERENCES `calificaciones` (`id_grupo`);
ALTER TABLE `asistencias` ADD FOREIGN KEY (codigo) REFERENCES `usuario` (`codigo`);
ALTER TABLE `asistencias` ADD FOREIGN KEY (nrc) REFERENCES `curso` (`nrc`);
ALTER TABLE `detalle_ciclo_escolar` ADD FOREIGN KEY (ciclo) REFERENCES `ciclo_escolar` (`ciclo`);
ALTER TABLE `detalle_curso` ADD FOREIGN KEY (nrc) REFERENCES `curso` (`nrc`);
ALTER TABLE `detalle_lista` ADD FOREIGN KEY (id_grupo) REFERENCES `asistencias` (`id_grupo`);
ALTER TABLE `detalle_calificaciones` ADD FOREIGN KEY (id_grupo) REFERENCES `calificaciones` (`id_grupo`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `usuario` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `calificaciones` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `curso` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `ciclo_escolar` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `asistencias` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `detalle_ciclo_escolar` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `detalle_curso` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `detalle_lista` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `detalle_calificaciones` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `usuario` (`codigo`,`nombres`,`apellidos`,`password`,`tipo_usuario`,`carrera`,`email`,`activo`) VALUES
-- ('','','','','','','','');
-- INSERT INTO `calificaciones` (`id_grupo`,`codigo`,`nrc`) VALUES
-- ('','','');
-- INSERT INTO `curso` (`nrc`,`ciclo`,`nombre_materia`,`seccion`,`academia`,`carga_horaria`) VALUES
-- ('','','','','','');
-- INSERT INTO `ciclo_escolar` (`ciclo`,`fecha_inicio`,`fecha_fin`) VALUES
-- ('','','');
-- INSERT INTO `asistencias` (`id_grupo`,`codigo`,`nrc`) VALUES
-- ('','','');
-- INSERT INTO `detalle_ciclo_escolar` (`ciclo`,`dia_no_efectivo`,`descripcion`) VALUES
-- ('','','');
-- INSERT INTO `detalle_curso` (`nrc`,`dia`,`horas_por_dia`,`horario`) VALUES
-- ('','','','');
-- INSERT INTO `detalle_lista` (`id_grupo`,`dia_asistencia`,`asistencia`) VALUES
-- ('','','');
-- INSERT INTO `detalle_calificaciones` (`id_grupo`,`numero_tarea`,`calificacion`) VALUES
-- ('','','');


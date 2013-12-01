-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2013 at 03:11 AM
-- Server version: 5.5.33a-MariaDB
-- PHP Version: 5.5.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mudledb`
--

-- --------------------------------------------------------

--
-- Table structure for table `calificacion`
--

CREATE TABLE IF NOT EXISTS `calificacion` (
  `ciclonrc` varchar(10) DEFAULT NULL,
  `codigo` varchar(9) DEFAULT NULL,
  `rubro` varchar(30) DEFAULT NULL,
  `calificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ciclo_escolar`
--

CREATE TABLE IF NOT EXISTS `ciclo_escolar` (
  `ciclo` varchar(5) NOT NULL DEFAULT 'NULL',
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ciclo_escolar`
--

INSERT INTO `ciclo_escolar` (`ciclo`, `fecha_inicio`, `fecha_fin`) VALUES
('2012a', '2012-02-05', '2012-06-15'),
('2012b', '2012-08-19', '2012-12-16'),
('2013a', '2013-02-03', '2013-06-16'),
('2013b', '2013-08-18', '2013-12-15');

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `ciclonrc` varchar(10) NOT NULL,
  `nrc` varchar(5) NOT NULL DEFAULT 'NULL',
  `ciclo` varchar(5) NOT NULL DEFAULT 'NULL',
  `clave_materia` varchar(5) DEFAULT NULL,
  `seccion` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`ciclonrc`, `nrc`, `ciclo`, `clave_materia`, `seccion`) VALUES
('2013b12345', '12345', '2013b', 'cc300', 'd01'),
('2013b23456', '23456', '2013b', 'cc301', 'd02'),
('2013a12345', '12345', '2013a', 'cc100', 'd01'),
('2013a09876', '09876', '2013a', 'cc102', 'd02'),
('2012b67890', '67890', '2012b', 'CC200', 'D01'),
('2012b34567', '34567', '2012b', 'cc202', 'd02'),
('2012a45678', '45678', '2012a', 'CC204', 'D04'),
('2012a65432', '65432', '2012a', 'cc400', 'd05');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_ciclo_escolar`
--

CREATE TABLE IF NOT EXISTS `detalle_ciclo_escolar` (
  `ciclo` varchar(5) NOT NULL DEFAULT 'NULL',
  `dia_no_efectivo` date DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detalle_ciclo_escolar`
--

INSERT INTO `detalle_ciclo_escolar` (`ciclo`, `dia_no_efectivo`, `descripcion`) VALUES
('2012a', '2012-04-10', 'Dia Festivo Uno'),
('2012a', '2012-03-05', 'Dia Festivo Dos'),
('2012b', '2012-11-12', 'Dia Festivo Uno'),
('2012b', '2012-09-20', 'Dia Festivo Dos'),
('2013a', '2013-05-06', 'Dia Festivo Uno'),
('2013a', '2013-02-21', 'Dia Festivo Dos'),
('2013b', '2013-11-04', 'Dia Festivo Uno'),
('2013b', '2013-11-27', 'Dia Festivo Dos');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_curso`
--

CREATE TABLE IF NOT EXISTS `detalle_curso` (
  `ciclonrc` varchar(10) DEFAULT NULL,
  `dia` varchar(10) DEFAULT NULL,
  `horas_por_dia` tinyint(4) DEFAULT NULL,
  `horario` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detalle_curso`
--

INSERT INTO `detalle_curso` (`ciclonrc`, `dia`, `horas_por_dia`, `horario`) VALUES
('2013b12345', 'Lunes', 2, '12:00'),
('2013b12345', 'Miercoles', 2, '12:00'),
('2013b23456', 'Martes', 2, '07:00'),
('2013b23456', 'Jueves', 1, '07:00'),
('2013a12345', 'Miercoles', 2, '20:00'),
('2013a12345', 'Lunes', 2, '20:00'),
('2013a09876', 'Miercoles', 1, '08:00'),
('2013a09876', 'Sabado', 2, '07:00'),
('2012b67890', 'Sabado', 4, '09:00'),
('2012b34567', 'Sabado', 4, '10:00'),
('2012a45678', 'Lunes', 2, '16:00'),
('2012a45678', 'Viernes', 2, '16:00'),
('2012a65432', 'Martes', 2, '12:00'),
('2012a65432', 'Jueves', 1, '12:00');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_usuario`
--

CREATE TABLE IF NOT EXISTS `detalle_usuario` (
  `codigo` varchar(9) NOT NULL,
  `campo_extra` varchar(50) NOT NULL,
  `valor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detalle_usuario`
--

INSERT INTO `detalle_usuario` (`codigo`, `campo_extra`, `valor`) VALUES
('210224667', 'github', 'noiarek'),
('210224667', 'facebook', 'noiarek'),
('210223806', 'github', 'davido262'),
('210223806', 'facebook', 'davido262'),
('210769576', 'github', 'ntmichell'),
('210769576', 'twitter', 'ntmichell');

-- --------------------------------------------------------

--
-- Table structure for table `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `ciclonrc` varchar(10) NOT NULL,
  `codigo` varchar(9) NOT NULL,
  `mes1` int(11) NOT NULL,
  `mes2` int(11) NOT NULL,
  `mes3` int(11) NOT NULL,
  `mes4` int(11) NOT NULL,
  `mes5` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `materia`
--

CREATE TABLE IF NOT EXISTS `materia` (
  `clave` varchar(5) NOT NULL,
  `materia` varchar(100) NOT NULL,
  `academia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materia`
--

INSERT INTO `materia` (`clave`, `materia`, `academia`) VALUES
('CC100', 'Introduccion a la Computacion', 'Computacion basica'),
('CC101', 'Taller de Introduccion a la Computacion', 'Computacion basica'),
('CC102', 'Introduccion a la Programacion', 'Programacion basica'),
('CC103', 'Taller de Programacion Estructurada', 'Programacion basica'),
('CC108', 'Programacion Estructurada', 'Programacion basica'),
('CC109', 'Programacion para Interfaces', 'Tecnicas Modernas de Programacion'),
('CC200', 'Programacion Orientada a Objetos', 'Tecnicas Modernas de Programacion'),
('CC201', 'Taller de Programacion Orientada a Objetos', 'Tecnicas Modernas de Programacion'),
('CC202', 'Estructura de Datos', 'Estructuras y algoritmos'),
('CC203', 'Taller de Estructura de Datos', 'Estructuras y algoritmos'),
('CC204', 'Estructura de Archivos', 'Estructuras y algoritmos'),
('CC205', 'Taller de Estructura de Archivos', 'Estructuras y algoritmos'),
('CC206', 'Programacion de Sistemas', 'Software de Sistemas'),
('CC207', 'Taller de Programacion de Sistemas', 'Software de Sistemas'),
('CC208', 'Lenguajes de Programacion Comparados', 'Tecnicas Modernas de Programacion'),
('CC209', 'Teoria de la Computacion', 'Estructuras y algoritmos'),
('CC210', 'Arquitectura de Computadoras', 'Sistemas Digitales'),
('CC211', 'Teleinformatica', 'Sistemas Digitales'),
('CC212', 'Redes de Computadoras', 'Sistemas Digitales'),
('CC213', 'Taller de Redes de Computadoras', 'Sistemas Digitales'),
('CC300', 'Sistemas Operativos', 'Software de Sistemas'),
('CC301', 'Taller de Sistemas Operativos', 'Software de Sistemas'),
('CC302', 'Bases de Datos', 'Sistemas de Informacion'),
('CC303', 'Taller de Bases de Datos', 'Sistemas de Informacion'),
('CC304', 'Ingenieria de Software I', 'Ingenieria de software'),
('CC305', 'Ingenieria de Software II', 'Ingenieria de software'),
('CC306', 'Taller de Ingenieria de Software II', 'Ingenieria de software'),
('CC307', 'Programacion Logica y Funcional', 'Tecnicas Modernas de Programacion'),
('CC308', 'Taller de Programacion Logica y Funcional', 'Tecnicas Modernas de Programacion'),
('CC309', 'Bases de Datos Avanzadas', 'Sistemas de Informacion'),
('CC310', 'Taller de Bases de Datos Avanzadas', 'Sistemas de Informacion'),
('CC311', 'Graficas por Computadora', 'Software de Sistemas'),
('CC312', 'Taller de Graficas por Computadora', ''),
('CC313', 'Administracion de Bases de Datos', 'Sistemas de Informacion'),
('CC314', 'Taller de Administracion de Bases de Datos', 'Sistemas de Informacion'),
('CC315', 'Sistemas de Informacion Administrativos', 'Sistemas de Informacion'),
('CC316', 'Analisis y Diseño de Algoritmos', 'Estructuras y algoritmos'),
('CC317', 'Compiladores', ''),
('CC318', 'Taller de Compiladores', 'Software de Sistemas'),
('CC319', 'Sistemas Operativos Avanzados', 'Software de Sistemas'),
('CC320', 'Taller de Sistemas Operativos Avanzados', 'Software de Sistemas'),
('CC321', 'Fundamentos de Ingenieria de Software', 'Ingenieria de software'),
('CC322', 'Organizacion de Computadoras I', 'Sistemas Digitales'),
('CC323', 'Organizacion de Computadoras II', 'Sistemas Digitales'),
('CC324', 'Redes de Computadoras Avanzadas', 'Sistemas Digitales'),
('CC325', 'Taller de Redes Avanzadas', 'Sistemas Digitales'),
('CC400', 'Sistemas Expertos', 'Tecnicas Modernas de Programacion'),
('CC401', 'Programacion de Sistemas Multimedia', 'Sistemas de Informacion'),
('CC402', 'Taller de Sistemas Multimedia', 'Sistemas de Informacion'),
('CC403', 'Auditoria de Sistemas', 'Ingenieria de software'),
('CC404', 'Sistemas de Informacion Financieros', 'Sistemas de Informacion'),
('CC405', 'Sistemas de Informacion para la Manufactura', 'Sistemas de Informacion'),
('CC406', 'Sistemas de Informacion para la Toma de Decisiones', 'Sistemas de Informacion'),
('CC407', 'Proyecto Terminal', 'Ingenieria de software'),
('CC408', 'Simulacion de Sistemas Digitales', 'Sistemas Digitales'),
('CC409', 'Arquitectura de Computadoras Avanzada', 'Sistemas Digitales'),
('CC410', 'Redes Neuronales Artificiales', 'Tecnicas Modernas de Programacion'),
('CC411', 'Computacion Tolerante a Fallas', 'Software de Sistemas'),
('CC413', 'Programacion Concurrente y Distribuida', 'Software de Sistemas'),
('CC414', 'Taller de Programacion Concurrente y Distribuida', 'Software de Sistemas'),
('CC415', 'Inteligencia Artificial', 'Tecnicas Modernas de Programacion'),
('CC417', 'Topicos Selectos de Computacion I (Robotica Movil)', 'Software de Sistemas'),
('CC417', 'Topicos Selectos de Computacion I (Administracion de Servidores Microsoft)', 'Software de Sistemas'),
('CC417', 'Topicos Selectos de Computacion I (Control de Proyectos)', 'Ingenieria de software'),
('CC418', 'Topicos Selectos de Computacion II (Unix y Linux)', 'Software de Sistemas'),
('CC419', 'Topicos Selectos de Computacion III (Java Avanzado)', 'Tecnicas Modernas de Programacion'),
('CC419', 'Topicos Selectos de Computacion III (Programacion Web)', 'Tecnicas Modernas de Programacion'),
('CC420', 'Topicos Selectos de Informatica I (Programacion de iPod y iPhone)', 'Software de Sistemas'),
('CC420', 'Topicos Selectos de Informatica I (Interconexion de redes)', 'Sistemas Digitales'),
('CC420', 'Topicos Selectos de Informatica I (Comercio Electronico)', 'Ingenieria de software'),
('CC421', 'Topicos Selectos de Informatica II (Programacion de iPod y iPhone)', 'Software de Sistemas'),
('CC421', 'Topicos Selectos de Informatica II', 'Tecnicas Modernas de Programacion'),
('CC421', 'Topicos Selectos de Informatica II', 'Ingenieria de software'),
('CC422', 'Topicos Selectos de Informatica III (C#)', 'Tecnicas Modernas de Programacion'),
('CC422', 'Topicos Selectos de Informatica III (Software libre)', 'Software de Sistemas'),
('I5882', 'Programacion', ''),
('I5883', 'Seminario de Solucion de Problemas de Programacion', ''),
('I5884', 'Algoritmia', ''),
('I5885', 'Seminario de Solucion de Problemas de Algoritmia', ''),
('I5886', 'Estructuras de Datos I', ''),
('I5887', 'Seminario de Solucion de Problemas de Estructuras de Datos I', ''),
('I5888', 'Estructuras de Datos II', ''),
('I5889', 'Seminario de Solucion de Problemas de Estructuras de Datos II', ''),
('I5890', 'Bases de Datos', ''),
('I5891', 'Seminario de Solucion de Problemas de Bases de Datos', ''),
('I5898', 'Ingenieria de Software I', ''),
('I5899', 'Seminario de Solucion de Problemas de Ingenieria de Software I', ''),
('I5900', 'Ingenieria de Software II', ''),
('I5902', 'Administracion de Bases de Datos', ''),
('I5903', 'Uso', ''),
('I5904', 'Seminario de Solucion de Problemas de Uso', ''),
('I5905', 'Seguridad de la Informacion', ''),
('I5906', 'Almacenes de Datos (Data Warehouse)', ''),
('I5907', 'Administracion de Redes', ''),
('I5908', 'Administracion de Servidores', ''),
('I5909', 'Programacion para Internet', ''),
('I5910', 'Hypermedia', ''),
('I5911', 'Mineria de Datos', ''),
('I5912', 'Clasificacion Inteligente de Datos', ''),
('I5913', 'Sistemas Basados en Conocimiento', ''),
('I5914', 'Seminario de Solucion de Problemas de Sistemas Basados en Conocimiento', ''),
('I5915', 'Teoria de la Computacion', ''),
('I7022', 'Fundamentos Filosoficos de la Computacion', ''),
('I7023', 'Arquitectura de Computadoras', ''),
('I7024', 'Seminario de Solucion de Problemas de Arquitectura de Computadoras', ''),
('I7025', 'Traductores de Lenguajes I', ''),
('I7026', 'Seminario de Solucion de Problemas de Traductores de Lenguajes I', ''),
('I7027', 'Traductores de Lenguajes II', ''),
('I7028', 'Seminario de Solucion de Problemas de Traductores de Lenguaje II', ''),
('I7029', 'Sistemas Operativos', ''),
('I7030', 'Seminario de Solucion de Problemas de Sistemas Operativos', ''),
('I7031', 'Redes de computadoras y Protocolos de Comunicacion', ''),
('I7032', 'Seminario de Solucion de Problemas de Redes de Computadoras y Protocolos de Comunicacion', ''),
('I7033', 'Sistemas Operativos de Red', ''),
('I7034', 'Seminario de Solucion de Problemas de Sistemas Operativos en Red', ''),
('I7035', 'Sistemas Concurrentes y Distribuidos', ''),
('I7036', 'Computacion tolerante a fallas', ''),
('I7037', 'Seguridad', ''),
('I7038', 'Inteligencia Artificial I', ''),
('I7039', 'Seminario de Solucion de Problemas de Inteligencia Artificial I', ''),
('I7040', 'Inteligencia Artificial II', ''),
('I7041', 'Seminario de Solucion de Problemas de Inteligencia Artificial II', ''),
('I7042', 'Simulacion por Computadora', ''),
('I7609', 'Procesamiento de Bioimagenes', '');

-- --------------------------------------------------------

--
-- Table structure for table `rubro`
--

CREATE TABLE IF NOT EXISTS `rubro` (
  `ciclonrc` varchar(10) NOT NULL,
  `rubro` varchar(30) NOT NULL,
  `porcentaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `codigo` varchar(15) DEFAULT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `tipo_usuario` tinyint(4) DEFAULT NULL,
  `carrera` varchar(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`codigo`, `nombres`, `apellidos`, `password`, `tipo_usuario`, `carrera`, `email`, `activo`) VALUES
('000000000', 'root', 'root', 'root', -1, 'root', 'root@root.com', 1),
('999999999', 'admin', 'admin', 'admin', 0, 'admin', 'admin@admin.com', 1),
('210224667', 'Gustavo Rodrigo', 'Guillen Villarreal', 'asdf', 2, 'COM', 'noiarek@gmail.com', 1),
('210223806', 'David', 'Cavazos Woo', 'asdf', 2, 'COM', 'david0262@gmail.com', 1),
('210769576', 'Nancy Michelle', 'Torres Villanueva', 'asdf', 1, 'COM', 'michelletorres@gmail.com', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

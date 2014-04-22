-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-04-2014 a las 06:51:36
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `demo_pdo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `area` enum('comercial','desarrollo','diseño','soporte') COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='cargo a asignar al momento de crear un usuario' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nacimiento` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_departamento`
--

CREATE TABLE IF NOT EXISTS `usuario_departamento` (
  `id_usuario` int(10) unsigned NOT NULL,
  `id_depto` int(10) unsigned NOT NULL,
  `registro` date NOT NULL COMMENT 'fecha en que ingreso al departamento',
  PRIMARY KEY (`id_usuario`,`id_depto`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_depto` (`id_depto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- RELACIONES PARA LA TABLA `usuario_departamento`:
--   `id_depto`
--       `departamento` -> `id`
--   `id_usuario`
--       `usuario` -> `id`
--

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario_departamento`
--
ALTER TABLE `usuario_departamento`
  ADD CONSTRAINT `usuario_departamento_ibfk_3` FOREIGN KEY (`id_depto`) REFERENCES `departamento` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_departamento_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--insert para tabla usuario
INSERT INTO usuario(nombre, nacimiento) VALUES 
('Marcela', CURDATE()),
('Alberto', CURDATE()),
('Julian', CURDATE()),
('Marta', CURDATE()),
('Pia', CURDATE()),
('Joshua', CURDATE());

--insert para tabla departamento
INSERT INTO departamento(nombre, area) VALUES
('planificación presupuesto', 'comercial'),
('Aseguramiento de la calidad QA', 'desarrollo'),
('Maquetación', 'diseño'),
('Atención al cliente', 'soporte');

--insert para tabla usuario_departamento
INSERT INTO usuario_departamento(id_usuario, id_depto, registro) VALUES
(1,1,CURDATE()),
(2,2,CURDATE()),
(2,3,CURDATE()),
(3,4,CURDATE()),
(4,1,CURDATE()),
(5,2,CURDATE()),
(6,3,CURDATE());

--resetear los id's autoincrementales
ALTER TABLE usuario AUTO_INCREMENT=1;
ALTER TABLE departamento AUTO_INCREMENT=1;

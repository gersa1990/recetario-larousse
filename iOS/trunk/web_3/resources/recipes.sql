-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-03-2013 a las 19:37:42
-- Versión del servidor: 5.5.8
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `recipes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app`
--

CREATE TABLE IF NOT EXISTS `app` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `app`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `color` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `categoria`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conf`
--

CREATE TABLE IF NOT EXISTS `conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `valor` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `conf`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `glosario`
--

CREATE TABLE IF NOT EXISTS `glosario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `glosario`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE IF NOT EXISTS `recetas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_app` int(11) NOT NULL,
  `procedimiento` text NOT NULL,
  `ingredientes` text NOT NULL,
  `preparacion` int(11) NOT NULL,
  `coccion` int(11) NOT NULL,
  `costo` int(11) NOT NULL,
  `video` text NOT NULL,
  `foto` text NOT NULL,
  `user_fav` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_app_idx` (`id_app`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `recetas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas_relacion`
--

CREATE TABLE IF NOT EXISTS `recetas_relacion` (
  `id_receta1` int(11) NOT NULL,
  `id_receta2` int(11) NOT NULL,
  KEY `id_receta1_idx` (`id_receta1`),
  KEY `id_receta2_idx` (`id_receta2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `recetas_relacion`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta_glosario`
--

CREATE TABLE IF NOT EXISTS `receta_glosario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_receta` int(11) NOT NULL,
  `id_glosario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_receta_idx` (`id_receta`),
  KEY `id_glosario_idx` (`id_glosario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `receta_glosario`
--


--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD CONSTRAINT `id_app` FOREIGN KEY (`id_app`) REFERENCES `app` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recetas_relacion`
--
ALTER TABLE `recetas_relacion`
  ADD CONSTRAINT `id_receta1` FOREIGN KEY (`id_receta1`) REFERENCES `recetas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_receta2` FOREIGN KEY (`id_receta2`) REFERENCES `recetas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `receta_glosario`
--
ALTER TABLE `receta_glosario`
  ADD CONSTRAINT `id_glosario` FOREIGN KEY (`id_glosario`) REFERENCES `glosario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_receta` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

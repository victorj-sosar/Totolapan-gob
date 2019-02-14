-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-02-2019 a las 01:05:06
-- Versión del servidor: 5.7.23
-- Versión de PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `toto1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convocatorias`
--

DROP TABLE IF EXISTS `convocatorias`;
CREATE TABLE IF NOT EXISTS `convocatorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(254) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `archivo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estatus` (`estatus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

DROP TABLE IF EXISTS `estatus`;
CREATE TABLE IF NOT EXISTS `estatus` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`id`, `descripcion`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `contenido` longtext COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estatus` (`estatus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagen` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `titulo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(254) COLLATE utf8_spanish_ci NOT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estatus` (`estatus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'CDC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `paterno` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `materno` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `user` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` int(11) NOT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estatus` (`estatus`),
  KEY `tipo` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `paterno`, `materno`, `user`, `pass`, `tipo`, `estatus`) VALUES
(1, 'Administrador', 'Administrador', 'Administrador', 'admin', '$2y$10$YGb7mrHoZsJE2GQR8FU6M.RnIX7SlHn4jAjA0A6SE1EmAQGBsb1a.', 1, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `convocatorias`
--
ALTER TABLE `convocatorias`
  ADD CONSTRAINT `convocatorias_ibfk_1` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`id`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`id`);

--
-- Filtros para la tabla `slider`
--
ALTER TABLE `slider`
  ADD CONSTRAINT `slider_ibfk_1` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`id`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`tipo`) REFERENCES `tipo_usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

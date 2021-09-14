-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-02-2016 a las 19:19:45
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `caporce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE IF NOT EXISTS `caja` (
  `id_caja` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` double DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `persona_creacion` int(11) DEFAULT NULL,
  `persona_modificacion` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_caja`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id_caja`, `cantidad`, `fecha`, `fecha_creacion`, `fecha_modificacion`, `persona_creacion`, `persona_modificacion`, `activo`) VALUES
(1, 6000, '2016-02-05', '2016-02-05 00:00:00', '2016-02-05 00:00:00', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE IF NOT EXISTS `compras` (
  `id_compras` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_compra` int(11) DEFAULT NULL,
  `proveedor` varchar(150) DEFAULT NULL,
  `num_productos` int(11) DEFAULT NULL,
  `kilos` double DEFAULT NULL,
  `precio_kilos` double DEFAULT NULL,
  `precio_total` double DEFAULT NULL,
  `status_pago` int(11) DEFAULT NULL,
  `fecha_compra` datetime DEFAULT NULL,
  `fecha_pago` datetime DEFAULT NULL,
  `tipo_pago` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_compras`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `derivados`
--

CREATE TABLE IF NOT EXISTS `derivados` (
  `id_derivados` int(11) NOT NULL AUTO_INCREMENT,
  `almacen` int(11) DEFAULT NULL,
  `mascara_cantidad` double DEFAULT NULL,
  `mascara_peso` double DEFAULT NULL,
  `lengua_cantidad` double DEFAULT NULL,
  `lengua_peso` double DEFAULT NULL,
  `sesos_peso` double DEFAULT NULL,
  `hueso_cabeza_peso` double DEFAULT NULL,
  `papada_cabeza_peso` double DEFAULT NULL,
  `recorte_cabeza_peso` double DEFAULT NULL,
  `manteca_peso` double DEFAULT NULL,
  `prensado_peso` double DEFAULT NULL,
  `sancocho_peso` double DEFAULT NULL,
  `chicharron_peso` double DEFAULT NULL,
  `ahumada_cantidad` double DEFAULT NULL,
  `ahumada_peso` double DEFAULT NULL,
  `tocino_cantidad` double DEFAULT NULL,
  `tocino_peso` double DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `persona_creacion` int(11) DEFAULT NULL,
  `persona_modificacion` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_derivados`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `derivados`
--

INSERT INTO `derivados` (`id_derivados`, `almacen`, `mascara_cantidad`, `mascara_peso`, `lengua_cantidad`, `lengua_peso`, `sesos_peso`, `hueso_cabeza_peso`, `papada_cabeza_peso`, `recorte_cabeza_peso`, `manteca_peso`, `prensado_peso`, `sancocho_peso`, `chicharron_peso`, `ahumada_cantidad`, `ahumada_peso`, `tocino_cantidad`, `tocino_peso`, `fecha`, `fecha_creacion`, `fecha_modificacion`, `persona_creacion`, `persona_modificacion`, `activo`) VALUES
(1, 1, NULL, 14, NULL, 35, 15, 24, 23, 54, 34, 45, 46, 45, NULL, 23, NULL, 34, '2016-01-25', '2016-01-25 00:00:00', '2016-01-25 00:00:00', 1, 1, 1),
(2, 1, NULL, 14, NULL, 35, 15, 24, 23, 54, 34, 45, 46, 45, NULL, 23, NULL, 34, '2016-01-25', '2016-01-25 00:00:00', '2016-01-25 00:00:00', 1, 1, 1),
(3, 1, NULL, 14, NULL, 35, 15, 24, 23, 54, 34, 45, 46, 45, NULL, 23, NULL, 34, '2016-01-26', '2016-01-26 00:00:00', '2016-01-26 00:00:00', 1, 1, 1),
(4, 1, NULL, 14, NULL, 35, 15, 24, 23, 54, 34, 45, 46, 45, NULL, 23, NULL, 34, '2016-01-28', '2016-01-28 00:00:00', '2016-01-28 00:00:00', 1, 1, 1),
(5, 1, 0, 14, 0, 35, 15, 24, 23, 54, 34, 45, 46, 45, 0, 23, 0, 34, '2016-02-03', '2016-02-03 00:00:00', '2016-02-03 00:00:00', 1, 1, 1),
(6, 1, 0, 14, 0, 35, 15, 24, 23, 54, 34, 45, 46, 45, 0, 23, 0, 34, '2016-02-03', '2016-02-03 00:00:00', '2016-02-03 00:00:00', 1, 1, 1),
(7, 1, 0, 14, 0, 35, 15, 24, 23, 54, 34, 45, 46, 45, 0, 23, 0, 34, '2016-02-04', '2016-02-04 00:00:00', '2016-02-04 00:00:00', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE IF NOT EXISTS `gastos` (
  `id_gastos` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_pago` date DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_gastos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id_gastos`, `fecha_pago`, `precio`, `descripcion`, `fecha_creacion`, `activo`) VALUES
(15, '2016-02-05', 20000, 'Pago de Renta                              ', '2016-02-03 02:33:23', 1),
(17, '2016-02-05', 50000, 'PAGO DE CANALES                                ', '2016-02-05 02:35:23', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE IF NOT EXISTS `inventario` (
  `id_inventario` int(11) NOT NULL AUTO_INCREMENT,
  `almacen` int(11) DEFAULT NULL,
  `pierna_cantidad` double DEFAULT NULL,
  `pierna_peso` double DEFAULT NULL,
  `costilla_cantidad` double DEFAULT NULL,
  `costilla_peso` double DEFAULT NULL,
  `lomo_cantidad` double DEFAULT NULL,
  `lomo_peso` double DEFAULT NULL,
  `espinazo_cantidad` double DEFAULT NULL,
  `espinazo_peso` double DEFAULT NULL,
  `barriga_cantidad` double DEFAULT NULL,
  `barriga_peso` double DEFAULT NULL,
  `cuero_cantidad` double DEFAULT NULL,
  `cuero_peso` double DEFAULT NULL,
  `pata_cantidad` double DEFAULT NULL,
  `pata_peso` double DEFAULT NULL,
  `hueso_peso` double DEFAULT NULL,
  `papada_peso` double DEFAULT NULL,
  `grasa_peso` double DEFAULT NULL,
  `cabeza_cantidad` double DEFAULT NULL,
  `cabeza_peso` double DEFAULT NULL,
  `varilla_cantidad` double DEFAULT NULL,
  `varilla_peso` double DEFAULT NULL,
  `rabo_cantidad` double DEFAULT NULL,
  `rabo_peso` double DEFAULT NULL,
  `chamorro_cantidad` double DEFAULT NULL,
  `chamorro_peso` double DEFAULT NULL,
  `piernachamorro_cantidad` double DEFAULT NULL,
  `piernachamorro_peso` double DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `persona_creacion` int(11) DEFAULT NULL,
  `persona_modificacion` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_inventario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `almacen`, `pierna_cantidad`, `pierna_peso`, `costilla_cantidad`, `costilla_peso`, `lomo_cantidad`, `lomo_peso`, `espinazo_cantidad`, `espinazo_peso`, `barriga_cantidad`, `barriga_peso`, `cuero_cantidad`, `cuero_peso`, `pata_cantidad`, `pata_peso`, `hueso_peso`, `papada_peso`, `grasa_peso`, `cabeza_cantidad`, `cabeza_peso`, `varilla_cantidad`, `varilla_peso`, `rabo_cantidad`, `rabo_peso`, `chamorro_cantidad`, `chamorro_peso`, `piernachamorro_cantidad`, `piernachamorro_peso`, `fecha`, `fecha_creacion`, `fecha_modificacion`, `persona_creacion`, `persona_modificacion`, `activo`) VALUES
(1, 1, 400, 100, 200, 200, 300, 300, 400, 400, 500, 500, NULL, 600, 600, 100, 100, 300, 400, 600, 100, NULL, 100, 200, 600, 700, 800, 300, 400, '2016-01-22', '2016-01-22 03:09:13', '2016-01-22 03:13:19', 1, 1, 1),
(3, 1, 400, 100, 200, 200, 300, 300, 400, 400, 500, 500, NULL, 600, 600, 100, 100, 300, 400, 600, 100, NULL, 100, 200, 600, 700, 800, 300, 400, '2016-01-25', '2016-01-25 00:00:00', '2016-01-25 00:00:00', 1, 1, 1),
(4, 1, 400, 100, 200, 200, 300, 300, 400, 400, 500, 500, NULL, 600, 600, 100, 100, 300, 400, 600, 100, NULL, 100, 200, 600, 700, 800, 300, 400, '2016-01-27', '2016-01-27 00:00:00', '2016-01-27 00:00:00', 1, 1, 1),
(5, 1, 400, 100, 200, 200, 300, 300, 400, 400, 500, 500, NULL, 600, 600, 100, 100, 300, 400, 600, 100, NULL, 100, 200, 600, 700, 800, 300, 400, '2016-01-28', '2016-01-28 00:00:00', '2016-01-28 00:00:00', 1, 1, 1),
(6, 1, 400, 100, 200, 200, 300, 300, 400, 400, 500, 500, 0, 600, 600, 100, 100, 300, 400, 600, 100, 0, 100, 200, 600, 700, 800, 300, 400, '2016-01-29', '2016-01-29 00:00:00', '2016-01-29 00:00:00', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipo_usuario` int(11) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `username`, `password`, `tipo_usuario`, `activo`) VALUES
(1, 'admin', 'Zn5G7hnkL0bhgf181dc9bdb52d04dc20036dbd8313ed055', 1, 1),
(2, 'inventario', 'Zn5G7hnkL0bhgf181dc9bdb52d04dc20036dbd8313ed055', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

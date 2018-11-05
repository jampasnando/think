-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2018 a las 01:31:07
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `think`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambientes_propios`
--

CREATE TABLE `ambientes_propios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ambientes_propios`
--

INSERT INTO `ambientes_propios` (`id`, `nombre`) VALUES
(1, 'baÃ±o'),
(2, 'cocineta'),
(3, 'Sala'),
(4, 'Suit'),
(6, 'comedor'),
(7, 'patio trasero'),
(8, 'baulera'),
(11, 'Dormitorio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambientes_propios_inmueble`
--

CREATE TABLE `ambientes_propios_inmueble` (
  `id` int(11) NOT NULL,
  `ambientes_propios_id` int(11) NOT NULL,
  `inmuebles_id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ambientes_propios_inmueble`
--

INSERT INTO `ambientes_propios_inmueble` (`id`, `ambientes_propios_id`, `inmuebles_id`, `cantidad`) VALUES
(12, 2, 49, 1),
(13, 1, 49, 1),
(50, 1, 67, 1),
(51, 2, 67, 1),
(52, 3, 67, 3),
(85, 1, 139, 2),
(86, 3, 139, 1),
(87, 1, 140, 2),
(88, 3, 140, 1),
(89, 4, 140, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areascomunes`
--

CREATE TABLE `areascomunes` (
  `id` int(11) NOT NULL,
  `area` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `areascomunes`
--

INSERT INTO `areascomunes` (`id`, `area`) VALUES
(1, 'salon de fiestas'),
(3, 'LavanderÃ­a'),
(7, 'Piscina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areascomunes_proyecto`
--

CREATE TABLE `areascomunes_proyecto` (
  `id` int(11) NOT NULL,
  `proyectos_id` int(11) NOT NULL,
  `areascomunes_id` int(11) NOT NULL,
  `dimension` varchar(45) DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  `direccion` text,
  `telefono_fijo` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `correo` varchar(200) DEFAULT NULL,
  `facebook` varchar(250) DEFAULT NULL,
  `whatsapp` varchar(45) DEFAULT NULL,
  `twitter` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `sexo`, `direccion`, `telefono_fijo`, `celular`, `correo`, `facebook`, `whatsapp`, `twitter`) VALUES
(1, 'Juan Perez', 'M', 'adfkaj ajdflak ', '53495839', '099879', '', '', '', ''),
(2, 'Carla Gomez', 'F', 'aljfa ajdflk sj akdjf', '72790611', '72790611', 'hhhkh', 'hkhkh', '', ''),
(3, 'Javier Bellot', 'M', 'jljljl', '4234543', '78744342', '', '', '879797', ''),
(4, 'Rosario Benavente', 'F', 'asdfaf', '', '799979', 'asdfadfasdf', '', '6464646', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esquema_colores`
--

CREATE TABLE `esquema_colores` (
  `id` int(11) NOT NULL,
  `esquema` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `esquema_colores`
--

INSERT INTO `esquema_colores` (`id`, `esquema`) VALUES
(1, '#674d3c:#d9ad7c:white:black'),
(2, '#034f84:#92a8d1:white:black'),
(3, '#c94c4c:#eea29a:white:black'),
(4, '#36486b:#618685:white:black'),
(5, '#77a8a8:#d9ecd0:white:black'),
(6, '#7e4a35:#cab577:white:black'),
(7, '#622569:#b8a9c9:white:black'),
(8, '#e06377:#f9d5e5:white:black'),
(9, '#588c7e:#96ceb4:white:black'),
(10, '#ffcc5c:#ffeead:white:black'),
(11, '#454140:#8ca3a3:white:black'),
(12, '#a6001a:#e06000:white:black'),
(13, '#373538:#9495a5:white:black'),
(14, '#004B8D:#95DEE3:white:black'),
(15, '#E94B3C:#ECDB54:white:black'),
(16, '#FC7307:#FFEBDC:white:black');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_inmueble`
--

CREATE TABLE `estados_inmueble` (
  `id` int(11) NOT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `acronimo` varchar(45) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados_inmueble`
--

INSERT INTO `estados_inmueble` (`id`, `estado`, `acronimo`, `color`) VALUES
(1, 'Vendido', 'V', 'rgb(126, 74, 53):rgb(202, 181, 119):rgb(255, 255, 255):rgb(0, 0, 0)'),
(2, 'Reservado', 'R', 'rgb(119, 168, 168):rgb(217, 236, 208):rgb(255, 255, 255):rgb(0, 0, 0)'),
(3, 'Disponible', 'D', 'rgb(3, 79, 132):rgb(146, 168, 209):rgb(255, 255, 255):rgb(0, 0, 0)'),
(4, 'Pre Venta', 'PV', 'rgb(252, 115, 7):rgb(255, 235, 220):rgb(255, 255, 255):rgb(0, 0, 0)'),
(5, 'Pre Reserva', 'PR', '#622569:#b8a9c9:white:black');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_proyecto`
--

CREATE TABLE `estados_proyecto` (
  `id` int(11) NOT NULL,
  `estado` varchar(200) DEFAULT NULL,
  `acronimo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados_proyecto`
--

INSERT INTO `estados_proyecto` (`id`, `estado`, `acronimo`) VALUES
(1, 'DiseÃ±o', 'D'),
(2, 'Construccion', 'C'),
(3, 'Terminado', 'T'),
(7, 'Test3', 'TT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos_inmueble`
--

CREATE TABLE `eventos_inmueble` (
  `id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `inmuebles_id` int(11) NOT NULL,
  `tipos_evento_id` varchar(250) NOT NULL,
  `fechahora_registro` datetime DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos_proyecto`
--

CREATE TABLE `eventos_proyecto` (
  `id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `proyectos_id` int(11) NOT NULL,
  `tipo_evento` varchar(200) DEFAULT NULL,
  `fechahora_registro` datetime DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles`
--

CREATE TABLE `inmuebles` (
  `id` int(11) NOT NULL,
  `proyectos_id` int(11) NOT NULL,
  `tipos_inmueble_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `precio_base` float DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `clientes_id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `acuenta` float DEFAULT NULL,
  `moneda_acuenta` varchar(45) DEFAULT NULL,
  `posfila` int(11) NOT NULL,
  `poscol` int(11) NOT NULL,
  `garaje` varchar(50) NOT NULL,
  `baulera` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inmuebles`
--

INSERT INTO `inmuebles` (`id`, `proyectos_id`, `tipos_inmueble_id`, `estado`, `precio_base`, `fecha_creacion`, `clientes_id`, `usuarios_id`, `fecha_inicio`, `fecha_fin`, `acuenta`, `moneda_acuenta`, `posfila`, `poscol`, `garaje`, `baulera`) VALUES
(67, 3, 1, 3, 30000, '2018-10-03 11:55:05', 1, 4, '2018-10-02 15:19:33', '2018-10-30 15:19:45', 300, 'dolares', 3, 3, '', ''),
(74, 1, 2, 4, 60000, '2018-10-05 16:49:53', 3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 10, 3, '', ''),
(75, 1, 1, 4, 60000, '2018-10-03 01:45:28', 2, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 7, 3, '', ''),
(79, 1, 1, 3, 0, '2018-10-04 23:46:12', 0, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 11, 2, '', ''),
(82, 1, 2, 3, 60000, '2018-10-03 22:52:37', 0, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 11, 3, '', ''),
(83, 1, 2, 2, 0, '2018-10-06 20:45:38', 1, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 10, 2, '', ''),
(84, 1, 1, 4, 0, '2018-10-06 20:46:02', 0, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 9, 2, '', ''),
(85, 1, 1, 3, 60000, '2018-10-06 20:46:49', 0, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 9, 3, '', ''),
(103, 1, 1, 2, 60000, '2018-10-18 16:45:16', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 3, '', ''),
(123, 3, 1, 3, 0, '2018-10-20 00:48:27', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 2, '', ''),
(124, 3, 1, 3, 0, '2018-10-20 00:48:29', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 3, '', ''),
(125, 3, 1, 3, 0, '2018-10-20 00:48:32', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 4, '', ''),
(126, 3, 1, 3, 0, '2018-10-20 00:48:35', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 3, '', ''),
(127, 3, 1, 3, 0, '2018-10-20 00:55:53', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 2, '', ''),
(128, 3, 2, 3, 0, '2018-10-20 00:55:55', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 2, '', ''),
(129, 3, 3, 3, 0, '2018-10-20 00:55:58', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 3, '', ''),
(130, 3, 3, 3, 0, '2018-10-20 00:56:01', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 4, '', ''),
(134, 3, 3, 3, 0, '2018-10-20 12:29:02', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 3, '', ''),
(135, 3, 3, 3, 0, '2018-10-20 12:29:16', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 2, '', ''),
(136, 3, 3, 3, 0, '2018-10-20 12:30:49', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 2, '', ''),
(139, 1, 1, 1, 0, '2018-10-21 08:18:27', 1, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 6, '700', '300'),
(140, 1, 1, 5, 45000, '2018-10-04 23:46:33', 1, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 11, 4, '', ''),
(143, 5, 1, 3, 0, '2018-10-21 09:23:07', 1, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 3, '', ''),
(144, 1, 1, 2, 45000, '2018-10-21 16:18:35', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 7, 4, '', ''),
(145, 1, 2, 3, 45000, '2018-10-21 16:18:38', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 7, 2, '', ''),
(146, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 1, 0, '', ''),
(147, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 1, 1, '', ''),
(148, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 1, 2, '', ''),
(149, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 1, 3, '', ''),
(150, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 1, 4, '', ''),
(151, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 1, 5, '', ''),
(152, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 0, '', ''),
(153, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 1, '', ''),
(154, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 2, '', ''),
(155, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 3, '', ''),
(156, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 4, '', ''),
(157, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 5, '', ''),
(158, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 0, '', ''),
(159, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 1, '', ''),
(161, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 3, '', ''),
(162, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 4, '', ''),
(163, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 5, '', ''),
(164, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 0, '', ''),
(165, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 1, '', ''),
(166, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 2, '', ''),
(167, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 3, '', ''),
(168, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 4, '', ''),
(169, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 5, '', ''),
(170, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 0, '', ''),
(171, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 1, '', ''),
(172, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 2, '', ''),
(173, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 3, '', ''),
(174, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 4, '', ''),
(175, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 5, '', ''),
(176, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 0, '', ''),
(177, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 1, '', ''),
(178, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 2, '', ''),
(179, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 3, '', ''),
(180, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 4, '', ''),
(181, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 5, '', ''),
(182, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 7, 0, '', ''),
(183, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 7, 1, '', ''),
(184, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 7, 2, '', ''),
(185, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 7, 3, '', ''),
(186, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 7, 4, '', ''),
(187, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 7, 5, '', ''),
(188, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 8, 0, '', ''),
(189, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 8, 1, '', ''),
(190, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 8, 2, '', ''),
(191, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 8, 3, '', ''),
(192, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 8, 4, '', ''),
(193, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 8, 5, '', ''),
(194, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 9, 0, '', ''),
(195, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 9, 1, '', ''),
(196, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 9, 2, '', ''),
(197, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 9, 3, '', ''),
(198, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 9, 4, '', ''),
(199, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 9, 5, '', ''),
(200, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 10, 0, '', ''),
(201, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 10, 1, '', ''),
(202, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 10, 2, '', ''),
(203, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 10, 3, '', ''),
(204, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 10, 4, '', ''),
(205, 7, 1, 3, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 10, 5, '', ''),
(206, 7, 1, 1, 0, '2018-10-21 17:30:30', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 2, '', ''),
(317, 8, 1, 3, 0, '2018-10-21 17:36:08', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 10, 2, '', ''),
(318, 8, 1, 3, 0, '2018-10-21 17:36:11', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 10, 3, '', ''),
(319, 8, 2, 3, 0, '2018-10-21 17:36:14', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 10, 4, '', ''),
(461, 3, 1, 3, 0, '2018-10-22 16:08:23', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 4, '', ''),
(462, 3, 2, 3, 0, '2018-10-22 16:08:26', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 4, '', ''),
(463, 3, 1, 3, 0, '2018-10-23 11:54:29', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 4, '', ''),
(464, 3, 1, 3, 0, '2018-10-23 11:59:12', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 5, '', ''),
(465, 1, 1, 3, 0, '2018-10-23 14:04:24', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 2, '', ''),
(466, 1, 1, 3, 0, '2018-10-23 14:23:56', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 2, '', ''),
(467, 1, 1, 3, 0, '2018-10-23 14:28:39', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 2, '', ''),
(469, 1, 1, 5, 60000, '2018-10-23 16:00:34', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 3, '', ''),
(588, 1, 1, 3, 0, '2018-10-23 18:38:27', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 9, 1, '', ''),
(589, 1, 1, 4, 45000, '2018-10-23 23:27:33', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 4, '', ''),
(590, 1, 1, 2, 0, '2018-10-24 21:47:00', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 2, '', ''),
(591, 1, 1, 3, 0, '2018-10-24 22:08:42', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 2, '', ''),
(592, 1, 1, 3, 60000, '2018-10-24 22:19:16', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 3, '', ''),
(593, 1, 1, 3, 0, '2018-10-24 22:32:41', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 1, '', ''),
(594, 1, 1, 3, 0, '2018-10-24 22:52:23', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 1, '', ''),
(595, 1, 1, 3, 60000, '2018-10-24 22:55:41', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 3, '', ''),
(598, 1, 1, 3, 0, '2018-10-24 22:59:23', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 1, '', ''),
(599, 1, 1, 3, 0, '2018-10-24 23:00:34', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 1, '', ''),
(600, 1, 1, 3, 45000, '2018-10-24 23:02:11', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 4, '', ''),
(601, 1, 1, 3, 0, '2018-10-24 23:03:11', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 1, '', ''),
(602, 1, 1, 3, 0, '2018-10-24 23:03:51', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 7, 1, '', ''),
(603, 1, 1, 2, 0, '2018-10-24 23:05:09', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 7, 5, '', ''),
(604, 1, 1, 3, 45000, '2018-10-24 23:05:19', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 8, 4, '', ''),
(605, 1, 1, 5, 0, '2018-10-24 23:06:49', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 5, '', ''),
(606, 1, 1, 2, 0, '2018-10-24 23:22:09', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 8, 5, '', ''),
(607, 1, 1, 3, 60000, '2018-10-24 23:25:04', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 8, 3, '', ''),
(608, 1, 1, 3, 0, '2018-10-24 23:25:15', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 8, 2, '', ''),
(609, 1, 1, 3, 0, '2018-10-24 23:27:06', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 8, 1, '', ''),
(610, 1, 1, 3, 45000, '2018-10-24 23:31:09', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 9, 4, '', ''),
(611, 1, 1, 2, 0, '2018-10-24 23:34:41', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 9, 5, '', ''),
(612, 1, 1, 3, 45000, '2018-10-24 23:42:22', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 10, 4, '', ''),
(613, 1, 1, 5, 0, '2018-10-25 10:16:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 5, '', ''),
(614, 1, 2, 3, 0, '2018-10-25 10:16:10', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 5, '', ''),
(615, 1, 3, 2, 0, '2018-10-25 12:08:35', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 6, '700', '300'),
(617, 1, 1, 2, 30000, '2018-10-25 23:10:23', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 6, '700', '300'),
(618, 1, 1, 3, 60000, '2018-10-24 22:56:22', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 3, '', ''),
(622, 1, 1, 2, 45000, '2018-10-23 15:29:28', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 4, '', '0'),
(623, 1, 1, 1, 45000, '2018-10-24 22:58:24', 2, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 4, '', '1000'),
(624, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 1, 0, '0', '0'),
(625, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 1, 1, '0', '0'),
(626, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 1, 2, '0', '0'),
(627, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 1, 3, '0', '0'),
(628, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 1, 4, '0', '0'),
(629, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 0, '0', '0'),
(630, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 1, '0', '0'),
(631, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 2, '0', '0'),
(632, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 3, '0', '0'),
(633, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 4, '0', '0'),
(634, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 0, '0', '0'),
(635, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 1, '0', '0'),
(636, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 2, '0', '0'),
(637, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 3, '0', '0'),
(638, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 4, '0', '0'),
(639, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 0, '0', '0'),
(640, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 1, '0', '0'),
(641, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 2, '0', '0'),
(642, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 3, '0', '0'),
(643, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 4, '0', '0'),
(644, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 0, '0', '0'),
(645, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 1, '0', '0'),
(646, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 2, '0', '0'),
(647, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 3, '0', '0'),
(648, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 4, '0', '0'),
(649, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 0, '0', '0'),
(650, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 1, '0', '0'),
(651, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 2, '0', '0'),
(652, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 3, '0', '0'),
(653, 14, 1, 3, 70000, '2018-10-26 16:20:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 4, '0', '0'),
(654, 1, 1, 3, 0, '2018-10-27 18:42:05', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 5, '', ''),
(655, 1, 1, 3, 0, '2018-10-27 18:46:26', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 4, '', ''),
(656, 1, 2, 3, 0, '2018-10-27 18:46:31', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 3, 6, '', ''),
(657, 1, 3, 3, 0, '2018-10-27 18:46:36', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 2, 5, '', ''),
(658, 1, 1, 3, 0, '2018-10-27 18:59:56', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 1, 1, '', ''),
(659, 1, 2, 3, 0, '2018-10-27 19:01:05', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 1, 2, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `telefonos` varchar(45) DEFAULT NULL,
  `latitud` varchar(45) DEFAULT NULL,
  `longitud` varchar(45) DEFAULT NULL,
  `fechareg` datetime DEFAULT NULL,
  `descripcion` text,
  `estado` int(11) NOT NULL,
  `avance` varchar(250) NOT NULL,
  `textofilas` text NOT NULL,
  `textocols` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `nombre`, `direccion`, `telefonos`, `latitud`, `longitud`, `fechareg`, `descripcion`, `estado`, `avance`, `textofilas`, `textocols`) VALUES
(1, 'Edificio Santa Ana', 'aaaaaaaaaa', '7678687', '97979', '78767', '2000-03-03 00:00:00', 'ljalsdfja\r\nasdkjfladj', 3, '100%', '13:12:11:9:8:7:6:5:4:2:PB', 'A:B:C@lasjflasjfd:AAAAAAAA\r\nBBBBBBBBB@CCCCCCCCC\r\nDDDDDDD:Edddd222@EEEEEEEEEEE\r\nFFFFFFFFFFF:F:G'),
(3, 'Edificio Pentagono', 'adfafdfsa', '898434', '5235425', '3422354', '2000-04-04 00:00:00', 'asdfas lasjfakls\r\nasjdfladsjfla', 3, '40%', '5:4:3:2A:1:PB', 'A:B:C:D:E:F:G:[SinNombre]'),
(4, 'Condominio Dubai', 'ljkl lkjlk lk xx', '0898989', '222333', '', '0000-00-00 00:00:00', 'wwetrwertw', 3, '35%', '11:10:4:3:2:1:PB', 'A:B:C:D:E:F:G'),
(5, 'Torres de Norte', 'jalkjfakldjklx', '35534', '45444444', '23244', '2000-04-04 00:00:00', 'afdafaf', 3, '52%', '4:3:2:1:PB', 'A:B:C:D:E:F:G'),
(7, 'Edificio Monumental', 'jlajdfa lajfdkajflkajfakjf lk', '2352345', '', '', '2018-10-21 17:30:30', '', 3, '100%', '9:8:7:6:5:4:3:2:1:PB', 'A:B:C:D:E'),
(8, 'Edificio PuntaCana', 'jsfdlkajfa', '3425254', '', '', '2018-10-21 17:35:33', '', 2, '50%', '9:8:7:6:5:4:3:2:1:PB', 'A:B:C:D:E:F:G:H:I:J'),
(14, 'Edificio Real', '', '', '', '', '2018-10-26 16:20:07', '', 3, '100%', '5:4:3:2:1:PB', 'A:B:C:D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_inmueble`
--

CREATE TABLE `tipos_inmueble` (
  `id` int(11) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `icono` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_inmueble`
--

INSERT INTO `tipos_inmueble` (`id`, `tipo`, `icono`) VALUES
(1, 'Departamento', 'images/departamento.png'),
(2, 'Oficina', 'images/oficina.png'),
(3, 'Local Comercial', 'images/comercial.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuario`
--

CREATE TABLE `tipos_usuario` (
  `id` int(11) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_usuario`
--

INSERT INTO `tipos_usuario` (`id`, `tipo`) VALUES
(1, 'Vendedor'),
(2, 'Secretaria'),
(3, 'Supervisor'),
(4, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `ci` varchar(45) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `fijo` varchar(45) DEFAULT NULL,
  `direccion` text,
  `facebook` varchar(200) DEFAULT NULL,
  `correo` varchar(200) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `ci`, `fecha_nac`, `sexo`, `celular`, `fijo`, `direccion`, `facebook`, `correo`, `login`, `password`, `tipo`) VALUES
(4, 'Fernando Garcia', '3560308', '0000-00-00', 'M', '7654321', '456789', 'fhfhhvhv', 'hvhvhvhvhgv', 'aljfda@gmail.com', 'fernando', '123', 1),
(5, 'Juan Jose', '997987', '2000-02-02', 'M', '080808', '09808080', 'uoohlkjlk', 'hkjhjkhkhkj', 'hkhk@hkhk.com', 'juanjo', '123', 3),
(6, 'Piter', '304503', '0000-00-00', 'M', '8687698', '', '', '', '', 'piter', '123', 3),
(9, 'Susana Rivero', '34262', '0000-00-00', '', '', '', '', '', '', 'susana', '123', 1),
(11, 'Maria Eugenia Vargas', '2354235', '0000-00-00', '', '', '', '', '', '', 'maria', '123', 1),
(12, 'Gustavo Soto', '79798797', '0000-00-00', '', '', '', '', '', 'afadfs@sgsdgf', 'gustavo', '123', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ambientes_propios`
--
ALTER TABLE `ambientes_propios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ambientes_propios_inmueble`
--
ALTER TABLE `ambientes_propios_inmueble`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ambientes_propios_propiedad_ambientes_propios1_idx` (`ambientes_propios_id`),
  ADD KEY `fk_ambientes_propios_inmueble_inmuebles1_idx` (`inmuebles_id`);

--
-- Indices de la tabla `areascomunes`
--
ALTER TABLE `areascomunes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `areascomunes_proyecto`
--
ALTER TABLE `areascomunes_proyecto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_areascomunes_proyecto_proyectos1_idx` (`proyectos_id`),
  ADD KEY `fk_areascomunes_proyecto_areascomunes1_idx` (`areascomunes_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `esquema_colores`
--
ALTER TABLE `esquema_colores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados_inmueble`
--
ALTER TABLE `estados_inmueble`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados_proyecto`
--
ALTER TABLE `estados_proyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos_inmueble`
--
ALTER TABLE `eventos_inmueble`
  ADD PRIMARY KEY (`id`,`usuarios_id`,`inmuebles_id`),
  ADD KEY `fk_eventos_inmueble_usuarios1_idx` (`usuarios_id`),
  ADD KEY `fk_eventos_inmueble_inmuebles1_idx` (`inmuebles_id`);

--
-- Indices de la tabla `eventos_proyecto`
--
ALTER TABLE `eventos_proyecto`
  ADD PRIMARY KEY (`id`,`usuarios_id`,`proyectos_id`),
  ADD KEY `fk_eventos_proyecto_usuarios1_idx` (`usuarios_id`),
  ADD KEY `fk_eventos_proyecto_proyectos1_idx` (`proyectos_id`);

--
-- Indices de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD PRIMARY KEY (`id`,`proyectos_id`,`tipos_inmueble_id`,`estado`),
  ADD KEY `fk_inmuebles_tipos_inmueble1_idx` (`tipos_inmueble_id`),
  ADD KEY `fk_inmuebles_proyectos1_idx` (`proyectos_id`),
  ADD KEY `fk_inmuebles_clientes1_idx` (`clientes_id`),
  ADD KEY `fk_inmuebles_usuarios1_idx` (`usuarios_id`),
  ADD KEY `fk_inmuebles_estados_inmueble1_idx` (`estado`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_proyectos_estados_proyecto1_idx` (`estado`);

--
-- Indices de la tabla `tipos_inmueble`
--
ALTER TABLE `tipos_inmueble`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`,`tipo`),
  ADD KEY `fk_usuarios_tipos_usuario1_idx` (`tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ambientes_propios`
--
ALTER TABLE `ambientes_propios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `ambientes_propios_inmueble`
--
ALTER TABLE `ambientes_propios_inmueble`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `areascomunes`
--
ALTER TABLE `areascomunes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `areascomunes_proyecto`
--
ALTER TABLE `areascomunes_proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `esquema_colores`
--
ALTER TABLE `esquema_colores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `estados_inmueble`
--
ALTER TABLE `estados_inmueble`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estados_proyecto`
--
ALTER TABLE `estados_proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `eventos_inmueble`
--
ALTER TABLE `eventos_inmueble`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos_proyecto`
--
ALTER TABLE `eventos_proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=660;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tipos_inmueble`
--
ALTER TABLE `tipos_inmueble`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `areascomunes_proyecto`
--
ALTER TABLE `areascomunes_proyecto`
  ADD CONSTRAINT `fk_areascomunes_proyecto_areascomunes1` FOREIGN KEY (`areascomunes_id`) REFERENCES `areascomunes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_areascomunes_proyecto_proyectos1` FOREIGN KEY (`proyectos_id`) REFERENCES `proyectos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `eventos_inmueble`
--
ALTER TABLE `eventos_inmueble`
  ADD CONSTRAINT `fk_eventos_inmueble_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `eventos_proyecto`
--
ALTER TABLE `eventos_proyecto`
  ADD CONSTRAINT `fk_eventos_proyecto_proyectos1` FOREIGN KEY (`proyectos_id`) REFERENCES `proyectos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_eventos_proyecto_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD CONSTRAINT `fk_inmuebles_proyectos1` FOREIGN KEY (`proyectos_id`) REFERENCES `proyectos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inmuebles_tipos_inmueble1` FOREIGN KEY (`tipos_inmueble_id`) REFERENCES `tipos_inmueble` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `fk_proyectos_estados_proyecto1` FOREIGN KEY (`estado`) REFERENCES `estados_proyecto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_tipos_usuario_id` FOREIGN KEY (`tipo`) REFERENCES `tipos_usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

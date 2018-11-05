-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2018 a las 01:46:15
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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `esquema_colores`
--
ALTER TABLE `esquema_colores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `esquema_colores`
--
ALTER TABLE `esquema_colores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

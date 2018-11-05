-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2018 a las 06:10:40
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
(3, 'Sala');

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
(52, 3, 67, 3);

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
(2, 'Piscina'),
(3, 'LavanderÃ­a');

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
(2, 'Carla Gomez', 'F', 'aljfa ajdflk sj akdjf', '07987986', '896786', 'hhhkh', 'hkhkh', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_inmueble`
--

CREATE TABLE `estados_inmueble` (
  `id` int(11) NOT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `acronimo` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados_inmueble`
--

INSERT INTO `estados_inmueble` (`id`, `estado`, `acronimo`, `color`) VALUES
(1, 'Vendido', 'V', 'CEA430'),
(2, 'Reservado', 'R', 'FFC85A'),
(3, 'Disponible', 'D', 'CAFFFF'),
(4, 'Pre Venta', 'PV', 'F9FF45'),
(5, 'Pre Reserva', 'PR', '82FFC9');

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
(2, 'Construccion', 'C');

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
  `poscol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inmuebles`
--

INSERT INTO `inmuebles` (`id`, `proyectos_id`, `tipos_inmueble_id`, `estado`, `precio_base`, `fecha_creacion`, `clientes_id`, `usuarios_id`, `fecha_inicio`, `fecha_fin`, `acuenta`, `moneda_acuenta`, `posfila`, `poscol`) VALUES
(3, 1, 2, 2, 0, '2018-10-02 22:20:14', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 5),
(8, 1, 1, 2, 40000, '2018-10-03 01:45:28', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 4, 4),
(49, 3, 1, 3, 0, '2018-10-03 14:38:07', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 5),
(67, 3, 1, 3, 30000, '2018-10-03 11:55:05', 1, 4, '2018-10-02 15:19:33', '2018-10-30 15:19:45', 300, 'dolares', 5, 3),
(68, 1, 2, 3, 0, '2018-10-03 22:52:37', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 6, 3);

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
(1, 'Edificio Santa Ana', 'ljljljhjhjghj', '7678687', '97979', '78767', '2000-03-03 00:00:00', 'ljalsdfja\r\nasdkjfladj', 1, '50%', '7:6:5:4:2:PB', 'A:B:C:D12-D14:AAVVCC:F:G'),
(3, 'Edificio Pentagono', 'adfafdfsa', '898434', '', '', '2000-04-04 00:00:00', 'asdfas lasjfakls\r\nasjdfladsjfla', 2, '40%', '4:3:2A:1:PB', 'A:B:C:D:E:F:G');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_inmueble`
--

CREATE TABLE `tipos_inmueble` (
  `id` int(11) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_inmueble`
--

INSERT INTO `tipos_inmueble` (`id`, `tipo`) VALUES
(1, 'Departamento'),
(2, 'Oficina'),
(3, 'Local Comercial');

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
(5, 'Juan Jose', '997987', '2000-02-02', 'M', '080808', '09808080', 'uoohlkjlk', 'hkjhjkhkhkj', 'hkhk@hkhk.com', 'juanjo', '123', 3);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ambientes_propios_inmueble`
--
ALTER TABLE `ambientes_propios_inmueble`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `areascomunes`
--
ALTER TABLE `areascomunes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `areascomunes_proyecto`
--
ALTER TABLE `areascomunes_proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estados_inmueble`
--
ALTER TABLE `estados_inmueble`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estados_proyecto`
--
ALTER TABLE `estados_proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipos_inmueble`
--
ALTER TABLE `tipos_inmueble`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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

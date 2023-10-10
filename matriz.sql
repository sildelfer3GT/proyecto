-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2023 a las 15:18:15
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `matriz`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `idjefe` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `nombre`, `idjefe`) VALUES
(1, 'diseño login', '2'),
(2, 'diseño index', '2'),
(7, 'hjg', '3'),
(8, 'qwe', '3'),
(9, 'pioi', '3'),
(10, 'hola', '3'),
(13, 'Diseño de Salida', '5'),
(14, 'B', '5'),
(15, 'C', '5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `idjefe` varchar(25) NOT NULL,
  `disp` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `apellido`, `idjefe`, `disp`) VALUES
(2, 'Ezequiel', 'Rojas', '2', 0),
(3, 'Evelyn', 'Fernandez', '5', 0),
(4, 'Araceli', 'Fernandez', '5', 0),
(5, 'LL', 'jj', '5', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_actividad`
--

CREATE TABLE `empleados_actividad` (
  `id` int(11) NOT NULL,
  `idempleado` int(11) NOT NULL,
  `idactividad` int(11) NOT NULL,
  `proyecto` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados_actividad`
--

INSERT INTO `empleados_actividad` (`id`, `idempleado`, `idactividad`, `proyecto`, `estado`) VALUES
(6, 2, 2, 1, 0),
(7, 3, 13, 14, 0),
(9, 5, 14, 14, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` varchar(12) NOT NULL,
  `actividades` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `nombre`, `estado`, `actividades`, `usuario`) VALUES
(1, 'Proyecto A', 'Proceso', '', '2'),
(5, 'Proyecto B', 'Proceso', '', '2'),
(6, 'Diseño X', 'Pausa', '', '2'),
(9, 'Proyecto2', 'Finalizado', '', '3'),
(10, 'hjg', 'Proceso', '', '3'),
(11, 'Master', 'Proceso', '', '4'),
(13, 'Panel', 'Pausa', '', '4'),
(14, 'Proyecto M', 'Proceso', '', '5'),
(15, 'Proyexto B', 'Proceso', '', '5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contra` varchar(255) NOT NULL,
  `proyectos` varchar(255) NOT NULL COMMENT 'cadena de los ids de sus proyectos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `apellido`, `nombre`, `email`, `contra`, `proyectos`) VALUES
(2, 'Salgado ', 'Maria ', 'mafersae@gmail.com', 'maria05fer', ''),
(3, 'jwoo', 'jhose', 'jhosejwoo@gmail.com', 'jwoo', ''),
(4, 'silvestre', 'maily', 'mailysilvestrem@gmail.com', 'cualqiera', ''),
(5, 'Mamani', 'Jhoselin', 'Jhoselin@gmail.com', 'mamani', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados_actividad`
--
ALTER TABLE `empleados_actividad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idempleado` (`idempleado`,`idactividad`),
  ADD KEY `idactividad` (`idactividad`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `empleados_actividad`
--
ALTER TABLE `empleados_actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleados_actividad`
--
ALTER TABLE `empleados_actividad`
  ADD CONSTRAINT `empleados_actividad_ibfk_2` FOREIGN KEY (`idactividad`) REFERENCES `actividades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empleados_actividad_ibfk_3` FOREIGN KEY (`idempleado`) REFERENCES `empleados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-03-2023 a las 19:01:03
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_taller`
--
CREATE DATABASE IF NOT EXISTS `bd_taller` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bd_taller`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` smallint(2) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fechaCrea` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `nombre`, `estado`, `fechaCrea`) VALUES
(1, 'Director Ejecutivo', 'A', '2023-03-13 13:21:10'),
(2, 'Director de Operaciones', 'A', '2023-03-13 13:21:10'),
(3, 'Director Comercial', 'A', '2023-03-13 13:21:10'),
(4, 'Director de Marketing', 'A', '2023-03-13 13:21:10'),
(5, 'Director de Recursos Humanos', 'A', '2023-03-13 13:21:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` smallint(2) NOT NULL,
  `id_pais` smallint(2) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fechaCrea` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `id_pais`, `nombre`, `estado`, `fechaCrea`) VALUES
(1, 1, 'Atlantico', 'A', '2023-03-13 13:21:21'),
(2, 1, 'Antioquia', 'A', '2023-03-13 13:21:21'),
(3, 2, 'Napo', 'A', '2023-03-13 13:21:21'),
(4, 2, 'Esmeraldas', 'A', '2023-03-13 13:21:21'),
(5, 3, 'Paris', 'A', '2023-03-13 13:21:21'),
(6, 3, 'Calvados', 'A', '2023-03-13 13:21:21'),
(7, 4, 'Lacio', 'A', '2023-03-13 13:21:21'),
(8, 4, 'Liguria', 'A', '2023-03-13 13:21:21'),
(9, 5, 'Kinki', 'A', '2023-03-13 13:21:21'),
(10, 5, 'Kanto', 'A', '2023-03-13 13:21:21'),
(11, 1, 'Putomayo', 'A', '2023-03-13 15:51:02'),
(12, 1, 'Amazona', 'A', '2023-03-13 16:18:02'),
(13, 4, 'Lile', 'A', '2023-03-13 16:19:14'),
(14, 7, 'Chic', 'A', '2023-03-14 12:34:18'),
(15, 6, 'Tuli', 'A', '2023-03-14 13:56:30'),
(17, 2, '123', 'A', '2023-03-22 17:16:38'),
(18, 3, 'Pana', 'A', '2023-03-27 20:15:49'),
(19, 1, 'Juan Mina', 'A', '2023-03-27 21:30:36'),
(20, 3, 'Amaz', 'A', '2023-03-27 21:46:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` smallint(2) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `id_municipio` smallint(2) NOT NULL,
  `nacimientoAno` year(4) NOT NULL,
  `id_cargo` smallint(2) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fechaCrea` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombres`, `apellidos`, `id_municipio`, `nacimientoAno`, `id_cargo`, `estado`, `fechaCrea`) VALUES
(1, 'Andres', 'De la Hoz Martinez', 5, 1980, 1, 'A', '2023-03-13 13:20:54'),
(2, 'Jose Luis', 'Carrasco Mendez', 1, 1980, 1, 'A', '2023-03-13 13:20:54'),
(3, 'Josefa Jose', 'Restrepo Vargas', 3, 1990, 1, 'A', '2023-03-13 13:20:54'),
(4, 'Andrade', 'Perez Gomez', 10, 1999, 1, 'A', '2023-03-13 13:20:54'),
(5, 'Johana', 'Zambrano Rodriguez', 8, 1999, 1, 'A', '2023-03-13 13:20:54'),
(6, 'Yuranis', 'Torres Contreras', 1, 2001, 2, 'A', '2023-03-13 13:20:54'),
(7, 'Pedro Francisco', 'Fuentes Aguas', 1, 1995, 2, 'A', '2023-03-13 13:20:54'),
(8, 'Faiver', 'Fuentes Aguas', 4, 1983, 2, 'A', '2023-03-13 13:20:54'),
(9, 'Moises David', 'Mazo Solano', 4, 1983, 2, 'A', '2023-03-13 13:20:54'),
(10, 'Isabella', 'Rodriguez Martinez', 7, 1998, 2, 'A', '2023-03-13 13:20:54'),
(11, 'Ethan', 'James Anderson', 6, 1992, 3, 'A', '2023-03-13 13:20:54'),
(12, 'Emily', 'Grace Wilson', 3, 1996, 3, 'A', '2023-03-13 13:20:54'),
(13, 'Jhosua David', 'Lee Son', 10, 1989, 3, 'A', '2023-03-13 13:20:54'),
(14, 'Olivia Marie', 'Taylor Davis', 5, 1985, 3, 'A', '2023-03-13 13:20:54'),
(15, 'Alexander', 'Adams Brown', 2, 2000, 3, 'A', '2023-03-13 13:20:54'),
(16, 'Ava', 'Anderson Collins', 7, 1998, 4, 'A', '2023-03-13 13:20:54'),
(17, 'Lucas', 'Perez Baker', 5, 1991, 4, 'A', '2023-03-13 13:20:54'),
(18, 'Mia Olivia', 'Parker Turner', 5, 1991, 4, 'A', '2023-03-13 13:20:54'),
(19, 'William', 'Wright Bailey', 9, 1997, 4, 'A', '2023-03-13 13:20:54'),
(20, 'Hector', 'Ramos Perez', 2, 1993, 4, 'A', '2023-03-13 13:20:54'),
(21, 'Jordan David', 'Rocas Gonzales', 5, 1999, 5, 'A', '2023-03-13 13:20:54'),
(22, 'Juan', 'Mendoza Torres', 2, 1997, 5, 'A', '2023-03-13 13:20:54'),
(23, 'Martha', 'Salazar Hurtado', 2, 1997, 5, 'A', '2023-03-13 13:20:54'),
(24, 'Luis', 'Lopez Bayardo', 3, 1988, 5, 'A', '2023-03-13 13:20:54'),
(25, 'Daniel Efren', 'Daza Timana', 8, 1985, 5, 'A', '2023-03-13 13:20:54'),
(59, 'acasdasd', 'asd', 1, 2008, 2, 'A', '2023-03-30 21:51:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` smallint(2) NOT NULL,
  `id_dpto` smallint(2) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fechaCrea` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `id_dpto`, `nombre`, `estado`, `fechaCrea`) VALUES
(1, 1, 'Barranquilla', 'A', '2023-03-13 13:21:36'),
(2, 2, 'Medellin', 'A', '2023-03-13 13:21:36'),
(3, 3, 'Tena', 'A', '2023-03-13 13:21:36'),
(4, 4, 'Esmeraldas', 'A', '2023-03-13 13:21:36'),
(5, 5, 'Paris', 'A', '2023-03-13 13:21:36'),
(6, 6, 'Caen', 'A', '2023-03-13 13:21:36'),
(7, 7, 'Roma', 'A', '2023-03-13 13:21:36'),
(8, 8, 'Genova', 'A', '2023-03-13 13:21:36'),
(9, 9, 'Osaka', 'A', '2023-03-13 13:21:36'),
(10, 10, 'Toki', 'A', '2023-03-13 13:21:36'),
(11, 1, 'Yuju', 'A', '2023-03-14 14:02:11'),
(12, 15, 'Neymar', 'I', '2023-03-14 14:05:26'),
(13, 2, 'a', 'A', '2023-03-22 12:22:02'),
(14, 14, 'a', 'A', '2023-03-22 14:22:59'),
(15, 3, 'lalal', 'A', '2023-03-23 13:50:16'),
(16, 4, 'yuñle', 'A', '2023-03-23 13:51:57'),
(17, 11, 'JAJ', 'A', '2023-03-29 15:00:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` smallint(2) NOT NULL,
  `codigo` smallint(2) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fechaCrea` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `codigo`, `nombre`, `estado`, `fechaCrea`) VALUES
(1, 123, 'Colombia', 'A', '2023-03-13 12:59:26'),
(2, 222, 'Ecuador', 'A', '2023-03-13 12:59:26'),
(3, 5, 'Francia', 'A', '2023-03-13 12:59:26'),
(4, 9098, 'Italia', 'A', '2023-03-13 12:59:26'),
(5, 342, 'Japon', 'A', '2023-03-13 12:59:26'),
(6, 45, 'Brasil', 'A', '2023-03-13 20:40:37'),
(7, 33, 'Peru', 'A', '2023-03-14 17:34:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salarios`
--

CREATE TABLE `salarios` (
  `id` smallint(2) NOT NULL,
  `periodoAno` year(4) NOT NULL,
  `id_empleado` smallint(2) NOT NULL,
  `sueldo` decimal(14,2) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fechaCrea` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salarios`
--

INSERT INTO `salarios` (`id`, `periodoAno`, `id_empleado`, `sueldo`, `estado`, `fechaCrea`) VALUES
(1, 2023, 1, '90111.00', 'A', '2023-03-13 13:21:58'),
(2, 2023, 2, '10000000.00', 'A', '2023-03-13 13:21:58'),
(3, 2023, 3, '12000000.00', 'A', '2023-03-13 13:21:58'),
(4, 2023, 3, '13000000.00', 'A', '2023-03-13 13:21:58'),
(5, 2023, 4, '14000000.00', 'A', '2023-03-13 13:21:58'),
(6, 2023, 5, '15000000.00', 'A', '2023-03-13 13:21:58'),
(7, 2023, 6, '16000000.00', 'A', '2023-03-13 13:21:58'),
(8, 2023, 7, '17000000.00', 'A', '2023-03-13 13:21:58'),
(9, 2023, 8, '18000000.00', 'A', '2023-03-13 13:21:58'),
(10, 2023, 9, '19000000.00', 'A', '2023-03-13 13:21:58'),
(11, 2023, 10, '20000000.00', 'A', '2023-03-13 13:21:58'),
(12, 2023, 11, '21000000.00', 'A', '2023-03-13 13:21:58'),
(13, 2023, 12, '22000000.00', 'A', '2023-03-13 13:21:58'),
(14, 2023, 13, '23000000.00', 'A', '2023-03-13 13:21:58'),
(15, 2023, 14, '24000000.00', 'A', '2023-03-13 13:21:58'),
(16, 2023, 15, '25000000.00', 'A', '2023-03-13 13:21:58'),
(17, 2023, 16, '26000000.00', 'A', '2023-03-13 13:21:58'),
(18, 2023, 17, '27000000.00', 'A', '2023-03-13 13:21:58'),
(19, 2023, 18, '28000000.00', 'A', '2023-03-13 13:21:58'),
(20, 2023, 19, '29000000.00', 'A', '2023-03-13 13:21:58'),
(21, 2023, 20, '30000000.00', 'A', '2023-03-13 13:21:58'),
(22, 2023, 21, '31000000.00', 'A', '2023-03-13 13:21:58'),
(23, 2023, 22, '32000000.00', 'A', '2023-03-13 13:21:58'),
(24, 2023, 23, '33000000.00', 'A', '2023-03-13 13:21:58'),
(25, 2023, 24, '24000000.00', 'A', '2023-03-13 13:21:58'),
(26, 2023, 25, '25000000.00', 'A', '2023-03-13 13:21:58'),
(27, 2010, 49, '21313.00', 'A', '2023-03-16 20:20:03'),
(28, 2009, 50, '123123.00', 'A', '2023-03-16 21:54:29'),
(29, 2008, 51, '3222222.00', 'A', '2023-03-21 19:34:54'),
(30, 2011, 52, '123123.00', 'A', '2023-03-21 20:15:27'),
(31, 2010, 53, '23.00', 'A', '2023-03-21 20:16:00'),
(32, 2015, 54, '21312.00', 'A', '2023-03-21 20:16:40'),
(33, 2018, 55, '123123.00', 'A', '2023-03-21 20:17:13'),
(34, 2008, 56, '123.00', 'A', '2023-03-22 19:23:20'),
(35, 2022, 1, '123123.00', 'I', '2023-03-27 17:29:25'),
(36, 2018, 1, '22.00', 'A', '2023-03-27 17:29:58'),
(37, 2023, 7, '1234.00', 'I', '2023-03-27 18:56:08'),
(38, 2023, 57, '123.00', 'A', '2023-03-27 20:06:32'),
(39, 2019, 55, '1000000.00', 'A', '2023-03-27 21:53:36'),
(40, 2023, 58, '122.00', 'A', '2023-03-27 21:58:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` smallint(2) NOT NULL,
  `nombres` varchar(50) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `apellidos` varchar(50) NOT NULL,
  `n_iden` varchar(15) NOT NULL,
  `contrasena` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `estado` char(2) NOT NULL DEFAULT 'A',
  `fechaCrea` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pais` (`id_pais`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_municipio` (`id_municipio`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dpto` (`id_dpto`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salarios`
--
ALTER TABLE `salarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empleado` (`id_empleado`);

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
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `salarios`
--
ALTER TABLE `salarios`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `departamentos_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id`),
  ADD CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id`);

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`id_dpto`) REFERENCES `departamentos` (`id`);

--
-- Filtros para la tabla `salarios`
--
ALTER TABLE `salarios`
  ADD CONSTRAINT `salarios_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

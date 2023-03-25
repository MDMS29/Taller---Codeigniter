-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-03-2023 a las 16:38:43
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

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
CREATE DATABASE IF NOT EXISTS `bd_taller1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bd_taller1`;

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
(14, 7, 'Chico', 'A', '2023-03-14 12:34:18'),
(15, 6, 'Tuli', 'I', '2023-03-14 13:56:30');

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
(1, 'Andres', 'De la Hoz Martinez', 1, 1980, 1, 'A', '2023-03-13 13:20:54'),
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
(25, 'Daniel Efren', 'Daza Timana', 7, 1985, 5, 'A', '2023-03-13 13:20:54'),
(26, 'Moises', 'Prueba', 12, 2005, 1, 'A', '2023-03-14 14:41:40'),
(27, 'asdasd', 'asdasd', 9, 2008, 2, 'A', '2023-03-14 19:44:41'),
(28, 'asdasd', 'asdasd', 9, 2008, 2, 'A', '2023-03-14 19:49:33'),
(29, 'asdasd', 'asdasd', 9, 2008, 2, 'A', '2023-03-14 19:49:43'),
(30, 'asdasd', 'asdasd', 9, 2008, 2, 'A', '2023-03-14 19:49:47'),
(31, 'asdasd', 'asdasd', 9, 2008, 2, 'A', '2023-03-14 19:49:52'),
(32, 'asdasd', 'asdasd', 9, 2008, 2, 'A', '2023-03-14 19:50:00'),
(33, 'asdasd', 'asdasd', 9, 2008, 2, 'A', '2023-03-14 19:50:17'),
(34, 'asdasd', 'asdasd', 9, 2008, 2, 'A', '2023-03-14 19:50:18'),
(35, 'asdasd', 'asdasd', 9, 2008, 2, 'A', '2023-03-14 19:50:46'),
(36, 'asdasd', 'asdasd', 9, 2008, 2, 'A', '2023-03-14 19:52:20'),
(37, 'asdsa', 'asdkjjklasd', 9, 2005, 1, 'A', '2023-03-14 19:52:38'),
(38, 'asdsa', 'asdkjjklasd', 9, 2005, 1, 'A', '2023-03-14 19:53:16'),
(39, 'asdsa', 'asdkjjklasd', 9, 2005, 1, 'A', '2023-03-14 19:53:33'),
(40, 'fbfgn', 'mnbm,', 9, 2005, 3, 'A', '2023-03-14 19:53:43'),
(41, 'assa', 'dadad', 9, 2008, 1, 'A', '2023-03-14 19:55:25'),
(42, 'asdasd', 'asdasdasd', 8, 2010, 1, 'A', '2023-03-14 19:57:17'),
(43, 'asdasd', 'asdasdasd', 8, 2010, 1, 'A', '2023-03-14 19:57:33'),
(44, 'asdasd', 'asdasdasd', 9, 2007, 1, 'A', '2023-03-14 20:01:47'),
(45, 'PPPPPP', 'asdasdasd', 9, 2007, 1, 'A', '2023-03-14 20:02:57'),
(47, 'asdasd', 'sadasd', 2, 2022, 1, 'A', '2023-03-16 20:18:01'),
(48, 'asdasd', 'sadasd', 2, 2022, 1, 'A', '2023-03-16 20:18:50'),
(49, 'asdasd', 'sadasd', 2, 2022, 1, 'A', '2023-03-16 20:20:03');

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
(12, 15, 'Neymar', 'A', '2023-03-14 14:05:26');

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
(2, 3455, 'Ecuador', 'A', '2023-03-13 12:59:26'),
(3, 747, 'Francia', 'A', '2023-03-13 12:59:26'),
(4, 9098, 'Italia', 'A', '2023-03-13 12:59:26'),
(5, 342, 'Japon', 'A', '2023-03-13 12:59:26'),
(6, 45, 'Brasil', 'A', '2023-03-13 20:40:37'),
(7, 33, 'Peru', 'A', '2023-03-14 17:34:07'),
(8, 123, 'Colombia', 'I', '2023-03-14 21:43:27'),
(9, 123, 'Colombia', 'A', '2023-03-14 21:43:34'),
(10, 123, 'Colombia', 'I', '2023-03-14 21:43:44'),
(11, 123, 'Colombiaa', 'I', '2023-03-14 21:44:46'),
(12, 123, 'Colombia', 'I', '2023-03-14 21:45:06'),
(13, 0, ' mOISES', 'I', '2023-03-14 21:53:13'),
(14, 0, 'asdasd', 'I', '2023-03-14 21:53:21'),
(15, 0, 'a', 'I', '2023-03-14 21:53:26'),
(16, 123, 'sdad', 'I', '2023-03-15 17:52:59'),
(17, 123, 'asdasd', 'I', '2023-03-15 17:53:06'),
(18, 32767, 'asdsdasda', 'I', '2023-03-15 17:54:10'),
(19, 32767, 'asdsdasda', 'I', '2023-03-15 17:54:13'),
(20, 123, 'asdasd', 'I', '2023-03-15 17:55:19'),
(21, 1, 'asdsad', 'I', '2023-03-15 18:10:33'),
(22, 2, 'asdasd', 'I', '2023-03-15 18:10:58'),
(23, 2, 'asdasd', 'I', '2023-03-15 18:11:29'),
(24, 4, 'asdasd', 'I', '2023-03-15 18:12:03'),
(25, 23, 'asd', 'I', '2023-03-15 18:14:03'),
(26, 4444, 'a', 'I', '2023-03-15 18:14:14'),
(27, 4, 'asdasdscfrasmklP+´DPFKOÑ´LPASD', 'I', '2023-03-15 18:14:32');

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
(1, 2023, 1, '9000000.00', 'A', '2023-03-13 13:21:58'),
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
(27, 2010, 49, '21313.00', 'A', '2023-03-16 20:20:03');

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `salarios`
--
ALTER TABLE `salarios`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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

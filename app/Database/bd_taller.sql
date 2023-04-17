-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-04-2023 a las 23:27:19
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

DROP TABLE IF EXISTS `acciones`;
CREATE TABLE `acciones` (
  `id` smallint(2) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `tabla` varchar(20) NOT NULL,
  `accion` text NOT NULL,
  `fechaCrea` date NOT NULL DEFAULT current_timestamp(),
  `usuarioCrea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `acciones`
--

INSERT INTO `acciones` (`id`, `tipo`, `tabla`, `accion`, `fechaCrea`, `usuarioCrea`) VALUES
(1, 'Agregación', 'Departamentos', 'Se inserto un nuevo departamento con el nombre: Caracas en el pais de : Venezuela', '2023-04-14', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

DROP TABLE IF EXISTS `cargos`;
CREATE TABLE `cargos` (
  `id` smallint(2) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fechaCrea` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCrea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `nombre`, `estado`, `fechaCrea`, `usuarioCrea`) VALUES
(1, 'Director Ejecutivo', 'I', '2023-03-13 13:21:10', 3),
(2, 'Director de Operaciones', 'A', '2023-03-13 13:21:10', 3),
(3, 'Director Comercial', 'A', '2023-03-13 13:21:10', 3),
(4, 'Director de Marketing', 'A', '2023-03-13 13:21:10', 3),
(5, 'Director de Recursos Humanos', 'A', '2023-03-13 13:21:10', 3),
(10, 'Director Informatico', 'A', '2023-03-28 03:26:39', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE `departamentos` (
  `id` smallint(2) NOT NULL,
  `id_pais` smallint(2) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fechaCrea` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCrea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `id_pais`, `nombre`, `estado`, `fechaCrea`, `usuarioCrea`) VALUES
(1, 1, 'Atlantico', 'A', '2023-03-13 13:21:21', 3),
(2, 1, 'Antioquia', 'A', '2023-03-13 13:21:21', 3),
(3, 2, 'Napo', 'A', '2023-03-13 13:21:21', 3),
(4, 2, 'Esmeraldas', 'A', '2023-03-13 13:21:21', 3),
(5, 3, 'Paris', 'A', '2023-03-13 13:21:21', 3),
(6, 3, 'Calvados', 'A', '2023-03-13 13:21:21', 3),
(7, 4, 'Lacio', 'A', '2023-03-13 13:21:21', 3),
(8, 4, 'Liguria', 'A', '2023-03-13 13:21:21', 3),
(9, 5, 'Kinki', 'A', '2023-03-13 13:21:21', 3),
(10, 5, 'Kanto', 'A', '2023-03-13 13:21:21', 3),
(11, 1, 'Putomayo', 'A', '2023-03-13 15:51:02', 3),
(12, 1, 'Amazona', 'A', '2023-03-13 16:18:02', 3),
(13, 4, 'Lile', 'I', '2023-03-13 16:19:14', 3),
(14, 7, 'Chico', 'I', '2023-03-14 12:34:18', 3),
(15, 6, 'Tuli', 'A', '2023-03-14 13:56:30', 3),
(16, 2, 'Atlantico', 'A', '2023-03-28 08:04:39', 3),
(17, 1, 'Cundinamarca', 'A', '2023-04-15 02:28:28', 3),
(19, 8, 'Caracas', 'A', '2023-04-15 05:20:31', 3);

--
-- Disparadores `departamentos`
--
DROP TRIGGER IF EXISTS `mov_insert_dep	`;
DELIMITER $$
CREATE TRIGGER `mov_insert_dep	` AFTER INSERT ON `departamentos` FOR EACH ROW INSERT INTO acciones (tipo, tabla, accion, usuarioCrea)
SELECT 'Agregación' AS tipo,
       'Departamentos' AS tabla,
       CONCAT('Se inserto un nuevo departamento con el nombre: ', new.nombre, ' en el pais de : ', paises.nombre) AS accion,
       new.usuarioCrea AS usuarioCrea
FROM paises
WHERE paises.id = new.id_pais
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE `empleados` (
  `id` smallint(2) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `id_municipio` smallint(2) NOT NULL,
  `nacimientoAno` year(4) NOT NULL,
  `id_cargo` smallint(2) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fechaCrea` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCrea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombres`, `apellidos`, `id_municipio`, `nacimientoAno`, `id_cargo`, `estado`, `fechaCrea`, `usuarioCrea`) VALUES
(54, 'Moises', 'Mazo', 1, 2005, 2, 'A', '2023-03-28 08:16:10', 3),
(55, 'Andres', 'De la Hoz Martinez', 14, 2010, 3, 'A', '2023-03-28 08:21:33', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

DROP TABLE IF EXISTS `municipios`;
CREATE TABLE `municipios` (
  `id` smallint(2) NOT NULL,
  `id_dpto` smallint(2) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fechaCrea` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCrea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `id_dpto`, `nombre`, `estado`, `fechaCrea`, `usuarioCrea`) VALUES
(1, 1, 'Barranquilla', 'I', '2023-03-13 13:21:36', 3),
(2, 2, 'Medellin', 'A', '2023-03-13 13:21:36', 3),
(3, 3, 'Tena', 'A', '2023-03-13 13:21:36', 3),
(4, 4, 'Esmeraldas', 'A', '2023-03-13 13:21:36', 3),
(5, 5, 'Paris', 'A', '2023-03-13 13:21:36', 3),
(6, 6, 'Caen', 'A', '2023-03-13 13:21:36', 3),
(7, 7, 'Roma', 'A', '2023-03-13 13:21:36', 3),
(8, 8, 'Genova', 'A', '2023-03-13 13:21:36', 3),
(9, 9, 'Osaka', 'A', '2023-03-13 13:21:36', 3),
(10, 10, 'Toki', 'A', '2023-03-13 13:21:36', 3),
(11, 1, 'Yuju', 'A', '2023-03-14 14:02:11', 3),
(12, 15, 'Neymar', 'A', '2023-03-14 14:05:26', 3),
(13, 1, 'Juan Mina', 'A', '2023-03-27 22:14:52', 3),
(14, 1, 'Malambo', 'A', '2023-03-27 22:15:05', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

DROP TABLE IF EXISTS `paises`;
CREATE TABLE `paises` (
  `id` smallint(2) NOT NULL,
  `codigo` smallint(2) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fechaCrea` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCrea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `codigo`, `nombre`, `estado`, `fechaCrea`, `usuarioCrea`) VALUES
(1, 57, 'Colombia', 'A', '2023-03-13 12:59:26', 3),
(2, 593, 'Ecuador', 'A', '2023-03-13 12:59:26', 3),
(3, 33, 'Francia', 'A', '2023-03-13 12:59:26', 3),
(4, 39, 'Italia', 'A', '2023-03-13 12:59:26', 3),
(5, 81, 'Japon', 'A', '2023-03-13 12:59:26', 3),
(6, 55, 'Brasil', 'A', '2023-03-13 20:40:37', 3),
(7, 51, 'Peru', 'A', '2023-03-14 17:34:07', 3),
(8, 58, 'Venezuela', 'A', '2023-03-29 06:43:38', 3),
(55, 502, 'Guatemala', 'A', '2023-04-15 02:09:38', 3),
(57, 34, 'España', 'A', '2023-04-15 03:49:35', 3);

--
-- Disparadores `paises`
--
DROP TRIGGER IF EXISTS `mov_insert_pais`;
DELIMITER $$
CREATE TRIGGER `mov_insert_pais` AFTER INSERT ON `paises` FOR EACH ROW INSERT INTO 
	acciones (tipo, tabla, accion, usuarioCrea) 
VALUES (
	'Agregación', 'Paises', concat('Se inserto un nuevo pais con el codigo: ', new.codigo, ' Y nombre: ', new.nombre), new.usuarioCrea
)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `mov_update_pais`;
DELIMITER $$
CREATE TRIGGER `mov_update_pais` AFTER UPDATE ON `paises` FOR EACH ROW INSERT INTO acciones (tipo, tabla, accion, usuarioCrea)
SELECT DISTINCT
    CASE
        WHEN new.estado = 'A' AND old.estado = 'I'
            THEN 'Restauracion'
        WHEN new.estado = 'I' AND old.estado = 'A'
            THEN 'Eliminación'
        WHEN new.estado = old.estado AND old.estado = new.estado
            THEN 'Actualización'
    END AS tipo,
    'Paises' AS tabla,
    CONCAT(
        CASE
            WHEN new.estado = 'A' AND old.estado = 'I'
                THEN 'Se restauro el pais con el codigo: '
            WHEN new.estado = 'I' AND old.estado = 'A'
                THEN 'Se elimino el pais con el codigo: '
            WHEN new.estado = old.estado AND old.estado = new.estado
                THEN 'Se actualizó el país con el codigo: '
        END,
        new.codigo,
        ' Y nombre: ',
        new.nombre
    ) AS accion,
    CASE
        WHEN new.estado = 'A' AND old.estado = 'I'
            THEN new.usuarioCrea
        WHEN new.estado = 'I' AND old.estado = 'A'
            THEN new.usuarioCrea
        WHEN new.estado = old.estado AND old.estado = new.estado
            THEN new.usuarioCrea
    END AS usuarioCrea
FROM paises
WHERE (new.estado = 'A' AND old.estado = 'I')
      OR (new.estado = 'I' AND old.estado = 'A')
      OR (new.estado = old.estado AND old.estado = new.estado)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` smallint(2) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fechaCrea` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `estado`, `fechaCrea`) VALUES
(1, 'Super Administrador', 'A', '2023-04-05 18:12:17'),
(2, 'Administrador', 'A', '2023-04-05 18:12:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salarios`
--

DROP TABLE IF EXISTS `salarios`;
CREATE TABLE `salarios` (
  `id` smallint(2) NOT NULL,
  `periodoAno` year(4) NOT NULL,
  `id_empleado` smallint(2) NOT NULL,
  `sueldo` decimal(14,2) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fechaCrea` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCrea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salarios`
--

INSERT INTO `salarios` (`id`, `periodoAno`, `id_empleado`, `sueldo`, `estado`, `fechaCrea`, `usuarioCrea`) VALUES
(29, 2023, 54, '2131.00', 'I', '2023-03-28 08:20:09', 3),
(30, 2020, 54, '111.00', 'A', '2023-03-28 08:31:14', 3),
(31, 2005, 55, '76.00', 'A', '2023-03-29 06:52:35', 3),
(32, 1976, 55, '76.00', 'A', '2023-03-29 06:53:22', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` smallint(2) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `n_iden` varchar(15) NOT NULL,
  `contrasena` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_rol` smallint(2) NOT NULL,
  `estado` char(2) NOT NULL DEFAULT 'A',
  `fechaCrea` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `n_iden`, `contrasena`, `email`, `id_rol`, `estado`, `fechaCrea`) VALUES
(3, 'Moises', 'Mazo', '1130266003', '$2y$10$NBSPW36c9fAQD6ITLfcHCO3YiKp0xSwY3zBglLCNGoNTiRQbMBolm', 'mazomoises@gmail.com', 1, 'A', '2023-04-05 23:07:07'),
(4, 'Ever', 'Padilla', '111111', '$2y$10$5SuG9M8upsFGCE4AGhR3A.Ader.B2lCxRi4f2TazXASSIX0VVKb52', 'ever@company.com', 1, 'A', '2023-04-09 01:24:16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarioCrea` (`usuarioCrea`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pais` (`id_pais`),
  ADD KEY `usuarioCrea` (`usuarioCrea`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_municipio` (`id_municipio`),
  ADD KEY `id_cargo` (`id_cargo`),
  ADD KEY `usuarioCrea` (`usuarioCrea`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dpto` (`id_dpto`),
  ADD KEY `usuarioCrea` (`usuarioCrea`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarioCrea` (`usuarioCrea`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salarios`
--
ALTER TABLE `salarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `usuarioCrea` (`usuarioCrea`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acciones`
--
ALTER TABLE `acciones`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `salarios`
--
ALTER TABLE `salarios`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD CONSTRAINT `usuariosCrea` FOREIGN KEY (`usuarioCrea`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `departamentos_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id`),
  ADD CONSTRAINT `usuario` FOREIGN KEY (`usuarioCrea`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id`),
  ADD CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id`),
  ADD CONSTRAINT `empleados_ibfk_3` FOREIGN KEY (`usuarioCrea`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`id_dpto`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `usuarioCrea` FOREIGN KEY (`usuarioCrea`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `paises`
--
ALTER TABLE `paises`
  ADD CONSTRAINT `paises_ibfk_1` FOREIGN KEY (`usuarioCrea`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `salarios`
--
ALTER TABLE `salarios`
  ADD CONSTRAINT `salarios_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id`),
  ADD CONSTRAINT `salarios_ibfk_2` FOREIGN KEY (`usuarioCrea`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

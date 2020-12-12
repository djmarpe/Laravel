-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-12-2020 a las 16:51:16
-- Versión del servidor: 8.0.22-0ubuntu0.20.04.3
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `CRUD_Laravel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alquilado`
--

CREATE TABLE `Alquilado` (
  `Matricula` varchar(7) NOT NULL,
  `DNI` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Alquilado`
--

INSERT INTO `Alquilado` (`Matricula`, `DNI`) VALUES
('2323MJJ', '11111111A'),
('4646BYX', '11111111A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AsignacionRol`
--

CREATE TABLE `AsignacionRol` (
  `DNI` varchar(9) NOT NULL,
  `idRol` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `AsignacionRol`
--

INSERT INTO `AsignacionRol` (`DNI`, `idRol`) VALUES
('00000000A', 0),
('00000000A', 1),
('11111111A', 0),
('69696969M', 1),
('22222222P', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Coche`
--

CREATE TABLE `Coche` (
  `Matricula` varchar(7) NOT NULL,
  `Marca` varchar(50) NOT NULL,
  `Modelo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Coche`
--

INSERT INTO `Coche` (`Matricula`, `Marca`, `Modelo`) VALUES
('2323MJJ', 'Citroën', 'C5'),
('2456KYG', 'Peugeot', '508'),
('4646BYX', 'Citroën', 'Tanque'),
('7683CLT', 'Opel', 'Astra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Persona`
--

CREATE TABLE `Persona` (
  `DNI` varchar(9) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Contra` varchar(50) NOT NULL,
  `Activado` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Persona`
--

INSERT INTO `Persona` (`DNI`, `Nombre`, `Apellidos`, `Email`, `Contra`, `Activado`) VALUES
('00000000A', 'Alejandro', 'Martín Pérez', 'admin@admin.com', 'Admin1234', 1),
('11111111A', 'Homer', 'Simpson', 'homer@simpson.com', 'Pollagorda69', 1),
('69696969M', 'Maki', 'Navaja', 'maki@navaja.com', 'Makina1234', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rol`
--

CREATE TABLE `Rol` (
  `idRol` int NOT NULL,
  `Rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Rol`
--

INSERT INTO `Rol` (`idRol`, `Rol`) VALUES
(0, 'Administrador'),
(1, 'Usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Alquilado`
--
ALTER TABLE `Alquilado`
  ADD PRIMARY KEY (`Matricula`,`DNI`);

--
-- Indices de la tabla `Coche`
--
ALTER TABLE `Coche`
  ADD PRIMARY KEY (`Matricula`);

--
-- Indices de la tabla `Persona`
--
ALTER TABLE `Persona`
  ADD PRIMARY KEY (`DNI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

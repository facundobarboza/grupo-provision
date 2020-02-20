-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2020 a las 09:22:34
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `grupo_provision`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_armazon`
--

CREATE TABLE `tipo_armazon` (
  `id_tipo_armazon` int(11) NOT NULL,
  `descripcion` char(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_armazon`
--

INSERT INTO `tipo_armazon` (`id_tipo_armazon`, `descripcion`) VALUES
(1, 'cmlo'),
(2, 'dmlo'),
(3, 'czlo'),
(4, 'dzlo'),
(5, 'jzo'),
(6, 'jmo'),
(7, 'lmo'),
(8, 'lzo'),
(9, 'nmo'),
(10, 'nzo'),
(11, 'cmlp'),
(12, 'dmlp'),
(13, 'czlp'),
(14, 'dzlp'),
(15, 'jzp'),
(16, 'jmp'),
(17, 'lzo'),
(18, 'nmp'),
(19, 'nzp');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tipo_armazon`
--
ALTER TABLE `tipo_armazon`
  ADD PRIMARY KEY (`id_tipo_armazon`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tipo_armazon`
--
ALTER TABLE `tipo_armazon`
  MODIFY `id_tipo_armazon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

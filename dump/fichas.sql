-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2020 a las 09:20:13
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
-- Estructura de tabla para la tabla `fichas`
--

CREATE TABLE `fichas` (
  `id_ficha` int(11) NOT NULL,
  `beneficiario` varchar(100) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `delegacion` varchar(100) NOT NULL,
  `optica` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `codigo_armazon` varchar(100) NOT NULL,
  `color_armazon` varchar(100) NOT NULL,
  `id_stock` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `voucher` varchar(100) NOT NULL,
  `nro_pedido` varchar(100) NOT NULL,
  `grad_od_esf` varchar(100) NOT NULL,
  `grad_od_cil` varchar(100) NOT NULL,
  `eje_od` varchar(100) NOT NULL,
  `grad_oi_esf` varchar(100) NOT NULL,
  `grad_oi_cil` varchar(100) NOT NULL,
  `eje_oi` varchar(100) NOT NULL,
  `comentario` text NOT NULL,
  `es_lejos` int(11) NOT NULL,
  `adicional` varchar(2) NOT NULL,
  `descripcion_adicional` varchar(100) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `costo_adicional` double NOT NULL,
  `seña_adicional` double NOT NULL,
  `saldo_adicional` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fichas`
--
ALTER TABLE `fichas`
  ADD PRIMARY KEY (`id_ficha`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

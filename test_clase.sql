-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2024 a las 16:16:42
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test_clase`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_elemt`
--

CREATE TABLE `estado_elemt` (
  `Id_estado` int(11) NOT NULL,
  `desc_estado` enum('Activo','Inactivo','Pendiente','Deshabilitado','Archivado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_elemt`
--

INSERT INTO `estado_elemt` (`Id_estado`, `desc_estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Pendiente'),
(4, 'Deshabilitado'),
(5, 'Archivado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Id_producto` int(11) NOT NULL,
  `nom_producto` varchar(100) DEFAULT NULL,
  `descrip_producto` varchar(150) DEFAULT NULL,
  `valor_producto` int(11) DEFAULT NULL,
  `estadofk` int(11) DEFAULT NULL,
  `tipo_elemfk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Id_producto`, `nom_producto`, `descrip_producto`, `valor_producto`, `estadofk`, `tipo_elemfk`) VALUES
(1, 'Laptop', 'Portátil con gran rendimiento y batería duradera.', 1200, 1, 2),
(2, 'Teléfono', 'Smartphone con cámara de 200MP y 256GB de almacenamiento.', 1000, 2, 4),
(3, 'Tableta', 'Tableta de 10 pulgadas, perfecta para trabajar y jugar.', 400, 3, 4),
(4, 'Auriculares', 'Auriculares inalámbricos con excelente sonido.', 150, 4, 5),
(5, 'Reloj Inteligente', 'Reloj con monitoreo de salud y notificaciones rápidas.', 250, 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_elem`
--

CREATE TABLE `tipo_elem` (
  `Id_tipo` int(11) NOT NULL,
  `nom_elemen` varchar(100) DEFAULT NULL,
  `descrip_elemen` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_elem`
--

INSERT INTO `tipo_elem` (`Id_tipo`, `nom_elemen`, `descrip_elemen`) VALUES
(1, 'Fuego', 'Elemento que representa la energía y el calor.'),
(2, 'Agua', 'Elemento que simboliza la fluidez y la vida.'),
(3, 'Tierra', 'Elemento que representa la estabilidad y la solidez.'),
(4, 'Aire', 'Elemento que simboliza la libertad y el movimiento.'),
(5, 'Éter', 'Elemento que representa el espacio y la conexión espiritual.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estado_elemt`
--
ALTER TABLE `estado_elemt`
  ADD PRIMARY KEY (`Id_estado`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id_producto`),
  ADD KEY `estadofk` (`estadofk`),
  ADD KEY `tipo_elemfk` (`tipo_elemfk`);

--
-- Indices de la tabla `tipo_elem`
--
ALTER TABLE `tipo_elem`
  ADD PRIMARY KEY (`Id_tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estado_elemt`
--
ALTER TABLE `estado_elemt`
  MODIFY `Id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_elem`
--
ALTER TABLE `tipo_elem`
  MODIFY `Id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`estadofk`) REFERENCES `estado_elemt` (`Id_estado`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`tipo_elemfk`) REFERENCES `tipo_elem` (`Id_tipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

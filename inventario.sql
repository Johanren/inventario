-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-01-2024 a las 19:59:05
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo`
--

CREATE TABLE `activo` (
  `id_activo` int(11) NOT NULL,
  `nombre_activo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `activo`
--

INSERT INTO `activo` (`id_activo`, `nombre_activo`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id_articulo` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_proeevedor` int(11) NOT NULL,
  `iva` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `nombre_producto` varchar(200) NOT NULL,
  `id_medida` int(11) NOT NULL,
  `precio_unitario` int(11) NOT NULL,
  `cantidad_producto` int(11) NOT NULL,
  `valor_producto_iva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id_articulo`, `id_categoria`, `id_proeevedor`, `iva`, `codigo_producto`, `nombre_producto`, `id_medida`, `precio_unitario`, `cantidad_producto`, `valor_producto_iva`) VALUES
(1, 1, 1, 10, 1, 'Prueba 1', 1, 20000, 1, 22000),
(2, 1, 1, 20, 2, 'Prueba 2', 1, 30000, 9, 36000),
(3, 1, 1, 10, 3, 'Prueba 3', 1, 50000, 6, 55000),
(4, 1, 1, 50, 4, 'Prueba 4', 2, 20000, 5, 30000),
(5, 1, 2, 10, 5, 'Prueba 5', 2, 30000, 0, 33000),
(6, 3, 1, 50, 6, 'Prueba 6', 3, 8000, 2, 12000),
(7, 3, 2, 70, 7, 'Dog chow cachorro', 3, 9000, 10, 15300),
(8, 3, 2, 70, 8, 'Oh mai gat', 3, 6000, 2, 10200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id_caja` int(11) NOT NULL,
  `nombre_caja` varchar(20) NOT NULL,
  `id_activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id_caja`, `nombre_caja`, `id_activo`) VALUES
(1, 'Caja 1', 2),
(2, 'Caja 2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES
(1, 'ML'),
(2, 'KG'),
(3, 'Cachorro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `numero_cedula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `apellido`, `numero_cedula`) VALUES
(1, 'Jogan Felipe', 'Rengifo Solarte', 1070586140),
(2, 'NN', 'NN', 11111);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diseno_sistema`
--

CREATE TABLE `diseno_sistema` (
  `id_diseno` int(11) NOT NULL,
  `nom_sistema` text NOT NULL,
  `nit` int(11) NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `icon_sistema` text NOT NULL,
  `id_activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `diseno_sistema`
--

INSERT INTO `diseno_sistema` (`id_diseno`, `nom_sistema`, `nit`, `telefono`, `direccion`, `icon_sistema`, `id_activo`) VALUES
(1, 'Prueba', 123, 1, 'prueba', 'Views/img/diseno_sistema/fondo calculo.webp', 2),
(2, 'Veterinaria N', 1080160425, 2147483647, 'prueba', 'Views/img/diseno_sistema/foto.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `id_caja` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_factura` date NOT NULL DEFAULT current_timestamp(),
  `total_factura` int(11) NOT NULL,
  `tarjeta` int(11) DEFAULT NULL,
  `efectivo` int(11) DEFAULT NULL,
  `cambio` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `id_caja`, `id_usuario`, `fecha_factura`, `total_factura`, `tarjeta`, `efectivo`, `cambio`, `id_cliente`) VALUES
(1, 1, 1, '2024-01-09', 58000, NULL, 80000, 22000, 2),
(2, 1, 1, '2024-01-09', 40000, NULL, 50000, 10000, 2),
(3, 1, 1, '2024-01-09', 40000, NULL, 50000, 10000, 2),
(4, 1, 1, '2024-01-09', 15300, NULL, 20000, 4700, 2),
(5, 1, 1, '2024-01-09', 125300, NULL, 125300, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_proeevedor`
--

CREATE TABLE `factura_proeevedor` (
  `id_factura_proeevedor` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_proeevedor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_medida` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `nombre_producto` varchar(200) NOT NULL,
  `precio_unitario` int(11) NOT NULL,
  `cantidad_producto` double NOT NULL,
  `fecha_ingreso` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura_proeevedor`
--

INSERT INTO `factura_proeevedor` (`id_factura_proeevedor`, `id_categoria`, `id_proeevedor`, `id_usuario`, `id_medida`, `codigo_producto`, `nombre_producto`, `precio_unitario`, `cantidad_producto`, `fecha_ingreso`) VALUES
(1, 1, 1, 1, 1, 1, 'Prueba 1', 20000, 2, '2024-01-07'),
(2, 1, 1, 1, 1, 2, 'Prueba 2', 30000, 2, '2024-01-07'),
(3, 1, 1, 1, 1, 3, 'Prueba 3', 50000, 2, '2024-01-07'),
(4, 1, 1, 1, 2, 4, 'Prueba 4', 20000, 5, '2024-01-07'),
(5, 1, 2, 1, 2, 5, 'Prueba 5', 30000, 2, '2024-01-07'),
(6, 1, 1, 1, 1, 1, 'Prueba 1', 20000, 2, '2024-01-08'),
(7, 1, 1, 1, 1, 2, 'Prueba 2', 30000, 2, '2024-01-08'),
(8, 1, 1, 1, 1, 1, 'Prueba 1', 20000, 2, '2024-01-08'),
(9, 3, 1, 1, 3, 6, 'Prueba 6', 8000, 2, '2024-01-08'),
(10, 3, 2, 1, 3, 7, 'Dog chow cachorro', 7000, 10, '2024-01-08'),
(11, 3, 2, 1, 3, 7, 'Dog chow cachorro', 9000, 2, '2024-01-08'),
(12, 1, 2, 1, 2, 7, 'Dog chow cachorro', 9000, 2, '2024-01-08'),
(13, 3, 2, 1, 3, 7, 'Dog chow cachorro', 9000, 0, '2024-01-08'),
(14, 3, 2, 1, 3, 8, 'Oh mai gat', 6000, 2, '2024-01-08'),
(15, 1, 2, 2, 1, 1, 'Prueba 1', 20000, 0, '2024-01-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medida`
--

CREATE TABLE `medida` (
  `id_medida` int(11) NOT NULL,
  `medida` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medida`
--

INSERT INTO `medida` (`id_medida`, `medida`) VALUES
(1, 'ML'),
(2, 'KG'),
(3, 'UND');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proeevedor`
--

CREATE TABLE `proeevedor` (
  `id_proeevedor` int(11) NOT NULL,
  `nit_proeevedor` varchar(11) NOT NULL,
  `nombre_proeevedor` varchar(100) NOT NULL,
  `telefono_proeevedor` int(11) NOT NULL,
  `direccion_proeevedor` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proeevedor`
--

INSERT INTO `proeevedor` (`id_proeevedor`, `nit_proeevedor`, `nombre_proeevedor`, `telefono_proeevedor`, `direccion_proeevedor`) VALUES
(1, '123456', 'Prueba', 12345, 'Mz J Casa 15'),
(2, '123456', 'Prueba 1', 2147483647, 'Mz J Casa 15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'Administrado'),
(2, 'Cajero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `id_activo` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_caja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `clave`, `id_activo`, `id_rol`, `id_caja`) VALUES
(1, 'Johan Rengifo', 'Johan321', 1, 1, 1),
(2, 'Yovany', 'yovany321', 1, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_caja` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `peso` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `valor_unitario` int(11) NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `id_factura`, `id_usuario`, `id_caja`, `id_producto`, `peso`, `cantidad`, `valor_unitario`, `precio_compra`, `fecha_ingreso`) VALUES
(1, 1, 1, 1, 1, NULL, 2, 22000, 44000, '2024-01-08'),
(2, 1, 1, 1, 7, NULL, 2, 15300, 30600, '2024-01-09'),
(3, 2, 1, 1, 1, NULL, 2, 22000, 44000, '2024-01-09'),
(4, 3, 1, 1, 1, NULL, 2, 22000, 44000, '2024-01-09'),
(5, 4, 1, 1, 7, NULL, 1, 15300, 15300, '2024-01-09'),
(6, 5, 1, 1, 1, NULL, 2, 22000, 44000, '2024-01-09'),
(7, 5, 1, 1, 5, NULL, 2, 33000, 66000, '2024-01-09'),
(8, 5, 1, 1, 7, NULL, 1, 15300, 15300, '2024-01-09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activo`
--
ALTER TABLE `activo`
  ADD PRIMARY KEY (`id_activo`);

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id_articulo`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_medida` (`id_medida`),
  ADD KEY `id_proeevedor` (`id_proeevedor`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id_caja`),
  ADD KEY `id_activo` (`id_activo`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `diseno_sistema`
--
ALTER TABLE `diseno_sistema`
  ADD PRIMARY KEY (`id_diseno`),
  ADD KEY `id_activo` (`id_activo`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_caja` (`id_caja`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `factura_proeevedor`
--
ALTER TABLE `factura_proeevedor`
  ADD PRIMARY KEY (`id_factura_proeevedor`);

--
-- Indices de la tabla `medida`
--
ALTER TABLE `medida`
  ADD PRIMARY KEY (`id_medida`);

--
-- Indices de la tabla `proeevedor`
--
ALTER TABLE `proeevedor`
  ADD PRIMARY KEY (`id_proeevedor`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_activo` (`id_activo`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_caja` (`id_caja`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_caja` (`id_caja`),
  ADD KEY `id_producto` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activo`
--
ALTER TABLE `activo`
  MODIFY `id_activo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id_articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `diseno_sistema`
--
ALTER TABLE `diseno_sistema`
  MODIFY `id_diseno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `factura_proeevedor`
--
ALTER TABLE `factura_proeevedor`
  MODIFY `id_factura_proeevedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `medida`
--
ALTER TABLE `medida`
  MODIFY `id_medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proeevedor`
--
ALTER TABLE `proeevedor`
  MODIFY `id_proeevedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articulos_ibfk_2` FOREIGN KEY (`id_medida`) REFERENCES `medida` (`id_medida`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articulos_ibfk_3` FOREIGN KEY (`id_proeevedor`) REFERENCES `proeevedor` (`id_proeevedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`id_activo`) REFERENCES `activo` (`id_activo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `diseno_sistema`
--
ALTER TABLE `diseno_sistema`
  ADD CONSTRAINT `diseno_sistema_ibfk_1` FOREIGN KEY (`id_activo`) REFERENCES `activo` (`id_activo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id_caja`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_activo`) REFERENCES `activo` (`id_activo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id_caja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id_caja`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_4` FOREIGN KEY (`id_producto`) REFERENCES `articulos` (`id_articulo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

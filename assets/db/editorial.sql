-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2019 a las 18:15:05
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `editorial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_editorial`
--

CREATE TABLE `categoria_editorial` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(30) NOT NULL,
  `descripcion_categoria` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria_editorial`
--

INSERT INTO `categoria_editorial` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`) VALUES
(1, 'Terror', 'Es un género literario que se define por la sensación que causa: miedo. Nöel Carroll en su');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_editorial`
--

CREATE TABLE `cliente_editorial` (
  `id_cliente` bigint(20) NOT NULL,
  `num_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(20) DEFAULT NULL,
  `apellido_cliente` varchar(20) DEFAULT NULL,
  `telefono_cliente` int(11) DEFAULT NULL,
  `correo_cliente` varchar(60) DEFAULT NULL,
  `direccion_cliente` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `id_detalle` int(11) NOT NULL,
  `num_factura_fk` int(11) NOT NULL,
  `id_producto_fk` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_editorial`
--

CREATE TABLE `factura_editorial` (
  `id_factura` int(11) NOT NULL,
  `num_factura` int(11) NOT NULL,
  `id_cliente_fk` bigint(20) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_editorial`
--

CREATE TABLE `producto_editorial` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(30) NOT NULL,
  `descripcion_producto` varchar(750) NOT NULL,
  `precio_producto` int(11) NOT NULL,
  `autor_producto` varchar(60) NOT NULL,
  `editorial_producto` varchar(90) NOT NULL,
  `edicion_producto` int(11) NOT NULL,
  `formato_producto` varchar(20) NOT NULL,
  `ISBN_producto` varchar(20) NOT NULL,
  `facultad` varchar(20) NOT NULL,
  `n_paginas` int(11) NOT NULL,
  `idioma` varchar(15) NOT NULL,
  `terminado` varchar(20) NOT NULL,
  `alto_ancho` varchar(15) NOT NULL,
  `imagen` varchar(20) NOT NULL,
  `id_categoria_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto_editorial`
--

INSERT INTO `producto_editorial` (`id_producto`, `nombre_producto`, `descripcion_producto`, `precio_producto`, `autor_producto`, `editorial_producto`, `edicion_producto`, `formato_producto`, `ISBN_producto`, `facultad`, `n_paginas`, `idioma`, `terminado`, `alto_ancho`, `imagen`, `id_categoria_fk`) VALUES
(4, 'Bajo el signo del crepúsculo. ', 'Bajo el signo del crepúsculo nos sumerge en el mundo de los instantes. Un primer momento, nos lleva a desabrir espacios inéditos del baúl de la abuela, fotografías sepias juguetean con la imaginación del lector; el tío Miguel, con sus aventuras violentas; la tía Eduviges, con esa eterna sonrisa cómplice; la prima Daniela, enamorada del teatro; la tragedia de Andrés, tras la muerte de Sofía; y las aventuras jocosas, de Horacio y Mercedes que buscan un fiador. Un segundo momento, nos sitúa en las reflexiones del ateo que anhela el perdón divino, la doctora Raquel Pérez en la metamorfosis otoñal, el siete machos arrastrando la cruz arrepentido, el juicio académico de César y la danza del fuego. Un tercer momento nos sumerge en la majestuosidad', 20000, 'Alhim Adonaí Vera Silva', 'Editorial Universidad Surcolombiana', 2008, 'Impreso', '978-958-8324-55-5', 'Facultad de Educació', 106, 'Español', 'Tapa Rústica', '17 x 24 cm', 'imagen_12161204.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(60) NOT NULL,
  `psw_usuario` varchar(250) NOT NULL,
  `rol_usuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `psw_usuario`, `rol_usuario`) VALUES
(1081420457, 'Leiner Ortega', '21679a05ffb6a180e569e6e4902cc1a7', 'Admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_editorial`
--
ALTER TABLE `categoria_editorial`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `cliente_editorial`
--
ALTER TABLE `cliente_editorial`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `num_cliente` (`num_cliente`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `num_factura_fk` (`num_factura_fk`),
  ADD KEY `id_producto_fk` (`id_producto_fk`);

--
-- Indices de la tabla `factura_editorial`
--
ALTER TABLE `factura_editorial`
  ADD PRIMARY KEY (`num_factura`),
  ADD KEY `id_cliente_fk` (`id_cliente_fk`);

--
-- Indices de la tabla `producto_editorial`
--
ALTER TABLE `producto_editorial`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria_fk` (`id_categoria_fk`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_editorial`
--
ALTER TABLE `categoria_editorial`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente_editorial`
--
ALTER TABLE `cliente_editorial`
  MODIFY `num_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura_editorial`
--
ALTER TABLE `factura_editorial`
  MODIFY `num_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto_editorial`
--
ALTER TABLE `producto_editorial`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`num_factura_fk`) REFERENCES `factura_editorial` (`num_factura`),
  ADD CONSTRAINT `detalle_ibfk_2` FOREIGN KEY (`id_producto_fk`) REFERENCES `producto_editorial` (`id_producto`);

--
-- Filtros para la tabla `factura_editorial`
--
ALTER TABLE `factura_editorial`
  ADD CONSTRAINT `factura_editorial_ibfk_1` FOREIGN KEY (`id_cliente_fk`) REFERENCES `cliente_editorial` (`id_cliente`);

--
-- Filtros para la tabla `producto_editorial`
--
ALTER TABLE `producto_editorial`
  ADD CONSTRAINT `producto_editorial_ibfk_1` FOREIGN KEY (`id_categoria_fk`) REFERENCES `categoria_editorial` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2026 a las 23:13:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aura_boutique`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritos`
--

CREATE TABLE `carritos` (
  `id_carrito` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `descripcion`, `estado`, `fecha_creacion`) VALUES
(1, 'Ropa', 'Prendas de vestir', 'activo', '2026-08-14 18:58:22'),
(2, 'Accesorios', 'Accesorios de moda', 'activo', '2026-08-14 18:58:22'),
(3, 'Calzado', 'Productos de calzado', 'activo', '2026-08-14 18:58:22'),
(4, 'Maquillaje', NULL, 'activo', '2026-09-30 20:18:13'),
(5, 'Vestidos y enterizos ', NULL, 'activo', '2026-09-30 20:27:53'),
(6, 'Blusas y tops', NULL, 'activo', '2026-09-30 20:28:14'),
(7, 'Pantalones y jeans', NULL, 'activo', '2026-09-30 20:28:35'),
(8, 'Faldas y shorts', NULL, 'activo', '2026-09-30 20:28:51'),
(9, 'Chaquetas y abrigos', NULL, 'activo', '2026-09-30 20:29:06'),
(10, 'Accesorios y bisutería', NULL, 'activo', '2026-09-30 20:29:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `id_color` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `codigo_hex` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`id_color`, `nombre`, `codigo_hex`) VALUES
(1, 'Negro', '#000000'),
(2, 'Blanco', '#FFFFFF'),
(3, 'Rojo', '#FF0000'),
(4, 'Azul', '#0000FF'),
(5, 'Rosado', '#FFC0CB'),
(6, 'Verde', '#008000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_carrito`
--

CREATE TABLE `detalle_carrito` (
  `id_detalle_carrito` int(10) UNSIGNED NOT NULL,
  `id_carrito` int(10) UNSIGNED NOT NULL,
  `id_producto` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle_pedido` int(10) UNSIGNED NOT NULL,
  `id_pedido` int(10) UNSIGNED NOT NULL,
  `id_producto` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(10) UNSIGNED NOT NULL,
  `id_producto` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `stock_minimo` int(10) UNSIGNED NOT NULL DEFAULT 5,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_pedidos`
--

CREATE TABLE `lineas_pedidos` (
  `id` int(255) NOT NULL,
  `pedido_id` int(255) NOT NULL,
  `producto_id` int(255) NOT NULL,
  `unidades` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lineas_pedidos`
--

INSERT INTO `lineas_pedidos` (`id`, `pedido_id`, `producto_id`, `unidades`) VALUES
(1, 5, 29, 1),
(2, 6, 31, 1),
(3, 6, 30, 1),
(4, 6, 29, 1),
(5, 6, 25, 1),
(6, 7, 31, 1),
(7, 7, 29, 1),
(8, 8, 29, 1),
(9, 8, 25, 1),
(10, 12, 30, 4),
(11, 13, 29, 1),
(12, 13, 31, 1),
(13, 14, 29, 1),
(14, 15, 30, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `estado` enum('pendiente','confirmado','en_preparacion','enviado','entregado','cancelado') NOT NULL DEFAULT 'pendiente',
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `direccion_entrega` varchar(255) NOT NULL,
  `ciudad_entrega` varchar(100) NOT NULL,
  `telefono_contacto` varchar(20) NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `provincia` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `coste` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `usuario_id`, `id_usuario`, `estado`, `fecha`, `hora`, `total`, `direccion_entrega`, `ciudad_entrega`, `telefono_contacto`, `fecha_pedido`, `fecha_actualizacion`, `provincia`, `ciudad`, `localidad`, `departamento`, `direccion`, `coste`) VALUES
(1, 0, 1, '', NULL, NULL, 0.00, 'diagonal 25', '50000', 'confirm', '2026-09-23 05:00:00', '2026-09-23 21:12:23', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 0, 1, '', NULL, NULL, 0.00, 'diagonal 25', '50000', 'confirm', '2026-09-23 05:00:00', '2026-09-23 21:12:26', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 0, 1, '', NULL, NULL, 0.00, 'diagonal 25', '50000', 'confirm', '2026-09-30 05:00:00', '2026-09-30 18:56:02', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 0, 1, '', NULL, NULL, 0.00, 'diagonal 25', '50000', 'confirm', '2026-09-30 05:00:00', '2026-09-30 18:56:07', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 0, 1, '', NULL, NULL, 0.00, 'diagonal 25', '50000', 'confirm', '2026-09-30 05:00:00', '2026-09-30 18:57:33', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 0, 1, '', NULL, NULL, 0.00, 'diagonal 25', '340000', 'confirm', '2026-09-30 05:00:00', '2026-09-30 20:01:30', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 0, 4, '', NULL, NULL, 0.00, 'diagonal 25', '115000', 'confirm', '2026-09-30 05:00:00', '2026-09-30 20:13:56', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 0, 4, '', NULL, NULL, 0.00, 'diagonal 25', '125000', 'confirm', '2026-09-30 05:00:00', '2026-09-30 20:14:30', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 0, 5, '', '2026-10-16', '15:26:44', 0.00, '', '', '', '2026-10-16 20:26:44', '2026-10-16 20:26:44', NULL, 'bogota', NULL, 'cundinamarca', 'diagonal', 600000.00),
(13, 0, 1, '', '2026-10-16', '15:27:09', 0.00, '', '', '', '2026-10-16 20:27:09', '2026-10-16 20:27:09', NULL, 'bogota', NULL, 'cundinamarca', 'diagonal', 115000.00),
(14, 0, 1, '', '2026-10-16', '15:44:34', 0.00, '', '', '', '2026-10-16 20:44:34', '2026-10-16 20:44:34', NULL, 'bogota', NULL, 'cundinamarca', 'diagonal', 50000.00),
(15, 0, 1, '', '2026-10-16', '16:10:38', 0.00, '', '', '', '2026-10-16 21:10:38', '2026-10-16 21:10:38', NULL, 'bogota', NULL, 'cundinamarca', 'diagonal', 150000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `talla` varchar(50) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_categoria`, `nombre`, `descripcion`, `precio`, `stock`, `talla`, `imagen`, `estado`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(25, 3, 'Tacones ', 'Tacones blancos elegantes ideales para una ocasión especial', 75000.00, 85, NULL, 'tacones.PNG', 'activo', '2026-09-23 05:00:00', '2026-09-23 19:57:04'),
(29, 2, 'Labial rojo Victoria', 'Labial rojo Victoria', 50000.00, 100, NULL, 'LabialRojoVictoria.PNG', 'activo', '2026-09-23 05:00:00', '2026-09-23 19:59:18'),
(31, 1, 'buzo dama', 'buzo dama negro, cómodo pero elegante', 65000.00, 80, NULL, 'Buzo mujer.PNG', 'activo', '2026-09-23 05:00:00', '2026-09-23 19:59:54'),
(37, 1, 'Pantalon Dama Beige', 'Hermoso pantalón color beige cómodo pero elegante ideal para ocasiones especiales', 150000.00, 15, NULL, 'pantalon.PNG', 'activo', '2026-10-21 05:00:00', '2026-10-21 19:40:24'),
(38, 7, 'Pantalon Dama Gris', 'Hermoso pantalón de dama color gris', 65000.00, 55, NULL, 'WhatsApp Image 2026-10-16 at 4.09.59 PM.jpeg', 'activo', '2026-10-21 05:00:00', '2026-10-21 19:40:39'),
(39, 7, 'Pantalon Dama Blanco', 'Hermoso pantalon de Dama color blanco', 58000.00, 65, NULL, 'WhatsApp Image 2026-10-16 at 4.10.09 PM.jpeg', 'activo', '2026-10-21 05:00:00', '2026-10-21 19:42:46'),
(40, 7, 'Pantalon Dama Negro', 'Hermoso pantalon de dama color negro', 75000.00, 65, NULL, 'WhatsApp Image 2026-10-16 at 4.10.29 PM.jpeg', 'activo', '2026-10-21 05:00:00', '2026-10-21 19:48:17'),
(41, 7, 'Pantalon Dama Color Palo De Rosa', 'Hermoso pantalon palo de rosa', 80000.00, 100, NULL, 'WhatsApp Image 2026-10-16 at 4.10.39 PM.jpeg', 'activo', '2026-10-21 05:00:00', '2026-10-21 19:50:52'),
(42, 7, 'Pantalon Dama De Cuero', 'Hermoso pantalon de dama de cuero color negro', 70000.00, 80, NULL, 'WhatsApp Image 2026-10-16 at 4.10.58 PM.jpeg', 'activo', '2026-10-21 05:00:00', '2026-10-21 19:52:04'),
(43, 7, 'Jean Dama Blanco', 'Hermoso Jean de dama color blanco', 45000.00, 50, 'Talla Única', 'WhatsApp Image 2026-10-16 at 4.11.13 PM.jpeg', 'activo', '2026-10-21 05:00:00', '2026-10-21 21:02:13'),
(44, 7, 'Jean De Dama Negro', 'Hermoso Jean De Dama Negro', 78000.00, 55, NULL, 'WhatsApp Image 2026-10-16 at 4.11.38 PM.jpeg', 'activo', '2026-10-21 05:00:00', '2026-10-21 20:05:23'),
(45, 10, 'Jean De Dama Beige', 'Hermoso Jean De Dama Beige', 85000.00, 55, NULL, 'WhatsApp Image 2026-10-16 at 4.12.44 PM.jpeg', 'activo', '2026-10-21 05:00:00', '2026-10-21 20:07:48'),
(46, 5, 'Vestido cafe', 'Hermoso Vestido Cafe', 45000.00, 55, NULL, 'WhatsApp Image 2026-10-16 at 4.13.07 PM.jpeg', 'activo', '2026-10-21 05:00:00', '2026-10-21 20:14:44'),
(47, 5, 'Vestido Amarillo Claro', 'Hermoso Vestdo Corto Amarillo Claro', 65000.00, 50, NULL, 'WhatsApp Image 2026-10-16 at 4.13.15 PM.jpeg', 'activo', '2026-10-21 05:00:00', '2026-10-21 20:19:16'),
(48, 5, 'Vestido Negro', 'Hermoso Vestido Negro', 60000.00, 56, NULL, 'WhatsApp Image 2026-10-16 at 4.13.21 PM.jpeg', 'activo', '2026-10-21 05:00:00', '2026-10-21 20:20:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_color`
--

CREATE TABLE `producto_color` (
  `id_producto` int(10) UNSIGNED NOT NULL,
  `id_color` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_talla`
--

CREATE TABLE `producto_talla` (
  `id_producto` int(10) UNSIGNED NOT NULL,
  `id_talla` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`, `descripcion`, `fecha_creacion`) VALUES
(1, 'administrador', 'Usuario encargado de administrar la plataforma', '2026-08-14 18:58:22'),
(2, 'cliente', 'Usuario que puede comprar productos', '2026-08-14 18:58:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas`
--

CREATE TABLE `tallas` (
  `id_talla` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tallas`
--

INSERT INTO `tallas` (`id_talla`, `nombre`, `descripcion`) VALUES
(1, 'XS', 'Extra pequeña'),
(2, 'S', 'Pequeña'),
(3, 'M', 'Mediana'),
(4, 'L', 'Grande'),
(5, 'XL', 'Extra grande');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `id_rol` int(10) UNSIGNED NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_rol`, `nombres`, `apellidos`, `correo`, `password`, `telefono`, `direccion`, `ciudad`, `estado`, `fecha_registro`, `fecha_actualizacion`) VALUES
(1, 1, 'allison', 'cardona', 'allisonc123@gmail.com', '$2y$04$llPgFnhcznwupGNaKZ2QMeybVaTiJ3mWyqYX8UDRbZuOiax6wsODi', NULL, NULL, NULL, 'activo', '2026-08-26 21:19:20', '2026-08-26 21:24:22'),
(4, 2, 'Daniela', 'cardona', 'danielac123@gmail.com', '$2y$04$Oedzk1Atd9JXUVHtvW9YqeIYTDx81VF12Ekl93ls7jd0ubnpJsK2m', NULL, NULL, NULL, 'activo', '2026-09-23 20:15:02', '2026-09-23 20:15:02'),
(5, 2, 'washington', 'nieto', 'wnieto@gmail.com', '$2y$04$FViyGQPrQEUR7cZ9kHiwn.A05hU/sLtqECs4y4WapzUxpcXcFHWXO', NULL, NULL, NULL, 'activo', '2026-10-16 19:48:07', '2026-10-16 19:48:07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD PRIMARY KEY (`id_carrito`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id_color`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `detalle_carrito`
--
ALTER TABLE `detalle_carrito`
  ADD PRIMARY KEY (`id_detalle_carrito`),
  ADD UNIQUE KEY `uk_carrito_producto` (`id_carrito`,`id_producto`),
  ADD KEY `fk_detalle_carrito_producto` (`id_producto`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle_pedido`),
  ADD KEY `idx_detalle_pedido_pedido` (`id_pedido`),
  ADD KEY `idx_detalle_pedido_producto` (`id_producto`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD UNIQUE KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `idx_pedido_usuario` (`id_usuario`),
  ADD KEY `idx_pedido_estado` (`estado`),
  ADD KEY `idx_pedido_fecha` (`fecha_pedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `idx_producto_categoria` (`id_categoria`),
  ADD KEY `idx_producto_estado` (`estado`),
  ADD KEY `idx_producto_nombre` (`nombre`);

--
-- Indices de la tabla `producto_color`
--
ALTER TABLE `producto_color`
  ADD PRIMARY KEY (`id_producto`,`id_color`),
  ADD KEY `fk_producto_color_color` (`id_color`);

--
-- Indices de la tabla `producto_talla`
--
ALTER TABLE `producto_talla`
  ADD PRIMARY KEY (`id_producto`,`id_talla`),
  ADD KEY `fk_producto_talla_talla` (`id_talla`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tallas`
--
ALTER TABLE `tallas`
  ADD PRIMARY KEY (`id_talla`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `idx_usuario_rol` (`id_rol`),
  ADD KEY `idx_usuario_estado` (`estado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carritos`
--
ALTER TABLE `carritos`
  MODIFY `id_carrito` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `id_color` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_carrito`
--
ALTER TABLE `detalle_carrito`
  MODIFY `id_detalle_carrito` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle_pedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tallas`
--
ALTER TABLE `tallas`
  MODIFY `id_talla` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD CONSTRAINT `fk_carrito_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_carrito`
--
ALTER TABLE `detalle_carrito`
  ADD CONSTRAINT `fk_detalle_carrito_carrito` FOREIGN KEY (`id_carrito`) REFERENCES `carritos` (`id_carrito`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detalle_carrito_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `fk_detalle_pedido_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detalle_pedido_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `fk_inventario_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_color`
--
ALTER TABLE `producto_color`
  ADD CONSTRAINT `fk_producto_color_color` FOREIGN KEY (`id_color`) REFERENCES `colores` (`id_color`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_color_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_talla`
--
ALTER TABLE `producto_talla`
  ADD CONSTRAINT `fk_producto_talla_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_talla_talla` FOREIGN KEY (`id_talla`) REFERENCES `tallas` (`id_talla`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

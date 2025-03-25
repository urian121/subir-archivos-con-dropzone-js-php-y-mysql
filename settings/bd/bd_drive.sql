-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 25-03-2025 a las 15:02:48
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_drive`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_drive_files`
--

CREATE TABLE `tbl_drive_files` (
  `id_drive` int NOT NULL,
  `nombre_original` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_sistema` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_mime` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tamano` int NOT NULL COMMENT 'Tamaño en bytes',
  `fecha_subida` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int DEFAULT NULL COMMENT 'ID del usuario que subió el archivo',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `en_papelera` tinyint(1) NOT NULL DEFAULT '0',
  `id_folder` int UNSIGNED DEFAULT NULL,
  `id_menu_link` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_drive_files`
--

INSERT INTO `tbl_drive_files` (`id_drive`, `nombre_original`, `nombre_sistema`, `ruta`, `extension`, `tipo_mime`, `tamano`, `fecha_subida`, `id_usuario`, `activo`, `en_papelera`, `id_folder`, `id_menu_link`) VALUES
(1, '8675154_ic_fluent_lock_closed_regular_icon.png', '1742402732_5368.png', 'uploads/1742402732_5368.png', 'png', 'image/png', 544, '2025-03-19 11:45:32', 3, 1, 1, 0, 4),
(4, 'edumedia.jpg', '1742402733_3371.jpg', 'uploads/1742402733_3371.jpg', 'jpg', 'image/jpeg', 27641, '2025-03-19 11:45:33', 3, 1, 0, 12, NULL),
(5, 'closed.png', '1742411576_4330.png', 'uploads/1742411576_4330.png', 'png', 'image/png', 1653, '2025-03-19 14:12:56', 3, 1, 0, 0, 2),
(6, 'naruto1.jpg', '1742411597_2721.jpg', 'uploads/1742411597_2721.jpg', 'jpg', 'image/jpeg', 314517, '2025-03-19 14:13:17', 3, 1, 0, 0, 2),
(9, 'react_native(1).js', '1742415087_5309.js', 'uploads/1742415087_5309.js', 'js', 'application/x-javascript', 18, '2025-03-19 15:11:27', 3, 1, 1, 0, 4),
(10, '3SzfP9fw-GH_2DFR_2D196_5FMODELO_20HOJA_20DE_20VIDA_5Frv01-1-1.pdf', '1742415087_1819.pdf', 'uploads/1742415087_1819.pdf', 'pdf', 'application/pdf', 220035, '2025-03-19 15:11:27', 3, 1, 0, 0, 1),
(12, 'gaitan_servidor.sql', '1742416618_7544.sql', 'uploads/1742416618_7544.sql', 'sql', 'application/octet-stream', 16201, '2025-03-19 15:36:58', 3, 1, 0, 15, NULL),
(20, 'react_native(1).js', '1742427752_1162.js', 'uploads/1742427752_1162.js', 'js', 'application/x-javascript', 18, '2025-03-19 18:42:32', 3, 1, 1, 0, 4),
(22, 'react_native.js', '1742427752_9850.js', 'uploads/1742427752_9850.js', 'js', 'application/x-javascript', 18, '2025-03-19 18:42:32', 3, 1, 1, 0, 4),
(29, 'edumedia-removebg-preview(2).png', '1742431230_8189.png', 'uploads/1742431230_8189.png', 'png', 'image/png', 102490, '2025-03-19 19:40:30', 3, 1, 0, 15, NULL),
(30, '8675154_ic_fluent_lock_closed_regular_icon(1).png', '1742431239_6397.png', 'uploads/1742431239_6397.png', 'png', 'image/png', 544, '2025-03-19 19:40:39', 3, 1, 0, 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_drive_folders`
--

CREATE TABLE `tbl_drive_folders` (
  `id_folder` int UNSIGNED NOT NULL,
  `nombre_folder` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int DEFAULT NULL,
  `created_folder` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus_folder` tinyint(1) DEFAULT '1',
  `public` tinyint(1) NOT NULL DEFAULT '1',
  `id_menu_link` int UNSIGNED NOT NULL DEFAULT '1',
  `id_folder_padre` int UNSIGNED DEFAULT NULL COMMENT 'ID de la carpeta padre, NULL si es una carpeta raíz'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_drive_folders`
--

INSERT INTO `tbl_drive_folders` (`id_folder`, `nombre_folder`, `created_by`, `created_folder`, `estatus_folder`, `public`, `id_menu_link`, `id_folder_padre`) VALUES
(12, 'carpeta 1', 3, '2025-03-21 16:58:36', 1, 1, 1, NULL),
(13, 'carpeta 2', 3, '2025-03-21 16:58:50', 1, 1, 1, NULL),
(14, 'carpeta 3', 3, '2025-03-21 16:59:17', 1, 1, 2, NULL),
(15, 'carpeta 4', 3, '2025-03-21 16:59:26', 1, 1, 2, NULL),
(16, 'carpeta 5', 3, '2025-03-21 17:04:31', 1, 1, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_drive_menu_links`
--

CREATE TABLE `tbl_drive_menu_links` (
  `id_menu_link` int UNSIGNED NOT NULL,
  `nombre_menu` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icono_menu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estatus_menu` tinyint(1) DEFAULT '1',
  `posicion_menu` int NOT NULL,
  `created_at_menu` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_drive_menu_links`
--

INSERT INTO `tbl_drive_menu_links` (`id_menu_link`, `nombre_menu`, `url_menu`, `icono_menu`, `estatus_menu`, `posicion_menu`, `created_at_menu`) VALUES
(1, 'Mis archivos', '/mis-archivos/', 'bi bi-hdd', 1, 1, '2025-03-16 12:13:16'),
(2, 'Archivos compartidos', '/archivos-compartidos/', 'bi bi-share', 1, 2, '2025-03-16 12:13:16'),
(3, 'Favoritos', '/', 'bi bi-star', 0, 3, '2025-03-16 12:13:16'),
(4, 'Papelera', '/archivos-en-papelera/', 'bi bi-trash', 1, 4, '2025-03-16 12:13:16'),
(5, 'Mi perfil', '#', 'bi bi-person', 1, 5, '2025-03-16 12:13:16'),
(6, 'Cerrar sesión', '../actions/logout.php', 'bi bi-box-arrow-right', 1, 6, '2025-03-16 12:13:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_user` int NOT NULL,
  `email_user` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password_user` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `name_user` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `create_user` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus_user` tinyint NOT NULL DEFAULT '1',
  `sesion_desde_user` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sesion_hasta_user` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_users`
--

INSERT INTO `tbl_users` (`id_user`, `email_user`, `password_user`, `name_user`, `create_user`, `estatus_user`, `sesion_desde_user`, `sesion_hasta_user`) VALUES
(2, 'abelardo@gmail.com', '$2y$10$P6xmGncFmN3/6itQxpTlceH8WmdSyPQiFZV52puWuGi.bI4Nu2Leu', 'Urian', '2024-11-07 15:47:51', 1, NULL, NULL),
(3, 'dev@gmail.com', '$2y$10$iGX2nmHHYXuxUccXg7jlH.7RXeq3Yr4iy0voTpXR.nBKKP.fRZABK', 'Urian Viera', '2024-11-07 15:48:34', 1, '2025-03-19 17:22:PM', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_drive_files`
--
ALTER TABLE `tbl_drive_files`
  ADD PRIMARY KEY (`id_drive`),
  ADD KEY `idx_usuario` (`id_usuario`),
  ADD KEY `idx_fecha` (`fecha_subida`),
  ADD KEY `idx_extension` (`extension`);

--
-- Indices de la tabla `tbl_drive_folders`
--
ALTER TABLE `tbl_drive_folders`
  ADD PRIMARY KEY (`id_folder`);

--
-- Indices de la tabla `tbl_drive_menu_links`
--
ALTER TABLE `tbl_drive_menu_links`
  ADD PRIMARY KEY (`id_menu_link`);

--
-- Indices de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_drive_files`
--
ALTER TABLE `tbl_drive_files`
  MODIFY `id_drive` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `tbl_drive_folders`
--
ALTER TABLE `tbl_drive_folders`
  MODIFY `id_folder` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tbl_drive_menu_links`
--
ALTER TABLE `tbl_drive_menu_links`
  MODIFY `id_menu_link` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

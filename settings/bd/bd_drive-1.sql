-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-03-2025 a las 15:15:12
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
  `en_papelera` tinyint(1) NOT NULL DEFAULT '0',
  `id_folder` int UNSIGNED DEFAULT NULL,
  `id_menu_link` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, 'dev@gmail.com', '$2y$10$iGX2nmHHYXuxUccXg7jlH.7RXeq3Yr4iy0voTpXR.nBKKP.fRZABK', 'Urian Viera', '2024-11-07 15:48:34', 1, '2025-03-25 17:06:PM', '2025-03-25 10:39:AM');

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
  MODIFY `id_drive` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_drive_folders`
--
ALTER TABLE `tbl_drive_folders`
  MODIFY `id_folder` int UNSIGNED NOT NULL AUTO_INCREMENT;

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

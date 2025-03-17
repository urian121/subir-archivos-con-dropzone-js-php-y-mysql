-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-03-2025 a las 02:10:06
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
-- Base de datos: `drive_edumetrics`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_drive_directorios`
--

CREATE TABLE `tbl_drive_directorios` (
  `id_directorio` int UNSIGNED NOT NULL,
  `nombre_directorio` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_directorio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icono_directorio` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estatus_directorio` tinyint(1) DEFAULT '1',
  `posicion_directorio` int NOT NULL,
  `created_at_directorio` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_drive_directorios`
--

INSERT INTO `tbl_drive_directorios` (`id_directorio`, `nombre_directorio`, `url_directorio`, `icono_directorio`, `estatus_directorio`, `posicion_directorio`, `created_at_directorio`) VALUES
(1, 'Mis archivos', '/index.php', 'bi bi-hdd', 1, 1, '2025-03-16 12:13:16'),
(2, 'Archivos compartidos', '/archivos-compartidos/', 'bi bi-share', 1, 2, '2025-03-16 12:13:16'),
(3, 'Favoritos', '/', 'bi bi-star', 0, 3, '2025-03-16 12:13:16'),
(4, 'Papelera', '/archivos-en-papelera/', 'bi bi-trash', 1, 4, '2025-03-16 12:13:16'),
(5, 'Mi perfil', '#', 'bi bi-person', 1, 5, '2025-03-16 12:13:16'),
(6, 'Cerrar sesión', '/actions/logout.php', 'bi bi-box-arrow-right', 1, 6, '2025-03-16 12:13:16');

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
  `shared_files` tinyint(1) NOT NULL DEFAULT '0',
  `en_papelera` tinyint(1) NOT NULL DEFAULT '0',
  `id_folder` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_drive_files`
--

INSERT INTO `tbl_drive_files` (`id_drive`, `nombre_original`, `nombre_sistema`, `ruta`, `extension`, `tipo_mime`, `tamano`, `fecha_subida`, `id_usuario`, `activo`, `shared_files`, `en_papelera`, `id_folder`) VALUES
(9, 'vegeta 1.jpg', '1742137682_9862.jpg', 'uploads/1742137682_9862.jpg', 'jpg', 'image/jpeg', 11416, '2025-03-16 10:08:02', NULL, 1, 0, 0, 1),
(11, '1741872558_6450.tar', '1742137777_5035.tar', 'uploads/1742137777_5035.tar', 'tar', 'application/x-tar', 221696, '2025-03-16 10:09:37', NULL, 1, 0, 0, 2),
(12, 'b434341477aeca6f20c76f621950d8e9 - copia.jpg', '1742137777_4430.jpg', 'uploads/1742137777_4430.jpg', 'jpg', 'image/jpeg', 119345, '2025-03-16 10:09:37', NULL, 1, 0, 0, 6);

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
  `id_directorio` int UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_drive_folders`
--

INSERT INTO `tbl_drive_folders` (`id_folder`, `nombre_folder`, `created_by`, `created_folder`, `estatus_folder`, `id_directorio`) VALUES
(1, 'nueva', 3, '2025-03-16 20:51:56', 1, 2),
(2, 'papelera', 3, '2025-03-16 20:53:12', 1, 4),
(3, 'segunda', 3, '2025-03-16 20:56:41', 1, 2),
(4, 'mis-archivos', 3, '2025-03-16 20:57:47', 1, 1),
(5, 'tercera', 3, '2025-03-16 21:01:53', 1, 2),
(6, 'folder-1', 3, '2025-03-16 21:02:18', 1, 1),
(7, '4 carpeta', 3, '2025-03-16 21:05:18', 1, 2);

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
(3, 'dev@gmail.com', '$2y$10$iGX2nmHHYXuxUccXg7jlH.7RXeq3Yr4iy0voTpXR.nBKKP.fRZABK', 'Urian Viera', '2024-11-07 15:48:34', 1, '2025-03-16 20:28:PM', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_drive_directorios`
--
ALTER TABLE `tbl_drive_directorios`
  ADD PRIMARY KEY (`id_directorio`);

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
-- Indices de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_drive_directorios`
--
ALTER TABLE `tbl_drive_directorios`
  MODIFY `id_directorio` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_drive_files`
--
ALTER TABLE `tbl_drive_files`
  MODIFY `id_drive` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tbl_drive_folders`
--
ALTER TABLE `tbl_drive_folders`
  MODIFY `id_folder` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

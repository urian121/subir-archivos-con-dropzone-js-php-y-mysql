-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-03-2025 a las 22:32:50
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
  `en_papelera` tinyint(1) NOT NULL DEFAULT '0',
  `id_folder` int UNSIGNED DEFAULT NULL,
  `id_directorio` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_drive_files`
--

INSERT INTO `tbl_drive_files` (`id_drive`, `nombre_original`, `nombre_sistema`, `ruta`, `extension`, `tipo_mime`, `tamano`, `fecha_subida`, `id_usuario`, `activo`, `en_papelera`, `id_folder`, `id_directorio`) VALUES
(1, 'naruto (1)-1.webp', '1742242789_5495.webp', 'uploads/1742242789_5495.webp', 'webp', 'image/webp', 69024, '2025-03-17 15:19:49', 3, 1, 1, 0, 1),
(2, 'naruto (1)-1.webp', '1742242862_2286.webp', 'uploads/1742242862_2286.webp', 'webp', 'image/webp', 69024, '2025-03-17 15:21:02', 3, 1, 0, 2, NULL),
(3, 'naruto (1)-2.webp', '1742242862_7830.webp', 'uploads/1742242862_7830.webp', 'webp', 'image/webp', 69024, '2025-03-17 15:21:02', 3, 1, 0, 2, NULL),
(4, 'home.css', '1742243178_2284.css', 'uploads/1742243178_2284.css', 'css', 'text/css', 67, '2025-03-17 15:26:18', 3, 1, 0, 3, 1),
(5, 'header.png', '1742243406_9189.png', 'uploads/1742243406_9189.png', 'png', 'image/png', 29855, '2025-03-17 15:30:06', 3, 1, 0, 4, NULL),
(6, 'vegeta.webp', '1742243413_7374.webp', 'uploads/1742243413_7374.webp', 'webp', 'image/webp', 43812, '2025-03-17 15:30:13', 3, 1, 0, 3, NULL),
(7, 'naruto (1)-1-1.webp', '1742243702_2710.webp', 'uploads/1742243702_2710.webp', 'webp', 'image/webp', 69024, '2025-03-17 15:35:02', 3, 1, 0, 2, 1),
(8, 'naruto1 (1)(1).jpg', '1742243702_4436.jpg', 'uploads/1742243702_4436.jpg', 'jpg', 'image/jpeg', 314517, '2025-03-17 15:35:02', 3, 1, 0, 2, 1),
(9, 'naruto (1)-2.webp', '1742243703_3752.webp', 'uploads/1742243703_3752.webp', 'webp', 'image/webp', 69024, '2025-03-17 15:35:03', 3, 1, 0, 2, 1),
(10, 'naruto (1)-1.webp', '1742243703_1838.webp', 'uploads/1742243703_1838.webp', 'webp', 'image/webp', 69024, '2025-03-17 15:35:03', 3, 1, 0, 2, 1),
(11, 'ico.ico', '1742243719_4926.ico', 'uploads/1742243719_4926.ico', 'ico', 'image/x-icon', 43406, '2025-03-17 15:35:19', 3, 1, 0, 2, 1),
(12, 'header.png', '1742243719_6939.png', 'uploads/1742243719_6939.png', 'png', 'image/png', 29855, '2025-03-17 15:35:19', 3, 1, 0, 2, 1),
(13, 'edumetrics-drive-removebg-preview.png', '1742243720_4407.png', 'uploads/1742243720_4407.png', 'png', 'image/png', 14048, '2025-03-17 15:35:20', 3, 1, 0, 2, 1),
(14, 'edumetrics-drive.jpg', '1742243720_5817.jpg', 'uploads/1742243720_5817.jpg', 'jpg', 'image/jpeg', 3303, '2025-03-17 15:35:20', 3, 1, 0, 2, 1),
(15, 'naruto (1).webp', '1742243721_1407.webp', 'uploads/1742243721_1407.webp', 'webp', 'image/webp', 69024, '2025-03-17 15:35:21', 3, 1, 0, 2, 1),
(16, 'naruto1 (1).jpg', '1742243721_6446.jpg', 'uploads/1742243721_6446.jpg', 'jpg', 'image/jpeg', 314517, '2025-03-17 15:35:21', 3, 1, 0, 4, NULL),
(17, 'naruto1.jpg', '1742243722_5655.jpg', 'uploads/1742243722_5655.jpg', 'jpg', 'image/jpeg', 314517, '2025-03-17 15:35:22', 3, 1, 1, 4, NULL),
(18, 'naruto.webp', '1742243722_1297.webp', 'uploads/1742243722_1297.webp', 'webp', 'image/webp', 69024, '2025-03-17 15:35:22', 3, 1, 0, 2, 1),
(19, 'naruto (1)-2.webp', '1742243949_7954.webp', 'uploads/1742243949_7954.webp', 'webp', 'image/webp', 69024, '2025-03-17 15:39:09', 3, 1, 0, 1, 2),
(20, 'naruto (1)-1.webp', '1742243949_3289.webp', 'uploads/1742243949_3289.webp', 'webp', 'image/webp', 69024, '2025-03-17 15:39:09', 3, 1, 0, 1, 2),
(21, 'index.html', '1742243949_1938.html', 'uploads/1742243949_1938.html', 'html', 'text/html', 234, '2025-03-17 15:39:09', 3, 1, 0, 1, 2),
(22, 'home.css', '1742243949_5976.css', 'uploads/1742243949_5976.css', 'css', 'text/css', 67, '2025-03-17 15:39:09', 3, 1, 0, 1, 2),
(23, 'vegeta.webp', '1742243964_7790.webp', 'uploads/1742243964_7790.webp', 'webp', 'image/webp', 43812, '2025-03-17 15:39:24', 3, 1, 1, 0, 2),
(24, 'a525ed4f2677b03dfeb313a9956e6382814a7534_high-1.webp', '1742243964_1229.webp', 'uploads/1742243964_1229.webp', 'webp', 'image/webp', 98744, '2025-03-17 15:39:24', 3, 1, 1, 0, 2),
(25, '1(1).tar', '1742243965_9142.tar', 'uploads/1742243965_9142.tar', 'tar', 'application/x-tar', 221696, '2025-03-17 15:39:25', 3, 1, 0, 0, 2),
(26, 'naruto (1)-2.webp', '1742244661_9630.webp', 'uploads/1742244661_9630.webp', 'webp', 'image/webp', 69024, '2025-03-17 15:51:01', 3, 1, 0, 0, 1),
(27, 'naruto (1)-1.webp', '1742244661_7418.webp', 'uploads/1742244661_7418.webp', 'webp', 'image/webp', 69024, '2025-03-17 15:51:01', 3, 1, 0, 0, 1),
(28, 'robot.jpg', '1742244662_4844.jpg', 'uploads/1742244662_4844.jpg', 'jpg', 'image/jpeg', 111027, '2025-03-17 15:51:02', 3, 1, 0, 0, 1),
(29, 'robot.webp', '1742244662_8227.webp', 'uploads/1742244662_8227.webp', 'webp', 'image/webp', 45954, '2025-03-17 15:51:02', 3, 1, 0, 3, NULL),
(30, 'vegeta 1.jpg', '1742244663_3336.jpg', 'uploads/1742244663_3336.jpg', 'jpg', 'image/jpeg', 11416, '2025-03-17 15:51:03', 3, 1, 0, 0, 1),
(31, 'vegeta.webp', '1742244663_4119.webp', 'uploads/1742244663_4119.webp', 'webp', 'image/webp', 43812, '2025-03-17 15:51:03', 3, 1, 0, 4, NULL),
(32, 'naruto1 (1)(1).jpg', '1742247102_5815.jpg', 'uploads/1742247102_5815.jpg', 'jpg', 'image/jpeg', 314517, '2025-03-17 16:31:42', 3, 1, 0, 6, 1),
(33, 'CV-URIAN-VIERA.pdf', '1742247335_5373.pdf', 'uploads/1742247335_5373.pdf', 'pdf', 'application/pdf', 2253931, '2025-03-17 16:35:35', 3, 1, 0, 4, 5),
(34, '3SzfP9fw-GH_2DFR_2D196_5FMODELO_20HOJA_20DE_20VIDA_5Frv01-1.pdf', '1742247379_7616.pdf', 'uploads/1742247379_7616.pdf', 'pdf', 'application/pdf', 220035, '2025-03-17 16:36:19', 3, 1, 0, 6, 5),
(35, 'vegeta 1.jpg', '1742247394_1838.jpg', 'uploads/1742247394_1838.jpg', 'jpg', 'image/jpeg', 11416, '2025-03-17 16:36:34', 3, 1, 0, 0, 1),
(36, 'robot.jpg', '1742247394_7107.jpg', 'uploads/1742247394_7107.jpg', 'jpg', 'image/jpeg', 111027, '2025-03-17 16:36:34', 3, 1, 0, 0, 1),
(37, 'vegeta.webp', '1742247398_1976.webp', 'uploads/1742247398_1976.webp', 'webp', 'image/webp', 43812, '2025-03-17 16:36:38', 3, 1, 0, 0, 1),
(38, '1(1).tar', '1742247398_9912.tar', 'uploads/1742247398_9912.tar', 'tar', 'application/x-tar', 221696, '2025-03-17 16:36:38', 3, 1, 0, 0, 1),
(39, 'CV-URIAN-VIERA.pdf', '1742247427_1273.pdf', 'uploads/1742247427_1273.pdf', 'pdf', 'application/pdf', 2253931, '2025-03-17 16:37:07', 3, 1, 0, 2, 1),
(40, 'naruto1 (1)(1).jpg', '1742247456_6120.jpg', 'uploads/1742247456_6120.jpg', 'jpg', 'image/jpeg', 314517, '2025-03-17 16:37:36', 3, 1, 0, 3, 1),
(41, 'loading.svg', '1742247742_3142.svg', 'uploads/1742247742_3142.svg', 'svg', 'image/svg+xml', 1003, '2025-03-17 16:42:22', 3, 1, 0, 1, 2),
(42, 'tube-spinner(1).svg', '1742247742_1878.svg', 'uploads/1742247742_1878.svg', 'svg', 'image/svg+xml', 1003, '2025-03-17 16:42:22', 3, 1, 0, 1, 2);

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
(1, 'carpeta 1', 3, '2025-03-17 15:24:01', 1, 2),
(2, 'Carpeta 1', 3, '2025-03-17 15:24:23', 1, 1),
(3, 'carpeta 2', 3, '2025-03-17 15:24:51', 1, 1),
(4, 'carpeta 3', 3, '2025-03-17 15:34:20', 1, 1),
(5, 'nueva', 3, '2025-03-17 16:31:23', 1, 6),
(6, 'nuebvasaqe', 3, '2025-03-17 16:31:33', 1, 1);

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
(3, 'dev@gmail.com', '$2y$10$iGX2nmHHYXuxUccXg7jlH.7RXeq3Yr4iy0voTpXR.nBKKP.fRZABK', 'Urian Viera', '2024-11-07 15:48:34', 1, '2025-03-17 17:13:PM', NULL);

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
  MODIFY `id_drive` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `tbl_drive_folders`
--
ALTER TABLE `tbl_drive_folders`
  MODIFY `id_folder` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

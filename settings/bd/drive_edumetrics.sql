-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 14-03-2025 a las 23:18:28
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
-- Estructura de tabla para la tabla `tbl_files`
--

CREATE TABLE `tbl_files` (
  `id` int NOT NULL,
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
  `id_folder` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_files`
--

INSERT INTO `tbl_files` (`id`, `nombre_original`, `nombre_sistema`, `ruta`, `extension`, `tipo_mime`, `tamano`, `fecha_subida`, `id_usuario`, `activo`, `en_papelera`, `id_folder`) VALUES
(2, 'no.txt', '1741906883_8681.txt', 'uploads/1741906883_8681.txt', 'txt', 'text/plain', 4338, '2025-03-13 18:01:23', NULL, 1, 0, 0),
(6, 'b434341477aeca6f20c76f621950d8e9 - copia.jpg', '1741819398_3257.jpg', 'uploads/1741819398_3257.jpg', 'jpg', 'image/jpeg', 119345, '2025-03-12 17:43:18', NULL, 1, 0, 0),
(11, '3SzfP9fw-GH_2DFR_2D196_5FMODELO_20HOJA_20DE_20VIDA_5Frv01.pdf', '1741872105_7686.pdf', 'uploads/1741872105_7686.pdf', 'pdf', 'application/pdf', 220035, '2025-03-13 08:21:45', NULL, 1, 0, 0),
(12, 'loader.gif', '1741872131_4136.gif', 'uploads/1741872131_4136.gif', 'gif', 'image/gif', 2291272, '2025-03-13 08:22:11', NULL, 1, 0, 0),
(14, 'GH-FR-196_MODELO HOJA DE VIDA_rv01.doc', '1741872444_4205.doc', 'uploads/1741872444_4205.doc', 'doc', 'application/msword', 142848, '2025-03-13 08:27:24', NULL, 1, 0, 0),
(15, 'tab_contenidos.sql', '1741872456_9591.sql', 'uploads/1741872456_9591.sql', 'sql', 'application/octet-stream', 136623, '2025-03-13 08:27:36', NULL, 1, 0, 0),
(16, '1. DESARROLLOS PENDIENTE EXPLORERS..pptx', '1741872473_8717.pptx', 'uploads/1741872473_8717.pptx', 'pptx', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 1845191, '2025-03-13 08:27:53', NULL, 1, 0, 0),
(17, 'DATA-ESTUDIANTES.csv', '1741872539_9532.csv', 'uploads/1741872539_9532.csv', 'csv', 'application/vnd.ms-excel', 447, '2025-03-13 08:28:59', NULL, 1, 0, 0),
(18, '1.tar', '1741872558_6450.tar', 'uploads/1741872558_6450.tar', 'tar', 'application/x-tar', 221696, '2025-03-13 08:29:18', NULL, 1, 0, 0),
(20, 'ac4822aefaec274c6c5dc99b54034596.gif', '1741872720_4829.gif', 'uploads/1741872720_4829.gif', 'gif', 'image/gif', 1437234, '2025-03-13 08:32:00', NULL, 1, 0, 0),
(21, 'QwIA.gif', '1741872720_5095.gif', 'uploads/1741872720_5095.gif', 'gif', 'image/gif', 428746, '2025-03-13 08:32:00', NULL, 1, 0, 0),
(22, 'react-native (1).webp', '1741872727_8967.webp', 'uploads/1741872727_8967.webp', 'webp', 'image/webp', 18468, '2025-03-13 08:32:07', NULL, 1, 0, 0),
(23, 'ac4822aefaec274c6c5dc99b54034596.gif', '1741875413_5918.gif', 'uploads/1741875413_5918.gif', 'gif', 'image/gif', 1437234, '2025-03-13 09:16:53', NULL, 1, 0, 0),
(25, 'chica.webp', '1741880161_9401.webp', 'uploads/1741880161_9401.webp', 'webp', 'image/webp', 205444, '2025-03-13 10:36:01', NULL, 1, 0, 2),
(26, 'video x.mp4', '1741880592_7037.mp4', 'uploads/1741880592_7037.mp4', 'mp4', 'video/mp4', 6720083, '2025-03-13 10:43:12', NULL, 1, 0, 2),
(28, 'links.txt', '1741880639_3629.txt', 'uploads/1741880639_3629.txt', 'txt', 'text/plain', 2583, '2025-03-13 10:43:59', NULL, 1, 0, 2),
(29, 'Loading.mp4', '1741880639_1443.mp4', 'uploads/1741880639_1443.mp4', 'mp4', 'video/mp4', 6038663, '2025-03-13 10:43:59', NULL, 1, 0, 2),
(30, 'errores-comunes-python.md', '1741880644_3925.md', 'uploads/1741880644_3925.md', 'md', 'application/octet-stream', 429, '2025-03-13 10:44:04', NULL, 1, 0, 2),
(32, 'a525ed4f2677b03dfeb313a9956e6382814a7534_high.webp', '1741880663_2064.webp', 'uploads/1741880663_2064.webp', 'webp', 'image/webp', 98744, '2025-03-13 10:44:23', NULL, 1, 0, 2),
(33, '31f3b0ffcafc242691e358dc765362d4e06b1a89_high.webp', '1741880667_1101.webp', 'uploads/1741880667_1101.webp', 'webp', 'image/webp', 211288, '2025-03-13 10:44:27', NULL, 1, 0, 2),
(35, '7455b9b8e8d96420ef70491694db3732_high.webp', '1741880671_6225.webp', 'uploads/1741880671_6225.webp', 'webp', 'image/webp', 113700, '2025-03-13 10:44:31', NULL, 1, 0, 2),
(41, 'tube-spinner(1).svg', '1741895750_8507.svg', 'uploads/1741895750_8507.svg', 'svg', 'image/svg+xml', 1003, '2025-03-13 14:55:50', NULL, 1, 0, 2),
(42, 'loading.svg', '1741895750_9146.svg', 'uploads/1741895750_9146.svg', 'svg', 'image/svg+xml', 1003, '2025-03-13 14:55:50', NULL, 1, 0, 2),
(50, 'naruto.webp', '1741959451_2694.webp', 'uploads/1741959451_2694.webp', 'webp', 'image/webp', 69024, '2025-03-14 08:37:31', NULL, 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_folders`
--

CREATE TABLE `tbl_folders` (
  `id_folder` int UNSIGNED NOT NULL,
  `nombre_folder` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_folders`
--

INSERT INTO `tbl_folders` (`id_folder`, `nombre_folder`) VALUES
(1, 'Programacion'),
(2, 'Videos');

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
(3, 'dev@gmail.com', '$2y$10$iGX2nmHHYXuxUccXg7jlH.7RXeq3Yr4iy0voTpXR.nBKKP.fRZABK', 'Urian Viera', '2024-11-07 15:48:34', 1, '2025-03-14 17:55:PM', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_files`
--
ALTER TABLE `tbl_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_usuario` (`id_usuario`),
  ADD KEY `idx_fecha` (`fecha_subida`),
  ADD KEY `idx_extension` (`extension`);

--
-- Indices de la tabla `tbl_folders`
--
ALTER TABLE `tbl_folders`
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
-- AUTO_INCREMENT de la tabla `tbl_files`
--
ALTER TABLE `tbl_files`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

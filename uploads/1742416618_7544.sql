-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-03-2025 a las 18:35:05
-- Versión del servidor: 8.0.41-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gaitan_servidor`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_pin` (IN `cantidad` INT, IN `tiempo` INT, IN `digitos` INT(2), IN `nota` TEXT)  BEGIN
    DECLARE max_intentos INT DEFAULT 10;
    DECLARE contador INT DEFAULT 0;
    DECLARE pines_insertados INT DEFAULT 0;
    DECLARE id VARCHAR(10);
    DECLARE pin VARCHAR(7);
    DECLARE identificador VARCHAR(5) DEFAULT CONCAT(SUBSTRING(YEAR(CURDATE()), 4, 1), DATE_FORMAT(CURDATE(), '%m%d'));
    DECLARE intento INT;
    DECLARE ultimo_identificador INT DEFAULT (
        SELECT COALESCE(MAX(CAST(SUBSTRING(id_usr, 7) AS UNSIGNED)), 0)
        FROM usuarios
        WHERE SUBSTRING(id_usr, 1, 5) = identificador
    );
    
    IF digitos IS NULL OR digitos <= 0 THEN
        SET digitos = 6;
    END IF;
    
    IF tiempo IS NULL OR tiempo <= 0 THEN
        SET tiempo = 1;
    END IF;
    
    WHILE contador < cantidad DO
        SET id = CONCAT(identificador, LPAD(ultimo_identificador + 1, 4, '0'));  -- Generar ID
        SET intento = 0;
        REPEAT
            SET pin = generar_pin(digitos);
            SET intento = intento + 1;
        UNTIL (SELECT COUNT(*) FROM usuarios WHERE pin_usr = pin) = 0 OR intento >= max_intentos
        END REPEAT;
        IF intento < max_intentos THEN
            INSERT INTO usuarios (id_usr, pin_usr, vigencia_usr,nota_usr)
            VALUES (id, pin, tiempo, nota);
            SET contador = contador + 1;
            SET ultimo_identificador = ultimo_identificador + 1;
            SET pines_insertados = pines_insertados + 1;
        ELSE
            SET contador = contador + 1;
        END IF;
    END WHILE;
    SELECT CONCAT('Se insertaron ', pines_insertados, ' pines de ',cantidad,' solicitados') AS mensaje;
END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `generar_pin` (`digitos` INT) RETURNS VARCHAR(255) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci NO SQL
    COMMENT 'generador de pines'
BEGIN
    DECLARE caracteres VARCHAR(33) DEFAULT 'ABCDEFGHJKLMNPQRSTUVWXYZ123456789';
    DECLARE pin VARCHAR(250) DEFAULT '';
    DECLARE i INT DEFAULT 0;
    WHILE i < digitos DO
        SET pin = CONCAT(pin, SUBSTRING(caracteres, FLOOR(1 + (RAND() * 32)), 1));
        SET i = i + 1;
    END WHILE;
    
    RETURN pin;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estudiantes`
--

CREATE TABLE `tbl_estudiantes` (
  `id_estudiante` int NOT NULL,
  `code_estudiante` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `documento_estudiante` int DEFAULT NULL,
  `nombre_estudiante` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `apellido_estudiante` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email_estudiante` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fecha_nacimiento_estudiante` date NOT NULL,
  `direccion_estudiante` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `perfil_estudiante` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `estado_estudiante` tinyint DEFAULT '1',
  `id_grado` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tbl_estudiantes`
--

INSERT INTO `tbl_estudiantes` (`id_estudiante`, `code_estudiante`, `documento_estudiante`, `nombre_estudiante`, `apellido_estudiante`, `email_estudiante`, `fecha_nacimiento_estudiante`, `direccion_estudiante`, `perfil_estudiante`, `estado_estudiante`, `id_grado`, `created_at`) VALUES
(63, 'RARO79', 3334987, 'Ramírez', 'Rodríguez', 'email_estudiante4@gmail.com', '2020-12-01', 'Fontibón', NULL, 1, 42, '2025-01-20 15:35:15'),
(73, 'JOVS98', 33313323, 'josé actualizado2', 'Vásquez', 'email_estudiante1@gmail.com', '2020-12-01', 'Fontibon', NULL, 1, 43, '2025-01-20 15:43:25'),
(74, 'PEDA50', 2147483647, 'peña Actualizado', 'Díaz', 'email_estudiante2@gmail.com', '2020-12-05', 'Fontibon', NULL, 1, 43, '2025-01-20 15:43:25'),
(75, 'LUGM40', 44433333, 'Lucía', 'Gímenez', 'email_estudiante3@gmail.com', '2020-12-01', 'Fontibon', NULL, 1, 43, '2025-01-20 15:43:25'),
(76, 'VEMN59', 33332336, 'Verónica', 'Méndez 1', 'email_estudiante5@gmail.com', '2023-02-03', 'Suba1', NULL, 1, 42, '2025-01-20 15:43:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_grados`
--

CREATE TABLE `tbl_grados` (
  `id_grado` int NOT NULL,
  `grado` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jornada` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seccion` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estatus_grado` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tbl_grados`
--

INSERT INTO `tbl_grados` (`id_grado`, `grado`, `jornada`, `seccion`, `estatus_grado`, `created_at`) VALUES
(40, 'Transición', 'Mañana', 'A1', 1, '2024-12-19 17:04:38'),
(41, 'Transición', 'Tarde', 'A', 1, '2024-12-19 17:04:46'),
(42, 'Kinder', 'Tarde', 'B', 1, '2024-12-19 17:04:51'),
(43, 'Kinder', 'Tarde', 'C', 1, '2024-12-19 17:04:58'),
(44, 'Kinder', 'Noche', 'A', 1, '2024-12-19 17:05:05'),
(45, 'Transición', 'Mañana', 'B', 1, '2025-01-14 16:35:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_materias`
--

CREATE TABLE `tbl_materias` (
  `id_materia` int NOT NULL,
  `nombre_materia` varchar(100) NOT NULL,
  `estatus_materia` tinyint NOT NULL DEFAULT '1',
  `editar_materia` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tbl_materias`
--

INSERT INTO `tbl_materias` (`id_materia`, `nombre_materia`, `estatus_materia`, `editar_materia`, `created_at`) VALUES
(1, 'Matemáticas', 1, 0, '2024-10-29 16:53:16'),
(2, 'Ciencias Naturales', 1, 0, '2024-10-29 16:53:16'),
(3, 'Español', 1, 0, '2024-10-29 16:53:16'),
(4, 'Ciencias Sociales', 0, 0, '2024-10-29 16:53:16'),
(9, 'Inglés', 0, 0, '2024-10-29 16:53:16'),
(54, 'Programación', 1, 1, '2025-03-13 21:32:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_notificaciones`
--

CREATE TABLE `tbl_notificaciones` (
  `id_notificacion` int NOT NULL,
  `titulo_notificacion` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensaje_notificacion` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `file_notificacion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destino_notificacion` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estatus_notificacion` int NOT NULL DEFAULT '1',
  `fecha_publicacion_notificacion` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_notificaciones`
--

INSERT INTO `tbl_notificaciones` (`id_notificacion`, `titulo_notificacion`, `mensaje_notificacion`, `file_notificacion`, `destino_notificacion`, `estatus_notificacion`, `fecha_publicacion_notificacion`, `created_at`) VALUES
(2, 'sdf', 'twetwe', '', '3', 1, '2024-12-18', '2024-12-16 14:31:01'),
(3, 'hola', 'que hacen?', '', '2', 0, '2024-12-18', '2024-12-16 14:50:20'),
(4, 'nuevo', 'hola gente!', '', '1', 1, '2024-12-18', '2024-12-16 15:22:20'),
(5, 'Ejemplo', 'hola a todos', '33443e75fba03e94a479.png', '2', 1, '2024-12-10', '2024-12-16 15:44:08'),
(6, 'n', 'hola', '68a3fc0e174cdb8c806b.jpg', '1', 1, '2025-01-16', '2025-01-15 09:49:20'),
(7, 'Vierenes', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde.', '6539b1d88c2883f67879.jpg', 'Estudiantes', 1, '2025-01-23', '2025-01-17 08:48:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_profesores`
--

CREATE TABLE `tbl_profesores` (
  `id_profe` int NOT NULL,
  `code_profe` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nombre_profe` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apellido_profe` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `identificacion_profe` int DEFAULT NULL,
  `telefono_profe` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_profe` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `especialidad_profe` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avatar_profe` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estatus_profe` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_profesores`
--

INSERT INTO `tbl_profesores` (`id_profe`, `code_profe`, `nombre_profe`, `apellido_profe`, `identificacion_profe`, `telefono_profe`, `email_profe`, `especialidad_profe`, `avatar_profe`, `estatus_profe`, `created_at`) VALUES
(531, 'VEMN64', 'Verónica', 'Méndez', 53453, '4569871235', 'veronica@gmail.com', '444333', NULL, 1, '2025-01-17 20:42:32'),
(543, 'JOVS82', 'josé', 'Vásquez', 143223, '1236547892', 'profesor1@gmail.com', 'Física', NULL, 1, '2025-01-17 20:45:56'),
(544, 'PEDA98', 'peña', 'Díaz', 344443, '7896541235', 'profesor2@gmail.com', 'Ingeniero', NULL, 1, '2025-01-17 20:45:56'),
(545, 'LUGM91', 'Lucía', 'Gímenez', 342345, '2136547896', 'profesor3@gmail.com', 'Inglés', NULL, 1, '2025-01-17 20:45:56'),
(546, 'RARO14', 'Ramírez', 'Rodríguez', 876867, '1231654123', 'profesor4@gmail.com', 'Administración', NULL, 1, '2025-01-17 20:45:56'),
(547, 'NOAP64', '555', 'Apellido 1', 54543, '1234567898', 'correo@gmail.com', 'hh', NULL, 1, '2025-01-17 20:45:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_profesores_materias`
--

CREATE TABLE `tbl_profesores_materias` (
  `id_asignacion` int NOT NULL,
  `id_profesor` int DEFAULT NULL,
  `id_materia` int DEFAULT NULL,
  `id_grado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tbl_profesores_materias`
--

INSERT INTO `tbl_profesores_materias` (`id_asignacion`, `id_profesor`, `id_materia`, `id_grado`) VALUES
(150, 531, 3, 42),
(151, 531, 2, 42),
(152, 531, 3, 45),
(153, 531, 2, 45),
(154, 531, 2, 41),
(155, 531, 3, 41),
(156, 531, 9, 41),
(158, 544, 2, 41),
(159, 544, 4, 41);

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
(3, 'dev@gmail.com', '$2y$10$iGX2nmHHYXuxUccXg7jlH.7RXeq3Yr4iy0voTpXR.nBKKP.fRZABK', 'Urian Viera', '2024-11-07 15:48:34', 1, '2025-03-17 10:05:AM', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_estudiantes`
--
ALTER TABLE `tbl_estudiantes`
  ADD PRIMARY KEY (`id_estudiante`),
  ADD UNIQUE KEY `numero_documento` (`documento_estudiante`),
  ADD KEY `fk_alumno_curso` (`id_grado`);

--
-- Indices de la tabla `tbl_grados`
--
ALTER TABLE `tbl_grados`
  ADD PRIMARY KEY (`id_grado`);

--
-- Indices de la tabla `tbl_materias`
--
ALTER TABLE `tbl_materias`
  ADD PRIMARY KEY (`id_materia`);

--
-- Indices de la tabla `tbl_notificaciones`
--
ALTER TABLE `tbl_notificaciones`
  ADD PRIMARY KEY (`id_notificacion`);

--
-- Indices de la tabla `tbl_profesores`
--
ALTER TABLE `tbl_profesores`
  ADD PRIMARY KEY (`id_profe`),
  ADD UNIQUE KEY `identificacion` (`identificacion_profe`),
  ADD UNIQUE KEY `identificacion_2` (`identificacion_profe`),
  ADD UNIQUE KEY `code_profe` (`code_profe`);

--
-- Indices de la tabla `tbl_profesores_materias`
--
ALTER TABLE `tbl_profesores_materias`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `fk_profesor` (`id_profesor`),
  ADD KEY `fk_curso` (`id_grado`),
  ADD KEY `id_materia` (`id_materia`);

--
-- Indices de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_estudiantes`
--
ALTER TABLE `tbl_estudiantes`
  MODIFY `id_estudiante` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `tbl_grados`
--
ALTER TABLE `tbl_grados`
  MODIFY `id_grado` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `tbl_materias`
--
ALTER TABLE `tbl_materias`
  MODIFY `id_materia` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `tbl_notificaciones`
--
ALTER TABLE `tbl_notificaciones`
  MODIFY `id_notificacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_profesores`
--
ALTER TABLE `tbl_profesores`
  MODIFY `id_profe` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=548;

--
-- AUTO_INCREMENT de la tabla `tbl_profesores_materias`
--
ALTER TABLE `tbl_profesores_materias`
  MODIFY `id_asignacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_estudiantes`
--
ALTER TABLE `tbl_estudiantes`
  ADD CONSTRAINT `fk_alumno_curso` FOREIGN KEY (`id_grado`) REFERENCES `tbl_grados` (`id_grado`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `tbl_profesores_materias`
--
ALTER TABLE `tbl_profesores_materias`
  ADD CONSTRAINT `fk_curso` FOREIGN KEY (`id_grado`) REFERENCES `tbl_grados` (`id_grado`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_profesor` FOREIGN KEY (`id_profesor`) REFERENCES `tbl_profesores` (`id_profe`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

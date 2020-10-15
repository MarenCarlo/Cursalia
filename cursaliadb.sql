-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 01-09-2020 a las 03:54:07
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cursaliadb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

DROP TABLE IF EXISTS `actividades`;
CREATE TABLE IF NOT EXISTS `actividades` (
  `idActividad` int(11) NOT NULL AUTO_INCREMENT,
  `NombreActividad` varchar(64) NOT NULL,
  `DescripcionActividad` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Fecha_Entrega` datetime NOT NULL,
  `FK_Curso` int(11) NOT NULL,
  `FK_Grado` int(11) NOT NULL,
  PRIMARY KEY (`idActividad`),
  KEY `FK_Actividad_Curso` (`FK_Curso`),
  KEY `FK_Actividad_Grado` (`FK_Grado`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`idActividad`, `NombreActividad`, `DescripcionActividad`, `Fecha_Entrega`, `FK_Curso`, `FK_Grado`) VALUES
(17, 'Que son los agujeros Negros?', 'Investigar que son los agujeros negros, minimo 10 paginas en Word, con comentario personal, sobre lo que a usted le llamo la atencion de este tema', '2020-07-17 23:59:00', 1, 2),
(18, 'La Vida De Jesus', 'Resumen de 10 paginas sobre la vida y los milagros mas famosos de Jesucristo!', '2020-07-15 23:59:00', 2, 2),
(19, 'Que es la Fotosintesis?', 'Investigacion sobre la fotosintesis.', '2020-07-20 00:45:00', 1, 2),
(21, 'La Via Lactea', 'Investigar que es la Vía Láctea...', '2020-07-24 23:59:00', 1, 2),
(22, 'Que es la Mecanica Cuantica?', 'Investigacion sobre que es la mecanica cuantica en el universo', '2020-08-25 23:59:00', 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_contenidos`
--

DROP TABLE IF EXISTS `archivos_contenidos`;
CREATE TABLE IF NOT EXISTS `archivos_contenidos` (
  `idContenido` int(11) NOT NULL,
  `Nombre_Contenido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Ruta_Contenido` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Tipo_Contenido` set('Enlace','Archivo') NOT NULL,
  `Url_Contenido` varchar(1024) DEFAULT NULL,
  `Titulo_Contenido` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Descripcion_Contenido` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `FK_Curso` int(11) NOT NULL,
  `FK_Usuario` int(11) NOT NULL,
  KEY `FK_Contenido_Cursos` (`FK_Curso`),
  KEY `FK_Contenido_Usuarios` (`FK_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_tareas`
--

DROP TABLE IF EXISTS `archivos_tareas`;
CREATE TABLE IF NOT EXISTS `archivos_tareas` (
  `idArchivo` int(11) NOT NULL AUTO_INCREMENT,
  `NombreArchivo` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `RutaArchivo` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `FK_Usuario` int(11) NOT NULL,
  PRIMARY KEY (`idArchivo`),
  KEY `FK_ArchivoT_Usuario` (`FK_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `archivos_tareas`
--

INSERT INTO `archivos_tareas` (`idArchivo`, `NombreArchivo`, `RutaArchivo`, `FK_Usuario`) VALUES
(1, 'Sin Archivos', 'No ha entregado nada aun', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCurso` varchar(128) NOT NULL,
  `Descripcion` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `FK_Catedratico` int(11) NOT NULL,
  `FK_Grado` int(11) NOT NULL,
  PRIMARY KEY (`idCurso`),
  KEY `FK_Curso_Catedratico` (`FK_Catedratico`),
  KEY `FK_Grado_Catedratico` (`FK_Grado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`idCurso`, `NombreCurso`, `Descripcion`, `FK_Catedratico`, `FK_Grado`) VALUES
(1, 'Ciencias Naturales', 'Materia que enseña los conocimientos básicos sobre ciencia a los Alumnos.', 2, 2),
(2, 'Religión', 'Materia que enseña los conocimientos basicos sobre Teologia a los alumnos.', 2, 2),
(4, 'Matematicas', 'Este Curso otorga los conocimientos basicos de Matematicas, En este curso se te otorgaran los conocimientos necesarios para aprobar esta materia tan importante correspondiente a tu grado.', 1, 2),
(5, 'Física Fundamental III ', 'Clase que enseña los conocimientos básicos de Física Fundamental a los alumnos de Tercero Básico.', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_actividades`
--

DROP TABLE IF EXISTS `detalle_actividades`;
CREATE TABLE IF NOT EXISTS `detalle_actividades` (
  `idDetalleActividad` int(11) NOT NULL AUTO_INCREMENT,
  `Estado_Entrega` set('Entregado','No Entregado') NOT NULL,
  `Estado_Calificacion` set('Calificada','Sin Calificar') NOT NULL,
  `Calificacion` tinyint(3) NOT NULL,
  `FK_Actividad` int(11) NOT NULL,
  `FK_Usuario` int(11) NOT NULL,
  `FK_Archivos` int(11) NOT NULL,
  PRIMARY KEY (`idDetalleActividad`),
  KEY `FK_DetalleActividades_Actividades` (`FK_Actividad`),
  KEY `FK_DetalleActividades_Usuarios` (`FK_Usuario`),
  KEY `FK_DetalleActividades_Archivos` (`FK_Archivos`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detalle_actividades`
--

INSERT INTO `detalle_actividades` (`idDetalleActividad`, `Estado_Entrega`, `Estado_Calificacion`, `Calificacion`, `FK_Actividad`, `FK_Usuario`, `FK_Archivos`) VALUES
(6, 'No Entregado', 'Sin Calificar', 0, 17, 3, 1),
(7, 'No Entregado', 'Sin Calificar', 0, 17, 4, 1),
(8, 'No Entregado', 'Sin Calificar', 0, 18, 3, 1),
(10, 'No Entregado', 'Sin Calificar', 0, 18, 4, 1),
(11, 'No Entregado', 'Sin Calificar', 0, 19, 3, 1),
(12, 'No Entregado', 'Sin Calificar', 0, 19, 4, 1),
(13, 'No Entregado', 'Sin Calificar', 0, 21, 3, 1),
(14, 'No Entregado', 'Sin Calificar', 0, 21, 4, 1),
(15, 'No Entregado', 'Sin Calificar', 0, 22, 3, 1),
(16, 'No Entregado', 'Sin Calificar', 0, 22, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_alumno`
--

DROP TABLE IF EXISTS `detalle_alumno`;
CREATE TABLE IF NOT EXISTS `detalle_alumno` (
  `idDetalle_Alumno` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo_Estudiantil` varchar(32) NOT NULL,
  `FK_Usuario` int(11) NOT NULL,
  `FK_Grado` int(11) NOT NULL,
  `FK_Nivel_Estudiantil` int(11) NOT NULL,
  PRIMARY KEY (`idDetalle_Alumno`),
  KEY `FK_DetalleAlumnos_Usuarios` (`FK_Usuario`),
  KEY `FK_DetalleAlumnos_Grados` (`FK_Grado`),
  KEY `FK_DetalleAlumnos_NivelEst` (`FK_Nivel_Estudiantil`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detalle_alumno`
--

INSERT INTO `detalle_alumno` (`idDetalle_Alumno`, `Codigo_Estudiantil`, `FK_Usuario`, `FK_Grado`, `FK_Nivel_Estudiantil`) VALUES
(1, '151TB', 4, 2, 3),
(2, '150TB', 3, 2, 3),
(3, 'No Aplicable', 2, 1, 1),
(4, 'No Aplicable', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_sesiones`
--

DROP TABLE IF EXISTS `detalle_sesiones`;
CREATE TABLE IF NOT EXISTS `detalle_sesiones` (
  `idSesion` int(11) NOT NULL AUTO_INCREMENT,
  `Inicio_Sesion` datetime NOT NULL,
  `Cierre_Sesion` datetime DEFAULT NULL,
  `Estado_Ses` set('Activa','Inactiva') NOT NULL,
  `FK_Usuario` int(11) NOT NULL,
  PRIMARY KEY (`idSesion`),
  KEY `FK_Ticket_Usuario` (`FK_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=321 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detalle_sesiones`
--

INSERT INTO `detalle_sesiones` (`idSesion`, `Inicio_Sesion`, `Cierre_Sesion`, `Estado_Ses`, `FK_Usuario`) VALUES
(1, '2020-07-10 15:48:43', '2020-07-10 15:54:27', 'Inactiva', 3),
(2, '2020-07-10 15:54:33', '2020-07-10 15:54:41', 'Inactiva', 1),
(3, '2020-07-10 19:35:57', '2020-07-10 19:36:43', 'Inactiva', 1),
(4, '2020-07-10 19:36:49', '2020-07-10 19:37:31', 'Inactiva', 2),
(5, '2020-07-10 19:37:37', '2020-07-10 19:51:49', 'Inactiva', 3),
(6, '2020-07-10 19:55:40', '2020-07-10 20:02:22', 'Inactiva', 2),
(7, '2020-07-10 20:02:30', '2020-07-10 20:02:34', 'Inactiva', 1),
(8, '2020-07-10 20:03:54', '2020-07-10 20:06:22', 'Inactiva', 1),
(9, '2020-07-10 20:15:14', '2020-07-10 20:16:36', 'Inactiva', 3),
(10, '2020-07-10 20:16:40', '2020-07-10 20:36:13', 'Inactiva', 2),
(11, '2020-07-10 20:36:19', '2020-07-10 20:36:32', 'Inactiva', 1),
(12, '2020-07-10 21:07:18', '2020-07-10 21:11:27', 'Inactiva', 2),
(13, '2020-07-10 21:11:31', '2020-07-10 21:29:10', 'Inactiva', 3),
(14, '2020-07-10 21:29:16', '2020-07-10 21:30:12', 'Inactiva', 2),
(15, '2020-07-10 21:30:19', '2020-07-10 21:43:47', 'Inactiva', 3),
(16, '2020-07-10 21:43:51', NULL, 'Activa', 3),
(17, '2020-07-10 21:44:37', '2020-07-10 21:44:58', 'Inactiva', 2),
(18, '2020-07-10 21:47:56', NULL, 'Activa', 3),
(19, '2020-07-10 21:48:54', '2020-07-10 21:56:48', 'Inactiva', 2),
(20, '2020-07-10 21:56:55', '2020-07-10 22:14:23', 'Inactiva', 3),
(21, '2020-07-11 12:18:34', '2020-07-11 12:19:10', 'Inactiva', 3),
(22, '2020-07-11 12:28:28', '2020-07-11 13:01:47', 'Inactiva', 2),
(23, '2020-07-11 13:01:51', NULL, 'Activa', 2),
(24, '2020-07-12 15:20:33', '2020-07-12 21:13:06', 'Inactiva', 2),
(25, '2020-07-12 21:13:11', NULL, 'Activa', 3),
(26, '2020-07-12 21:14:49', '2020-07-12 21:47:55', 'Inactiva', 2),
(27, '2020-07-13 13:57:51', '2020-07-13 13:58:01', 'Inactiva', 1),
(28, '2020-07-13 14:02:09', '2020-07-13 15:16:30', 'Inactiva', 2),
(29, '2020-07-13 15:16:35', '2020-07-13 15:22:30', 'Inactiva', 1),
(30, '2020-07-13 15:22:47', '2020-07-13 15:23:28', 'Inactiva', 1),
(31, '2020-07-13 15:23:45', '2020-07-13 20:18:12', 'Inactiva', 1),
(32, '2020-07-13 20:25:40', '2020-07-13 21:04:25', 'Inactiva', 1),
(33, '2020-07-13 21:04:30', '2020-07-13 21:04:47', 'Inactiva', 3),
(34, '2020-07-13 21:04:52', '2020-07-13 21:04:59', 'Inactiva', 2),
(35, '2020-07-13 21:05:04', '2020-07-13 22:42:20', 'Inactiva', 1),
(36, '2020-07-14 17:12:01', NULL, 'Activa', 1),
(37, '2020-07-14 20:08:31', '2020-07-14 20:46:12', 'Inactiva', 1),
(38, '2020-07-14 20:46:26', '2020-07-14 20:47:05', 'Inactiva', 2),
(39, '2020-07-14 20:47:09', '2020-07-14 20:52:49', 'Inactiva', 1),
(40, '2020-07-14 20:52:54', '2020-07-14 20:53:03', 'Inactiva', 2),
(41, '2020-07-14 20:53:07', '2020-07-14 20:55:40', 'Inactiva', 1),
(42, '2020-07-14 20:55:44', '2020-07-14 20:58:13', 'Inactiva', 2),
(43, '2020-07-14 20:58:18', '2020-07-14 21:05:50', 'Inactiva', 3),
(44, '2020-07-14 21:05:55', '2020-07-14 21:21:18', 'Inactiva', 3),
(45, '2020-07-14 21:25:02', '2020-07-14 21:58:59', 'Inactiva', 1),
(46, '2020-07-14 21:59:05', '2020-07-14 22:37:25', 'Inactiva', 1),
(47, '2020-07-15 09:45:03', '2020-07-15 09:45:19', 'Inactiva', 3),
(48, '2020-07-15 09:45:26', '2020-07-15 09:46:19', 'Inactiva', 2),
(49, '2020-07-15 09:46:25', '2020-07-15 09:46:51', 'Inactiva', 3),
(50, '2020-07-15 09:46:59', '2020-07-15 09:47:25', 'Inactiva', 2),
(51, '2020-07-15 09:47:31', '2020-07-15 09:48:19', 'Inactiva', 3),
(52, '2020-07-15 09:48:27', '2020-07-15 10:04:10', 'Inactiva', 2),
(53, '2020-07-15 10:04:14', NULL, 'Activa', 3),
(54, '2020-07-15 10:04:58', '2020-07-15 10:05:24', 'Inactiva', 2),
(55, '2020-07-15 10:05:30', NULL, 'Activa', 3),
(56, '2020-07-15 10:07:04', NULL, 'Activa', 3),
(57, '2020-07-15 10:14:57', '2020-07-15 10:15:20', 'Inactiva', 3),
(58, '2020-07-15 10:19:05', '2020-07-15 10:19:34', 'Inactiva', 2),
(59, '2020-07-15 10:20:25', '2020-07-15 10:20:32', 'Inactiva', 1),
(60, '2020-07-15 10:21:11', '2020-07-15 10:21:14', 'Inactiva', 1),
(61, '2020-07-15 10:21:19', '2020-07-15 10:22:00', 'Inactiva', 1),
(62, '2020-07-15 10:22:13', '2020-07-15 10:23:06', 'Inactiva', 1),
(63, '2020-07-15 10:23:53', '2020-07-15 10:32:17', 'Inactiva', 2),
(64, '2020-07-15 10:32:21', '2020-07-15 10:35:19', 'Inactiva', 2),
(65, '2020-07-15 10:35:24', '2020-07-15 10:35:42', 'Inactiva', 2),
(66, '2020-07-15 10:35:47', '2020-07-15 10:48:03', 'Inactiva', 2),
(67, '2020-07-15 10:48:07', '2020-07-15 11:44:39', 'Inactiva', 3),
(68, '2020-07-15 20:11:55', '2020-07-15 20:14:20', 'Inactiva', 2),
(69, '2020-07-15 20:14:34', '2020-07-15 20:14:37', 'Inactiva', 2),
(70, '2020-07-21 18:57:24', '2020-07-21 18:57:41', 'Inactiva', 3),
(71, '2020-07-21 18:57:45', '2020-07-21 18:58:41', 'Inactiva', 2),
(72, '2020-07-21 19:02:15', '2020-07-21 19:02:19', 'Inactiva', 1),
(73, '2020-07-21 19:04:53', '2020-07-21 19:07:20', 'Inactiva', 2),
(74, '2020-07-22 19:40:41', '2020-07-22 19:40:43', 'Inactiva', 2),
(75, '2020-07-22 19:41:02', '2020-07-22 19:41:03', 'Inactiva', 2),
(76, '2020-07-22 20:02:02', '2020-07-22 20:02:11', 'Inactiva', 1),
(77, '2020-07-22 20:02:30', '2020-07-22 20:04:13', 'Inactiva', 2),
(78, '2020-07-23 11:01:42', '2020-07-23 11:03:03', 'Inactiva', 2),
(79, '2020-07-23 11:16:33', '2020-07-23 11:18:55', 'Inactiva', 2),
(80, '2020-07-23 13:50:45', '2020-07-23 13:51:17', 'Inactiva', 2),
(81, '2020-07-23 17:24:22', '2020-07-23 17:25:02', 'Inactiva', 2),
(82, '2020-07-23 22:57:46', '2020-07-23 22:58:10', 'Inactiva', 1),
(83, '2020-07-23 22:58:15', '2020-07-23 22:58:37', 'Inactiva', 3),
(84, '2020-07-23 22:58:42', '2020-07-23 22:59:06', 'Inactiva', 2),
(85, '2020-07-23 22:59:11', '2020-07-23 23:09:25', 'Inactiva', 1),
(86, '2020-07-23 23:09:31', '2020-07-23 23:11:13', 'Inactiva', 2),
(87, '2020-07-23 23:11:18', '2020-07-23 23:12:34', 'Inactiva', 2),
(88, '2020-07-23 23:12:45', '2020-07-23 23:16:36', 'Inactiva', 3),
(89, '2020-07-23 23:16:43', '2020-07-23 23:19:57', 'Inactiva', 2),
(90, '2020-07-23 23:20:01', '2020-07-23 23:21:19', 'Inactiva', 3),
(91, '2020-08-06 22:31:44', '2020-08-06 22:31:49', 'Inactiva', 1),
(92, '2020-08-06 22:33:23', '2020-08-06 22:33:39', 'Inactiva', 2),
(93, '2020-08-06 22:38:44', '2020-08-06 22:39:10', 'Inactiva', 2),
(94, '2020-08-06 22:39:17', '2020-08-06 22:39:58', 'Inactiva', 3),
(95, '2020-08-06 22:40:06', '2020-08-06 22:43:02', 'Inactiva', 1),
(96, '2020-08-06 22:43:10', '2020-08-06 22:43:19', 'Inactiva', 2),
(97, '2020-08-06 22:43:40', '2020-08-06 22:43:46', 'Inactiva', 1),
(98, '2020-08-06 22:44:01', '2020-08-06 22:44:13', 'Inactiva', 1),
(99, '2020-08-06 22:44:57', '2020-08-06 22:45:49', 'Inactiva', 1),
(100, '2020-08-15 19:50:15', NULL, 'Activa', 1),
(101, '2020-08-20 00:12:55', '2020-08-20 00:13:23', 'Inactiva', 2),
(102, '2020-08-20 00:14:09', '2020-08-20 00:14:42', 'Inactiva', 2),
(103, '2020-08-20 00:14:46', '2020-08-20 00:14:59', 'Inactiva', 1),
(104, '2020-08-20 00:25:57', '2020-08-20 00:27:35', 'Inactiva', 2),
(105, '2020-08-20 00:32:53', '2020-08-20 00:34:04', 'Inactiva', 2),
(106, '2020-08-20 00:35:55', '2020-08-20 00:36:11', 'Inactiva', 3),
(107, '2020-08-20 00:38:51', '2020-08-20 00:43:20', 'Inactiva', 1),
(108, '2020-08-20 00:43:28', '2020-08-20 00:45:19', 'Inactiva', 2),
(109, '2020-08-20 00:50:31', '2020-08-20 00:51:50', 'Inactiva', 2),
(110, '2020-08-20 00:51:57', '2020-08-20 01:39:44', 'Inactiva', 1),
(111, '2020-08-20 01:39:49', '2020-08-20 01:39:51', 'Inactiva', 2),
(112, '2020-08-20 01:39:56', '2020-08-20 01:44:23', 'Inactiva', 1),
(113, '2020-08-20 01:44:30', '2020-08-20 01:45:29', 'Inactiva', 1),
(114, '2020-08-20 01:46:08', '2020-08-20 01:51:24', 'Inactiva', 1),
(115, '2020-08-20 01:51:34', '2020-08-20 01:54:05', 'Inactiva', 2),
(116, '2020-08-20 10:46:35', '2020-08-20 10:59:18', 'Inactiva', 2),
(117, '2020-08-20 10:59:23', '2020-08-20 11:06:41', 'Inactiva', 2),
(118, '2020-08-20 11:06:50', '2020-08-20 11:23:13', 'Inactiva', 2),
(119, '2020-08-20 11:23:20', '2020-08-20 11:30:28', 'Inactiva', 2),
(120, '2020-08-20 11:30:35', '2020-08-20 11:40:29', 'Inactiva', 2),
(121, '2020-08-20 11:44:05', '2020-08-20 11:49:31', 'Inactiva', 2),
(122, '2020-08-20 11:49:37', '2020-08-20 11:50:45', 'Inactiva', 1),
(123, '2020-08-20 11:50:50', '2020-08-20 11:58:15', 'Inactiva', 2),
(124, '2020-08-20 11:58:22', '2020-08-20 12:15:13', 'Inactiva', 3),
(125, '2020-08-20 12:15:23', '2020-08-20 12:16:01', 'Inactiva', 1),
(126, '2020-08-20 12:16:08', '2020-08-20 12:19:53', 'Inactiva', 1),
(127, '2020-08-20 12:19:57', '2020-08-20 12:32:23', 'Inactiva', 2),
(128, '2020-08-20 12:34:05', '2020-08-20 12:37:54', 'Inactiva', 1),
(129, '2020-08-20 12:38:22', '2020-08-20 13:15:47', 'Inactiva', 2),
(130, '2020-08-20 13:15:51', '2020-08-20 13:16:26', 'Inactiva', 3),
(131, '2020-08-20 13:16:34', '2020-08-20 13:17:04', 'Inactiva', 2),
(132, '2020-08-20 13:17:09', '2020-08-20 14:49:22', 'Inactiva', 1),
(133, '2020-08-20 14:49:32', '2020-08-20 15:19:04', 'Inactiva', 1),
(134, '2020-08-20 15:19:09', '2020-08-20 15:19:20', 'Inactiva', 2),
(135, '2020-08-20 15:19:25', '2020-08-20 16:06:09', 'Inactiva', 1),
(136, '2020-08-20 16:06:18', '2020-08-20 16:07:23', 'Inactiva', 2),
(137, '2020-08-20 16:07:28', '2020-08-20 16:58:20', 'Inactiva', 1),
(138, '2020-08-20 16:58:51', '2020-08-20 17:05:42', 'Inactiva', 2),
(139, '2020-08-20 17:06:45', '2020-08-20 17:24:10', 'Inactiva', 2),
(140, '2020-08-20 17:26:25', '2020-08-20 17:34:01', 'Inactiva', 2),
(141, '2020-08-20 17:34:06', '2020-08-20 17:43:01', 'Inactiva', 1),
(142, '2020-08-20 17:43:13', '2020-08-20 17:58:41', 'Inactiva', 1),
(143, '2020-08-20 17:58:58', '2020-08-20 17:59:11', 'Inactiva', 3),
(144, '2020-08-20 17:59:17', '2020-08-20 18:06:58', 'Inactiva', 1),
(145, '2020-08-20 18:07:35', '2020-08-20 18:21:16', 'Inactiva', 1),
(146, '2020-08-20 18:21:21', '2020-08-20 18:50:06', 'Inactiva', 2),
(147, '2020-08-20 18:58:03', '2020-08-20 18:59:39', 'Inactiva', 1),
(148, '2020-08-20 19:03:15', '2020-08-20 19:13:41', 'Inactiva', 1),
(149, '2020-08-20 19:13:50', '2020-08-20 19:14:46', 'Inactiva', 1),
(150, '2020-08-20 19:41:14', '2020-08-20 20:19:14', 'Inactiva', 1),
(151, '2020-08-20 20:31:16', '2020-08-20 20:38:52', 'Inactiva', 2),
(152, '2020-08-20 20:38:57', '2020-08-20 20:42:36', 'Inactiva', 1),
(153, '2020-08-20 20:42:47', '2020-08-20 20:56:57', 'Inactiva', 1),
(154, '2020-08-20 20:57:30', '2020-08-20 21:27:57', 'Inactiva', 2),
(155, '2020-08-20 21:34:00', '2020-08-20 21:35:03', 'Inactiva', 2),
(156, '2020-08-20 22:14:11', '2020-08-20 22:14:17', 'Inactiva', 2),
(157, '2020-08-20 23:06:55', '2020-08-20 23:07:35', 'Inactiva', 2),
(158, '2020-08-20 23:07:42', '2020-08-20 23:09:47', 'Inactiva', 1),
(159, '2020-08-20 23:10:53', '2020-08-20 23:11:13', 'Inactiva', 2),
(160, '2020-08-21 10:04:06', '2020-08-21 10:04:16', 'Inactiva', 2),
(161, '2020-08-21 10:05:48', '2020-08-21 10:06:24', 'Inactiva', 1),
(162, '2020-08-21 10:07:04', '2020-08-21 11:46:31', 'Inactiva', 1),
(163, '2020-08-21 11:46:38', '2020-08-21 12:03:47', 'Inactiva', 2),
(164, '2020-08-21 12:03:51', '2020-08-21 12:04:19', 'Inactiva', 1),
(165, '2020-08-21 12:04:23', '2020-08-21 12:05:46', 'Inactiva', 3),
(166, '2020-08-21 12:05:50', '2020-08-21 12:37:37', 'Inactiva', 2),
(167, '2020-08-21 12:37:43', '2020-08-21 14:03:59', 'Inactiva', 1),
(168, '2020-08-21 14:04:05', '2020-08-21 14:12:28', 'Inactiva', 1),
(169, '2020-08-21 14:12:32', '2020-08-21 14:25:15', 'Inactiva', 2),
(170, '2020-08-21 14:25:19', '2020-08-21 14:25:30', 'Inactiva', 3),
(171, '2020-08-21 14:25:36', '2020-08-21 14:31:28', 'Inactiva', 2),
(172, '2020-08-21 14:31:44', '2020-08-21 14:52:52', 'Inactiva', 2),
(173, '2020-08-21 14:52:56', '2020-08-21 14:56:30', 'Inactiva', 1),
(174, '2020-08-21 14:56:35', '2020-08-21 14:57:29', 'Inactiva', 1),
(175, '2020-08-21 14:57:32', '2020-08-21 14:57:40', 'Inactiva', 2),
(176, '2020-08-21 14:57:48', '2020-08-21 14:57:58', 'Inactiva', 3),
(177, '2020-08-21 14:58:02', '2020-08-21 14:58:32', 'Inactiva', 1),
(178, '2020-08-21 14:58:36', '2020-08-21 15:01:28', 'Inactiva', 2),
(179, '2020-08-21 15:01:33', '2020-08-21 15:02:14', 'Inactiva', 3),
(180, '2020-08-21 15:02:23', '2020-08-21 16:02:13', 'Inactiva', 1),
(181, '2020-08-21 16:02:17', '2020-08-21 16:02:38', 'Inactiva', 2),
(182, '2020-08-21 16:02:42', '2020-08-21 16:03:06', 'Inactiva', 1),
(183, '2020-08-21 19:51:52', '2020-08-21 19:55:13', 'Inactiva', 1),
(184, '2020-08-21 19:55:17', '2020-08-21 19:55:36', 'Inactiva', 3),
(185, '2020-08-21 19:55:41', '2020-08-21 19:55:53', 'Inactiva', 1),
(186, '2020-08-21 19:56:00', '2020-08-21 19:57:34', 'Inactiva', 3),
(187, '2020-08-21 19:57:41', NULL, 'Activa', 3),
(188, '2020-08-21 20:01:06', '2020-08-21 22:49:57', 'Inactiva', 1),
(189, '2020-08-21 22:50:03', '2020-08-21 23:01:41', 'Inactiva', 1),
(190, '2020-08-21 23:01:46', '2020-08-21 23:21:55', 'Inactiva', 1),
(191, '2020-08-21 23:22:00', '2020-08-21 23:22:17', 'Inactiva', 2),
(192, '2020-08-21 23:22:21', NULL, 'Activa', 1),
(193, '2020-08-22 13:14:42', NULL, 'Activa', 1),
(194, '2020-08-22 14:38:29', '2020-08-22 14:39:04', 'Inactiva', 2),
(195, '2020-08-22 14:39:10', '2020-08-22 14:39:39', 'Inactiva', 3),
(196, '2020-08-22 15:07:14', '2020-08-22 16:36:51', 'Inactiva', 1),
(197, '2020-08-22 16:36:56', '2020-08-22 16:55:17', 'Inactiva', 2),
(198, '2020-08-22 16:55:20', '2020-08-22 17:05:39', 'Inactiva', 1),
(199, '2020-08-22 17:05:44', '2020-08-22 17:06:04', 'Inactiva', 3),
(200, '2020-08-22 17:06:08', '2020-08-22 18:09:04', 'Inactiva', 1),
(201, '2020-08-22 18:12:38', '2020-08-22 18:12:58', 'Inactiva', 2),
(202, '2020-08-22 18:31:36', '2020-08-22 18:40:55', 'Inactiva', 1),
(203, '2020-08-22 18:40:59', '2020-08-22 18:41:08', 'Inactiva', 3),
(204, '2020-08-22 18:41:13', '2020-08-22 18:41:27', 'Inactiva', 2),
(205, '2020-08-22 18:41:31', '2020-08-22 19:01:45', 'Inactiva', 1),
(206, '2020-08-22 19:05:45', '2020-08-22 19:08:23', 'Inactiva', 1),
(207, '2020-08-22 19:08:27', '2020-08-22 19:08:41', 'Inactiva', 2),
(208, '2020-08-22 19:08:45', '2020-08-22 19:12:05', 'Inactiva', 3),
(209, '2020-08-22 19:12:08', '2020-08-22 19:15:30', 'Inactiva', 1),
(210, '2020-08-22 19:15:34', '2020-08-22 19:18:34', 'Inactiva', 3),
(211, '2020-08-22 19:18:37', '2020-08-22 19:20:54', 'Inactiva', 1),
(212, '2020-08-22 19:23:01', '2020-08-22 19:23:02', 'Inactiva', 1),
(213, '2020-08-22 19:24:49', '2020-08-22 19:26:17', 'Inactiva', 1),
(214, '2020-08-22 19:26:21', '2020-08-22 19:29:37', 'Inactiva', 3),
(215, '2020-08-22 19:29:45', '2020-08-22 19:31:22', 'Inactiva', 2),
(216, '2020-08-22 19:31:25', '2020-08-22 19:34:06', 'Inactiva', 1),
(217, '2020-08-22 19:34:09', '2020-08-22 19:34:18', 'Inactiva', 1),
(218, '2020-08-22 19:34:22', '2020-08-22 20:07:31', 'Inactiva', 3),
(219, '2020-08-22 20:07:34', NULL, 'Activa', 3),
(220, '2020-08-22 20:08:33', '2020-08-22 20:11:44', 'Inactiva', 1),
(221, '2020-08-22 20:11:48', '2020-08-22 20:12:01', 'Inactiva', 2),
(222, '2020-08-22 20:54:56', '2020-08-22 21:05:34', 'Inactiva', 1),
(223, '2020-08-22 21:05:40', '2020-08-22 21:06:04', 'Inactiva', 2),
(224, '2020-08-22 21:07:06', '2020-08-22 21:07:28', 'Inactiva', 3),
(225, '2020-08-22 21:07:34', NULL, 'Activa', 3),
(226, '2020-08-22 21:12:29', '2020-08-22 21:12:51', 'Inactiva', 1),
(227, '2020-08-22 21:13:30', '2020-08-22 21:18:06', 'Inactiva', 1),
(228, '2020-08-24 15:31:05', '2020-08-24 15:46:24', 'Inactiva', 1),
(229, '2020-08-24 15:53:39', '2020-08-24 16:13:04', 'Inactiva', 1),
(230, '2020-08-24 19:49:11', '2020-08-24 19:50:28', 'Inactiva', 1),
(231, '2020-08-24 19:57:48', '2020-08-24 20:16:57', 'Inactiva', 1),
(232, '2020-08-24 20:27:38', '2020-08-24 20:27:59', 'Inactiva', 1),
(233, '2020-08-24 20:35:15', '2020-08-24 20:36:52', 'Inactiva', 1),
(234, '2020-08-24 20:37:53', '2020-08-24 20:38:19', 'Inactiva', 1),
(235, '2020-08-24 20:39:38', '2020-08-24 20:44:17', 'Inactiva', 1),
(236, '2020-08-24 20:50:34', '2020-08-24 20:50:35', 'Inactiva', 1),
(237, '2020-08-24 21:13:25', '2020-08-24 21:15:01', 'Inactiva', 1),
(238, '2020-08-24 21:15:17', '2020-08-24 23:32:58', 'Inactiva', 1),
(239, '2020-08-25 10:09:25', '2020-08-25 10:09:40', 'Inactiva', 1),
(240, '2020-08-25 10:23:51', '2020-08-25 10:33:37', 'Inactiva', 1),
(241, '2020-08-25 10:36:38', '2020-08-25 10:36:41', 'Inactiva', 2),
(242, '2020-08-25 10:37:54', '2020-08-25 11:05:51', 'Inactiva', 1),
(243, '2020-08-25 11:15:49', '2020-08-25 11:19:43', 'Inactiva', 3),
(244, '2020-08-25 11:19:47', '2020-08-25 11:19:54', 'Inactiva', 1),
(245, '2020-08-25 11:35:36', '2020-08-25 11:35:45', 'Inactiva', 1),
(246, '2020-08-25 11:36:00', '2020-08-25 13:07:04', 'Inactiva', 3),
(247, '2020-08-25 13:07:12', '2020-08-25 17:46:55', 'Inactiva', 1),
(248, '2020-08-25 17:49:24', '2020-08-25 19:12:45', 'Inactiva', 1),
(249, '2020-08-25 20:19:29', '2020-08-26 09:12:26', 'Inactiva', 1),
(250, '2020-08-26 09:12:31', '2020-08-26 09:25:41', 'Inactiva', 2),
(251, '2020-08-26 09:25:46', '2020-08-26 09:55:04', 'Inactiva', 3),
(252, '2020-08-26 09:55:09', '2020-08-26 09:59:35', 'Inactiva', 2),
(253, '2020-08-26 09:59:41', '2020-08-26 10:01:37', 'Inactiva', 3),
(254, '2020-08-26 10:01:42', '2020-08-26 10:03:47', 'Inactiva', 2),
(255, '2020-08-26 10:03:51', '2020-08-26 10:05:37', 'Inactiva', 3),
(256, '2020-08-26 10:05:45', NULL, 'Activa', 3),
(257, '2020-08-26 10:41:29', '2020-08-26 10:41:34', 'Inactiva', 2),
(258, '2020-08-26 10:41:39', '2020-08-26 10:41:46', 'Inactiva', 1),
(259, '2020-08-26 10:41:51', NULL, 'Activa', 3),
(260, '2020-08-26 11:24:26', '2020-08-26 11:24:41', 'Inactiva', 1),
(261, '2020-08-26 11:26:37', '2020-08-26 12:03:55', 'Inactiva', 1),
(262, '2020-08-26 12:04:01', '2020-08-26 12:05:05', 'Inactiva', 3),
(263, '2020-08-26 12:05:25', '2020-08-26 12:05:48', 'Inactiva', 3),
(264, '2020-08-26 12:06:12', '2020-08-26 12:06:30', 'Inactiva', 3),
(265, '2020-08-26 12:07:55', '2020-08-26 12:09:52', 'Inactiva', 1),
(266, '2020-08-26 12:11:46', '2020-08-26 12:12:33', 'Inactiva', 3),
(267, '2020-08-26 12:13:14', NULL, 'Activa', 3),
(268, '2020-08-26 12:21:07', '2020-08-26 12:30:47', 'Inactiva', 1),
(269, '2020-08-26 12:31:19', '2020-08-26 12:34:52', 'Inactiva', 3),
(270, '2020-08-26 12:34:57', NULL, 'Activa', 3),
(271, '2020-08-26 12:36:11', '2020-08-26 12:40:11', 'Inactiva', 2),
(272, '2020-08-26 12:42:28', '2020-08-26 12:43:58', 'Inactiva', 1),
(273, '2020-08-26 16:33:17', '2020-08-26 18:02:36', 'Inactiva', 1),
(274, '2020-08-26 18:25:11', '2020-08-26 20:17:16', 'Inactiva', 3),
(275, '2020-08-26 20:56:54', '2020-08-26 20:57:05', 'Inactiva', 1),
(276, '2020-08-26 23:55:49', '2020-08-26 23:55:58', 'Inactiva', 1),
(277, '2020-08-26 23:56:05', '2020-08-27 00:13:06', 'Inactiva', 3),
(278, '2020-08-27 11:40:41', '2020-08-27 12:10:57', 'Inactiva', 1),
(279, '2020-08-27 12:49:36', '2020-08-27 12:57:49', 'Inactiva', 1),
(280, '2020-08-27 13:03:02', '2020-08-27 13:03:44', 'Inactiva', 1),
(281, '2020-08-27 13:06:49', '2020-08-27 13:07:09', 'Inactiva', 1),
(282, '2020-08-27 13:07:58', NULL, 'Activa', 3),
(283, '2020-08-27 13:12:14', '2020-08-27 14:28:20', 'Inactiva', 3),
(284, '2020-08-27 14:19:16', '2020-08-27 14:19:28', 'Inactiva', 1),
(285, '2020-08-27 14:36:45', NULL, 'Activa', 1),
(286, '2020-08-27 14:48:20', '2020-08-27 14:49:08', 'Inactiva', 1),
(287, '2020-08-27 15:35:46', NULL, 'Activa', 1),
(288, '2020-08-27 15:42:41', NULL, 'Activa', 1),
(289, '2020-08-27 15:46:27', '2020-08-27 15:57:39', 'Inactiva', 1),
(290, '2020-08-27 15:47:11', '2020-08-27 15:48:18', 'Inactiva', 3),
(291, '2020-08-27 15:59:48', '2020-08-27 16:02:09', 'Inactiva', 1),
(292, '2020-08-27 16:08:43', '2020-08-27 19:33:27', 'Inactiva', 1),
(293, '2020-08-27 19:33:31', '2020-08-27 19:35:50', 'Inactiva', 3),
(294, '2020-08-27 19:37:48', '2020-08-27 21:05:40', 'Inactiva', 1),
(295, '2020-08-27 21:06:02', '2020-08-27 21:06:04', 'Inactiva', 1),
(296, '2020-08-27 21:21:36', '2020-08-27 21:23:10', 'Inactiva', 1),
(297, '2020-08-27 22:29:50', NULL, 'Activa', 3),
(298, '2020-08-27 22:56:49', '2020-08-27 22:56:57', 'Inactiva', 1),
(299, '2020-08-27 23:14:13', '2020-08-27 23:14:14', 'Inactiva', 1),
(300, '2020-08-28 09:52:57', '2020-08-28 10:25:50', 'Inactiva', 1),
(301, '2020-08-28 10:25:55', '2020-08-28 11:45:11', 'Inactiva', 3),
(302, '2020-08-28 11:45:15', '2020-08-28 11:49:36', 'Inactiva', 2),
(303, '2020-08-28 11:49:41', '2020-08-28 11:50:16', 'Inactiva', 3),
(304, '2020-08-28 11:50:20', '2020-08-28 11:52:48', 'Inactiva', 2),
(305, '2020-08-28 11:52:52', NULL, 'Activa', 3),
(306, '2020-08-28 14:28:54', '2020-08-28 14:29:15', 'Inactiva', 1),
(307, '2020-08-28 14:33:28', '2020-08-28 14:33:35', 'Inactiva', 1),
(308, '2020-08-28 14:33:49', '2020-08-28 14:33:52', 'Inactiva', 1),
(309, '2020-08-28 14:33:56', '2020-08-28 15:58:31', 'Inactiva', 3),
(310, '2020-08-28 16:47:37', '2020-08-28 17:20:09', 'Inactiva', 3),
(311, '2020-08-28 17:20:21', '2020-08-28 17:20:47', 'Inactiva', 3),
(312, '2020-08-28 17:20:51', '2020-08-28 17:22:04', 'Inactiva', 3),
(313, '2020-08-28 17:22:27', '2020-08-28 17:35:41', 'Inactiva', 3),
(314, '2020-08-28 17:38:11', '2020-08-28 19:08:00', 'Inactiva', 3),
(315, '2020-08-31 20:03:50', '2020-08-31 20:03:59', 'Inactiva', 1),
(316, '2020-08-31 20:20:12', '2020-08-31 20:20:36', 'Inactiva', 1),
(317, '2020-08-31 20:25:16', '2020-08-31 20:25:26', 'Inactiva', 1),
(318, '2020-08-31 20:34:03', '2020-08-31 20:34:14', 'Inactiva', 3),
(319, '2020-08-31 20:37:59', '2020-08-31 20:38:07', 'Inactiva', 1),
(320, '2020-08-31 20:38:12', '2020-08-31 20:38:28', 'Inactiva', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

DROP TABLE IF EXISTS `grados`;
CREATE TABLE IF NOT EXISTS `grados` (
  `idGrado` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo_Grado` varchar(32) NOT NULL,
  `NombreGrado` varchar(64) NOT NULL,
  `Descripcion` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Seccion` varchar(8) NOT NULL,
  `FK_Jornada` int(11) NOT NULL,
  PRIMARY KEY (`idGrado`),
  KEY `FK_Grado_Jornada` (`FK_Jornada`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`idGrado`, `Codigo_Grado`, `NombreGrado`, `Descripcion`, `Seccion`, `FK_Jornada`) VALUES
(1, 'No Aplicable', 'No Aplicable', 'Este es el grado que se le aplica en la llave foranea a profesores o todo tipo de usuario que no sea estudiante', 'No Aplic', 1),
(2, 'TB-001', 'Tercero Basico', 'Tercer Grado de Educación Básica', 'A', 2),
(3, 'SB-001', 'Segundo Basico', 'Segundo Grado de Educacion Basica', 'B', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada`
--

DROP TABLE IF EXISTS `jornada`;
CREATE TABLE IF NOT EXISTS `jornada` (
  `idJornada` int(11) NOT NULL AUTO_INCREMENT,
  `Jornada` varchar(32) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`idJornada`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `jornada`
--

INSERT INTO `jornada` (`idJornada`, `Jornada`, `Descripcion`) VALUES
(1, 'No Aplicable', 'Registro para grados no aplicables.'),
(2, 'Matutina', 'Jornada Estudiantil de la mañana.'),
(3, 'Vespertina', 'Jornada Estudiantil de la tarde.'),
(4, 'Nocturna', 'Jornada estudiantil de la noche.'),
(5, '(Matutina) Fin De Semana', 'Jornada Estudiantil de la mañana del fin de semana.'),
(6, '(Vespertina) Fin De Semana', 'Jornada Estudiantil de la tarde del fin de semana.'),
(7, '(Nocturna) Fin De Semana', 'Jornada Estudiantil de la Noche del fin de semana.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_estudiantil`
--

DROP TABLE IF EXISTS `nivel_estudiantil`;
CREATE TABLE IF NOT EXISTS `nivel_estudiantil` (
  `idNivelEstudiantil` int(11) NOT NULL AUTO_INCREMENT,
  `Nivel_Estudiantil` varchar(64) NOT NULL,
  PRIMARY KEY (`idNivelEstudiantil`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `nivel_estudiantil`
--

INSERT INTO `nivel_estudiantil` (`idNivelEstudiantil`, `Nivel_Estudiantil`) VALUES
(1, 'No Aplicable'),
(2, 'Educación Primaria'),
(3, 'Educación Básica'),
(4, 'Educación Diversificada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(32) NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `Descripcion`) VALUES
(1, 'Administrador'),
(2, 'Catedratico'),
(3, 'Estudiante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `User` varchar(32) NOT NULL,
  `Pass` varchar(256) NOT NULL,
  `Name_User` varchar(256) NOT NULL,
  `Genero` set('Masculino','Femenino') NOT NULL,
  `Email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Estado` set('Activo','Inactivo') NOT NULL,
  `FK_Rol` int(11) DEFAULT NULL,
  `FK_DetalleAlumno` int(11) NOT NULL,
  `FK_Grado` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `FK_Rol_Users` (`FK_Rol`),
  KEY `FK_Users_DetalleAlumno` (`FK_DetalleAlumno`),
  KEY `FK_Users_Grado` (`FK_Grado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `User`, `Pass`, `Name_User`, `Genero`, `Email`, `Estado`, `FK_Rol`, `FK_DetalleAlumno`, `FK_Grado`) VALUES
(1, 'admin', '08aa2cee8a7c60a785ec95ac1f40ac74911e60e6917c49da5f2ae21b6f55d49cf057d0ab09eb1b89713c6f1c8aef92783628fe35caeedb5b073edf1970aea855', 'Mario Enrique Carbajal Lopez', 'Masculino', 'marencarlo2112@gmail.com', 'Activo', 1, 4, 1),
(2, 'Profesor', '08aa2cee8a7c60a785ec95ac1f40ac74911e60e6917c49da5f2ae21b6f55d49cf057d0ab09eb1b89713c6f1c8aef92783628fe35caeedb5b073edf1970aea855', 'Dominick Toretto', 'Masculino', 'sebant4@gmail.com', 'Activo', 2, 3, 1),
(3, 'Alumno1', '08aa2cee8a7c60a785ec95ac1f40ac74911e60e6917c49da5f2ae21b6f55d49cf057d0ab09eb1b89713c6f1c8aef92783628fe35caeedb5b073edf1970aea855', 'Carlos Carbajal', 'Masculino', 'carlos22@gmail.com', 'Activo', 3, 2, 2),
(4, 'Alumno2', '08aa2cee8a7c60a785ec95ac1f40ac74911e60e6917c49da5f2ae21b6f55d49cf057d0ab09eb1b89713c6f1c8aef92783628fe35caeedb5b073edf1970aea855', 'Felipe Gonzales', 'Masculino', 'FelGon@gmail.com', 'Activo', 3, 1, 2);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `FK_Actividad_Curso` FOREIGN KEY (`FK_Curso`) REFERENCES `cursos` (`idCurso`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Actividad_Grado` FOREIGN KEY (`FK_Grado`) REFERENCES `grados` (`idGrado`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `archivos_contenidos`
--
ALTER TABLE `archivos_contenidos`
  ADD CONSTRAINT `FK_Contenido_Cursos` FOREIGN KEY (`FK_Curso`) REFERENCES `cursos` (`idCurso`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Contenido_Usuarios` FOREIGN KEY (`FK_Usuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `archivos_tareas`
--
ALTER TABLE `archivos_tareas`
  ADD CONSTRAINT `FK_ArchivoT_Usuario` FOREIGN KEY (`FK_Usuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `FK_Curso_Catedratico` FOREIGN KEY (`FK_Catedratico`) REFERENCES `usuarios` (`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Grado_Catedratico` FOREIGN KEY (`FK_Grado`) REFERENCES `grados` (`idGrado`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `detalle_actividades`
--
ALTER TABLE `detalle_actividades`
  ADD CONSTRAINT `FK_DetalleActividades_Actividades` FOREIGN KEY (`FK_Actividad`) REFERENCES `actividades` (`idActividad`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_DetalleActividades_Archivos` FOREIGN KEY (`FK_Archivos`) REFERENCES `archivos_tareas` (`idArchivo`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_DetalleActividades_Usuarios` FOREIGN KEY (`FK_Usuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `detalle_alumno`
--
ALTER TABLE `detalle_alumno`
  ADD CONSTRAINT `FK_DetalleAlumnos_Grados` FOREIGN KEY (`FK_Grado`) REFERENCES `grados` (`idGrado`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_DetalleAlumnos_NivelEst` FOREIGN KEY (`FK_Nivel_Estudiantil`) REFERENCES `nivel_estudiantil` (`idNivelEstudiantil`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_DetalleAlumnos_Usuarios` FOREIGN KEY (`FK_Usuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `detalle_sesiones`
--
ALTER TABLE `detalle_sesiones`
  ADD CONSTRAINT `FK_Sesion_Usuario` FOREIGN KEY (`FK_Usuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `grados`
--
ALTER TABLE `grados`
  ADD CONSTRAINT `FK_Grado_Jornada` FOREIGN KEY (`FK_Jornada`) REFERENCES `jornada` (`idJornada`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_Users_DetalleAlumno` FOREIGN KEY (`FK_DetalleAlumno`) REFERENCES `detalle_alumno` (`idDetalle_Alumno`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Users_Grado` FOREIGN KEY (`FK_Grado`) REFERENCES `grados` (`idGrado`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Users_Rol` FOREIGN KEY (`FK_Rol`) REFERENCES `roles` (`idRol`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

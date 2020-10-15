-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 15-10-2020 a las 03:50:02
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.4.0

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
  `FK_Tipo_Calificacion` int(11) NOT NULL,
  PRIMARY KEY (`idActividad`),
  KEY `FK_Actividad_Curso` (`FK_Curso`),
  KEY `FK_Actividad_Grado` (`FK_Grado`),
  KEY `FK_Actividad_TipoCalificacion` (`FK_Tipo_Calificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`idActividad`, `NombreActividad`, `DescripcionActividad`, `Fecha_Entrega`, `FK_Curso`, `FK_Grado`, `FK_Tipo_Calificacion`) VALUES
(17, 'Que son los agujeros Negros?', 'Investigar que son los agujeros negros, minimo 10 paginas en Word, con comentario personal, sobre lo que a usted le llamo la atencion de este tema', '2020-09-28 23:59:00', 1, 2, 1),
(18, 'La Vida De Jesus', 'Resumen de 10 paginas sobre la vida y los milagros mas famosos de Jesucristo!', '2020-07-15 23:59:00', 2, 2, 1),
(19, 'Que es la fotosíntesis en las plantas?', 'Investigar sobre la fotosíntesis en un documento de Word y escribir un comentario personal de lo que opina usted sobre este tema. ', '2020-09-25 23:59:00', 1, 2, 1),
(21, 'La Via Lactea', 'Investigar que es la vía láctea y realizar un comentario personal de lo que usted piensa de la vía láctea.', '2020-09-25 23:59:00', 1, 2, 1),
(22, 'Que es la Mecanica Cuantica?', 'Investigacion sobre que es la mecanica cuantica en el universo', '2020-09-21 23:59:00', 5, 2, 1),
(24, 'Por que se forman los Huracanes?', 'Investigar los principales factores por los que se forman los Huracanes.', '2020-09-21 23:59:00', 1, 2, 2),
(25, 'Los 10 Mandamientos', 'Realizar un breve comentario personal sobre lo que significa para usted, cada mandamiento.', '2020-09-21 23:59:00', 2, 2, 1),
(26, 'Resumen: Don Quijote de la Mancha', 'Leer el libro del Quijote y luego realizar un resumen de 10 paginas de lo que usted interpreta de este libro.', '2020-10-12 23:59:00', 6, 3, 1),
(27, 'Quien fue Aurelio Baldor?', 'Realizar investigación de 10 paginas sobre la vida de Aurelio Baldor.', '2020-10-12 23:59:00', 4, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_contenidos`
--

DROP TABLE IF EXISTS `archivos_contenidos`;
CREATE TABLE IF NOT EXISTS `archivos_contenidos` (
  `idContenido` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Contenido` varchar(256) NOT NULL,
  `Ruta_Contenido` varchar(256) NOT NULL,
  `Tipo_Contenido` set('Archivo','URL') NOT NULL,
  `URL_Contenido` varchar(256) DEFAULT NULL,
  `Titulo_Contenido` varchar(128) DEFAULT NULL,
  `Descripcion_Contenido` varchar(1064) DEFAULT NULL,
  `FK_Curso` int(11) NOT NULL,
  `FK_Usuario` int(11) NOT NULL,
  PRIMARY KEY (`idContenido`),
  KEY `FK_Contenido_Cursos` (`FK_Curso`),
  KEY `FK_Contenido_Usuarios` (`FK_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `archivos_contenidos`
--

INSERT INTO `archivos_contenidos` (`idContenido`, `Nombre_Contenido`, `Ruta_Contenido`, `Tipo_Contenido`, `URL_Contenido`, `Titulo_Contenido`, `Descripcion_Contenido`, `FK_Curso`, `FK_Usuario`) VALUES
(8, 'Cuantica.pdf', 'C:/wamp64/www/cursalia/media/archivos_contenidos/', 'Archivo', NULL, 'Mecanica Cuantica I', 'Primer documento con contenido de apoyo para las respectivas tareas de investigación sobre Mecánica Cuántica. Es de suma importancia leerlo ya que ciertas partes vendrán en el examen de final de modulo.', 1, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `archivos_tareas`
--

INSERT INTO `archivos_tareas` (`idArchivo`, `NombreArchivo`, `RutaArchivo`, `FK_Usuario`) VALUES
(1, 'Sin Archivos', '#!', 1),
(6, 'MOOC.docx', 'C:/wamp64/www/cursalia/media/archivos_tareas/', 3),
(7, 'Palabras.docx', 'C:/wamp64/www/cursalia/media/archivos_tareas/', 3),
(8, 'Desarrollador de aplicaciones para la web con PHP - Instructivo del Candidato.pdf', 'C:/wamp64/www/cursalia/media/archivos_tareas/', 4),
(9, 'INSTRUMENTO DE EVALUACIÓN PHP.docx', 'C:/wamp64/www/cursalia/media/archivos_tareas/', 4),
(10, 'cursaliadb.pdf', 'C:/wamp64/www/cursalia/media/archivos_tareas/', 3),
(11, 'Ernesto Sábato - Sobre Heroes y Tumbas.pdf', 'C:/wamp64/www/cursalia/media/archivos_tareas/', 3),
(12, 'FUN_Coursera_ppt.pdf', 'C:/wamp64/www/cursalia/media/archivos_tareas/', 3),
(13, 'Business-model-canvas-1420x1065.pdf', 'C:/wamp64/www/cursalia/media/archivos_tareas/', 13),
(14, 'CO2009-0001.pdf', 'C:/wamp64/www/cursalia/media/archivos_tareas/', 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`idCurso`, `NombreCurso`, `Descripcion`, `FK_Catedratico`, `FK_Grado`) VALUES
(1, 'Ciencias Naturales', 'Materia que enseña los conocimientos básicos sobre ciencia a los Alumnos.', 2, 2),
(2, 'Religión', 'Materia que enseña los conocimientos basicos sobre Teologia a los alumnos.', 2, 2),
(4, 'Matematicas', 'Este Curso otorga los conocimientos basicos de Matematicas, En este curso se te otorgaran los conocimientos necesarios para aprobar esta materia tan importante correspondiente a tu grado.', 2, 2),
(5, 'Física Fundamental III ', 'Clase que enseña los conocimientos básicos de Física Fundamental a los alumnos de Tercero Básico.', 2, 2),
(6, 'Idioma Materno I ', 'Curso que brinda los conocimientos básicos de la gramática y ortografía Española', 12, 3);

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
  `FK_DetalleAlumno` int(11) NOT NULL,
  PRIMARY KEY (`idDetalleActividad`),
  KEY `FK_DetalleActividades_Actividades` (`FK_Actividad`),
  KEY `FK_DetalleActividades_Usuarios` (`FK_Usuario`),
  KEY `FK_DetalleActividades_Archivos` (`FK_Archivos`),
  KEY `FK_DetalleActividades_DetalleAlumno` (`FK_DetalleAlumno`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detalle_actividades`
--

INSERT INTO `detalle_actividades` (`idDetalleActividad`, `Estado_Entrega`, `Estado_Calificacion`, `Calificacion`, `FK_Actividad`, `FK_Usuario`, `FK_Archivos`, `FK_DetalleAlumno`) VALUES
(6, 'Entregado', 'Calificada', 75, 17, 3, 7, 2),
(7, 'Entregado', 'Calificada', 75, 17, 4, 9, 1),
(8, 'Entregado', 'Calificada', 46, 18, 3, 6, 2),
(10, 'Entregado', 'Calificada', 55, 18, 4, 8, 1),
(11, 'No Entregado', 'Sin Calificar', 0, 19, 3, 1, 2),
(12, 'No Entregado', 'Sin Calificar', 0, 19, 4, 1, 1),
(13, 'No Entregado', 'Sin Calificar', 0, 21, 3, 1, 2),
(14, 'No Entregado', 'Sin Calificar', 0, 21, 4, 1, 1),
(15, 'Entregado', 'Sin Calificar', 0, 22, 3, 12, 2),
(16, 'No Entregado', 'Sin Calificar', 0, 22, 4, 1, 1),
(17, 'Entregado', 'Calificada', 65, 24, 3, 10, 2),
(18, 'No Entregado', 'Sin Calificar', 0, 24, 4, 1, 1),
(19, 'No Entregado', 'Sin Calificar', 0, 24, 5, 1, 5),
(20, 'No Entregado', 'Sin Calificar', 0, 24, 6, 1, 6),
(21, 'No Entregado', 'Sin Calificar', 0, 24, 7, 1, 7),
(22, 'No Entregado', 'Sin Calificar', 0, 24, 8, 1, 8),
(23, 'No Entregado', 'Sin Calificar', 0, 24, 9, 1, 9),
(24, 'Entregado', 'Calificada', 75, 25, 3, 11, 2),
(25, 'No Entregado', 'Sin Calificar', 0, 25, 4, 1, 1),
(26, 'No Entregado', 'Sin Calificar', 0, 25, 5, 1, 5),
(27, 'No Entregado', 'Sin Calificar', 0, 25, 6, 1, 6),
(28, 'No Entregado', 'Sin Calificar', 0, 25, 7, 1, 7),
(29, 'No Entregado', 'Sin Calificar', 0, 25, 8, 1, 8),
(30, 'No Entregado', 'Sin Calificar', 0, 25, 9, 1, 9),
(31, 'Entregado', 'Sin Calificar', 0, 26, 13, 13, 12),
(32, 'Entregado', 'Sin Calificar', 0, 27, 3, 14, 2),
(33, 'No Entregado', 'Sin Calificar', 0, 27, 4, 1, 1),
(34, 'No Entregado', 'Sin Calificar', 0, 27, 5, 1, 5),
(35, 'No Entregado', 'Sin Calificar', 0, 27, 6, 1, 6),
(36, 'No Entregado', 'Sin Calificar', 0, 27, 7, 1, 7),
(37, 'No Entregado', 'Sin Calificar', 0, 27, 8, 1, 8),
(38, 'No Entregado', 'Sin Calificar', 0, 27, 9, 1, 9),
(39, 'No Entregado', 'Sin Calificar', 0, 27, 10, 1, 10),
(40, 'No Entregado', 'Sin Calificar', 0, 27, 11, 1, 11);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detalle_alumno`
--

INSERT INTO `detalle_alumno` (`idDetalle_Alumno`, `Codigo_Estudiantil`, `FK_Usuario`, `FK_Grado`, `FK_Nivel_Estudiantil`) VALUES
(1, '150TB', 4, 2, 3),
(2, '151TB', 3, 2, 3),
(5, '152TB', 5, 2, 3),
(6, '153TB', 6, 2, 3),
(7, '154TB', 7, 2, 3),
(8, '155TB', 8, 2, 3),
(9, '156TB', 9, 2, 3),
(10, '157TB', 10, 2, 3),
(11, '158TB', 11, 2, 3),
(12, '001SB', 13, 3, 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detalle_sesiones`
--

INSERT INTO `detalle_sesiones` (`idSesion`, `Inicio_Sesion`, `Cierre_Sesion`, `Estado_Ses`, `FK_Usuario`) VALUES
(1, '2020-10-07 18:39:40', '2020-10-07 18:39:45', 'Inactiva', 1),
(2, '2020-10-09 15:23:20', '2020-10-09 16:00:04', 'Inactiva', 1),
(3, '2020-10-09 16:00:08', '2020-10-10 01:54:58', 'Inactiva', 2),
(4, '2020-10-09 16:00:20', '2020-10-09 19:38:16', 'Inactiva', 1),
(5, '2020-10-09 19:41:31', '2020-10-09 21:06:46', 'Inactiva', 1),
(6, '2020-10-09 22:19:42', '2020-10-10 01:54:20', 'Inactiva', 1),
(7, '2020-10-10 01:54:25', NULL, 'Inactiva', 1),
(8, '2020-10-10 01:54:40', NULL, 'Inactiva', 1),
(9, '2020-10-10 01:54:48', NULL, 'Inactiva', 1),
(10, '2020-10-10 01:55:04', '2020-10-10 01:55:09', 'Inactiva', 1),
(11, '2020-10-10 01:55:12', '2020-10-10 01:56:10', 'Inactiva', 1),
(12, '2020-10-10 01:56:15', '2020-10-10 02:08:19', 'Inactiva', 2),
(13, '2020-10-10 01:56:20', '2020-10-10 01:56:29', 'Inactiva', 1),
(14, '2020-10-10 01:56:33', NULL, 'Inactiva', 1),
(15, '2020-10-10 01:57:01', '2020-10-10 01:57:17', 'Inactiva', 1),
(16, '2020-10-10 01:58:04', '2020-10-10 02:00:52', 'Inactiva', 1),
(17, '2020-10-10 02:00:57', NULL, 'Inactiva', 1),
(18, '2020-10-10 02:02:29', NULL, 'Inactiva', 1),
(19, '2020-10-10 02:03:28', '2020-10-10 02:06:29', 'Inactiva', 1),
(22, '2020-10-10 02:08:25', '2020-10-10 02:08:37', 'Inactiva', 2),
(23, '2020-10-10 02:10:09', '2020-10-10 02:14:46', 'Inactiva', 1),
(24, '2020-10-10 03:07:46', '2020-10-10 03:07:49', 'Inactiva', 2),
(25, '2020-10-10 05:02:02', '2020-10-10 05:08:30', 'Inactiva', 1),
(26, '2020-10-10 22:30:19', '2020-10-10 22:31:22', 'Inactiva', 1),
(27, '2020-10-14 19:45:22', '2020-10-14 19:45:31', 'Inactiva', 1),
(28, '2020-10-14 19:45:38', '2020-10-14 19:45:43', 'Inactiva', 2),
(29, '2020-10-15 01:53:40', '2020-10-15 01:53:46', 'Inactiva', 1),
(30, '2020-10-15 01:55:46', '2020-10-15 01:57:24', 'Inactiva', 1),
(31, '2020-10-15 01:57:29', '2020-10-15 01:58:14', 'Inactiva', 2);

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
  `FK_Seccion` int(11) NOT NULL,
  `FK_Jornada` int(11) NOT NULL,
  `FK_Nivel_Estudiantil` int(11) NOT NULL,
  PRIMARY KEY (`idGrado`),
  KEY `FK_Grado_Jornada` (`FK_Jornada`),
  KEY `FK_Grado_NivelEstudiantil` (`FK_Nivel_Estudiantil`),
  KEY `FK_Grado_Seccion` (`FK_Seccion`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`idGrado`, `Codigo_Grado`, `NombreGrado`, `Descripcion`, `FK_Seccion`, `FK_Jornada`, `FK_Nivel_Estudiantil`) VALUES
(1, 'No Aplicable', 'No Aplicable', 'Este es el grado que se le aplica en la llave foranea a profesores o todo tipo de usuario que no sea estudiante', 1, 1, 1),
(2, 'TB-001', 'Tercero Basico', 'Tercer Grado de Educación Básica', 2, 2, 3),
(3, 'SB-001', 'Segundo Basico', 'Segundo Grado de Educacion Basica', 2, 2, 3),
(4, 'PB-001', 'Primero Básico', 'Primer grado de Educación Básica', 2, 2, 3);

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
-- Estructura de tabla para la tabla `secciones`
--

DROP TABLE IF EXISTS `secciones`;
CREATE TABLE IF NOT EXISTS `secciones` (
  `idSeccion` int(11) NOT NULL AUTO_INCREMENT,
  `NombreSeccion` varchar(8) NOT NULL,
  PRIMARY KEY (`idSeccion`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`idSeccion`, `NombreSeccion`) VALUES
(1, 'N/A'),
(2, 'A'),
(3, 'B'),
(4, 'C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_calificacion`
--

DROP TABLE IF EXISTS `tipo_calificacion`;
CREATE TABLE IF NOT EXISTS `tipo_calificacion` (
  `idTipoCalificacion` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo_Calificacion` varchar(32) NOT NULL,
  `Tipo_Valor` float NOT NULL,
  `FK_Usuario` int(11) NOT NULL,
  PRIMARY KEY (`idTipoCalificacion`),
  KEY `FK_Tipo_Calificacion_Usuarios` (`FK_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipo_calificacion`
--

INSERT INTO `tipo_calificacion` (`idTipoCalificacion`, `Tipo_Calificacion`, `Tipo_Valor`, `FK_Usuario`) VALUES
(1, 'Tarea Comun', 0.1, 1),
(2, 'Investigacion', 0.2, 1),
(3, 'Parcial', 0.3, 1),
(4, 'Evaluacion', 0.4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `User` varchar(32) NOT NULL,
  `Pass` varchar(256) NOT NULL,
  `FName_User` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `LName_User` varchar(128) NOT NULL,
  `Genero` set('Masculino','Femenino','No Binario') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Estado` set('Activo','Inactivo') NOT NULL,
  `Telefono` varchar(32) NOT NULL,
  `FK_Rol` int(11) DEFAULT NULL,
  `FK_Grado` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `FK_Rol_Users` (`FK_Rol`),
  KEY `FK_Users_Grado` (`FK_Grado`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `User`, `Pass`, `FName_User`, `LName_User`, `Genero`, `Fecha_Nacimiento`, `Email`, `Estado`, `Telefono`, `FK_Rol`, `FK_Grado`) VALUES
(1, 'admin', '08aa2cee8a7c60a785ec95ac1f40ac74911e60e6917c49da5f2ae21b6f55d49cf057d0ab09eb1b89713c6f1c8aef92783628fe35caeedb5b073edf1970aea855', 'Mario Enrique ', 'Carbajal Lopez', 'Masculino', '1997-12-21', 'marencarlo2112@gmail.com', 'Activo', '+502 4132-6597', 1, 1),
(2, 'Profesor', '08aa2cee8a7c60a785ec95ac1f40ac74911e60e6917c49da5f2ae21b6f55d49cf057d0ab09eb1b89713c6f1c8aef92783628fe35caeedb5b073edf1970aea855', 'Sebastian Antonio', 'Carbajal Lopez', 'Masculino', '2000-04-22', 'sebant4@gmail.com', 'Activo', '+502 3454-3441', 2, 1),
(3, 'CACL', '08aa2cee8a7c60a785ec95ac1f40ac74911e60e6917c49da5f2ae21b6f55d49cf057d0ab09eb1b89713c6f1c8aef92783628fe35caeedb5b073edf1970aea855', 'Carlos Alejandro', 'Carbajal Lopez', 'Masculino', '2004-05-20', 'carlos22@gmail.com', 'Activo', '+502 4569-6554', 3, 2),
(4, 'FEGO', '08aa2cee8a7c60a785ec95ac1f40ac74911e60e6917c49da5f2ae21b6f55d49cf057d0ab09eb1b89713c6f1c8aef92783628fe35caeedb5b073edf1970aea855', 'Felipe ', 'Gonzales', 'Masculino', '2004-05-20', 'FelGon@gmail.com', 'Activo', '+502 9034-1232', 3, 2),
(5, 'DFBP', '08aa2cee8a7c60a785ec95ac1f40ac74911e60e6917c49da5f2ae21b6f55d49cf057d0ab09eb1b89713c6f1c8aef92783628fe35caeedb5b073edf1970aea855', 'Diego Fernando', 'Barrientos Pinto', 'Masculino', '2005-06-06', 'Dieggs13@gmail.com', 'Activo', '+502 5122-3022', 3, 2),
(6, 'MFPL', '08aa2cee8a7c60a785ec95ac1f40ac74911e60e6917c49da5f2ae21b6f55d49cf057d0ab09eb1b89713c6f1c8aef92783628fe35caeedb5b073edf1970aea855', 'Maria Fernanda', 'Pinto Lopez', 'Femenino', '2002-09-02', 'mafer@gmail.com', 'Activo', '+502 5420-9301', 3, 2),
(7, 'AMGC', '08aa2cee8a7c60a785ec95ac1f40ac74911e60e6917c49da5f2ae21b6f55d49cf057d0ab09eb1b89713c6f1c8aef92783628fe35caeedb5b073edf1970aea855', 'Ana Maria', 'Guevara Caceres', 'Femenino', '2000-07-12', 'AMGC@gmail.com', 'Activo', '+502 4312-2302', 3, 2),
(8, 'RALC', '08aa2cee8a7c60a785ec95ac1f40ac74911e60e6917c49da5f2ae21b6f55d49cf057d0ab09eb1b89713c6f1c8aef92783628fe35caeedb5b073edf1970aea855', 'Rocio Andrea', 'Lopez Casas', 'Femenino', '2001-11-20', 'RALC@gmail.com', 'Activo', '+502 4588-4332', 3, 2),
(9, 'JAVR', '08aa2cee8a7c60a785ec95ac1f40ac74911e60e6917c49da5f2ae21b6f55d49cf057d0ab09eb1b89713c6f1c8aef92783628fe35caeedb5b073edf1970aea855', 'Jorge Alberto', 'Villeda Recinos', 'Masculino', '2005-02-09', 'JAVR@gmail.com', 'Activo', '+502 2564-3432', 3, 2),
(10, 'RMLS', '08aa2cee8a7c60a785ec95ac1f40ac74911e60e6917c49da5f2ae21b6f55d49cf057d0ab09eb1b89713c6f1c8aef92783628fe35caeedb5b073edf1970aea855', 'Rocio Maria', 'Linares Sagastume', 'Femenino', '2000-01-11', 'RMLS@gmail.com', 'Activo', '+502 3443-0012', 3, 2),
(11, 'CRPS', '08aa2cee8a7c60a785ec95ac1f40ac74911e60e6917c49da5f2ae21b6f55d49cf057d0ab09eb1b89713c6f1c8aef92783628fe35caeedb5b073edf1970aea855', 'Catalina Rocio', 'Perez Saavedra', 'Femenino', '2001-06-13', 'CRPS@gmail.com', 'Activo', '+502 4509-3443', 3, 2),
(12, 'RARP', '08aa2cee8a7c60a785ec95ac1f40ac74911e60e6917c49da5f2ae21b6f55d49cf057d0ab09eb1b89713c6f1c8aef92783628fe35caeedb5b073edf1970aea855', 'Roberto Alexander', 'Rivera Pacheco', 'Femenino', '1990-06-19', 'RARP@gmail.com', 'Activo', '+502 5609-8383', 2, 1),
(13, 'JRWV', '08aa2cee8a7c60a785ec95ac1f40ac74911e60e6917c49da5f2ae21b6f55d49cf057d0ab09eb1b89713c6f1c8aef92783628fe35caeedb5b073edf1970aea855', 'Juan Rigoberto', 'Winter Vielmann', 'Masculino', '2003-06-10', 'JRWV@gmail.com', 'Activo', '+502 3565-6577', 3, 3);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `FK_Actividad_Curso` FOREIGN KEY (`FK_Curso`) REFERENCES `cursos` (`idCurso`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Actividad_Grado` FOREIGN KEY (`FK_Grado`) REFERENCES `grados` (`idGrado`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Actividad_TipoCalificacion` FOREIGN KEY (`FK_Tipo_Calificacion`) REFERENCES `tipo_calificacion` (`idTipoCalificacion`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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
  ADD CONSTRAINT `FK_DetalleActividades_DetalleAlumno` FOREIGN KEY (`FK_DetalleAlumno`) REFERENCES `detalle_alumno` (`idDetalle_Alumno`) ON DELETE RESTRICT ON UPDATE RESTRICT,
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
  ADD CONSTRAINT `FK_Grado_Jornada` FOREIGN KEY (`FK_Jornada`) REFERENCES `jornada` (`idJornada`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Grado_NivelEstudiantil` FOREIGN KEY (`FK_Nivel_Estudiantil`) REFERENCES `nivel_estudiantil` (`idNivelEstudiantil`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Grado_Seccion` FOREIGN KEY (`FK_Seccion`) REFERENCES `secciones` (`idSeccion`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `tipo_calificacion`
--
ALTER TABLE `tipo_calificacion`
  ADD CONSTRAINT `FK_Tipo_Calificacion_Usuarios` FOREIGN KEY (`FK_Usuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_Users_Grado` FOREIGN KEY (`FK_Grado`) REFERENCES `grados` (`idGrado`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Users_Rol` FOREIGN KEY (`FK_Rol`) REFERENCES `roles` (`idRol`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

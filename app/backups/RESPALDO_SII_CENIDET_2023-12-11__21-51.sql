-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: sii_del_cenidet
-- ------------------------------------------------------
-- Server version	8.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumnos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ApellidoP` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ApellidoM` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `FechaNac` date NOT NULL,
  `noControl` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `curp` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Direccion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Genero` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Telefono` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idCarrera` bigint unsigned DEFAULT NULL,
  `idGrupo` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alumnos_nocontrol_unique` (`noControl`),
  KEY `alumnos_idgrupo_foreign` (`idGrupo`),
  KEY `alumnos_idcarrera_foreign` (`idCarrera`),
  CONSTRAINT `alumnos_idcarrera_foreign` FOREIGN KEY (`idCarrera`) REFERENCES `carreras` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `alumnos_idgrupo_foreign` FOREIGN KEY (`idGrupo`) REFERENCES `grupos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos`
--

LOCK TABLES `alumnos` WRITE;
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
INSERT INTO `alumnos` VALUES (7,'Martin','Torrez','Gomez','2002-02-01','66662','RDBQ011710UTIXC2','Col.Lomas Cortes #6','Masculino','7778920041',NULL,1),(8,'Ana','Roman','Palacios','2001-07-12','66663','RDBQ011710UTIXC2','Avenida cuauhtémoc #52','Femenino','7775636713',NULL,1);
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aplicacion_periodos`
--

DROP TABLE IF EXISTS `aplicacion_periodos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aplicacion_periodos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idPeriodo` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aplicacion_periodos_idperiodo_foreign` (`idPeriodo`),
  CONSTRAINT `aplicacion_periodos_idperiodo_foreign` FOREIGN KEY (`idPeriodo`) REFERENCES `periodos` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aplicacion_periodos`
--

LOCK TABLES `aplicacion_periodos` WRITE;
/*!40000 ALTER TABLE `aplicacion_periodos` DISABLE KEYS */;
INSERT INTO `aplicacion_periodos` VALUES (2,'REGISTRO DE CALIFICACIONES',2);
/*!40000 ALTER TABLE `aplicacion_periodos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aulas`
--

DROP TABLE IF EXISTS `aulas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aulas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `NombreAula` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Capacidad` int NOT NULL,
  `Ubicacion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aulas`
--

LOCK TABLES `aulas` WRITE;
/*!40000 ALTER TABLE `aulas` DISABLE KEYS */;
INSERT INTO `aulas` VALUES (2,'Aula Á-234',40,'Campus 1 Edificio de computacion','2023-12-10 06:15:13','2023-12-10 06:15:13');
/*!40000 ALTER TABLE `aulas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avisos`
--

DROP TABLE IF EXISTS `avisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avisos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `FechaPublicacion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avisos`
--

LOCK TABLES `avisos` WRITE;
/*!40000 ALTER TABLE `avisos` DISABLE KEYS */;
INSERT INTO `avisos` VALUES (1,'Aviso de prueba','IEINEVNEVNENECNN','2023-12-04'),(2,'Prueba','Texto prueba','2023-12-04'),(3,'Lunes','ygygvgyg','2023-12-04'),(4,'Lunes','ygygvgyg','2023-12-04'),(5,'KJIFHUDGJU','UNNBFUUNHGHUR','2023-12-04');
/*!40000 ALTER TABLE `avisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avisos_usuarios`
--

DROP TABLE IF EXISTS `avisos_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avisos_usuarios` (
  `idAviso` bigint unsigned DEFAULT NULL,
  `idUsuario` bigint unsigned DEFAULT NULL,
  KEY `avisos_usuarios_idaviso_foreign` (`idAviso`),
  KEY `avisos_usuarios_idusuario_foreign` (`idUsuario`),
  CONSTRAINT `avisos_usuarios_idaviso_foreign` FOREIGN KEY (`idAviso`) REFERENCES `avisos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `avisos_usuarios_idusuario_foreign` FOREIGN KEY (`idUsuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avisos_usuarios`
--

LOCK TABLES `avisos_usuarios` WRITE;
/*!40000 ALTER TABLE `avisos_usuarios` DISABLE KEYS */;
INSERT INTO `avisos_usuarios` VALUES (1,81),(1,82),(2,81),(3,81),(4,81),(5,81);
/*!40000 ALTER TABLE `avisos_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bajaspersonal`
--

DROP TABLE IF EXISTS `bajaspersonal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bajaspersonal` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idPersonal` bigint unsigned NOT NULL,
  `idEstatus` bigint unsigned NOT NULL,
  `FechaBaja` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bajaspersonal_idpersonal_foreign` (`idPersonal`),
  KEY `bajaspersonal_idestatus_foreign` (`idEstatus`),
  CONSTRAINT `bajaspersonal_idestatus_foreign` FOREIGN KEY (`idEstatus`) REFERENCES `estatus empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bajaspersonal_idpersonal_foreign` FOREIGN KEY (`idPersonal`) REFERENCES `personal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bajaspersonal`
--

LOCK TABLES `bajaspersonal` WRITE;
/*!40000 ALTER TABLE `bajaspersonal` DISABLE KEYS */;
INSERT INTO `bajaspersonal` VALUES (1,8,17,'2023-12-01'),(2,5,3,'2023-12-02'),(3,7,10,'2023-12-02'),(8,2,5,'2023-12-02'),(9,9,8,'2023-12-02'),(10,10,11,'2023-12-02');
/*!40000 ALTER TABLE `bajaspersonal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calificaciones`
--

DROP TABLE IF EXISTS `calificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calificaciones` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idAlumno` bigint unsigned DEFAULT NULL,
  `idMateria` bigint unsigned DEFAULT NULL,
  `Calificacion` double(8,2) NOT NULL,
  `NumSemestre` double(8,2) NOT NULL,
  `idProfesor` bigint unsigned DEFAULT NULL,
  `idGrupo` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `calificaciones_idalumno_foreign` (`idAlumno`),
  KEY `calificaciones_idmateria_foreign` (`idMateria`),
  KEY `calificaciones_idprofesor_foreign` (`idProfesor`),
  KEY `calificaciones_idgrupo_foreign` (`idGrupo`),
  CONSTRAINT `calificaciones_idalumno_foreign` FOREIGN KEY (`idAlumno`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `calificaciones_idgrupo_foreign` FOREIGN KEY (`idGrupo`) REFERENCES `grupos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `calificaciones_idmateria_foreign` FOREIGN KEY (`idMateria`) REFERENCES `materias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `calificaciones_idprofesor_foreign` FOREIGN KEY (`idProfesor`) REFERENCES `personal` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calificaciones`
--

LOCK TABLES `calificaciones` WRITE;
/*!40000 ALTER TABLE `calificaciones` DISABLE KEYS */;
INSERT INTO `calificaciones` VALUES (1,7,1,9.00,4.00,NULL,1),(2,8,1,10.00,4.00,NULL,1);
/*!40000 ALTER TABLE `calificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carreras`
--

DROP TABLE IF EXISTS `carreras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carreras` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Descripcion` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Duracion_Años` int NOT NULL,
  `Nivel` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carreras`
--

LOCK TABLES `carreras` WRITE;
/*!40000 ALTER TABLE `carreras` DISABLE KEYS */;
INSERT INTO `carreras` VALUES (1,'Ciencias de la computacion','',2,'Doctorado'),(2,'Ciencias en ingenieria electronica','',2,'Doctorado'),(3,'Ciencias de la ingenieria','',2,'Doctorado'),(4,'Ciencias en ingenieria mecatronica','',2,'Doctorado'),(5,'Semiconductores','',2,'Especialidad'),(6,'Ciencias en ingenieria electronica','',2,'Doctorado'),(7,'Electromecanica','',2,'Ingenieria'),(8,'Ciencias de la computacion','',2,'Maestria'),(9,'Ciencias en ingenieria electronica','',2,'Maestria'),(10,'Ciencias en ingenieria mecanica','',2,'Maestria'),(11,'Ciencias de la ingenieria','',2,'Maestria'),(12,'Ciencias en ingenieria mecatronica','',2,'Maestria');
/*!40000 ALTER TABLE `carreras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Clave` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Horas` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categorias_clave_unique` (`Clave`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Jefe de Mesa','A01004',36),(2,'Jefe de Proyecto','A01009',36),(3,'Analista de sistemas administrativos','A04003',36),(4,'Secretario Bilingue','A08003',36),(5,'Secretario de director del plantel','A08016',36),(6,'Secretario de jefe de departamento','A08029',36),(7,'Tecnico docente asignatura B','E3507',36),(8,'Profesor de asignatura A E.S','E3519',36),(9,'Profesor de asignatura B E.S','E3521',36),(10,'Profesor de asignatura C E.S','E3525',36),(11,'Profesor asociado B E.S','E3809',36),(12,'Profesor asociado C E.S','E3811',36),(13,'Profesor titular A E.S','E3813',36),(14,'Profesor titular B E.S','E3815',36),(15,'Profesor titular C E.S','E3817',36),(16,'Tecnico Docente Asociado A E.S','E3837',36),(17,'Tecnico Docente Asociado B E.S','E3839',36);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clases`
--

DROP TABLE IF EXISTS `clases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `HInicio` time NOT NULL,
  `HFin` time NOT NULL,
  `dia` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idMateria` bigint unsigned DEFAULT NULL,
  `idAula` bigint unsigned DEFAULT NULL,
  `idGrupo` bigint unsigned DEFAULT NULL,
  `idHorario` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clases_idmateria_foreign` (`idMateria`),
  KEY `clases_idaula_foreign` (`idAula`),
  KEY `clases_idgrupo_foreign` (`idGrupo`),
  KEY `clases_idhorario_foreign` (`idHorario`),
  CONSTRAINT `clases_idaula_foreign` FOREIGN KEY (`idAula`) REFERENCES `aulas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `clases_idgrupo_foreign` FOREIGN KEY (`idGrupo`) REFERENCES `grupos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `clases_idhorario_foreign` FOREIGN KEY (`idHorario`) REFERENCES `horarios_docentes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `clases_idmateria_foreign` FOREIGN KEY (`idMateria`) REFERENCES `materias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clases`
--

LOCK TABLES `clases` WRITE;
/*!40000 ALTER TABLE `clases` DISABLE KEYS */;
INSERT INTO `clases` VALUES (22,'11:00:00','12:00:00','Lunes','#AE1f20',1,2,2,1),(23,'12:00:00','13:00:00','Lunes','#1d9541',1,2,2,1),(24,'08:00:00','09:00:00','Martes','#1f23ad',1,2,2,1),(25,'11:00:00','12:00:00','Martes','#abad1f',1,2,2,1),(26,'00:00:00','13:00:00','Viernes','#646a16',1,2,2,1);
/*!40000 ALTER TABLE `clases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamentos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Descripcion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idEncargado` bigint unsigned DEFAULT NULL,
  `idSubdireccion` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departamentos_idencargado_foreign` (`idEncargado`),
  KEY `departamentos_idsubdireccion_foreign` (`idSubdireccion`),
  CONSTRAINT `departamentos_idencargado_foreign` FOREIGN KEY (`idEncargado`) REFERENCES `personal` (`id`) ON DELETE SET NULL,
  CONSTRAINT `departamentos_idsubdireccion_foreign` FOREIGN KEY (`idSubdireccion`) REFERENCES `subdireccion` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (1,'Direccion','Prueba',NULL,NULL),(2,'Departamento de ingenieria mecanica','Prueba',NULL,NULL),(3,'Coordinacion de mecatronica','Prueba',NULL,NULL),(4,'Coordinacion de ciencias de la ingenieria','Prueba',NULL,NULL),(5,'Departamento de ingenieria electronica','Prueba',NULL,NULL),(6,'Departamento de ciencias computacionales','Prueba',NULL,NULL),(7,'Departamento de Organizacion y seguimiento de estudios','Prueba',NULL,NULL),(8,'Departamento de desarrollo academico e idiomas','Prueba',NULL,NULL),(9,'Departamento de planeacion, programacion y presupuestacion ','Prueba',NULL,NULL),(10,'Departamento de gestion tecnologica y vinculacion','Prueba',NULL,NULL),(11,'Departamento de comunicacion y eventos','Prueba',NULL,NULL),(12,'Centro de informacion','Prueba',NULL,NULL),(13,'Centro de computo','Prueba',NULL,NULL),(14,'Departamento de Servicios escolares','Prueba',NULL,NULL),(15,'Departamento de recursos materiales y servicios','Prueba',NULL,NULL),(16,'Departamento de recursos humanos','Prueba',NULL,NULL);
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diashorario`
--

DROP TABLE IF EXISTS `diashorario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diashorario` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `HInicio` time NOT NULL,
  `HFin` time NOT NULL,
  `dia` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idHorario` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `diashorario_idhorario_foreign` (`idHorario`),
  CONSTRAINT `diashorario_idhorario_foreign` FOREIGN KEY (`idHorario`) REFERENCES `horarios_docentes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diashorario`
--

LOCK TABLES `diashorario` WRITE;
/*!40000 ALTER TABLE `diashorario` DISABLE KEYS */;
INSERT INTO `diashorario` VALUES (2,'12:00:00','14:00:00','Lunes',2),(3,'12:00:00','12:01:00','Viernes',3),(4,'12:00:00','14:04:00','Martes',4),(8,'12:00:00','14:00:00','Lunes',1),(9,'12:00:00','14:00:00','Martes',1),(10,'12:00:00','12:00:00','Miercoles',1);
/*!40000 ALTER TABLE `diashorario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estatus empleado`
--

DROP TABLE IF EXISTS `estatus empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estatus empleado` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estatus empleado`
--

LOCK TABLES `estatus empleado` WRITE;
/*!40000 ALTER TABLE `estatus empleado` DISABLE KEYS */;
INSERT INTO `estatus empleado` VALUES (1,'Activo'),(2,'Baja por abandono de Empleo'),(3,'Baja por cambio de adscripcion'),(4,'Baja por defuncion'),(5,'Baja por incapacidad I.S.S.S.T.E'),(6,'Baja por insubsistencia de nombramiento'),(7,'Baja por jubilacion'),(8,'Baja por renuncia'),(9,'Baja por resolucion del tribunal de concilacion y arbitraje'),(10,'Baja por sentencia Judicial'),(11,'Baja por termino de nombramiento'),(12,'Licencia por asuntos particulares'),(13,'Licencia por beca'),(14,'Licencia por comision sindical o eleccion popular'),(15,'Licencia por gravidez'),(16,'Licencia pre pensionada'),(17,'Sabatico');
/*!40000 ALTER TABLE `estatus empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Semestre` int NOT NULL,
  `Especialidad` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Letra` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idPeriodo` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grupos_idperiodo_foreign` (`idPeriodo`),
  CONSTRAINT `grupos_idperiodo_foreign` FOREIGN KEY (`idPeriodo`) REFERENCES `periodos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos`
--

LOCK TABLES `grupos` WRITE;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` VALUES (1,4,'Computacion','A',3),(2,1,'Computacion','A',1),(3,1,'Computacion','A',2),(4,1,'Computacion','A',3);
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarios_docentes`
--

DROP TABLE IF EXISTS `horarios_docentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horarios_docentes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idProfesor` bigint unsigned DEFAULT NULL,
  `idPeriodo` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `horarios_docentes_idprofesor_foreign` (`idProfesor`),
  KEY `horarios_docentes_idperiodo_foreign` (`idPeriodo`),
  CONSTRAINT `horarios_docentes_idperiodo_foreign` FOREIGN KEY (`idPeriodo`) REFERENCES `periodos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `horarios_docentes_idprofesor_foreign` FOREIGN KEY (`idProfesor`) REFERENCES `personal` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios_docentes`
--

LOCK TABLES `horarios_docentes` WRITE;
/*!40000 ALTER TABLE `horarios_docentes` DISABLE KEYS */;
INSERT INTO `horarios_docentes` VALUES (1,1,1),(2,7,1),(3,5,1),(4,8,1);
/*!40000 ALTER TABLE `horarios_docentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias`
--

DROP TABLE IF EXISTS `materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Descripcion` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Codigo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias`
--

LOCK TABLES `materias` WRITE;
/*!40000 ALTER TABLE `materias` DISABLE KEYS */;
INSERT INTO `materias` VALUES (1,'Español','La materia de español se ve los números','384849');
/*!40000 ALTER TABLE `materias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2023_07_20_182922_create_sessions_table',1),(7,'2023_07_20_215233_create__aula_table',1),(8,'2023_08_19_191953_create_permission_tables',1),(9,'2023_09_06_184833_historial_alumno',1),(10,'2023_09_06_190939_periodo',1),(11,'2023_09_06_191432_historial_alumno',1),(12,'2023_09_09_225802_aplicacion_periodos',1),(13,'2023_09_13_000624_estatus_empleado',1),(14,'2023_09_13_164018_categoria',1),(15,'2023_09_13_184947_plazas',1),(16,'2023_09_14_192017_personal',1),(17,'2023_09_15_235519_subdireccion',1),(18,'2023_09_20_163346_departamento',1),(19,'2023_09_21_084904_update_table_personal',1),(20,'2023_09_25_173710_horarios_profesores',1),(21,'2023_09_30_014559_materias',1),(22,'2023_09_30_213632_grupos',1),(23,'2023_10_01_012120_clases',1),(24,'2023_10_03_233219_carrera',1),(25,'2023_10_22_194550_alumnos',1),(26,'2023_10_30_172539_dias_horario',1),(27,'2023_11_04_002222_vigencias_personal',1),(28,'2023_11_19_225510_calificaciones',1),(29,'2023_11_26_000711_permisos_carreras',1),(30,'2023_11_27_044925_avisos',1),(31,'2023_11_27_180449_usuarios__avisos',1),(32,'2023_12_02_035237_bajas_personal',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
INSERT INTO `model_has_permissions` VALUES (1,'App\\Models\\User',1),(7,'App\\Models\\User',4),(8,'App\\Models\\User',4);
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (2,'App\\Models\\User',1),(2,'App\\Models\\User',2),(1,'App\\Models\\User',4),(8,'App\\Models\\User',7),(3,'App\\Models\\User',10),(7,'App\\Models\\User',81),(11,'App\\Models\\User',82);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES ('erickrra11@gmail.com','$2y$10$iKo1PULtQx0cP4HcRcmOMeY9UtkXHuA.cwx5v2bDMNU1ChUHtAk86','2023-12-05 02:46:42');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodos`
--

DROP TABLE IF EXISTS `periodos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periodos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mesInicio` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `AñoInicio` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mesTermino` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `AñoTermino` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodos`
--

LOCK TABLES `periodos` WRITE;
/*!40000 ALTER TABLE `periodos` DISABLE KEYS */;
INSERT INTO `periodos` VALUES (1,'Agosto','2023','Febrero','2024'),(2,'Febrero','2023','Julio','2023'),(3,'Agosto','2022','Febrero','2023'),(4,'Febrero','2022','Julio','2022'),(5,'Agosto','2021','Febrero','2022'),(6,'Febrero','2021','Julio','2021'),(7,'Agosto','2020','Febrero','2021'),(8,'Febrero','2020','Julio','2020'),(9,'Agosto','2019','Enero','2020'),(10,'Febrero','2019','Julio','2019'),(11,'Agosto','2018','Enero','2019'),(12,'Febrero','2018','Julio','2018'),(13,'Agosto','2017','Enero','2018'),(14,'Febrero','2017','Julio','2017'),(15,'Agosto','2016','Enero','2017'),(16,'Febrero','2016','Julio','2016'),(17,'Agosto','2015','Enero','2016'),(18,'Febrero','2015','Julio','2015'),(19,'Agosto','2014','Enero','2015'),(20,'Febrero','2014','Julio','2014'),(21,'Agosto','2013','Enero','2014'),(22,'Enero','2013','Junio','2013'),(23,'Agosto','2012','Enero','2013'),(24,'Enero','2012','Junio','2012'),(25,'Agosto','2011','Enero','2012'),(26,'Enero','2011','Junio','2011'),(27,'Agosto','2010','Enero','2011'),(28,'Enero','2010','Junio','2010'),(29,'Agosto','2009','Enero','2010'),(30,'Enero','2009','Junio','2009'),(31,'Agosto','2008','Enero','2009'),(32,'Enero','2008','Junio','2008'),(33,'Agosto','2007','Enero','2008'),(34,'Enero','2007','Junio','2007'),(35,'Agosto','2006','Enero','2007'),(36,'Enero','2006','Junio','2006'),(37,'Agosto','2005','Enero','2006'),(38,'Enero','2005','Junio','2005'),(39,'Agosto','2004','Enero','2005'),(40,'Enero','2004','Junio','2004'),(41,'Agosto','2003','Enero','2004'),(42,'Enero','2003','Junio','2003'),(43,'Agosto','2002','Enero','2003'),(44,'Enero','2002','Junio','2002'),(45,'Agosto','2001','Enero','2002'),(46,'Enero','2001','Junio','2001'),(47,'Agosto','2000','Enero','2001'),(48,'Enero','2000','Junio','2000');
/*!40000 ALTER TABLE `periodos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisoscarreras`
--

DROP TABLE IF EXISTS `permisoscarreras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permisoscarreras` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idCarrera` bigint unsigned DEFAULT NULL,
  `idUsuario` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permisoscarreras_idcarrera_foreign` (`idCarrera`),
  KEY `permisoscarreras_idusuario_foreign` (`idUsuario`),
  CONSTRAINT `permisoscarreras_idcarrera_foreign` FOREIGN KEY (`idCarrera`) REFERENCES `carreras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permisoscarreras_idusuario_foreign` FOREIGN KEY (`idUsuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisoscarreras`
--

LOCK TABLES `permisoscarreras` WRITE;
/*!40000 ALTER TABLE `permisoscarreras` DISABLE KEYS */;
INSERT INTO `permisoscarreras` VALUES (1,1,1),(2,10,4),(3,11,4);
/*!40000 ALTER TABLE `permisoscarreras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Modificación de Actas de Calificaciones','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(2,'Modificación de Actas de Ex. Globales o Especiales','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(3,'Generación de Folios','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(4,'Alta de Alumnoss','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(5,'Modificación de datos de Alumnos','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(6,'Eliminación de Alumnos','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(7,'Modificación de Kardex','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(8,'Calcular promedios de Alumnos','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(9,'Solicitud de Ex. Globales o Especiales','web','2023-12-02 09:35:22','2023-12-02 09:35:22');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal`
--

DROP TABLE IF EXISTS `personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ApellidoP` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ApellidoM` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nombre` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `RFC` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `LugarNacimiento` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Sexo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `EstadoCivil` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Direccion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Colonia` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CodigoPostal` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Ciudad` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `EntFederativa` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Telefono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CURP` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CorreoPers` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NivEst1` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NivEst2` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NivEst3` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GradoMax1` int DEFAULT NULL,
  `GradoMax2` int DEFAULT NULL,
  `GradoMax3` int DEFAULT NULL,
  `Estudio1` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Estudio2` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Estudio3` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Titulo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Nombramiento` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numEmpleado` int NOT NULL,
  `Estatus` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `IngAñoSNEST` int DEFAULT NULL,
  `IngQuinSNEST` int DEFAULT NULL,
  `IngAñoGob` int DEFAULT NULL,
  `IngQuinGob` int DEFAULT NULL,
  `IngAñoSEP` int DEFAULT NULL,
  `IngQuinSEP` int DEFAULT NULL,
  `IngAñoPlan` int DEFAULT NULL,
  `IngQuinPlan` int DEFAULT NULL,
  `TipoAct` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `FechaRegistro` date NOT NULL,
  `idPlaza` bigint unsigned DEFAULT NULL,
  `idUsuario` bigint unsigned DEFAULT NULL,
  `EstatusEmpleado` bigint unsigned DEFAULT NULL,
  `idDepAdscripcion` bigint unsigned DEFAULT NULL,
  `idDepAcademico` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `personal_idplaza_foreign` (`idPlaza`),
  KEY `personal_idusuario_foreign` (`idUsuario`),
  KEY `personal_estatusempleado_foreign` (`EstatusEmpleado`),
  KEY `personal_iddepadscripcion_foreign` (`idDepAdscripcion`),
  KEY `personal_iddepacademico_foreign` (`idDepAcademico`),
  CONSTRAINT `personal_estatusempleado_foreign` FOREIGN KEY (`EstatusEmpleado`) REFERENCES `estatus empleado` (`id`) ON DELETE SET NULL,
  CONSTRAINT `personal_iddepacademico_foreign` FOREIGN KEY (`idDepAcademico`) REFERENCES `departamentos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `personal_iddepadscripcion_foreign` FOREIGN KEY (`idDepAdscripcion`) REFERENCES `departamentos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `personal_idplaza_foreign` FOREIGN KEY (`idPlaza`) REFERENCES `plazas` (`id`) ON DELETE SET NULL,
  CONSTRAINT `personal_idusuario_foreign` FOREIGN KEY (`idUsuario`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal`
--

LOCK TABLES `personal` WRITE;
/*!40000 ALTER TABLE `personal` DISABLE KEYS */;
INSERT INTO `personal` VALUES (1,'Perez','Torres','Ana','NDFUNNVURNVRN','Morelos','2023-12-07','Femenino','Soltero','vejbtnjnrtd','nevuurvnur','67532','hvdh rvhe','nucvnur','nuceunvnu','NJVNURNUVNVUNUVRNV','ana@gmail.com','Preparatoria','Secundaria','Maestria',2,9,10,'Kiudunnufd','rbtjbtr','Prueba','Mr.','Docente',3,'A',2001,2,2002,2,2002,4,2005,2,'Docentes','2021-12-02',NULL,81,1,15,9),(2,'Torrez','Lopez','David','HBDBHRVHBVRBH','Gomez','2023-10-13','Masculino','Casado','evbhrvbuvrurvbuu','uwcbyevbyrvby','bdvby','bhysdvbyevby','bhcebyveby','bscbhceby','RVRBVHYRBHYVREBUER','david@gmail.com','Doctorado',NULL,NULL,8,0,0,'2001',NULL,NULL,'Dr.','Administrativo',4,'B',2001,2,NULL,NULL,NULL,NULL,2004,2,'Docentes','2023-12-01',NULL,76,5,9,7),(5,'getgrtg','evijvrjju','Pedro','yevbyrvyggecg','jjujj','2023-12-02','Masculino','Soltero','nivruvrhu`','jchuvrhvrhu','49854','enurvvrh','huehur','wjiveuhjrvhu','evuhuvrhbvrvrgh','Pedro@gmail.com','Profesional',NULL,NULL,6,0,0,'rvijrvurtuhhi',NULL,NULL,'Ing','Administrativo',3848,'B',2001,2,NULL,NULL,NULL,NULL,NULL,NULL,'Docentes','2010-12-01',NULL,19,3,2,5),(7,'IVRUNRUU','UWCURVUH','Alan','UNEUHRBHYVRHY','Morelos','2023-12-08','Masculino','Viudo','evrrimtrijjiu','jvurvhu','juheu','juevuhvryh','huuhfvrhrv','hucehurvh','JIRJITBUJBTUBTRHUB','alan@gmail.com','Maestria',NULL,NULL,2,0,0,'NUCNUUF',NULL,NULL,'Mr.','Administrativo',2768,'B',2001,2,NULL,NULL,NULL,NULL,NULL,NULL,'Docentes','2023-12-01',NULL,NULL,10,3,3),(8,'njuevurbu','uuevuhrvhurvhu','Juanito','URURBVRHBVHRV','Morelos','2023-11-10','Masculino','Casado','eijrurvuhvrhu','uhhuechurvyh','huedv','hyywcygevyg','yhevybgrvygyg','777867213','VRUHJRUHRVUHVRUHRV','juanito@gmail.com','Maestria',NULL,NULL,5,0,0,'Prueba',NULL,NULL,'Mr.','Administrativo',2,'B',2001,2,NULL,NULL,NULL,NULL,NULL,NULL,'Administrativas','2023-12-01',NULL,NULL,17,3,4),(9,'NUBBS','mrvmrvim','Maria','NFBH HBVRBHVH','IRVIVRI','2023-12-01','Femenino','Soltero','ECNICUNBU','NUNUENUCENU','NUCRB','NBECBHRB','BHBEHCHB`','777509201','NRVNUVRNURVNUVRNNU','Maria@gmail.com','Normal',NULL,NULL,3,0,0,'ecjnne',NULL,NULL,'Lic','Docente',4858,'B',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Docentes','2023-12-02',NULL,NULL,8,6,8),(10,'HNDDNEN','UNDNUNUCENEC','Karen','BHWHBECHBBWCB','NIC3NURNUVRNUVRN','2023-12-08','Femenino','Divorciado','NEIINENI','INECNUECNU','INUEU','UNCWNECNUECNU','NUUCWNUCE','777983841','NUERVHHRVRBRVBRBHV','Kren@gmail.com','Carrera Tecnica',NULL,NULL,3,0,0,'imd if ii',NULL,NULL,'Lic','Administrativo',2939,'B',2001,2,NULL,NULL,NULL,NULL,NULL,NULL,'Administrativas','2023-12-02',NULL,NULL,11,4,4);
/*!40000 ALTER TABLE `personal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plazas`
--

DROP TABLE IF EXISTS `plazas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plazas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `diagonal` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unidad` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subunidad` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `horas` int NOT NULL,
  `TipoMovimiento` int NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `idCategoria` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plazas_idcategoria_foreign` (`idCategoria`),
  CONSTRAINT `plazas_idcategoria_foreign` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plazas`
--

LOCK TABLES `plazas` WRITE;
/*!40000 ALTER TABLE `plazas` DISABLE KEYS */;
INSERT INTO `plazas` VALUES (1,'626737','14','1',36,10,0,4,'2023-12-07 05:41:47','2023-12-07 05:41:47'),(2,'75902','18','2',40,95,0,10,'2023-12-07 05:42:06','2023-12-07 05:42:06'),(4,'709939','18','2',36,20,0,4,'2023-12-08 00:04:15','2023-12-08 00:04:15');
/*!40000 ALTER TABLE `plazas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Comite de Calidad','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(2,'Academicos','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(3,'Departamento de desarrollo academico','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(4,'Division de estudios Profesionales','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(5,'Direccion','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(6,'Docentes','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(7,'Recursos Humanos','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(8,'Escolares','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(9,'Gestion tecnologica y vinculacion','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(10,'Departamento de planeacion','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(11,'Administrador','web','2023-12-02 09:35:22','2023-12-02 09:35:22'),(12,'Secretarias CENIDET','web','2023-12-02 09:35:22','2023-12-02 09:35:22');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('0vOCRgGwedXlJMhPdeVILnRWXsRmq9jIAPvg6GeP',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 OPR/105.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoieERjbFBKWGpCNzl4Z0ZsSmdpT3FENGkzRnd0QjVwTHNhOUhIZzBhcSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL0hvcmFyaW9zRG9jZW50ZXMvMy92ZXIiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1702352882),('GfAmZ5rPM3zRnlUSpGP8Z6VEAzb3e1THDblsKkEK',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 OPR/105.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNURzTFdHRERtS2ZtUGdxQkJQN0w3R3RMOEZNRlZZenRjd2pEcGxmcCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL0hvcmFyaW9zRG9jZW50ZXMvMi92ZXIiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL0hvcmFyaW9zRG9jZW50ZXMvMi92ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1702352878),('HK6QlWP1atQyIeJih9rBkvwJm2b8Jt4tC2pWm7pp',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 OPR/105.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN3RKUTd0UVVneFRSUldGUzE1bG5qR3RhT3VDNVliSDZQYlFaa1VzNyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL0hvcmFyaW9zRG9jZW50ZXMvNC92ZXIiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1702352883),('jOkLnn8ejouU49QWjFmkuZz4unOL6WucCKLx4dDq',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 OPR/105.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWXFueHg5QkpyNmtLSVdOY3QwMWtLTDlERVMyclRuakhoT3NhVEw2OSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL0hvcmFyaW9zRG9jZW50ZXMvMS92ZXIiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1702352881),('oAJPl0oLZGzYrJfs1MKZH70d0vQsd4CcTK4Fg3f3',81,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 OPR/105.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSGUzREQxVTdQWFNMckRoUXhPMDBkc21scDVaVTBkNWExcW9EVXROSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODE7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkUTd5UVhLZ2dSZUlDd0RjMWRuQW5hZUxUS1hBYjVad01PTnZmSDZnZ2lnd1ZRN1JuU0pUaUciO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvSG9yYXJpb3NEb2NlbnRlcy80L3ZlciI7fX0=',1702337709),('tjOZOtmgS2sXWEU5CWlklgRfvmZMSt9UlBMBz1iV',82,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 OPR/105.0.0.0','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiTjdrdWNmdVJWSGNQRjBNdjg1NlJqOXduTjdtWE5FeU43cTdzZUxEVCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo4MjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRZQmx0UDJsUS45dVpUT21IVXNGYzQuVHlIaDQ3blhFMURlaDExei5NSWlIZ2Y5MEpZRy9YSyI7fQ==',1702353047);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subdireccion`
--

DROP TABLE IF EXISTS `subdireccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subdireccion` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subdireccion`
--

LOCK TABLES `subdireccion` WRITE;
/*!40000 ALTER TABLE `subdireccion` DISABLE KEYS */;
INSERT INTO `subdireccion` VALUES (1,'Subdireccion academica'),(2,'Subdireccion de Planeacion y vinculacion'),(3,'Subdireccion de Servicios administrativos'),(4,'Direccion');
/*!40000 ALTER TABLE `subdireccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `Estatus` tinyint(1) NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Jena Doyle DDS','heidenreich.gwendolyn@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'cxFEoLlUyl',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(2,'Johanna Bernier III','gwindler@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'q99tiV7Kza',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(3,'Malachi Carroll','gregoria.shanahan@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'JyKIVJ62Aj',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(4,'Ms. Ebony McDermott IV','kenny.pfannerstill@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'Gr5rwXbg3I',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(5,'Dr. Luis Wisozk','zcremin@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'7KPatLQA1n',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(6,'Mr. Gus Waelchi MD','wcarter@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'yyfeR60bQO',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(7,'Delphia Feest','bfahey@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'2M2UZa40yG',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(8,'Guadalupe Batz','harris.drew@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'cArwruqpyl',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(9,'Kallie Senger','genesis.durgan@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'PGza3R92yX',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(10,'Reed Bartell','ian.champlin@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'be0XwcysGu',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(11,'Madaline Lebsack','telly97@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'pA0qGmKiEP',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(12,'Kory Considine','estrella16@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'PE8XOsm9OU',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(13,'Thalia Corkery','vblanda@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'wssqdJAVji',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(14,'Bret Kiehn','annamae79@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'puZxgPx1Ph',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(15,'Bonita Kuhlman','oshanahan@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'Mmf6EBhTfc',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(16,'Ian Hansen','tyra83@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'6YT6IetkNP',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(17,'Anjali Schaefer','gabrielle95@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'GBtqxEgnj1',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(18,'Dr. Vivien Toy','torp.mikel@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'r5hU6Cl4Nk',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(19,'Antonia Harvey','tgaylord@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'XIcAViJMR0',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(20,'Mollie Stehr','hammes.harold@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'6sSd0V1qqE',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(21,'Dr. Lula Williamson DDS','bmckenzie@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'KQoOfdPIGI',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(22,'Giovanni Rosenbaum V','kay70@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'IlQMfBciJI',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(23,'Mr. Elton Cole II','lzemlak@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'rfA6XwbUGa',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(24,'Lily Berge','barrett.thiel@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'X7R69owknY',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(25,'Joe Gorczany','vernice50@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'jA27WnCu5o',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(26,'Mozell Langosh','strosin.erica@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'YfDKUAIQtF',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(27,'Karl Watsica','jarrell.gutkowski@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'cOb4GnxTK0',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(28,'Lola McGlynn','fanny20@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'SOOfIDCYsi',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(29,'Mr. Brayan Donnelly','cterry@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'xImkaH7cuy',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(30,'Flavio Sawayn','kchristiansen@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'8SbmN1oUT1',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(31,'Charlotte Quigley','langworth.joyce@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'hhVnkr8qRz',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(32,'Bessie Hoppe','miller.kristopher@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'9rEba04702',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(33,'Marlon Hahn','qbeier@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'TgAGh4oYd9',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(34,'Ibrahim Stiedemann','dgoodwin@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'3EtWjMCzmn',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(35,'Miss Amara Brown','lowell56@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'dHV2zrMyuc',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(36,'Prof. Bernice Koch I','ortiz.weldon@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'eKqmoqPEwI',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(37,'Gail Tremblay','kiana37@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'RYKX78O788',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(38,'Isidro Labadie','jayme95@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'ccBmGB1ddb',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(39,'Dejuan Lemke','martine.graham@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'7nxT4AZCdu',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(40,'Hunter Yundt','zoila31@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'0UbezWrgXh',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(41,'Turner Abbott PhD','freeman87@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'VjVq0Y1C0M',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(42,'Edgar Schultz','balistreri.dora@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'gWmZW0P15l',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(43,'Christine Roberts DVM','nicklaus.zemlak@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'ejEuRrY7n6',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(44,'Emory Stamm','joanie.schuster@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'HfRHhDiErx',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(45,'Prof. Darrin Turner','blaise53@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'oy1Kir0eFi',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(46,'Olen Kunze','bernhard.watson@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'L3wUEHXIvM',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(47,'Gregorio Barton','brice@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'eEKO2g0MSl',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(48,'Felicita Ondricka','kurtis.sanford@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'wcpZUobjwG',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(49,'Josh Hirthe','virgil37@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'42Lpdxaicu',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(50,'Arvel Kovacek','rico.wilderman@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'t38SiElgZd',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(51,'Spencer Langworth','rutherford.juvenal@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'hKLtFnNmhE',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(52,'Elmira Will','ncole@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'S3vUGQ67FW',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(53,'Mr. Kayleigh Ullrich V','rau.yesenia@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'lFgHE0m5aa',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(54,'Emilie Deckow DVM','zwisozk@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'DAaK1aUbMh',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(55,'Flavio Koelpin','gbotsford@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'vyTDMh6U8F',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(56,'Hardy Ruecker','qreilly@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'fIKjuVnwSL',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(57,'Adriana Greenfelder','veda39@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'CePmfZlhWq',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(58,'Bernice Renner','lacey.wehner@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'C3QjtqZ6Xe',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(59,'Mr. Eloy McKenzie MD','bbradtke@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'Vg1sskhccB',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(60,'Camilla Hermiston','ike.lakin@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'kuzmgBzwYo',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(61,'Tyson Rogahn','manuel.torphy@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'iEb1sr6h8Z',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(62,'Colin Beahan PhD','hoconnell@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'nyirSaajjw',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(63,'Maegan Lynch','gerald.hermiston@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'tDlwKHRABp',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(64,'Napoleon Dietrich','elijah.daugherty@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'YoY4tiiYWr',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(65,'Gregory Boyle','schamberger.enos@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'uYMrJeX0QT',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(66,'Ron O\'Conner V','noemie.kuhic@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'DwJVEdgdiB',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(67,'Brice Prosacco','shanna.robel@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'yT6w3O8wyH',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(68,'Dr. Ibrahim Price V','leif.mann@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'fhe8Z9udiV',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(69,'Jaylin Rohan','cquigley@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'yjNJcaj5BA',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(70,'Helene Crist','rafaela90@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'mr4YSv9lOV',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(71,'Prof. Jocelyn Spinka','zora.breitenberg@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'LhLyvBfdEo',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(72,'Mr. Arvel Rosenbaum','ebba.schoen@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'JrmWUzjRga',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(73,'Dallin Rowe','korbin.stokes@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'VgJHstXsG5',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(74,'Mozelle Bode','julius20@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'JafIBlXEw8',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(75,'Hilma Borer','cartwright.rowan@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'XZBOVVUQkw',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(76,'Constance Kessler','sjakubowski@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'6AsgUgpBzf',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(77,'Mariah Lind','heidenreich.odessa@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'8jgXWEtfDW',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(78,'Blaze Conroy','hbotsford@example.com',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'nCAyM8Fq5O',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(79,'Mrs. Kylie Kemmer','swelch@example.org',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'Oocm7oQa0d',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(80,'Carolyne Steuber','dee.funk@example.net',NULL,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,0,'LpqabXfhWc',NULL,NULL,'2023-12-02 09:35:23','2023-12-02 09:35:23'),(81,'Jorge','rbeo201569@upemor.edu.mx','2023-12-02 09:35:24','$2y$10$Q7yQXKggReICwDc1dnAnaeLTKXAb5ZwMONvfH6ggigwVQ7RnSJTiG',NULL,NULL,NULL,0,'mMudcwycDeT8M8ZQVu6eoptDoogC0Q3vwx5bs8pL0szDou1mO1wGC9DRbLD6',NULL,NULL,'2023-12-02 09:35:24','2023-12-05 03:02:16'),(82,'Erick','erickrra11@gmail.com','2023-12-02 09:35:24','$2y$10$YBltP2lQ.9uZTOmHUsFc4.TyHh47nXE1Deh11z.MIiHgf90JYG/XK',NULL,NULL,NULL,0,'8jBaIVvRXvJh3aYUZSy7TkNB2LbUv52MW9Y7DGJKrFNvc8P6Zznk406vXr6y',NULL,NULL,'2023-12-02 09:35:24','2023-12-02 09:35:24');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vigenciapersonal`
--

DROP TABLE IF EXISTS `vigenciapersonal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vigenciapersonal` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idPersonal` bigint unsigned DEFAULT NULL,
  `idPeriodo` bigint unsigned DEFAULT NULL,
  `InicioVigencia` date NOT NULL,
  `FinVigencia` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vigenciapersonal_idpersonal_foreign` (`idPersonal`),
  KEY `vigenciapersonal_idperiodo_foreign` (`idPeriodo`),
  CONSTRAINT `vigenciapersonal_idperiodo_foreign` FOREIGN KEY (`idPeriodo`) REFERENCES `periodos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `vigenciapersonal_idpersonal_foreign` FOREIGN KEY (`idPersonal`) REFERENCES `personal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vigenciapersonal`
--

LOCK TABLES `vigenciapersonal` WRITE;
/*!40000 ALTER TABLE `vigenciapersonal` DISABLE KEYS */;
/*!40000 ALTER TABLE `vigenciapersonal` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-11 21:51:11

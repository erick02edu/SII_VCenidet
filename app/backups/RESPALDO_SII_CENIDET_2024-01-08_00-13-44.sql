-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: SII
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
-- Table structure for table `aplicacion_periodos`
--

DROP TABLE IF EXISTS `aplicacion_periodos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aplicacion_periodos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idPeriodo` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aplicacion_periodos_idperiodo_foreign` (`idPeriodo`),
  CONSTRAINT `aplicacion_periodos_idperiodo_foreign` FOREIGN KEY (`idPeriodo`) REFERENCES `periodos` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aplicacion_periodos`
--

LOCK TABLES `aplicacion_periodos` WRITE;
/*!40000 ALTER TABLE `aplicacion_periodos` DISABLE KEYS */;
INSERT INTO `aplicacion_periodos` VALUES (2,'CAPTURA DE CALIFICACIONES FINALES',1),(3,'CIERRE DE PERIODOS ESCOLARES',1),(4,'CALIFICACIONES PARCIALES, GESTION DE CURSO',1),(5,'CAPTURA DE EXAMENES ESPECIALES',1),(6,'PROCESO DE REINSCRIPCION',1),(7,'AUTORIZACION DE RESIDENCIAS DEP',1);
/*!40000 ALTER TABLE `aplicacion_periodos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avisos`
--

DROP TABLE IF EXISTS `avisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avisos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FechaPublicacion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avisos`
--

LOCK TABLES `avisos` WRITE;
/*!40000 ALTER TABLE `avisos` DISABLE KEYS */;
INSERT INTO `avisos` VALUES (2,'Nuevo Aviso','Esto es una prueba','2024-01-09');
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
  `Leido` tinyint(1) NOT NULL,
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
INSERT INTO `avisos_usuarios` VALUES (2,2,1);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bajaspersonal`
--

LOCK TABLES `bajaspersonal` WRITE;
/*!40000 ALTER TABLE `bajaspersonal` DISABLE KEYS */;
/*!40000 ALTER TABLE `bajaspersonal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carreras`
--

DROP TABLE IF EXISTS `carreras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carreras` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Descripcion` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Duracion_Años` int NOT NULL,
  `Nivel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `Descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Clave` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamentos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `dia` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idHorario` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `diashorario_idhorario_foreign` (`idHorario`),
  CONSTRAINT `diashorario_idhorario_foreign` FOREIGN KEY (`idHorario`) REFERENCES `horarios_docentes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diashorario`
--

LOCK TABLES `diashorario` WRITE;
/*!40000 ALTER TABLE `diashorario` DISABLE KEYS */;
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
  `Descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios_docentes`
--

LOCK TABLES `horarios_docentes` WRITE;
/*!40000 ALTER TABLE `horarios_docentes` DISABLE KEYS */;
/*!40000 ALTER TABLE `horarios_docentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2023_07_20_182922_create_sessions_table',1),(7,'2023_08_19_191953_create_permission_tables',1),(8,'2023_09_06_190939_periodo',1),(9,'2023_09_09_225802_aplicacion_periodos',1),(10,'2023_09_13_000624_estatus_empleado',1),(11,'2023_09_13_164018_categoria',1),(12,'2023_09_13_184947_plazas',1),(13,'2023_09_14_192017_personal',1),(14,'2023_09_15_235519_subdireccion',1),(15,'2023_09_20_163346_departamento',1),(16,'2023_09_21_084904_update_table_personal',1),(17,'2023_09_25_173710_horarios_profesores',1),(18,'2023_10_03_233219_carrera',1),(19,'2023_10_30_172539_dias_horario',1),(20,'2023_11_04_002222_vigencias_personal',1),(21,'2023_11_26_000711_permisos_carreras',1),(22,'2023_11_27_044925_avisos',1),(23,'2023_11_27_180449_usuarios__avisos',1),(24,'2023_12_02_035237_bajas_personal',1),(25,'2024_01_08_210853_triggers',1);
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
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `model_has_roles` VALUES (7,'App\\Models\\User',1),(11,'App\\Models\\User',2),(2,'App\\Models\\User',3),(4,'App\\Models\\User',4),(2,'App\\Models\\User',5),(3,'App\\Models\\User',7),(10,'App\\Models\\User',8);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
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
  `mesInicio` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `AñoInicio` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mesTermino` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `AñoTermino` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisoscarreras`
--

LOCK TABLES `permisoscarreras` WRITE;
/*!40000 ALTER TABLE `permisoscarreras` DISABLE KEYS */;
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
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `permissions` VALUES (1,'Modificación de Actas de Calificaciones','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(2,'Modificación de Actas de Ex. Globales o Especiales','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(3,'Generación de Folios','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(4,'Alta de Alumnos','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(5,'Modificación de datos de Alumnos','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(6,'Eliminación de Alumnos','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(7,'Modificación de Kardex','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(8,'Calcular promedios de Alumnos','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(9,'Solicitud de Ex. Globales o Especiales','web','2024-01-09 09:20:49','2024-01-09 09:20:49');
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
  `ApellidoP` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ApellidoM` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RFC` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LugarNacimiento` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Sexo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EstadoCivil` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Direccion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Colonia` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CodigoPostal` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Ciudad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EntFederativa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Telefono` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CURP` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CorreoPers` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NivEst1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NivEst2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NivEst3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GradoMax1` int DEFAULT NULL,
  `GradoMax2` int DEFAULT NULL,
  `GradoMax3` int DEFAULT NULL,
  `Estudio1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Estudio2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Estudio3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Titulo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Nombramiento` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numEmpleado` int NOT NULL,
  `Estatus` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IngAñoSNEST` int DEFAULT NULL,
  `IngQuinSNEST` int DEFAULT NULL,
  `IngAñoGob` int DEFAULT NULL,
  `IngQuinGob` int DEFAULT NULL,
  `IngAñoSEP` int DEFAULT NULL,
  `IngQuinSEP` int DEFAULT NULL,
  `IngAñoPlan` int DEFAULT NULL,
  `IngQuinPlan` int DEFAULT NULL,
  `TipoAct` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal`
--

LOCK TABLES `personal` WRITE;
/*!40000 ALTER TABLE `personal` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `actualiza_estatus_plaza_update_personal` BEFORE UPDATE ON `personal` FOR EACH ROW BEGIN
                IF NEW.idPlaza IS NOT NULL THEN
                UPDATE plazas SET estatus = '0' WHERE id = OLD.idPlaza;
                    UPDATE plazas SET estatus = '1' WHERE id = NEW.idPlaza;
                END IF;
            END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `actualiza_estatus_cuenta_update_personal` BEFORE UPDATE ON `personal` FOR EACH ROW BEGIN
                IF NEW.idUsuario IS NOT NULL THEN
                UPDATE users SET Estatus = '0' WHERE id = OLD.idUsuario;
                    UPDATE users SET Estatus = '1' WHERE id = NEW.idUsuario;
                END IF;
            END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `actualiza_estatus_PlazaCuenta_baja_personal` BEFORE UPDATE ON `personal` FOR EACH ROW BEGIN
                DECLARE personal_id INT;
                SET personal_id = NEW.id;

                IF NEW.Estatus='B' THEN
                    UPDATE departamentos SET idEncargado=NULL WHERE id=personal_id;
                    UPDATE plazas SET estatus = '0' WHERE id = OLD.idPlaza;
                    UPDATE users SET Estatus = '0' WHERE id = OLD.idUsuario;
                    SET NEW.idPlaza=NULL;
                    SET NEW.idUsuario=NULL;
                END IF;
            END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
  `diagonal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unidad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subunidad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `horas` int NOT NULL,
  `TipoMovimiento` int NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `idCategoria` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plazas_idcategoria_foreign` (`idCategoria`),
  CONSTRAINT `plazas_idcategoria_foreign` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plazas`
--

LOCK TABLES `plazas` WRITE;
/*!40000 ALTER TABLE `plazas` DISABLE KEYS */;
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
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Comite de Calidad','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(2,'Academicos','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(3,'Departamento de desarrollo academico','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(4,'Division de estudios Profesionales','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(5,'Direccion','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(6,'Docentes','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(7,'Recursos Humanos','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(8,'Escolares','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(9,'Gestion tecnologica y vinculacion','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(10,'Departamento de planeacion','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(11,'Administrador','web','2024-01-09 09:20:49','2024-01-09 09:20:49'),(12,'Secretarias CENIDET','web','2024-01-09 09:20:49','2024-01-09 09:20:49');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `sessions` VALUES ('7a47MCwHRkbfNfNfdT8JgZ8W2ZEBmDqVmijxLhru',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 OPR/105.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRlpjTU9uMEtVRnFvRkp1anlLNUV1U0pHOGZyZjJqWjgxUVVpUER3VSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRHVzhPTGJKdkIzb01rVTBodGVIYm51US81SFZXbGJFZmlMRzBsNjlrUlJONUhtVlEyS3YvTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9Sb2xlcz9wYWdlPTIiO319',1704780822),('soonV5viYLCX00MUzkt7iryNlPbJardD7YyNMKkO',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 OPR/105.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoieHJKNzZuM0JIOURDWE9wUTd5VjNSZU0xOGN2RUJiZm5QOVhmRDZ6diI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRHVzhPTGJKdkIzb01rVTBodGVIYm51US81SFZXbGJFZmlMRzBsNjlrUlJONUhtVlEyS3YvTyI7fQ==',1704770998);
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
  `Nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `Estatus` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'RecHum','rbeo201569@upemor.edu.mx','2024-01-09 09:20:49','$2y$10$bdJEMoKF3D/uGumtdRFQ7e62DSGZczL7jc1LF6bl9wewemguHasHK',NULL,NULL,NULL,1,'fj8mvODckE',NULL,NULL,'2024-01-09 09:20:49','2024-01-09 09:20:49'),(2,'Admin','erickrra11@gmail.com','2024-01-09 09:20:49','$2y$10$GW8OLbJvB3oMkU0hteHbnuQ/5HVWlbEfiLG0l69kRRN5HmVQ2Kv/O',NULL,NULL,NULL,1,'x7ON07bGD2dO54tyDyr5wi8qjUfKd3kpszCCUcBReqJbN6mJcYJCXfckQ1L6',NULL,NULL,'2024-01-09 09:20:49','2024-01-09 09:20:49'),(3,'AcadDA','erickrra11@gmail.com','2024-01-09 09:20:49','$2y$10$7zcdm7/92SDvIzYu76tQQeplK4YqtDhJqDy8iNCyh3lAuNHiX2JBa',NULL,NULL,NULL,1,'wU0tqUX18P',NULL,NULL,'2024-01-09 09:20:49','2024-01-09 09:20:49'),(4,'DEPI','erickrra11@gmail.com','2024-01-09 09:20:49','$2y$10$UIBceYOFXShbnm1UHYbys.xxuXdkOJdQnfmwvpGrCUob8POxCrWWy',NULL,NULL,NULL,1,'q1yLi9NiyV',NULL,NULL,'2024-01-09 09:20:49','2024-01-09 09:20:49'),(5,'HPlaneacion','erickrra11@gmail.com','2024-01-09 09:20:50','$2y$10$z3yX.q0S.AnlsJCurhWstOyBhIdfwES3R6UjXvp4dVq8VfB0xjBky',NULL,NULL,NULL,1,'VnuJskVECh',NULL,NULL,'2024-01-09 09:20:50','2024-01-09 09:20:50'),(7,'DepMaria',NULL,NULL,'$2y$10$H9JZszWfr2AVmLe0fXOyZuaNWNxz96c.HBZ4JuQjfGM0/ZeqasWee',NULL,NULL,NULL,1,NULL,NULL,NULL,'2024-01-09 12:08:42','2024-01-09 12:08:42'),(8,'DepAlan',NULL,NULL,'$2y$10$Yatr4BNgbaXVibcZyQJC0eIUhHP0W5rLadtKE09YRjRjdFBG1vv8u',NULL,NULL,NULL,1,NULL,NULL,NULL,'2024-01-09 12:09:09','2024-01-09 12:09:09');
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

-- Dump completed on 2024-01-09  0:13:46

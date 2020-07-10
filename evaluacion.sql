-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: evaluacion
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.19.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Políticas contenidos'),(3,'Políticas gobernanza'),(4,'Políticas preservación'),(5,'Formatos técnicos'),(6,'Plataforma SW'),(7,'Plataforma HW'),(8,'Posicionamiento y visibilidad'),(9,'Difusión y formación');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion` (
  `configuracion_id` int(11) NOT NULL AUTO_INCREMENT,
  `texto_encabezado` text NOT NULL,
  PRIMARY KEY (`configuracion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES (1,'Rúbrica para evaluaciones (porcentaje a evaluar de la calificación máxima indicada en la columna Max): Si no se ha contemplado -40%, si se está planificando -30%, si se está implementando con plan escrito 0%, sin plan escrito -15% / Si ya se implementó 15%, si ya está funcionado desde el año actual 50%, si lleva más de un año 80%, más de dos 100% (TODO DEBE SER DEMOSTRABLE).');
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pregunta` (
  `pregunta_id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(500) DEFAULT NULL,
  `orden` varchar(3) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `subcategoria_id` int(11) DEFAULT NULL,
  `max_num` int(11) NOT NULL,
  `ayuda` text,
  PRIMARY KEY (`pregunta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pregunta`
--

LOCK TABLES `pregunta` WRITE;
/*!40000 ALTER TABLE `pregunta` DISABLE KEYS */;
INSERT INTO `pregunta` VALUES (1,'¿Tiene una definición del tipo de contenido con el que se puede contar?','1',1,1,10,'<h1>Prueba</h1>\r\n<ul>\r\n<li>ok</li>\r\n</ul>'),(2,'Las definiciones se encuentran publicadas','2',1,1,10,'Prueba otra ves\r\n<ul>\r\n<li>demo</li>\r\n</ul>'),(3,'Se cuenta con política publicada de Integridad Académica','3',1,1,15,'<h1><strong>Ayuda</strong></h1>'),(4,'Se realizan revisiones antiplagio','4',1,1,10,NULL),(5,'Se cuenta con política publicada de autodepósito','5',1,1,20,NULL),(6,'El usuario autoriza la publicación en abierto','6',1,1,15,NULL),(7,'El usuario autoriza la transformación','7',1,1,10,NULL),(8,'El usuario selecciona libremente la licencia de su contenido','8',1,1,10,NULL),(9,'Porcentaje de documentos resultado de autodepósito en el año actual y anterior (rangos de 5 cada 20%)','1',1,2,20,NULL),(10,'El usuario autoriza la transformación','2',1,2,40,NULL),(12,'¿se cuenta con personal encargado, con roles, funciones, responsabilidades?','1',3,1,20,NULL),(13,'¿se cuenta con un presupuesto anual para la operación del RI?','2',3,1,20,NULL),(14,'¿está publicada la misión y objetivos del RI?','3',3,1,15,NULL),(15,'¿se cuenta con un programa de formación continua para el personal encargadado del RI?','4',3,1,10,NULL),(16,'¿se cuenta con un compromiso de transparencia y rendición de cuentas por parte de todas las personas y áreas involucradas en el RI?','5',3,1,20,NULL),(17,'¿existen políticas de transparencia con respecto a los recursos que consume el RI?','6',3,1,15,NULL),(18,'¿existe personal responsable de la preservación?','1',3,2,15,NULL),(19,'¿el personal cuenta con dominio de estándares?','2',3,2,20,NULL),(20,'¿existe personal técnico dedicado y responsable de la operación de la plataforma tecnológica?','3',3,2,30,NULL),(21,'¿el personal técnico cuenta con la experiencia y el tiempo para desarrollar funciones específicas?','4',3,2,35,NULL),(22,'¿el RI acepta abiertamente y de forma pública su responsabilidad de preservar los contenidos?','1',4,1,100,NULL),(23,'¿se cuenta con una política donde se notifique a los usuarios de que los  contenidos serán transformados?','1',4,2,25,NULL),(24,'¿se informa al usuario los estándares que se utilizan para preservación digital?','2',4,2,15,NULL),(25,'¿se tienen definidos los niveles que se cubrirán con respecto a la preservación digital?','3',4,2,30,NULL),(26,'¿se tiene definido el proceso para gestionar el inventario de recursos digitales, así como el proceso de revisiones de integridad del contenido?','4',4,2,30,NULL),(27,'¿se cuenta con capacidad de gestionar y visibilizar formatos abiertos?','1',5,1,35,NULL),(28,'¿se tiene definido el tipo de formatos abiertos a utilizar?','2',5,1,30,NULL),(29,'¿se cuenta con una especificación sobre los formatos técnicos aceptables en el repositorio?','3',5,1,20,NULL),(30,'¿se cuenta con una especificación para los materiales distintos a los documentos, por ejemplo, los sets de datos?','4',5,1,15,NULL),(31,'¿se cuenta con un plan de conversión o transformación desde formatos cerrados a formatos abiertos?','1',5,2,40,NULL),(32,'¿se cuenta con la documentación técnica que garantice el uso de formatos abiertos en el largo plazo?','2',5,2,30,NULL),(33,'¿se cuenta con una metodología para gestión los formatos técnicos distintos a los documentos?','3',5,2,30,NULL),(34,'¿se cuenta con un programa permanente de actualización?','1',6,1,20,NULL),(35,'¿Se cuenta con un plan de crecimiento de sw?','2',6,1,10,NULL),(36,'¿se cuenta con la documentación técnica necesaria para que el sistema sea administrado a futuro sin importar cambios en el personal?','3',6,1,15,NULL),(37,'¿se cuenta con un plan de trabajo para realizar desarrollos a la medida?','4',6,1,15,NULL),(38,'¿se cuenta con un control de versiones, actualizaciones?','5',6,1,10,NULL),(39,'¿el personal responsable del RI interactua y participa activamente en foros y grupos internacionales de desarrollo de la plataforma seleccionada?','6',6,1,30,NULL),(40,'¿se cuenta con acceso completo a la información, con metadatos, sin nigún tipo de restricción?','1',6,2,60,NULL),(41,'¿se realizan pruebas de seguridad informática y estrés a la plataforma?','2',6,2,40,NULL),(42,'¿se cuenta con un cálculo de requerimientos enfocado en la demanda del usuario y en el plan de crecimiento de HW?','1',7,1,30,NULL),(43,'¿se cuenta con un plan de crecimiento para el HW?','2',7,1,20,NULL),(44,'¿se cuenta con redundancia?','3',7,1,30,NULL),(45,'¿se tienen métricas de uso y dispoiniblidad del servicio en línea?','4',7,1,20,NULL),(46,'¿se realizan pruebas de seguridad informática?','1',7,2,30,NULL),(47,'¿se llevan a cabo procesos de respaldo acordes con una metodología conocida?','2',7,2,20,NULL),(48,'¿se cuenta con al menos tres copias de cada elemento, en ubicaciones físicas separadas, siento al menos una de estas, en otra ciudad?','3',7,2,50,NULL),(49,'¿el repositorio cuenta con un nombre identificable?','1',8,1,10,NULL),(50,'¿se cuenta con una URL propia?','2',8,1,15,NULL),(51,'¿se usan identificadores persistentes?','3',8,1,10,NULL),(52,'¿el repositorio se encuentra en índices o directorios especializados?','4',8,1,10,NULL),(53,'¿se cuenta con acuerdos con otras bibliotecas para intercambio de ligas o metadatos?','5',8,1,15,NULL),(54,'¿Se cubre con normas internacionales de interoperabilidad y cosecha con motores como Google Académico?','6',8,1,10,NULL),(55,'¿se cumple con estándares de inclusión y accesibilidad?','7',8,1,30,NULL),(56,'¿se utiliza completamente el esquema de metadatos de acuerdo con algún estándar?','1',8,2,40,NULL),(57,'¿el sistema utiliza protocolos como OAI o Sword?','2',8,2,60,NULL),(58,'¿se realizan campañas de difusión del RI hacia la comunidad externa?','1',9,1,25,NULL),(59,'¿se cuenta con métricas de estas campañas, así como con funciones que permitan rastrear los resultados traducidos en visitas y uso del RI?','2',9,1,35,NULL),(60,'¿se cuenta con programas de capacitación en Ciencia Abierta y Acceso Abierto?','3',9,1,10,NULL),(61,'¿Se cuenta con programas de capacitación en Propiedad Intelectual y uso de licencias CC?','4',9,1,10,NULL),(62,'¿se cuenta con programas de concientización y formación en temas de inclusión y accesibilidad?','5',9,1,20,NULL),(63,'¿se realizan campañas de sensiblización con respecto a la PD?','1',9,2,20,NULL),(64,'¿se cuenta con programas de capacitación en PD?','2',9,2,25,NULL),(65,'¿se cuenta con programas de formación y fomento al autodepósito?','3',9,2,35,NULL),(66,'¿se cuenta con programas de formación en XML, formatos abiertos y transformación de contenidos?','4',9,2,20,NULL),(68,'El usuario selecciona libremente la licencia de su contenido','3',1,2,40,NULL);
/*!40000 ALTER TABLE `pregunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respuesta`
--

DROP TABLE IF EXISTS `respuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `respuesta` (
  `respuesta_id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta_id` varchar(255) DEFAULT NULL,
  `real_num` int(3) DEFAULT NULL,
  `usuario_id` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`respuesta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subcategoria`
--

DROP TABLE IF EXISTS `subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategoria` (
  `subcategoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`subcategoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategoria`
--

LOCK TABLES `subcategoria` WRITE;
/*!40000 ALTER TABLE `subcategoria` DISABLE KEYS */;
INSERT INTO `subcategoria` VALUES (1,'ACCESIBILIDAD'),(2,'PRESERVACIÓN');
/*!40000 ALTER TABLE `subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `usuario` varchar(50) NOT NULL,
  `contra` varchar(255) DEFAULT NULL,
  `correo` varchar(80) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `contacto` varchar(500) DEFAULT NULL,
  `rol` varchar(30) NOT NULL,
  `login_session_key` varchar(255) DEFAULT NULL,
  `email_status` varchar(20) DEFAULT NULL,
  `password_reset_key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Administrador','admin','$2y$10$d9bRMvGF5aCWnaOQzff/nO80XVRZ8/A9jLRiJXVLNJZepGecLpBsq','usuario@correo.com','','','administrador',NULL,NULL,NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-17 18:57:58

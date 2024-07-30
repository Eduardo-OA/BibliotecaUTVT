/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.28-MariaDB : Database - uippe2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`uippe2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `uippe2`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tb_areas` */

DROP TABLE IF EXISTS `tb_areas`;

CREATE TABLE `tb_areas` (
  `id_area` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(30) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `activo` tinyint(1) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tb_areasmetas` */

DROP TABLE IF EXISTS `tb_areasmetas`;

CREATE TABLE `tb_areasmetas` (
  `id_areasmetas` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `area_id` bigint(20) unsigned NOT NULL,
  `meta_id` bigint(20) unsigned NOT NULL,
  `id_programa` bigint(20) unsigned NOT NULL,
  `objetivo` varchar(255) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_areasmetas`),
  KEY `tb_areasmetas_area_id_foreign` (`area_id`),
  KEY `tb_areasmetas_meta_id_foreign` (`meta_id`),
  KEY `tb_areasmetas_id_programa_foreign` (`id_programa`),
  CONSTRAINT `tb_areasmetas_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `tb_areas` (`id_area`),
  CONSTRAINT `tb_areasmetas_id_programa_foreign` FOREIGN KEY (`id_programa`) REFERENCES `tb_programas` (`id_programa`),
  CONSTRAINT `tb_areasmetas_meta_id_foreign` FOREIGN KEY (`meta_id`) REFERENCES `tb_metas` (`id_meta`)
) ENGINE=InnoDB AUTO_INCREMENT=266 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tb_areasusuarios` */

DROP TABLE IF EXISTS `tb_areasusuarios`;

CREATE TABLE `tb_areasusuarios` (
  `id_areasusuarios` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `area_id` bigint(20) unsigned NOT NULL,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `id_registro` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_areasusuarios`),
  KEY `tb_areasusuarios_area_id_foreign` (`area_id`),
  KEY `tb_areasusuarios_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `tb_areasusuarios_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `tb_areas` (`id_area`),
  CONSTRAINT `tb_areasusuarios_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tb_calendarizars` */

DROP TABLE IF EXISTS `tb_calendarizars`;

CREATE TABLE `tb_calendarizars` (
  `id_calendario` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `areameta_id` bigint(20) unsigned NOT NULL,
  `meses_id` bigint(20) unsigned NOT NULL,
  `id_registro` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_calendario`),
  KEY `tb_calendarizars_areameta_id_foreign` (`areameta_id`),
  KEY `tb_calendarizars_meses_id_foreign` (`meses_id`),
  CONSTRAINT `tb_calendarizars_areameta_id_foreign` FOREIGN KEY (`areameta_id`) REFERENCES `tb_areasmetas` (`id_areasmetas`),
  CONSTRAINT `tb_calendarizars_meses_id_foreign` FOREIGN KEY (`meses_id`) REFERENCES `tb_meses` (`id_meses`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tb_correo` */

DROP TABLE IF EXISTS `tb_correo`;

CREATE TABLE `tb_correo` (
  `id_correo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `destinatario` text NOT NULL,
  `asunto` text NOT NULL,
  `contenido` text NOT NULL,
  `remitente` text DEFAULT NULL,
  `fecha_envio` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tb_entregas` */

DROP TABLE IF EXISTS `tb_entregas`;

CREATE TABLE `tb_entregas` (
  `id_entregas` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `areameta_id` bigint(20) unsigned NOT NULL,
  `meses_id` bigint(20) unsigned NOT NULL,
  `id_registro` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_entregas`),
  KEY `tb_entregas_areameta_id_foreign` (`areameta_id`),
  KEY `tb_entregas_meses_id_foreign` (`meses_id`),
  CONSTRAINT `tb_entregas_areameta_id_foreign` FOREIGN KEY (`areameta_id`) REFERENCES `tb_areasmetas` (`id_areasmetas`),
  CONSTRAINT `tb_entregas_meses_id_foreign` FOREIGN KEY (`meses_id`) REFERENCES `tb_meses` (`id_meses`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tb_meses` */

DROP TABLE IF EXISTS `tb_meses`;

CREATE TABLE `tb_meses` (
  `id_meses` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `m_enero` int(11) NOT NULL,
  `m_febrero` int(11) NOT NULL,
  `m_marzo` int(11) NOT NULL,
  `m_abril` int(11) NOT NULL,
  `m_mayo` int(11) NOT NULL,
  `m_junio` int(11) NOT NULL,
  `m_julio` int(11) NOT NULL,
  `m_agosto` int(11) NOT NULL,
  `m_septiembre` int(11) NOT NULL,
  `m_octubre` int(11) NOT NULL,
  `m_noviembre` int(11) NOT NULL,
  `m_diciembre` int(11) NOT NULL,
  `m_cantidad` int(11) NOT NULL,
  `m_year` year(4) NOT NULL,
  `m_fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_meses`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tb_metas` */

DROP TABLE IF EXISTS `tb_metas`;

CREATE TABLE `tb_metas` (
  `id_meta` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(30) DEFAULT NULL,
  `nombre` text NOT NULL,
  `descripcion` text DEFAULT NULL,
  `unidadmedida` text DEFAULT NULL,
  `programa_id` bigint(20) unsigned NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_meta`),
  KEY `tb_metas_programa_id_foreign` (`programa_id`),
  CONSTRAINT `tb_metas_programa_id_foreign` FOREIGN KEY (`programa_id`) REFERENCES `tb_programas` (`id_programa`)
) ENGINE=InnoDB AUTO_INCREMENT=266 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tb_programas` */

DROP TABLE IF EXISTS `tb_programas`;

CREATE TABLE `tb_programas` (
  `id_programa` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `abreviatura` varchar(30) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `activo` tinyint(1) NOT NULL,
  `id_registro` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_programa`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tb_tipos` */

DROP TABLE IF EXISTS `tb_tipos`;

CREATE TABLE `tb_tipos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(30) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `activo` tinyint(1) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(30) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `app` varchar(50) NOT NULL,
  `apm` varchar(50) NOT NULL,
  `gen` varchar(15) NOT NULL,
  `fn` date NOT NULL,
  `academico` text NOT NULL,
  `foto` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `id_tipo` bigint(20) unsigned NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_id_tipo_foreign` (`id_tipo`),
  CONSTRAINT `users_id_tipo_foreign` FOREIGN KEY (`id_tipo`) REFERENCES `tb_tipos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

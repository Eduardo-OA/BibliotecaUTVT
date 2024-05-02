/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.28-MariaDB : Database - bibliotecautvt
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bibliotecautvt` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `bibliotecautvt`;

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

/*Data for the table `failed_jobs` */

/*Table structure for table `libros` */

INSERT  INTO `rentamaquinas`(`id`,`usuario_id`,`maquina_id`,`hora_inicio`,`hora_final`,`created_at`,`updated_at`) VALUES 
(1,2,2,'14:06:00','14:13:54','2024-03-15 14:06:59','2024-03-15 14:13:54'),
(2,1,2,'14:44:00','14:49:49','2024-04-09 14:44:25','2024-04-09 14:49:49'),
(3,1,1,'14:49:00','14:49:35','2024-04-10 14:49:00','2024-04-10 14:49:35'),
(4,9,3,'14:52:00','14:55:50','2024-04-11 14:52:34','2024-04-11 14:55:50'),
(5,9,1,'12:48:00','12:53:16','2024-04-24 12:48:54','2024-04-24 12:53:16'),
(6,6,15,'12:51:00','12:53:03','2024-04-17 12:51:48','2024-04-17 12:53:03'),
(7,44,2,'14:06:00','14:13:54','2024-03-16 14:06:59','2024-03-16 14:13:54'),
(8,13,2,'14:44:00','14:49:49','2024-04-08 14:44:25','2024-04-08 14:49:49'),
(9,16,1,'14:49:00','14:49:35','2024-04-09 14:49:00','2024-04-09 14:49:35'),
(10,64,3,'14:52:00','14:55:50','2024-04-09 14:52:34','2024-04-09 14:55:50'),
(11,29,1,'12:48:00','12:53:16','2024-04-18 12:48:54','2024-04-17 12:53:16'),
(12,46,15,'12:51:00','12:53:03','2024-04-20 12:51:48','2024-04-20 12:53:03'),
(13,43,2,'14:06:00','14:13:54','2024-03-17 14:06:59','2024-03-17 14:13:54'),
(14,12,2,'14:44:00','14:49:49','2024-04-23 14:44:25','2024-04-23 14:49:49'),
(15,11,1,'14:49:00','14:49:35','2024-04-09 14:49:00','2024-04-09 14:49:35'),
(16,9,3,'14:52:00','14:55:50','2024-04-09 14:52:34','2024-04-09 14:55:50'),
(17,19,1,'12:48:00','12:53:16','2024-04-28 12:48:54','2024-04-28 12:53:16'),
(18,6,15,'12:51:00','12:53:03','2024-04-14 12:51:48','2024-04-14 12:53:03');

DROP TABLE IF EXISTS `libros`;

CREATE TABLE `libros` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `autor_principal` varchar(255) NOT NULL,
  `autores` varchar(255) DEFAULT NULL,
  `genero` varchar(255) NOT NULL,
  `editorial` varchar(255) NOT NULL,
  `idioma` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `fechaadqui` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `libros` */

insert  into `libros`(`id`,`titulo`,`autor_principal`,`autores`,`genero`,`editorial`,`idioma`,`cantidad`,`disponibilidad`,`ubicacion`,`fechaadqui`,`created_at`,`updated_at`) values 
(1,'El nombre del viento','Patrick Rothfuss',NULL,'Fantasía','Plaza & Janés','Español',10,1,'A-1','2024-03-15','2024-03-15 12:48:41','2024-03-15 14:14:12');

/*Table structure for table `mantenimientomaquina` */

DROP TABLE IF EXISTS `mantenimientomaquina`;

CREATE TABLE `mantenimientomaquina` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `maquina_id` bigint(20) unsigned DEFAULT NULL,
  `detalle` text DEFAULT NULL,
  `id_maquina_eliminada` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mantenimientomaquina_maquina_id_foreign` (`maquina_id`),
  CONSTRAINT `mantenimientomaquina_maquina_id_foreign` FOREIGN KEY (`maquina_id`) REFERENCES `maquinas` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mantenimientomaquina` */

/*Table structure for table `maquinas` */

DROP TABLE IF EXISTS `maquinas`;

CREATE TABLE `maquinas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `alias` text NOT NULL,
  `estatus` text NOT NULL,
  `isla` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `maquinas` */

insert  into `maquinas`(`id`,`alias`,`estatus`,`isla`,`created_at`,`updated_at`) values 
(1,'MB-1','D',1,'2024-03-15 14:05:00','2024-04-17 12:53:16'),
(2,'MB-2','D',1,'2024-03-15 14:05:09','2024-04-09 14:49:49'),
(3,'MQ-12','D',1,'2024-04-09 14:51:49','2024-04-17 12:45:17'),
(4,'MQ-4','D',1,'2024-04-17 12:44:54','2024-04-17 12:44:54'),
(5,'MQ-5','D',1,'2024-04-17 12:45:32','2024-04-17 12:45:32'),
(6,'MQ-6','D',1,'2024-04-17 12:45:41','2024-04-17 12:45:41'),
(7,'MQ-7','D',1,'2024-04-17 12:45:50','2024-04-17 12:45:50'),
(8,'MQ-8','D',2,'2024-04-17 12:46:04','2024-04-17 12:46:04'),
(9,'MQ-9','D',2,'2024-04-17 12:46:15','2024-04-17 12:46:15'),
(10,'MQ-10','D',2,'2024-04-17 12:46:28','2024-04-17 12:46:28'),
(11,'MQ-11','D',2,'2024-04-17 12:46:48','2024-04-17 12:46:48'),
(12,'MQ-12','D',2,'2024-04-17 12:46:59','2024-04-17 12:46:59'),
(13,'MQ-13','D',2,'2024-04-17 12:47:05','2024-04-17 12:47:05'),
(14,'MQ-14','D',2,'2024-04-17 12:47:12','2024-04-17 12:47:12'),
(15,'MQ-15','D',3,'2024-04-17 12:47:19','2024-04-17 12:53:03');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_06_07_152938_create_roles_table',1),
(2,'2014_10_12_000000_create_users_table',1),
(3,'2014_10_12_100000_create_password_reset_tokens_table',1),
(4,'2019_08_19_000000_create_failed_jobs_table',1),
(5,'2019_12_14_000001_create_personal_access_tokens_table',1),
(6,'2024_01_30_013044_create_libros_table',1),
(7,'2024_01_30_013055_create_maquinas_table',1),
(8,'2024_01_30_013111_create_rentamaquinas_table',1),
(9,'2024_01_30_013125_create_prestamolibros_table',1),
(10,'2024_03_05_135333_mantenimientomaquina',1);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

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

/*Data for the table `personal_access_tokens` */

/*Table structure for table `prestamolibros` */

DROP TABLE IF EXISTS `prestamolibros`;

CREATE TABLE `prestamolibros` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `libros_id` bigint(20) unsigned NOT NULL,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `fecha_pres` date NOT NULL,
  `fecha_devo` date NOT NULL,
  `notas` varchar(255) NOT NULL,
  `status` enum('rentado','disponible') NOT NULL DEFAULT 'rentado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prestamolibros_libros_id_foreign` (`libros_id`),
  KEY `prestamolibros_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `prestamolibros_libros_id_foreign` FOREIGN KEY (`libros_id`) REFERENCES `libros` (`id`),
  CONSTRAINT `prestamolibros_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `prestamolibros` */

insert  into `prestamolibros`(`id`,`libros_id`,`usuario_id`,`fecha_pres`,`fecha_devo`,`notas`,`status`,`created_at`,`updated_at`) values 
(1,1,1,'2024-03-15','2024-03-16','Sin anotaciones','disponible','2024-03-15 14:13:49','2024-03-15 14:14:12');

/*Table structure for table `rentamaquinas` */

DROP TABLE IF EXISTS `rentamaquinas`;

CREATE TABLE `rentamaquinas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `maquina_id` bigint(20) unsigned NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_final` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rentamaquinas_usuario_id_foreign` (`usuario_id`),
  KEY `rentamaquinas_maquina_id_foreign` (`maquina_id`),
  CONSTRAINT `rentamaquinas_maquina_id_foreign` FOREIGN KEY (`maquina_id`) REFERENCES `maquinas` (`id`),
  CONSTRAINT `rentamaquinas_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `rentamaquinas` */

insert  into `rentamaquinas`(`id`,`usuario_id`,`maquina_id`,`hora_inicio`,`hora_final`,`created_at`,`updated_at`) values 
(1,4,2,'14:06:00','14:13:54','2024-03-15 14:06:59','2024-03-15 14:13:54'),
(2,1,2,'14:44:00','14:49:49','2024-04-09 14:44:25','2024-04-09 14:49:49'),
(3,1,1,'14:49:00','14:49:35','2024-04-09 14:49:00','2024-04-09 14:49:35'),
(4,9,3,'14:52:00','14:55:50','2024-04-09 14:52:34','2024-04-09 14:55:50'),
(5,9,1,'12:48:00','12:53:16','2024-04-17 12:48:54','2024-04-17 12:53:16'),
(6,6,15,'12:51:00','12:53:03','2024-04-17 12:51:48','2024-04-17 12:53:03');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'Administrador','2024-03-15 12:48:27','2024-03-15 12:48:27'),
(2,'Auxiliar Biblioteca','2024-03-15 12:48:27','2024-03-15 12:48:27'),
(3,'Estudiante','2024-03-15 12:48:27','2024-03-15 12:48:27');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `app` varchar(50) NOT NULL,
  `apm` varchar(50) NOT NULL,
  `carrera` varchar(255) DEFAULT NULL,
  `matricula` int(11) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `genero` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `rol_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_rol_id_foreign` (`rol_id`),
  CONSTRAINT `users_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`nombre`,`app`,`apm`,`carrera`,`matricula`,`direccion`,`genero`,`email`,`email_verified_at`,`password`,`remember_token`,`celular`,`rol_id`,`created_at`,`updated_at`) values 
(1,'Usuario 1','Apellido','Apellido','T.S.U Mantenimiento, Área industrial',436440,'Dirección de prueba','M','usuario1@biblioteca.com',NULL,'$2y$12$moBUKxQOZrgLTcvNF1qMt.NmsFv8HQnKnry8WWrOCIro9VzONuvJ.',NULL,NULL,3,'2024-03-15 12:48:27','2024-03-15 12:48:27'),
(2,'Usuario 2','Apellido','Apellido','T.S.U Mantenimiento, Área industrial',822333,'Dirección de prueba','M','usuario2@biblioteca.com',NULL,'$2y$12$GGiW/FrShqC6LcwB88TldOgXSOAHOldpSPyPP83elHqxJPvI88lU.',NULL,NULL,3,'2024-03-15 12:48:27','2024-03-15 12:48:27'),
(3,'Usuario 3','Apellido','Apellido','T.S.U Mantenimiento, Área industrial',751239,'Dirección de prueba','M','usuario3@biblioteca.com',NULL,'$2y$12$vm0wbh.KhJp8a9gOwW4xvuZFcWedyHGm9rTFN.eCp5VsuwK53Axq.',NULL,NULL,3,'2024-03-15 12:48:27','2024-03-15 12:48:27'),
(4,'Usuario 4','Apellido','Apellido','T.S.U Mecatrónica, Área Sistermas Manufactura Flexible.',531692,'Dirección de prueba','M','usuario4@biblioteca.com',NULL,'$2y$12$fFgpYjY1n0MKWLb.JC9qX.4KTMNbRE7XCUY//C6Q53mRlbFshtqAm',NULL,NULL,3,'2024-03-15 12:48:28','2024-03-15 12:48:28'),
(5,'Usuario 5','Apellido','Apellido','T.S.U Mecatrónica, Área Sistermas Manufactura Flexible.',238901,'Dirección de prueba','M','usuario5@biblioteca.com',NULL,'$2y$12$Xz19IPX58RSgy651uNdEy.NeSBF67QDPb3rJwVeOS112H.MxERRDa',NULL,NULL,3,'2024-03-15 12:48:28','2024-03-15 12:48:28'),
(6,'Usuario 6','Apellido','Apellido','T.S.U Mecatrónica, Área Sistermas Manufactura Flexible.',786000,'Dirección de prueba','M','usuario6@biblioteca.com',NULL,'$2y$12$IBMv4u0ixNyXcBZjgyjSLuY.j9anQjLt3hXerQ17XI7g5/KXt7M4C',NULL,NULL,3,'2024-03-15 12:48:28','2024-03-15 12:48:28'),
(7,'Usuario 7','Apellido','Apellido','T.S.U Tecnologías de la información, Área Desarrollo de Software Multiplataforma.',682537,'Dirección de prueba','M','usuario7@biblioteca.com',NULL,'$2y$12$kVxKeZwBcdHZJ2dC1yX/ZOFfD5GiL0OJrZWKKGyO..BFibZUSs6Oa',NULL,NULL,3,'2024-03-15 12:48:28','2024-03-15 12:48:28'),
(8,'Usuario 8','Apellido','Apellido','T.S.U Tecnologías de la información, Área Desarrollo de Software Multiplataforma.',941092,'Dirección de prueba','M','usuario8@biblioteca.com',NULL,'$2y$12$vyFJE1T7OkJ8Z78E0uUMROWKFjq/hAvb1q7IkkofdXhx9jHCc67ly',NULL,NULL,3,'2024-03-15 12:48:29','2024-03-15 12:48:29'),
(9,'Usuario 9','Apellido','Apellido','T.S.U Tecnologías de la información, Área Desarrollo de Software Multiplataforma.',974902,'Dirección de prueba','M','usuario9@biblioteca.com',NULL,'$2y$12$L2VGJWjA7ALZaG7HnPGbSOH999G1WX/lfiolfT9xWwmJXaHbs/bDC',NULL,NULL,3,'2024-03-15 12:48:29','2024-03-15 12:48:29'),
(10,'Usuario 10','Apellido','Apellido','T.S.U Tecnologías de la información, Área infraestructura de Redes Digitales.',548764,'Dirección de prueba','M','usuario10@biblioteca.com',NULL,'$2y$12$Byng2K5n9ocpG5.SURGWm.wtF9yfU15ro5HHnAG8BY8g26a3AqGlK',NULL,NULL,3,'2024-03-15 12:48:29','2024-03-15 12:48:29'),
(11,'Usuario 11','Apellido','Apellido','T.S.U Tecnologías de la información, Área infraestructura de Redes Digitales.',536520,'Dirección de prueba','M','usuario11@biblioteca.com',NULL,'$2y$12$N68fAi1Zo3d.yCXb8aM1.O2TyGijWXuPnal5ljrn6YUp.XH/KIVHS',NULL,NULL,3,'2024-03-15 12:48:29','2024-03-15 12:48:29'),
(12,'Usuario 12','Apellido','Apellido','T.S.U Tecnologías de la información, Área infraestructura de Redes Digitales.',384391,'Dirección de prueba','M','usuario12@biblioteca.com',NULL,'$2y$12$MHOtftAsjIEX7d2iCGdwjO/7cltsr0cdlVOsHoHJZ8CJ7Di27469S',NULL,NULL,3,'2024-03-15 12:48:30','2024-03-15 12:48:30'),
(13,'Usuario 13','Apellido','Apellido','T.S.U Procesos Industriales, Área Manufactura.',708280,'Dirección de prueba','M','usuario13@biblioteca.com',NULL,'$2y$12$81eqzHtfpHSLeVJ5bp5ale2ne6dicb9a8r/cPYUG5GCl.KrPde.Yu',NULL,NULL,3,'2024-03-15 12:48:30','2024-03-15 12:48:30'),
(14,'Usuario 14','Apellido','Apellido','T.S.U Procesos Industriales, Área Manufactura.',624630,'Dirección de prueba','M','usuario14@biblioteca.com',NULL,'$2y$12$CoTEVQNgQqh.68.a5wIKEO66YqUAW/EU5zdIpUpl8jbjFhk1NBVye',NULL,NULL,3,'2024-03-15 12:48:30','2024-03-15 12:48:30'),
(15,'Usuario 15','Apellido','Apellido','T.S.U Procesos Industriales, Área Manufactura.',822215,'Dirección de prueba','M','usuario15@biblioteca.com',NULL,'$2y$12$XAnss8uA0/zANfTSqG8J9ODB7A2FFaPyUHTCKcwqug0EBM4dKl9hK',NULL,NULL,3,'2024-03-15 12:48:30','2024-03-15 12:48:30'),
(16,'Usuario 16','Apellido','Apellido','T.S.U Química, Área Tecnología Ambiental.',839743,'Dirección de prueba','M','usuario16@biblioteca.com',NULL,'$2y$12$IS4auGFcGz.RggisqJT31eZuRgQ0PcskGNevVqir0WnZ8.YSe6LV.',NULL,NULL,3,'2024-03-15 12:48:31','2024-03-15 12:48:31'),
(17,'Usuario 17','Apellido','Apellido','T.S.U Química, Área Tecnología Ambiental.',492707,'Dirección de prueba','M','usuario17@biblioteca.com',NULL,'$2y$12$0Q3W8HWQZmBTp9.zldCMQeeqb2Sa2RiTl9DXLRrZwD46rVFB/EWmm',NULL,NULL,3,'2024-03-15 12:48:31','2024-03-15 12:48:31'),
(18,'Usuario 18','Apellido','Apellido','T.S.U Química, Área Tecnología Ambiental.',502614,'Dirección de prueba','M','usuario18@biblioteca.com',NULL,'$2y$12$p9mjWECMeOhWCcK9WzNgsuB8d/LfLICRkrvfSTBq7d9Wq/6tkL.Ry',NULL,NULL,3,'2024-03-15 12:48:31','2024-03-15 12:48:31'),
(19,'Usuario 19','Apellido','Apellido','T.S.U Paramédico.',825290,'Dirección de prueba','M','usuario19@biblioteca.com',NULL,'$2y$12$W1jzdp0ei.B5KJWkidqh0OvpOvlSTS46FK4zFEuXS6TubYOCThMEW',NULL,NULL,3,'2024-03-15 12:48:31','2024-03-15 12:48:31'),
(20,'Usuario 20','Apellido','Apellido','T.S.U Paramédico.',395789,'Dirección de prueba','M','usuario20@biblioteca.com',NULL,'$2y$12$3lG5HmD/CqmAUekme1vntevrzP1fsTahFLZu8dHb0RFizgkhyWeeC',NULL,NULL,3,'2024-03-15 12:48:31','2024-03-15 12:48:31'),
(21,'Usuario 21','Apellido','Apellido','T.S.U Paramédico.',453058,'Dirección de prueba','M','usuario21@biblioteca.com',NULL,'$2y$12$3en3P/rKoXA6teR7VNGYSuObe2Coq6VqTtisad13cSFXcPqcQe.D6',NULL,NULL,3,'2024-03-15 12:48:32','2024-03-15 12:48:32'),
(22,'Usuario 22','Apellido','Apellido','T.S.U Desarrollo de Negocios, Área Ventas.',276702,'Dirección de prueba','M','usuario22@biblioteca.com',NULL,'$2y$12$ud4AissSdch6Ub9La4UjTeGqzUwV9MYQ5.f0k7NYiDBPBW78lj6eK',NULL,NULL,3,'2024-03-15 12:48:32','2024-03-15 12:48:32'),
(23,'Usuario 23','Apellido','Apellido','T.S.U Desarrollo de Negocios, Área Ventas.',462029,'Dirección de prueba','M','usuario23@biblioteca.com',NULL,'$2y$12$3TyPdk/wcTVHrbk9XULEseVoVjEou/my.uOcaTuSKUg4ILGLuCFHi',NULL,NULL,3,'2024-03-15 12:48:32','2024-03-15 12:48:32'),
(24,'Usuario 24','Apellido','Apellido','T.S.U Desarrollo de Negocios, Área Ventas.',916886,'Dirección de prueba','M','usuario24@biblioteca.com',NULL,'$2y$12$8hAH68I78loew5J/zJysUeH.hjrnvkF1S7a.8FCRRiMh2z1iBewyi',NULL,NULL,3,'2024-03-15 12:48:32','2024-03-15 12:48:32'),
(25,'Usuario 25','Apellido','Apellido','T.S.U Desarrollo de Negocios, Área Mercadotecnica.',919373,'Dirección de prueba','M','usuario25@biblioteca.com',NULL,'$2y$12$21lNkGDm/9pXkkrEAo6sJuNTUicGm4bxfE8DuMJfJanyh8OHE0JTW',NULL,NULL,3,'2024-03-15 12:48:33','2024-03-15 12:48:33'),
(26,'Usuario 26','Apellido','Apellido','T.S.U Desarrollo de Negocios, Área Mercadotecnica.',695182,'Dirección de prueba','M','usuario26@biblioteca.com',NULL,'$2y$12$WrT6Lcw0SdDY38eXEWV7y.w.FHAnW4bc62pVpVWYwn4IojWpdhrsi',NULL,NULL,3,'2024-03-15 12:48:33','2024-03-15 12:48:33'),
(27,'Usuario 27','Apellido','Apellido','T.S.U Desarrollo de Negocios, Área Mercadotecnica.',210009,'Dirección de prueba','M','usuario27@biblioteca.com',NULL,'$2y$12$0gz8CmiNpBUGGBzFdq3BO.xwE6h0lu3vNPKgZrpK84XZ6SeEzd7uy',NULL,NULL,3,'2024-03-15 12:48:33','2024-03-15 12:48:33'),
(28,'Usuario 28','Apellido','Apellido','ING. Mantenimiento Industrial.',964099,'Dirección de prueba','M','usuario28@biblioteca.com',NULL,'$2y$12$RfPoE2o2vBb/2PKGRB2ii.4qf3EXttOYDrNBmBf0AMAyG9Qcoo4/a',NULL,NULL,3,'2024-03-15 12:48:34','2024-03-15 12:48:34'),
(29,'Usuario 29','Apellido','Apellido','ING. Mantenimiento Industrial.',238235,'Dirección de prueba','M','usuario29@biblioteca.com',NULL,'$2y$12$.z6FvVlY5F.1V.qFW1ImDO314clJvtwDoRmiFmkQiAOqQuo9PGIKy',NULL,NULL,3,'2024-03-15 12:48:34','2024-03-15 12:48:34'),
(30,'Usuario 30','Apellido','Apellido','ING. Mantenimiento Industrial.',558746,'Dirección de prueba','M','usuario30@biblioteca.com',NULL,'$2y$12$9EvJTmbAoLb6rMUaI90DEu2/FELQig.LDOAsSPEHMbBKOfdMgByh2',NULL,NULL,3,'2024-03-15 12:48:34','2024-03-15 12:48:34'),
(31,'Usuario 31','Apellido','Apellido','ING. Mecatrónica',748881,'Dirección de prueba','M','usuario31@biblioteca.com',NULL,'$2y$12$GC9Do/rwPuAJQaqK4f4M9ugIqNrW6KIrs5M6i41KJBa9jAD9UcSeK',NULL,NULL,3,'2024-03-15 12:48:34','2024-03-15 12:48:34'),
(32,'Usuario 32','Apellido','Apellido','ING. Mecatrónica',960539,'Dirección de prueba','M','usuario32@biblioteca.com',NULL,'$2y$12$vY9TSI6KstXkX3tEkByGxu1W3R/sKUqBJD6Qos6b0YDS.ZoKzcN/S',NULL,NULL,3,'2024-03-15 12:48:35','2024-03-15 12:48:35'),
(33,'Usuario 33','Apellido','Apellido','ING. Mecatrónica',151821,'Dirección de prueba','M','usuario33@biblioteca.com',NULL,'$2y$12$ppmzBRKFQGpXeMyyhZlnBehmGyz5E4krxtbRNdDdceRufkg4jtBP6',NULL,NULL,3,'2024-03-15 12:48:35','2024-03-15 12:48:35'),
(34,'Usuario 34','Apellido','Apellido','ING. Desarrollo y Gestión de Software.',207600,'Dirección de prueba','M','usuario34@biblioteca.com',NULL,'$2y$12$1CiQgfBY8LP6FBxA.92glOlFu3eEqw5yRK3IeSLrDSefaPOhwQghW',NULL,NULL,3,'2024-03-15 12:48:35','2024-03-15 12:48:35'),
(35,'Usuario 35','Apellido','Apellido','ING. Desarrollo y Gestión de Software.',811236,'Dirección de prueba','M','usuario35@biblioteca.com',NULL,'$2y$12$IDsBPYyRlCIAL4dQ2ohxeuFhnsB5tWJBZb9h1maM39j9Z0n2zh5ti',NULL,NULL,3,'2024-03-15 12:48:35','2024-03-15 12:48:35'),
(36,'Usuario 36','Apellido','Apellido','ING. Desarrollo y Gestión de Software.',174203,'Dirección de prueba','M','usuario36@biblioteca.com',NULL,'$2y$12$VFsmFPpKbtaZframb5jNuOOow55kCJ8zGlvYa4i2vVfZjfImjd5my',NULL,NULL,3,'2024-03-15 12:48:36','2024-03-15 12:48:36'),
(37,'Usuario 37','Apellido','Apellido','ING. Redes Inteligentes y Ciberseguridad',472465,'Dirección de prueba','M','usuario37@biblioteca.com',NULL,'$2y$12$9q98pltKDxOlGb3fJClRWO9Ufh9WCjVnj2o6WqQRkE4Rs/MRgp62G',NULL,NULL,3,'2024-03-15 12:48:36','2024-03-15 12:48:36'),
(38,'Usuario 38','Apellido','Apellido','ING. Redes Inteligentes y Ciberseguridad',527910,'Dirección de prueba','M','usuario38@biblioteca.com',NULL,'$2y$12$EnZ8OwdDUu1QT7MBuxm5he6E0YK6cdLpN2AXZP0RpixO3V.zDqjES',NULL,NULL,3,'2024-03-15 12:48:36','2024-03-15 12:48:36'),
(39,'Usuario 39','Apellido','Apellido','ING. Redes Inteligentes y Ciberseguridad',563344,'Dirección de prueba','M','usuario39@biblioteca.com',NULL,'$2y$12$xkdYBxqnRt9MsIeIIEUgcuh9CCXR2kn25BsGnEN.ZjHh2wf9KZfrO',NULL,NULL,3,'2024-03-15 12:48:36','2024-03-15 12:48:36'),
(40,'Usuario 40','Apellido','Apellido','ING. Sistemas Productivos.',302276,'Dirección de prueba','M','usuario40@biblioteca.com',NULL,'$2y$12$/RkYs.mj7hvU.58Nzzz2zuAgSK8Jjdwq91Yig1RFtrkleoUztskMq',NULL,NULL,3,'2024-03-15 12:48:37','2024-03-15 12:48:37'),
(41,'Usuario 41','Apellido','Apellido','ING. Sistemas Productivos.',343004,'Dirección de prueba','M','usuario41@biblioteca.com',NULL,'$2y$12$CpjBZJkSgzqXUy2VLEH8oueJRCWCUFW4MkPV92XW7uYWV9Zzxn6eu',NULL,NULL,3,'2024-03-15 12:48:37','2024-03-15 12:48:37'),
(42,'Usuario 42','Apellido','Apellido','ING. Sistemas Productivos.',148837,'Dirección de prueba','M','usuario42@biblioteca.com',NULL,'$2y$12$A7P34gmJgTv6GPuF5LfYDeJOFwIHc5mUHnsoippp.1ik6ocp2te36',NULL,NULL,3,'2024-03-15 12:48:37','2024-03-15 12:48:37'),
(43,'Usuario 43','Apellido','Apellido','ING. Tecnología Ambiental.',339251,'Dirección de prueba','M','usuario43@biblioteca.com',NULL,'$2y$12$C/QVFQKaD.yRG8rDhqjSNO1aYhjQm.dWO.VwlbAamOAqBfuMw/AWy',NULL,NULL,3,'2024-03-15 12:48:37','2024-03-15 12:48:37'),
(44,'Usuario 44','Apellido','Apellido','ING. Tecnología Ambiental.',831456,'Dirección de prueba','M','usuario44@biblioteca.com',NULL,'$2y$12$RDv1xtlI/ujiZGYlbtd9LuPeygO80Sv356GYShDHBOWRsm/IsAFKm',NULL,NULL,3,'2024-03-15 12:48:38','2024-03-15 12:48:38'),
(45,'Usuario 45','Apellido','Apellido','ING. Tecnología Ambiental.',824279,'Dirección de prueba','M','usuario45@biblioteca.com',NULL,'$2y$12$EZpY/TnkQ7ZqkCiYOGSw8uuGOB/6McNjlhbfUHXry4mDTJQUDlnTW',NULL,NULL,3,'2024-03-15 12:48:38','2024-03-15 12:48:38'),
(46,'Usuario 46','Apellido','Apellido','LIC. Protección Civil y Emergencias.',275863,'Dirección de prueba','M','usuario46@biblioteca.com',NULL,'$2y$12$o5Xw2PzcU8N8xmirPXDISu1iZdENAAyYPSTukhz0n0B7Zip7DdOze',NULL,NULL,3,'2024-03-15 12:48:38','2024-03-15 12:48:38'),
(47,'Usuario 47','Apellido','Apellido','LIC. Protección Civil y Emergencias.',826569,'Dirección de prueba','M','usuario47@biblioteca.com',NULL,'$2y$12$GsuLx/jIVm2.65.Iy5pn3.97HYGtyNmTa3DS9Cxej.nnvz4jUJmOG',NULL,NULL,3,'2024-03-15 12:48:38','2024-03-15 12:48:38'),
(48,'Usuario 48','Apellido','Apellido','LIC. Protección Civil y Emergencias.',316623,'Dirección de prueba','M','usuario48@biblioteca.com',NULL,'$2y$12$3GLO03lQQGIJtHGQuIaIK.ixcao/aBJAwu64W8KY2b3XSJ1kGLSmS',NULL,NULL,3,'2024-03-15 12:48:39','2024-03-15 12:48:39'),
(49,'Usuario 49','Apellido','Apellido','LIC. Innovación de Negocios y Mercadotecnica.',577273,'Dirección de prueba','M','usuario49@biblioteca.com',NULL,'$2y$12$S6zCSGUiG0D9ADAK1DOjOuGWWG3jbHcjCmN7gHuhMYeVQdDcqoHBW',NULL,NULL,3,'2024-03-15 12:48:39','2024-03-15 12:48:39'),
(50,'Usuario 50','Apellido','Apellido','LIC. Innovación de Negocios y Mercadotecnica.',926813,'Dirección de prueba','M','usuario50@biblioteca.com',NULL,'$2y$12$.rxioeFObne2jjKYEejyoOdvuydO.0JyKCZcIJ1UQKzSPbX8FS.rS',NULL,NULL,3,'2024-03-15 12:48:39','2024-03-15 12:48:39'),
(51,'Usuario 51','Apellido','Apellido','LIC. Innovación de Negocios y Mercadotecnica.',143980,'Dirección de prueba','M','usuario51@biblioteca.com',NULL,'$2y$12$64v9kW3bBbrRRGviM/LZlO.NaRjO8m1dvs9GcofyCbd55dDMOaq.C',NULL,NULL,3,'2024-03-15 12:48:39','2024-03-15 12:48:39'),
(52,'Usuario 52','Apellido','Apellido','LIC. Enfermería',218556,'Dirección de prueba','M','usuario52@biblioteca.com',NULL,'$2y$12$nMP5SMSztSdyxlFKfg2j5OfdH3CFOjCf5tzXOIntbvhODeqMkNx/W',NULL,NULL,3,'2024-03-15 12:48:40','2024-03-15 12:48:40'),
(53,'Usuario 53','Apellido','Apellido','LIC. Enfermería',273995,'Dirección de prueba','M','usuario53@biblioteca.com',NULL,'$2y$12$EGzpfOF9a2ZcTicFYl0VAOBJafKYllYEmpsqvBJEihjFGc4YAjvN.',NULL,NULL,3,'2024-03-15 12:48:40','2024-03-15 12:48:40'),
(54,'Usuario 54','Apellido','Apellido','LIC. Enfermería',190322,'Dirección de prueba','M','usuario54@biblioteca.com',NULL,'$2y$12$HVKuIC3gK7kFHSDMcJivJuwW.FTn9WqAZLEeDAcDX5dxMY1/Zv9SO',NULL,NULL,3,'2024-03-15 12:48:40','2024-03-15 12:48:40'),
(55,'Administrador','','','UTVT',123456,'Lerma México','M','admin@biblioteca.com',NULL,'$2y$12$ExNWdiJLAaBbmgID6dTkLepNOqsHoCLexxtthr7ELXz3dG9fTZGvi',NULL,NULL,1,'2024-03-15 12:48:40','2024-03-15 12:48:40'),
(56,'Auxiliar','-','Biblioteca',NULL,NULL,NULL,'M','auxiliar@biblioteca.com',NULL,'$2y$12$omdSazpRWkci0ZKM61QHTOc9AQhG52uNwR0lNZJdsmhRfKKFKBdgW',NULL,NULL,2,'2024-03-15 12:48:41','2024-03-15 12:48:41'),
(57,'Miguel Emanuel','Arriola','Ortega','UTVT',123456,'Xonacatlan, Edo. de México','H','mike@biblioteca.com',NULL,'$2y$12$ZtsEiyhaqvHuYgCV79cQGeitWk5dADRv3gIUHiPaji54IP4Lno15S',NULL,NULL,3,'2024-03-15 12:48:41','2024-03-15 12:48:41'),
(58,'Jimena','Diaz','de los Santos','UTVT',123456,'Xonacatlan, Edo. de México','H','jime@biblioteca.com',NULL,'$2y$12$tP2LHkWffcS1HgkUSplwBuzQOrU12bvEHkKX2EgvRN/qg1xex98QS',NULL,NULL,3,'2024-03-15 12:48:41','2024-03-15 12:48:41');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

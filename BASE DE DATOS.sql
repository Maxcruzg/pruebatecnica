-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.27-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para courses
CREATE DATABASE IF NOT EXISTS `courses` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `courses`;

-- Volcando estructura para tabla courses.courses
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla courses.courses: ~3 rows (aproximadamente)
INSERT INTO `courses` (`id`, `name`, `description`, `start_date`, `end_date`, `created`, `modified`, `is_active`) VALUES
	(5, 'carpinteria', 'El curso consta con varios dias de trabajo', '1976-10-06', '1994-10-12', '2025-01-16 14:46:28', '2025-01-16 18:01:37', 1),
	(24, 'Curso de mecánica', 'Curso donde aprenderas a desarrollar todos tus dotes para el futuro', '2025-01-25', '2025-01-28', '2025-01-16 15:26:56', '2025-01-16 15:26:56', 1),
	(25, 'Curso de programaciónes', 'Bootcamp de 1 año', '2025-01-18', '2030-09-10', '2025-01-16 15:30:37', '2025-01-16 16:14:02', 1);

-- Volcando estructura para tabla courses.phinxlog
CREATE TABLE IF NOT EXISTS `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla courses.phinxlog: ~6 rows (aproximadamente)
INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
	(20250114183215, 'CreateTableRoles', '2025-01-14 21:38:25', '2025-01-14 21:38:25', 0),
	(20250114183218, 'CreateTableUsers', '2025-01-14 21:38:25', '2025-01-14 21:38:25', 0),
	(20250114183222, 'CreateTableCourses', '2025-01-14 21:38:25', '2025-01-14 21:38:25', 0),
	(20250115005959, 'CreateTableUsersCourses', '2025-01-15 04:04:27', '2025-01-15 04:04:27', 0),
	(20250115010455, 'AlterTableCourses', '2025-01-15 17:12:39', '2025-01-15 17:12:40', 0),
	(20250115140857, 'AlterTableUsers', '2025-01-15 17:12:50', '2025-01-15 17:12:50', 0);

-- Volcando estructura para tabla courses.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla courses.roles: ~2 rows (aproximadamente)
INSERT INTO `roles` (`id`, `name`, `created`, `modified`) VALUES
	(1, 'Administrador', '2025-01-14 18:50:34', '2025-01-14 18:50:34'),
	(2, 'Usuario', '2025-01-14 18:50:34', '2025-01-14 18:50:34');

-- Volcando estructura para tabla courses.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lastname` text NOT NULL,
  `rut` varchar(12) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_id` (`roles_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla courses.users: ~6 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `lastname`, `rut`, `email`, `password`, `roles_id`, `is_active`, `created`, `modified`) VALUES
	(10, 'Maximiliano', 'Perez', '198825182', 'maximilianoc618@gmail.com', '$2y$10$0T4OjfKGeGnGBwjGEY1uiuhQWKRTBKI15sUnxe4sHE0L1SxlvV.Tm', 2, 1, '2025-01-14 20:22:47', '2025-01-15 14:39:43'),
	(11, 'Jose', 'Henriquez', '201232321', 'j.henriquez@gmail.com', '$2y$10$09dTGeY7UMTFifRkMmixjePXU8e/BBzR5fJhcwk8MkT235XNkGfrW', 1, 1, '2025-01-14 21:04:29', '2025-01-17 21:29:52'),
	(12, 'Pedro', 'Rodriguez', '187652431', 'pedro.navaja@gmail.com', '$2y$10$R8YA0EUWGbAYf8FCRFBMbe3NP25hMXqtQJnEfwu6FWTj1FbTxk9TG', 2, 0, '2025-01-14 22:19:04', '2025-01-16 13:38:05'),
	(14, 'maximiliano', 'cruz', '189653452', 'enrique@gmail.com', '$2y$10$T8GPlTcG7JVTOlTxk82nA..hI.dvQGihfUGsRScpj/KUbDf.M2HMK', 2, 1, '2025-01-17 20:36:31', '2025-01-17 20:36:31'),
	(16, 'Maximilianoc', 'Cruz', '198815182', 'maximilianoc6182@gmail.com', '$2y$10$sGxII1ifp9.cGfai61qPFO83BxGloCSzLh3RrS7SWMxw.LaA9eidq', 1, 1, '2025-01-17 21:15:19', '2025-01-17 21:15:19'),
	(17, 'admin', 'Admin', '253452331', 'admin@admin.cl', '$2y$10$0.llap6lPnFhWR5TBbfy9euhqyBS1PLBaVM/IEQ7SaiJlrjPXTPiW', 1, 1, '2025-01-17 21:27:17', '2025-01-17 21:27:17');

-- Volcando estructura para tabla courses.user_courses
CREATE TABLE IF NOT EXISTS `user_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `user_courses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `user_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla courses.user_courses: ~7 rows (aproximadamente)
INSERT INTO `user_courses` (`id`, `user_id`, `course_id`, `created`, `modified`) VALUES
	(11, 12, 25, '2025-01-16 15:32:57', '2025-01-16 15:32:57'),
	(12, 10, 25, '2025-01-16 15:33:00', '2025-01-16 15:33:00'),
	(13, 12, 5, '2025-01-16 18:30:23', '2025-01-16 18:30:23'),
	(14, 10, 5, '2025-01-17 02:52:35', '2025-01-17 02:52:35'),
	(15, 11, 5, '2025-01-17 21:39:33', '2025-01-17 21:39:33'),
	(16, 11, 5, '2025-01-17 21:39:34', '2025-01-17 21:39:34'),
	(17, 14, 5, '2025-01-17 22:27:12', '2025-01-17 22:27:12');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

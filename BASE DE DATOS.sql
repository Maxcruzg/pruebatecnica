


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
	(5, 'carpinteria', 'El curso consta con varios dias de trabajo', '2025-01-18', '2026-01-17', '2025-01-16 14:46:28', '2025-01-19 23:07:46', 1),
	(25, 'Curso de programación', 'Bootcamp de 1 año', '2025-01-18', '2030-09-10', '2025-01-16 15:30:37', '2025-01-20 02:00:09', 1);

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
	(17, 'admin', 'Admin', '253452331', 'admin@admin.cl', '$2y$10$0.llap6lPnFhWR5TBbfy9euhqyBS1PLBaVM/IEQ7SaiJlrjPXTPiW', 1, 1, '2025-01-17 21:27:17', '2025-01-17 21:27:17'),
	(18, 'maximiliano', 'cruz', '182653221', 'maximilianoc@gmail.com', '$2y$10$yhHn5FOyZjXasgcBrTdEgeAvhXe3AZIdnpwgXjKIt63vTDHQb2Vo6', 2, 1, '2025-01-20 01:54:40', '2025-01-20 01:54:40'),
	(19, 'juan', 'henriquez', '201234567', 'j.henriquez@gmail.com', '$2y$10$Xq8shTeEFiv5mJF7.d.v8ejXS.aZ4xeQKu33xgIF2m4kqcBBnUZea', 2, 1, '2025-01-20 01:55:30', '2025-01-20 01:55:30'),
	(20, 'prueba', 'Prueba', '222222222', 'pruebas@gmail.com', '$2y$10$qcGgEHc4S4SnhOEmISuxH.5gkgxbndA7sC4Cp21E.VZ.wQa9IIsN2', 2, 0, '2025-01-20 01:55:55', '2025-01-20 02:11:48'),
	(21, 'usuario', 'PRUEBA', '111111111', 'usuarioprueba@gmail.com', '$2y$10$46imYWh/WdBHLzCfmzKPreS6mPw.4tIKbUApF68q1PdRxIaoMLKBa', 2, 1, '2025-01-20 01:57:52', '2025-01-20 01:57:52'),
	(22, 'prueba', 'prueba', '333333332', 'pruebaprueba@gmail.com', '$2y$10$d0905k/RszFRv8OSGSXelueKoO7KUPVtAQ6PK1rGPTzSKsleS7oha', 2, 1, '2025-01-20 01:58:40', '2025-01-20 01:58:40');

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

-- Volcando datos para la tabla courses.user_courses: ~3 rows (aproximadamente)
INSERT INTO `user_courses` (`id`, `user_id`, `course_id`, `created`, `modified`) VALUES
	(18, 18, 5, '2025-01-20 02:00:21', '2025-01-20 02:00:21'),
	(19, 21, 5, '2025-01-20 02:00:25', '2025-01-20 02:00:25'),
	(20, 22, 5, '2025-01-20 02:03:43', '2025-01-20 02:03:43'),
	(21, 21, 25, '2025-01-20 02:09:14', '2025-01-20 02:09:14');



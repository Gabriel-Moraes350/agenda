-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.28-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para agenda
CREATE DATABASE IF NOT EXISTS `agenda` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `agenda`;

-- Copiando estrutura para tabela agenda.access_level
CREATE TABLE IF NOT EXISTS `access_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `access_level` enum('master','analyst') COLLATE utf8_bin NOT NULL DEFAULT 'master',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela agenda.access_level: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `access_level` DISABLE KEYS */;
INSERT INTO `access_level` (`id`, `access_level`) VALUES
	(1, 'master'),
	(2, 'analyst');
/*!40000 ALTER TABLE `access_level` ENABLE KEYS */;

-- Copiando estrutura para tabela agenda.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `password` varchar(255) NOT NULL,
  `access_level` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_access_level` (`access_level`),
  CONSTRAINT `fk_access_level` FOREIGN KEY (`access_level`) REFERENCES `access_level` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela agenda.admin: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `name`, `login`, `active`, `password`, `access_level`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Administrador', 'admin@gmail.com', 'yes', '$2y$10$PENOf0GTv/u4Ph70Y7ft6.NthwntlkGm3Y1XEA2apULTpyIC6bwdu', 1, '2018-06-19 01:40:36', '2018-06-19 01:40:40', NULL);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Copiando estrutura para tabela agenda.admin_token
CREATE TABLE IF NOT EXISTS `admin_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) COLLATE utf8_bin NOT NULL,
  `admin_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_token_admin` (`admin_id`),
  CONSTRAINT `fk_token_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela agenda.admin_token: ~45 rows (aproximadamente)
/*!40000 ALTER TABLE `admin_token` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_token` ENABLE KEYS */;

-- Copiando estrutura para tabela agenda.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text,
  `info` text,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela agenda.user: ~30 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Copiando estrutura para tabela agenda.user_phone
CREATE TABLE IF NOT EXISTS `user_phone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_up_user` (`user_id`),
  CONSTRAINT `fk_up_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela agenda.user_phone: ~79 rows (aproximadamente)
/*!40000 ALTER TABLE `user_phone` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_phone` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

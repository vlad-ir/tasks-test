﻿--
-- Script was generated by Devart dbForge Studio 2020 for MySQL, Version 9.0.791.0
-- Product home page: http://www.devart.com/dbforge/mysql/studio
-- Script date 07.05.2022 20:59:37
-- Server version: 8.0.19
-- Client version: 4.1
--

-- 
-- Disable foreign keys
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Set SQL mode
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

DROP DATABASE IF EXISTS tasks_test;

CREATE DATABASE IF NOT EXISTS tasks_test
	CHARACTER SET utf8mb4
	COLLATE utf8mb4_0900_ai_ci;

--
-- Set default database
--
USE tasks_test;

--
-- Create table `users`
--
CREATE TABLE IF NOT EXISTS users (
  id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL,
  is_admin TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_0900_ai_ci;

--
-- Create index `username` on table `users`
--
ALTER TABLE users 
  ADD UNIQUE INDEX username(username);

--
-- Create table `tasks`
--
CREATE TABLE IF NOT EXISTS tasks (
  id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(100) NOT NULL,
  email VARCHAR(255) NOT NULL,
  text TEXT NOT NULL,
  status TINYINT(1) DEFAULT NULL,
  text_edited TINYINT(1) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_0900_ai_ci;

-- 
-- Dumping data for table users
--
INSERT INTO users VALUES
(1, 'admin', '$2y$10$gxiTGC5ZiP2N/NWYLLzGh.KYE4fHj0cA9y.9DR1dVC/I0QycQlzsK', 1);

-- 
-- Dumping data for table tasks
--
INSERT INTO tasks VALUES
(1, 'user1', 'user_1@example.com', 'Текст примера', NULL, NULL),
(2, 'user_2', 'user_2@example.com', 'Это отредактированный текст', NULL, 1),
(3, 'user_3', 'user_3@example.com', 'Еще один текст для примера', NULL, NULL),
(4, 'user_3', 'user_3@example.com', 'Длинный текст для объемной задачи, которую только можно придумать.', NULL, NULL),
(5, 'user_4', 'user_4@example.com', 'Этот текст тоже редактировали', NULL, 1),
(6, 'user_5', 'user_5@example.com', 'Редактировали', 1, 1),
(7, 'user_4', 'user_4@example.com', 'Задача выполнена', 1, NULL),
(8, 'пользователь', 'user@user.com', 'Добавляем задачу через форму', NULL, NULL),
(9, 'asdasdasd', 'user@user.com', 'asdasd', NULL, NULL),
(10, 'sdfg', 'admin@mediacity.co.in', 'sfdsgdfg', NULL, NULL);

-- 
-- Restore previous SQL mode
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Enable foreign keys
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
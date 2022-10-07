-- set database info
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- create user login table
CREATE TABLE `users` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);
-- create admin table
CREATE TABLE `admin` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- create inv table
CREATE TABLE `items` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `item` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `s_n` varchar(255) NOT NULL UNIQUE,
  `desc` varchar(255) NOT NULL,
  `added_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active | 0=Inactive'
);
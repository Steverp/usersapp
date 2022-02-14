CREATE DATABASE usersapp2 /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE usersapp;

CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_document` int NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(120) NOT NULL,
  `user_country` varchar(30) NOT NULL,
  `user_password` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_document` (`user_document`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

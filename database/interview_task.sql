
-- MySQL dump for interview_task database

CREATE DATABASE IF NOT EXISTS interview_task;
USE interview_task;

-- Table structure for table `auth_user`
DROP TABLE IF EXISTS `auth_user`;
CREATE TABLE `auth_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample data for `auth_user`
INSERT INTO `auth_user` (`name`, `email`, `password`) VALUES
('Admin User', 'admin@example.com', '$2y$10$abcdefghijklmnopqrstuv'); -- hashed password

-- Table structure for table `teachers`
DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `subject` varchar(100) NOT NULL,
  `experience` int DEFAULT 0,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES auth_user(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample data for `teachers`
INSERT INTO `teachers` (`user_id`, `subject`, `experience`) VALUES
(1, 'Mathematics', 5),
(1, 'Science', 3);

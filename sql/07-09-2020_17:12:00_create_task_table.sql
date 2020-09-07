CREATE TABLE IF NOT EXISTS `tasks`(
   `id` INT(11) AUTO_INCREMENT,
   `user` VARCHAR(100),
   `email` VARCHAR(100),
   `text` TEXT,
   `updated_at` DATETIME NULL,
   `completed_at` DATETIME NULL,
   PRIMARY KEY (id)
);
CREATE DATABASE IF NOT EXISTS test;
CREATE DATABASE IF NOT EXISTS testo;
USE test;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `numbers` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `numbers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE USER 'root'@'%' IDENTIFIED BY ''
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;

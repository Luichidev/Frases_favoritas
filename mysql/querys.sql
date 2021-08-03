CREATE DATABASE `quotes_db` DEFAULT CHARACTER
SET
`utf8mb4` COLLATE `utf8mb4_unicode_ci`;

CREATE TABLE `users`
(
`iduser` INT PRIMARY KEY AUTO_INCREMENT,
`use_name` VARCHAR
(50) NOT NULL,
`use_ts` DATETIME DEFAULT CURRENT_TIMESTAMP,
`use_email` VARCHAR
(100) NOT NULL UNIQUE,
`use_pass` VARCHAR
(100) NOT NULL,
`use_roll` INT
(50) NOT NULL
);

CREATE TABLE `quotes`
(`idquote` INT PRIMARY KEY AUTO_INCREMENT,
`quo_iduser` INT,
FOREIGN KEY
(`quo_iduser`) REFERENCES users
(`iduser`),
`quo_quote` VARCHAR
(255) NOT NULL,
`quo_author` VARCHAR
(100) NOT NULL,
`quo_category` VARCHAR
(100) DEFAULT "Sin categoria",
`quo_isPublic` TINYINT NOT NULL DEFAULT 0,
`quo_ts` DATETIME DEFAULT CURRENT_TIMESTAMP,
`quo_modificate` DATETIME DEFAULT CURRENT_TIMESTAMP ON
UPDATE CURRENT_TIMESTAMP
);

INSERT INTO users
  (use_name, use_email, use_pass, use_roll)
VALUES('admin', 'admin@frasesfavoritas.es', '$2y$10$TCr410PpO22W8Z.OIpowIOdgxuUVNiwbb.ozdd9MyUZd9QZr1b3HS', 1);
-- admin123
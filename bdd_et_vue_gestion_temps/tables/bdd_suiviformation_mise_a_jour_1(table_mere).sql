-- Active: 1656400043423@@127.0.0.1@3306

CREATE TABLE users (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  email varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE,
  cin varchar(30) COLLATE utf8mb4_unicode_ci,
  telephone varchar(100) COLLATE utf8mb4_unicode_ci ,
  email_verified_at timestamp NULL DEFAULT NULL,
  password varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  remember_token varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  created_at timestamp NULL DEFAULT  current_timestamp(),
  updated_at timestamp NULL DEFAULT  current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at,cin,telephone) VALUES
(1, 'contact', 'contact@formation.mg', NULL, '$2y$10$9i0uUmJpIwVtYX1dlEdM5.bNcYXU8CrD8QXDS5loPVAurII6BmbFm', NULL, '2021-08-04 05:53:44', '2021-08-04 05:53:44','301051027178','0321122233');

-- Active: 1657795847622@@127.0.0.1@3306@bdd_temps
CREATE TABLE temps_roles (
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    role_name varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    role_description varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    created_at timestamp NULL DEFAULT current_timestamp(),
    updated_at timestamp NULL DEFAULT  current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO temps_roles (id,role_name,role_description, created_at, updated_at) VALUES
(1,'admin','Admnistrateur', '2021-10-26 05:45:24', '2021-10-26 05:45:24');

CREATE TABLE temps_role_users(
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_id` bigint(20) UNSIGNED NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    `role_id` bigint(20) UNSIGNED NOT NULL REFERENCES temps_roles(id) ON DELETE CASCADE,
    prioriter boolean not null default false,
    activiter boolean not null default false
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO temps_role_users(user_id,role_id,activiter) VALUES (1,6,1);

CREATE TABLE temps_entreprises (
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
    adresse_rue varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
    adresse_quartier varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
    adresse_code_postal varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
    adresse_ville varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
    adresse_region varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
    logo varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    created_at timestamp NULL DEFAULT current_timestamp(),
    updated_at timestamp NULL DEFAULT current_timestamp(),
    nif varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    stat varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
    rcs varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
    cif varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
    email varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    site varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
    activiter boolean not null default true,
    telephone varchar(191) COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `temps_departement_entreprises` (
    `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `nom_departement`  varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES temps_entreprises(id) ON DELETE CASCADE,
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE temps_employers (
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    matricule varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    nom varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    prenom varchar(255) COLLATE utf8mb4_unicode_ci,
    date_naissance DATETIME DEFAULT current_timestamp(),
    cin varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    email varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    telephone varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    fonction varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    service_id bigint(20) UNSIGNED,
    branche_id bigint(20) UNSIGNED,
    genre_id bigint(20) unsigned DEFAULT 1  REFERENCES genre(id),
    departement_entreprises_id bigint(20) UNSIGNED,
    adresse_quartier varchar(255) COLLATE utf8mb4_unicode_ci  default NULL,
    adresse_code_postal varchar(30) COLLATE utf8mb4_unicode_ci  default NULL,
    adresse_lot varchar(255) COLLATE utf8mb4_unicode_ci  default NULL,
    adresse_ville varchar(255) COLLATE utf8mb4_unicode_ci  default NULL,
    adresse_region varchar(255) COLLATE utf8mb4_unicode_ci  default NULL,
    user_id bigint(20) UNSIGNED NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    photos varchar(255) COLLATE utf8mb4_unicode_ci,
    entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES temps_entreprises(id) ON DELETE CASCADE,
    niveau_etude_id bigint(20) UNSIGNED NOT NULL DEFAULT 1 REFERENCES niveau_etude(id) ON DELETE CASCADE,
    activiter boolean not null default true,
    prioriter boolean not null default false,
    url_photo VARCHAR(155),
    created_at timestamp  DEFAULT current_timestamp(),
    updated_at timestamp  DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `temps_chef_dep_entreprises` (
    `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `departement_entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES temps_departement_entreprises(id) ON DELETE CASCADE,
    `chef_departement_id` bigint(20) UNSIGNED NOT NULL REFERENCES temps_employers(id) ON DELETE CASCADE,
    `created_at` timestamp default current_timestamp(),
    `updated_at` timestamp default current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create Table pointage
(
time entree,
time pause,
time rentree,
time sortie,
datetime ajd,
BIGINT id_employer
);


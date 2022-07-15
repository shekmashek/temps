-- Active: 1657795847622@@127.0.0.1@3306@bdd_temps
create Table temps_pointage(
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    entree time DEFAULT CURRENT_TIME() NOT NULL,
    debut_pause time,
    fin_pause time,
    sortie time,
    jour datetime DEFAULT CURRENT_TIMESTAMP() NOT NULL,
    employer_id bigint(20) UNSIGNED NOT NULL,
    foreign key(employer_id) references employers(id) on delete cascade
);

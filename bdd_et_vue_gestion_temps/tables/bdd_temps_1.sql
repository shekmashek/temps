-- Active: 1656400043423@@127.0.0.1@3306@bdd_nicole
drop table temps_pointage;

create Table temps_pointage(
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    entree time DEFAULT CURRENT_TIME() NOT NULL,
    heure_pause DECIMAL(2,1),
    sortie time,
    jour datetime DEFAULT CURRENT_TIMESTAMP() NOT NULL,
    employer_id bigint(20) UNSIGNED NOT NULL,
    foreign key(employer_id) references employers(id) on delete cascade
);

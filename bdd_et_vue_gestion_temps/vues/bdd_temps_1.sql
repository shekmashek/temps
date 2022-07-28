-- Active: 1656400043423@@127.0.0.1@3306@bdd_nicole

-- totale heure de travail
create or REPLACE VIEW totaleHeureDeTravail as;
SELECT
    sum((timestampDiff(
        minute,
        entree,
        case
            when sortie <= entree and entree != '00:00:00' and sortie != '00:00:00'
            then DATE_ADD(sortie,interval 24 hour)
            else sortie
        end))/60 - heure_pause
    ) duree,
    week(jour) semaine,
    year(jour) annee
from temps_pointage
GROUP BY week(jour), year(jour)
;
SELECT
duree, semaine, annee
from totaleHeureDeTravail;

-- liste heure sup
CREATE or REPLACE VIEW listeHeureSup as
SELECT
    id,entree,sortie,heure_pause,debut,fin,
    case
        when (SELECT fin) <= entree and entree != '00:00:00' and (SELECT fin) != '00:00:00'
        then DATE_ADD((SELECT fin),interval 24 hour)
        else (SELECT fin)
    end as 'var_fin',
    timestampDiff(minute, (SELECT debut), (SELECT var_fin)) var_Hsup,
    Case
        when (SELECT var_Hsup) < 0 then 0
        else (SELECT var_Hsup/60)
    end as 'duree',
    jour,
    week(jour) semaine,
    month(jour) mois,
    year(jour) annee
from liste
;

-- liste heure supplementaire
CREATE or REPLACE VIEW liste as;
SELECT id,debut, entree,fin, sortie,duree,jour,heure_pause
from heure_supplementaire_jour
UNION
SELECT id,debut, entree,fin, sortie,duree,jour,heure_pause
from heure_supplementaire_nuit
ORDER BY jour;

-- totale heure sup semaine
CREATE or REPLACE VIEW totaleHeureSup as
SELECT SUM(duree) duree, week(jour) semaine, year(jour) annee
from listeheuresup
GROUP BY semaine,annee
;
SELECT
duree,semaine,annee
from totaleheuresup
;

CREATE or REPLACE VIEW HeureSupHuit as;
SELECT
    id, debut, fin, duree, jour,
    (SELECT duree
    from totaleHeureDeTravail t
    where t.semaine=l.semaine
    and t.annee=l.annee) as totalSemaine,
    (SELECT duree
    from totaleHeureSup t
    where t.semaine=l.semaine
    and t.annee=l.annee) as totalHeureSupSemaine,
    semaine, annee
from listeheuresup l
ORDER BY semaine,annee
;

SELECT * FROM HeureSupHuit;
;
---- SALAIRE DE BASE:
-- maka 8 premières heures
-- 130 ou 150

-- le jour où le total de durée est de 8h
CREATE or REPLACE VIEW DebutJourHuit as
SELECT
    id,
    jour,
    duree,
    debut,

    (SELECT
        sum(h2.duree)
    from listeheuresup h2
    WHERE h2.jour < h1.jour
    ) as reste,

    CASE
    WHEN (select reste) is NULL
    then
        case
            when DATE_ADD(debut, interval 8*60 minute) > 24
            then DATE_ADD(debut, interval (8 - 24)*60 minute)
            else DATE_ADD(debut, interval 8*60 minute)
        end
    else DATE_ADD(debut, interval (SELECT 8*60 - reste*60) minute)
    end as var_fine,
    CASE
        when (SELECT var_fine) > time '24:00'
        then DATE_ADD((SELECT var_fine), interval -24*60 minute)
        else (SELECT var_fine)
    end as fin
from
listeheuresup h1
where (
    SELECT
        sum(h2.duree)
    from HeureSupHuit h2
    WHERE h2.jour <= h1.jour
    ) >= 8
ORDER BY jour
LIMIT 1
;

CREATE or REPLACE VIEW heure_supplementaire_avant_huit as;
SELECT id,debut,fin,duree,jour FROM listeheuresup l
WHERE jour < (
    SELECT jour
    from DebutJourHuit j
    WHERE week(j.jour)=week(l.jour)
    AND year(j.jour)=year(l.jour)
    )
UNION
SELECT id,debut,fin,duree,jour FROM DebutJourHuit
ORDER BY jour;

CREATE or REPLACE VIEW FinJourHuit as
SELECT
    id,
    jour,
    duree,
    fin,

    (SELECT
        sum(h2.duree)
    from listeheuresup h2
    WHERE h2.jour < h1.jour
    ) as reste,

    CASE
    WHEN (select reste) is NULL
    then
        case
            when DATE_ADD(debut, interval 8*60 minute) > 24
            then DATE_ADD(debut, interval (8 - 24)*60 minute)
            else DATE_ADD(debut, interval 8*60 minute)
        end
    else DATE_ADD(debut, interval (SELECT 8*60 - reste*60) minute)
    end as var_fine,
    CASE
        when (SELECT var_fine) > time '24:00'
        then DATE_ADD((SELECT var_fine), interval -24*60 minute)
        else (SELECT var_fine)
    end as debut

from
listeheuresup h1
where (
    SELECT
        sum(h2.duree)
    from HeureSupHuit h2
    WHERE h2.jour <= h1.jour
    ) >= 8
ORDER BY jour
LIMIT 1
;

CREATE or REPLACE VIEW heure_supplementaire_apres_huit as;
SELECT id,debut,fin,duree,jour FROM listeheuresup l
WHERE jour > (
    SELECT jour
    from FinJourHuit j
    WHERE week(j.jour)=week(l.jour)
    AND year(j.jour)=year(l.jour)
    )
UNION
SELECT id,debut,fin,duree,jour FROM FinJourHuit
ORDER BY jour;

---- MAJORATION: durée, type de majoration, jour
-- heure de jour ou heure de nuit
-- 0 ou 50
-- mbola tsisy hoe sady manao heure sup maraina izy no nanao heure sup hariva
-- liste jour entre debut -> 10pm

CREATE or REPLACE VIEW heure_supplementaire_jour_apres_sortie as
SELECT
    id,heure_pause,entree,sortie,
    case
        when sortie <= entree and entree != '00:00:00' and sortie != '00:00:00'
        then DATE_ADD(sortie,interval 24 hour)
        else sortie
    end as 'var_fin',
    CASE
        when entree < time '08:00:00'
        then entree
        else DATE_ADD(entree, interval (8 + heure_pause)*60 minute)
    end as debut,
    case
        when (SELECT var_fin) > '22:00:00'
        then time '22:00:00'
        when entree < time '08:00:00'
        then time '08:00:00'
        else (SELECT var_fin)
    end as 'fin',
    timestampDiff(minute, (SELECT debut), (SELECT fin)) var_Hsup,
    Case
        when (SELECT var_Hsup) < 0 then 0
        else (SELECT var_Hsup/60)
    end as 'duree',
    jour
from temps_pointage
WHERE entree != '00:00:00' and sortie != '00:00:00'
;
-- liste jour entre 05am -> fin
-- else DATE_ADD(entree, interval (8 + heure_pause)*60 minute)

CREATE or REPLACE VIEW heure_supplementaire_jour_avant_entree as
SELECT
    id,heure_pause,entree,sortie,
    DATE_ADD(entree, interval (8 + heure_pause)*60 minute) as var_debut,
    CASE
        when entree < time '08:00:00'
        then entree
        else DATE_ADD(entree, interval (8 + heure_pause)*60 minute)
    end as var_entree,
    CASE
        when (SELECT var_entree) < time '08:00:00'
        then time '08:00:00'
        else sortie
    end as var_sortie,
    case
        when (SELECT var_sortie) <= (SELECT var_entree) and (SELECT var_entree) != '00:00:00' and (SELECT var_sortie) != '00:00:00'
        then DATE_ADD((SELECT var_sortie),interval 24 hour)
        else (SELECT var_sortie)
    end as var_fin,
    CASE
        when (SELECT var_entree) < time '08:00:00'
        then
            CASE
                when (SELECT var_entree) < time '05:00:00'
                then time '05:00:00'
                else (SELECT var_entree)
                end
        else DATE_ADD((SELECT var_entree), interval (8 + heure_pause)*60 minute)
    end as debut,
    CASE
        when (SELECT var_entree) < time '08:00:00'
        then time '08:00:00'
        else (SELECT var_sortie)
    end as fin,
    timestampDiff(minute, (SELECT debut), (SELECT fin)) var_Hsup,
    Case
        when (SELECT var_Hsup) < 0 then 0
        else (SELECT var_Hsup/60)
    end as 'duree',
    jour
from temps_pointage
where
    case
        when sortie <= entree
        then DATE_ADD(sortie,interval 24 hour)
        else sortie
    end > DATE_ADD(time '24:00:00',interval 5 hour)
OR entree < time '08:00:00'
and entree != '00:00:00' and sortie != '00:00:00'
;

CREATE or REPLACE view heure_supplementaire_jour as
select id,debut,fin,duree,jour,heure_pause,entree,sortie
from
heure_supplementaire_jour_avant_entree
UNION
select id,debut,fin,duree,jour,heure_pause,entree,sortie
from
heure_supplementaire_jour_apres_sortie
where id not in (select id from heure_supplementaire_jour_avant_entree)
;

-- liste heure sup entre 22h -> 05h
CREATE or REPLACE VIEW heure_supplementaire_nuit as
SELECT
    id,entree,sortie,heure_pause,
    DATE_ADD(entree, interval (8 + heure_pause)*60 minute) as var_debut,
    case
        when sortie <= entree and entree != '00:00:00' and sortie != '00:00:00'
        then DATE_ADD(sortie,interval 24 hour)
        else sortie
    end as limite_fin,
    case
        when entree < time '08:00:00'
        then entree
        else time '22:00:00'
    end as debut,
    case
        when entree < time '08:00:00'
        then time '05:00:00'
        when (select limite_fin) > DATE_ADD(time '24:00:00',interval 5 hour)
        then time '05:00:00'
        else sortie
    end as fin,
    case
        when (SELECT fin) <= (SELECT debut)
        then DATE_ADD((SELECT fin),interval 24 hour)
        else (SELECT fin)
    end as var_fin,
    timestampDiff(minute, (SELECT debut), (SELECT var_fin)) var_Hsup,
    Case
        when (SELECT var_Hsup) < 0 then 0
        else (SELECT var_Hsup/60)
    end as 'duree',
    jour
from temps_pointage
WHERE entree != '00:00:00' and sortie != '00:00:00'
and
    (case
        when sortie <= entree
        then DATE_ADD(sortie,interval 24 hour)
        else sortie
    end > time '22:00:00'
    OR entree < time '08:00:00')
;

select id,debut,fin,duree,jour from heure_supplementaire_nuit;


-- type de jour: ouvrable, dimanche, férié
-- sans ou 40 ou 100


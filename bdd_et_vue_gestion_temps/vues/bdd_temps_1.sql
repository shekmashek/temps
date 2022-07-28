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


-- liste heure supplementaire
CREATE or REPLACE VIEW listeHeureSup as;
SELECT id, entree, sortie, debut, fin,duree,jour,heure_pause,week(jour) semaine,month(jour) mois,year(jour) annee
from heure_supplementaire_jour
UNION
SELECT id, entree, sortie, debut, fin,duree,jour,heure_pause,week(jour) semaine,month(jour) mois,year(jour) annee
from heure_de_nuit
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
CREATE or REPLACE VIEW DebutJourHuit as;
SELECT
    id,
    jour,
    debut,fin,
    duree,

    (SELECT
        sum(h2.duree)
    from listeheuresup h2
    WHERE h2.jour <= h1.jour
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
listeheuresup h1;
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

CREATE or REPLACE VIEW FinJourHuit as;
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
-- liste jour entre debut -> 10pm

CREATE or REPLACE VIEW heure_supplementaire_jour_apres_sortie as;
SELECT
    id,heure_pause,entree,sortie,
    -- verification si la sortie est à la date du jour ou le jour suivant
    case
        when sortie <= entree and entree != '00:00:00' and sortie != '00:00:00'
        -- ajouter 24 heures pour les jours d'après
        then DATE_ADD(sortie,interval 24 hour)
        else sortie
    end as sortie_today_or_tomorrow,
    CASE
        -- balisage heure de debut d'heure supp à l'heure conventionnelle
        when entree < time '08:00:00'
        -- heure de sortie conventionnelle = 8am + 8 heures + avec pause
        then DATE_ADD(time '08:00:00', interval (8 + heure_pause)*60 minute)
        -- heure de sortie conventionnelle = heure d'entrée + 8 heures + avec pause
        else DATE_ADD(entree, interval (8 + heure_pause)*60 minute)
    end as debut,
    case
        -- balisage heure de sortie à 10pm
        when (SELECT sortie_today_or_tomorrow) > '22:00:00'
        then time '22:00:00'
        else sortie
    end as fin,
    -- durée d'heure supp en minutes
    timestampDiff(minute, (SELECT debut), (SELECT fin)) duree_minute,
    -- durée d'heure sup en heure
    Case
        when (SELECT duree_minute) < 0 then 0
        else (SELECT duree_minute/60)
    end as 'duree',
    jour
from temps_pointage
WHERE entree != '00:00:00' and sortie != '00:00:00'
;

-- liste jour entre 05am -> fin
-- mbola tsy mety ny double heure sup avant entrée ohatra hoe raha niditra t@ 7 izy nefa t@ 6 ampitso vao nirava
CREATE or REPLACE VIEW heure_supplementaire_jour_avant_entree as;
SELECT
    id,heure_pause,entree,sortie,
    -- verification si la sortie est à la date du jour ou le jour suivant
    case
        when sortie <= entree and entree != '00:00:00' and sortie != '00:00:00'
        -- ajouter 24 heures pour les jours d'après
        then DATE_ADD(sortie,interval 24 hour)
        else sortie
    end as sortie_today_or_tomorrow,
    CASE
        -- balisage heure d'entrée à 5am
        when entree < time '05:00:00'
        then time '05:00:00'
        -- heure de sortie demain après 5am
        when (SELECT sortie_today_or_tomorrow) > DATE_ADD(time '24:00:00',interval 5 hour)
        then time '05:00:00'
        else entree
    end as debut,
    -- balisage heure de fin d'heure supp à 8am ou à l'heure de sortie conventionnelle
    case
        when (SELECT sortie_today_or_tomorrow) < time '17:00:00'
        -- heure de sortie conventionnelle = 8 heure - durée d'heure de travail (avec pause)
        then DATE_ADD(sortie, interval -(8 + heure_pause)*60 minute)
        -- heure de sortie demain après 5am
        when (SELECT sortie_today_or_tomorrow) > DATE_ADD(time '24:00:00',interval 5 hour)
        then sortie
        else time '08:00:00'
    end as fin,
    -- durée d'heure supp en minutes
    timestampDiff(minute, (SELECT debut), (SELECT fin)) duree_minute,
    -- durée d'heure sup en heure
    Case
        when (SELECT duree_minute) < 0 then 0
        else (SELECT duree_minute/60)
    end as 'duree',
    jour
from temps_pointage
where
    --condition pour les jours non travaillés
    entree != '00:00:00' and sortie != '00:00:00' and
    -- condition similaire pour sortie_today_or_tomorrow
    (case
        when sortie <= entree
        then DATE_ADD(sortie,interval 24 hour)
        else sortie
    -- heure de sortie demain après 5am
    end > DATE_ADD(time '24:00:00',interval 5 hour)
    -- heure d'entrée avant 8am
    OR entree < time '08:00:00')
;

-- regrouper les heures de jour dans cette VIEW heure_supplementaire_jour
CREATE or REPLACE view heure_supplementaire_jour as;
select id,debut,fin,duree,jour,heure_pause,entree,sortie
from
heure_supplementaire_jour_avant_entree
where heure_supplementaire_jour_avant_entree.duree >= 1
UNION
select id,debut,fin,duree,jour,heure_pause,entree,sortie
from
heure_supplementaire_jour_apres_sortie
WHERE heure_supplementaire_jour_apres_sortie.duree >= 1
;

-- liste heure sup entre 22h -> 05h
CREATE or REPLACE VIEW heure_de_nuit as;
-- requete imbriqée pour la condition where durée >= 1 et avoir les attriubts necessaires
SELECT id,debut,fin,duree,jour,heure_pause,entree,sortie
from (
    SELECT
        id,entree,sortie,heure_pause,(entree < time '05:00:00'),
        -- verification si la sortie est à la date du jour ou le jour suivant
        case
            when sortie <= entree and entree != '00:00:00' and sortie != '00:00:00'
            -- ajouter 24 heures pour les jours d'après
            then DATE_ADD(sortie,interval 24 hour)
            else sortie
        end as sortie_today_or_tomorrow,
        case
            -- si l'heure de travail de 8h avec pause depasse 22h
            when DATE_ADD(entree, interval (8 + heure_pause)*60 minute) > time '22:00:00'
            then DATE_ADD(entree, interval (8 + heure_pause)*60 minute)
            -- balisage heure d'entrée de [ 10pm à 5am ]
            when time '05:00:00' < entree and  entree < time '22:00:00'
            then time '22:00:00'
            else entree
        end as debut,
        case
            -- balisage heure de sortie à 5am si le debut d'heure supp est entre [ 00h à 05h ]
            when (SELECT debut) < time '05:00:00'
            then time '05:00:00'
            -- balisage heure de sortie à 5am si l'heure de fin est après 5am du jour après
            when (select sortie_today_or_tomorrow) > DATE_ADD(time '24:00:00',interval 5 hour)
            then time '05:00:00'
            else sortie
        end as fin,
        case
            -- ajouter 24h si heure de fin est dans la matinée du jour d'après [ 00h à 05h ]
            when (SELECT fin) <= (SELECT debut)
            then DATE_ADD((SELECT fin),interval 24 hour)
            else (SELECT fin)
        end as var_fin,
        -- durée d'heure supp en minutes
        timestampDiff(minute, (SELECT debut), (SELECT var_fin)) duree_minute,
        -- durée d'heure sup en heure
        Case
            when (SELECT duree_minute) < 0 then 0
            else (SELECT duree_minute/60)
        end as 'duree',
        jour
    from temps_pointage
    WHERE
        --condition pour les jours non travaillés
        entree != '00:00:00' and sortie != '00:00:00' and
        -- condition similaire pour sortie_today_or_tomorrow
        (case
            when sortie <= entree
            then DATE_ADD(sortie,interval 24 hour)
            else sortie
        -- pour heure de sortie après 10pm ou est dans le jour d'après
        end > time '22:00:00'
        -- pour heure d'entrée avant 5am [ 00h à 05h ]
        OR entree < time '05:00:00')
)as heure_de_nuit
where duree >= 1
;

-- type de jour: ouvrable, dimanche, férié
-- sans ou 40 ou 100


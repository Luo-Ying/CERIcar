


-- recuperation du trajet de depart à arrivée avec des correspondances
WITH RECURSIVE tableTrajetTest(
    passTrajet,
    villeDepart,
    villeArrivee,
    villeArriveeCorrespondance
)
AS(
    SELECT 1, CAST(depart as VARCHAR), CAST(arrivee as VARCHAR), CAST(arrivee as VARCHAR)
    FROM jabaianb.trajet
    WHERE jabaianb.trajet.depart = 'Paris'
    UNION ALL
    SELECT
    tableTrajetTest.passTrajet + 1, 
    tableTrajetTest.villeDepart || ', ' || jabaianb.trajet.depart,
    tableTrajetTest.villeArrivee || ' > ' || jabaianb.trajet.arrivee,
    jabaianb.trajet.arrivee
    FROM tableTrajetTest
    INNER JOIN jabaianb.trajet ON jabaianb.trajet.depart = tableTrajetTest.villeArriveeCorrespondance
    WHERE tableTrajetTest.villeDepart NOT LIKE '%' || jabaianb.trajet.arrivee || '%' 
    AND jabaianb.trajet.distance > 0
    AND tableTrajetTest.passTrajet < 3
)
SELECT * FROM tableTrajetTest
WHERE tableTrajetTest.villeArrivee LIKE '%Montpellier';




WITH RECURSIVE tableCorrespondance (
    stepVoyage,
    IdVoyage, 
    villeDepart, 
    villeArrivee, 
    heureDepart, 
    heureArrivee, 
    heureAttanteTotal,
    nbPlaceRestant,
    tarifTotal,
    distanceTrajetTotal,
    heureTrajetTotal,
    heureDepartFinal,
    heureArriveeFinal,
    villeArriveeFinal,
    nbPlaceRestantLast
) 
AS (
    SELECT 
    1, 
    CAST(voyage.id as VARCHAR),
    CAST(trajet.depart as VARCHAR),
    CAST(trajet.arrivee as VARCHAR),
    CAST(voyage.heuredepart as VARCHAR),
    CAST(cast(round(jabaianb.voyage.heuredepart+(jabaianb.trajet.distance/60)) as integer)%24 as VARCHAR),
    0,
    CAST(nbPlaceRestant(voyage.id) as VARCHAR),
    voyage.tarif,
    trajet.distance,
    round(voyage.heuredepart+(trajet.distance/60))-voyage.heuredepart,
    voyage.heuredepart,
    cast(round(jabaianb.voyage.heuredepart+(jabaianb.trajet.distance/60)) as integer)%24,
    jabaianb.trajet.arrivee,
    nbPlaceRestant(voyage.id)
    FROM jabaianb.voyage JOIN jabaianb.trajet ON jabaianb.voyage.trajet = jabaianb.trajet.id
    WHERE jabaianb.trajet.depart = 'Marseille'
    UNION
    SELECT 
    tableCorrespondance.stepVoyage + 1,
    tableCorrespondance.IdVoyage || ', ' || CAST(suivant.id as VARCHAR),
    tableCorrespondance.villeDepart || ', ' || suivant.depart,
    tableCorrespondance.villeArrivee || ', ' || suivant.arrivee,
    tableCorrespondance.heureDepart || ', ' || CAST(suivant.heuredepart as VARCHAR),
    tableCorrespondance.heureArrivee || ', ' || CAST(cast(round(suivant.heuredepart+(suivant.distance/60)) as integer)%24 as VARCHAR),
    tableCorrespondance.heureAttanteTotal + (suivant.heuredepart - CAST(tableCorrespondance.heureArriveeFinal as integer)),
    tableCorrespondance.nbPlaceRestant || ', ' || CAST(nbPlaceRestant(suivant.id) as VARCHAR),
    tableCorrespondance.tarifTotal + suivant.tarif,
    tableCorrespondance.distanceTrajetTotal + suivant.distance,
    tableCorrespondance.heureTrajetTotal + (cast(round(suivant.heuredepart+(suivant.distance/60)) as integer)%24 - tableCorrespondance.heureArriveeFinal),
    suivant.heuredepart,
    cast(round(suivant.heuredepart+(suivant.distance/60)) as integer)%24,
    suivant.arrivee,
    nbPlaceRestant(suivant.id)
    FROM (SELECT jabaianb.voyage.id as id, 
                jabaianb.trajet.depart as depart, 
                jabaianb.trajet.arrivee as arrivee, 
                jabaianb.voyage.heuredepart as heuredepart, 
                jabaianb.voyage.tarif as tarif, 
                jabaianb.trajet.distance as distance 
            FROM jabaianb.voyage JOIN jabaianb.trajet
            ON jabaianb.voyage.trajet = jabaianb.trajet.id)
    AS suivant INNER JOIN tableCorrespondance ON suivant.depart = tableCorrespondance.villeArriveeFinal
    WHERE tableCorrespondance.villeDepart NOT LIKE '%' || suivant.arrivee || '%'
    AND tableCorrespondance.heureArriveeFinal < suivant.heuredepart
    AND tableCorrespondance.nbPlaceRestantLast > 0
)
SELECT stepVoyage,
        villeArrivee,
        heureDepart,
        heureArrivee,
        heureAttanteTotal,
        nbPlaceRestant,
        distanceTrajetTotal,
        heureTrajetTotal
    FROM tableCorrespondance
    WHERE tableCorrespondance.villeArrivee LIKE '%Toulouse' AND tableCorrespondance.stepVoyage > 1
    And tableCorrespondance.nbPlaceRestantLast > 0;
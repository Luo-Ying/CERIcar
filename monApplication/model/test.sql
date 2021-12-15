WITH RECURSIVE tableCorrespondance (
    correspondant,
    IdVoyage, 
    villeDepart, 
    villeArrivee, 
    heureDepart, 
    heureArrivee, 
    heureAttanteTotal,
    nbPlaceRestant,
    tarifTotal,
    distanceTrajetTotal,
    heureTrajetTotal
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
    round(voyage.heuredepart+(trajet.distance/60))-voyage.heuredepart
    FROM jabaianb.voyage JOIN jabaianb.trajet ON jabaianb.voyage.trajet = jabaianb.trajet.id
    WHERE jabaianb.trajet.depart = 'Paris'
    UNION ALL
    SELECT 
    tableCorrespondance.correspondant + 1,
    tableCorrespondance.IdVoyage || ', ' || CAST(suivant.id as VARCHAR),
    tableCorrespondance.villeDepart || ', ' || suivant.depart,
    tableCorrespondance.villeArrivee || ', ' || suivant.arrivee,
    tableCorrespondance.heureDepart || ', ' || CAST(suivant.heuredepart as VARCHAR),
    tableCorrespondance.heureArrivee || ', ' || CAST(cast(round(suivant.heuredepart+(suivant.distance/60)) as integer)%24 as VARCHAR),
    tableCorrespondance.heureAttanteTotal + (suivant.heuredepart - CAST(tableCorrespondance.heureArrivee as integer)) ,
    tableCorrespondance.nbPlaceRestant || ', ' || CAST(nbPlaceRestant(suivant.id) as VARCHAR),
    tableCorrespondance.tarifTotal + suivant.tarif,
    tableCorrespondance.distanceTrajetTotal + suivant.distance,
    tableCorrespondance.heureTrajetTotal + ((suivant.heuredepart - CAST(tableCorrespondance.heureArrivee as integer)) + (round(suivant.heuredepart+(suivant.distance/60))-suivant.heuredepart))
    FROM (SELECT voyage.id as id, depart, arrivee, heuredepart, tarif, distance 
            FROM jabaianb.voyage JOIN jabaianb.trajet
            ON jabaianb.voyage.trajet = jabaianb.trajet.id)
    AS suivant INNER JOIN tableCorrespondance ON tableCorrespondance.villeArrivee = suivant.depart
)
SELECT * FROM tableCorrespondance;
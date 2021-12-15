-- renvoyer la nbReservation du voyage
DROP FUNCTION IF EXISTS nbReservation(idVoyage integer) cascade;

CREATE OR REPLACE FUNCTION nbReservation(idVoyage integer)
RETURNS integer
AS $$
    DECLARE
        nbReservation integer;
    BEGIN
        SELECT COUNT(voyage) INTO nbReservation FROM jabaianb.reservation WHERE voyage = idVoyage;
        return nbReservation;
    END;
$$ LANGUAGE plpgsql;


-- renvoyer la nbPlace restant du voyage
DROP FUNCTION IF EXISTS nbPlaceRestant(idVoyage integer) cascade;

CREATE OR REPLACE FUNCTION nbPlaceRestant(idVoyage integer)
RETURNS integer
AS $$
    DECLARE
        nbPlace integer;
        nbReservation integer;
        nbPlaceRestant integer;
    BEGIN
        SELECT jabaianb.voyage.nbplace INTO nbPlace FROM jabaianb.voyage WHERE id = idVoyage;
        nbReservation = nbReservation(idVoyage);
        nbPlaceRestant = nbPlace - nbReservation;
        if(nbPlaceRestant < 0) THEN
            nbPlaceRestant = 0;
        END IF;
        return nbPlaceRestant;
    END;
$$ LANGUAGE plpgsql;



-- reserve un voyage
DROP FUNCTION IF EXISTST reserveVoyage(idVoyage integer, idUser integer) cascade;

CREATE OR REPLACE FUNCTION reserveVoyage(idVoyage integer, idUser integer)
RETURNS void 
AS $$
    BEGIN
        INSERT INTO jabaianb.reservation (voyage, voyageur) VALUES (idVoyage, idUser);
    END;
$$ LANGUAGE plpgsql;



-- proposer un voyage
DROP FUNCTION IF EXISTST proposerVoyage(idConducteur integer, idTrajet integer, tarif integer, nbPlace integer, heureDepart integer, contraintes VARCHAR) cascade;

CREATE OR REPLACE FUNCTION proposerVoyage(idConducteur integer, idTrajet integer, tarif integer, nbPlace integer, heureDepart integer, contraintes VARCHAR)
RETURNS void 
AS $$
    BEGIN
        INSERT INTO jabaianb.voyage (conducteur, trajet, tarif, nbplace, heuredepart, contraintes) 
        VALUES (idConducteur, idTrajet, tarif, nbPlace, heureDepart, contraintes);
    END;
$$ LANGUAGE plpgsql;








-- recherche voyages pour correspondance
DROP FUNCTION IF EXISTS searchVoyageCorrespondance(villeDepartDebut VARCHAR, villeArriveeFin VARCHAR) cascade;

CREATE OR REPLACE FUNCTION searchVoyageCorrespondance(villeDepartDebut VARCHAR, villeArriveeFin VARCHAR)
RETURNS table (
    stepVoyage integer,
    IdVoyage VARCHAR,
    villeDepart VARCHAR,
    villeArrivee VARCHAR,
    heureDepart VARCHAR,
    heureArrivee VARCHAR,
    heureAttanteTotal integer,
    nbPlaceRestant VARCHAR,
    tarifTotal integer,
    distanceTrajetTotal integer,
    heureTrajetTotal integer,
    heureDepartFinal integer,
    heureArriveeFinal integer,
    villeArriveeFinal VARCHAR
)
AS $$
    BEGIN
        RETURN query
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
            villeArriveeFinal
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
            CAST(round(voyage.heuredepart+(trajet.distance/60))-voyage.heuredepart as integer),
            voyage.heuredepart,
            cast(round(jabaianb.voyage.heuredepart+(jabaianb.trajet.distance/60)) as integer)%24,
            jabaianb.trajet.arrivee
            FROM jabaianb.voyage JOIN jabaianb.trajet ON jabaianb.voyage.trajet = jabaianb.trajet.id
            WHERE jabaianb.trajet.depart = villeDepartDebut
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
            CAST(tableCorrespondance.heureTrajetTotal + (cast(round(suivant.heuredepart+(suivant.distance/60)) as integer)%24 - tableCorrespondance.heureArriveeFinal) as integer),
            suivant.heuredepart,
            cast(round(suivant.heuredepart+(suivant.distance/60)) as integer)%24,
            suivant.arrivee
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
            -- AND tableCorrespondance.heureAttanteTotal > 0
            -- AND tableCorrespondance.heureTrajetTotal > 0 AND tableCorrespondance.heureTrajetTotal <= 24
        )
        SELECT * FROM tableCorrespondance
            WHERE tableCorrespondance.villeArrivee LIKE '%' || villeArriveeFin AND tableCorrespondance.stepVoyage > 1;
    END;
$$ LANGUAGE plpgsql;


SELECT searchVoyageCorrespondance('Marseille', 'Toulouse');
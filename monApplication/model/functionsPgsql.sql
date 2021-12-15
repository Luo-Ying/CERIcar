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
DROP FUNCTION IF EXISTS searchVoyageCorrespondance() cascade;

CREATE OR REPLACE FUNCTION searchVoyageCorrespondance(villeDepart VARCHAR, villeArrivee VARCHAR, nbVoyageur integer)
RETURNS table (
    step integer,
    IdVoyage integer,
    villeDepart VARCHAR,
    villeArrivee VARCHAR,
    heureDepart numeric,
    heureArrivee numeric,
    heureAttanteTotal numeric,
    nbPlaceRestant integer,
    tarifTotal numeric,
    distanceTrajetTotal integer,
    heureTrajetTotal numeric
)
AS $$
    BEGIN
        RETURN query
        WITH RECURSIVE tableCorrespondance (
            step,
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
            0, 
            voyage.id,
            trajet.depart,
            trajet.arrivee,
            voyage.heuredepart,
            cast(round(jabaianb.voyage.heuredepart+(jabaianb.trajet.distance/60)) as integer)%24,
            0,
            nbPlaceRestant(voyage.id),
            voyage.tarif,
            trajet.distance,
            round(voyage.heuredepart+(trajet.distance/60))-voyage.heuredepart
            FROM jabaianb.voyage JOIN jabaianb.trajet ON jabaianb.voyage.trajet = jabaianb.trajet.id
            WHERE jabaianb.trajet.depart = villeDepart
            UNION
            SELECT 
            tableCorrespondance.step + 1,
            tableCorrespondance.id || ", " || suivant.id,
            tableCorrespondance.villeDepart || ", " || suivant.depart,
            tableCorrespondance.villeArrivee || ", " || suivant.arrivee,
            tableCorrespondance.heureDepart || ", " || suivant.heuredepart,
            tableCorrespondance.heureArrivee || ", " || suivant.heurearrivee,
            tableCorrespondance.heureAttanteTotal + (suivant.heuredepart - tableCorrespondance.heureArrivee),
            tableCorrespondance.nbPlaceRestant || ", " || nbPlaceRestant(suivant.id),
            tableCorrespondance.tarifTotal + suivant.tarif,
            tableCorrespondance.distanceTrajetTotal + suivant.distance,
            tableCorrespondance.heureTrajetTotal + ((suivant.heuredepart - tableCorrespondance.heureArrivee) + (round(suivant.heuredepart+(suivant.distance/60))-suivant.heuredepart)
        )
        FROM (SELECT voyage.id as id, depart, arrivee, heuredepart, tarif, distance 
                FROM jabaianb.voyage JOIN jabaianb.trajet
                ON jabaianb.voyage.trajet = jabaianb.trajet.id)
        AS suivant INNER JOIN tableCorrespondance ON tableCorrespondance.villeArrivee = suivant.depart





select 0 as step, voyage.id as idVoyage, trajet.depart as villeDepart, trajet.arrivee as villeArrivee, voyage.heuredepart as heureDepart, cast(round(voyage.heuredepart+(trajet.distance/60)) as integer)%24 as heureArrivee, 0 as heureAttante, nbPlaceRestant(voyage.id) as nbPlaceRestant, voyage.tarif as tarif, trajet.distance as distance, round(voyage.heuredepart+(trajet.distance/60))-voyage.heuredepart as heureTrajetTotal 
from jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet = jabaianb.trajet.id 
where trajet.depart = 'Paris' or trajet.arrivee = 'Lyon' and nbPlaceRestant(voyage.id) > 0;
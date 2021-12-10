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



-- retourner voyages reserve
-- DROP FUNCTION IF EXISTST voyageReserveByUser(idUser integer) cascade;

-- CREATE OR REPLACE FUNCTION voyageReserveByUser(idUser integer)
-- RETURNS text[]
-- AS $$
--     DECLARE




-- recherche voyages pour correspondance
DROP FUNCTION IF EXISTS searchVoyageCorrespondance() cascade;

CREATE OR REPLACE FUNCTION searchVoyageCorrespondance(villeDepart VARCHAR, villeArrivee VARCHAR, nbVoyageur integer)
RETURNS table (
    step integer,
    IdVoyageCorrespondance integer,
    villeDepartCorrespondance VARCHAR,
    villeArriveeCorrespondance VARCHAR,
    heureDepart numeric,
    heureArrivee numeric,
    heureAttante numeric,
    heureTrajetTotal numeric,
    distanceTrajetTotal integer
    tarif numeric,
    nbPlaceRestant integer
)
AS $$
    BEGIN
        RETURN query
        WITH RECURSIVE (
            step,
            IdVoyageCorrespondance, 
            villeDepartCorrespondance, 
            villeArriveeCorrespondance, 
            heureDepart, 
            heureArrivee, 
            heureAttante,
            heureTrajetTotal,
            distanceTrajetTotal,
            tarif,
            nbPlaceRestant
        ) 
        AS (
            SELECT 
            0, 
            jabaianb.voyage.id,
            jabaianb.trajet.depart,
            jabaianb.trajet.arrivee,
            jabaianb.voyage.heuredepart,
            round(jabaianb.voyage.heuredepart+(jabaianb.trajet.distance/60))+(jabaianb.trajet.distance%60)/100,
             
        )
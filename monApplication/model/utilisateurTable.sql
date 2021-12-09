
-- ajouter un vouneau compte
DROP FUNCTION IF EXISTS addNewUser(identifiantUser VARCHAR(30), passUser VARCHAR(100), nomUser VARCHAR(50), prenomUser VARCHAR(50), avatarUser VARCHAR(300)) cascade;

CREATE OR REPLACE FUNCTION addNewUser(identifiantUser VARCHAR(30), passUser VARCHAR(100), nomUser VARCHAR(50), prenomUser VARCHAR(50), avatarUser VARCHAR(300))
RETURNS void
AS $$
    BEGIN
        INSERT INTO jabaianb.utilisateur(identifiant, pass, nom, prenom, avatar) 
        VALUES (identifiantUser, passUser, nomUser, prenomUser, avatarUser);

    END;
$$ LANGUAGE plpgsql;



<?php

/**
 * Database voyage object
 */

require_once "voyage.class.php";

class voyageTable{

    /**
     * fonction for get voyage with 'trajet'
     */
    public static function getVoyagesByTrajet($trajet){
        $em = dbconnection::getInstance()->getEntityManager();
        $voyageRepository = $em->getRepository('voyage');
        
        $voyages = $voyageRepository->findBy(
            array('trajet' => $trajet->id),
            array('heureDepart' => 'ASC')
        );

        if($voyages == false){
        }
        return $voyages;
    }


    /**
     * fonction for get voyage with 'id'
     */
    public static function getVoyagesById($idVoyage){
        $em = dbconnection::getInstance()->getEntityManager();
        $voyageRepository = $em->getRepository('voyage');
        
        $voyage = $voyageRepository->findOneBy(array('id' => $idVoyage));

        if($voyage == false){
        }
        return $voyage;
    }


    /**
     * fonction for get voyage with 'conducteur'
     */
    public static function getVoyageByConducteur($idConducteur){
        $em = dbconnection::getInstance()->getEntityManager();
        $propositionVoyageRepository = $em->getRepository('voyage');
        
        $propositionVoyage = $propositionVoyageRepository->findBy(
            array('conducteur' => $idConducteur)
        );
        if($propositionVoyage == false){
            echo "Erreur sql";
        }

        return $propositionVoyage;
    }

    /**
     * @param idVoyage
     * fonction for get number of places remaining with param 'idVoyage'
     * call the function of psql nbPlaceRestant('$idVoyage')
     */
    public static function getNbPlaceRestantByIdVoyage($idVoyage){
        $em = dbconnection::getInstance()->getEntityManager();

        $sql = "SELECT nbPlaceRestant('$idVoyage')";
		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute();
        $nbPlaceRestant = $stmt->fetchAll();
        return $nbPlaceRestant[0]["nbplacerestant"];
    }

    /**
     * @param depart
     * @param arrivee
     * fonction for get all correspondings with param ''depart' and 'arrivee'
     * call the function of psql searchVoyageCorrespondance('$depart', '$arrivee')
     */
    public static function getCorrespondanceVoyagesByDepartArrivee($depart, $arrivee){
        $em = dbconnection::getInstance()->getEntityManager();

        $sql = "SELECT * FROM searchVoyageCorrespondance('$depart', '$arrivee')";
		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute();
        $tableCorrespondance = $stmt->fetchAll();
        return $tableCorrespondance;
    }


    /**
     * fonction for propose a trip , add a new trip into data base
     */
    public static function proposerVoyage($conducteurVoyageProposer, 
        $trajetVoyageProposer, 
        $tarifVoyageProposer,
        $nbPlaceVoyageProposer,
        $heuredepartVoyageProposer,
        $contraintesVoyageProposer){
        
        $em = dbconnection::getInstance()->getEntityManager();

        $sql = "SELECT proposerVoyage('$conducteurVoyageProposer', 
                                    '$trajetVoyageProposer', 
                                    '$tarifVoyageProposer',
                                    '$nbPlaceVoyageProposer',
                                    '$heuredepartVoyageProposer',
                                    '$contraintesVoyageProposer')";
		$stmt = $em->getConnection()->prepare($sql);
		$var = $stmt->execute();

        echo $var;
        echo $stmt;
	}

}

?>
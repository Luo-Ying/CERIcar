<?php

require_once "voyage.class.php";

class voyageTable{

    public static function getVoyagesByTrajet($trajet){
        // echo "<br>", $trajet->id,"<br>";
        $em = dbconnection::getInstance()->getEntityManager();
        $voyageRepository = $em->getRepository('voyage');
        
        $voyages = $voyageRepository->findBy(
            array('trajet' => $trajet->id),
            array('heureDepart' => 'ASC')
        );
        // echo "<br>ok<br>";

        if($voyages == false){
            // echo 'Erreur sql';
        }
        return $voyages;
    }

    public static function getVoyagesById($idVoyage){
        $em = dbconnection::getInstance()->getEntityManager();
        $voyageRepository = $em->getRepository('voyage');
        
        // $voyage = $voyageRepository->findBy(
        //     // array('trajet' => $trajet->id),
        //     // array('heureDepart' => 'ASC')
            
        // );
        $voyage = $voyageRepository->findOneBy(array('id' => $idVoyage));
        // echo "<br>ok<br>";
        // echo var_dump($voyage);

        if($voyage == false){
            echo 'Erreur sql';
        }
        return $voyage;
    }


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

    public static function getNbPlaceRestantByIdVoyage($idVoyage){
        $em = dbconnection::getInstance()->getEntityManager();

		// $sql = "SELECT * from correspondances('$trajet->depart','$trajet->arrivee',$seats)";
        $sql = "SELECT nbPlaceRestant('$idVoyage')";
		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute();
        $nbPlaceRestant = $stmt->fetchAll();
        // var_dump($nbPlaceRestant);
        return $nbPlaceRestant[0]["nbplacerestant"];
    }


    public static function proposerVoyage($conducteurVoyageProposer, 
        $trajetVoyageProposer, 
        $tarifVoyageProposer,
        $nbPlaceVoyageProposer,
        $heuredepartVoyageProposer,
        $contraintesVoyageProposer){
        
        // echo $conducteurVoyageProposer;
        // echo $trajetVoyageProposer;
        // echo $tarifVoyageProposer;
        // echo $nbPlaceVoyageProposer;
        // echo $heuredepartVoyageProposer;
        // echo $contraintesVoyageProposer;
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
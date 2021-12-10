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

}

?>
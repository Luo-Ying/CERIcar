<?php

require_once "trajet.class.php";

class trajetTable{

    public static function getTrajet($depart, $arrivee){

        // $depart = ucfirst(strtolower($depart));

        // $arrivee = ucfirst(strtolower($arrivee));

        // $em = dbconnection::getInstance()->getEntityManager();

        // $trajetRepository = $em->getRepository('trajet');

        
        // $trajet = $trajetRepository->findOneBy(array('depart' => $depart, 'arrivee' => $arrivee));
        
        $em = dbconnection::getInstance()->getEntityManager() ;
        
		$trajetRepository = $em->getRepository('trajet');
		$trajet = $trajetRepository->findOneBy(array('depart' => $depart, 'arrivee' => $arrivee));	
        // echo "<br>ok<br>";
        
        if($trajet == false){
            echo 'Erreur sql';
        }
        else{
            return $trajet;
        }

    }

}

?>
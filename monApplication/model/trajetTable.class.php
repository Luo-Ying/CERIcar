<?php

/**
 * database trajet object
 */

require_once "trajet.class.php";

class trajetTable{


    /**
     * fonction for get trajet
     */
    public static function getTrajet($depart, $arrivee){

        
        $em = dbconnection::getInstance()->getEntityManager() ;
        
		$trajetRepository = $em->getRepository('trajet');
		$trajet = $trajetRepository->findOneBy(array('depart' => $depart, 'arrivee' => $arrivee));	
        
        if($trajet == false){
        }
        else{
            return $trajet;
        }

    }

}

?>
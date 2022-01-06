<?php


/**
 * les reservations de voyage
 */


require_once "reservation.class.php";

class reservationTable{

    /**
     * fonction for get all reservations of trip with objetct voyage
     */
    public static function getReservationByVoyage($voyage){

        $em = dbconnection::getInstance()->getEntityManager();
        $reservationRepository = $em->getRepository('reservation');
        
        $reservations = $reservationRepository->findBy(
            array('voyage' => $voyage->id)
        );
        if($reservations == false){
        }

        return $reservations;

    }

    /**
     * fonction for get all reservations of trip with if of voyage
     */
    public static function getReservationByVoyageur($idVoyageur){

        $em = dbconnection::getInstance()->getEntityManager();
        $reservationRepository = $em->getRepository('reservation');
        
        $reservations = $reservationRepository->findBy(
            array('voyageur' => $idVoyageur)
        );
        if($reservations == false){
        }

        return $reservations;

    }


    /**
     * fonction for tha action to reserve a trip (add a new reservation into data base)
     */
    public static function reserveVoyage($voyageReservation, $voyageurReservation){

        $em = dbconnection::getInstance()->getEntityManager();

        $sql = "SELECT reserveVoyage('$voyageReservation', '$voyageurReservation')";
		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute();
	}
    
}

?>
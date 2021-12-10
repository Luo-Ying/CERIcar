<?php

require_once "reservation.class.php";

class reservationTable{

    public static function getReservationByVoyage($voyage){

        // echo $voyage->trajet->id;
        $em = dbconnection::getInstance()->getEntityManager();
        $reservationRepository = $em->getRepository('reservation');
        
        $reservations = $reservationRepository->findBy(
            array('voyage' => $voyage->id)
        );
        // echo "<br>ok<br>";
        // echo $reservation->id;
        if($reservations == false){
            echo "Erreur sql";
        }

        return $reservations;

    }

    public static function reserveVoyage($voyage, $voyageur){

		$em = dbconnection::getInstance()->getEntityManager();
		$reservation = new reservation();

		$reservation->voyage = $voyage;
		$reservation->voyageur = $voyageur;

		$em->persist($reservation);
		$em->flush();
	}
    
}

?>
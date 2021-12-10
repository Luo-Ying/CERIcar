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

    public static function reserveVoyage($voyageReservation, $voyageurReservation){

		// $em = dbconnection::getInstance()->getEntityManager();
		// $reservation = new reservation();

		// $reservation->voyage = $voyageReservation;
		// $reservation->voyageur = $voyageurReservation;

		// $em->persist($reservation);
		// $em->flush();
        $em = dbconnection::getInstance()->getEntityManager();

		// $sql = "SELECT * from correspondances('$trajet->depart','$trajet->arrivee',$seats)";
        $sql = "SELECT reserveVoyage('$voyageReservation', '$voyageurReservation')";
		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute();
        // $nbPlaceRestant = $stmt->fetchAll();
        // // var_dump($nbPlaceRestant);
        // return $nbPlaceRestant[0]["nbplacerestant"];
	}
    
}

?>
<?php

class mainController
{

	// <----------------------------test du debut--------------------------------->
	public static function helloWorld($request,$context)
	{
		$context->mavariable="hello world";
		return context::SUCCESS;
	}

	public static function header($request,$context){
		return context::SUCCESS;
	}

	public static function index($request,$context){
		return context::SUCCESS;
	}

	public static function loginIndex($request, $context){
		return context::SUCCESS;
	}

	public static function register($request, $context){
		return context::SUCCESS;
	}

	public static function proposerVoyageIndex($request, $context){
		return context::SUCCESS;
	}

	public static function proposerVoyageSuivant($request, $context){
		if(isset($request['depart']) and isset($request['arrivee']) and isset($request['nbPlace'])){
			$context->trajetProposer = trajetTable::getTrajet($request['depart'], $request['arrivee']);
			$context->nbPlace = $request['nbPlace'];
			return context::SUCCESS;
		}
		return context::ERROR;
	}

	public static function proposerVoyage($request, $context){
		var_dump($request);
		if(isset($request['conducteur']) 
		&& isset($request['trajet']) 
		&& isset($request['tarif'])
		&& isset($request['nbPlace'])
		&& isset($request['heuredepart'])){
			// echo "okskdlfkjsabvlniuabe;rlkgnvSL";
			voyageTable::proposerVoyage($request['conducteur'],
										$request['trajet'],
										$request['tarif'],
										$request['nbPlace'],
										$request['heuredepart'],
										$request['contraintes']);
			return context::SUCCESS;
		}
	}

	public static function banner(array $request, $context)
	{
		$trajet = trajetTable::getTrajet($request['depart'], $request['arrivee']);
		// $user = utilisateurTable::getUserByLoginAndPass($request['identifiant'], $request['pass']);
		$context->hasVoyages = (bool) voyageTable::getVoyagesByTrajet($trajet);
		
		if(isset($request['message'])){
			$context->message = $request['message'];
			$context->criticality = $request['criticality'] ?? 'success';
			$context->title = $request['title'] ?? 'success';
		}
		// verifier le cherche de la voyage
		// if((isset($request['depart']) && isset($request['arrivee'])) && (($request['depart'] != null) && ($request['arrivee'] != null))){
		// 	if($context->hasVoyages) {
		// 		$context->message = 'Recherche terminée ';
		// 		$context->criticality = 'success';
		// 		$context->title = 'success';
		// 	} 
		// 	else {
		// 		$context->message = 'Il n\'y a pas de trajet !';
		// 		$context->criticality = 'alert';
		// 		$context->title = 'warning';
		// 	}
		// }
		// // else{
		// else if((isset($request['depart']) && isset($request['arrivee'])) && (($request['depart'] == null) && ($request['arrivee'] == null))){
		// 	$context->message = 'Le champ de départ ou Destination est onligatoire !';
		// 	$context->criticality = 'warning';
		// 	$context->title = 'error';
		// }
		// }
		// TODO: [Poste d\'annonce reussit...] / [xxxx(champ) est obligatoire !]

		return context::SUCCESS;
	}


	// test module for etape 2 
	
	public static function checkLogin(array $request, $context)
	{

		if(isset($request['login']) and isset($request['pass'])) {
			$user = utilisateurTable::getUserByLoginAndPass($request['login'], $request['pass']);

			if(!$user){
				echo "is_login:false";
				return context::SUCCESS;
			}
			else{
				echo "is_login:true";
				$context->setSessionAttribute('userId', $user->identifiant);
				// $_SESSION['userId'] = $user->identifiant;
				// $context->setSessionAttribute('userIdChiffre', $user->id);
				$context->user = utilisateurTable::getUserByUsername($user->identifiant);
				$context->setSessionAttribute('userIdChiffre', $context->user->id);
				return context::ERROR;
			}
		}
		return context::ERROR;
	}
	
	// public static function checkLogin(array $request, $context){
	// 	if(!isset($request['login']) or !isset($request['pass'])){
	// 		return context::ERROR;
	// 	}

	// 	$user = utilisateurTable::getUserByLoginAndPass($request['login'], $request['pass']);

	// 	if(!$user){
	// 		return context::ERROR;
	// 	}

	// 	$context->setSessionAttribute('userId', $user->identifiant);

	// 	return context::SUCCESS;
	// }

	public static function logout($request, $context){
		if($context->getSessionAttribute('userId') != NUll)
		{
			session_unset(); 
			session_destroy(); 
		}
		return context::SUCCESS;
	}

	public static function getUserByIdentifiant($request, $context){
		if(isset($request['identifiant'])){
			$context->identifiant = $request['identifiant'];
			$user = utilisateurTable::getUserByUsername($context->identifiant);
			$context->user = $user;
			return context::SUCCESS;
		}
	}

	public static function profil($request, $context){
		if(isset($request['identifiant'])){
			// echo "pass";
			$context->identifiant = $request['identifiant'];
			// echo var_dump($context->identifiant);
			$context->user = utilisateurTable::getUserByUsername($context->identifiant);
			// echo var_dump($context->user);
			// echo $context->user->id;
			// echo var_dump(reservationTable::getReservationByVoyageur($context->user->id));
			$context->reservationsOfUser = reservationTable::getReservationByVoyageur($context->user->id);
			// echo var_dump($context->reservationsOfUser);
			$context->propositionVoyageOfUser = voyageTable::getVoyageByConducteur($context->user->id);

			return context::SUCCESS;
		}
		return context::ERROR;
	}

	public static function checkUserName($request, $context){
		if(isset($request['identifiant'])){
			$user = utilisateurTable::getUserByUsername($request['identifiant']);
			if(!$user){
				echo "userName:ok";
				return context::SUCCESS;
			}
			echo "userName:exist";
			return context::ERROR;
		}
		return context::ERROR;
	}

	public static function addNewUser($request, $context){
		if(isset($request['identifiant']) && isset($request['nom']) && isset($request['prenom']) && isset($request['pass']) && isset($request['avatar'])){
			utilisateurTable::addNewUser($request['identifiant'], $request['nom'], $request['prenom'], $request['pass'], $request['avatar']);
			return $context::SUCCESS;
		}
		return $context::ERROR;
	}


	public static function trajetTest($request, $context){
		if(isset($request['depart']) and isset($request['arrivee'])){
			$context->depart = $request['depart'];
			$context->arrivee = $request['arrivee'];
			$trajet = trajetTable::getTrajet($context->depart, $context->arrivee);
			$context->trajet = $trajet;
			return context::SUCCESS;
		}
	}

	public static function searchVoyages($request, $context){
		mainController::trajetTest($request, $context);
		$voyages = voyageTable::getVoyagesByTrajet($context->trajet);
		foreach( $voyages as $voyage ){
			$voyage->nbPlaceRestant = voyageTable::getNbPlaceRestantByIdVoyage($voyage->id);
			// echo $voyage->nbPlaceRestant;
		}
		$context->voyages = $voyages;
		return context::SUCCESS;
	}

	public static function pageReservationVoyage($request, $context){
		if( isset($request['idVoyage'])
		&& isset($request['heureDepart']) 
		&& isset($request['heureArrivee']) 
		&& isset($request['villeDepart'])
		&& isset($request['villeArrivee'])
		&& isset($request['conducteur'])
		&& isset($request['conducteurIdentifiant'])
		&& isset($request['contraintes'])
		&& isset($request['tarif'])
		&& isset($request['nbPlaceRestant'])){
			// echo "function pageVoyage ok";
			$context->pageVoyageIdVoyage = $request['idVoyage'];
			// echo $context->pageVoyageIdVoyage;
			$context->pageVoyageHeureDepart = $request['heureDepart'];
			// echo $context->pageVoyageHeureDepart;
			$context->pageVoyageHeureArrivee = $request['heureArrivee'];
			$context->pageVoyageVilleDepart = $request['villeDepart'];
			$context->pageVoyageVilleArrivee = $request['villeArrivee'];
			$context->pageVoyageConducteur = $request['conducteur'];
			$context->pageVoyageConducteurIdentifiant = $request['conducteurIdentifiant'];
			$context->pageVoyageContraintes = $request['contraintes'];
			// echo $context->pageVoyageContraintes;
			$context->pageVoyageTarif = $request['tarif'];
			$context->pageVoyagenbPlaceRestant = $request['nbPlaceRestant'];
			return context::SUCCESS;
		}
		return context::ERROR;
	}

	public static function reserveVoyage($request, $context){
		// echo "oasdbas,jhbfl.ewjnf.kSNFc.JBEJfvhbzdr,jhgejrbg,mzdbjhb,djhfbvkashbflauiwhebvf,kasjebgwehesj vks.jncf,j";
		if(isset($request['voyage']) && isset($request['voyageur'])){
			// echo "ok";
			reservationTable::reserveVoyage($request['voyage'], $request['voyageur']);
			return $context::SUCCESS;
		}
		return $context::ERROR;
	}


	// public static function reservationsTest($request, $context){
	// 	if(isset($request['idVoyage'])){
	// 		$context->idVoyage = $request['idVoyage'];
	// 		// echo $context->idVoyage;
	// 		mainController::searchVoyages($request, $context);
	// 		// echo "nb voyages: ", sizeof($context->voyages), "<br>";
	// 		// echo "id voyage: ", $context->voyages[0]->trajet->id, "<br>";
	// 		foreach($context->voyages as $voyage){
	// 			// echo "<br>ok<br>";
	// 			// echo $voyage->id;
	// 			// if()
	// 			// echo $voyage->id, "<br>";
	// 			// echo $context->idVoyage, "<br>";
	// 			if($voyage->id == $context->idVoyage){
	// 				// echo "<br>ok<br>";
	// 				$context->voyage = $voyage;
	// 				$reservations = reservationTable::getReservationByVoyage($context->voyage);
				
	// 			}
	// 		}
	// 		$context->reservations = $reservations;
	// 		return context::SUCCESS;
	// 		// echo $context->voyage->id;
	// 	}
	// }

	// public static function proposerVoyage($request, $context){
		
	// }

}

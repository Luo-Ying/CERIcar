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
		// echo "ok";
		return context::SUCCESS;
	}

	public static function loginIndex($request, $context){
		return context::SUCCESS;
	}

	public static function banner(array $request, $context)
	{
		$trajet = trajetTable::getTrajet($request['depart'], $request['arrivee']);
		// $user = utilisateurTable::getUserByLoginAndPass($request['identifiant'], $request['pass']);
		$context->hasVoyages = (bool) voyageTable::getVoyagesByTrajet($trajet);
		
		if(isset($request['message'])){
			$context->message = $request['message'];
			$context->criticality = $request['criticality'] ?? 'success';
			$context->title = $request['title'];
		}
		// verifier le cherche de la voyage
		if((isset($request['depart']) && isset($request['arrivee'])) && (($request['depart'] != null) && ($request['arrivee'] != null))){
			if($context->hasVoyages) {
				$context->message = 'Recherche terminée ';
				$context->criticality = 'success';
				$context->title = 'success';
			} 
			else {
				$context->message = 'Il n\'y a pas de trajet !';
				$context->criticality = 'alert';
				$context->title = 'warning';
			}
		}
		// else{
		else if((isset($request['depart']) && isset($request['arrivee'])) && (($request['depart'] == null) && ($request['arrivee'] == null))){
			$context->message = 'Le champ de départ ou Destination est onligatoire !';
			$context->criticality = 'warning';
			$context->title = 'error';
		}
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


	public static function getUserByIdTest($request, $context){
		if(isset($request['id'])){
			$context->id = $request['id'];
			$user = utilisateurTable::getUserById($context->id);
			$context->user = $user;
			return context::SUCCESS;
		}
	}


	public static function trajetTest($request, $context){
		// echo "ok";
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
		$context->voyages = $voyages;
		// $context->distance = $context->trajet->distance;
		return context::SUCCESS;
	}


	public static function reservationsTest($request, $context){
		if(isset($request['idVoyage'])){
			$context->idVoyage = $request['idVoyage'];
			// echo $context->idVoyage;
			mainController::searchVoyages($request, $context);
			// echo "nb voyages: ", sizeof($context->voyages), "<br>";
			// echo "id voyage: ", $context->voyages[0]->trajet->id, "<br>";
			foreach($context->voyages as $voyage){
				// echo "<br>ok<br>";
				// echo $voyage->id;
				// if()
				// echo $voyage->id, "<br>";
				// echo $context->idVoyage, "<br>";
				if($voyage->id == $context->idVoyage){
					// echo "<br>ok<br>";
					$context->voyage = $voyage;
					$reservations = reservationTable::getReservationByVoyage($context->voyage);
				
				}
			}
			$context->reservations = $reservations;
			return context::SUCCESS;
			// echo $context->voyage->id;
		}
	}
}

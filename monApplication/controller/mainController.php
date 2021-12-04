<?php

class mainController
{

	// <----------------------------test du debut--------------------------------->
	public static function helloWorld($request,$context)
	{
		$context->mavariable="hello world";
		return context::SUCCESS;
	}

	public static function index($request,$context){
		// echo "ok";
		return context::SUCCESS;
	}

	public static function login($request, $context){
		return context::SUCCESS;
	}

	public static function banner(array $request, $context)
	{
		$trajet = trajetTable::getTrajet($request['depart'], $request['arrivee']);
		$user = utilisateurTable::getUserByLoginAndPass($request['identifiant'], $request['pass']);
		$context->hasVoyages = (bool) voyageTable::getVoyagesByTrajet($trajet);

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
		else if((isset($request['identifiant']) && isset($request['pass'])) && (($request['identifiant'] != null) && ($request['pass'] != null))){
			if($user){
				$context->message = 'Bienvenu !';
				$context->criticality = 'success';
				$context->title = 'success';
			}
			else{
				$context->message = 'Votre compte ou mot de pass n\'est pas bon !';
				$context->criticality = 'danger';
				$context->title = 'error';
			}
		}
		else{
			if((isset($request['depart']) && isset($request['arrivee'])) && (($request['depart'] == null) && ($request['arrivee'] == null))){
				$context->message = 'Le champ de départ ou Destination est onligatoire !';
				$context->criticality = 'warning';
				$context->title = 'error';
			}
			else if(($request['identifiant'] == null) && ($request['pass'] == null)){
				$context->message = 'Le champ de Username ou Password est onligatoire !';
				$context->criticality = 'warning';
				$context->title = 'error';
			}
		}
		// TODO: [Poste d\'annonce reussit...] / [xxxx(champ) est obligatoire !]

		return context::SUCCESS;
	}


	// test module for etape 2 
	
	public static function checkLogin(array $request, $context)
	{

		if(isset($request['login']) and isset($request['pass'])) {
			$context->login = $request['login'];
			$context->pass = $request['pass'];

			$user = utilisateurTable::getUserByLoginAndPass($context->login, $context->pass);
			$context->user = $user;

			if($user){
				$context->setSessionAttribute('userId', $user->identifiant);
				$context->setSessionAttribute('userPass', $user->pass);
				$context->setSessionAttribute('is_login', true);
				echo "is_login:true";
				// $data = json_decode($request['']);
				return context::SUCCESS;
			}
			else{
				return context::ERROR;
			}
		}
		return context::ERROR;
	}

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

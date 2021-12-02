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

	public static function banner(array $request, $context)
	{
		$trajet = trajetTable::getTrajet($request['depart'], $request['arrivee']);
		$context->hasVoyages = (bool) voyageTable::getVoyagesByTrajet($trajet);

		if ($context->hasVoyages) {
			$context->message = 'Recherche terminée ';
			$context->criticality = 'success';
			$context->title = 'success';
		} 
		else {
			$context->message = 'Il n\'y a pas de trajet !';
			$context->criticality = 'alert';
			$context->title = 'warning';
		}
		// TODO: [Poste d\'annonce reussit...] / [xxxx(champ) est obligatoire !]

		return context::SUCCESS;
	}


	// test module for etape 2 
	
	public static function getUserByLoginAndPassTest(array $request, $context)
	{
		if(isset($request['login']) and isset($request['pass'])) {
			$context->login = $request['login'];
			$context->pass = $request['pass'];

			$user = utilisateurTable::getUserByLoginAndPass($context->login, $context->pass);

			$context->user = $user;

			return context::SUCCESS;
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

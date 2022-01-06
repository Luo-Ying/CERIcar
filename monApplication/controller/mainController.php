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

	/**
	 * controller propose trip
	 */

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


	/**
	 * fonction for propose trip
	 */
	public static function proposerVoyage($request, $context){
		var_dump($request);
		if(isset($request['conducteur']) 
		&& isset($request['trajet']) 
		&& isset($request['tarif'])
		&& isset($request['nbPlace'])
		&& isset($request['heuredepart'])){
			voyageTable::proposerVoyage($request['conducteur'],
										$request['trajet'],
										$request['tarif'],
										$request['nbPlace'],
										$request['heuredepart'],
										$request['contraintes']);
			return context::SUCCESS;
		}
	}


	/**
	 * controller banner
	 */

	public static function banner(array $request, $context)
	{
		$trajet = trajetTable::getTrajet($request['depart'], $request['arrivee']);
		$context->hasVoyages = (bool) voyageTable::getVoyagesByTrajet($trajet);
		
		if(isset($request['message'])){
			$context->message = $request['message'];
			$context->criticality = $request['criticality'] ?? 'success';
			$context->title = $request['title'] ?? 'success';
		}

		return context::SUCCESS;
	}


	
	/**
	 * check if user is logged in
	 */

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
				$context->user = utilisateurTable::getUserByUsername($user->identifiant);
				$context->setSessionAttribute('userIdChiffre', $context->user->id);
				return context::ERROR;
			}
		}
		return context::ERROR;
	}
	

	/**
	 * fonction for logout
	 */
	public static function logout($request, $context){
		if($context->getSessionAttribute('userId') != NUll)
		{
			session_unset(); 
			session_destroy(); 
		}
		return context::SUCCESS;
	}


	/**
	 * fonction for get the user with identifiant(username)
	 */
	public static function getUserByIdentifiant($request, $context){
		if(isset($request['identifiant'])){
			$context->identifiant = $request['identifiant'];
			$user = utilisateurTable::getUserByUsername($context->identifiant);
			$context->user = $user;
			return context::SUCCESS;
		}
	}

	/**
	 * controller send the information to go to the profile page
	 */

	public static function profil($request, $context){
		if(isset($request['identifiant'])){
			$context->identifiant = $request['identifiant'];
			$context->user = utilisateurTable::getUserByUsername($context->identifiant);
			$context->reservationsOfUser = reservationTable::getReservationByVoyageur($context->user->id);
			$context->propositionVoyageOfUser = voyageTable::getVoyageByConducteur($context->user->id);

			return context::SUCCESS;
		}
		return context::ERROR;
	}

	/**
	 * function for chek the user name
	 */
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


	/**
	 * fonction for add new user into data base (register)
	 */
	public static function addNewUser($request, $context){
		if(isset($request['identifiant']) && isset($request['nom']) && isset($request['prenom']) && isset($request['pass']) && isset($request['avatar'])){
			utilisateurTable::addNewUser($request['identifiant'], $request['nom'], $request['prenom'], $request['pass'], $request['avatar']);
			return $context::SUCCESS;
		}
		return $context::ERROR;
	}


	/**
	 * fonction for get trajet in the data base with name of city of depart and arrival
	 */
	public static function trajetTest($request, $context){
		if(isset($request['depart']) and isset($request['arrivee'])){
			$context->depart = $request['depart'];
			$context->arrivee = $request['arrivee'];
			$trajet = trajetTable::getTrajet($context->depart, $context->arrivee);
			$context->trajet = $trajet;
			return context::SUCCESS;
		}
	}


	/**
	 * fonction for searching trip with trajet
	 */
	public static function searchVoyages($request, $context){
		mainController::trajetTest($request, $context);
		$voyages = voyageTable::getVoyagesByTrajet($context->trajet);
		foreach( $voyages as $voyage ){
			$voyage->nbPlaceRestant = voyageTable::getNbPlaceRestantByIdVoyage($voyage->id);
		}
		$context->voyages = $voyages;
		return context::SUCCESS;
	}


	/**
	 * controller call the function to get all correspondings
	 */

	public static function searchVoyageCorrespondance($request, $context){
		if(isset($request['depart']) && isset($request['arrivee'])){
			$context->tabCorrespondance = voyageTable::getCorrespondanceVoyagesByDepartArrivee($request['depart'], $request['arrivee']);

			return context::SUCCESS;
		}
		return context::ERROR;
	}

	/**
	 * controller send the information to go to the reservation page
	 */

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
			$context->pageVoyageIdVoyage = $request['idVoyage'];
			$context->pageVoyageHeureDepart = $request['heureDepart'];
			$context->pageVoyageHeureArrivee = $request['heureArrivee'];
			$context->pageVoyageVilleDepart = $request['villeDepart'];
			$context->pageVoyageVilleArrivee = $request['villeArrivee'];
			$context->pageVoyageConducteur = $request['conducteur'];
			$context->pageVoyageConducteurIdentifiant = $request['conducteurIdentifiant'];
			$context->pageVoyageContraintes = $request['contraintes'];
			$context->pageVoyageTarif = $request['tarif'];
			$context->pageVoyagenbPlaceRestant = $request['nbPlaceRestant'];
			return context::SUCCESS;
		}
		return context::ERROR;
	}

	/**
	 * fonction for reserve trip
	 */
	public static function reserveVoyage($request, $context){
		if(isset($request['voyage']) && isset($request['voyageur'])){
			reservationTable::reserveVoyage($request['voyage'], $request['voyageur']);
			return $context::SUCCESS;
		}
		return $context::ERROR;
	}



}

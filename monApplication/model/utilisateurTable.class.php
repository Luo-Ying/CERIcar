<?php

/**
 * objet utilisateur liee base de donne
 */

require_once "utilisateur.class.php";

class utilisateurTable {


	/**
	 * fonction get user with identifiant(username) and password
	 */
	public static function getUserByLoginAndPass($login,$pass){

		$em = dbconnection::getInstance()->getEntityManager() ;

		$userRepository = $em->getRepository('utilisateur') ;

		$user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => $pass));

		return $user; 
	}


	/**
	 * fonction get user with identifiant(username)
	 */
	public static function getUserByUsername($identifiant){	

		$em = dbconnection::getInstance()->getEntityManager();

		$userRepository = $em->getRepository('utilisateur');

		$user = $userRepository->findOneBy(array('identifiant' => $identifiant));

		if($user == false){
		}

		return $user;

	}


	/**
	 * fonction for add new user into data base with the method of doctrine(persist)
	 */
	public static function addNewUser($identifiantUser, $nomUser, $prenomUser, $passUser, $avatarUser){
		
		$em = dbconnection::getInstance()->getEntityManager();

		$utilisateur = new utilisateur();

		$utilisateur->identifiant = $identifiantUser;
		$utilisateur->pass = $passUser;
		$utilisateur->nom = $nomUser;
		$utilisateur->prenom = $prenomUser;
		$utilisateur->avatar = $avatarUser;

		$em->persist($utilisateur);
		$em->flush();
	}

  
}


?>

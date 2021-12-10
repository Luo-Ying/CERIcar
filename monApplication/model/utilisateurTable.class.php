<?php

require_once "utilisateur.class.php";

class utilisateurTable {

	public static function getUserByLoginAndPass($login,$pass){

		$em = dbconnection::getInstance()->getEntityManager() ;

		$userRepository = $em->getRepository('utilisateur') ;
		//echo "ok";
		// $user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => sha1($pass)));	
		$user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => $pass));

		//echo $user->id;
		// if ($user == false){
		// 	// echo 'Erreur sql';
		// 	echo "is_login: false";
		// }
		return $user; 
	}

	public static function getUserByUsername($identifiant){		// identifiant

		$em = dbconnection::getInstance()->getEntityManager();

		$userRepository = $em->getRepository('utilisateur');

		$user = $userRepository->findOneBy(array('identifiant' => $identifiant));

		if($user == false){
			echo 'Erreur sql';
		}

		return $user;

	}


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

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

	public static function getUserByUsername($id){		// identifiant

		$em = dbconnection::getInstance()->getEntityManager();

		$userRepository = $em->getRepository('utilisateur');

		$user = $userRepository->findOneBy(array('identifiant' => $id));

		if($user == false){
			echo 'Erreur sql';
		}

		return $user;

	}


	public static function addNewUser($identifiantUser, $nomUser, $prenomUser, $passUser, $avatarUser){
		// $em = dbconnection::getInstance()->getEntityManager()->getConnection() ;
		$em = dbconnection::getInstance()->getEntityManager();
		// $query = $em->prepare('select addNewUser('+$identifiantUser+','+ $passUser+','+ $nomUser+','+ $prenomUser+','+ $avatarUser+')');
		// $bool = $query->execute();
		// echo "ok";
		// echo $bool;
		$utilisateur = new utilisateur();

		$utilisateur->identifiant = $identifiantUser;
		$utilisateur->pass = $passUser;
		$utilisateur->nom = $nomUser;
		$utilisateur->prenom = $prenomUser;
		$utilisateur->avatar = $avatarUser;
		// if ($bool == false){
		// 	return NULL;
		// }
		// return $query->fetchAll(); // retourne un tableau d'enregistrements (tableau de tableaux de valeurs)
		// return $bool;
		$em->persist($utilisateur);
		$em->flush();
	}

  
}


?>

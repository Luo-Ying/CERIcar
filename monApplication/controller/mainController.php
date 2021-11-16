<?php

class mainController
{

	// <----------------------------test du debut--------------------------------->
	public static function helloWorld($request,$context)
	{
		$context->mavariable="hello world";
		return context::SUCCESS;
	}

	// public static function BE($request,$context)
	// {
	// 	$context->error="I'm so cute";
	// 	return context::ERROR;	//context: ERROR
	// }

	// public static function BEnone($request,$context)
	// {
	// 	$context->error="I'm so cute";
	// 	return context::NONE;	//context: NONE
	// }

	// public static function superTest($request,$context)
	// {
	// 	$context->mavariable1=$_GET["mavariable1"];
	// 	$context->mavariable2=$_GET["mavariable2"];
	// 	// $context->er
	// 	return context::SUCCESS;
	// }


	public static function index($request,$context){
		// echo "ok";
		return context::SUCCESS;
	}


	// test module for etape 2 
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

	// public static function userTest($request,$context){
	// 	// echo "ok";
	// 	if(isset($request['login']) and isset($request['pass'])){
	// 		$context->login = $request['login'];
	// 		$context->pass = $request['pass'];
	// 		// echo $context->login, $context->pass;
	// 		$user = utilisateurTable::getUserByLoginAndPass($context->login, $context->pass);
	// 		// echo "ok";
	// 		$context->user = $user;
	// 		return context::SUCCESS;
	// 	}  
		
	// }


}

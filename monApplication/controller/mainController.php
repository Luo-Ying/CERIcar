<?php

class mainController
{

	public static function helloWorld($request,$context)
	{
		$context->mavariable="hello world";
		return context::SUCCESS;
	}

	public static function BE($request,$context)
	{
		$context->error="I'm so cute";
		return context::ERROR;	//context: ERROR
	}

	public static function BEnone($request,$context)
	{
		$context->error="I'm so cute";
		return context::NONE;	//context: NONE
	}

	public static function superTest($request,$context)
	{
		$context->mavariable1=$_GET["mavariable1"];
		$context->mavariable2=$_GET["mavariable2"];
		// $context->er
		return context::SUCCESS;
	}


	public static function index($request,$context){
		
		return context::SUCCESS;
	}




}

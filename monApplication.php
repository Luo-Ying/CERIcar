<?php error_reporting(0); ?>

<?php


//nom de l'application
$nameApp = "monApplication";

//action par défaut
$action = "index";
// $action = "helloWorld";
// $action = "BE";

if(key_exists("action", $_REQUEST))
$action =  $_REQUEST['action'];

require_once 'lib/core.php';
require_once $nameApp.'/controller/mainController.php';	//include

foreach(glob($nameApp.'/model/*.class.php') as $model)
	include_once $model ;   

session_start();

$context = context::getInstance();	//recupere le context
$context->init($nameApp);

$view=$context->executeAction($action, $_REQUEST);

//traitement des erreurs de bases, reste a traiter les erreurs d'inclusion
if($view===false)
{
	echo "Une grave erreur s'est produite, il est probable que l'action ".$action." n'existe pas...";
	die;
}
//inclusion du layout qui va lui meme inclure le template view
elseif($view!=context::NONE)
{
	$template_view=$nameApp."/view/".$action.$view.".php";
	include($nameApp."/layout/".$context->getLayout().".php");
}

?>

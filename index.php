<?php

	session_start();

	date_default_timezone_set('UTC');
	setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

	//Test d'authentification de l'utilisateur
	if(!empty($_SESSION['CONNECT']) && $_SESSION['CONNECT'] == 1){
		
		$page=(isset($_GET['p'])?(isset($_SESSION['ID_UTIL'])?$_GET['p']:''):'');

		$_SESSION['last_page']=$page;

		$_SESSION['last_action'] = time();

		//Redirection de l'utilisateur authentifié vers l'accueil
		if($_SESSION['TYPE_COMPTE'] == 1 || $_SESSION['TYPE_COMPTE'] == 3)
			include_once('controllers/Admin.php');
		elseif($_SESSION['TYPE_COMPTE'] == 2)
			include_once('controllers/Oper.php');
		elseif($_SESSION['TYPE_COMPTE'] == 4 || $_SESSION['TYPE_COMPTE'] == 5)
			include_once('controllers/Drh.php');		
		elseif($_SESSION['TYPE_COMPTE'] == 6)
			include_once('controllers/Super.php');
	}else{
		//Redirection de l'utilisateur non authentifié vers la page d'authentification
		$_SESSION = array();
		include_once('controllers/Authentication.php');
	}

?>

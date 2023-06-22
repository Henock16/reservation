<?php
	include('../config/Connexion.php');
	include_once('../functions/EnvoiSMS_function.php');

	$action=$argv[1];
	$idreserv=$argv[2];

	EnvoiSMS($bdd,$action,$idreserv);			
?>


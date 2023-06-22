<?php
/*
    Date creation : 22-04-2021
    Auteur : Cellule SOLAS - ABRS
    Version:1.0
    Dernière modification : 22-04-2021
    Dernier modificateur : Cellule SOLAS - ABRS
    Description: effectuer lannulation d'une affectation ou le reje d'une reservation
*/
	session_start();

	include('../config/Connexion.php');

	include_once('../functions/Cancel_reject_function.php');
	include_once('../functions/Notification_function.php');
	include_once('../functions/EnvoiSMS_function.php');
	include_once('../functions/Table_value_function.php');
	include_once('../functions/Log_function.php');

	
    $tab=CancelReject($bdd,$_POST['action-id'],$_POST['confirmation-id'],$_POST['statut'],$_POST['motif'],$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);


?>
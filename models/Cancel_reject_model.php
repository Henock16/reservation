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

<<<<<<< HEAD
	include_once('../functions/Cancel_reject_function.php');
	include_once('../functions/Notification_function.php');
	include_once('../functions/EnvoiSMS_function.php');
	include_once('../functions/Table_value_function.php');
	include_once('../functions/Log_function.php');

	
    $tab=CancelReject($bdd,$_POST['action-id'],$_POST['confirmation-id'],$_POST['statut'],$_POST['motif'],$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
=======
	include_once('../functions/Notification_function.php');

	function CancelReject($bdd,$action,$idreserv,$statut,$ville,$affecteur){

			$query="UPDATE Reservation SET STATUT='".(($action==3)?"5":"1")."' WHERE IDENTIFIANT='".$idreserv."' AND STATUT='".(($action==3)?"1":"3")."'";
			$req1=$bdd->exec($query);

			$query="UPDATE Affectation SET STATUT='2' WHERE STATUT='1' AND RESERVATION='".$idreserv."'  ";
			$req2=(($action==3)?$req1:($req1?$bdd->exec($query):0));

			Notification($bdd,$action,$idreserv);			

			$tab[0]=(($req1&&$req2)?0:"Erreur liée à la base de données");


	return $tab;
	}
	
    $tab=CancelReject($bdd,$_POST['action-id'],$_POST['confirmation-id'],$_POST['statut'],$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);


?>
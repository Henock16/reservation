<?php
/*
    Date creation : 22-04-2021
    Auteur : Cellule SOLAS - ABRS
    Version:1.0
    Dernière modification : 22-04-2021
    Dernier modificateur : Cellule SOLAS - ABRS
    Description: effectuer laffectation dun agent a une reservation
*/
	session_start();

	include('../config/Connexion.php');

	include_once('../functions/Date_function.php');
	include_once('../functions/Table_value_function.php');
	include_once('../functions/Set_Affectation_function.php');

	
    $tab=SetAffectation($bdd,1,1,$_POST['action-id'],$_POST['inspecteur-id'],$_POST['reservation-id'],$_POST['statut'],$_POST['motif'],$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);


?>
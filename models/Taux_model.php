<?php
/*
    Date creation : 10-08-2021
    Auteur : Cellule SOLAS - ABRS
    Version:1.0
    Dernière modification : 10-08-2021
    Dernier modificateur : Cellule SOLAS - ABRS
    Description: Obtenir le taux de satidsfaction des reservations
*/
	session_start();

	include('../config/Connexion.php');

	include_once('../functions/Taux_function.php');

	$date=date("Y-m",strtotime(date("Y-m")." - ".$taux." month"));

	$mois=substr($date,5,2);
	$annee=substr($date,0,4);

	$tab=taux($bdd,$mois,$annee,$_POST['type'],$_SESSION['VILLE']);	
 

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);


?>
<?php
/*
    Date creation : 20-04-2021
    Auteur : Cellule SOLAS - ABRS
    Version:1.0
    Dernière modification : 20-04-2021
    Dernier modificateur : Cellule SOLAS - ABRS
    Description: Obtenir la liste des inspecteurs affectables
*/
	session_start();

	include('../config/Connexion.php');

	include_once('../functions/Date_function.php');
	include_once('../functions/Table_value_function.php');
	include_once('../functions/Get_Inspector_List_function.php');

    $tab=GetInspectorList($bdd,$_POST['id'],$_POST['action'],$_SESSION['VILLE'],$_SESSION['ID_UTIL'],$_SESSION['TYPE_COMPTE']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
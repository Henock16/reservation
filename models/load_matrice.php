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
	include_once('../functions/PDF_Matrice_function.php');


	if($mpdf==6)
		include("../mpdf/mpdf.php");
	elseif($mpdf==7)
		require_once '../vendors/autoload.php';

	$typeuser=(isset($_GET['typeuser'])?$_GET['typeuser']:'');
	$type=(isset($_GET['type'])?$_GET['type']:'');
	$mois=(isset($_GET['mois'])?$_GET['mois']:'');
	$semaine=(isset($_GET['semaine'])?$_GET['semaine']:'');
	$superviseur=(isset($_GET['superviseur'])?$_GET['superviseur']:'');


PDF_Matrice($typeuser,$_SESSION['ID_UTIL'],$type,$mois,$semaine,$superviseur);

?>
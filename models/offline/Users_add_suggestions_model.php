<?php
	/*
		Date creation : 27-01-2020
		Auteur : Cellule SOLAS - KAM
		Version:1.0
		Dernière modification : 27-01-2020
		Dernier modificateur : Cellule SOLAS - KAM
		Description: Insertion d'une nouvelle demande dans la base de données
	*/
	session_start();

	include_once('../../config/Connexion.php');
	include_once('../../functions/Users_request_create_code_function.php');


	$idutil=((isset($_SESSION['ID_UTIL'])&& $_SESSION['ID_UTIL']!=0)?$_SESSION['ID_UTIL']:0);
	
	$anonymat=((isset($_POST['anonyme']) && $_POST['anonyme'])?1:(($idutil==0)?1:0));
	
	$code = createCode($bdd, 8, date('Y'), isset($_SESSION['MATRICULE'])?$_SESSION['MATRICULE']:'0000');

	//Insertion du details de la suggestion
	$query = $bdd -> prepare("INSERT INTO suggestion (ID_AGENT, ANONYMAT, CODE, TYPE, TITRE, MESSAGE)
							VALUES (:idutil, :anonymat, :code, :type, :titre, :message)");
	$query -> bindParam(':idutil', $idutil , PDO::PARAM_INT);
	$query -> bindParam(':anonymat', $anonymat, PDO::PARAM_INT);
	$query -> bindParam(':code', $code, PDO::PARAM_STR);
	$query -> bindParam(':type', $_POST['type'], PDO::PARAM_INT);
	$query -> bindParam(':titre', $_POST['title'], PDO::PARAM_STR);
	$query -> bindParam(':message', $_POST['message'], PDO::PARAM_STR);
	$query -> execute();
	$query -> closeCursor();
	
	$tab[0]=0;
	

$bdd = null;

/* Output header */
header('Content-type: application/json');
echo json_encode($tab);
?>

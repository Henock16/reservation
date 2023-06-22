<?php
    
	session_start();

	include('../config/Connexion.php');
    

	
	$accord = $_POST['accord'];
	
	$actualise = $bdd -> prepare("UPDATE User SET ACCORD=:accord WHERE IDENTIFIANT=:id");
	$actualise -> bindParam(':accord', $accord, PDO::PARAM_INT);
	$actualise -> bindParam(':id', $_SESSION['ID_UTIL'], PDO::PARAM_INT);
	$actualise -> execute();
		
	$bdd = null;
	
	
?>


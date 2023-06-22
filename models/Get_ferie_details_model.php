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

function GetJoursFeriesDetails($bdd,$id,$iduser){

	$query="SELECT * FROM JoursFeries WHERE IDENTIFIANT= ".$id."";
	$result=$bdd->query($query);

	$rows=$result -> rowCount();
	
	$i=0;
	if($rows>0){
			
		$tab[$i] = $rows;
		$i++;
		while ($lign = $result->fetch()){
			
			$tab[$i]=$lign['IDENTIFIANT'];
			$i++;

			$tab[$i]=$lign['TYPE'];
			$i++;

			$tab[$i]=$lign['NOM'];
			$i++;

			$tab[$i]=dateservertosite($lign['DATE']);
			$i++;


		}
		$result->closeCursor();	
	}else
	    $tab[$i] = 0;
	  

	return $tab;
	}
	
    $tab=GetJoursFeriesDetails($bdd,$_POST['id'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
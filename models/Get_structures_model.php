<?php
/*
    Date creation : 20-04-2021
    Auteur : Cellule SOLAS - ABRS
    Version:1.0
    Dernière modification : 20-04-2021
    Dernier modificateur : Cellule SOLAS - ABRS
    Description: Obtenir la liste des structures
*/
	session_start();

	include('../config/Connexion.php');

	function GetStructures($bdd,$ville,$user){

		$query="SELECT * FROM Structure WHERE IDENTIFIANT>0 ORDER BY LIBELLE ";
		$result=$bdd->query($query);

		$i=0;
		$tab[$i]=0;
		$i++;
		
		$tab[$i]=$result -> rowCount();
		$i++;
		
		$tab[$i]=2;
		$i++;
		
		while ($donnees = $result->fetch()){
			
			$tab[$i]=$donnees['IDENTIFIANT'];
			$i++;

			$tab[$i]=$donnees['LIBELLE'];
			$i++;
		}
		$result->closeCursor();	

		return $tab;
	}
	
    $tab=GetStructures($bdd,$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
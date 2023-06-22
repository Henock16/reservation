<?php
/*
    Date creation : 18-05-2021
    Auteur : Cellule SOLAS - ABRS
    Version:1.0
    Dernière modification : 18-05-2021
    Dernier modificateur : Cellule SOLAS - ABRS
    Description: Obtenir les inspecteurs de poids
*/
	session_start();

	include('../config/Connexion.php');

	include_once('../functions/Date_function.php');
	include_once('../functions/Table_value_function.php');

	function GetSuperviseurs($bdd,$ville,$iduser){
						  
		$query="SELECT * FROM User WHERE TYPE_COMPTE=6 ".(($ville>0 && $_SESSION['TYPE_COMPTE']!=3)?"
		AND VILLE='".$ville."'":"")." ORDER BY NOM_RESPO ";
		$result=$bdd->query($query);

		$i=0;
		$tab[$i]=0;
		$i++;
				
		$tab[$i] = $result -> rowCount();
		$i++;

		$tab[$i]=2;
		$i++;

		while ($donnees = $result->fetch()){
			
			$tab[$i] = $donnees['IDENTIFIANT'];
			$i++;
						
			$tab[$i] = $donnees['NOM_RESPO'];
			$i++;
						
		}
		$result->closeCursor();	

		return $tab;
	}

    $tab=GetSuperviseurs($bdd,$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>

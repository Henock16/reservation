<?php
/*
    Date creation : 14-07-2021
    Auteur : Cellule SOLAS - ABRS
    Version:1.0
    Dernière modification : 14-07-2021
    Dernier modificateur : Cellule SOLAS - ABRS
    Description: Obtenir la liste des parametres
*/
	session_start();

	include('../config/Connexion.php');


	function GetParams($bdd,$ville,$user){

		$query="SELECT * FROM Parametre WHERE IDENTIFIANT>0 ORDER BY IDENTIFIANT ASC";
		$result=$bdd->query($query);

		$i=0;
		$tab[$i]=0;
		$i++;
		
		$tab[$i]=$result -> rowCount();
		$i++;
		
		$tab[$i]=6;
		$i++;

		while ($lign = $result->fetch()){
			
			$tab[$i]=$lign['IDENTIFIANT'];
			$i++;

			$tab[$i]=$lign['NOM'];
			$i++;

			$tab[$i]=$lign['LIBELLE'];
			$i++;

			$tab[$i]=$lign['VALEUR'];
			$i++;

			$tab[$i]=$lign['EXPLICATION'];
			$i++;

			$tab[$i]=$lign['TYPE'];
			$i++;
		}
		$result->closeCursor();	

		return $tab;
	}
	
    $tab=GetParams($bdd,$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
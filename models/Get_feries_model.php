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

	function GetJoursFeries($bdd,$ville,$user){

		$query="SELECT * FROM JoursFeries WHERE IDENTIFIANT>0 ORDER BY DATE DESC";
		$result=$bdd->query($query);

		$i=0;
		$tab[$i]=0;
		$i++;
		
		$tab[$i]=$result -> rowCount();
		$i++;
		
		while ($lign = $result->fetch()){
			
			$tab[$i]=$lign['IDENTIFIANT'];
			$i++;

			$tab[$i]=$lign['TYPE'];
			$i++;

			$tab[$i]=dateservertosite($lign['DATE']);
			$i++;

			$tab[$i]=$lign['NOM'];
			$i++;

			$tab[$i]=(($lign['DATE']<date('Y-m-d'))?1:0);
			$i++;
		}
		$result->closeCursor();	

		return $tab;
	}
	
    $tab=GetJoursFeries($bdd,$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
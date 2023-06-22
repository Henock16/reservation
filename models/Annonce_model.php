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

	function GetAnnonce($bdd){

		$query="SELECT * FROM annonce WHERE ID>0 AND ACTIF=0 ORDER BY ID DESC LIMIT 0,1";
		$result=$bdd->query($query);

		$i=0;
		$tab[$i]=1;
					
		while ($donnees = $result->fetch()){
			
			$tab[$i]=0;
			$i++;

			$tab[$i]=$donnees['TITRE'];
			$i++;

			$tab[$i]=$donnees['LIBELLE'];
			$i++;
		}
		$result->closeCursor();	

		return $tab;
	}
	
    $tab=GetAnnonce($bdd);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
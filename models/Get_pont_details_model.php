<?php
/*
    Date creation : 20-05-2021
    Auteur : Cellule SOLAS - ABRS
    Version:1.0
    Dernière modification : 20-05-2021
    Dernier modificateur : Cellule SOLAS - ABRS
    Description: Obtenir les detail dun site
*/
	session_start();

	include('../config/Connexion.php');

	function GetPontDetails($bdd,$id,$user){

		$query="SELECT * FROM Site WHERE IDENTIFIANT=".$id;
		$result=$bdd->query($query);

		$i=0;
	    $tab[$i] = $result -> rowCount();;
	    $i++;
	
		while ($donnees = $result->fetch()){
			
			$tab[$i]=$donnees['IDENTIFIANT'];
			$i++;

			$tab[$i] = $donnees['STATUT'];
			$i++;

			$tab[$i] = $donnees['NIVEAU'];
			$i++;

			$tab[$i] = $donnees['TYPE_SITE'];
			$i++;

			$tab[$i]=$donnees['CODE_SITE'];
			$i++;

			$tab[$i]=$donnees['LIBELLE'];
			$i++;

			$tab[$i] = $donnees['STRUCT'];
			$i++;

			$tab[$i] = $donnees['VILLE'];
			$i++;

			$tab[$i] = (($donnees['ADRESSE_GEO']==null)?'':$donnees['ADRESSE_GEO']);
			$i++;

			$tab[$i]=(($donnees['COORDON_GPS']==null)?'':$donnees['COORDON_GPS']);
			$i++;

			$tab[$i]=(($donnees['NOM_RESPO']==null)?'':$donnees['NOM_RESPO']);
			$i++;

			$tab[$i] = (($donnees['FONCTION_RESPO']==null)?'':$donnees['FONCTION_RESPO']);
			$i++;

			$tab[$i] = (($donnees['CONTACT_RESPO']==null)?'':$donnees['CONTACT_RESPO']);
			$i++;
<<<<<<< HEAD

			$tab[$i] = $donnees['QUARTIER'];
			$i++;
=======
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
			}
		$result->closeCursor();	

		return $tab;
	}
	
    $tab=GetPontDetails($bdd,$_POST['id'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
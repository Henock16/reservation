<?php
/*
    Date creation : 21-05-2021
    Auteur : Cellule SOLAS - ABRS
    Version:1.0
    Dernière modification : 21-05-2021
    Dernier modificateur : Cellule SOLAS - ABRS
    Description: Obtenir les detail dun utilisateur
*/
	session_start();

	include('../config/Connexion.php');
	include_once('../functions/Date_function.php');

	function GetUserDetails($bdd,$id,$user){

		$query="SELECT * FROM User WHERE IDENTIFIANT=".$id;
		$result=$bdd->query($query);

		$i=0;
	    $tab[$i] = $result -> rowCount();;
	    $i++;
	
		while ($donnees = $result->fetch()){
			
			$tab[$i]=$donnees['IDENTIFIANT'];
			$i++;

			$tab[$i] = $donnees['STATUT_COMPTE'];
			$i++;

			$tab[$i]=$donnees['FIRST_CONNECTION'];
			$i++;

			$tab[$i] = (($donnees['TYPE_COMPTE']!=null)?$donnees['TYPE_COMPTE']:0);
			$i++;

			$tab[$i] = $donnees['STRUCT'];
			$i++;

			$tab[$i]=$donnees['LOGIN'];
			$i++;

			$dern=$donnees['DERNIERE_CONNEXION'];
			$tab[$i]=(($dern!=null)?dateservertosite(substr($dern,0,10)).' à '.substr($dern,11,2).'h'.substr($dern,14,2).'m'.substr($dern,17,2).'s':'');		
			$i++;

			$tab[$i] = (($donnees['DERNIERE_ACTION']!=0)?$donnees['DERNIERE_ACTION']:'NON');
			$i++;

			$tab[$i] = (($donnees['TYPE_STRUCT']!=null)?$donnees['TYPE_STRUCT']:0);
			$i++;

			$tab[$i] = $donnees['VILLE'];
			$i++;

			$tab[$i]=(($donnees['SIGLE']==null)?'':$donnees['SIGLE']);
			$i++;

			$tab[$i]=(($donnees['NUM_CC']==null)?'':$donnees['NUM_CC']);
			$i++;

			$tab[$i] = (($donnees['ADRESSE_GEO']==null)?'':$donnees['ADRESSE_GEO']);
			$i++;

			$tab[$i]=(($donnees['NOM_RESPO']==null)?'':$donnees['NOM_RESPO']);
			$i++;

			$tab[$i] = (($donnees['FONCTION_RESPO']==null)?'':$donnees['FONCTION_RESPO']);
			$i++;

			$tab[$i] = (($donnees['CONTACT_RESPO']==null)?'':$donnees['CONTACT_RESPO']);
			$i++;
			}
		$result->closeCursor();	

		return $tab;
	}
	
    $tab=GetUserDetails($bdd,$_POST['id'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
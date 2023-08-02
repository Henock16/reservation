<?php
/*
    Date creation : 21-05-2021
    Auteur : Cellule SOLAS - ABRS
    Version:1.0
    Dernière modification : 21-05-2021
    Dernier modificateur : Cellule SOLAS - ABRS
    Description: Obtenir la liste des utilisateurs
*/
	session_start();

	include('../config/Connexion.php');

	include_once('../functions/Date_function.php');
	include_once('../functions/Table_value_function.php');

	function GetUsers($bdd,$ville,$user){

		$query="SELECT * FROM User WHERE IDENTIFIANT>0 ".(($ville>0 && $_SESSION['TYPE_COMPTE']!=3)?" 
		AND VILLE IN(".$ville.") ":"").(($_SESSION['TYPE_COMPTE']!=3)?" AND TYPE_COMPTE!=3 ":"")." ORDER BY LOGIN ";
		$result=$bdd->query($query);

		$i=0;
		$tab[$i]=0;
		$i++;
		
		$tab[$i]=$result -> rowCount();
		$i++;
		
<<<<<<< HEAD
		$tab[$i]=9;
=======
		$tab[$i]=8;
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
		$i++;
		
		while ($donnees = $result->fetch()){
			
			$tab[$i]=$donnees['IDENTIFIANT'];
			$i++;

<<<<<<< HEAD
			if($donnees['STRUCT']!=0)	
				$struct=getvalue($bdd,'LIBELLE','Structure','IDENTIFIANT',$donnees['STRUCT']);
			$tab[$i] = (($donnees['STRUCT']!=null)?$struct[0]:'');
=======
			$tab[$i]=$donnees['LOGIN'];
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
			$i++;

			$tab[$i] = $donnees['STATUT_COMPTE'];
			$i++;

			$tab[$i]=$donnees['FIRST_CONNECTION'];
			$i++;

			$tab[$i] = (($donnees['TYPE_COMPTE']!=null)?$donnees['TYPE_COMPTE']:'');
			$i++;

<<<<<<< HEAD
			$tab[$i]=$donnees['LOGIN'];
=======
			if($donnees['STRUCT']!=0)	
				$struct=getvalue($bdd,'LIBELLE','Structure','IDENTIFIANT',$donnees['STRUCT']);
			$tab[$i] = (($donnees['STRUCT']!=null)?$struct[0]:'');
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
			$i++;

			$tab[$i] = (($donnees['TYPE_STRUCT']!=null)?$donnees['TYPE_STRUCT']:0);
			$i++;

<<<<<<< HEAD
			$tab[$i] = $donnees['VILLE'];
			$i++;

			$tab[$i] = $donnees['BLOQUE'];
			$i++;
=======

			$tab[$i] = $donnees['VILLE'];
			$i++;

>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
		}
		$result->closeCursor();	

		return $tab;
	}
	
    $tab=GetUsers($bdd,$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
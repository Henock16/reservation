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
	include_once('../functions/Table_value_function.php');

function GetPonts($bdd,$ville,$user){

	$query="SELECT * FROM Site WHERE IDENTIFIANT>0 ".(($ville>0 && $_SESSION['TYPE_COMPTE']!=3)?" 
	AND VILLE='".$ville."'":"")." ORDER BY LIBELLE ";
	$result=$bdd->query($query);

	$i=0;
	$tab[$i]=0;
	$i++;
	
	$tab[$i]=$result -> rowCount();
	$i++;
	
	$tab[$i]=8;
	$i++;
	
	while ($donnees = $result->fetch()){
		
		$tab[$i]=$donnees['IDENTIFIANT'];
		$i++;

		$tab[$i]=$donnees['LIBELLE'];
		$i++;

		$tab[$i] = $donnees['STATUT'];
		$i++;

		$tab[$i]=$donnees['CODE_SITE'];
		$i++;

		$tab[$i] = $donnees['NIVEAU'];
		$i++;

		$tab[$i] = $donnees['TYPE_SITE'];
		$i++;

		if($donnees['STRUCT']!=0)	
			$struct=getvalue($bdd,'LIBELLE','Structure','IDENTIFIANT',$donnees['STRUCT']);
		$tab[$i] = (($donnees['STRUCT']!=null)?$struct[0]:'');
		$i++;

		$tab[$i] = $donnees['VILLE'];
		$i++;

	}
	$result->closeCursor();	

	return $tab;
	}
	
    $tab=GetPonts($bdd,$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
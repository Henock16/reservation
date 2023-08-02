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

	function GetInspecteurs($bdd,$ville,$iduser){
						  
		$query="SELECT * FROM Inspecteur WHERE STATUT='0' ".(($ville>0 && $_SESSION['TYPE_COMPTE']!=3)?"
		AND VILLE='".$ville."'":"")." ORDER BY NOM,PRENOMS ";
		$result=$bdd->query($query);

		$i=0;
		$tab[$i]=0;
		$i++;
				
		$tab[$i] = $result -> rowCount();
		$i++;

		$tab[$i]=6;
		$i++;

		while ($donnees = $result->fetch()){
			
			$tab[$i] = $donnees['IDENTIFIANT'];
			$i++;
						
			$tab[$i] = strtoupper($donnees['NOM']).' '.strtoupper($donnees['PRENOMS']);
			$i++;
											
			$tab[$i] = $donnees['STATUT'];
			$i++;

			$tab[$i] = $donnees['MATRICULE'];
			$i++;
						
			$tab[$i] = $donnees['VILLE'];
			$i++;
						
			if($donnees['SITE_AFFECTATION']!=0)				
				$site=getvalue($bdd,'LIBELLE,CODE_SITE','Site','IDENTIFIANT',$donnees['SITE_AFFECTATION']);
			
			$tab[$i] = (($donnees['SITE_AFFECTATION']!=0)?$site[0].' ':'');
			$i++;
		}
		$result->closeCursor();	

		return $tab;
	}

    $tab=GetInspecteurs($bdd,$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>

<?php
/*
    Date creation : 06-02-2020
    Auteur : Cellule SOLAS - KAM
    Version:1.0
    Dernière modification : 23-05-2020
    Dernier modificateur : Cellule SOLAS - ABRS
    Description: Obtenir les informations des demandes d'un agent
*/
	session_start();

	include('../config/Connexion.php');

	include_once('../functions/Date_function.php');
	include_once('../functions/Table_value_function.php');

 function GetInspectorsAffectations($bdd,$idagent,$iduser){
	 
	global $nbaffect; //nb daffectations a afficher
	
	$now=date('Y-m-d');
	
	$query="SELECT R.TYPE,S.LIBELLE,R.DATE_RESERVATION,R.PLAGE_HORAIRE,R.IDENTIFIANT 
			FROM Affectation A,Reservation R,Site S 
			WHERE A.INSPECTEUR='".$idagent."' AND A.STATUT='1' AND A.RESERVATION=R.IDENTIFIANT AND R.STATUT='3' AND S.IDENTIFIANT=R.SITE 
			ORDER BY R.DATE_RESERVATION DESC,R.PLAGE_HORAIRE DESC LIMIT 0,".$nbaffect." ";
	$result=$bdd->query($query);
	$rows = $result -> rowCount();

	$i=0;
	$tab[$i]=0;
	$i++;
    $tab[$i] = $rows;
    $i++;

	while ($lign = $result->fetch())
		{
		$tab[$i] = $lign['IDENTIFIANT'];
		$i++;
		$tab[$i] = $lign['TYPE'];
		$i++;
		$tab[$i] = dateservertosite($lign['DATE_RESERVATION']);
		$i++;
		$tab[$i] = $lign['PLAGE_HORAIRE'];
		$i++;
		$tab[$i] = $lign['LIBELLE'];
		$i++;
		//EXPIRE
		$tab[$i] = (($lign['DATE_RESERVATION']<$now ||($lign['DATE_RESERVATION']==$now && $lign['PLAGE_HORAIRE']==1))?0:1);
		$i++;					
		}
	$result->closeCursor();	
	  
	return $tab;
	}

    $tab=GetInspectorsAffectations($bdd,$_POST['id'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
<?php
/*
    Date creation : 22-04-2020
    Auteur : Cellule SOLAS - ABR0 Stephane
    Version:1.0
    Dernière modification : 22-04-2021
    Dernier modificateur : Cellule SOLAS - ABR0 Stephane
    Description: Obtenir les details d'une reservation
*/
	session_start();

	include('../config/Connexion.php');

	include_once('../functions/Date_function.php');
	include_once('../functions/Table_value_function.php');

 function GetReservationDetails($bdd,$reserv,$action,$ville,$iduser)
	{
		$query = "SELECT Reservation.IDENTIFIANT, Reservation.DATE_RESERVATION, Reservation.DATE_CREATION, Reservation.PLAGE_HORAIRE, Reservation.STATUT  ";
		$query .=",Site.LIBELLE,Site.STRUCTURE AS SITE_STRUCTURE,Site.CODE_SITE,User.LOGIN,User.STRUCTURE AS OPERATEUR_STRUCTURE ,Reservation.NOM_COMPLET ,Reservation.FONCTION ";
		$query .="FROM Reservation LEFT JOIN Site ON (Reservation.SITE = Site.IDENTIFIANT) LEFT JOIN User ON (Reservation.USER = User.IDENTIFIANT)";
		$query .="WHERE Reservation.IDENTIFIANT= ".$reserv."  ";

		//requete SQL
		$reponse=$bdd->query($query);

		$rows = $reponse -> rowCount();

		$i=0;
		if($rows>0){
			
	    $tab[$i] = $rows;
	    $i++;

		while ($donnees = $reponse->fetch())
			{

					$tab[$i] = $donnees['IDENTIFIANT'];
					$i++;
					
					//PONT
					$tab[$i] = $donnees['LIBELLE'];
					$i++;
					
					$tab[$i] = $donnees['SITE_STRUCTURE'];
					$i++;
					
					$tab[$i] = $donnees['CODE_SITE'];
					$i++;
					
					//DEMANDEUR
					$tab[$i] = $donnees['NOM_COMPLET'];
					$i++;
					
					$tab[$i] = $donnees['FONCTION'];
					$i++;
					
					$tab[$i] = $donnees['LOGIN'];
					$i++;
					
					$tab[$i] = $donnees['OPERATEUR_STRUCTURE'];
					$i++;
					
					//RESERVATION
					$tab[$i] = dateservertosite($donnees['DATE_RESERVATION']);
					$i++;
					
					$tab[$i] = dateservertosite(substr($donnees['DATE_CREATION'],0,10))." à ".substr($donnees['DATE_CREATION'],11,2)."h".substr($donnees['DATE_CREATION'],14,2);
					$i++;
					
					$tab[$i] = (($donnees['PLAGE_HORAIRE']==1)?'JOUR':(($donnees['PLAGE_HORAIRE']==2)?'NUIT':(($donnees['PLAGE_HORAIRE']==3)?'RELAIS':'NON DEFINI')));
					$i++;

					$stat=array("Statut","En attente","Annulée","Affectée","Avortée","Rejetée");
					  
					$tab[$i] = $stat[$donnees['STATUT']];
					$i++;
					
					//AGENT
					if($donnees['STATUT']==3){				
						$affect=getvalue($bdd,'INSPECTEUR,USER','Affectation','RESERVATION',$donnees['IDENTIFIANT']);
						$agent=getvalue($bdd,'NOM,PRENOMS,DATE_CREATION','Inspecteur','IDENTIFIANT',$affect[0]);						
						$user=getvalue($bdd,'LOGIN,STRUCTURE','User','IDENTIFIANT',$affect[1]);						
					}
					$tab[$i] = (($donnees['STATUT']==3)?$agent[0].' '.$agent[1]:'');
					$i++;
					
					$tab[$i] = (($donnees['STATUT']==3)?dateservertosite(substr($agent[2],0,10))." à ".substr($agent[2],11,2)."h".substr($agent[2],14,2):'');
					$i++;
					
					$tab[$i] = (($donnees['STATUT']==3)?$user[0]:'');
					$i++;
					
					$tab[$i] = (($donnees['STATUT']==3)?$user[1]:'');
					$i++;					
			}
		$reponse->closeCursor();	
	  }
	  else
	    $tab[$i] = 0;
	  

	return $tab;
	}

    $tab=GetReservationDetails($bdd,$_POST['id'],$_POST['action'],$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
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
	include_once('../functions/Last_day_function.php');
	include_once('../functions/Recapitulatif_function.php');


function util($util)
	{		
	return (!empty($util)?" AND Reservation.USER='".$util."' ":"");
	}


function statut($bdd,$stat)
	{		
	$datelimite=date('Y-m-d',strtotime(LastDay($bdd,"+")." days"));

	$where =" AND (Reservation.DATE_RESERVATION>'".date('Y-m-d')."' OR (Reservation.DATE_RESERVATION='".date('Y-m-d')."' AND Reservation.PLAGE_HORAIRE IN('3','2') )) ";			
	$where .=" AND (Reservation.DATE_RESERVATION<'".$datelimite."' OR (Reservation.DATE_RESERVATION='".$datelimite."' AND Reservation.PLAGE_HORAIRE='1')) ";		
	$where .=(($stat=='3')?" AND Reservation.STATUT='".$stat."' ":(($stat=='0')?" AND Reservation.STATUT IN('1','3') ":""));

	return $where;
	}

 function SendRecap($bdd,$type,$iduser,$ville){
	 		
			$select = "SELECT Reservation.IDENTIFIANT, Reservation.DATE_RESERVATION, Reservation.DATE_CREATION, Reservation.SITE, Reservation.USER, Reservation.PLAGE_HORAIRE, Reservation.STATUT ";
			$select .=",Site.LIBELLE,Site.STRUCTURE AS SITE_STRUCTURE,Site.CODE_SITE,User.LOGIN,User.STRUCTURE AS OPERATEUR_STRUCTURE ";
			$from ="FROM Reservation LEFT JOIN Site ON (Reservation.SITE = Site.IDENTIFIANT) LEFT JOIN User ON (Reservation.USER = User.IDENTIFIANT) ";
			$where =" WHERE Reservation.IDENTIFIANT>0 ";
			$where .=(isset($type)?" AND Reservation.TYPE='".$type."' ":"");
			$order=" ".(($ville>0 && $_SESSION['TYPE_COMPTE'])?" AND Site.VILLE='".$ville."'":"")." ORDER BY Reservation.DATE_RESERVATION ASC, Reservation.PLAGE_HORAIRE ASC,Reservation.IDENTIFIANT ASC ";

			$query = $select.$from.$where.util("").statut($bdd,"0").$order;

			$nb_reserv=0;
			$nb_affect=0;
			$nb_today=0;
			$nb_affect_today=0;
			$reponse=$bdd->query($query);
			while ($donnees = $reponse->fetch())
				{
				$nb_reserv++;
				$nb_affect+=(($donnees['STATUT']=="3")?1:0);
				}
			$reponse->closeCursor();	

			if(!$nb_reserv)
				$tab=array(1);
			else if(!$nb_affect)
				$tab=array(2);
			else if(($nb_affect<$nb_reserv))
				$tab=array(3,$nb_affect,$nb_reserv);
			else
				{
				//envoyer le récap à chaque agent de la CCI
				$query = $select.$from.$where.util("").statut($bdd,"3").$order;	
				$chemin=recapitulatif($bdd,$query,'',($ville>0 && $_SESSION['TYPE_COMPTE'])?$ville:0);	
			
				//envoyer le recap a chacun des opérateurs qui ont réservé
				$query = "SELECT DISTINCT Reservation.USER  FROM Reservation ".$where.statut($bdd,"3");
				$reponse=$bdd->query($query);
				while ($donnees = $reponse->fetch())
					{
					$query = $select.$from.$where.util($donnees['USER']).statut($bdd,"3").$order;
					recapitulatif($bdd,$query,$donnees['USER'],($ville>0 && $_SESSION['TYPE_COMPTE'])?$ville:0);
					}
				$reponse->closeCursor();				

				$tab=array(0,$nb_affect,$nb_reserv,$chemin);
				}
			return $tab;
	}

    $tab=SendRecap($bdd,0,$_SESSION['ID_UTIL'],$_SESSION['VILLE']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
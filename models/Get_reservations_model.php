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
	include_once('../functions/Last_day_function.php');
<<<<<<< HEAD
	include_once('../functions/Isdayofrest_function.php');
=======
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643

	function GetReservations($bdd,$type,$demand,$reserv,$util,$pont,$stat,$ville,$iduser){
	 
		$now=date('Y-m-d');
		
		$reserv=datesitetoserver($reserv);
		$demand=datesitetoserver($demand);

		global $nbdays; //0=nb jr off / >0=nb de jr / -1=infini
		$datelimite=date('Y-m-d',strtotime(($nbdays?(($stat=='6')?"-":"+").$nbdays:LastDay($bdd,(($stat=='6')?"-":"+")))." days"));
		$order=(($stat=='6')?"DESC":"ASC");
					  
		$query = "SELECT Reservation.IDENTIFIANT, Reservation.DATE_RESERVATION, Reservation.DATE_CREATION, Reservation.SITE, Reservation.USER, Reservation.PLAGE_HORAIRE, Reservation.STATUT  ";
<<<<<<< HEAD
		$query .=",Site.LIBELLE,Site.STRUCTURE AS SITE_STRUCTURE,Site.CODE_SITE,User.LOGIN,User.BLOQUE,User.STRUCTURE AS OPERATEUR_STRUCTURE ";
=======
		$query .=",Site.LIBELLE,Site.STRUCTURE AS SITE_STRUCTURE,Site.CODE_SITE,User.LOGIN,User.STRUCTURE AS OPERATEUR_STRUCTURE ";
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
		$query .="FROM Reservation LEFT JOIN Site ON (Reservation.SITE = Site.IDENTIFIANT) LEFT JOIN User ON (Reservation.USER = User.IDENTIFIANT)";
		$query .="WHERE Reservation.IDENTIFIANT>0 ".(($ville>0 && $_SESSION['TYPE_COMPTE']!=3)?" AND Site.VILLE='".$ville."'":"")."  ";
		$query .=" AND (Reservation.DATE_RESERVATION".(($stat=='6')?"<":">")."'".$now."' OR (Reservation.DATE_RESERVATION='".$now."' AND Reservation.PLAGE_HORAIRE ".(($stat=='6')?"NOT":"")." IN('3','2'))) ";			
		$query .=((($nbdays>=0)&&empty($reserv)&&empty($pont))?" AND (Reservation.DATE_RESERVATION".(($stat=='6')?">":"<")."'".$datelimite."' OR (Reservation.DATE_RESERVATION='".$datelimite."' AND Reservation.PLAGE_HORAIRE".(($stat=='6')?"<>":"=")."'1')) ":" ");		
		$query .=(!empty($reserv)?" AND Reservation.DATE_RESERVATION='".$reserv."' ":"");		
		$query .=(!empty($demand)?" AND Reservation.DATE_CREATION>='".$demand.' 00:00:00'."' AND Reservation.DATE_CREATION<='".$demand.' 23:59:59'."' ":"");		
		$query .=(!empty($util)?" AND Reservation.USER='".$util."' ":"");		
		$query .=(!empty($pont)?" AND Reservation.SITE='".$pont."' ":"");
		$query .=((($stat!='0')&&($stat!='6'))?" AND Reservation.STATUT='".$stat."' ":" "); //" AND Reservation.STATUT NOT IN('2') ");
		$query .=(isset($type)?" AND Reservation.TYPE='".$type."' ":"");
		$query .= " ORDER BY Reservation.DATE_RESERVATION ".$order.", Reservation.PLAGE_HORAIRE ".$order.",Reservation.IDENTIFIANT ".$order."";

		//requete SQL
		$reponse=$bdd->query($query);

		$i=0;
	    $tab[$i] = $reponse -> rowCount();
	    $i++;

		while ($donnees = $reponse->fetch()){

			$tab[$i] = $donnees['IDENTIFIANT'];
			$i++;
			
			$tab[$i] = dateservertosite($donnees['DATE_RESERVATION']);
			$i++;
			
			$tab[$i] = $donnees['PLAGE_HORAIRE'];
			$i++;
			
			//PONT
			$tab[$i] = $donnees['LIBELLE'];
			$i++;
						
			$tab[$i] = $donnees['STATUT'];
			$i++;
			
			//AGENT
			if($donnees['STATUT']==3){				
<<<<<<< HEAD
				$affect=getvalue($bdd,'IDENTIFIANT,INSPECTEUR','Affectation','RESERVATION',$donnees['IDENTIFIANT']);
				$agent=getvalue($bdd,'NOM,PRENOMS','Inspecteur','IDENTIFIANT',$affect[1]);				
=======
				$affect=getvalue($bdd,'INSPECTEUR','Affectation','RESERVATION',$donnees['IDENTIFIANT']);
				$agent=getvalue($bdd,'NOM,PRENOMS','Inspecteur','IDENTIFIANT',$affect[0]);				
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
			}
			$tab[$i] = (($donnees['STATUT']==3)?$agent[0].' '.$agent[1]:'');
			$i++;
			
			//EXPIRE
<<<<<<< HEAD
			$tab[$i] = (($donnees['DATE_RESERVATION']<$now ||($donnees['DATE_RESERVATION']==$now && $donnees['PLAGE_HORAIRE']==1))?0:1);
			$i++;			

			//BLOQUE
			$tab[$i] = ($donnees['BLOQUE'] && ($now<=$donnees['DATE_RESERVATION']) && ($donnees['PLAGE_HORAIRE']==2 || isdayofrest($bdd,$donnees['DATE_RESERVATION']) || in_array(date('w',mktime(0,0,0,substr($donnees['DATE_RESERVATION'],5,2),substr($donnees['DATE_RESERVATION'],8,2),substr($donnees['DATE_RESERVATION'],0,4))),array("6","0"))));
			$i++;
=======
			$tab[$i] = (($donnees['DATE_RESERVATION']<$now ||($donnees['DATE_RESERVATION']==$now && $donnees['PLAGE_HORAIRE']==1))?1:0);
			$i++;			
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
		}
		$reponse->closeCursor();	

	return $tab;
	}

    $tab=GetReservations($bdd,0,'',$_POST['date'],'',$_POST['pont'],$_POST['statut'],$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

<<<<<<< HEAD
?>
=======
?>
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643

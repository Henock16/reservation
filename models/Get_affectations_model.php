<?php
/*
    Date creation : 25-05-2021
    Auteur : Cellule SOLAS - ABRS
    Version:1.0
    Dernière modification : 25-05-2021
    Dernier modificateur : Cellule SOLAS - ABRS
    Description: Obtenir les affectations
*/
	session_start();

	include('../config/Connexion.php');
	include_once('../functions/Date_function.php');
	include_once('../functions/Table_value_function.php');
	include_once('../functions/Last_day_function.php');

	function GetAffectations($bdd,$fact,$debut,$fin,$inspecteur,$util,$pont,$type,$ville,$iduser){
	 
		$now=date('Y-m-d');
		
		$debut=datesitetoserver($debut);
		$fin=datesitetoserver($fin);

<<<<<<< HEAD
		global $nbdays,$tarif; //0=nb jr off / >0=nb de jr / -1=infini
=======
		global $nbdays; //0=nb jr off / >0=nb de jr / -1=infini
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
		$datelimite=date('Y-m-d',strtotime(($nbdays?"-".$nbdays:LastDay($bdd,"-"))." days"));
					  
		$query = "SELECT Reservation.IDENTIFIANT, Reservation.DATE_RESERVATION, Reservation.DATE_CREATION, ";
		$query .= "Reservation.SITE, Reservation.USER, Reservation.PLAGE_HORAIRE, Reservation.STATUT, ";
		$query .= "Affectation.INSPECTEUR, ";
<<<<<<< HEAD
		$query .="Site.LIBELLE,Site.STRUCTURE AS SITE_STRUCTURE,Site.VILLE,User.LOGIN,User.STRUCT AS OPERATEUR_STRUCTURE ";
=======
		$query .="Site.LIBELLE,Site.STRUCTURE AS SITE_STRUCTURE,Site.VILLE,User.LOGIN,User.STRUCTURE AS OPERATEUR_STRUCTURE ";
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
		$query .="FROM Reservation LEFT JOIN Site ON (Reservation.SITE = Site.IDENTIFIANT) ";
		$query .="LEFT JOIN User ON (Reservation.USER = User.IDENTIFIANT) ";
		$query .="LEFT JOIN Affectation ON (Reservation.IDENTIFIANT = Affectation.RESERVATION)";
		$query .="WHERE Reservation.IDENTIFIANT>0 AND Reservation.STATUT=3  AND Affectation.STATUT=1 ";
		
		$query .=((($nbdays>=0)&&empty($debut)&&empty($inspecteur)&&empty($util))?" AND Reservation.DATE_RESERVATION>='".$datelimite."'  ":" ");		
		$query .=(!empty($debut)?" AND Reservation.DATE_RESERVATION>='".$debut."' ":"");		
		$query .=(!empty($fin)?" AND Reservation.DATE_RESERVATION<='".$fin."' ":"");		
		$query .=(!empty($inspecteur)?" AND Affectation.INSPECTEUR='".$inspecteur."' ":"");		
		$query .=(!empty($util)?" AND Reservation.USER='".$util."' ":"");		
		$query .=(!empty($pont)?" AND Reservation.SITE='".$pont."' ":"");
		$query .=(!empty($type)?" AND Reservation.TYPE='".$type."' ":"");
		$query .=(($ville>0 && !in_array($_SESSION['TYPE_COMPTE'],array(3,4,5)))?" AND Site.VILLE='".$ville."' ":"");
		$query .="ORDER BY Reservation.DATE_RESERVATION DESC, Reservation.PLAGE_HORAIRE DESC,Reservation.IDENTIFIANT DESC";

		//requete SQL
		$reponse=$bdd->query($query);

		$i=0;
	    $tab[$i] = $reponse -> rowCount();
	    $i++;
<<<<<<< HEAD
		
	    $tab[$i] = $reponse -> rowCount();
	    $i++;
		
	    $tab[$i] = $reponse -> rowCount();
	    $i++;
		
		$nb=0;
		$nbf=0;
=======
		$nb=0;

>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
		while ($donnees = $reponse->fetch()){
			
			$dateres=$donnees['DATE_RESERVATION'];
			$dateres=strtotime(substr($dateres,5,2)."/".substr($dateres,8,2)."/".substr($dateres,0,4));
			$bill=(($donnees['PLAGE_HORAIRE']==2 || isdayofrest($bdd,date('Y-m-d',$dateres))|| in_array(date('w',$dateres),array(6,0)))?0:1);
			
			if($fact==='' || $bill==$fact){
				$nb++;
<<<<<<< HEAD
				$nbf+=(1-$bill);
=======
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
				
				$tab[$i] = $donnees['IDENTIFIANT'];
				$i++;
				
				$tab[$i] = $bill;
				$i++;
				
				$tab[$i] = dateservertosite($donnees['DATE_RESERVATION']);
				$i++;
				
				$tab[$i] = $donnees['PLAGE_HORAIRE'];
				$i++;
				
				//PONT
				$tab[$i] = $donnees['LIBELLE'];
				$i++;
							
				//AGENT			
				$agent=getvalue($bdd,'NOM,PRENOMS','Inspecteur','IDENTIFIANT',$donnees['INSPECTEUR']);
				$tab[$i] = $agent[0].' '.$agent[1];
				$i++;
				
				//USER
<<<<<<< HEAD
				$struct = getvalue($bdd,'LIBELLE','Structure','IDENTIFIANT',$donnees['OPERATEUR_STRUCTURE']);
				$tab[$i] = $struct[0];
=======
				$tab[$i] = $donnees['LOGIN'];
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
				$i++;
							
				//VILLE
				$tab[$i] = $donnees['VILLE'];
				$i++;
							
				//EXPIRE
				$tab[$i] = (($donnees['DATE_RESERVATION']<$now ||($donnees['DATE_RESERVATION']==$now && $donnees['PLAGE_HORAIRE']==1))?1:0);
				$i++;			
			}
		}
		$reponse->closeCursor();

		$tab[0] = $nb;
<<<<<<< HEAD
		$tab[1] = number_format($nb,0,"",".");
		$tab[2] = number_format($nbf*$tarif,0,"",".");
=======
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643

	return $tab;
	}

    $tab=GetAffectations($bdd,$_POST['factur'],$_POST['debut'],$_POST['fin'],$_POST['inspecteur'],$_POST['user'],'','',$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
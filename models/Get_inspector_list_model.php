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
	include_once('../functions/Tri_function.php');

function GetInspectorList($bdd,$id,$action,$ville,$user){

	global $heuremax; //nb Heure maximum a ne pas depasser
	global $plagejour; //nb Heure lors de la plage jour
	global $plagenuit; //nb Heure lors de la plage nuit

	
	$agent = array();
	$lundi=date('Y-m-d',strtotime("-".(date('w')?(date('w')-1):"6")." days"));

	$query="SELECT * FROM Inspecteur WHERE STATUT='0' ".(($ville>0 && $_SESSION['TYPE_COMPTE']!=3)?" AND VILLE='".$ville."'":"")." ORDER BY NOM,PRENOMS ";
	$result=$bdd->query($query);
	$nbr_agents=$result -> rowCount();
	$i=0;
	$tab[$i]=0;
	$i++;
	$inspecteur=getvalue($bdd,'INSPECTEUR','Affectation','RESERVATION',$id);
	$tab[$i]=(($action==4)?$inspecteur:0);
	$i++;
	while ($lign = $result->fetch()){
		
		$query="SELECT COUNT(A.IDENTIFIANT) AS NB_AFFECT, SUM(IF(R.PLAGE_HORAIRE=1,".$plagejour.",".$plagenuit.")) AS NB_HEURE 
				FROM Affectation A,Reservation R 
				WHERE A.INSPECTEUR='".$lign['IDENTIFIANT']."' AND A.STATUT='1' 
				AND A.RESERVATION=R.IDENTIFIANT AND R.STATUT='3' AND R.DATE_RESERVATION>='".$lundi."' 
				AND (R.DATE_RESERVATION<'".date('Y-m-d')."' OR (R.DATE_RESERVATION='".date('Y-m-d')."' AND R.PLAGE_HORAIRE IN('1','3'))) ";
		$res=$bdd->query($query);
		$rows = $res -> rowCount();
		$donnees = $res->fetch();
		$num = (($rows>0)?$donnees['NB_AFFECT']:"0");
		$heures = (($rows>0)?$donnees['NB_HEURE']:"0");
		
		if($heures<$heuremax){
			$infos=$lign['IDENTIFIANT'].";".str_replace(";","",$lign['NOM']." ".$lign['PRENOMS']).";".$heures.";".$num;
			$agent[]=explode(";",$infos);
		}else
			$nbr_agents--;
	}
	$result->closeCursor();	
	$tab[0]=$nbr_agents ;

	$agent=tri($agent,$nbr_agents,4,2,0);

	for($j=0;$j<$nbr_agents;$j++){
		$tab[$i]= $agent[$j][0];$i++;
		$tab[$i]= $agent[$j][1];$i++;
		$tab[$i]= $agent[$j][2];$i++;
	}
	
	return $tab;
	}
	
    $tab=GetInspectorList($bdd,$_POST['id'],$_POST['action'],$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
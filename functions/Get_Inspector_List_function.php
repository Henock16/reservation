<?php

	include_once('../functions/Tri_function.php');

function GetInspectorList($bdd,$id,$action,$ville,$user,$type_compte){

	global $heuremax; //nb Heure maximum a ne pas depasser
	global $plagejour; //nb Heure lors de la plage jour
	global $plagenuit; //nb Heure lors de la plage nuit

	
	$agent = array();
	$lundi=date('Y-m-d',strtotime("-".(date('w')?(date('w')-1):"6")." days"));

	$query="SELECT * FROM Inspecteur WHERE STATUT='0' ".(($ville>0 && $type_compte!=3)?" AND VILLE='".$ville."'":"")." ";
	$result=$bdd->query($query);
	$nbr_agents=$result -> rowCount();

	$i=0;
	$tab[$i]=0;
	$i++;
	
	$inspecteur=getvalue($bdd,'IDENTIFIANT,INSPECTEUR','Affectation','RESERVATION',$id);
	$tab[$i]=(($action==4)?$inspecteur[1]:0);
	$i++;
	
	$site=getvalue($bdd,'SITE','Reservation','IDENTIFIANT',$id);
	$quartier=getvalue($bdd,'QUARTIER','Site','IDENTIFIANT',$site[0]);
	$quartier=getvalue($bdd,'NOM,LOCALISATION','Quartier','IDENTIFIANT',$quartier[0]);
	$tab[$i]=$quartier[0];
	$i++;
	
	$libsite=getvalue($bdd,'LIBELLE','Site','IDENTIFIANT',$site[0]);
	$tab[$i]=$libsite[0];
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
			$quarter=getvalue($bdd,'NOM,LOCALISATION','Quartier','IDENTIFIANT',$lign['QUARTIER']);
			$distance=abs((!ctype_digit($quarter[1])?0:$quarter[1])-(!ctype_digit($quartier[1])?0:$quartier[1]));
			$agent[]=array($lign['IDENTIFIANT'],str_replace(";","",$lign['NOM']." ".$lign['PRENOMS']),$heures,$num,$quarter[0],$distance);
		}else
			$nbr_agents--;
	}
	$result->closeCursor();	
	$tab[0]=$nbr_agents ;

	$agent=tri($agent,$nbr_agents,6,2,5);

	for($j=0;$j<$nbr_agents;$j++){
		$tab[$i]= $agent[$j][0];$i++;
		$tab[$i]= $agent[$j][1];$i++;
		$tab[$i]= $agent[$j][2];$i++;
		$tab[$i]= $agent[$j][3];$i++;
		$tab[$i]= $agent[$j][4];$i++;
	}
	
	return $tab;
	}
?>

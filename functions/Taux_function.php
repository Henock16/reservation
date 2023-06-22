<?php

function etat($statut)
	{
	$stt=array("","EN ATTENTE","ANNULE","VALIDE","EXPIRE","REJETE");
	$stat=0;
	for($i=0;$i<=5;$i++)
	$stat=(($statut==$i)?$stt[$i]:$stat);
	
	return $stat;			
	}
	
function user($bdd,$iduser)
	{
	$query="SELECT * FROM User WHERE  IDENTIFIANT='".$iduser."'";
	$res=$bdd->query($query);
	$n="";
	while ($lign = $res->fetch())
		$n=$lign['STRUCTURE'];
	$res->closeCursor();	

	return $n;			
	}

function nomsite($bdd,$idsite)
	{
	$query="SELECT * FROM Site WHERE  IDENTIFIANT='".$idsite."'";
	$res=$bdd->query($query);
	$n="";
	while ($lign = $res->fetch())
		$n=$lign['LIBELLE'];
	$res->closeCursor();	

	return $n;			
	}

function taux($bdd,$mois,$annee,$typ,$ville)
	{
	$query="SELECT R.* FROM Reservation R,Site S WHERE R.`DATE_RESERVATION` BETWEEN '".$annee."-".$mois."-01' AND  '".$annee."-".$mois."-31'  AND R.SITE=S.IDENTIFIANT AND S.VILLE =".$ville." ORDER BY R.DATE_RESERVATION,R.PLAGE_HORAIRE ";
	$result=$bdd->query($query);
	$statut=array(0,0,0,0,0,0);
	$content="DATE_RESERVATION;PLAGE_HORAIRE;STATUT;STRUCTURE;NOM_COMPLET;FONCTION;DATE_CREATION;PONT_SITE\n";

	while ($lign = $result->fetch())
		{
		$ligne="";
		if($typ)
		$ligne=$lign['DATE_RESERVATION'].";".(($lign['PLAGE_HORAIRE']==1)?"JOUR":"NUIT").";".utf8_encode(etat($lign['STATUT'])).";".utf8_encode(str_replace(";","",user($bdd,$lign['USER']))).";".utf8_encode(str_replace(";","",$lign['NOM_COMPLET'])).";".utf8_encode(str_replace(";","",$lign['FONCTION'])).";".$lign['DATE_CREATION'].";".utf8_encode(str_replace(";","",nomsite($bdd,$lign['SITE'])))."\n";
		else
			for($i=0;$i<=5;$i++)
				$statut[$i]+=($i?(($lign['STATUT']==$i)?1:0):1);
		$content.=$ligne;
		}
	$result->closeCursor();	

	$month = array("janvier","fevrier","mars","avril","mai","juin","juillet","aout","septembre","octobre","novembre","decembre");

	if($typ){
			$fichier="RESERVATIONS_DU_MOIS_DE_".strtoupper($month[$mois-1])."_".$annee.".csv";

			$chemin="./docs/";

			if (!$handle = fopen(".".$chemin.$fichier, 'w')) 
				exit;
			if (fwrite($handle, $content) === FALSE) 
				exit;
			fclose($handle);
	}else{
		$recues=$statut[0]-($statut[2]+$statut[5]);
		$mois=strtoupper($month[$mois-1]);
		$taux=number_format(($recues?($statut[3]/$recues):0)*100,2,",",".");
	}

	return ($typ?$chemin.$fichier:array(0,$recues,$statut[3],$taux,$mois,$annee));
	}


?>

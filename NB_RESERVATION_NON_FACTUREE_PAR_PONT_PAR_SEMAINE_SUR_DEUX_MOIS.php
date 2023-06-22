<?php
$serv="localhost";
$user="root";
//$pass="";//local
//$pass="kj2ji63E8bmpYSedjqaP658IYN78uL2Evg";//solas
$pass="NRtPEvqJYXtPE5gK";//ipage
//$pass="KRbKsjK6jRrxQi";//nsia
$base="Pesage";

$bdd = new PDO('mysql:host='.$serv.';dbname='.$base.';charset=utf8', $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

function PutFile($fichier,$token)
	{
	$cree=false;

	if(file_exists($fichier))
		if(!unlink($fichier))
			$cree=false;

	if ($handle = fopen($fichier, 'w')) 
		{
		if (fwrite($handle, $token) === FALSE) 
			exit;
		fclose($handle);
		$cree=true;	
		}
	return $cree;
	}

function daysofrest($bdd,$debut,$fin)
	{
	$ferie='';
	$yeardeb = substr($debut,0,4);
	$yearfin = substr($fin,0,4);
	    
	for($year=$yeardeb;$year<=$yearfin;$year++){

	$easterDate = easter_date($year);
	$easterDay = date('j', $easterDate);
	$easterMonth = date('n', $easterDate);
	$easterYear = date('Y', $easterDate);
	    
	$holidays = array(
	mktime(0, 0, 0, 1, 1, $year),// 1er janvier
	mktime(0, 0, 0, $easterMonth, $easterDay + 1, $easterYear),// Lundi de paques
	mktime(0, 0, 0, 5, 1, $year),// Fete du travail
	mktime(0, 0, 0, $easterMonth, $easterDay + 39, $easterYear),// Ascension
	mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear), // Pentecote
	//mktime(0, 0, 0, 11, 11, $year),// Nuit du destin
	//mktime(0, 0, 0, 5, 8, $year),// Ramadan
	mktime(0, 0, 0, 8, 7, $year),// Fete nationale
	mktime(0, 0, 0, 8, 15, $year),// Assomption
	//mktime(0, 0, 0, 11, 11, $year),// Tabaski
	mktime(0, 0, 0, 11, 1, $year),// Toussaint
	mktime(0, 0, 0, 11, 15, $year),// Journée de la paix
	//mktime(0, 0, 0, 11, 11, $year),// Mahouloud
	mktime(0, 0, 0, 12, 25, $year),// Noel
	);
	    
	$i=0;
	while ($i<count($holidays))
		{
		$jour=$holidays[$i];
		$day=date('Y', $jour)."-".date('m', $jour)."-".date('d', $jour);
echo $day."\n";
		$ferie.=(($day>=$debut && $day<=$fin)?(($ferie?',':'').$day):'');
		$i++;
		}

	}

	$query="SELECT * FROM JoursFeries WHERE DATE BETWEEN '".$debut."' AND '".$fin."'";
	$res=$bdd->query($query);
	while ($lign = $res->fetch())
		$ferie.=($ferie?',':'').$lign['DATE'];
	$res->closeCursor();	

	return $ferie;			
	}
	
function Generer($bdd,$debut,$sem,$fichier)
        {
        date_default_timezone_set("Africa/Abidjan");

        $date=date("Y-m-d");

        $ln="\r\n";
		
        $ligne='OPERATEUR;VILLE;PONT';	
		$weekstart=array();
		$weekfin=array();
		$weeks='';
		for($j=0;$j<$sem;$j++){
			$weekstart[]=date('Y-m-d',strtotime($debut." +".($j*7)." days"));
			$weekfin[]=date('Y-m-d',strtotime($debut." +".($j*7+4)." days"));
			$ligne.='Du '.$weekstart[$j].' Au '.$weekfin[$j].';';
			$weeks.=";SUM(IF(R.DATE_RESERVATION BETWEEN '".$weekstart[$j]."' AND '".$weekfin[$j]."',1,0)) AS SEM".$j;
		}		
        $ligne.=$ln;
		
		$daysoff=daysofrest($bdd,$weekstart[0],$weekfin[$sem-1]);

        $query="
			SELECT 	
			O.LIBELLE AS STRUCTURE,
			S.VILLE,
			S.LIBELLE AS PONT
			".$weeks."
			FROM Reservation  R, Site S, Structure O
			WHERE R.DATE_RESERVATION>='".$weekstart[0]."' AND R.DATE_RESERVATION<='".$weekfin[$sem-1]."' 
			AND R.SITE=S.IDENTIFIANT
			AND S.STRUCT=O.IDENTIFIANT
			AND R.PLAGE_HORAIRE=1
			AND R.DATE_RESERVATION NOT IN(".$daysoff.")
			AND R.STATUT=3
			GROUP BY S.LIBELLE ORDER BY S.LIBELLE DESC
			";
echo  $query;
			$num=0;
			$result=$bdd->query($query);
			$num = 0;
			while ($donnees = $result->fetch()){
				$num++;

				$ligne.=$donnees['STRUCTURE'];
				$ligne.=';'.$donnees['VILLE'];
				$ligne.=';'.$donnees['PONT'];
				for($j=0;$j<$sem;$j++)
					$ligne.=';'.$donnees['SEM'.$j];
						
				$ligne.=$ln;
			}
			$result->closeCursor();	

	PutFile($fichier.".CSV",$ligne);
	
//*/

}


$fichier=Generer($bdd,'2022-04-04',8,"NB_RESERVATION_NON_FACTUREE_PAR_PONT_PAR_SEMAINE_SUR_DEUX_MOIS");
//$fichier=Generer($bdd,'2022-04-04',8,"NB_RESERVATION_NON_FACTUREE_PAR_PONT_PAR_SEMAINE_SUR_DEUX_MOIS");

//$fichier=Generer($bdd,'2022-04-04','2022-05-28',"NB_RESERVATION_NON_FACTUREE_PAR_PONT_PAR_SEMAINE_SUR_DEUX_MOIS");
//$fichier=Generer($bdd,'2022-04-04','2022-05-28',"NB_RESERVATION_NON_FACTUREE_PAR_PONT_PAR_SEMAINE_SUR_DEUX_MOIS");


?>

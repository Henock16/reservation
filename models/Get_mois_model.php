<?php
/*
    Date creation : 20-04-2021
    Auteur : Cellule SOLAS - ABRS
    Version:1.0
    Dernière modification : 20-04-2021
    Dernier modificateur : Cellule SOLAS - ABRS
    Description: Obtenir la liste des inspecteurs affectables
*/


	include_once('../functions/Complete_function.php');


function GetMois($type){

	$monthlong=24;

	$month = array("janvier","fevrier","mars","avril","mai","juin","juillet","aout","septembre","octobre","novembre","decembre");

	$i=0;
	$tab[$i]=0;
	$i++;
	
	$tab[$i]=$monthlong;
	$i++;
	
	$tab[$i]=2;
	$i++;


		$annee=date('Y');
		$mois=date('m');
		$days=$annee.'-'.$mois.'-01';
		$weekbegin = date('Y-m-d',strtotime($days.' monday- 1 week'));	
 		$weekend = date('Y-m-d', strtotime($days.' sunday+ 1 week'));
 		$jourj = date('Y-m-d');
 		
	if($weekbegin<=$jourj  && $jourj<$weekend)
	$mois=(date('m')-2);
	else
	$mois=(date('m')-1);		
	

	$j=0; 
	while($j<$monthlong){
		
		if($j>0 || $type==0){
		$annee=$annee-(($mois==0)?1:0);		
		$mois=(($mois==0)?11:($mois-1));
		}
		
 			$tab[$i]=$annee."-".Complete($mois+1,2);
 			$i++;

			$tab[$i]=strtoupper($month[$mois])." ".$annee;
			$i++;	
 		
 		

				$j++;
	}	

	return $tab;
	}
	
$tab=GetMois($_POST['type']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
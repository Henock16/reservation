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


function GetSemaines($mois){

 
	$i=0;
	$tab[$i]=0;
	$i++;
	
	$tab[$i]=0;
	$i++;
	
	$tab[$i]=2;
	$i++;

	$day=0;
	$semaine=1;
	$debut=$mois."-01";
	$bon=true;
	$old=false;
	while($day<31 && $bon && !$old){

		$date=$mois."-".Complete($day+1,2);
		$old=($date>=date("Y-m-d"));
		$tag=explode('-', $mois);
		$jour=$tag[1]."/".Complete($day+1,2)."/".$tag[0];
		$bon=checkdate($tag[1],$day+2,$tag[0]);
		$weekbegin = date('Y-m-d',strtotime("sunday-2 week"));
 		$weekend = date('Y-m-d',strtotime("sunday 1 week"));
 		$week = $weekbegin." ".$weekend;

		 
		if(!$old && ((date('w',strtotime($jour))==0)|| !$bon)){	
		
			$tab[$i]=$debut." ".$date;
			if($tab[$i] < $week)
			{
				$i++;

			$tab[$i]="DU ".implode('/',array_reverse(explode('-', $debut)))." AU ".implode('/',array_reverse(explode('-', $date)));
			$i++;
			
			$semaine++;
			$debut=$mois."-".Complete($day+2,2);
			}
					
		}
				
		$day++;
	}	
	$tab[1]=$semaine-1;

	return $tab;
	}
	
$tab=GetSemaines($_POST['mois']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
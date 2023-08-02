<?php
include_once('Date_function.php');
include_once('../functions/Table_value_function.php');
include_once('../functions/Complete_function.php');
include_once('../functions/Isdayofrest_function.php');

function WeekList($mois){
	
	//liste des semaines
	$deb=array();
	$fin=array();
	$day=0;
	$nbsem=1;
	$debut=$mois."-01";
	$bon=true;
	while($day<31 && $bon){
		
		$date=$mois."-".Complete($day+1,2);
		$tag=explode('-', $mois);
		$jour=$tag[1]."/".Complete($day+1,2)."/".$tag[0];
		$bon=checkdate($tag[1],$day+2,$tag[0]);
		
		if((date('w',strtotime($jour))==0)|| !$bon){	
		
			$deb[]=$debut;
			$fin[]=$date;
			
			$nbsem++;
			$debut=$mois."-".Complete($day+2,2);		
		}		
		$day++;
	}	
	$nbsem-=1;

return array($deb,$fin);
}

function getMatriceMensuelleHtml($mois){

    global $mpdf,$bdd,$heuremax,$echelle;

    $semaines=WeekList($mois);	
	$deb=$semaines[0];
	$fin=$semaines[1];
	
	//liste des agents
	$query="SELECT I.IDENTIFIANT,I.MATRICULE,I.NOM,I.PRENOMS,I.VILLE FROM Inspecteur I, matrice M
	WHERE I.IDENTIFIANT NOT IN(135,119,120)
	AND M.DATE_AFFECTATION BETWEEN '".$mois."-01' AND'".$mois."-31' AND M.INSPECTEUR=I.IDENTIFIANT 
	GROUP BY I.IDENTIFIANT ORDER BY I.NOM,I.PRENOMS ";
	$result=$bdd->query($query);

	//mois
	$annee=substr($mois,0,4);
	$mois=substr($mois,5,2);
	$month = array("janvier","fevrier","mars","avril","mai","juin","juillet","aout","septembre","octobre","novembre","decembre");
	$monat=strtoupper($month[$mois-1])." ".$annee;


    setlocale(LC_TIME, 'fr_FR',"French");   
    
	$titre=';font-size: 30px;font-weight: bold;font-family: Arial Black;';
	$titre1='font-size: 13px;font-weight: bold;font-family: Arial Black;white-space: nowrap;';

	$entete= $titre1.'; font-style : italic;';
	$signe= $titre1.'; ';
	
///////////////////////////////////////////////ENTETE///////////////////////////////////////////////
	$html='  <table style=";border: 1px solid black;border-collapse: collapse;padding-left:0px;padding-right:10px"  border=1 width="100%">
                <tbody>
                  <tr>
                     <th height="20px"width="100px" style="border: 1px solid black;" align="center">	
						<img width="100px" height="40px" src="../images/cci.jpg" alt="profile"/> 					 
					 </th>
                     <th width="400px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:red;white-space: nowrap;">
						G&Eacute;RER LA PRODUCTION DU CERTIFICAT DE PESAGE
						</p>					 
					 </th>
                     <th width="200px" style="border: 1px solid black;" align="center">				
						<p style="white-space: nowrap;">
						<span style="color:orange;">R&eacute;f&eacute;rence: </span>
						<span style="color:red;">PESAGE-PR2-PRO-04-ERG-03</span>
						</p>					 
						<p style="white-space: nowrap;text-align:center">
						<span style="color:orange;">Version: </span>
						<span style="color:black;">01</span>
						</p>					 
					 </th>
                  </tr>
                  <tr>
                     <th width="100px" height="20px" style="border: 1px solid black;" align="center">				
						<p style="font-weight:bold;white-space: nowrap;">
						DISC/PESAGE
						</p>					 
					 </th>
                     <th  style="border: 1px solid black;" align="center">				
						<p style="font-weight:bold;white-space: nowrap;">
						MATRICE DE DECOMPTE DES HEURES TRAVAILL&Eacute;ES
						</p>					 
					 </th>
                     <th  style="border: 1px solid black;" align="center">				
						<p style="white-space: nowrap;font-family: Arial">
						<span style="color:orange;">Date: </span>
						<span style="color:black;">10/07/2018</span>
						</p>					 
					 </th>
                  </tr>
               </tbody>              
            </table>';

	
	$html.='<br><br>';

	$html.='  <table style=";border: 1px solid black;border-collapse: collapse;padding-left:0px;padding-right:10px"  border=1 width="100%">
                <tbody>
                  <tr>
                     <th height="20px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						 MOIS DE '.$monat.'
						</p>					 
					 </th>
                  </tr>
               </tbody>              
            </table>';

	$html.='<br>';

	$html.='  <table style=";border: 1px solid black;border-collapse: collapse;padding-left:0px;padding-right:10px"  border=1 width="100%">
                <tbody>';
    $entete='       <tr>
                     <th width="20px" height="20px" style="border: 1px solid black;" align="center" rowspan="2">	
					 NB
					 </th>
                     <th width="30px" style="border: 1px solid black;" align="center" rowspan="2">
					 MTLE
					 </th>
                     <th width="300px" style="border: 1px solid black;" align="center" rowspan="2">				
						NOM ET PRENOMS
					 </th>';

	for($i=0;$i<count($deb);$i++)					 
	$entete.='         <th width="'.round(300/count($deb)).'px" style="border: 1px solid black;" align="center">
						SEMAINE '.($i+1).'
					 </th>';
					 
	$entete.='         <th width="50px" style="border: 1px solid black;" align="center" rowspan="2">
						TOTAL NUITS
					 </th>
                     <th width="50px" style="border: 1px solid black;" align="center" rowspan="2">
						NB JRS<BR/>FERI&Eacute;S
					 </th>
                  </tr>
                  <tr>';

	for($i=0;$i<count($deb);$i++)					 
	$entete.='         <th height="20px" style="border: 1px solid black;" align="center">
						DU '.substr($deb[$i],8,2).' AU '.implode('/',array_reverse(explode('-', $fin[$i]))).'
					 </th>';

	$entete.='      </tr>';
	
	
///////////////POUR CHAQUE INSPECTEUR///////////////////////////////////////////////////////////////////////////
	
	$thismonth=array(array(0,0,0),array(0,0,0),array(0,0,0));
	$jours=array();
	$nuits=array();
	$nights=0;
	$feries=0;
	$j=0;
	if($result->rowCount()==0)
    $html.='     <tr>
                     <th height="40px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						 AUCUNE DONN&Eacute;E DISPONIBLE
						</p>					 
					 </th>
                  </tr>';
	else	while ($donnees = $result->fetch()){
	$j++;
	//si mpdf = 6
	if($mpdf==6)
		$html.=(($echelle==1)?((($j==1)||($j==21)||($j==77)||($j==21)||($j==105))?$entete:''):((($j==1)||($j==47)||($j==100))?$entete:''));

	else if($mpdf==7)	
		$html.=(($echelle==1)?((($j==1)||($j==27)||($j==58)||($j==89)||($j==120))?$entete:''):$html.=((($j==1)||($j==47)||($j==100))?$entete:''));

	$html.='      <tr>
                     <th height="20px" style="border: 1px solid black;" align="center">
						'.$j.'					 
					 </th>
                     <th style="border: 1px solid black;" align="center">				
						'.$donnees['MATRICULE'].'					 
					 </th>
                     <th style="border: 1px solid black;" align="left">				
						'.$donnees['NOM']=strtoupper($donnees['NOM']).' '.$donnees['PRENOMS']=strtoupper($donnees['PRENOMS']).'					 
					 </th>';

	$query="SELECT M.DATE_AFFECTATION,M.PLAGE_HORAIRE,M.NB_HEURE FROM matrice M	WHERE M.INSPECTEUR=".$donnees['IDENTIFIANT']."  
	AND M.DATE_AFFECTATION BETWEEN '".$deb[0]."' AND '".$fin[count($fin)-1]."' ORDER BY M.DATE_AFFECTATION";
	$res=$bdd->query($query);
	$hour=array(0,0,0,0,0,0);
	$jour=array(0,0,0,0,0,0);
	$nuit=array(0,0,0,0,0,0);
	$night=0;
	$ferie=0;
	while ($row = $res->fetch()){
		for($i=0;$i<count($deb);$i++){
			$isdateweek=(($row['DATE_AFFECTATION']>=$deb[$i] && $row['DATE_AFFECTATION']<=$fin[$i])?true:false);
			$jour[$i]+=(($isdateweek && $row['PLAGE_HORAIRE']==1)?1:0);
			$nuit[$i]+=(($isdateweek && $row['PLAGE_HORAIRE']==2)?1:0);
			$hour[$i]+=($isdateweek?$row['NB_HEURE']:0);
		}
		$night+=(($row['PLAGE_HORAIRE']==2)?1:0);
		$ferie+=(isdayofrest($bdd,$row['DATE_AFFECTATION'])?1:0);
	}
	$res->closeCursor();	


	for($i=0;$i<count($deb);$i++){		
	$html.='         <th style="border: 1px solid black;" align="center">				
						'.$nuit[$i].'					 
					 </th>';
	$jours[$i]=(isset($jours[$i])?$jours[$i]:0)+$jour[$i];
	$nuits[$i]=(isset($nuits[$i])?$nuits[$i]:0)+$nuit[$i];
	$thismonth[0][2]+=(($hour[$i]>$heuremax)?$hour[$i]-$heuremax:0);
	$thismonth[1][2]+=(($donnees['VILLE']==1 && $hour[$i]>$heuremax)?$hour[$i]-$heuremax:0);
	$thismonth[2][2]+=(($donnees['VILLE']==2 && $hour[$i]>$heuremax)?$hour[$i]-$heuremax:0);
	}
					 
	$html.='         <th style="border: 1px solid black;" align="center">
						'.($night).'
					 </th>
                     <th style="border: 1px solid black;" align="center">
						'.($ferie).'
					 </th>
                  </tr>';
	$nights+=$night;
	$thismonth[1][0]+=(($donnees['VILLE']==1)?$night:0);
	$thismonth[2][0]+=(($donnees['VILLE']==2)?$night:0);
	$feries+=$ferie;
	$thismonth[1][1]+=(($donnees['VILLE']==1)?$ferie:0);
	$thismonth[2][1]+=(($donnees['VILLE']==2)?$ferie:0);
	}
	$result->closeCursor();	
	
	$thismonth[0][0]=$nights;
	$thismonth[0][1]=$feries;

	$html.='      <tr>
                     <th height="20px" style="border: 1px solid black;" align="center" colspan="3">
						TOTAL					 
					 </th>';
	for($i=0;$i<count($deb);$i++){		
	$html.='         <th style="border: 1px solid black;" align="center">				
						'.($nuits[$i]).'					 
					 </th>';
	}
					 
	$html.='         <th style="border: 1px solid black;" align="center">
						'.($nights).'
					 </th>
                     <th style="border: 1px solid black;" align="center">
						'.($feries).'
					 </th>
                  </tr>';


				  
	$html.='    </tbody>              
            </table> <br><br><br><br><br><br><br>';			

///////////////MOIS PRECEDENT///////////////////////////////////////////////////////////////////////////
    $moisprec=(($mois>1)?$annee:$annee-1)."-".Complete((($mois==1)?12:$mois-1),2);
	$semaines=WeekList($moisprec);	
	$deb=$semaines[0];
	$fin=$semaines[1];

	//liste des agents
	$query="SELECT I.IDENTIFIANT,I.MATRICULE,I.NOM,I.PRENOMS,I.VILLE FROM Inspecteur I, matrice M
	WHERE I.IDENTIFIANT NOT IN(135,119,120)
	AND M.DATE_AFFECTATION BETWEEN '".$moisprec."-01' AND'".$moisprec."-31' AND M.INSPECTEUR=I.IDENTIFIANT 
	GROUP BY I.IDENTIFIANT ORDER BY I.NOM,I.PRENOMS ";
	$result=$bdd->query($query);

	$prevmonth=array(array(0,0,0),array(0,0,0),array(0,0,0));
	while ($donnees = $result->fetch()){
		
	$query="SELECT M.DATE_AFFECTATION,M.PLAGE_HORAIRE,M.NB_HEURE FROM matrice M	WHERE M.INSPECTEUR=".$donnees['IDENTIFIANT']."  
	AND M.DATE_AFFECTATION BETWEEN '".$deb[0]."' AND '".$fin[count($fin)-1]."' ORDER BY M.DATE_AFFECTATION";
	$res=$bdd->query($query);
	$hour=array(0,0,0,0,0,0);
	$night=0;
	$ferie=0;
	while ($row = $res->fetch()){
		for($i=0;$i<count($deb);$i++){
			$isdateweek=(($row['DATE_AFFECTATION']>=$deb[$i] && $row['DATE_AFFECTATION']<=$fin[$i])?true:false);
			$hour[$i]+=($isdateweek?$row['NB_HEURE']:0);
			
		}
		$night+=(($row['PLAGE_HORAIRE']==2)?1:0);
		$ferie+=(isdayofrest($bdd,$row['DATE_AFFECTATION'])?1:0);
	}
	$res->closeCursor();	

	for($i=0;$i<count($deb);$i++){		
	$prevmonth[0][2]+=(($hour[$i]>$heuremax)?$hour[$i]-$heuremax:0);
	$prevmonth[1][2]+=(($donnees['VILLE']==1 && $hour[$i]>$heuremax)?$hour[$i]-$heuremax:0);
	$prevmonth[2][2]+=(($donnees['VILLE']==2 && $hour[$i]>$heuremax)?$hour[$i]-$heuremax:0);
	}
					 
	$prevmonth[0][0]+=$night;
	$prevmonth[1][0]+=(($donnees['VILLE']==1)?$night:0);
	$prevmonth[2][0]+=(($donnees['VILLE']==2)?$night:0);
	$prevmonth[0][1]+=$ferie;
	$prevmonth[1][1]+=(($donnees['VILLE']==1)?$ferie:0);
	$prevmonth[2][1]+=(($donnees['VILLE']==2)?$ferie:0);
	}
	$result->closeCursor();	

///////////////TABLEAUX DE SYNTHESE///////////////////////////////////////////////////////////////////////////
	$oldmonth=(strtoupper($month[($mois==1)?11:$mois-2])." ".(($mois>1)?$annee:$annee-1));
	$synthese=array('GENERALE','ABIDJAN','SAN PEDRO');
	$ligne=array('NOMBRE DE NUITS TRAVAILLEES','NOMBRE DE JOURS FERIES TRAVAILLES','HEURES SUP EFFECTUEES ESTIMEES');

	for($i=0;$i<3;$i++){
	$html.='<br><br><br>
			<center>
			<table style=";border: 1px solid black;border-collapse: collapse;padding-left:0px;padding-right:10px"  border=1 width="100%">
			<thead>
                  <tr>
                     <th height="20px" style="border: 1px solid black;" align="center" colspan="5">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						 SYNTHESE '.$synthese[$i].'
						</p>					 
					 </th>
               </thead>     
                <tbody>
                 <tr>
                     <th width="40%" height="20px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						  
						</p>					 
					 </th>
                     <th width="15%" height="20px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						'.$oldmonth.'   
						</p>					 
					 </th>
                     <th width="15%" height="20px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						'.$monat.'   
						</p>					 
					 </th>
                     <th width="15%" height="20px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
							ECART
						</p>					 
					 </th>
                     <th height="15%" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						 %						 
						</p>					 
					 </th>
                  </tr>';
				  
		for($j=0;$j<3;$j++)
        $html.='<tr>
                     <th height="20px" style="border: 1px solid black;" align="left">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						'.$ligne[$j].' 						 
						</p>					 
					 </th>
                     <th height="20px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						 '.$prevmonth[$i][$j].'
						</p>					 
					 </th>
                     <th height="20px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						 '.$thismonth[$i][$j].'
						</p>					 
					 </th>
                     <th height="20px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						 '.($thismonth[$i][$j]-$prevmonth[$i][$j]).'						 
						</p>					 
					 </th>
                     <th height="20px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						 '.($prevmonth[$i][$j]?number_format(100*($thismonth[$i][$j]-$prevmonth[$i][$j])/$prevmonth[$i][$j],2,',',''):'').'
						</p>					 
					 </th>
                  </tr>';
        $html.='</tbody>              
            </table>
			</center>';
	}
///////////////VALIDATIONS///////////////////////////////////////////////////////////////////////////

	$html.='<br><br><br><br>
			<table style=";border: 1px solid black;border-collapse: collapse;padding-left:0px;padding-right:10px"  border=1 width="100%">
                <tbody>
                  <tr>
                     <th width="25%" height="20px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						  Chef de Service Pesage
						</p>					 
					 </th>
                     <th width="25%" height="20px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						  Chef de D&eacute;partement Pesage
						</p>					 
					 </th>
                     <th width="25%" height="20px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						 DGISC
						</p>					 
					 </th>
                     <th width="25%" height="20px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						 DARH
						</p>					 
					 </th>
                  </tr>
                  <tr>
                     <th height="50px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						 
						</p>					 
					 </th>
                     <th height="50px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						 
						</p>					 
					 </th>
                     <th height="50px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						 
						</p>					 
					 </th>
                     <th height="50px" style="border: 1px solid black;" align="center">	
						<p style="font-weight:bold;color:black;white-space: nowrap;">
						 
						</p>					 
					 </th>
                  </tr>
               </tbody>              
            </table> <br><br><br><br>';

if($mpdf==7){
$html.='<br><br><br><br>';
$html.='<br><br><br><br>';
}
/**/
///////////////////////////////////////////////////////DEUXIEME PAGES ///////////////////////////////////////////////
   
    return $html;
   
}


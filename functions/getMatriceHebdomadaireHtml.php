<?php
include_once('Date_function.php');
include_once('../functions/Table_value_function.php');
include_once('../functions/Isdayofrest_function.php');


function getMatriceHebdomadaireHtml($semaine,$superviseur)
{
	

	    global $mpdf,$bdd,$heuremax;


		//liste des semaines
		$semaine=explode(' ',$semaine);
		$deb=explode('-',$semaine[0]);
		$fin=explode('-',$semaine[1]);
		$mois=0;
		$annee=1;
		$debut=$mois."-01";


		//mois
		$annee=substr($mois,0,4);
		$mois=substr($mois,5,2);
		$month=array("janvier","fevrier","mars","avril","mai","juin","juillet","aout","septembre","octobre","novembre","decembre");
		// $monat=strtoupper($month[$mois-1])." ".$annee;

	    
		//liste des agents
		$query="SELECT I.IDENTIFIANT,I.MATRICULE,I.NOM,I.PRENOMS FROM Inspecteur I, matrice M
		WHERE M.SUPERVISEUR=".$superviseur." AND I.IDENTIFIANT NOT IN(135,119,120)
		AND M.DATE_AFFECTATION BETWEEN '".$semaine[0]."' AND '".$semaine[1]."' AND M.INSPECTEUR=I.IDENTIFIANT GROUP BY I.IDENTIFIANT ORDER BY I.NOM,I.PRENOMS";
	//	$query="SELECT I.IDENTIFIANT,I.MATRICULE,I.NOM,I.PRENOMS FROM Inspecteur I
	//	WHERE  I.IDENTIFIANT NOT IN(135,119,120) ORDER BY I.NOM,I.PRENOMS ";
		$result=$bdd->query($query);

		$superviseur=getvalue($bdd,'NOM_RESPO','User','IDENTIFIANT',$superviseur);

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
	                     <th rowspan="2" width="400px" style="border: 1px solid black;" align="center">	
							<p style="font-weight:bold;color:red;white-space: nowrap;">
							G&Eacute;RER LA PRODUCTION DU CERTIFICAT DE PESAGE
							</p>					 
						 </th>
	                     <th width="200px" style="border: 1px solid black;" align="center">				
							<p style="white-space: nowrap;">
							<span style="color:orange;">R&eacute;f&eacute;rence: </span>
							<span style="color:red;">PESAGE-PR2-PRO-02-ERG-2</span>
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
							<p style="white-space: nowrap;font-family: Arial">
							<span style="color:orange;">Date: </span>
							<span style="color:black;">23/07/2019</span>
							</p>					 
						 </th>
	                  </tr>
	                  <tr>
	                    <th colspan="3" style="border: 1px solid black;" align="center">				
							<p style="font-weight:bold;white-space: nowrap;">
							MATRICE DE DECOMPTE DES HEURES DE TRAVAIL DES INSPECTEURS DE POIDS PAR SEMAINE
							</p>					 
						</th>
	                  </tr>
	               </tbody>              
	            </table>';

		$html.='<br>';

		$html.='  <table style=";border: 1px solid black;border-collapse: collapse;padding-left:0px;padding-right:10px"  border=1 width="100%">
	                <tbody>
	                  <tr>
	                     <th height="40px" style="border: 1px solid black;" align="left">	
							<p style="font-weight:bold;color:black;white-space: nowrap;">
							 SEMAINE DU '.implode('/',array_reverse(explode('-', $semaine[0]))).' AU '.implode('/',array_reverse(explode('-', $semaine[1]))).'<br/>
							 SUPERVISEUR: '.$superviseur[0]=strtoupper($superviseur[0]).'
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

		for($i=$deb[2];$i<=$fin[2];$i++)					 
		$entete.='       <th width="'.round(300/($fin[2]-$deb[2]+1)).'px" style="border: 1px solid black;" align="center" colspan="2">
							 '.$i.'/'.$deb[1].'/'.$deb[0].'
						 </th>';
						 
		$entete.='       <th width="30px" style="border: 1px solid black;" align="center" rowspan="2">
							TOTAL/S
						 </th>
	                     <th width="20px" style="border: 1px solid black;" align="center" rowspan="2">
							HN
						 </th>
						 <th width="20px" style="border: 1px solid black;" align="center" rowspan="2">
							HS
						 </th>
	                     <th width="50px" style="border: 1px solid black;" align="center" rowspan="2">
							NB HRS JRS<BR/>FERI&Eacute;S
						 </th>
	                  </tr>
	                  <tr>';

		for($i=$deb[2];$i<=$fin[2];$i++)					 
		$entete.='       <th height="20px" style="border: 1px solid black;" align="center">
							JOUR
						 </th>
						 <th height="20px" style="border: 1px solid black;" align="center">
							NUIT
						 </th>';

		$entete.='      </tr>';
		
		
		$j=0;
		if($result->rowCount()==0)
	    $html.='     <tr>
	                     <th height="40px" style="border: 1px solid black;" align="center">	
							<p style="font-weight:bold;color:black;white-space: nowrap;">
							 AUCUNE DONN&Eacute;E DISPONIBLE
							</p>					 
						 </th>
	                  </tr>';
		else
		while ($donnees = $result->fetch())
		{



			$j++;
			
			$html.=((($j==1)||($j==54)||($j==116))?$entete:'');
			
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

			$jour=array();
			$nuit=array();
			$total=0;
			$night=0;
			$hn=40;
			$ferie=0;
			$query="SELECT DATE_AFFECTATION,PLAGE_HORAIRE,NB_HEURE FROM matrice WHERE INSPECTEUR=".$donnees['IDENTIFIANT']."
			AND DATE_AFFECTATION BETWEEN '".$semaine[0]."' AND '".$semaine[1]."' ORDER BY DATE_AFFECTATION";
			$res=$bdd->query($query);
			
			$day = $deb[2];

			$finalArr = [];
			for ($i=$day; $i <= $fin[2] ; $i++) {  
				$finalArr[$i] = ['jour'=> 0, 'nuit'=> 0];
			}
			$numb = $res->rowCount();
			
			
				while ($row = $res->fetch()){
					$jaffect=substr($row['DATE_AFFECTATION'],8,2);
					$ins=getvalue($bdd,'NOM','Inspecteur','IDENTIFIANT',$donnees['IDENTIFIANT']);
					
					
					for ($i=$day; $i <= $fin[2] ; $i++) { 
						$currentDay = $i;
						$jour[$currentDay]= 0;
						$nuit[$currentDay]=0;
						if($currentDay == $jaffect){
							$jour[$currentDay]= $row['PLAGE_HORAIRE']==1?$row['NB_HEURE']: 0;
							$nuit[$currentDay]=$row['PLAGE_HORAIRE']==2?$row['NB_HEURE']:0;

							$finalArr[$currentDay] = ['jour'=> $jour[$currentDay], 'nuit'=> $nuit[$currentDay]];
							
						}
						
						
					}
					$total += $row['NB_HEURE'];
					$night+=(($row['PLAGE_HORAIRE']==2)?$row['NB_HEURE']:0);
					$ferie+=(isdayofrest($bdd,$row['DATE_AFFECTATION'])?$row['NB_HEURE']:0);
					// array_push($finalArr, ['jour' =>$jour[$currentDay],'nuit' => $nuit[$currentDay]])
	
						
					
				}//END WHILE
				$res->closeCursor();
				

			

	

			
			$hrsup=(($total>$heuremax)?$total-$heuremax:0);


			for($i=$deb[2];$i<=$fin[2];$i++){
				
			$html.='         <th style="border: 1px solid black;" align="center">				
								 '.($finalArr[$i]['jour'] != 0? $finalArr[$i]['jour'] : 'X').'					 
							 </th>
							 <th style="border: 1px solid black;" align="center">				
								'.($finalArr[$i]['nuit'] != 0? $finalArr[$i]['nuit'] : 'X').'					 
							 </th>';					 
			}//END FOR
							 
			$html.='         <th style="border: 1px solid black;" align="center">
								'.(($total==0)?'':$total).'
							 </th>
		                     <th style="border: 1px solid black;" align="center">				
								'.$heuremax.'
							 </th>
							 <th style="border: 1px solid black;" align="center">				
								'.$hrsup.'
							 </th>
		                     <th style="border: 1px solid black;" align="center">				
								'.(($ferie==0)?'X':$ferie).'
							 </th>
		                  </tr>';
		}//END WHILE
		$result->closeCursor();	
		
					  
		$html.='    </tbody>              
	            </table>';
				
			
	if($mpdf==7){
	$html.='<br><br><br><br>';
	$html.='<br><br><br><br>';
	}
	/**/
	///////////////////////////////////////////////////////DEUXIEME PAGES ///////////////////////////////////////////////
	   
	    return $html;
   
}//END FUNCTION


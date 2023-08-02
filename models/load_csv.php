<?php
    session_start();
    include_once('../functions/Isdayofrest_function.php');
    include('../config/Connexion.php');
    include('../functions/Table_value_function.php');
    include_once('../functions/Complete_function.php');


    $mois=$_GET['mois'];

    function addchmp($val){
		
        $val=str_replace(CHR(10),"",$val);
        $val=str_replace(CHR(13),"",$val);
        $val=str_replace("\n","",$val);
        $val=str_replace("\r","",$val);
        $val=str_replace(";","",$val).";";
        return $val;
    }
        //une fonction qui me renvoie la liste de toutes les semaines d'un mois donné
    function WeekList($mois)
    {
	
        //liste des semaines
        $deb=array();
        $fin=array();
        $day=0;
        $nbsem=1;
        $debut=$mois."-01";
        $bon=true;
        while($day<31 && $bon)
        {
            $date=$mois."-".Complete($day+1,2);
            $tag=explode('-', $mois);
            $jour=$tag[1]."/".Complete($day+1,2)."/".$tag[0];
            $bon=checkdate($tag[1],$day+2,$tag[0]);            
            if((date('w',strtotime($jour))==0)|| !$bon)
            {	
            
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
    //une fonction qui me renvoie le ficher csv

    function getMatriceMensuelleCsv($mois){
        global $bdd,$heuremax;

        $semaines=WeekList($mois);	
        $deb=$semaines[0];
        $fin=$semaines[1];
    
            $filename="MATRICE DE DECOMPTE DES HEURES TRAVAILLÉES";

            $typeuser=$_GET['typeuser'];
            $type=$_GET['type'];
	        $superviseur=$_GET['superviseur'];
            $annee=substr($mois,0,4);
	        $mois=substr($mois,5,2);
            $month = array("janvier","fevrier","mars","avril","mai","juin","juillet","aout","septembre","octobre","novembre","decembre");
	        $monat=strtoupper($month[$mois-1])." ".$annee;
            $j=0;
           

           


            
                    $ln="\n";
                    $entete=addchmp('GERER LA PRODUCTION DU CERTIFICAT DE PESAGE');
                    $entete.=addchmp('Reference: PESAGE-PR2-PRO-04-ERG-03');
                    $entete.=addchmp('Version: 01');
                    $entete.=$ln;
                    $entete.=addchmp('DISC/PESAGE');
                    $entete.=addchmp('MATRICE DE DECOMPTE DES HEURES TRAVAILLEES');
                    $entete.=addchmp('10/07/2018');
                    $entete.=$ln;
                    $entete.=$ln;
                    $entete.=$ln;
                    $entete.=$ln;
                    $entete.=addchmp(' ');
                    $entete.=addchmp(' ');
                    $entete.=addchmp(' ');
                    $entete.=addchmp(' ');
                    $entete.=addchmp('MOIS DE '.$monat.'');
                    $entete.=$ln;
                    $entete.=addchmp('NB');
                    $entete.=addchmp('MTLE');
                    $entete.=addchmp('NOM ET PRENOMS');
                    for($i=0;$i<count($deb);$i++)$entete.=addchmp('SEMAINE '.($i+1).'');
                    $entete.=addchmp('TOTAL NUITS');
                    $entete.=addchmp('NB JRS FERIES');
                    $entete.=$ln;
                    $entete.=addchmp('');$entete.=addchmp('');$entete.=addchmp('');
                    for($i=0;$i<count($deb);$i++)$entete.=addchmp('DU '.substr($deb[$i],8,2).' AU '.implode('/',array_reverse(explode('-', $fin[$i]))).'');
                    ///////////////POUR CHAQUE INSPECTEUR///////////////////////////////////////////////////////////////////////////
	
                    $thismonth=array(array(0,0,0),array(0,0,0),array(0,0,0));
                    $jours=array();
                    $nuits=array();
                    $nights=0;
                    $feries=0;
                    $j=0;
                    //liste des agents
	                $query="SELECT I.IDENTIFIANT,I.MATRICULE,I.NOM,I.PRENOMS,I.VILLE FROM Inspecteur I, matrice M
                    WHERE I.IDENTIFIANT NOT IN(135,119,120)
                    AND M.DATE_AFFECTATION BETWEEN '".$annee."-".$mois."-01' AND'".$annee."-".$mois."-31' AND M.INSPECTEUR=I.IDENTIFIANT 
                    GROUP BY I.IDENTIFIANT ORDER BY I.NOM,I.PRENOMS ";
                    $result=$bdd->query($query);

					$i=0;
					$cnt="";
                     while($data = $result -> fetch())
                    {
                        $entete.=$ln;
                        $j++;
                        $entete.=addchmp($j);
                        $entete.=addchmp($data['MATRICULE']);
                        $entete.=addchmp($data['NOM']=strtoupper($data['NOM']).' '.$data['PRENOMS']=strtoupper($data['PRENOMS']));
                        
                        $query="SELECT M.DATE_AFFECTATION,M.PLAGE_HORAIRE,M.NB_HEURE FROM matrice M	WHERE M.INSPECTEUR=".$data['IDENTIFIANT']."  
                                AND M.DATE_AFFECTATION BETWEEN '".$deb[0]."' AND '".$fin[count($fin)-1]."' ORDER BY M.DATE_AFFECTATION";
                                $res=$bdd->query($query);
                                $hour=array(0,0,0,0,0,0);
                                $jour=array(0,0,0,0,0,0);
                                $nuit=array(0,0,0,0,0,0);
                                $night=0;
                                $ferie=0;
                                while($row = $res -> fetch())
                                {
                                    
                                    for($i=0;$i<count($deb);$i++)
                                    {
                                        
                                        $isdateweek=(($row['DATE_AFFECTATION']>=$deb[$i] && $row['DATE_AFFECTATION']<=$fin[$i])?true:false);
                                        $jour[$i]+=(($isdateweek && $row['PLAGE_HORAIRE']==1)?1:0);
                                        $nuit[$i]+=(($isdateweek && $row['PLAGE_HORAIRE']==2)?1:0);
                                        $hour[$i]+=($isdateweek?$row['NB_HEURE']:0);
                                    }
                                    $night+=(($row['PLAGE_HORAIRE']==2)?1:0);
                                    $ferie+=(isdayofrest($bdd,$row['DATE_AFFECTATION'])?1:0);
                                }
                                $res->closeCursor();

                                for($i=0;$i<count($deb);$i++)
                                    {		
                                        
                                        $entete.=addchmp($nuit[$i]);
                                        $jours[$i]=(isset($jours[$i])?$jours[$i]:0)+$jour[$i];
                                        $nuits[$i]=(isset($nuits[$i])?$nuits[$i]:0)+$nuit[$i];
                                        $thismonth[0][2]+=(($hour[$i]>$heuremax)?$hour[$i]-$heuremax:0);
                                        $thismonth[1][2]+=(($data['VILLE']==1 && $hour[$i]>$heuremax)?$hour[$i]-$heuremax:0);
                                        $thismonth[2][2]+=(($data['VILLE']==2 && $hour[$i]>$heuremax)?$hour[$i]-$heuremax:0);
                                    }
                                    $entete.=addchmp($night);
                                    $entete.=addchmp($ferie);

                                    $nights+=$night;
                                    $thismonth[1][0]+=(($data['VILLE']==1)?$night:0);
                                    $thismonth[2][0]+=(($data['VILLE']==2)?$night:0);
                                    $feries+=$ferie;
                                    $thismonth[1][1]+=(($data['VILLE']==1)?$ferie:0);
                                    $thismonth[2][1]+=(($data['VILLE']==2)?$ferie:0);
                    }
                    $result -> closeCursor(); 
                    
                    $thismonth[0][0]=$nights;
	                $thismonth[0][1]=$feries;
                    $entete.=$ln;
                    $entete.=addchmp('');
                    $entete.=addchmp('');
                    $entete.=addchmp('TOTAL');
                    for($i=0;$i<count($deb);$i++)$entete.=addchmp($nuits[$i]);
                    $entete.=addchmp($nights);
                    $entete.=addchmp($feries);
                    $entete.=$ln;
                    $entete.=$ln;
                    $entete.=$ln;
 

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
                    while ($data = $result->fetch())
                    {
		
                        $query="SELECT M.DATE_AFFECTATION,M.PLAGE_HORAIRE,M.NB_HEURE FROM matrice M	WHERE M.INSPECTEUR=".$data['IDENTIFIANT']."  
                        AND M.DATE_AFFECTATION BETWEEN '".$deb[0]."' AND '".$fin[count($fin)-1]."' ORDER BY M.DATE_AFFECTATION";
                        $res=$bdd->query($query);
                        $hour=array(0,0,0,0,0,0);
                        $night=0;
                        $ferie=0;
                       
                        
                        while ($row = $res->fetch())
                        {
                            for($i=0;$i<count($deb);$i++)
                            {
                                $isdateweek=(($row['DATE_AFFECTATION']>=$deb[$i] && $row['DATE_AFFECTATION']<=$fin[$i])?true:false);
                                $hour[$i]+=($isdateweek?$row['NB_HEURE']:0);
                                
                            }
                        
                            $night+=(($row['PLAGE_HORAIRE']==2)?1:0);
                            $ferie+=(isdayofrest($bdd,$row['DATE_AFFECTATION'])?1:0);
                            
                        }
                        $res->closeCursor();	

                        for($i=0;$i<count($deb);$i++)
                         {	
                            $prevmonth[0][2]+=(($hour[$i]>$heuremax)?$hour[$i]-$heuremax:0);
                            $prevmonth[1][2]+=(($data['VILLE']==1 && $hour[$i]>$heuremax)?$hour[$i]-$heuremax:0);
                            $prevmonth[2][2]+=(($data['VILLE']==2 && $hour[$i]>$heuremax)?$hour[$i]-$heuremax:0);
                        }
                                         
                        $prevmonth[0][0]+=$night;
                        $prevmonth[1][0]+=(($data['VILLE']==1)?$night:0);
                        $prevmonth[2][0]+=(($data['VILLE']==2)?$night:0);
                        $prevmonth[0][1]+=$ferie;
                        $prevmonth[1][1]+=(($data['VILLE']==1)?$ferie:0);
                        $prevmonth[2][1]+=(($data['VILLE']==2)?$ferie:0);
                        
                    }
                        $result->closeCursor();	

// ///////////////TABLEAUX DE SYNTHESE///////////////////////////////////////////////////////////////////////////
                        $oldmonth=(strtoupper($month[($mois==1)?11:$mois-2])." ".(($mois>1)?$annee:$annee-1));
                        $synthese=array('GENERALE','ABIDJAN','SAN PEDRO');
                        $ligne=array('NOMBRE DE NUITS TRAVAILLEES','NOMBRE DE JOURS FERIES TRAVAILLES','HEURES SUP EFFECTUEES ESTIMEES');
                        for($i=0;$i<3;$i++)
                        {
                            $entete.=$ln;
                            $entete.=addchmp('SYNTHESE'.$synthese[$i]);
                            $entete.=$ln;
                            $entete.=addchmp(' ');
                            $entete.=addchmp($oldmonth);
                            $entete.=addchmp($monat);
                            $entete.=addchmp('ECART');
                            $entete.=addchmp('%');
                            for($j=0;$j<3;$j++)
                            {
                                $entete.=$ln;
                                $entete.=addchmp($ligne[$j]);
                                $entete.=addchmp($prevmonth[$i][$j]);
                                $entete.=addchmp($thismonth[$i][$j]);
                                $entete.=addchmp($thismonth[$i][$j]-$prevmonth[$i][$j]);
                                $entete.=addchmp($prevmonth[$i][$j]?number_format(100*($thismonth[$i][$j]-$prevmonth[$i][$j])/$prevmonth[$i][$j],2,',',''):'');
                            }
                        }
                        $entete.=$ln;
                        $entete.=$ln;
                        $entete.=$ln;
                        $entete.=addchmp('Chef de Service Pesage');
                        $entete.=addchmp(' Chef de Departement Pesage');
                        $entete.=addchmp('DGISC');
                        $entete.=addchmp(' DARH');
		
			
            if (!$handle = fopen($filename,'w'))
                exit;
            if (fwrite($handle,$entete) === FALSE)
                exit;
            fclose($handle);

            ignore_user_abort(true);
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.$filename.' DE '.$monat.".csv".'"');

            readfile($filename);
            unlink($filename);
}
$entete=getMatriceMensuelleCsv($mois);
    echo json_encode($entete);

?>
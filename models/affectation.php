<?php
//S'EXECUTE APRES 16H

	include('../config/Connexion.php');
	include_once('../functions/Isdayofrest_function.php');
	include_once('../functions/Date_function.php');
	include_once('../functions/Table_value_function.php');
	include_once('../functions/Get_Inspector_List_function.php');
	include_once('../functions/Set_Affectation_function.php');

$user=0; //ID de l'utilisateur

$reaffect=0; //1=Reaffecte les reservations deja affectees 0=non

$affich=1; //AFFICHER L'ACTIVITE SUR LA CONSOLE

$jour= array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");

$decale=0; //decalade de jour par rapport à la date systeme

$day=0;

$suivant=1; 

if(!isdayofrest($bdd,date('Y-m-d',strtotime("+".($day+$decale)." days"))) && date('w',strtotime("+".($day+$decale)." days"))!=6 && date('w',strtotime("+".($day+$decale)." days"))!=0)  //SI JOUR OUVRABLE
while ($suivant)//TANT QUE JOURS (SUIVANT) NON OUVRABLE
	{

	for($k=0;$k<2;$k++) //POUR CHAQUE PLAGE HORRAIRE DE CE JOUR (0=AUJOURDHUI NUIT,1=DEMAIN JOUR,2=DEMAIN APREM)
		{	
		//k 0=NUIT, 1=JOUR 2=APREM
		//PLAGE 2=NUIT, 1=JOUR 3=APREM
		$plage=($k==0?2:($k==1?1:($k==2?3:0)));

		//k 0=NUIT, 1=JOUR 2=APREM
		//DECALAGE 0=AUJOURDHUI, 1=DEMAIN , 1=DEMAIN 
		$decalage=($k?1:0);

		$today=strtotime("+".($day+$decale+$decalage)." days");
		$dayofweek = date('w',$today);
		$date = date('d/m/Y',$today);
		$datereserv = date('Y-m-d',$today);
		$dayofrest=isdayofrest($bdd,$datereserv);

			echo ($affich?(($plage==1)?"JOUR":"NUIT")." DU ".$datereserv."\n":"");	

		//DETECTION DES RESERVATIONS APARTENANT A CETTE PLAGE HORRAIRE
		$query="SELECT * FROM Reservation R WHERE R.DATE_RESERVATION='".$datereserv."' AND R.PLAGE_HORAIRE=".$plage." 
				AND STATUT IN(1,3)
				ORDER BY R.IDENTIFIANT ASC";
		$res=$bdd->query($query);
		$i=0;
		while ($lign = $res->fetch()){			
			$i++;

			$id_reserv=$lign['IDENTIFIANT'];

			$libsite=getvalue($bdd,'LIBELLE,QUARTIER','Site','IDENTIFIANT',$lign['SITE']);
			$quarter=getvalue($bdd,'NOM','Quartier','IDENTIFIANT',$libsite[1]);
			echo ($affich?"	".$libsite[0]." [".$quarter[0]."]\n":"");	

			if($lign['STATUT']==3 && $reaffect==0){
				
				$insp=getvalue($bdd,'INSPECTEUR','Affectation','RESERVATION',$id_reserv);
				$agent=getvalue($bdd,'NOM,PRENOMS,QUARTIER','Inspecteur','IDENTIFIANT',$insp[0]);
				$quarter=getvalue($bdd,'NOM','Quartier','IDENTIFIANT',$agent[2]);
				echo ($affich?"		"."DEJA AFFECTE ".$agent[0]." ".$agent[1].($quarter[0]?" [".$quarter[0]."]":"")."\n":"");	
			}else{
				
				$ville=getvalue($bdd,'VILLE','Site','IDENTIFIANT',$lign['SITE']);
				$agent=GetInspectorList($bdd,$id_reserv,$lign['STATUT'],$ville[0],$user,1);

				$affect=1; //0=affecte >0=echec affectation
				$j=4;			
				for($i=0;($i<$agent[0] && $affect>0);$i++){
					
					$action=(($lign['STATUT']==1)?2:4);
					$tab=SetAffectation($bdd,$affect_mail,$affect_sms,$action,$agent[$j],$id_reserv,1,"",$ville[0],$user);
					$affect=$tab[0];
									
					$motif=array('','DEJA AFFECTE LE MEME JOUR ET A LA MEME PLAGE','DEJA AFFECTE LE MEME JOUR','DEJA AFFECTE '.$nuits.' NUITS SUCCESSIVES');
					echo ($affich?"		".(($affect==0)?"	SUCCES":"ECHEC")." AFFECTATION DE ".$agent[$j+1]." | ".(($agent[$j+2])?$agent[$j+2]:'0')." h ".$agent[$j+3]." affect ".(($agent[$j+4])?"(".$agent[$j+4].")":"")." ".(($affect>0)?"MOTIF: ".$motif[$affect]:"")."\n":"");	

					$j+=5;
				}
			}

		}
		$res->closeCursor();	

		} //FIN POUR CHAQUE TOUR DE ROTATION 

	$day++;
	if(!isdayofrest($bdd,date('Y-m-d',strtotime("+".($day+$decale)." days"))) && date('w',strtotime("+".($day+$decale)." days"))!=6 && date('w',strtotime("+".($day+$decale)." days"))!=0) 
		$suivant=0;
	
	}  //FIN TANT QUE JOURS (SUIVANT) NON OUVRABLE
?>

<?php
	
	include_once('../functions/Cancel_reject_function.php');
	include_once('../functions/Notification_function.php');
	include_once('../functions/EnvoiSMS_function.php');
	include_once('../functions/Log_function.php');

function SetAffectation($bdd,$affect_mail,$affect_sms,$action,$agent,$idreserv,$statut,$motif,$ville,$affecteur){
			
			global $nuits; //nb de nuits daffectations successives apres lequel il ya un repos obligatoire

			$tab[0]=0;
			$site="";
			$date="";
			$plaj="";

			$inspect=getvalue($bdd,'NOM,PRENOMS,CONTACT_FLOTTE,CONTACT_PERSO','Inspecteur','IDENTIFIANT',$agent);
			$ajan=str_replace(";","",$inspect[0]." ".$inspect[1]);
			$ctct=str_replace(';','',$inspect[2].(($inspect[2]&&$inspect[3])?'/':'').$inspect[3]);

			$reserv=getvalue($bdd,'PLAGE_HORAIRE,DATE_RESERVATION','Reservation','IDENTIFIANT',$idreserv);
			$plage=$reserv[0];
			$reserv=$reserv[1];

			//voir si l'inspecteur de poids a deja été affecté sur un site ce jour et à cette plage horaire
			
			$num = 0;
			if(!(isset($_POST['action'])&&($_POST['action']=="reserver"))){	// si l'affectation n'est pas exceptionnelle
				
				$query="SELECT S.LIBELLE,R.IDENTIFIANT,R.TYPE 
						FROM Affectation A,Reservation R,Site S 
						WHERE A.INSPECTEUR='".$agent."' AND A.STATUT='1' AND A.RESERVATION=R.IDENTIFIANT AND R.STATUT='3' 
						AND R.DATE_RESERVATION='".$reserv."' AND R.PLAGE_HORAIRE='".$plage."' AND R.SITE=S.IDENTIFIANT ";
				$result=$bdd->query($query);
				while ($donnees = $result->fetch())
					{
					$num++;
					$site=str_replace(';','',$donnees['LIBELLE']);
					$reserv=$donnees['IDENTIFIANT'];
					$type=$donnees['IDENTIFIANT'];
					}
				$result->closeCursor();	
			}
			
			if($num)
				$tab=array(1,$ajan,$site,$reserv,$type,$idreserv);
			else
				{
				// voir si l'inspecteur de poids a deja été affecte le meme jour sur plage horaire differente
				if(!(isset($_POST['action'])&&($_POST['action']=="reserver"))){	// si l'affectation n'est pas exceptionnelle
					
					$query="SELECT S.LIBELLE,R.IDENTIFIANT,R.TYPE,R.PLAGE_HORAIRE,R.DATE_RESERVATION 
							FROM Affectation A,Reservation R,Site S 
							WHERE 
							(((R.PLAGE_HORAIRE='1' OR R.PLAGE_HORAIRE='3') AND (R.DATE_RESERVATION='".$reserv."')) 
							OR((".$plage."=1 OR ".$plage."=3) AND (R.DATE_RESERVATION='".$reserv."')))
							AND A.INSPECTEUR='".$agent."' AND A.STATUT='1' AND A.RESERVATION=R.IDENTIFIANT AND R.STATUT='3' AND R.SITE=S.IDENTIFIANT 
							ORDER BY R.IDENTIFIANT ASC LIMIT 0,1";
					$result=$bdd->query($query);
					$num = 0;
					$site="";
					while ($donnees = $result->fetch())
						{
						$num++;
						$site=str_replace(';','',$donnees['LIBELLE']);
						$date=substr($donnees['DATE_RESERVATION'],8,2).'/'.substr($donnees['DATE_RESERVATION'],5,2).'/'.substr($donnees['DATE_RESERVATION'],0,4);
						$plaj=$donnees['PLAGE_HORAIRE'];
						$reserv=$donnees['IDENTIFIANT'];
						$type=$donnees['IDENTIFIANT'];
						}
					$result->closeCursor();	
				}
				
				if($num)
					$tab=array(2,$ajan,$site,$date,$reserv,$plaj,$type,$idreserv);
				else
					{
					$count = 0;
					$num = 0;
					// pas d'affectation si l'agent est affecte $nuits fois successivement les nuits precedentes
					while($count==0 || ($count<$nuits && $num>0)){
						$count++;
						$query="SELECT S.LIBELLE,R.IDENTIFIANT,R.TYPE,R.PLAGE_HORAIRE,R.DATE_RESERVATION 
								FROM Affectation A,Reservation R,Site S 
								WHERE ((R.PLAGE_HORAIRE='2' AND DATE_ADD(R.DATE_RESERVATION,INTERVAL ".$count." DAY)='".$reserv."' )
								OR(".$plage."=2 AND DATE_ADD('".$reserv."',INTERVAL ".$count." DAY)=R.DATE_RESERVATION ))
								AND A.INSPECTEUR='".$agent."' AND A.STATUT='1' AND A.RESERVATION=R.IDENTIFIANT AND R.STATUT='3' AND R.SITE=S.IDENTIFIANT 
								ORDER BY R.IDENTIFIANT ASC LIMIT 0,1";
						$result=$bdd->query($query);
						$num+=$result->rowCount();
					}
					if($num==$nuits)
						$tab=array(3,$ajan);
					else
						{
							
						if($action==4)// si reaffectation, annulation de la laffectation
							CancelReject($bdd,5,$idreserv,$statut,$motif,$ville,$affecteur);
						
						$query="INSERT INTO Affectation(INSPECTEUR,RESERVATION,USER,STATUT,DATE_CREATION) VALUES('".$agent."','".$idreserv."','".$affecteur."','1','".date("Y-m-d H:i:s")."')";
						$bdd->exec($query);
						$affectation=$bdd->lastInsertId();
						logger($bdd, $affecteur, 3, 2,$affectation , $motif);

						$query="UPDATE Reservation SET STATUT='3' WHERE IDENTIFIANT='".$idreserv."'";
						$bdd->exec($query);

						$user=getvalue($bdd,'LOGIN','User','IDENTIFIANT',$affecteur);
						$tab=array(0,$ajan,$ctct,$user[0],$affectation);
						
						if($affect_mail)
							Notification($bdd,$action,$idreserv);	

						if($affect_sms)
							shell_exec("php envoi_sms.php ".$action." ".$idreserv." > /dev/null 2>&1 &");							
						//	EnvoiSMS($bdd,$action,$idreserv);			
						}
					}
				}
	return $tab;
	}
?>

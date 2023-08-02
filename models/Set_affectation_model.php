<?php
/*
    Date creation : 22-04-2021
    Auteur : Cellule SOLAS - ABRS
    Version:1.0
    Dernière modification : 22-04-2021
    Dernier modificateur : Cellule SOLAS - ABRS
    Description: effectuer laffectation dun agent a une reservation
*/
	session_start();

	include('../config/Connexion.php');

	include_once('../functions/Date_function.php');
	include_once('../functions/Table_value_function.php');
<<<<<<< HEAD
	include_once('../functions/Set_Affectation_function.php');

	
    $tab=SetAffectation($bdd,1,1,$_POST['action-id'],$_POST['inspecteur-id'],$_POST['reservation-id'],$_POST['statut'],$_POST['motif'],$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
=======
	include_once('../functions/Notification_function.php');

function SetAffectation($bdd,$action,$agent,$idreserv,$ville,$affecteur){
			
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

			//voir si l''inspecteur de poids a deja été affecté sur un site ce jour et à cette plage horraire
			$query="SELECT S.LIBELLE,R.IDENTIFIANT,R.TYPE 
					FROM Affectation A,Reservation R,Site S 
					WHERE A.INSPECTEUR='".$agent."' AND A.STATUT='1' AND A.RESERVATION=R.IDENTIFIANT AND R.STATUT='3' 
					AND R.DATE_RESERVATION='".$reserv."' AND R.PLAGE_HORAIRE='".$plage."' AND R.SITE=S.IDENTIFIANT ";
			$result=$bdd->query($query);
			$num = 0;
			while ($donnees = $result->fetch())
				{
				$num++;
				$site=str_replace(';','',$donnees['LIBELLE']);
				$reserv=$donnees['IDENTIFIANT'];
				$type=$donnees['IDENTIFIANT'];
				}
			$result->closeCursor();	

			if($num)
				$tab=array(1,$ajan,$site,$reserv,$type,$idreserv);
			else
				{
				// Contraintes de proximité des affectations
				$query="SELECT S.LIBELLE,R.IDENTIFIANT,R.TYPE,R.PLAGE_HORAIRE,R.DATE_RESERVATION 
						FROM Affectation A,Reservation R,Site S 
						WHERE ((R.PLAGE_HORAIRE='2' AND DATE_ADD(R.DATE_RESERVATION,INTERVAL 1 DAY)='".$reserv."' AND ".$plage."=1)
						OR(".$plage."=2 AND DATE_ADD('".$reserv."',INTERVAL 1 DAY)=R.DATE_RESERVATION AND R.PLAGE_HORAIRE='1')
						OR((".$plage."=1 OR ".$plage."=3) AND (R.DATE_RESERVATION='".$reserv."'))
						OR((R.PLAGE_HORAIRE='1' OR R.PLAGE_HORAIRE='3') AND (R.DATE_RESERVATION='".$reserv."'))) 
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

				if($num)
					$tab=array(2,$ajan,$site,$date,$reserv,$plaj,$type,$idreserv);
				else
					{
					$query="UPDATE Affectation SET STATUT='2' WHERE STATUT='1' AND RESERVATION='".$idreserv."' ";
					$req0=(($action==4)?$bdd->exec($query):1);

					$query="INSERT INTO Affectation(INSPECTEUR,RESERVATION,USER,STATUT,DATE_CREATION) VALUES('".$agent."','".$idreserv."','".$affecteur."','1','".date("Y-m-d H:i:s")."')";
					$req1=($req0?$bdd->exec($query):0);
					$affectation=$bdd->lastInsertId();

					$query="UPDATE Reservation SET STATUT='3' WHERE IDENTIFIANT='".$idreserv."'";
					$req2=(($action==2)?($req1?$bdd->exec($query):0):1);

					$user=getvalue($bdd,'LOGIN','User','IDENTIFIANT',$affecteur);

					$tab=(($req0&&$req1&&$req2)?array(0,$ajan,$ctct,$user[0],$affectation):array("Erreur liée à la base de données"));

					Notification($bdd,$action,$idreserv);		
					}
				}
	return $tab;
	}
	
    $tab=SetAffectation($bdd,$_POST['action-id'],$_POST['inspecteur-id'],$_POST['reservation-id'],$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);


?>
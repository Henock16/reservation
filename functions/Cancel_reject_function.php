<?php
	

	function CancelReject($bdd,$action,$idreserv,$statut,$motif,$ville,$affecteur){

			$query="UPDATE Reservation SET STATUT='".(($action==3)?"5":(($statut==1)?"1":"4"))."' WHERE IDENTIFIANT='".$idreserv."' AND STATUT='".(($action==3)?"1":"3")."'";
			$req1=$bdd->exec($query);
			
			if($action==3) //rejet Reservation
				logger($bdd, $affecteur,2 ,1 ,$idreserv ,$motif);

			$query="UPDATE Affectation SET STATUT='2' WHERE STATUT='1' AND RESERVATION='".$idreserv."'  ";
			$req2=(($action==3)?$req1:($req1?$bdd->exec($query):0));

			if($action==5){//annulation affectation
				$affect=getvalue($bdd,'IDENTIFIANT','Affectation','RESERVATION',$idreserv);
				logger($bdd, $affecteur, 5, 2, $affect[0], $motif);
			}

			Notification($bdd,$action,$idreserv);			

			EnvoiSMS($bdd,$action,$idreserv);			

			$tab[0]=(($req1&&$req2)?0:"Erreur liée à la base de données");


	return $tab;
	}

?>

<?php
    session_start();
    include('../config/Connexion.php');
    include('../functions/Date_function.php');
	include_once('../functions/Table_value_function.php');
	include_once('../functions/Set_Affectation_function.php');


if($_POST['action']=='reserver' ){

	$datereserv= datefr2en($_POST["date_reserv"]); //j'ai changer la function datefr2en en dateFrench

		//On cherche l'existence de la reservation dans la base de données	      
		$lign_Exist=$bdd->prepare(" SELECT * FROM Reservation WHERE DATE_RESERVATION = :Date AND PLAGE_HORAIRE = :Plage AND SITE = :Site  AND STATUT IN(1,3) ");
		
		$lign_Exist->bindParam(':Date', $datereserv, PDO::PARAM_STR);
		$lign_Exist->bindParam(':Plage', $_POST["plage"], PDO::PARAM_INT);
		$lign_Exist->bindParam(':Site', $_POST["site"], PDO::PARAM_INT);
		$lign_Exist->execute();
		
		$lign_count = $lign_Exist->rowCount();
		  
		if($lign_count == 0){ // Si la réservation n'existe pas encore dans la base de données, on l'insère
			
		$idutil=getvalue($bdd,'LOGIN','User','IDENTIFIANT',$_SESSION["ID_UTIL"]);
		$fullname=$idutil[0];
		$fonction='AGENT CCI';
		$tel='';
		$result=$bdd->query("SELECT U.IDENTIFIANT FROM Site S,User U WHERE S.IDENTIFIANT=".$_POST["site"]." AND S.STRUCT=U.STRUCT AND S.VILLE=U.VILLE ");
		$donnees = $result->fetch();
		$iduser=$donnees['IDENTIFIANT'];
		
        $sql="INSERT INTO Reservation(PLAGE_HORAIRE,DATE_RESERVATION,STATUT,SITE,USER,NOM_COMPLET,FONCTION,TELEPHONE,DATE_CREATION) 
                                VALUES( :Plage, :Date,1, :Site, :user, :Fullnam, :Fonct,:Tel, NOW())";
        $result= $bdd->prepare($sql);
        $result->bindParam(':Plage', $_POST["plage"], PDO::PARAM_INT);
        $result->bindParam(':Date', $datereserv, PDO::PARAM_STR);
        $result->bindParam(':Site', $_POST["site"], PDO::PARAM_INT);
        $result->bindParam(':user', $iduser, PDO::PARAM_INT);
        $result->bindParam(':Fullnam', $fullname, PDO::PARAM_STR);
        $result->bindParam(':Fonct', $fonction, PDO::PARAM_STR);
        $result->bindParam(':Tel', $tel, PDO::PARAM_STR);
        $result->execute();

		//Message visuel de retour de résErvation effectuée avec succès
		$tab[0]=$bdd->lastInsertId();

							
		}else{	// Si la réservation existe deja dans la base de données

			$don = $lign_Exist->fetch();

			if($don['STATUT']==1){	// Si la réservation n'a pas d'affectation
				
				$tab[0]=$don['IDENTIFIANT'];

			}else{	// Si la réservation a une affectation

				$tab[0]=-1;
			}
		}
			
				
	if($tab[0]>0)
		$tab=SetAffectation($bdd,1,1,2,$_POST['inspecteur'],$tab[0],0,'',$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

	/* Output header */
	header('Content-type: application/json');
	echo json_encode($tab);

}


?>
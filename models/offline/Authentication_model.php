<?php

	session_start();

	include('../../config/Connexion.php');

	include_once('../../functions/Table_value_function.php');

	$username = $_POST['user'];
	$password = $_POST['pass'];
	$today = date('Y-m-d');

	$query = $bdd -> prepare("SELECT * FROM User WHERE BINARY LOGIN=:user AND BINARY MOT_PASSE=:mp");
	$query -> bindParam(':user', $username, PDO::PARAM_STR);
	$query -> bindParam(':mp', $password, PDO::PARAM_STR);
	$query -> execute();

	$rows = $query -> rowCount();

	if($rows > 0){

		while($data = $query -> fetch()){

			$interval = time() - $data['DERNIERE_ACTION'] ;

			//COMPTE DESACTIVE
			if($data['STATUT_COMPTE'] == 1){
				$result['0'] = 1 ;
			}
			//COMPTE EN COURS D'UTILISATION
			elseif(($data['DERNIERE_ACTION'] > 0) && ($interval < $deconnect)){
				$result['0'] = 2 ;
			}
			//PREMIERE CONNEXION
			elseif($data['FIRST_CONNECTION'] == 0 && $data['TYPE_COMPTE']==2){
				$_SESSION['ID_UTIL'] = $data['IDENTIFIANT'] ;
				$result['0'] = 3 ;
				$result['1'] = $data['TYPE_STRUCT'];
				$result['2'] = $data['SIGLE'];
				$result['3'] = $data['VILLE'];
				$result['4'] = $data['ADRESSE_GEO'];
				$result['5'] = $data['NUM_CC'];
				$result['6'] = $data['NOM_RESPO'];
				$result['7'] = $data['FONCTION_RESPO'];
				$result['8'] = str_replace(" ","",$data['CONTACT_RESPO']);
				
				$query = $bdd -> prepare("SELECT * FROM Email WHERE STATUT=0 AND IDENTIFIANT=".$data['IDENTIFIANT']);
				$query -> execute();
				$mails='';
				while($data = $query -> fetch())
					$mails.=(($mails=='')?'':',').$data['LIBELLE'];
				$result['9'] = $mails;
				
				$struct=getvalue($bdd,'LIBELLE ','Structure','IDENTIFIANT',$data['STRUCT']);
				$result['10'] = $struct[0];
			}
			//MOT DE PASSE REINITIALISE
			elseif($data['FIRST_CONNECTION'] == 0 || $data['FIRST_CONNECTION'] == 2){
				$result['0'] = 4 ;

				$_SESSION['ID_UTIL'] = $data['IDENTIFIANT'] ;
			}
			else{
				$result['0'] = 5 ;

				$_SESSION['CONNECT'] = 1;
				$_SESSION['ID_UTIL'] = $data['IDENTIFIANT'];
				$_SESSION['NAME'] = $data['LOGIN'];
				$_SESSION['STRUCTURE']= $data['STRUCTURE'];
				$_SESSION['VILLE'] = $data['VILLE'];
				$_SESSION['TYPE_COMPTE'] = $data['TYPE_COMPTE'];
				$_SESSION['DERNIERE_ACTION'] = time();
				$_SESSION['derniere_connexion'] = $data['DERNIERE_CONNEXION'];
				$_SESSION['last_page'] = $data['LAST_PAGE'];
				$result['1'] = $_SESSION['last_page'] ;
				
				$id=$data['IDENTIFIANT'];
				$now=date('Y-m-d H:i:s');
				$resultat = $bdd->prepare("UPDATE User SET DERNIERE_CONNEXION =:dern WHERE IDENTIFIANT =:id");
				$resultat -> bindParam(':dern', $now, PDO::PARAM_STR);
				$resultat -> bindParam(':id', $id, PDO::PARAM_INT);
				$resultat -> execute();				
				$resultat->closeCursor();

				$time = $_SESSION['DERNIERE_ACTION'];
				include('../../functions/Update_action.php');
			}
		}
	}
	//UTILISATEUR OU MOT DE PASSE ERRONE
	else{
		$result['0'] = 0 ;
	}
	$query->closeCursor();
	
	$bdd = null;

	/* Output header */
	header('Content-type: application/json');
	echo json_encode($result) ;
?>

<?php

	session_start(); //demarrage de la session
 
	include_once('../../config/Connexion.php');
	
	include_once('../../functions/Date_function.php');


	$id = $_SESSION['ID_UTIL'];
	$categorie = $_POST['categorie'];
	$sigle = $_POST['sigle'];
	$ville = $_POST['ville'];
	$adgeo = $_POST['adgeo'];
	$ncoco = $_POST['ncoco'];
	$nom = $_POST['nom'];
	$fonction = $_POST['fonction'];
	$mdp = $_POST['mdp'];
	
	$i = 0;		
	while($i < $_POST['t1']){		
		$contact = (($i==0)?"":$contact.",").str_replace(" ","",str_replace(",","",$_POST["contact".$i]));
		$i++;
	}
	

	$j = 0;
	while($j < $_POST['t2']){
		$mail = $_POST["mail".$j];
		
		$reponse = $bdd->prepare("SELECT * FROM Email WHERE USER=:id AND LIBELLE=:mail");
		$reponse -> bindParam(':mail', $mail, PDO::PARAM_STR);
		$reponse -> bindParam(':id', $id, PDO::PARAM_INT);
		$reponse -> execute();
		if($reponse -> rowCount()>0)	
			$reponse = $bdd->prepare("UPDATE Email SET STATUT=0 WHERE USER=:id AND LIBELLE=:mail");
		else
			$reponse = $bdd->prepare("INSERT INTO Email (STATUT,LIBELLE,USER) VALUES(0,:mail,:id)");
		$reponse -> bindParam(':mail', $mail, PDO::PARAM_STR);
		$reponse -> bindParam(':id', $id, PDO::PARAM_INT);
		$reponse -> execute();
		$j++;
	}

	
	$reponse = $bdd->prepare("UPDATE User SET FIRST_CONNECTION=1, TYPE_STRUCT=:categorie, SIGLE=:sigle,
				VILLE=:ville,ADRESSE_GEO=:adgeo, NUM_CC=:ncoco, NOM_RESPO=:nom,FONCTION_RESPO=:fonction, 
				CONTACT_RESPO=:contact,MOT_PASSE=:mdp WHERE IDENTIFIANT=:id");
	$reponse -> bindParam(':categorie', $categorie, PDO::PARAM_INT);
	$reponse -> bindParam(':sigle', $sigle, PDO::PARAM_STR);
	$reponse -> bindParam(':ville', $ville, PDO::PARAM_INT);
	$reponse -> bindParam(':adgeo', $adgeo, PDO::PARAM_STR);
	$reponse -> bindParam(':ncoco', $ncoco, PDO::PARAM_STR);
	$reponse -> bindParam(':nom', $nom, PDO::PARAM_STR);
	$reponse -> bindParam(':fonction', $fonction, PDO::PARAM_STR);
	$reponse -> bindParam(':contact', $contact, PDO::PARAM_STR);
	$reponse -> bindParam(':mdp', $mdp, PDO::PARAM_STR);
	$reponse -> bindParam(':id', $id, PDO::PARAM_INT);
	
	$reponse -> execute();

	$_SESSION = array();

	$bdd = NULL;

	$result['0'] = 0 ;
		
	/* Output header */
	header('Content-type: application/json');
	echo json_encode($result) ;

?>	

<?php
/*
    Date creation : 28-05-2021
    Auteur : Cellule SOLAS - ABRS
    Version:1.0
    Dernière modification : 28-05-2021
    Dernier modificateur : Cellule SOLAS - ABRS
    Description:  Modification,Ajout d'une Structure
*/
	session_start();

	include('../config/Connexion.php');
	include_once('../functions/Date_function.php');


	function Modification($bdd,$ville,$affecteur){

		$id = (isset($_POST['structure-id'])?$_POST['structure-id']:''); 
		$nom = (!empty($_POST['nom'])?$_POST['nom']:''); 

		$query="SELECT * FROM Structure WHERE IDENTIFIANT<>".$id." AND LIBELLE='".$nom."'"; 
		$result=$bdd->query($query);
		$i=0;
		$exist="";
		while ($lign = $result->fetch()){
			$exist=$lign['LIBELLE'];
			$i++;
		}
		$result->closeCursor();	

		if($i)
			$tab=array(1,$exist);
		else{

			$modif="UPDATE Structure SET LIBELLE='".str_replace("'","''",strtoupper($nom))."'	WHERE IDENTIFIANT='".$id."'";
			$bdd->exec($modif);

			$tab=array(0,id,$nom);
		}
	return $tab;
	}

	function Ajout($bdd,$ville,$affecteur){
	
		$nom = (!empty($_POST['nom'])?$_POST['nom']:''); 

		$query="SELECT * FROM Structure WHERE LIBELLE='".$nom."'"; 
		$result=$bdd->query($query);
		$i=0;
		$exist="";
		while ($lign = $result->fetch()){
			$exist=$lign['LIBELLE'];
			$i++;
		}
		$result->closeCursor();	

		if($i)
			$tab=array(1,$exist);
		else{
			$insert="INSERT INTO Structure(LIBELLE,DATE_CREATION)";
			$insert.=" VALUES('".str_replace("'","''",strtoupper($nom))."','".date("Y-m-d H:i:s")."')";
			$bdd->exec($insert);
			$tab=array(0,$bdd->lastInsertId(),$nom);
		}

	return $tab;
	}
	
	if($_POST['action-id']==2)
		$tab=Modification($bdd,$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
	elseif($_POST['action-id']==0)
		$tab=Ajout($bdd,$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);


?>
<?php
/*
    Date creation : 28-05-2021
    Auteur : Cellule SOLAS - ABRS
    Version:1.0
    Dernière modification : 28-05-2021
    Dernier modificateur : Cellule SOLAS - ABRS
    Description:  Modification,Ajout d'un quartier
*/
	session_start();

	include('../config/Connexion.php');
	include_once('../functions/Date_function.php');


	function Modification($bdd,$ville,$affecteur){

		$id = (isset($_POST['quartier-id'])?$_POST['quartier-id']:''); 
		$nom = (!empty($_POST['nom'])?$_POST['nom']:''); 

		$query="SELECT * FROM Quartier WHERE IDENTIFIANT<>".$id." 
				AND VILLE=".$ville." AND NOM='".str_replace("'","''",strtoupper($nom))."'"; 
		$result=$bdd->query($query);
		$i=0;
		$exist="";
		while ($lign = $result->fetch()){
			$exist=$lign['NOM'];
			$i++;
		}
		$result->closeCursor();	

		if($i)
			$tab=array(1,$exist);
		else{

			$modif="UPDATE Quartier SET NOM='".str_replace("'","''",strtoupper($nom))."',
					VILLE=".$ville." WHERE IDENTIFIANT='".$id."'";
			$bdd->exec($modif);

			$tab=array(0,id,$nom);
		}
	return $tab;
	}

	function Ajout($bdd,$ville,$affecteur){
	
		$nom = (!empty($_POST['nom'])?$_POST['nom']:''); 

		$query="SELECT * FROM Quartier WHERE NOM='".str_replace("'","''",strtoupper($nom))."' AND VILLE=".$ville.""; 
		$result=$bdd->query($query);
		$i=0;
		$exist="";
		while ($lign = $result->fetch()){
			$exist=$lign['NOM'];
			$i++;
		}
		$result->closeCursor();	

		if($i)
			$tab=array(1,$exist);
		else{
			$insert="INSERT INTO Quartier(NOM,VILLE,LOCALISATION)";
			$insert.=" VALUES('".str_replace("'","''",strtoupper($nom))."',".$ville.",'')";
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
<?php
/*
    Date creation : 19-05-2021
    Auteur : Cellule SOLAS - ABRS
    Version:1.0
    Dernière modification : 19-05-2021
    Dernier modificateur : Cellule SOLAS - ABRS
    Description: Suppression, Modification,Ajout d'un jour ferie
*/
	session_start();

	include('../config/Connexion.php');
	include_once('../functions/Date_function.php');

	function Suppression($bdd,$id,$iduser){

		$query="DELETE FROM JoursFeries WHERE IDENTIFIANT='".$id."' ";
		$req1=$bdd->exec($query);
		$tab[0]=($req1?0:"Erreur liée à la base de données");

	return $tab;
	}
	
	function Modification($bdd,$iduser){

		$id = (isset($_POST['ferie-id'])?$_POST['ferie-id']:''); 
		$type = (isset($_POST['type'])?$_POST['type']:0); 
		$nom = (isset($_POST['nom'])?$_POST['nom']:''); 
		$date = (($_POST['date']!='')?"'".datesitetoserver($_POST['date'])."'":null); 

		$query="SELECT * FROM JoursFeries WHERE IDENTIFIANT<>".$id." AND TYPE=".$type." 
				AND SUBSTRING(DATE,1,4)='".substr(datesitetoserver($_POST['date']),0,4)."' "; 
		$result=$bdd->query($query);
		$i=0;
		$exist= "";
		while ($lign = $result->fetch()){
			$exist=dateservertosite($lign['DATE']);
			$i++;
		}
		$result->closeCursor();	

		if($type>0 && $i)
			$tab=array(2,$exist);
		else
			{
			$query="SELECT * FROM JoursFeries WHERE IDENTIFIANT<>".$id." AND TYPE>0 
			AND DATE='".datesitetoserver($_POST['date'])."' "; 
			$result=$bdd->query($query);
			$i=0;
			$exist= "";
			while ($lign = $result->fetch()){
				$exist=$lign['NOM'];
				$i++;
			}
			$result->closeCursor();	

			if($type>0 && $i)
				$tab=array(1,$exist);
			else{

				$modif="UPDATE JoursFeries SET TYPE=".$type.",NOM='".str_replace("'","''",$nom)."',
				DATE=".(($date==null)?"NULL":$date)." WHERE IDENTIFIANT='".$id."'";
				$bdd->exec($modif);

				$tab=array(0);
				}
			}
	return $tab;
	}

	function Ajout($bdd,$iduser){
	
		$type = (isset($_POST['type'])?$_POST['type']:0); 
		$nom = (isset($_POST['nom'])?$_POST['nom']:''); 
		$date = (($_POST['date']!='')?"'".datesitetoserver($_POST['date'])."'":null); 

		$query="SELECT * FROM JoursFeries WHERE TYPE=".$type." 
				AND SUBSTRING(DATE,1,4)='".substr(datesitetoserver($_POST['date']),0,4)."' "; 
		$result=$bdd->query($query);
		$i=0;
		$exist= "";
		while ($lign = $result->fetch()){
			$exist=dateservertosite($lign['DATE']);
			$i++;
		}
		$result->closeCursor();	

		if($type>0 && $i)
			$tab=array(2,$exist);
		else
			{
			$query="SELECT * FROM JoursFeries WHERE TYPE>0 AND DATE='".datesitetoserver($_POST['date'])."' "; 
			$result=$bdd->query($query);
			$i=0;
			$exist= "";
			while ($lign = $result->fetch()){
				$exist=$lign['NOM'];
				$i++;
			}
			$result->closeCursor();	

			if($type>0 && $i)
				$tab=array(1,$exist);
			else{

				$insert="INSERT INTO JoursFeries(TYPE,NOM,DATE)";
				$insert.=" VALUES(".$type.",'".str_replace("'","''",$nom)."',".(($date==null)?"NULL":$date).")";
				$bdd->exec($insert);

				$tab=array(0);
				}
			}

	return $tab;
	}
	
	if($_POST['action-id']==3)
		$tab=Suppression($bdd,$_POST['confirmation-id'],$_SESSION['ID_UTIL']);
	elseif($_POST['action-id']==2)
		$tab=Modification($bdd,$_SESSION['ID_UTIL']);
	elseif($_POST['action-id']==0)
		$tab=Ajout($bdd,$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);


?>
<?php
/*
    Date creation : 18-05-2021
    Auteur : Cellule SOLAS - ABRS
    Version:1.0
    Dernière modification : 18-05-2021
    Dernier modificateur : Cellule SOLAS - ABRS
    Description: Activation/Desactivation, Modification,Ajout d'un inspecteur
*/
	session_start();

	include('../config/Connexion.php');
	include_once('../functions/Date_function.php');

	function Numerotation($bdd,$ville,$affecteur){

		$query="SELECT * FROM User WHERE TYPE_COMPTE=2 ORDER BY IDENTIFIANT DESC LIMIT 0,1";
		$result=$bdd->query($query);
		$num=0;
		while ($lign = $result->fetch())
			$num=substr($lign['LOGIN'],-3);
		$result->closeCursor();	

	return array(0,$num);
	}
	
	function Connexion($bdd,$id,$action,$ville,$affecteur){

		$query="UPDATE User SET FIRST_CONNECTION='".(($action==4)?2:0)."' WHERE IDENTIFIANT='".$id."' ";
		$req1=$bdd->exec($query);
		$tab[0]=($req1?0:"Erreur liée à la base de données");

	return $tab;
	}
	
	function Activation($bdd,$id,$statut,$ville,$affecteur){

		$query="UPDATE User SET STATUT_COMPTE='".(1-$statut)."' WHERE IDENTIFIANT='".$id."' AND STATUT_COMPTE='".$statut."'";
		$req1=$bdd->exec($query);
		$tab[0]=($req1?0:"Erreur liée à la base de données");

	return $tab;
	}
	
	function Modification($bdd,$ville,$affecteur){

		$id = (isset($_POST['user-id'])?$_POST['user-id']:''); 
		$actif = (isset($_POST['statut'])?$_POST['statut']:0); 
		$connex = (isset($_POST['connex'])?$_POST['connex']:0); 
		$type = (isset($_POST['type'])?$_POST['type']:''); 
		$struct = (isset($_POST['struct'])?$_POST['struct']:5); 
		$login = (!empty($_POST['login'])?$_POST['login']:''); 
		$city = ((isset($_POST['ville'])&&!empty($_POST['ville'])&&($_POST['ville']!=null))?$_POST['ville']:$ville); 

		$query="SELECT * FROM User WHERE IDENTIFIANT<>".$id." AND LOGIN='".$login."'"; 
		$result=$bdd->query($query);
		$i=0;
		$exist="";
		while ($lign = $result->fetch()){
			$exist=$lign['LOGIN'];
			$i++;
		}
		$result->closeCursor();	

		if($i)
			$tab=array(1,$exist);
		else{

			$modif="UPDATE User SET STATUT_COMPTE=".$actif.",FIRST_CONNECTION=".$connex.",
			TYPE_COMPTE=".$type.",STRUCT=".$struct.",LOGIN='".str_replace("'","''",$login)."',VILLE=".$city."
			WHERE IDENTIFIANT='".$id."'";
			$bdd->exec($modif);

			$tab=array(0);
		}
	return $tab;
	}

	function Ajout($bdd,$ville,$affecteur){
	
		$actif = (isset($_POST['statut'])?$_POST['statut']:0); 
		$connex = (isset($_POST['connex'])?$_POST['connex']:0); 
		$type = (isset($_POST['type'])?$_POST['type']:''); 
		$struct = (isset($_POST['struct'])?$_POST['struct']:5); 
		$login = (!empty($_POST['login'])?$_POST['login']:''); 
		$city = (isset($_POST['ville'])?$_POST['ville']:$ville); 

		$query="SELECT * FROM User WHERE LOGIN='".$login."'"; 
		$result=$bdd->query($query);
		$i=0;
		$exist="";
		while ($lign = $result->fetch()){
			$exist=$lign['LOGIN'];
			$i++;
		}
		$result->closeCursor();	

		if($i)
			$tab=array(1,$exist);
		else{
			$insert="INSERT INTO User(STATUT_COMPTE,FIRST_CONNECTION,TYPE_COMPTE,STRUCT,LOGIN,VILLE,DERNIERE_ACTION,
			STRUCTURE,MOT_PASSE,LAST_PAGE,DATE_CREATION)";
			$insert.=" VALUES(".$actif.",".$connex.",".$type.",".$struct.",'".str_replace("'","''",$login)."',".$city.",
			0,'','12345','','".date("Y-m-d H:i:s")."')";
			$bdd->exec($insert);
			$tab=array(0);
		}

	return $tab;
	}
	
	if($_POST['action-id']==1)
		$tab=Numerotation($bdd,$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
	elseif($_POST['action-id']==4 || $_POST['action-id']==4)
		$tab=Connexion($bdd,$_POST['confirmation-id'],$_POST['action-id'],$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
	elseif($_POST['action-id']==3)
		$tab=Activation($bdd,$_POST['confirmation-id'],$_POST['statut'],$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
	elseif($_POST['action-id']==2)
		$tab=Modification($bdd,$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
	elseif($_POST['action-id']==0)
		$tab=Ajout($bdd,$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);


?>
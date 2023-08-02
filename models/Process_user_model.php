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

<<<<<<< HEAD
		$query="UPDATE User SET FIRST_CONNECTION='".(($action==4)?2:0)."',MOT_PASSE='12345' WHERE IDENTIFIANT='".$id."' ";
=======
		$query="UPDATE User SET FIRST_CONNECTION='".(($action==4)?2:0)."' WHERE IDENTIFIANT='".$id."' ";
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
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
	
<<<<<<< HEAD
	function Blocage($bdd,$id,$statut,$ville,$affecteur){

		$query="UPDATE User SET BLOQUE='".(1-$statut)."' WHERE IDENTIFIANT='".$id."' AND BLOQUE='".$statut."'";
		$req1=$bdd->exec($query);
		$tab[0]=($req1?0:"Erreur liée à la base de données");

	return $tab;
	}
	
	function Modification($bdd,$ville,$affecteur){

		$id = (isset($_POST['user-id'])?$_POST['user-id']:''); 
		$bloque = (isset($_POST['bloque'])?$_POST['bloque']:0); 
=======
	function Modification($bdd,$ville,$affecteur){

		$id = (isset($_POST['user-id'])?$_POST['user-id']:''); 
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
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

<<<<<<< HEAD
			$modif="UPDATE User SET BLOQUE=".$bloque.", STATUT_COMPTE=".$actif.",FIRST_CONNECTION=".$connex.",
=======
			$modif="UPDATE User SET STATUT_COMPTE=".$actif.",FIRST_CONNECTION=".$connex.",
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
			TYPE_COMPTE=".$type.",STRUCT=".$struct.",LOGIN='".str_replace("'","''",$login)."',VILLE=".$city."
			WHERE IDENTIFIANT='".$id."'";
			$bdd->exec($modif);

			$tab=array(0);
		}
	return $tab;
	}

	function Ajout($bdd,$ville,$affecteur){
	
<<<<<<< HEAD
		$bloque = (isset($_POST['bloque'])?$_POST['bloque']:0); 
=======
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
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
<<<<<<< HEAD
			$insert="INSERT INTO User(BLOQUE,STATUT_COMPTE,FIRST_CONNECTION,TYPE_COMPTE,STRUCT,LOGIN,VILLE,DERNIERE_ACTION,
			STRUCTURE,MOT_PASSE,LAST_PAGE,DATE_CREATION)";
			$insert.=" VALUES(".$bloque.",".$actif.",".$connex.",".$type.",".$struct.",'".str_replace("'","''",$login)."',".$city.",
=======
			$insert="INSERT INTO User(STATUT_COMPTE,FIRST_CONNECTION,TYPE_COMPTE,STRUCT,LOGIN,VILLE,DERNIERE_ACTION,
			STRUCTURE,MOT_PASSE,LAST_PAGE,DATE_CREATION)";
			$insert.=" VALUES(".$actif.",".$connex.",".$type.",".$struct.",'".str_replace("'","''",$login)."',".$city.",
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
			0,'','12345','','".date("Y-m-d H:i:s")."')";
			$bdd->exec($insert);
			$tab=array(0);
		}

	return $tab;
	}
	
	if($_POST['action-id']==1)
		$tab=Numerotation($bdd,$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
<<<<<<< HEAD
	elseif($_POST['action-id']==4 || $_POST['action-id']==5)
		$tab=Connexion($bdd,$_POST['confirmation-id'],$_POST['action-id'],$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
	elseif($_POST['action-id']==3)
		$tab=Activation($bdd,$_POST['confirmation-id'],$_POST['statut'],$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
	elseif($_POST['action-id']==6)
		$tab=Blocage($bdd,$_POST['confirmation-id'],$_POST['statut'],$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
=======
	elseif($_POST['action-id']==4 || $_POST['action-id']==4)
		$tab=Connexion($bdd,$_POST['confirmation-id'],$_POST['action-id'],$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
	elseif($_POST['action-id']==3)
		$tab=Activation($bdd,$_POST['confirmation-id'],$_POST['statut'],$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
	elseif($_POST['action-id']==2)
		$tab=Modification($bdd,$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
	elseif($_POST['action-id']==0)
		$tab=Ajout($bdd,$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);


?>
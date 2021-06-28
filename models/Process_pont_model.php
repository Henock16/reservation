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

	function Activation($bdd,$id,$statut,$ville,$affecteur){

		$query="UPDATE Site SET STATUT='".(1-$statut)."' WHERE IDENTIFIANT='".$id."' AND STATUT='".$statut."'";
		$req1=$bdd->exec($query);
		$tab[0]=($req1?0:"Erreur liée à la base de données");

	return $tab;
	}
	
	function Modification($bdd,$ville,$affecteur){

		$id = (isset($_POST['pont-id'])?$_POST['pont-id']:''); 
		$statut = (isset($_POST['statut'])?$_POST['statut']:0); 
		$niveau = (!empty($_POST['niveau'])?$_POST['niveau']:0); 
		$type = (isset($_POST['type'])?$_POST['type']:0); 
		$code = (isset($_POST['code'])?$_POST['code']:''); 
		$nom = (isset($_POST['nom'])?$_POST['nom']:''); 	
		$struct = (!empty($_POST['struct'])?$_POST['struct']:null); 
		$ville = (isset($_POST['ville'])?$_POST['ville']:$ville); 

		$localisation = (isset($_POST['localisation'])?$_POST['localisation']:''); 
		$gps = (isset($_POST['gps'])?$_POST['gps']:''); 
		$nomresp = (isset($_POST['nomresp'])?$_POST['nomresp']:''); 
		$foncresp = (isset($_POST['foncresp'])?$_POST['foncresp']:''); 
		$contresp = (isset($_POST['contresp'])?$_POST['contresp']:''); 

		$query="SELECT * FROM Site WHERE IDENTIFIANT<>".$id." AND (CODE_SITE='".$code."' OR LIBELLE='".$nom."')"; 
		$result=$bdd->query($query);
		$i=0;
		$exist= array("","");
		while ($lign = $result->fetch())
			{
			$exist[0]=$lign['CODE_SITE'];
			$exist[1]=$lign['LIBELLE'];
			$i++;
			}
		$result->closeCursor();	

		if($i && $exist[0]==$code)
			$tab=array(2,$exist[0]);
		elseif($i && $exist[1]==$nom)
			$tab=array(1,$exist[1]);
		else
			{

			$modif="UPDATE Site SET STATUT=".$statut.",NIVEAU=".$niveau.",TYPE_SITE=".$type.",
			CODE_SITE='".str_replace("'","''",$code)."',LIBELLE='".str_replace("'","''",$nom)."',STRUCT=".$struct.",
			VILLE=".$ville.",ADRESSE_GEO='".str_replace("'","''",$localisation)."',COORDON_GPS='".str_replace("'","''",$gps)."',
			NOM_RESPO='".str_replace("'","''",$nomresp)."',FONCTION_RESPO='".str_replace("'","''",$foncresp)."',
			CONTACT_RESPO='".str_replace("'","''",$contresp)."' WHERE IDENTIFIANT='".$id."'";
			$bdd->exec($modif);

			$tab=array(0);
			}
	return $tab;
	}

	function Ajout($bdd,$ville,$affecteur){
	
		$statut = (isset($_POST['statut'])?$_POST['statut']:0); 
		$niveau = (!empty($_POST['niveau'])?$_POST['niveau']:0); 
		$type = (isset($_POST['type'])?$_POST['type']:0); 
		$code = (isset($_POST['code'])?$_POST['code']:''); 
		$nom = (isset($_POST['nom'])?$_POST['nom']:''); 	
		$struct = (!empty($_POST['struct'])?$_POST['struct']:null); 
		$ville = (isset($_POST['ville'])?$_POST['ville']:$ville); 

		$localisation = (isset($_POST['localisation'])?$_POST['localisation']:''); 
		$gps = (isset($_POST['gps'])?$_POST['gps']:''); 
		$nomresp = (isset($_POST['nomresp'])?$_POST['nomresp']:''); 
		$foncresp = (isset($_POST['foncresp'])?$_POST['foncresp']:''); 
		$contresp = (isset($_POST['contresp'])?$_POST['contresp']:''); 

		$query="SELECT * FROM Site WHERE (CODE_SITE='".$code."' OR LIBELLE='".$nom."')"; 
		$result=$bdd->query($query);
		$i=0;
		$exist= array("","");
		while ($lign = $result->fetch())
			{
			$exist[0]=$lign['CODE_SITE'];
			$exist[1]=$lign['LIBELLE'];
			$i++;
			}
		$result->closeCursor();	

		if($i && $exist[0]==$code)
			$tab=array(2,$exist[0]);
		elseif($i && $exist[1]==$nom)
			$tab=array(1,$exist[1]);
		else{

			$insert="INSERT INTO Site(USER,STATUT,NIVEAU,TYPE_SITE,CODE_SITE,LIBELLE,STRUCT,VILLE,
			ADRESSE_GEO,COORDON_GPS,NOM_RESPO,FONCTION_RESPO,CONTACT_RESPO,DATE_CREATION)";
			$insert.=" VALUES(0,".$statut.",".$niveau.",".$type.",'".str_replace("'","''",$code)."',
			'".str_replace("'","''",$nom)."',".$struct.",".$ville.",'".str_replace("'","''",$localisation)."',
			'".str_replace("'","''",$gps)."','".str_replace("'","''",$nomresp)."','".str_replace("'","''",$foncresp)."',
			'".str_replace("'","''",$contresp)."','".date("Y-m-d H:i:s")."')";
			$bdd->exec($insert);

			$tab=array(0);
		}

	return $tab;
	}
	
	if($_POST['action-id']==3)
		$tab=Activation($bdd,$_POST['confirmation-id'],$_POST['statut'],$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
	elseif($_POST['action-id']==2)
		$tab=Modification($bdd,$_SESSION['VILLE'],$_SESSION['ID_UTIL']);
	elseif($_POST['action-id']==0)
		$tab=Ajout($bdd,$_SESSION['VILLE'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);


?>
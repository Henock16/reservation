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

	function Activation($bdd,$id,$statut,$ville,$affecteur){

		$query="UPDATE Inspecteur SET STATUT='".(1-$statut)."' WHERE IDENTIFIANT='".$id."' AND STATUT='".$statut."'";
		$req1=$bdd->exec($query);
		$tab[0]=($req1?0:"Erreur liée à la base de données");

	return $tab;
	}
	
	function Modification($bdd,$ville,$affecteur){

		$id = (isset($_POST['inspecteur-id'])?$_POST['inspecteur-id']:''); 
		$actif = (isset($_POST['statut'])?$_POST['statut']:0); 
		$matr = (isset($_POST['matricule'])?$_POST['matricule']:''); 
		$name = (isset($_POST['nom'])?$_POST['nom']:''); 
		$surname = (isset($_POST['prenoms'])?$_POST['prenoms']:''); 
		$city = (isset($_POST['ville'])?$_POST['ville']:''); 
		$born = (($_POST['naissance']!='')?"'".datesitetoserver($_POST['naissance'])."'":null); 
		$site = (!empty($_POST['site'])?$_POST['site']:0); 
		$perso = (isset($_POST['telephone'])?$_POST['telephone']:''); 

		$flotte = (isset($_POST['flotte'])?$_POST['flotte']:''); 
		$habitation = (isset($_POST['habitation'])?$_POST['habitation']:''); 
		$mail = (isset($_POST['mail'])?$_POST['mail']:''); 
		$contrat = (isset($_POST['contrat'])?$_POST['contrat']:0); 
		$diplome = (isset($_POST['diplome'])?$_POST['diplome']:''); 
		$niveau = (isset($_POST['niveau'])?$_POST['niveau']:''); 

		$query="SELECT * FROM Inspecteur WHERE IDENTIFIANT<>".$id." AND MATRICULE='".$matr."'"; 
		$result=$bdd->query($query);
		$i=0;
		$exist= array("","");
		while ($lign = $result->fetch())
			{
			$exist[0]=$lign['IDENTIFIANT'];
			$exist[1]=$lign['MATRICULE'];
			$i++;
			}
		$result->closeCursor();	

		if($i)
			$tab=array(2,$exist[1]);
		else
			{
			$query="SELECT * FROM Site WHERE IDENTIFIANT='".$site."'"; 
			$result=$bdd->query($query);
			$ville="";
			while($lign = $result->fetch())
				$ville=$lign['VILLE'];
			$result->closeCursor();	

			if($site && ($ville!=$city))
				$tab=array(1);
			else
				{
				$result=$bdd->query("SELECT * FROM Inspecteur WHERE IDENTIFIANT=".$id."");
				$oldsite=0;
				$oldstat="";
				while ($lign = $result->fetch())
					{
					$oldsite=$lign['SITE_AFFECTATION']; 
					$oldstat=$lign['STATUT']; 
					}
				$result->closeCursor();	

				if(($site!=$oldsite)||($actif!=$oldstat))
					{
					if($site && ($actif==0))
						$bdd->exec("INSERT INTO  Permanence(INSPECTEUR,SITE,DATE_AFFECT,TYPE,USER,DATE_CREATION) 
					VALUES(".$id.",".$site.",'".date("Y-m-d")."',1,0,'".date("Y-m-d H:i:s")."')");
					if($oldsite && ($oldstat==0))
						$bdd->exec("INSERT INTO  Permanence(INSPECTEUR,SITE,DATE_AFFECT,TYPE,USER,DATE_CREATION) 
					VALUES(".$id.",".$oldsite.",'".date("Y-m-d")."',-1,0,'".date("Y-m-d H:i:s")."')");
					}

				$modif="UPDATE Inspecteur SET STATUT=".$actif.",MATRICULE='".str_replace("'","''",$matr)."',
				NOM='".str_replace("'","''",$name)."',PRENOMS='".str_replace("'","''",$surname)."',VILLE=".$city.",
				CONTACT_FLOTTE='".str_replace("'","''",$flotte)."',LIEU_HABITATION='".str_replace("'","''",$habitation)."',
				DIPLOME='".str_replace("'","''",$diplome)."',CONTRAT='".$contrat."',DATE_NAISSANCE=".(($born==null)?"NULL":$born).",
				EMAIL='".str_replace("'","''",$mail)."',NIVEAU_ETUDE='".str_replace("'","''",$niveau)."',
				SITE_AFFECTATION=".$site.",CONTACT_PERSO='".str_replace("'","''",$perso)."' WHERE IDENTIFIANT='".$id."'";
				$bdd->exec($modif);

				$tab=array(0);
				}
			}
	return $tab;
	}

	function Ajout($bdd,$ville,$affecteur){
	
		$actif = (isset($_POST['statut'])?$_POST['statut']:0); 
		$matr = (isset($_POST['matricule'])?$_POST['matricule']:''); 
		$name = (isset($_POST['nom'])?$_POST['nom']:''); 
		$surname = (isset($_POST['prenoms'])?$_POST['prenoms']:''); 
		$city = (isset($_POST['ville'])?$_POST['ville']:$ville); 
		$born = (($_POST['naissance']!='')?"'".datesitetoserver($_POST['naissance'])."'":null); 
		$site = (!empty($_POST['site'])?$_POST['site']:0); 
		$perso = (isset($_POST['telephone'])?$_POST['telephone']:''); 

		$flotte = (isset($_POST['flotte'])?$_POST['flotte']:''); 
		$habitation = (isset($_POST['habitation'])?$_POST['habitation']:''); 
		$mail = (isset($_POST['mail'])?$_POST['mail']:''); 
		$contrat = (isset($_POST['contrat'])?$_POST['contrat']:0); 
		$diplome = (isset($_POST['diplome'])?$_POST['diplome']:''); 
		$niveau = (isset($_POST['niveau'])?$_POST['niveau']:''); 

		$query="SELECT * FROM Inspecteur WHERE MATRICULE='".$matr."'"; 
		$result=$bdd->query($query);
		$i=0;
		$exist="";
		while ($lign = $result->fetch())
			{
			$exist=$lign['MATRICULE'];
			$i++;
			}
		$result->closeCursor();	

		if($i)
			$tab=array(2,$exist);
		else
			{
			$query="SELECT * FROM Site WHERE IDENTIFIANT='".$site."'"; 
			$result=$bdd->query($query);
			$ville="";
			while ($lign = $result->fetch())
				$ville=$lign['VILLE'];
			$result->closeCursor();	

			if($site && ($ville!=$city))
				$tab=array(1);
			else
				{

				$insert="INSERT INTO Inspecteur(STATUT,MATRICULE,NOM,PRENOMS,VILLE,CONTACT_FLOTTE,LIEU_HABITATION,
				DIPLOME,CONTRAT,DATE_NAISSANCE,EMAIL,NIVEAU_ETUDE,SITE_AFFECTATION,CONTACT_PERSO,DATE_CREATION)";
				$insert.=" VALUES(".$actif.",'".str_replace("'","''",$matr)."','".str_replace("'","''",$name)."',
				'".str_replace("'","''",$surname)."',".$city.",'".str_replace("'","''",$flotte)."',
				'".str_replace("'","''",$habitation)."','".str_replace("'","''",$diplome)."','".$contrat."',
				".(($born==null)?"NULL":$born).",'".str_replace("'","''",$mail)."','".str_replace("'","''",$niveau)."',
				".$site.",'".str_replace("'","''",$perso)."',
				'".date("Y-m-d H:i:s")."')";
				$bdd->exec($insert);

				if($site && ($actif==0))
					$bdd->exec("INSERT INTO  Permanence(INSPECTEUR,SITE,DATE_AFFECT,TYPE,USER,DATE_CREATION) 
				VALUES(".$bdd->lastInsertId().",".$site.",'".date("Y-m-d")."',1,0,'".date("Y-m-d H:i:s")."')");

				$tab=array(0);
				}
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
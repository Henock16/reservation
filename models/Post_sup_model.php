<?php
    session_start();
    include('../config/Connexion.php');
    include('../functions/Date_function.php');
	include('../functions/Table_value_function.php');
	//pour avoir l'heure d'abidjan  
 	date_default_timezone_set('Africa/Abidjan');
 	//$weekbegin est une variable qui represente le debut du premier jour de la semaine, weekend le dernier jour de la semaine et endate reprensente le jour j
 	$weekbegin = date('Y-m-d',strtotime("sunday-2 week"));
 	$weekend = date('Y-m-d',strtotime("sunday 1 week"));
 	$endate=date("Y-m-d");
	$superviseur=(isset($_POST['superviseur'])?$_POST['superviseur']:'');
	$typecompte=(isset($_POST['typeuser'])?$_POST['typeuser']:'');
	$nomsup=getvalue($bdd,'IDENTIFIANT,NOM_RESPO','user','IDENTIFIANT',$_SESSION['ID_UTIL']);
if($_POST['action']=='inserer')
	{
		$inspecteur= (isset($_POST['ins'])?$_POST['ins']:'');
        $plagehoraire= (isset($_POST['plagem'])?$_POST['plagem']:'');
        $date= (isset($_POST['date'])?$_POST['date']:'');
        $nbh= (isset($_POST['nbh'])?$_POST['nbh']:'');
        $date=datesitetoserver($date);
        $debut = strtotime($date);
        $fin = strtotime($endate);
        $heureA=date("H:i:s");
        $heureD="19:00:00";
		//On vérifie si le compte est de type administrateurs et si un superviseur a été selectionnez
		if($typecompte==3 && !empty($superviseur))
		{
			$lign_Exist=$bdd->prepare(" SELECT * FROM matrice WHERE DATE_AFFECTATION ='".$date."' AND INSPECTEUR='".$inspecteur."'AND SUPERVISEUR=".$superviseur);
			$lign_Exist->execute();
			$lign_count = $lign_Exist->rowCount();
			  
			if($lign_count != 0 )
			{
			
				$tab[0]=1;
				$tab[1]='alert alert-danger alert-dismissible';
				$tab[2]='ATTENTION';
				$tab[3]='<strong>Cette ligne existe déjà !</strong> ';							
				$tab[4]='btn btn-danger';
				$tab[5]='OK';
				
			}
			else 
			{
					$conf=0;
					$alert='alert alert-warning alert-dismissible'; 
					$ttle='VALIDATION';
					$mssg="<p style=\"color:orange;\">
							Voulez vous vraiment valider cette operation !
							</p>";
					$bttn='Valider';
					$bout='btn btn-warning';
				$tab[0]=$conf;
				$tab[1]=$alert;
				$tab[2]=$ttle;
				$tab[3]=$mssg;							
				$tab[4]=$bout;
				$tab[5]=$bttn;
				$tab[6]=$superviseur;
				$tab[7]=$inspecteur;
				$tab[8]=$plagehoraire;
				$tab[9]=$date;
				$tab[10]=$nbh;
				}
		}
        //on vas comparez la date entrez a la date d'aujourd'hui et vérifié si elle est cmprise dans un intervalle de la semaine derniére
        else if($debut<$fin || $debut == $fin && $heureD <= $heureA && $plagehoraire ==1)
        {
	        //On cherche l'existence dans la base de données si ya double affectation le meme jour à la meme plage horaire
			$lign_Exist=$bdd->prepare(" SELECT * FROM matrice WHERE DATE_AFFECTATION ='".$date."' AND INSPECTEUR=".$inspecteur);

			$lign_Exist->execute();
			$lign_count = $lign_Exist->rowCount();
			  
			if($lign_count != 0 )
			{
			
				$tab[0]=1;
				$tab[1]='alert alert-danger alert-dismissible';
				$tab[2]='ATTENTION';
				$tab[3]='<strong>Cet inspecteur a déjà été enregistré à cette même date !</strong> ';							
				$tab[4]='btn btn-danger';
				$tab[5]='OK';
				
			}
			else 
			{
				//on vérifie si la date entrez est comprise dans la semaine encour
				if($weekbegin<$date && $date<=$endate){
					$conf=0;
					$alert='alert alert-warning alert-dismissible'; 
					$ttle='VALIDATION';
					$mssg="<p style=\"color:orange;\">
							Voulez vous vraiment valider cette operation !
							</p>";
					$bttn='Valider';
					$bout='btn btn-warning';
				$tab[0]=$conf;
				$tab[1]=$alert;
				$tab[2]=$ttle;
				$tab[3]=$mssg;							
				$tab[4]=$bout;
				$tab[5]=$bttn;
				$tab[6]=$inspecteur;
				$tab[7]=$plagehoraire;
				$tab[8]=$date;
				$tab[9]=$nbh;
				}
				else
				{
					$tab[0]=3;
				$tab[1]='alert alert-warning alert-dismissible';
				$tab[2]='ATTENTION';
				$tab[3]="<p style=\"color:orange;\">
						 Veuillez changer la date entrée car elle fait partie des semaines clôturées !
						</p>";
				$tab[5]='ok';
				$tab[4]='btn btn-warning';
				}
			}
		}
		else
		{
				$tab[0]=3;
				$tab[1]='alert alert-warning alert-dismissible';
				$tab[2]='ATTENTION';
				$tab[3]="<p style=\"color:orange;\">
						  Veuillez changer la date entrée car elle n'est pas encore cloturée!
						</p>";
				$tab[5]='ok';
				$tab[4]='btn btn-warning';
		}
		/* Output header */
		header('Content-type: application/json');
		echo json_encode($tab);
		
	}
		//////////////////////////////////////////////////////////////
 if($_POST['action']=='confirmer' ){
 		$id=(isset($_POST['id'])?$_POST['id']:'');
 		$inspecteur= (isset($_POST['ins'])?$_POST['ins']:'');
		$superviseur=(isset($_POST['super'])?$_POST['super']:'');
        $plagehoraire= (isset($_POST['plagem'])?$_POST['plagem']:'');
        $date= (isset($_POST['date'])?$_POST['date']:'');
        $nbh= (isset($_POST['nbh'])?$_POST['nbh']:'');
		$typecompte=(isset($_POST['typecompte'])?$_POST['typecompte']:'');
        $date=datesitetoserver($date);
		$superviseur=($typecompte==3 && !empty($superviseur))?$superviseur:$_SESSION['ID_UTIL'];
       if($inspecteur == $_POST['ins'] && $_POST['id'] == ''){
	        $sql="INSERT INTO matrice(SUPERVISEUR,INSPECTEUR,DATE_AFFECTATION,PLAGE_HORAIRE,NB_HEURE,DATE_CREATION) 
	                              VALUES('".$superviseur."','".$inspecteur."','".$date."','".$plagehoraire."','".$nbh."','".date('Y-m-d H:i:s')."')";
	        $result= $bdd->prepare($sql);
	        $result->execute();
    	
	        //Message visuel de retour d'affectation effectuée avec succès
	    
	        $tab[0]=0;
	        $tab[1]='alert alert-success alert-dismissible';
	        $tab[2]='';							
	        $tab[3]='<br/>Effectué avec succès !';							
	        $tab[4]='btn btn-success';
	        $tab[5]='OK';
	      }elseif($_POST['id'] !='' && $_POST['id'] ==$id && $inspecteur!='' && $plagehoraire!='' && $date!='' && $nbh!=''){
			($typecompte==3)?$modif=" UPDATE matrice SET SUPERVISEUR='".$_POST['super']."',INSPECTEUR='".$_POST['ins']."',PLAGE_HORAIRE='".$_POST['plagem']."',DATE_AFFECTATION='".$date."',NB_HEURE='".$_POST['nbh']."'WHERE IDENTIFIANT=".$id:$modif=" UPDATE matrice SET INSPECTEUR='".$_POST['ins']."',PLAGE_HORAIRE='".$_POST['plagem']."',DATE_AFFECTATION='".$date."',NB_HEURE='".$_POST['nbh']."'WHERE IDENTIFIANT=".$id;
			 $bdd->exec($modif);
			$tab[0]=1;
	        $tab[1]='alert alert-success alert-dismissible';
	        $tab[2]='';							
	        $tab[3]='<br/>Modifié avec succès !';							
	        $tab[4]='btn btn-success';
	        $tab[5]='OK';
	      }else if(($inspecteur=='' && $plagehoraire=='' && $date=='' && $nbh=='' )|| ($typecompte==3 && $superviseur=''))
	      {
	      	$query="DELETE FROM matrice WHERE matrice.IDENTIFIANT =".$_POST['id'];
	
			$result=$bdd->exec($query);

			$tab[0]=2;
	        $tab[1]='alert alert-success alert-dismissible';
	        $tab[2]='';							
	        $tab[3]='<br/>Supprimé avec succès !';							
	        $tab[4]='btn btn-success';
	        $tab[5]='OK';
		  }
		/* Output header */
		header('Content-type: application/json');
		echo json_encode($tab);
 }

if($_POST['action']=='afficher' )
{	$superviseur=(isset($_POST['sup'])?$_POST['sup']:'');
	$semaineD=(isset($_POST['semaine'])?$_POST['semaine']:'');
	$semaineD=substr($semaineD, 0, 10);
	$semaineF=(isset($_POST['semaine'])?$_POST['semaine']:'');
	$semaineF=substr($semaineF, -10, 10);
	if($typecompte==3)
	{
		$query="SELECT M.IDENTIFIANT, M.DATE_AFFECTATION, M.SUPERVISEUR, U.NOM_RESPO,I.IDENTIFIANT AS ID_INSP,I.NOM,I.PRENOMS,M.PLAGE_HORAIRE,M.NB_HEURE";
		$query.=" FROM matrice M, Inspecteur I, User U";
		$query.=" WHERE I.IDENTIFIANT=M.INSPECTEUR AND U.IDENTIFIANT=M.SUPERVISEUR AND M.DATE_AFFECTATION>='".$semaineD."' AND M.DATE_AFFECTATION<='".$semaineF."'AND M.SUPERVISEUR ='".$superviseur."'ORDER BY M.DATE_AFFECTATION";
		$result=$bdd->query($query);

	}else
	{
		$query="SELECT M.IDENTIFIANT, M.DATE_AFFECTATION, M.SUPERVISEUR, I.IDENTIFIANT AS ID_INSP,I.NOM,I.PRENOMS,M.PLAGE_HORAIRE,M.NB_HEURE";
		$query.=" FROM matrice M, Inspecteur I ";
		$query.=" WHERE I.IDENTIFIANT=M.INSPECTEUR AND M.DATE_AFFECTATION>'".$weekbegin."' AND M.DATE_AFFECTATION<='".$endate."'AND M.SUPERVISEUR ='".$_SESSION['ID_UTIL']."'ORDER BY M.DATE_AFFECTATION";
		$result=$bdd->query($query);
	}
	
		$i=0;
		$tab[$i]=0;
		$i++;
				
		$tab[$i] = $result -> rowCount();
		$i++;

		$tab[$i]=9;
		$i++;	
		while ($donnees = $result->fetch()){
			
			$tab[$i] = $donnees['IDENTIFIANT'];
			$i++;

			$tab[$i] = date('d/m/Y',strtotime($donnees['DATE_AFFECTATION']));
			$i++;

			$tab[$i] = $donnees['SUPERVISEUR'];
			$i++;
						
			$tab[$i] = ($typecompte==3)?$donnees['NOM_RESPO']:$nomsup;
			$i++;

			$tab[$i] = $donnees['ID_INSP'];
			$i++;
						
			$tab[$i] = strtoupper($donnees['NOM']).' '.strtoupper($donnees['PRENOMS']);
			$i++;
											

			$tab[$i] = $donnees['PLAGE_HORAIRE'];
			$i++;

			$tab[$i] = $donnees['NB_HEURE'];
			$i++;
						
			$tab[$i] = $donnees['DATE_AFFECTATION'];
			$i++;
			
		}
		$result->closeCursor();	

/* Output header */
	header('Content-type: application/json');
	echo json_encode($tab);
}
//affiche les donnees dans le formulaire pour modification

if($_POST['action'] == 'Affmodifier')
{
	$id = (isset($_POST['id_l'])?$_POST['id_l']:'');
	$typecompte=(isset($_POST['typecompte'])?$_POST['typecompte']:'');
		if($id == $_POST['id_l'] )
			{	
				if($typecompte==3)
				{
					$query=" SELECT SUPERVISEUR,INSPECTEUR,PLAGE_HORAIRE,DATE_AFFECTATION,NB_HEURE FROM matrice WHERE IDENTIFIANT=".$id; 
					$result=$bdd->query($query);
					
					$lign = $result->fetch();
						$tab[0] = 0;
						$tab[1] = $lign['SUPERVISEUR'];
						$tab[2] = $lign['INSPECTEUR'];
						$tab[3] = $lign['PLAGE_HORAIRE'];
						$tab[4] = date('d/m/Y',strtotime($lign['DATE_AFFECTATION']));
						$tab[5] = $lign['NB_HEURE'];
					$result->closeCursor();
				}
				else
				{
					$query=" SELECT INSPECTEUR,PLAGE_HORAIRE,DATE_AFFECTATION,NB_HEURE FROM matrice WHERE IDENTIFIANT=".$id; 
					$result=$bdd->query($query);
					
					$lign = $result->fetch();
						$tab[0] = 0;
						$tab[1] = $lign['INSPECTEUR'];
						$tab[2] = $lign['PLAGE_HORAIRE'];
						$tab[3] = date('d/m/Y',strtotime( $lign['DATE_AFFECTATION']));
						$tab[4] = $lign['NB_HEURE'];
					$result->closeCursor();
				}
			}
			else{
				$tab[0]=1;
				$tab[1]='Erreur !';
			}
			
			
	/* Output header */
	header('Content-type: application/json');
	echo json_encode($tab);
}	

//au clique du bouton modifier

if($_POST['action'] == 'modifier')
{
	$id = (isset($_POST['id_l'])?$_POST['id_l']:'');
	$inspecteur= (isset($_POST['ins'])?$_POST['ins']:'');
        $plagehoraire= (isset($_POST['plagem'])?$_POST['plagem']:'');
        $date= (isset($_POST['date'])?$_POST['date']:'');
        $nbh= (isset($_POST['nbh'])?$_POST['nbh']:'');
		$superviseur=(isset($_POST['super'])?$_POST['super']:'');
		$typecompte= (isset($_POST['typecompte'])?$_POST['typecompte']:'');
        $date=datesitetoserver($date);
        $endate=date("Y-m-d");
        $debut = strtotime($date);
        $fin = strtotime($endate);
        $heureA=date("H:i:s");
        $heureD="19:00:00";
		if($typecompte==3)
		{
			$lign_Exist=$bdd->prepare(" SELECT * FROM matrice WHERE DATE_AFFECTATION ='".$date."'AND SUPERVISEUR ='".$superviseur."'AND INSPECTEUR ='".$inspecteur."'AND PLAGE_HORAIRE ='".$plagehoraire."'");
			$lign_Exist->execute();
			$lign_count = $lign_Exist->rowCount();
			  
			if($lign_count != 0 )
			{
			
				$tab[0]=1;
				$tab[1]='alert alert-danger alert-dismissible';
				$tab[2]='ATTENTION';
				$tab[3]='<strong>Cette ligne existe déjà !</strong> ';							
				$tab[4]='btn btn-danger';
				$tab[5]='OK';
				
			}
			else 
			{
					$conf=1;
					$alert='alert alert-warning alert-dismissible';
					$ttle='VALIDATION';
					$mssg="<p style=\"color:orange;\">
							Voulez vous vraiment modifier ces informations !
							</p>";
					$bttn='Valider';
					$bout='btn btn-warning';
					$tab[0]=$conf;
					$tab[1]=$alert;
					$tab[2]=$ttle;
					$tab[3]=$mssg;							
					$tab[4]=$bout;
					$tab[5]=$bttn;
					$tab[6]=$superviseur;
					$tab[7]=$inspecteur;
					$tab[8]=$plagehoraire;
					$tab[9]=$date;
					$tab[10]=$nbh;
					$tab[11]=$typecompte;
				}
			}
        //on vas comparez la date entrez a la date d'aujourd'hui
        else if($debut<$fin || $debut == $fin && $heureD <= $heureA && $plagehoraire==1)
        {
        
	        	$lign_Exist=$bdd->prepare(" SELECT * FROM matrice WHERE DATE_AFFECTATION ='".$date."'AND INSPECTEUR=".$inspecteur);
				$lign_Exist->execute();
				$compare=$lign_Exist->fetch();
				$lign_count = $lign_Exist->rowCount();

			if($lign_count!=0 )
				{
					if($compare['PLAGE_HORAIRE']==$plagehoraire)	
					{
						$tab[0]=2;
						$tab[1]='alert alert-danger alert-dismissible';
						$tab[2]='ERREUR';
						$tab[3]='<strong>Votre demande n a pas été effectuée car cet inspecteur et cette date existent déja!</strong>';		
						$tab[4]='btn btn-danger';
						$tab[5]='OK';
					}else if($compare['PLAGE_HORAIRE']!=$plagehoraire && $id!=$compare['IDENTIFIANT'])
					{
						$tab[0]=2;
						$tab[1]='alert alert-danger alert-dismissible';
						$tab[2]='ERREUR';
						$tab[3]='<strong>Votre demande n a pas été effectuée car cet inspecteur et cette date existent déja!</strong>';		
						$tab[4]='btn btn-danger';
						$tab[5]='OK';
					}
					else if($weekbegin<$date && $date<=$endate)
					{	
					 	$conf=1;
						$alert='alert alert-warning alert-dismissible';
						$ttle='VALIDATION';
						$mssg="<p style=\"color:orange;\">
								Voulez vous vraiment modifier ces informations !
								</p>";
						$bttn='Valider';
						$bout='btn btn-warning';
						$tab[0]=$conf;
						$tab[1]=$alert;
						$tab[2]=$ttle;
						$tab[3]=$mssg;							
						$tab[4]=$bout;
						$tab[5]=$bttn;
						$tab[6]=$inspecteur;
						$tab[7]=$plagehoraire;
						$tab[8]=$date;
						$tab[9]=$nbh;
					
					}
				}
				else /*if($compare['PLAGE_HORAIRE']!=$plagehoraire )*/
				{
					if($weekbegin<$date && $date<=$endate)
					{	
					 	$conf=1;
						$alert='alert alert-warning alert-dismissible';
						$ttle='VALIDATION';
						$mssg="<p style=\"color:orange;\">
								Voulez vous vraiment modifier ces informations !
								</p>";
						$bttn='Valider';
						$bout='btn btn-warning';
						$tab[0]=$conf;
						$tab[1]=$alert;
						$tab[2]=$ttle;
						$tab[3]=$mssg;							
						$tab[4]=$bout;
						$tab[5]=$bttn;
						$tab[6]=$inspecteur;
						$tab[7]=$plagehoraire;
						$tab[8]=$date;
						$tab[9]=$nbh;
					
					}
					else
					{
						$tab[0]=3;
						$tab[1]='alert alert-warning alert-dismissible';
						$tab[2]='ATTENTION';
						$tab[3]="<p style=\"color:orange;\">
						 Veuillez changer la date entrée car la semaine n'est pas encore clôturée !
						</p>";
						$tab[5]='ok';
						$tab[4]='btn btn-warning';
					}
				}
		}
			else
			{
				$tab[0]=3;
				$tab[1]='alert alert-warning alert-dismissible';
				$tab[2]='ATTENTION';
				$tab[3]="<p style=\"color:orange;\">
						 Veuillez changer la date entrée car la plage horaire n'a pas été cloturée !
						</p>";
				$tab[5]='ok';
				$tab[4]='btn btn-warning';
			}
	/* Output header */
	header('Content-type: application/json');
	echo json_encode($tab);
}	



if($_POST['action']=='suprimer'){
	$idl=(isset($_POST['idligne'])?$_POST['idligne']:'');
		  		$lign=$bdd->prepare(" SELECT INSPECTEUR,PLAGE_HORAIRE,DATE_AFFECTATION,NB_HEURE FROM matrice WHERE IDENTIFIANT=".$idl);
				$lign->execute();
				$lign_count = $lign->rowCount();
		if( $lign_count != 0){
					
	
			$tab[0]=0;
			$tab[1]='alert alert-danger alert-dismissible';
	        $tab[2]='';							
	        $tab[3]='<br/>Voulez vous supprimer cette ligne !';							
	        $tab[4]='btn btn-danger';
	        $tab[5]='oui';
	        }

	/* Output header */
	header('Content-type: application/json');
	echo json_encode($tab);
   
}


?>
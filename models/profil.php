<?php

	session_start();	
	    	
	include('../config/Connexion.php');

	
	$iduser=$_SESSION['ID_UTIL'];
 
	if(($_GET['action']=='mail')){    
		
		$sql="SELECT User.IDENTIFIANT, Email.IDENTIFIANT AS ID, Email.LIBELLE, Email.STATUT AS STAT 
				FROM User JOIN Email 
				WHERE User.IDENTIFIANT =:id AND User.IDENTIFIANT = Email.USER AND Email.STATUT = 0
				ORDER BY  Email.LIBELLE ASC";
		$result = $bdd->prepare($sql);
		$result -> bindParam(':id', $iduser, PDO::PARAM_INT);
		$result -> execute();
			     
		$head = null;
		$body = null;
			
		if(!$result -> rowCount()){
			$head.=' <tr><th style="text-align:center;;background-color:lightblue;" colspan=2>
						<h3>Adresse électronique</h3>
						</th></tr>';

			$body.='<tr>                                                   
							<td style="width:100%; margin:auto;" style="text-align:center;" bgcolor="white" >
								<p style="text-align:center;">Vous n\'avez aucune adresse électronique configurée</p>
							</td>
					</tr>';
		}else{
			$head.=' <tr><th style="text-align:center;;background-color:lightblue;"><h3>Adresse électronique</h3></th>
					<th style="text-align:center;;background-color:lightblue;">Option</th></tr>';		   			
						
			while ($donnees = $result->fetch())			
				$body.='<tr id="ligne_'.$donnees['ID'].'">                                                   
								<td style="width:85%; margin:auto;" bgcolor="white" >
									<input type="label" style="text-align:center; height:30px;" class="form-control" name="" value="'.$donnees['LIBELLE'].'" disabled="disabled">
								</td>
								<td style="width:15%;text-align:center;" bgcolor="white" >
									<a href="javascript:delmail('.$donnees['ID'].')" class="btn btn-light">Desactiver</a>
								</td>
						</tr>';
		}						
		$result->closeCursor();

  /* Output header */
    header('Content-type: application/json');
    echo json_encode(array($head,$body));
						
	}

	if($_GET['action']=='desactiver'){    
    
    	$result = $bdd->prepare("UPDATE Email SET STATUT =1 WHERE Email.IDENTIFIANT =:id AND Email.USER =:user");
    	$result -> bindParam(':id', $_GET['idmail'], PDO::PARAM_INT);
    	$result -> bindParam(':user', $iduser, PDO::PARAM_INT);
    	$result -> execute();    	
    	$result->closeCursor();
    	
   	    echo "ok";
     	
    }
    	
	if($_GET['action']=='ajouter'){    
    
		$sql="SELECT E.IDENTIFIANT,E.STATUT
				FROM User U,Email E
				WHERE U.IDENTIFIANT =:user 
				AND U.IDENTIFIANT = E.USER AND E.LIBELLE =:mail
				LIMIT 1";
		$result = $bdd->prepare($sql);
		$result -> bindParam(':user', $iduser, PDO::PARAM_INT);
		$result -> bindParam(':mail', $_GET['mail'], PDO::PARAM_STR);
		$result -> execute();
					 
		$exist = $result->rowCount();;
					


		if($exist){
			
			$donnees = $result->fetch();
			$stat = $donnees['STATUT'];
			$id = $donnees['IDENTIFIANT'];
		
			if($stat){

				$result = $bdd->prepare("UPDATE Email SET STATUT =0 WHERE IDENTIFIANT =:id");
				$result -> bindParam(':id', $id, PDO::PARAM_INT);
				$result -> execute();				
				$result->closeCursor();
				
				echo "ok;".$id.";".str_replace(";","",$_GET['mail']);
			}else
				echo "ko;";
		}
		else{
			$result = $bdd->prepare("INSERT INTO Email(STATUT,LIBELLE,USER) VALUES(0,:mail,:user)");
			$result -> bindParam(':mail', $_GET['mail'], PDO::PARAM_STR);
			$result -> bindParam(':user', $iduser, PDO::PARAM_INT);
			$result -> execute();			
			$result->closeCursor();
			
			echo "ok;".$bdd->lastInsertId().";".str_replace(";","",$_GET['mail']);
		}   				     	
     	
    }
    	
 


 
	if(($_GET['action']=='info')){    
    
			$reponse = $bdd->prepare("SELECT * FROM User WHERE IDENTIFIANT =:id");
			$reponse -> bindParam(':id', $iduser, PDO::PARAM_INT);
			$reponse -> execute();
					
			$res="";
			while($donnees = $reponse->fetch()){
			$dern=$_SESSION['derniere_connexion'];
			$dern=(($dern!=null)?substr($dern,8,2).'/'.substr($dern,5,2).'/'.substr($dern,0,4).' à '.substr($dern,11,2).'h'.substr($dern,14,2).'m'.substr($dern,17,2).'s':'');		
			$res.=str_replace(";","",($dern!='')?'Dernière connexion le '.$dern:'Pas de dernière connexion');
			$res.=';'.str_replace(";","",$donnees['STRUCTURE']);
			$res.=';'.str_replace(";","",(($donnees['TYPE_STRUCT']==1)?'EXPORTATEUR':(($donnees['TYPE_STRUCT']==2)?'PONT BASCULE':(($donnees['TYPE_STRUCT']==3)?'USINE':(($donnees['TYPE_STRUCT']==4)?'TRANSITAIRE':'')))));
			$res.=';'.str_replace(";","",$donnees['SIGLE']);
			$res.=';'.str_replace(";","",$donnees['NUM_CC']);
			$res.=';'.str_replace(";","",(($donnees['VILLE'] == 1)?'Abidjan':(($donnees['VILLE'] == 2)?'San Pedro':"")));
			$res.=';'.str_replace(";","",$donnees['ADRESSE_GEO']);
			$res.=';'.str_replace(";","",$donnees['NOM_RESPO']);
			$res.=';'.str_replace(";","",$donnees['FONCTION_RESPO']);
			$res.=';'.str_replace(";","",$donnees['CONTACT_RESPO']);

				
			}
			
			$reponse->closeCursor();
    	
   	    echo $res;
     	
    }


 
	if(($_GET['action']=='charger')){    
    
			$reponse = $bdd->prepare("SELECT * FROM User WHERE IDENTIFIANT =:id");
			$reponse -> bindParam(':id', $iduser, PDO::PARAM_INT);
			$reponse -> execute();
			
			$res="";
					
			while($donnees = $reponse->fetch()){

            $res.='<option selected disabled>-------------------- Selectionner une categorie --------------------</option>
				    <option value="1" '.(($donnees['TYPE_STRUCT']==1)?'selected':'').' >EXPORTATEUR</option>
					<option value="2" '.(($donnees['TYPE_STRUCT']==2)?'selected':'').' >PONT BASCULE</option>
					<option value="3" '.(($donnees['TYPE_STRUCT']==3)?'selected':'').' >USINE</option>
					<option value="4" '.(($donnees['TYPE_STRUCT']==4)?'selected':'').' >TRANSITAIRE</option>';
			$res.=';'.str_replace(";","",$donnees['SIGLE']);
            $res.=';'.'<option selected disabled>----------------------- Selectionner une Ville -----------------------</option>
					<option value="1" '.(($donnees['VILLE']==1)?'selected':'').'>ABIDJAN</option>
					<option value="2" '.(($donnees['VILLE']==2)?'selected':'').'>SAN PEDRO</option>';
			$res.=';'.str_replace(";","",$donnees['ADRESSE_GEO']);
			$res.=';'.str_replace(";","",$donnees['NUM_CC']);
			$res.=';'.str_replace(";","",$donnees['NOM_RESPO']);
			$res.=';'.str_replace(";","",$donnees['FONCTION_RESPO']);
			$res.=';'.str_replace(";","",$donnees['CONTACT_RESPO']);
			}
    	
        	$reponse->closeCursor();
    	
   	    echo $res;
     	
    }

    	
	if(($_GET['action']=='modifier')){    
	    
        $contact="";
	    $i=0;
	    $j=0;
	    while(isset($_GET['contact'.$i]))
	        {
	            if(!empty($_GET['contact'.$i]))
	                {
	                $j++;
	                
	                $contact.=(($j==1)?"":",").trim(str_replace(",","",$_GET['contact'.$i]));
	                }
	            
	            $i++;
	        }
    
    	$result = $bdd->prepare("UPDATE User SET  TYPE_STRUCT=:categorie,SIGLE=:sigle,VILLE=:ville,ADRESSE_GEO=:adgeo,NUM_CC=:ncoco,NOM_RESPO=:nom,FONCTION_RESPO=:fonction,CONTACT_RESPO=:contact WHERE IDENTIFIANT =:iduser");
    	$result -> bindParam(':iduser', $iduser, PDO::PARAM_INT);
    	$result -> bindParam(':categorie', $_GET['categorie'], PDO::PARAM_INT);
    	$result -> bindParam(':sigle', $_GET['sigle'], PDO::PARAM_STR);
    	$result -> bindParam(':ville', $_GET['ville'], PDO::PARAM_INT);
    	$result -> bindParam(':adgeo', $_GET['adgeo'], PDO::PARAM_STR);
    	$result -> bindParam(':ncoco', $_GET['ncoco'], PDO::PARAM_STR);
    	$result -> bindParam(':nom', $_GET['nom'], PDO::PARAM_STR);
    	$result -> bindParam(':fonction', $_GET['fonction'], PDO::PARAM_STR);
    	$result -> bindParam(':contact', $contact, PDO::PARAM_STR);
    	$result -> execute();
    	
    	$result->closeCursor();
   	
   	    echo "ok";
     	
    }
    	
    $bdd = null;
	
?>
<?php
	/*
		Date creation : 26-02-2021
		Auteur : Cellule SOLAS - ABRS
		Version:1.0
		Dernière modification : 26-02-2021
		Dernier modificateur : Cellule SOLAS - ABRS
		Description: Obtenir les reponses et donner les questions pour les mot de passe oublies
	*/
	session_start();

	include_once('../../config/Connexion.php');
	include_once('../../functions/Date_function.php');
	include_once('../../functions/Mail_function.php');

	$test=$_POST['test'];
	$matr=$_POST['matr'];
	$chp=$_POST['champ'];
	$res=$_POST['result'];

	if($test==0){
		$tab[0]=$test+1;
		$tab[1]=$matr;
		$tab[2]=$chp;
		$tab[3]=$res;
		$tab[4]="Pas de panique. Cette fenêtre vous permettra certainement de réinitialiser votre mot de passe ou de le recevoir par mail.<br/>
		Pour ce faire, il va vous falloir repondre correctement aux différentes questions qui vous seront posées.";
		$tab[5]='';
	}elseif($test==1){
		$tab[0]=$test+1;
		$tab[1]=$matr;
		$tab[2]=$chp;
		$tab[3]=$res;
		$tab[4]="Veuillez s'il vous pla&icirc;t saisir votre numéro matricule";
		$tab[5]='<input type="number" class="form-control" name="matricule" placeholder="Matricule" oninput="setCustomValidity(\'\')" oninvalid="this.setCustomValidity(\'Champ obligatoire\')" required />';		
	}elseif($test>=2){

		$info=array('date de naissance','sexe','statut matrimonial','numéro de téléphone','poste','date d\'embauche','categorie professionelle','adresse électronique');
		$champ=array('DATE_NAISS','SEXE','SITUATION_MATRI','TELEPHONE','ID_POSTE','DATE_EMBAUCHE','ID_CATEGORIE','EMAIL');
		$valeur=array('datenaissance','sexe','statut','telephone','poste','dateembauche','categorie','email');
		$type=array('date','radio','radio','number','select','date','select','email');

		$tour=$test-3;
		$matr=(($test>2)?$matr:$_POST['matricule']);
		$val=(($test>2)?(($type[$tour]=='date')?datesitetoserver($_POST[$valeur[$tour]]):$_POST[$valeur[$tour]]):'');//inversion de la valeur si le champ est de type date
		$liste=((($test>2) && in_array($type[$tour],array('number','email')))?1:0); //Le champ peut contenir une liste
		$query = $bdd -> prepare("SELECT * FROM agent WHERE MATRICULE = \"".$matr."\" ".((($test>2)&&!$liste)?"AND ".$champ[$tour]."= \"".$val."\"":""));
		$query -> execute();
		$rows = $query -> rowCount();

		//si le champ peut contenir une liste on y fouille
		if($liste){
			$data = $query -> fetch();
			$list=explode(",",$data[$champ[$tour]]);
			$rows=(in_array($val,$list)?1:0);
		}

		// si on vient de demander le matricule et qu'il nest pas correct
		if(($test == 2)&&($rows == 0)){
			$tab[0]=0;
			$tab[1]=$tour;
		}else{

			$chp=(($test>2)?(($chp!="")?$chp."-":"").$tour:"");
			$res=(($test>2)?(($res!="")?$res."-":"").$rows:"");

			$exist=0;
			while(!$exist && ($tour<count($champ)-1)){
				$tour++;
				$query = $bdd -> prepare("SELECT ".$champ[$tour]." FROM agent WHERE MATRICULE = :matricule ");
				$query -> bindParam(':matricule', $matr, PDO::PARAM_STR);
				$query -> execute();
				$data = $query -> fetch();
				if(!in_array($data[$champ[$tour]],array(null,"0","","0000-00-00")))
					$exist=1;
			}

			if($exist){
				$tab[0]=$tour+3;
				$tab[1]=$matr;
				$tab[2]=$chp;
				$tab[3]=$res;
				if($tour==0){
					$tab[4]="Veuillez s'il vous pla&icirc;t saisir votre date de naissance :";
					$tab[5]='datenaissance';
				}elseif($tour==1){
					$tab[4]="Veuillez s'il vous pla&icirc;t cocher votre sexe :";
					$tab[5]='<label for="homme"><table><tr><td><input type="radio" name="sexe" value="M" id="homme" class="form-control" required /></td><td>Homme</td></tr></table></label><br/>
							 <label for="femme"><table><tr><td><input type="radio" name="sexe" value="F" id="femme" class="form-control" required /></td><td>Femme</td></tr></table></label></label>';
				}elseif($tour==2){
					$tab[4]="Veuillez s'il vous pla&icirc;t cocher votre situation matrimoniale :";
					$tab[5]='<label for="single"><table><tr><td><input type="radio" name="statut" value="1" id="single" class="form-control" required /></td><td>Célibataire</td></tr></table></label><br/>
							 <label for="maried"><table><tr><td><input type="radio" name="statut" value="2" id="maried" class="form-control" required /></td><td>Marié(e)</td></tr></table></label><br/>
							 <label for="divorced"><table><tr><td><input type="radio" name="statut" value="3" id="divorced" class="form-control" required /></td><td>Divorcé(e)</td></tr></table></label><br/>
							 <label for="widowed"><table><tr><td><input type="radio" name="statut" value="4" id="widowed" class="form-control" required /></td><td>Veuf/Veuve</td></tr></table></label>';
				}elseif($tour==3){
					$tab[4]="Veuillez s'il vous pla&icirc;t saisir un de vos numéros de téléphone sans espace ni tiret :";
					$tab[5]='<input type="number" class="form-control" name="telephone" placeholder="Numéro de téléphone" oninput="setCustomValidity(\'\')" oninvalid="this.setCustomValidity(\'Champ obligatoire\')" required />';
				}elseif($tour==4){
					$tab[4]="Veuillez s'il vous pla&icirc;t sélectionner votre poste au sein de l'entreprise :";
					$tab[5]='<select class="form-control" name="poste" required>';
					$tab[5].='<option value=""></option>';
					$query = $bdd -> prepare("SELECT * FROM poste ORDER BY LIBELLE ");
					$query -> execute();
					while($data = $query -> fetch())
						$tab[5].='<option value="'.$data['IDENTIFIANT'].'">'.$data['LIBELLE'].'</option>';					
					$tab[5].='</select>';
				}elseif($tour==5){
					$tab[4]="Veuillez s'il vous pla&icirc;t saisir votre date d'embauche au sein de l'entreprise :";
					$tab[5]='dateembauche';
				}elseif($tour==6){
					$tab[4]="Veuillez s'il vous pla&icirc;t sélectionner votre catégorie professionnelle :";
					$tab[5]='<select class="form-control" name="categorie" required>';
					$tab[5].='<option value=""></option>';
					$query = $bdd -> prepare("SELECT * FROM categorie ORDER BY LIBELLE ");
					$query -> execute();
					while($data = $query -> fetch())
						$tab[5].='<option value="'.$data['IDENTIFIANT'].'">'.$data['LIBELLE'].'</option>';					
					$tab[5].='</select>';
				}elseif($tour==7){
					$tab[4]="Veuillez s'il vous pla&icirc;t saisir une de vos adresses électroniques :";
					$tab[5]='<input type="text" class="form-control" name="email" placeholder="Adresse électronique" oninput="setCustomValidity(\'\')" oninvalid="this.setCustomValidity(\'Champ obligatoire\')" required />';
				}
			}else{
				$tab[0]=-1;

				$chp=explode("-",$chp);
				$res=explode("-",$res);

				//calcul du nombre de succes
				$success=0;
				for($i=0;$i<count($res);$i++)
					$success+=$res[$i];

				//definition de la securite du compte
				$secure=((in_array(0,$chp) && in_array(3,$chp) && in_array(5,$chp))?1:0);

				//champs maquants
				$missing="";
				for($i=0;$i<count($info);$i++)
					$missing.=(in_array($i,$chp)?"":"- ".$info[$i]."<br/>");
				

				if($success==count($res)){//si toutes les infos sont correctes
					if($secure && in_array(7,$chp) && $mail_server==1){//si mail renseigne et compte securise

						$query = $bdd -> prepare("SELECT EMAIL, MOT_PASSE  FROM agent WHERE MATRICULE = :matricule ");
						$query -> bindParam(':matricule', $matr, PDO::PARAM_STR);
						$query -> execute();
						$data = $query -> fetch();

						$sujet=$appli." - VOTRE MOT DE PASSE OUBLIE";
						$message="Le mot de passe associé à votre numéro matricule <b>".$matr."</b> est <b>".$data['MOT_PASSE']."</b> dans l'application de gestion des demandes.";
						$message.="<br/><br/>Pour vous connecter, veuillez cliquer sur le lien <a href=\"https://".$nom_site."\">".$nom_site."</a> et connectez-vous grâce à votre <b>numéro matricule</b> et votre <b>mot de passe</b>.";
						$list=explode(",",$data['EMAIL']);
						for($i=0;$i<count($list);$i++)
							envoimail($list[$i],$sujet,$message,"","");

						$tab[4]="<p style=\"color: green\">Votre mot de passe vous a été transmis dans vos boites de messagerie.</p>";
					}elseif(in_array(7,$chp) && $mail_server==1)//si compte pas securise
						$tab[4]="<p style=\"color: red\">Le mot de passe ne peut pas être transmis dans la boite de messagerie associée à l'adresse mail que vous avez renseigné car vos informations de vérifiation ne sont pas suffisantes pour sécuriser l'accès de votre compte à l'application.</p>";
					elseif($secure){//si mail pas  renseigne et compte securise

						$query = $bdd -> prepare('UPDATE agent SET MOT_PASSE="12345", PREM_CONNEXION=2 WHERE MATRICULE = :matricule ');
						$query -> bindParam(':matricule', $matr, PDO::PARAM_STR);
						$query -> execute();

						$tab[4]="<p style=\"color: green\">Votre mot de passe a été reinitialisé. Vous pouvez vous connecter à l'application à l'aide de votre matricule \"".$matr."\" et du mot de passe \"12345\"</p>";
					}else//si mail pas  renseigne et compte pas securise
						$tab[4]="<p style=\"color: red\">Le mot de passe ne peut pas être reinitialisé car vos informations de vérifiation ne sont pas suffisantes pour sécuriser l'accès de votre compte à l'application.</p>";
				}else{//si au moins une info incorrecte
					if(in_array(7,$chp) && $mail_server==1)//si mail renseigne 
						$tab[4]="<p style=\"color: red\">Le mot de passe ne peut pas être transmis dans la boite de messagerie associée à l'adresse mail que vous avez renseigné car au moins une vos reponses ne correspond pas aux informations associées à votre matricule.</p>";
					else//si mail pas renseigne 
						$tab[4]="<p style=\"color: red\">Le mot de passe ne peut pas être reinitialisé car au moins une de vos reponses ne correspond pas aux informations associées à votre matricule. Veuillez les vérifier et les saisir à nouveau soigneusement.</p>";
				}
				$tab[5]=($missing?"<p style=\"color: blue\">".(($success==count($res))?"Veuillez":"Toutefois, veillez à")." rentrer en contact avec l'administration afin que vos informations suivantes de vérification soient renseignées dans l'application pour la sécurisation de l'accès à votre compte d'utilisateur:</p>".$missing:'');
			}
		}

	}



	/* Output header */
	header('Content-type: application/json');
	echo json_encode($tab);
?>

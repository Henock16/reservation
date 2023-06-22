<?php
/*
    Date creation : 18-05-2021
    Auteur : Cellule SOLAS - ABR0 Stephane
    Version:1.0
    Dernière modification : 18-05-2021
    Dernier modificateur : Cellule SOLAS - ABR0 Stephane
    Description: Obtenir les details d'un inspecteur
*/
	session_start();

	include('../config/Connexion.php');

	include_once('../functions/Date_function.php');

	function GetInspectorDetails($bdd,$id,$iduser){
		$query = "SELECT * FROM Inspecteur WHERE IDENTIFIANT= ".$id."  ";

		//requete SQL
		$reponse=$bdd->query($query);

		$i=0;
	    $tab[$i] = $reponse -> rowCount();;
	    $i++;

		while ($donnees = $reponse->fetch())
			{
					$tab[$i] = $donnees['IDENTIFIANT'];
					$i++;
					
					$tab[$i] = $donnees['STATUT'];
					$i++;
					
					$tab[$i] = $donnees['MATRICULE'];
					$i++;
					
					$tab[$i] = $donnees['NOM'];
					$i++;
					
					$tab[$i] = $donnees['PRENOMS'];
					$i++;
					
					$tab[$i] = (($donnees['DATE_NAISSANCE']=='0000-00-00')?'':dateservertosite($donnees['DATE_NAISSANCE']));
					$i++;
					
					$tab[$i] = (($donnees['LIEU_HABITATION']==null)?'':$donnees['LIEU_HABITATION']);
					$i++;
					
					$tab[$i] = (($donnees['EMAIL']==null)?'':$donnees['EMAIL']);
					$i++;
					
					$tab[$i] = (($donnees['CONTACT_PERSO']==null)?'':$donnees['CONTACT_PERSO']);
					$i++;
					
					$tab[$i] = (($donnees['CONTACT_FLOTTE']==null)?'':$donnees['CONTACT_FLOTTE']);
					$i++;
					
					$tab[$i] = $donnees['CONTRAT'];
					$i++;
					  
					$tab[$i] = $donnees['VILLE'];
					$i++;
										
					$tab[$i] = $donnees['SITE_AFFECTATION'];
					$i++;
					
					$tab[$i] = (($donnees['DIPLOME']==null)?'':$donnees['DIPLOME']);
					$i++;					

					$tab[$i] = (($donnees['NIVEAU_ETUDE']==null)?'':$donnees['NIVEAU_ETUDE']);
					$i++;					

					$tab[$i] = $donnees['QUARTIER'];
					$i++;

					$tab[$i]=(($donnees['COORDON_GPS']==null)?'':$donnees['COORDON_GPS']);
					$i++;

			}
		$reponse->closeCursor();		  

	return $tab;
	}

    $tab=GetInspectorDetails($bdd,$_POST['id'],$_SESSION['ID_UTIL']);

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
<?php
//include('../config/Connexion.php');

session_start();
include('../config/Connexion.php');

							
	$req=1;
	$nbsite=0;
	while($req<=2 && $nbsite==0){	
		$sql="SELECT S.IDENTIFIANT as ID,S.LIBELLE
			FROM Site S,User U
			WHERE S.STATUT=0 AND S.VILLE = U.VILLE ".(($req==1)?"AND S.USER = U.IDENTIFIANT":(($req==2)?"AND S.STRUCT = U.STRUCT":""))." 
			AND U.IDENTIFIANT = '".$_SESSION['ID_UTIL']."' 
			ORDER BY S.LIBELLE ";	
		$result = $bdd->query($sql);
		$nbsite = $result->rowCount();
		$req++;
	}

	$i=0;
	$tab[$i]=0;
	$i++;
	
	$tab[$i]=$nbsite;
	$i++;

	$tab[$i]=2;
	$i++;

	while ($donnees = $result->fetch()){

		$tab[$i]=(($donnees['ID']=="")?" ":$donnees['ID']);
		$i++;

		$tab[$i]=$donnees['LIBELLE'];
		$i++;
	}
	$result->closeCursor();	


    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>

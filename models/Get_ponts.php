<?php
//include('../config/Connexion.php');

session_start();
include('../config/Connexion.php');

							
$req=1;
$nbsite=0;
while($req<3 && $nbsite==0){	
	$sql="SELECT S.IDENTIFIANT as ID,S.LIBELLE as Libelle,S.CODE_SITE as code 
		FROM Site S,User U
		WHERE S.STATUT=0 AND S.VILLE = U.VILLE ".(($req==1)?"":"AND S.USER = U.IDENTIFIANT")." AND U.IDENTIFIANT = '".$_SESSION['ID_UTIL']."' 
		ORDER BY S.LIBELLE ";	
	$result = $bdd->query($sql);
	$nbsite = $result->rowCount();
	$req++;
}

$html='<option value="" selected="selected">Séléctionner le site de pesée</option>';

while ($donnees = $result->fetch()){
	$pt=(($donnees['ID']=="")?" ":$donnees['ID']);  
	$nom=$donnees['Libelle'].(($donnees['Libelle']&&$donnees['code'])?' (':'').$donnees['code'].(($donnees['Libelle']&&$donnees['code'])?')':'&lt;INCONNU&gt;');
	$html.= '<option value="'.$pt.'" '.((isset($_POST['site']))?(($_POST['site']==$pt)?'selected="selected"':''):'').'>'.(($nom=="/")?"&lt;VIDE&gt;":$nom).'</option>';
}
$result->closeCursor();	

echo $html;
?>

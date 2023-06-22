<?php
$host='localhost';
$user='root';
//$pass="kj2ji63E8bmpYSedjqaP658IYN78uL2Evg";//cci desktop
$pass=""; //my laptop
// $pass="NRtPEvqJYXtPE5gK"; //ipage
//$pass="KRbKsjK6jRrxQi"; //NSIA
$base='Pesage';
//$base='vgmci_resa';

date_default_timezone_set("Africa/Abidjan");

$bdd = new PDO('mysql:host='.$host.';dbname='.$base.';charset=utf8',$user , $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$uploadrep="uploads";
$lang=1; //1=FR/2=EN
$mpdf=7; //6=mpdf version 6 pour apache 5 /7=mpdf version 7 pour apache 7 avec autoloader
$echelle=1;//si $echelle=0 la feuille est en portrait si $echelle=1 la feuille est en payasage
$deconnect=15*60;//(minute*60=second)
$appli="RESERVATION";
$nom_site="reservation.pesagecci.ci"; //URL du site ou est hebergee l'application sans le http:// ou https://
$mail_server=1;	//0=pas de transmission de mail 1=transmission de mail=presence de serveur de mail
$test_mail=0; //1=envoyer tous les mails dans la boite de l'administrateur  0=envoyer les mails dans la boite  de l'utilisateur concerne
$affect_mail=0; //1=envoi de mail en cas daffectation automatique 0=non
$mail_admin="stephaneabro@cci.ci"; //Adresse électronique de l'administrateur

$sms_server=1;	//0=pas de transmission de sms 1=transmission de sms=presence de serveur de sms
$test_sms=0; //1=envoyer tous les sms sur le numéro de téléphone de l'administrateur  0=envoyer les sms sur le numéro de téléphone de l'utilisateur concerne
$affect_sms=0; //1=envoi de sms en cas daffectation automatique 0=non
$sms_admin="0749473093"; //Numéro de téléphone de l'administrateur

$nbreserv=10; //nb de reservations a afficher par page
$nbdays=0; //nb de jr de reservations a afficher: 0=nb de jr off / >0=nb de jr / -1=nb de jr infini
$plagejour=8; //nb Heure lors de la plage jour
$plagenuit=11; //nb Heure lors de la plage nuit
$heuremax=40; //nb Heure maximum a ne pas depasser par agent dans la semaine
$nbaffect=5; //nb daffectations a afficher pour un inspecteur
$nuits=2; //nb de nuits daffectations successives apres lequel il ya un repos obligatoire
$tarif=35000; //Cout d'une reservation de nuit et jour non ouvrable
$taux=1; //Nombre de mois d'avance dont on veut obtenir le taux de satisfaction des réservation
$heure_ab="16:00:00"; //Heure limite des reservations a Abidjan
$heure_sp="17:00:00"; //Heure limite des reservations a San Pedro

$query="SELECT * FROM Parametre ";
$res=$bdd->query($query);
while ($donnees = $res->fetch())
	{
	if("deconnect"==$donnees['NOM'])
		$deconnect=$donnees['VALEUR']*60;
	elseif("appli"==$donnees['NOM'])
		$appli=$donnees['VALEUR'];
	elseif("nom_site"==$donnees['NOM'])
		$nom_site=$donnees['VALEUR'];
	elseif("mail_server"==$donnees['NOM'])
		$mail_server=$donnees['VALEUR'];
	elseif("test_mail"==$donnees['NOM'])
		$test_mail=$donnees['VALEUR'];
	elseif("affect_mail"==$donnees['NOM'])
		$affect_mail=$donnees['VALEUR'];
	elseif("mail_admin"==$donnees['NOM'])
		$mail_admin=$donnees['VALEUR'];
	elseif("sms_server"==$donnees['NOM'])
		$sms_server=$donnees['VALEUR'];
	elseif("test_sms"==$donnees['NOM'])
		$test_sms=$donnees['VALEUR'];
	elseif("affect_sms"==$donnees['NOM'])
		$affect_sms=$donnees['VALEUR'];
	elseif("sms_admin"==$donnees['NOM'])
		$sms_admin=$donnees['VALEUR'];
	elseif("nbreserv"==$donnees['NOM'])
		$nbreserv=$donnees['VALEUR'];
	elseif("nbdays"==$donnees['NOM'])
		$nbdays=$donnees['VALEUR'];
	elseif("plagejour"==$donnees['NOM'])
		$plagejour=$donnees['VALEUR'];
	elseif("plagenuit"==$donnees['NOM'])
		$plagenuit=$donnees['VALEUR'];
	elseif("heuremax"==$donnees['NOM'])
		$heuremax=$donnees['VALEUR'];
	elseif("nbaffect"==$donnees['NOM'])
		$nbaffect=$donnees['VALEUR'];
	elseif("nuits"==$donnees['NOM'])
		$nuits=$donnees['VALEUR'];
	elseif("tarif"==$donnees['NOM'])
		$tarif=$donnees['VALEUR'];
	elseif("taux"==$donnees['NOM'])
		$taux=$donnees['VALEUR'];
	elseif("heure_ab"==$donnees['NOM'])
		$heure_ab=$donnees['VALEUR'];
	elseif("heure_sp"==$donnees['NOM'])
		$heure_sp=$donnees['VALEUR'];
	}
$res->closeCursor();	



?>

<?php

function EnvoiSMS($bdd,$action,$idreserv)
	{
	global $sms_server,$test_sms,$sms_admin;	

///*
	if($sms_server && $action!=3){

		$inspecteur="";
		$telephone="";
		$site="";
		$plage="";
		$reserv="";
		$query="SELECT R.DATE_RESERVATION,R.PLAGE_HORAIRE,R.USER, S.LIBELLE ".(($action==3)?"":", I.NOM,I.PRENOMS,I.CONTACT_FLOTTE,I.CONTACT_PERSO ");
		$query.=" FROM Reservation R,Site S ".(($action==3)?"":" ,Inspecteur I,Affectation A ");
		$query.=" WHERE R.IDENTIFIANT='".$idreserv."' AND  R.SITE=S.IDENTIFIANT ".(($action==3)?"":" AND A.INSPECTEUR=I.IDENTIFIANT AND A.RESERVATION=R.IDENTIFIANT AND A.STATUT='".(($action==5)?"2":"1")."' ORDER BY A.IDENTIFIANT DESC LIMIT 0,1");
		$res=$bdd->query($query);
		while ($lign = $res->fetch())
			{
			$inspecteur=(($action==3)?"":$lign['NOM']." ".$lign['PRENOMS']);
			$telephone=(($action==3)?"":$lign['CONTACT_FLOTTE'].(($lign['CONTACT_FLOTTE']&&$lign['CONTACT_PERSO'])?'/':'').$lign['CONTACT_PERSO']);
			$site=$lign['LIBELLE'];
			$plage=$lign['PLAGE_HORAIRE'];
			$reserv=$lign['DATE_RESERVATION'];
			}
		$res->closeCursor();	



		$reserv=substr($reserv,8,2).'/'.substr($reserv,5,2).'/'.substr($reserv,0,4);
		$plage=(($plage=="1")?"journée":"nuit");
		$site=strtoupper($site);

		$message="";
		if($action==5)
			$message="Bonjour ".$inspecteur.", Votre affectation pour la ".$plage." du ".$reserv." sur ".$site." a ete annulee.";
		else
			$message="Bonjour ".$inspecteur.", Vous etes affectes sur ".$site." pour la ".$plage." du ".$reserv.".";

		
		$origine="0758734934";
		$tel=explode('/',str_replace(',','/',str_replace(' ','',$test_sms?$sms_admin:$telephone)));
		$orange=array("07","08","09","47","48","49","57","58","59","67","68","69","77","78","79","87","88","89");
		$mtn=array("04","05","06","44","45","46","54","55","56","64","65","66","74","75","76","84","85","86");
		$moov=array("01","02","03","41","42","43");

		for($i=0;$i<count($tel);$i++){

			$prefix=substr($tel[$i],0,2);
			$tel[$i]=((strlen($tel[$i])==8)?(in_array($prefix,$orange)?'07':(in_array($prefix,$mtn)?'05':(in_array($prefix,$moov)?'01':''))):'').$tel[$i];
			$lien="http://197.159.208.198:443/cgi-bin/sendsms?username=tester&password=foobar&smsc=SOLAS_ORANGE&";
			$lien.="from=".((strlen($origine)==10)?"00225".$origine:$origine)."&";
			$lien.="to=".((strlen($tel[$i])==10)?"00225".$tel[$i]:$tel[$i])."&";
			$lien.="text=".str_replace(' ','+',strtoupper($message));
	
			@ $content=file_get_contents($lien);
		}			
	}
//*/
	
	}

?>

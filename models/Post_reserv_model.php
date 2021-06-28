<?php
    session_start();
    include('../config/Connexion.php');
    include('../functions/Isaffectable_function.php');
    include('../functions/Date_function.php');

    
    if($_POST['action']=='confirmer' ){
	
        $sql="INSERT INTO Reservation(PLAGE_HORAIRE,DATE_RESERVATION,STATUT,SITE,USER,NOM_COMPLET,FONCTION,TELEPHONE,DATE_CREATION) 
                                VALUES( :Plage, :Date,1, :Site, :Login, :Fullnam, :Fonct,:Tel, NOW())";
        $result= $bdd->prepare($sql);
        $result->bindParam(':Site', $_POST["site"], PDO::PARAM_INT);
        $result->bindParam(':Plage', $_POST["plage"], PDO::PARAM_INT);
        $result->bindParam(':Date', $_POST["date_reserv"], PDO::PARAM_STR);
        $result->bindParam(':Login', $_SESSION["ID_UTIL"], PDO::PARAM_INT);
        $result->bindParam(':Fullnam', $_POST["fullname"], PDO::PARAM_STR);
        $result->bindParam(':Fonct', $_POST["fonction"], PDO::PARAM_STR);
        $result->bindParam(':Tel', $_POST["tel"], PDO::PARAM_STR);
        $result->execute();


        //Message visuel de retour de résarvation effectuée avec succès
    
        $tab[0]=0;
        $tab[1]='alert alert-success alert-dismissible';
        $tab[2]='FELICITATIONS';
        $tab[3]='<strong>Reservation effectuée avec succès !</strong> ';							
        $tab[4]='btn btn-success';
        $tab[5]='OK';

        //Destinataires des mails de réservation
        $email='bilekangah@cci.ci';
        $email1='aflorent@cci.ci';
        $email2='paternebrou@cci.ci';
        $email4='traoredaba@cci.ci';
        $email5='kevindalle@cci.ci';
        $email3='jean-lucsery@cci.ci';

        $res=$bdd->prepare(" SELECT * FROM Site WHERE IDENTIFIANT=:Site ");
        $res->bindParam(':Site', $_POST["site"], PDO::PARAM_INT);
        $res->execute();
        $don = $res->fetch();
        $sj='Nouvelle Reservation';
        $msg="<span>
            Nous vous informons qu'une reservation a été faite par ".$_SESSION["STRUCTURE"]."
            <ul>
            <li>PONT BASCULE: ".$don["LIBELLE"]."</li>
            <li>DATE DE RESERVATION: ".$_POST["date_reserv"]."</li>
            <li>PLAGE HORRAIRE: ".(($_POST["plage"]==1)?'JOUR':(($_POST["plage"]==2)?'NUIT':'RELAIS'))."</li>
            </ul>
            </span>
            </br>
            <span><a href='https://vgmci.com/reservation/'> Cliquez ici pour voir la reservation</a></span>";

        //Envoi de mail 
        if($_SESSION['VILLE']==1)
            {
            envoimail2( $email,$sj,$msg);	
            envoimail2( $email1,$sj,$msg);	
            envoimail2( $email2,$sj,$msg);
            }					
        elseif($_SESSION['VILLE']==2)
            {
            envoimail2( $email3,$sj,$msg);	
            envoimail2( $email4,$sj,$msg);	
            envoimail2( $email5,$sj,$msg);
            }		

/* Output header */
header('Content-type: application/json');
echo json_encode($tab);

}


if($_POST['action']=='reserver' ){

$datereserv= datefr2en($_POST["date_reserv"]); //j'ai changer la function datefr2en en dateFrench

$jour=date("Y-m-d");
$heur= date("H:m:s");
$timeis='15:45:00';

if(isaffectable($bdd,$datereserv,$_POST["radio"],$jour,$heur,$timeis)){	//(issaffectable sera isAffectable remplacer par )Si la reservation peut avoir une affectation

    //On cherche l'existence de la reservation dans la base de données	      
    $lign_Exist=$bdd->prepare(" SELECT * FROM Reservation WHERE DATE_RESERVATION = :Date AND PLAGE_HORAIRE = :Plage AND SITE = :Site  AND STATUT IN(1,3) ");
    
    $lign_Exist->bindParam(':Date', $datereserv, PDO::PARAM_STR);
    $lign_Exist->bindParam(':Plage', $_POST["radio"], PDO::PARAM_INT);
    $lign_Exist->bindParam(':Site', $_POST["site"], PDO::PARAM_INT);
    $lign_Exist->execute();
    
    $lign_count = $lign_Exist->rowCount();
      
    if( $lign_count == 0){ // Si la réservation n'existe pas encore dans la base de données, on l'insère
    
        
        $res=$bdd->prepare("SELECT * FROM Site WHERE IDENTIFIANT=:Site ");
        $res->bindParam(':Site', $_POST["site"], PDO::PARAM_INT);
        $res->execute();
        $don = $res->fetch();

        $date_reserv=strtotime(substr($datereserv,5,2)."/".substr($datereserv,8,2)."/".substr($datereserv,0,4));
        $working_time=($_POST["radio"]==1 && !isdayofrest($bdd,date('Y-m-d',$date_reserv)) && !in_array(date('w',$date_reserv),array(6,0))) ;

        if($working_time){
            $alert='alert alert-warning alert-dismissible';
            $mssg="<p style=\"color:orange;\">
                    Cette prestation vous sera facturée à <b>0 FCFA</b>
                    </p>";
            $bout='btn btn-warning';
        }else{
            $alert='alert alert-danger alert-dismissible';
            $mssg="<p style=\"color:red;\">
                    La facturation des frais de prestation s'effectue conformément aux tarifs en vigueur. <br/>
                    Pour toute commande ou réservation de peseurs jurés en dehors des horaires de travail en vigueur à la CCI-CI (<b>les nuits et les jours non ouvrés ou fériés</b>), un montant complémentaire de <b>35 000 FCFA</b> sera exigé.<br/>
                    A ce niveau, la CCI-CI se réserve le droit d'effectuer des modifications de prix par écrit avec un préavis le cas échéant. La facturation sera établie dès l’avis de mise à disposition.
                    </p>
                    <p style=\"color:red;\">
                    Cette prestation vous sera facturée à <b>35 000 FCFA</b>
                    </p>";
            $bout='btn btn-danger';
        }


        //Message visuel de retour de résErvation effectuée avec succès
    
        $tab[0]=0;
        $tab[1]=$alert;
        $tab[2]='VALIDATION DE LA RESERVATION';
        $tab[3]=$mssg;							
        $tab[4]=$bout;
        $tab[5]='Valider la réservation';
        $tab[6]=$_POST["site"];
        $tab[7]=$_POST["radio"];
        $tab[8]=$datereserv;
        $tab[9]=$_POST["fullname"];
        $tab[10]=$_POST["fonction"];
        $tab[11]=$_POST["tel"];

                        
    }else{	// Si la réservation existe deja dans la base de données

        $tab[0]=1;
        $tab[1]='alert alert-warning alert-dismissible';
        $tab[2]='ATTENTION';
        $tab[3]='<strong>Une reservation a deja éte effectuée pour ce site à cette date et plage horaire !</strong> ';							
        $tab[4]='btn btn-warning';
        $tab[5]='OK';
    }
                                            

}else{	//Si la reservation ne peut pas avoir d'affectation

    $tab[0]=2;
    $tab[1]='alert alert-danger alert-dismissible';
    $tab[2]='DESOLÉ';
    $tab[3]='<strong>Une reservation ne peut être effectuée que pour la nuit du prochain jour ouvrable ou plutard !</strong> ';							
    $tab[4]='btn btn-danger';
    $tab[5]='OK';
    
}

/* Output header */
header('Content-type: application/json');
echo json_encode($tab);

}



if($_POST['action']=='afficher'){

$jour=date("Y-m-d");

$nbpages=0;
//Nombre maximum bouton de page
$long=10;
//Nombre maximum de reservations  par page
$nbmsgpp=8;

$criteres=" FROM  `Reservation`,`Site` WHERE DATE_RESERVATION >='".$jour."' AND Reservation.STATUT =1 AND Reservation.SITE = Site.IDENTIFIANT AND Reservation.USER='".$_SESSION['ID_UTIL']."' ";	 

$resultnb = $bdd->query("SELECT count(*) as count ".$criteres);

$lign = $resultnb->fetch();
$nombre = $lign['count'];
$resultnb->closeCursor();

$nbpages=ceil($nombre/$nbmsgpp);

$tab=array();
$tab[0]=$nombre;

if($nombre==0){
    $tab[1]='alert alert-info alert-dismissible';
    $tab[2]='';							
    $tab[3]='<strong>Vous n\'avez pas de reservation en attente !</strong> ';							
    $tab[4]='btn btn-info';
    $tab[5]='OK';
}else{
    $tab[1]='';

$page=((isset($_POST["page"]) && $_POST["page"]>0)?(($_POST["page"]>$nbpages)?$nbpages:$_POST["page"]):1);

$pagination='<div class="text-center" style="margin: auto; margin-left: 40%;" >
                <nav aria-label="Page navigation" style="height: 65px;">
                    <ul class="pagination" style="margin-top:5px;">';
                    
if($nbpages>1){
                
    $pagination.='<li class="'.(($page==1)?'disabled':'bouton').'">
                    <a class="page-link" href="javascript:loadreservations('.(($page>1)?($page-1):1).')" aria-label="Page précédante">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>';

    $min=(($nbpages<=$long)?1:(($page-ceil($long/2)<1)?1:($page-ceil($long/2)-(((ceil($long/2)-($nbpages-$page))>0)?(ceil($long/2)-($nbpages-$page)):0))));
    $max=(($nbpages<=$long)?$nbpages:(($page+ceil($long/2)>$nbpages)?$nbpages:($page+ceil($long/2)+(((ceil($long/2)-($page-1))>0)?(ceil($long/2)-($page-1)):0))));

    for ($i =$min ; $i <= $max; $i++)
        $pagination.='<li class="'.(($i==$page)?'active':'page-item').'" aria-label="Page '.$i.'">
                        <a class="page-link" href="javascript:loadreservations('.$i.')">'.$i.'</a>
                      </li>';
    
    $pagination.='<li class="'.(($page==$nbpages)?'disabled':'bouton').'">
                    <a class="page-link" href="javascript:loadreservations('.(($page<$nbpages)?($page+1):$nbpages).')" aria-label="Page suivante">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>';
    }

$pagination.='   </ul>
                </nav>
              </div>';

$tab[1].= $pagination; 

$query="SELECT Reservation.IDENTIFIANT as ID,DATE_RESERVATION,LIBELLE,Reservation.DATE_CREATION as date,
        CASE (`PLAGE_HORAIRE`) WHEN 1 THEN  'Jour' WHEN 2 THEN  'Nuit' END AS plage ".$criteres." 
        ORDER BY Reservation.DATE_RESERVATION ASC,Reservation.PLAGE_HORAIRE ASC 
        LIMIT ".($nbmsgpp*$page -$nbmsgpp).",".$nbmsgpp;

$result = $bdd->query($query);

$messages='<table class="table table-sm" id="tab_logic" style="font-size:12px;margin-top:-15px;margin-bottom:0px; margin-left: 7px;padding-bottom:0px;">
             <thead>
                    <tr>
                    <th style="text-align:center;;background-color:lightblue;">Date de r&eacute;servation</th>
                    <th style="text-align:center;;background-color:lightblue;">Plage horaire</th>
                    <th style="text-align:center;;background-color:lightblue;">Pont bascule / Site d\'empotage</th>
                    <th style="text-align:center;;background-color:lightblue;">Option</th>
                </tr>
             </thead>
             <tbody>';

while ($donnees = $result->fetch()){
        
        $messages .= '<tr>                                                   
                        <td style="width:200px;margin:auto;" bgcolor="lightgray">
                        <input type="text" style="text-align:center; height: 30px;" class="form-control" name="" value="'.dateFr($donnees['DATE_RESERVATION']).'" disabled="disabled">
                        </td>
                        <td style="width:150px;margin:auto;" bgcolor="lightgray">
                        <input type="text" style="text-align:center;  height: 30px;" class="form-control" name="" value="'.$donnees['plage'].'" disabled="disabled">
                        </td>
                        <td style="width:350px;margin:auto;" bgcolor="lightgray">
                        <input type="text" style="text-align:center; height: 30px;" class="form-control" name="" value="'.$donnees['LIBELLE'].'" width="100%" disabled="disabled">
                        </td>
                        <td style="text-align:center;" bgcolor="lightgray">
                            <ul class="pagination" style="margin-top:0px;margin-bottom:0px">
                            <li class="bouton">
                            <a class="btn btn-light" href="javascript:delreservations('.$donnees['ID'].','.$page.')">Annuler</a>
                            </li>
                            </ul>
                        </td>
                       </tr>';

    }
$result->closeCursor();

$tab[1].= $messages.'</tbody></table>'; 		

}

/* Output header */
header('Content-type: application/json');
echo json_encode($tab);
}


if($_POST['action']=='annuler'){

$email='bilekangah@cci.ci';
$email1='aflorent@cci.ci';
$email2='paternebrou@cci.ci';
$email4='traoredaba@cci.ci';
$email5='kevindalle@cci.ci';
$email3='jean-lucsery@cci.ci';
                        
$result = $bdd->query("UPDATE Reservation SET STATUT = 2 WHERE IDENTIFIANT='".$_POST['id']."'");

$res=$bdd->prepare(" SELECT R.DATE_RESERVATION, S.LIBELLE FROM Reservation R,Site S WHERE R.SITE=S.IDENTIFIANT AND R.IDENTIFIANT=:id ");
$res->bindParam(':id', $_POST["id"], PDO::PARAM_INT);
$res->execute();
$don = $res->fetch();
$sj='Annulation';
$msg="<span>La réservation du site ".$don["LIBELLE"]." pour le ".dateFr($don['DATE_RESERVATION'])." a été annulée par ".$_SESSION["STRUCTURE"]."</span>
        </br><span><a href='https://vgmci.com/reservation/'>Cliquez ici pour voir les détails</a></span>";

 if($_SESSION['VILLE']== 1)
    {
        envoimail2( $email,$sj,$msg);	
        envoimail2( $email1,$sj,$msg);	
        envoimail2( $email2,$sj,$msg);
    }

     elseif($_SESSION['VILLE']== 2)
    {
        envoimail2( $email3,$sj,$msg);	
        envoimail2( $email4,$sj,$msg);	
        envoimail2( $email5,$sj,$msg);
    }	

$tab[0]=0;

/* Output header */
header('Content-type: application/json');
echo json_encode($tab);

    
}



function dateFr($date){

return strftime('%d/%m/%Y',strtotime($date));
}


function envoimail2($destinataire,$sujet,$message){

 $depotmail=false;
                    
 $domaine="cci.ci";
 $nomexp="CCI - COTE D'IVOIRE<solasvgm@cci.ci>";
 $expediteur="solasvgm@cci.ci";

 $boundary = md5(uniqid(rand(), true));
 $entetes  ='MIME-Version: 1.0'."\r\n";
 $entetes .='Organization: '.$domaine."\r\n";
 $entetes .='From: '.$nomexp."\r\n";
 $entetes .='Reply-To: '.$expediteur."\r\n";
 $entetes .='X-Mailer: PHP/'.phpversion()."\r\n";
 $entetes .='Content-Type: multipart/alternative; boundary="'.$boundary.'"';
 $n="\n";
 $body  = 'This is a multi-part message in MIME format.'.$n;
 $body .= '--'.$boundary.$n;
 $body .= 'Content-Type: text/html; charset="UTF-8"'.$n;
 $body .= "Content-Transfer-Encoding: 8bit".$n;
 $body .= $n;
 $body .= $message;
 $body .= $n;
 $body .= '--'.$boundary.$n;
 $body = wordwrap($body, 70);

  //mail($destinataire, $sujet, $body, $entetes,$expediteur);
 return $depotmail;
}

?>
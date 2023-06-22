<?php
/*
    Date creation : 14-07-2021
    Auteur : Cellule SOLAS - KENT
    Version:1.0
    Dernière modification : 04-10-2022
    Dernier modificateur : Cellule SOLAS - KENT
    Description: Generation de la facture en pdf  
*/

include('../functions/getMatriceMensuelleHtml.php');
include('../functions/getMatriceHebdomadaireHtml.php');

function PDF_Matrice($typeuser,$iduser,$type,$mois,$semaine,$superviseur){
	
    global $mpdf;
	 
	if($type==1 || $typeuser==6){

		$matrice = getMatriceHebdomadaireHtml($semaine,(($typeuser==6)?$iduser:$superviseur));
				
	}else{

     	$matrice = getMatriceMensuelleHtml($mois);
		 
		
	}
		
	$path=time().".PDF";
		
	if($mpdf==6){

		$pdf = new mPDF();
		ini_set("pcre.backtrack_limit", "1000000");
		$pdf->SetDisplayMode('fullpage');
		$pdf->SetFooter('AVENUE JOSEPH ANOMA &bull; 01 B.P. 1399 ABIDJAN 01 &bull; TEL lignes group&eacute;es : (225) 27.20.33.16.00 &bull; FAX : (225) 27.20.32.39.42 &bull; www.cci.ci');
		$pdf->AddPage('L');
		$pdf->WriteHTML(utf8_encode($matrice));
		setlocale(LC_TIME, 'fr_FR',"French");
		// $pdf->SetFooter(''.strftime('%A %d %B %Y').'|'.strftime('%H:%M:%S').'|  Page{PAGENO}/{PAGENO} | ' );

		$pdf->Output($path,'I');
	
		exit;

	}elseif($mpdf==7){
		
		try {
			$pdf = new \Mpdf\Mpdf(['default_font_size' => 7,'default_font' => 'Helvetica']);
         
			$pdf->SetDisplayMode('fullpage');
	
			$pdf->AddPage('L');
			$footer='6, AVENUE JOSEPH ANOMA • 01 B.P. 1399 ABIDJAN 01 • TEL. Lignes groupées : (225) 27.20.33.16.00 • FAX : (225) 27.20.32.39.42 • www.cci.ci';
			$footer = array('odd' => array (
			 					'C' => array (
			 						'content' => $footer,
			 						'font-size' => 10,
			 						'font-style' => 'B',
			 						'font-family' => 'arial',
			 						'color'=>'#000000'
			 						),
			 					'line' => 1,
			 					)
			 				);
			$pdf->SetFooter($footer);


			$pdf->WriteHTML(utf8_encode($matrice));
			setlocale(LC_TIME, 'fr_FR',"French");

			$pdf->Output($path,'I');

			exit;

		}catch (\Mpdf\MpdfException $e){
			$msg = "{ERROR: '" . $e->getMessage() . "}";
			echo  $msg ;
			return array('ERROR ' => $msg);
		}
		
	}else
		return false;

 }
?>

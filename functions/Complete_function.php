<?php
/*
    Date creation : 20-08-2022
    Auteur : Cellule SOLAS - KENT
    Version:1.0
    Dernière modification : 04-10-2022
    Dernier modificateur : Cellule SOLAS - KENT
    Description: Mettre des espaces dans le fichier texte genéré 
*/

function Complete($id,$dgt)
	{
	$j=10;
	$i=10;
	for($k=1;$k<$dgt;$k++)
		$i*=$j;

	while(strlen($id)<$dgt)
		{
		$id=(($id<$i)?'0':'').$id;
		$i/=10;	
		}

	return $id;			
	}
/// la function Caractere permet de mettre des espaces en fonction de la longuer en lettre du chargeur
function Caractere($text,$long,$char,$pos){
		
	$text=substr($text,($pos?0:((strlen($text)>$long)?(strlen($text)-$long):0)),$long);

	while(strlen($text)<$long)
		$text=(!$pos?$char:"").$text.($pos?$char:"");
	
return $text;
}


?>
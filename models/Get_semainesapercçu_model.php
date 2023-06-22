<?php
/*
    Date creation : 12-06-2023
    Auteur : Cellule SOLAS - KENT
    Version:1.0
    Dernière modification : 12-06-2023
    Dernier modificateur : Cellule SOLAS - KENT
    Description: Obtenir la semaine encour et antérieur pour aperçue avant la matrice officiel
*/
	$i=0;
    $tab[$i]=0;
    $i++;
        
    $tab[$i]=2; 
    $i++;
        
    $tab[$i]=2;
    $i++;
   // Récupération de la date actuelle
$dateCourante = new DateTime();

// Formatage de la date actuelle en mois au format 'Y-m'
$moisCourant = $dateCourante->format('Y-m');

// Récupération de la date du premier jour du mois
$dateDebutMois = new DateTime('first day of ' . $moisCourant);

// Récupération de la date du dernier jour du mois
$dateFinMois = new DateTime('last day of ' . $moisCourant);

// Liste des semaines dans le mois courant
$semaines = array();

// Boucle pour récupérer les semaines dans le mois
while ($dateDebutMois <= $dateFinMois) {
    // Récupération de la date de fin de la semaine
    $dateFinSemaine = clone $dateDebutMois;
    $dateFinSemaine->modify('next Sunday');
    if ($dateFinSemaine > $dateFinMois) {
        $dateFinSemaine = clone $dateFinMois;
    }
    
    // Ajout de la semaine à la liste
    $semaines[] = array(
        'debut' => clone $dateDebutMois,
        'fin' => $dateFinSemaine
    );
    
    // Passage à la semaine suivante
    $dateDebutMois->modify('next Monday');
}

// Récupération de la semaine en cours
foreach ($semaines as $index => $semaine) {
    if ($dateCourante >= $semaine['debut'] && $dateCourante <= $semaine['fin']) {
        $semaineEnCours = $index;
        break;
    }
}

    // Affichage de la semaine précédente et de la semaine en cours
    $semainePrecedente = $semaineEnCours - 1;
	$tab[$i]=$semaines[$semainePrecedente]['debut']->format('Y-m-d')." ". $semaines[$semainePrecedente]['fin']->format('Y-m-d');
	$i++;

    $tab[$i]="DU ".$semaines[$semainePrecedente]['debut']->format('d/m/Y'). " AU " . $semaines[$semainePrecedente]['fin']->format('d/m/Y');
	$i++;

	$tab[$i]=$semaines[$semaineEnCours]['debut']->format('Y-m-d')." ".$semaines[$semaineEnCours]['fin']->format('Y-m-d');
	$i++;

    $tab[$i]="DU ".$semaines[$semaineEnCours]['debut']->format('d/m/Y')  . " AU " .  $semaines[$semaineEnCours]['fin']->format('d/m/Y');
	$i++;

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($tab);

?>
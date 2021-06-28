<?php

	session_start();

	if(isset($_POST['x'])){
		
	include('../../config/Connexion.php');

	$time = time();

	include('../../functions/Update_action.php');
	
	$tab[0] = 0;
	}
	
	$_SESSION['DERNIERE_ACTION'] = time();

	/* Output header */
	header('Content-type: application/json');
	echo json_encode($tab);

?>

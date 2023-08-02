	<!-- partial:partials/_horizontal-navbar.html -->
 		<div class="container-fluid page-body-wrapper">
			<div class="main-panel">
				<div class="content-wrapper">

<?php

switch($page)
{
case 'affect';
	include('views/pages/Affect_view.php'); 
	break;
case 'inspect';
	include('views/pages/Inspect_view.php'); 
	break;
case 'ponts';
	include('views/pages/Ponts_view.php'); 
	break;
case 'user';
	include('views/pages/User_view.php'); 
	break;
case 'ferie';
	include('views/pages/Ferie_view.php'); 
	break;
case 'extract';
	include('views/pages/Extract_view.php'); 
	break;
<<<<<<< HEAD
case 'matrice';
	include('views/pages/Super_view.php'); 
	break;
=======
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
default:
	include('views/pages/Affect_view.php');
}
?>


				</div>
				<!-- content-wrapper ends -->

	<!-- partial:partials/_horizontal-navbar.html -->
 		<div class="container-fluid page-body-wrapper">
			<div class="main-panel">
				<div class="content-wrapper">

<?php

switch($page)
{
case 'reserv';
	include('views/pages/Reserv_view.php'); 
	break;
case 'profil';
	include('views/pages/Profil_view.php'); 
	break;
case 'factur';
	include('views/pages/Factur_view.php'); 
	break;
default:
	include('views/pages/Reserv_view.php');
}
?>


				</div>
				<!-- content-wrapper ends -->

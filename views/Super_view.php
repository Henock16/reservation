	<!-- partial:partials/_horizontal-navbar.html -->
 		<div class="container-fluid page-body-wrapper">
			<div class="main-panel">
				<div class="content-wrapper">

<?php

switch($page)
{
case 'matrice';
	include('views/pages/Super_view.php'); 
	break;
case 'affect';
	include('views/pages/Affect_view.php'); 
	break;
case 'inspect';
	include('views/pages/Inspect_view.php'); 
	break;
default:
	include('views/pages/Super_view.php'); 
}
?>


				</div>
				<!-- content-wrapper ends -->

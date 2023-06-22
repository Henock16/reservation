	<!-- partial:partials/_horizontal-navbar.html -->
 		<div class="container-fluid page-body-wrapper">
			<div class="main-panel">
				<div class="content-wrapper">

<?php

switch($page)
{
case 'extract';
	include('views/pages/Extract_view.php'); 
	break;
default:
	include('views/pages/Extract_view.php');
}
?>


				</div>
				<!-- content-wrapper ends -->

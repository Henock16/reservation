<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pesage Poids Public</title>
    <link rel="shortcut icon" href="images/cci.png" />

    <!-- base:css -->
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
	
    <!-- plugin css for this page -->
	<!-- End plugin css for this page -->
	
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/loader.css">
	<link rel="stylesheet" href="js/datetimepicker/jquery.datetimepicker.min.css">
	<link rel="stylesheet" href="vendors/datatables/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="vendors/datatables/css/buttons.dataTables.min.css">
	<!-- endinject -->
  </head>
  <body onclick="actualiser();">
 
	<div id="loader"></div>
	<div id="bgpage"></div>

    <div class="container-scroller">
	<!-- partial:partials/_horizontal-navbar.html -->


<div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <ul class="navbar-nav navbar-nav-left">
              <li class="nav-item ml-0 mr-5 d-lg-flex d-none">
                <a href="#" class="nav-link horizontal-nav-left-menu"><i class="mdi mdi-format-list-bulleted"></i></a>
              </li>
            </ul>
			
			<div class="container text-center" id="intro">
				<h2 class="thin" style="margin-top: 10px;"><img src="images/cci.jpg" width="350px" height="50px"/></h2>
				<p class="text-muted">
					Int&eacute;r&ecirc;t G&eacute;n&eacute;ral <span style="color: rgb(215,0,0); font-size: 1.25em">&nbsp;&bull;&nbsp;</span> 
					Engagement <span style="color: rgb(215,0,0); font-size: 1.25em">&nbsp;&bull;&nbsp;</span>
					Int&eacute;grit&eacute; <span style="color: rgb(215,0,0); font-size: 1.25em">&nbsp;&bull;&nbsp;</span> 
					Esprit d'&eacute;quipe <span style="color: rgb(215,0,0); font-size: 1.25em">&nbsp;&bull;&nbsp;</span> Innovation
				</p>
			</div>
			
				<ul class="navbar-nav navbar-nav-right">
               <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <span class="nav-profile-name"><?php echo $_SESSION['NAME']; ?></span>
                    <span class="online-status"></span>
                    <img src="<?php echo (file_exists('images/faces/face'.$_SESSION['ID_UTIL'].'.jpg')?'images/faces/face'.$_SESSION['ID_UTIL'].'.jpg':'images/faces/face0.png'); ?>" alt="profile"/>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                      <a class="dropdown-item">
                        <i class="mdi mdi-settings text-warning"></i>
                        Paramètres
                      </a>
                      <a class="dropdown-item" href="#" id="logout" title="Quitter l'application en toute sécurité">
                        <i class="mdi mdi-logout text-danger"></i>
                        Déconnexion
                      </a>
                  </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
              <li class="nav-item">
                <a href="index.php?p=reserv" class="nav-link bg-<?php echo(($page=='reserv')?'success':'white');?>">
                  <i class="mdi mdi-truck menu-icon text-<?php echo(($page=='reserv')?'white':'success');?>"></i>
                  <span class="menu-title text-<?php echo(($page=='reserv')?'white':'success');?>">Réservation</span>
                  <i class="menu-arrow"></i>
               </a>
              </li>
              <li class="nav-item">
                  <a href="index.php?p=profil" class="nav-link bg-<?php echo(($page=='profil')?'primary':'white');?>">
                    <i class="mdi mdi-account menu-icon text-<?php echo(($page=='profil')?'white':'primary');?>"></i>
                    <span class="menu-title text-<?php echo(($page=='profil')?'white':'primary');?>">Profil</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="index.php?p=factur" class="nav-link bg-<?php echo(($page=='factur')?'dark':'white');?>">
                    <i class="mdi mdi-file-document-box menu-icon text-<?php echo(($page=='factur')?'white':'dark');?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>
                    <span class="menu-title text-<?php echo(($page=='factur')?'white':'dark');?>">Facturation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>
            </ul>
        </div>
      </nav>
    </div>
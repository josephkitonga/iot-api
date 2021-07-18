<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Audit Archiving Utility</title>
    <meta name="description" content="Audit Archiving Utility" />
	<meta name="author" content="Joseph Kitonga">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=base_url()?>assets/favicon.ico">
    <link rel="icon" href="<?=base_url()?>assets/favicon.ico" type="image/x-icon">
	
	<!-- vector map CSS -->
    <link href="<?=base_url()?>vendors/vectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" type="text/css" />
	
	<link href="<?=base_url()?>vendors/apexcharts/dist/apexcharts.css" rel="stylesheet" type="text/css" />

	<link href="<?=base_url()?>vendors/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">

	<!-- Daterangepicker CSS -->
    <link href="<?=base_url()?>vendors/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />

	
	  <!-- Data Table CSS -->
	<link href="<?=base_url()?>vendors/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />

    <!-- Toggles CSS -->
    <link href="<?=base_url()?>vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
	
	<!-- Toastr CSS -->
    <link href="<?=base_url()?>vendors/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
	<link href="<?=base_url()?>dist/css/style.css" rel="stylesheet" type="text/css">
	
	<script src="<?=base_url()?>vendors/jquery/dist/jquery.min.js"></script>
		<!-- Daterangepicker JavaScript -->
	<script src="<?=base_url()?>vendors/moment/min/moment.min.js"></script>
	<script src="<?=base_url()?>vendors/daterangepicker/daterangepicker.js"></script>
	<!-- <script src="dist/js/daterangepicker-data.js"></script> -->

	<link href="<?=base_url()?>vendors/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css">

	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">

	
	<script> var base_url = '<?=base_url()?>';</script>

</head>


<body >
    <!-- Preloader 
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    --><!-- /Preloader -->


	
	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-vertical-nav">

        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar">
            <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
             <a class="navbar-brand font-weight-700" href="<?=base_url('/')?>" style="font-size: 15px;">
			 PKF AUDIT ARCHIVING UTILITY
            </a>
            <ul class="navbar-nav hk-navbar-content">
                <!-- <li class="nav-item">
                    <a id="navbar_search_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="search"></i></span></a>
                </li> -->
                <li class="nav-item">
                    <a id="settings_toggle_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="settings"></i></span></a>
                </li>
             
                <li class="nav-item dropdown dropdown-authentication">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar">
                                    <img src="dist/img/avatar12.png" alt="user" class="avatar-img rounded-circle">
                                </div>
                                <span class="badge badge-success badge-indicator"></span>
                            </div>
                            <div class="media-body">
                                <span><?=$user_name?><i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                        <!-- <a class="dropdown-item" href="profile.html"><i class="dropdown-icon zmdi zmdi-account"></i><span>Profile</span></a> -->
                        <!-- <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-card"></i><span>My balance</span></a>
                        <a class="dropdown-item" href="inbox.html"><i class="dropdown-icon zmdi zmdi-email"></i><span>Inbox</span></a>
                        <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-settings"></i><span>Settings</span></a> -->
                        <div class="dropdown-divider"></div>
                        <div class="sub-dropdown-menu show-on-hover">
                            <a href="#" class="dropdown-toggle dropdown-item no-caret"><i class="zmdi zmdi-check text-success"></i>Online</a>
                            <!-- <div class="dropdown-menu open-left-side">
                                <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-check text-success"></i><span>Online</span></a>
                                <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-circle-o text-warning"></i><span>Busy</span></a>
                                <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-minus-circle-outline text-danger"></i><span>Offline</span></a>
                            </div> -->
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?=base_url('Login/Logout')?>"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- <form role="search" class="navbar-search">
            <div class="position-relative">
                <a href="javascript:void(0);" class="navbar-search-icon"><span class="feather-icon"><i data-feather="search"></i></span></a>
                <input type="text" name="example-input1-group2" class="form-control" placeholder="Type here to Search">
                <a id="navbar_search_close" class="navbar-search-close" href="#"><span class="feather-icon"><i data-feather="x"></i></span></a>
            </div>
        </form> -->
        <!-- /Top Navbar -->

        <!-- Vertical Nav -->
        <nav class="hk-nav hk-nav-light">
            <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
            <div class="nicescroll-bar">
                <div class="navbar-nav-wrap">
                    <ul class="navbar-nav flex-column">



				<?php 

				if(!empty($Module)): foreach($Module as $modules): if($modules->state == "1" && $modules->sub=="0"):  
				if(empty(get_user_rights($user_type,$modules->module_id))){continue;}
				$sub=""; $Style=""; $ext=""; 
				$subArrow="none"; 
				$link = base_url($modules->path);
				if(get_user_rights($user_type,$modules->module_id)!="X"){ $Style="none"; }
				if($modules->withsub=="1"){ $sub="menu-toggle waves-effect waves-block"; $subArrow=""; $ext="data-toggle='collapse'"; $link="#".$modules->module_id;}?>
				
				<?php if($modules->divider=='1'){ ?> <li class="nav-heading ">  <span><?=$modules->name?></span></li><?php } ?>
				
				<li style="display: <?=$Style?>" class="nav-item <?php if($modules->path==$module){echo('active');} ?>" >
					<a  href="<?=$link; ?>" class="nav-link <?=$sub?>" <?=$ext?>>
						<em class="material-icons"><?=$modules->module_icon ?></em> &nbsp;
						<span class="nav-link-text"><?=$modules->name ?></span>
					</a>
					<ul id="<?=$modules->module_id; ?>" style="display: <?=$subArrow?>" class="nav flex-column collapse collapse-level-1">
						<?php if(!empty($Module)): foreach($Module as $subModules): if($subModules->main_id == $modules->module_id): if($subModules->state == "1" && $subModules->sub=="1"): ?>
						<li class="nav-item <?php if($subModules->path==$module){echo('active');} ?>">
						<a href="<?=base_url($subModules->path); ?>" class="nav-link"><?=$subModules->name ?></a></li>
						<?php endif; endif; endforeach; endif; ?>
					</ul>
				</li>

                <hr class="nav-separator">
				
			<?php endif; endforeach; endif; ?>

	
                <!-- <img class="alignnone" style="display: inline; width:100%" title="heartica_logo" src="<?=base_url()?>assets/banner.png" alt="" width="150" height="50" /> -->

						
                    </ul>
                </div>
            </div>
        </nav>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->

        <!-- Setting Panel -->
        <div class="hk-settings-panel">
            <div class="nicescroll-bar position-relative">
                <div class="settings-panel-wrap">
                    <div class="settings-panel-head">
                        <a href="javascript:void(0);" id="settings_panel_close" class="settings-panel-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
                    </div>
                    <hr>
                    
                    <h6 class="mb-5">Navigation</h6>
                    <p class="font-14">Menu comes in two modes: dark & light</p>
                    <div class="button-list hk-nav-select mb-10">
                        <button type="button" id="nav_light_select" class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-sun-o"></i> </span><span class="btn-text">Light Mode</span></button>
                        <button type="button" id="nav_dark_select" class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-moon-o"></i> </span><span class="btn-text">Dark Mode</span></button>
                    </div>
                    <hr>
                    <h6 class="mb-5">Top Nav</h6>
                    <p class="font-14">Choose your liked color mode</p>
                    <div class="button-list hk-navbar-select mb-10">
                        <button type="button" id="navtop_light_select" class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-sun-o"></i> </span><span class="btn-text">Light Mode</span></button>
                        <button type="button" id="navtop_dark_select" class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-moon-o"></i> </span><span class="btn-text">Dark Mode</span></button>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Scrollable Header</h6>
                        <div class="toggle toggle-sm toggle-simple toggle-light toggle-bg-primary scroll-nav-switch"></div>
                    </div>
                    <button id="reset_settings" class="btn btn-primary btn-block btn-reset mt-30">Reset</button>
                </div>
            </div>
            <!-- <img class="d-none" src="dist/img/logo-light.png" alt="brand" /> -->
            <!-- <img class="d-none" src="dist/img/logo-dark.png" alt="brand" /> -->
        </div>
        <!-- /Setting Panel -->

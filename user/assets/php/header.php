<?php
	require_once 'assets/php/session.php';
?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/ventura/blank-page.html by HTTrack Website Copier/3.x [XR&CO'2017], Sat, 18 Apr 2020 05:52:31 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Ventura - <?= ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?></title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="assets/css/feathericon.min.css">

        <!-- Datatables CSS -->
		<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">

        <style type="text/css">
        	@media only screen and (max-width: 767.98px) {
        		.header .header-left .logo{
        			padding-right: 100rem !important;
        		}

        		.header-left .logo.logo-small {
				    display: inline-block;
				}
        	}
        </style>
		
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body class="mini-sidebar">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            <div class="header">
			
				<!-- Logo -->
                <div class="header-left">
					<a href="home.php" class="logo logo-small">
						<img src="assets/img/logo.png" alt="Logo" width="30" height="30">
					</a>
                </div>
				<!-- /Logo -->
				
				<!-- Header Right Menu -->
				<ul class="nav user-menu">
					<li class="nav-item">
						<a href="feedback.php" class="nav-link"><i class="fe fe-comment-o" title="Feedback"></i></a>
					</li>
					
					<!-- Notifications -->
					<li class="nav-item dropdown noti-dropdown">
						<a href="notification.php" class="nav-link" title="Notifications">
							<i class="fe fe-bell"></i> <span id="checkNotification"></span>
						</a>
					</li>
					<!-- /Notifications -->
					
					<!-- User Menu -->
					<li class="nav-item dropdown has-arrow">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img">
								<!-- <img class="rounded-circle" src="assets/img/profiles/avatar-01.jpg" width="31" alt="Ryan Taylor"> -->
								<?php if(!$cphoto): ?>
									<img class="rounded-circle" alt="User Image" width="31" src="assets/img/profiles/avatar.png">
								<?php else: ?>
									<img class="rounded-circle" alt="User Image" width="31" src="<?= 'assets/php/'.$cphoto; ?>">
								<?php endif; ?>	
							</span>
						</a>
						<div class="dropdown-menu">
							<div class="user-header">
								<div class="avatar avatar-sm">
									<!-- <img src="assets/img/profiles/avatar-01.jpg" alt="User Image" class="avatar-img rounded-circle"> -->
									<?php if(!$cphoto): ?>
									<img class="rounded-circle" alt="User Image" width="31" src="assets/img/profiles/avatar.png">
									<?php else: ?>
										<img class="rounded-circle" alt="User Image" width="31" src="<?= 'assets/php/'.$cphoto; ?>">
									<?php endif; ?>	
								</div>
								<div class="user-text">
									<h6 class="pt-2">Hello, <?= $fname; ?></h6>
								</div>
							</div>
							<a class="dropdown-item" href="profile.php">My Profile</a>
							<a class="dropdown-item" href="assets/php/logout.php">Logout</a>
						</div>
					</li>
					<!-- /User Menu -->
					
				</ul>
				<!-- /Header Right Menu -->
				
            </div>
			<!-- /Header -->
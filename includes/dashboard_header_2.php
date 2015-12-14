<?php
		echo "<!DOCTYPE html>";
	require_once ("../includes/common.php");
	require_once ("../includes/functions/set-module.php");
	require_once ("../includes/sessions/sessionvariables.php");


?>


			<html>
				<head>
					<title>Package Hero&reg;</title>
					<!-- The CSS styles  -->
					<link rel = "stylesheet" href = "../css/admin_styles.css" type ="text/css">
					<link type="text/css" rel="stylesheet" href="../css/overlaypopup.css" />
					<link type="text/css" rel="stylesheet" href="../css/jquery-ui.min.css" />

					<!-- The icon libraries  -->
					<link type="text/css" rel="stylesheet" href="../css/styles.css" />
					<link rel="shortcut icon" href="../images/favicon.ico"/>
					<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

					<!-- The google fonts  -->
					<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,600,700" rel="stylesheet" type="text/css">
					<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

					<!-- The fancybox (lightbox) helpers  -->
					<link rel="stylesheet" href="../fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
					<link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
					<link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />

					<link rel="alternate" type="application/rss+xml" title="Package Hero RSS feed" href="../rss.php" />
					<meta name="viewport" content="width=device-width, initial-scale=1">
				</head>

				<body>
					<div id = "container">

						<!-- The main nav at the top of the screen  -->
						<ul id="top">
							<li class="menu"><i class="fa fa-bars fa-fw"></i></li>
							<li class="user"><a href="#" title="Update your profile"><?php echo $user; ?></a>
								<ul class="submenu">
									<li class="profile"><a href="#" title="Update your user profile"><i class="fa fa-pencil fa-fw"></i>update profile</a></li>
									<li><a href ="../includes/logout.php" title = "Logout from Package Hero"><i class="fa fa-close fa-fw"></i>Sign out</a></li>
								</ul>
							</li>
							<li class="pageTitle"><?php echo $title; ?></li>

						</ul>

						<!-- The left navigation -->
						<nav id ="navigation">
							<header class="navCategory navIssues">Issues<i class="fa fa-toggle-on"></i></header>
							<span class="issues"><a class ="link" id="first-link" href ="../admin/dashboard.php?module=overview" title = "View an overview of the system"><i class="fa fa-binoculars fa-fw"></i> Overview</a></span>
							<?php
								if($role == "Administrator" || $role == "Miami") // Show the new issue menu if the user is an admin or has a miami account
								{
									echo '<span class="issues"><a class ="link" href="#" id="newissue" title = "Create a new issue"><i class="fa fa-bug fa-fw"></i> New Issue</a></span>';
								}
							?>
							<span class="issues"><a class ="link" id="viewIssues" href="../includes/allpackages.php"  title = "View a list of all Packages with issues"><i class="fa fa-eye fa-fw"></i> View issues <span class="numberOfIssues"><?php echo countTotalAvailableIssues(); ?></span></a></span>


							<header class="navCategory navPackages">Packages<i class="fa fa-toggle-on"></i></header>
							<span class="packages"><a class ="link" href ="../admin/dashboard.php?module=search" id="searchNav" title = "Search for any package data"><i class="fa fa-search fa-fw"></i> Find a package</a></span>

							<?php
								if($role == "Administrator" || $role == "Miami") // Admins and Miami accounts can see Initial Package Scanning menu
								{
									echo '<span class="packages"><a class ="link" href ="#" id="initialPackageScan" title = "Perform an initial package scan"><i class="fa fa-barcode fa-fw"></i> Scan a Package</a></span>';
									// echo '<span class="packages"><a class ="link" href="../includes/allpackagescans.php"  title = "A list of all scanned packages"><i class="fa fa-eye fa-fw"></i> View Package scans</a></span>';
								}
							?>

							<header class="navCategory navUsers">User<i class="fa fa-toggle-on"></i></header>

							<!-- Only admins can create new user accounts -->
							<?php
								if($role == "Administrator")
								{
									echo '<span class="usr"><a class ="link" href ="#" id="adduser" title = "Create a new user"><i class="fa fa-plus fa-fw"></i> Create User</a></span>';
								}
							?>
							<span class="usr"><a class ="link" href ="../includes/logout.php" title = "Logout from Package Hero"><i class="fa fa-close fa-fw"></i> Sign out</a></span>
						</nav>

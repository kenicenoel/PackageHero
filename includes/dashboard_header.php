
<?php
	echo "<!DOCTYPE html>";
	require_once ("../includes/common.php");
	require_once ("../includes/sessions/sessionvariables.php");
	require_once ("../includes/functions/set-module.php");
	session_start();


	if(!isset($_SESSION['id']) && !isset($_SESSION['username']))
	{
		 header("Location:../index.php");

	}



?>


				<html>
					<head>
						<title>Package Hero&reg;</title>
						<link rel = "stylesheet" href = "../css/admin_styles.css" type ="text/css">
						<link type="text/css" rel="stylesheet" href="../css/overlaypopup.css" />
						<link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>
						<link rel="shortcut icon" href="../images/favicon.ico"/>
						<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,600,700" rel="stylesheet" type="text/css">
						<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
						<link href="../css/jquery.circliful.css" rel="stylesheet" type="text/css" />
						<meta name="viewport" content="width=device-width, initial-scale=1">
					</head>

					<body>
						<div id = "container">
							<header class="top">
								<p class="user"><?php echo $user; ?></p>
								<p class="pageTitle"><?php echo $title; ?></p>
								<input type ='text' placeholder="find a package" name="headerSearchBox" />
								<p class="userCountry"><?php echo '<img src="../images/flags/'.$country.'.png" />'; ?></p>
							</header>
							<nav id ="navigation">
								<header class="navCategory">Issues<i class="fa fa-caret-down"></i></header>
								<a class ="link" id="first-link" href ="?module=overview" title = "View an overview of the system"><i class="fa fa-line-chart fa-fw"></i> Overview</a>
								<a class ="link" href="#" id="newissue" title = "Create a new issue"><i class="fa fa-bug fa-fw"></i> New Issue</a>
								<a class ="link" href="../includes/allpackages.php"  title = "View a list of all Packages with issues"><i class="fa fa-eye fa-fw"></i> View issues <span><?php echo $issueCount; ?></span></a>


								<header class="navCategory">Packages<i class="fa fa-caret-down"></i></header>
								<a class ="link" href ="?module=search" id="searchNav" title = "Search for any package data"><i class="fa fa-search fa-fw"></i> Find a package</a>
								<!-- Admins and Miami accounts can do Initial Package Scanning  -->
								<?php if($role == "Administrator" || $role == "Miami")
								{
									echo '<a class ="link" href ="#" id="initialPackageScan" title = "Perform an initial package scan"><i class="fa fa-barcode fa-fw"></i> Scan a Package</a>';
									echo '<a class ="link" href="../includes/allpackagescans.php"  title = "A list of all scanned packages"><i class="fa fa-eye fa-fw"></i> View Package scans</a>';
								} ?>
						
								<!-- Admins can create new user accounts -->
								<?php if($role == "Administrator")
								{
									echo '<header class="navCategory">User<i class="fa fa-caret-down"></i></header>';
									echo '<a class ="link" href ="#" id="adduser" title = "Create a new user"><i class="fa fa-plus fa-fw"></i> Create User</a>';
								} ?>


								<a class ="link" href ="../includes/logout.php" title = "Logout from Package Hero"><i class="fa fa-close fa-fw"></i> Sign out</a>
							</nav>

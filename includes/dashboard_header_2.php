<?php
		echo "<!DOCTYPE html>";
	require_once ("../includes/common.php");
	require_once ("../includes/functions/set-module.php");


	if(!isset($_SESSION['id']) && !isset($_SESSION['username']))
	{
		header("Location:../index.php");
	}

	$role = $_SESSION['role'];

?>


			<html>
				<head>
					<title>Package Hero&reg;</title>
					<link rel = "stylesheet" href = "../css/admin_styles.css" type ="text/css">
					<link type="text/css" rel="stylesheet" href="../css/overlaypopup.css" />
					<link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>
					<link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700' rel='stylesheet' type='text/css'>
					<link rel="shortcut icon" href="../images/favicon.ico"/>
					<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,600,700" rel="stylesheet" type="text/css">
					<link rel="stylesheet" href="../fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
					<link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
					<link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
					<link href="../css/jquery.circliful.css" rel="stylesheet" type="text/css" />
					<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
					<meta name="viewport" content="width=device-width, initial-scale=1">
				</head>

				<body>
					<div id = "container">
						<header class="top">
							<p class="user"><?php echo $user; ?></p>
							<input type ='text' placeholder="find a package" name="headerSearchBox" />
						</header>

						<nav id ="navigation">
							<header class="navCategory">Issues</header>
							<a class ="link" id="first-link" href ="../admin/dashboard.php?module=overview" title = "View an overview of the system"><i class="fa fa-line-chart fa-fw"></i> Overview</a>
							<a class ="link" href="#" id="newissue" title = "Create a new issue"><i class="fa fa-bug fa-fw"></i> New Issue</a>
							<a class ="link" href="allpackages.php" title = "View a list of all Packages with issues"><i class="fa fa-eye fa-fw"></i> View issues <span><?php echo $_SESSION['availableIssuesCount'] ?></span></a>

							<header class="navCategory">Packages<i class="fa fa-caret-down"></i></header>
							<a class ="link" href ="../admin/dashboard.php?module=search" title = "Search for any package data"><i class="fa fa-search fa-fw"></i> Find a package</a>
							<?php if($role == "Administrator" || $role == "Miami")
							{
								echo '<a class ="link" href ="#" id="initialPackageScan" title = "Perform an initial package scan"><i class="fa fa-barcode fa-fw"></i> Scan a Package</a>';
								echo '<a class ="link" href="../includes/allpackagescans.php"  title = "A list of all scanned packages"><i class="fa fa-eye fa-fw"></i> View Package scans</a>';
							} ?>

							<?php if($role == "Administrator")
							{
								echo '<header class="navCategory">User<i class="fa fa-caret-down"></i></header>';
								echo '<a class ="link" href ="#" id="adduser" title = "Create a new user"><i class="fa fa-plus fa-fw"></i> Create User</a>';

							} ?>


							<a class ="link" href ="logout.php" title = "Logout from Package Hero"><i class="fa fa-close fa-fw"></i> Sign out</a>
						</nav>

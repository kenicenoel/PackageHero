<?php
		echo "<!DOCTYPE html>";
	require_once ("../includes/common.php");
	session_start();

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

						<nav id ="navigation">
							<span>
								<p id="app-name">PACKAGE HERO&REG;</p>
								<p id="user-name"> <?php echo $_SESSION['username']; ?></p>
							</span>
							<a class ="link" id="first-link" href ="../admin/dashboard.php?module=overview" title = "View an overview of the system"><i class="fa fa-line-chart fa-fw"></i> Overview</a>
							<!-- <a class ="link" href ="#"id="newsfeed" title = "View all newsfeed udpates"><i class="fa fa-bullhorn fa-fw"></i> Newsfeed</a> -->
							<a class ="link" href="#" id="newissue" title = "Create a new issue"><i class="fa fa-bug fa-fw"></i> New Issue</a>
							<a class ="link" href="allpackages.php" title = "View a list of all Packages with issues"><i class="fa fa-eye fa-fw"></i> View issues <span><?php echo $_SESSION['availableIssuesCount'] ?></span></a>
							<a class ="link" href ="../admin/dashboard.php?module=search" title = "Search for any package data"><i class="fa fa-search fa-fw"></i> Find a package</a>
							<?php if($role == "Administrator")
							{
								echo '<a class ="link" href ="#" id="adduser" title = "Create a new user"><i class="fa fa-plus fa-fw"></i> Create User</a>';
							} ?>

							<?php if($role == "Administrator" || $role == "Miami")
							{
								echo '<a class ="link" href ="#" id="initialPackageScan" title = "Perform an initial package scan"><i class="fa fa-barcode fa-fw"></i> Scan a Package</a>';
								// Uncomment the line below to allow viewing of scanned package data from Package Hero.
								//echo '<a class ="link" href="../includes/allpackagescans.php"  title = "A list of all scanned packages"><i class="fa fa-eye fa-fw"></i> View Package scans</a>';
							} ?>
							<a class ="link" href ="logout.php" title = "Logout from Package Hero"><i class="fa fa-close fa-fw"></i> Sign out</a>
						</nav>

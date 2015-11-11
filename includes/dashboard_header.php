<?php

	require_once ("../includes/common.php");
	session_start();


	if(!isset($_SESSION['id']) && !isset($_SESSION['username']))
	{
		 header("Location:../index.php");

	}

?>

	<!Doctype html>
				<html>
					<head>
						<title>Package Hero&reg;</title>
						<link rel = "stylesheet" href = "../css/admin_styles.css" type ="text/css">
						<link type="text/css" rel="stylesheet" href="../css/overlaypopup.css" />
						<link href="http://fonts.googleapis.com/css?family=Roboto:400,300,500" rel="stylesheet" type="text/css">
						<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,600,700" rel="stylesheet" type="text/css">
						<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
						<link href="../css/jquery.circliful.css" rel="stylesheet" type="text/css" />
					</head>

					<body>
						<nav id ="navigation">
							<span>
								<p id="app-name">PACKAGE HERO&REG;</p>
								<p id="user-name"> <?php echo $_SESSION['username'] ?></p>
							</span>
							<a class ="link" id="first-link" href ="?module=overview" title = "View an overview of the system"><i class="fa fa-line-chart fa-fw"></i> Overview</a>
							<a class ="link" href="#" id="newissue" title = "Create a new issue"><i class="fa fa-bug fa-fw"></i> New Issue</a>
							<a class ="link" href="../includes/allpackages.php"  title = "View a list of all Packages with issues"><i class="fa fa-plane fa-fw"></i> Current issues <span><?php echo $_SESSION['availableIssuesCount'] ?></span></a>
							<a class ="link" href ="?module=search" title = "Search for any package data"><i class="fa fa-search fa-fw"></i> Find a package</a>
							<a class ="link" href ="#" id="help" title = "Get help with using the system"><i class="fa fa-question-circle fa-fw"></i> Help</a>
							<a class ="link" href ="../includes/logout.php" title = "Logout from Package Issues Manager"><i class="fa fa-close fa-fw"></i> Sign out</a>
						</nav>

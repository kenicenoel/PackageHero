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
					<link href="http://fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css">
					<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300" rel="stylesheet" type="text/css">
					<link rel="stylesheet" href="../fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
					<link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
					<link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
					<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
				</head>

				<body>
						<nav id ="navigation">
							<p id="start">Package Hero&reg;</p>
							<a class ="link" href ="../admin/dashboard.php?module=overview" title = "View an overview of the system"><i class="fa fa-tasks fa-fw"></i> Overview</a>
							<a class ="link" href ="#"id="newsfeed" title = "View all newsfeed udpates"><i class="fa fa-bullhorn fa-fw"></i> Newsfeed</a>
							<a class ="link" href="#" id="newissue" title = "Create a new issue"><i class="fa fa-bug fa-fw"></i> New Issue</a>
							<a class ="link" href="allpackages.php" title = "View a list of all Packages with issues"><i class="fa fa-plane fa-fw"></i> Current issues</a>
							<a class ="link" href ="../admin/dashboard.php?module=search" title = "Search for any package data"><i class="fa fa-search fa-fw"></i> Find a package</a>
							<a class ="link" href ="#" id="help" title = "Get help with using the system"><i class="fa fa-question-circle fa-fw"></i> Help</a>
							<a class ="link" href ="logout.php" title = "Logout from Package Issues Manager"><i class="fa fa-close fa-fw"></i> Sign out</a>
						</nav>

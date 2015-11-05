<?php

	require_once ("../includes/common.php");
	session_start();

	if(!isset($_SESSION['userID']) && !isset($_SESSION['username']))
	{
		header("Location:../index.php");
	}

?>


<!Doctype html>
			<html>
				<head>
					<title>Package Issue Management</title>
					<link rel = "stylesheet" href = "../css/admin_styles.css" type ="text/css">
					<link type="text/css" rel="stylesheet" href="../css/overlaypopup.css" />
					<link href="http://fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css">
					<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300" rel="stylesheet" type="text/css">
					<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

				</head>

				<body>
						<nav id ="navigation">
							<p id="start">Package Hero&reg;</p>
							<a class ="link" href ="../admin/dashboard.php?module=overview" title = "View an overview of the system"><i class="fa fa-dashboard fa-fw"></i>Overview</a>
							<a class ="link" href ="#"id="newsfeed" title = "View all newsfeed udpates"><i class="fa fa-bullhorn fa-fw"></i> Newsfeed</a>
							<a class ="link" href="#" id="newissue" title = "Create a new issue"><i class="fa fa-bug fa-fw"></i> New Issue</a>
							<a class ="link" href="allpackages.php" title = "View a list of all Packages with issues"><i class="fa fa-truck fa-fw"></i> Current issues</a>
							<a class ="link" href ="../admin/dashboard.php?module=search" title = "Search for any package data"><i class="fa fa-search fa-fw"></i> Find a package</a>
							<!-- <a class ="link" href ="?module=user" title = "Manage users of the system"><i class="fa fa-user fa-fw"></i> Users</a> -->

							<a class ="link" href ="logout.php" title = "Logout from Package Issues Manager"><i class="fa fa-sign-out fa-fw"></i> Sign out</a>

						</nav>

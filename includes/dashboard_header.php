
<?php
	echo "<!DOCTYPE html>";
	require_once ("../includes/common.php");
	session_start();


	if(!isset($_SESSION['id']) && !isset($_SESSION['username']))
	{
		 header("Location:../index.php");

	}

	$role = $_SESSION['role'];
	$issueCount = $_SESSION['availableIssuesCount'];

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
						<div id="navigation-holder">

							<nav id ="navigation">
								<span>
									<p id="app-name">PACKAGE HERO&REG;</p>
									<p id="user-name"> <?php echo $_SESSION['username']; ?></p>
								</span>
								<a class ="link" id="first-link" href ="?module=overview" title = "View an overview of the system"><i class="fa fa-line-chart fa-fw"></i> Overview</a>
								<a class ="link" href="#" id="newissue" title = "Create a new issue"><i class="fa fa-bug fa-fw"></i> New Issue</a>
								<a class ="link" href="../includes/allpackages.php"  title = "View a list of all Packages with issues"><i class="fa fa-eye fa-fw"></i> View issues <span><?php echo $issueCount; ?></span></a>
								<a class ="link" href ="?module=search" id="searchNav" title = "Search for any package data"><i class="fa fa-search fa-fw"></i> Find a package</a>
								<?php if($role == "Administrator")
								{
									echo '<a class ="link" href ="#" id="adduser" title = "Create a new user"><i class="fa fa-user-plus fa-fw"></i> Add User</a>';
								} ?>
								<a class ="link" href ="../includes/logout.php" title = "Logout from Package Hero"><i class="fa fa-close fa-fw"></i> Sign out</a>
							</nav>
					</div>

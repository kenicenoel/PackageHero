<?php
		session_start();
		if(isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_GET['page']))
		{
			header("Location:".$_GET['page']);
			exit();
		}

		else if(isset($_SESSION['id']) && isset($_SESSION['username']))
		{
			header("Location: admin/dashboard.php");
			exit();
		}


?>
	<!Doctype html>
		<html>
			<head>

				<title>Package Hero by Web Source</title>
				<link rel = "stylesheet" href = "css/main.css" type ="text/css">
					<link type="text/css" rel="stylesheet" href="css/jquery-ui.min.css" />
				<link rel = "stylesheet" href = "font-awesome/css/font-awesome.min.css" type ="text/css">
		 		<link href="http://fonts.googleapis.com/css?family=Roboto:400,300,600" rel="stylesheet" type="text/css">
				<link rel="shortcut icon" href="images/favicon.ico"/>
		 		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,600" rel="stylesheet" type="text/css">
				<meta name="viewport" content="width=device-width, initial-scale=1">
			</head>
			<body>

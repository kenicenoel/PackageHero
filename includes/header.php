<?php
		session_start();
		if(isset($_SESSION['id']) && isset($_SESSION['username']))
		{
			header("Location:../admin/dashboard.php");
		}

?>
	<!Doctype html>
		<html>
			<head>
				<title>Package Hero &reg;</title>
				<link rel = "stylesheet" href = "css/main.css" type ="text/css">
		 		<link rel = "stylesheet" href = "font-awesome/css/font-awesome.min.css" type ="text/css">
		 		<link href="http://fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css">
				<link rel="shortcut icon" href="images/favicon.ico"/>
		 		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,600" rel="stylesheet" type="text/css">
			</head>
			<body>

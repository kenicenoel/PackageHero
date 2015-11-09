<?php


// Connect to the mySQL server
$host = "localhost";
$user = "admin";
$pass = "admin";
$database = "websource_package_data";

// Create connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error)
{
    die("Whoops! Could not connect to the websource database. Here's the error: " . $connection->connect_error);
}










?>

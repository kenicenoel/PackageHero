<?php


// Connect to the local mySQL server
$host = "localhost";
$user = "admin";
$pass = "admin";
$database = "websource_package_data";



// The production MySql server
// $host = "websource-caribbean.com";
// $user = "packagehero";
// $pass = "PackageH3r0";
// $database = "packagehero_db";


// Connect to the Azure mySQL server
$host = "br-cdbr-azure-south-a.cloudapp.net";
$user = "b80dca2c05801a";
$pass = "349729b5";
$database = "DefaultMySQL";

// Create connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error)
{
    die("Whoops! Could not connect to the Package Hero database. Here's the error -> " . $connection->connect_error);
}



?>

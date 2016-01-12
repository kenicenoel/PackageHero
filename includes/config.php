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


// Create connection
// $connection = new mysqli($host, $user, $pass, $database);
  try
  {
    $connection = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $pass);

    #set the PDO engine to accept exceptions as the error output mode
    $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );


  }

  catch(PDOException $error)
    {
      echo "Something went wrong. If you want to solve this issue, here\'s the error: ".$error->getMessage();
    }


?>

<?php
    // require_once('../includes/config.php');
    header('Content-Type: application/json');


    // Connect to the local mySQL server
    $host = "localhost";
    $user = "admin";
    $pass = "admin";
    $database = "websource_package_data";


    // Create connection
    $connection = new mysqli($host, $user, $pass, $database);

    // Check connection
    if ($connection->connect_error)
    {
        die("Whoops! Could not connect to the Package Hero database. Here's the error -> " . $connection->connect_error);
    }



    // Count the total number of package issues not hidden and resolved

    // global $connection;
    $country = $_SESSION['country'];

    // Build the query
    $sql = "SELECT DATE(IssueCreationTime) As date, COUNT(PackageID) As total_issues FROM Packages GROUP BY date DESC LIMIT 7";

    // prepare the sql statement
    $stmt = $connection->prepare($sql);

    //execute the prepared statement
    $stmt->execute();

    /* store result */
    $stmt->store_result();

    $stmt->bind_result($date, $number);
    $table = array(); // create an empty array to hold the column values
    $rows = array(); // create an empty array to hold the row values
    $table['cols'] = array // define the column names
    (
      // Labels for the chart, these represent the column titles
      array('id' => '', 'label' => 'Date', 'type' => 'string'),
      array('id' => '', 'label' => 'Issues', 'type' => 'number')
    );

    while ($stmt->fetch())
    {
      // echo $date.' ('.$number.') ';

      $temp = array();

      // Values
      $temp[] = array('v' => (string) $date);
      $temp[] = array('v' => (float) $number);
      $rows[] = array('c' => $temp);

    }
    $table['rows'] = $rows;
    $jsonTable = json_encode($table, true);
    echo $jsonTable;

    /* Close statement */
    $stmt->close();
    $connection->close();









 ?>

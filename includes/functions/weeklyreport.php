<?php
    // require_once('../includes/config.php');
    header('Content-Type: application/json');


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



    global $connection;


    // Build the query  ... SELECT DATE_FORMAT(IssueCreationTime,'%d %b %Y') As date, COUNT(PackageID) As total_issues FROM packages GROUP BY date ORDER BY `IssueCreationTime` DESC LIMIT 0 , 7
    $sql = "SELECT DATE_FORMAT(IssueCreationTime,'%d %b %Y') As IssueCreationDate, COUNT(PackageID) As TotalIssues FROM packages GROUP BY IssueCreationDate ORDER BY `IssueCreationTime` DESC LIMIT 0 , 7";

    // prepare the sql statement
    $stmt = $connection->prepare($sql);

    $stmt->setFetchMode(PDO::FETCH_OBJ);

    //execute the prepared statement
    $stmt->execute();



    $table = array(); // create an empty array to hold the column values
    $rows = array(); // create an empty array to hold the row values
    $table['cols'] = array // define the column names
    (
      // Labels for the chart, these represent the column titles
      array('id' => '', 'label' => 'Last 7 days with issues', 'type' => 'string'),
      array('id' => '', 'label' => 'Number of Issues', 'type' => 'number')
    );

    while ($row = $stmt->fetch())
    {


      $temp = array();

      // Values
      $temp[] = array('v' => (string) $row->IssueCreationDate);
      $temp[] = array('v' => (float) $row->TotalIssues);
      $rows[] = array('c' => $temp);

    }
    $table['rows'] = $rows;
    $jsonTable = json_encode($table, true);
    echo $jsonTable;

    $connection = null;









 ?>

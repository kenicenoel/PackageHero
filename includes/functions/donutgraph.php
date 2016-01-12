<?php
    // require_once('../config.php');
    // require_once('../common.php');
    header('Content-Type: application/json');
    session_start();
    /////////////// DATABASE CONNECTION SECTION ////////////////////////////////

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

    ///////////////////////////////////////////////////////////////////////////

    // Count the total number of package issues not hidden and resolved
    function countTotalAvailableIssues()
    {
      global $connection;
      $country = $_SESSION['country'];
      $resolved = 'No';


      // Build the query
        $sql = "SELECT * FROM packages WHERE Resolved = :resolved AND (PackageID NOT IN(SELECT PackageID from hiddenissues) OR PackageID NOT IN(SELECT PackageID FROM hiddenissues WHERE HideFromCountry = :country))";

        //prepare the sql statement
        $stmt = $connection->prepare($sql);

        $stmt->setFetchMode(PDO::FETCH_OBJ);

        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        $stmt->bindParam(':resolved', $resolved, PDO::PARAM_STR);

        //execute the prepared statement
        $stmt->execute();


      $total = $stmt->rowCount();


      if($total == 0)
      {
        return 0;

      }

      else
      {
        return $total;
      }



      $connection = null;


  }

    // Count the total number of package issues hidden
    function countTotalHidden()
    {

      global $connection;
      $country = $_SESSION['country'];
      $resolved = 'No';

      // Build the query
      $sql = "SELECT * FROM packages WHERE Resolved = :resolved AND PackageID IN(SELECT PackageID FROM hiddenissues WHERE HideFromCountry = :country)";

      //prepare the sql statement
      $stmt = $connection->prepare($sql);

      $stmt->setFetchMode(PDO::FETCH_OBJ);
      $stmt->bindParam(':country', $country, PDO::PARAM_STR);
      $stmt->bindParam(':resolved', $resolved, PDO::PARAM_STR);

      //execute the prepared statement
      $stmt->execute();



      $total = $stmt->rowCount();

      if($total == 0)
      {
        return 0;

      }

      else
      {
        return $total;
      }






    }




    $totalAvailable = countTotalAvailableIssues();
    $totalHidden = countTotalHidden();
    // $total = countTotalIssues();


    $cols = array(); // create an empty array to hold the column values
    $rows = array(); // create an empty array to hold the row values
    $cols= array
    (
      // Labels for the chart, these represent the column titles
      array('id' => '', 'label' => 'Issues', 'type' => 'string'),
      array('id' => '', 'label' => 'Count', 'type' => 'number')

    );



      // Values
      $rows[] = array('c' => array(array('v' => 'Available Issues'), array('v' => (int)$totalAvailable)));
      $rows[] = array('c' => array(array('v' => 'Hidden Issues'), array('v' => (int)$totalHidden)));


    $table = array(
      'cols' => $cols,
      'rows' => $rows
    );
    $jsonTable = json_encode($table, true);
    echo $jsonTable;









 ?>

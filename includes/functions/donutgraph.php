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
        $connection = new mysqli($host, $user, $pass, $database);

        // Check connection
        if ($connection->connect_error)
        {
            die("Whoops! Could not connect to the Package Hero database. Here's the error -> " . $connection->connect_error);
        }



    ///////////////////////////////////////////////////////////////////////////

    // Count the total number of package issues not hidden and resolved
    function countTotalAvailableIssues()
    {
      global $connection;
      $country = $_SESSION['country'];


      // Build the query
        $sql = "SELECT * FROM packages WHERE Resolved = 'No' AND (PackageID NOT IN(SELECT PackageID from hiddenissues) OR PackageID NOT IN(SELECT PackageID FROM hiddenissues WHERE HideFromCountry = '$country'))";

        //prepare the sql statement
        $stmt = $connection->prepare($sql);

        //execute the prepared statement
        $stmt->execute();

      /* store result */
      $stmt->store_result();


      $total = $stmt->num_rows;


      if($total == 0)
      {
        return 0;

      }

      else
      {
        return $total;
      }


      /* Close statement */
      $stmt->close();
      $connection->close();


  }

    // Count the total number of package issues hidden
    function countTotalHidden()
    {

      global $connection;
      $country = $_SESSION['country'];

      // Build the query
      $sql = "SELECT * FROM packages WHERE Resolved = 'No' AND PackageID IN(SELECT PackageID FROM hiddenissues WHERE HideFromCountry = '$country')";

      //prepare the sql statement
      $stmt = $connection->prepare($sql);

      //execute the prepared statement
      $stmt->execute();

      /* store result */
      $stmt->store_result();

      $total = $stmt->num_rows;

      if($total == 0)
      {
        return 0;

      }

      else
      {
        return $total;
      }


      /* Close statement */
      $stmt->close();

      $connection->close();


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

<?php
    require_once('../includes/config.php');

  // Count the total number of package issues not hidden and resolved

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
      echo 0;

    }

    else
    {
      echo $total;
    }


    /* Close statement */
    $stmt->close();
    $connection->close();



 ?>

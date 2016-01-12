<?php
    require_once('../includes/config.php');

  // Count the total number of package issues not hidden and resolved
  function countTotalAvailableIssues()
  {
    global $connection;
    $country = $_SESSION['country'];


    // Build the query
      $sql = "SELECT * FROM packages WHERE Resolved = 'No' AND (PackageID NOT IN(SELECT PackageID from hiddenissues) OR PackageID NOT IN(SELECT PackageID FROM hiddenissues WHERE HideFromCountry = :country))";

      //prepare the sql statement
      $stmt = $connection->prepare($sql);

      $stmt->bindParam(':country', $country, PDO::PARAM_STR);

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



 ?>

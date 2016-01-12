<?php
  require_once("config.php");
  session_start();


      global $connection;

      $username = $_SESSION['username'];
      $country="";

      if(isset($_POST['tr']) && isset($_POST['pid']))
      {
         $pid = $_POST['pid'];
         $tnumber = $_POST['tr'];

      }

      else
      {
        $pid = $_SESSION['pid'];
        $tnumber = $_SESSION['trackingnumber'];
      }


      // Get the user country
      $sql = "SELECT Country FROM users WHERE Username = :Username";
      $stmt = $connection->prepare($sql);
      $stmt->setFetchMode(PDO::FETCH_OBJ);
      $stmt->bindParam(':Username', $username);
      $stmt->execute();

      while ($row = $stmt->fetch())
      {
        $_SESSION['country'] = $row->Country;
        $country = $_SESSION['country'];
      }


      // Hide the issue
      $sql = "INSERT into hiddenissues (PackageID, HideFromCountry, HiddenBy) VALUES(:PackageID, :HideFromCountry, :HiddenBy)";
      $stmt = $connection->prepare($sql);
      $stmt->bindParam(':PackageID', $pid, PDO::PARAM_INT);
      $stmt->bindParam(':HideFromCountry', $country, PDO::PARAM_STR);
      $stmt->bindParam(':HiddenBy', $username, PDO::PARAM_INT);
      $stmt->execute();


      // Insert the newsfeed item into table
      $news = $username." has hidden issue ".$tnumber;
      $sql = "INSERT INTO newsfeed (PackageID, News, Username) VALUES(:PackageID, :News, :Username)";
      $stmt = $connection->prepare($sql);
      $stmt->bindParam(':PackageID', $pid, PDO::PARAM_INT);
      $stmt->bindParam(':News', $news, PDO::PARAM_STR);
      $stmt->bindParam(':Username', $username, PDO::PARAM_STR);

      $stmt->execute();

      echo "Done";


?>

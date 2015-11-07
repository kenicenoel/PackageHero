<?php
  require_once("config.php");
  session_start();


      global $connection;

      $username = $_SESSION['username'];
      $pid = $_SESSION['pid'];
      $tnumber = $_SESSION['trackingnumber'];




      // Get the user country
      $sql = "SELECT Country FROM users WHERE Username = '$username'";
      $stmt = $connection->prepare($sql);
      $stmt->execute();
      $stmt->bind_result($country);
      $stmt->fetch();
      $stmt->close();

      $_SESSION['country'] = $country;


      // Hide the issue
      $sql = "INSERT into hiddenissues (PackageID, HideFromCountry, HiddenBy) VALUES('$pid','$country','$username')";
      $stmt = $connection->prepare($sql);
      $stmt->execute();

      // Insert the newsfeed item into table
      $news = $username." has hidden issue ".$tnumber." from all users in ".$country;
      $sql = "INSERT INTO newsfeed (PackageID, News, Username) VALUES(?,?,?)";
      $stmt = $connection->prepare($sql);
      $stmt->bind_param('sss', $pid, $news, $username);
      $stmt->execute();
      $stmt->close();

      echo "Done";


?>

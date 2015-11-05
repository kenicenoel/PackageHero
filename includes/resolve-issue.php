<?php
  require_once("config.php");
  session_start();


      global $connection;



      $username = $_SESSION['username'];
      $pid = $_SESSION['pid'];
      $tnumber = $_SESSION['trackingnumber'];
      $news = $username." marked issue ".$tnumber." as Resolved.";

      // Set the issue as resolved
      $sql = "UPDATE packages SET Resolved ='Yes', ResolvedTimestamp = now(), ResolvedBy ='$username' WHERE PackageID = $pid";
      $stmt = $connection->prepare($sql);
      $stmt->execute();

      // Insert the newsfeed item into table
      $sql = "INSERT INTO newsfeed (PackageID, News, Username) VALUES(?,?,?)";
      $stmt = $connection->prepare($sql);
      $stmt->bind_param('sss', $pid, $news, $username);
      $stmt->execute();
      $stmt->close();

      echo "Done";

?>

<?php
  require_once("config.php");
  session_start();


      // global $connection;



      $username = $_SESSION['username'];
      $pid = $_SESSION['pid'];
      $tnumber = $_SESSION['trackingnumber'];
      $news = $username." marked issue ".$tnumber." as Resolved.";

      $resolved = "Yes";
      $timestamp = "now()";


      // Set the issue as resolved
      $sql = "UPDATE packages SET Resolved = ?, ResolvedTimestamp = ?, ResolvedBy = ? WHERE PackageID = ?";
      $stmt = $connection->prepare($sql);
      $stmt->bind_param('sssi', $resolved, $timestamp, $username, $pid);

        if($stmt->execute())
        {
          // Insert the newsfeed item into table
          $query = "INSERT INTO newsfeed (PackageID, News, Username) VALUES(?,?,?)";
          $stmt = $connection->prepare($query);
          $stmt->bind_param('iss', $pid, $news, $username);
          $stmt->execute();


          echo "Done";
        }



        else
        {
          echo "Failed to mark the issue as resolved";
        }

        $stmt->close();







?>

<?php
  require_once("config.php");
  session_start();


      global $connection;



      $username = $_SESSION['username'];
      $pid = $_SESSION['pid'];
      $tnumber = $_SESSION['trackingnumber'];
      $country = $_SESSION['country'];
      $agent = $_SESSION['agent'];


      // Create new note and newsfeed item
      $note = $_POST['note'];
      $news = $username." (".$agent.") created a new note for issue  ".$tnumber.". NOTE: '".$note."'";

      // Insert the note into the updates table
      $sql = "INSERT INTO updates (PackageID, Note, Username, Agent) VALUES(?,?,?,?)";
      $stmt = $connection->prepare($sql);
      $stmt->bind_param('ssss', $pid, $note, $username, $agent);
      $stmt->execute();
      $stmt->close();


      // Insert the news into the newsfeed table
      $sql = "INSERT INTO newsfeed (PackageID, News, Username) VALUES(?,?,?)";
      $stmt = $connection->prepare($sql);
      $stmt->bind_param('sss', $pid, $news, $username);
      $stmt->execute();
      $stmt->close();

      echo "Done";

?>

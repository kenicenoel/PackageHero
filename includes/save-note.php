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
      $sql = "INSERT INTO updates (PackageID, Note, Username, Agent) VALUES(:PackageID, :Note, :Username, :Agent)";
      $stmt = $connection->prepare($sql);
      $stmt->bindParam(':PackageID', $pid, PDO::PARAM_INT);
      $stmt->bindParam(':Note', $note, PDO::PARAM_STR);
      $stmt->bindParam(':Username', $username, PDO::PARAM_STR);
      $stmt->bindParam(':Agent', $agent, PDO::PARAM_STR);
      $stmt->execute();



      // Insert the news into the newsfeed table
      $sql = "INSERT INTO newsfeed (PackageID, News, Username) VALUES(:PackageID, :News, :Username)";
      $stmt = $connection->prepare($sql);
      $stmt->bindParam(':PackageID', $pid, PDO::PARAM_INT);
      $stmt->bindParam(':News', $news, PDO::PARAM_STR);
      $stmt->bindParam(':Username', $username, PDO::PARAM_STR);

      $stmt->execute();


      echo "Done";

?>

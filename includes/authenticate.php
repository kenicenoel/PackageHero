<?php
  require_once("config.php");
  session_start();



      //set the username and password from form values
      $u = $_POST['username'];
      $p = $_POST['password'];

    

    $sql = "SELECT userId, Country FROM users WHERE Username = ? AND Password = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('ss', $u, $p);
    $stmt->execute();
    $stmt->bind_result($id, $country);
    if($stmt->fetch())
    {
      echo 'true';
      // create a new session
      $_SESSION['id'] = $id;
      $_SESSION['username'] = $u;
      $_SESSION['country'] = $country;

    }

      else
      {
        echo 'false';
      }


?>

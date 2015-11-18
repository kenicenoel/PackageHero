<?php
  require_once("config.php");
  session_start();



      // set the username and password from form values
      $u = $_POST['username'];
      $p = md5($_POST['password']);


    // Check the username, password and select the information from the database
    $sql = "SELECT userId, Country, Role, Agent FROM users WHERE Username = ? AND Password = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('ss', $u, $p);
    $stmt->execute();
    $stmt->bind_result($id, $country, $role, $agent);
    if($stmt->fetch())
    {

        echo 'true';
        // create a new session
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $u;
        $_SESSION['country'] = $country;
        $_SESSION['role'] = $role;
        $_SESSION['agent'] = $agent;

    }

      else
      {
        echo 'false';
      }


?>

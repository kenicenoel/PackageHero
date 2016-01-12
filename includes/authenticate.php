<?php
  require_once("config.php");
  include_once("functions/countavailableissues.php");
  session_start();




      // set the username and password from form values
      $u = $_POST['username'];
      $p = md5($_POST['password']);


    // Check the username, password and select the information from the database
    $sql = "SELECT UserId, Country, Role, Agent FROM users WHERE Username = :username AND Password = :password";
    $stmt = $connection->prepare($sql);

    # setting the fetch mode
    $stmt->setFetchMode(PDO::FETCH_OBJ);

    $stmt->bindParam(':username', $u, PDO::PARAM_STR);
    $stmt->bindParam(':password', $p, PDO::PARAM_STR);
    $stmt->execute();

    $total = $stmt->rowCount();

    if($total == 1)
    {
      echo 'success';
      while($row = $stmt->fetch())
      {
        // create a new session
        $_SESSION['id'] = $row ->UserId;
        $_SESSION['username'] = $u;
        $_SESSION['country'] = $row->Country;
        $_SESSION['role'] = $row->Role;
        $_SESSION['agent'] = $row->Agent;
      }

      // $error="";
      // $error.= $_SESSION['id'];
      // $error.=$_SESSION['username'];
      // $error.=$_SESSION['country'];
      // $error.=$_SESSION['role'];
      // $error.=$_SESSION['agent'];

      // echo $error;
    }



      else
      {
        echo 'failure';
      }

      $connection = null;


?>

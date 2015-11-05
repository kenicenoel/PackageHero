<?php
  require_once("config.php");
  session_start();


      global $connection;


      //set the username and password from form values
      $username = $_POST['username'];
      $password = $_POST['password'];

      // Build the query
      $sql = "SELECT UserID, Username, Country FROM users WHERE Username = ? AND Password = ?";

      // $stmt = $connection->stmt_init();

      //prepare the sql statement
      $stmt = $connection->prepare($sql);

      // bind variables to the paramenters ? present in sql
      $stmt->bind_param('ss', $username, $password);

      //execute the prepared statement
      $stmt->execute();

      //bind the results ($id corresponds to the items we are selecting)
      $stmt->bind_result($id, $username, $country);

      // store result of prepared statement
      $stmt->store_result();

      $result = $stmt->num_rows;


      if($result == 1)
      {
        echo 'true';

        // create a new session
        $_SESSION['userID'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['country'] = $country;

      }

      else
      {
        echo 'false';
      }


?>

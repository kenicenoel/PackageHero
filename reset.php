<?php
    include_once "includes/config.php";
    require_once('includes/classes/PasswordGenerator.php');

    // Calls the password generator class to create secure password
    function generateSecurePassword($length)
    {
      $alphaNumericPassword = PasswordGenerator::getAlphaNumericPassword($length);
      return $alphaNumericPassword;
    }

    if(isset($_POST['username']) && isset($_POST['emailaddress']))
    {

      // Create new note and newsfeed item
      $user = $_POST['username'];
      $email = $_POST['emailaddress'];

      // Check the username, password and select the information from the database
      $sql = "SELECT userId FROM users WHERE Username = ? AND EmailAddress = ?";
      $stmt = $connection->prepare($sql);
      $stmt->bind_param('ss', $user, $email);
      $stmt->execute();
      $stmt->bind_result($id);
      $stmt->store_result();
      if($stmt->fetch())
      {
          $newPassword = generateSecurePassword(9);
          $password = md5($newPassword);

          // Insert the note into the updates table
          $query = "UPDATE users SET Password = ? WHERE Username = ? AND EmailAddress = ?";
          $stmt2 = $connection->prepare($query);

          $stmt2->bind_param('sss', $password, $user, $email);
          $stmt2->execute();
          $stmt2->close();

          echo $newPassword;

      }
      else
      {
        echo "Try again";
      }

    }

   ?>

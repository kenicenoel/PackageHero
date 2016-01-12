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
      $sql = "SELECT UserId FROM users WHERE Username = :Username AND EmailAddress = :EmailAddress";
      $stmt = $connection->prepare($sql);

      $stmt->setFetchMode(PDO::FETCH_OBJ);
      $stmt->bindParam(':Username', $user);
      $stmt->bindParam(':EmailAddress', $email);
      $stmt->execute();

      while($stmt->fetch())
      {
          $newPassword = generateSecurePassword(9);
          $password = md5($newPassword);

          // Insert the note into the updates table
          $sql2 = "UPDATE users SET Password = :Password WHERE Username = :Username AND EmailAddress = :EmailAddress";
          $stmt = $connection->prepare($sql2);

          $stmt->bindParam(':Password', $password, PDO::PARAM_STR);
          $stmt->bindParam(':Username', $user, PDO::PARAM_STR);
          $stmt->bindParam(':EmailAddress', $email, PDO::PARAM_STR);
          $stmt->execute();


          echo $newPassword;

      }
      else
      {
        echo "Try again";
      }

    }

   ?>

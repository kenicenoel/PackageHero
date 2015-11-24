<?php
  require_once("config.php");
  session_start();


    if(isset($_POST['accountNumber']))
    {
      $username = $_SESSION['username'];
      $pid = $_SESSION['pid'];
      $tnumber = $_SESSION['trackingnumber'];
      $accnumber = $_POST['accountNumber'];
      $news = $username." marked issue ".$tnumber." as Resolved. Customer = ".$accnumber;

      $resolved = "Yes";
      $timestamp = "CURRENT_TIMESTAMP";


      // Set the issue as resolved
      $sql = "UPDATE packages SET Resolved = ?, ResolvedTimestamp = ?, ResolvedBy = ?, AccountNumber = ? WHERE PackageID = ?";
      $stmt = $connection->prepare($sql);
      $stmt->bind_param('ssssi', $resolved, $timestamp, $username, $accnumber, $pid);

        if($stmt->execute())
        {

          // Insert the newsfeed item into table
          $query = "INSERT INTO newsfeed (PackageID, News, Username) VALUES(?,?,?)";
          $stmt = $connection->prepare($query);
          $stmt->bind_param('iss', $pid, $news, $username);
          $stmt->execute();

          echo "Done";
        }


        $stmt->close();
    }



    else
    {
      echo '
        <div id ="content">
            <form class="card" id="resolve-issue">
                <header class="subheading"><span class=" fa fa-check"></span> You are about to resolve this issue</header>
                <p>To resolve this issue, enter the Account Number for this package. E.g: WEB1234 or GUY1234</p>
                <br>
                <p id="errorMessage"></p>
                <label for="accountNumber">Account Number</label>
                <input type = "text" id = "accountNumber" name="accountNumber" required autofocus /><br>
                <input id="resolveissue" type = "submit" value="Resolve" />

            </form>



      </div>

      ';
    } ?>

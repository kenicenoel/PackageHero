<?php
  require_once("config.php");
  session_start();


    if(isset($_POST['accountNumber']))
    {
      $username = $_SESSION['username'];
      $pid = $_SESSION['pid'];
      $agent = $_SESSION['agent'];
      $tnumber = $_SESSION['trackingnumber'];
      $accnumber = $_POST['accountNumber'];
      $news = $username." (".$agent.") marked issue ".$tnumber." as resolved for customer ".$accnumber;
      $resolved = "Yes";
      $timestamp = "CURRENT_TIMESTAMP";


      // Set the issue as resolved
      $sql = "UPDATE packages SET Resolved = :Resolved, ResolvedTimestamp = :CurrentTimestamp, ResolvedBy = :ResolvedBy, AccountNumber = :AccountNumber WHERE PackageID = :PackageID";
      $stmt = $connection->prepare($sql);
      $stmt->bindParam(':Resolved', $resolved, PDO::PARAM_STR);
      $stmt->bindParam(':CurrentTimestamp', $timestamp, PDO::PARAM_STR);
      $stmt->bindParam(':ResolvedBy', $username, PDO::PARAM_STR);
      $stmt->bindParam(':AccountNumber', $accnumber, PDO::PARAM_STR);
      $stmt->bindParam(':PackageID', $pid, PDO::PARAM_INT);
    

        if($stmt->execute())
        {

          // Insert the newsfeed item into table
          $query = "INSERT INTO newsfeed (PackageID, News, Username) VALUES(:PackageID, :News, :Username)";
          $stmt = $connection->prepare($query);
          $stmt->bindParam(':PackageID', $pid, PDO::PARAM_INT);
          $stmt->bindParam(':News', $news, PDO::PARAM_STR);
          $stmt->bindParam(':Username', $username, PDO::PARAM_STR);
          $stmt->execute();

          echo "Done";
        }



    }



    else
    {
      echo '
        <div id ="content">
            <form class="card" id="resolve-issue">
                <header class="subheading"><span class=" fa fa-check"></span> You are about to resolve this issue</header>
                <p>To resolve this issue, enter the Account Number for this package. E.g: WEB1234</p>
                <br>
                <p id="errorMessage"></p>
                <label for="accountNumber">Account Number</label>
                <input type = "text" id = "accountNumber" name="accountNumber" placeholder="e.g GRE123 or WEB720 or ANU1212 or BSL800 " required autofocus /><br>
                <input id="resolveissue" type = "submit" value="Resolve" />
            </form>

      </div>

      ';
    } ?>

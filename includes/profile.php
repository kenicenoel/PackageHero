<?php
    include_once "config.php";
    include_once "sessions/sessionvariables.php";
    global $connection;
    if(isset($_POST['FirstName']) || isset($_POST['LastName']) || isset($_POST['EmailAddress']) || isset($_POST['PhoneNumber']) || isset($_POST['Password']))
      {

      	// Check each set key and index from the form and update appropriate field in table
      	foreach ($_POST as $ColumnName => $ColumnValue)
      	{
            if($ColumnName == 'Password')
            {
              $ColumnValue = md5($ColumnValue);
            }

        		if($ColumnValue != null || $ColumnValue != "")
        		{
        					$sql = "UPDATE users SET {$ColumnName} = :ColumnValue  WHERE UserId = :UserId;";

        					// Prepare the sql statement
        					$stmt = $connection->prepare($sql);
                  $stmt->bindParam(':ColumnValue', $ColumnValue);
                  $stmt->bindParam(':UserId', $id); // value included from the sessionvariables.php file


        					// Execute the prepared statement
        					$stmt->execute();

        					$connection = null;
        			}
      		}
      			echo 'success';


      }

    else
    {
      echo '

          <form id="profile" class="card" method = "post">
            <header class="subheading"> <span class="fa fa-pencil-square-o fa-fw"></span> Profile</header>
            <p>Update all or part of your profile information</p>
            <p id="errorMessage"></p>

            <label for="FirstName">First name </label>
            <input id="firstname" type = "text" name = "FirstName" placeholder = "e.g Claire" autofocus/><br>

            <label for="LastName">Last name </label>
            <input id="lastname" type = "text" name = "LastName" placeholder = "e.g Benett" /><br>

            <label for="Password">Password </label>
            <input id="password" type = "text" name = "Password" placeholder = "sav3th3ch33rl3@d3r" /><br>

            <label for="Email">Email address </label>
            <input id="emailaddress" type = "email" name = "EmailAddress" placeholder = "clairebear@shipwebsource.com" /><br>

            <label for="PhoneNumber">Phone number</label>
            <input type = "text" id = "phonenumber" name="PhoneNumber" placeholder="8682854932" /> <br>

            <button id="save_profile" type = "submit">Update</button>
          </form>
        ';

    }




?>

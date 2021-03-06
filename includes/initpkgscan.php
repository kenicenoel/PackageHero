<?php
    include_once "config.php";
    session_start();
    if(isset($_POST['trackingnumber']) && isset($_POST['shippingcarrier']))
    {
      $tnum = $_POST['trackingnumber'];
      $ship = $_POST['shippingcarrier'];
      $user = $_SESSION['username'];


      // Insert the note into the updates table
      $sql = "INSERT INTO initialpackagescans(TrackingNumber, ShippingCarrier, ScannedBy) VALUES(:TrackingNumber,:ShippingCarrier,:ScannedBy)";
      $stmt = $connection->prepare($sql);

      // Shortcut to bind Parameters... The Keys have to be the same name as the : placeholders in query
      $data = array('TrackingNumber'=>$tnum, 'ShippingCarrier'=>$ship, 'ScannedBy'=>$user);
      $stmt->execute($data);


      echo "Done";

    }
    else
    {
      echo '
			  <div id ="content">
			      <form class="card" id="initialscan">
								<header class="subheading"><span class=" fa fa-barcode"></span> Initial Package Scanner</header>
                <p>Scan the packages shipped or dropped off to the warehouse</p>
                <br>
								<p id="errorMessage"></p>
			          <label for="trackingnumber">Tracking Number</label>
								<input type = "text" id = "tnum" name="trackingnumber" required autofocus /><br>

								<label for="shippingcarrier">Shipping Carrier</label>
								<input type = "text" id = "carrier" name="shippingcarrier" required /><br>

								<input id="savescan" type = "submit" value="Save" />

			      </form>



			</div>

			';
    } ?>

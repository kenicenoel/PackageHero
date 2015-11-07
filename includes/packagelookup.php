<?php
include_once("config.php");

if(isset($_POST['query']))
{
      $trackingnumber = $_POST['query'];

      $sql = "SELECT TrackingNumber, CustomerName, MainIssue, Resolved, Description, Photo1 FROM packages WHERE packages.TrackingNumber = ?";

		  // prepare the sql statement
		  $stmt = $connection->prepare($sql);

		  // bind variables to the paramenters ? present in sql
		  $stmt->bind_param('s',$trackingnumber);

		  // execute the prepared statement
		  $stmt->execute();

		  /* store result */
		  $stmt->store_result();

		  /* Bind the results to variables */
		  $stmt->bind_result($trackingnumber, $customername, $issue, $resolved, $desc, $image1);



      while($stmt->fetch())
      {

        $desc_snippet = substr($desc, 0, 50);
          echo '
          <div class="card">
  				    <header class="subheading"><span class="fa fa-plane"> </span> Tracking Number: '.$trackingnumber.'</header>
  					  <p><img src="../includes/'.$image1.'"alt="packageImage" /></p>
  				    <p><span class="fa fa-male"> </span> Customer: '.$customername.'</p>
              <p><span class="fa fa-bug"> </span> Main Issue: '.$issue.'</p>
              <p><span class="fa fa-check"> </span> Resolved? '.$resolved.'</p>
  					  <p><span class="fa fa-file-text"> </span> Details: '.$desc_snippet.'...</p>

  			  </div>

          ';

      } // end while
    } // end if isset


else
{
  echo '<p>Something went wrong. Please try again.</p>';
}








?>

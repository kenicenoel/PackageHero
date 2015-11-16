<?php
include_once("config.php");

if(isset($_POST['query']))
{
      $trackingnumber = "%{$_POST['query']}%";

      $sql = "SELECT TrackingNumber, CustomerName, MainIssue, Resolved, Description, Photo1 FROM packages WHERE packages.TrackingNumber Like ?";

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

        $desc_snippet = substr($desc, 0, 30);
          echo '
          <div class="card">
  						<div class="card-image">
  							<p><img src="../includes/'.$image1.'"alt="packageImage" /></p>
  						</div>

  						<div class="card-details">
  							<p class="customer">'.$customername.'</p>
  							<p class="issue"><span class="fa fa-bug"> </span> '.$issue.'</p>
  							<p class="description">'.$desc_snippet.'...</p>
                <p><span class="fa fa-check"> </span> Resolved? '.$resolved.'</p>
  						</div>

  						<div class="card-footer">
  					    <p class="trackingnumber"><span class="fa fa-truck"> </span> '.$trackingnumber.'</header>
  					    <p class="url"><a id="view-full" class="full-details" href="../includes/fulldetails.php?trackingnumber='.urlencode($trackingnumber).'&res='.urlencode($resolved).'" title="View full package details"><span class="fa fa-eye fa-fw"></span>View</a></p>
  						</div>

  			  </div>




          ';

      } // end while
    } // end if isset


else
{
  echo '<p>Something went wrong. Please try again.</p>';
}








?>

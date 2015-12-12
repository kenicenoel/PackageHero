<?php
include_once("config.php");

// if either a post or get request is received, check if query is set which means someone wants to search
if(isset($_POST['query']) || isset($_GET['query']) )
{
      // if a post request was received check if there is a value and if so, make $query that value
      if(isset($_POST['query']) && ($_POST['query'] !=''))
      {
        $query = "%{$_POST['query']}%";
      }

      // if a get request was received check if there is a value and if so, make $query that value
      else if(isset($_GET['query']) && ($_GET['query'] !=''))
      {
        $query = "%{$_GET['query']}%";
      }

        $before = "";
        $after = "";
        if(isset($_POST['beforeDate']))
        {
          $before = $_POST['beforeDate'];
        }

        if(isset($_POST['afterDate']))
        {
          $after = $_POST['afterDate'];
        }
        $sql = "SELECT TrackingNumber, AccountNumber, CustomerName, MainIssue, Resolved, Description, Photo1, ItemType, ShippingCarrier FROM packages WHERE (packages.IssueCreationTime BETWEEN ? AND ?)  OR packages.TrackingNumber Like ? OR packages.CustomerName Like ? OR packages.ItemType LIKE ? OR packages.ShippingCarrier LIKE ?";

        // echo $before;
        // echo $after;
        // echo "Search Term=".$query;

		  // prepare the sql statement
		  $stmt = $connection->prepare($sql);

		  // bind variables to the paramenters ? present in sql
		  $stmt->bind_param('ssssss', $before, $after, $query ,$query, $query, $query);

		  // execute the prepared statement
		  $stmt->execute();

		  /* store result */
		  $stmt->store_result();

		  /* Bind the results to variables */
		  $stmt->bind_result($trackingnumber, $accountnumber, $customername, $issue, $resolved, $desc, $image1, $itemtype, $shippingcarrier);



      while($stmt->fetch())
      {

        $desc_snippet = substr($desc, 0, 25);
          echo '
          <div id="search-card" class="card">
  						<div class="card-image">
  							<p><img src="../includes/'.$image1.'"alt="packageImage" /></p>
  						</div>

  						<div class="card-details">
  							<p class="customer">'.$customername.'</p>
  							<p class="issue"><span class="fa fa-bug"></span> '.$issue.'</p>
                <p class="issue"><span class="fa fa-shopping-bag"></span> '.$itemtype.'</p>
                <p class="issue"><span class="fa fa-ship"></span> '.$shippingcarrier.'</p>
  							<p class="issue"><span class="fa fa-check"> </span> Resolved: '.$resolved.'</p>
                <p class="issue"><span class="fa fa-hashtag"> </span> Account #: '.$accountnumber.'</p>
                <p class="description">'.$desc_snippet.'...</p>
  						</div>

  						<div class="card-footer">
  					    <p class="trackingnumber"><span class="fa fa-truck"> </span> '.$trackingnumber.'</header>
  					    <button class="url"><a id="view-full" class="full-details" href="../includes/fulldetails.php?trackingnumber='.urlencode($trackingnumber).'&res='.urlencode($resolved).'" title="View full package details">View</a></button>
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

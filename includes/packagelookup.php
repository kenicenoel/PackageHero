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
        $sql = "SELECT TrackingNumber, AccountNumber, CustomerName, MainIssue, Resolved, Description, Photo1, ItemType, ShippingCarrier FROM packages WHERE (packages.IssueCreationTime BETWEEN :StartDate AND :EndDate)  OR packages.TrackingNumber Like :Query OR packages.CustomerName Like :Query OR packages.ItemType LIKE :Query OR packages.ShippingCarrier LIKE :Query OR packages.AccountNumber LIKE :Query";



		  // prepare the sql statement
		  $stmt = $connection->prepare($sql);

      $stmt->setFetchMode(PDO::FETCH_OBJ);
      $stmt->bindParam(':StartDate', $before, PDO::PARAM_STR);
      $stmt->bindParam(':EndDate', $after, PDO::PARAM_STR);
      $stmt->bindParam(':Query', $query, PDO::PARAM_STR);


		  // execute the prepared statement
		  $stmt->execute();



      while($row = $stmt->fetch())
      {

        $desc_snippet = substr($row->Description, 0, 25);
          echo '
          <div id="search-card" class="card">
  						<div class="card-image">
  							<p><img src="../includes/'.$row->Photo1.'"alt="packageImage" /></p>
  						</div>

  						<div class="card-details">
  							<p class="customer">'.$row->CustomerName.'</p>
  							<p class="issue"><span class="fa fa-bug"></span> '.$row->MainIssue.'</p>
                <p class="issue"><span class="fa fa-shopping-bag"></span> '.$row->ItemType.'</p>
                <p class="issue"><span class="fa fa-ship"></span> '.$row->ShippingCarrier.'</p>
  							<p class="issue"><span class="fa fa-check"> </span> Resolved: '.$row->Resolved.'</p>
                <p class="issue"><span class="fa fa-hashtag"> </span> Account #: '.$row->AccountNumber.'</p>
                <p class="description">'.$desc_snippet.'...</p>
  						</div>

  						<div class="card-footer">
  					    <p class="trackingnumber"><span class="fa fa-truck"> </span> '.$row->TrackingNumber.'</header>
  					    <button class="url"><a id="view-full" class="full-details" href="../includes/fulldetails.php?trackingnumber='.urlencode($row->TrackingNumber).'&res='.urlencode($row->Resolved).'" title="View full package details">View</a></button>
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

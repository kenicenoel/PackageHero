<?php header('Content-Type: text/xml'); ?>
<?xml version='1.0' encoding='UTF-8'?>
<rss version="2.0">
  <channel>
    <?php
	include_once ('../config.php');
	
	    $sql = " SELECT PackageID, TrackingNumber, CustomerName, MainIssue, Description, IssueCreationTime FROM packages ORDER BY PackageID LIMIT 10";


		  // prepare the sql statement
		  $stmt = $connection->prepare($sql);

		  // execute the prepared statement
		  $stmt->execute();

		  /* store result */
		  $stmt->store_result();

		  /* Bind the results to variables */
		  $stmt->bind_result($packageid, $tnumber, $customername, $mainissue, $description, $issuedate);

      while($stmt->fetch())
      {
		  	
		  	$pubdate = date('D j F Y g:i A', strtotime($issuedate));
			$title = "A new issue has been created for a package with a Tracking Number ".$tnumber.".";
			$desc = 
			"Here are the details of the issue:<br>
			Main Issue: ".$mainissue."
        	$items .=
			'
			<item>
				<title>'.$title.'</title>
				<link>'.$link.'</link>
				<guid>'.$packageid.'</link>
				<pubDate>'.$pubdate.'</pubDate>
				<description>'.$description.'</description>
				<



          

      }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    	echo '
		<title>Package Hero Updates</title>
		<link>http://packagehero.websource-caribbean.com</link>
		<description>Receive updates on Package Hero Issues</description>
		
	
	
	
	
	
	
	
	
	
    ?>
  </channel>
</rss>

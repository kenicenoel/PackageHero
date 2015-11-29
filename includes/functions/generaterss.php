<?php
    header("Content-Type: application/rss+xml; charset=ISO-8859-1");


echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
echo "<rss version='2.0'>";
echo "<channel>";

	   include_once ('../config.php');

	    $sql = " SELECT PackageID, TrackingNumber, CustomerName, MainIssue, Description, Photo1, IssueCreationTime FROM packages ORDER BY IssueCreationTime DESC";
		  // prepare the sql statement
		  $stmt = $connection->prepare($sql);

		  // execute the prepared statement
		  $stmt->execute();

		  /* store result */
		  $stmt->store_result();

		  /* Bind the results to variables */
		  $stmt->bind_result($packageid, $tnumber, $customername, $mainissue, $description, $photo, $issuedate);

      while($stmt->fetch())
      {

		  	$pubdate = date('D j F Y g:i A', strtotime($issuedate));
			  $title = "A new issue has been created for a package with Tracking Number ".$tnumber.".";
			  $desc = "<header>Hello,</header><br>A new issue has been added to Package Hero.<br>Here are the details of the issue:";
        $desc.= "<br><img src='../".$photo."' />";
        $desc.= "<br>Tracking Number: ".$tnumber;
        $desc.= "<br>Main Issue: ".$mainissue;
        $desc.= "<br>Customer: ".$customername;

        $items .=
			'
			<item>
				<title>'.$title.'</title>
				<link>'.$link.'</link>
				<guid>'.$packageid.'</guid>
				<pubDate>'.$pubdate.'</pubDate>
				<description><![CDATA['.$desc.']]></description>
			</item>';
      }

    	echo '
		<title>Package Hero Updates</title>
		<link>http://packagehero.websource-caribbean.com</link>
		<description>Receive updates on Package Hero Issues</description>';
    echo $items;


echo "</channel>";
echo "</rss>";

  ?>

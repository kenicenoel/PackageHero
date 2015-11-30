<?php
    header("Content-Type: application/rss+xml; charset=ISO-8859-1");


    echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
    echo '<?xml-stylesheet type="text/css" href="css/rss.css"?>';
    echo "<rss version='2.0'>";
    echo "<channel>";

	   include_once ('includes/config.php');

	    $sql = " SELECT PackageID, TrackingNumber, CustomerName, MainIssue, Description, Photo1, IssueCreationTime FROM packages ORDER BY IssueCreationTime DESC LIMIT 10";
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
			  $desc = "<header>Hello,</header>
              <p>A new issue has been added to Package Hero.</p>
              <p>Here are the details of the issue:</p>";
        $desc.= "<img src='../includes/".$photo."' />";
        $desc.= "<p>Tracking Number: ".$tnumber."</p>";
        $desc.= "<p>Main Issue: ".$mainissue."</p>";
        $desc.= "<p>Customer: ".$customername."</p>";

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

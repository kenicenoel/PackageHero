<?php

		require_once dirname(__FILE__) .'/config.php';
		require_once('classes/PasswordGenerator.php');

		/* The countTotal, getLastAddedUser, getLastAddedLandlord functions
			are all system overview functions that do the job their name implies
		*/
		session_start();



		// Count the total number of package issues
		function countTotal()
		{
			global $connection;
			$country = $_SESSION['country'];

			// Build the query
      $sql = "SELECT * FROM packages WHERE Resolved = 'No'";

	    //prepare the sql statement
	    $stmt = $connection->prepare($sql);

	    //execute the prepared statement
	    $stmt->execute();

			/* store result */
	    $stmt->store_result();

			$total = $stmt->num_rows;

			if($total == 0)
			{
				return 0;

			}

			else
			{
				return $total;
			}


			/* Close statement */
			$stmt->close();
			$connection->close();

		}



		// Count the total number of package issues hidden
		function countTotalHidden()
		{

			global $connection;
			$country = $_SESSION['country'];

			// Build the query
      $sql = "SELECT * FROM packages WHERE Resolved = 'No' AND PackageID IN(SELECT PackageID FROM hiddenissues WHERE HideFromCountry = '$country')";

	      //prepare the sql statement
	      $stmt = $connection->prepare($sql);

	    //execute the prepared statement
	      $stmt->execute();

			/* store result */
	    $stmt->store_result();

		$total = $stmt->num_rows;

			if($total == 0)
			{
				return 0;

			}

			else
			{
				return $total;
			}


			/* Close statement */
			$stmt->close();

			$connection->close();


		}

		// Count the total number of package issues not hidden and resolved
		function countTotalAvailableIssues()
		{
			global $connection;
			$country = $_SESSION['country'];
			// $table = $tableName;

			// Build the query
				$sql = "SELECT * FROM packages WHERE Resolved = 'No' AND (PackageID NOT IN(SELECT PackageID from hiddenissues) OR PackageID NOT IN(SELECT PackageID FROM hiddenissues WHERE HideFromCountry = '$country'))";

				//prepare the sql statement
				$stmt = $connection->prepare($sql);

				//execute the prepared statement
				$stmt->execute();

			/* store result */
			$stmt->store_result();


			$total = $stmt->num_rows;
			$_SESSION['availableIssuesCount'] = $total;

			if($total == 0)
			{
				return 0;

			}

			else
			{
				return $total;
			}


			/* Close statement */
			$stmt->close();
			$connection->close();


		}



		// Get the user whose details were last modified
		function getLastModifiedUser()
		{
			global $connection;

			// Build the query
      $sql = "SELECT FirstName, LastName FROM users ORDER BY LastModifiedOn DESC LIMIT 1";

      // prepare the sql statement
      $stmt = $connection->prepare($sql);

      // execute the prepared statement
      $stmt->execute();

			/* store result */
	    $stmt->store_result();

			/* Bind the results to variables */
			$stmt->bind_result($fname, $lname);

			/* Fetch the results and operate on them */
			if($stmt->fetch())
			{
				$name = $fname. " " . $lname;
				return $name;

				/* Close statement */
				$stmt ->close();
			}

		}

		// Get the  last new package that was added
		function getLastAddedPackage()
		{
			global $connection;

			$country = $_SESSION['country'];
			$sql = "SELECT TrackingNumber FROM packages WHERE (PackageID NOT IN(SELECT PackageID from hiddenissues)  OR PackageID NOT IN(SELECT PackageID FROM hiddenissues WHERE HideFromCountry = '$country')) ORDER BY PackageID DESC LIMIT 1";

			// prepare the sql statement
			$stmt = $connection->prepare($sql);


			// execute the prepared statement
			$stmt->execute();

			/* store result */
	    $stmt->store_result();

			/* Bind the results to variables */
			$stmt->bind_result($trackingnumber);

			/* Fetch the results and operate on them */
			if($stmt->fetch())
			{

				return $trackingnumber;

				/* Close statement */
				$stmt ->close();
			}



			// Close the statement
			$stmt ->close();

			return $trackingnumber;


		}


		// Get the  most recent issues that were added
		function mostRecentIssues()
		{
			global $connection;
			$country = $_SESSION['country'];

			$sql = "SELECT TrackingNumber, CustomerName, MainIssue, Description FROM packages WHERE Resolved = 'No' AND (PackageID NOT IN(SELECT PackageID from hiddenissues) OR PackageID NOT IN(SELECT PackageID FROM hiddenissues WHERE HideFromCountry = '$country')) ORDER BY PackageID DESC LIMIT 5";


			// prepare the sql statement
			$stmt = $connection->prepare($sql);


			// execute the prepared statement
			$stmt->execute();

			/* store result */
	    $stmt->store_result();

			/* Bind the results to variables */
			$stmt->bind_result($tnum, $cust, $mainissue, $desc);


			$list="";
			/* Fetch the results and operate on them */
			while($stmt->fetch())
			{
				$desc_snippet = substr($desc, 0, 30); // a 30 character substring of the description
				$list.='
				<tr>
				    <td>'.$tnum.'</td>
				    <td>'.$cust.'</td>
						<td>'.$mainissue.'</td>
						<td>'.$desc_snippet.'...</td>


			  </tr>
				';


			}

			if($list == "")
			{
				return "<tr><td>No issues require your attention right now. That's good right?</td></tr>";
			}

			return $list;

			// Close the statement
			$stmt ->close();

		}


		// Get the  most recent news items that were added

		function mostRecentNewsItems()
		{
			global $connection;


			$sql = "SELECT TimeCreated, News, Username FROM newsfeed ORDER BY TimeCreated DESC LIMIT 5";


			// prepare the sql statement
			$stmt = $connection->prepare($sql);


			// execute the prepared statement
			$stmt->execute();

			/* store result */
	    $stmt->store_result();

			/* Bind the results to variables */
			$stmt->bind_result($time, $news, $user);


			$list="";
			/* Fetch the results and operate on them */
			while($stmt->fetch())
			{
				$list.='

				    <p class="newsitem">'.$time.': '.$news.'</p>

				';


			}
			if($list == "")
			{
				return "<p class='newsitem'> Dang! We could not find any news to show you. Sorry about that.</p>";
			}

			return $list;

			// Close the statement
			$stmt ->close();



		}


		function showDate()
		{
			/*
			h - 12-hour format of an hour with leading zeros (01 to 12)
			i - Minutes with leading zeros (00 to 59)
			s - Seconds with leading zeros (00 to 59)
			a - Lowercase Ante meridiem and Post meridiem (am or pm)
			l - Full day of week
			F - Full month
			d - Day of the month
			Y - Year

			*/


			date_default_timezone_set("America/Grenada");
			$day = date("l");
			$dayOfMonth = date("d");
			$month = date("F");
			$year = date("Y");
			$time = date("h:i A");

			return $dashboardTime = $day." ".$month." ".$dayOfMonth.", ".$year." at ".$time;

		}


		// The overview function creates the data shown in the admin dashboard by calling the various
		// functions and passing the correct parameter

		function overview()
		{
			// $userTotal = call_user_func('countTotal', 'users');
			$packageTotal = call_user_func('countTotal');
			$availableTotal = call_user_func('countTotalAvailableIssues');
			$hiddenTotal = call_user_func('countTotalHidden');
			$lastModifiedUser = call_user_func('getLastModifiedUser');
			$lastAddedPackage = call_user_func('getLastAddedPackage');
			$generateMostRecentIssues = call_user_func('mostRecentIssues');

			// Uncomment or comment out the line below to show/hide news feed
				$generateMostRecentNewsItems = call_user_func('mostRecentNewsItems');



				echo '
				<!-- The overview of the system -->

				<div id="content">

					<div class="news-feed">
						<header class ="modules"> <i class="fa fa-bullhorn fa-fw"></i> News </header>
							'.$generateMostRecentNewsItems.'
					</div>
					<br><br>

					<div class="at-a-glance">
							<header class ="modules"> <i class="fa fa-pie-chart fa-fw"></i> Summary </header>

									<section class="card">
										<p class="card-title">Total Issues</p>
										<p class="summary">
											<span id="total-issues" data-fgcolor="#FF6B6B" data-fontsize="30" data-dimension="200" data-text="'.$packageTotal.'" data-width="30" data-total="'.$packageTotal.'" data-part="'.$packageTotal.'"></span>
										</p>
									</section>

									<section class="card">
										<p class="card-title">Hidden Issues</p>
										<p class="summary">
											<span id="hidden-issues" data-fgcolor="#A48AD4" data-fontsize="30" data-dimension="200" data-text="'.$hiddenTotal.'" data-width="30" data-total="'.$packageTotal.'" data-part="'.$hiddenTotal.'"></span>
										</p>
									</section>


									<section class="card">
										<p class="card-title">Available Issues</p>
										<p class="summary">
											<span id="available-issues" data-fgcolor="#65C3DF" data-fontsize="30" data-dimension="200" data-text="'.$availableTotal.'" data-width="30" data-total="'.$packageTotal.'" data-part="'.$availableTotal.'"></span>
										</p>
									</section>


									<section class="card">
										<p class="card-title">Latest issue</p>
										<p class="summary">
									 			<span id="last-issue" data-fgcolor="#F8CB00" data-fontsize="20" data-dimension="200" data-text="'.$lastAddedPackage.'" data-width="30"></span>
									 	</p>
									</section>
						</div>

							<br><br>

							<! -- This div shows the 5 most recent package issues that are not hidden and are unresolved -->
							<div class="recent-items">
								<header class ="modules"> <i class="fa fa-history fa-fw"></i> Recent </header>
										<table id="results">
											<thead>
												<tr>
													<th>Tracking Number</th>
													<th>Customer Name</th>
													<th>Main Issue</th>
													<th>Description</th>

												</tr>
											</thead>

											<tbody id="info">
												 '.$generateMostRecentIssues.'
											</tbody>
										</table>
							</div>

				</div>



				';


		}



		// Responsible for showing the search options
		function search()
		{

			echo '
			<!-- The search div -->
			<div id="content">

				<form class="card">
					<header class = "subheading"><span class=" fa fa-search"></span>Package Finder</header>
					<p>Enter all or part of a tracking number to find packages<br> it may belong to.</p><br>

					<input id="queryField" type = "text" name="query" placeholder = "Enter tracking number" />
					<input id="lookupButton" type="submit" value="Find">
				</form>

				<section id = "lookupResults">

				</section>



			</div>';
		}


		/* The following functions are responsible for
			generating the content that are shown
			when clicking the tiles on the dashboard for each module */


		function addpackage()
		{

			global $connection;

			echo '
			<div class="overlay-content popup4">
			  <section id ="content2 class=left">
			    <header>Add a new package with issues to the system </header>

			    <form class="card" id="package" enctype="multipart/form-data" method = "post" action = "includes/tasks/addPackage.php">
								<br>
								<p id="errorMessage"></p>
			          <label for="trackingnumber">Tracking Number</label>
								<input type = "text" id = "trackingnumber" name="trackingnumber" /><br>

								<label for="customername">Customer Name</label>
								<input type = "text" id = "customername" name="customername" /><br>

								<label for="address">Address</label>
			          <input type = "text" id = "address" name="address" /><br>

								<textarea rows="10" cols="70" form="package" id = "description" name="description"
								required placeholder = "Enter issues for this package" wrap="hard">
								</textarea> <br>

			          <label for="images">Images (up to 5)</label>
			          <input type = "file" id = "images" name="images[]" accept=".jpg" multiple> <br>
								<input id="upload" type = "submit" value="Add" />

			      </form>



			</div>

			';

		}



		// Calls the password generator class to create secure password
		   	function generateSecurePassword($length)
				{
					$ascii = PasswordGenerator::getASCIIPassword($length);
					return $ascii;
				}


?>

<script src="../includes/js/jquery.js"></script>
<script src="../fancybox/source/jquery.fancybox.js"></script>
<script src="../includes/js/main.js"></script>
<script src="../includes/js/jquery.circliful.min.js"></script>

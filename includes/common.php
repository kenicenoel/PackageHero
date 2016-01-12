<?php

		require_once dirname(__FILE__) .'/config.php';
		require_once ("../includes/sessions/sessionvariables.php");
		require_once('functions/countavailableissues.php');
		require_once('classes/PasswordGenerator.php');

		/* The count functions create the summary for the dashboard summary category */

		session_start();



		// Count the total number of package issues
		function countTotalIssues()
		{
			global $connection;
			$resolved = 'No';


			// Build the query
      $sql = "SELECT * FROM packages WHERE Resolved = :resolved";

	    //prepare the sql statement
	    $stmt = $connection->prepare($sql);

			$stmt->bindParam(':resolved', $resolved, PDO::PARAM_STR);

	    //execute the prepared statement
	    $stmt->execute();


			$total = $stmt->rowCount();

			if($total == 0)
			{
				return 0;

			}

			else
			{
				return $total;
			}


		$connection = null;


		}


		// Count the total number of package issues hidden
		function countTotalHidden()
		{

			global $connection;
			$country = $_SESSION['country'];
			$resolved = 'No';

			// Build the query
      $sql = "SELECT * FROM packages WHERE Resolved = :resolved AND PackageID IN(SELECT PackageID FROM hiddenissues WHERE HideFromCountry = :country)";

	    //prepare the sql statement
	    $stmt = $connection->prepare($sql);
			$stmt->bindParam(':country', $country, PDO::PARAM_STR);
			$stmt->bindParam(':resolved', $resolved, PDO::PARAM_STR);

	    //execute the prepared statement
	    $stmt->execute();


			$total = $stmt->rowCount();

			if($total == 0)
			{
				return 0;

			}

			else
			{
				return $total;
			}


		$connection = null;




		}



		// Get the user whose details were last modified
		function getLastModifiedUser()
		{
			global $connection;

			// Build the query
      $sql = "SELECT FirstName, LastName FROM users ORDER BY LastModifiedOn DESC LIMIT 1";

      // prepare the sql statement
      $stmt = $connection->prepare($sql);

			# setting the fetch mode
			$stmt->setFetchMode(PDO::FETCH_OBJ);

      // execute the prepared statement
      $stmt->execute();



			/* Fetch the results and operate on them */
			while($row = $stmt->fetch())
			{
				$name = $row->FirstName. " " . $row->LastName;
				return $name;

				/* Close statement */
				$connection = null;
			}

		}

		// Get the last new package that was added
		function getLastAddedPackage()
		{
			global $connection;

			$country = $_SESSION['country'];
			$sql = "SELECT TrackingNumber FROM packages WHERE (PackageID NOT IN(SELECT PackageID from hiddenissues)  OR PackageID NOT IN(SELECT PackageID FROM hiddenissues WHERE HideFromCountry = :country)) ORDER BY PackageID DESC LIMIT 1";

			// prepare the sql statement
			$stmt = $connection->prepare($sql);

			$stmt->bindParam(':country', $country, PDO::PARAM_STR);

			// setting the fetch mode
	    $stmt->setFetchMode(PDO::FETCH_OBJ);

			// execute the prepared statement
			$stmt->execute();


			/* Fetch the results and operate on them */
			while($row = $stmt->fetch())
			{

				return $row->TrackingNumber;

				/* Close statement */
				$stmt = null;
			}



			// Close the statement
			$stmt = null;

			return $trackingnumber;


		}


		// Get the  most recent issues that were added
		function mostRecentIssues()
		{
			global $connection;
			$country = $_SESSION['country'];
			$resolved = 'No';

			$sql = "SELECT TrackingNumber, CustomerName, MainIssue, Description FROM packages WHERE Resolved = :resolved AND (PackageID NOT IN(SELECT PackageID from hiddenissues) OR PackageID NOT IN(SELECT PackageID FROM hiddenissues WHERE HideFromCountry = :country)) ORDER BY PackageID DESC LIMIT 5";


			// prepare the sql statement
			$stmt = $connection->prepare($sql);
			$stmt->bindParam(':country', $country, PDO::PARAM_STR);
			$stmt->bindParam(':resolved', $resolved, PDO::PARAM_STR);

			$stmt->setFetchMode(PDO::FETCH_OBJ);


			// execute the prepared statement
			$stmt->execute();


			$list="";
			/* Fetch the results and operate on them */
			while($row = $stmt->fetch())
			{
				$desc_snippet = substr($row->Description, 0, 30); // a 30 character substring of the description
				$list.='
				<tr>
				    <td>'.$row->TrackingNumber.'</td>
				    <td>'.$row->CustomerName.'</td>
						<td>'.$row->MainIssue.'</td>
						<td>'.$desc_snippet.'...</td>
						<td><a href="../includes/fulldetails.php?trackingnumber='.urlencode($row->TrackingNumber).'" title="View full package details"><span class="fa fa-eye fa-fw"></span>View</a></td>


			  </tr>
				';


			}

			if($list == "")
			{
				return "<tr><td>No issues require your attention right now. That's good right?</td></tr>";
			}

			return $list;

			// Close the statement
			$stmt = null;

		}


		// Get the  most recent news items that were added

		function mostRecentNewsItems()
		{
			global $connection;


			$sql = "SELECT TimeCreated, News, Username FROM newsfeed ORDER BY TimeCreated DESC LIMIT 5";


			// prepare the sql statement
			$stmt = $connection->prepare($sql);

			$stmt->setFetchMode(PDO::FETCH_OBJ);


			// execute the prepared statement
			$stmt->execute();



			$list="";
			/* Fetch the results and operate on them */
			while($row = $stmt->fetch())
			{
				$list.='

				    <p class="newsitem">'.$row->TimeCreated.': '.$row->News.'</p>

				';


			}
			if($list == "")
			{
				return "<p class='newsitem'> We could not find any news to show you. Sorry about that.</p>";
			}

			return $list;

			// Close the statement
			$connection = null;



		}

		// Returns the current date and time
		function showDate()
		{
			/* Here is a list of potential values for the date/time
			d - The day of the month (from 01 to 31)
			D - A textual representation of a day (three letters)
			j - The day of the month without leading zeros (1 to 31)
			l (lowercase 'L') - A full textual representation of a day
			N - The ISO-8601 numeric representation of a day (1 for Monday, 7 for Sunday)
			S - The English ordinal suffix for the day of the month (2 characters st, nd, rd or th. Works well with j)
			w - A numeric representation of the day (0 for Sunday, 6 for Saturday)
			z - The day of the year (from 0 through 365)
			W - The ISO-8601 week number of year (weeks starting on Monday)
			F - A full textual representation of a month (January through December)
			m - A numeric representation of a month (from 01 to 12)
			M - A short textual representation of a month (three letters)
			n - A numeric representation of a month, without leading zeros (1 to 12)
			t - The number of days in the given month
			L - Whether it's a leap year (1 if it is a leap year, 0 otherwise)
			o - The ISO-8601 year number
			Y - A four digit representation of a year
			y - A two digit representation of a year
			a - Lowercase am or pm
			A - Uppercase AM or PM
			B - Swatch Internet time (000 to 999)
			g - 12-hour format of an hour (1 to 12)
			G - 24-hour format of an hour (0 to 23)
			h - 12-hour format of an hour (01 to 12)
			H - 24-hour format of an hour (00 to 23)
			i - Minutes with leading zeros (00 to 59)
			s - Seconds, with leading zeros (00 to 59)

			*/


			date_default_timezone_set("America/Grenada");
			$day = date("l");
			$dayOfMonth = date("j");
			$month = date("F");
			$year = date("Y");
			$time = date("h:i A");

			return $dashboardTime = $day.", ".$month." ".$dayOfMonth.", ".$year." : ".$time;

		}

		// Responsible for showing the search options
		function search()
		{

			echo '
			<!-- The search div -->
			<div id="content">

				<form class="card" id="search">
					<header class = "subheading"><span class="fa fa-search"></span> Package Finder</header>
					<p>Search by tracking number, customer, shipping provider or item description</p><br>
					<input id="queryField" type = "text" name="query" placeholder = "e.g enter a tracking number, name, courier or item description to search " autofocus/><br>
					<header class="subheading searchOptions">Show results </header>
					<label for="beforeDate"> Between</label> <input type="date" id="before"  name="beforeDate" />
					<label for="afterDate"> And</label><input type="date"  id="after" name="afterDate" />
					<input id="lookupButton" type="submit" value="Find">

					<header class="subheading searchOptions">Icon guide</header>
					<p class="searchKey"><span><i class="fa fa-bug"></i></span> : Package Issue</p>
					<p class="searchKey"><span><i class="fa fa-shopping-bag"></i></span> : Item description</p>
					<p class="searchKey"><span><i class="fa fa-ship"></i></span> : Shipping carrier e.g UPS</p>
					<p class="searchKey"><span><i class="fa fa-truck"></i></span> : Tracking number</p>
					<p class="searchKey"><span><i class="fa fa-hashtag"></i></span> : Account number e.g WEB720</p>
				</form>


				<section id = "lookupResults">

				</section>
			</div>';
		}


		// Calls the password generator class to create secure password
		function generateSecurePassword($length)
		{
			$ascii = PasswordGenerator::getASCIIPassword($length);
			return $ascii;
		}


		// The overview function creates the data shown in the admin dashboard by calling the various
		// functions and passing the correct parameter

		function overview()
		{
			$totalAvailable = call_user_func('countTotalAvailableIssues');
			$hiddenTotal = call_user_func('countTotalHidden');
			// $usersTotal = call_user_func('countTotalUsers');
			$lastModifiedUser = call_user_func('getLastModifiedUser');
			$lastAddedPackage = call_user_func('getLastAddedPackage');
			$generateMostRecentIssues = call_user_func('mostRecentIssues');

			// Uncomment or comment out the line below to show/hide news feed
				$generateMostRecentNewsItems = call_user_func('mostRecentNewsItems');

				$role = $_SESSION['role'];

				echo '
				<!-- The overview of the system -->

				<div id="content">';
					if($role == "Administrator") // If an administrator is logged in, show news-feed
					{
						echo
						'
						<div class="news-feed roundedBorder">
							<header class ="modules newsModule"> <i class="fa fa-bullhorn fa-fw"></i> News <i class="fa fa-caret-down"></i></header>
								'.$generateMostRecentNewsItems.'
						</div>
						<br><br>
						';
					}



					echo '
						<div class="summary roundedBorder">
							<header class ="modules summaryModule"> <i class="fa fa-calculator fa-fw"></i> Summary <i class="fa fa-caret-down"></i></header>
							<p id="summary-graph">

							</p>

						</div>
						<!-- The graphs trends -->
						<div class="trends roundedBorder">
							<header class ="modules trendsModule"> <i class="fa fa-line-chart fa-fw"></i> Trends <i class="fa fa-caret-down"></i></header>
							<p id="weekly-report">

							</p>

						</div>

							<br><br>

							<!-- This div shows the 5 most recent package issues that are not hidden and are unresolved -->
							<div class="recent-items roundedBorder">
								<header class ="modules recentModule"> <i class="fa fa-history fa-fw"></i> Recent <i class="fa fa-caret-down"></i></header>
										<table class="nospacing" id="results">
											<thead>
												<tr>
													<th>Tracking Number</th>
													<th>Customer</th>
													<th>Issue</th>
													<th>Description</th>
													<th></th>

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


?>

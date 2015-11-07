<?php

		require_once dirname(__FILE__) .'/config.php';
		require_once('classes/PasswordGenerator.php');

		/* The countTotal, getLastAddedUser, getLastAddedLandlord functions
			are all system overview functions that do the job their name implies
		*/

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
			$sql = "SELECT TrackingNumber FROM packages WHERE (PackageID NOT IN(SELECT PackageID from hiddenissues)  OR PackageID NOT IN(SELECT PackageID FROM hiddenissues WHERE HideFromCountry = '$country') ) ORDER BY PackageID DESC LIMIT 1";

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

			$sql = "SELECT TrackingNumber, CustomerName, MainIssue, Description FROM packages WHERE Resolved = 'No' AND (PackageID NOT IN(SELECT PackageID from hiddenissues) OR PackageID NOT IN(SELECT PackageID FROM hiddenissues WHERE HideFromCountry = '$country')) ORDER BY PackageID DESC LIMIT 10";


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


			// Uncomment the line below to show news feed

			 $generateMostRecentNewsItems = call_user_func('mostRecentNewsItems');

			$moduleName = "System Overview";

				echo '
				<!-- The overview of the system -->

				<div id="content">
					<header class="username-welcome">Welcome, '.$_SESSION['username'].'</header>
				<header class ="modules"> <i class="fa fa-bullhorn fa-fw"></i> News summary </header>
					<div class="recent-items">
							'.$generateMostRecentNewsItems.'
					</div>

					<header class ="modules"> <i class="fa fa-eye fa-fw"></i> At a glance </header>

							<section class="card">
								<p class="card-title">Total Issues</p>
								<p class="summary">
									<span>'. $packageTotal .'</span>
								</p>
							</section>

							<section class="card">
								<p class="card-title">Hidden Issues</p>
								<p class="summary">
									<span>'. $hiddenTotal .'</span>
								</p>
							</section>

							<section class="card">
								<p class="card-title">Available Issues</p>
								<p class="summary">
									<span>'. $availableTotal .'</span>
								</p>
							</section>


							<section class="card">
								<p class="card-title">Most recent issue</p>
								<p class="summary">
							 			<span> '. $lastAddedPackage .'</span>
							 	</p>
							</section>

							<br><br>
							<header class ="modules"> <i class="fa fa-history fa-fw"></i> Most recent issues </header>
							<div id="recent-items">
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


		// Shows the package management options
		function package()
		{

			echo '
			<!-- The listings div containing tiles -->
			<div id="content">


					<section id="cards" class="card" data-function="addPackage">
						<p class="card-title">
							Add new package
						</p>

						<p>
							<span class="fa fa-plus fa-fw"></span>
						</p>


					</section>


					<section id="cards" class="card" data-function="viewPackages">
						<p class="card-title">
							View all packages
						</p>

						<p>
							<span class="fa fa-eye fa-fw"></span>
						</p>


					</section>

			</div>';


		}




		// Shows the lookup management options
		function search()
		{

			echo '
			<!-- The search div -->
			<div id="content">

				<form class="card">
					<header class = "subheading"><span class=" fa fa-search"></span>Package Finder</header>
					<p>Enter a tracking number to find the package it belongs to.</p><br>

					<input id="queryField" type = "text" name="query" placeholder = "Enter tracking number" /><br>
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



			</div>';

		}



		// Calls the password generator class to create secure password
		   	function generateSecurePassword($length)
				{
					$ascii = PasswordGenerator::getASCIIPassword($length);
					return $ascii;
				}







?>

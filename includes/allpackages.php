<?php

		require_once ('config.php');
		include_once('dashboard_header_2.php');

		$country = $_SESSION['country'];

		// Get the total rows from the database matching criteria
		$sql = "SELECT * FROM packages WHERE Resolved ='No' AND HideFromCountry <> '$country'";

		$stmt = $connection->prepare($sql);

		$stmt->execute();
		$stmt->store_result();

		$total = $stmt->num_rows;

		// The number of results per page
		$pageRows=5;

		//Page number of the last page
		$lastPage = ceil($total/$pageRows);

		// Makes sure last cannot be less than one
		if($lastPage < 1)
		{
			$lastPage = 1;
		}

		// Establish the $pagenum variable
		$pagenum = 1;

		// Get the pagenum from the URL vars if it is present. If not it is  = 1
		if(isset($_GET['pn']))
		{
			$pagenum = preg_replace('#[^0-9]#','', $_GET['pn']);

		}

		// This makes sure the page number is not below 1 or greater than first page
		if($pagenum < 1)
		{
			$pagenum = 1;
		}
		else if($pagenum > $lastPage)
		{
			$pagenum = $lastPage;
		}

		// This sets the range of rows to query for the chosen $pagenum
		$limit = 'LIMIT ' .($pagenum - 1) * $pageRows . ',' . $pageRows;

		// Grab one row of data
		$sql = "SELECT TrackingNumber, CustomerName, MainIssue, Description, Photo1, Photo2, Photo3, Photo4, Photo5 FROM packages WHERE Resolved ='No' AND HideFromCountry <> '$country' ORDER BY IssueCreationTime DESC $limit";


		  // prepare the sql statement
		  $stmt = $connection->prepare($sql);

		  // bind variables to the paramenters ? present in sql
		  // $stmt->bind_param('s',$trackingnumber);

		  // execute the prepared statement
		  $stmt->execute();

		  /* store result */
		  $stmt->store_result();

		  /* Bind the results to variables */
		  $stmt->bind_result($tnumber, $customername, $mainissue, $description, $photo1, $photo2, $photo3, $photo4, $photo5);
			$i = 0;

			$textline = "There are $total packages with issues in the system. You are on page $pagenum of $lastPage.";

			// Establish the paginationCtrls variable
			$navigation = '';

			// If there is more than one page of results
			if($lastPage != 1)
			{
				/* First, check if you are on page 1. If so, then
				a link to previous page and first page is not needed.
				If not on the first page, generate links to those
				*/
				if($pagenum >1)
				{
					$previous = $pagenum -1;
					$navigation.='<a class="paginate" href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a>';
					//Clickable numbered links go here and appear on the left
					for($i = $pagenum -4; $i < $pagenum; $i++)
					{
						if($i > 0)
						{
							$navigation.='<a class="paginate" href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a>';
						}
					}

				} // end if pagenum >1

				// Render the target page number, but without a link
				$navigation.='<span class="pageNumber">'.$pagenum.' </span>';

				//Clickable numbered links go here and appear on the left
				for($i = $pagenum + 1; $i <= $lastPage; $i++)
				{
					$navigation.='<a class="paginate" href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a>';
					if($i >= $pagenum+4)
					{
						break;
					}
				}
				// Checks if we are on the last page and generate next
				if($pagenum !=$lastPage)
				{
					$next = $pagenum+1;
					$navigation.='<a class="paginate" href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a>';
				}
			} // end if lastpage !=1

			$grid = "";
			$list = "";
			while($stmt->fetch())
			{
			  $i++;

				$desc_snippet = substr($description, 0, 30); // a 30 character substring of the description

			  // Generate the grid view
			  $grid.= '
			  <div class="card">
				    <header class="subheading"><span class="fa fa-truck"> </span> '.$tnumber.'</header>
						<p><img src="../includes/'.$photo1.'"alt="packageImage" /></p>
				    <p><span class="fa fa-male"> </span> '.$customername.'</p>
						<p><span class="fa fa-warning"> </span> '.$mainissue.'</p>
				  	<p>'.$desc_snippet.'...</p>

				    <p><a id="view-full" class="full-details" href="fulldetails.php?trackingnumber='.$tnumber.'" title="View full package details"><span class="fa fa-legal fa-fw"></span>Take action</a></p>
			  </div>

			  ';
			  // Generate the list view
			  $list.= '
			  <tr>
				    <td>'.$tnumber.'</td>
				    <td>'.$customername.'</td>
						<td>'.$mainissue.'</td>
						<td>'.$desc_snippet.'...</td>

				    <td><a id="view-full" class="full-details"  href="fulldetails.php?trackingnumber='.$tnumber.'" title="View full package details"><span class="fa fa-legal fa-fw"></span>Take action</a></td>
			  </tr>

			  ';
			}



		 // end if isset


?>





						<div id = "container">

						<div id ="content2">
									<header class="titleheading"> These are all the issues currently needing attention. To resolve an issue or add details, choose "<span class="fa fa-legal fa-fw"></span>Take action" </header>
							<div id="data">
									<div id = "toggle-view">
										<p>CHANGE VIEW:<p>
										<p id="list" class="view"><span class="fa fa-list"> List</span><p>
										<p id="grid" class="view"><span class="fa fa-th"> Grid</span><p>
									</div>
									<!--Show the results as a grid (the default view -->
										<div id="result-cards">
											<?php echo $grid ?>
										</div>

									<!--	Show the results as a list (table)-->
										<div id="table-results">
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
															<?php echo $list ?>
														</tbody>
													</table>
										</div>
									<!--Display the Pagination links and information-->
										<div id="pagination-holder"> <?php echo $textline."<br><br>".$navigation ?> </div>

								</div>
							</div>


						</div>


					<script src="../includes/js/jquery.js"></script>
					<script src="../fancybox/source/jquery.fancybox.js"></script>
					<script src="../includes/js/main.js"></script>
					<script src="../includes/js/custom.js"></script>

			</body>
</html>
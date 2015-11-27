<?php

		require_once ('config.php');
		include_once('dashboard_header_2.php');



		$country = $_SESSION['country'];


		// Get the total rows from the database matching criteria
		$sql = "SELECT * FROM initialpackagescans";

		$stmt = $connection->prepare($sql);

		$stmt->execute();
		$stmt->store_result();

		$total = $stmt->num_rows;

		// The number of results per page
		$pageRows=15;

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
		$sql = "SELECT TrackingNumber, ShippingCarrier, ScannedBy, timeScanned FROM initialpackagescans ORDER BY TrackingNumber DESC $limit";


		  // prepare the sql statement
		  $stmt = $connection->prepare($sql);

		  // execute the prepared statement
		  $stmt->execute();

		  /* store result */
		  $stmt->store_result();

		  /* Bind the results to variables */
		  $stmt->bind_result($tnumber, $shippingcarrier, $scannedBy, $timeScanned);
			$i = 0;

			$textline = "<p>There are <span>$total</span> initially scanned packages. You are viewing page <span>$pagenum</span> of $lastPage.</p>";

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

			  // Generate the table view
			  $list.= '
			  <tr>
				    <td>'.$tnumber.'</td>
				    <td>'.$shippingcarrier.'</td>
						<td>'.$scannedBy.'</td>
						<td>'.$timeScanned.'</td>
			  </tr>

			  ';
			}

		 // end if isset


?>

						<div id = "container">

						<div id ="content2">
								<div id="data">
									<!--	Show the results as a list (table)-->
										<div id="table-results">
													<table id="results">
														<thead>
															<tr>
																<th>Tracking Number</th>
																<th>Shipping Carrier</th>
																<th>Scanned By</th>
																<th>Time Scanned</th>

															</tr>
														</thead>

														<tbody>
															<?php echo $list ?>
														</tbody>
													</table>
										</div>
									<!--Display the Pagination links and information-->
										<div id="pagination-holder"> <?php echo $textline."<br><br>".$navigation ?> </div>

								</div>
							</div>


						</div>


			</body>
</html>

<?php

		require_once ('config.php');
		include_once('dashboard_header_2.php');
		if(!isset($_SESSION['id']) && !isset($_SESSION['username']))
		{
			header('Location: ../index.php');
			exit();
		}


		$country = $_SESSION['country'];
		$resolved = 'No';

		// Get the total rows from the database matching criteria
		$sql = "SELECT * FROM packages WHERE Resolved = :Resolved AND (PackageID NOT IN(SELECT PackageID from hiddenissues)  OR PackageID NOT IN(SELECT PackageID FROM hiddenissues WHERE HideFromCountry = :Country))";

		$stmt = $connection->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->bindParam(':Resolved', $resolved, PDO::PARAM_STR);
		$stmt->bindParam(':Country', $country, PDO::PARAM_STR);
		$stmt->execute();
		$total = $stmt->rowCount();

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
		$sql2 = "SELECT DATE_FORMAT(IssueCreationTime,'%W, %D %M, %Y') As IssueCreationDate, DATE_FORMAT(IssueCreationTime,'%h:%i %p') As CreationTime, TrackingNumber, PackageID, CustomerName, MainIssue, Description, ShippingCarrier, ItemType, Photo1 FROM packages WHERE Resolved = :Resolved AND (PackageID NOT IN(SELECT PackageID from hiddenissues) OR PackageID NOT IN(SELECT PackageID FROM hiddenissues WHERE HideFromCountry = :Country)) ORDER BY PackageID DESC $limit";



		  // prepare the sql statement
		  $stmt2 = $connection->prepare($sql2);
			$stmt2->bindParam(':Resolved', $resolved, PDO::PARAM_STR);
			$stmt2->bindParam(':Country', $country, PDO::PARAM_STR);
			$stmt2->setFetchMode(PDO::FETCH_OBJ);
		  // execute the prepared statement
		  $stmt2->execute();

			$i = 0;

			$textline = "<p>There are $total total packages in Package Hero available to you and you are currently on page $pagenum of $lastPage.</p>";

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
			$last_date='0000-00-00';
			while($row = $stmt2->fetch())
			{

			  $i++;

				$desc_snippet = substr($row->Description, 0, 25); // a 25 character substring of the description

			  // Generate the grid view
				$date_header = '';
				if ($last_date != $row->IssueCreationDate)
				{
					$date_header = '<p class="dateHeader">'.$row->IssueCreationDate.'</p>';
				}
				else
				{
					$date_header = '';
				}
			  $grid.=
			  	$date_header.'<div class="card">
						<div class="card-image">
							<p><img src="../includes/'.$row->Photo1.'"alt="packageImage" /></p>
						</div>

						<div class="card-details">
							<p class="customer">'.$row->CustomerName.'</p>
							<p class="issue"><span class="fa fa-bug"> </span> '.$row->MainIssue.'</p>
							<p class="issue"><span class="fa fa-shopping-bag"></span> '.$row->ItemType.'</p>
							<p class="issue"><span class="fa fa-ship"></span> '.$row->ShippingCarrier.'</p>
							<p class="description">'.$desc_snippet.'...</p>
						</div>

						<div class="card-footer">
					    <p class="trackingnumber"><span class="fa fa-truck"> </span> '.$row->TrackingNumber.'</p>
					    <button class="url"><a id="view-full" class="full-details" href="fulldetails.php?trackingnumber='.urlencode($row->TrackingNumber).'" title="View full package details">View</a></button>
						</div>

			  </div>

			  ';

			  // Generate the list view
				$date_header = '';
				if ($last_date != $row->IssueCreationDate)
				{
					$date_header = '<p class="dateHeader">'.$row->IssueCreationDate.'</p>';
				}
				else
				{
					$date_header = '';
				}
			  $list.= $date_header.'<div class="listView">
						<p class="time">'.$row->CreationTime.'</p>
				    <p>'.$row->TrackingNumber.'</p>
				    <p>'.$row->CustomerName.'</p>
						<p>'.$row->MainIssue.'</p>
						<p>'.$row->ItemType.'</p>
						<p>'.$row->ShippingCarrier.'</p>
						<p>'.$desc_snippet.'...</p>


				    <p class="quickButtonsHolder">
						<button class="quickView"><a id="view-full" class="full-details" href="fulldetails.php?trackingnumber='.$row->TrackingNumber.'" title="View full package details">view</a></button>
						<button class="quickHide hide" data-tracking="'.$row->TrackingNumber.'" data-pid="'.$pid.'">hide</button>
						</p>
			  </div>

			  ';
					$last_date = $row->IssueCreationDate;
			}

		 // end if isset


?>


						<div id ="content2">
								<div id="data">
									<div id = "toggle-view">
										<p>VIEW AS:<p>
										<p id="list" class="view"><span class="fa fa-list-alt"> List</span><p>
										<p id="grid" class="view"><span class="fa fa-th-large"> Cards</span><p>
									</div>

									<!--Show the results as a grid (the default view -->
										<div id="result-cards">
											<?php echo $grid ?>

										</div>


									<!--	Show the results as a list -->
										<div id="table-results">
											<!-- <p>Date</p>
											<p>Tracking Number</p>
											<p>Customer</p>
											<p>Issue</p>
											<p>Item</p>
											<p>Shipper</p>
											<p>Description</p> -->

												<?php echo $list ?>

										</div>
									<!--Display the Pagination links and information-->
									<div class="pagination-holder"> <?php echo $textline."<br><br>".$navigation ?> </div>

								</div>
							</div>


						</div>


			</body>
			<script type= "text/javascript" src="../includes/js/jquery.js"></script>
			<script type="text/javascript" src="../fancybox/source/jquery.fancybox.js"></script>
			<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
			<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-media.js"></script>
			<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>
			<script src="../includes/js/jquery-ui.min.js"></script>
			<script type= "text/javascript" src="../includes/js/main.js"></script>


</html>

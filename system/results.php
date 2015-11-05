<?php

		require_once ('../includes/system_header.php');


		if(isset($_POST['min']) && isset($_POST['max'])  )
		{

			$minPrice=$_POST['min'];
			$maxPrice=$_POST['max'];
			$location="%";
			$occupants = 100;
			$furnished = "%";
			$type = "%";


			$_SESSION['min'] = $minPrice;
			$_SESSION['max'] = $maxPrice;
			$_SESSION['location'] = $location;
			$_SESSION['num-occupants'] = $occupants;
			$_SESSION['furnished'] = $furnished;
			$_SESSION['type'] = $type;


			if(isset($_POST['location']))
			{
				$location='%'.$_POST['location'];
				$_SESSION['location'] = $location;
			}

			if(isset($_POST['num-occupants']))
			{
				$occupants = $_POST['num-occupants'];
			}

			if(isset($_POST['furnished']))
			{
				$furnished = '%'.$_POST['furnished'];
				$_SESSION['furnished'] = $furnished;
			}

			if(isset($_POST['num-occupants']))
			{
				$occupants = $_POST['num-occupants'];
			}

			if(isset($_POST['type']))
			{
				$type = '%'.$_POST['type'];
			}




		}

		else
		{
			$minPrice=$_SESSION['min'];
			$maxPrice=$_SESSION['max'];
			$location=$_SESSION['location'];
			$occupants = $_SESSION['num-occupants'];
			$furnished= $_SESSION['furnished'] ;
			$type = $_SESSION['type'];


		}




			// Get the total rows from the database matching criteria
			$sql = "SELECT * FROM listing, landlord WHERE listing.price >= ? AND listing.price <= ? AND
		landlord.landlordNumber = listing.landlordNumber AND location LIKE ? AND occupants <=? AND furnished LIKE ? AND type LIKE ? ";

		$stmt = $connection->prepare($sql);
		$stmt->bind_param('iisiss', $minPrice, $maxPrice, $location, $occupants, $furnished, $type);
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

		//Get the pagenum from the URL vars if it is present. If not it is  =1
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
			$sql = "SELECT listing.listingNumber, listing.type, listing.address, listing.location, listing.description, listing.price, landlord.firstName, landlord.lastName,
			 				image1, image2, image3 FROM listing, landlord WHERE listing.price >= ? AND listing.price <= ? AND
							landlord.landlordNumber = listing.landlordNumber AND location LIKE ? AND occupants <=? AND furnished LIKE ? AND type LIKE ? ORDER BY listing.price ASC $limit";

		  // prepare the sql statement
		  $stmt = $connection->prepare($sql);

		  // bind variables to the paramenters ? present in sql
		  $stmt->bind_param('iisiss',$minPrice, $maxPrice, $location, $occupants, $furnished, $type);

		  // execute the prepared statement
		  $stmt->execute();

		  /* store result */
		  $stmt->store_result();

		  /* Bind the results to variables */
		  $stmt->bind_result($number, $type, $address, $location, $desc, $price, $fname, $lname, $image1, $image2, $image3);
			$i = 0;

			$textline = "Found $total listings that match your selected filters.
						You are on page $pagenum of $lastPage.";

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
				$navigation.=''.$pagenum.' &nbsp;';

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
				$full_address = $address.", ".$location; // merge the address and the location into a single string
				$desc_snippet = substr($desc, 0, 30); // a 30 character substring of the description

			  // Generate the grid view
			  $grid.= '
			  <div class="card">
				    <header class="subheading"><span class="fa fa-building-o"> </span> '.$type.'</header>
					<p><img src="../includes/tasks/'.$image1.'"alt="listingImage" /></p>
				    <p><span class="fa fa-map-marker"> </span> '.$full_address.'</p>
				    <p><span class="fa fa-dollar"> </span> '.$price.'</p>
				    <p><span class="fa fa-male"> </span> '.$fname ." ".$lname.'</p>
					<p>'.$desc_snippet.'...</p>
				    <p><a class="full-listing" href="expandlisting.php?l='.$number.'" title="Full listing details"><span class="fa fa-check-circle fa-fw"></span> Full details</a></p>
			  </div>

			  ';
			  // Generate the list view
			  $list.= '
			  <tr>
				    <td>'.$type.'</td>
				    <td>'.$full_address.'</td>
					<td>'.$desc_snippet.'...</td>
				    <td>$'.$price.'</td>
				    <td>'.$fname ." ".$lname.'</td>
				    <td><a href="expandlisting.php?l='.$number.'" title="Expand listing"><span class="fa fa-external-link-square fa-fw"></span> View</a></td>
			  </tr>

			  ';
			}



		 // end if isset


?>

<div id = "container">

<section id ="content">

	<header class = "highlight">

	</header>
</section>

<section id ="content2">
	<header> </header>
	<div id = "toggle-view">
		<p>VIEW:<p>
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
								<th>Type</th>
								<th>Address</th>
								<th>Description</th>
								<th>Price</th>
								<th>Landlord</th>
							</tr>
						</thead>

						<tbody id="info">
							<?php echo $list ?>
						</tbody>
					</table>
		</div>
	<!--Display the Pagination links and information-->
		<div id="pagination-holder"> <?php echo $textline."<br><br>".$navigation ?> </div>

</section>


</div>



<script type= "text/javascript" src="../includes/js/jquery.js"></script>
<script type="text/javascript" src="../fancybox/source/jquery.fancybox.js"></script>
<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-media.js"></script>
<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>
<script type= "text/javascript" src="../includes/js/main.js"></script>

<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="../datatables/media/js/jquery.dataTables.js"></script>


</body>
<?php include_once "../includes/oasis_footer.php" ?>

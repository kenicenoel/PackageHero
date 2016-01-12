<?php

		require_once ('config.php');
		include_once('dashboard_header_2.php');
		if(!isset($_SESSION['id']) && !isset($_SESSION['username']))
		{
			header('Location: ../index.php');
			exit();
		}


		if(isset($_GET['trackingnumber'])  )
		{

			$trackingnumber = $_GET['trackingnumber'];
			$_SESSION['trackingnumber'] = $trackingnumber;

			// Get the details for the package
			$sql = "SELECT * FROM packages WHERE TrackingNumber = :TrackingNumber";
		  $stmt = $connection->prepare($sql);
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			$stmt->bindParam(':TrackingNumber', $trackingnumber, PDO::PARAM_STR);
			$stmt->execute();
			$currentDetails="";
			$imageCollection = array();
			while ($row = $stmt->fetch())
			{
				$_SESSION['pid'] = $row->PackageID;

				$currentDetails.=
				"
				<p>Tracking number: ".$row->TrackingNumber.".</p>
				<p>Customer name: ".$row->CustomerName.".</p>
				<p>Main Issue: ".$row->MainIssue.".</p>
				<p>Description: ".$row->Description.".</p>
				";

				// Get the images for the listing

					if($row->Photo1)
					{
						$image = $row->Photo1;
						$imageCollection[] = $image;
					}
					if($row->Photo2)
					{
						$image = $row->Photo2;
						$imageCollection[] = $image;
					}

					if($row->Photo3)
					{
						$image = $row->Photo3;
						$imageCollection[] = $image;
					}
					if($row->Photo4)
					{
						$image = $row->Photo4;
						$imageCollection[] = $image;
					}
					if($row->Photo5)
					{
						$image = $row->Photo5;
						$imageCollection[] = $image;
					}

			}

		} // end if isset


		 // Get the details for the note
		 $sql = "SELECT updates.Note, updates.TimeCreated, updates.Username, updates.Agent FROM updates WHERE updates.PackageID = :PackageID";
		 $stmt = $connection->prepare($sql);
		 $stmt->bindParam(':PackageID', $_SESSION['pid'], PDO::PARAM_INT);
		 $stmt->setFetchMode(PDO::FETCH_OBJ);

		 $stmt->execute();

		 $notes="";
		 while($row = $stmt->fetch())
		 {
			 // Generate the list view
			 $notes.= '
			 <tr>
					 <td>'.$row->TimeCreated.'</td>
					 <td>'.$row->Note.'</td>
					 <td>'.$row->Username.' ('.$row->Agent.')</td>

			</tr>';
		 }


?>

						<div id = "container">
								<div id ="content2">

									<div id='data'>

										<div id="result-container">

												<!-- The action buttons goes below here -->
													<?php

														if(isset($_GET['res']) && $_GET['res'] == 'No')
														{
															echo '<p> You can mark the issue as resolved or hide irrelevant issues from your dashboard. Hiding an issue will also hide it from other users in your country.</p>';
															echo '<button class="task-actions" id="resolve"><span class="fa fa-check fa-fw"></span>Resolve</button>';
															echo '<button class="task-actions hide"><span class="fa fa-eye-slash fa-fw"></span>Hide</button>';
														}

														if (!isset($_GET['res']))
														{
															echo '<p> You can mark the issue as resolved or hide irrelevant issues from your dashboard. Hiding an issue will also hide it from other users in your country.</p>';
															echo '<button class="task-actions" id="resolve"><span class="fa fa-check fa-fw"></span>Resolve</button>';
															echo '<button class="task-actions hide"><span class="fa fa-eye-slash fa-fw"></span>Hide</button>';
														}

														else if(isset($_GET['res']) && $_GET['res'] == 'Yes')
														{
															echo '<p> This issue has been resolved. You can still view it and make notes but can no longer hide or resolve it.</p>';
														}
														 ?>

												<p id="errorMessage"></p>
											<div id="actions">
												<header class="subheading">Enter an update for this issue</header>
												<input id="note" type="text" placeholder="e.g. Received invoice from Customer" name="note" required />
												<button id="saveNote"><span class="fa fa-arrow-right fa-fw"></span></button>
											</div> <!-- End actions div -->

										<?php

											echo '<header class="subheading"><span class="fa fa-file-text fa-fw"></span> Current details</header>';
											echo $currentDetails;

										?>

										 <div id="image-container">
											 <header class="subheading"><span class="fa fa-photo fa-fw"></span> Images</header>
											 <?php

												 // This for loop goes through the image collection array and creates thumbnails of them surrounded by a paragraph tag using fancybox
													 for($i = 0; $i < count($imageCollection); $i++)
													 {
														 echo '<p><a class="fancybox" rel="image" href="../includes/'.$imageCollection[$i].'"><img src="../includes/'.$imageCollection[$i].'" alt="" /></a></p>';
													 }

											 ?>
										 </div> <!-- End image-container div -->
										 <header class="subheading"><span class="fa fa-history fa-fw"></span> Update History</header>
										 <table id="update-history">
											 <!-- <thead>
												 <tr>
													 <th>Date</th>
													 <th>Note</th>
													 <th>User</th>
												</tr>
											 </thead> -->

											 <tbody id="note-list">
												 <?php echo $notes ?>
											 </tbody>
										 </table>

										 <!-- THE DIV THAT HOLDS THE DATA FOR THE POPUP WARNING -->
										 <div id="dialog-confirm" title="Hide issue" style="display:none;">
  									 		<p><?php echo $_SESSION['username']; ?>, are you sure you want to hide this issue?<br> This also hides it from other users in <?php echo $country; ?> as well.</p>
										</div>

										</div>

									</div> <!-- End data div -->

								</div> <!-- End content2 div -->

						</div> <!-- End container div -->
		</body>
		<script type= "text/javascript" src="../includes/js/jquery.js"></script>
		<script type="text/javascript" src="../fancybox/source/jquery.fancybox.js"></script>
		<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
		<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-media.js"></script>
		<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>
		<script src="../includes/js/jquery-ui.min.js"></script>
		<script type= "text/javascript" src="../includes/js/main.js"></script>
	</html>

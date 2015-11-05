<?php

		require_once ('config.php');
		include_once('dashboard_header_2.php');


		if(isset($_GET['trackingnumber'])  )
		{

			$trackingnumber = $_GET['trackingnumber'];


			// Get the details for the package
			$sql = "SELECT packages.PackageID, packages.TrackingNumber, packages.CustomerName, packages.MainIssue, packages.Description, packages.Photo1 FROM packages WHERE TrackingNumber = ?";
		  $stmt = $connection->prepare($sql);
			$stmt->bind_param('s', $trackingnumber);
			$stmt->execute();
			$stmt->bind_result($pid, $trackingnumber, $customername, $issue, $description, $photo1);
			$stmt->fetch();
			$stmt->close();


			// Get the images for the listing
			$imageCollection = array();
			for($i = 1; $i <= 5; $i++)
			{
				$sql = "SELECT Photo$i FROM packages WHERE TrackingNumber = ?";
			  $stmt = $connection->prepare($sql);
				$stmt->bind_param('s', $trackingnumber);
				$stmt->execute();
				$stmt->bind_result($image);
				if($image)
				{
					$imageCollection[] = $image;
				}

				/* store result */
			  $stmt->fetch();
				$stmt->close();
			}


			} // end if isset
		 $_SESSION['pid'] = $pid;
		 $_SESSION['trackingnumber'] = $trackingnumber;

		 // Get the details for the note
		 $sql = "SELECT updates.Note, updates.TimeCreated, updates.Username FROM updates WHERE updates.PackageID = $pid";
		//  $stmt->bind_param('i', $pid);

		 $stmt = $connection->prepare($sql);
		 $stmt->execute();
		 $stmt->bind_result($note, $timestamp, $user);
		 $notes="";
		 while($stmt->fetch())
		 {
			 // Generate the list view
			 $notes.= '
			 <tr>
					 <td>'.$timestamp.'</td>
					 <td>'.$note.'</td>
					 <td>'.$user.'</td>
			</tr>';
		 }

		 $stmt->close();


?>


						<div id = "container">

								<div id ="content2">
									<header class="titleheading"> <span class="fa fa-legal fa-fw"></span>You are now taking action on issue <?php echo $trackingnumber ?></header>
									<div id='data'>

										<div id="result-container">
												<!-- The action buttons goes below here -->
												<button class="task-actions" id="resolve"><span class="fa fa-check fa-fw"></span>Resolve</button>
												<button class="task-actions" id="hide"><span class="fa fa-eye-slash fa-fw"></span>Hide</button>

											<div id="actions">
												<header class="subheading">Enter an update for this issue</header>
												<input id="note" type="text" placeholder="e.g. Received invoice from Customer" name="note">
												<button id="saveNote"><span class="fa fa-chevron-circle-right fa-fw"></span></button>

											</div> <!-- End actions div -->
										<?php
											echo '<header class="subheading"><span class="fa fa-file-text fa-fw"></span> Current details</header>';
											echo '<p>Tracking number: '.$trackingnumber.' </p>';
											echo '<p>Customer name: '.$customername.' </p>';
											echo '<p>Main Issue: '.$issue.' </p>';
											echo '<p>Description: '.$description.' </p>';
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



										</div>

									</div> <!-- End data div -->



								</div> <!-- End content2 div -->



						</div> <!-- End container div -->

			<script type= "text/javascript" src="../includes/js/jquery.js"></script>
			<script type="text/javascript" src="../fancybox/source/jquery.fancybox.js"></script>
			<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
			<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-media.js"></script>
			<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>
			<script type= "text/javascript" src="../includes/js/main.js"></script>

			<!-- DataTables -->
			<script type="text/javascript" charset="utf8" src="../datatables/media/js/jquery.dataTables.js"></script>


		</body>
	</html>

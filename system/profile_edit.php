<?php require_once "../includes/oasis_header.php";

if
(
		isset($_POST['firstName']) || isset($_POST['lastName']) || isset($_POST['email']) || isset($_POST['address'])
		|| isset($_POST['phoneNumber']) || isset($_POST['password'])
)
{


	// Check each set key and index from the form and update appropriate field in table
	foreach ($_POST as $key => $val)
	{


			if($val != null)
			{

					$sql = "UPDATE users SET {$key} = ?  WHERE studentNumber = ?";

					//prepare the sql statement
					$stmt = $connection->prepare($sql);
					$stmt->bind_param('si', $val, $studentNumber);

					//execute the prepared statement
					$stmt->execute();
					$stmt->close();
					$connection->close();

			}



		}
			echo 'Successfully updated your profile';






}

?>


	<div id = "container">



	<section id ="content2">


			<form id="profile" class="card" method = "post" action = "profile_edit.php">
				<header class="subheading"> <span class="fa fa-pencil-square-o fa-fw"></span> Profile</header>
				<p>Update all or part of your profile information</p>
				<p id="errorMessage"></p>

				<label for="firstName">First name </label>
				<input id="fname" type = "text" name = "firstName" placeholder = "Nye" autofocus/><br>

				<label for="lastName">Last name </label>
				<input id="lname" type = "text" name = "lastName" placeholder = "Jules" /><br>

				<label for="password">Password </label>
				<input id="password" type = "password" name = "password" placeholder = "password" /><br>

				<label for="email">Email address </label>
				<input id="email" type = "email" name = "email" placeholder = "nyej@my.uwi.edu" /><br>

				<label for="phoneNumber">Phone number</label>
				<input type = "text" id = "phoneNumber" name="phoneNumber" placeholder="17121234567" /> <br>

				<label for="address">Address</label>
				<input type = "text" id = "address" name="address" placeholder="Curepe" /> <br>

				<!-- <label for="accent">Accent</label>
				<input type = "color" id = "accent" name="accent"  /> <br> -->



				<button id="save_profile" type = "submit">Update</button>
			</form>


	</section>


</div>



</body>


<?php include_once "../includes/oasis_footer.php" ?>

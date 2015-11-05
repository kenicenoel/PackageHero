<?php require_once "../includes/oasis_header.php";

			if(isset($_POST['accent']))
			{
				$accent = $_POST['accent'];
				$sql = "UPDATE users SET accent = ?  WHERE studentNumber = ?";

					//prepare the sql statement
					$stmt = $connection->prepare($sql);

					// bind variables to the paramenters ? present in sql
					$stmt->bind_param('s', $accent, $sid);

					//set the variables from form values
					
					$sid = $studentNumber; // $studentNumber value is stored in the $_SESSION['studentNumber'] variable


					//execute the prepared statement
					$stmt->execute();
			}
			
			

?>


	<div id = "container">

	

	<section id ="content2">
		

			<form class="card">
				<header class="subheading"> <span class="fa fa-pencil-square-o fa-fw"></span> Change accent color</header>
				<p>Pick your favourite colour to use througout your oasis account.</p>
				<input type="color" name="accent" value="#1fa4b9">
				
				

				<button id="set_accent">Change</button>
			</form>


	</section>


</div>



</body>


<?php include_once "../includes/oasis_footer.php" ?>


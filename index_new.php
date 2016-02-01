<?php include_once("includes/header.php"); ?>

			<div id = "container">

				<div class="top">
					
				</div>

				<div id ="bottom">
							<form id="form" method ="post">
								<img src="images/ph.png" />
								<header id="welcome">Hello</header>
									<?php
										if(isset($_GET['page']))
										{
											echo '<p class="text">You need to login before we can show you this.</p>';
										}

										else
										{
											echo "<p class='text'>Please enter your username and password </p>";
										}
									?>

									<p id = "msg"></p>
									 <label for="username">Username</label>
									<input type = "text" id = "username" name="username" required autofocus placeholder = "e.g bob.frank" /> <br><br>
									<label for="password">Password</label>
									<input type = "password" id = "password" name="password" required placeholder="myawesomepassword" /> <br>
									<?php
										if(isset($_GET['page']))
										{
											echo '<input id="page" type="hidden" name="page" value="'.$_GET["page"].'">';
										}
										else
										{
											echo '<input id="page" type="hidden" name="page" value="">';
										}
									?>
									<input id ="login-button" type = "submit" value="Login" />
									<p id="forgot-password">Forgot your password?</p>
							</form>
							<?php include_once 'includes/footer.php'; ?>
				</div>

		</div>


		<!-- <footer> -->

	</body>

	<script type= "text/javascript" src="includes/js/jquery.js"></script>
	<script type= "text/javascript" src="includes/js/login.js"></script>
	<script type= "text/javascript" src="includes/js/passwordreset.js"></script>
	<script src="includes/js/jquery-ui.min.js"></script>

</html>

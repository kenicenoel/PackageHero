<?php include_once("includes/header.php"); ?>

			<div id = "container">
				<header class="top"><img src="images/logo.svg" /></header>


				<div id ="bottom">
							<form id="form" method ="post">
								<img src="images/icons/id.svg" />
								<header id="welcome">Hello!</header>
									<p class="text">Before we can let you in, we need to know who you are</p>
									<p id = "msg"></p>
									 <label for="username">Username</label>
									<input type = "text" id = "username" name="username" required autofocus placeholder = "e.g brendon.charles" /> <br><br>
									<label for="password">Password</label>
									<input type = "password" id = "password" name="password" required placeholder="itgurus" /> <br>
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

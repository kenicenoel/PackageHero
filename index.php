<?php include_once("includes/header.php"); ?>

			<div id = "container">
				<header class="top"><img src="images/packagehero_logo.svg" /></header>

			
				<div id ="bottom">
							<form id="form" action= "" method ="post">
								<header id="welcome">Hello!</header>
									<p class="text">Please enter your username and password</p>
									<p id = "msg"></p>
									 <label for="username"><span class="fa fa-male fa-fw"></span> Username</label>
									<input type = "text" id = "username" name="username" required autofocus placeholder = "e.g Brendon" /> <br><br>
									<label for="password"><span class="fa fa-keyboard-o fa-fw"> </span> Password</label>
									<input type = "password" id = "password" name="password" required placeholder="kingCh@rl3s" /> <br>
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

</html>

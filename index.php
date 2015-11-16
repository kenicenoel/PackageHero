<?php include_once("includes/header.php"); ?>

			<div id = "container">

				<!-- <div id ="top">


				</div> -->

				<div id ="bottom">


							<form id="form" action= "" method ="post" class ="ajax">
								<header id="welcome">Welcome</header>
									<p class="text">Enter your username and password to begin.</p>
									<p id = "msg"></p>
									 <label for="username"><span class="fa fa-male fa-fw"></span> Username</label>
									<input type = "text" id = "username" name="username" required autofocus placeholder = "e.g Brendon" /> <br><br>

									<label for="password"><span class="fa fa-keyboard-o fa-fw"> </span> Password</label>
									<input type = "password" id = "password" name="password" required placeholder="kingCh@rl3s" /> <br>
									<input id ="login-button" type = "submit" value="Login" />
							</form>
							<footer id = "footer">&copy;<?php echo date("Y"); ?> Web Source. Package Issue Management made simple.</footer>
				</div>

		</div>



	</body>
	<script type= "text/javascript" src="includes/js/jquery.js"></script>
	<script type= "text/javascript" src="includes/js/login.js"></script>

</html>

<?php include_once("includes/header.php"); ?>

			<div id = "container">

				<div id ="left-sidebar">

							<img src = 'images/package_hero_new.png' alt = "PIM banner" />
				</div>

				<div id ="right-sidebar">
					<header id="welcome">Ready to get started?</header>


							<p class="text">Enter your username and password to begin.</p>

							<form id="form" action= "" method ="post" class ="ajax">
									<p id = "msg"></p>
									<span class="fa fa-male fa-fw"> </span><label for="username"> Username</label>
									<input type = "text" id = "username" name="username" required autofocus placeholder = "e.g Brendon" /> <br><br>

									<span class="fa fa-keyboard-o fa-fw"> </span><label for="password"> Password</label>
									<input type = "password" id = "password" name="password" required placeholder="kingCh@rl3s" /> <br>

									<input id ="login-button" type = "submit" value="Login" />
							</form>




				</div>



			</div>

				<footer id = "footer">&copy;<?php echo date("Y"); ?> Web Source.Package Hero&reg;: Package Issue Management made simple.</footer>

	</body>
	<script type= "text/javascript" src="includes/js/jquery.js"></script>
	<script type= "text/javascript" src="includes/js/login.js"></script>

</html>

<?php include_once("includes/header.php"); ?>

			<div id = "container">

				<div id ="left-sidebar">

							<img src = 'images/package_hero.png' alt = "PIM banner" />
				</div>

				<div id ="right-sidebar">
					<header id="welcome">Welcome</header>


							<p class="text">To start, enter your username and password.</p>

							<form id="form" action= "" method ="post" class ="ajax">
									<p id = "msg"></p>
									<span class="fa fa-male fa-fw"> </span><label for="username"> Username</label>
									<input type = "text" id = "username" name="username" required autofocus placeholder = "e.g packageKing" /> <br><br>

									<span class="fa fa-keyboard-o fa-fw"> </span><label for="password"> Password</label>
									<input type = "password" id = "password" name="password" required placeholder="@25MneuTy7d3" /> <br>

									<input id ="login-button" type = "submit" value="Login" />

							</form>




				</div>

						<footer id = "footer">&copy;2015 Websource</footer>

			</div>



	</body>
	<script type= "text/javascript" src="includes/js/jquery.js"></script>
	<script type= "text/javascript" src="includes/js/login.js"></script>

</html>

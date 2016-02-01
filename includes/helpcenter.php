<?php

		require_once ('config.php');
		include_once('dashboard_header_2.php');
		if(!isset($_SESSION['id']) && !isset($_SESSION['username']))
		{
			header('Location: ../index.php');
			exit();
		}


?>



						<div id ="content2">
								<div id="data">
										<header class="helpHeader">
											Need help? We've got you covered.
											<p class="helpSubText">
												Here, you will find videos and guides on using all the new features of Package Detective
											</p>
										</header>
										<video class= "tutorial" width="700" height="500" controls muted poster="../images/posterimage_tutorial.png">
										  <source src="../media/tutorialvideo.webm" type="video/webm">
												Your browser can't play this video. Upgrade to the latest version of your browser first.
										</video>
										<video class= "tutorial" width="700" height="500" controls muted poster="../images/posterimage_passwordreset.png">
										  <source src="../media/passwordreset.webm" type="video/webm">
												Your browser can't play this video. Upgrade to the latest version of your browser first.
										</video>

										<h4>It is recommended that you view the videos in fullscreen mode.</h4>


								</div>
						</div>


				</div>


			</body>
			<script type= "text/javascript" src="../includes/js/jquery.js"></script>
			<script type="text/javascript" src="../fancybox/source/jquery.fancybox.js"></script>
			<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
			<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-media.js"></script>
			<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>
			<script src="../includes/js/jquery-ui.min.js"></script>
			<script type= "text/javascript" src="../includes/js/main.js"></script>


</html>

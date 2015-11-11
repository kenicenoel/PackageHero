<?php
			require_once ("../includes/dashboard_header.php");

			// checks if the url has the module switch
			if(isset ($_GET['module']))
			{
				$moduleNameSpanOpen = "<span class='highlight'>";
				$moduleNameSpanClose = "</span>";
				if($_GET['module'] != 'package' && $_GET['module'] != 'search')
				{
					$setmodule= "overview";  // Default to overview
					$moduleName = $moduleNameSpanOpen."Overview".$moduleNameSpanClose;
				}
				else
				{
					$setmodule = $_GET['module']; // sets the module switch using the url

					$area = $_GET['module'];
					if($area == "search")
					{
						$moduleName = $moduleNameSpanOpen."Package finder".$moduleNameSpanClose;
					}

					else
					{
						$moduleName = "";
					}
				}

			}

			else if(!isset ($_GET['module']))
			{
				$setmodule= "overview";  // Default to overview
				$moduleName = "System Overview";
			}


?>


	<div id = "container">

			<div id ="content2">
					<header></header>
					<div id="data">
							<?php echo call_user_func($setmodule) ?>
					</div>

			</div>

			<!-- <?php include_once "../includes/footer.php" ?> -->
	</div>


	<script src="../includes/js/jquery.js"></script>
	<script src="../fancybox/source/jquery.fancybox.js"></script>
	<script src="../includes/js/main.js"></script>
	<script src="../includes/js/jquery.circliful.min.js"></script>


</body>

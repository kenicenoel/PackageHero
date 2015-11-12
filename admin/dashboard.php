<?php
			require_once ("../includes/dashboard_header.php");

			// checks if the url has the module switch
			if(isset ($_GET['module']))
			{

				if($_GET['module'] != 'package' && $_GET['module'] != 'search')
				{
					$setmodule= "overview";  // Default to overview
					$title = "<span class='fa fa-dashboard fa-fw'></span>Dashboard > <span id='date'>".$date = showDate()."</span>";

				}
				else
				{
					$setmodule = $_GET['module']; // sets the module switch using the url

					$area = $_GET['module'];
					if($area == "search")
					{
						$title = "<button class='back-button'><i class='fa fa-chevron-left fa-fw'></i></button><i class='fa fa-search fa-fw'></i>Package search. Enter all or part of a tracking number then 'FIND'";
					}

					else
					{
						// $title = "<button class='back-button'><i class='fa fa-chevron-left fa-fw'></i></button><span class='fa fa-dashboard fa-fw'><span class='fa fa-dashboard fa-fw'></span>Dashboard > <span id='date'>".$date = showDate()."</span>";
					}
				}

			}

			else if(!isset ($_GET['module']))
			{
				$setmodule= "overview";  // Default to overview
				$title = "<span class='fa fa-dashboard fa-fw'></span>Dashboard > <span id='date'>".$date = showDate()."</span>";

			}


?>


	<div id = "container">

			<div id ="content2">
				<div id="page-title">
					<header class="titleheading"><?php echo $title; ?> </header>
				</div>
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

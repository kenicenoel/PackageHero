<?php

session_start();

if(!isset($_SESSION['id']) && !isset($_SESSION['username']))
{
	header('Location: ../index.php');
	exit();
}

require_once ("../includes/dashboard_header.php");

?>
		<div id ="content2">

							<div id="data">
									<?php echo call_user_func($setmodule) ?>
							</div>

			</div>



</div>
<div class="loader">

</div>
</body>
<script src="../includes/js/jquery.js"></script>
<script src="../includes/js/jquery-ui.min.js"></script>
<script src="../fancybox/source/jquery.fancybox.js"></script>
<script src="../includes/js/main.js"></script>


<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="../includes/js/weeklyReportGraph.js"></script>
<script src="../includes/js/donutGraph.js"></script>
</html>

<?php
/*
Check to see is a successful login
*/
session_start();
//print_r($_SESSION);
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
</body>
</html>

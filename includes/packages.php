<?php require_once "../includes/system_header.php" ?>

	<div id = "container">


	<section id ="content2">

			<form id="filter" class="card" method = "post" action = "results.php">
				<header class="subheading"><span class="fa fa-search fa-fw"></span>Find a listing</header>
				<p>Customize your search with filters and then click find to filter listings.</p>
				<p class="subheading"><span class="fa fa-globe fa-fw"></span>Location &amp; Price</p>

				<header><span class="fa fa-area-chart fa-fw"></span> Oasis Dashboard > <?php echo $moduleName ?></header>
				<div id="data">
					<?php call_user_func($setmodule) ?> <!-- calls the appropriate function  based on the set module-->
				</div>

	</section>


</div>




<script type="text/javascript" src="../fancybox/source/jquery.fancybox.js"></script>
<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-media.js"></script>
<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>
</body>
<?php include_once "../includes/system_footer.php" ?>

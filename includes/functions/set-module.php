<?php
// checks if the url has the module switch
if(isset ($_GET['module']))
{

  if($_GET['module'] != 'package' && $_GET['module'] != 'search' && $_GET['module'] != 'user')
  {
    $setmodule= "overview";  // Default to overview
    $title = "<span class='fa fa-calendar fa-fw'></span><span id='date'>".$date = showDate()."</span>";

  }
  else
  {
    $setmodule = $_GET['module']; // sets the module switch using the url

    $area = $_GET['module'];
    
  }

}

else if(!isset ($_GET['module']))
{
  $setmodule= "overview";  // Default to overview
  $title = "<span class='fa fa-calendar fa-fw'></span><span id='date'>".$date = showDate()."</span>";

}





 ?>

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

    $module = $_GET['module'];
    if($module =='search')
    {
      $title = "Lookup any package";
    }


  }

}

else if(!isset ($_GET['module']))
{
  $setmodule= "overview";  // Default to overview
  $title = "<span class='fa fa-calendar fa-fw'></span><span id='date'>".$date = showDate()."</span>";
  
}

if(isset ($_GET['trackingnumber']))
{
  $title = "Viewing issue ". $_GET['trackingnumber'];
}

if($_SERVER['REQUEST_URI'] =="/packagehero/includes/allpackages.php")
{
  $title = "View a list of all current issues";
}






 ?>


<!-- This field is responsible for loading all the session varibales to allow for cleaner code -->
<?php
  include_once ('../includes/functions/countavailableissues.php');
  session_start();
  $role = $_SESSION['role'];
  $issueCount = $_SESSION['availableIssuesCount'];
  $country = $_SESSION['country'];
  $id = $_SESSION['id'];
  $user = $_SESSION['username'];
  $agent = $_SESSION['agent'];
  $totalAvailable = countTotalAvailableIssues();
  $userCountryImage="";

  if($country == "Grenada")
  {
    $userCountryImage = "<img class='countryImage' src ='../images/flags/grenada.png' />";
  }

  else if($country == "Trinidad")
    {
      $userCountryImage = "<img class='countryImage' src ='../images/flags/trinidad.png' />";
    }

    else if($country == "United States")
      {
        $userCountryImage = "<img class='countryImage' src ='../images/flags/unitedstates.png' />";
      }

      else if($country == "Guyana")
        {
          $userCountryImage = "<img class='countryImage' src ='../images/flags/guyana.png' />";
        }

        else if($country == "Dominica")
          {
            $userCountryImage = "<img class='countryImage' src ='../images/flags/dominica.png' />";
          }

          else if($country == "St Lucia")
            {
              $userCountryImage = "<img class='countryImage' src ='../images/flags/stlucia.png' />";
            }

            else if($country == "Jamaica")
              {
                $userCountryImage = "<img class='countryImage' src ='../images/flags/jamaica.png' />";
              }

              else if($country == "Antigua")
                {
                  $userCountryImage = "<img class='countryImage' src ='../images/flags/antigua.png' />";
                }


 ?>

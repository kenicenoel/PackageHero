
<!-- This fiel is responsible for loading all the session varibales to allow for cleaner code -->
<?php
  session_start();
  $role = $_SESSION['role'];
  $issueCount = $_SESSION['availableIssuesCount'];
  $country = $_SESSION['country'];
  $id = $_SESSION['id'];
  $user = $_SESSION['username'];
  $agent = $_SESSION['agent'];



 ?>

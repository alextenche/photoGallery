<?php 

require_once('../includes/initialize.php');


// include('layouts/header.php'); 

$user = new User();
$user->username = "Alexone";
$user->password = "pass";
$user->first_name = "Alexone";
$user->last_name = "Alexone";
$user->create();

// include('layouts/footer.php'); 
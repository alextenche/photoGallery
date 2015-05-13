<?php require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
 	redirect_to("login.php"); 
 }

// must have an id
if( empty($_GET['id']) ) {
	$session->message("No user id was provided.");
	redirect_to('index.php');
}

$user = User::find_by_id($_GET['id']);
//var_dump($user);
//die();

if($user && $user->delete()) {
	//$session->message("The photo {$photo->filename} was deleted.");
	$session->logout();
    redirect_to('index.php');
} else {
    $session->message("The user could not be deleted.");
    redirect_to('settings.php');
}  

if(isset($database)) { $database->close_connection(); }
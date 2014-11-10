<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php include_layout_template('admin_header.php');?>
<?php

	$user = new User();
	$user->username ="johnsmith";
	$user->password ="password";
	$user->first_name ="john";
	$user->last_name ="smith";
	$user->create();
	
	/*$user = User::find_by_id(2);
	$user->password = "pass";
	$user->save();*/
	
	$user = User::find_by_id(3);
	$user->delete();
	echo $user->first_name;

?>
	
<?php include_layout_template('admin_footer.php');?>
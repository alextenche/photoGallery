<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php include_layout_template('admin_header.php');?>
<?php

	/*$user = new User();
	$user->username ="blade";
	$user->password ="matrix";
	$user->first_name ="blade";
	$user->last_name ="daywalker";
	$user->create();*/
	
	
	
	/*$user = User::find_by_id(4);
	$user->password = "pass";
	$user->update();
	echo "updated user";*/
	
	
	$user = User::find_by_id(4);
	$user->delete();
	echo $user->first_name;

?>
	
<?php include_layout_template('admin_footer.php');?>
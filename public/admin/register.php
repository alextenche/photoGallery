<?php 

require_once('../../includes/initialize.php');

if ( !$session->is_logged_in() ) {
	redirect_to("login.php"); 
}?>

<?php include_layout_template('admin_header.php'); ?>
	
	<div class="container">

		<h2>Menu</h2>	
		<hr>

		<a href="list_photos.php" class="btn btn-primary btn-lg btn-success"> List Photos </a>
		<br><br>
		<a href="logfile.php" class="btn btn-primary btn-lg btn-info"> View Log file </a>
		<br><br>
		<a href="logout.php" class="btn btn-primary btn-lg btn-danger"> Logout </a>
		<br><br>

		

		<?php echo output_message($message); ?>

	</div>

<?php include_layout_template('admin_footer.php'); ?>
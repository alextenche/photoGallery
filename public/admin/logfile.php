<?php 

require_once("../../includes/initialize.php");

if ( !$session->is_logged_in() ) {
    redirect_to("login.php"); 
}

$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
  
if(isset($_GET['clear']) && $_GET['clear'] == 'true') {
	file_put_contents($logfile, '');
	// Add the first log entry
	log_action('Logs Cleared', "by User ID {$session->user_id}");
    // redirect to this same page so that the URL won't have "clear=true" anymore
    redirect_to('logfile.php');
}?>

<?php include_layout_template('admin_header.php'); ?>

<div class="container">

    <h2>Log File</h2>
    <hr>

    <?php if( file_exists($logfile) && is_readable($logfile) && $handle = fopen($logfile, 'r') ) : ?>
        <ul class="log-entries">
	        <?php while( !feof($handle) ) : 
		        $entry = fgets($handle);
		        if( trim($entry) != "" ) : ?>
			        <li><?php echo $entry; ?></li>
		        <?php endif; ?>
	        <?php endwhile; ?>
        </ul>
        <?php fclose($handle); ?>
    <?php else : ?>
        <p>Could not read from <?php echo $logfile; ?></p>
    <?php endif; ?>

    <button class="btn btn-danger"><a href="logfile.php?clear=true"> Clear log file </a></button>
    <button class="btn btn-info"><a href="index.php"> Back </a></button>
    <br><br>

</div><!-- end container -->

<?php include_layout_template('admin_footer.php'); ?>
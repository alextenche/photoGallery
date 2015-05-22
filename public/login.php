<?php 

require_once('../includes/initialize.php');

$pageTitle = "photoGallery - login";
$section = "login";

if( $session->is_logged_in() ) {
	redirect_to("index.php");
}

// Form has been submitted.
if (isset($_POST['submit'])) { 

	$email = trim($_POST['email']);
	$password = md5(trim($_POST['password']));

	// Check database to see if username/password exist.
	$found_user = User::authenticate($email, $password);
	
	if ($found_user) {
		$session->login($found_user);
		log_action('Login', "{$found_user->username} logged in.");
		redirect_to("index.php");
	} else {
		// username/password combo was not found in the database
		$error = "email/password combination was incorrect.";
	}
} else { // Form has not been submitted.
	$email = "";
	$password = "";
}?>

<?php include('layouts/header.php'); ?>

<div class="container">

	<form class="form-horizontal" action="login.php" method="post">

		<fieldset>
			<legend> Login </legend>

			<?php if(isset($error) && $error != ""){
            	echo '<div class="form-group">';
            	echo '<label for="error" class="col-sm-2 control-label"></label>';
                echo '<div class="col-sm-10 alert alert-danger" role="alert">';
                echo $error;
                $error = "";
                echo '</div>';
                echo '</div>';
            }?>

			<div class="form-group">
				<label for="inputEmail" class="col-lg-2 control-label">Email</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" name="email" maxlength="30" id="inputEmail" 
						value="" placeholder="Email">
				</div>
			</div>

			<div class="form-group">
				<label for="inputPassword" class="col-lg-2 control-label">Password</label>
				<div class="col-lg-10">
					<input type="password" class="form-control" id="inputPassword" name="password" maxlength="30" 
						value="" placeholder="Password">
				</div>
			</div>
	
			<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
					<button type="reset" class="btn btn-danger"> Cancel </button>
					<button type="submit" name="submit" class="btn btn-success"> Log In </button>
				</div>
			</div>

		</fieldset>

	</form><!-- end form -->

	<?php //echo output_message($message); ?>
	
</div><!-- end container -->

<?php include_layout_template('footer.php'); ?>
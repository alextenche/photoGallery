<?php 

require_once('../includes/initialize.php');

if ( $session->is_logged_in() ) {
	redirect_to("index.php"); 
}

$pageTitle = "photoGallery - signup";
$section = "signup"; 

// if signup form has been submitted
if (isset($_POST['submit'])) { 

	$username = trim($_POST['username']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);

	// Check database to see if username/password exist.
	$found_user = User::authenticate($username, $password);
	
	if ($found_user) {
		$error ="User already exists";
	} else {
		$user = new User();
		$user->username = $username;
		$user->email = $email;
		$user->password = $password;
		$user->create();
		$message ="User signed up successful";
	}
} else { // Form has not been submitted.
	$username = "";
	$email = "";
	$password = "";
}?>

<?php include('layouts/header.php'); ?>

<div class="container">

	<form class="form-horizontal" action="signup.php" method="post">

		<fieldset>
			<legend> Signup </legend>

			<?php if(isset($message) && $message != ""){
				echo '<div class="form-group">';
				echo '<label for="message" class="col-sm-2 control-label"></label>';
                echo '<div class="col-sm-10 alert alert-success" role="alert">';
                echo $message;
                $message = "";
                echo '</div>';
                echo '</div>';
            }?>

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
				<label for="inputName" class="col-sm-2 control-label"> Name </label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="username" maxlength="30" id="inputEmail" 
						value="<?php echo htmlentities($username); ?>" placeholder="your name">
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail" class="col-sm-2 control-label"> Email </label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="email" maxlength="30" id="inputEmail" 
						value="<?php echo htmlentities($email); ?>" placeholder="email address">
				</div>
			</div>

			<div class="form-group">
				<label for="inputPassword" class="col-lg-2 control-label"> Password </label>
				<div class="col-lg-10">
					<input type="password" class="form-control" id="inputPassword" name="password" maxlength="30" 
						value="<?php echo htmlentities($password); ?>" placeholder="password">
				</div>
			</div>

			<!--<div class="form-group">
				<label for="inputPassword" class="col-lg-2 control-label"> Confirm Password </label>
				<div class="col-lg-10">
					<input type="password" class="form-control" id="inputPassword" name="cpassword" maxlength="30" 
						value="<?php //echo htmlentities($cpassword); ?>" placeholder="retype password">
				</div>
			</div>-->
	
			<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
					<button type="reset" class="btn btn-danger"> Cancel </button>
					<button type="submit" name="submit" class="btn btn-success"> Sign Up </button>
				</div>
			</div>

		</fieldset>

	</form><!-- end form -->

	<?php //echo output_message($message); ?>
	
</div><!-- end container -->

<?php include('layouts/footer.php'); ?>
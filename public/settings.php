<?php 

require_once('../includes/initialize.php');

if ( !$session->is_logged_in() ) {
	redirect_to("login.php"); 
}

$pageTitle = "photoGallery - settings";
$section = "settings";

$user = User::find_by_id($session->user_id);

// if signup form has been submitted
if (isset($_POST['submit'])) { 

	// check name
    if( isset($_POST['username']) && !empty($_POST['username']) ){ 
        $username = trim($_POST['username']);

        // check password
    	if( isset($_POST['password']) && !empty($_POST['password']) ){ 
        	$password = trim($_POST['password']);

        	//$user = new User();
			$user->username = $username;
			$user->password = $password;
			$user->update();
			$message ="User profile updated successfuly";

        // if missing password, display error	
    	} else {
        	$error ="please insert a password";
    	}

    // if missing client name, display error
    } else {
        $error ="please insert a username";
    }

// Form has not been submitted.
} else { 
	$username = "";
	$email = "";
	$password = "";
}?>

<?php include('layouts/header.php'); ?>

<div class="container">

	<form class="form-horizontal" action="settings.php" method="post">

		<fieldset>
			<legend> <span class="glyphicon glyphicon-user"></span> &nbsp;Settings </legend>

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
						value="<?php echo $user->username; ?>" placeholder="your name">
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail" class="col-sm-2 control-label"> Email </label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="email" maxlength="30" id="inputEmail" 
						value="<?php echo $user->email; ?>" placeholder="email address" readonly>
				</div>
			</div>

			<div class="form-group">
				<label for="inputPassword" class="col-lg-2 control-label"> Password </label>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="inputPassword" name="password" maxlength="30" 
						value="<?php echo $user->password; ?>" placeholder="password">
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
					<a class="btn btn-danger" href="delete_user.php?id=<?php echo $user->id; ?>"> Delete account </a>
				</div>
			</div>

			<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
					<button type="reset" class="btn btn-default"> Cancel </button>
					<button type="submit" name="submit" class="btn btn-success"> Update Settings </button>
				</div>
			</div>

		</fieldset>

	</form><!-- end form -->

	<?php //echo output_message($message); ?>
	
</div><!-- end container -->

<?php include('layouts/footer.php'); ?>
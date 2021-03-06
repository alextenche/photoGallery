<?php 

require_once('../includes/initialize.php');

if ( $session->is_logged_in() ) {
	redirect_to("index.php"); 
}

$pageTitle = "photoGallery - signup";
$section = "signup"; 

// if signup form has been submitted
if (isset($_POST['submit'])) { 

	// check name
    if( isset($_POST['username']) && !empty($_POST['username']) ){ 
        $username = trim($_POST['username']);

        // check email
    	if( isset($_POST['email']) && !empty($_POST['email']) ){
    		$email = trim($_POST['email']);

        	// check database to see if email already in use.
			$found_email = User::check_email( $email );

			if (!$found_email) {
				
        		// check password
    			if( isset($_POST['password']) && !empty($_POST['password']) ){ 
        			$password = trim($_POST['password']);

        			// all ok, put data into database
        			//echo "Datele din formularul clientului sunt ok <br>";
        			//echo "client_name:  " . $client_name . "<br>";
        			//echo "client_email: " . $client_email . "<br>";
        			//echo "client_password:  " . $client_password . "<br>";

        			$user = new User();
					$user->username = $username;
					$user->email = $email;
					$user->password = md5($password);
					$user->create();
					$message ="User signed up successfuly";
					$username = "";
					$email = "";
					$password = "";

        		// if missing password, display error	
    			} else {
        			$error ="please insert a password";
    			}

			// if email already exists, display error
    		} else {
				$error ="email address already in use, please insert another";
    		}     			

    	// if missing email, display error
    	} else {
        	$error ="please insert a valid email address";
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
						value="<?php if(isset($username)) {echo $username;} ?>" placeholder="your name">
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail" class="col-sm-2 control-label"> Email </label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="email" maxlength="30" id="inputEmail" 
						value="<?php if(isset($email)) {echo $email;} ?>" placeholder="email address">
				</div>
			</div>

			<div class="form-group">
				<label for="inputPassword" class="col-lg-2 control-label"> Password </label>
				<div class="col-lg-10">
					<input type="password" class="form-control" id="inputPassword" name="password" maxlength="30" 
						value="" placeholder="password">
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
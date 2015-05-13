<?php

require_once('../includes/initialize.php');

if (!$session->is_logged_in()) {
 	redirect_to("login.php"); 
 }

$pageTitle = "photoGallery - photo upload";
$section = "photoUpload";

$max_file_size = 1048576; // 10485760 =  10 MB

// form processing
if(isset($_POST['submit'])) {
	$photo = new Photograph();
	$photo->user_id = $session->user_id;
	$photo->caption = $_POST['caption'];
	$photo->attach_file($_FILES['file_upload']);
	if($photo->save()) {
		$session->message("Photograph uploaded successfully");
		redirect_to('list_photos.php');
	} else {
		$message = join("<br>", $photo->errors);
	}
}

include('layouts/header.php'); ?>

<div class="container">

	<form class="form-horizontal" action="photo_upload.php" enctype="multipart/form-data" method="post">

		<fieldset>

			<legend> photoUpload </legend>

			<?php if (output_message($message) != "") : ?>
				<div class="alert alert-info" role="alert">
					<?php echo output_message($message); ?>
				</div>
			<?php endif; ?>

			<div class="form-group">
				<label for="file" class="col-sm-2 control-label">file input</label>
				<div class="col-sm-10">
					<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>">
					<input type="file" name="file_upload">
				</div>
			</div>

			<div class="form-group">
				<label for="caption" class="col-sm-2 control-label"> photo description </label>
				<div class="col-sm-10">
					<input type="text" class="form-control" placeholder="Enter a photo description" name="caption" value="">
				</div>
			</div>

			<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
					<input class="btn btn-success" type="submit" name="submit" value="Upload">
					<a class="btn btn-danger" href="/photoGallery/public/admin/list_photos.php">Cancel</a>
				</div>
			</div>

		</fieldset>

	</form>
		
</div><!-- end container -->

<?php include('layouts/footer.php'); ?>
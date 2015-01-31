<?php require_once('../../includes/initialize.php');

if (!$session->is_logged_in()) { redirect_to("login.php"); }

$max_file_size = 1048576; // 10485760 =  10 MB

// form processing
if(isset($_POST['submit'])) {
	$photo = new Photograph();
	$photo->caption = $_POST['caption'];
	$photo->attach_file($_FILES['file_upload']);
	if($photo->save()) {
		$session->message("Photograph uploaded successfully");
		redirect_to('list_photos.php');
	} else {
		$message = join("<br>", $photo->errors);
	}
}

include_layout_template('admin_header.php'); ?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">photoUpload</h1>
	</div>

	<div class="alert alert-info" role="alert">
		<?php echo output_message($message); ?>
	</div>

	<form action="photo_upload.php" enctype="multipart/form-data" method="POST">

		<div class="form-group">
			<label for="file">file input</label>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>">
			<input type="file" name="file_upload">
		</div>
		<div class="form-group">
			<label for="caption">photo description</label>
			<input type="text" class="form-control" placeholder="Enter a photo description" name="caption" value="">
		</div>
		
		<input class="btn btn-success" type="submit" name="submit" value="Upload">
		<button class="btn btn-danger">Cancel</button>

	</form>
</div>

<?php include_layout_template('admin_footer.php'); ?>
<?php require_once("../includes/initialize.php");

if(empty($_GET['id'])) {
	$session->message("No photo ID was provided.");
	redirect_to('index.php');
}

$photo = Photograph::find_by_id($_GET['id']);

if(!$photo) {
	$session->message("The photo could not be located.");
	redirect_to('index.php');
}

if(isset($_POST['submit'])) {
	$author = trim($_POST['author']);
	$body = trim($_POST['body']);
	
	$new_comment = Comment::make($photo->id, $author, $body);
	if($new_comment && $new_comment->save()) {

		// send email
		//$new_comment->try_to_send_notification();
		
	    // Important! You could just let the page render from here. 
	    // But then if the page is reloaded, the form will try to resubmit the comment. So redirect instead:
		redirect_to("photo.php?id={$photo->id}");
	} else {
		$message = "there was an error that prevented the comment from being saved";
	}
} else {
	$author = "";
	$body = "";
}

$comments = $photo->comments();	?>

<?php include_layout_template('header.php'); ?>

<div class="container main">
	<div class="row">
		<h3><?php echo $photo->caption; ?></h3>
		<div class="thumbnail">
			<img src="<?php echo $photo->image_path(); ?>" alt="">
		</div>

		<a class="btn btn-primary" href="index.php">back to gallery</a>
		<hr>

		<!-- display comments on a photo -->
		<table class="table table-striped">
			<?php foreach($comments as $comment): ?>
				<tr>
					<td><b><?php echo htmlentities($comment->author); ?></b></td>
					<td><?php echo strip_tags($comment->body, '<strong><em><p>'); ?></td>
					<td><?php echo datetime_to_text($comment->created); ?></td>
				</tr>
			<?php endforeach; ?>
			<?php if(empty($comments)) { echo "<td>no comments</td>"; } ?>
		</table>
				
		<?php echo output_message($message); ?>

		<form action="photo.php?id=<?php echo $photo->id; ?>" method="post">
			<fieldset>
				<legend>write comment</legend>
				<div class="form-group">
					<input name="author" type="text" class="form-control" placeholder="author" value="">
				</div>

				<div class="form-group">
					<input name="body" type="text" class="form-control" placeholder="comment"  value="">
				</div>

				<input class="btn btn-success" type="submit" name="submit" value="submit comment">
				<a class="btn btn-danger" href="/photoGallery/public/admin/list_photos.php">cancel</a>
			</fieldset>
			<p><br></p>
		</form>
	</div>
</div>

<?php include_layout_template('footer.php'); ?>
<?php 

require_once("../includes/initialize.php");

if (!$session->is_logged_in()) { redirect_to("login.php"); }

if(empty($_GET['id'])) {
	$session->message("no photograph id was provided");
	redirect_to('index.php');
}
	
$photo = Photograph::find_by_id($_GET['id']);

if(!$photo) {
	$session->message("the photo could not be located");
    redirect_to('index.php');
}
$comments = $photo->comments();

$pageTitle = "photoGallery - comments";
$section = "comments";
	
include('layouts/header.php'); ?>

<div class="container main">
	<div class="row">
		<h1 class="page-header">photoComments <small> - <?php echo $photo->filename; ?></small></h1>
		

		<?php echo output_message($message); ?>

		<table class="table table-striped">
			<?php foreach($comments as $comment): ?>
				<tr>
					<td><?php echo htmlentities($comment->author); ?></td>
					<td><?php echo strip_tags($comment->body, '<strong><em><p>'); ?></td>
					<td><?php echo datetime_to_text($comment->created); ?></td>
					<td><a class="btn btn-danger" href="delete_comment.php?id=<?php echo $comment->id; ?>">delete</a></td>
				</tr>
			<?php endforeach; ?>
			<?php if(empty($comments)) { echo "<td>no comments</td>"; } ?>
		</table>
		<a class="btn btn-primary" href="list_photos.php">back</a><br>
		<p><br></p>
	</div>
</div>

<?php include('layouts/footer.php'); ?>
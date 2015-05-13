<?php 

require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
 	redirect_to("login.php"); 
}

$pageTitle = "photoGallery - photos list";
$section = "listphotos";

$photos = Photograph::find_all();

include('layouts/header.php'); ?>

<div class="container main">
	<div class="row">
		<h1 class="page-header">photoList</h1>

		<?php if (output_message($message) != "") : ?>
			<div class="alert alert-info" role="alert">
				<?php echo output_message($message); ?>
			</div>
		<?php endif; ?>

		<table class="table table-striped">
			<tr>
				<th>photo</th>
				<th>filename</th>
				<th>description</th>
				<th>size</th>
				<th>type</th>
				<th>comments</th>
				<th>&nbsp;</th>
			</tr>
			<?php foreach($photos as $photo): ?>
				<tr>
					<td><img src="../<?php echo $photo->image_path(); ?>" width="100" /></td>
					<td><?php echo $photo->filename; ?></td>
					<td><?php echo $photo->caption; ?></td>
					<td><?php echo $photo->size_as_text(); ?></td>
					<td><?php echo $photo->type; ?></td>
					<td>
						<a href="comments.php?id=<?php echo $photo->id; ?>"><?php echo count($photo->comments()) . " comments"; ?></a>
					</td>
					<td>
						<a class="btn btn-danger" href="delete_photo.php?id=<?php echo $photo->id; ?>">delete</a>
					</td>	
				</tr>
			<?php endforeach; ?>
		</table>
		<br>
		<a class="btn btn-primary" href="photo_upload.php">upload photo</a>
		<p><br></p>
	</div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
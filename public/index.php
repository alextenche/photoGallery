<?php 

require_once("../includes/initialize.php");

$pageTitle = "photoGallery";
$section = "home";

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 6;
$total_count = Photograph::count_all();

$pagination = new Pagination($page, $per_page, $total_count);

// instead of finding all records, just find the records for this page
$sql  = "SELECT * FROM photographs ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$photos = Photograph::find_by_sql($sql);
 
include('layouts/header.php'); ?>

<div class="jumbotron" id="photoBackground">
	<div class="container" >
		<h1> photoGallery </h1>
  		<!--<p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  		<p><a class="btn btn-primary btn-lg">Learn more</a></p>-->
	</div>
</div>

<div class="container main">
	<div class="row">
		<!--<h1 class="page-header">photoGallery</h1>-->

		<?php foreach($photos as $photo): ?>
			<div class="col-lg-4 col-md-4 col-xs-6 thumb">
				<a class="thumbnail"  href="photo.php?id=<?php echo $photo->id; ?>">
					<img class="img-responsive" src="<?php echo $photo->image_path(); ?>" alt="">
				</a>
				<p style="text-align:center;"><?php echo $photo->caption; ?></p>
			</div>
		<?php endforeach; ?>

		<div class="row">
			<div class="col-xs-4 col-xs-offset-5">
				<nav>
					<ul class="pagination pagination-lg">
						<?php if($pagination->total_pages() > 1) {
							for($i=1; $i <= $pagination->total_pages(); $i++) {
								if($i == $page) {
									echo '<li class="active"><a href="#">'.$i.'<span class="sr-only">(current)</span></a></li>';
								} else {
									echo '<li><a href="index.php?page='.$i.'">'.$i.'</a></li>'; 
								}
							}
						}?>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>

<?php include('layouts/footer.php'); ?>
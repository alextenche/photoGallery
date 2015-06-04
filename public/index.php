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

	<div class="row grid">
		<?php foreach($photos as $photo): ?>
			<div class="col-sm-4 col-md-3 item">
				<div class="thumbnail">
					<a href="photo.php?id=<?php echo $photo->id; ?>">
						<img src="<?php echo $photo->image_path(); ?>" alt="">
					</a>
					<div class="caption">
	             		<h4> <?php echo $photo->caption; ?> </h4>
	           		</div>
						
				</div>
			</div>
		<?php endforeach; ?>
	</div> <!-- end row -->

	<hr>

	<div class="row"> <!-- pagination row -->
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
	</div><!-- end pagination row -->

	<hr>

</div><!-- end container -->

<script type="text/javascript">

	var $grid = $('.grid').imagesLoaded( function() {
	  	// init Masonry after all images have loaded
	  	$grid.masonry({
	    	itemSelector: '.item',
	    	columnWidth: '.item'
	  	});
	});	

</script>

<?php include('layouts/footer.php'); ?>
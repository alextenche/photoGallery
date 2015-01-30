<?php 
require_once("../includes/initialize.php");

// 1. the current page number ($current_page)
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
	
// 2. records per page ($per_page)
$per_page = 6;
	
// 3. total record count ($total_count)
$total_count = Photograph::count_all();

// Find all photos
// use pagination instead
//$photos = Photograph::find_all();
	
$pagination = new Pagination($page, $per_page, $total_count);
	
// Instead of finding all records, just find the records for this page
$sql  = "SELECT * FROM photographs ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$photos = Photograph::find_by_sql($sql);
	
// Need to add ?page=$page to all links we want to maintain the current page (or store $page in $session)

include_layout_template('header.php'); ?>


<div class="row">
	<div class="col-lg-12">
        <h1 class="page-header">photoGallery</h1>
    </div>
		
	<?php foreach($photos as $photo): ?>
		<div class="col-lg-4 col-md-4 col-xs-6 thumb">
           	<a class="thumbnail"  href="photo.php?id=<?php echo $photo->id; ?>">
                <img class="img-responsive" src="<?php echo $photo->image_path(); ?>" alt="">
            </a>
            <p style="text-align:center;"><?php echo $photo->caption; ?></p>
  		</div>
	<?php endforeach; ?>

	<div class="row">
		<div class="col-xs-4 col-xs-offset-5" id="pagination">
		<nav>
		<ul class="pagination">
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

<?php include_layout_template('footer.php'); ?>
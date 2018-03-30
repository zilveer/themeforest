<?php
$page_category = get_post_meta(get_the_ID(),'cs_portfolio_category',true);
$masonry_filter = get_post_meta(get_the_ID(),'cs_page_masonry_filter',true);
if ($page_category == "") {
    $args = array(
        'parent' => 0
    );
    $categories = get_terms('portfolio_category',$args);
} else {
	$page_category = explode(',', $page_category);
	if(is_array($page_category)){
		$cats = $page_category;
		$categories = array();
		foreach ($cats as $key => $value) {
			$cat = get_term($value,'portfolio_category');
			$categories[$key] = new stdClass();
			$categories[$key]->slug = $cat->slug; 
			$categories[$key]->name = $cat->name; 
		}
	}
	else{
		$args = array(
	        'parent' => $page_category
	    );
	    $categories = get_terms('portfolio_category', $args );
	}
    
}
if ($masonry_filter && count($categories) > 0) {	?>
		
			<div class="filter_outer">
				<div class="filter_holder container">
					<ul>
						<li class="filter active" data-filter="*"><span><?php _e('All', THEMENAME); ?></span></li>
						<?php foreach ($categories as $category) { ?>
							 <li class="filter" data-filter="<?php echo ".category-" . $category->slug; ?>"><span><?php echo $category->name; ?></span></li>
						<?php } ?>
					</ul>
				</div>
			</div>

      <?php  }
?>

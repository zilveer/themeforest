<?php 
	// RELATED PORTFOLIO
	global $flatsome_opt;
	$get_cat = get_the_terms( get_the_ID(), 'featured_item_category', '', ', ', '' );

	$category = '';
	if($get_cat) $category = current($get_cat)->slug;
	echo do_shortcode('<div class="portfolio-related mt">[featured_items_slider class="portfolio-related" cat="'.$category.'"]</div>');
?>
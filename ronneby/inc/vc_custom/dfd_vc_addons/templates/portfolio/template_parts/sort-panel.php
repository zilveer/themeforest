<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if($items != 'single') {
	$taxonomy = 'my-product_category';
	/*
	if (isset($post_categories_array) && $post_categories_array) {
		$include_cats = array();
		foreach($post_categories_array as $cat) {
			$exclude_cat = get_term_by('slug', $cat, 'my-product_category');
			$include_cats[] = $exclude_cat->term_id;
		}
		$categories = get_terms($taxonomy, array('include' => $include_cats));
	} else {
	}
	*/
	$categories = get_terms($taxonomy);
	
	echo '<div class="clearfix">';
		echo '<div class="sort-panel '.esc_attr($sort_alignment).'">';
			echo '<ul class="filter">';
				echo '<li class="active"><a data-filter=".project" href="#">'. __('All', 'dfd') .'</a></li>';
				foreach ($categories as $category) {
					echo '<li><a data-filter=".project[data-category~=\'' . strtolower(preg_replace('/\s+/', '-', $category->slug)) . '\']" href="#">' . $category->name . '</a></li>';
				}
			echo '</ul>';
		echo '</div>';
	echo '</div>';
}
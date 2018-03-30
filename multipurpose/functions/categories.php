<?php

function get_subcat_list($id) {
	$options = array(
		'orderby' => 'name',
		'hierarchical' => 0,
		'child_of' => $id
		);
	$cats = get_categories($options);
	$catLinks = array();
	foreach($cats as $cat) {
		$catLinks[] = '<a href="'. get_category_link($cat->term_id) .'">' . $cat->name . '</a>';
	}
	return implode(", ", $catLinks);
}
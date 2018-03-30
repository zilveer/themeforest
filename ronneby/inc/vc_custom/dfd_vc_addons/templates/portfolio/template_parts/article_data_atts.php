<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
//if($sort_panel) {
	$article_data_atts = '';
	$terms = get_the_terms(get_the_ID(), 'my-product_category');

	$article_data_atts .= 'data-category="';
	if($terms && !empty($terms) && is_array($terms)) {
		foreach ($terms as $term) {
			$article_data_atts .= ' ' . strtolower(preg_replace('/\s+/', '-', $term->slug)) . ' ';
		}
	}
	$article_data_atts .= '"';
//}
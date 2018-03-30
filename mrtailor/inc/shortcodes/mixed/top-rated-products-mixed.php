<?php

// [top_rated_products_mixed]
function shortcode_top_rated_products_mixed($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' => '',
		'per_page'  => '12',
		'columns'  => '4',
        'orderby' => 'date',
        'order' => 'desc',
		'layout'  => 'listing',
	), $atts));
	ob_start();

    if ($layout == "listing") {
		if ($title != '') {
			echo '<h3 class="shortcode_title">' . $title . '</h3>';
		}
		echo do_shortcode('[top_rated_products per_page="'.$per_page.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'"]');
	} else {
		echo do_shortcode('[top_rated_products_slider per_page="'.$per_page.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'"]');
	}

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("top_rated_products_mixed", "shortcode_top_rated_products_mixed");
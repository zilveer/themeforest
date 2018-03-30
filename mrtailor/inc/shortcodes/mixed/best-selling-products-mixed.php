<?php

// [best_selling_products_mixed]
function shortcode_best_selling_products_mixed($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' => '',
		'per_page'  => '12',
		'columns'  => '4',
		'layout'  => 'listing'
	), $atts));
	ob_start();

    if ($layout == "listing") {
		if ($title != '') {
			echo '<h3 class="shortcode_title">' . $title . '</h3>';
		}
		echo do_shortcode('[best_selling_products per_page="'.$per_page.'" columns="'.$columns.'"]');
	} else {
		echo do_shortcode('[best_selling_products_slider per_page="'.$per_page.'" columns="'.$columns.'"]');
	}

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("best_selling_products_mixed", "shortcode_best_selling_products_mixed");
<?php

// [best_selling_products_mixed]
function shortcode_best_selling_products_mixed($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => 'Best Selling Products',
		'per_page'  => '12',
		'layout'  => 'slider'
	), $atts));
	ob_start();

    if ($layout == "listing") {
		if ($title != '') {
			echo '<h3 class="shortcode_title">' . $title . '</h3>';
		}
		echo do_shortcode('[best_selling_products per_page="'.$per_page.'"]');
	} else {
		echo do_shortcode('[custom_best_sellers title="'.$title.'" per_page="'.$per_page.'"]');
	}

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("best_selling_products_mixed", "shortcode_best_selling_products_mixed");
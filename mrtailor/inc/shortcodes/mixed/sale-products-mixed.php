<?php

// [sale_products_mixed]
function shortcode_sale_products_mixed($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' => '',
		'per_page'  => '12',
		'columns'  => '4',
		'layout'  => 'listing',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();

    if ($layout == "listing") {
		if ($title != '') {
			echo '<h3 class="shortcode_title">' . $title . '</h3>';
		}
		echo do_shortcode('[sale_products per_page="'.$per_page.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'"]');
	} else {
		echo do_shortcode('[sale_products_slider per_page="'.$per_page.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'"]');
	}

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("sale_products_mixed", "shortcode_sale_products_mixed");
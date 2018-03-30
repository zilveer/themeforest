<?php

// [product_attribute_mixed]
function shortcode_product_attribute_mixed($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' => '',
		'attribute' => '',
		'filter' => '',
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
		echo do_shortcode('[product_attribute attribute="'.$attribute.'" filter="'.$filter.'" per_page="'.$per_page.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'"]');
	} else {
		echo do_shortcode('[product_attribute_slider attribute="'.$attribute.'" filter="'.$filter.'" per_page="'.$per_page.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'"]');
	}

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("product_attribute_mixed", "shortcode_product_attribute_mixed");
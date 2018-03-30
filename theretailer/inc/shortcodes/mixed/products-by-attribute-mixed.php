<?php

// [products_by_attribute_mixed]
function shortcode_products_by_attribute_mixed($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' => '',
		'attribute' => '',
		'filter' => '',
		'per_page'  => '12',
        'orderby' => 'date',
        'order' => 'desc',
		'layout'  => 'slider',
	), $atts));
	ob_start();

    if ($layout == "listing") {
		if ($title != '') {
			echo '<h3 class="shortcode_title">' . $title . '</h3>';
		}
		echo do_shortcode('[product_attribute attribute="'.$attribute.'" filter="'.$filter.'" per_page="'.$per_page.'" orderby="'.$orderby.'" order="'.$order.'"]');
	} else {
		echo do_shortcode('[custom_product_attribute title="'.$title.'" attribute="'.$attribute.'" filter="'.$filter.'" per_page="'.$per_page.'" orderby="'.$orderby.'" order="'.$order.'"]');
	}

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("products_by_attribute_mixed", "shortcode_products_by_attribute_mixed");
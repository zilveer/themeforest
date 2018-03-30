<?php

// [products_mixed]
function shortcode_products_mixed($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => 'Products',
		'layout'  => 'slider',
        'orderby' => 'date',
        'order' => 'desc',
		'ids' => ''
	), $atts));
	ob_start();

    if ($layout == "listing") {
		if ($title != '') {
			echo '<h3 class="shortcode_title">' . $title . '</h3>';
		}
		echo do_shortcode('[products orderby="'.$orderby.'" order="'.$order.'" ids="'.$ids.'"]');
	} else {
		echo do_shortcode('[custom_products title="'.$title.'" orderby="'.$orderby.'" order="'.$order.'" ids="'.$ids.'"]');
	}

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("products_mixed", "shortcode_products_mixed");
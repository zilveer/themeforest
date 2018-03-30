<?php

// [recent_products_mixed]
function shortcode_recent_products_mixed($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => 'Recent Products',
		'per_page'  => '12',
		'layout'  => 'slider',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();

    if ($layout == "listing") {
		if ($title != '') {
			echo '<h3 class="shortcode_title">' . $title . '</h3>';
		}
		echo do_shortcode('[recent_products per_page="'.$per_page.'" orderby="'.$orderby.'" order="'.$order.'"]');
	} else {
		echo do_shortcode('[custom_latest_products title="'.$title.'" per_page="'.$per_page.'" orderby="'.$orderby.'" order="'.$order.'"]');
	}

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("recent_products_mixed", "shortcode_recent_products_mixed");
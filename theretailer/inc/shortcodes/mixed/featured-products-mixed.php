<?php

// [featured_products_mixed]
function shortcode_featured_products_mixed($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => 'Featured Products',
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
		echo do_shortcode('[featured_products per_page="'.$per_page.'" orderby="'.$orderby.'" order="'.$order.'"]');
	} else {
		echo do_shortcode('[custom_featured_products title="'.$title.'" per_page="'.$per_page.'" orderby="'.$orderby.'" order="'.$order.'"]');
	}

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("featured_products_mixed", "shortcode_featured_products_mixed");
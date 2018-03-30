<?php

// [sale_products_mixed]
function shortcode_sale_products_mixed($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => 'Sales',
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
		echo do_shortcode('[sale_products per_page="'.$per_page.'" orderby="'.$orderby.'" order="'.$order.'"]');
	} else {
		echo do_shortcode('[custom_on_sale_products title="'.$title.'" per_page="'.$per_page.'" orderby="'.$orderby.'" order="'.$order.'"]');
	}

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("sale_products_mixed", "shortcode_sale_products_mixed");
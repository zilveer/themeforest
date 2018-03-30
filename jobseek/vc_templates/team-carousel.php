<?php

/* Logo Carousel 
-------------------------------------------------------------------------------------------------------------------*/

if ( !function_exists( 'logo_carousel' ) ) {
    function logo_carousel($atts, $content = null) {
 
		extract(shortcode_atts(array(
			'columns'  => '',
		    'autoplay' => '',
		    'el_class' => '',
		), $atts));

		if( !empty($el_class) ) $el_class = ' ' . $el_class;

		if( !empty($autoplay) ) $autoplay = ' data-autoplay="' . $autoplay . '"';

		$output = '<div class="logo-carousel owl-carousel' . $el_class . '" data-columns="' . $columns . '"' . $autoplay . '>' . wpb_js_remove_wpautop($content) . '</div>';

		return $output;

	}
}

add_shortcode('logo_carousel', 'logo_carousel');
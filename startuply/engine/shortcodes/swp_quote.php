<?php

/*-----------------------------------------------------------------------------------*/
/*	Quote Shortcode Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map(array(
				"name" => __("Quote", "vivaco"),
				"weight" => 16,
				"base" => "vsc-quote",
				"icon" => "icon-quote",
				"description" => "A dose of inspiration for visitors",
				"class" => "quote_extended",
				"category" => __("Content", "vivaco"),
				"params" => array(
					array(
						"type" => "textarea",
						"class" => "",
						"admin_label" => true,
						"heading" => __("Quote text", "vivaco"),
						"param_name" => "text"
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Quote Author", "vivaco"),
						"param_name" => "author"
					)
				)
			));





/*-----------------------------------------------------------------------------------*/
/*	Quote Shortcode Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_quote_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'text' => '',
		'author' => ''
	), $atts));

	$output = '';

	$output .= '<div class="single-quote">';
	$output .= '<blockquote>"' . $text . '"</blockquote>';
	$output .= '<span class="quote-author">' . $author . '</span>';
	$output .= '</div>';

	return $output;
}

add_shortcode('vsc-quote', 'vsc_quote_shortcode');

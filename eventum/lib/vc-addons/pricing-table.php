<?php
add_shortcode( 'themeum_pricing_table', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'title' 						=> '',
		'price' 						=> '',
		'duration' 						=> '',
		'pricing_content' 				=> '',
		'button_text' 					=> '',
		'button_url' 					=> '',
		'btn_bg' 						=> '',
		'btn_color' 					=> '',
		'alignment' 					=> 'center',
		'background' 					=> '',
		'background_image' 				=> '',
		'background_transparency' 		=> 1,
		'color' 						=> '',
		'featured' 						=> '',
		'class' 						=> '',
		), $atts));

	$style = '';
	$btn_style = '';
	 $src_image   = wp_get_attachment_image_src($background_image, 'full'); 

	if($background_transparency=='') $background_transparency = 1;

	if($background) $style .= 'background-color:' . pricing_themeumrgba($background, $background_transparency). ';';
	if($background_image) $style .= 'background-image: url(' . $src_image[0] . ');';

       


	if($color) $style .= 'color:' . esc_attr( $color ) . ';';

	if($alignment) $align = 'style="text-align:'. esc_attr( $alignment ) .'";';

	if($alignment) {
		$output  = '<div class="themeum-addon-pricing-table ' . esc_attr( $class ) . '" '.$align.'>';
	} else {
		$output  = '<div class="themeum-addon-pricing-table ' . esc_attr( $class ) . '">';
	}
	
	
	$output .= '<div style="' . $style . '" class="themeum-pricing-box '. esc_attr( $featured ) .'">';
	$output .= '<div class="sppb-pricing-header">';
	if($price) $output .= '<span class="sppb-pricing-price">' . esc_attr( $price ) . '</span>';
	if($duration) $output .= '<span class="sppb-pricing-duration">' . esc_attr( $duration ) . '</span>';
	if($title) $output .= '<div class="sppb-pricing-title">' . esc_html( $title ) . '</div>';
	$output .= '</div>';

	if($pricing_content) {
		$output .= '<div class="sppb-pricing-features">';
		$output .= '<ul>';

		$features = explode("\n", $pricing_content);

		foreach ($features as $feature) {
			$output .= '<li>' . $feature . '</li>';
		}
		
		$output .= '</ul>';
		$output .= '</div>';
	}
	if ($button_url) {
		if($btn_bg) $btn_style .= 'background-color:' . esc_attr( $btn_bg ). ';';
		if($btn_color) $btn_style .= 'color:' . esc_attr( $btn_color ) . ';';
		$output .= '<div class="sppb-pricing-footer">';
		$output .= '<a href="' . $button_url . '" class="btn pricing-btn" style="'.$btn_style.'">'. esc_html( $button_text ) .'</a>';
		$output .= '</div>';
	}


	$output .= '</div>';
	
	$output .= '</div>';

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => esc_html__("Themeum Pricing Table", 'eventum'),
		"base" => "themeum_pricing_table",
		'icon' => 'icon-thm-pricing-table',
		"class" => "",
		"description" => esc_html__("Widget Title Heading", 'eventum'),
		"category" => esc_html__('Themeum', 'eventum'),
		"params" => array(
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Alignment", 'eventum'),
				"param_name" => "alignment",
				"value" => array('Text Center'=>'center','Text Left'=>'left','Text Right'=>'right'),
			),	
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", 'eventum'),
				"param_name" => "title",
				"value" => "",
				"admin_label"=>true,
				),

			array(
				"type" => "textfield",
				"heading" => esc_html__("Price", 'eventum'),
				"param_name" => "price",
				"value" => "$9",
				"admin_label"=>true
				),			

			array(
				"type" => "textfield",
				"heading" => esc_html__("Price Duration", 'eventum'),
				"param_name" => "duration",
				"value" => "Month",
				"admin_label"=>true
				),

			array(
				"type" => "textarea",
				"heading" => esc_html__("Pricing Content", 'eventum'),
				"param_name" => "pricing_content",
				"value" => ""
				),

			array(
				"type" => "textfield",
				"heading" => esc_html__("Button URL", 'eventum'),
				"param_name" => "button_url",
				"value" => ""
				),

			array(
				"type" => "textfield",
				"heading" => esc_html__("Button Text", 'eventum'),
				"param_name" => "button_text",
				"value" => ""
				),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Button Color", 'eventum'),
				"param_name" => "btn_color",
				"value" => "",
				),				

			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Button Background", 'eventum'),
				"param_name" => "btn_bg",
				"value" => "",
				),	


			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Body Color", 'eventum'),
				"param_name" => "color",
				"value" => "",
				),				

			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Body Background", 'eventum'),
				"param_name" => "background",
				"value" => "",
				),	
			array(
				"type" => "attach_image",
				"heading" => esc_html__("Body Background Image", 'eventum'),
				"param_name" => "background_image",
				"value" => "",
				),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Background Transparency", 'eventum'),
				"param_name" => "background_transparency",
				"value" => ""
				),

			array(
				"type" => "checkbox",
				"heading" => esc_html__("Featured", 'eventum'),
				"param_name" => "featured",
				"value" => Array(esc_html__("Featured", 'eventum') => "featured")
				),

			)
		));
}



function pricing_themeumrgba($hex, $opacity) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }

   $rgb = array($r, $g, $b);

   return 'rgba(' . implode(",", $rgb) . ', ' . $opacity . ')';
}

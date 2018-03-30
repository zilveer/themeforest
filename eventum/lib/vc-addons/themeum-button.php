<?php
add_shortcode( 'themeum_button', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'position'				=> 'left',
		'display'				=> 'block',
		'btn_link' 				=> '',
		'btn_name'		 		=> '',
		'target'		 		=> '_blank',
		'btn_text_size'			=> '',
		'btn_color' 			=> '',
		'btn_color_hover' 		=> '',
		'btn_background' 		=> '',
		'btn_background_hover' 	=> '',
		'border_radius' 		=> '',
		'btn_weight' 			=> '300',
		'btn_margin' 			=> '',
		'btn_padding' 			=> '',
		'class' 				=> '',
		), $atts));

	$style = '';
	$align = '';
	if($position) $align .= 'text-align:'. esc_attr( $position ) .';';
	if($display) $align .= 'display:'. esc_attr( $display ) .';';

	if($btn_text_size) $style .= 'font-size:' . (int) esc_attr($btn_text_size) . 'px;line-height:'. (int) esc_attr($btn_text_size)  .'px;';

	if($btn_color) $style .= 'color:' . esc_attr($btn_color)  . ';';

	if($btn_background) $style .= 'background:' . esc_attr($btn_background)  . ';';

	if($border_radius) $style .= 'border-radius:' . (int) esc_attr($border_radius)  . 'px;';
	
	if($btn_weight) $style .= 'font-weight:'. esc_attr($btn_weight) .';';

	if($btn_margin) $style .= 'margin:' . esc_attr($btn_margin)  . ';';

	if($btn_padding) $style .= 'padding:' . esc_attr($btn_padding)  . ';display:inline-block';


	$output = '';

        if ($btn_link)
        {
        	$output .=  '<div class="themeum-button '.esc_attr($class).'" style="display: inline; '. $align .'">';
				$output .=  '<a data-hover-color="'.esc_attr($btn_color_hover).'" data-hover-bg-color="'.esc_attr($btn_background_hover).'"  class="thm-color themeum_button_shortcode" style="'.$style.'" href="'.esc_url($btn_link).'" target="'.esc_attr($target).'">'.esc_attr($btn_name).'</a>';
			$output .=  '</div>';
        }
      
	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => esc_html__("Button", 'eventum'),
		"base" => "themeum_button",
		'icon' => 'icon-thm-btn',
		"category" => esc_html__('Themeum', 'eventum'),
		"params" => array(


			array(
				"type" => "dropdown",
				"heading" => esc_html__("Position", 'eventum'),
				"param_name" => "position",
				"value" => array('Left'=>'left','Center'=>'center','Right'=>'right'),
			),	

			array(
				"type" => "dropdown",
				"heading" => esc_html__("Display", 'eventum'),
				"param_name" => "display",
				"value" => array('Block'=>'block','inline'=>'Inline','Inline Block'=>'inline-block'),
			),				

			array(
				"type" => "textfield",
				"heading" => esc_html__("Link URL", 'eventum'),
				"param_name" => "btn_link",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => esc_html__("Button Name", 'eventum'),
				"param_name" => "btn_name",
				"value" => "",
				),	

			array(
				"type" => "dropdown",
				"heading" => esc_html__("Target Link", 'eventum'),
				"param_name" => "target",
				"value" => array('Self'=>'_self','Blank'=>'_blank','Parent'=>'_parent'),
				),								

			array(
				"type" => "textfield",
				"heading" => esc_html__("Button Text Size", 'eventum'),
				"param_name" => "btn_text_size",
				"value" => "",
				),	

			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Button Text Color", 'eventum'),
				"param_name" => "btn_color",
				"value" => "",
				),

			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Hover Button Text Color", 'eventum'),
				"param_name" => "btn_color_hover",
				"value" => "",
				),	

			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Button Background", 'eventum'),
				"param_name" => "btn_background",
				"value" => "",
				),

			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Hover Button Background", 'eventum'),
				"param_name" => "btn_background_hover",
				"value" => "",
				),	

			array(
				"type" => "textfield",
				"heading" => esc_html__("Border Radius", 'eventum'),
				"param_name" => "border_radius",
				"value" => "",
				),	

			array(
				"type" => "dropdown",
				"heading" => esc_html__("Button Font Wight", 'eventum'),
				"param_name" => "btn_weight",
				"value" => array('400'=>'400','100'=>'100','200'=>'200','300'=>'300','500'=>'500','600'=>'600','700'=>'700'),
				),				

			array(
				"type" => "textfield",
				"heading" => esc_html__("Button Margin Ex. 5px 0 5px 0", 'eventum'),
				"param_name" => "btn_margin",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => esc_html__("Button Padding Ex. 5px 0 5px 0", 'eventum'),
				"param_name" => "btn_padding",
				"value" => "",
				),							

			array(
				"type" => "textfield",
				"heading" => esc_html__("Custom Class ", 'eventum'),
				"param_name" => "class",
				"value" => "",
				)
			),
		));
}
<?php
add_shortcode( 'themeum_button', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'btn_size' 				=> 'medium',
		'btn_link' 				=> '',
		'btn_name'		 		=> '',
		'target'		 		=> '_self',
		'btn_text_size'			=> '14',
		'btn_color' 			=> '#62A83D',
		'btn_background' 		=> 'rgba(255,255,255,0)',
		'border_color' 			=> 'rgba(255, 255, 255, 0)',
		'border_width' 			=> '1',
		'border_style' 			=> 'none',
		'border_radius' 		=> '100',
		'btn_transform' 		=> 'capitalize',
		'btn_weight' 			=> '400',
		'btn_spacing' 			=> '0px',
		'btn_margin' 			=> '5px 0 5px 0',
		'btn_icon_position' 	=> 'none',
		'icon_name' 			=> '',
		'class' 				=> '',
		), $atts));

	$style = '';

	if($btn_text_size) $style .= 'font-size:' . (int) $btn_text_size . 'px;line-height:'. (int) $btn_text_size  .'px;';

	if($btn_color) $style .= 'color:' . $btn_color  . ';';

	if($btn_background) $style .= 'background:' . $btn_background  . ';';

	if($border_color) $style .= 'border-color:' . $border_color  . ';';

	if($border_width) $style .= 'border-width:' . (int) $border_width  . 'px;';

	if($border_style) $style .= 'border-style:' . $border_style  . ';';

	if($border_radius) $style .= 'border-radius:' . (int) $border_radius  . 'px;';

	if($btn_transform) $style .= 'text-transform:'. $btn_transform .';';
	
	if($btn_weight) $style .= 'font-weight:'. $btn_weight .';';

	if($btn_spacing) $style .= 'letter-spacing:'. $btn_spacing .';';

	if($btn_margin) $style .= 'margin:' . $btn_margin  . ';';


	$output = '';


    switch ($btn_icon_position) {
        case 'none':
	        if ($btn_link)
	        {
			$output .=  '<a class="themeum_button_shortcode '.$btn_size.' '.$class.'" style="'.$style.'" href="'.$btn_link.'" target="'.$target.'">'.$btn_name.'</a>';
	        }
            break;           

        case 'before':
        	if ($btn_link)
	        {
        	$output .=  '<a class="themeum_button_shortcode '.$btn_size.' '.$class.'" style="'.$style.'" href="'.$btn_link.'" target="'.$target.'"><i class="fa ' . $icon_name . '"></i>' .$btn_name. '</a>';
            }  
            break;             

        case 'after':
            if ($btn_link)
	        {
        	$output .=  '<a class="themeum_button_shortcode '.$btn_size.' '.$class.'" style="'.$style.'" href="'.$btn_link.'" target="'.$target.'">'.$btn_name. '<i class="fa ' . $icon_name . '"></i></a>';
		    }
            break;   

        default:
	        if ($btn_link)
	        {
			$output .=  '<a class="themeum_button_shortcode '.$btn_size.' '.$class.'" style="'.$style.'" href="'.$btn_link.'" target="'.$target.'">'.$btn_name.'</a>';
	        }
            break;
    }	

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Themeum Button", "themeum"),
		"base" => "themeum_button",
		'icon' => 'icon-thm-btn',
		"category" => __('Themeum', "themeum"),
		"params" => array(


			array(
				"type" => "dropdown",
				"heading" => __("Buton Size", "themeum"),
				"param_name" => "btn_size",
				"value" => array('Medium'=>'medium','Small'=>'small','Large'=>'large','Extra Large'=>'ex_large'),
				),				

			array(
				"type" => "textfield",
				"heading" => __("Link URL", "themeum"),
				"param_name" => "btn_link",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Button Name", "themeum"),
				"param_name" => "btn_name",
				"value" => "",
				),	

			array(
				"type" => "dropdown",
				"heading" => __("Target Link", "themeum"),
				"param_name" => "target",
				"value" => array('Self'=>'_self','Blank'=>'_blank','Parent'=>'_parent'),
				),								

			array(
				"type" => "textfield",
				"heading" => __("Button Text Size", "themeum"),
				"param_name" => "btn_text_size",
				"value" => "",
				),	

			array(
				"type" => "colorpicker",
				"heading" => __("Button Text Color", "themeum"),
				"param_name" => "btn_color",
				"value" => "",
				),	

			array(
				"type" => "colorpicker",
				"heading" => __("Button Background", "themeum"),
				"param_name" => "btn_background",
				"value" => "",
				),	

			array(
				"type" => "colorpicker",
				"heading" => __("Button Border Color", "themeum"),
				"param_name" => "border_color",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Border Width", "themeum"),
				"param_name" => "border_width",
				"value" => "",
				),	

			array(
				"type" => "dropdown",
				"heading" => __("Border Style", "themeum"),
				"param_name" => "border_style",
				"value" => array('None'=>'none','Solid'=>'solid','Dashed'=>'dashed','Dotted'=>'dotted'),
				),			

			array(
				"type" => "textfield",
				"heading" => __("Border Radius", "themeum"),
				"param_name" => "border_radius",
				"value" => "",
				),	

			array(
				"type" => "dropdown",
				"heading" => __("Button Text Transform", "themeum"),
				"param_name" => "btn_transform",
				"value" => array('Capitalize'=>'capitalize','Uppercase'=>'uppercase','Lowercase'=>'lowercase','None'=>'none'),
				),	

			array(
				"type" => "dropdown",
				"heading" => __("Button Font Wight", "themeum"),
				"param_name" => "btn_weight",
				"value" => array('400'=>'400','100'=>'100','200'=>'200','300'=>'300','500'=>'500','600'=>'600','700'=>'700'),
				),				

			array(
				"type" => "textfield",
				"heading" => __("Button Font Letter Spacing Ex. 1px", "themeum"),
				"param_name" => "btn_spacing",
				"value" => "",
				),	

			array(
				"type" => "textfield",
				"heading" => __("Button Margin Ex. 5px 0 5px 0", "themeum"),
				"param_name" => "btn_margin",
				"value" => "",
				),							

			array(
				"type" => "dropdown",
				"heading" => __("Icon Position", "themeum"),
				"param_name" => "btn_icon_position",
				"value" => array('None'=>'none','Before'=>'before','After'=>'after'),
				),																

			array(
				"type" => "dropdown",
				"heading" => __("Icon Name", "themeum"),
				"param_name" => "icon_name",
				"value" => getIconsList(),

				),	

			array(
				"type" => "textfield",
				"heading" => __("Custom Class ", "themeum"),
				"param_name" => "class",
				"value" => "",
				)
			),
		));
}
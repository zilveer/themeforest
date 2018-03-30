<?php

/* ------------------------------------
:: CONTENT ANIMATOR
------------------------------------*/

	function content_animator_shortcode( $atts, $content = null, $code ) {

        extract(shortcode_atts(array(
			'delay' => '0',
			'effect' => 'slide',
			'direction' => 'left',	  
			'align' => '',
			'class' => '',
			'easing' => 'linear',
			'margin_top' => '',
			'margin_left' => '',
			'margin_right' => '',
			'float' => '',
			'id' => '',
			'speed' => '',
        ), $atts));
	
	
		wp_enqueue_script("jquery-effects-fade",false,array('jquery-effects-core'));
		wp_enqueue_script("jquery-effects-slide",false,array('jquery-effect-core'));
	
		wp_deregister_script('content-animator');	
		wp_register_script('content-animator',get_template_directory_uri().'/js/content.animator.min.js',null,true);
		wp_enqueue_script('content-animator');
		
		ob_start(); 
		
		$styling = $width_class = '';
	
		if( !empty( $margin_top ) )  	$styling  = 'margin-top:'.$margin_top.'px;'; 
		if( !empty( $margin_left ) ) 	$styling .= 'margin-left:'.$margin_left.'px;'; 
		if( !empty( $margin_right ) ) 	$styling .= 'margin-right:'.$margin_right.'px;'; 
			
		if( !empty( $styling ) ) $styling = 'style="'. $styling .'"';
			
		if( $float=='yes' ) $floatclass = 'float'; else $floatclass = '';
		
		$output  = '<div id="anim-' . $id . '" class="animator-wrap ' . $width_class . ' ' . $floatclass . ' ' . $class . ' ' . $align . ' ' . 'direction-'.$direction .'" ' . $styling . ' data-animator-easing="' . $easing . '" data-animator-speed="' . $speed . '" data-animator-effect="' . $effect . '" data-animator-direction="' . $direction . '" data-animator-delay="' . $delay . '">';
		$output .= remove_wpautop( $content );
		$output .= '</div>';
		
		echo $output;
	 
		$output_string=ob_get_contents();
		ob_end_clean();
		return $output_string;
	
	}

	/* ------------------------------------
	:: CONTENT ANIMATOR MAP
	------------------------------------*/

	wpb_map( array(
		"base"		=> "content_animator",
		"name"		=> __("Content Animator", "js_composer"),
		"class"		=> "",
		"controls"	=> "edit_popup_delete",
		"icon"      => "icon-animator",
		'deprecated' => '4.6',
		"params"	=> array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Animator ID", "js_composer"),
				"param_name" => "id",
				"value" => __("animator_", "js_composer"),
				"description" => __("Enter a unique ID e.g. animator_text.", "js_composer")
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content to Animate", "js_composer"),
				"param_name" => "content",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Delay Time", "js_composer"),
				"param_name" => "delay",
				"value" => "",
				"description" => __("Miliseconds e.g. 5000 = 5 seconds", "js_composer")
			),	
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Effect Speed", "js_composer"),
				"param_name" => "speed",
				"value" => "",
				"description" => __("Miliseconds e.g. 5000 = 5 seconds", "js_composer")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Effect", "js_composer"),
				"param_name" => "effect",
				"value" => array(
					'fade', 
					'slide',
				),
			),
			array(
				"type" => "dropdown",
				"heading" => __("Animate Direction", "js_composer"),
				"param_name" => "direction",
				"value" => array(
					'left', 
					'right',
					'up',
					'down',
				),
			),	
			array(
				"type" => "dropdown",
				"heading" => __("Align", "js_composer"),
				"param_name" => "align",
				"value" => array(
					'left', 
					'center',
					'right',
				),
			),
			array(
				"type" => "dropdown",
				"heading" => __("Float", "js_composer"),
				"param_name" => "float",
				"value" => array(
					'no', 
					'yes',
				),
			),																			
			array(
				"type" => "dropdown",
				"heading" => __("Easing", "js_composer"),
				"param_name" => "easing",
				"value" => get_options_array( 'transition' )
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Top Margin", "js_composer"),
				"param_name" => "margin_top",
				"description" => __("px", "js_composer"),
				"value" => "",
			),	
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Left Margin", "js_composer"),
				"param_name" => "margin_left",
				"description" => __("px", "js_composer"),
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Right Margin", "js_composer"),
				"param_name" => "margin_right",
				"description" => __("px", "js_composer"),
				"value" => "",
			),										
		)
	) );	
	
	add_shortcode('content_animator', 'content_animator_shortcode' );
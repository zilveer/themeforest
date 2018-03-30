<?php

	/* ------------------------------------
	:: TOOLTIP
	------------------------------------*/
	
	function tooltip_shortcode( $atts, $content = null, $code ) {
	   extract( shortcode_atts( array(
		  'tip' => '',
		  'color' => '',
		  'position' => '',
		  'icon' => ''
	), $atts ) );
	
		wp_deregister_script('jquery-tooltips');	
		wp_register_script('jquery-tooltips',get_template_directory_uri().'/js/jquery.tooltips.js',false,array('jquery'),true);
		wp_enqueue_script('jquery-tooltips');
			
		if($icon!='') $icon='<span class="tooltip-icon">&nbsp;</span>'; else $icon='';
		
		$position = str_replace('_',' ',$position);
		
		ob_start(); ?>
		<span class="tooltip-info <?php echo $position; ?> <?php if($icon) echo 'icon'; ?> <?php if( $content=='' ) echo 'info'; ?>" data-tooltip-position="<?php echo $position; ?>"><?php echo do_shortcode( $content ).' '.$icon; ?></span><span class="tooltip <?php echo esc_attr($color);  ?>"><?php echo do_shortcode($tip); ?> </span>
	
	
	<?php 
	 
	 $output_string=ob_get_contents();
	 ob_end_clean();
	 return $output_string;
	
	}

	/* ------------------------------------
	:: TOOLTIPS MAP 
	------------------------------------*/

	wpb_map( array(
		"name"		=> __("Tooltip", "js_composer"),
		"base"		=> "tooltip",
		"class"		=> "",
		"icon"		=> "icon-tooltip",
		"controls"	=> "",
		"category"  => __('Content', 'js_composer'),
		"params"	=> array(
		   array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Tooltip Trigger", "js_composer"),
				"param_name" => "content",
				"description" => __("Enter the content you want to act as a trigger.", "js_composer")
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Information Icon", "js_composer"),
				"param_name" => "icon",
				"value" =>  array(
					__('Enable', "js_composer") => "yes", 
				)
			),			
			array(
				"type" => "dropdown",
				"heading" => __("Position", "js_composer"),
				"param_name" => "position",
				"value" => array(
					__('Top Right', "js_composer") => 'top right',
					__('Top Left', "js_composer") => 'top left', 
					__('Top Center', "js_composer") => 'top center', 
					__('Bottom Right', "js_composer") => 'bottom right',
					__('Bottom Left', "js_composer") => 'bottom left', 
					__('Bottom Center', "js_composer") => 'bottom center', 					
				),
			),			
			array(
				"type" => "dropdown",
				"heading" => __("Color", "js_composer"),
				"param_name" => "color",
				"value" => array(
					__('Dark', "js_composer") => 'dark', 
					__('Light', "js_composer") => 'light', 						
				),
				"description" => __("Select color of the Tooltip.", "js_composer")
			),							
		   array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => __("Tooltip Content", "js_composer"),
				"param_name" => "tip",
				"value" => "",
				"description" => __("Enter the content you wish to appear within the Tooltip", "js_composer")
			),		
		),
	));		
	
	add_shortcode('tooltip', 'tooltip_shortcode');
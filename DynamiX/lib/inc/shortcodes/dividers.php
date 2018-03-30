<?php

	/* ------------------------------------
	:: DIVIDERS
	------------------------------------*/

	function divider_shortcode( $atts, $content = null,$code ) {
		extract( shortcode_atts( array(
		  'type' => '',
		  'opacity' => '',
		), $atts ) );
	
		if( $code == 'divider_blank' || $type == 'divider_blank' )
		{
			return '<div class="hozbreak blank clearfix">&nbsp;</div>';
		}
		elseif( $code == 'hozbreaktop' || $type == 'divider_linetop' || $code == 'divider_linetop' )
		{
			return '<div class="hozbreak-top clearfix"><a href="#top" class="clearfix">'. __('Back to Top', 'themeva' ) .'</a></div>';
		}
		elseif( $type == 'clear' )
		{
			return '<div class="clear"></div>';
		}		
		elseif( $code == 'divider_shadow' || $type == 'divider_shadow' || $code == 'divider_shadow_top' || $type == 'divider_shadow_top' )
		{
			// select correct shadow image
			if( $code == 'divider_shadow_top' || $type == 'divider_shadow_top' ) 
			{
				$imgtype = 'break-c';
			}
			else
			{
				$imgtype = 'break-b'; 
			}
			
			if( empty( $opacity ) ) $opacity = '100';
			
			if( $opacity == '100' ) $opacity_dec = '1'; elseif( $opacity == '.' ) $opacity_dec='0'; elseif( $opacity < '10' )  $opacity_dec = '.0'. $opacity; else $opacity_dec = '.'. $opacity;
			
			return '<div class="hozbreak shadow '.$imgtype.' clearfix"><div class="divider-wrap"><img style="opacity:'.$opacity_dec.';" src="'.get_template_directory_uri().'/images/'.$imgtype.'.png" alt="horizontal break" /></div></div>';
		}				 
		else
		{
			return '<div class="hozbreak clearfix">&nbsp;</div>';
		}
	}

	/* ------------------------------------
	:: DIVIDER MAP	  	
	------------------------------------*/

	wpb_map( array(
		"name"		=> __("Divider", "js_composer"),
		"base"		=> "divider_line",
		"controls"	=> "edit_popup_delete",
		"class"		=> "",
		'deprecated' => '4.6',
		"icon"		=> "icon-divider",
		"category"  => __('Content', 'js_composer'),
		"params"	=> array(
			array(
				"type" => "dropdown",
				"heading" => __("Type", "js_composer"),
				"holder" => 'div',
				"param_name" => "type",
				"value" => array(
					__('Line', "js_composer") => 'divider_line', 
					__('Line + Back to Top', "js_composer") => 'divider_linetop',
					__('Shadow ( Bottom )', "js_composer") => 'divider_shadow', 
					__('Shadow ( Top )', "js_composer") => 'divider_shadow_top', 
					__('Blank', "js_composer") => 'divider_blank',
					__('Clear', "js_composer") => 'clear', 
				),
			),				
			array(
				"type" => "textfield",
				"heading" => __("Opacity", "js_composer"),
				"param_name" => "opacity",
				"value" => "",
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('divider_shadow','divider_shadow_top')),
				"description" => __("% ( 0 - 100 ).", "js_composer")
			),										
		)
	));		
	
	add_shortcode('divider_linetop', 'divider_shortcode');
	add_shortcode('hozbreak', 'divider_shortcode');
	add_shortcode('divider_line', 'divider_shortcode');
	add_shortcode('divider_blank', 'divider_shortcode');
	add_shortcode('divider_shadow', 'divider_shortcode');
	add_shortcode('divider_shadow_top', 'divider_shortcode');
	add_shortcode('hozbreaktop', 'divider_shortcode');	
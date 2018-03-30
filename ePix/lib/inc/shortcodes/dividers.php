<?php

	/* ------------------------------------
	:: DIVIDERS
	------------------------------------*/

	function divider_shortcode( $atts, $content = null,$code ) {
		extract( shortcode_atts( array(
		  'type' => '',
		  'line_type' => '',
		  'height' => '',
		), $atts ) );
	
		if( $code == 'divider_blank' || $type == 'divider_blank' )
		{
			return '<div class="hozbreak blank clearfix" '. ( !empty( $height ) ? 'style="height:'. $height .'px"' : '' ) .' >&nbsp;</div>';
		}
		elseif( $code == 'hozbreaktop' || $type == 'divider_linetop' || $code == 'divider_linetop' )
		{
			return '<div class="hozbreak-top clearfix"><a href="#top" class="clearfix"><i class="fa fa-chevron-circle-up fa-lg"></i></a><div class="hozbreak '. ( !empty( $line_type ) ? $line_type : '' ) .'"></div></div>';
		}
		elseif( $type == 'clear' )
		{
			return '<div class="clear"></div>';
		}		
		else
		{
			return '<div class="hozbreak clearfix '. ( !empty( $line_type ) ? $line_type : '' ) .'">&nbsp;</div>';
		}
	}

	/* ------------------------------------
	:: DIVIDER MAP	  	
	------------------------------------*/

	add_shortcode('divider_linetop', 'divider_shortcode');
	add_shortcode('hozbreak', 'divider_shortcode');
	add_shortcode('divider_line', 'divider_shortcode');
	add_shortcode('divider_blank', 'divider_shortcode');
	add_shortcode('divider_shadow', 'divider_shortcode');
	add_shortcode('divider_shadow_top', 'divider_shortcode');
	add_shortcode('hozbreaktop', 'divider_shortcode');	

	wpb_map( array(
		"name"		=> __("Divider ( Deprecated )", "js_composer"),
		"base"		=> "divider_line",
		"controls"	=> "edit_popup_delete",
		"description" => __('Use Separator Element', 'js_composer'),
		"class"		=> "",
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
					__('Blank', "js_composer") => 'divider_blank',
					__('Clear', "js_composer") => 'clear', 
				),
			),				
			array(
				"type" => "dropdown",
				"heading" => __("Line", "js_composer"),
				"param_name" => "line_type",
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('divider_line','divider_linetop')),
				"value" => array(
					__('Dashed', "js_composer") => '', 
					__('Dotted', "js_composer") => 'dotted',
					__('Solid', "js_composer") => 'solid',
					__('Double', "js_composer") => 'double', 
				),
			),
			array(
				"type" => "textfield",
				"heading" => __("Height", "js_composer"),
				"param_name" => "height",
				"value" => "",
				"description" => __("Set a height value to increase the divider space.", "js_composer"),
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('divider_blank') ),
			),														
		)
	));		
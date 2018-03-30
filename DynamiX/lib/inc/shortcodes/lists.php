<?php

	/* ------------------------------------
	:: LISTS
	------------------------------------*/
	
	function list_shortcode( $atts, $content = null, $code ) {
	   extract( shortcode_atts( array(
		  'style' => 'orb',
		  'color' => 'grey-lite',
		  'unicode' => '',
	), $atts ) );
	
		$unicode_class = '';
			
		if( $style == 'custom' && !empty($unicode) )
		{
			$unicode_class = 'list-'. $unicode;

			wp_enqueue_style( 'themeva-custom-styles-list',	get_template_directory_uri() . '/extra-style.css', false, null );
			
			$custom_css = "
				.list.{$unicode_class} li:before {
				 content: '\\{$unicode}';
				}";
			
			wp_add_inline_style( 'themeva-custom-styles-list', $custom_css );			
		}

		return '<div class="list '. esc_attr($style) .' '. esc_attr($color)  .' '. $unicode_class .'">'. do_shortcode( $content ) .'</div>';
	}

	/* ------------------------------------
	:: LISTS MAP 	
	------------------------------------*/

	wpb_map( array(
		"name"		=> __("List", "js_composer"),
		"base"		=> "list",
		"class"		=> "wpb_controls_top_right",
		"icon"		=> "icon-list",
		"controls"	=> "full",
		"category"  => __('Content', 'js_composer'),
		"params"	=> array(
			array(
				"type" => "dropdown",
				"heading" => __("Style", "js_composer"),
				"param_name" => "style",
				"value" => array(
					__('Bullet', "js_composer") => 'orb', 
					__('Arrow', "js_composer") => 'arrow',
					__('Check', "js_composer") => 'check', 
					__('Cross', "js_composer") => 'cross', 
					__('Custom', "js_composer") => 'custom', 
				),
			),				
			array(
				"type" => "textfield",
				"heading" => __("Unicode Character", "js_composer"),
				"param_name" => "unicode",
				"dependency" => Array('element' => 'style' /*, 'not_empty' => true*/, 'value' => array('custom')),
				"description" => __("Add <a href=\"http://fortawesome.github.io/Font-Awesome/icon/coffee/\" target=\"_blank\">Font Awesome</a> <strong>Unicode</strong> Character: e.g. <strong>F0F4</strong>", "js_composer")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Color", "js_composer"),
				"param_name" => "color",
				"value" => get_options_array('colors'),
				"description" => __("Select color of the toggle icon.", "js_composer")
			),							
		   array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Text", "js_composer"),
				"param_name" => "content",
				"value" => "<ul><li>List Item</li><li>List Item</li><li>List Item</li></ul>",
			),		
		),
	));
	
	add_shortcode('list', 'list_shortcode');
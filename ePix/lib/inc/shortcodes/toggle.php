<?php

	/* ------------------------------------
	:: REVEAL / TOGGLE
	------------------------------------*/

	function reveal_shortcode( $atts, $content = null, $code ) {
		
			extract(shortcode_atts(array(
				'width' => '',
				'align' => '',
				'title' => '',
				'color' => '',
				'open' => '',
				'css_animation' => '' 
			), $atts));

		//$css_class = $this->getCSSAnimation($css_animation);
	 
		if( $width )
		{
			$width='style="width:'. esc_attr($width) .'px"';
		}
	 
		$state = ( $open == 'true' ) ? $state = 'ui-state-active' : ''; 
	 
	 
	   return '<div class="revealbox '. $align .' '. $color .' '. $open .' '. $css_class .' clearfix" '. $width .'><h4 class="reveal '. $state .'"><i class="ui-icon fa fa-plus"></i>'. $title .'</h4><div class="reveal-content">' . do_shortcode($content) . '</div></div>';
	
	}

	/* ------------------------------------
	:: REVEAL MAP
	------------------------------------*/
	
	wpb_map( array(
		"name"		=> __("Reveal ( Deprecated )", "js_composer"),		
		"base"		=> "reveal",
		"controls"	=> "full",
		"description" => __('Use FAQ Element', 'js_composer'),
		"class"		=> "",
		'deprecated' => '4.6',
		"icon"		=> "icon-toggle",
		"category"  => __('Content', 'js_composer'),
		"params"	=> array(
			array(
				"type" => "textfield",
				"holder" => "h4",
				"class" => "toggle_title",
				"heading" => __("Toggle title", "js_composer"),
				"param_name" => "title",
				"value" => __("Toggle title", "js_composer"),
				"description" => __("Toggle block title.", "js_composer")
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "toggle_content",
				"heading" => __("Toggle content", "js_composer"),
				"param_name" => "content",
				"value" => __("<p>Toggle content goes here, click edit button.</p>", "js_composer"),
				"description" => __("Toggle block content.", "js_composer")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Default state", "js_composer"),
				"param_name" => "open",
				"value" => array(__("Closed", "js_composer") => "false", __("Open", "js_composer") => "true"),
				"description" => __("Select this if you want toggle to be open by default.", "js_composer")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Color", "js_composer"),
				"param_name" => "color",
				"value" => get_options_array('colors'),
				"description" => __("Select color of the toggle icon.", "js_composer")
			),
			$add_css_animation,		
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", "js_composer"),
				"param_name" => "el_class",
				"value" => "",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			)
		)	
	) );	
	
	add_shortcode('reveal', 'reveal_shortcode');
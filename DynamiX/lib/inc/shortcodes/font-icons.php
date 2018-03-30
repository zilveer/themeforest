<?php

	/* ------------------------------------
	:: FONT ICON
	------------------------------------*/

	class WPBakeryShortCode_icon extends WPBakeryShortCode {
		protected  $predefined_atts = array(
					  'name' => '',
					  'background' => '',
					  'backgroundcolor' => '',
					  'iconcolor' => '',
					  'iconsize' => '',
					  'align' => '',
					  'css_animation' => '' 
					);
		public function content( $atts, $content = null ) {
			$width = $align = $open = $title = $color = $css_animation = $css_class = '';
			extract(shortcode_atts(array(
				'name' => '',
				'background' => '',
				'backgroundcolor' => '',
				'iconcolor' => '',
				'color' => '',
				'iconsize' => '',
				'align' => '',
				'css_animation' => '' 
			), $atts));

			$css_class = $this->getCSSAnimation($css_animation);
	 
			return '<span class="fonticon '. $css_class .' '. ( !empty( $iconsize ) ? $iconsize .' ' : '' ) . ( !empty( $align ) ? $align .' ' : '' ) . ( !empty( $background ) ? 'background' : '' ) .'" '. ( !empty( $backgroundcolor ) ? 'style="background-color:'. $backgroundcolor .'"' : '' ) .'><i class="fa '. $name . ( $iconcolor == 'inherit' ? ' inherit' : '' ) .'" '. ( !empty( $color ) ? 'style="color:'. $color .'"' : '' ) .'></i></span>';
	
		}
	}

	/* ------------------------------------
	:: FONT ICON MAP
	------------------------------------*/
	
	wpb_map( array(
		"name"		=> __("Icon Font", "js_composer"),
		"base"		=> "icon",
		"controls"	=> "full",
		"class"		=> "",
		'deprecated' => '4.6',
		"icon"		=> "icon-toggle",
		"category"  => __('Content', 'js_composer'),
		"params"	=> array(
			array(
				"type" => "textfield",
				"holder" => "h4",
				"heading" => __("Icon Name", "js_composer"),
				"param_name" => "name",
				"description" => __("See Font Awesome <a href=\"http://fortawesome.github.io/Font-Awesome/icons/\" target=\"_blank\">Icons</a> : Enture Icon Name e.g.<strong> fa-compass</strong>", "js_composer")
			),
			array(
				"type" => "textfield",
				"heading" => __("Icon Size", "js_composer"),
				"param_name" => "iconsize",
				"description" => __("e.g. small, medium, large, x-large, xx-large", "js_composer")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Icon Color", "js_composer"),
				"param_name" => "iconcolor",
				"value" => array(
				__('Default', "js_composer") => "", 
				__('Custom', "js_composer") => "custom", 
				__('Inherit Link Color', "js_composer") => "inherit"
				),
			),				
			array(
				"type" => "colorpicker",
				"heading" => __("Icon Color", "js_composer"),
				"param_name" => "color",
				"dependency" => Array('element' => 'iconcolor' /*, 'not_empty' => true*/, 'value' => array('custom')),
				"value" => "",
				"description" => __("If no color is set, the default text color will be used.", "js_composer")
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Background Color", "js_composer"),
				"param_name" => "background",
				"value" =>  array(
					__('Enable', "js_composer") => "true", 
				),
				"description" => __("If no color is set, the default link color will be used.", "js_composer")
			),
			array(
				"type" => "colorpicker",
				"heading" => __("Custom Background Color", "js_composer"),
				"param_name" => "backgroundcolor",
				"dependency" => Array('element' => 'background' /*, 'not_empty' => true*/, 'value' => array('true')),
				"value" => "",
			),		
			array(
				"type" => "dropdown",
				"heading" => __("Align", "js_composer"),
				"param_name" => "align",
				"value" => array(
				__('Left', "js_composer") => "", 
				__('Center', "js_composer") => "center", 
				__('Right', "js_composer") => "right"
				),
				"description" => __("Select message type.", "js_composer")
			),			
			$add_css_animation,		
		)	
	) );	
	
	add_shortcode('reveal', 'reveal_shortcode');
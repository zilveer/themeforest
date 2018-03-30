<?php

/* ------------------------------------
:: FEATURE BOXES
------------------------------------*/

	/* ------------------------------------
	:: FEATURE BOXES MAP
	------------------------------------*/
	
	wpb_map( array(
		"name"		=> __("Feature Box", "js_composer"),
		"base"		=> "featurebox",
		"is_container" => false,
		"icon"		=> "icon-stylebox",
		"category"  => __('Content', 'js_composer'),		
		"params"	=> array(	
			array(
				"type" => "dropdown",
				"heading" => __("Feature Box Type", "js_composer"),
				"param_name" => "type",
				"value" => array(
				__('Inherit Element Background Color', "js_composer") => "general_shaded", 
				__('Custom', "js_composer") => "custom"),
			),
			array(
				"type" => "colorpicker",
				"heading" => __("Custom Background Color", "js_composer"),
				"param_name" => "background_color",
				"value" => "",
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('custom')),
				"description" => __("Add a Custom Background Color", "js_composer")
			),
			array(
				"type" => "colorpicker",
				"heading" => __("Custom Border Color", "js_composer"),
				"param_name" => "border_color",
				"value" => "",
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('custom')),
				"description" => __("Add a Custom Border Color", "js_composer")
			),
			array(
				"type" => "colorpicker",
				"heading" => __("Custom Font Color", "js_composer"),
				"param_name" => "font_color",
				"value" => "",
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('custom')),
				"description" => __("Add a Custom Font Color", "js_composer")
			),
			array(
				"type" => "textfield",
				"heading" => __("Icon", "js_composer"),
				"param_name" => "icon",
				"value" => "",
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('custom','general_shaded')),
				"description" => __("See Font Awesome <a href=\"http://fortawesome.github.io/Font-Awesome/icons/\" target=\"_blank\">Icons</a> : Enter Icon Name e.g.<strong> fa-compass</strong>", "js_composer")
			),
			array(
				"type" => "colorpicker",
				"heading" => __("Icon Color", "js_composer"),
				"param_name" => "icon_color",
				"value" => "",
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('custom','general_shaded')),
			),
			array(
				"type" => "colorpicker",
				"heading" => __("Icon Background Color", "js_composer"),
				"param_name" => "icon_background",
				"value" => "",
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('custom','general_shaded')),
			),							
			array(
				"type" => "dropdown",
				"heading" => __("Icon Position", "js_composer"),
				"param_name" => "icon_position",
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('custom','general_shaded')),
				"value" => array(
					__('Left', "js_composer") => "left", 
					__('Center', "js_composer") => "center",
					__('Right', "js_composer") => "right"
				),
			),
		   array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Text", "js_composer"),
				"param_name" => "content",
				"value" => "",
			),									
			$add_css_animation,										
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", "js_composer"),
				"param_name" => "el_class",
				"value" => "",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			)
		),
	) );

	class WPBakeryShortCode_FeatureBox extends WPBakeryShortCode {
		
		public function __construct($settings) {
			parent::__construct($settings);
		}
	
		public function content( $atts, $content = null ) {

			$title = $columns = $width = $el_position = $el_class = $css_class = '';
			//
			extract(shortcode_atts(array(
				  'type' => 'general_shaded',
				  'color' => '',
				  'width' => '',
				  'height' => '',
				  'icon' => '',
				  'icon_position' => 'left',
				  'icon_color' => '',
				  'icon_background' => '',
				  'bg_color' =>'',
				  'background_color' =>'',
				  'border_color' =>'',
				  'font_color' =>'',
				  'align' => '',
				  'el_class' => '',
				  'css_animation' => ''
			), $atts));
			
			$output = '';
			
			$el_class = $this->getExtraClass($el_class);

			$style = $inner_type = $inner_style = $custom_style = '';
		 
			if( esc_attr( $width ) )
			{
				$style='max-width:'. esc_attr($width) .'px;';
			}
			
			if( esc_attr( $height ) )
			{
				$style .= 'min-height:'. esc_attr($height) .'px;';
			} 
			
			if( !empty( $style ) ) $inner_style = 'style="'. $style .'"';
			
			
			// Custom Background / Border
			if( !empty( $bg_color ) )
			{
				$background_color = $bg_color;
			}
			
			if( !empty( $background_color ) && $type == 'custom' )
			{
				$custom_style .= 'background-color:'. $background_color .';';	
			}
	
			if( !empty( $border_color ) && $type == 'custom' )
			{
				$custom_style .= 'border:1px solid '. $border_color .';';	
			}
				
			if( !empty( $font_color ) && $type == 'custom' )
			{
				$custom_style .= 'color:'. $font_color .';';	
			}					
			
			if( isset( $custom_style ) && $type == 'custom' ) $custom_style = 'style="'. $custom_style .'"';
			
			
			// Custom Icon 
			if( !empty( $icon ) && ( $type == 'custom' || $type == 'general_shaded' ) )
			{
				$icon_style = '';
				
				if( !empty( $icon_color ) ) $icon_style .= 'color:'. $icon_color .';';
				if( !empty( $icon_background ) ) $icon_style .= 'background-color:'. $icon_background .';';
				
				$icon = '<span class="icon-wrap" '. ( !empty( $icon_style ) ? 'style="'. $icon_style .'"' : '' ) .'><i class="fa '. $icon .'"></i></span>';
			}

			if( $type == "general_shaded" )
			{
				$type = 'general shaded';
			}			
	
			$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'styledbox feature '. $type .' '. $el_class .' wpb_content_element', $this->settings['base']);
			$css_class .= $this->getCSSAnimation($css_animation);
			
			$output .= "\n\t".'<div class="'. $css_class .' '. ( !empty($icon) ? 'icon' : '' ) .' '.  ( !empty($icon_position) ? 'fonticon-'.$icon_position : '' ) .'" '. $custom_style .'>'; 
			$output .= "\n\t\t". $icon .'<div class="boxcontent clearfix '. $inner_type .'" '. $inner_style .'>'. wpb_js_remove_wpautop($content) .'</div>';
			$output .= "\n\t".'</div> '.$this->endBlockComment('.styledbox');
	
			//

			return $output;
		}
	}		
	
	
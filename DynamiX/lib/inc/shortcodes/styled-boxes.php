<?php
/* ------------------------------------
:: STYLED BOXES
------------------------------------*/

	function styledbox_shortcode( $atts, $content = null )
	{
	   extract( shortcode_atts( array(
		  'type' => '',
		  'color' => '',
		  'width' => '',
		  'height' => '',
		  'bg_color' =>'',
		  'icon' =>'',
		  'border_color' =>'',
		  'font_color' =>'',
		  'align' => '',
		  'el_position' => '',
		  'el_class' => ''
		  ), $atts ) );
	 
	 	$style = '';
	 
		if( esc_attr( $width ) )
		{
			$style='max-width:'. esc_attr($width) .'px;';
		}
		
		if( esc_attr( $height ) )
		{
			$style .= 'min-height:'. esc_attr($height) .'px;';
		} 
		
		// Custom Background / Border
		if( !empty( $bg_color ) && $type == 'custom' )
		{
			$style .= 'background-color:'. $bg_color .';';	
		}

		if( !empty( $border_color ) && $type == 'custom' )
		{
			$style .= 'border:1px solid '. $border_color .';';	
		}		

		if( !empty( $font_color ) && $type == 'custom' )
		{
			$style .= 'color:'. $font_color .';';	
		}			
		
		if( isset( $style ) ) $style = 'style="'. $style .'"';
		
		if( esc_attr( $type ) == "general_shaded" )
		{
			$type = 'general shaded';
		}

		if( !isset($style) ) $style = '';
		
		if( !empty( $icon ) )
		{
			$icon = '<span class="icon-wrap"><i class="fa '. $icon .'"></i></span>';
		}		
		 
		if( esc_attr($type) == "shadow" )
		{
			return '<div class="styledbox shadow top '. esc_attr($align) .' " '. $style .'><div class="styledbox shadow bottom"><div class="boxcontent shadow">'. do_shortcode( $content ) .'<div class="clear"></div></div></div></div>';
		}
		elseif( esc_attr($type) == "shadowbottom" )
		{
			return '<div class="styledbox shadow '. esc_attr($align) .' " '. $style .'><div class="styledbox shadow bottom"><div class="boxcontent shadow">'. do_shortcode( $content ) .'<div class="clear"></div></div></div></div>';
		 
		}
		else
		{
		   if( !isset($style) ) $style='';
		   return '<div class="styledbox ' . esc_attr($type) .' '. esc_attr($align) .' ' . esc_attr($el_class) .'"  '. ( !empty($icon) ? 'icon' : '' ) .'" '. $style .'>'. $icon .'<div class="boxcontent cleafix">'. do_shortcode( $content ) .'</div></div>';
		}
	}
	
	//add_shortcode('styledbox', 'styledbox_shortcode');

	/* ------------------------------------
	:: STYLED BOXES MAP
	------------------------------------*/
	
	wpb_map( array(
		"name"		=> __("Styled Boxes", "js_composer"),
		"base"		=> "styledbox",
		"is_container" => true,
		"icon"		=> "icon-stylebox",
		"category"  => __('Content', 'js_composer'),
		'default_content' => '
			[vc_column_inner width="1/1"][/vc_column_inner]
		',		
		"params"	=> array(	
			array(
				"type" => "dropdown",
				"heading" => __("StyledBox Type", "js_composer"),
				"param_name" => "type",
				"value" => array(__('General', "js_composer") => "general", __('General Shaded', "js_composer") => "general_shaded", __('Blank', "js_composer") => "blank", __('Warning', "js_composer") => "warning", __('Information', "js_composer") => "information", __('Download', "js_composer") => "download", __('Help', "js_composer") => "help", __('Custom', "js_composer") => "custom"),
				"description" => __("Select message type.", "js_composer")
			),
			array(
				"type" => "colorpicker",
				"heading" => __("Custom Background Color", "js_composer"),
				"param_name" => "bg_color",
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
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('custom','general_shaded','general')),
				"description" => __("See Font Awesome <a href=\"http://fortawesome.github.io/Font-Awesome/icons/\" target=\"_blank\">Icons</a> : Enter Icon Name e.g.<strong> fa-compass</strong>", "js_composer")
			),
			array(
				"type" => "colorpicker",
				"heading" => __("Icon Color", "js_composer"),
				"param_name" => "icon_color",
				"value" => "",
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('custom','general_shaded','general')),
			),				
			$add_css_animation,
			array(
				"type" => "textfield",
				"heading" => __("Height", "js_composer"),
				"param_name" => "height",
				"value" => "",
				"description" => __("Add a custom height e.g. 200, this will set a minimum height of 200px.", "js_composer")
			),											
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", "js_composer"),
				"param_name" => "el_class",
				"value" => "",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			)
		),
		'admin_enqueue_js' => array(get_template_directory_uri().'/js/custom-views-extended.js'),
		'js_view' => 'StyledBoxView'
	) );

	
	if( function_exists( 'vc_path_dir' ) )
	{
		require_once vc_path_dir('SHORTCODES_DIR', 'vc-row.php');
	}
	

	if( class_exists( 'WPBakeryShortCode_VC_Row' ) )
	{	
		class WPBakeryShortCode_Styledbox extends WPBakeryShortCode_VC_Row {
			
			public function __construct($settings) {
				parent::__construct($settings);
			}
		
			public function content( $atts, $content = null ) {
	
				$title = $columns = $width = $el_position = $el_class = $css_class = $output = '';
				//
				extract(shortcode_atts(array(
					  'type' => '',
					  'color' => '',
					  'icon' => '',
					  'icon_color' => '',			  
					  'width' => '',
					  'height' => '',
					  'bg_color' =>'',
					  'border_color' =>'',
					  'font_color' =>'',
					  'align' => '',
					  'el_class' => '',
					  'css_animation' => ''
				), $atts));
				
		
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
					$custom_style .= 'background-color:'. $bg_color .';';	
				}
		
				if( !empty( $border_color ) )
				{
					$custom_style .= 'border:1px solid '. $border_color .';';	
				}
					
				if( !empty( $font_color ) )
				{
					$custom_style .= 'color:'. $font_color .';';	
				}					
				
				if( isset( $custom_style ) && $type == 'custom' ) $custom_style = 'style="'. $custom_style .'"';
	
				// Custom Icon 
				if( !empty( $icon ) && ( $type == 'custom' || $type == 'general_shaded' || $type == 'general' ) )
				{
					$icon_style = '';
					
					if( !empty( $icon_color ) ) $icon_style .= 'color:'. $icon_color .';';
					if( !empty( $icon_background ) ) $icon_style .= 'background-color:'. $icon_background .';';
					
					$icon = '<span class="icon-wrap" '. ( !empty( $icon_style ) ? 'style="'. $icon_style .'"' : '' ) .'><i class="fa '. $icon .'"></i></span>';
				}
				
				// Warning Icon
				if( $type == 'warning' )
				{
					$icon = '<span class="icon-wrap"><i class="fa fa-exclamation-triangle"></i></span>';
				}
				
				// Help Icon
				if( $type == 'help' )
				{
					$icon = '<span class="icon-wrap"><i class="fa fa-question-circle"></i></span>';
				}
	
				// Download Icon
				if( $type == 'download' )
				{
					$icon = '<span class="icon-wrap"><i class="fa fa-arrow-circle-o-down"></i></span>';
				}					
	
				// Informaion Icon
				if( $type == 'information' )
				{
					$icon = '<span class="icon-wrap"><i class="fa fa-info-circle"></i></span>';
				}			
				
				
				if( $type == "general_shaded" )
				{
					$type = 'general shaded';
				}
				 
				if( $type == "shadow" )
				{
					$icon = '';
					$type = 'shadow top';
					$inner_type = 'shadow bottom';
				}
				elseif( $type == "shadowbottom" )
				{
					$icon = '';
					$type = 'shadow';
					$inner_type = 'shadow bottom';
				}
				
		
				$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'styledbox '. $type .' '. $el_class .' wpb_content_element', $this->settings['base']);
				$css_class .= $this->getCSSAnimation($css_animation);
				
				$output .= "\n\t".'<div class="'. $css_class .' '. ( !empty($icon) ? 'icon fonticon-left' : '' ) .'" '. $custom_style .'>'; 
				$output .= "\n\t\t". $icon .'<div class="boxcontent clearfix '. $inner_type .'" '. $inner_style .'>'. do_shortcode($content) .'</div>';
				$output .= "\n\t".'</div> '.$this->endBlockComment('.styledbox');
		
				//
				return $output;
			}
		}
	}
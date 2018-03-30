<?php

	/* ------------------------------------
	:: BUTTONS
	------------------------------------*/
	

	class WPBakeryShortCode_Button extends WPBakeryShortCode {
		protected  $predefined_atts = array(
					  'url' => '',
					  'type' => '',
					  'title' => '',
					  'target' => '',
					  'icon' => '',
					  'color' => '',
					  'back_color' => '',
					  'border_color' => '',
					  'text_color' => '',
					  'width' => '',
					  'align' => '',
					  'el_class' => '',	
					  'css_animation' => ''
					);
		public function content( $atts, $content = null, $code = '' ) {
			$width = $align = $url = $title = $color = $css_animation = $type = $back_color = $border_color = $text_color = $el_class = $target = $css_class = '';
			extract(shortcode_atts(array(
			  'url' => '',
			  'type' => '',
			  'title' => '',
			  'target' => '',
			  'icon' => '',
			  'color' => '',
			  'back_color' => '',
			  'border_color' => '',
			  'text_color' => '',
			  'width' => '',
			  'align' => '',
			  'el_class' => '',	
			  'css_animation' => ''
			), $atts));
			
			$css_class = $this->getCSSAnimation($css_animation) .' '. $el_class;
		 
			if( !empty($target) )
			{
				$target = 'target="'. $target .'"';
			}
			
			if( !empty( $title ) )
			{
				$content = $title;	
			}

			if( !empty( $icon ) )
			{
				$icon = '<i class="fa '. $icon .'"></i>'; 
			}				
			 
			if($align) $buttonalign = $align; else $buttonalign = '';
			 
			if( $code == 'droppanelbutton' || $type == 'droppanelbutton' )
			{
				 return '<div class="button-wrap '. $width . ' '. $css_class .' '.$buttonalign.'"><div class="'. $color .' button '. $width .' droppaneltrigger"><a href="#">'. $icon .' '. $content .'</a></div></div>';
			}
			 
			if( $type == 'custom' )
			{
				$style = '';
				 
				if( !empty( $back_color ) )
				{
					$style = 'background-color:'. $back_color .';'; 
				}
			
				if( !empty( $border_color ) )
				{
					//$style .= 'border: 1px solid '. $border_color .';'; 
				}	
			
				if( !empty( $text_color ) )
				{
					$text_color = 'color:'. $text_color .';'; 
				}		 			
				 
				return '<div class="button-wrap '. $type .' '. $width .' '. $css_class .' '. $buttonalign .'"><div style="'. $style .'" class="button '. $width .'"><a href="' . $url . '" ' . $target . ' style="'. $text_color .'">'. $icon .' '. $content .'</a></div></div>';
			} 
			else
			{
				return '<div class="button-wrap '. $width .' '. $css_class .' '. $buttonalign .'"><div class="'. $color .' button ' . $width . '"><a href="' . $url . '" ' . $target . '>'. $icon .' '. $content .'</a></div></div>';	 
			}
	   
		}
	}

	/* ------------------------------------
	:: DROP PANEL BUTTON
	------------------------------------*/

	function droppanelbutton_shortcode( $atts, $content = null, $code )
	{
	   extract( shortcode_atts( array(
		  'url' => '',
		  'type' => '',
		  'title' => '',
		  'target' => '',
		  'color' => '',
		  'back_color' => '',
		  'border_color' => '',
		  'text_color' => '',
		  'width' => '',
		  'align' => '',
		  'el_class' => '',	  
	), $atts ) );
	 
	if( !empty($target) )
	{
		$target = 'target="'. $target .'"';
	}
	
	if( !empty( $title ) )
	{
		$content = $title;	
	}
	
	return '<div class="button-wrap '. $width .' '. $el_class .' '. $align .'"><div class="'. $color .' button '. $width .' droppaneltrigger"><a href="#">' . $content . '</a></div></div>';
	   
	}
	
	
	// Add Default Link Color
	$button_colors = get_options_array('colors');
	$button_colors = array(	'Link Color' => 'link_color' ) + $button_colors; 
	
	/* ------------------------------------
	:: BUTTONS MAP
	------------------------------------*/
	
	wpb_map( array(
		"name"		=> __("Button", "js_composer"),
		"base"		=> "button",
		"class"		=> "",
		'deprecated' => '4.6',
		"icon"		=> "icon-button",
		"controls"	=> "edit_popup_delete",		
		"category"  => __('Content', 'js_composer'),
		"show_settings_on_create" => true,
		"params"	=> array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"heading" => __("Button Text", "js_composer"),
				"param_name" => "title",
				"value" => "",
				"description" => __("Enter button text.", "js_composer")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Button Type", "js_composer"),
				"param_name" => "type",
				"value" => array(
					__('Button', "js_composer") => "linkbutton", 
					__('Drop Panel Trigger', "js_composer") => "droppanelbutton", 
					__('Custom', "js_composer") => "custom"
				),
				"description" => __("Select button type.", "js_composer")
			),
			array(
				"type" => "colorpicker",
				"heading" => __("Text Color", "js_composer"),
				"param_name" => "text_color",
				"value" => "",
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('custom')),
				"description" => __("Button Color", "js_composer")
			),
			array(
				"type" => "colorpicker",
				"heading" => __("Background Color", "js_composer"),
				"param_name" => "back_color",
				"value" => "",
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('custom')),
				"description" => __("Button Color", "js_composer")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Color", "js_composer"),
				"param_name" => "color",
				"value" => $button_colors,
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('droppanelbutton','linkbutton')),
				"description" => __("Select button type.", "js_composer")
			),	
			array(
				"type" => "textfield",
				"holder" => "div",
				"heading" => __("Button Icon", "js_composer"),
				"param_name" => "icon",
				"value" => "",
				"description" => __("See Font Awesome <a href=\"http://fortawesome.github.io/Font-Awesome/icons/\" target=\"_blank\">Icons</a> : Enture Icon Name e.g.<strong> fa-compass</strong>", "js_composer")
			),								
			get_common_options( 'align', 'Button' ),				
			array(
				"type" => "textfield",
				"heading" => __("Link URL", "js_composer"),
				"param_name" => "url",
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('custom','linkbutton')),
				"value" => "",
			),
			array(
				"type" => "dropdown",
				"heading" => __("Link Target", "js_composer"),
				"param_name" => "target",
				"value" => array(
					__("Same window", "js_composer") => "_self", 
					__("New window", "js_composer") => "_blank"
				),
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('custom','linkbutton')),	
			),
			$add_css_animation,
			array(
				"type" => "dropdown",
				"heading" => __("Width", "js_composer"),
				"param_name" => "width",
				"value" => array(
					__("Normal", "js_composer") => "", 
					__("Quarter", "js_composer") => "quarter", 
					__("Half", "js_composer") => "half",
					__("Three Quarter", "js_composer") => "threequarter",
					__("Full", "js_composer") => "full"
				),
			),						
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", "js_composer"),
				"param_name" => "el_class",
				"value" => "",
				"description" => __("Add Custom CSS classes to this field, below are some default classes you can use.<br /><br />
				<strong>medium-text</strong><br />
				<strong>big-text</strong><br />
				<strong>large-text</strong><br />
				<strong>xlarge-text</strong><br />
				<strong>supersize-text</strong>
				", "js_composer")
			)
		),
	) );
	
	add_shortcode('droppanelbutton', 'droppanelbutton_shortcode');
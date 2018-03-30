<?php

	/* ------------------------------------
	:: BLOCK QUOTE
	------------------------------------*/

	class WPBakeryShortCode_Blockquote extends WPBakeryShortCode {
		protected  $predefined_atts = array(
					  'type' => '',
					  'align' => '',
					  'width' => '',
					  'css_animation' => '' 
					);
		public function content( $atts, $content = null ) {
			$type = $align = $width = $css_animation = $blockwidth = $css_class = '';
			extract(shortcode_atts(array(
				  'type' => 'blockquote_quotes',
				  'align' => '',
				  'width' => '',
				  'css_animation' => '' 
			), $atts));

			global $NV_inskin;

			$css_class = $this->getCSSAnimation($css_animation);
		
			if( $width !='' )
			{ 
				$blockwidth='style="width:100%;max-width:'. $width .'px"'; 
			}
		 
			if( $type != "blockquote_line" )
			{
				return '<div class="nv-skin ' . $type .' '. $align .' '. $css_class .'" '.$blockwidth.'><span class="quote right"><span>'. __('&#8221;','themeva') .'</span></span><span class="quote left"><span>'. __('&#8220;','themeva') .'</span></span>' . $content . '</div>';   
			}
			else
			{
				return '<div class="nv-skin ' . $type .' '. $align .' '. $css_class .'" '.$blockwidth.'>' . $content . '</div>';  
			}
		}
	}
	

	/* ------------------------------------
	:: BLOCK QUOTE MAP 
	------------------------------------*/

	wpb_map( array(
		"name"		=> __("Quote", "js_composer"),
		"base"		=> "blockquote",
		"class"		=> "wpb_controls_top_right",
		"icon"		=> "icon-quote",
		"controls"	=> "full",
		"category"  => __('Content', 'js_composer'),
		"params"	=> array(
			array(
				"type" => "dropdown",
				"heading" => __("Type", "js_composer"),
				"param_name" => "type",
				"value" => array(
					__('Quotes', "js_composer") => 'blockquote_quotes',
					__('Line', "js_composer") => 'blockquote_line', 

				),
			),
			array(
				"type" => "dropdown",
				"heading" => __("Align", "js_composer"),
				"param_name" => "align",
				"value" => array(
					__('Left', "js_composer") => 'left',
					__('Center', "js_composer") => 'center', 
					__('Right', "js_composer") => 'right', 

				),
			),
			$add_css_animation,					
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Quote", "js_composer"),
				"param_name" => "content",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Width", "js_composer"),
				"param_name" => "width",
				"value" => "",
				"description" => __("Add optional width setting.", "js_composer")
			),			
		),
	));	
<?php

/* ------------------------------------
:: TEXT SLIDER
------------------------------------*/

	class WPBakeryShortCode_TextSlide extends WPBakeryShortCode {

		public function content( $atts, $content = null ) {
			$output = '';

			$output .= '<div class="text-slide clearfix">'. wpb_js_remove_wpautop( $content ) .'</div>';
	
			return $output;
		}

		public function mainHtmlBlockParams($width, $i) {
			return 'data-element_type="'.$this->settings["base"].'" class=" wpb_'.$this->settings['base'].'"'.$this->customAdminBlockParams();
		}
		public function containerHtmlBlockParams($width, $i) {
			return 'class="wpb_column_container vc_container_for_children"';
		}
		protected function outputTitle($title) {
			return  '';
		}
	
		public function customAdminBlockParams() {
			return '';
		}
	
	}

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_TextSlider extends WPBakeryShortCodesContainer {

			protected function content( $atts, $content = null ) {
	
				$align = $navigation = $effect = $timeout = $el_class = $el_position = '';
				//
				extract(shortcode_atts(array(
					'width' => '',
					'el_class' => '',
					'effect' => 'scrollHorz',
					'timeout' => '5',
					'navigation' => '',
				), $atts));
				
				$output = '';
		
				$el_class = $this->getExtraClass($el_class);
	
				$output .= "\n\t".'<div id="textslider-'. uniqid() .'" class="textslider-wrap gallery-wrap '. $width .' '. $el_class .' clearfix" data-texteffect="'. $effect .'" data-texttimeout="'. $timeout .'">';
				$output .= "\n\t\t".'<div class="textslider-slides wpb_text_column">';
				$output .= "\n\t\t\t". wpb_js_remove_wpautop($content);
				$output .= "\n\t\t".'</div>';

				if( $navigation == "enable" )
				{
					$output .= '<div class="slidernav-left">';
					$output .= '<div class="slidernav">';
					$output .= '<a class="poststage-prev nav-prev"></a>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '<div class="slidernav-right">';
					$output .= '<div class="slidernav">';
					$output .= '<a class="poststage-next nav-next"></a>';
					$output .= '</div>';
					$output .= '</div>';	
				} 				

				$output .= "\n\t".'</div>';
	
				wp_register_script('jquery-cycle',get_template_directory_uri().'/js/jquery.cycle.plugin.min.js',false,array('jquery'),true);
				wp_enqueue_script('jquery-cycle');	

				wp_register_script('acoda-textslider',get_template_directory_uri().'/js/text-slider.min.js',false,array('jquery-cycle'),true);
				wp_enqueue_script('acoda-textslider');					
				
				return $output;
			}
		}
	}


	/* ------------------------------------
	:: TESTIMONIALS MAP
	------------------------------------*/	

	wpb_map( array(
		"name"		=> __("Text Slider", "js_composer"),
		"base"		=> "textslider",
		"show_settings_on_create" => false,
		"content_element" => true,
		"as_parent" => array('only' => 'textslide'), // Use only|except attributes 
		"category"  => __('Content', 'js_composer'),
		"params"	=> array(	
			array(
				"type" => "dropdown",
				"heading" => __("Width", "js_composer"),
				"param_name" => "width",
				"value" => array(
					__('100%', "js_composer") => 'width_100',
					__('75%', "js_composer") => 'width_75', 
					__('50%', "js_composer") => 'width_50', 
				),
			),	
			array(
				"type" => "dropdown",
				"heading" => __("Effect", "js_composer"),
				"param_name" => "effect",
				"value" => array(
					__('Slide', "js_composer") => 'scrollHorz',
					__('Fade', "js_composer") => 'fade', 
				),
			),							
			array(
				"type" => "dropdown",
				"heading" => __("Auto-Slide", "js_composer"),
				"param_name" => "timeout",
				"value" => array(
					__('5 Seconds', "js_composer") => '5000',
					__('10 Seconds', "js_composer") => '10000', 
					__('20 Seconds', "js_composer") => '20000',
					__('30 Seconds', "js_composer") => '30000', 
					__('Disable', "js_composer") => '-1', 
				),
			),
			array(
				"type" => "dropdown",
				"heading" => __("Navigation", "js_composer"),
				"param_name" => "navigation",
				"value" => array(
					__('Disable', "js_composer") => 'disable',
					__('Enable', "js_composer") => 'enable', 
				),
			),				
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", "js_composer"),
				"param_name" => "el_class",
				"value" => "",
				"description" => __("Add custom CSS classes to the above field.", "js_composer")
			)
		),
	  "js_view" => 'VcColumnView'
	) );
	
	
	wpb_map( array(
		"name"		=> __("Text Slide", "js_composer"),
		"base"		=> "textslide",
		"content_element" => true,
		"as_child" => array('only' => 'textslider'), // Use only|except attributes 
		"params"	=> array(			
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"heading" => __("Content", "js_composer"),
				"param_name" => "content",
				"value" => "",
			),	
		)
	) );
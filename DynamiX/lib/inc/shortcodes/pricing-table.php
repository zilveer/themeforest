<?php

	/* ------------------------------------
	:: PRICING TABLE
	------------------------------------*/
	
	
	class WPBakeryShortCode_Plan extends WPBakeryShortCode {
		protected  $predefined_atts = array(
			'el_position' => '',
			'title' => '',
			'featured' => '',
			'button_text' => '',
			'button_link' => '',
			'price' => '',
			'target' => '',
			'icon' => '',
			'icon_background' => '',
			'icon_color' => '',					
			'per' => '',
			'color' => '',
			'el_class' => '',
			'width' => ''
		);
	
		public function content( $atts, $content = null ) {
			$title = $el_position = $featured = $button_text = $button_link = $price = $target = $per = $color = $el_class = $width = '';
	
			extract(shortcode_atts(array(
				'el_position' => '',
				'title' => "",
				'featured' => '',
				'button_text' => '',
				'button_link' => '',
				'price' => '',
				'target' => '',
				'icon' => '',
				'icon_background' => '',
				'icon_color' => '',						
				'per' => '',
				'color' => '',
				'el_class' => '',
				'width' => '',
			), $atts));
	
		
			if( $featured == 'true' ) $featured = 'featured';
			$color = ( $color != '' ) ? $color : 'grey-lite';
				
			if( !empty( $width ) )
			{
				$width = numberToWords ( $width );
				$width = $width .'-column';
			}
				
			$output = '';
			$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'nv-pricing-plan group '.$featured.' '. $color .' '. $el_class .' '. $width, $this->settings['base']);
			$output .= "\n\t\t\t" . '<div class="'.$css_class.'">';		

			if( !empty( $icon ) ) 
			{

				$icon_style = '';
				
				if( !empty( $icon_color ) ) $icon_style .= 'color:'. $icon_color .';';
				if( !empty( $icon_background ) ) $icon_style .= 'background-color:'. $icon_background .';';
								
				$output .= "\n\t\t\t" . '<span class="icon-wrap" '. ( !empty( $icon_style ) ? 'style="'. $icon_style .'"' : '' ) .'><i class="fa '. $icon .'"></i></span>';	
			}
			
			$output .= "\n\t\t\t\t" . '<div class="nv-pricing-title '. ( !empty( $icon ) ? 'icon' : '' ) .' '. $color .'"><h4>'.esc_attr($title).'</h4></div>';
			$output .= "\n\t\t\t\t" . '<div class="nv-pricing-container '.$color.'">';
			$output .= "\n\t\t\t\t\t" . '<div class="nv-pricing-cost"><span class="price-value">'. esc_attr($price) .'</span> <span class="price-per">'. esc_attr($per) .'</span></div>';
			$output .= "\n\t\t\t\t\t" . '<div class="nv-pricing-content">';
			$output .= "\n\t\t\t\t\t\t" . wpb_js_remove_wpautop($content);
			$output .= "\n\t\t\t\t\t" . '</div> ' . $this->endBlockComment('.nv-pricing-content');
				
			// Set Signup Button
			$button_type = '';
				
			if( $target !='' ) $target='target="'. $target .'"';
	
			if( $button_link == 'droppaneltrigger' && $button_text != '' )
			{
				$button_type='[droppanelbutton align="center" color="'.$color.'" ]'. esc_attr($button_text) .'[/droppanelbutton]';
			}
			elseif( $button_text != '' )
			{
				$button_type='[button url="'.esc_attr($button_link).'"  align="center" color="'. $color .'" '. $target .' ]'.esc_attr($button_text).'[/button]';
			}			
				
			if( $button_type != '' )
			{
				$output .= "\n\t\t\t\t\t" . '<div class="nv-pricing-signup">'. do_shortcode($button_type) .'</div>';
			}
				
			$output .= "\n\t\t\t\t" . '</div> ' . $this->endBlockComment('.nv-pricing-container');
			$output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.nv-pricing-plan');	
	
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
	
	class WPBakeryShortCode_Pricing_table extends WPBakeryShortCode {
	
		public function __construct($settings) {
			parent::__construct($settings);
		}
		
	
		protected function content( $atts, $content = null ) {
			$columns = $el_position = $el_class = '';
			//
			extract(shortcode_atts(array(
				'columns' => '',
				'el_position' => '',
				'el_class' => ''
			), $atts));
			$output = '';
	
			if( $columns != '' )
			{
				$columns = numberToWords ( $columns );
				$column_class = $columns .'-column';
			}		
	
			$el_class = $this->getExtraClass($el_class);
			$width = '';//wpb_translateColumnWidthToSpan($width);
			$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'nv-pricing-table clearfix '. $column_class .' wpb_content_element '.$width.$el_class.' not-column-inherit', $this->settings['base']);
	
			$output .= "\n\t".'<div class="'.$css_class.'">';
			$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
			$output .= "\n\t".'</div> '.$this->endBlockComment($width);
	
			//
			return $output;
		}
	
		public function contentAdmin( $atts, $content = NULL ) {
			$width = $custom_markup = '';
			$shortcode_attributes = array('width' => '1/1');
			foreach ( $this->settings['params'] as $param ) {
				if ( $param['param_name'] != 'content' ) {
					if (isset($param['value']) && is_string($param['value']) ) {
						$shortcode_attributes[$param['param_name']] = $param['value'];
					} elseif(isset($param['value'])) {
						$shortcode_attributes[$param['param_name']] = $param['value'];
					}
				} else if ( $param['param_name'] == 'content' && $content == NULL ) {
					$content = $param['value'];
				}
			}
			extract(shortcode_atts(
				$shortcode_attributes
				, $atts));
	
			$output = '';
	
			$elem = $this->getElementHolder($width);
	
			$inner = '';
			foreach ($this->settings['params'] as $param) {
				$param_value = '';
				$param_value = isset($$param['param_name']) ? $$param['param_name'] : '';
				if ( is_array($param_value)) {
					// Get first element from the array
					reset($param_value);
					$first_key = key($param_value);
					$param_value = $param_value[$first_key];
				}
				$inner .= $this->singleParamHtmlHolder($param, $param_value);
			}
	 
			$tmp = '';
	
			if ( isset($this->settings["custom_markup"]) && $this->settings["custom_markup"] != '' ) {
				if ( $content != '' ) {
					$custom_markup = str_ireplace("%content%", $tmp.$content, $this->settings["custom_markup"]);
				} else if ( $content == '' && isset($this->settings["default_content_in_template"]) && $this->settings["default_content_in_template"] != '' ) {
					$custom_markup = str_ireplace("%content%", $this->settings["default_content_in_template"], $this->settings["custom_markup"]);
				} else {
					$custom_markup =  str_ireplace("%content%", '', $this->settings["custom_markup"]);
				}
	 
				$inner .= do_shortcode($custom_markup);
			}
			$elem = str_ireplace('%wpb_element_content%', $inner, $elem);
			$output = $elem;
	
			return $output;
		}
	}

	/* ------------------------------------
	:: PRICING TABLE MAP
	------------------------------------*/	


	wpb_map( array(
	  "name" => __("Pricing Table", "js_composer"),
	  "base" => "pricing_table",
	  "show_settings_on_create" => false,
	  "is_container" => true,
	  "icon" => "icon-pricing",
	  "category" => __('Content', 'js_composer'),
	  "params" => array(
		array(
		  "type" => "textfield",
		  "heading" => __("Columns", "js_composer"),
		  "param_name" => "columns",
		),
		array(
		  "type" => "textfield",
		  "heading" => __("Extra class name", "js_composer"),
		  "param_name" => "el_class",
		  "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
		),
	  ),
	  "custom_markup" => '
	  <h4 class="wpb_element_title">'. __("Pricing Table", "js_composer") .'</h4>
	  <div class="wpb_pricing_table_holder wpb_holder clearfix vc_container_for_children">
	  %content%
	  </div>
	  <div class="tab_controls">
	  <button class="add_plan" title="'.__("Add Plan", "js_composer").'">'.__("Add Plan", "js_composer").'</button>
	  </div>
	  ',
	  'default_content' => '
	  [plan title="Plan"]<ul><li>List Item</li><li>List Item</li></ul>[/plan]
	  [plan title="Plan"]<ul><li>List Item</li><li>List Item</li></ul>[/plan]
	  [plan title="Featured Plan" featured="true" color="teal-lite"]<ul><li>List Item</li><li>List Item</li></ul>[/plan]
	  [plan title="Plan"]<ul><li>List Item</li><li>List Item</li></ul>[/plan]
	  ',
	  'admin_enqueue_js' => array(get_template_directory_uri().'/js/custom-views-extended.js'),
	  'js_view' => 'PricingTableView'
	) );
	
	wpb_map( array(
	  "name" => __("Plan Section", "js_composer"),
	  "base" => "plan",
  	  "content_element" => false,
      "is_container" => true,	  
	  "params" => array(
			array(
				"type" => "textfield",
				"heading" => __("Title", "js_composer"),
				"param_name" => "title",
				"holder" => "h4",
				"value" => "",
				"description" => __("Plan Title", "js_composer")
			),					
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Featured Plan", "js_composer"),
				"param_name" => "featured",
				"value" =>  array(
					__('Enable', "js_composer") => "true", 
				)
			),			
			array(
				"type" => "textfield",
				"heading" => __("Price", "js_composer"),
				"param_name" => "price",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"heading" => __("Per", "js_composer"),
				"param_name" => "per",
				"value" => "",
				"description" => __("E.g. / Month", "js_composer")
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
				"heading" => __("Content", "js_composer"),
				"param_name" => "content",
				"value" => __("<ul><li>List Item</li><li>List Item</li></ul>", "js_composer"),
			),	
			array(
				"type" => "textfield",
				"heading" => __("Button Text", "js_composer"),
				"param_name" => "button_text",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"heading" => __("Button Link", "js_composer"),
				"param_name" => "button_link",
				"value" => "",
				"description" => __("Enter 'droppaneltrigger' to trigger Drop Panel ( remove quotes )", "js_composer")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Link Target", "js_composer"),
				"param_name" => "target",
				"value" => array(
					__("Same window", "js_composer") => "_self", 
					__("New window", "js_composer") => "_blank"
				),
			),	
			array(
				"type" => "textfield",
				"heading" => __("Icon", "js_composer"),
				"param_name" => "icon",
				"value" => "",
				"description" => __("See Font Awesome <a href=\"http://fortawesome.github.io/Font-Awesome/icons/\" target=\"_blank\">Icons</a> : Enter Icon Name e.g.<strong> fa-compass</strong>", 			"js_composer")
			),	
			array(
				"type" => "colorpicker",
				"heading" => __("Icon Color", "js_composer"),
				"param_name" => "icon_color",
				"value" => "",
				"dependency" => Array('element' => 'icon', 'not_empty' => true),
			),
			array(
				"type" => "colorpicker",
				"heading" => __("Icon Background Color", "js_composer"),
				"param_name" => "icon_background",
				"value" => "",
				"dependency" => Array('element' => 'icon', 'not_empty' => true),
			),									
	  	),
		'js_view' => 'PlanView'
	) );
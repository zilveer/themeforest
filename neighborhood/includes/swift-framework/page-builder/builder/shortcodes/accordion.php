<?php
	
	/*
	*
	*	Swift Page Builder - Blog Shortcode
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	/* ACCORDION ASSET
	================================================== */ 
	class SwiftPageBuilderShortcode_spb_accordion_tab extends SwiftPageBuilderShortcode {
	
	
	    protected function content( $atts, $content = null ) {
	        $title = '';
	
	        extract(shortcode_atts(array(
	            'title' => __("Section", "swiftframework")
	        ), $atts));
	
	        $output = '';
	        
	        $output .= "\n\t\t\t" . '<div class="spb_accordion_section group">';
	        $output .= "\n\t\t\t\t" . '<h3><a href="#">'.$title.'</a></h3>';
	        //$output .= "\n\t\t\t\t" . '<div><div class="row-fluid">';
	        $output .= "\n\t\t\t\t" . '<div class="row-fluid">';
	        $output .= "\n\t\t\t\t" . spb_js_remove_wpautop($content);
	        $output .= "\n\t\t\t\t" . '</div>';
	        //$output .= "\n\t\t\t\t" . '</div></div>';
	        $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.spb_accordion_section') . "\n";
	
	        return $output;
	    }
	
	    public function contentAdmin( $atts, $content = null ) {
	        $title = '';
	        $defaults = array( 'title' => __('Section', "swiftframework") );
	        extract( shortcode_atts( $defaults, $atts ) );
	
	        return '<div class="group">
			<h3><a class="title-text" href="#">'.$title.'</a><a class="delete_tab"></a><a class="edit_tab"></a></h3>
			<div>
				<div class="row-fluid spb_column_container not-column-inherit">
					'. do_shortcode($content) . SwiftPageBuilder::getInstance()->getLayout()->getContainerHelper() . '
				</div>
			</div>
		    </div>';
	    }
	}
	
	class SwiftPageBuilderShortcode_spb_accordion extends SwiftPageBuilderShortcode {
	
	    public function __construct($settings) {
	        parent::__construct($settings);
	        SwiftPageBuilder::getInstance()->addShortCode( array( 'base' => 'spb_accordion_tab' ) );
	    }
	
	    protected function content( $atts, $content = null ) {
	        wp_enqueue_script('sf-jquery-ui');
	        $widget_title = $type = $active_section = $interval = $width = $el_position = $el_class = '';
	        //
	        extract(shortcode_atts(array(
	            'widget_title' => '',
	            'interval' => 0,
	            'active_section' => '',
	            'width' => '1/1',
	            'el_position' => '',
	            'el_class' => ''
	        ), $atts));
	        $output = '';
	
	        $el_class = $this->getExtraClass($el_class);
	        $width = spb_translateColumnWidthToSpan($width);
	
	        $output .= "\n\t".'<div class="spb_accordion spb_content_element '.$width.$el_class.' not-column-inherit" data-active="'.$active_section.'">'; //data-interval="'.$interval.'"
	        $output .= ($widget_title != '' ) ? "\n\t\t\t".'<h4 class="spb_heading spb_accordion_heading"><span>'.$widget_title.'</span></h4>' : '';
	        $output .= "\n\t\t".'<div class="spb_wrapper spb_accordion_wrapper ">';
	        $output .= "\n\t\t\t".spb_js_remove_wpautop($content);
	        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
	        $output .= "\n\t".'</div> '.$this->endBlockComment($width);
	
	        
	        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
	        return $output;
	    }
	
	    public function contentAdmin( $atts, $content ) {
	        $width = $custom_markup = '';
	        $shortcode_attributes = array('width' => '1/1');
	        foreach ( $this->settings['params'] as $param ) {
	            if ( $param['param_name'] != 'content' ) {
	                if ( is_string($param['value']) ) {
	                    $shortcode_attributes[$param['param_name']] = __($param['value'], "swiftframework");
	                } else {
	                    $shortcode_attributes[$param['param_name']] = $param['value'];
	                }
	            } else if ( $param['param_name'] == 'content' && $content == NULL ) {
	                $content = __($param['value'], "swiftframework");
	            }
	        }
	        extract(shortcode_atts(
	            $shortcode_attributes
	            , $atts));
	
	        $output = '';
	
	        $elem = $this->getElementHolder($width);
	
	        $iner = '';
	        foreach ($this->settings['params'] as $param) {
	            $param_value = isset(${$param['param_name']}) ? ${$param['param_name']} : null;
	
	            if ( is_array($param_value)) {
	                // Get first element from the array
	                reset($param_value);
	                $first_key = key($param_value);
	                $param_value = $param_value[$first_key];
	            }
	            $iner .= $this->singleParamHtmlHolder($param, $param_value);
	        }
	        //$elem = str_ireplace('%spb_element_content%', $iner, $elem);
	        $tmp = '';
	        if ( isset($this->settings["custom_markup"]) && $this->settings["custom_markup"] != '' ) {
	            if ( $content != '' ) {
	                $custom_markup = str_ireplace("%content%", $tmp.$content, $this->settings["custom_markup"]);
	            } else if ( $content == '' && isset($this->settings["default_content"]) && $this->settings["default_content"] != '' ) {
	                $custom_markup = str_ireplace("%content%", $this->settings["default_content"], $this->settings["custom_markup"]);
	            }
	            //$output .= do_shortcode($this->settings["custom_markup"]);
	            $iner .= do_shortcode($custom_markup);
	        }
	        $elem = str_ireplace('%spb_element_content%', $iner, $elem);
	        $output = $elem;
	
	        return $output;
	    }
	}
		
	SPBMap::map( 'spb_accordion', array(
	    "name"		=> __("Accordion", "swiftframework"),
	    "base"		=> "spb_accordion",
	    "controls"	=> "full",
	    "class"		=> "spb_accordion",
		"icon"		=> "spb-icon-accordion",
	    "params"	=> array(
	        array(
	            "type" => "textfield",
	            "heading" => __("Widget title", "swiftframework"),
	            "param_name" => "widget_title",
	            "value" => "",
	            "description" => __("What text use as widget title. Leave blank if no title is needed.", "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Active Section", "swiftframework"),
	            "param_name" => "active_section",
	            "value" => "",
	            "description" => __("You can set the section that is active here by entering the number of the section here. NOTE: The first section would be 0, second would be 1, and so on. Leave blank for all sections to be closed by default.", "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Extra class name", "swiftframework"),
	            "param_name" => "el_class",
	            "value" => "",
	            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swiftframework")
	        )
	    ),
	    "custom_markup" => '
		<div class="tab_controls">
			<button class="add_tab">'.__("Add section", "swiftframework").'</button>
		</div>
	
		<div class="spb_accordion_holder clearfix">
			%content%
		</div>',
	    'default_content' => '
		<div class="group">
			<h3><a class="title-text" href="#">'.__('Section 1', "swiftframework").'</a><a class="delete_tab"></a><a class="edit_tab"></a></h3>
			<div>
				<div class="row-fluid spb_column_container spb_sortable_container not-column-inherit">
					[spb_text_block width="1/1"] '.__('This is a text block. Click the edit button to change this text.', "swiftframework").' [/spb_text_block]
				</div>
			</div>
		</div>
		<div class="group">
			<h3><a class="title-text" href="#">'.__('Section 2', "swiftframework").'</a><a class="delete_tab"></a><a class="edit_tab"></a></h3>
			<div>
				<div class="row-fluid spb_column_container spb_sortable_container not-column-inherit">
					[spb_text_block width="1/1"] '.__('This is a text block. Click the edit button to change this text.', "swiftframework").' [/spb_text_block]
				</div>
			</div>
		</div>',
	    "js_callback" => array("init" => "spbAccordionInitCallBack", "shortcode" => "spbAccordionGenerateShortcodeCallBack")
	) );
?>
<?php
	
	/*
	*
	*	Swift Page Builder - Tabs Shortcode
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	/* TABS ASSET
	================================================== */ 
	class SwiftPageBuilderShortcode_spb_tab extends SwiftPageBuilderShortcode {
	    public function content( $atts, $content = null ) {
	        $title = '';
	        extract(shortcode_atts(array(
	            'title' => __("Tab", "swiftframework")
	        ), $atts));
	        $output = '';
	        $output .= "\n\t\t\t" . '<div id="'.preg_replace("#[[:punct:]]#", "", (strtolower(str_replace(' ', '-', $title)))).'" class="tab-pane">';
	        $output .= "\n\t\t\t\t" . spb_js_remove_wpautop($content);
	        $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.spb_tab');
	        return $output;
	    }
	
	    public function contentAdmin($atts, $content) {
	        $title = '';
	        $defaults = array( 'title' => __('Tab', "swiftframework") );
	        extract( shortcode_atts( $defaults, $atts ) );
	
	        return '<div id="tab-'. sanitize_title( $title ) .'" class="row-fluid spb_column_container spb_sortable_container not-column-inherit">'. do_shortcode($content) . SwiftPageBuilder::getInstance()->getLayout()->getContainerHelper() . '</div>';
	    }
	}
	
	class SwiftPageBuilderShortcode_spb_tabs extends SwiftPageBuilderShortcode {
	
	    public function __construct($settings) {
	        parent::__construct($settings);
	        SwiftPageBuilder::getInstance()->addShortCode( array( 'base' => 'spb_tab' ) );
	    }
	
	    public function contentAdmin($atts, $content = null) {
	        $width = $custom_markup = '';
	        $shortcode_attributes = array('width' => '1/1');
	        foreach ( $this->settings['params'] as $param ) {
	            if ( $param['param_name'] != 'content' ) {
	                //$shortcode_attributes[$param['param_name']] = $param['value'];
	                if ( is_string($param['value']) ) {
	                    $shortcode_attributes[$param['param_name']] = __($param['value'], "swiftframework");
	                } else {
	                    $shortcode_attributes[$param['param_name']] = $param['value'];
	                }
	            } else if ( $param['param_name'] == 'content' && $content == NULL ) {
	                //$content = $param['value'];
	                $content = __($param['value'], "swiftframework");
	            }
	        }
	        extract(shortcode_atts(
	            $shortcode_attributes
	            , $atts));
	
	        // Extract tab titles
	        preg_match_all( '/spb_tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
	        $tab_titles = array();
	        if ( isset($matches[1]) ) { $tab_titles = $matches[1]; }
	
	        $output = '';
	
	        $tmp = '';
	        if ( count($tab_titles) ) {
	            $tmp .= '<ul class="clearfix">';
	            foreach ( $tab_titles as $tab ) {
	                $tmp .= '<li><a href="#tab-'. sanitize_title( $tab[0] ) .'"><span>' . $tab[0] . '</span></a><a class="edit_tab"></a><a class="delete_tab"></a></li>';
	            }
	            $tmp .= '</ul>';
	        } else {
	            $output .= do_shortcode( $content );
	        }
	        $elem = $this->getElementHolder($width);
	
	        $iner = '';
	        foreach ($this->settings['params'] as $param) {
	            $custom_markup = '';
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
	
	        if ( isset($this->settings["custom_markup"]) &&$this->settings["custom_markup"] != '' ) {
	            if ( $content != '' ) {
	                $custom_markup = str_ireplace("%content%", $tmp.$content, $this->settings["custom_markup"]);
	            } else if ( $content == '' && isset($this->settings["default_content"]) && $this->settings["default_content"] != '' ) {
	                $custom_markup = str_ireplace("%content%",$this->settings["default_content"],$this->settings["custom_markup"]);
	            }
	            //$output .= do_shortcode($this->settings["custom_markup"]);
	            $iner .= do_shortcode($custom_markup);
	        }
	        $elem = str_ireplace('%spb_element_content%', $iner, $elem);
	        $output = $elem;
	
	        return $output;
	    }
	
	    public function content($atts, $content =null) {
	        $tab_asset_title = $type = $interval = $width = $el_position = $el_class = '';
	        extract(shortcode_atts(array(
	            'tab_asset_title' => '',
	            'interval' => 0,
	            'width' => '1/1',
	            'el_position' => '',
	            'el_class' => ''
	        ), $atts));
	        $output = '';
	
	        $el_class = $this->getExtraClass($el_class);
	        $width = spb_translateColumnWidthToSpan($width);
	
	        $element = 'spb_tabs';
	        if ( 'spb_tour' == $this->shortcode) $element = 'spb_tour';
	
	        // Extract tab titles
	        preg_match_all( '/spb_tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
	        $tab_titles = array();
	        if ( isset($matches[1]) ) { $tab_titles = $matches[1]; }
	        $tabs_nav = '';
	        $tab_count = 0;
	        
	        $tabs_nav .= '<ul class="nav nav-tabs">';
	        foreach ( $tab_titles as $tab ) {
	        	if ($tab_count == 0) {
	            $tabs_nav .= '<li class="active"><a href="#'. preg_replace("#[[:punct:]]#", "", (strtolower(str_replace(' ', '-', $tab[0])))) .'" data-toggle="tab">' . $tab[0] . '</a></li>';
	        	} else {
	            $tabs_nav .= '<li><a href="#'. preg_replace("#[[:punct:]]#", "", (strtolower(str_replace(' ', '-', $tab[0])))) .'" data-toggle="tab">' . $tab[0] . '</a></li>';        	
	        	}
	        	$tab_count++;
	        }
	        $tabs_nav .= '</ul>'."\n";
	
	        $output .= "\n\t".'<div class="'.$element.' spb_content_element '.$width.$el_class.'" data-interval="'.$interval.'">';
	        $output .= "\n\t\t".'<div class="spb_wrapper spb_tabs_wrapper">';
	        $output .= ($tab_asset_title != '' ) ? "\n\t\t\t".'<h4 class="spb_heading '.$element.'_heading"><span>'.$tab_asset_title.'</span></h4>' : '';
	        $output .= "\n\t\t\t".$tabs_nav;
	        $output .= "\n\t\t\t" . '<div class="tab-content">';
	        $output .= "\n\t\t\t".spb_js_remove_wpautop($content);
	       	$output .= "\n\t\t\t" . '</div>';
	        if ( 'spb_tour' == $this->shortcode) {
	            $output .= "\n\t\t\t" . '<div class="spb_tour_next_prev_nav"> <span class="spb_prev_slide"><a href="#prev" title="'.__('Previous slide').'">'.__('Previous slide').'</a></span> <span class="spb_next_slide"><a href="#next" title="'.__('Next slide').'">'.__('Next slide').'</a></span></div>';
	        }
	        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
	        $output .= "\n\t".'</div> '.$this->endBlockComment($width);
	
	        //
	        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
	        return $output;
	    }
	}
	
	SPBMap::map( 'spb_tabs', array(
	    "name"		=> __("Tabs", "swiftframework"),
	    "base"		=> "spb_tabs",
	    "controls"	=> "full",
	    "class"		=> "spb_tabs",
		"icon"		=> "spb-icon-tabs",
	    "params"	=> array(
	        array(
	            "type" => "textfield",
	            "heading" => __("Widget title", "swiftframework"),
	            "param_name" => "tab_asset_title",
	            "value" => "",
	            "description" => __("What text use as widget title. Leave blank if no title is needed.", "swiftframework")
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
			<button class="add_tab">'.__("Add New Tab", "swiftframework").'</button>
	</div>
	
		<div class="spb_tabs_holder">
			%content%
		</div>',
	    'default_content' => '
		<ul>
			<li><a href="#tab-1"><span>'.__('Tab 1', "swiftframework").'</span></a><a class="edit_tab"></a><a class="delete_tab"></a></li>
			<li><a href="#tab-2"><span>'.__('Tab 2', "swiftframework").'</span></a><a class="edit_tab"></a><a class="delete_tab"></a></li>
		</ul>
	
		<div id="tab-1" class="row-fluid spb_column_container spb_sortable_container not-column-inherit">
			[spb_text_block width="1/1"] '.__('This is a text block. Click the edit button to change this text.', "swiftframework").' [/spb_text_block]
		</div>
	
		<div id="tab-2" class="row-fluid spb_column_container spb_sortable_container not-column-inherit">
			[spb_text_block width="1/1"] '.__('This is a text block. Click the edit button to change this text.', "swiftframework").' [/spb_text_block]
		</div>',
	    "js_callback" => array("init" => "spbTabsInitCallBack", "shortcode" => "spbTabsGenerateShortcodeCallBack")
	    //"js_callback" => array("init" => "spbTabsInitCallBack", "edit" => "spbTabsEditCallBack", "save" => "spbTabsSaveCallBack", "shortcode" => "spbTabsGenerateShortcodeCallBack")
	) );
?>
<?php

class WPBakeryShortCode_search_widget extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

		    $width = $pb_margin_bottom = $pb_border_bottom = $pb_border_top = $el_class = $output = $search_form = $el_position = '';
		
	        extract(shortcode_atts(array(
	        	'el_position' => '',
	        	'search_input_text' => '',
	        	'pb_margin_bottom' => 'no',
	        	'pb_border_bottom' => 'no',
	        	'pb_border_top' => 'no',
	        	'width' => '1/1',
	        	'twitter_username' => '',
	        	'el_class' => ''
	        ), $atts));
	        
	        if ($pb_margin_bottom == "yes") {
	        $el_class .= ' pb-margin-bottom';
	        }
	        if ($pb_border_bottom == "yes") {
	        $el_class .= ' pb-border-bottom';
	        }
	        if ($pb_border_top == "yes") {
	        $el_class .= ' pb-border-top';
	        }
	        
    		$el_class = $this->getExtraClass($el_class);
            $width = wpb_translateColumnWidthToSpan($width);
            
            $search_form .= '<form method="get" class="search-form search-widget" action="'.get_home_url().'/">';
            $search_form .= '<input type="text" placeholder="'.$search_input_text.'" name="sf-search" />';
            $search_form .= '</form>';
            
            $output .= "\n\t".'<div class="wpb_search_widget wpb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="wpb_wrapper latest-tweet-bar-wrap clearfix">';
            $output .= "\n\t\t\t".$search_form;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            return $output;
		
    }
}

WPBMap::map( 'search_widget', array(
    "name"		=> __("Search", "js_composer"),
    "base"		=> "search_widget",
    "class"		=> "wpb_search_widget",
    "icon"      => "icon-wpb-search",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Input placeholder text", "js_composer"),
    	    "param_name" => "search_input_text",
    	    "value" => "Search",
    	    "description" => __("Enter the text that appearas as default in the search input.", "js_composer")
    	),
    	array(
    	    "type" => "dropdown",
    	    "heading" => __("Margin below widget", "js_composer"),
    	    "param_name" => "pb_margin_bottom",
    	    "value" => array(__('No', "js_composer") => "no", __('Yes', "js_composer") => "yes"),
    	    "description" => __("Add a bottom margin to the widget.", "js_composer")
    	),
    	array(
    	    "type" => "dropdown",
    	    "heading" => __("Border below widget", "js_composer"),
    	    "param_name" => "pb_border_bottom",
    	    "value" => array(__('No', "js_composer") => "no", __('Yes', "js_composer") => "yes"),
    	    "description" => __("Add a bottom border to the widget.", "js_composer")
    	),
    	array(
    	    "type" => "dropdown",
    	    "heading" => __("Border above widget", "js_composer"),
    	    "param_name" => "pb_border_top",
    	    "value" => array(__('No', "js_composer") => "no", __('Yes', "js_composer") => "yes"),
    	    "description" => __("Add a top border to the widget.", "js_composer")
    	),
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Extra class name", "js_composer"),
    	    "param_name" => "el_class",
    	    "value" => "",
    	    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
    	)
    )
) );

?>
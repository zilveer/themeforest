<?php

class SwiftPageBuilderShortcode_search_widget extends SwiftPageBuilderShortcode {

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
            $width = spb_translateColumnWidthToSpan($width);
            
            $search_form .= '<form method="get" class="search-form search-widget" action="'.get_home_url().'/">';
            $search_form .= '<input type="text" placeholder="'.$search_input_text.'" name="s" />';
            $search_form .= '</form>';
            
            $output .= "\n\t".'<div class="spb_search_widget spb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="spb_wrapper latest-tweet-bar-wrap clearfix">';
            $output .= "\n\t\t\t".$search_form;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            return $output;
		
    }
}

SPBMap::map( 'search_widget', array(
    "name"		=> __("Search", "swift-framework-admin"),
    "base"		=> "search_widget",
    "class"		=> "spb_search_widget",
    "icon"      => "spb-icon-search",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Input placeholder text", "swift-framework-admin"),
    	    "param_name" => "search_input_text",
    	    "value" => "Search",
    	    "description" => __("Enter the text that appearas as default in the search input.", "swift-framework-admin")
    	),
    	array(
    	    "type" => "dropdown",
    	    "heading" => __("Margin below widget", "swift-framework-admin"),
    	    "param_name" => "pb_margin_bottom",
    	    "value" => array(__('No', "swift-framework-admin") => "no", __('Yes', "swift-framework-admin") => "yes"),
    	    "description" => __("Add a bottom margin to the widget.", "swift-framework-admin")
    	),
    	array(
    	    "type" => "dropdown",
    	    "heading" => __("Border below widget", "swift-framework-admin"),
    	    "param_name" => "pb_border_bottom",
    	    "value" => array(__('No', "swift-framework-admin") => "no", __('Yes', "swift-framework-admin") => "yes"),
    	    "description" => __("Add a bottom border to the widget.", "swift-framework-admin")
    	),
    	array(
    	    "type" => "dropdown",
    	    "heading" => __("Border above widget", "swift-framework-admin"),
    	    "param_name" => "pb_border_top",
    	    "value" => array(__('No', "swift-framework-admin") => "no", __('Yes', "swift-framework-admin") => "yes"),
    	    "description" => __("Add a top border to the widget.", "swift-framework-admin")
    	),
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Extra class name", "swift-framework-admin"),
    	    "param_name" => "el_class",
    	    "value" => "",
    	    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swift-framework-admin")
    	)
    )
) );

?>
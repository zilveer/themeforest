<?php

	/*
	*
	*	Swift Page Builder - Sidebar Widget Shortcode
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*/

class SwiftPageBuilderShortcode_sidebar_widget extends SwiftPageBuilderShortcode {

    protected function content($atts, $content = null) {
	
		$output = $el_position = $title = $width = $el_class = $sidebar_id = '';
		
		extract(shortcode_atts(array(
		'el_position' => '',
		'width' => '1/1',
		'el_class' => '',
		'sidebar_id' => ''
		), $atts));
		
		if ( $sidebar_id == '' ) { echo 'Sidebar ID not set.'; return null; }

		$el_class = $this->getExtraClass($el_class);

		ob_start();
		dynamic_sidebar($sidebar_id);
		$sidebar_value = ob_get_contents();
		ob_end_clean();

		$sidebar_value = trim($sidebar_value);
		$sidebar_value = (substr($sidebar_value, 0, 3) == '<li' ) ? '<ul>'.$sidebar_value.'</ul>' : $sidebar_value;//
		
    	$el_class = $this->getExtraClass($el_class);
        $width = spb_translateColumnWidthToSpan($width);
		
        $output .= "\n\t".'<div class="spb_sidebar_widget spb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="spb_wrapper clearfix">';
		$output .= "\n\t\t\t".$sidebar_value;
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);
		
		$output = $this->startRow($el_position) . $output . $this->endRow($el_position);
		return $output;
	}
}

SPBMap::map( 'sidebar_widget', array(
    "name"		=> __("Widget Sidebar", "swift-framework-admin"),
    "base"		=> "sidebar_widget",
    "class"		=> "spb_sidebar_widget",
    "icon"      => "spb-icon-sidebar",
    "params"	=> array(
    	array(
    	    "type" => "widgetised_sidebars",
    	    "heading" => __("Select Sidebar:", "swift-framework-admin"),
    	    "param_name" => "sidebar_id",
    	    "value" => "Sidebar",
    	    "description" => __("Select an existing sidebar to add to the page.", "swift-framework-admin")
    	)
	)
	) 
);
<?php
	/*
	*
	*	Swift Page Builder - Button Shortcodes
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/

	/* IMPACT TEXT ASSET
	================================================== */ 
	class SwiftPageBuilderShortcode_impact_text extends SwiftPageBuilderShortcode {
	
	    protected function content( $atts, $content = null ) {
	        $color = $type = $size = $target = $href = $border_top = $include_button = $button_style = $border_bottom = $title = $width = $position = $el_class = '';
	        extract(shortcode_atts(array(
	            'color' => 'btn',
	            'include_button' => '',
	            'button_style' => '',
	            'size' => '',
	            'target' => '',
	            'type'	=> '',
	            'href' => '',
	            'shadow'		=> 'yes',
	            'title' => __('Text on the button', "swiftframework"),
	            'position' => 'cta_align_right',
	            'alt_background'	=> 'none',
	            'width' => '1/1',
	            'el_class' => '',
	            'el_position' => '',
	        ), $atts));
	        $output = '';
	        
	        $border_class = '';
	        
	        if ($border_top == "yes") {
	        $border_class .= 'border-top ';
	        }
	        if ($border_bottom == "yes") {
	        $border_class .= 'border-bottom';
	        }
	
			$width = spb_translateColumnWidthToSpan($width);
	        $el_class = $this->getExtraClass($el_class);
	        
	        $sidebar_config = sf_get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
	        
	        $sidebars = '';
	        if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
	        $sidebars = 'one-sidebar';
	        } else if ($sidebar_config == "both-sidebars") {
	        $sidebars = 'both-sidebars';
	        } else {
	        $sidebars = 'no-sidebars';
	        }
	
	        if ( $target == 'same' || $target == '_self' ) { $target = '_self'; }
	        if ( $target != '' ) { $target = $target; }
	
	        $size = ( $size != '' ) ? ' '.$size : '';
	
	        $a_class = '';
	        if ( $el_class != '' ) {
	            $tmp_class = explode(" ", $el_class);
	        }
	        
	        $button = '';
	        
	        if (($type == "squarearrow") || ($type == "slightlyroundedarrow") || ($type == "roundedarrow")) {
	        	$button = '<a class="spb_button sf-button'.$size.' '. $color .' '. $type .'" href="'.$href.'" target="'.$target.'"><span>' . $title . '</span><span class="arrow"></span></a>';
	        } else {
	        	$button = '<a class="spb_button sf-button'.$size.' '. $color .' '. $type .'" href="'.$href.'" target="'.$target.'"><span>' . $title . '</span></a>';
	        }
	        
	        if ($button_style == "arrow") {
	        
		        if ($position == "cta_align_left") {
		        	$button = '<a class="impact-text-arrow arrow-left" href="'.$href.'" target="'.$target.'"><i class="fa-angle-left"></i></a>';
		        } else { 
		        	$button = '<a class="impact-text-arrow arrow-right" href="'.$href.'" target="'.$target.'"><i class="fa-angle-right"></i></a>';
		        }
	        
	        }
	        
	        // Full width setup
	        $fullwidth = false;
	        if ($alt_background != "none" && $sidebars == "no-sidebars") {
	        $fullwidth = true;
	        }
	        
	        $output .= '<div class="spb_impact_text spb_content_element clearfix '.$width.' '.$position.$el_class.'">'. "\n";
	        $output .= '<div class="impact-text-wrap clearfix">'. "\n";
	        $output .= '<div class="spb_call_text">'. spb_js_remove_wpautop($content) . '</div>'. "\n";
	        if ($include_button == "yes") {
	        $output .= $button. "\n";
	        }
	        $output .= '</div>'. "\n";
	        $output .= '</div> ' . $this->endBlockComment('.spb_impact_text') . "\n";
			
			$output = $this->startRow($el_position, $width, $fullwidth, false, $alt_background) . $output . $this->endRow($el_position, $width, $fullwidth, false);
			
	        return $output;
	    }
	}
	
	$colors_arr = array(__("Accent", "swiftframework") => "accent", __("Blue", "swiftframework") => "blue", __("Grey", "swiftframework") => "grey", __("Light grey", "swiftframework") => "lightgrey", __("Purple", "swiftframework") => "purple", __("Light Blue", "swiftframework") => "lightblue", __("Green", "swiftframework") => "green", __("Lime Green", "swiftframework") => "limegreen", __("Turquoise", "swiftframework") => "turquoise", __("Pink", "swiftframework") => "pink", __("Orange", "swiftframework") => "orange");
	
	$size_arr = array(__("Normal", "swiftframework") => "normal", __("Large", "swiftframework") => "large");
	
	$type_arr = array(__("Standard", "swiftframework") => "standard", __("Square with arrow", "swiftframework") => "squarearrow", __("Slightly rounded", "swiftframework") => "slightlyrounded", __("Slightly rounded with arrow", "swiftframework") => "slightlyroundedarrow", __("Rounded", "swiftframework") => "rounded", __("Rounded with arrow", "swiftframework") => "roundedarrow", __("Outer glow effect", "swiftframework") => "outerglow", __("Drop shadow effect", "swiftframework") => "dropshadow");
	
	
	$target_arr = array(__("Same window", "swiftframework") => "_self", __("New window", "swiftframework") => "_blank");
	
	SPBMap::map( 'impact_text', array(
	    "name"		=> __("Impact Text + Button", "swiftframework"),
	    "base"		=> "impact_text",
	    "class"		=> "button_grey",
		"icon"		=> "spb-icon-impact-text",
	    "controls"	=> "edit_popup_delete",
	    "params"	=> array(
	    	array(
	    	    "type" => "dropdown",
	    	    "heading" => __("Include button", "swiftframework"),
	    	    "param_name" => "include_button",
	    	    "value" => array(__("Yes", "swiftframework") => "yes", __("No", "swiftframework") => "no"),
	    	    "description" => __("Include a button in the asset.", "swiftframework")
	    	),
	    	array(
	    	    "type" => "dropdown",
	    	    "heading" => __("Button Style", "swiftframework"),
	    	    "param_name" => "button_style",
	    	    "value" => array(__("Standard", "swiftframework") => "standard", __("Arrow", "swiftframework") => "arrow"),
	    	),
	        array(
	            "type" => "textfield",
	            "heading" => __("Text on the button", "swiftframework"),
	            "param_name" => "title",
	            "value" => __("Text on the button", "swiftframework"),
	            "description" => __("Text on the button.", "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("URL (Link)", "swiftframework"),
	            "param_name" => "href",
	            "value" => "",
	            "description" => __("Button link.", "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Color", "swiftframework"),
	            "param_name" => "color",
	            "value" => $colors_arr,
	            "description" => __("Button color.", "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Size", "swiftframework"),
	            "param_name" => "size",
	            "value" => $size_arr,
	            "description" => __("Button size.", "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Type", "swiftframework"),
	            "param_name" => "type",
	            "value" => $type_arr
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Target", "swiftframework"),
	            "param_name" => "target",
	            "value" => $target_arr
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Button position", "swiftframework"),
	            "param_name" => "position",
	            "value" => array(__("Align right", "swiftframework") => "cta_align_right", __("Align left", "swiftframework") => "cta_align_left", __("Align bottom", "swiftframework") => "cta_align_bottom"),
	            "description" => __("Select button alignment.", "swiftframework")
	        ),
	        array(
	            "type" => "textarea_html",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __("Text", "swiftframework"),
	            "param_name" => "content",
	            "value" => __("click the edit button to change this text.", "swiftframework"),
	            "description" => __("Enter your content.", "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Show alt background", "swiftframework"),
	            "param_name" => "alt_background",
	            "value" => array(__("None", "swiftframework") => "none", __("Alt 1", "swiftframework") => "alt-one", __("Alt 2", "swiftframework") => "alt-two", __("Alt 3", "swiftframework") => "alt-three", __("Alt 4", "swiftframework") => "alt-four", __("Alt 5", "swiftframework") => "alt-five", __("Alt 6", "swiftframework") => "alt-six", __("Alt 7", "swiftframework") => "alt-seven", __("Alt 8", "swiftframework") => "alt-eight", __("Alt 9", "swiftframework") => "alt-nine", __("Alt 10", "swiftframework") => "alt-ten"),
	            "description" => __("Show an alternative background around the asset. These can all be set in Neighborhood Options > Asset Background Options. NOTE: This is only available on a page with the no sidebar setup.", "swiftframework")
	        ),
	        array(
	            "type" => "altbg_preview",
	            "heading" => __("Alt Background Preview", "swiftframework"),
	            "param_name" => "altbg_preview",
	            "value" => "",
	            "description" => __("", "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Extra class name", "swiftframework"),
	            "param_name" => "el_class",
	            "value" => "",
	            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swiftframework")
	        )
	    ),
	    "js_callback" => array("init" => "spbCallToActionInitCallBack", "save" => "spbCallToActionSaveCallBack")
	) );	
?>
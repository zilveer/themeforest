<?php
	/*
	*
	*	Swift Page Builder - Imapact Text Shortcode
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*/

	class SwiftPageBuilderShortcode_impact_text extends SwiftPageBuilderShortcode {
	
	    protected function content( $atts, $content = null ) {
	        $color = $type = $target = $href = $border_top = $include_button = $button_style = $border_bottom = $title = $width = $position = $el_class = '';
	        extract(shortcode_atts(array(
	            'color' => 'btn',
	            'include_button' => '',
	            'button_style' => '',
	            'target' => '',
	            'type'	=> '',
	            'href' => '',
	            'shadow'		=> 'yes',
	            'title' => __('Text on the button', "swift-framework-admin"),
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
		
	        $a_class = '';
	        if ( $el_class != '' ) {
	            $tmp_class = explode(" ", $el_class);
	            if ( in_array("prettyphoto", $tmp_class) ) {
	                wp_enqueue_script( 'prettyphoto' );
	                wp_enqueue_style( 'prettyphoto' );
	                $a_class .= ' prettyphoto'; $el_class = str_ireplace("prettyphoto", "", $el_class);
	            }
	        }
	        
	        $button = '';
	        
	        if ($button_style == "arrow") {
	        
		        if ($position == "cta_align_left") {
		        	$button = '<a class="impact-text-arrow arrow-left" href="'.$href.'" target="'.$target.'"><i class="ss-navigateleft"></i></a>';
		        } else { 
		        	$button = '<a class="impact-text-arrow arrow-right" href="'.$href.'" target="'.$target.'"><i class="ss-navigateright"></i></a>';
		        }
	        
	        } else {
	        	$button = '<a class="sf-button sf-button '. $color .' '. $type .'" href="'.$href.'" target="'.$target.'"><span>' . $title . '</span></a>';
	        }
	        
	        // Full width setup
	        $fullwidth = false;
	        if ($alt_background != "none" && $sidebars == "no-sidebars") {
	        $fullwidth = true;
	        }
	             
	        $output .= "\n\t".'<div class="spb_impact_text spb_content_element '.$width.$el_class.'">'; 
	        if ($alt_background != "none") {
	        $output .= '<div class="impact-text-wrap '.$position.' asset-bg '.$alt_background.' clearfix">'. "\n";
	        } else {    
	        $output .= '<div class="impact-text-wrap '.$position.' clearfix">'. "\n";
	        }
	        $output .= '<div class="spb_call_text">'. spb_format_content($content) . '</div>'. "\n";
	        if ($include_button == "yes") {
	        $output .= $button. "\n";
	        }
	        $output .= '</div>'. "\n";
	        $output .= '</div> ' . $this->endBlockComment('.spb_impact_text') . "\n";
			
			$output = $this->startRow($el_position, $width, false, false, $alt_background) . $output . $this->endRow($el_position, $width, false, false);
			
	        return $output;
	    }
	}
	
	$colors_arr = array(__("Accent", "swift-framework-admin") => "accent", __("Blue", "swift-framework-admin") => "blue", __("Grey", "swift-framework-admin") => "grey", __("Light grey", "swift-framework-admin") => "lightgrey", __("Purple", "swift-framework-admin") => "purple", __("Light Blue", "swift-framework-admin") => "lightblue", __("Green", "swift-framework-admin") => "green", __("Lime Green", "swift-framework-admin") => "limegreen", __("Turquoise", "swift-framework-admin") => "turquoise", __("Pink", "swift-framework-admin") => "pink", __("Orange", "swift-framework-admin") => "orange");
			
	$target_arr = array(__("Same window", "swift-framework-admin") => "_self", __("New window", "swift-framework-admin") => "_blank");
	
	SPBMap::map( 'impact_text', array(
	    "name"		=> __("Impact Text + Button", "swift-framework-admin"),
	    "base"		=> "impact_text",
	    "class"		=> "button_grey",
		"icon"		=> "spb-icon-impact-text",
	    "controls"	=> "edit_popup_delete",
	    "params"	=> array(
	    	array(
	    	    "type" => "dropdown",
	    	    "heading" => __("Include button", "swift-framework-admin"),
	    	    "param_name" => "include_button",
	    	    "value" => array(__("Yes", "swift-framework-admin") => "yes", __("No", "swift-framework-admin") => "no"),
	    	    "description" => __("Include a button in the asset.", "swift-framework-admin")
	    	),
	    	array(
	    	    "type" => "dropdown",
	    	    "heading" => __("Button Style", "swift-framework-admin"),
	    	    "param_name" => "button_style",
	    	    "value" => array(__("Standard", "swift-framework-admin") => "standard", __("Arrow", "swift-framework-admin") => "arrow"),
	    	),
	        array(
	            "type" => "textfield",
	            "heading" => __("Text on the button", "swift-framework-admin"),
	            "param_name" => "title",
	            "value" => __("Text on the button", "swift-framework-admin"),
	            "description" => __("Text on the button.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("URL (Link)", "swift-framework-admin"),
	            "param_name" => "href",
	            "value" => "",
	            "description" => __("Button link.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Color", "swift-framework-admin"),
	            "param_name" => "color",
	            "value" => $colors_arr,
	            "description" => __("Button color.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Target", "swift-framework-admin"),
	            "param_name" => "target",
	            "value" => $target_arr
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Button position", "swift-framework-admin"),
	            "param_name" => "position",
	            "value" => array(__("Align right", "swift-framework-admin") => "cta_align_right", __("Align left", "swift-framework-admin") => "cta_align_left", __("Align bottom", "swift-framework-admin") => "cta_align_bottom"),
	            "description" => __("Select button alignment.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textarea_html",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __("Text", "swift-framework-admin"),
	            "param_name" => "content",
	            "value" => __("click the edit button to change this text.", "swift-framework-admin"),
	            "description" => __("Enter your content.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Show alt background", "swift-framework-admin"),
	            "param_name" => "alt_background",
	            "value" => array(__("None", "swift-framework-admin") => "none", __("Alt 1", "swift-framework-admin") => "alt-one", __("Alt 2", "swift-framework-admin") => "alt-two", __("Alt 3", "swift-framework-admin") => "alt-three", __("Alt 4", "swift-framework-admin") => "alt-four", __("Alt 5", "swift-framework-admin") => "alt-five", __("Alt 6", "swift-framework-admin") => "alt-six", __("Alt 7", "swift-framework-admin") => "alt-seven", __("Alt 8", "swift-framework-admin") => "alt-eight", __("Alt 9", "swift-framework-admin") => "alt-nine", __("Alt 10", "swift-framework-admin") => "alt-ten"),
	            "description" => __("Show an alternative background around the asset. These can all be set in Theme Options > Asset Background Options. NOTE: This is only available on a page with the no sidebar setup.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "altbg_preview",
	            "heading" => __("Alt Background Preview", "swift-framework-admin"),
	            "param_name" => "altbg_preview",
	            "value" => "",
	            "description" => __("", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Extra class name", "swift-framework-admin"),
	            "param_name" => "el_class",
	            "value" => "",
	            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swift-framework-admin")
	        )
	    ),
	    "js_callback" => array("init" => "spbCallToActionInitCallBack", "save" => "spbCallToActionSaveCallBack")
	) );
?>
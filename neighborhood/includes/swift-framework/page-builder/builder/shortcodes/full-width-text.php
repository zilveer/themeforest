<?php
	
class SwiftPageBuilderShortcode_fullwidth_text extends SwiftPageBuilderShortcode {

    public function content( $atts, $content = null ) {

        $title = $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
        	'alt_background'	=> 'none',
            'el_class' => '',
            'el_position' => '',
            'width' => '1/1'
        ), $atts));

        $output = '';

        $el_class = $this->getExtraClass($el_class);
        $width = spb_translateColumnWidthToSpan($width);

        $el_class .= ' spb_text_column';
        
        $sidebar_config = sf_get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
        
        $sidebars = '';
        if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
        $sidebars = 'one-sidebar';
        } else if ($sidebar_config == "both-sidebars") {
        $sidebars = 'both-sidebars';
        } else {
        $sidebars = 'no-sidebars';
        }
        
        // Full width setup
        $fullwidth = false;
        if ($alt_background != "none" && $sidebars == "no-sidebars") {
        $fullwidth = true;
        }
                        
        $output .= "\n\t".'<div class="full-width-text spb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="spb_wrapper clearfix">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h4 class="spb_heading spb_text_heading"><span>'.$title.'</span></h4></div>' : '';
        $output .= "\n\t\t\t".do_shortcode($content);
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        $output = $this->startRow($el_position, $width, $fullwidth, "", $alt_background) . $output . $this->endRow($el_position, $width, $fullwidth);
        
        return $output;
    }
}

SPBMap::map( 'fullwidth_text', array(
    "name"		=> __("Text Block (Full Width)", "swiftframework"),
    "base"		=> "fullwidth_text",
    "class"		=> "fullwidth_text",
    "icon"      => "spb-icon-full-width-text",
    "params"	=> array(
	    array(
	        "type" => "textfield",
	        "heading" => __("Widget title", "swiftframework"),
	        "param_name" => "title",
	        "value" => "",
	        "description" => __("Heading text. Leave it empty if not needed.", "swiftframework")
	    ),
	    array(
	        "type" => "textarea_html",
	        "holder" => "div",
	        "class" => "",
	        "heading" => __("Text", "swiftframework"),
	        "param_name" => "content",
	        "value" => __("<p>This is a full width text block. Click the edit button to change this text.</p>", "swiftframework"),
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
    )
) );

?>
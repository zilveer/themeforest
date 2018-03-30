<?php
	
class SwiftPageBuilderShortcode_fullwidth_text extends SwiftPageBuilderShortcode {

    public function content( $atts, $content = null ) {

        $title = $el_class = $title_heading_class =  $width = $el_position = '';

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
        
        $title_heading_class = 'spb-center-heading';
                        
        $output .= "\n\t".'<div class="full-width-text spb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="spb_wrapper clearfix">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h3 class="spb-heading '.$title_heading_class.'"><span>'.$title.'</span></h3></div>' : '';
        $output .= "\n\t\t\t".do_shortcode($content);
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        $output = $this->startRow($el_position, $width, $fullwidth, "", $alt_background) . $output . $this->endRow($el_position, $width, $fullwidth, "fw-text");

        return $output;
    }
}

SPBMap::map( 'fullwidth_text', array(
    "name"		=> __("Text Block (Full Width)", "swift-framework-admin"),
    "base"		=> "fullwidth_text",
    "class"		=> "fullwidth_text",
    "icon"      => "spb-icon-full-width-text",
    "params"	=> array(
	    array(
	        "type" => "textfield",
	        "heading" => __("Widget title", "swift-framework-admin"),
	        "param_name" => "title",
	        "value" => "",
	        "description" => __("Heading text. Leave it empty if not needed.", "swift-framework-admin")
	    ),
	    array(
	        "type" => "textarea_html",
	        "holder" => "div",
	        "class" => "",
	        "heading" => __("Text", "swift-framework-admin"),
	        "param_name" => "content",
	        "value" => __("<p>This is a full width text block. Click the edit button to change this text.</p>", "swift-framework-admin"),
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
    )
) );

?>